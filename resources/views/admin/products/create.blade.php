@extends('layouts.app')

@section('content')

<div class="bg-white shadow rounded p-6">

    <h1 class="text-2xl font-bold mb-5">
        Add Product
    </h1>

    <form method="POST"
    action="{{ route('admin.products.store') }}"
    enctype="multipart/form-data">

        @csrf

        <div class="grid grid-cols-2 gap-5">

            <div>

                <label>Name</label>

                <input type="text"
                name="name"
                class="w-full border p-3 rounded">

            </div>

            <div>

                <label>Restaurant</label>

                <select name="restaurant_id"
                class="w-full border p-3 rounded">

                    @foreach($restaurants as $restaurant)

                    <option value="{{ $restaurant->id }}">
                        {{ $restaurant->name }}
                    </option>

                    @endforeach

                </select>

            </div>
            <div>

    <label>Vendor</label>

    <select name="vendor_id"
    class="w-full border p-3 rounded">

        <option value="">
            Select Vendor
        </option>

        @foreach($vendors as $vendor)

        <option value="{{ $vendor->id }}">
            {{ $vendor->name }}
        </option>

        @endforeach

    </select>

</div>

            <div>

                <label>Category</label>

                <select name="category_id"
                class="w-full border p-3 rounded">

                    @foreach($categories as $category)

                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label>Price (€)</label>

                <input type="number"
                step="0.01"
                name="price"
                class="w-full border p-3 rounded">

            </div>

        </div>

        <div class="mt-5">

            <label>Description</label>

            <textarea
            name="description"
            rows="5"
            class="w-full border p-3 rounded"></textarea>

        </div>

        <div class="mt-5">

            <label>Image</label>

            <input type="file" name="image">

        </div>

        <button
        class="bg-green-500 text-white px-5 py-3 rounded mt-5">

            Save Product

        </button>

    </form>

</div>

@endsection