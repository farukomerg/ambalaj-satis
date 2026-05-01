@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container admin-shell">
            @include('admin.partials.sidebar')
            <div>
                <h1>Siparis yonetimi</h1>
                <table>
                    <thead><tr><th>No</th><th>Kullanici</th><th>Durum</th><th>Tutar</th><th></th></tr></thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->status }} / {{ \App\Models\Order::FULFILLMENT_STEPS[$order->fulfillment_status] }}</td>
                                <td>{{ number_format($order->total_amount, 2, ',', '.') }} TL</td>
                                <td><a class="btn light" href="{{ route('admin.orders.show', $order) }}">Yonet</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </section>
@endsection
