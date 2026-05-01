@php($appName = config('app.name', 'Ambalaj Satis'))
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $appName }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @include('layouts.partials.storefront-styles')
</head>
<body>
    <header class="site-header">
        <div class="announcement-bar">
            <div class="container announcement-content">
                <span>Mutfak, ev, kutlama ve gonderim icin ambalaj urunleri tek yerde.</span>
                <span class="announcement-note">B2C magazasi</span>
            </div>
        </div>

        <div class="topbar">
            <nav class="container nav">
                <a class="brand" href="{{ route('home') }}">
                    <span class="brand-mark">AS</span>
                    <span class="brand-copy">
                        <strong>{{ $appName }}</strong>
                        <small>Gunluk Ambalaj Magazasi</small>
                    </span>
                </a>

                <div class="nav-links">
                    <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Anasayfa</a>
                    <a class="{{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Urunler</a>
                    <a href="{{ route('home') }}#kategoriler">Kategoriler</a>
                </div>

                <div class="nav-actions">
                    @auth
                        <a class="btn ghost small" href="{{ route('cart.index') }}">Sepet</a>
                        <a class="btn light small" href="{{ route('orders.index') }}">Siparislerim</a>
                        <a class="btn ghost small" href="{{ route('profile.edit') }}">Profil</a>
                        @if(auth()->user()->isAdmin())
                            <a class="pill" href="{{ route('admin.dashboard') }}">Admin</a>
                        @endif
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="link-button" type="submit">Cikis</button>
                        </form>
                    @else
                        <a class="btn ghost small" href="{{ route('login') }}">Giris</a>
                        <a class="btn light small" href="{{ route('register') }}">Hesap olustur</a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <main class="page-shell">
        <div class="container alert-stack">
            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert error">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert error">{{ $errors->first() }}</div>
            @endif
        </div>

        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div>
                <div class="brand" style="margin-bottom: 14px;">
                    <span class="brand-mark">AS</span>
                    <span class="brand-copy">
                        <strong>{{ $appName }}</strong>
                        <small>Gunluk Ambalaj Magazasi</small>
                    </span>
                </div>
                <p>Kolay gezilen kategori yapisi, hafif metin kullanimi ve telefonda da rahat calisan alisveris akisi.</p>
            </div>

            <div>
                <h3>Magaza</h3>
                <div class="footer-links">
                    <a href="{{ route('products.index') }}">Urunler</a>
                    <a href="{{ route('home') }}#kategoriler">Kategoriler</a>
                    <a href="{{ route('cart.index') }}">Sepet</a>
                </div>
            </div>

            <div>
                <h3>Hesabim</h3>
                <div class="footer-links">
                    @auth
                        <a href="{{ route('orders.index') }}">Siparislerim</a>
                        <a href="{{ route('profile.edit') }}">Profil</a>
                    @else
                        <a href="{{ route('login') }}">Giris yap</a>
                        <a href="{{ route('register') }}">Kayit ol</a>
                    @endauth
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
