@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container admin-shell">
            @include('admin.partials.sidebar')
            <div>
                <div class="page-hero page-hero-compact">
                    <div>
                        <span class="eyebrow">Siparis detayi</span>
                        <h1>{{ $order->order_number }}</h1>
                        <p>{{ $order->user->name }} icin olusturuldu. Guncel durum: {{ $order->adminStatusLabel() }}</p>
                    </div>
                    <div class="page-hero-actions">
                        <span class="status-pill {{ $order->statusVariant() }}">{{ $order->adminStatusLabel() }}</span>
                    </div>
                </div>

                <div class="admin-content-grid">
                    <div class="card">
                        <div class="card-body">
                            <div class="admin-action-row">
                                @if($order->status === 'pending_approval')
                                    <form method="post" action="{{ route('admin.orders.approve', $order) }}">
                                        @csrf
                                        <button type="submit">Siparisi onayla</button>
                                    </form>
                                @endif

                                @if($order->canAdvanceByAdmin())
                                    <form method="post" action="{{ route('admin.orders.advance', $order) }}">
                                        @csrf
                                        <button class="btn secondary" type="submit">{{ $order->nextFulfillmentLabel() }} olarak isaretle</button>
                                    </form>
                                @endif

                                @if($order->canBeCancelledByAdmin())
                                    <form method="post" action="{{ route('admin.orders.cancel', $order) }}">
                                        @csrf
                                        <button class="btn danger" type="submit">Siparisi iptal et</button>
                                    </form>
                                @endif

                                <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="btn light">Fatura Yazdir</a>
                            </div>

                            <div class="table-shell">
                                <table>
                                    <thead><tr><th>Urun</th><th>Adet</th><th>Birim fiyat</th><th>Tutar</th></tr></thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>{{ $item->product_name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->unit_price, 2, ',', '.') }} TL</td>
                                                <td>{{ number_format($item->line_total, 2, ',', '.') }} TL</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="order-side-stack">
                        <div class="card">
                            <div class="card-body">
                                <span class="eyebrow">Odeme ozeti</span>
                                <div class="summary-list">
                                    <div class="summary-line">
                                        <span>Ara toplam</span>
                                        <strong>{{ number_format($order->subtotal, 2, ',', '.') }} TL</strong>
                                    </div>
                                    <div class="summary-line">
                                        <span>Cuzdandan kullanilan</span>
                                        <strong>{{ number_format($order->wallet_used, 2, ',', '.') }} TL</strong>
                                    </div>
                                    <div class="summary-line">
                                        <span>Kartla odenen</span>
                                        <strong>{{ number_format($order->paid_amount, 2, ',', '.') }} TL</strong>
                                    </div>
                                    <div class="summary-line">
                                        <span>Genel toplam</span>
                                        <strong>{{ number_format($order->total_amount, 2, ',', '.') }} TL</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <span class="eyebrow">Teslimat adresi</span>
                                <div class="summary-list">
                                    <div class="summary-line">
                                        <span>Kisi</span>
                                        <strong>{{ $order->shipping_address['full_name'] }}</strong>
                                    </div>
                                    <div class="summary-line">
                                        <span>Telefon</span>
                                        <strong>{{ $order->shipping_address['phone'] }}</strong>
                                    </div>
                                    <p>{{ $order->shipping_address['address_line'] }}</p>
                                    <p>{{ $order->shipping_address['district'] }} / {{ $order->shipping_address['city'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <span class="eyebrow">Durum gecmisi</span>
                                <div class="timeline">
                                    @foreach($order->histories as $history)
                                        <div class="timeline-item">
                                            <strong>{{ $history->created_at->format('d.m.Y H:i') }}</strong>
                                            <p>{{ $history->note }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
