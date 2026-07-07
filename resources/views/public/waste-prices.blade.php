@extends('layouts.guest')

@section('content')

<nav class="bg-green-700 text-white shadow">

    <div class="max-w-7xl mx-auto px-8 py-5 flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold">
                Recycling Point
            </h1>

            <p class="text-green-100 text-sm">
                Smart Waste Management System
            </p>

        </div>

        <div class="flex gap-8 font-medium">

            <a href="/">Home</a>

            <a href="{{ route('waste-prices') }}">
                Waste Prices
            </a>

            <a href="{{ route('waste-banks') }}">
                Waste Banks
            </a>

            <a href="{{ route('login') }}">
                Login
            </a>

            <a href="{{ route('register') }}">
                Register
            </a>

        </div>

    </div>

</nav>

<div class="max-w-7xl mx-auto px-8 py-16">

    <div class="text-center mb-12">

        <h1 class="text-5xl font-bold text-green-700">
            Waste Prices
        </h1>

        <p class="text-xl text-gray-500 mt-4">
            Daftar harga sampah dan reward point yang dapat diperoleh
            pada Recycling Point.
        </p>

    </div>

    <div class="grid md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white rounded-3xl shadow p-6">

            <div class="text-4xl mb-3">
                ♻️
            </div>

            <h3 class="font-bold text-xl">
                Waste Categories
            </h3>

            <p class="text-gray-500 mt-2">
                Berbagai kategori sampah yang dapat didaur ulang.
            </p>

        </div>

        <div class="bg-white rounded-3xl shadow p-6">

            <div class="text-4xl mb-3">
                💰
            </div>

            <h3 class="font-bold text-xl">
                Market Value
            </h3>

            <p class="text-gray-500 mt-2">
                Harga per kilogram mengikuti nilai kategori sampah.
            </p>

        </div>

        <div class="bg-white rounded-3xl shadow p-6">

            <div class="text-4xl mb-3">
                🎁
            </div>

            <h3 class="font-bold text-xl">
                Reward Points
            </h3>

            <p class="text-gray-500 mt-2">
                Point dapat ditukar dengan voucher di Recycling Point.
            </p>

        </div>

    </div>

    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <table class="w-full">

            <thead>

                <tr class="bg-green-600 text-white">

                    <th class="p-5 text-left">
                        Waste Category
                    </th>

                    <th class="p-5 text-left">
                        Main Category
                    </th>

                    <th class="p-5 text-left">
                        Price / KG
                    </th>

                    <th class="p-5 text-left">
                        Points / KG
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($categories as $category)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-5 font-medium">
                        {{ $category->nama_kategori }}
                    </td>

                    <td class="p-5">
                        {{ $category->main_category }}
                    </td>

                    <td class="p-5">
                        Rp {{ number_format($category->harga_per_kg,0,',','.') }}
                    </td>

                    <td class="p-5 font-semibold text-green-700">
                        {{ number_format($category->poin_per_kg) }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <div class="mt-10 bg-green-50 border border-green-200 rounded-3xl p-6">

        <h3 class="text-xl font-bold text-green-700 mb-3">
            Cara Perhitungan Point
        </h3>

        <p class="text-gray-700">
            Pada Recycling Point, reward point dihitung berdasarkan
            nilai jual sampah.
        </p>

        <p class="mt-2 font-semibold text-green-700">
            1 Point = Rp 100
        </p>

        <p class="mt-2 text-gray-600">
            Contoh:
            Sampah Tembaga bernilai Rp 175.000/KG,
            maka pengguna memperoleh 1.750 Point/KG.
        </p>

    </div>

</div>

<footer class="bg-green-700 text-white mt-20">

    <div class="max-w-7xl mx-auto px-8 py-8 text-center">

        <h3 class="text-2xl font-bold">
            Recycling Point
        </h3>

        <p class="text-green-100 mt-2">
            Smart Waste Management System
        </p>

    </div>

</footer>

@endsection