@extends('layouts.app')

@section('content')

<div class="p-10">

    <h1 class="text-2xl font-bold mb-5">
        Add Category
    </h1>

    <form method="POST"
    action="{{ route('admin.categories.store') }}"
    enctype="multipart/form-data">

        @csrf

        <div class="mb-4">

            <label>Name</label>

            <input type="text"
            name="name"
            class="w-full border p-3 rounded">

        </div>

        <div class="mb-4">

            <label>Parent Category</label>

            <select name="parent_id"
            class="w-full border p-3 rounded">

                <option value="">Select</option>

                @foreach($categories as $category)

                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label>Image</label>

            <input type="file" name="image">

        </div>

        <button class="bg-blue-500 text-white px-5 py-2 rounded">
            Save
        </button>

    </form>

</div>

@endsection