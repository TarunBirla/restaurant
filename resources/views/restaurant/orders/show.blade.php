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

            {{-- <p class="mb-3">

                <strong>Email:</strong>
                {{ $order->user->email }}

            </p> --}}

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

{{-- FLOATING MESSAGE BUTTON --}}
<button
    onclick="openMessageModal()"
    style="
        position:fixed;
        bottom:30px;
        right:30px;
        width:64px;
        height:64px;
        border-radius:50%;
        border:none;
        background:#2563EB;
        color:#fff;
        cursor:pointer;
        box-shadow:0 10px 30px rgba(37,99,235,.35);
        z-index:9999;
        display:flex;
        align-items:center;
        justify-content:center;
    ">

    <svg width="28"
        height="28"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24">

        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M8 10h8M8 14h5M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4-.8L3 20l1.2-3.2A7.64 7.64 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />

    </svg>

</button>

{{-- MESSAGE MODAL --}}
<div id="messageModal"
    style="
        display:none;
        position:fixed;
        inset:0;
        background:rgba(0,0,0,.5);
        z-index:99999;
        align-items:center;
        justify-content:center;
    ">

    <div style="
        width:100%;
        max-width:500px;
        background:#fff;
        border-radius:24px;
        padding:30px;
        position:relative;
    ">

        <button
            onclick="closeMessageModal()"
            style="
                position:absolute;
                top:15px;
                right:15px;
                border:none;
                background:none;
                font-size:22px;
                cursor:pointer;
            ">

            ✕

        </button>

        <h2 class="text-2xl font-bold mb-6">

            Send Message

        </h2>

        <form method="POST"
            action="{{ route('restaurant.orders.message', $order->id) }}">

            @csrf

            <textarea
                name="message"
                rows="5"
                required
                placeholder="Write message..."
                class="w-full border rounded-2xl p-4"></textarea>

            <button
                class="bg-blue-500 text-white px-8 py-3 rounded-xl mt-5">

                Send Message

            </button>

        </form>

    </div>

</div>

<script>

function openMessageModal() {

    document.getElementById('messageModal').style.display = 'flex';

}

function closeMessageModal() {

    document.getElementById('messageModal').style.display = 'none';

}

</script>

@endsection