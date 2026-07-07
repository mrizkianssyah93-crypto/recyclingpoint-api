@extends('layouts.app')

@section('content')

<div class="p-10">

    <h1 class="text-4xl font-bold text-[#14213d] mb-6">
        Store Transactions
    </h1>

    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-green-600 text-white">

                <tr>
                    <th class="p-4 text-left">User</th>
                    <th class="p-4 text-left">Waste Type</th>
                    <th class="p-4 text-left">Weight</th>
                    <th class="p-4 text-left">Total Price</th>
                    <th class="p-4 text-left">Points</th>
                    <th class="p-4 text-left">Date</th>
                </tr>

            </thead>

            <tbody>

                @foreach($transactions as $item)

                <tr class="border-b">

                    <td class="p-4">
                        {{ $item->user?->nama ?? '-' }}
                    </td>

                    <td class="p-4">
                        {{ $item->category?->nama_kategori ?? '-' }}
                    </td>

                    <td class="p-4">
                        {{ $item->berat }} KG
                    </td>

                    <td class="p-4 text-green-600 font-bold">
                        Rp {{ number_format($item->total_harga) }}
                    </td>

                    <td class="p-4">
                        {{ number_format($item->total_poin) }}
                    </td>

                    <td class="p-4">
                        {{ $item->created_at->format('d M Y H:i') }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection