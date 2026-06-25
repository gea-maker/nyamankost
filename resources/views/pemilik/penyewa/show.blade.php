<x-app-layout>

<div class="max-w-5xl mx-auto py-10">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Detail Penyewa
            </h1>

            <p class="text-gray-500 mt-1">
                Informasi lengkap penyewa kos
            </p>

        </div>

        <a href="{{ route('pemilik.penyewa') }}"
           class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-2xl transition">

            Kembali

        </a>

    </div>


    {{-- CARD --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        {{-- TOP --}}
        <div class="bg-indigo-600 p-8 text-white">

            <div class="flex items-center gap-6">

                {{-- AVATAR --}}
                <div class="w-24 h-24 rounded-full bg-white text-indigo-600 flex items-center justify-center text-4xl font-bold">

                    {{ strtoupper(substr($penyewa->nama,0,1)) }}

                </div>

                <div>

                    <h2 class="text-3xl font-bold">

                        {{ $penyewa->nama }}

                    </h2>

                    <p class="mt-2 text-indigo-100">

                        Penyewa Aktif

                    </p>

                </div>

            </div>

        </div>


        {{-- BODY --}}
        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- KIRI --}}
            <div class="space-y-6">

                <div>

                    <h3 class="text-sm text-gray-500 mb-1">
                        Nomor WhatsApp
                    </h3>

                    <p class="font-semibold text-lg">
                        {{ $penyewa->no_hp }}
                    </p>

                </div>

                <div>

                    <h3 class="text-sm text-gray-500 mb-1">
                        Email
                    </h3>

                    <p class="font-semibold text-lg">
                        {{ $penyewa->email ?? '-' }}
                    </p>

                </div>

                <div>

                    <h3 class="text-sm text-gray-500 mb-1">
                        Kos Ditempati
                    </h3>

                    <p class="font-semibold text-lg">
                        {{ $penyewa->kos->nama_kos ?? '-' }}                    </p>

                </div>

                <div>

                    <h3 class="text-sm text-gray-500 mb-1">
                        Nomor Kamar
                    </h3>

                    <p class="font-semibold text-lg">
                        {{ $penyewa->nomor_kamar }}
                    </p>

                </div>

            </div>


            {{-- KANAN --}}
            <div class="space-y-6">

                <div>

                    <h3 class="text-sm text-gray-500 mb-1">
                        Harga Bulanan
                    </h3>

                    <p class="font-semibold text-lg text-indigo-600">

                        Rp {{ number_format($penyewa->harga_bulanan,0,',','.') }}

                    </p>

                </div>

                <div>

                    <h3 class="text-sm text-gray-500 mb-1">
                        Tanggal Masuk
                    </h3>

                    <p class="font-semibold text-lg">
                        {{ $penyewa->tanggal_masuk }}
                    </p>

                </div>

                <div>

                    <h3 class="text-sm text-gray-500 mb-1">
                        Jatuh Tempo
                    </h3>

                    <p class="font-semibold text-lg text-red-500">
                        {{ $penyewa->jatuh_tempo }}
                    </p>

                </div>

                <div>

                    <h3 class="text-sm text-gray-500 mb-1">
                        Status Pembayaran
                    </h3>

                    <span class="px-4 py-2 rounded-full text-sm font-semibold
                        {{ $penyewa->status_pembayaran == 'Lunas'
                            ? 'bg-green-100 text-green-700'
                            : ($penyewa->status_pembayaran == 'Menunggu'
                                ? 'bg-yellow-100 text-yellow-700'
                                : 'bg-red-100 text-red-700') }}">

                        {{ $penyewa->status_pembayaran }}

                    </span>

                </div>

            </div>

        </div>


        <div class="border-t p-8 flex flex-wrap gap-4">

    {{-- WA --}}
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $penyewa->no_hp) }}"
       target="_blank"
       class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-2xl transition">

        WhatsApp

    </a>

    {{-- EDIT --}}
    <a href="{{ route('pemilik.penyewa.edit', $penyewa->id) }}"
       class="bg-yellow-400 hover:bg-yellow-500 text-white px-6 py-3 rounded-2xl transition">

        Edit Penyewa

    </a>

    {{-- HAPUS --}}
    <form action="{{ route('pemilik.penyewa.destroy', $penyewa->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin hapus penyewa?')">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-2xl transition">

            Hapus Penyewa

        </button>

    </form>



        </div>

    </div>

</div>

</x-app-layout>