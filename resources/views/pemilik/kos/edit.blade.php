<x-app-layout>

<div class="min-h-screen bg-gray-50 py-10">

    <div class="max-w-5xl mx-auto px-6">
           {{-- BACK --}}
        <a href="{{ route('pemilik.dashboard') }}"
           class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-6 font-semibold">

            ← Kembali

        </a>


        {{-- CARD --}}
        <div class="bg-white shadow-xl rounded-3xl overflow-hidden">

            {{-- HEADER --}}
            <div class="bg-indigo-600 px-8 py-6">

                <h2 class="text-3xl font-bold text-white">
                    Edit Data Kos
                </h2>

                <p class="text-indigo-100 mt-2">
                    Perbarui informasi properti kos Anda
                </p>

            </div>

            {{-- FORM --}}
            <form action="{{ route('pemilik.kos.update', $kos->id) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="p-8 space-y-8">

                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Kos
                    </label>

                    <input type="text"
                           name="nama_kos"
                           value="{{ old('nama_kos', $kos->nama_kos) }}"
                           class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-indigo-500">

                </div>

                {{-- JENIS --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Jenis Kos
                    </label>

                    <select name="jenis_kos"
                            class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-indigo-500">

                        <option value="Putra"
                            {{ $kos->jenis_kos == 'Putra' ? 'selected' : '' }}>

                            Putra

                        </option>

                        <option value="Putri"
                            {{ $kos->jenis_kos == 'Putri' ? 'selected' : '' }}>

                            Putri

                        </option>

                        <option value="Campur"
                            {{ $kos->jenis_kos == 'Campur' ? 'selected' : '' }}>

                            Campur

                        </option>

                    </select>

                </div>

                {{-- HARGA --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Harga Per Bulan
                    </label>

                    <input type="number"
                           name="harga_per_bulan"
                           value="{{ old('harga_per_bulan', $kos->harga_per_bulan) }}"
                           class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-indigo-500">

                </div>

                {{-- SISA --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Sisa Kamar
                    </label>

                    <input type="number"
                           name="sisa_kamar"
                           value="{{ old('sisa_kamar', $kos->sisa_kamar) }}"
                           class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-indigo-500">

                </div>

                {{-- ALAMAT --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Alamat Lengkap
                    </label>

                    <textarea name="alamat"
                              rows="4"
                              class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-indigo-500">{{ old('alamat', $kos->alamat) }}</textarea>

                </div>

                {{-- STATUS --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Status Kos
                    </label>

                    <select name="status_kos"
                            class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-indigo-500">

                        <option value="Tersedia"
                            {{ $kos->status_kos == 'Tersedia' ? 'selected' : '' }}>

                            Tersedia

                        </option>

                        <option value="Penuh"
                            {{ $kos->status_kos == 'Penuh' ? 'selected' : '' }}>

                            Penuh

                        </option>

                        <option value="Maintenance"
                            {{ $kos->status_kos == 'Maintenance' ? 'selected' : '' }}>

                            Maintenance

                        </option>

                    </select>

                </div>

                {{-- DESKRIPSI --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi Kos
                    </label>

                    <textarea name="deskripsi"
                              rows="5"
                              class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-indigo-500">{{ old('deskripsi', $kos->deskripsi) }}</textarea>

                </div>

                {{-- NOMOR HP --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor WhatsApp
                    </label>

                    <input type="text"
                           name="no_hp"
                           value="{{ old('no_hp', $kos->no_hp) }}"
                           class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-indigo-500">

                </div>

                {{-- INSTAGRAM --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Instagram
                    </label>

                    <input type="text"
                           name="instagram"
                           value="{{ old('instagram', $kos->instagram) }}"
                           class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-indigo-500">

                </div>

                {{-- GOOGLE MAPS --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Link Google Maps
                    </label>

                    <input type="text"
                           name="lokasi_maps"
                           value="{{ old('lokasi_maps', $kos->lokasi_maps) }}"
                           class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-indigo-500">

                </div>

                {{-- FASILITAS --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Fasilitas
                    </label>

                    @php
                        $fasilitasKos = explode(',', $kos->fasilitas);
                    @endphp

                    <div class="grid md:grid-cols-3 gap-4">

                        @foreach([
                            'WiFi',
                            'Kasur',
                            'Lemari',
                            'Kamar Mandi Dalam',
                            'Dapur',
                            'Parkir',
                            'AC',
                            'Laundry'
                        ] as $item)

                        <label class="flex items-center gap-3 bg-gray-50 p-3 rounded-xl">

                            <input type="checkbox"
                                   name="fasilitas[]"
                                   value="{{ $item }}"
                                   {{ in_array($item, $fasilitasKos) ? 'checked' : '' }}>

                            <span>
                                {{ $item }}
                            </span>

                        </label>

                        @endforeach

                    </div>

                </div>

                {{-- FOTO --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Foto Kos
                    </label>

                    @if($kos->foto)

                        <img src="{{ asset('uploads/kos/' . $kos->foto) }}"
                             class="w-52 rounded-2xl shadow mb-5">

                    @endif

                    <input type="file"
                           name="foto"
                           class="w-full border border-gray-300 rounded-2xl px-4 py-3">

                </div>
                {{-- GALERI FOTO --}}
<div>

    <label class="block text-sm font-semibold text-gray-700 mb-3">

        Galeri Foto Kos

    </label>

    <input type="file"
           name="fotos[]"
           multiple
           class="w-full border border-gray-300 rounded-2xl px-4 py-3">

    <p class="text-sm text-gray-400 mt-2">

        Bisa pilih banyak foto sekaligus

    </p>

</div>

                {{-- BUTTON --}}
                <div class="pt-4">

                    <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-2xl font-bold text-lg transition">

                        Update Data Kos

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>