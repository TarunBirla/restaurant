@extends('front.layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-10 px-5">

    <div class="max-w-7xl mx-auto">

        <div class="grid grid-cols-12 gap-8">

            <!-- SIDEBAR -->

            <div class="col-span-3">

                @include('front.layouts.user-sidebar')

            </div>

            <!-- CONTENT -->

            <div class="col-span-9">

                <div class="bg-white rounded-3xl shadow overflow-hidden">

                    <!-- HEADER -->

                    <div class="p-8 border-b flex justify-between items-center">

                        <div>

                            <h1 class="text-4xl font-bold">

                                My Transactions

                            </h1>

                            <p class="text-gray-500 mt-2">

                                Payment history & transactions

                            </p>

                        </div>

                        <div class="bg-green-100 text-green-700 px-5 py-3 rounded-2xl font-bold text-lg">

                            Total :
                            £{{ number_format($payments->sum('amount'),2) }}

                        </div>

                    </div>

                    <!-- TABLE -->

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-gray-100">

                                <tr>

                                    <th class="p-5 text-left">
                                        Transaction ID
                                    </th>

                                    <th class="p-5 text-left">
                                        Order
                                    </th>

                                    <th class="p-5 text-left">
                                        Restaurant
                                    </th>

                                    <th class="p-5 text-left">
                                        Payment Type
                                    </th>

                                    <th class="p-5 text-left">
                                        Amount
                                    </th>

                                    <th class="p-5 text-left">
                                        Status
                                    </th>

                                    <th class="p-5 text-left">
                                        Date
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($payments as $payment)

                                <tr class="border-t hover:bg-gray-50 transition">

                                    <!-- TRANSACTION -->

                                    <td class="p-5">

                                        <div class="font-bold text-gray-800">

                                            TXN-{{ $payment->id }}

                                        </div>

                                    </td>

                                    <!-- ORDER -->

                                    <td class="p-5">

                                        <a
                                        href="/my-orders/{{ $payment->order_id }}"
                                        class="text-blue-600 font-semibold hover:underline">

                                            #{{ $payment->order_id }}

                                        </a>

                                    </td>

                                    <!-- RESTAURANT -->

                                    <td class="p-5">

                                        {{ $payment->restaurant->name ?? '-' }}

                                    </td>

                                    <!-- PAYMENT TYPE -->

                                    <td class="p-5">

                                        @if($payment->payment_method == 'online')

                                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold">

                                                💳 Online

                                            </span>

                                        @else

                                            <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-bold">

                                                💵 COD

                                            </span>

                                        @endif

                                    </td>

                                    <!-- AMOUNT -->

                                    <td class="p-5">

                                        <span class="font-bold text-green-600 text-lg">

                                            £{{ $payment->amount }}

                                        </span>

                                    </td>

                                    <!-- STATUS -->

                                    <td class="p-5">

                                        @if($payment->payment_status == 'paid')

                                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold">

                                                ✅ Paid

                                            </span>

                                        @else

                                            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-bold">

                                                🕒 Pending

                                            </span>

                                        @endif

                                    </td>

                                    <!-- DATE -->

                                    <td class="p-5 text-gray-500">

                                        {{ $payment->created_at->format('d M Y') }}

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="7"
                                    class="text-center py-20">

                                        <div class="flex flex-col items-center">

                                            <div class="text-6xl mb-5">

                                                💳

                                            </div>

                                            <h2 class="text-2xl font-bold text-gray-700">

                                                No Transactions Found

                                            </h2>

                                            <p class="text-gray-500 mt-2">

                                                Your payment history will appear here

                                            </p>

                                        </div>

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection