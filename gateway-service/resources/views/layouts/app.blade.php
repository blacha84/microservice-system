<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Smart Parking System</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gray-50 text-gray-800">

<nav class="bg-white shadow">

    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <a href="/" class="font-bold text-xl text-blue-600">
            Parking System
        </a>

        <div class="flex gap-6 items-center">

            <a href="/" class="hover:text-blue-600">
                Home
            </a>

            @guest

                <a href="/register" class="hover:text-blue-600">
                    Register
                </a>

                <a href="/login"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Login
                </a>

            @endguest


            @auth

                <span class="text-gray-600 text-sm">
                    Hello, <span class="font-semibold">{{ auth()->user()->name }}</span>
                </span>

                <a href="/dashboard" class="hover:text-blue-600">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">

                        Logout

                    </button>

                </form>

            @endauth

        </div>

    </div>

</nav>


<main>

    @yield('content')

</main>


<footer class="mt-20 py-8 text-center text-gray-500 text-sm">

    Smart Parking System demo – Laravel + Go microservices

</footer>

</body>

</html>
