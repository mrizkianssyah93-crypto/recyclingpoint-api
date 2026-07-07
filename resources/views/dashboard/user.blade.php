@extends('layouts.app')

@section('content')

<div class="p-10">

    {{-- HEADER --}}

    <div class="flex justify-between items-start mb-10">

        <div>

            <h1 class="text-4xl font-bold text-green-700">
                Hi, {{ auth()->user()->nama }}
            </h1>

            <p class="text-gray-500 mt-2">
                Welcome back to Recycling Point
            </p>

        </div>

        <div class="relative inline-block">

    <button
        type="button"
        onclick="toggleProfileMenu()"
    >

        @if(auth()->user()->foto)

<div class="w-16 h-16 rounded-full overflow-hidden border-2 border-white shadow-md">

    <img
        src="{{ asset('storage/' . auth()->user()->foto) }}"
        class="w-full h-full object-cover"
    >

</div>
@endif
    </button>

    <div
<div
    id="profileMenu"
    class="hidden absolute right-0 top-24 bg-white rounded-2xl shadow-xl z-50 overflow-hidden"
    style="width:170px;"
>
    <a
        href="{{ route('profile.edit') }}"
        class="block px-4 py-3 hover:bg-gray-100"
    >
        👤 Edit Profile
    </a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button
            type="submit"
            class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50"
        >
            🚪 Logout
        </button>
    </form>
</div>

</div>

<script>

function toggleProfileMenu()
{
    document
        .getElementById('profileMenu')
        .classList.toggle('hidden');
}

</script>

    </div>

    {{-- POINT CARD --}}

    <div
        class="bg-gradient-to-r from-green-700 to-green-400
        rounded-3xl p-8 text-white shadow-xl mb-10">

        <div class="text-xl">
            Your Points
        </div>

        <div class="text-6xl font-bold mt-4">
            {{ auth()->user()->poin }}
        </div>

        <a
            href="{{ route('vouchers') }}"
            class="inline-block mt-6 bg-white text-green-700
            px-6 py-3 rounded-2xl font-bold"
        >
            Redeem Points
        </a>

    </div>

    {{-- MENU --}}

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <a
            href="{{ route('pickup-requests') }}"
            class="bg-white rounded-3xl shadow-lg p-8 hover:shadow-xl transition"
        >

            <div class="text-4xl mb-4">
                🚚
            </div>

            <h2 class="text-2xl font-bold">
                Pickup Request
            </h2>

            <p class="text-gray-500 mt-2">
                Request waste pickup service
            </p>

        </a>

        <a
            href="{{ route('history') }}"
            class="bg-white rounded-3xl shadow-lg p-8 hover:shadow-xl transition"
        >

            <div class="text-4xl mb-4">
                📄
            </div>

            <h2 class="text-2xl font-bold">
                Transaction History
            </h2>

            <p class="text-gray-500 mt-2">
                View your recycling activity
            </p>

        </a>

        <a
            href="{{ route('vouchers') }}"
            class="bg-white rounded-3xl shadow-lg p-8 hover:shadow-xl transition"
        >

            <div class="text-4xl mb-4">
                🎁
            </div>

            <h2 class="text-2xl font-bold">
                Redeem Voucher
            </h2>

            <p class="text-gray-500 mt-2">
                Exchange points for rewards
            </p>

        </a>

    </div>

    {{-- INFO --}}

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h2 class="text-2xl font-bold mb-6">
            Recycling Information
        </h2>

        <div class="space-y-4 text-gray-600">

            <p>
                ♻️ Collect more waste to earn more points
            </p>

            <p>
                🎁 Redeem your points with attractive vouchers
            </p>

            <p>
                🚚 Use pickup request for easier recycling
            </p>

        </div>

    </div>

</div>

@endsection