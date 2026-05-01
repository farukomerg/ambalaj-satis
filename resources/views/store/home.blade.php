@extends('layouts.app')

@section('content')
    @php($heroProduct = $featuredProducts->first() ?? $latestProducts->first())
    @php($promoProducts = $featuredProducts->take(4))
    @php($categoryIcons = ['BX', 'PS', 'NY', 'BT', 'SF', 'GD', 'PK', 'EV'])

    <section class="section">
        <div class="container">
            <div class="hero-shell">
                <div class="hero-copy">
                    <span class="eyebrow">Gorsel odakli yeni vitrin</span>
                    <h1>Ambalaj urunlerini daha dikkat cekici, daha profesyonel ve daha satici gosterin.</h1>
                    <p>Yakutsan benzeri guclu bir e-ticaret ritmi icin; kampanya hissi veren ust alan, renkli kategori vitrini ve sepete yonlendiren urun raflari hazirlandi.</p>

                    <div class="hero-actions">
                        <a class="btn" href="{{ route('products.index') }}">Urunleri incele</a>
                        <a class="btn ghost" href="#one-cikanlar">One cikanlari gor</a>
                        <a class="btn secondary" href="#kategoriler">Kategorileri ac</a>
                    </div>

                    <div class="feature-strip">
                        <span class="feature-badge">Renkli vitrin bloklari</span>
                        <span class="feature-badge">Sepete yonlendiren CTA</span>
                        <span class="feature-badge">Mobil uyumlu ticari duzen</span>
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
                                <span class="promo-pill">{{ $heroProduct->category->name }}</span>
                                <h3>{{ $heroProduct->name }}</h3>
                                <strong>{{ number_format($heroProduct->price, 2, ',', '.') }} TL</strong>
                            </div>
                        </a>
                    @endif

                    <div class="promo-stack">
                        <div class="feature-card">
                            <strong>Vitrin etkisi</strong>
                            <span class="muted">Daha fazla urun gosterimi, daha canli bir ilk ekran.</span>
                        </div>
                        <div class="feature-card">
                            <strong>Buton uyumu</strong>
                            <span class="muted">Detay, kategori ve sepet aksiyonlari tek dilde toplandi.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section tight">
        <div class="container promo-grid">
            <div class="promo-banner">
                <div class="promo-banner-top">
                    <span class="promo-pill">Sizin icin sectiklerimiz</span>
                    <span>Yeni vitrin</span>
                </div>
                <h3>Kategori gecislerini daha dikkat cekici hale getirin.</h3>
                <p>Ilk bakista profesyonel gorunen, ama kullaniciyi yormayan raf mantiginda bir ana sayfa akisi.</p>
            </div>

            <div class="promo-banner alt">
                <div class="promo-banner-top">
                    <span class="promo-pill">One cikan urunler</span>
                    <span>Sepete yonelik</span>
                </div>
                <h3>Urun kartlari artik daha satici bir sunuma sahip.</h3>
                <p>Gorsel, fiyat ve aksiyon dugmesi artik daha dengeli ve daha guclu gorunuyor.</p>
            </div>
        </div>
    </section>

    <section class="section" id="kategoriler">
        <div class="container">
            <x-store.section-heading eyebrow="Kategori vitrini" title="Renkli ve goz alici kategori bloklari" text="Referans sitedeki kategori zenginligini daha duzenli ve modern kartlarla yorumladim.">
                <x-slot:actions>
                    <a class="btn light" href="{{ route('products.index') }}">Tum kategoriler</a>
                </x-slot:actions>
            </x-store.section-heading>

            <div class="category-grid">
                @foreach($categories as $category)
                    <a class="category-card" href="{{ route('products.index', ['category' => $category->slug]) }}">
                        <div class="category-visual">{{ $categoryIcons[$loop->index % count($categoryIcons)] }}</div>
                        <div class="category-card-body">
                            <div class="category-card-top">
                                <span class="category-index">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="pill">{{ $category->products_count }} urun</span>
                            </div>
                            <h3>{{ $category->name }}</h3>
                            <p>{{ $category->description ?: 'Farkli kullanim alanlari icin secilmis urunler.' }}</p>
                            <div class="category-meta">
                                <span>Koleksiyonu ac</span>
                                <span>Detayli incele</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section" id="one-cikanlar">
        <div class="container">
            <x-store.section-heading eyebrow="Sizin icin sectiklerimiz" title="Sepete eklemeye hazir urun raflari" text="Yakutsan tarzi magazalarda oldugu gibi urunleri bloklar halinde one cikaran bir vitrin akisi kuruldu." />

            <div class="product-grid">
                @foreach($featuredProducts as $product)
                    @include('store.partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container showcase-grid">
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

            <div class="card">
                <div class="card-body">
                    <span class="eyebrow">Vitrin gucleri</span>
                    <div class="feature-list">
                        <div class="feature-card">
                            <strong>Daha dikkat cekici ana ekran</strong>
                            <span class="muted">Renk, hacim ve ticari aksiyon dengesi yukseltilmis durumda.</span>
                        </div>
                        <div class="feature-card">
                            <strong>Daha guclu urun kartlari</strong>
                            <span class="muted">Kartlar artik gorsel ve fiyat odagini daha iyi kuruyor.</span>
                        </div>
                        <div class="feature-card">
                            <strong>Daha uyumlu buton sistemi</strong>
                            <span class="muted">Tum CTA'lar ortak bir ticari tasarim dilinde toplandi.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($promoProducts->isNotEmpty())
        <section class="section tight">
            <div class="container">
                <x-store.section-heading eyebrow="En cok ilgi gorenler" title="Kampanya hissi veren ikinci urun rafi" />
                <div class="product-grid">
                    @foreach($promoProducts as $product)
                        @include('store.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
