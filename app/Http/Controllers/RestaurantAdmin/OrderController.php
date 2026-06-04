<?php

namespace App\Http\Controllers\RestaurantAdmin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Services\FirebaseNotificationService;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ORDER LIST
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $orders = Order::where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )
            ->whereDate(
                'created_at',
                today()
            )
            ->latest()
            ->get();

        return view(
            'restaurant.orders.index',
            compact('orders')
        );
    }

    public function allOrders()
    {
        $orders = Order::where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )
            ->latest()
            ->get();

        return view(
            'restaurant.orders.create',
            compact('orders')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ORDER DETAILS
    |--------------------------------------------------------------------------
    */

    // public function show($id)
    // {
    //     $order = Order::where(
    //         'restaurant_id',
    //         auth()->user()->restaurant_id
    //     )
    //         ->with([
    //             'user',
    //             'items.product',
    //             'payment'
    //         ])
    //         ->findOrFail($id);

    //     return view(
    //         'restaurant.orders.show',
    //         compact('order')
    //     );
    // }

    public function show($id)
    {
        $order = Order::where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )
        ->with([
            'user',
            'restaurant',
            'items.product',
            'payment',
            'review'
        ])
        ->findOrFail($id);

        return view(
            'restaurant.orders.show',
            compact('order')
        );
    }

    public function sendMessage(Request $request, $id)
    {
        $request->validate([

            'message' => 'required'

        ]);

        $order = Order::findOrFail($id);

        Message::create([

            'sender_id' => auth()->id(),

            'receiver_id' => $order->user_id,

            'order_id' => $order->id,

            'message' => $request->message,

            'is_read' => 0

        ]);

        return back()->with(
            'success',
            'Message Sent Successfully'
        );
    }
    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS
    |--------------------------------------------------------------------------
    */

    // public function updateStatus(Request $request, $id)
    // {
    //     $order = Order::where(
    //         'restaurant_id',
    //         auth()->user()->restaurant_id
    //     )
    //     ->findOrFail($id);

    //     $order->update([

    //         'status' => $request->status

    //     ]);

    //     return back()->with(
    //         'success',
    //         'Order Status Updated'
    //     );
    // }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | UPDATE ORDER STATUS
        |--------------------------------------------------------------------------
        */



        $order->update([

            'status' => $request->status

        ]);

        if (

            $order->user

            &&

            $order->user->fcm_token

        ) {

            \Log::info('SEND ORDER STATUS TO USER');

            $firebase =
                new FirebaseNotificationService();

            $firebase->send(

                $order->user->fcm_token,

                'Order Updated',

                'Order #'
                . $order->id
                . ' is now '
                . strtoupper(
                    $request->status
                )

            );

        }
        /*
        |--------------------------------------------------------------------------
        | PAYMENT STATUS AUTO UPDATE
        |--------------------------------------------------------------------------
        */

        if ($request->status == 'completed') {

            Payment::where(
                'order_id',
                $order->id
            )->update([

                        'payment_status' => 'paid'

                    ]);

        }

        /*
        |--------------------------------------------------------------------------
        | CANCELLED ORDER
        |--------------------------------------------------------------------------
        */

        if ($request->status == 'cancelled') {

            Payment::where(
                'order_id',
                $order->id
            )->update([

                        'payment_status' => 'paid'

                    ]);

        }

        return back()->with(
            'success',
            'Order Status Updated Successfully'
        );
    }

    public function updatePaymentStatus(
        Request $request,
        $id
    ) {
        $order = Order::where(

            'restaurant_id',
            auth()->user()->restaurant_id

        )->findOrFail($id);

        Payment::where(

            'order_id',
            $order->id

        )->update([

                    'payment_status' =>
                        $request->payment_status

                ]);

        

        return back()->with(

            'success',

            'Payment Status Updated Successfully'

        );
    }

    public function refundPayment($id)
    {
        $order = Order::where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )->with('payment')->findOrFail($id);

        if ($order->status !== 'cancelled') {

            return back()->with(
                'error',
                'Only cancelled orders can be refunded.'
            );
        }

        if (!$order->payment) {

            return back()->with(
                'error',
                'Payment record not found.'
            );
        }

        if ($order->payment->payment_status !== 'paid') {

            return back()->with(
                'error',
                'Only paid orders can be refunded.'
            );
        }

        $order->payment->update([
            'payment_status' => 'refunded'
        ]);

        return back()->with(
            'success',
            'Payment Refunded Successfully.'
        );
    }

  
    // public function refundPayment($id)
    // {
    //     $order = Order::where(
    //         'restaurant_id',
    //         auth()->user()->restaurant_id
    //     )
    //     ->with([
    //         'payment',
    //         'restaurant'
    //     ])
    //     ->findOrFail($id);

    //     if ($order->status !== 'cancelled') {

    //         return back()->with(
    //             'error',
    //             'Only cancelled orders can be refunded.'
    //         );
    //     }

    //     if (!$order->payment) {

    //         return back()->with(
    //             'error',
    //             'Payment record not found.'
    //         );
    //     }

    //     if ($order->payment->payment_status !== 'paid') {

    //         return back()->with(
    //             'error',
    //             'Only paid payments can be refunded.'
    //         );
    //     }

    //     $restaurant = $order->restaurant;

    //     $memberId =
    //         $restaurant->transactworld_member_id;

    //     $secureKey =
    //         $restaurant->transactworld_checksum_key;

    //     $paymentId =
    //         $order->payment->payment_id;

    //     $amount = number_format(
    //         $order->payment->amount,
    //         2,
    //         '.',
    //         ''
    //     );

    //     $checksum = md5(
    //         $memberId .
    //         '|' .
    //         $secureKey .
    //         '|' .
    //         $paymentId .
    //         '|' .
    //         $amount
    //     );

    //     $endpoint =
    //         'https://preprod.transactworld.com/transactionServices/REST/v1/payments/' .
    //         $paymentId;

    //     $response = Http::withHeaders([

    //         'Content-Type' => 'application/json',

    //         // Add auth token here
    //         'authentication' =>
    //             'YOUR_AUTH_TOKEN'

    //     ])->post($endpoint, [

    //         'memberId' =>
    //             $memberId,

    //         'paymentType' =>
    //             'RF',

    //         'amount' =>
    //             $amount,

    //         'checksum' =>
    //             $checksum
    //     ]);

    //     $result = $response->json();

    //     \Log::info('Refund Response', $result);

    //     if (
    //         isset($result['responseCode']) &&
    //         $result['responseCode'] == '000'
    //     ) {

    //         $order->payment->update([

    //             'payment_status' =>
    //                 'refunded'
    //         ]);

    //         return back()->with(
    //             'success',
    //             'Payment Refunded Successfully.'
    //         );
    //     }

    //     return back()->with(
    //         'error',
    //         $result['responseMessage']
    //             ?? 'Refund Failed'
    //     );
    // }

    public function reviews()
    {
        $reviews = Review::with([

            'user',
            'order'

        ])

            ->where(

                'restaurant_id',

                auth()->user()->restaurant_id

            )

            ->latest()

            ->get();

        return view(

            'restaurant.reviews.index',

            compact('reviews')

        );
    }
    public function approveReview($id)
    {
        $review = Review::findOrFail($id);

        $review->update([

            'status' => 'approved'

        ]);

        return back()->with(

            'success',

            'Review approved successfully.'

        );
    }
    public function rejectReview($id)
    {
        $review = Review::findOrFail($id);

        $review->update([

            'status' => 'rejected'

        ]);

        return back()->with(

            'success',

            'Review rejected successfully.'

        );
    }
}