<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
public function index(Request $request)
{
    $query = Product::where('is_active', true);

    // 👉 SORTING
    if ($request->sort == 'low') {
        $query->orderBy('price', 'asc');
    } 
    elseif ($request->sort == 'high') {
        $query->orderBy('price', 'desc');
    } 
    elseif ($request->sort == 'discount') {

        $now = now();

        $query->where(function ($q) use ($now) {

            // 🔴 PRODUCT DISCOUNT
            $q->whereExists(function ($sub) use ($now) {
                $sub->select(DB::raw(1))
                    ->from('discounts')
                    ->whereColumn('discounts.product_id', 'products.id')
                    ->where('discounts.type', 'product')
                    ->where('discounts.is_active', true)
                    ->where(function ($q) use ($now) {
                        $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
                    })
                    ->where(function ($q) use ($now) {
                        $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
                    });
            })

            // 🟡 CATEGORY DISCOUNT
            ->orWhereExists(function ($sub) use ($now) {
                $sub->select(DB::raw(1))
                    ->from('discounts')
                    ->whereColumn('discounts.category_id', 'products.category_id')
                    ->where('discounts.type', 'category')
                    ->where('discounts.is_active', true)
                    ->where(function ($q) use ($now) {
                        $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
                    })
                    ->where(function ($q) use ($now) {
                        $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
                    });
            })

            // 🟢 GLOBAL DISCOUNT
            ->orWhereExists(function ($sub) use ($now) {
                $sub->select(DB::raw(1))
                    ->from('discounts')
                    ->where('discounts.type', 'global')
                    ->where('discounts.is_active', true)
                    ->where(function ($q) use ($now) {
                        $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
                    })
                    ->where(function ($q) use ($now) {
                        $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
                    });
            });

        });

        // optional: latest discounted first
        $query->latest();
    } 
    else {
        $query->latest(); // default
    }

    // 👉 PAGINATION (normal, fast)
    $products = $query->paginate(12)->withQueryString();

    return view('customer.products.index', compact('products'));
}

 public function quickView($id)
{
    $product = Product::findOrFail($id);

    return response()->json([
        'id' => $product->id,
        'name' => $product->name,
        'slug' => $product->slug, 
        'price' => $product->price,
        'final_price' => $product->final_price,
        'stock' => $product->stock,
        'description' => $product->description,
        'colors' => $product->colors,
        'image' => $product->image
            ? asset('storage/' . $product->image)
            : null,
    ]);
}




public function show($slug)
{
    // 👉 Get product by slug
    $product = Product::with('category')
        ->where('slug', $slug)
        ->firstOrFail();

    // 👉 Navbar categories (only with products, sorted)
    $navCategories = Category::has('products')
        ->withCount('products')
        ->orderBy('products_count', 'desc')
        ->get();

    // 👉 Related products (same category, exclude current)
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->where('is_active', true)
        ->latest()
        ->take(8)
        ->get();

    return view('customer.products.show', compact(
        'product',
        'navCategories',
        'relatedProducts'
    ));
}
}
