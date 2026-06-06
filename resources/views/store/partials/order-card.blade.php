<article class="order-card">
    <div class="order-top">
        <div>
            <strong>{{ $order->order_number }}</strong>
            <p class="mini-meta">{{ $order->created_at->format('d.m.Y H:i') }}</p>
        </div>
        <span class="status-pill {{ $order->statusVariant() }}">{{ $order->customerStatusLabel() }}</span>
    </div>

    <div class="summary-line">
        <span>Durum</span>
        <strong>{{ $order->secondaryStatusText() }}</strong>
    </div>

    <div class="summary-line">
        <span>Toplam</span>
        <strong class="order-total">{{ number_format($order->total_amount, 2, ',', '.') }} TL</strong>
    </div>

    <div class="order-actions">
        <a class="btn ghost small" href="{{ route('orders.show', $order) }}">Detay</a>

        @if($order->canBeMarkedDeliveredByUser())
            <form method="post" action="{{ route('orders.delivered', $order) }}">
                @csrf
                <button class="btn secondary small" type="submit">Teslim aldim</button>
            </form>
        @endif
    </div>
</article>
