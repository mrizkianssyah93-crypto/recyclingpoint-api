@extends('layouts.app')

@section('content')

<div class="p-10">

    <div class="flex justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-green-700">
                Redeem Voucher
            </h1>

            <p class="text-gray-500">
                Exchange your points
            </p>

        </div>

        <div class="bg-green-600 text-white px-6 py-3 rounded-2xl">

            My Points :
            {{ auth()->user()->poin }}

        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach($vouchers as $voucher)

        <div class="bg-white rounded-2xl shadow p-6">

            <h2 class="text-2xl font-bold mb-2">
                {{ $voucher->nama }}
            </h2>

            <p class="text-gray-500 mb-4">
                {{ $voucher->kategori }}
            </p>

            <div class="text-green-600 text-3xl font-bold mb-6">

                {{ $voucher->poin }} Points

            </div>

            <form
                action="{{ route('vouchers.redeem', $voucher->id) }}"
                method="POST"
            >

                @csrf

                <button
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl"
                >

                    Redeem

                </button>

            </form>

        </div>

        @endforeach

    </div>

</div>

@endsection