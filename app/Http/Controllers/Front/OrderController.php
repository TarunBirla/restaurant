<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        return view('front.checkout',
            compact('cart'));
    }

    public function placeOrder()
    {
        $cart = session()->get('cart', []);

        if(empty($cart)){

            return back();
        }

        $total = 0;

        foreach($cart as $item){

            $total += $item['price']
                * $item['quantity'];
        }

        $restaurantId = \App\Models\Product::find(
            array_key_first($cart)
        )->restaurant_id;

        $order = Order::create([

            'user_id' => auth()->id(),

            'restaurant_id' => $restaurantId,

            'total_amount' => $total,

            'status' => 'pending'
        ]);

        foreach($cart as $item){

            OrderItem::create([

                'order_id' => $order->id,

                'product_id' => $item['id'],

                'quantity' => $item['quantity'],

                'price' => $item['price'],

                'total' => $item['price']
                    * $item['quantity']
            ]);
        }

        session()->forget('cart');

        return redirect('/my-orders')
            ->with('success',
            'Order Placed');
    }

    public function myOrders()
    {
        $orders = Order::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        return view('front.orders',
            compact('orders'));
    }
}