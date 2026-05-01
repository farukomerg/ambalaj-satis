@extends('layouts.app')

@section('content')
    @php($heroProduct = $featuredProducts->first() ?? $latestProducts->first())

    <section class="section">
        <div class="container">
            <div class="hero-shell">
                <div class="hero-copy">
                    <span class="eyebrow">Ev, mutfak ve kutlama icin</span>
                    <h1>Gunluk ihtiyaclar icin daha sade ve daha hizli bir alisveris deneyimi.</h1>
                    <p>Urunleri bulmak, detaylari gormek ve telefondan sepete eklemek artik daha kolay.</p>

                    <div class="hero-actions">
                        <a class="btn" href="{{ route('products.index') }}">Alisverise basla</a>
                        <a class="btn ghost" href="#kategoriler">Kategorileri gor</a>
                    </div>

                    <div class="hero-metrics">
                        @foreach($metrics as $metric)
                            <div class="metric-pill">
                                <strong>{{ $metric['value'] }}</strong>
                                <span>{{ $metric['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="hero-side">
                    @if($heroProduct)
                        <a class="hero-product" href="{{ route('products.show', $heroProduct) }}">
                            <img src="{{ $heroProduct->imageUrl() }}" alt="{{ $heroProduct->name }}">
                            <div class="hero-product-body">
                                <span class="pill">{{ $heroProduct->category->name }}</span>
                                <h3>{{ $heroProduct->name }}</h3>
                                <strong>{{ number_format($heroProduct->price, 2, ',', '.') }} TL</strong>
                            </div>
                        </a>
                    @endif

                    <div class="point-grid">
                        <div class="point-card">
                            <strong>Mobil rahat</strong>
                            <span>Telefon ekraninda kolay gezinme</span>
                        </div>
                        <div class="point-card">
                            <strong>Net kartlar</strong>
                            <span>Fiyat, stok ve detay ayni yerde</span>
                        </div>
                        <div class="point-card">
                            <strong>Hizli sepet</strong>
                            <span>Az adimla satin alma</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="kategoriler">
        <div class="container">
            <x-store.section-heading eyebrow="Kategoriler" title="En cok bakilan kategoriler" text="Kisa aciklamalar ve temiz kart yapisiyla kategoriye hizli gecis.">
                <x-slot:actions>
                    <a class="btn light" href="{{ route('products.index') }}">Tum urunler</a>
                </x-slot:actions>
            </x-store.section-heading>

            <div class="category-grid">
                @foreach($categories as $category)
                    @include('store.partials.category-card', ['category' => $category])
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <x-store.section-heading eyebrow="One cikanlar" title="Sepete eklemesi kolay secimler" text="Yazi yogunlugunu azaltan, urunu one cikaran kart yapisi kullanildi." />

            <div class="product-grid">
                @foreach($featuredProducts as $product)
                    @include('store.partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container info-grid">
            <div class="card">
                <div class="card-body">
                    <span class="eyebrow">Neden daha iyi</span>
                    <div class="summary-list">
                        <div class="summary-line"><span>Daha hafif metin</span><strong>Daha az kalabalik</strong></div>
                        <div class="summary-line"><span>Moduler yapi</span><strong>Parcali Blade bilesenleri</strong></div>
                        <div class="summary-line"><span>Mobil akış</span><strong>Kart temelli duzen</strong></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <span class="eyebrow">Yeni eklenenler</span>
                    <div class="order-stack">
                        @foreach($latestProducts as $product)
                            <a class="summary-line" href="{{ route('products.show', $product) }}">
                                <span>{{ $product->name }}</span>
                                <strong>{{ number_format($product->price, 2, ',', '.') }} TL</strong>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
