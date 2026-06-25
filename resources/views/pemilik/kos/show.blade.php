<x-app-layout>

<div class="min-h-screen bg-gray-50 py-10">

    <div class="max-w-6xl mx-auto px-6">

        {{-- BACK --}}
        <a href="{{ route('pemilik.dashboard') }}"
           class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-6 font-semibold">

            ← Kembali

        </a>

        {{-- CARD --}}
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

            {{-- FOTO --}}
            <div class="h-[400px] bg-gray-100 overflow-hidden">

                @if($kos->foto)

                    {{-- SLIDER FOTO --}}
<div x-data="{ activeSlide: 0 }" class="relative">

    @php

        $allFotos = [];

        if ($kos->foto) {

            $allFotos[] = $kos->foto;
        }

        foreach ($kos->fotos as $foto) {

            $allFotos[] = $foto->foto;
        }

    @endphp

    {{-- FOTO --}}
    <div class="overflow-hidden rounded-3xl shadow-lg">

        @foreach($allFotos as $index => $foto)

            <div x-show="activeSlide === {{ $index }}"
                 x-transition
                 class="w-full">

                <img src="{{ asset('uploads/kos/' . $foto) }}"
                     class="w-full h-[450px] object-cover">

            </div>

        @endforeach

    </div>

    {{-- BUTTON PREV --}}
    <button @click="activeSlide = activeSlide === 0 ? {{ count($allFotos)-1 }} : activeSlide - 1"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-black w-10 h-10 rounded-full shadow">

        ←

    </button>

    {{-- BUTTON NEXT --}}
    <button @click="activeSlide = activeSlide === {{ count($allFotos)-1 }} ? 0 : activeSlide + 1"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-black w-10 h-10 rounded-full shadow">

        →

    </button>

    {{-- THUMBNAIL --}}
    <div class="flex gap-3 mt-4 overflow-x-auto">

        @foreach($allFotos as $index => $foto)

            <img src="{{ asset('uploads/kos/' . $foto) }}"
                 @click="activeSlide = {{ $index }}"
                 class="w-24 h-20 object-cover rounded-xl cursor-pointer border-4"
                 :class="activeSlide === {{ $index }} ? 'border-indigo-600' : 'border-transparent'">

        @endforeach

    </div>

</div>

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

                        <p class="text-gray-500 mb-4">

                            {{ $kos->alamat }}

                        </p>

                        {{-- STATUS --}}
                        @if($kos->status_kos == 'Tersedia')

                            <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">

                                Tersedia

                            </span>

                        @elseif($kos->status_kos == 'Penuh')

                            <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-semibold">

                                Penuh

                            </span>

                        @else

                            <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">

                                Maintenance

                            </span>

                        @endif

                    </div>

                    {{-- JENIS --}}
                    <div>

                        <span class="px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 text-sm font-semibold">

                            {{ $kos->jenis_kos }}

                        </span>

                    </div>

                </div>

                {{-- HARGA + SISA --}}
                <div class="grid md:grid-cols-2 gap-6 mb-8">

                    <div class="bg-gray-50 rounded-2xl p-5">

                        <h3 class="text-lg font-semibold text-gray-700 mb-2">

                            Harga Per Bulan

                        </h3>

                        <p class="text-3xl font-bold text-indigo-600">

                            Rp {{ number_format($kos->harga_per_bulan, 0, ',', '.') }}

                        </p>

                    </div>

                    <div class="bg-gray-50 rounded-2xl p-5">

                        <h3 class="text-lg font-semibold text-gray-700 mb-2">

                            Sisa Kamar

                        </h3>

                        <p class="text-xl text-gray-700">

                            {{ $kos->sisa_kamar }} kamar tersedia

                        </p>

                    </div>

                </div>

                {{-- FASILITAS --}}
                <div class="mb-8">

                    <h3 class="text-lg font-semibold text-gray-700 mb-4">

                        Fasilitas

                    </h3>

                    <div class="flex flex-wrap gap-3">

                        @if($kos->fasilitas)

                            @foreach(explode(',', $kos->fasilitas) as $item)

                                <span class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full text-sm">

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
                <div class="mb-8">

                    <h3 class="text-lg font-semibold text-gray-700 mb-3">

                        Deskripsi

                    </h3>

                    <p class="text-gray-600 leading-relaxed">

                        {{ $kos->deskripsi ?? 'Belum ada deskripsi.' }}

                    </p>

                </div>

                {{-- KONTAK --}}
                <div class="grid md:grid-cols-2 gap-6 mb-8">

                    {{-- WHATSAPP --}}
                    <div class="bg-gray-50 rounded-2xl p-5">

                        <h3 class="font-semibold text-gray-700 mb-3">

                            Nomor WhatsApp

                        </h3>

                        <p class="text-gray-600 mb-4">

                            {{ $kos->no_hp ?? '-' }}

                        </p>

                        @if($kos->no_hp)

                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kos->no_hp) }}"
                               target="_blank"
                               class="inline-flex items-center px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded-2xl font-semibold">

                                Hubungi WhatsApp

                            </a>

                        @endif

                    </div>

                   {{-- INSTAGRAM --}}
<div class="bg-gray-50 rounded-2xl p-5">

    <h3 class="font-semibold text-gray-700 mb-3">

        Instagram

    </h3>

    @if($kos->instagram)

        <p class="text-gray-600 mb-4">

            {{ $kos->instagram }}

        </p>

        <a href="https://instagram.com/{{ ltrim($kos->instagram, '@') }}"
           target="_blank"
           class="inline-flex items-center px-6 py-3 bg-pink-500 hover:bg-pink-600 text-white rounded-2xl font-semibold transition">

            Kunjungi Instagram

        </a>

    @else

        <p class="text-gray-400">

            Tidak ada Instagram

        </p>

    @endif

</div>

                </div>

               {{-- MAPS --}}
@if($kos->lokasi_maps)

<div class="mb-8">

    <h3 class="text-lg font-semibold text-gray-700 mb-4">

        Lokasi Kos

    </h3>

    {{-- EMBED MAPS --}}
    <div class="rounded-3xl overflow-hidden shadow-lg mb-5">

        <iframe
            src="{{ $kos->lokasi_maps }}"
            width="100%"
            height="350"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">

        </iframe>

    </div>

    {{-- BUTTON --}}
    <a href="{{ $kos->lokasi_maps }}"
       target="_blank"
       class="inline-flex items-center px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-2xl font-semibold transition">

        Buka Google Maps

    </a>

</div>

@endif

                

            </div>

        </div>

    </div>

</div>

</x-app-layout>