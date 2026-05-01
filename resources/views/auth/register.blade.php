@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            <x-store.page-hero eyebrow="Uyelik" title="Yeni hesap olusturun." subtitle="Alisverise baslamak icin temel bilgilerinizi girin." compact />

            <form class="card" method="post" action="{{ route('register.store') }}">
                @csrf
                <div class="card-body">
                    <div class="field"><label>Ad soyad</label><input name="name" value="{{ old('name') }}" required></div>
                    <div class="field"><label>E-posta</label><input name="email" type="email" value="{{ old('email') }}" required></div>
                    <div class="field"><label>Telefon</label><input name="phone" value="{{ old('phone') }}"></div>
                    <div class="field"><label>Sifre</label><input name="password" type="password" required></div>
                    <div class="field"><label>Sifre tekrar</label><input name="password_confirmation" type="password" required></div>
                    <button type="submit">Hesap olustur</button>
                </div>
            </form>
        </div>
    </section>
@endsection
