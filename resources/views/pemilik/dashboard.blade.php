<x-app-layout>

    <div class="flex h-screen bg-gray-100" x-data="{ sidebarOpen: false }">

        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'flex' : 'hidden'"
             @click.away="sidebarOpen = false"
             class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-indigo-900 lg:translate-x-0 lg:static lg:inset-0 flex flex-col justify-between lg:flex">

            <div>

                <div class="flex items-center justify-center mt-8">
                    <span class="text-2xl font-bold text-white tracking-wider uppercase">
                        Nyamankost
                    </span>
                </div>

                <nav class="mt-10">

                    <a class="flex items-center px-6 py-3 text-gray-100 bg-indigo-800 bg-opacity-75 border-l-4 border-white font-medium"
                       href="{{ route('pemilik.dashboard') }}">

                        <i class="fa-solid fa-gauge-high w-6 text-lg"></i>

                        <span class="mx-3">Dashboard</span>

                    </a>

                    {{-- KELOLA KOS --}}
    <a href="{{ route('pemilik.kelola-kos') }}"
       class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-800 hover:text-white transition font-medium">

        <i class="fa-solid fa-house-chimney w-6 text-lg"></i>

        <span class="mx-3">
            Kelola Kos
        </span>

    </a>


    <a href="{{ route('pemilik.penyewa.index') }}"
   class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-800 hover:text-white transition font-medium">

    <i class="fa-solid fa-users w-6 text-lg"></i>

    <span class="mx-3">
        Penyewa Aktif
    </span>

</a>

<a href="{{ route('pemilik.pembayaran') }}"
   class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-800 hover:text-white transition font-medium">

    <i class="fa-solid fa-money-bill-wave w-6 text-lg"></i>

    <span class="mx-3">
        Pembayaran
    </span>

</a>

<a href="{{ route('profile.edit') }}"
   class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-800 hover:text-white transition font-medium">

    <i class="fa-solid fa-user-gear w-6 text-lg"></i>

    <span class="mx-3">
        Profil Saya
    </span>

</a>
</nav>
            </div>

            <div class="px-6 mt-auto mb-10 w-full">

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit"
                            class="flex items-center justify-center w-full px-4 py-2.5 text-red-200 border border-red-400/50 hover:bg-red-600 hover:text-white hover:border-transparent rounded-lg transition duration-200 font-medium shadow-sm">

                        <i class="fa-solid fa-right-from-bracket mr-2"></i>

                        <span>Keluar</span>

                    </button>

                </form>

            </div>

        </div>

        <!-- Main -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
        <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200 shadow-sm">

    <div class="flex items-center">

        <button @click="sidebarOpen = true"
                class="text-gray-500 focus:outline-none lg:hidden">

            <i class="fa-solid fa-bars text-xl"></i>

        </button>

        <div class="relative mx-4 lg:mx-0">

            <h2 class="text-2xl font-bold text-gray-800">
                Panel Kendali Juragan
            </h2>

            <p class="text-sm text-gray-500">
                Kelola properti kos Anda dengan mudah
            </p>

        </div>

    </div>

    {{-- PROFILE DROPDOWN --}}
    <div class="flex items-center">

        <div x-data="{ dropdownOpen: false }"
             class="relative">

            {{-- BUTTON --}}
            <button @click="dropdownOpen = !dropdownOpen"
                    class="flex items-center space-x-3 focus:outline-none bg-white hover:bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 shadow-sm transition">

                {{-- USER NAME --}}
                <div class="text-right hidden sm:block">

                    <p class="text-sm font-semibold text-gray-700">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-xs text-gray-400">
                        Pemilik Kos
                    </p>

                </div>

                {{-- AVATAR --}}
                @if(Auth::user()->foto_profil)
                    <img class="object-cover w-10 h-10 rounded-full border-2 border-indigo-500 shadow-sm"
                         src="{{ asset('storage/'.Auth::user()->foto_profil) }}"
                         alt="Avatar">
                @else
                    <img class="object-cover w-10 h-10 rounded-full border-2 border-indigo-500 shadow-sm"
                         src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff"
                         alt="Avatar">
                @endif

                {{-- ICON --}}
                <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>

            </button>

            {{-- DROPDOWN --}}
            <div x-show="dropdownOpen"
                 x-transition
                 @click.outside="dropdownOpen = false"
                 class="absolute right-0 mt-3 w-60 bg-white rounded-2xl overflow-hidden shadow-xl z-50 border border-gray-100"
                 style="display: none;">

                {{-- PROFILE --}}
                <div class="px-5 py-4 bg-gradient-to-r from-indigo-500 to-indigo-600">

                    <p class="text-white font-semibold">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-indigo-100 text-sm">
                        {{ Auth::user()->email }}
                    </p>

                </div>

                {{-- MENU --}}
                <div class="py-2">

                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center px-5 py-3 text-sm text-gray-700 hover:bg-indigo-50 transition">

                        <i class="fa-solid fa-user-gear mr-3 text-indigo-500"></i>

                        Pengaturan Profil

                    </a>

                    <a href="{{ route('pemilik.dashboard') }}"
                       class="flex items-center px-5 py-3 text-sm text-gray-700 hover:bg-indigo-50 transition">

                        <i class="fa-solid fa-house mr-3 text-indigo-500"></i>

                        Dashboard

                    </a>

                    <div class="border-t border-gray-100 my-2"></div>

                    {{-- LOGOUT --}}
                    <form method="POST"
                          action="{{ route('logout') }}">

                        @csrf

                        <button type="submit"
                                class="flex items-center w-full text-left px-5 py-3 text-sm text-red-600 hover:bg-red-50 transition">

                            <i class="fa-solid fa-right-from-bracket mr-3"></i>

                            Keluar

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</header>

        
{{-- ===================================== --}}
{{-- NOTIFIKASI SUCCESS --}}
{{-- ===================================== --}}

