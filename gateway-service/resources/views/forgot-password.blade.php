@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-center py-16 px-4">

        <div class="bg-white shadow-xl rounded-xl p-10 w-full max-w-md">

            <h1 class="text-3xl font-bold mb-6 text-center">
                Reset password
            </h1>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST"
                  action="{{ route('password.send') }}"
                  class="space-y-6">

                @csrf

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

                <button
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold shadow hover:bg-blue-700 transition">

                    Send reset link

                </button>

            </form>

        </div>

    </div>

@endsection
