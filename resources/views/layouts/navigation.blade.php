<nav class="bg-green-700 text-white h-screen w-80 fixed top-0 left-0 flex flex-col justify-between">

    <div>

        <div class="p-6">

            <h1 class="text-3xl font-bold">
                Recycling Point
            </h1>

            <p class="text-green-100 text-sm mt-1">
                Waste Management System
            </p>

            <div class="mt-6 text-sm text-green-100">

  Logged in as :
{{ auth()->user()->role == 'user' ? 'Customer' : ucfirst(auth()->user()->role) }}

            </div>

        </div>

        <div class="mt-4">

            <a href="{{ route('dashboard') }}"
            class="block px-6 py-4 hover:bg-green-800 transition">

                Dashboard

            </a>

            @if(
                auth()->user()->role == 'admin'
            )

            <a href="{{ route('waste-categories') }}"
            class="block px-6 py-4 hover:bg-green-800 transition">

                Waste Categories

            </a>
<a href="{{ route('waste-bank-locations') }}"
   class="block px-6 py-4 hover:bg-green-800 transition">
    Waste Bank Locations
</a>
            <a href="{{ route('users') }}"
            class="block px-6 py-4 hover:bg-green-800 transition">

                Users Management

            </a>

            @endif

            @if(auth()->user()->role == 'admin')

<a href="{{ route('store-transactions') }}"
class="block px-6 py-4 hover:bg-green-800 transition">

    Store Transactions

</a>

<a href="{{ route('voucher-management') }}"
class="block px-6 py-4 hover:bg-green-800 transition">

    Voucher Management

</a>
<a href="{{ route('reports') }}"
   class="block px-6 py-4 hover:bg-green-800 transition">
    Reports
</a>
@endif


@if(auth()->user()->role == 'operation')

<a href="{{ route('store-transactions') }}"
class="block px-6 py-4 hover:bg-green-800 transition">

    Store Transactions

</a>

<a href="{{ route('pickup-requests') }}"
class="block px-6 py-4 hover:bg-green-800 transition">

    Pickup Requests

</a>

@endif

    </div>

    </div>

    <div class="p-4">

        <form method="POST"
            action="{{ route('logout') }}">

            @csrf

            <button
                class="w-full bg-red-500 hover:bg-red-600 py-3 rounded-xl transition">

                Logout

            </button>

        </form>

    </div>

</nav>