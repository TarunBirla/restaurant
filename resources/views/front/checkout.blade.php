@extends('front.layouts.app')

@section('content')

    <div class="container mx-auto max-w-7xl py-10 px-5">

        <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-lg overflow-hidden">

            <!-- HEADER -->

            <div class="bg-red-500 text-white p-8">

                <h1 class="text-4xl font-bold">

                    Checkout

                </h1>

                <p class="mt-2 text-red-100">

                    Complete your order details

                </p>

            </div>

            <div class="p-8">

                @if ($errors->any())

                    <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-xl mb-6">

                        <ul class="list-disc ml-5">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                @php $total = 0; @endphp

                <!-- CART ITEMS -->

                <div class="mb-10">

                    <h2 class="text-2xl font-bold mb-6">

                        Order Summary

                    </h2>

                    @foreach($cart as $item)

                        @php

                            $subtotal = $item['price'] * $item['quantity'];

                            $total += $subtotal;

                        @endphp

                        <div class="flex justify-between items-center border-b py-5">

                            <div class="flex items-center gap-4">

                                <img src="{{ asset('storage/' . $item['image']) }}" class="w-30 h-30 rounded-xl object-cover">

                                <div>

                                    <h3 class="text-xl font-bold">

                                        {{ $item['name'] }}

                                    </h3>

                                    <div class="flex items-center gap-3 mt-3">

                                        <!-- DECREASE -->

                                        <a href="/cart/decrease/{{ $item['id'] }}"
                                            class="w-9 h-9 bg-gray-200 rounded-full flex items-center justify-center text-xl font-bold">

                                            -

                                        </a>

                                        <!-- QTY -->

                                        <span class="text-lg font-bold">

                                            {{ $item['quantity'] }}

                                        </span>

                                        <!-- INCREASE -->

                                        <a href="/cart/increase/{{ $item['id'] }}"
                                            class="w-9 h-9 bg-green-500 text-white rounded-full flex items-center justify-center text-xl font-bold">

                                            +

                                        </a>

                                        <!-- REMOVE -->

                                        <a href="/cart/remove/{{ $item['id'] }}" class="text-red-500 ml-4 font-semibold">

                                            Remove

                                        </a>

                                    </div>

                                    <p class="text-gray-500 mt-2">

                                        Price :
                                        <span class="font-bold text-red-500">

                                            £{{ $item['price'] }}
                                        </span>

                                    </p>

                                </div>

                            </div>

                            <h2 class="text-xl font-bold text-red-500">

                                £{{ $subtotal }}

                            </h2>

                        </div>

                    @endforeach

                </div>

                <!-- TOTAL -->

                <div class="flex justify-between items-center border-b pb-6 mb-8">

                    <h2 class="text-3xl font-bold">

                        Total Amount

                    </h2>

                    <h2 class="text-4xl font-bold text-red-500">

                        £{{ $total }}

                    </h2>

                </div>

                <!-- FORM -->

                <form method="POST" action="/place-order">

                    @csrf

                    <!-- ORDER TYPE -->

                    <h2 class="text-2xl font-bold mb-5">

                        Select Order Type

                    </h2>

                    <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">

                                        <label class="border rounded-2xl p-5 cursor-pointer hover:border-red-500 transition">

                                            <input type="radio" name="order_type" value="dine_in" required>

                                            <span class="ml-2 font-semibold text-lg">

                                                Dine In

                                            </span>

                                        </label>

                                        <label class="border rounded-2xl p-5 cursor-pointer hover:border-red-500 transition">

                                            <input type="radio" name="order_type" value="delivery" required>

                                            <span class="ml-2 font-semibold text-lg">

                                                Home Delivery

                                            </span>

                                        </label>

                                    </div> -->

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-10">

                        <!-- DINE IN -->

                        <label
                            class="border-2 border-gray-200 rounded-3xl p-5 cursor-pointer transition hover:border-red-500 hover:bg-red-50 flex items-center justify-between">

                            <div class="flex items-center gap-4">

                                <!-- RADIO -->

                                <input type="radio" name="order_type" value="dine_in" required
                                    class="w-5 h-5 accent-red-500">

                                <!-- TEXT -->

                                <div>

                                    <h3 class="font-bold text-xl text-gray-800">

                                        Dine In

                                    </h3>

                                    <p class="text-gray-500 text-sm mt-1">

                                        Eat inside restaurant

                                    </p>

                                </div>

                            </div>

                            <!-- ICON -->

                            <div class="text-3xl">

                                🍽️

                            </div>

                        </label>

                        <!-- HOME DELIVERY -->

                        <label
                            class="border-2 border-gray-200 rounded-3xl p-5 cursor-pointer transition hover:border-red-500 hover:bg-red-50 flex items-center justify-between">

                            <div class="flex items-center gap-4">

                                <!-- RADIO -->

                                <input type="radio" name="order_type" value="delivery" required
                                    class="w-5 h-5 accent-red-500">

                                <!-- TEXT -->

                                <div>

                                    <h3 class="font-bold text-xl text-gray-800">

                                        Home Delivery

                                    </h3>

                                    <p class="text-gray-500 text-sm mt-1">

                                        Delivered to your address

                                    </p>

                                </div>

                            </div>

                            <!-- ICON -->

                            <div class="text-3xl">

                                🚚

                            </div>

                        </label>

                    </div>

                    <!-- DELIVERY ADDRESS -->

                    <div id="deliveryFields" class="hidden">

                        <h2 class="text-2xl font-bold mb-5">

                            Delivery Details

                        </h2>

                        <!-- ADDRESS -->
                        <div class="mb-6">

                            <label class="font-bold text-lg block mb-3">

                                Delivery Address

                            </label>
                            <textarea id="address" name="address" placeholder="Enter Full Delivery Address"
                                class="w-full border rounded-2xl p-5 mb-5 focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
                        </div>
                        <!-- PINCODE -->
                        <div class="mb-6">

                            <label class="font-bold text-lg block mb-3">

                                Pin Code

                            </label>
                            <input type="text" id="pincode" name="pincode" placeholder="Enter Pincode"
                                class="w-full border rounded-2xl p-5 mb-8 focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                        <!-- PHONE -->

                        <!-- <div class="mb-6">

                                <label class="font-bold text-lg block mb-3">

                                    Phone Number

                                </label>

                                <input type="text" id="phone" name="phone" placeholder="Enter Phone Number"
                                    class="w-full border-2 border-gray-200 rounded-2xl p-5 focus:outline-none focus:ring-2 focus:ring-red-500">

                            </div> -->

                    </div>

                    <!-- PAYMENT -->

                    <h2 class="text-2xl font-bold mb-5">

                        Select Payment Method

                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- ONLINE PAYMENT -->

                        <label
                            class="border-2 border-gray-200 rounded-3xl p-5 cursor-pointer transition hover:border-green-500 hover:bg-green-50 flex items-center justify-between">

                            <div class="flex items-center gap-4">

                                <!-- RADIO -->

                                <input type="radio" name="payment_method" value="online" required
                                    class="w-5 h-5 accent-green-500">

                                <!-- TEXT -->

                                <div>

                                    <h3 class="font-bold text-xl text-gray-800">

                                        Online Payment

                                    </h3>

                                    <p class="text-gray-500 text-sm mt-1">

                                        UPI / Card / Wallet

                                    </p>

                                </div>

                            </div>

                            <!-- ICON -->

                            <div class="text-3xl">

                                💳

                            </div>

                        </label>

                        <!-- CASH ON DELIVERY -->

                        <label
                            class="border-2 border-gray-200 rounded-3xl p-5 cursor-pointer transition hover:border-blue-500 hover:bg-blue-50 flex items-center justify-between">

                            <div class="flex items-center gap-4">

                                <!-- RADIO -->

                                <input type="radio" name="payment_method" value="Cash On Delivery" required
                                    class="w-5 h-5 accent-blue-500">

                                <!-- TEXT -->

                                <div>

                                    <h3 class="font-bold text-xl text-gray-800">

                                        Cash On Delivery

                                    </h3>

                                    <p class="text-gray-500 text-sm mt-1">

                                        Pay after delivery

                                    </p>

                                </div>

                            </div>

                            <!-- ICON -->

                            <div class="text-3xl">

                                💵

                            </div>

                        </label>

                    </div>

                    <!-- PHONE FIELD -->

                    <div id="phoneField" class="hidden mt-8">

                        <label class="font-bold text-lg block mb-3">

                            Phone Number

                        </label>

                        <input type="text" id="phone" name="phone" placeholder="Enter Phone Number"
                            class="w-full border-2 border-gray-200 rounded-2xl p-5 focus:outline-none focus:ring-2 focus:ring-red-500">

                    </div>

                    <!-- BUTTON -->

                    <button
                        class="w-full bg-red-500 hover:bg-red-600 text-white text-xl font-bold py-5 rounded-2xl mt-10 transition">

                        Place Order

                    </button>

                </form>

            </div>

        </div>

    </div>

    <!-- JS -->

    <script>

        let orderTypes = document.querySelectorAll(
            'input[name="order_type"]'
        );

        let paymentMethods = document.querySelectorAll(
            'input[name="payment_method"]'
        );

        let deliveryFields =
            document.getElementById('deliveryFields');

        let phoneField =
            document.getElementById('phoneField');

        let address =
            document.getElementById('address');

        let pincode =
            document.getElementById('pincode');

        let phone =
            document.getElementById('phone');

        /*
        |--------------------------------------------------------------------------
        | ORDER TYPE
        |--------------------------------------------------------------------------
        */

        orderTypes.forEach((radio) => {

            radio.addEventListener('change', function () {

                /*
                |--------------------------------------------------------------------------
                | DELIVERY
                |--------------------------------------------------------------------------
                */

                if (this.value == 'delivery') {

                    deliveryFields.classList.remove('hidden');

                    address.required = true;

                    pincode.required = true;

                } else {

                    deliveryFields.classList.add('hidden');

                    address.required = false;

                    pincode.required = false;

                }

            });

        });

        /*
        |--------------------------------------------------------------------------
        | PAYMENT METHOD
        |--------------------------------------------------------------------------
        */

        paymentMethods.forEach((radio) => {

            radio.addEventListener('change', function () {

                /*
                |--------------------------------------------------------------------------
                | COD
                |--------------------------------------------------------------------------
                */

                if (this.value == 'Cash On Delivery') {

                    phoneField.classList.remove('hidden');

                    phone.required = true;

                } else {

                    phoneField.classList.add('hidden');

                    phone.required = false;

                }

            });

        });

    </script>

@endsection