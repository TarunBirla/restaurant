@extends('layouts.app')

@section('content')

<div class="p-10">

    <div class="flex justify-between mb-5">

        <h1 class="text-2xl font-bold">
            Products
        </h1>

        <a href="{{ route('admin.products.create') }}"
        class="bg-green-500 text-white px-5 py-2 rounded">
            Add Product
        </a>

    </div>

    <table class="w-full border">

        <tr class="bg-gray-200">

            <th class="border p-3">Image</th>
            <th class="border p-3">Name</th>
            <th class="border p-3">Restaurant</th>
            <th class="border p-3">Category</th>
            <th class="border p-3">Price</th>
            <th class="border p-3">Action</th>

        </tr>

        @foreach($products as $product)

        <tr>

            <td class="border p-3">

                <img src="{{ asset('storage/'.$product->image) }}"
                class="w-20 h-20 object-cover">

            </td>

            <td class="border p-3">
                {{ $product->name }}
            </td>

            <td class="border p-3">
                {{ $product->restaurant->name ?? '' }}
            </td>

            <td class="border p-3">
                {{ $product->category->name ?? '' }}
            </td>

            <td class="border p-3">
                €{{ $product->price }}
            </td>

            <td class="border p-3">

                <a href="{{ route('admin.products.edit',$product->id) }}"
                class="bg-yellow-500 text-white px-3 py-1 rounded">
                    Edit
                </a>

                <form method="POST"
                action="{{ route('admin.products.destroy',$product->id) }}"
                class="inline">

                    @csrf
                    @method('DELETE')

                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

        @endforeach

    </table>

</div>

@endsection