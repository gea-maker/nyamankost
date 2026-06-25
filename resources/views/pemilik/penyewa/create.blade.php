<x-app-layout>

<div class="max-w-4xl mx-auto py-10">

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h1 class="text-3xl font-bold mb-8">
            Tambah Penyewa
        </h1>

        <form action="{{ route('pemilik.penyewa.store') }}"
              method="POST"
              class="space-y-6">

            @csrf

            {{-- PILIH KOS --}}
            <div>

                <label class="block mb-2 font-semibold">
                    Pilih Kos
                </label>

                <select name="kos_id"
                        class="w-full border rounded-2xl px-4 py-3">

                    @foreach($dataKos as $kos)

                        <option value="{{ $kos->id }}">

                            {{ $kos->nama_kos }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- NAMA --}}
            <div>

                <label class="block mb-2 font-semibold">
                    Nama Penyewa
                </label>

                <input type="text"
                       name="nama"
                       class="w-full border rounded-2xl px-4 py-3">

            </div>

            {{-- HP --}}
            <div>

                <label class="block mb-2 font-semibold">
                    Nomor WhatsApp
                </label>

                <input type="text"
                       name="no_hp"
                       class="w-full border rounded-2xl px-4 py-3">

            </div>

            {{-- EMAIL --}}
            <div>

                <label class="block mb-2 font-semibold">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="w-full border rounded-2xl px-4 py-3">

            </div>

            {{-- KAMAR --}}
            <div>

                <label class="block mb-2 font-semibold">
                    Nomor Kamar
                </label>

                <input type="text"
                       name="nomor_kamar"
                       placeholder="A1"
                       class="w-full border rounded-2xl px-4 py-3">

            </div>

            {{-- HARGA --}}
            <div>

                <label class="block mb-2 font-semibold">
                    Harga Bulanan
                </label>

                <input type="number"
                       name="harga_bulanan"
                       class="w-full border rounded-2xl px-4 py-3">

            </div>

            {{-- STATUS --}}
            <div>

                <label class="block mb-2 font-semibold">
                    Status Pembayaran
                </label>

                <select name="status_pembayaran"
                        class="w-full border rounded-2xl px-4 py-3">

                    <option value="Lunas">
                        Lunas
                    </option>

                    <option value="Menunggu">
                        Menunggu
                    </option>

                    <option value="Menunggak">
                        Menunggak
                    </option>

                </select>

            </div>

            {{-- TANGGAL MASUK --}}
            <div>

                <label class="block mb-2 font-semibold">
                    Tanggal Masuk
                </label>

                <input type="date"
                       name="tanggal_masuk"
                       class="w-full border rounded-2xl px-4 py-3">

            </div>

            {{-- JATUH TEMPO --}}
            <div>

                <label class="block mb-2 font-semibold">
                    Jatuh Tempo
                </label>

                <input type="date"
                       name="jatuh_tempo"
                       class="w-full border rounded-2xl px-4 py-3">

            </div>

            {{-- BUTTON --}}
            <div>

                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl shadow-lg">

                    Simpan Penyewa

                </button>

            </div>

        </form>

    </div>

</div>

</x-app-layout>