@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <x-store.page-hero eyebrow="Sepet" title="Sectiklerinizi gozden gecirin." subtitle="Kart yapisi sayesinde telefonda da adet degistirmek ve urun kaldirmak daha rahat.">
                <x-slot:actions>
                    <a class="btn light" href="{{ route('products.index') }}">Alisverise devam et</a>
                </x-slot:actions>
            </x-store.page-hero>

            @if($items->isEmpty())
                <div class="empty-state">Sepetiniz bos.</div>
            @else
                <div class="cart-layout">
                    <div class="item-stack">
                        @foreach($items as $item)
                            @include('store.partials.cart-item', ['item' => $item])
                        @endforeach
                    </div>

                    <aside class="summary-card">
                        <span class="eyebrow">Siparis ozeti</span>
                        <div class="summary-list">
                            <div class="summary-line">
                                <span>Urun sayisi</span>
                                <strong>{{ $items->sum('quantity') }}</strong>
                            </div>
                            <div class="summary-line">
                                <span>Toplam</span>
                                <strong>{{ number_format($subtotal, 2, ',', '.') }} TL</strong>
                            </div>
                        </div>

                        <div class="hero-actions">
                            <a class="btn" href="{{ route('checkout.show') }}">Odeme adimina gec</a>
                        </div>
                    </aside>
                </div>
            @endif
        </div>
    </section>
@endsection
