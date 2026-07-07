<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Recycling Point Login
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 via-white to-green-100 px-6 py-10 relative overflow-hidden">

    <!-- BACKGROUND BLUR -->

    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-green-300 rounded-full blur-3xl opacity-20 -translate-x-1/2 -translate-y-1/2"></div>

    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-emerald-300 rounded-full blur-3xl opacity-20 translate-x-1/3 translate-y-1/3"></div>

    <!-- MAIN CONTAINER -->

    <div class="w-full max-w-7xl min-h-[750px] bg-white/70 backdrop-blur-xl rounded-[40px] shadow-2xl overflow-hidden border border-white/40 grid lg:grid-cols-2">

        <!-- LEFT SIDE -->

        <div class="hidden lg:flex relative overflow-hidden bg-gradient-to-br from-green-600 to-emerald-500 p-16 flex-col justify-center items-center text-white">

            <!-- FLOATING SHAPES -->

            <div class="absolute top-10 left-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>

            <div class="absolute bottom-10 right-10 w-52 h-52 bg-white/10 rounded-full blur-3xl"></div>

            <!-- LOGO -->

            <div class="relative z-10">

                <img
                    src="{{ asset('images/recycling-logo.png') }}"
                    alt="Recycling Point"
                    class="w-40 drop-shadow-2xl"
                >

            </div>

            <!-- TITLE -->

            <div class="relative z-10 text-center mt-10 max-w-xl">

                <h1 class="text-6xl font-extrabold leading-tight">
                    Recycling Point
                </h1>

                <p class="mt-6 text-xl text-white/90 leading-relaxed">
                    Smart Waste Management Platform untuk mendukung lingkungan yang lebih bersih, modern, dan berkelanjutan.
                </p>

            </div>

            <!-- FEATURE CARD -->

            <div class="relative z-10 mt-14 bg-white/10 backdrop-blur-lg border border-white/20 rounded-[28px] px-8 py-7 shadow-2xl w-full max-w-md">

                <div class="flex items-start gap-5">

                    <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl shadow-lg">
                        ♻️
                    </div>

                    <div>

                        <h3 class="font-bold text-2xl">
                            Eco Friendly System
                        </h3>

                        <p class="mt-2 text-white/80 text-[16px] leading-relaxed">
                            Kelola pickup sampah lebih mudah, modern, dan efisien dengan sistem digital Recycling Point.
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT SIDE -->

        <div class="flex items-center justify-center p-10 lg:p-20 bg-white/60 backdrop-blur-xl">

            <div class="w-full max-w-md">

                <!-- MOBILE LOGO -->

                <div class="lg:hidden flex justify-center mb-8">

                    <img
                        src="{{ asset('images/recycling-logo.png') }}"
                        alt="Recycling Point"
                        class="w-28"
                    >

                </div>

                <!-- HEADING -->

                <div class="mb-10">

                    <h2 class="text-5xl font-extrabold text-gray-800 leading-tight">
                        Welcome Back
                    </h2>

                    <p class="text-gray-500 mt-4 text-[16px] leading-relaxed">
                        Login untuk melanjutkan ke dashboard Recycling Point
                    </p>
@if(session('success'))

<div class="mb-6 p-4 rounded-2xl bg-green-100 border border-green-200 text-green-700">

    {{ session('success') }}

</div>

@endif

                </div>

                <!-- SESSION -->

                <x-auth-session-status
                    class="mb-4"
                    :status="session('status')"
                />

                <!-- FORM -->

                <form
                    method="POST"
                    action="{{ route('login') }}"
                    class="space-y-6"
                >

                    @csrf

                    <!-- USERNAME -->
<div>

    <label
        for="username"
        class="block mb-2 text-gray-700 font-semibold"
    >
        Username
    </label>

    <input
        id="username"
        type="text"
        name="username"
        value="{{ old('username') }}"
        required
        autofocus
        autocomplete="username"
        class="w-full border border-gray-300 rounded-2xl py-4 px-5 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
    >

    @error('username')
        <p class="text-red-500 text-sm mt-2">
            {{ $message }}
        </p>
    @enderror

</div>

                    <!-- PASSWORD -->

<div>

    <label
        for="password"
        class="block mb-2 text-gray-700 font-semibold"
    >
        Password
    </label>

    <input
        id="password"
        type="password"
        name="password"
        required
        autocomplete="current-password"
        class="w-full border border-gray-300 rounded-2xl py-4 px-5 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
    >

    @error('password')
        <p class="text-red-500 text-sm mt-2">
            {{ $message }}
        </p>
    @enderror

</div>

                    <!-- REMEMBER -->

                    <div class="flex items-center justify-between">

                        <label
                            for="remember_me"
                            class="inline-flex items-center"
                        >

                            <input
                                id="remember_me"
                                type="checkbox"
                                class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500"
                                name="remember"
                            >

                            <span class="ms-2 text-sm text-gray-600">
                                Remember me
                            </span>

                        </label>

                        @if (Route::has('password.request'))

                            <a
                                class="text-sm text-green-600 hover:text-green-700 font-semibold"
                                href="{{ route('password.request') }}"
                            >

                                Forgot Password?

                            </a>

                        @endif

                    </div>

                    <!-- BUTTON -->

                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-green-600 to-emerald-500 hover:from-green-700 hover:to-emerald-600 text-white font-bold py-4 rounded-2xl shadow-xl transition duration-300 text-[17px]"
                    >

                        LOG IN

                    </button>
<!-- DIVIDER -->

<div class="flex items-center gap-4 my-6">

    <div class="flex-1 h-px bg-gray-200"></div>

    <span class="text-sm text-gray-400 font-medium">
        atau lanjut dengan
    </span>

    <div class="flex-1 h-px bg-gray-200"></div>

</div>

<!-- GOOGLE LOGIN -->

<a
    href="{{ url('/auth/google') }}"
    class="w-full flex items-center justify-center gap-3 border border-gray-200 hover:border-gray-300 bg-white hover:bg-gray-50 rounded-2xl py-4 transition shadow-sm"
>

    <img
        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg"
        class="w-5 h-5"
    >

    <span class="text-[15px] font-semibold text-gray-700">
        Continue with Google
    </span>

</a>
                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>