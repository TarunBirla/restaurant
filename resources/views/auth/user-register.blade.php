<!DOCTYPE html>
<html>

<head>

    <title>User Register</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">

    <div class="bg-white p-10 rounded shadow w-full max-w-md">

        <h1 class="text-3xl font-bold mb-8 text-center">

            User Register

        </h1>

        <form method="POST" action="/register-user">

            @csrf

            <div class="mb-5">

                <label>Name</label>

                <input type="text"
                name="name"
                class="w-full border p-3 rounded">

            </div>

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
            class="w-full bg-green-500 text-white p-3 rounded">

                Register

            </button>

        </form>

    </div>

</div>

</body>
</html>