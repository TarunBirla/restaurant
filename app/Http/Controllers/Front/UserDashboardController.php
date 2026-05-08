<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;

class UserDashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where(
            'user_id',
            auth()->id()
        )->count();

        return view('front.dashboard',
            compact('orders'));
    }
}