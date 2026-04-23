<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('customer.settings.index');
    }

    public function account()
{
    return view('customer.settings.account', [
        'user' => auth()->user()
    ]);
}

    public function privacy()
    {
        return view('customer.settings.privacy');
    }

    public function return()
    {
        return view('customer.settings.return');
    }

    public function refund()
    {
        return view('customer.settings.refund');
    }

    public function warranty()
    {
        return view('customer.settings.warranty');
    }

    public function help()
    {
        return view('customer.settings.help');
    }

    public function report()
    {
        return view('customer.settings.report');
    }
}
