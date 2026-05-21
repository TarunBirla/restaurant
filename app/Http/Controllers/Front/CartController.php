<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        return view(
            'front.cart',
            compact('cart')
        );
    }


    public function add(Request $request)
    {
        if (!auth()->check()) {

            return response()->json([

                'success' => false,

                'message' => 'Please login first',

                'redirect' => route('login')

            ]);
        }

        $product =
            Product::findOrFail(
                $request->product_id
            );

        $cart =
            session()->get(
                'cart',
                []
            );

        /*
        SINGLE RESTAURANT
        */

        if (!empty($cart)) {

            $firstItem =
                reset($cart);

            $oldProduct =
                Product::find(
                    $firstItem['id']
                );

            if (

                $oldProduct

                &&

                $oldProduct->restaurant_id
                !=
                $product->restaurant_id

            ) {

                session()->forget('cart');

                $cart = [];
            }
        }

        if (
            isset(
            $cart[$product->id]
        )
        ) {

            $cart[
                $product->id
            ]['quantity']++;

        } else {

            $cart[
                $product->id
            ] = [

                'id' => $product->id,

                'name' => $product->name,

                'price' => $product->price,

                'image' => $product->image,

                'quantity' => 1
            ];
        }

        session()->put(
            'cart',
            $cart
        );

        return response()->json([

            'success' => true,

            'message' => 'Added to cart successfully',

            'count' =>

                collect($cart)

                    ->sum('quantity')

        ]);
    }
    public function increase($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

        }

        session()->put('cart', $cart);

        return back();
    }

    /*
    |--------------------------------------------------------------------------
    | DECREASE QTY
    |--------------------------------------------------------------------------
    */

    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            /*
            |--------------------------------------------------------------------------
            | MINIMUM 1
            |--------------------------------------------------------------------------
            */

            if ($cart[$id]['quantity'] > 1) {

                $cart[$id]['quantity']--;

            }

        }

        session()->put('cart', $cart);

        return back();
    }
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);

        return back();
    }
}