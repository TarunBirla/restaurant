@extends('front.layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-10">

    <div class="container mx-auto">

        <div class="grid grid-cols-12 gap-8">

            <!-- SIDEBAR -->

            <div class="col-span-3">

                <div class="bg-white rounded-3xl shadow p-8 sticky top-28">

                    <div class="text-center border-b pb-8">

                        <div
                        class="w-24 h-24 bg-red-500 rounded-full mx-auto flex items-center justify-center text-white text-4xl font-bold">

                            {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                        </div>

                        <h2 class="text-2xl font-bold mt-5">

                            {{ auth()->user()->name }}

                        </h2>

                        <p class="text-gray-500 mt-2">

                            {{ auth()->user()->email }}

                        </p>

                    </div>

                    <ul class="mt-8 space-y-3">

                        <li>

                            <a href="/dashboard"
                            class="block bg-red-500 text-white px-5 py-4 rounded-xl">

                                Dashboard

                            </a>

                        </li>

                        <li>

                            <a href="/profile"
                            class="block hover:bg-gray-100 px-5 py-4 rounded-xl transition">

                                My Profile

                            </a>

                        </li>

                        <li>

                            <a href="/my-orders"
                            class="block hover:bg-gray-100 px-5 py-4 rounded-xl transition">

                                My Orders

                            </a>

                        </li>

                        <li>

                            <a href="/cart"
                            class="block hover:bg-gray-100 px-5 py-4 rounded-xl transition">

                                Cart

                            </a>

                        </li>

                        <li>

                            <form method="POST"
                            action="/logout">

                                @csrf

                                <button
                                class="w-full text-left hover:bg-red-500 hover:text-white px-5 py-4 rounded-xl transition">

                                    Logout

                                </button>

                            </form>

                        </li>

                    </ul>

                </div>

            </div>





            <!-- CONTENT -->

            <div class="col-span-9">

                <div class="grid grid-cols-3 gap-6">

                    <div class="bg-white rounded-3xl shadow p-8">

                        <h3 class="text-gray-500 text-lg">

                            My Orders

                        </h3>

                        <h2 class="text-5xl font-bold mt-5">

                            {{ \App\Models\Order::where('user_id',auth()->id())->count() }}

                        </h2>

                    </div>

                    <div class="bg-white rounded-3xl shadow p-8">

                        <h3 class="text-gray-500 text-lg">

                            Cart Items

                        </h3>

                        <h2 class="text-5xl font-bold mt-5">

                            {{ count(session('cart',[])) }}

                        </h2>

                    </div>

                    <div class="bg-white rounded-3xl shadow p-8">

                        <h3 class="text-gray-500 text-lg">

                            Account Type

                        </h3>

                        <h2 class="text-3xl font-bold mt-5">

                            {{ auth()->user()->role }}

                        </h2>

                    </div>

                </div>





                <!-- RECENT ORDERS -->

                <div class="bg-white rounded-3xl shadow mt-10 p-8">

                    <div class="flex justify-between items-center mb-8">

                        <h2 class="text-3xl font-bold">

                            Recent Orders

                        </h2>

                        <a href="/my-orders"
                        class="text-red-500 font-bold">

                            View All

                        </a>

                    </div>

                    <table class="w-full">

                        <thead>

                            <tr class="border-b">

                                <th class="text-left py-4">
                                    Order ID
                                </th>

                                <th class="text-left py-4">
                                    Amount
                                </th>

                                <th class="text-left py-4">
                                    Date
                                </th>

                                <th class="text-left py-4">
                                    Status
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach(\App\Models\Order::where('user_id',auth()->id())->latest()->take(5)->get() as $order)

                            <tr class="border-b">

                                <td class="py-5">

                                    #{{ $order->id }}

                                </td>

                                <td class="py-5">

                                    €{{ $order->total_amount }}

                                </td>

                                <td class="py-5">

                                    {{ $order->created_at->format('d M Y') }}

                                </td>

                                <td class="py-5">

                                    <span
                                    class="bg-green-100 text-green-700 px-4 py-1 rounded-full">

                                        {{ $order->status }}

                                    </span>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection