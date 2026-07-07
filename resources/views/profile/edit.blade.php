@extends('layouts.app')

@section('content')

<div class="p-10">

    <h1 class="text-4xl font-bold text-green-700 mb-6">
        My Profile
    </h1>

    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">
            {{ session('success') }}
        </div>

    @endif

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form
            action="{{ route('profile.update') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="flex justify-center mb-8">

                @if($user->foto)

                    <img
                        src="{{ asset('storage/' . $user->foto) }}"
                        class="w-40 h-40 rounded-full object-cover border-4 border-green-500"
                    >

                @else

                    <div
                        class="w-40 h-40 rounded-full bg-gray-300"
                    ></div>

                @endif

            </div>

            <div class="space-y-5">

                <div>

                    <label class="block mb-2">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ $user->nama }}"
                        class="w-full border rounded-xl p-3"
                    >

                </div>

                <div>

                    <label class="block mb-2">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        value="{{ $user->username }}"
                        class="w-full border rounded-xl p-3"
                    >

                </div>

                <div>

                    <label class="block mb-2">
                        New Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Leave blank if not changing"
                        class="w-full border rounded-xl p-3"
                    >

                </div>

                <div>

                    <label class="block mb-2">
                        Profile Photo
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="w-full border rounded-xl p-3"
                    >

                </div>

                <button
                    type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl"
                >
                    Save Profile
                </button>

            </div>

        </form>

    </div>

</div>

@endsection