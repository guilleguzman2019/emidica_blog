<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    
    public function show(Order $order)
    {
        return view('panel.orders.show', compact('order'));
    }

}
