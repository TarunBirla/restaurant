@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-8">

    Super Admin Dashboard

</h1>

<div class="grid grid-cols-4 gap-5">

    <div class="bg-white shadow rounded p-5">

        <h2 class="text-gray-500">
            Restaurants
        </h2>

        <p class="text-4xl font-bold mt-3">
            {{ $restaurants }}
        </p>

    </div>

    <div class="bg-white shadow rounded p-5">

        <h2 class="text-gray-500">
            Products
        </h2>

        <p class="text-4xl font-bold mt-3">
            {{ $products }}
        </p>

    </div>

    <div class="bg-white shadow rounded p-5">

        <h2 class="text-gray-500">
            Orders
        </h2>

        <p class="text-4xl font-bold mt-3">
            {{ $orders }}
        </p>

    </div>

    <div class="bg-white shadow rounded p-5">

        <h2 class="text-gray-500">
            Users
        </h2>

        <p class="text-4xl font-bold mt-3">
            {{ $users }}
        </p>

    </div>

</div>

@endsection