@extends('layouts.app')

@section('content')

<div class="flex items-center gap-4 mb-8">

    <img
        src="{{ asset('images/Pickuprequest.png') }}"
        class="w-14 h-14 object-contain"
    >

    <div>

        <h1 class="text-4xl font-bold text-[#14213d]">
            Pickup Requests
        </h1>

        <p class="text-gray-500 mt-1">
            Request waste pickup from nearest waste bank
        </p>

    </div>

</div>

    <!-- MAIN CONTENT -->

    <div class="flex gap-4 items-start mb-0">

        <!-- LEFT FORM -->

        <div class="col-span-7">

            <div class="bg-white rounded-[24px] border border-gray-100 shadow-sm p-5">

                <!-- TITLE -->

                <div class="flex items-center gap-3 mb-5">

    <img
        src="{{ asset('images/PickupInformation.png') }}"
        class="w-10 h-10 object-contain"
    >

    <div>

        <h2 class="text-[24px] font-bold text-[#1f2937]">
            Pickup Information
        </h2>

        <p class="text-gray-500 text-[14px] mt-1">
            Fill in the details below to request a waste pickup
        </p>

    </div>

</div>
                    <form
                        id="pickupForm"
                        action="{{ route('pickup-requests.store') }}"
                        method="POST"
                        class="space-y-4"
                    >

                    @csrf

                    <input
                        type="hidden"
                        name="distance_km"
                        id="distance_km"
                    >

                    <!-- ADDRESS + PHONE -->

                    <div class="grid grid-cols-2 gap-4">

                        <div>

                            <label class="flex items-center gap-2 text-[14px] font-semibold text-gray-700 mb-2">
    <img src="{{ asset('images/CompletedAddress.png') }}" class="w-5 h-5 object-contain">
    Complete Pickup Address
</label>

                            <textarea
                                name="alamat_lengkap"
                                id="pickup_address"
                                rows="2"
                                class="w-full border border-gray-200 rounded-2xl p-3 text-[14px] resize-none"
                                placeholder="Enter your complete address for pickup location..."
                                required
                            ></textarea>

                        </div>

                        <div>

                            <label class="flex items-center gap-2 text-[14px] font-semibold text-gray-700 mb-2">
    <img src="{{ asset('images/Phonenumber.png') }}" class="w-5 h-5 object-contain">
    Phone Number
</label>

                            <input
                                type="text"
                                name="nomor_hp"
                                class="w-full border border-gray-200 rounded-2xl p-3 text-[14px]"
                                placeholder="Example: 08123456789"
                                required
                            >

                        </div>

                    </div>

                    <!-- CATEGORY -->

                    <div class="grid grid-cols-3 gap-4">

                        <div>

                            <label class="flex items-center gap-2 text-[14px] font-semibold text-gray-700 mb-2">
    <img src="{{ asset('images/SelectWasterBank.png') }}" class="w-5 h-5 object-contain">
    Select Waste Bank
</label>

<select
    name="waste_bank_name"
    id="waste_bank"
    class="w-full border border-gray-200 rounded-2xl p-3 text-[14px]"
    required
>

    <option value="">
        Select Waste Bank
    </option>

    @foreach($wasteBanks as $bank)

        <option
            value="{{ $bank->nama }}"
        >
            {{ $bank->nama }}
        </option>

    @endforeach

</select>

                        </div>

                        <div>

                            <label class="flex items-center gap-2 text-[14px] font-semibold text-gray-700 mb-2">
    <img src="{{ asset('images/MainCategory.png') }}" class="w-5 h-5 object-contain">
    Main Category
</label>

                            <select
                                id="main_category"
                                class="w-full border border-gray-200 rounded-2xl p-3 text-[14px]"
                            >

                                <option value="">
                                    Select Main Category
                                </option>

                                <option value="logam">
                                    Logam
                                </option>

                                <option value="plastik">
                                    Plastik
                                </option>

                                <option value="kertas">
                                    Kertas
                                </option>

                                <option value="kaca">
                                    Kaca
                                </option>

                            </select>

                        </div>

                        <div>

                            <label class="flex items-center gap-2 text-[14px] font-semibold text-gray-700 mb-2">
    <img src="{{ asset('images/WasteType.png') }}" class="w-5 h-5 object-contain">
    Waste Type
