<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('customer.categories.index');
    }

    public function show($id)
    {
        return view('customer.categories.show');
    }
}