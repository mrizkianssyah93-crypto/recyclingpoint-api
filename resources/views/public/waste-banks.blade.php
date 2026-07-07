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
            Waste Banks Active
        </h1>

        <p class="text-xl text-gray-500 mt-4">
            Temukan lokasi Waste Bank yang bekerja sama dengan Recycling Point.
        </p>

    </div>

    <div
        id="map"
        class="w-full h-[600px] rounded-3xl shadow-xl overflow-hidden"
    ></div>

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

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet/dist/leaflet.css"
/>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const map = L.map('map').setView(
        [-6.1754, 106.8272],
        11
    );

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap contributors'
        }
    ).addTo(map);

    const wasteBanks = @json($wasteBanks);

    const bounds = [];

    wasteBanks.forEach(function(bank) {

        if (bank.latitude && bank.longitude) {

            L.marker([
                parseFloat(bank.latitude),
                parseFloat(bank.longitude)
            ])
            .addTo(map)
            .bindPopup(
                '<b>' + bank.nama + '</b><br>' +
                bank.alamat +
                '<br><br>' +
                '<a href="https://www.google.com/maps/search/?api=1&query=' +
                bank.latitude + ',' +
                bank.longitude +
                '" target="_blank">Open in Google Maps</a>'
            );

            bounds.push([
                parseFloat(bank.latitude),
                parseFloat(bank.longitude)
            ]);
        }

    });

    if (bounds.length > 0) {
        map.fitBounds(bounds);
    }

});

</script>

@endsection