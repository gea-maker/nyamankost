<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tagihan Saya - NyamanKost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">

@php $activePage = 'dashboard'; @endphp
@include('user.partials.sidebar')

<div class="lg:ml-64 flex flex-col min-h-screen">

    @include('user.partials.header', ['title' => 'Tagihan Saya', 'penyewa' => $penyewa])

    <main class="flex-1 p-6 lg:p-10">

        <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-sm border border-gray-100 p-8">

            <div class="flex flex-col md:flex-row gap-12">

                {{-- DETAIL TAGIHAN --}}
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Rincian Tagihan</h3>
                    </div>

                    <div class="space-y-6">
                        <div class="border-b border-gray-100 pb-4">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nama Kos</p>
                            <p class="text-lg font-bold text-gray-800">{{ $penyewa->kos->nama_kos ?? '-' }}</p>
                        </div>

                        <div class="border-b border-gray-100 pb-4">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nomor Kamar</p>
                            <p class="text-lg font-bold text-gray-800">{{ $penyewa->nomor_kamar ?? '-' }}</p>
                        </div>

                        <div class="border-b border-gray-100 pb-4">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Jatuh Tempo</p>
                            <p class="text-lg font-bold text-gray-800">
                                @if($penyewa->jatuh_tempo)
                                    {{ \Carbon\Carbon::parse($penyewa->jatuh_tempo)->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                        <div class="bg-indigo-50 border border-indigo-100 p-5 rounded-2xl">
                            <p class="text-xs font-bold text-indigo-400 uppercase tracking-wider mb-1">Total Tagihan Bulanan</p>
                            <p class="text-3xl font-black text-indigo-700">Rp {{ number_format($penyewa->harga_bulanan, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                {{-- STATUS CARD --}}
                <div class="md:w-72">
                    <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 text-center h-full flex flex-col justify-center">
                        <p class="text-gray-500 font-semibold mb-4">Status Saat Ini</p>

                        @if($penyewa->status_pembayaran == 'Lunas')
                            <div class="w-24 h-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid fa-check text-4xl"></i>
                            </div>
                            <h4 class="text-2xl font-black text-green-700 mb-2">LUNAS</h4>
                            <p class="text-sm text-green-600/80">Terima kasih atas pembayaran Anda bulan ini.</p>

                        @elseif($penyewa->status_pembayaran == 'Menunggak')
                            <div class="w-24 h-24 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid fa-triangle-exclamation text-4xl"></i>
                            </div>
                            <h4 class="text-2xl font-black text-red-700 mb-2">MENUNGGAK</h4>
                            <p class="text-sm text-red-600/80 mb-6">Segera lakukan pembayaran.</p>
                            <a href="{{ route('user.upload') }}" class="block w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl transition">
                                Bayar Sekarang
                            </a>

                        @else
                            <div class="w-24 h-24 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid fa-hourglass-half text-4xl"></i>
                            </div>
                            <h4 class="text-2xl font-black text-yellow-700 mb-2">MENUNGGU</h4>
                            <p class="text-sm text-yellow-600/80 mb-6">Menunggu pembayaran atau sedang diverifikasi.</p>
                            <a href="{{ route('user.upload') }}" class="block w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-xl transition shadow-md">
                                Upload Bukti Bayar
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </main>
</div>

</body>
</html>