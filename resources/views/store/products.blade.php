@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <x-store.page-hero eyebrow="Urunler" title="Ihtiyaciniza uygun urunu hizla secin." subtitle="Filtreler solda, kartlar sade, mobilde akış daha rahat.">
                <x-slot:actions>
                    @if(request()->filled('search') || request()->filled('category'))
                        <a class="btn ghost" href="{{ route('products.index') }}">Temizle</a>
                    @endif
                    <a class="btn secondary" href="{{ route('home') }}#kategoriler">Kategoriler</a>
                </x-slot:actions>
            </x-store.page-hero>

            <div class="listing-shell">
                <aside class="card filter-card">
                    <div class="card-body">
                        <span class="eyebrow">Filtreler</span>
                        <form class="filter-form" method="get">
                            <div class="field">
                                <label>Urun ara</label>
                                <input name="search" value="{{ request('search') }}" placeholder="Ornek: koli, bardak, poset">
                            </div>

                            <div class="field">
                                <label>Kategori</label>
                                <select name="category">
                                    <option value="">Tum kategoriler</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit">Uygula</button>
                        </form>

                        <div class="quick-chips">
                            @foreach($categories as $category)
                                <a class="chip {{ request('category') === $category->slug ? 'active' : '' }}" href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </aside>

                <div>
                    <div class="results-bar">
                        <div>
                            <strong>{{ number_format($products->total(), 0, ',', '.') }} urun</strong>
                            @if(request('search'))
                                <span> "{{ request('search') }}" icin sonuclar</span>
                            @endif
                        </div>

                        @if(request('category'))
                            <span class="pill">{{ $categories->firstWhere('slug', request('category'))?->name }}</span>
                        @endif
                    </div>

                    <div class="product-grid">
                        @forelse($products as $product)
                            @include('store.partials.product-card', ['product' => $product])
                        @empty
                            <div class="empty-state">
                                Bu filtreyle eslesen urun bulunamadi.
                            </div>
                        @endforelse
                    </div>

                    {{ $products->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
