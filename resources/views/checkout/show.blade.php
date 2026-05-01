@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <x-store.page-hero eyebrow="Odeme" title="Teslimat ve odeme bilgilerini tamamlayin." subtitle="Form alanlari daha sade ve mobilde daha rahat kullanilacak sekilde duzenlendi." compact />

            <div class="checkout-shell">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('checkout.store') }}">
                            @csrf
                            <div class="field"><label>Ad soyad</label><input name="full_name" value="{{ old('full_name', auth()->user()->name) }}" required></div>
                            <div class="field"><label>Telefon</label><input name="phone" value="{{ old('phone', auth()->user()->phone) }}" required></div>
                            <div class="field"><label>Sehir</label><input name="city" value="{{ old('city', 'Kocaeli') }}" required></div>
                            <div class="field"><label>Ilce</label><input name="district" value="{{ old('district') }}" required></div>
                            <div class="field"><label>Adres</label><textarea name="address_line" rows="4" required>{{ old('address_line', auth()->user()->address) }}</textarea></div>
                            <div class="field"><label>Posta kodu</label><input name="postal_code" value="{{ old('postal_code') }}"></div>
                            <hr>
                            <div class="field"><label>Kart uzerindeki isim</label><input name="card_holder" required></div>
                            <div class="field"><label>Kart numarasi</label><input name="card_number" placeholder="Simule odeme" required></div>
                            <button type="submit">Siparisi tamamla</button>
                        </form>
                    </div>
                </div>

                <aside class="summary-card">
                    <span class="eyebrow">Ozet</span>
                    <div class="summary-list">
                        @foreach($items as $item)
                            <div class="summary-line">
                                <span>{{ $item->quantity }} x {{ $item->product->name }}</span>
                                <strong>{{ number_format($item->lineTotal(), 2, ',', '.') }} TL</strong>
                            </div>
                        @endforeach
                        <hr>
                        <div class="summary-line">
                            <span>Ara toplam</span>
                            <strong>{{ number_format($subtotal, 2, ',', '.') }} TL</strong>
                        </div>
                        <div class="summary-line">
                            <span>Hesap bakiyesi</span>
                            <strong>{{ number_format(auth()->user()->wallet_balance, 2, ',', '.') }} TL</strong>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
