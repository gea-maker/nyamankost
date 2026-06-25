<x-app-layout>

<div class="max-w-7xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-8">

        Riwayat Pembayaran

    </h1>

    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-50">

                <tr>

                    <th class="p-4 text-left">
                        Bulan
                    </th>

                    <th class="p-4 text-left">
                        Tahun
                    </th>

                    <th class="p-4 text-left">
                        Jumlah
                    </th>

                    <th class="p-4 text-left">
                        Status
                    </th>

                    <th class="p-4 text-left">
                        Tanggal Upload
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($riwayat as $item)

                <tr class="border-t">

                    <td class="p-4">

                        {{ $item->bulan }}

                    </td>

                    <td class="p-4">

                        {{ $item->tahun }}

                    </td>

                    <td class="p-4">

                        Rp {{ number_format($item->jumlah,0,',','.') }}

                    </td>

                    <td class="p-4">

                        @if($item->status == 'Diterima')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                                Diterima

                            </span>

                        @elseif($item->status == 'Ditolak')

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                                Ditolak

                            </span>

                        @else

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                                Menunggu

                            </span>

                        @endif

                    </td>

                    <td class="p-4">

                        {{ $item->created_at->format('d-m-Y') }}

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5"
                        class="p-8 text-center text-gray-400">

                        Belum ada riwayat pembayaran

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>