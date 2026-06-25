<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Riwayat Pembayaran - NyamanKost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">

@php $activePage = 'riwayat'; @endphp
@include('user.partials.sidebar')

<div class="lg:ml-64 flex flex-col min-h-screen">

    @include('user.partials.header', ['title' => 'Riwayat Pembayaran', 'penyewa' => $penyewa])

    <main class="flex-1 p-6 lg:p-10">

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-lg text-gray-800">Semua Transaksi</h3>
                <a href="{{ route('user.upload') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Upload Pembayaran
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-100">
                            <th class="px-6 py-4 font-semibold">Tanggal</th>
                            <th class="px-6 py-4 font-semibold">Bulan & Tahun</th>
                            <th class="px-6 py-4 font-semibold">Jumlah</th>
                            <th class="px-6 py-4 font-semibold">Bukti Pembayaran</th>
                            <th class="px-6 py-4 font-semibold text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($riwayat as $item)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $item->created_at->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                {{ $item->bulan }} {{ $item->tahun }}
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-800">
                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ asset('uploads/pembayaran/' . $item->bukti_bayar) }}" target="_blank"
                                   class="text-indigo-600 hover:text-indigo-800 flex items-center gap-2 font-medium">
                                    <i class="fa-solid fa-file-invoice"></i> Lihat Bukti
                                </a>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->status == 'Disetujui' || $item->status == 'approved')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                        <i class="fa-solid fa-check-circle mr-1.5"></i> Disetujui
                                    </span>
                                @elseif($item->status == 'Ditolak' || $item->status == 'rejected')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                        <i class="fa-solid fa-circle-xmark mr-1.5"></i> Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                        <i class="fa-solid fa-clock mr-1.5"></i> Menunggu
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                                    <i class="fa-solid fa-receipt text-2xl"></i>
                                </div>
                                <h4 class="text-gray-800 font-bold mb-1">Belum ada riwayat pembayaran</h4>
                                <p class="text-sm text-gray-500">Anda belum pernah melakukan pembayaran.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

</body>
</html>
