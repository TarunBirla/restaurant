@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-4xl font-bold">

            My Products

        </h1>

        <p class="text-gray-500 mt-2">

            Restaurant products list

        </p>

    </div>

    <a href="/restaurant/products/create"
    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl">

        Add Product

    </a>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-5 text-left">
                    Image
                </th>

                <th class="p-5 text-left">
                    Name
                </th>

                <th class="p-5 text-left">
                    Category
                </th>

                <th class="p-5 text-left">
                    Price
                </th>

                <th class="p-5 text-left">
                    Status
                </th>

                <th class="p-5 text-left">
                    Action
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($products as $product)

            <tr class="border-t">

                <td class="p-5">

                    @if($product->image)

                    <img
                    src="{{ asset('storage/'.$product->image) }}"
                    class="w-20 h-20 rounded-xl object-cover">

                    @endif

                </td>

                <td class="p-5 font-bold">

                    {{ $product->name }}

                </td>

                <td class="p-5">

                    {{ $product->category->name ?? '' }}

                </td>

                <td class="p-5">

                    £{{ $product->price }}

                </td>

                <td class="p-5">

                    @if($product->status == 1)

                    <span
                    class="bg-green-100 text-green-700 px-4 py-1 rounded-full">

                        Active

                    </span>

                    @else

                    <span
                    class="bg-red-100 text-red-700 px-4 py-1 rounded-full">

                        Inactive

                    </span>

                    @endif

                </td>

                <td class="p-5 flex gap-3">

                    <a href="/restaurant/products/{{ $product->id }}/edit"
                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg">

                        Edit

                    </a>

                    <form method="POST"
                    action="/restaurant/products/{{ $product->id }}">

                        @csrf
                        @method('DELETE')

                        <button
                        class="bg-red-500 text-white px-4 py-2 rounded-lg">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6"
                class="text-center py-20 text-gray-500">

                    No Products Found

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection