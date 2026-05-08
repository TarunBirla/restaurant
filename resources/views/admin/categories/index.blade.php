@extends('layouts.app')

@section('content')

<div class="p-10">

    <div class="flex justify-between mb-5">

        <h1 class="text-2xl font-bold">
            Categories
        </h1>

        <a href="{{ route('admin.categories.create') }}"
        class="bg-blue-500 text-white px-5 py-2 rounded">
            Add Category
        </a>

    </div>

    <table class="w-full border">

        <tr class="bg-gray-200">

            <th class="p-3 border">Image</th>
            <th class="p-3 border">Name</th>
            <th class="p-3 border">Parent</th>
            <th class="p-3 border">Action</th>

        </tr>

        @foreach($categories as $category)

        <tr>

            <td class="border p-3">

                @if($category->image)

                <img src="{{ asset('storage/'.$category->image) }}"
                class="w-20 h-20 object-cover">

                @endif

            </td>

            <td class="border p-3">
                {{ $category->name }}
            </td>

            <td class="border p-3">
                {{ $category->parent->name ?? '-' }}
            </td>

            <td class="border p-3">

                <a href="{{ route('admin.categories.edit',$category->id) }}"
                class="bg-yellow-500 text-white px-3 py-1 rounded">
                    Edit
                </a>

                <form method="POST"
                action="{{ route('admin.categories.destroy',$category->id) }}"
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