<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="min-h-screen bg-gradient-to-br from-orange-100 via-red-50 to-pink-100 flex items-center justify-center p-5">

    <div class="w-full max-w-md">

        <div class="bg-white rounded-3xl shadow-2xl p-10">

            <div class="text-center mb-8">

                
                <input type="hidden" name="previous_url" value="{{ $previous }}">
                <h1 class="text-4xl font-extrabold text-gray-800 mb-2">

                    User Login

                </h1>

                <p class="text-gray-500 text-sm">

                    Login to continue ordering food

                </p>

            </div>

            <form method="POST" action="{{ route('login.submit') }}">

                @csrf

                <div class="mb-5">

                    <label class="text-gray-700 text-sm font-semibold mb-2 block">

                        Email

                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        class="w-full border border-gray-200 p-4 rounded-2xl outline-none focus:border-red-400">

                </div>

                <div class="mb-7">

                    <label class="text-gray-700 text-sm font-semibold mb-2 block">

                        Password

                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        class="w-full border border-gray-200 p-4 rounded-2xl outline-none focus:border-red-400">

                </div>

                <button
                    class="w-full bg-gradient-to-r from-red-500 to-orange-500 hover:scale-[1.02] transition-all text-white font-bold py-4 rounded-2xl shadow-lg">

                    Login Now

                </button>

            </form>

        </div>

    </div>

@if(session('success'))

<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('success') }}',
        confirmButtonColor: '#111827'
    });
</script>

@endif

@if(session('error'))

<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('error') }}',
        confirmButtonColor: '#E63946'
    });
</script>

@endif

</body>

</html>