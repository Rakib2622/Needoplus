<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DiscountController extends Controller
{
    public function index()
{
    $discounts = Discount::with(['category', 'product'])
        ->latest()
        ->get();

    return view('admin.discounts.index', compact('discounts'));
}

    public function create()
    {
        $categories = Category::all();
        $products = Product::all();

        return view('admin.discounts.create', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:global,category,product',
            'category_id' => 'nullable|exists:categories,id',
            'product_id' => 'nullable|exists:products,id',
            'discount_type' => 'required|in:flat,percent',
            'value' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // IMAGE UPLOAD (same as your product logic)
        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('discounts', $filename, 'public');

            $imagePath = 'discounts/' . $filename;
        }

        Discount::create([
            'name' => $request->name,
            'type' => $request->type,
            'category_id' => $request->category_id,
            'product_id' => $request->product_id,
            'discount_type' => $request->discount_type,
            'value' => $request->value,
            'image' => $imagePath,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => true,
        ]);

        return redirect()->route('admin.discounts.index')
            ->with('success', 'Discount created successfully');
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        $categories = Category::all();
        $products = Product::all();

        return view('admin.discounts.edit', compact('discount', 'categories', 'products'));
    }

    public function update(Request $request, $id)
    {
        $discount = Discount::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'type' => 'required|in:global,category,product',
            'category_id' => 'nullable|exists:categories,id',
            'product_id' => 'nullable|exists:products,id',
            'discount_type' => 'required|in:flat,percent',
            'value' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $discount->image;

        // UPDATE IMAGE
        if ($request->hasFile('image')) {

            // delete old image
            if ($discount->image && Storage::disk('public')->exists($discount->image)) {
                Storage::disk('public')->delete($discount->image);
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('discounts', $filename, 'public');

            $imagePath = 'discounts/' . $filename;
        }

        $discount->update([
            'name' => $request->name,
            'type' => $request->type,
            'category_id' => $request->category_id,
            'product_id' => $request->product_id,
            'discount_type' => $request->discount_type,
            'value' => $request->value,
            'image' => $imagePath,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('admin.discounts.index')
            ->with('success', 'Discount updated successfully');
    }

    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);

        // delete image
        if ($discount->image && Storage::disk('public')->exists($discount->image)) {
            Storage::disk('public')->delete($discount->image);
        }

        $discount->delete();

        return redirect()->back()->with('success', 'Discount deleted successfully');
    }
}