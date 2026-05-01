<article class="card cart-item">
    <a href="{{ route('products.show', $item->product) }}">
        <img class="cart-item-image" src="{{ $item->product->imageUrl() }}" alt="{{ $item->product->name }}">
    </a>

    <div class="cart-item-body">
        <div class="order-top">
            <div>
                <h3><a href="{{ route('products.show', $item->product) }}">{{ $item->product->name }}</a></h3>
                <p class="muted">Birim fiyat: {{ number_format($item->product->price, 2, ',', '.') }} TL</p>
            </div>

            <form method="post" action="{{ route('cart.destroy', $item) }}">
                @csrf
                @method('DELETE')
                <button class="btn ghost small" type="submit">Kaldir</button>
            </form>
        </div>

        <div class="cart-item-footer">
            <form method="post" action="{{ route('cart.update', $item) }}" class="inline-form">
                @csrf
                @method('PATCH')
                <div>
                    <label>Adet</label>
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}">
                </div>
                <button class="btn light small" type="submit">Guncelle</button>
            </form>

            <div>
                <strong>{{ number_format($item->lineTotal(), 2, ',', '.') }} TL</strong>
            </div>
        </div>
    </div>
</article>