@if(session('success'))

<div id="success-alert"
     class="mb-6 flex items-center p-4 text-green-800 border border-green-300 rounded-xl bg-green-50 shadow-sm transition-all duration-500">

    <div class="flex-shrink-0">

        <svg class="w-5 h-5"
             fill="currentColor"
             viewBox="0 0 20 20">

            <path fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.172 7.707 8.879a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                  clip-rule="evenodd">
            </path>

        </svg>

    </div>

    <div class="ml-3 text-sm font-medium">

        {{ session('success') }}

    </div>

</div>

<script>

    setTimeout(() => {

        const alert = document.getElementById('success-alert');

        if(alert){

            alert.style.opacity = '0';

            alert.style.transform = 'translateY(-10px)';

            setTimeout(() => {

                alert.remove();

            }, 500);

        }

    }, 3000);

</script>

@endif
                <div class="container mx-auto">

                    <h3 class="text-3xl font-bold text-gray-800 mb-2">
                        Halo, {{ Auth::user()->name }} 👋
                    </h3>

                    <p class="text-gray-500 text-sm mb-6">
                        Berikut adalah ringkasan bisnis kos Anda hari ini.
                    </p>

                    <!-- Statistik -->
                    <div class="flex flex-wrap -mx-6">

                        <!-- Total Properti -->
                        <div class="w-full px-6 sm:w-1/2 xl:w-1/3">

                            <div class="flex items-center px-5 py-6 bg-white rounded-xl shadow-sm border border-gray-100">

                                <div class="p-3 bg-blue-500 bg-opacity-10 rounded-lg">

                                    <i class="fa-solid fa-hotel text-blue-500 text-2xl w-8 text-center"></i>

                                </div>

                                <div class="mx-5">

                                    <h4 class="text-2xl font-bold text-gray-800">
                                        {{ $totalKos }}
                                    </h4>

                                    <div class="text-gray-500 text-sm">
                                        Total Properti
                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Kamar Terisi -->
                        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">

                            <div class="flex items-center px-5 py-6 bg-white rounded-xl shadow-sm border border-gray-100">

                                <div class="p-3 bg-green-500 bg-opacity-10 rounded-lg">

                                    <i class="fa-solid fa-door-open text-green-500 text-2xl w-8 text-center"></i>

                                </div>

                                <div class="mx-5">

                                    <h4 class="text-2xl font-bold text-gray-800">
                                        {{ $kamarTerisi }}
                                    </h4>

                                    <div class="text-gray-500 text-sm">
                                        Kamar Terisi
                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Omzet -->
                        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">

                            <div class="flex items-center px-5 py-6 bg-white rounded-xl shadow-sm border border-gray-100">

                                <div class="p-3 bg-yellow-500 bg-opacity-10 rounded-lg">

                                    <i class="fa-solid fa-hand-holding-dollar text-yellow-500 text-2xl w-8 text-center"></i>

                                </div>

                                <div class="mx-5">

                                    <h4 class="text-2xl font-bold text-gray-800">
                                        Rp {{ number_format($omzet, 0, ',', '.') }}
                                    </h4>

                                    <div class="text-gray-500 text-sm">
                                        Estimasi Omzet
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Tabel -->
                    <div class="mt-8">

                        <div class="flex items-center justify-between mb-4">

                            <h4 class="text-gray-700 font-bold text-lg">
                                Daftar Properti Kos Anda
                            </h4>

                            <a href="{{ route('pemilik.kos.create') }}"
                               class="inline-flex items-center bg-indigo-600 text-white font-medium text-sm px-4 py-2 rounded-lg shadow-sm hover:bg-indigo-700 transition">

                                <i class="fa-solid fa-plus mr-1"></i>

                                Tambah Kos Baru

                            </a>

                        </div>

                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

                            <table class="min-w-full">

                                <thead class="bg-gray-50 border-b border-gray-100">

    <tr>

        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
            Nama Kos
        </th>

        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
            Lokasi
        </th>

        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
            Harga
        </th>

        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
            Tipe
        </th>

        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">
            Foto
        </th>

        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">
            Aksi
        </th>

    </tr>

