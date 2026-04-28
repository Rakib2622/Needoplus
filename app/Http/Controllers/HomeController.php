<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{


public function index()
{
    // 👉 Navbar categories
    $navCategories = Category::has('products')
        ->withCount('products')
        ->orderBy('products_count', 'desc')
        ->get();

    // 👉 Home category grid
    $homeCategories = $navCategories->take(6);

    // 👉 STEP 1: Get 1 product from each category
    $categoryProducts = Product::where('is_active', true)
        ->select('products.*')
        ->join(DB::raw('(SELECT MIN(id) as id FROM products WHERE is_active = 1 GROUP BY category_id) as grouped'), function ($join) {
            $join->on('products.id', '=', 'grouped.id');
        })
        ->get();

    // 👉 STEP 2: Get additional latest products
    $remainingProducts = Product::where('is_active', true)
        ->whereNotIn('id', $categoryProducts->pluck('id'))
        ->latest()
        ->take(8 - $categoryProducts->count()) // total 8 products
        ->get();

    // 👉 Merge both
    $products = $categoryProducts->merge($remainingProducts);

    return view('customer.home', compact(
        'navCategories',
        'homeCategories',
        'products'
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
