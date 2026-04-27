<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        return view('customer.products.index');
    }

    



public function show($id)
{
    $product = Product::with('category')->findOrFail($id);

    // for navbar categories
    $navCategories = Category::withCount('products')->get();

    // related products (same category)
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(8)
        ->get();

    return view('customer.products.show', compact(
        'product',
        'navCategories',
        'relatedProducts'
    ));
}
}
