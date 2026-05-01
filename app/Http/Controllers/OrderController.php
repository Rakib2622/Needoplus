<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // 📦 Order List (My Orders)
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items')
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    // 📄 Single Order View
    public function show($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id()) // 🔒 security
            ->with('items')
            ->firstOrFail();

        return view('customer.orders.show', compact('order'));
    }
}