@extends('layouts.app')

@section('content')

    <h1 class="text-3xl font-bold mb-8">
        Dashboard
    </h1>

    <div class="grid grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="font-semibold text-lg mb-2">
                User information
            </h2>

            <p class="text-sm text-gray-600">
                Name: {{ $user->name }}
            </p>

            <p class="text-sm text-gray-600">
                Email: {{ $user->email }}
            </p>

            <p class="text-sm text-gray-600">
                Registered: {{ $user->created_at->format('Y-m-d') }}
            </p>

        </div>

        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="font-semibold text-lg mb-2">
                Account status
            </h2>

            <p class="text-sm text-green-600">
                Active
            </p>

        </div>

        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="font-semibold text-lg mb-2">
                Microservices
            </h2>

            <p class="text-sm text-gray-600">
                Notification service connected
            </p>

        </div>

    </div>

@endsection
