@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container admin-shell">
            @include('admin.partials.sidebar')
            <form class="card" method="post" enctype="multipart/form-data" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}">
                @csrf
                @if($product->exists)
                    @method('PATCH')
                @endif
                <div class="card-body">
                    <h1>{{ $product->exists ? 'Urun duzenle' : 'Yeni urun' }}</h1>
                    <div class="field">
                        <label>Kategori</label>
                        <select name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field"><label>Urun adi</label><input name="name" value="{{ old('name', $product->name) }}" required></div>
                    <div class="field"><label>SKU</label><input name="sku" value="{{ old('sku', $product->sku) }}" required></div>
                    <div class="field"><label>Aciklama</label><textarea name="description" rows="5" required>{{ old('description', $product->description) }}</textarea></div>
                    <div class="grid cards">
                        <div class="field"><label>Fiyat</label><input name="price" type="number" step="0.01" value="{{ old('price', $product->price) }}" required></div>
                        <div class="field"><label>Stok</label><input name="stock" type="number" value="{{ old('stock', $product->stock ?? 0) }}" required></div>
                        <div class="field"><label>Birim</label><input name="unit" value="{{ old('unit', $product->unit ?? 'adet') }}" required></div>
                        <div class="field"><label>Minimum siparis</label><input name="min_order_quantity" type="number" value="{{ old('min_order_quantity', $product->min_order_quantity ?? 1) }}" required></div>
                    </div>
                    <div class="grid cards">
                        <div class="field"><label>Olcu</label><input name="size" value="{{ old('size', $product->size) }}"></div>
                        <div class="field"><label>Malzeme</label><input name="material" value="{{ old('material', $product->material) }}"></div>
                        <div class="field"><label>Renk</label><input name="color" value="{{ old('color', $product->color) }}"></div>
                    </div>
                    <div class="field"><label>Urun gorseli</label><input name="image" type="file" accept="image/*"></div>
                    <label><input style="width: auto" type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))> Satista</label>
                    <label><input style="width: auto" type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured ?? false))> One cikan</label>
                    <button type="submit">Kaydet</button>
                </div>
            </form>
        </div>
    </section>
@endsection
