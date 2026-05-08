@extends('front.layouts.app')

@section('content')

<div class="container mx-auto py-10">

    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow p-10">

        <h1 class="text-4xl font-bold mb-10">

            Checkout

        </h1>

        @php $total = 0; @endphp

        @foreach($cart as $item)

        @php
        $total += $item['price'] * $item['quantity'];
        @endphp

        <div class="flex justify-between border-b py-5">

            <h2 class="text-xl">

                {{ $item['name'] }}

            </h2>

            <h2 class="font-bold">

                €{{ $item['price'] }}

            </h2>

        </div>

        @endforeach

        <div class="flex justify-between mt-10">

            <h2 class="text-3xl font-bold">

                Total

            </h2>

            <h2 class="text-3xl font-bold">

                €{{ $total }}

            </h2>

        </div>

        <form method="POST"
        action="/place-order">

            @csrf

            <button
            class="bg-red-500 text-white px-10 py-4 rounded-xl mt-10">

                Place Order

            </button>

        </form>

    </div>

</div>

@endsection