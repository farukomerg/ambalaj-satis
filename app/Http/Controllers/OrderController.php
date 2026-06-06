<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderWorkflowService;
use Illuminate\Http\Request;

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

    public function cancel(Request $request, Order $order, OrderWorkflowService $workflow)
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        if (! $order->canBeCancelledByUser()) {
            return back()->with('error', 'Hazirlama basladiktan sonra siparis iptal edilemez.');
        }

        $workflow->cancel(
            $order,
            'Siparis kullanici tarafindan iptal edildi.',
            'Siparis iptal iadesi kullanici bakiyesine eklendi.'
        );

        return back()->with('success', 'Siparis iptal edildi ve tutar hesabiniza yansitildi.');
    }

    public function markDelivered(Request $request, Order $order, OrderWorkflowService $workflow)
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        if (! $order->canBeMarkedDeliveredByUser()) {
            return back()->with('error', 'Teslimat onayi su anda aktif degil.');
        }

        $workflow->confirmDelivery($order);

        return back()->with('success', 'Teslimat onaylandi.');
    }
}
