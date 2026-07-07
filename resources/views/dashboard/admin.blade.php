@extends('layouts.app')

@section('content')

<div class="p-10">

    <h1 class="text-4xl font-bold text-green-700 mb-2">
        Admin Dashboard
    </h1>

    <p class="text-gray-500 mb-8">
        Recycling Point Administration Panel
    </p>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-500">
                Users
            </p>
            <h2 class="text-4xl font-bold text-green-600 mt-2">
                {{ $totalUsers }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-500">
                Waste Categories
            </p>
            <h2 class="text-4xl font-bold text-green-600 mt-2">
                {{ $totalCategories }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-500">
                Waste Banks
            </p>
            <h2 class="text-4xl font-bold text-green-600 mt-2">
                {{ $totalWasteBanks }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-500">
                Transactions
            </p>
            <h2 class="text-4xl font-bold text-green-600 mt-2">
                {{ $totalTransactions }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-500">
                Pickup Requests
            </p>
            <h2 class="text-4xl font-bold text-green-600 mt-2">
                {{ $totalPickups }}
            </h2>
        </div>

    </div>

</div>

@endsection