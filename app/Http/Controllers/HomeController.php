<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{


public function index()
{
    // 👉 For NAVBAR (all categories, sorted by popularity)
    $navCategories = Category::has('products')
        ->withCount('products')
        ->orderBy('products_count', 'desc')
        ->get();

    // 👉 For HOME CATEGORY GRID (limit to 6 like design)
    $homeCategories = $navCategories->take(6);

    // 👉 Optional: show some products on homepage (recommended)
    $products = Product::where('is_active', true)
        ->latest()
        ->take(8)
        ->get();

    return view('customer.home', compact(
        'navCategories',
        'homeCategories',
        'products'
    ));
}

public function category($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

    $products = $category->products()
        ->where('is_active', true)
        ->latest()
        ->paginate(9);

    return view('customer.categories.category-products', compact('category', 'products'));
}
}
