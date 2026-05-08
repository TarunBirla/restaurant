@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-4xl font-bold">

            Restaurants

        </h1>

        <p class="text-gray-500 mt-2">

            Manage all restaurants

        </p>

    </div>

    <a href="{{ route('admin.restaurants.create') }}"
    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl">

        Add Restaurant

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
                    Email
                </th>

                <th class="p-5 text-left">
                    Phone
                </th>

                <th class="p-5 text-left">
                    Location
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

            @forelse($restaurants as $restaurant)

            <tr class="border-t hover:bg-gray-50">

                <td class="p-5">

                    @if($restaurant->image)

                    <img
                    src="{{ asset('storage/'.$restaurant->image) }}"
                    class="w-20 h-20 rounded-xl object-cover">

                    @else

                    <img
                    src="https://via.placeholder.com/80"
                    class="w-20 h-20 rounded-xl object-cover">

                    @endif

                </td>

                <td class="p-5 font-bold">

                    {{ $restaurant->name }}

                </td>

                <td class="p-5">

                    {{ $restaurant->email }}

                </td>

                <td class="p-5">

                    {{ $restaurant->phone }}

                </td>

                <td class="p-5">

                    {{ $restaurant->location }}

                </td>

                <td class="p-5">

                    @if($restaurant->status == 1)

                    <span
                    class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm">

                        Active

                    </span>

                    @else

                    <span
                    class="bg-red-100 text-red-700 px-4 py-1 rounded-full text-sm">

                        Inactive

                    </span>

                    @endif

                </td>

                <td class="p-5">

                    <div class="flex gap-3">

                        <a href="{{ route('admin.restaurants.edit',$restaurant->id) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

                            Edit

                        </a>

                        <form method="POST"
                        action="{{ route('admin.restaurants.destroy',$restaurant->id) }}"
                        onsubmit="return confirm('Delete Restaurant?')">

                            @csrf
                            @method('DELETE')

                            <button
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">

                                Delete

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7"
                class="text-center py-20 text-gray-500">

                    No Restaurants Found

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection