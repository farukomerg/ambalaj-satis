<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $items = $request->user()->cartItems()->with('product')->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Sepetiniz bos.');
        }

        return view('checkout.show', [
            'items' => $items,
            'subtotal' => $items->sum(fn (CartItem $item) => $item->lineTotal()),
            'defaultAddress' => $request->user()->addresses()->where('is_default', true)->first(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'city' => ['required', 'string', 'max:120'],
            'district' => ['required', 'string', 'max:120'],
            'address_line' => ['required', 'string', 'max:1000'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'card_holder' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'string', 'min:12', 'max:24'],
        ]);

        $user = $request->user();
        $items = $user->cartItems()->with('product')->lockForUpdate()->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Sepetiniz bos.');
        }

        $order = DB::transaction(function () use ($items, $user, $data) {
            foreach ($items as $item) {
                if ($item->quantity > $item->product->stock) {
                    abort(422, "{$item->product->name} icin yeterli stok yok.");
                }
            }

            $subtotal = $items->sum(fn (CartItem $item) => $item->lineTotal());
            $walletUsed = min((float) $user->wallet_balance, $subtotal);
            $paidAmount = $subtotal - $walletUsed;

            if ($walletUsed > 0) {
                $user->decrement('wallet_balance', $walletUsed);
            }

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'AMB-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)),
                'subtotal' => $subtotal,
                'wallet_used' => $walletUsed,
                'paid_amount' => $paidAmount,
                'total_amount' => $subtotal,
                'shipping_address' => collect($data)->except(['card_holder', 'card_number'])->all(),
            ]);

            foreach ($items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'unit_price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'line_total' => $item->lineTotal(),
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            OrderStatusHistory::create([
                'order_id' => $order->id,
                'status' => 'pending_approval',
                'note' => 'Siparis alindi. Hazirlama sirasina eklendi.',
            ]);

            if ($walletUsed > 0) {
                WalletTransaction::create([
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    'type' => 'debit',
                    'amount' => $walletUsed,
                    'description' => 'Sipariste site bakiyesi kullanildi.',
                ]);
            }

            $user->cartItems()->delete();

            return $order;
        });

        return redirect()->route('orders.show', $order)->with('success', 'Siparisiniz alindi.');
    }
}
