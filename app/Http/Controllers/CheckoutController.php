<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('customer.checkout.index', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
{
    // ✅ VALIDATION
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string',
        'shipping_area' => 'required|in:inside,outside',
        'payment_method' => 'required|in:cod',
    ]);

    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return back()->with('error', 'Cart is empty!');
    }

    // ✅ CALCULATE SUBTOTAL
    $subtotal = 0;

    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    // ✅ SHIPPING LOGIC
    $shipping = $request->shipping_area === 'inside' ? 120 : 80;

    // ✅ FINAL TOTAL
    $total = $subtotal + $shipping;

    // ✅ CREATE ORDER
    $order = Order::create([
        'user_id' => Auth::check() ? Auth::id() : null,

        'name' => $request->name,
        'phone' => $request->phone,
        'address' => $request->address,

        'total_amount' => $total,
        'payment_method' => $request->payment_method,
        'payment_status' => 'pending',
        'status' => 'pending',

        // optional (recommended if column exists)
        'shipping_charge' => $shipping,
    ]);

    // ✅ CREATE ORDER ITEMS
    foreach ($cart as $item) {

        OrderItem::create([
            'order_id' => $order->id,

            // ✅ HANDLE TYPE
            'product_id' => $item['type'] === 'product' ? $item['id'] : null,
            'package_id' => $item['type'] === 'package' ? $item['id'] : null,

            // ✅ SNAPSHOT
            'name' => $item['name'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'subtotal' => $item['price'] * $item['quantity'],

            'color' => $item['color'] ?? null,
        ]);
    }

    // ✅ CLEAR CART
    session()->forget('cart');

    // ✅ REDIRECT
    return redirect()->route('checkout.success', $order->id)
        ->with('success', 'Order placed successfully!');
}

    public function success($id)
    {
        $order = Order::findOrFail($id);

        return view('customer.checkout.success', compact('order'));
    }
}
