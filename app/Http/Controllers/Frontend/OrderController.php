<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get(); // show latest first
        return view('orders', compact('orders'));
    }
}
