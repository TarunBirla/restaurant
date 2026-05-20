<?php

namespace App\Http\Controllers\RestaurantAdmin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Services\FirebaseNotificationService;

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

    public function show($id)
    {
        $order = Order::where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )
            ->with([
                'user',
                'items.product',
                'payment'
            ])
            ->findOrFail($id);

        return view(
            'restaurant.orders.show',
            compact('order')
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

            $firebase =
                new FirebaseNotificationService();

            $firebase->send(

                $order->user->fcm_token,

                'Order Status Updated',

                'Your order is now '
                . $request->status

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

                        'payment_status' => 'cancelled'

                    ]);

        }

        return back()->with(
            'success',
            'Order Status Updated Successfully'
        );
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )->findOrFail($id);

        Payment::where(
            'order_id',
            $order->id
        )->update([

                    'payment_status' => $request->payment_status

                ]);

        return back()->with(
            'success',
            'Payment Status Updated Successfully'
        );
    }

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