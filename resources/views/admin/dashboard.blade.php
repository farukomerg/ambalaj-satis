@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container admin-shell">
            @include('admin.partials.sidebar')
            <div>
                <h1>Admin paneli</h1>
                <div class="grid cards">
                    <div class="stat"><span class="muted">Urun</span><strong>{{ $productCount }}</strong></div>
                    <div class="stat"><span class="muted">Kullanici</span><strong>{{ $userCount }}</strong></div>
                    <div class="stat"><span class="muted">Onay bekleyen</span><strong>{{ $pendingOrders }}</strong></div>
                </div>
                <h2>Son siparisler</h2>
                <table>
                    <thead><tr><th>No</th><th>Kullanici</th><th>Durum</th><th></th></tr></thead>
                    <tbody>
                        @foreach($latestOrders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->status }}</td>
                                <td><a class="btn light" href="{{ route('admin.orders.show', $order) }}">Ac</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
