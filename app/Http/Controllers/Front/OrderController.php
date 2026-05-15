<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Services\StuartService;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        return view(
            'front.checkout',
            compact('cart')
        );
    }

    public function placeOrder(Request $request)
    {
        Log::info('PLACE ORDER START');
        $request->validate([

            'order_type' => 'required',

            'payment_method' => 'required',


            'phone' => 'required_if:payment_method,Cash On Delivery',

            'address' => 'required_if:order_type,delivery|required_if:payment_method,Cash On Delivery',

            'pincode' => 'required_if:order_type,delivery|required_if:payment_method,Cash On Delivery',

        ]);
        Log::info('VALIDATION SUCCESS');
        $cart = session()->get('cart', []);

        if (empty($cart)) {

            return back();
        }

        $total = 0;

        foreach ($cart as $item) {

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

            'order_type' => $request->order_type,
            'phone' => $request->phone,

            'address' => $request->address,

            'pincode' => $request->pincode,

            'payment_method' => $request->payment_method,

            'status' => 'pending'
        ]);
        Log::info('ORDER CREATED', [
            'order_id' => $order->id
        ]);

        foreach ($cart as $item) {

            OrderItem::create([

                'order_id' => $order->id,

                'product_id' => $item['id'],

                'quantity' => $item['quantity'],

                'price' => $item['price'],

                'total' => $item['price']
                    * $item['quantity']
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PAYMENT ENTRY
        |--------------------------------------------------------------------------
        */

        Payment::create([

            'order_id' => $order->id,

            'restaurant_id' => $restaurantId,

            'user_id' => auth()->id(),

            'payment_method' => $request->payment_method,

            'amount' => $total,

            'payment_status' =>
                $request->payment_method == 'Cash On Delivery'
                ? 'pending'
                : 'paid'
        ]);
        Log::info('PAYMENT CREATED');
        /*
|--------------------------------------------------------------------------
| STUART DELIVERY
|--------------------------------------------------------------------------
*/
        Log::info('STUART DELIVERY START');
        if ($request->order_type == 'delivery') {

            $restaurant = Restaurant::find(
                $restaurantId
            );

            $stuart = new StuartService();

            $order->load('user');

            $delivery = $stuart->createDelivery(
                $order,
                $restaurant
            );

            Log::info('DELIVERY RESPONSE', [
                'delivery' => $delivery
            ]);

            if ($delivery) {

                $order->update([

                    'stuart_job_id' =>
                        $delivery['id'] ?? null,

                    'tracking_url' =>
                        $delivery['deliveries'][0]['tracking_url']
                        ?? null,

                    'delivery_status' =>
                        $delivery['status']
                        ?? 'searching',
                ]);
            }
        }



        session()->forget('cart');

        return redirect('/my-orders')
            ->with(
                'success',
                'Order Placed Successfully'
            );
    }



    public function driverwebhook(Request $request)
    {
        Log::info('STUART WEBHOOK', $request->all());

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $data = $request->data;

        if (!$data) {

            return response()->json([
                'success' => false,
                'message' => 'No data found'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CLIENT REFERENCE
        |--------------------------------------------------------------------------
        */

        $clientReference =
            $data['clientReference'] ?? null;

        if (!$clientReference) {

            return response()->json([
                'success' => false,
                'message' => 'No client reference'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ORDER ID
        |--------------------------------------------------------------------------
        */

        $orderId = str_replace(
            'ORDER-',
            '',
            $clientReference
        );

        $order = Order::find($orderId);

        if (!$order) {

            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | DRIVER
        |--------------------------------------------------------------------------
        */

        $driver =
            $data['driver'] ?? [];

        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        $status =
            $data['status'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | UPDATE ORDER
        |--------------------------------------------------------------------------
        */

        $order->update([

            /*
            |--------------------------------------------------------------------------
            | DELIVERY STATUS
            |--------------------------------------------------------------------------
            */

            'delivery_status' => $status,

            /*
            |--------------------------------------------------------------------------
            | TRACKING URL
            |--------------------------------------------------------------------------
            */

            'tracking_url' =>
                $data['trackingUrl']
                ?? $order->tracking_url,

            /*
            |--------------------------------------------------------------------------
            | DRIVER DETAILS
            |--------------------------------------------------------------------------
            */

            'driver_name' =>
                $driver['name']
                ?? $order->driver_name,

            'driver_phone' =>
                $driver['phone']
                ?? $order->driver_phone,

            'driver_id' =>
                $driver['id']
                ?? $order->driver_id,

            /*
            |--------------------------------------------------------------------------
            | PICKED
            |--------------------------------------------------------------------------
            */

            'picked_at' =>

                in_array($status, [
                    'picking',
                    'in_transit'
                ])
                ? now()
                : $order->picked_at,

            /*
            |--------------------------------------------------------------------------
            | DELIVERED
            |--------------------------------------------------------------------------
            */

            'delivered_at' =>

                $status == 'delivered'
                ? now()
                : $order->delivered_at,
        ]);

        /*
        |--------------------------------------------------------------------------
        | LOGS
        |--------------------------------------------------------------------------
        */

        Log::info('ORDER UPDATED', [

            'order_id' => $order->id,

            'status' => $status,

            'driver_name' =>
                $driver['name'] ?? null,
        ]);

        return response()->json([
            'success' => true
        ]);
    }





    public function myOrders()
    {
        $orders = Order::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        return view(
            'front.orders',
            compact('orders')
        );
    }

    public function orderDetails($id)
    {
        $order = Order::with([

            'items.product',
            'payment',
            'restaurant'

        ])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view(
            'front.order-details',
            compact('order')
        );
    }

    public function transactions()
    {
        $payments = Payment::with([

            'restaurant',
            'order'

        ])
            ->where(
                'user_id',
                auth()->id()
            )
            ->latest()
            ->get();

        return view(
            'front.transactions',
            compact('payments')
        );
    }
}