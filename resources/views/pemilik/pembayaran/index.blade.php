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
                    Verifikasi Pembayaran
                </h1>

                <p class="text-gray-500 mt-1">
                    Kelola dan verifikasi pembayaran penyewa
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

            @if(session('success'))

                <div class="mb-6 p-4 rounded-2xl bg-green-100 text-green-700">

                    {{ session('success') }}

                </div>

            @endif

            {{-- HEADER TABLE --}}
            <div class="flex items-center justify-between mb-6">

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">
                        Data Pembayaran
                    </h2>

                    <p class="text-gray-500 mt-1">
                        Semua pembayaran dari penyewa kos
                    </p>

                </div>

            </div>

            {{-- TABLE --}}
            <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr class="text-left text-gray-600 text-sm">

                            <th class="p-5">Penyewa</th>
                            <th class="p-5">Periode</th>
                            <th class="p-5">Jumlah</th>
                            <th class="p-5">Bukti Pembayaran</th>
                            <th class="p-5">Status</th>
                            <th class="p-5">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($pembayarans as $item)

                        <tr class="border-b hover:bg-gray-50 transition">

                            {{-- PENYEWA --}}
                            <td class="p-5">

                                <div class="flex items-center gap-4">

                                    <div class="w-12 h-12 rounded-full bg-indigo-500 text-white flex items-center justify-center font-bold">

                                        {{ strtoupper(substr($item->penyewa->nama ?? 'P',0,1)) }}

                                    </div>

                                    <div>

                                        <h3 class="font-semibold text-gray-800">

                                            {{ $item->penyewa->nama ?? '-' }}

                                        </h3>

                                    </div>

                                </div>

                            </td>

                            {{-- BULAN --}}
                            <td class="p-5">

                                {{ $item->bulan }} {{ $item->tahun }}

                            </td>

                            {{-- JUMLAH --}}
                            <td class="p-5 font-semibold text-gray-700">

                                Rp {{ number_format($item->jumlah,0,',','.') }}

                            </td>

                            {{-- BUKTI --}}
                            <td class="p-5">

                                @if($item->bukti_bayar)

                                    <a href="{{ asset('uploads/pembayaran/'.$item->bukti_bayar) }}"
                                       target="_blank"
                                       class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-xl text-sm transition">

                                        Lihat Bukti

                                    </a>

                                @else

                                    <span class="text-gray-400">
                                        Tidak ada file
                                    </span>

                                @endif

                            </td>

                            {{-- STATUS --}}
                            <td class="p-5">

                                <span class="px-4 py-2 rounded-full text-sm font-semibold

                                    @if($item->status == 'Diterima')

                                        bg-green-100 text-green-700

                                    @elseif($item->status == 'Ditolak')

                                        bg-red-100 text-red-700

                                    @else

                                        bg-yellow-100 text-yellow-700

                                    @endif">

                                    {{ $item->status }}

                                </span>

                            </td>

                            {{-- AKSI --}}
                            <td class="p-5">

                                <div class="flex gap-2">

                                    @if($item->status == 'Menunggu')

                                        <form method="POST"
                                              action="{{ route('pemilik.pembayaran.terima',$item->id) }}">

                                            @csrf
                                            @method('PUT')

                                            <button type="submit"
                                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm transition">

                                                Terima

                                            </button>

                                        </form>

                                        <form method="POST"
                                              action="{{ route('pemilik.pembayaran.tolak',$item->id) }}">

                                            @csrf
                                            @method('PUT')

                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm transition">

                                                Tolak

                                            </button>

                                        </form>

                                    @else

                                        <span class="text-gray-400 text-sm">

                                            Selesai

                                        </span>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="p-10 text-center text-gray-400">

                                Belum ada pembayaran

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