@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-center py-16 px-4">

        <div class="bg-white shadow-xl rounded-xl p-10 w-full max-w-md">

            <h1 class="text-3xl font-bold mb-6 text-center">
                Set new password
            </h1>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-lg text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST"
                  action="{{ route('password.update') }}"
                  class="space-y-6">

                @csrf

                <input type="hidden"
                       name="token"
                       value="{{ $token }}">

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        required
                        class="w-full rounded-lg px-4 py-2 border border-gray-300
                    focus:ring-2 focus:ring-blue-500"
                    />

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        New password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full rounded-lg px-4 py-2 border border-gray-300
                    focus:ring-2 focus:ring-blue-500"
                    />

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Confirm password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        class="w-full rounded-lg px-4 py-2 border border-gray-300
                    focus:ring-2 focus:ring-blue-500"
                    />

                </div>

                <button
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold shadow hover:bg-blue-700 transition">

                    Reset password

                </button>

            </form>

        </div>

    </div>

@endsection
