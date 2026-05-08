<?php

namespace App\Http\Controllers\RestaurantAdmin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )->latest()->get();

        return view('restaurant.orders.index',
            compact('orders'));
    }
}