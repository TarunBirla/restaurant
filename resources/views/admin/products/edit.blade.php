@extends('layouts.app')

@section('content')

<div class="bg-white shadow rounded p-6">

    <h1 class="text-2xl font-bold mb-5">
        Edit Product
    </h1>

    <form method="POST"
    action="{{ route('admin.products.update',$product->id) }}"
    enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-5">

            <div>

                <label>Name</label>

                <input type="text"
                name="name"
                value="{{ $product->name }}"
                class="w-full border p-3 rounded">

            </div>

            <div>

                <label>Price</label>

                <input type="number"
                name="price"
                value="{{ $product->price }}"
                class="w-full border p-3 rounded">

            </div>

        </div>

        <div class="mt-5">

            <label>Description</label>

            <textarea
            name="description"
            class="w-full border p-3 rounded"
            rows="5">{{ $product->description }}</textarea>

        </div>

        <div class="mt-5">

            <img src="{{ asset('storage/'.$product->image) }}"
            class="w-32 h-32 object-cover mb-3">

            <input type="file" name="image">

        </div>

        <button
        class="bg-blue-500 text-white px-5 py-3 rounded mt-5">

            Update Product

        </button>

    </form>

</div>

@endsection