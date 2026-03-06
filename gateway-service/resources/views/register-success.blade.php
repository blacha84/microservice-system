@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-center py-20 px-4">

        <div class="bg-white shadow-xl rounded-xl p-10 w-full max-w-md text-center">

            <div class="text-green-500 text-5xl mb-4">
                ✔
            </div>

            <h1 class="text-3xl font-bold mb-4">
                Registration successful
            </h1>

            <p class="text-gray-600 mb-6">
                Your account has been created.
                Please check your email and click the activation link to activate your account.
            </p>

            <a
                href="/login"
                class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold shadow hover:bg-blue-700 transition">

                Go to login

            </a>

        </div>

    </div>

@endsection
