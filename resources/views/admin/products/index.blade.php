@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container admin-shell">
            @include('admin.partials.sidebar')
            <div>
                <div class="section-head">
                    <div class="section-head-main">
                        <span class="eyebrow">Urun yonetimi</span>
                        <h1>Urunleri gorseliyle birlikte yonetin</h1>
                        <p class="section-head-copy">Liste ekranina gorsel kolonu eklendi; boylece yuklenen gorselin gercekten gelip gelmedigi aninda kontrol edilebilir.</p>
                    </div>
                    <a class="btn" href="{{ route('admin.products.create') }}">Yeni urun</a>
                </div>
                <div class="table-shell">
                    <table>
                        <thead><tr><th>Gorsel</th><th>Urun</th><th>Kategori</th><th>Stok</th><th>Fiyat</th><th>Durum</th><th></th></tr></thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><img class="admin-thumb" src="{{ $product->imageUrl() }}" alt="{{ $product->name }}"></td>
                                    <td>{{ $product->name }}<br><span class="muted">{{ $product->sku }}</span></td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ number_format($product->price, 2, ',', '.') }} TL</td>
                                    <td><span class="status-pill {{ $product->is_active ? 'success' : 'warning' }}">{{ $product->is_active ? 'Satista' : 'Pasif' }}</span></td>
                                    <td class="toolbar">
                                        <a class="btn light small" href="{{ route('admin.products.edit', $product) }}">Duzenle</a>
                                        <form method="post" action="{{ route('admin.products.destroy', $product) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn danger small" type="submit">Sil</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
