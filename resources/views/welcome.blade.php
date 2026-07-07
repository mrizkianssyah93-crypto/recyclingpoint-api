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

        <a href="/" class="hover:text-green-200">
            Home
        </a>

        <a href="{{ route('waste-prices') }}" class="hover:text-green-200">
            Waste Prices
        </a>

        <a href="{{ route('waste-banks') }}" class="hover:text-green-200">
            Waste Banks
        </a>

        <a href="{{ route('login') }}" class="hover:text-green-200">
            Login
        </a>

        <a href="{{ route('register') }}" class="hover:text-green-200">
            Register
        </a>

    </div>

</div>


</nav>

<section class="max-w-7xl mx-auto px-8 py-20">


<div class="grid md:grid-cols-2 gap-12 items-center">

    <div>

        <h1 class="text-6xl font-bold text-green-700 leading-tight">

            Recycling Point

        </h1>

        <h2 class="text-3xl font-semibold text-gray-700 mt-4">

            Smart Waste Management System

        </h2>

        <p class="text-xl text-gray-500 mt-6 leading-relaxed">

            Kelola sampah daur ulang menjadi nilai ekonomi,
            poin reward, dan kontribusi nyata terhadap
            lingkungan yang lebih bersih dan berkelanjutan.

        </p>

        <div class="flex gap-4 mt-10">

            <a href="{{ route('register') }}"
            class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-2xl font-bold transition">

                Get Started

            </a>

            <a href="{{ route('waste-prices') }}"
            class="border-2 border-green-600 text-green-700 px-8 py-4 rounded-2xl font-bold hover:bg-green-50 transition">

                View Waste Prices

            </a>

        </div>

    </div>

    <div>

        <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden h-[360px]">

            <div id="journal-slider" class="h-full">

                <div class="journal-item h-full p-8 flex flex-col justify-between">

                    <div>

                        <div class="text-sm font-semibold text-green-600 mb-3">
                            Journal Publication
                        </div>

                        <h3 class="text-2xl font-bold text-green-700 leading-snug">

                            Perancangan Sistem Pengelolaan Bank Sampah Berbasis Android Dengan Metode Waterfall

                        </h3>

                        <p class="text-gray-500 mt-4">

                            Djaksana & Ardana (2025)

                        </p>

                    </div>

                    <a
                        href="https://doi.org/10.52005/jursistekni.v7i3.511"
                        target="_blank"
                        class="font-semibold text-green-700 hover:text-green-900"
                    >

                        Baca Publikasi →

                    </a>

                </div>

                <div class="journal-item hidden h-full p-8 flex flex-col justify-between">

                    <div>

                        <div class="text-sm font-semibold text-green-600 mb-3">
                            Journal Publication
                        </div>

                        <h3 class="text-2xl font-bold text-green-700 leading-snug">

                            Design of Website-Based Waste Management System using Laravel Framework in RT 06 Kramat Jati

                        </h3>

                        <p class="text-gray-500 mt-4">

                            Eka Saputra & Isa (2025)

                        </p>

                    </div>

                    <a
                        href="https://doi.org/10.35314/ga9s2g90"
                        target="_blank"
                        class="font-semibold text-green-700 hover:text-green-900"
                    >

                        Baca Publikasi →

                    </a>

                </div>

                <div class="journal-item hidden h-full p-8 flex flex-col justify-between">

                    <div>

                        <div class="text-sm font-semibold text-green-600 mb-3">
                            Journal Publication
                        </div>

                        <h3 class="text-2xl font-bold text-green-700 leading-snug">

                            Development of Waste Fee Management System for Village-Owned Enterprise Using Agile Approach

                        </h3>

                        <p class="text-gray-500 mt-4">

                            Isnaeni, Putro & Lisda (2025)

                        </p>

                    </div>

                    <a
                        href="https://doi.org/10.35746/jtim.v7i4.822"
                        target="_blank"
                        class="font-semibold text-green-700 hover:text-green-900"
                    >

                        Baca Publikasi →

                    </a>

                </div>

                <div class="journal-item hidden h-full p-8 flex flex-col justify-between">

                    <div>

                        <div class="text-sm font-semibold text-green-600 mb-3">
                            Journal Publication
                        </div>

                        <h3 class="text-2xl font-bold text-green-700 leading-snug">

                            Desain dan Pengembangan Aplikasi Mobile Daur Ulang Sampah di Kota Surabaya dengan Metode Design Thinking

                        </h3>

                        <p class="text-gray-500 mt-4">

                            Virginia, Kamisutara & Falani (2025)

                        </p>

                    </div>

                    <a
                        href="https://doi.org/10.26905/jasiek.v7i1.15295"
                        target="_blank"
                        class="font-semibold text-green-700 hover:text-green-900"
                    >

                        Baca Publikasi →

                    </a>

                </div>

            </div>

            <div class="absolute bottom-5 right-5 flex gap-2">

                <button
                    onclick="prevJournal()"
                    class="w-10 h-10 rounded-full bg-green-100 hover:bg-green-200"
                >
                    ←
                </button>

                <button
                    onclick="nextJournal()"
                    class="w-10 h-10 rounded-full bg-green-100 hover:bg-green-200"
                >
                    →
                </button>

            </div>

        </div>

    </div>

</div>

</section>

<section class="max-w-7xl mx-auto px-8 pb-20">

<h2 class="text-4xl font-bold text-center text-gray-800 mb-12">

    Main Features

</h2>

<div class="grid md:grid-cols-3 gap-8">

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <div class="text-5xl mb-4">
            ♻️
        </div>

        <h3 class="text-2xl font-bold mb-3">
            Waste Recycling
        </h3>

        <p class="text-gray-500">
            Kelola dan setor sampah berdasarkan kategori yang tersedia.
        </p>

    </div>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <div class="text-5xl mb-4">
            🚚
        </div>

        <h3 class="text-2xl font-bold mb-3">
            Pickup Request
        </h3>

        <p class="text-gray-500">
            Ajukan penjemputan sampah langsung dari lokasi Anda.
        </p>

    </div>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <div class="text-5xl mb-4">
            🎁
        </div>

        <h3 class="text-2xl font-bold mb-3">
            Redeem Voucher
        </h3>

        <p class="text-gray-500">
            Tukarkan poin menjadi berbagai voucher menarik.
        </p>

    </div>

</div>


</section>

<footer class="bg-green-700 text-white">


<div class="max-w-7xl mx-auto px-8 py-8 text-center">

    <h3 class="text-2xl font-bold">

        Recycling Point

    </h3>

    <p class="text-green-100 mt-2">

        Smart Waste Management System

    </p>

    <p class="text-green-100 mt-4 text-sm">

        © 2026 Recycling Point. All Rights Reserved.

    </p>

</div>

</footer>

<script>

let currentJournal = 0;

const journals = document.querySelectorAll('.journal-item');

function showJournal(index)
{
    journals.forEach(item => item.classList.add('hidden'));
    journals[index].classList.remove('hidden');
}

function nextJournal()
{
    currentJournal++;

    if(currentJournal >= journals.length)
    {
        currentJournal = 0;
    }

    showJournal(currentJournal);
}

function prevJournal()
{
    currentJournal--;

    if(currentJournal < 0)
    {
        currentJournal = journals.length - 1;
    }

    showJournal(currentJournal);
}

setInterval(() => {

    nextJournal();

}, 5000);

</script>

@endsection
