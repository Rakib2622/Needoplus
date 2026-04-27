<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index(Request $request)
{
    $product = null;

    if ($request->product_id) {
        $product = Product::find($request->product_id);
    }

    return view('customer.checkout.index', compact('product'));
}

    public function placeOrder()
    {
        return back();
    }
}
