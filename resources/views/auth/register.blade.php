<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - NyamanKost</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-700 via-yellow-600 to-indigo-900 px-4 py-10">

    <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden grid lg:grid-cols-2">

        {{-- PANEL KIRI --}}
        <div class="hidden lg:flex flex-col justify-center items-center bg-gradient-to-br from-indigo-700 to-yellow-600 text-white p-16">

            <div class="w-28 h-28 rounded-full bg-white/20 flex items-center justify-center mb-8">

                <i class="fa-solid fa-user-plus text-6xl"></i>

            </div>

            <h1 class="text-5xl font-bold tracking-wider">
                NYAMANKOST
            </h1>

            <p class="mt-6 text-center text-indigo-100 text-lg leading-relaxed max-w-md">

                Bergabunglah bersama NyamanKost dan nikmati kemudahan
                mengelola kos, penyewa, kamar, dan pembayaran
                dalam satu platform modern.

            </p>

            <div class="mt-12 grid grid-cols-3 gap-8 text-center">

                <div>

                    <i class="fa-solid fa-users text-3xl"></i>

                    <p class="mt-3">
                        Penyewa
                    </p>

                </div>

                <div>

                    <i class="fa-solid fa-building text-3xl"></i>

                    <p class="mt-3">
                        Kos
                    </p>

                </div>

                <div>

                    <i class="fa-solid fa-money-bill-wave text-3xl"></i>

                    <p class="mt-3">
                        Pembayaran
                    </p>

                </div>

            </div>

        </div>

        {{-- PANEL KANAN --}}
        <div class="p-10 lg:p-16">

            <div class="text-center mb-8">

                <div class="lg:hidden mb-4">

                    <i class="fa-solid fa-user-plus text-5xl text-indigo-600"></i>

                </div>

                <h2 class="text-4xl font-bold text-gray-800">
                    Daftar Akun
                </h2>

                <p class="text-gray-500 mt-3">
                    Buat akun baru untuk mulai menggunakan NyamanKost
                </p>

            </div>

            {{-- ERROR --}}
            @if ($errors->any())

                <div class="mb-6 rounded-xl bg-red-100 border border-red-300 p-4">

                    <ul class="list-disc list-inside text-red-600 text-sm">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form method="POST" action="{{ route('register') }}">

                @csrf

                {{-- NAMA --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Nama Lengkap

                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        placeholder="Masukkan nama lengkap"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500">

                </div>

                {{-- EMAIL --}}
                <div class="mt-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Email

                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="Masukkan email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500">

                </div>

                {{-- NO HP --}}
                <div class="mt-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Nomor Handphone

                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        value="{{ old('no_hp') }}"
                        placeholder="Contoh: 081234567890"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500">

                </div>

                {{-- ROLE --}}
                <div class="mt-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Daftar Sebagai

                    </label>

                    <select
                        name="role"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500">

                        <option value="penyewa">
                            Penyewa Kos
                        </option>

                        <option value="pemilik">
                            Pemilik Kos
                        </option>

                    </select>

                </div>

                {{-- PASSWORD --}}
                <div class="mt-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Password

                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="Masukkan password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500">

                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div class="mt-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Konfirmasi Password

                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        placeholder="Ulangi password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500">

                </div>

                {{-- BUTTON --}}
                <div class="mt-8">

                    <button
                        type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold shadow-lg transition">

                        <i class="fa-solid fa-user-plus mr-2"></i>

                        Daftar Sekarang

                    </button>

                </div>

                {{-- LOGIN --}}
                <div class="text-center mt-8">

                    <span class="text-gray-500">
                        Sudah punya akun?
                    </span>

                    <a href="{{ route('login') }}"
                       class="text-indigo-600 font-semibold hover:text-indigo-800">

                        Masuk di sini

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>