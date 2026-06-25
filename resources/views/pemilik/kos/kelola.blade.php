<x-app-layout>

<div class="flex h-screen bg-gray-100">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar')


    {{-- CONTENT --}}
    <main class="flex-1 overflow-y-auto">

        {{-- HEADER --}}
        <div class="bg-white shadow-sm px-10 py-6 flex items-center justify-between">

            <div>

                <h1 class="text-2xl font-bold text-gray-800">
                    Kelola Kos
                </h1>

                <p class="text-gray-500 text-sm mt-1">
                    Kelola semua properti kos Anda
                </p>

            </div>

            {{-- PROFILE --}}
            <div class="flex items-center gap-3 bg-gray-50 px-4 py-2 rounded-2xl border">

                <div class="text-right">

                    <p class="font-semibold text-sm">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Pemilik Kos
                    </p>

                </div>

                @if(Auth::user()->foto_profil)
                    <img class="w-10 h-10 rounded-full object-cover border-2 border-indigo-500 shadow-sm"
                         src="{{ asset('storage/'.Auth::user()->foto_profil) }}"
                         alt="Avatar">
                @else
                    <div class="w-10 h-10 rounded-full bg-indigo-500 text-white flex items-center justify-center font-bold">
                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                    </div>
                @endif

            </div>

        </div>


        {{-- BODY --}}
        <div class="p-10">

            {{-- TOP --}}
            <div class="flex items-center justify-between mb-8">

                <div>

                    <h2 class="text-3xl font-bold text-gray-800">
                        Data Properti Kos
                    </h2>

                    <p class="text-gray-500 mt-1">
                        Semua data kos yang Anda miliki
                    </p>

                </div>

                <a href="{{ route('pemilik.kos.create') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl shadow-lg transition">

                    + Tambah Kos

                </a>

            </div>


            {{-- SEARCH --}}
            <form method="GET"
                  class="bg-white p-6 rounded-3xl shadow mb-8">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <input type="text"
                           name="search"
                           placeholder="Cari nama kos..."
                           value="{{ request('search') }}"
                           class="border rounded-2xl px-4 py-3">

                    <select name="status_kos"
                            class="border rounded-2xl px-4 py-3">

                        <option value="">
                            Semua Status
                        </option>

                        <option value="Tersedia">
                            Tersedia
                        </option>

                        <option value="Penuh">
                            Penuh
                        </option>

                    </select>

                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl">

                        Cari

                    </button>

                </div>

            </form>


            {{-- TABLE --}}
            <div class="bg-white rounded-3xl shadow overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="p-4 text-left">
                                Foto
                            </th>

                            <th class="p-4 text-left">
                                Nama Kos
                            </th>

                            <th class="p-4 text-left">
                                Harga
                            </th>

                            <th class="p-4 text-left">
                                Status
                            </th>

                            <th class="p-4 text-left">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($dataKos as $kos)

                            <tr class="border-t hover:bg-gray-50 transition">

                                {{-- FOTO --}}
                                <td class="p-4">

                                    @if($kos->foto)

                                        <img src="{{ asset('uploads/kos/' . $kos->foto) }}"
                                             class="w-24 h-20 object-cover rounded-xl">

                                    @else

                                        <div class="w-24 h-20 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 text-sm">

                                            Tidak ada foto

                                        </div>

                                    @endif

                                </td>

                                {{-- NAMA --}}
                                <td class="p-4 font-semibold">

                                    {{ $kos->nama_kos }}

                                </td>

                                {{-- HARGA --}}
                                <td class="p-4">

                                    Rp {{ number_format($kos->harga_per_bulan,0,',','.') }}

                                </td>

                                {{-- STATUS --}}
                                <td class="p-4">

                                    <span class="px-3 py-1 rounded-full text-sm
                                        {{ $kos->status_kos == 'Tersedia'
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-red-100 text-red-700' }}">

                                        {{ $kos->status_kos }}

                                    </span>

                                </td>

                                {{-- AKSI --}}
                                <td class="p-4 flex gap-2">

                                    <a href="{{ route('pemilik.kos.show', $kos->id) }}"
                                       class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-xl transition">

                                        Detail

                                    </a>

                                    <a href="{{ route('pemilik.kos.edit', $kos->id) }}"
                                       class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-4 py-2 rounded-xl transition">

                                        Edit

                                    </a>

                                    <form action="{{ route('pemilik.kos.destroy', $kos->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus kos ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-xl transition">

                                            Hapus

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="p-10 text-center text-gray-400">

                                    Belum ada data kos

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