</thead>

                                <tbody class="divide-y divide-gray-100">

@if($myKos->count() > 0)

    @foreach($myKos as $kos)

    <tr class="hover:bg-gray-50 transition">

        {{-- NAMA --}}
        <td class="px-6 py-4 text-sm font-semibold text-gray-800">

            {{ $kos->nama_kos }}

        </td>

        {{-- LOKASI --}}
        <td class="px-6 py-4 text-sm text-gray-500">

            {{ $kos->alamat }}

        </td>

        {{-- HARGA --}}
        <td class="px-6 py-4 text-sm font-medium text-gray-700">

            Rp {{ number_format($kos->harga_per_bulan, 0, ',', '.') }}

        </td>

        {{-- TIPE --}}
        <td class="px-6 py-4">

            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">

                {{ $kos->jenis_kos }}

            </span>

        </td>

        {{-- FOTO --}}
        <td class="px-6 py-4 text-center">

            @if($kos->foto)

                <img src="{{ asset('uploads/kos/' . $kos->foto) }}"
                     class="w-16 h-16 rounded-xl object-cover mx-auto shadow-sm">

            @else

                <span class="text-xs text-gray-400">

                    Tidak ada foto

                </span>

            @endif

        </td>

        {{-- AKSI --}}
        <td class="px-6 py-4">

            <div class="flex items-center justify-center gap-3">

                {{-- DETAIL --}}
                <a href="{{ route('pemilik.kos.show', $kos->id) }}"
                   class="px-3 py-1.5 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 text-xs font-medium transition">

                    Detail

                </a>

                {{-- EDIT --}}
                <a href="{{ route('pemilik.kos.edit', $kos->id) }}"
                   class="px-3 py-1.5 rounded-lg bg-indigo-100 text-indigo-700 hover:bg-indigo-200 text-xs font-medium transition">

                    Edit

                </a>

                {{-- HAPUS --}}
                <button type="button"
                        onclick="openDeleteModal({{ $kos->id }})"
                        class="px-3 py-1.5 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 text-xs font-medium transition">

                    Hapus

                </button>

            </div>

        </td>

    </tr>

    @endforeach

@else

    <tr>

        <td colspan="6"
            class="px-6 py-8 text-center text-gray-400 italic">

            Belum ada data kos.

        </td>

    </tr>

@endif

</tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </main>

        </div>

    </div>
{{-- ===================================== --}}
{{-- MODAL DELETE --}}
{{-- ===================================== --}}

<div id="deleteModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8">

        <div class="text-center">

            {{-- ICON --}}
            <div class="mx-auto flex items-center justify-center w-20 h-20 rounded-full bg-red-100 mb-5">

                <i class="fa-solid fa-trash text-red-600 text-3xl"></i>

            </div>

            {{-- TITLE --}}
            <h3 class="text-2xl font-bold text-gray-800 mb-3">

                Hapus Data Kos?

            </h3>

            {{-- TEXT --}}
            <p class="text-gray-500 mb-8">

                Data kos yang dihapus tidak dapat dikembalikan lagi.

            </p>

            {{-- BUTTON --}}
            <div class="flex items-center justify-center gap-4">

                {{-- CANCEL --}}
                <button onclick="closeDeleteModal()"
                        class="px-5 py-3 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-100 transition">

                    Batal

                </button>

                {{-- DELETE --}}
                <form id="deleteForm"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="px-5 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white transition">

                        Ya, Hapus

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

{{-- ===================================== --}}
{{-- SCRIPT MODAL --}}
{{-- ===================================== --}}

<script>

    function openDeleteModal(id)
    {
        const modal = document.getElementById('deleteModal');

        const form = document.getElementById('deleteForm');

        form.action = `/dashboard-pemilik/kos/${id}`;

        modal.classList.remove('hidden');

        modal.classList.add('flex');
    }

    function closeDeleteModal()
    {
        const modal = document.getElementById('deleteModal');

        modal.classList.remove('flex');

        modal.classList.add('hidden');
    }

</script>
</x-app-layout>