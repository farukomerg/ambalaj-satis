<article class="card product-card">
    <a class="product-media" href="{{ route('products.show', $product) }}">
        <img class="product-img" src="{{ $product->imageUrl() }}" alt="{{ $product->name }}">
        <span class="product-badge pill">{{ $product->category->name }}</span>
    </a>

    <div class="card-body product-body">
        <div class="product-topline">
            <strong>{{ $product->size ?? 'Hazir urun' }}</strong>
            <span>{{ $product->stock }} {{ $product->unit }} stok</span>
        </div>

        <h3><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h3>
        <p class="muted">{{ \Illuminate\Support\Str::limit($product->description, 72) }}</p>

        <div class="product-specs">
            @if($product->size)
                <span>{{ $product->size }}</span>
            @endif
            @if($product->material)
                <span>{{ $product->material }}</span>
            @endif
        </div>

        <div class="product-footer">
            <p class="price">{{ number_format($product->price, 2, ',', '.') }} TL</p>
            <a class="btn ghost small" href="{{ route('products.show', $product) }}">Detay</a>
        </div>
    </div>
</article>
