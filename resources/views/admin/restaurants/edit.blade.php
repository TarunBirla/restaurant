@extends('layouts.app')

@section('content')

<div class="bg-white rounded shadow p-8">

    <h1 class="text-3xl font-bold mb-8">

        Edit Restaurant

    </h1>

    <form method="POST"
        action="{{ route('admin.restaurants.update',$restaurant->id) }}"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-5">

            <div>

                <label>Name</label>

                <input type="text"
                name="name"
                value="{{ $restaurant->name }}"
                class="w-full border p-3 rounded">

            </div>

            <div>

                <label>Email</label>

                <input type="email"
                name="email"
                value="{{ $restaurant->email }}"
                class="w-full border p-3 rounded">

            </div>

            <div>

                <label>Phone</label>

                <input type="text"
                name="phone"
                value="{{ $restaurant->phone }}"
                class="w-full border p-3 rounded">

            </div>

            <div>

                <label>Location</label>

                <input type="text"
                name="location"
                value="{{ $restaurant->location }}"
                class="w-full border p-3 rounded">

            </div>

            <div class="mt-5">

                <label>Status</label>

                <select
                    name="status"
                    class="w-full border p-3 rounded">

                    <option
                        value="1"
                        {{ $restaurant->status == 1 ? 'selected' : '' }}>
                        Active
                    </option>

                    <option
                        value="0"
                        {{ $restaurant->status == 0 ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>

        </div>

        <div class="mt-5">

            <label>Description</label>

            <textarea
            name="description"
            rows="5"
            class="w-full border p-3 rounded">{{ $restaurant->description }}</textarea>

        </div>

        

        <div class="mt-5">

            @if($restaurant->image)

            <img
            src="{{ asset('storage/'.$restaurant->image) }}"
            class="w-32 h-32 rounded object-cover mb-5">

            @endif

            <input type="file" name="image">

        </div>

        

        <button
        class="bg-green-500 text-white px-8 py-3 rounded mt-5">

            Update Restaurant

        </button>

    </form>

</div>

@endsection