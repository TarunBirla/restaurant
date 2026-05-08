@extends('front.layouts.app')

@section('content')

<div class="container mx-auto py-10">

    <h1 class="text-4xl font-bold mb-10">

        {{ $category->name }}

    </h1>

    <div class="grid grid-cols-4 gap-5">

        @foreach($products as $product)

        <div class="bg-white shadow rounded overflow-hidden">

            <img
            src="{{ asset('storage/'.$product->image) }}"
            class="w-full h-60 object-cover">

            <div class="p-5">

                <h2 class="text-2xl font-bold">

                    {{ $product->name }}

                </h2>

                <p class="mt-3 text-gray-500">

                    €{{ $product->price }}

                </p>

                <a href="/product/{{ $product->id }}"
                class="bg-blue-500 text-white px-5 py-2 rounded inline-block mt-5">

                    View Product

                </a>

            </div>

        </div>

        @endforeach

    </div>

</div>

@endsection