</label>

                            <select
                                name="waste_category_id"
                                id="waste_category"
                                class="w-full border border-gray-200 rounded-2xl p-3 text-[14px]"
                                required
                            >

                                <option value="">
                                    Select Waste Type
                                </option>

                            </select>

                        </div>

                    </div>

                    <!-- WEIGHT -->

                    <div class="grid grid-cols-3 gap-4">

                        <div>

                            <label class="flex items-center gap-2 text-[14px] font-semibold text-gray-700 mb-2">
    <img src="{{ asset('images/EstimatedWeight.png') }}" class="w-5 h-5 object-contain">
    Estimated Weight (KG)
</label>

                            <input
                                type="number"
                                name="estimasi_berat"
                                id="estimasi_berat"
                                class="w-full border border-gray-200 rounded-2xl p-3 text-[14px]"
                                placeholder="Example: 20"
                                required
                            >

                        </div>

                        <div>

                            <label class="flex items-center gap-2 text-[14px] font-semibold text-gray-700 mb-2">
    <img src="{{ asset('images/Pickupdate.png') }}" class="w-5 h-5 object-contain">
    Pickup Date
</label>

                            <input
                                type="date"
                                name="tanggal_pickup"
                                class="w-full border border-gray-200 rounded-2xl p-3 text-[14px]"
                                required
                            >

                        </div>

                        <div>

                            <label class="flex items-center gap-2 text-[14px] font-semibold text-gray-700 mb-2">
    <img src="{{ asset('images/Pickuptime.png') }}" class="w-5 h-5 object-contain">
    Pickup Time
</label>

                            <select
                                name="pickup_time"
                                class="w-full border border-gray-200 rounded-2xl p-3 text-[14px]"
                                required
                            >

                                <option value="">
                                    Select Pickup Time
                                </option>

                                <option value="08:00 - 10:00">
                                    08:00 - 10:00
                                </option>

                                <option value="15:00 - 17:00">
                                    15:00 - 17:00
                                </option>

                            </select>

                        </div>

                    </div>

                    <!-- INFO BOX -->

                    <div class="grid grid-cols-3 gap-4">

                        <div class="bg-[#f4faf5] rounded-2xl p-4">

    <div class="flex items-start gap-3">

        <img
            src="{{ asset('images/Tips.png') }}"
            class="w-8 h-8 object-contain mt-1"
        >

        <div>

            <h3 class="text-green-700 font-bold text-[15px]">
                Tips
            </h3>

            <p class="text-gray-600 text-[13px] mt-1">
                Pisahkan sampah berdasarkan jenis untuk nilai yang lebih baik
            </p>

        </div>

    </div>

</div>

                        <div class="bg-[#f4faf5] rounded-2xl p-4">

    <div class="flex items-start gap-3">

        <img
            src="{{ asset('images/Freepickup.png') }}"
            class="w-8 h-8 object-contain mt-1"
        >

        <div>

            <h3 class="text-green-700 font-bold text-[15px]">
                Free Pickup
            </h3>

            <p class="text-gray-600 text-[13px] mt-1">
                Pickup gratis untuk sampah hingga 20 KG
            </p>

        </div>

    </div>

</div>

                        <div class="bg-[#f4faf5] rounded-2xl p-4">

    <div class="flex items-start gap-3">

        <img
            src="{{ asset('images/Supportenvirontment.png') }}"
            class="w-8 h-8 object-contain mt-1"
        >

        <div>

            <h3 class="text-green-700 font-bold text-[15px]">
                Support Environment
            </h3>

            <p class="text-gray-600 text-[13px] mt-1">
                Bersama-sama kita jaga lingkungan lebih bersih
            </p>

        </div>

    </div>

