@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container admin-shell">
            @include('admin.partials.sidebar')
            <div>
                <h1>{{ $order->order_number }}</h1>
                <p>Kullanici: <strong>{{ $order->user->name }}</strong></p>
                <p>Durum: <span class="pill">{{ $order->status }}</span> {{ \App\Models\Order::FULFILLMENT_STEPS[$order->fulfillment_status] }}</p>
                <div class="toolbar">
                    @if($order->status === 'pending_approval')
                        <form method="post" action="{{ route('admin.orders.approve', $order) }}">
                            @csrf
                            <button type="submit">Siparisi onayla</button>
                        </form>
                    @endif
                    @if($order->status === 'approved' && $order->fulfillment_status !== 'delivered')
                        <form method="post" action="{{ route('admin.orders.advance', $order) }}">
                            @csrf
                            <button type="submit">Sureci ilerlet</button>
                        </form>
                    @endif
                </div>
                <table>
                    <thead><tr><th>Urun</th><th>Adet</th><th>Tutar</th></tr></thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr><td>{{ $item->product_name }}</td><td>{{ $item->quantity }}</td><td>{{ number_format($item->line_total, 2, ',', '.') }} TL</td></tr>
                        @endforeach
                    </tbody>
                </table>
                <h2>Toplam: {{ number_format($order->total_amount, 2, ',', '.') }} TL</h2>
                <h2>Teslimat adresi</h2>
                <p>{{ $order->shipping_address['full_name'] }} - {{ $order->shipping_address['phone'] }}</p>
                <p>{{ $order->shipping_address['address_line'] }}, {{ $order->shipping_address['district'] }}/{{ $order->shipping_address['city'] }}</p>
            </div>
        </div>
    </section>
@endsection
