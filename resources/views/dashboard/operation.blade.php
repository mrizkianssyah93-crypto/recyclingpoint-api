@extends('layouts.app')

@section('content')

<div class="p-10">

    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-4xl font-bold text-[#14213d]">
                Operator Dashboard
            </h1>

            <p class="text-gray-500 mt-1">
                Monitor pickup requests and process transactions
            </p>

        </div>

    </div>

    <!-- SUMMARY -->

    <div class="grid grid-cols-2 gap-6 mb-8">

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-gray-500 text-sm">
                Pending Requests
            </p>

            <h2 class="text-4xl font-bold text-orange-500 mt-2">
                {{ $pending }}
            </h2>

        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-gray-500 text-sm">
                On Process
            </p>

            <h2 class="text-4xl font-bold text-blue-500 mt-2">
                {{ $process }}
            </h2>

        </div>

    </div>

    <!-- TABLE -->

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="p-6 border-b border-gray-100">

            <h2 class="text-2xl font-bold text-[#14213d]">
                Incoming Pickup Requests
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-green-600 text-white">

                    <tr>

                        <th class="p-5 text-left">
                            Customer
                        </th>

                        <th class="p-5 text-left">
                            Waste Bank
                        </th>

                        <th class="p-5 text-left">
                            Weight
                        </th>

                        <th class="p-5 text-left">
                            Distance
                        </th>

                        <th class="p-5 text-left">
                            Pickup Date
                        </th>

                        <th class="p-5 text-left">
                            Status
                        </th>

                        <th class="p-5 text-center">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($pickups as $item)

                    <tr class="border-b">

                        <td class="p-5">
                            {{ $item->user->nama ?? '-' }}
                        </td>

                        <td class="p-5">
                            {{ $item->waste_bank_name }}
                        </td>

                        <td class="p-5">
                            {{ $item->estimasi_berat }} KG
                        </td>

                        <td class="p-5">
                            {{ $item->distance_km }} KM
                        </td>

                        <td class="p-5">
                            {{ $item->tanggal_pickup }}
                        </td>

                        <td class="p-5">

                            @if($item->status == 'pending')

                                <span class="bg-orange-100 text-orange-600 px-4 py-2 rounded-full text-sm font-semibold">
                                    Pending
                                </span>

                            @elseif($item->status == 'process')

                                <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold">
                                    Process
                                </span>

                            @endif

                        </td>

                        <td class="p-5 text-center">

                            <div class="flex items-center justify-center gap-3">

                                <!-- VIEW -->

                                <button
                                    onclick="openPickupModal(
                                        '{{ $item->id }}',
                                        '{{ $item->user->nama ?? '-' }}',
                                        '{{ $item->nomor_hp }}',
                                        '{{ $item->alamat_lengkap }}',
                                        '{{ $item->estimasi_berat }}',
                                        '{{ $item->distance_km }}'
                                    )"
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-semibold"
                                >
                                    View
                                </button>

                                <!-- PROCESS -->

                                @if($item->status == 'pending')

                                <form
                                    action="{{ route('pickup.process', $item->id) }}"
                                    method="POST"
                                >
                                    @csrf

                                    <button
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm font-semibold"
                                    >
                                        Process
                                    </button>

                                </form>

                                @endif

                                <!-- COMPLETE -->

                                @if($item->status == 'process')

                                <form
                                    action="{{ route('pickup.complete', $item->id) }}"
                                    method="POST"
                                >
                                    @csrf

                                    <button
                                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl text-sm font-semibold"
                                    >
                                        Complete
                                    </button>

                                </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- MODAL -->

<div
    id="pickupModal"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50"
>

    <div class="bg-white rounded-3xl w-[500px] p-8">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold text-[#14213d]">
                Pickup Detail
            </h2>

            <button
                onclick="closePickupModal()"
                class="text-gray-400 text-2xl"
            >
                ×
            </button>

        </div>

        <div class="space-y-4">

            <div>

                <p class="text-sm text-gray-500">
                    Customer
                </p>

                <h3
                    id="modalCustomer"
                    class="font-bold text-lg"
                ></h3>

            </div>

            <div>

                <p class="text-sm text-gray-500">
                    Phone Number
                </p>

                <h3
                    id="modalPhone"
                    class="font-semibold"
                ></h3>

            </div>

            <div>

                <p class="text-sm text-gray-500">
                    Address
                </p>

                <h3
                    id="modalAddress"
                    class="font-semibold"
                ></h3>

            </div>

            <!-- EDIT WEIGHT -->

            <form
                id="editWeightForm"
                method="POST"
            >

                @csrf

                <div>

                    <p class="text-sm text-gray-500 mb-2">
                        Weight (KG)
                    </p>

                    <input
                        type="number"
                        step="0.1"
                        name="estimasi_berat"
                        id="modalWeightInput"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                    >

                </div>

                <button
                    class="w-full mt-6 bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl font-bold transition"
                >
                    Save Changes
                </button>

            </form>

            <div>

                <p class="text-sm text-gray-500">
                    Distance
                </p>

                <h3
                    id="modalDistance"
                    class="font-semibold"
                ></h3>

            </div>

        </div>

    </div>

</div>

<script>

function openPickupModal(
    id,
    customer,
    phone,
    address,
    weight,
    distance
)
{
    document
    .getElementById('pickupModal')
    .classList
    .remove('hidden');

    document
    .getElementById('pickupModal')
    .classList
    .add('flex');

    document
    .getElementById('modalCustomer')
    .innerText = customer;

    document
    .getElementById('modalPhone')
    .innerText = phone;

    document
    .getElementById('modalAddress')
    .innerText = address;

    document
    .getElementById('modalWeightInput')
    .value = weight;

    document
    .getElementById('modalDistance')
    .innerText = distance + ' KM';

    document
    .getElementById('editWeightForm')
    .action = '/pickup/update-weight/' + id;
}

function closePickupModal()
{
    document
    .getElementById('pickupModal')
    .classList
    .remove('flex');

    document
    .getElementById('pickupModal')
    .classList
    .add('hidden');
}

</script>

@endsection