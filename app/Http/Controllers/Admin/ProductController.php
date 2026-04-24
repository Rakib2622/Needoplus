<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * INDEX - Show all products with category
     */
    public function index()
{
    $products = Product::with('category')
        ->latest()
        ->get()
        ->groupBy('category_id');

    return view('admin.products.index', compact('products'));
}

    /**
     * CREATE - Load form + categories
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * STORE - Validate + upload image + save product
     */
    public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',

        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',

        // NEW
        'colors' => 'nullable|array',
        'colors.*' => 'string',

        'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp',
    ]);

    // SINGLE IMAGE
    $imagePath = null;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('products', $filename, 'public');
        $imagePath = 'products/' . $filename;
    }

    // MULTIPLE IMAGES
    $images = [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('products', $filename, 'public');
            $images[] = 'products/' . $filename;
        }
    }

    // CREATE PRODUCT
    Product::create([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'image' => $imagePath,

        // NEW
        'images' => $images,
        'colors' => $request->colors,

        'is_active' => true,
    ]);

    return redirect()->route('admin.products.index')
        ->with('success', 'Product created successfully');
}

    public function show($id)
{
    $product = Product::with('category')->findOrFail($id);

    return view('admin.products.show', compact('product'));
}
 
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',

        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',

        // NEW
        'colors' => 'nullable|array',
        'colors.*' => 'string',

        'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp',
    ]);

    $imagePath = $product->image;

    // =========================
    // SINGLE IMAGE UPDATE
    // =========================
    if ($request->hasFile('image')) {

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('products', $filename, 'public');

        $imagePath = 'products/' . $filename;
    }

    // =========================
    // MULTIPLE IMAGES UPDATE
    // =========================
    $images = $product->images ?? [];

    if ($request->hasFile('images')) {

        // DELETE OLD IMAGES
        if ($product->images) {
            foreach ($product->images as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }

        $images = [];

        foreach ($request->file('images') as $file) {
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('products', $filename, 'public');
            $images[] = 'products/' . $filename;
        }
    }

    // =========================
    // UPDATE PRODUCT
    // =========================
    $product->update([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'image' => $imagePath,

        // NEW
        'images' => $images,
        'colors' => $request->colors,
    ]);

    return redirect()->route('admin.products.index')
        ->with('success', 'Product updated successfully');
}

    public function destroy(string $id)
{
    $product = Product::findOrFail($id);

    // delete single image
    if ($product->image && Storage::disk('public')->exists($product->image)) {
        Storage::disk('public')->delete($product->image);
    }

    // delete multiple images
    if ($product->images) {
        foreach ($product->images as $img) {
            if (Storage::disk('public')->exists($img)) {
                Storage::disk('public')->delete($img);
            }
        }
    }

    $product->delete();

    return redirect()->route('admin.products.index')
        ->with('success', 'Product deleted successfully');
}
}
