<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Review;
use App\Services\StuartService;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Log;
use App\Services\FirebaseNotificationService;

use App\Models\User;


class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {

            return redirect('/cart')
                ->with(
                    'error',
                    'Your cart is empty'
                );
        }


        $restaurantId = Product::find(
            array_key_first($cart)
        )->restaurant_id;

        $restaurant = Restaurant::find(
            $restaurantId
        );



        $cartProductIds = collect($cart)
            ->pluck('id')
            ->toArray();



        $originalTotal = 0;

        $discount = 0;

        $finalTotal = 0;



        foreach ($cart as $item) {

            $originalTotal +=
                $item['price']
                * $item['quantity'];
        }


        $offers = \App\Models\Offer::with('products')

            ->where('is_active', 1)

            ->where(function ($q) {

                $q->whereNull('start_date')
                    ->orWhereDate(
                        'start_date',
                        '<=',
                        now()
                    );

            })

            ->where(function ($q) {

                $q->whereNull('end_date')
                    ->orWhereDate(
                        'end_date',
                        '>=',
                        now()
                    );

            })

            ->get();

        /*
        |--------------------------------------------------------------------------
        | APPLY OFFER ONLY IF
        | ALL PRODUCTS MATCH
        |--------------------------------------------------------------------------
        */

        foreach ($offers as $offer) {

            $offerProductIds =
                $offer->products
                    ->pluck('id')
                    ->toArray();



            $allMatched = !array_diff(

                $offerProductIds,

                $cartProductIds
            );


            if ($allMatched) {


                $offerProductsTotal = 0;

                foreach ($cart as $item) {

                    if (
                        in_array(
                            $item['id'],
                            $offerProductIds
                        )
                    ) {

                        $offerProductsTotal +=
                            $item['price']
                            * $item['quantity'];


                        $cartItemOffer[
                            $item['id']
                        ] = $offer;
                    }
                }



                if (
                    $offer->value_type
                    == 'percent'
                ) {

                    $discount +=
                        (
                            $offerProductsTotal
                            * $offer->value
                        ) / 100;
                } else {

                    $discount +=
                        $offer->value;
                }
            }
        }



        $finalTotal =
            max(
                $originalTotal - $discount,
                0
            );


        foreach ($cart as $key => $item) {

            $cart[$key]['offer'] =
                $cartItemOffer[$item['id']]
                ?? null;

            $cart[$key]['final_price'] =
                $item['price'];

            $cart[$key]['subtotal'] =
                $item['price']
                * $item['quantity'];
        }



        return view(

            'front.checkout',

            compact(

                'cart',
                'restaurant',
                'originalTotal',
                'discount',
                'finalTotal'
            )
        );
    }

  


    public function placeOrder(Request $request)
    {
        Log::info('PLACE ORDER START');

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'order_type' =>
                'required',

            'payment_method' =>
                'required',

            'phone' =>
                'required_if:payment_method,Cash On Delivery',

            'address' =>
                'required_if:order_type,delivery|required_if:payment_method,Cash On Delivery',

            'pincode' =>
                'required_if:order_type,delivery|required_if:payment_method,Cash On Delivery',

        ]);

        Log::info('VALIDATION SUCCESS');

        /*
        |--------------------------------------------------------------------------
        | CART
        |--------------------------------------------------------------------------
        */

        $cart = session()->get('cart', []);

        if (empty($cart)) {

            return back();
        }

        /*
        |--------------------------------------------------------------------------
        | RESTAURANT
        |--------------------------------------------------------------------------
        */

        $restaurantId = Product::find(
            array_key_first($cart)
        )->restaurant_id;

        /*
        |--------------------------------------------------------------------------
        | CART PRODUCT IDS
        |--------------------------------------------------------------------------
        */

        $cartProductIds = collect($cart)
            ->pluck('id')
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | TOTALS
        |--------------------------------------------------------------------------
        */

        $originalTotal = 0;

        $discount = 0;

        /*
        |--------------------------------------------------------------------------
        | ORIGINAL TOTAL
        |--------------------------------------------------------------------------
        */

        foreach ($cart as $item) {

            $originalTotal +=
                $item['price']
                * $item['quantity'];
        }

        /*
        |--------------------------------------------------------------------------
        | ACTIVE OFFERS
        |--------------------------------------------------------------------------
        */

        $offers = \App\Models\Offer::with('products')

            ->where('is_active', 1)

            ->where(function ($q) {

                $q->whereNull('start_date')

                    ->orWhereDate(
                        'start_date',
                        '<=',
                        now()
                    );

            })

            ->where(function ($q) {

                $q->whereNull('end_date')

                    ->orWhereDate(
                        'end_date',
                        '>=',
                        now()
                    );

            })

            ->get();

        /*
        |--------------------------------------------------------------------------
        | APPLY COMBO OFFERS
        |--------------------------------------------------------------------------
        */

        foreach ($offers as $offer) {

            $offerProductIds =
                $offer->products
                    ->pluck('id')
                    ->toArray();

            /*
            |--------------------------------------------------------------------------
            | FULL COMBO MATCH
            |--------------------------------------------------------------------------
            */

            $allMatched = !array_diff(

                $offerProductIds,

                $cartProductIds
            );

            /*
            |--------------------------------------------------------------------------
            | APPLY OFFER
            |--------------------------------------------------------------------------
            */

            if ($allMatched) {

                foreach ($cart as $item) {

                    /*
                    |--------------------------------------------------------------------------
                    | ONLY OFFER PRODUCTS
                    |--------------------------------------------------------------------------
                    */

                    if (
                        in_array(
                            $item['id'],
                            $offerProductIds
                        )
                    ) {

                        /*
                        |--------------------------------------------------------------------------
                        | PERCENT
                        |--------------------------------------------------------------------------
                        */

                        if (
                            $offer->value_type
                            == 'percent'
                        ) {

                            $discount +=
                                (
                                    (
                                        $item['price']
                                        * $offer->value
                                    ) / 100
                                )
                                * $item['quantity'];
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | FLAT
                        |--------------------------------------------------------------------------
                        */ else {

                            $discount +=
                                $offer->value
                                * $item['quantity'];
                        }
                    }
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | FINAL TOTAL
        |--------------------------------------------------------------------------
        */

        $finalTotal = max(

            $originalTotal - $discount,

            0
        );

        /*
        |--------------------------------------------------------------------------
        | CREATE ORDER
        |--------------------------------------------------------------------------
        */

        $order = Order::create([

            'user_id' =>
                auth()->id(),

            'restaurant_id' =>
                $restaurantId,

            'total_amount' =>
                $finalTotal,

            'order_type' =>
                $request->order_type,

            'phone' =>
                $request->phone,

            'address' =>
                $request->address,

            'pincode' =>
                $request->pincode,

            'payment_method' =>
                $request->payment_method,

            'status' =>
                'pending'
        ]);

        Log::info('ORDER CREATED', [

            'order_id' =>
                $order->id
        ]);

        /*
        |--------------------------------------------------------------------------
        | ORDER ITEMS
        |--------------------------------------------------------------------------
        */

        foreach ($cart as $item) {

            /*
            |--------------------------------------------------------------------------
            | DEFAULT PRICE
            |--------------------------------------------------------------------------
            */

            $finalPrice =
                $item['price'];

            /*
            |--------------------------------------------------------------------------
            | FIND OFFER
            |--------------------------------------------------------------------------
            */

            foreach ($offers as $offer) {

                $offerProductIds =
                    $offer->products
                        ->pluck('id')
                        ->toArray();

                $allMatched = !array_diff(

                    $offerProductIds,

                    $cartProductIds
                );

                /*
                |--------------------------------------------------------------------------
                | OFFER PRODUCT
                |--------------------------------------------------------------------------
                */

                if (

                    $allMatched

                    &&

                    in_array(
                        $item['id'],
                        $offerProductIds
                    )

                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | PERCENT
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $offer->value_type
                        == 'percent'
                    ) {

                        $discountAmount =
                            (
                                $item['price']
                                * $offer->value
                            ) / 100;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | FLAT
                    |--------------------------------------------------------------------------
                    */ else {

                        $discountAmount =
                            $offer->value;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | FINAL PRICE
                    |--------------------------------------------------------------------------
                    */

                    $finalPrice = max(

                        $item['price']
                        - $discountAmount,

                        0
                    );

                    break;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | SAVE ORDER ITEM
            |--------------------------------------------------------------------------
            */

            OrderItem::create([

                'order_id' =>
                    $order->id,

                'product_id' =>
                    $item['id'],

                'quantity' =>
                    $item['quantity'],

                'price' =>
                    $finalPrice,

                'total' =>
                    $finalPrice
                    * $item['quantity']
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PAYMENT ENTRY
        |--------------------------------------------------------------------------
        */

        Payment::create([

            'order_id' =>
                $order->id,

            'restaurant_id' =>
                $restaurantId,

            'user_id' =>
                auth()->id(),

            'payment_method' =>
                $request->payment_method,

            'amount' =>
                $finalTotal,

            'payment_status' =>

                $request->payment_method
                == 'Cash On Delivery'

                ? 'pending'

                : 'paid'
        ]);

        $restaurantAdmin = User::where(

            'restaurant_id',
            $order->restaurant_id

        )
            ->where(
                'role',
                'restaurant_admin'
            )
            ->first();

        \Log::info('RESTAURANT ADMIN FOUND', [

            'restaurant_id' => $order->restaurant_id,
            'restaurant_admin' => $restaurantAdmin
        ]);

        if (

            $restaurantAdmin

            &&

            $restaurantAdmin->fcm_token

        ) {

            $firebase =
                new FirebaseNotificationService();

            $firebase->send(

                $restaurantAdmin->fcm_token,

                'New Order',

                'You received a new order.'

            );
        }

        Log::info('PAYMENT CREATED');

        /*
        |--------------------------------------------------------------------------
        | STUART DELIVERY
        |--------------------------------------------------------------------------
        */

        Log::info('STUART DELIVERY START');

        if (
            $request->order_type
            == 'delivery'
        ) {

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

                'delivery' =>
                    $delivery
            ]);

            if ($delivery) {

                $order->update([

                    'stuart_job_id' =>

                        $delivery['id']
                        ?? null,

                    'tracking_url' =>

                        $delivery['deliveries'][0]['tracking_url']
                        ?? null,

                    'delivery_status' =>

                        $delivery['status']
                        ?? 'searching',
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CLEAR CART
        |--------------------------------------------------------------------------
        */

        session()->forget('cart');

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

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
            'restaurant',
            'review'

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

    public function submitReview(Request $request, $id)
{
    $request->validate([

        'rating' => 'required|integer|min:1|max:5',

        'review' => 'nullable|string|max:1000'

    ]);

    $order = Order::where(

        'user_id',
        auth()->id()

    )
    ->where('id', $id)
    ->firstOrFail();

    /*
    |--------------------------------------------------------------------------
    | ONLY DELIVERED ORDER
    |--------------------------------------------------------------------------
    */

    if ($order->delivery_status != 'delivered') {

        return back()->with(

            'error',
            'Review allowed only after delivery.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PREVENT DUPLICATE
    |--------------------------------------------------------------------------
    */

    $already = Review::where(

        'order_id',
        $order->id

    )->exists();

    if ($already) {

        return back()->with(

            'error',
            'Review already submitted.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SAVE REVIEW
    |--------------------------------------------------------------------------
    */

    Review::create([

        'user_id' => auth()->id(),

        'restaurant_id' => $order->restaurant_id,

        'order_id' => $order->id,

        'rating' => $request->rating,

        'review' => $request->review,
         'status' => 'pending'

    ]);

    return back()->with(

        'success',
        'Review submitted successfully.'
    );
}
}