<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminPackageController extends Controller
{
    // 📦 LIST
    public function index()
    {
        $packages = Package::with('products')
            ->latest()
            ->paginate(10);

        return view('admin.packages.index', compact('packages'));
    }

    // ➕ CREATE PAGE
    public function create()
    {
        $products = Product::where('is_active', true)->get();

        return view('admin.packages.create', compact('products'));
    }

    // 💾 STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'discount_type' => 'nullable|in:percent,flat',
            'value' => 'nullable|numeric|min:0',
        ]);

        $package = Package::create([
            'name' => $request->name,
            'discount_type' => $request->discount_type,
            'value' => $request->value,
            'is_active' => $request->is_active ?? 1,
        ]);

        // attach products
        $syncData = [];

        if ($request->has('products')) {
            foreach ($request->products as $productId => $qty) {
                if ($qty > 0) {
                    $syncData[$productId] = ['quantity' => $qty];
                }
            }
        }

        $package->products()->sync($syncData);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Package created successfully');
    }

    // 👁 SHOW PAGE (NEW)
    public function show(Package $package)
    {
        $package->load('products');

        return view('admin.packages.show', compact('package'));
    }

    // ✏ EDIT
    public function edit(Package $package)
    {
        $products = Product::where('is_active', true)->get();

        $package->load('products');

        return view('admin.packages.edit', compact('package', 'products'));
    }

    // 🔄 UPDATE
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'discount_type' => 'nullable|in:percent,flat',
            'value' => 'nullable|numeric|min:0',
        ]);

        $package->update([
            'name' => $request->name,
            'discount_type' => $request->discount_type,
            'value' => $request->value,
            'is_active' => $request->is_active ?? 1,
        ]);

        $syncData = [];

        if ($request->has('products')) {
            foreach ($request->products as $productId => $qty) {
                if ($qty > 0) {
                    $syncData[$productId] = ['quantity' => $qty];
                }
            }
        }

        $package->products()->sync($syncData);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Package updated successfully');
    }

    // ❌ DELETE
    public function destroy(Package $package)
    {
        $package->delete();

        return back()->with('success', 'Package deleted');
    }
}