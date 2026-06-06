<?php

namespace App\Services;

use App\Models\Order;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;

class OrderWorkflowService
{
    public function approve(Order $order): void
    {
        $order->update([
            'status' => 'approved',
            'fulfillment_status' => 'sourcing',
            'approved_at' => now(),
        ]);

        $order->histories()->create([
            'status' => 'sourcing',
            'note' => 'Siparis onaylandi ve hazirlama asamasina alindi.',
        ]);
    }

    public function advance(Order $order): string
    {
        $steps = Order::advanceableFulfillmentSteps();
        $currentIndex = array_search($order->fulfillment_status, $steps, true);
        $next = $steps[min(($currentIndex === false ? 0 : $currentIndex + 1), count($steps) - 1)];

        $order->update(['fulfillment_status' => $next]);
        $order->histories()->create([
            'status' => $next,
            'note' => $next === 'delivered'
                ? 'Siparis teslim edildi olarak isaretlendi. Musteri onayi bekleniyor.'
                : Order::FULFILLMENT_STEPS[$next],
        ]);

        return $next;
    }

    public function cancel(Order $order, string $historyNote, string $refundDescription): void
    {
        $order->loadMissing(['items.product', 'user']);

        DB::transaction(function () use ($order, $historyNote, $refundDescription): void {
            foreach ($order->items as $item) {
                $item->product?->increment('stock', $item->quantity);
            }

            $order->update([
                'status' => 'cancelled',
                'fulfillment_status' => 'cancelled',
                'cancelled_at' => now(),
            ]);

            $alreadyRefunded = WalletTransaction::query()
                ->where('order_id', $order->id)
                ->where('type', 'credit')
                ->exists();

            if (! $alreadyRefunded) {
                $order->user()->increment('wallet_balance', $order->total_amount);

                WalletTransaction::create([
                    'user_id' => $order->user_id,
                    'order_id' => $order->id,
                    'type' => 'credit',
                    'amount' => $order->total_amount,
                    'description' => $refundDescription,
                ]);
            }

            $order->histories()->create([
                'status' => 'cancelled',
                'note' => $historyNote,
            ]);
        });
    }

    public function confirmDelivery(Order $order): void
    {
        $order->update([
            'status' => 'completed',
            'delivered_at' => now(),
        ]);

        $order->histories()->create([
            'status' => 'customer_confirmed_delivery',
            'note' => 'Musteri siparisi teslim aldigini onayladi.',
        ]);
    }
}
