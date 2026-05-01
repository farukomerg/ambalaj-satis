<article class="order-card">
    <div class="order-top">
        <div>
            <strong>{{ $order->order_number }}</strong>
            <p class="mini-meta">{{ $order->created_at->format('d.m.Y H:i') }}</p>
        </div>
        <span class="status-pill">{{ $order->statusLabel() }}</span>
    </div>

    <div class="summary-line">
        <span>Durum</span>
        <strong>{{ $order->fulfillmentLabel() }}</strong>
    </div>

    <div class="summary-line">
        <span>Toplam</span>
        <strong class="order-total">{{ number_format($order->total_amount, 2, ',', '.') }} TL</strong>
    </div>

    <a class="btn ghost small" href="{{ route('orders.show', $order) }}">Detay</a>
</article>
