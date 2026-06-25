<x-app-layout>
    <div class="flex h-screen bg-gray-100" x-data="{ sidebarOpen: false }">
        <div :class="sidebarOpen ? 'flex' : 'hidden'" @click.away="sidebarOpen = false" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-indigo-900 lg:translate-x-0 lg:static lg:inset-0 flex flex-col justify-between lg:flex">
            <div>
                <div class="flex items-center justify-center mt-8">
                    <div class="flex items-center">
                        <span class="text-2xl font-bold text-white tracking-wider uppercase">Nyamankost</span>
                    </div>
                </div>

                <nav class="mt-10">
                    <a class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-800 hover:bg-opacity-50 hover:text-white transition font-medium" href="{{ route('pemilik.dashboard') }}">
                        <i class="fa-solid fa-gauge-high w-6 text-lg"></i>
                        <span class="mx-3">Dashboard</span>
                    </a>

                    <a class="flex items-center px-6 py-3 mt-2 text-gray-100 bg-indigo-800 bg-opacity-75 border-l-4 border-white font-medium" href="#">
                        <i class="fa-solid fa-house-chimney w-6 text-lg"></i>
                        <span class="mx-3">Kelola Kos</span>
                    </a>
                    
                    <a class="flex items-center px-6 py-3 mt-2 text-gray-300 hover:bg-indigo-800 hover:bg-opacity-50 hover:text-white transition font-medium" href="#">
                        <i class="fa-solid fa-users w-6 text-lg"></i>
                        <span class="mx-3">Penyewa Aktif</span>
                    </a>
                </nav>
            </div>

            <div class="px-6 mt-auto mb-10 w-full">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center justify-center w-full px-4 py-2.5 text-red-200 border border-red-400/50 hover:bg-red-600 hover:text-white hover:border-transparent rounded-lg transition duration-200 font-medium shadow-sm">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <h2 class="text-xl font-bold text-gray-800 mx-4 lg:mx-0">Tambah Properti Kos</h2>
                </div>

                <div class="flex items-center">
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2 focus:outline-none">

                        </button>

                        
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                <div class="container mx-auto max-w-4xl">
                    <a href="{{ route('pemilik.dashboard') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 mb-6 transition">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
                    </a>
{{-- ========================= --}}
{{-- FORM TAMBAH KOS FINAL --}}
{{-- ========================= --}}

<form action="{{ route('pemilik.kos.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="space-y-6">

    @csrf

    {{-- ERROR --}}
    @if ($errors->any())

        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">

            <ul class="list-disc pl-5">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- NAMA KOS --}}
    <div>

        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Nama Kos
        </label>

        <input type="text"
               name="nama_kos"
               value="{{ old('nama_kos') }}"
               required
               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500">

    </div>

    {{-- JENIS KOS --}}
    <div>

        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Jenis Kos
        </label>

        <select name="jenis_kos"
                required
                class="w-full border border-gray-300 rounded-xl px-4 py-3">

            <option value="">Pilih Jenis Kos</option>

            <option value="Putra">Putra</option>

            <option value="Putri">Putri</option>

            <option value="Campur">Campur</option>

        </select>

    </div>

    {{-- HARGA --}}
    <div>

        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Harga Per Bulan
        </label>

        <input type="number"
               name="harga_per_bulan"
               value="{{ old('harga_per_bulan') }}"
               required
               class="w-full border border-gray-300 rounded-xl px-4 py-3">

    </div>

    {{-- SISA KAMAR --}}
    <div>

        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Sisa Kamar
        </label>

        <input type="number"
               name="sisa_kamar"
               value="{{ old('sisa_kamar') }}"
               required
               class="w-full border border-gray-300 rounded-xl px-4 py-3">

    </div>

    {{-- ALAMAT --}}
    <div>

        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Alamat Lengkap
        </label>

        <textarea name="alamat"
                  rows="4"
                  required
                  class="w-full border border-gray-300 rounded-xl px-4 py-3">{{ old('alamat') }}</textarea>

    </div>

    {{-- GOOGLE MAP --}}
    <div>

        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Link Google Maps / Lokasi
        </label>

        <input type="url"
               name="lokasi_maps"
               value="{{ old('lokasi_maps') }}"
               placeholder="https://maps.google.com/..."
               class="w-full border border-gray-300 rounded-xl px-4 py-3">

    </div>

    {{-- NOMOR HP --}}
    <div>

        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Nomor HP / WhatsApp
        </label>

        <input type="text"
               name="no_hp"
               value="{{ old('no_hp') }}"
               placeholder="08xxxxxxxxxx"
               class="w-full border border-gray-300 rounded-xl px-4 py-3">

    </div>

    {{-- INSTAGRAM --}}
    <div>

        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Instagram
        </label>

        <input type="text"
               name="instagram"
               value="{{ old('instagram') }}"
               placeholder="@namakos"
               class="w-full border border-gray-300 rounded-xl px-4 py-3">

    </div>

    {{-- FACEBOOK --}}
    <div>

        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Facebook
        </label>

        <input type="text"
               name="facebook"
               value="{{ old('facebook') }}"
               placeholder="Nama Facebook"
               class="w-full border border-gray-300 rounded-xl px-4 py-3">

    </div>

    {{-- TIKTOK --}}
    <div>

        <label class="block text-sm font-semibold text-gray-700 mb-2">
            TikTok
        </label>

        <input type="text"
               name="tiktok"
               value="{{ old('tiktok') }}"
               placeholder="@tiktok"
               class="w-full border border-gray-300 rounded-xl px-4 py-3">
</div>
{{-- STATUS --}}
<div>

    <label class="block text-sm font-semibold text-gray-700 mb-2">
        Status Kos
    </label>

    <select name="status_kos"
            class="w-full border border-gray-300 rounded-xl px-4 py-3">

        <option value="Tersedia">
            Tersedia
        </option>

        <option value="Penuh">
            Penuh
        </option>

        <option value="Maintenance">
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
              class="w-full border border-gray-300 rounded-xl px-4 py-3"></textarea>

</div>

    {{-- FASILITAS --}}
    <div>

        <label class="block text-sm font-semibold text-gray-700 mb-3">
            Fasilitas Kos
        </label>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">

            <label class="flex items-center gap-2">
                <input type="checkbox" name="fasilitas[]" value="WiFi">
                WiFi
            </label>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="fasilitas[]" value="AC">
                AC
            </label>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="fasilitas[]" value="Kasur">
                Kasur
            </label>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="fasilitas[]" value="Lemari">
                Lemari
            </label>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="fasilitas[]" value="Kamar Mandi Dalam">
                Kamar Mandi Dalam
            </label>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="fasilitas[]" value="Dapur">
                Dapur
            </label>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="fasilitas[]" value="Parkir">
                Parkir
            </label>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="fasilitas[]" value="Laundry">
                Laundry
            </label>

        </div>

    </div>

    {{-- FOTO --}}
    <div>

        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Upload Foto Kos
        </label>

        <input type="file"
               name="foto"
               accept="image/*"
               class="w-full border border-gray-300 rounded-xl px-4 py-3">

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
    <div>
        <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow-md transition">

            Simpan Kos

        </button>

    </div>

</form>
                    </div>

                </div>
            </main>
        </div>
    </div>
</x-app-layout>