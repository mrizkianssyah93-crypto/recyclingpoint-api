@extends('layouts.app')

@section('content')

<div class="p-10">

    <h1 class="text-4xl font-bold text-green-700 mb-6">
        Voucher Management
    </h1>

    {{-- FORM ADD VOUCHER --}}
    <div class="bg-white rounded-2xl shadow p-6 mb-8">

    <form
        action="{{ route('voucher-management.store') }}"
        method="POST"
    >

        @csrf

        <div style="display:flex;gap:15px;align-items:center;">

            <input
                type="text"
                name="nama"
                placeholder="Voucher Name"
                class="border rounded-xl p-3"
                style="flex:1"
                required
            >

            <input
                type="text"
                name="kategori"
                placeholder="Category"
                class="border rounded-xl p-3"
                style="flex:1"
                required
            >

            <input
                type="number"
                name="poin"
                placeholder="Points"
                class="border rounded-xl p-3"
                style="flex:1"
                required
            >

            <button
                type="submit"
                class="bg-green-600 text-white rounded-xl px-8 py-3"
            >
                Add Voucher
            </button>

        </div>

    </form>

</div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-green-600 text-white">

                <tr>

                    <th class="p-4 text-left">
                        Name
                    </th>

                    <th class="p-4 text-left">
                        Category
                    </th>

                    <th class="p-4 text-left">
                        Points
                    </th>

                    <th class="p-4 text-left">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($vouchers as $voucher)

                <tr class="border-b">

                    <td class="p-4">
                        {{ $voucher->nama }}
                    </td>

                    <td class="p-4">
                        {{ $voucher->kategori }}
                    </td>

                    <td class="p-4">
                        {{ $voucher->poin }}
                    </td>

                    <td class="p-4">

                        <div class="flex items-center gap-2">

                            <button
                                type="button"
                                onclick="openEditModal(
                                    '{{ $voucher->id }}',
                                    '{{ $voucher->nama }}',
                                    '{{ $voucher->kategori }}',
                                    '{{ $voucher->poin }}'
                                )"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg"
                            >
                                Edit
                            </button>

                            <form
                                action="{{ route('voucher-management.delete',$voucher->id) }}"
                                method="POST"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Delete this voucher?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg"
                                >
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

{{-- EDIT MODAL --}}
<div
    id="editModal"
    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50"
>

    <div class="bg-white rounded-2xl p-6 w-[500px]">

        <h2 class="text-xl font-bold mb-4">
            Edit Voucher
        </h2>

        <form
            id="editForm"
            method="POST"
        >

            @csrf

            <div class="mb-4">

                <label class="block mb-2">
                    Voucher Name
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

                <label class="block mb-2">
                    Category
                </label>

                <input
                    type="text"
                    name="kategori"
                    id="editKategori"
                    class="w-full border rounded-lg p-3"
                    required
                >

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Points
                </label>

                <input
                    type="number"
                    name="poin"
                    id="editPoin"
                    class="w-full border rounded-lg p-3"
                    required
                >

            </div>

            <div class="flex justify-end gap-2">

                <button
                    type="button"
                    onclick="closeModal()"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg"
                >
                    Save
                </button>

            </div>

        </form>

    </div>

</div>

<script>

function openEditModal(id,nama,kategori,poin)
{
    document
        .getElementById('editModal')
        .classList.remove('hidden');

    document.getElementById('editNama').value = nama;
    document.getElementById('editKategori').value = kategori;
    document.getElementById('editPoin').value = poin;

    document.getElementById('editForm').action =
        '/backend/voucher-management/update/' + id;
}

function closeModal()
{
    document
        .getElementById('editModal')
        .classList.add('hidden');
}

</script>

@endsection