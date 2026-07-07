@extends('layouts.app')

@section('content')

<div class="p-10">

    <h1 class="text-4xl font-bold text-green-700">
        Waste Bank
    </h1>

    <p class="text-gray-500 mb-8">
        Manage waste bank locations.
    </p>

    @if(session('success'))

        <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>

    @endif

    <!-- FORM -->

    <div class="bg-white rounded-3xl shadow p-6 mb-8">

        <form
            method="POST"
            action="{{ route('waste-bank-locations.store') }}"
            class="grid grid-cols-1 md:grid-cols-3 gap-4"
        >

            @csrf

            <input
                type="text"
                name="nama"
                placeholder="Waste Bank Name"
                class="border rounded-xl px-4 py-3"
                required
            >

            <input
                type="text"
                name="alamat"
                placeholder="Address"
                class="border rounded-xl px-4 py-3"
                required
            >

            <button
                type="submit"
                class="bg-green-600 text-white rounded-xl px-6 py-3"
            >
                Add Location
            </button>

        </form>

    </div>

    <!-- TABLE -->

    <div class="bg-white rounded-3xl shadow overflow-visible">

        <table class="w-full">

            <thead>

                <tr class="bg-green-600 text-white">

                    <th class="text-left p-5">
                        Name
                    </th>

                    <th class="text-left p-5">
                        Address
                    </th>

                    <th class="text-left p-5">
                        Status
                    </th>

                    <th class="text-left p-5">
                        Action
                    </th>

                </tr>

            </thead>

           <tbody>

    @forelse($wasteBanks as $bank)

        <tr class="border-b">

            <td class="p-5">
                {{ $bank->nama }}
            </td>

            <td class="p-5">
                {{ $bank->alamat }}
            </td>

            <td class="p-5">

                @if($bank->status == 1)

                    <span class="text-green-600 font-semibold">
                        Active
                    </span>

                @else

                    <span class="text-red-600 font-semibold">
                        Inactive
                    </span>

                @endif

            </td>
<td class="p-5">

    <details class="relative">

<summary
    class="text-xl text-center"
    style="
        list-style:none;
        cursor:pointer;
        user-select:none;
    "
>
    ⋮
</summary>

        <div
            class="absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-lg z-50"
        >

            <button
                onclick="openEditModal(
                    '{{ $bank->id }}',
                    '{{ $bank->nama }}',
                    '{{ $bank->alamat }}'
                )"
                class="block w-full text-left px-4 py-2 hover:bg-gray-100"
            >
                Edit
            </button>

            @if($bank->status == 1)

                <form
                    action="{{ route('waste-bank-locations.deactivate',$bank->id) }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="block w-full text-left px-4 py-2 hover:bg-yellow-100"
                    >
                        Deactivate
                    </button>

                </form>

            @else

                <form
                    action="{{ route('waste-bank-locations.activate',$bank->id) }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="block w-full text-left px-4 py-2 hover:bg-green-100"
                    >
                        Activate
                    </button>

                </form>

                <form
                    action="{{ route('waste-bank-locations.delete',$bank->id) }}"
                    method="POST"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        onclick="return confirm('Delete permanently?')"
                        class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-100"
                    >
                        Delete
                    </button>

                </form>

            @endif

        </div>

    </details>

</td>

        </tr>

    @empty

        <tr>

            <td
                colspan="4"
                class="p-8 text-center text-gray-500"
            >
                No waste bank locations found.
            </td>

        </tr>

    @endforelse

</tbody>

        </table>

    </div>

</div>
<div
    id="editModal"
    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-[9999]"
>

    <div class="bg-white rounded-2xl p-6 w-[500px]">

        <h2 class="text-xl font-bold mb-4">
            Edit Waste Bank
        </h2>

        <form
            id="editForm"
            method="POST"
        >

            @csrf

            <div class="mb-4">

                <label class="block mb-1">
                    Name
                </label>

                <input
                    type="text"
                    name="nama"
                    id="editNama"
                    class="w-full border rounded-lg p-3"
                    required
                >

            </div>

            <div class="mb-4">

                <label class="block mb-1">
                    Address
                </label>

                <textarea
                    name="alamat"
                    id="editAlamat"
                    class="w-full border rounded-lg p-3"
                    rows="4"
                    required
                ></textarea>

            </div>

            <div class="flex justify-end gap-2">

                <button
                    type="button"
                    onclick="closeModal()"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg"
                >
                    Save
                </button>

            </div>

        </form>

    </div>

</div>
<script>
function openEditModal(id,nama,alamat)
{
    console.log('EDIT CLICKED', id);

    let modal = document.getElementById('editModal');

    modal.classList.remove('hidden');

    document.getElementById('editNama').value = nama;
    document.getElementById('editAlamat').value = alamat;

    document.getElementById('editForm').action =
        '/backend/waste-bank-locations/update/' + id;
}
function openEditModal(id,nama,alamat)
{
    let modal = document.getElementById('editModal');

    modal.classList.remove('hidden');

    document.getElementById('editNama').value = nama;
    document.getElementById('editAlamat').value = alamat;

    document.getElementById('editForm').action =
        '/backend/waste-bank-locations/update/' + id;
}

function closeModal()
{
    document.getElementById('editModal')
        .classList.add('hidden');
}

</script>
@endsection