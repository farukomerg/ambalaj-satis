<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::with('category')->latest()->paginate(12),
        ]);
    }

    public function create()
    {
        return view('admin.products.form', [
            'product' => new Product(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $product = Product::create($this->validatedData($request));
        $this->storeImage($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Urun eklendi.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', [
            'product' => $product->load('primaryImage'),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($this->validatedData($request, $product));
        $this->storeImage($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Urun guncellendi.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Urun silindi.');
    }

    private function validatedData(Request $request, ?Product $product = null): array
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:80', 'unique:products,sku,'.($product?->id ?? 'NULL')],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'unit' => ['required', 'string', 'max:40'],
            'size' => ['nullable', 'string', 'max:120'],
            'material' => ['nullable', 'string', 'max:120'],
            'color' => ['nullable', 'string', 'max:120'],
            'min_order_quantity' => ['required', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['slug'] = Str::slug($data['name']).'-'.Str::lower(Str::random(5));
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        return $data;
    }

    private function storeImage(Request $request, Product $product): void
    {
        if (! $request->hasFile('image')) {
            return;
        }

        $path = $request->file('image')->store('products', 'public');

        $product->images()->update(['is_primary' => false]);
        $product->images()->create([
            'path' => $path,
            'alt_text' => $product->name,
            'is_primary' => true,
        ]);
    }
}
