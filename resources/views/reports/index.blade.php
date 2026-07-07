@extends('layouts.app')

@section('content')

<div class="p-10">

    <h1 class="text-4xl font-bold text-green-700 mb-2">
        Reports
    </h1>

    <p class="text-gray-500 mb-8">
        Transaction, User Points and Waste Collection Reports
    </p>

    <div class="bg-white rounded-2xl shadow p-6 mb-8">

        <form
            method="GET"
            action="{{ route('reports') }}"
            class="flex gap-4"
        >

            <select
                name="type"
                class="border rounded-xl p-3 flex-1"
                required
            >
                <option value="">
                    Select Report
                </option>

                <option
                    value="transaction"
                    {{ request('type') == 'transaction' ? 'selected' : '' }}
                >
                    Transaction Report
                </option>

                <option
                    value="points"
                    {{ request('type') == 'points' ? 'selected' : '' }}
                >
                    User Points Report
                </option>

                <option
                    value="waste"
                    {{ request('type') == 'waste' ? 'selected' : '' }}
                >
                    Waste Collection Report
                </option>

            </select>

            <button
                type="submit"
                class="bg-blue-600 text-white px-6 rounded-xl"
            >
                View Report
            </button>

            @if(request('type'))

            <a
                href="{{ route('reports.export',['type'=>request('type')]) }}"
                class="bg-green-600 text-white px-6 py-3 rounded-xl"
            >
                Export CSV
            </a>

            @endif

        </form>

    </div>

    {{-- TRANSACTION REPORT --}}

    @if($type == 'transaction')

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="bg-green-600 text-white p-4 font-bold">
            Transaction Report
        </div>

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">User</th>
                    <th class="p-4 text-left">Category</th>
                    <th class="p-4 text-left">Weight</th>
                    <th class="p-4 text-left">Total Price</th>
                    <th class="p-4 text-left">Points</th>

                </tr>

            </thead>

            <tbody>

                @foreach($transactions as $item)

                <tr class="border-b">

                    <td class="p-4">
                        {{ $item->user->nama ?? '-' }}
                    </td>

                    <td class="p-4">
                        {{ $item->category->nama_kategori ?? '-' }}
                    </td>

                    <td class="p-4">
                        {{ $item->berat }} KG
                    </td>

                    <td class="p-4">
                        Rp {{ number_format($item->total_harga) }}
                    </td>

                    <td class="p-4 text-green-600 font-bold">
                        {{ $item->total_poin }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    @endif

    {{-- USER POINT REPORT --}}

    @if($type == 'points')

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="bg-blue-600 text-white p-4 font-bold">
            User Points Report
        </div>

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">Name</th>
                    <th class="p-4 text-left">Username</th>
                    <th class="p-4 text-left">Points</th>

                </tr>

            </thead>

            <tbody>

                @foreach($users as $user)

                <tr class="border-b">

                    <td class="p-4">
                        {{ $user->nama }}
                    </td>

                    <td class="p-4">
                        {{ $user->username }}
                    </td>

                    <td class="p-4 text-green-600 font-bold">
                        {{ $user->poin }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    @endif

    {{-- WASTE REPORT --}}

    @if($type == 'waste')

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="bg-yellow-500 text-white p-4 font-bold">
            Waste Collection Report
        </div>

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">
                        Category
                    </th>

                    <th class="p-4 text-left">
                        Points / KG
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($wasteCategories as $item)

                <tr class="border-b">

                    <td class="p-4">
                        {{ $item->nama_kategori }}
                    </td>

                    <td class="p-4">
                        {{ $item->poin_per_kg }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    @endif

</div>

@endsection