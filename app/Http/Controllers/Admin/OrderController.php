<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * 📦 Show all orders
     */
    public function index()
    {
        $orders = Order::withCount('items')
            ->latest()
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * 📄 Show single order details
     */
    public function show($id)
    {
        $order = Order::with(['items.product', 'items.package', 'user'])
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * 🔄 Update Order Status
     */
    public function updateStatus(Request $request, $id)
    {
        // ✅ Allowed statuses
        $validStatuses = [
            'pending',
            'packaging',   // keeping your spelling (can change later)
            'shipped',
            'delivered',
            'returned',
            'declined',
            'completed',
        ];

        // ✅ Validate
        $request->validate([
            'status' => 'required|in:' . implode(',', $validStatuses),
        ]);

        // ✅ Find order
        $order = Order::findOrFail($id);

        // ✅ Update status
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated successfully!');
    }
}