</div>

                    </div>

                </form>

            </div>

        </div>

        <!-- RIGHT SUMMARY -->

 <div class="w-[55%]">

    <div class="bg-white rounded-[28px] border border-gray-100 shadow-sm p-4">

        <!-- PICKUP SUMMARY HEADER -->

        <div class="flex items-center gap-3 mb-5">

            <img
                src="{{ asset('images/Pickupsummary.png') }}"
                class="w-10 h-10 object-contain"
            >

            <div>

                <h2 class="text-[20px] font-bold text-[#14213d]">
                    Pickup Summary
                </h2>

                <p class="text-[14px] text-gray-500 mt-1">
                    Estimated summary for your pickup
                </p>

            </div>

        </div>

        <div class="mt-6 border border-gray-100 rounded-[22px] overflow-hidden">

            <!-- Estimated Value -->

            <div class="flex items-center justify-between px-6 py-6 border-b border-gray-100">

                <div class="flex items-center gap-3">

                    <img
                        src="{{ asset('images/netvaluereceived.png') }}"
                        class="w-8 h-8 object-contain"
                    >

                    <span class="text-[15px] text-[#14213d] font-medium">
                        Estimated Value
                    </span>

                </div>

                <span
                    id="harga_sampah_text"
                    class="text-[18px] font-bold text-green-600"
                >
                    Rp 0
                </span>

            </div>

            <!-- Distance -->

            <div class="flex items-center justify-between px-6 py-6 border-b border-gray-100">

                <div class="flex items-center gap-3">

                    <img
                        src="{{ asset('images/Distance.png') }}"
                        class="w-8 h-8 object-contain"
                    >

                    <span class="text-[15px] text-[#14213d] font-medium">
                        Distance
                    </span>

                </div>

                <span
                    id="distance_text"
                    class="text-[18px] font-bold text-[#14213d]"
                >
                    0 KM
                </span>

            </div>

            <!-- Pickup Fee -->

            <div class="flex items-center justify-between px-6 py-6 border-b border-gray-100">

                <div class="flex items-center gap-3">

                    <img
                        src="{{ asset('images/Pickupfee.png') }}"
                        class="w-8 h-8 object-contain"
                    >

                    <span class="text-[15px] text-[#14213d] font-medium">
                        Pickup Fee
                    </span>

                </div>

                <span
                    id="ongkir_text"
                    class="text-[18px] font-bold text-green-600"
                >
                    FREE
                </span>

            </div>

            <!-- Net Value -->

            <div class="flex items-center justify-between px-6 py-6">

                <div class="flex items-center gap-3">

                    <img
                        src="{{ asset('images/netvaluereceived.png') }}"
                        class="w-8 h-8 object-contain"
                    >

                    <span class="text-[15px] text-[#14213d] font-medium">
                        Net Value Received
                    </span>

                </div>

                <span
                    id="net_value_text"
                    class="text-[20px] font-bold text-green-600"
                >
                    Rp 0
                </span>

            </div>

        </div>

        <!-- BUTTON -->

        <button
            type="submit"
            form="pickupForm"
            class="w-full mt-12 bg-green-600 hover:bg-green-700 text-white font-bold text-[16px] py-4 rounded-[18px] transition flex items-center justify-center gap-3"
        >

            <img
                src="{{ asset('images/requestpickupbutton.png') }}"
                class="w-6 h-6 object-contain"
            >

            Request Pickup

        </button>

    </div>

</div>

