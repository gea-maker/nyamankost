<x-app-layout>

<div class="flex min-h-screen bg-gray-100">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar')

    {{-- CONTENT --}}
    <main class="flex-1">

        {{-- HEADER --}}
        <header class="bg-white shadow-sm px-8 py-5 flex justify-between items-center">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Penyewa Aktif
                </h1>

                <p class="text-gray-500 mt-1">
                    Kelola data penyewa kos Anda
                </p>

            </div>

            <div class="flex items-center gap-4">

                <div class="text-right">

                    <h3 class="font-semibold text-gray-800">
                        {{ Auth::user()->name }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        Pemilik Kos
                    </p>

                </div>

                @if(Auth::user()->foto_profil)
                    <img class="w-12 h-12 rounded-full object-cover border-2 border-indigo-500 shadow-sm"
                         src="{{ asset('storage/'.Auth::user()->foto_profil) }}"
                         alt="Avatar">
                @else
                    <div class="w-12 h-12 rounded-full bg-indigo-500 text-white flex items-center justify-center font-bold text-lg">
                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                    </div>
                @endif

            </div>

        </header>

        {{-- CONTENT --}}
        <div class="p-8">

            {{-- CARD STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

                {{-- TOTAL PENYEWA --}}
                <div class="bg-white rounded-3xl shadow-sm p-6">

                    <p class="text-gray-500 text-sm">
                        Total Penyewa
                    </p>

                    <h2 class="text-4xl font-bold text-indigo-600 mt-3">

                        {{ $totalPenyewa }}

                    </h2>

                </div>

                {{-- KAMAR TERISI --}}
                <div class="bg-white rounded-3xl shadow-sm p-6">

                    <p class="text-gray-500 text-sm">
                        Kamar Terisi
                    </p>

                    <h2 class="text-4xl font-bold text-green-600 mt-3">

                        {{ $kamarTerisi }}

                    </h2>

                </div>

                {{-- PEMBAYARAN --}}
                <div class="bg-white rounded-3xl shadow-sm p-6">

                    <p class="text-gray-500 text-sm">
                        Pembayaran Bulan Ini
                    </p>

                    <h2 class="text-3xl font-bold text-yellow-600 mt-3">

                        Rp {{ number_format($totalPembayaran,0,',','.') }}

                    </h2>

                </div>

                {{-- JATUH TEMPO --}}
                <div class="bg-white rounded-3xl shadow-sm p-6">

                    <p class="text-gray-500 text-sm">
                        Jatuh Tempo Hari Ini
                    </p>

                    <h2 class="text-4xl font-bold text-red-500 mt-3">

                        {{ $jatuhTempo }}

                    </h2>

                </div>

            </div>

            {{-- HEADER TABLE --}}
            <div class="flex items-center justify-between mb-6">

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">
                        Data Penyewa
                    </h2>

                    <p class="text-gray-500 mt-1">
                        Semua penyewa aktif saat ini
                    </p>

                </div>

                <a href="{{ route('pemilik.penyewa.create') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl shadow-lg transition">

                    + Tambah Penyewa

                </a>

            </div>

            {{-- TABLE --}}
            <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr class="text-left text-gray-600 text-sm">

                            <th class="p-5">Penyewa</th>

                            <th class="p-5">Kos</th>

                            <th class="p-5">Kamar</th>

                            <th class="p-5">Tanggal Huni</th>

                            <th class="p-5">Jatuh Tempo</th>

                            <th class="p-5">Pembayaran</th>

                            <th class="p-5">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($dataPenyewa as $penyewa)

                        <tr class="border-b hover:bg-gray-50 transition">

                            {{-- PENYEWA --}}
                            <td class="p-5">

                                <div class="flex items-center gap-4">

                                    <div class="w-12 h-12 rounded-full bg-indigo-500 text-white flex items-center justify-center font-bold">

                                        {{ strtoupper(substr($penyewa->nama,0,1)) }}

                                    </div>

                                    <div>

                                        <h3 class="font-semibold text-gray-800">

                                            {{ $penyewa->nama }}

                                        </h3>

                                        <p class="text-sm text-gray-500">

                                            {{ $penyewa->no_hp }}

                                        </p>

                                    </div>

                                </div>

                            </td>

                            {{-- KOS --}}
                            <td class="p-5">

                                {{ $penyewa->kos->nama_kos ?? '-' }}

                            </td>

                            {{-- KAMAR --}}
                            <td class="p-5">

                                {{ $penyewa->nomor_kamar }}

                            </td>

                            {{-- TANGGAL HUNI --}}
                            <td class="p-5">

                                {{ \Carbon\Carbon::parse($penyewa->tanggal_masuk)->translatedFormat('d F Y') }}

                            </td>

                            {{-- JATUH TEMPO --}}
                            <td class="p-5 font-semibold

                                {{ \Carbon\Carbon::parse($penyewa->jatuh_tempo)->isPast()
                                    ? 'text-red-600'
                                    : 'text-gray-700' }}">

                                {{ \Carbon\Carbon::parse($penyewa->jatuh_tempo)->translatedFormat('d F Y') }}

                            </td>

                            {{-- STATUS --}}
                            <td class="p-5">

                                <span class="px-4 py-2 rounded-full text-sm font-semibold

                                    @if($penyewa->status_pembayaran == 'Lunas')

                                        bg-green-100 text-green-700

                                    @elseif($penyewa->status_pembayaran == 'Menunggak')

                                        bg-red-100 text-red-700

                                    @else

                                        bg-yellow-100 text-yellow-700

                                    @endif">

                                    {{ $penyewa->status_pembayaran }}

                                </span>

                            </td>

                            {{-- AKSI --}}
                            <td class="p-5">

                                <div class="flex gap-2">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('pemilik.penyewa.show', $penyewa->id) }}"
                                       class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-xl text-sm transition">

                                        Detail

                                    </a>

                                    {{-- WHATSAPP --}}
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $penyewa->no_hp) }}"
                                       target="_blank"
                                       class="bg-green-100 hover:bg-green-200 text-green-700 px-4 py-2 rounded-xl text-sm transition">

                                        WhatsApp

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="p-10 text-center text-gray-400">

                                Belum ada data penyewa

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

</x-app-layout>