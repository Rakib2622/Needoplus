<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('customer.cart.index');
    }

    public function add()
    {
        return back();
    }

    public function update()
    {
        return back();
    }

    public function remove()
    {
        return back();
    }
}
