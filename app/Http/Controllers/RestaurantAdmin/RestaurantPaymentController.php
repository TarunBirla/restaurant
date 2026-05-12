<?php

namespace App\Http\Controllers\RestaurantAdmin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class RestaurantPaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with([
            'order',
            'order.user'
        ])
        ->where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )
        ->latest()
        ->get();

        return view(
            'restaurant.payments.index',
            compact('payments')
        );
    }
}