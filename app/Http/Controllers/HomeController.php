<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Discount;
use Carbon\Carbon;

class HomeController extends Controller
{


public function index()
{
    // 👉 Navbar categories
    $navCategories = Category::has('products')
        ->withCount('products')
        ->orderBy('products_count', 'desc')
        ->get();

    $homeCategories = $navCategories->take(6);

    // 👉 PRODUCTS (your existing logic)
    $categoryProducts = Product::where('is_active', true)
        ->select('products.*')
        ->join(DB::raw('(SELECT MIN(id) as id FROM products WHERE is_active = 1 GROUP BY category_id) as grouped'), function ($join) {
            $join->on('products.id', '=', 'grouped.id');
        })
        ->get();

    $remainingProducts = Product::where('is_active', true)
        ->whereNotIn('id', $categoryProducts->pluck('id'))
        ->latest()
        ->take(8 - $categoryProducts->count())
        ->get();

    $products = $categoryProducts->merge($remainingProducts);

    // 🔥 NEW: Get active discount banner
    $discount = Discount::where('is_active', 1)
        ->whereDate('start_date', '<=', Carbon::now())
        ->whereDate('end_date', '>=', Carbon::now())
        ->latest()
        ->first();

    // 🔥 BUILD REDIRECT URL
    $discountUrl = route('products.index'); // default fallback

    if ($discount) {

        if ($discount->type === 'category' && $discount->category_id) {

            $category = Category::find($discount->category_id);

            if ($category) {
                $discountUrl = route('category.show', $category->slug);
            }

        } elseif ($discount->type === 'product' && $discount->product_id) {

            $product = Product::find($discount->product_id);

            if ($product) {
                $discountUrl = route('product.show', $product->slug);
            }

        }
        // global → stays shop page
    }

    return view('customer.home', compact(
        'navCategories',
        'homeCategories',
        'products',
        'discount',
        'discountUrl' // 🔥 pass this
    ));
}

public function category(Request $request, $slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

    $query = $category->products()
        ->where('is_active', true);

    // 🔍 SEARCH
    if ($request->search) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // 🔃 SORT
    if ($request->sort == 'low') {
        $query->orderBy('price', 'asc');
    } elseif ($request->sort == 'high') {
        $query->orderBy('price', 'desc');
    } else {
        $query->latest();
    }

    $products = $query->paginate(9)->withQueryString();

    return view('customer.categories.category-products', compact('category', 'products'));
}
}
