@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-center py-16 px-4">

        <div class="bg-white shadow-xl rounded-xl p-10 w-full max-w-md">

            <h1 class="text-3xl font-bold mb-6 text-center">
                Login
            </h1>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-lg text-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('info'))
                <div class="bg-blue-100 text-blue-700 p-3 mb-4 rounded-lg text-sm">
                    {{ session('info') }}
                </div>
            @endif

            <form method="POST"
                  action="{{ route('login') }}"
                  novalidate
                  class="space-y-6">

                @csrf

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full rounded-lg px-4 py-2 border
@error('email') border-red-500 @else border-gray-300 @enderror
focus:ring-2 focus:ring-blue-500"
                    />

                    @error('email')
                    <p class="text-sm text-red-600 mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                <div>

                    <label class="block text-sm font-medium mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full rounded-lg px-4 py-2 border
@error('password') border-red-500 @else border-gray-300 @enderror
focus:ring-2 focus:ring-blue-500"
                    />

                    @error('password')
                    <p class="text-sm text-red-600 mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                <button
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold shadow hover:bg-blue-700 transition">

                    Login

                </button>


                <p class="text-sm text-gray-500 text-center">

                    Don't have an account?

                    <a href="/register" class="text-blue-600 hover:underline">
                        Register
                    </a>

                </p>

            </form>

        </div>

    </div>

@endsection
