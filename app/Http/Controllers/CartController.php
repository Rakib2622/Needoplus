<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Package;

class CartController extends Controller
{
    public function index()
    {
        return view('customer.cart.index');
    }

    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $qty = $request->quantity ?? 1;

        // ===============================
        // 🟢 ADD PRODUCT
        // ===============================
        if ($request->type === 'product') {

            $product = Product::findOrFail($request->product_id);

            $color = $request->color ?? null;

            // 🔑 Unique key (important)
            $key = 'product_' . $product->id . '_' . ($color ?? 'no_color');

            if (isset($cart[$key])) {
                $cart[$key]['quantity'] += $qty;
            } else {
                $cart[$key] = [
                    "type" => "product",
                    "id" => $product->id,
                    "name" => $product->name,
                    "price" => $product->final_price,
                    "image" => $product->image,
                    "quantity" => $qty,
                    "color" => $color
                ];
            }

            $message = 'Product added to cart!';
        }

        // ===============================
        // 🔵 ADD PACKAGE
        // ===============================
        elseif ($request->type === 'package') {

            $package = Package::findOrFail($request->package_id);

            $key = 'package_' . $package->id;

            if (isset($cart[$key])) {
                $cart[$key]['quantity'] += $qty;
            } else {
                $cart[$key] = [
                    "type" => "package",
                    "id" => $package->id,
                    "name" => $package->name,
                    "price" => $package->final_price,
                    "image" => optional($package->products->first())->image,
                    "quantity" => $qty,
                    "color" => null
                ];
            }

            $message = 'Package added to cart!';
        }

        else {
            return back()->with('error', 'Invalid item type');
        }

        session()->put('cart', $cart);

        return back()->with('success', $message);
    }

    // ===============================
    // 🔄 UPDATE QUANTITY
    // ===============================
public function update(Request $request)
{
    $cart = session()->get('cart', []);

    foreach ($request->items as $key => $data) {

        if (isset($cart[$key])) {

            $qty = $data['quantity'];

            if ($qty <= 0) {
                unset($cart[$key]);
                continue;
            }

            $cart[$key]['quantity'] = $qty;

            // update color
            if (isset($data['color'])) {
                $cart[$key]['color'] = $data['color'];
            }
        }
    }

    session()->put('cart', $cart);

    // 🔥 return JSON for AJAX
    return response()->json([
        'success' => true,
        'cart' => $cart
    ]);
}

    // ===============================
    // ❌ REMOVE ITEM
    // ===============================
    public function remove($key)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$key])) {
        unset($cart[$key]);
    }

    session()->put('cart', $cart);

    return response()->json([
        'success' => true
    ]);
}

    public function count()
{
    $cart = session()->get('cart', []);

    // যদি quantity থাকে
    $count = collect($cart)->sum('quantity');

    return response()->json([
        'count' => $count
    ]);
}

public function preview()
{
    $cart = session()->get('cart', []);

    $items = [];
    $total = 0;

    foreach ($cart as $key => $item) {

        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;

        $items[] = [
            'key' => $key,
            'name' => $item['name'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'image' => $item['image'],
            'color' => $item['color'],
            'type' => $item['type'],
            'subtotal' => $subtotal
        ];
    }

    return response()->json([
        'items' => $items,
        'total' => $total
    ]);
}
}