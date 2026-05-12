@extends('front.layouts.app')

@section('content')

    <div class="bg-gray-100 mx-auto max-w-7xl py-10 px-5">

        <div class="container mx-auto">

            <div class="grid grid-cols-12 gap-8">

                <!-- SIDEBAR -->

                <div class="col-span-3">

                    @include('front.layouts.user-sidebar')

                </div>





                <!-- CONTENT -->

                <div class="col-span-9">

                    <div class="bg-white rounded-3xl shadow p-8">

                        <h1 class="text-4xl font-bold mb-10">

                            My Cart

                        </h1>

                        @php $total = 0; @endphp

                        @forelse($cart as $item)

                            @php
                                $total += $item['price'] * $item['quantity'];
                            @endphp

                            <div class="flex justify-between items-center border-b py-5">

                                <div class="flex items-center gap-5">

                                    <img src="{{ asset('storage/' . $item['image']) }}"
                                        class="w-24 h-24 rounded-xl object-cover">

                                    <div>

                                        <h2 class="text-2xl font-bold">

                                            {{ $item['name'] }}

                                        </h2>

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

                                        </div>

                                    </div>

                                </div>

                                <div>

                                    <p class="text-2xl font-bold">

                                        £{{ $item['price'] }}

                                        <span class="text-gray-500 text-lg">

                                            x

                                        </span>

                                        {{ $item['quantity'] }}

                                        <span class="text-gray-500 text-lg">

                                            =

                                        </span>

                                        <span class="text-red-500">

                                            £{{ $item['price'] * $item['quantity'] }}

                                        </span>

                                    </p>

                                    <a href="/cart/remove/{{ $item['id'] }}" class="text-red-500 mt-3 inline-block">

                                        Remove

                                    </a>

                                </div>

                            </div>

                        @empty

                            <p class="text-center py-20 text-gray-500">

                                Cart Empty

                            </p>

                        @endforelse

                        @if(count($cart) > 0)

                            <div class="flex justify-between mt-10">

                                <h2 class="text-3xl font-bold">

                                    Total

                                </h2>

                                <h2 class="text-3xl font-bold">

                                    £{{ $total }}

                                </h2>

                            </div>

                            <a href="/checkout" class="bg-green-500 text-white px-10 py-4 rounded-xl inline-block mt-8">

                                Checkout

                            </a>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection