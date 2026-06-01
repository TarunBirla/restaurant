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

            <p class="text-2xl font-bold mt-4 text-blue-600">

                {{ $products }}

            </p>

        </div>

        <!-- ORDERS -->

        <div class="bg-white shadow rounded-3xl p-6">

            <h2 class="text-gray-500 text-lg">

                Total Orders

            </h2>

            <p class="text-2xl font-bold mt-4 text-red-500">

                {{ $orders }}

            </p>

        </div>

        <!-- CATEGORIES -->

        <div class="bg-white shadow rounded-3xl p-6">

            <h2 class="text-gray-500 text-lg">

                Categories

            </h2>

            <p class="text-2xl font-bold mt-4 text-green-600">

                {{ $categories }}

            </p>

        </div>

        <!-- EARNINGS -->

        <div class="mt-6">

            <button onclick="openQrModal()" class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl">
                Restaurant QR Code
            </button>

        </div>
        <div class="bg-white shadow rounded-3xl p-6">

            <h2 class="text-gray-500 text-lg">

                Earnings

            </h2>

            <p class="text-2xl font-bold mt-4 text-yellow-500">

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

            <p class="text-2xl font-bold mt-4 text-yellow-800">

                {{ $pendingOrders }}

            </p>

        </div>

        <!-- COMPLETED -->

        <div class="bg-green-100 rounded-3xl p-8">

            <h2 class="text-2xl font-bold text-green-700">

                Completed Orders

            </h2>

            <p class="text-2xl font-bold mt-4 text-green-800">

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

    <!-- QR MODAL -->

    <div id="qrModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 p-4">

        <div class="bg-white rounded-3xl p-8 max-w-md w-full relative">

            <!-- CLOSE -->

            <button onclick="closeQrModal()" class="absolute top-4 right-4 text-2xl">
                ✕
            </button>

            <!-- TITLE -->

            <h2 class="text-3xl font-bold text-center mb-6">
                Restaurant QR Code
            </h2>

            <!-- QR -->

            <div class="flex justify-center" id="qrCodeWrapper">
                {!! $restaurantQr !!}
            </div>

            <!-- LINK -->

            <div class="mt-5">

                <input type="text" value="{{ $restaurantUrl }}" readonly class="w-full border rounded-xl p-3">

            </div>

            <!-- DOWNLOAD -->

            <div class="mt-6 flex justify-center">

                <button onclick="downloadQR()" class="bg-black hover:bg-gray-800 text-white px-8 py-3 rounded-xl">
                    Download QR
                </button>

            </div>

        </div>

    </div>


        <script>

            function openQrModal() {
                document
                    .getElementById('qrModal')
                    .classList
                    .remove('hidden');

                document
                    .getElementById('qrModal')
                    .classList
                    .add('flex');
            }

            function closeQrModal() {
                document
                    .getElementById('qrModal')
                    .classList
                    .remove('flex');

                document
                    .getElementById('qrModal')
                    .classList
                    .add('hidden');
            }

            function downloadQR() {
                const svg = document.querySelector(
                    '#qrCodeWrapper svg'
                );

                const svgData = new XMLSerializer()
                    .serializeToString(svg);

                const canvas = document.createElement('canvas');

                const ctx = canvas.getContext('2d');

                const img = new Image();

                img.onload = function () {
                    canvas.width = img.width;
                    canvas.height = img.height;

                    ctx.drawImage(img, 0, 0);

                    const a = document.createElement('a');

                    a.download = 'restaurant-qr.png';

                    a.href = canvas.toDataURL('image/png');

                    a.click();
                };

                img.src =
                    'data:image/svg+xml;base64,' +
                    btoa(svgData);
            }

        </script>


@endsection