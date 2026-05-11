<div class="w-64 h-screen bg-gray-900 fixed text-white overflow-y-auto">

    <!-- LOGO -->

    <div class="p-6 border-b border-gray-700">

        <h1 class="text-xl font-bold">

            {{ auth()->user()->name }} Panel

        </h1>

        

    </div>





    <!-- SUPER ADMIN SIDEBAR -->

    @if(auth()->user()->role == 'super_admin')

    <ul class="mt-6">

        <li>

            <a href="/admin/dashboard"
            class="block px-6 py-4 hover:bg-gray-800 transition">

                Dashboard

            </a>

        </li>

        <li>

            <a href="/admin/restaurants"
            class="block px-6 py-4 hover:bg-gray-800 transition">

                Restaurants

            </a>

        </li>

        <li>

            <a href="/admin/vendor"
            class="block px-6 py-4 hover:bg-gray-800 transition">

                Vendors

            </a>

        </li>

        <li>

            <a href="/admin/categories"
            class="block px-6 py-4 hover:bg-gray-800 transition">

                Categories

            </a>

        </li>

        <li>

            <a href="/admin/products"
            class="block px-6 py-4 hover:bg-gray-800 transition">

                Products

            </a>

        </li>

        <li>

            <a href="/admin/orders"
            class="block px-6 py-4 hover:bg-gray-800 transition">

                Orders

            </a>

        </li>

        <li>

            <a href="/admin/users"
            class="block px-6 py-4 hover:bg-gray-800 transition">

                Users

            </a>

        </li>

    </ul>

    @endif






    <!-- RESTAURANT ADMIN SIDEBAR -->

    @if(auth()->user()->role == 'restaurant_admin')

    <ul class="mt-6">

        <li>

            <a href="/restaurant/dashboard"
            class="block px-6 py-4 hover:bg-gray-800 transition">

                Dashboard

            </a>

        </li>

        <li>

            <a href="/restaurant/products"
            class="block px-6 py-4 hover:bg-gray-800 transition">

                My Products

            </a>

        </li>

       

        <li>

            <a href="/restaurant/orders"
            class="block px-6 py-4 hover:bg-gray-800 transition">

                Orders

            </a>

        </li>

        <li>

            <a href="/restaurant/profile"
            class="block px-6 py-4 hover:bg-gray-800 transition">

                Restaurant Profile

            </a>

        </li>

    </ul>

    @endif


@if(auth()->user()->role == 'vendor')

<ul class="mt-6">

    <li>

        <a href="/vendor/dashboard"
        class="block px-6 py-4 hover:bg-gray-800 transition">

            Dashboard

        </a>

    </li>

    <li>

        <a href="/vendor/products"
        class="block px-6 py-4 hover:bg-gray-800 transition">

            My Products

        </a>

    </li>

</ul>

@endif









    <!-- LOGOUT -->

    <div class="absolute bottom-0 w-full border-t border-gray-700">

        <form method="POST"
        action="{{ route('logout') }}">

            @csrf

            <button
            class="w-full text-left px-6 py-4 hover:bg-red-500 transition">

                Logout

            </button>

        </form>

    </div>

</div>