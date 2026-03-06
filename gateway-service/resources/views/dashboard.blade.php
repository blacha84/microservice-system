@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-center py-20 px-4">

        <div class="bg-white shadow-xl rounded-xl p-10 w-full max-w-md text-center">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-3xl font-bold mb-4">
                Dashboard
            </h1>

            <p class="text-gray-600 mb-6">
                Welcome {{ auth()->user()->name }}.
            </p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="px-8 py-3 bg-red-600 text-white rounded-lg font-semibold shadow hover:bg-red-700 transition">

                    Logout

                </button>

            </form>

        </div>

    </div>

@endsection
