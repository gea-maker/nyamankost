<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>NyamanKost</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-50">

    {{-- HERO --}}
    <section class="bg-indigo-600 text-white py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h1 class="text-5xl font-bold mb-6">

                Cari Kos Nyaman Dengan Mudah

            </h1>

            <p class="text-indigo-100 text-lg mb-10">

                Temukan kos terbaik sesuai kebutuhan Anda

            </p>

            {{-- SEARCH --}}
            <form method="GET"
                  action="{{ route('home') }}"
                  class="bg-white rounded-2xl p-4 flex flex-col md:flex-row gap-4 shadow-2xl">

                <input type="text"
                       name="search"
                       placeholder="Cari nama kos atau lokasi..."
                       class="flex-1 rounded-xl border-gray-200">

                <select name="jenis_kos"
                        class="rounded-xl border-gray-200">

                    <option value="">
                        Semua Jenis
                    </option>

                    <option value="Putra">
                        Putra
                    </option>

                    <option value="Putri">
                        Putri
                    </option>

                    <option value="Campur">
                        Campur
                    </option>

                </select>

                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-semibold">

                    Cari

                </button>

            </form>

        </div>

    </section>

    {{-- LIST KOS --}}
    <section class="py-16">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($allKos as $kos)

                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition">

                    {{-- FOTO --}}
                    <div class="h-60 bg-gray-100 overflow-hidden">

                        @if($kos->foto)

                            <img src="{{ asset('uploads/kos/' . $kos->foto) }}"
                                 class="w-full h-full object-cover">

                        @else

                            <div class="w-full h-full flex items-center justify-center text-gray-400">

                                Tidak ada foto

                            </div>

                        @endif

                    </div>

                    {{-- CONTENT --}}
                    <div class="p-6">

                        <div class="flex items-start justify-between mb-4">

                            <div>

                                <h3 class="text-2xl font-bold text-gray-800 mb-2">

                                    {{ $kos->nama_kos }}

                                </h3>

                                <p class="text-gray-500 text-sm">

                                    {{ $kos->alamat }}

                                </p>

                            </div>

                            <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold">

                                {{ $kos->jenis_kos }}

                            </span>

                        </div>

                        {{-- HARGA --}}
                        <div class="mb-5">

                            <p class="text-2xl font-bold text-indigo-600">

                                Rp {{ number_format($kos->harga_per_bulan, 0, ',', '.') }}

                            </p>

                            <span class="text-sm text-gray-400">

                                / bulan

                            </span>

                        </div>

                        {{-- BUTTON --}}
                        <a href="{{ route('kos.detail', $kos->id) }}"
                           class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-2xl font-semibold transition">

                            Lihat Detail

                        </a>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </section>

</body>
</html>