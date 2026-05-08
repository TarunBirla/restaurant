@extends('front.layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-10">

    <div class="container mx-auto">

        <div class="grid grid-cols-12 gap-8">

            <!-- SIDEBAR -->

            <div class="col-span-3">

                @include('front.layouts.user-sidebar')

            </div>





            <!-- CONTENT -->

            <div class="col-span-9">

                <div class="bg-white rounded-3xl shadow p-10">

                    <h1 class="text-4xl font-bold mb-10">

                        My Profile

                    </h1>

                    @if(session('success'))

                    <div
                    class="bg-green-100 text-green-700 px-5 py-4 rounded-xl mb-8">

                        {{ session('success') }}

                    </div>

                    @endif

                    <form method="POST"
                    action="/profile/update">

                        @csrf

                        <div class="grid grid-cols-2 gap-8">

                            <div>

                                <label class="font-bold block mb-3">

                                    Full Name

                                </label>

                                <input
                                type="text"
                                name="name"
                                value="{{ auth()->user()->name }}"
                                class="w-full border rounded-xl p-4">

                            </div>

                            <div>

                                <label class="font-bold block mb-3">

                                    Email

                                </label>

                                <input
                                type="email"
                                name="email"
                                value="{{ auth()->user()->email }}"
                                class="w-full border rounded-xl p-4">

                            </div>

                        </div>

                        <div class="mt-8">

                            <button
                            class="bg-red-500 hover:bg-red-600 text-white px-10 py-4 rounded-xl">

                                Update Profile

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection