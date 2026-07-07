@extends('layouts.app')

@section('content')

<div class="p-10">

```
<h1 class="text-4xl font-bold text-green-700 mb-6">
    Waste Categories
</h1>

<div class="bg-white rounded-2xl shadow p-6 mb-8">

    <form
        action="{{ route('waste-categories.store') }}"
        method="POST"
    >

        @csrf

        <div class="flex gap-4">

            <input
                type="text"
                name="nama_kategori"
                placeholder="Category Name"
                class="flex-1 border rounded-xl p-3"
                required
            >

            <input
                type="number"
                name="poin_per_kg"
                placeholder="Points per KG"
                class="flex-1 border rounded-xl p-3"
                required
            >

            <button
                type="submit"
                class="bg-green-600 hover:bg-green-700 text-white rounded-xl px-8"
            >
                Add Category
            </button>

        </div>

    </form>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-green-600 text-white">

            <tr>

                <th class="p-4 text-left">
                    No
                </th>

                <th class="p-4 text-left">
                    Category
                </th>

                <th class="p-4 text-left">
                    Points / KG
                </th>

                <th class="p-4 text-left">
                    Action
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($categories as $item)

            <tr class="border-b">

                <td class="p-4">
                    {{ $loop->iteration }}
                </td>

                <td class="p-4">
                    {{ $item->nama_kategori }}
                </td>

                <td class="p-4">
                    {{ $item->poin_per_kg }}
                </td>

                <td class="p-4">

                    <div class="flex gap-2">

                        <button
                            type="button"
                            onclick="openEditModal(
                                '{{ $item->id }}',
                                '{{ $item->nama_kategori }}',
                                '{{ $item->poin_per_kg }}'
                            )"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg"
                        >
                            Edit
                        </button>

                        <form
                            action="{{ route('waste-categories.delete',$item->id) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Delete this category?')"
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
```

</div>

<div
    id="editModal"
    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50"
>

```
<div class="bg-white rounded-2xl p-6 w-[500px]">

    <h2 class="text-xl font-bold mb-4">
        Edit Category
    </h2>

    <form
        id="editForm"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block mb-2">
                Category Name
            </label>

            <input
                type="text"
                name="nama_kategori"
                id="editNama"
                class="w-full border rounded-lg p-3"
                required
            >

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Points per KG
            </label>

            <input
                type="number"
                name="poin_per_kg"
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
```

</div>

<script>

function openEditModal(id,nama,poin)
{
    document.getElementById('editModal')
        .classList.remove('hidden');

    document.getElementById('editNama').value = nama;
    document.getElementById('editPoin').value = poin;

    document.getElementById('editForm').action =
        '/backend/waste-categories/update/' + id;
}

function closeModal()
{
    document.getElementById('editModal')
        .classList.add('hidden');
}

</script>

@endsection
