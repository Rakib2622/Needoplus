<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('customer.cart.index');
    }

    public function add(Request $request)
{
    $product = Product::findOrFail($request->product_id);

    $cart = session()->get('cart', []);

    $qty = $request->quantity ?? 1;

    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity'] += $qty;
    } else {
        $cart[$product->id] = [
            "name" => $product->name,
            "price" => $product->final_price,
            "image" => $product->image,
            "quantity" => $qty
        ];
    }

    session()->put('cart', $cart);

    return back()->with('success', 'Product added to cart!');
}

    public function update()
    {
        return back();
    }

    public function remove()
    {
        return back();
    }
}
