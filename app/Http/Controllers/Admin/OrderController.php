<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderWorkflowService;

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

    public function approve(Order $order, OrderWorkflowService $workflow)
    {
        if ($order->status !== 'pending_approval') {
            return back()->with('error', 'Bu siparis zaten isleme alinmis.');
        }

        $workflow->approve($order);

        return back()->with('success', 'Siparis onaylandi.');
    }

    public function advance(Order $order, OrderWorkflowService $workflow)
    {
        if (! $order->canAdvanceByAdmin()) {
            return back()->with('error', 'Sadece onayli siparislerde surec ilerletilebilir.');
        }

        $next = $workflow->advance($order);

        return back()->with('success', 'Siparis durumu "'.Order::FULFILLMENT_STEPS[$next].'" asamasina gecti.');
    }

    public function cancel(Order $order, OrderWorkflowService $workflow)
    {
        if (! $order->canBeCancelledByAdmin()) {
            return back()->with('error', 'Bu siparis artik iptal edilemez.');
        }

        $workflow->cancel(
            $order,
            'Siparis admin tarafindan iptal edildi.',
            'Admin tarafindan iptal edilen siparis tutari kullanici bakiyesine eklendi.'
        );

        return back()->with('success', 'Siparis iptal edildi ve tutar kullanici hesabina aktarildi.');
    }

    public function invoice(Order $order)
    {
        return view('admin.orders.invoice', [
            'order' => $order->load(['user', 'items']),
        ]);
    }
}
