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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- PRODUCTS -->

        <div class="bg-white shadow rounded-3xl p-6">

            <h2 class="text-gray-500 text-lg">

                Total Products

            </h2>

            <p class="text-5xl font-bold mt-4 text-blue-600">

                {{ $products }}

            </p>

        </div>

        <!-- ORDERS -->

        <div class="bg-white shadow rounded-3xl p-6">

            <h2 class="text-gray-500 text-lg">

                Total Orders

            </h2>

            <p class="text-5xl font-bold mt-4 text-red-500">

                {{ $orders }}

            </p>

        </div>

        <!-- CATEGORIES -->

        <div class="bg-white shadow rounded-3xl p-6">

            <h2 class="text-gray-500 text-lg">

                Categories

            </h2>

            <p class="text-5xl font-bold mt-4 text-green-600">

                {{ $categories }}

            </p>

        </div>

        <!-- EARNINGS -->

        <div class="bg-white shadow rounded-3xl p-6">

            <h2 class="text-gray-500 text-lg">

                Earnings

            </h2>

            <p class="text-4xl font-bold mt-4 text-yellow-500">

                £{{ number_format($earnings, 2) }}

            </p>

        </div>

    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

    <!-- PENDING -->

    <div class="bg-yellow-100 rounded-3xl p-8">

        <h2 class="text-2xl font-bold text-yellow-700">

            Pending Orders

        </h2>

        <p class="text-5xl font-bold mt-4 text-yellow-800">

            {{ $pendingOrders }}

        </p>

    </div>

    <!-- COMPLETED -->

    <div class="bg-green-100 rounded-3xl p-8">

        <h2 class="text-2xl font-bold text-green-700">

            Completed Orders

        </h2>

        <p class="text-5xl font-bold mt-4 text-green-800">

            {{ $completedOrders }}

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

            <a href="/restaurant/products/create" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 rounded-xl">

                Add Product

            </a>

            <a href="/restaurant/products" class="bg-black hover:bg-gray-800 text-white px-8 py-4 rounded-xl">

                View Products

            </a>

        </div>

    </div>

@endsection