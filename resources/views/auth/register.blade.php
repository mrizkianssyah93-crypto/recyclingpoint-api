<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Recycling Point Register
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 via-white to-green-100 px-6 py-10 relative overflow-hidden">

    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-green-300 rounded-full blur-3xl opacity-20 -translate-x-1/2 -translate-y-1/2"></div>

    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-emerald-300 rounded-full blur-3xl opacity-20 translate-x-1/3 translate-y-1/3"></div>

    <div class="w-full max-w-7xl min-h-[750px] bg-white/70 backdrop-blur-xl rounded-[40px] shadow-2xl overflow-hidden border border-white/40 grid lg:grid-cols-2">

        <!-- LEFT SIDE -->

        <div class="hidden lg:flex relative overflow-hidden bg-gradient-to-br from-green-600 to-emerald-500 p-16 flex-col justify-center items-center text-white">

            <div class="absolute top-10 left-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>

            <div class="absolute bottom-10 right-10 w-52 h-52 bg-white/10 rounded-full blur-3xl"></div>

            <img
                src="{{ asset('images/recycling-logo.png') }}"
                alt="Recycling Point"
                class="w-40"
            >

            <h1 class="text-6xl font-extrabold mt-10">
                Recycling Point
            </h1>

            <p class="text-center mt-6 text-xl text-white/90 max-w-xl">
                Bergabung dan mulai ubah sampah menjadi poin reward serta kontribusi nyata untuk lingkungan.
            </p>

        </div>

        <!-- RIGHT SIDE -->

        <div class="flex items-center justify-center p-10 lg:p-20">

            <div class="w-full max-w-md">

                <h2 class="text-5xl font-extrabold text-gray-800">
                    Create Account
                </h2>

                <p class="text-gray-500 mt-4">
                    Masukkan Email atau Nomor Handphone untuk membuat akun Recycling Point
                </p>

                <form
                    method="POST"
                    action="{{ route('register') }}"
                    class="space-y-6 mt-10"
                >

                    @csrf

                    <!-- EMAIL / NO HP -->

                    <div>

                        <label class="font-semibold text-gray-700">
                            Email atau Nomor Handphone
                        </label>

                        <input
                            type="text"
                            name="identifier"
                            value="{{ old('identifier') }}"
                            class="w-full rounded-2xl border border-gray-200 focus:border-green-500 focus:ring-green-500 py-4 px-5 bg-white shadow-sm text-[16px] mt-2"
                            required
                        >

                        @error('identifier')

                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>

                    <!-- PASSWORD -->

                    <div>

                        <label class="font-semibold text-gray-700">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="w-full rounded-2xl border border-gray-200 focus:border-green-500 focus:ring-green-500 py-4 px-5 bg-white shadow-sm text-[16px] mt-2"
                            required
                        >

                        @error('password')

                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>

                    <!-- CONFIRM PASSWORD -->

                    <div>

                        <label class="font-semibold text-gray-700">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full rounded-2xl border border-gray-200 focus:border-green-500 focus:ring-green-500 py-4 px-5 bg-white shadow-sm text-[16px] mt-2"
                            required
                        >

                    </div>

                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-green-600 to-emerald-500 hover:from-green-700 hover:to-emerald-600 text-white py-4 rounded-2xl font-bold shadow-xl transition duration-300"
                    >

                        CREATE ACCOUNT

                    </button>

                    <!-- DIVIDER -->

                    <div class="flex items-center gap-4">

                        <div class="flex-1 h-px bg-gray-200"></div>

                        <span class="text-gray-400 text-sm">
                            atau lanjut dengan
                        </span>

                        <div class="flex-1 h-px bg-gray-200"></div>

                    </div>

                    <!-- GOOGLE -->

                    <a
                        href="{{ url('/auth/google') }}"
                        class="w-full flex items-center justify-center gap-3 border border-gray-200 hover:border-gray-300 bg-white hover:bg-gray-50 rounded-2xl py-4 transition shadow-sm"
                    >

                        <img
                            src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg"
                            class="w-5 h-5"
                        >

                        <span class="font-semibold text-gray-700">
                            Continue with Google
                        </span>

                    </a>

                    <div class="text-center pt-4">

                        <a
                            href="{{ route('login') }}"
                            class="text-green-600 font-semibold hover:text-green-700"
                        >

                            Already have an account?

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>

