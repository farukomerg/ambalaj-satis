<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $items = $request->user()->cartItems()->with('product.primaryImage')->get();

        return view('cart.index', [
            'items' => $items,
            'subtotal' => $items->sum(fn (CartItem $item) => $item->lineTotal()),
        ]);
    }

    public function store(Request $request, Product $product)
    {
        abort_unless($product->is_active, 404);

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:'.$product->min_order_quantity, 'max:'.$product->stock],
        ]);

        $item = CartItem::firstOrNew([
            'user_id' => $request->user()->id,
            'product_id' => $product->id,
        ]);

        $item->quantity = min($product->stock, ($item->exists ? $item->quantity : 0) + $data['quantity']);
        $item->save();

        return redirect()->route('cart.index')->with('success', 'Urun sepete eklendi.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        abort_unless($cartItem->user_id === $request->user()->id, 403);

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$cartItem->product->stock],
        ]);

        $cartItem->update($data);

        return back()->with('success', 'Sepet guncellendi.');
    }

    public function destroy(Request $request, CartItem $cartItem)
    {
        abort_unless($cartItem->user_id === $request->user()->id, 403);
        $cartItem->delete();

        return back()->with('success', 'Urun sepetten cikarildi.');
    }
}
