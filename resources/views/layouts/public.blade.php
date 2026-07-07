<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Recycling Point</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

</head>

<body class="bg-gray-100">

    <!-- NAVBAR -->

    <nav class="bg-green-700 shadow-lg">

        <div class="max-w-7xl mx-auto px-8 py-5 flex items-center justify-between">

            <a href="/" class="text-white font-bold text-3xl">
                Recycling Point
            </a>

            <div class="flex items-center gap-8 text-white font-medium">

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

                <a href="{{ route('register') }}"
                   class="bg-white text-green-700 px-4 py-2 rounded-xl font-semibold hover:bg-green-50">
                    Register
                </a>

            </div>

        </div>

    </nav>

    @yield('content')

    <!-- FOOTER -->

    <footer class="bg-green-700 text-white mt-16">

        <div class="max-w-7xl mx-auto px-8 py-8 text-center">

            <h3 class="font-bold text-2xl">
                Recycling Point
            </h3>

            <p class="text-green-100 mt-2">
                Smart Waste Management Platform
            </p>

            <p class="text-green-100 mt-4 text-sm">
                © 2026 Recycling Point. All Rights Reserved.
            </p>

        </div>

    </footer>

</body>
</html>