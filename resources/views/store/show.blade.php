@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Anasayfa</a>
                <span>/</span>
                <a href="{{ route('products.index') }}">Urunler</a>
                <span>/</span>
                <span>{{ $product->name }}</span>
            </div>

            <div class="detail-shell">
                <div class="detail-media card">
                    <img class="detail-image" src="{{ $product->imageUrl() }}" alt="{{ $product->name }}">
                </div>

                <div class="card detail-summary">
                    <div class="card-body">
                        <span class="eyebrow">{{ $product->category->name }}</span>
                        <h1>{{ $product->name }}</h1>
                        <p class="muted">{{ $product->description }}</p>

                        <div class="price-row">
                            <p class="price">{{ number_format($product->price, 2, ',', '.') }} TL</p>
                            <span class="stock-pill">{{ $product->stock }} {{ $product->unit }} stok</span>
                        </div>

                        <div class="spec-grid">
                            <div class="spec-item">
                                <span>Olcu</span>
                                <strong>{{ $product->size ?? '-' }}</strong>
                            </div>
                            <div class="spec-item">
                                <span>Malzeme</span>
                                <strong>{{ $product->material ?? '-' }}</strong>
                            </div>
                            <div class="spec-item">
                                <span>Renk</span>
                                <strong>{{ $product->color ?? '-' }}</strong>
                            </div>
                            <div class="spec-item">
                                <span>Min adet</span>
                                <strong>{{ $product->min_order_quantity }}</strong>
                            </div>
                        </div>

                        @auth
                            <form action="{{ route('cart.store', $product) }}" method="post">
                                @csrf
                                <div class="field">
                                    <label>Adet</label>
                                    <input type="number" name="quantity" min="{{ $product->min_order_quantity }}" max="{{ $product->stock }}" value="{{ $product->min_order_quantity }}">
                                </div>
                                <button type="submit">Sepete ekle</button>
                            </form>
                        @else
                            <a class="btn" href="{{ route('login') }}">Sepete eklemek icin giris yap</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container detail-lower">
            <div class="card">
                <div class="card-body">
                    <span class="eyebrow">Kisa notlar</span>
                    <div class="summary-list">
                        <div class="summary-line"><span>Kullanim</span><strong>Gunluk ihtiyac ve paketleme</strong></div>
                        <div class="summary-line"><span>Gorunum</span><strong>Sade detay alani</strong></div>
                        <div class="summary-line"><span>Sepet</span><strong>Mobilde tek alandan ekleme</strong></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <span class="eyebrow">Etiketler</span>
                    <div class="tag-list">
                        <span class="tag">Ev kullanimi</span>
                        <span class="tag">Mutfak</span>
                        <span class="tag">Paketleme</span>
                        @if($product->material)
                            <span class="tag">{{ $product->material }}</span>
                        @endif
                        @if($product->size)
                            <span class="tag">{{ $product->size }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($relatedProducts->isNotEmpty())
        <section class="section">
            <div class="container">
                <x-store.section-heading eyebrow="Benzer urunler" title="Buna bakanlar bunlari da inceledi" />

                <div class="product-grid">
                    @foreach($relatedProducts as $product)
                        @include('store.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
