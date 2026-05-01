<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    public function home()
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->withCount(['products' => fn ($query) => $query->where('is_active', true)])
            ->orderByDesc('products_count')
            ->orderBy('name')
            ->get();

        return view('store.home', [
            'categories' => $categories,
            'featuredProducts' => Product::with(['category', 'primaryImage'])
                ->where('is_active', true)
                ->where('is_featured', true)
                ->latest()
                ->take(8)
                ->get(),
            'latestProducts' => Product::with(['category', 'primaryImage'])
                ->where('is_active', true)
                ->latest()
                ->take(4)
                ->get(),
            'metrics' => [
                ['value' => number_format(Product::where('is_active', true)->count(), 0, ',', '.'), 'label' => 'Urun'],
                ['value' => number_format($categories->count(), 0, ',', '.'), 'label' => 'Kategori'],
                ['value' => number_format((int) Product::where('is_active', true)->sum('stock'), 0, ',', '.'), 'label' => 'Stok'],
            ],
        ]);
    }

    public function products(Request $request)
    {
        $search = trim((string) $request->input('search'));

        $products = Product::query()
            ->with(['category', 'primaryImage'])
            ->where('is_active', true)
            ->when($request->filled('category'), fn ($query) => $query->whereHas('category', fn ($q) => $q->where('slug', $request->category)))
            ->when($search !== '', fn ($query) => $query->whereRaw('LOWER(name) LIKE ?', ['%'.mb_strtolower($search, 'UTF-8').'%']))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('store.products', [
            'products' => $products,
            'categories' => Category::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);

        return view('store.show', [
            'product' => $product->load(['category', 'images']),
            'relatedProducts' => Product::with('primaryImage')
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->where('is_active', true)
                ->take(4)
                ->get(),
        ]);
    }
}