</div>
            </div>

        </div>

    </div>

    <!-- MY PICKUP REQUEST -->

    <div class="bg-white rounded-[24px] border border-gray-100 shadow-sm p-5">

        <h2 class="text-[24px] font-bold text-[#1f2937] mb-5">
            My Pickup Requests
        </h2>

       <div class="overflow-x-auto mt-0 px-0">

           <table class="w-full border-collapse">

                <thead class="bg-green-600 text-white">

                    <tr>

                        <th class="px-2 py-3 text-left text-[14px]">
                            Waste Bank
                        </th>

                        <th class="px-2 py-3 text-left text-[14px]">
                            Main Category
                        </th>

                        <th class="px-2 py-3 text-left text-[14px]">
                            Waste Type
                        </th>

                        <th class="px-2 py-3 text-left text-[14px]">
                            Address
                        </th>

                        <th class="px-2 py-3 text-left text-[14px]">
                            Phone
                        </th>

                        <th class="px-2 py-3 text-left text-[14px]">
                            Weight
                        </th>

                        <th class="px-2 py-3 text-left text-[14px]">
                            Distance
                        </th>

                        <th class="px-2 py-3 text-left text-[14px]">
                            Delivery Fee
                        </th>

                        <th class="px-2 py-3 text-left text-[14px]">
                            Pickup Date
                        </th>

                        <th class="px-2 py-3 text-left text-[14px]">
                            Pickup Time
                        </th>

                        <th class="px-2 py-3 text-left text-[14px]">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($requests as $item)

                    <tr class="border-b border-gray-100">

                        <td class="px-2 py-3 text-[14px]">
                            {{ $item->waste_bank_name }}
                        </td>

                        <td class="px-2 py-3 text-[14px]">

                            @php

                                $mainCategory = '-';

                                if($item->category)
                                {
                                    if(
                                        in_array(
                                            $item->category->nama_kategori,
                                            [
                                                'Tembaga',
                                                'Kuningan',
                                                'Aluminium',
                                                'Besi Campur'
                                            ]
                                        )
                                    )
                                    {
                                        $mainCategory = 'Logam';
                                    }

                                    elseif(
                                        in_array(
                                            $item->category->nama_kategori,
                                            [
                                                'Botol Plastik PET',
                                                'Gelas Plastik Bening',
                                                'Gelas Plastik Campur',
                                                'Tutup Botol Plastik',
                                                'Plastik PP Putih'
                                            ]
                                        )
                                    )
                                    {
                                        $mainCategory = 'Plastik';
                                    }

                                    elseif(
                                        in_array(
                                            $item->category->nama_kategori,
                                            [
                                                'Kardus',
                                                'Kertas Koran',
                                                'Kertas Dupleks'
                                            ]
                                        )
                                    )
                                    {
                                        $mainCategory = 'Kertas';
                                    }

                                    elseif(
                                        in_array(
                                            $item->category->nama_kategori,
                                            [
                                                'Botol Kaca Bening',
                                                'Botol Kaca Campur'
                                            ]
                                        )
                                    )
                                    {
                                        $mainCategory = 'Kaca';
                                    }
                                }

                            @endphp

                            {{ $mainCategory }}

                        </td>

                        <td class="px-2 py-3 text-[14px]">
                            {{ $item->category->nama_kategori ?? '-' }}
                        </td>

                        <td class="px-2 py-3 text-[14px]">
                            {{ $item->alamat_lengkap }}
                        </td>

                        <td class="px-2 py-3 text-[14px]">
                            {{ $item->nomor_hp }}
                        </td>

                        <td class="px-2 py-3 text-[14px]">
                            {{ $item->estimasi_berat }} KG
                        </td>

                        <td class="px-2 py-3 text-[14px]">
                            {{ $item->distance_km }} KM
                        </td>

                        <td class="px-2 py-3 text-[14px]">

                            @if($item->ongkir > 0)

                                Rp {{ number_format($item->ongkir) }}

                            @else

                                FREE

                            @endif

                        </td>

                        <td class="px-2 py-3 text-[14px]">
                            {{ $item->tanggal_pickup }}
                        </td>

                        <td class="px-2 py-3 text-[14px]">
                            {{ $item->pickup_time }}
                        </td>

                        <td class="px-2 py-3">

                            <!-- PENDING -->

    @if($item->status == 'pending')

        <button
            onclick="openTrackingModal(
                'Pending',
                'Permintaan pickup sedang menunggu konfirmasi dari pihak bank sampah.'
            )"
            class="bg-orange-100 text-orange-600 px-4 py-2 rounded-full text-sm font-semibold"
        >
            Pending
        </button>

    <!-- PROCESS -->

    @elseif($item->status == 'process')

        <button
            onclick="openTrackingModal(
                'Pickup Dijadwalkan',
                'Pickup sedang diproses dan dijadwalkan oleh operator bank sampah.'
            )"
            class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold"
        >
            Process
        </button>

    <!-- COMPLETED -->

    @else

        <button
            onclick="openTrackingModal(
                'Pickup Selesai',
                'Pickup telah selesai diproses.'
            )"
            class="bg-green-100 text-green-600 px-4 py-2 rounded-full text-sm font-semibold"
        >
            Completed
        </button>

    @endif

</td>
                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>
<script id="wasteBanksData" type="application/json">
{!! json_encode($wasteBanks->pluck('alamat','nama')) !!}
</script>
<script>

const categories = {

    logam: [

        { id: 1, name: 'Tembaga', price: 175000 },
        { id: 2, name: 'Kuningan', price: 90000 },
        { id: 3, name: 'Aluminium', price: 30000 },
        { id: 4, name: 'Besi Campur', price: 4500 }

    ],

    plastik: [

        { id: 5, name: 'Botol Plastik PET', price: 3000 },
        { id: 6, name: 'Gelas Plastik Bening', price: 3700 },
        { id: 7, name: 'Gelas Plastik Campur', price: 1800 },
        { id: 8, name: 'Tutup Botol Plastik', price: 4500 },
        { id: 9, name: 'Plastik PP Putih', price: 1400 }

    ],

    kertas: [

        { id: 10, name: 'Kardus', price: 2500 },
        { id: 11, name: 'Kertas Koran', price: 1000 },
        { id: 12, name: 'Kertas Dupleks', price: 500 }

    ],
 
    kaca: [

        { id: 13, name: 'Botol Kaca Bening', price: 800 },
        { id: 14, name: 'Botol Kaca Campur', price: 400 }

    ]

};

