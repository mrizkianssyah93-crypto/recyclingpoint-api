@extends('layouts.app')

@section('content')

    <div class="py-8 bg-gray-100 min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-green-700">
                    Recycling Point Dashboard
                </h1>

                <p class="text-gray-500 mt-2">
                    Welcome back, {{ auth()->user()->nama }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white p-6 rounded-2xl shadow">
                    <h2 class="text-gray-500">
                        Total Users
                    </h2>

                    <p class="text-4xl font-bold text-green-600 mt-2">
                        {{ $totalUsers }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow">
                    <h2 class="text-gray-500">
                        Waste Categories
                    </h2>

                    <p class="text-4xl font-bold text-blue-600 mt-2">
                        {{ $totalCategories }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow">
                    <h2 class="text-gray-500">
                        Transactions
                    </h2>

                    <p class="text-4xl font-bold text-yellow-500 mt-2">
                        {{ $totalTransactions }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow">
                    <h2 class="text-gray-500">
                        Pickup Requests
                    </h2>

                    <p class="text-4xl font-bold text-red-500 mt-2">
                        {{ $totalPickups }}
                    </p>
                </div>

            </div>

            <div class="bg-white rounded-2xl shadow mt-8 p-6">

                <h2 class="text-2xl font-bold mb-4">
                    Account Information
                </h2>

                <div class="space-y-2">

                    <p>
                        <strong>Name:</strong>
                        {{ auth()->user()->nama }}
                    </p>

                    <p>
                        <strong>Username:</strong>
                        {{ auth()->user()->username }}
                    </p>

                    <p>
                        <strong>Role:</strong>
                        {{ auth()->user()->role }}
                    </p>

                    <p>
                        <strong>Total Points:</strong>
                        {{ auth()->user()->poin }}
                    </p>

                </div>

            </div>

        </div>

    </div>

@endsection