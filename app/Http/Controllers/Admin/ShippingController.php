<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends Controller
{
    public function sheet(Shipping $shipping)
    {
        return view('admin.shippings.sheet', compact('shipping'));
    }

    public function control(Shipping $shipping)
    {
        return view('admin.shippings.control', compact('shipping'));
    }
}
