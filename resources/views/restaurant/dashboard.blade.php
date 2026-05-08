@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-10">

    <div>

        <h1 class="text-4xl font-bold">

            Restaurant Dashboard

        </h1>

        <p class="text-gray-500 mt-2">

            Welcome Restaurant Admin

        </p>

    </div>

</div>

<div class="grid grid-cols-4 gap-6">

    <div class="bg-white shadow rounded-2xl p-6">

        <h2 class="text-gray-500 text-lg">

            Total Products

        </h2>

        <p class="text-5xl font-bold mt-4">

            {{ \App\Models\Product::where('restaurant_id',auth()->user()->restaurant_id)->count() }}

        </p>

    </div>

    <div class="bg-white shadow rounded-2xl p-6">

        <h2 class="text-gray-500 text-lg">

            Total Orders

        </h2>

        <p class="text-5xl font-bold mt-4">

            {{ \App\Models\Order::where('restaurant_id',auth()->user()->restaurant_id)->count() }}

        </p>

    </div>

    <div class="bg-white shadow rounded-2xl p-6">

        <h2 class="text-gray-500 text-lg">

            Categories

        </h2>

        <p class="text-5xl font-bold mt-4">

            {{ \App\Models\Category::count() }}

        </p>

    </div>

    <div class="bg-white shadow rounded-2xl p-6">

        <h2 class="text-gray-500 text-lg">

            Earnings

        </h2>

        <p class="text-5xl font-bold mt-4">

            €0

        </p>

    </div>

</div>

<div class="bg-white rounded-2xl shadow mt-10 p-8">

    <div class="flex justify-between items-center mb-8">

        <h2 class="text-2xl font-bold">

            Quick Actions

        </h2>

    </div>

    <div class="flex gap-5">

        <a href="/restaurant/products/create"
        class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 rounded-xl">

            Add Product

        </a>

        <a href="/restaurant/products"
        class="bg-black hover:bg-gray-800 text-white px-8 py-4 rounded-xl">

            View Products

        </a>

    </div>

</div>

@endsection