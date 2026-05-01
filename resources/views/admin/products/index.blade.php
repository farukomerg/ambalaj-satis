@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container admin-shell">
            @include('admin.partials.sidebar')
            <div>
                <div class="section-head">
                    <h1>Urun yonetimi</h1>
                    <a class="btn" href="{{ route('admin.products.create') }}">Yeni urun</a>
                </div>
                <table>
                    <thead><tr><th>Urun</th><th>Kategori</th><th>Stok</th><th>Fiyat</th><th>Durum</th><th></th></tr></thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}<br><span class="muted">{{ $product->sku }}</span></td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ number_format($product->price, 2, ',', '.') }} TL</td>
                                <td>{{ $product->is_active ? 'Satista' : 'Pasif' }}</td>
                                <td class="toolbar">
                                    <a class="btn light" href="{{ route('admin.products.edit', $product) }}">Duzenle</a>
                                    <form method="post" action="{{ route('admin.products.destroy', $product) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn danger" type="submit">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
