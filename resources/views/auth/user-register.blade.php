<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Register</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="min-h-screen bg-gradient-to-br from-green-100 via-emerald-50 to-teal-100 flex items-center justify-center p-5">

    <div class="w-full max-w-md">

        <div class="bg-white rounded-3xl shadow-2xl p-10">

            <div class="text-center mb-8">


                <h1 class="text-4xl font-extrabold text-gray-800 mb-2">

                    Create Account

                </h1>

                <p class="text-gray-500 text-sm">

                    Register and start ordering delicious food

                </p>

            </div>

            <form method="POST" action="/register-user">

                @csrf

                <div class="mb-5">

                    <label class="text-gray-700 text-sm font-semibold mb-2 block">

                        Full Name

                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Enter full name"
                        class="w-full border border-gray-200 p-4 rounded-2xl outline-none focus:border-green-400">

                </div>

                <div class="mb-5">

                    <label class="text-gray-700 text-sm font-semibold mb-2 block">

                        Email Address

                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter email address"
                        class="w-full border border-gray-200 p-4 rounded-2xl outline-none focus:border-green-400">

                </div>

                <div class="mb-7">

                    <label class="text-gray-700 text-sm font-semibold mb-2 block">

                        Password

                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Create password"
                        class="w-full border border-gray-200 p-4 rounded-2xl outline-none focus:border-green-400">

                </div>

                <button
                    class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:scale-[1.02] transition-all text-white font-bold py-4 rounded-2xl shadow-lg">

                    Create Account

                </button>

            </form>

        </div>

    </div>

</body>

</html>