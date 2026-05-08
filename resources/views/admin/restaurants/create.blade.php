@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-4xl font-bold">

                Add Restaurant

            </h1>

            <p class="text-gray-500 mt-2">

                Create new restaurant

            </p>

        </div>

        <a href="{{ route('admin.restaurants.index') }}"
        class="bg-gray-800 hover:bg-black text-white px-6 py-3 rounded-xl">

            Back

        </a>

    </div>

    <div class="bg-white rounded-2xl shadow p-10">

        <form method="POST"
        action="{{ route('admin.restaurants.store') }}"
        enctype="multipart/form-data">

            @csrf

            <div class="grid grid-cols-2 gap-6">

                <!-- Restaurant Name -->

                <div>

                    <label class="font-semibold block mb-2">

                        Restaurant Name

                    </label>

                    <input
                    type="text"
                    name="name"
                    placeholder="Enter restaurant name"
                    class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                <!-- Email -->

                <div>

                    <label class="font-semibold block mb-2">

                        Email

                    </label>

                    <input
                    type="email"
                    name="email"
                    placeholder="Enter email"
                    class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>
                <div class="mt-6">

    <label class="font-semibold block mb-2">

        Password

    </label>

    <input
    type="password"
    name="password"
    placeholder="Enter password"
    class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

</div>

                <!-- Phone -->

                <div>

                    <label class="font-semibold block mb-2">

                        Phone

                    </label>

                    <input
                    type="text"
                    name="phone"
                    placeholder="Enter phone number"
                    class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                <!-- Location -->

                <div>

                    <label class="font-semibold block mb-2">

                        Location

                    </label>

                    <input
                    type="text"
                    name="location"
                    placeholder="Enter location"
                    class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

            </div>

            <!-- Description -->

            <div class="mt-6">

                <label class="font-semibold block mb-2">

                    Description

                </label>

                <textarea
                name="description"
                rows="5"
                placeholder="Restaurant description..."
                class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

            </div>

            <!-- Image -->

            <div class="mt-6">

                <label class="font-semibold block mb-2">

                    Restaurant Image

                </label>

                <input
                type="file"
                name="image"
                class="w-full border border-gray-300 rounded-xl p-4">

            </div>

            <!-- Status -->

            <div class="mt-6">

                <label class="font-semibold block mb-2">

                    Status

                </label>

                <select
                name="status"
                class="w-full border border-gray-300 rounded-xl p-4">

                    <option value="1">
                        Active
                    </option>

                    <option value="0">
                        Inactive
                    </option>

                </select>

            </div>

            <!-- Submit -->

            <div class="mt-10">

                <button
                class="bg-blue-500 hover:bg-blue-600 text-white px-10 py-4 rounded-xl text-lg">

                    Save Restaurant

                </button>

            </div>

        </form>

    </div>

</div>

@endsection