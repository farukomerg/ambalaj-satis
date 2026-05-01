@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <x-store.page-hero eyebrow="Profil" title="Hesap bilgilerinizi duzenleyin." subtitle="Form duzeni mobilde de rahat kullanilacak sekilde tutuldu." compact />

            <div class="form-shell">
                <form class="card" method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="field"><label>Ad soyad</label><input name="name" value="{{ old('name', $user->name) }}" required></div>
                        <div class="field"><label>E-posta</label><input name="email" type="email" value="{{ old('email', $user->email) }}" required></div>
                        <div class="field"><label>Telefon</label><input name="phone" value="{{ old('phone', $user->phone) }}"></div>
                        <div class="field"><label>Adres</label><textarea name="address" rows="4">{{ old('address', $user->address) }}</textarea></div>
                        <div class="field"><label>Yeni sifre</label><input name="password" type="password"></div>
                        <div class="field"><label>Yeni sifre tekrar</label><input name="password_confirmation" type="password"></div>
                        <button type="submit">Bilgileri guncelle</button>
                    </div>
                </form>

                <aside class="summary-card">
                    <span class="eyebrow">Hesabim</span>
                    <div class="summary-list">
                        <div class="summary-line">
                            <span>Kullanilabilir bakiye</span>
                            <strong>{{ number_format($user->wallet_balance, 2, ',', '.') }} TL</strong>
                        </div>
                    </div>
                    <div class="hero-actions">
                        <form method="post" action="{{ route('profile.deactivate') }}">
                            @csrf
                            <button class="btn danger" type="submit">Uyeligimi pasiflestir</button>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
