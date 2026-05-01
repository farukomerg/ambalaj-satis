@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            <x-store.page-hero eyebrow="Giris" title="Hesabiniza donun." subtitle="Kisa, sade ve mobil uyumlu giris formu." compact />

            <form class="card" method="post" action="{{ route('login.store') }}">
                @csrf
                <div class="card-body">
                    <div class="field">
                        <label>E-posta</label>
                        <input name="email" type="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="field">
                        <label>Sifre</label>
                        <input name="password" type="password" required>
                    </div>
                    <label class="checkbox-row"><input type="checkbox" name="remember"> Beni hatirla</label>
                    <button type="submit">Giris yap</button>
                </div>
            </form>
        </div>
    </section>
@endsection
