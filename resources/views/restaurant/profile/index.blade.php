@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <h1 class="text-4xl font-bold mb-8">

        Restaurant Profile

    </h1>

    <div class="bg-white rounded-2xl shadow p-10">

        <form method="POST"
        action="/restaurant/profile/update"
        enctype="multipart/form-data">

            @csrf

            <div class="grid grid-cols-2 gap-6">

                <div>

                    <label class="font-bold block mb-2">

                        Name

                    </label>

                    <input
                    type="text"
                    name="name"
                    value="{{ $restaurant->name }}"
                    class="w-full border p-4 rounded-xl">

                </div>

                <div>

                    <label class="font-bold block mb-2">

                        Email

                    </label>

                    <input
                    type="email"
                    name="email"
                    value="{{ $restaurant->email }}"
                    class="w-full border p-4 rounded-xl">

                </div>

                <div>

                    <label class="font-bold block mb-2">

                        Phone

                    </label>

                    <input
                    type="text"
                    name="phone"
                    value="{{ $restaurant->phone }}"
                    class="w-full border p-4 rounded-xl">

                </div>

                <div>

                    <label class="font-bold block mb-2">

                        Location

                    </label>

                    <input
                    type="text"
                    name="location"
                    value="{{ $restaurant->location }}"
                    class="w-full border p-4 rounded-xl">

                </div>

            </div>

            <div class="mt-6">

                <label class="font-bold block mb-2">

                    Description

                </label>

                <textarea
                name="description"
                rows="5"
                class="w-full border p-4 rounded-xl">{{ $restaurant->description }}</textarea>

            </div>

            <div class="mt-6">

                @if($restaurant->image)

                <img
                src="{{ asset('storage/'.$restaurant->image) }}"
                class="w-32 h-32 rounded-xl object-cover mb-5">

                @endif

                <input
                type="file"
                name="image"
                class="w-full border p-4 rounded-xl">

            </div>

            <button
            class="bg-blue-500 text-white px-10 py-4 rounded-xl mt-8">

                Update Profile

            </button>

        </form>

    </div>

</div>

@endsection