<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('products')
            ->where('is_active', true)
            ->latest()
            ->paginate(8);

        return view('customer.packages.index', compact('packages'));
    }

    public function show($id)
    {
        $package = Package::with('products')->findOrFail($id);

        return view('customer.packages.show', compact('package'));
    }
}