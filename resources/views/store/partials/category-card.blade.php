<a class="category-card" href="{{ route('products.index', ['category' => $category->slug]) }}">
    <span class="category-index">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
    <h3>{{ $category->name }}</h3>
    <p>{{ $category->description ?: 'Gunluk kullanim icin secilen urunler.' }}</p>
    <div class="category-meta">
        <span>{{ $category->products_count }} urun</span>
        <span>Incele</span>
    </div>
</a>
