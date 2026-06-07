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
                <span>Tum siparislerde dikkat ceken vitrin, hizli sepet ve guclu urun sunumu.</span>
                <span class="announcement-note" id="currency-widget">Kurlar yükleniyor...</span>
            </div>
        </div>

        <div class="topbar">
            <nav class="container nav">
                <div class="nav-header">
                    <a class="brand" href="{{ route('home') }}">
                        <span class="brand-mark">AS</span>
                        <span class="brand-copy">
                            <strong>{{ $appName }}</strong>
                            <small>Ambalaj ve Sarf Marketi</small>
                        </span>
                    </a>
                    <button class="mobile-menu-toggle" id="mobile-toggle" aria-label="Menu">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    </button>
                </div>

                <div class="nav-menu" id="nav-menu">
                    <div class="nav-links">
                    <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Anasayfa</a>
                    <a class="{{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Urunler</a>
                    <a href="{{ route('home') }}#kategoriler">Kategoriler</a>
                    <a href="{{ route('home') }}#one-cikanlar">One cikanlar</a>
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
                        <a class="btn secondary small" href="{{ route('register') }}">Uye ol</a>
                    @endauth
                </div>
                    </div>
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
                        <small>Ambalaj ve Sarf Marketi</small>
                    </span>
                </div>
                <p>Gorsel olarak daha guclu, urun vitrini daha ticari ve buton dili daha uyumlu bir magazaya donusturuldu.</p>
            </div>

            <div>
                <h3>Magaza</h3>
                <div class="footer-links">
                    <a href="{{ route('products.index') }}">Tum urunler</a>
                    <a href="{{ route('home') }}#kategoriler">Kategori vitrini</a>
                    <a href="{{ route('home') }}#one-cikanlar">One cikanlar</a>
                </div>
            </div>

            <div>
                <h3>Hesabim</h3>
                <div class="footer-links">
                    @auth
                        <a href="{{ route('cart.index') }}">Sepet</a>
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
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('mobile-toggle');
            const navMenu = document.getElementById('nav-menu');
            
            if(toggleBtn && navMenu) {
                toggleBtn.addEventListener('click', () => {
                    navMenu.classList.toggle('is-open');
                });
            }

            fetch('https://open.er-api.com/v6/latest/USD')
                .then(response => response.json())
                .then(data => {
                    const tryRate = data.rates.TRY.toFixed(2);
                    const eurRate = (data.rates.TRY / data.rates.EUR).toFixed(2);
                    document.getElementById('currency-widget').innerHTML = `<strong>USD:</strong> ${tryRate} ₺ &nbsp;|&nbsp; <strong>EUR:</strong> ${eurRate} ₺`;
                })
                .catch(() => {
                    document.getElementById('currency-widget').textContent = 'Kurlar alınamadı';
                });
        });
    </script>
</body>
</html>
