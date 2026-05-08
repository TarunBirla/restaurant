<!DOCTYPE html>
<html>
<head>

    <title>Restaurant System</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

<div class="flex">

    @include('layouts.sidebar')

    <div class="ml-64 w-full">

        @include('layouts.navbar')

        <div class="p-6">

            @if(session('success'))

            <div class="bg-green-500 text-white p-3 rounded mb-5">
                {{ session('success') }}
            </div>

            @endif

            @yield('content')

        </div>

    </div>

</div>

</body>
</html>