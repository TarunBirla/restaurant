@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-10">

        <div>

            <h1 class="text-4xl font-bold">

                Order Details

            </h1>

            <p class="text-gray-500 mt-2">

                Order #{{ $order->id }}

            </p>

        </div>

        <a href="/restaurant/orders"
        class="bg-black text-white px-6 py-3 rounded-xl">

            Back

        </a>

    </div>





    <div class="grid grid-cols-3 gap-8">

        <div class="bg-white rounded-2xl shadow p-8">

            <h2 class="text-xl font-bold mb-5">

                Customer Info

            </h2>

            <p class="mb-3">

                <strong>Name:</strong>
                {{ $order->user->name }}

            </p>

            <p class="mb-3">

                <strong>Email:</strong>
                {{ $order->user->email }}

            </p>

        </div>
<div class="bg-white rounded-2xl shadow p-8">

    <h2 class="text-xl font-bold mb-5">
        Payment Info
    </h2>

    <p class="mb-3">
        <strong>Payment Method:</strong>

        {{ $order->payment->payment_method ?? 'N/A' }}
    </p>

    <p class="mb-3">
        <strong>Payment Status:</strong>

        <span class="px-3 py-1 rounded-full bg-gray-100">
            {{ $order->payment->payment_status ?? 'Pending' }}
        </span>
    </p>

</div>




       





        <div class="bg-white rounded-2xl shadow p-8">

            <h2 class="text-xl font-bold mb-5">

                Update Status

            </h2>

            <form method="POST"
            action="{{ route('restaurant.orders.status',$order->id) }}">

                @csrf

                <select
                name="status"
                class="w-full border rounded-xl p-4">

                    <option
                    value="pending"
                    {{ $order->status == 'pending' ? 'selected' : '' }}>

                        Pending

                    </option>

                    <option
                    value="accepted"
                    {{ $order->status == 'accepted' ? 'selected' : '' }}>

                        Accepted

                    </option>
                    <option
                    value="completed"
                    {{ $order->status == 'completed' ? 'selected' : '' }}>

                        Completed

                    </option>
                    

                    <option
                    value="cancelled"
                    {{ $order->status == 'cancelled' ? 'selected' : '' }}>

                        Cancelled

                    </option>

                </select>

                <button
                class="bg-blue-500 text-white px-8 py-3 rounded-xl mt-5">

                    Update

                </button>

            </form>

        </div>
        <div class="mt-8 border-t pt-6">

    <h3 class="text-lg font-bold mb-4">
        Update Payment Status
    </h3>

    <form method="POST"
    action="{{ route('restaurant.orders.payment.status', $order->id) }}">

        @csrf

        <select
        name="payment_status"
        class="w-full border rounded-xl p-4">

            <option
            value="pending"
            {{ optional($order->payment)->payment_status == 'pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option
            value="paid"
            {{ optional($order->payment)->payment_status == 'paid' ? 'selected' : '' }}>
                Paid
            </option>

            <option
            value="failed"
            {{ optional($order->payment)->payment_status == 'failed' ? 'selected' : '' }}>
                Failed
            </option>

            <option
            value="cancelled"
            {{ optional($order->payment)->payment_status == 'cancelled' ? 'selected' : '' }}>
                Cancelled
            </option>

        </select>

        <button
        class="bg-green-500 text-white px-8 py-3 rounded-xl mt-5">

            Update Payment

        </button>

    </form>

</div>

    </div>





    <div class="bg-white rounded-2xl shadow mt-10 overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-5 text-left">
                        Product
                    </th>

                    <th class="p-5 text-left">
                        Price
                    </th>

                    <th class="p-5 text-left">
                        Qty
                    </th>

                    <th class="p-5 text-left">
                        Total
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($order->items as $item)

                <tr class="border-t">

                    <td class="p-5">

                        {{ $item->product->name ?? '' }}

                    </td>

                    <td class="p-5">

                        £{{ $item->price }}

                    </td>

                    <td class="p-5">

                        {{ $item->quantity }}

                    </td>

                    <td class="p-5 font-bold">

                        £{{ $item->total }}

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection