@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-4xl font-bold">

                Edit Category

            </h1>

            <p class="text-gray-500 mt-2">

                Update category details

            </p>

        </div>

        <a href="{{ route('admin.categories.index') }}"
        class="bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-xl">

            Back

        </a>

    </div>





    <div class="bg-white rounded-2xl shadow p-10">

        <form method="POST"
        action="{{ route('admin.categories.update',$category->id) }}"
        enctype="multipart/form-data">

            @csrf
            @method('PUT')





            <!-- CATEGORY NAME -->

            <div class="mb-6">

                <label class="font-semibold block mb-3">

                    Category Name

                </label>

                <input
                type="text"
                name="name"
                value="{{ $category->name }}"
                class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

            </div>





            <!-- PARENT CATEGORY -->

            <div class="mb-6">

                <label class="font-semibold block mb-3">

                    Parent Category

                </label>

                <select
                name="parent_id"
                class="w-full border border-gray-300 rounded-xl p-4">

                    <option value="">
                        Main Category
                    </option>

                    @foreach($categories as $cat)

                    <option
                    value="{{ $cat->id }}"
                    {{ $category->parent_id == $cat->id ? 'selected' : '' }}>

                        {{ $cat->name }}

                    </option>

                    @endforeach

                </select>

            </div>





            <!-- IMAGE -->

            <div class="mb-6">

                <label class="font-semibold block mb-3">

                    Category Image

                </label>

                @if($category->image)

                <img
                src="{{ asset('storage/'.$category->image) }}"
                class="w-32 h-32 rounded-xl object-cover mb-5 border">

                @endif

                <input
                type="file"
                name="image"
                class="w-full border border-gray-300 rounded-xl p-4">

            </div>





            <!-- STATUS -->

            <div class="mb-6">

                <label class="font-semibold block mb-3">

                    Status

                </label>

                <select
                name="status"
                class="w-full border border-gray-300 rounded-xl p-4">

                    <option
                    value="1"
                    {{ $category->status == 1 ? 'selected' : '' }}>

                        Active

                    </option>

                    <option
                    value="0"
                    {{ $category->status == 0 ? 'selected' : '' }}>

                        Inactive

                    </option>

                </select>

            </div>





            <!-- BUTTON -->

            <div class="mt-10">

                <button
                class="bg-blue-500 hover:bg-blue-600 text-white px-10 py-4 rounded-xl text-lg">

                    Update Category

                </button>

            </div>

        </form>

    </div>

</div>

@endsection