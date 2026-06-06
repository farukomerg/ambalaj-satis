@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <x-store.page-hero eyebrow="Siparis detayi" :title="$order->order_number" :subtitle="$order->customerStatusLabel()" compact>
                <x-slot:actions>
                    <span class="status-pill {{ $order->statusVariant() }}">{{ $order->customerStatusLabel() }}</span>
                </x-slot:actions>
            </x-store.page-hero>

            <div class="grid two">
                <div class="card">
                    <div class="card-body">
                        <div class="notice-panel">
                            <strong>{{ $order->secondaryStatusText() }}</strong>
                        </div>

                        <div class="summary-list">
                            @foreach($order->items as $item)
                                <div class="summary-line">
                                    <span>{{ $item->quantity }} x {{ $item->product_name }}</span>
                                    <strong>{{ number_format($item->line_total, 2, ',', '.') }} TL</strong>
                                </div>
                            @endforeach
                            <hr>
                            <div class="summary-line">
                                <span>Toplam</span>
                                <strong>{{ number_format($order->total_amount, 2, ',', '.') }} TL</strong>
                            </div>
                        </div>

                        <div class="hero-actions">
                            @if($order->canBeCancelledByUser())
                                <form method="post" action="{{ route('orders.cancel', $order) }}">
                                    @csrf
                                    <button class="btn danger" type="submit">Siparisi iptal et</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <aside class="card">
                    <div class="card-body">
                        <span class="eyebrow">Surec</span>
                        <div class="timeline">
                            @foreach($order->histories as $history)
                                <div class="timeline-item">
                                    <strong>{{ $history->created_at->format('d.m.Y H:i') }}</strong>
                                    <p>{{ $history->note }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
