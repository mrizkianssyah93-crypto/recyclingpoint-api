@extends('layouts.app')

@section('content')

<div class="py-8 bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-6">
@if ($errors->any())

<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">

    <ul>

        @foreach ($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif
            <h1 class="text-3xl font-bold text-green-700">
                Users Management
            </h1>

            <p class="text-gray-500">
                Manage system users
            </p>

        </div>
<div class="bg-white rounded-2xl shadow p-4 mb-4">

    <form method="GET">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search Name or Username..."
            class="w-full border rounded-xl p-3"
        >

    </form>

</div>

        <div class="bg-white rounded-2xl shadow p-6 mb-8">

<form
    action="{{ route('users.store') }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf

    <div class="space-y-4">

        <div class="flex gap-4 items-center">

            <input
                type="text"
                name="nama"
                placeholder="Full Name"
                class="flex-1 border rounded-xl p-3"
                required
            >

            <input
                type="text"
                name="username"
                placeholder="Username"
                class="flex-1 border rounded-xl p-3"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                class="flex-1 border rounded-xl p-3"
                required
            >

            <select
                name="role"
                class="w-48 border rounded-xl p-3"
                required
            >
                <option value="">
                    Select Role
                </option>

                <option value="admin">
                    Admin
                </option>

                <option value="operation">
                    Operation
                </option>

                <option value="user">
                    User
                </option>

            </select>

            <input
                type="file"
                name="foto"
                class="w-56 border rounded-xl p-2"
            >

        </div>

        <div>

            <button
                type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold"
            >
                Add User
            </button>

        </div>

    </div>

</form>

        </div>

        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-green-600 text-white">

<tr>

    <th class="p-4 text-left">
        Photo
    </th>

    <th class="p-4 text-left">
        Name
    </th>

                        <th class="p-4 text-left">
                            Username
                        </th>

                        <th class="p-4 text-left">
                            Role
                        </th>

                        <th class="p-4 text-left">
                            Points
                        </th>

                        <th class="p-4 text-center">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($users as $user)

                    <tr class="border-b">

    <td class="p-4">

@if($user->foto)

    <img
        src="{{ asset('storage/' . $user->foto) }}"
        width="60"
        height="60"
        style="border-radius:50%;object-fit:cover;"
    >

@else

            <div
                class="w-12 h-12 rounded-full bg-gray-300"
            ></div>

        @endif

    </td>

    <td class="p-4">
        {{ $user->nama }}
    </td>
                        <td class="p-4">
                            {{ $user->username }}
                        </td>

                        <td class="p-4">
                            {{ $user->role }}
                        </td>

                        <td class="p-4 text-green-600 font-bold">
                            {{ $user->poin }}
                        </td>
<td class="p-4">

    <div class="flex justify-center gap-2">

        <button
            type="button"
            onclick="openEditModal(
                '{{ $user->id }}',
                '{{ $user->nama }}',
                '{{ $user->username }}',
                '{{ $user->role }}'
            )"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg"
        >
            Edit
        </button>

        <form
            action="{{ route('users.delete', $user->id) }}"
            method="POST"
        >

            @csrf
            @method('DELETE')

            <button
                type="submit"
                onclick="return confirm('Delete this user?')"
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

<div class="mt-4">
    {{ $users->withQueryString()->links() }}
</div>

</div>
        </div>

    </div>

</div>

<div
    id="editModal"
    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-[9999]"
>

    <div class="bg-white rounded-2xl p-6 w-[500px]">

        <h2 class="text-xl font-bold mb-4">
            Edit User
        </h2>

        <form
            id="editForm"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div class="mb-4">

                <label class="block mb-1">
                    Full Name
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
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    id="editUsername"
                    class="w-full border rounded-lg p-3"
                    required
                >

            </div>

            <div class="mb-4">

                <label class="block mb-1">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Leave blank if not changed"
                    class="w-full border rounded-lg p-3"
                >

            </div>

            <div class="mb-4">

                <label class="block mb-1">
                    Role
                </label>

                <select
                    name="role"
                    id="editRole"
                    class="w-full border rounded-lg p-3"
                    required
                >
                    <option value="admin">Admin</option>
                    <option value="operation">Operation</option>
                    <option value="user">User</option>
                </select>

            </div>
<div class="mb-4">

    <label class="block mb-1">
        Photo
    </label>

    <input
        type="file"
        name="foto"
        class="w-full border rounded-lg p-3"
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

function openEditModal(id,nama,username,role)
{
    document
        .getElementById('editModal')
        .classList.remove('hidden');

    document.getElementById('editNama').value = nama;
    document.getElementById('editUsername').value = username;
    document.getElementById('editRole').value = role;

    document.getElementById('updateUserForm').action =
        '/backend/users/update/' + id;
}

function closeModal()
{
    document
        .getElementById('editModal')
        .classList.add('hidden');
}

</script>
@endsection