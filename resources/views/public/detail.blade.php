<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>{{ $kos->nama_kos }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-50">

    <div class="min-h-screen py-10">

        <div class="max-w-6xl mx-auto px-6">

            {{-- BACK --}}
            <a href="{{ route('home') }}"
               class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-8">

                ← Kembali

            </a>

            {{-- CARD --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg">

                {{-- FOTO --}}
                <div class="h-[450px] bg-gray-100 overflow-hidden">

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
                <div class="p-8">

                    {{-- HEADER --}}
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-5 mb-8">

                        <div>

                            <h1 class="text-4xl font-bold text-gray-800 mb-3">

                                {{ $kos->nama_kos }}

                            </h1>

                            <p class="text-gray-500 text-lg">

                                {{ $kos->alamat }}

                            </p>

                        </div>

                        {{-- STATUS --}}
                        <div>

                            @if($kos->status_kos == 'Tersedia')

                                <span class="px-5 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">

                                    Tersedia

                                </span>

                            @elseif($kos->status_kos == 'Penuh')

                                <span class="px-5 py-2 rounded-full bg-red-100 text-red-700 text-sm font-semibold">

                                    Penuh

                                </span>

                            @else

                                <span class="px-5 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">

                                    Maintenance

                                </span>

                            @endif

                        </div>

                    </div>

                    {{-- HARGA --}}
                    <div class="mb-8">

                        <h3 class="text-lg font-semibold text-gray-700 mb-2">

                            Harga Per Bulan

                        </h3>

                        <p class="text-4xl font-bold text-indigo-600">

                            Rp {{ number_format($kos->harga_per_bulan, 0, ',', '.') }}

                        </p>

                    </div>

                    {{-- INFO --}}
                    <div class="grid md:grid-cols-2 gap-6 mb-10">

                        {{-- TIPE --}}
                        <div class="bg-gray-50 rounded-2xl p-5">

                            <h4 class="font-semibold text-gray-700 mb-2">

                                Jenis Kos

                            </h4>

                            <p class="text-gray-600">

                                {{ $kos->jenis_kos }}

                            </p>

                        </div>

                        {{-- SISA --}}
                        <div class="bg-gray-50 rounded-2xl p-5">

                            <h4 class="font-semibold text-gray-700 mb-2">

                                Sisa Kamar

                            </h4>

                            <p class="text-gray-600">

                                {{ $kos->sisa_kamar }} kamar

                            </p>

                        </div>

                    </div>

                    {{-- FASILITAS --}}
                    <div class="mb-10">

                        <h3 class="text-2xl font-bold text-gray-800 mb-5">

                            Fasilitas

                        </h3>

                        <div class="flex flex-wrap gap-3">

                            @if($kos->fasilitas)

                                @foreach(explode(',', $kos->fasilitas) as $item)

                                    <span class="px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 text-sm font-medium">

                                        {{ trim($item) }}

                                    </span>

                                @endforeach

                            @else

                                <p class="text-gray-400">

                                    Belum ada fasilitas

                                </p>

                            @endif

                        </div>

                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-10">

                        <h3 class="text-2xl font-bold text-gray-800 mb-5">

                            Deskripsi Kos

                        </h3>

                        <p class="text-gray-600 leading-relaxed">

                            {{ $kos->deskripsi ?? 'Belum ada deskripsi.' }}

                        </p>

                    </div>

                    {{-- KONTAK --}}
                    <div class="grid md:grid-cols-2 gap-6 mb-10">

                        {{-- WHATSAPP --}}
                        <div class="bg-gray-50 rounded-2xl p-5">

                            <h4 class="font-semibold text-gray-700 mb-2">

                                WhatsApp

                            </h4>

                            <p class="text-gray-600">

                                {{ $kos->no_hp ?? '-' }}

                            </p>

                        </div>

                        {{-- INSTAGRAM --}}
                        <div class="bg-gray-50 rounded-2xl p-5">

                            <h4 class="font-semibold text-gray-700 mb-2">

                                Instagram

                            </h4>

                            <p class="text-gray-600">

                                {{ $kos->instagram ?? '-' }}

                            </p>

                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="flex flex-wrap gap-4">

                        {{-- WA --}}
                        @if($kos->no_hp)

                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kos->no_hp) }}"
                           target="_blank"
                           class="inline-flex items-center px-6 py-4 bg-green-500 hover:bg-green-600 text-white rounded-2xl font-semibold shadow-lg transition">

                            Hubungi WhatsApp

                        </a>

                        @endif

                        {{-- MAPS --}}
                        @if($kos->lokasi_maps)

                        <a href="{{ $kos->lokasi_maps }}"
                           target="_blank"
                           class="inline-flex items-center px-6 py-4 bg-red-500 hover:bg-red-600 text-white rounded-2xl font-semibold shadow-lg transition">

                            Buka Google Maps

                        </a>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>