<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.orders.index',
            compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product','user','restaurant')
            ->findOrFail($id);

        return view('admin.orders.show',
            compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update([

            'status' => $request->status
        ]);

        return back()->with(
            'success',
            'Order Status Updated'
        );
    }
}