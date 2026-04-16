<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('customer.orders.index');
    }

    public function show($id)
    {
        return view('customer.orders.show');
    }
}