const wasteBanks = JSON.parse(
    document.getElementById('wasteBanksData').textContent
);

const addressInput =
document.getElementById('pickup_address');

const wasteBankInput =
document.getElementById('waste_bank');

const mainCategory =
document.getElementById('main_category');

const wasteCategory =
document.getElementById('waste_category');

const beratInput =
document.getElementById('estimasi_berat');

mainCategory.addEventListener(
    'change',
    function()
    {
        const selected =
        categories[this.value];

        wasteCategory.innerHTML =
        '<option value="">Select Waste Type</option>';

        if(selected)
        {
            selected.forEach(item => {

                wasteCategory.innerHTML += `

                    <option
                        value="${item.id}"
                        data-price="${item.price}"
                    >

                        ${item.name}
                        - Rp ${item.price.toLocaleString()}/KG

                    </option>

                `;
            });
        }

        calculateDistance();
    }
);

async function calculateDistance()
{
    const address = addressInput.value;

    const wasteBank = wasteBankInput.value;

    if(!address || !wasteBank)
    {
        return;
    }

    const service =
    new google.maps.DistanceMatrixService();

    service.getDistanceMatrix({

        origins: [wasteBanks[wasteBank]],

        destinations: [address],

        travelMode: 'DRIVING',

        unitSystem:
        google.maps.UnitSystem.METRIC,

    }, function(response, status)
    {
        if(status !== 'OK')
        {
            return;
        }

        const distanceValue =
        response.rows[0]
        .elements[0]
        .distance
        .value;

        const distanceKm =
        (distanceValue / 1000).toFixed(1);

        document.getElementById(
            'distance_text'
        ).innerHTML =
        distanceKm + ' KM';

        document.getElementById(
            'distance_km'
        ).value =
        distanceKm;

        const berat =
        parseFloat(
            beratInput.value || 0
        );

        let ongkir = 0;

        const selectedOption =
        wasteCategory.options[
            wasteCategory.selectedIndex
        ];

        const hargaPerKg =
        parseFloat(
            selectedOption?.dataset.price || 0
        );

        const totalHarga =
        berat * hargaPerKg;

        if(berat > 20)
        {
            ongkir =
            distanceKm * 3000;
        }

        const netValue =
        totalHarga - ongkir;

        document.getElementById(
            'harga_sampah_text'
        ).innerHTML =
        'Rp ' +
        totalHarga.toLocaleString();

        document.getElementById(
            'ongkir_text'
        ).innerHTML =
        ongkir > 0
        ? 'Rp ' + ongkir.toLocaleString()
        : 'FREE';

        document.getElementById(
            'net_value_text'
        ).innerHTML =
        'Rp ' +
        netValue.toLocaleString();
    });
}

addressInput.addEventListener(
    'keyup',
    calculateDistance
);

beratInput.addEventListener(
    'keyup',
    calculateDistance
);

wasteBankInput.addEventListener(
    'change',
    calculateDistance
);

wasteCategory.addEventListener(
    'change',
    calculateDistance
);


</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}">
</script>
<!-- TRACKING MODAL -->

<div
    id="trackingModal"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50"
>

    <div class="bg-white rounded-3xl w-[450px] p-8">

        <div class="flex items-center justify-between mb-6">

            <h2
                id="trackingTitle"
                class="text-2xl font-bold text-[#14213d]"
            ></h2>

            <button
                onclick="closeTrackingModal()"
                class="text-gray-400 text-2xl"
            >
                ×
            </button>

        </div>

        <p
            id="trackingDescription"
            class="text-gray-600 leading-7"
        ></p>

    </div>

</div>

<script>

function openTrackingModal(title, description)
{
    document
    .getElementById('trackingModal')
    .classList
    .remove('hidden');

    document
    .getElementById('trackingModal')
    .classList
    .add('flex');

    document
    .getElementById('trackingTitle')
    .innerText = title;

    document
    .getElementById('trackingDescription')
    .innerText = description;
}

function closeTrackingModal()
{
    document
    .getElementById('trackingModal')
    .classList
    .remove('flex');

    document
    .getElementById('trackingModal')
    .classList
    .add('hidden');
}

</script>
@endsection