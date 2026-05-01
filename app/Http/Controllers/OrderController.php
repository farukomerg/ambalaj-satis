<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return view('orders.index', [
            'orders' => $request->user()->orders()->latest()->paginate(10),
        ]);
    }

    public function show(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id || $request->user()->isAdmin(), 403);

        return view('orders.show', [
            'order' => $order->load(['items', 'histories']),
        ]);
    }

    public function cancel(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        if (! $order->canBeCancelledByUser()) {
            return back()->with('error', 'Hazirlama basladiktan sonra siparis iptal edilemez.');
        }

        DB::transaction(function () use ($order, $request): void {
            foreach ($order->items as $item) {
                $item->product?->increment('stock', $item->quantity);
            }

            $order->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
            ]);

            $request->user()->increment('wallet_balance', $order->total_amount);

            WalletTransaction::create([
                'user_id' => $request->user()->id,
                'order_id' => $order->id,
                'type' => 'credit',
                'amount' => $order->total_amount,
                'description' => 'Onaylanmamis siparis iptal iadesi.',
            ]);

            $order->histories()->create([
                'status' => 'cancelled',
                'note' => 'Siparis kullanici tarafindan iptal edildi.',
            ]);
        });

        return back()->with('success', 'Siparis iptal edildi ve tutar hesabiniza yansitildi.');
    }

    public function markDelivered(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        if (! $order->canBeMarkedDeliveredByUser()) {
            return back()->with('error', 'Teslimat onayi su anda aktif degil.');
        }

        $order->update(['delivered_at' => now()]);
        $order->histories()->create([
            'status' => 'customer_confirmed_delivery',
            'note' => 'Kullanici urunleri teslim aldigini onayladi.',
        ]);

        return back()->with('success', 'Teslimat onaylandi.');
    }
}
