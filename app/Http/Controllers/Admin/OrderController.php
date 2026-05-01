<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index', [
            'orders' => Order::with('user')->latest()->paginate(12),
        ]);
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', [
            'order' => $order->load(['user', 'items', 'histories']),
        ]);
    }

    public function approve(Order $order)
    {
        if ($order->status !== 'pending_approval') {
            return back()->with('error', 'Bu siparis zaten isleme alinmis.');
        }

        $order->update([
            'status' => 'approved',
            'fulfillment_status' => 'sourcing',
            'approved_at' => now(),
        ]);

        $order->histories()->create([
            'status' => 'sourcing',
            'note' => 'Admin siparisi onayladi; urunler tedarik ediliyor.',
        ]);

        return back()->with('success', 'Siparis onaylandi.');
    }

    public function advance(Order $order)
    {
        if ($order->status !== 'approved') {
            return back()->with('error', 'Sadece onayli siparislerde surec ilerletilebilir.');
        }

        $steps = array_keys(Order::FULFILLMENT_STEPS);
        $currentIndex = array_search($order->fulfillment_status, $steps, true);
        $next = $steps[min($currentIndex + 1, count($steps) - 1)];

        $order->update(['fulfillment_status' => $next]);
        $order->histories()->create([
            'status' => $next,
            'note' => Order::FULFILLMENT_STEPS[$next],
        ]);

        return back()->with('success', 'Siparis durumu ilerletildi.');
    }
}
