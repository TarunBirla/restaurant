@extends('front.layouts.app')

@section('content')

    <div class="container mx-auto py-10">

        <div class="bg-white rounded shadow p-10 grid grid-cols-2 gap-10">

            <div>

                <img src="{{ asset('storage/' . $product->image) }}" class="w-full rounded">

            </div>

            <div>

                <h1 class="text-5xl font-bold">

                    {{ $product->name }}

                </h1>

                <p class="text-3xl font-bold text-red-500 mt-5">

                    €{{ $product->price }}

                </p>

                <p class="mt-5 text-gray-600 leading-8">

                    {{ $product->description }}

                </p>

                <form method="POST" action="/cart/add" class="mt-10">

                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="current_url" value="{{ url()->current() }}">


                    <button class="bg-red-500 text-white px-10 py-4 rounded text-xl">

                        Add To Cart

                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection