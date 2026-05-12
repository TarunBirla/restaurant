@extends('front.layouts.app')

@section('content')

    <div class="bg-gray-100 mx-auto max-w-7xl  px-5 py-10">

        <div class="container mx-auto">

            <div class="grid grid-cols-12 gap-8">

                <!-- SIDEBAR -->

                <div class="col-span-3">

                    @include('front.layouts.user-sidebar')

                </div>





                <!-- CONTENT -->

                <div class="col-span-9">

                    <div class="bg-white rounded-3xl shadow overflow-hidden">

                        <div class="p-8 border-b">

                            <h1 class="text-4xl font-bold">

                                My Orders

                            </h1>

                        </div>

                        <table class="w-full">

                            <thead class="bg-gray-100">

                                <tr>

                                    <th class="p-5 text-left">
                                        Order ID
                                    </th>

                                    <th class="p-5 text-left">
                                        Amount
                                    </th>

                                    <th class="p-5 text-left">
                                        Date
                                    </th>

                                    <th class="p-5 text-left">
                                        Status
                                    </th>
                                    <th class="p-5 text-left">
                                        Action
                                    </th>


                                </tr>

                            </thead>

                            <tbody>

                                @foreach($orders as $order)

                                    <tr class="border-t">

                                        <td class="p-5">

                                            #{{ $order->id }}

                                        </td>

                                        <td class="p-5">

                                            £{{ $order->total_amount }}

                                        </td>

                                        <td class="p-5">

                                            {{ $order->created_at->format('d M Y') }}

                                        </td>

                                        <td class="p-5">

                                            @if($order->status == 'pending')

                                                <span
                                                    class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-bold inline-flex items-center gap-2">

                                                    Pending

                                                </span>

                                            @elseif($order->status == 'accepted')

                                                <span
                                                    class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-bold inline-flex items-center gap-2">

                                                    Accepted

                                                </span>

                                            @elseif($order->status == 'completed')

                                                <span
                                                    class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold inline-flex items-center gap-2">

                                                    Completed

                                                </span>

                                            @elseif($order->status == 'cancelled')

                                                <span
                                                    class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold inline-flex items-center gap-2">

                                                    Cancelled

                                                </span>

                                            @else

                                                <span
                                                    class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-bold inline-flex items-center gap-2">

                                                    {{ ucfirst($order->status) }}

                                                </span>

                                            @endif

                                        </td>
                                        <td class="p-5">

                                            <a href="/my-orders/{{ $order->id }}"
                                                class="bg-black text-white px-5 py-2 rounded-xl">

                                                View

                                            </a>

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