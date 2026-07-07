<!DOCTYPE html>

<html lang="en">

<head>

```
<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>
    Verify Email
</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])
```

</head>

<body>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 via-white to-green-100 px-6 py-10">

```
<div class="w-full max-w-2xl bg-white rounded-[40px] shadow-2xl overflow-hidden">

    <div class="bg-gradient-to-r from-green-600 to-emerald-500 text-white text-center py-10 px-8">

        <img
            src="{{ asset('images/recycling-logo.png') }}"
            class="w-24 mx-auto mb-5"
        >

        <h1 class="text-4xl font-extrabold">
            Verify Your Email
        </h1>

        <p class="mt-4 text-white/90">
            Kami telah mengirimkan kode verifikasi ke email Anda.
        </p>

    </div>

    <div class="p-10">

        <form
            method="POST"
            action="{{ route('verify.code') }}"
            class="space-y-6"
        >

            @csrf

            <div>

                <label class="block mb-2 font-semibold text-gray-700">
                    Verification Code
                </label>

                <input
                    type="text"
                    name="code"
                    maxlength="6"
                    required
                    class="w-full border border-gray-300 rounded-2xl py-4 px-5 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 text-center text-2xl tracking-[10px]"
                >

                @error('code')

                <p class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </p>

                @enderror

            </div>

            <button
                type="submit"
                class="w-full bg-gradient-to-r from-green-600 to-emerald-500 hover:from-green-700 hover:to-emerald-600 text-white font-bold py-4 rounded-2xl shadow-xl transition"
            >

                VERIFY EMAIL

            </button>

        </form>

    </div>

</div>
```

</div>

</body>
</html>
