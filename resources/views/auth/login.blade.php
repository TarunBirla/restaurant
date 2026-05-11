<!DOCTYPE html>
<html>

<head>

    <title>User Login</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">

    <div class="bg-white p-10 rounded shadow w-full max-w-md">

        <h1 class="text-3xl font-bold text-center mb-8">

            User Login

        </h1>

        <!-- <form method="POST" action="/login-user"> -->
            <form method="POST" action="{{ route('login.submit') }}">

            @csrf

            <div class="mb-5">

                <label>Email</label>

                <input type="email"
                name="email"
                class="w-full border p-3 rounded">

            </div>

            <div class="mb-5">

                <label>Password</label>

                <input type="password"
                name="password"
                class="w-full border p-3 rounded">

            </div>

            <button
            class="w-full bg-red-500 text-white p-3 rounded">

                Login

            </button>

        </form>

    </div>

</div>

</body>
</html>