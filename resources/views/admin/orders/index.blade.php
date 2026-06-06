@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container admin-shell">
            @include('admin.partials.sidebar')
            <div>
                <div class="section-head">
                    <div class="section-head-main">
                        <span class="eyebrow">Siparis yonetimi</span>
                        <h1>Siparis akislarini tek ekrandan yonetin</h1>
                        <p class="section-head-copy">Onay, iptal ve kargo adimlari kullanici tarafindaki gorunumle uyumlu hale getirildi.</p>
                    </div>
                </div>

                <div class="table-shell">
                    <table>
                        <thead><tr><th>No</th><th>Kullanici</th><th>Durum</th><th>Tutar</th><th></th></tr></thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <strong>{{ $order->order_number }}</strong>
                                        <div class="mini-meta">{{ $order->created_at->format('d.m.Y H:i') }}</div>
                                    </td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>
                                        <span class="status-pill {{ $order->statusVariant() }}">{{ $order->adminStatusLabel() }}</span>
                                    </td>
                                    <td>{{ number_format($order->total_amount, 2, ',', '.') }} TL</td>
                                    <td><a class="btn light small" href="{{ route('admin.orders.show', $order) }}">Yonet</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $orders->links() }}
            </div>
        </div>
    </section>
@endsection
