@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-center py-16 px-4">

        <div class="bg-white shadow-xl rounded-xl p-10 w-full max-w-md">

            <h1 class="text-3xl font-bold mb-6 text-center">
                Create account
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

            <form method="POST"
                  action="{{ route('register') }}"
                  novalidate
                  class="space-y-6">

                @csrf


                <div>

                    <label class="block text-sm font-medium mb-2">
                        Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full rounded-lg px-4 py-2 border
@error('name') border-red-500 @else border-gray-300 @enderror
focus:ring-2 focus:ring-blue-500"
                    />

                    @error('name')
                    <p class="text-sm text-red-600 mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>



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



                <div>

                    <label class="block text-sm font-medium mb-2">
                        Confirm password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full rounded-lg px-4 py-2 border
@error('password_confirmation') border-red-500 @else border-gray-300 @enderror
focus:ring-2 focus:ring-blue-500"
                    />

                    @error('password_confirmation')
                    <p class="text-sm text-red-600 mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>



                <div class="pt-2 flex justify-center">

                    <div
                        class="g-recaptcha"
                        data-sitekey="{{ config('services.recaptcha.site_key') }}">
                    </div>

                </div>

                @error('g-recaptcha-response')
                <p class="text-sm text-red-600 text-center">
                    {{ $message }}
                </p>
                @enderror



                <button
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold shadow hover:bg-blue-700 transition">

                    Register

                </button>


                <p class="text-sm text-gray-500 text-center">

                    Already have an account?

                    <a href="/login" class="text-blue-600 hover:underline">
                        Login
                    </a>

                </p>


            </form>

            <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        </div>

    </div>


    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endsection
