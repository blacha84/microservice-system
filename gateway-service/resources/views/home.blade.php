@extends('layouts.app')

@section('content')

    <section class="py-20">

        <div class="max-w-6xl mx-auto px-6 text-center">

            <h1 class="text-5xl font-bold mb-6">
                Smart Parking System
            </h1>

            <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-10">
                A simple parking management platform demonstrating microservice architecture
                built with Laravel, RabbitMQ and Go services.
            </p>

            <div class="flex justify-center gap-4">

                @guest

                    <a
                        href="/register"
                        class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold shadow hover:bg-blue-700">

                        Get started

                    </a>

                @endguest


                @auth

                    <a
                        href="/dashboard"
                        class="px-8 py-3 bg-red-600 text-white rounded-lg font-semibold shadow hover:bg-red-700">

                        Go to dashboard

                    </a>

                @endauth

            </div>

        </div>

    </section>



    <section class="py-16 bg-gray-100">

        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-8">


            <div class="bg-white p-8 rounded-xl shadow">

                <div class="text-4xl mb-4">
                    🚗
                </div>

                <h3 class="text-xl font-semibold mb-2">
                    User Registration
                </h3>

                <p class="text-gray-600">
                    Drivers can create accounts and gain access to the parking system.
                </p>

            </div>


            <div class="bg-white p-8 rounded-xl shadow">

                <div class="text-4xl mb-4">
                    ⚡
                </div>

                <h3 class="text-xl font-semibold mb-2">
                    Event-Driven Architecture
                </h3>

                <p class="text-gray-600">
                    Laravel publishes events to RabbitMQ that are consumed by Go microservices.
                </p>

            </div>


            <div class="bg-white p-8 rounded-xl shadow">

                <div class="text-4xl mb-4">
                    📈
                </div>

                <h3 class="text-xl font-semibold mb-2">
                    Scalable System
                </h3>

                <p class="text-gray-600">
                    Each service can scale independently in a distributed architecture.
                </p>

            </div>


        </div>

    </section>

@endsection
