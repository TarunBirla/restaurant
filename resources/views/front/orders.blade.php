@extends('front.layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-10">

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

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($orders as $order)

                            <tr class="border-t">

                                <td class="p-5">

                                    #{{ $order->id }}

                                </td>

                                <td class="p-5">

                                    €{{ $order->total_amount }}

                                </td>

                                <td class="p-5">

                                    {{ $order->created_at->format('d M Y') }}

                                </td>

                                <td class="p-5">

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