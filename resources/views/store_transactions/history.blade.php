@extends('layouts.app')

@section('content')

<div class="p-10 bg-[#f7f9fb] min-h-screen">

    <!-- HEADER -->

    <div class="flex items-center gap-4 mb-8">

        <img
            src="{{ asset('images/Pickupsummary.png') }}"
            class="w-14 h-14 object-contain"
        >

        <div>

            <h1 class="text-4xl font-bold text-[#14213d]">
                Transaction History
            </h1>

            <p class="text-gray-500 mt-1">
                Your completed recycling transactions
            </p>

        </div>

    </div>

    <!-- TABLE -->

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-green-600 text-white">

                    <tr>

                        <th class="p-5 text-left">
                            Waste Type
                        </th>

                        <th class="p-5 text-left">
                            Weight
                        </th>

                        <th class="p-5 text-left">
                            Total Price
                        </th>

                        <th class="p-5 text-left">
                            Earn Points
                        </th>

                        <th class="p-5 text-left">
                            Transaction Date
                        </th>

                        <th class="p-5 text-left">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($transactions as $item)

                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                        <!-- WASTE TYPE -->

                        <td class="p-5">

                            <div class="font-semibold text-[#14213d]">

                                {{ $item->category->nama_kategori ?? '-' }}

                            </div>

                        </td>

                        <!-- WEIGHT -->

                        <td class="p-5 text-gray-700">

                            {{ $item->berat }} KG

                        </td>

                        <!-- TOTAL PRICE -->

                        <td class="p-5">

                            <span class="font-bold text-green-600">

                                Rp {{ number_format($item->total_harga) }}

                            </span>

                        </td>

                        <!-- EARN POINT -->

                        <td class="p-5">

                            <span class="font-bold text-[#14213d]">

                                +{{ number_format($item->total_poin) }} Points

                            </span>

                        </td>

                        <!-- DATE -->

                        <td class="p-5 text-gray-500">

                            {{ $item->created_at->format('d M Y H:i') }}

                        </td>

                        <!-- STATUS -->

                        <td class="p-5">

                            <span class="bg-green-100 text-green-600 px-4 py-2 rounded-full text-sm font-semibold">
                                Completed
                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="6"
                            class="p-10 text-center text-gray-400"
                        >
                            No transaction history yet
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection