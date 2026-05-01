@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <x-store.page-hero eyebrow="Siparislerim" title="Tum siparislerinizi tek ekranda gorun." subtitle="Tablo yerine kart yapisi kullanilarak mobil deneyim iyilestirildi." compact />

            <div class="order-grid">
                @forelse($orders as $order)
                    @include('store.partials.order-card', ['order' => $order])
                @empty
                    <div class="empty-state">Henuz bir siparisiniz yok.</div>
                @endforelse
            </div>

            {{ $orders->links() }}
        </div>
    </section>
@endsection
