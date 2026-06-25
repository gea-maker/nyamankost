<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Penyewa - NyamanKost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">

@php $activePage = 'dashboard'; @endphp
@include('user.partials.sidebar')

<div class="lg:ml-64 flex flex-col min-h-screen">

    {{-- TOP HEADER --}}
    @include('user.partials.header', ['title' => 'Dashboard Penyewa'])

    {{-- PAGE CONTENT --}}
    <main class="flex-1 p-6 lg:p-10">

        @if(session('error'))
        <div class="mb-6 flex items-center p-4 text-red-800 border border-red-200 rounded-xl bg-red-50">
            <i class="fa-solid fa-circle-exclamation text-red-500 mr-3"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        @if(session('success'))
        <div class="mb-6 flex items-center p-4 text-green-800 border border-green-200 rounded-xl bg-green-50">
            <i class="fa-solid fa-circle-check text-green-500 mr-3"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        {{-- BANNER BELUM KOS --}}
        @if(!$penyewa)
        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 border border-indigo-100 rounded-3xl p-10 mb-8 text-center max-w-2xl mx-auto">
            <div class="w-20 h-20 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center mx-auto mb-5">
                <i class="fa-solid fa-magnifying-glass-location text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Anda Belum Memilih Kos</h3>
            <p class="text-gray-500 mb-6">Temukan kos idaman Anda sekarang dan mulailah pengalaman ngekos yang nyaman.</p>
            <a href="{{ route('user.cari') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl shadow-lg hover:bg-indigo-700 transition">
                <i class="fa-solid fa-search"></i> Mulai Cari Kos
            </a>
        </div>
        @endif

        {{-- 4 INFO CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600">
                        <i class="fa-solid fa-door-open"></i>
                    </div>
                    <p class="text-sm font-semibold text-gray-500">Nomor Kamar</p>
                </div>
                <h2 class="text-3xl font-black text-gray-800">{{ $penyewa->nomor_kamar ?? '-' }}</h2>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600">
                        <i class="fa-solid fa-house-chimney"></i>
                    </div>
                    <p class="text-sm font-semibold text-gray-500">Nama Kos</p>
                </div>
                <h2 class="text-xl font-black text-gray-800 truncate">{{ $penyewa->kos->nama_kos ?? '-' }}</h2>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>
                    <p class="text-sm font-semibold text-gray-500">Status Bayar</p>
                </div>
                @if($penyewa && $penyewa->status_pembayaran)
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold
                        {{ $penyewa->status_pembayaran == 'Lunas' ? 'bg-green-100 text-green-800' :
                          ($penyewa->status_pembayaran == 'Menunggu' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                        {{ $penyewa->status_pembayaran }}
                    </span>
                @else
                    <span class="text-gray-400 font-bold text-xl">-</span>
                @endif
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-red-500">
                        <i class="fa-solid fa-calendar-xmark"></i>
                    </div>
                    <p class="text-sm font-semibold text-gray-500">Jatuh Tempo</p>
                </div>
                <h2 class="text-lg font-black text-gray-800">
                    @if($penyewa && $penyewa->jatuh_tempo)
                        {{ \Carbon\Carbon::parse($penyewa->jatuh_tempo)->translatedFormat('d M Y') }}
                    @else
                        -
                    @endif
                </h2>
            </div>
        </div>

        {{-- AKSI CEPAT --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-black text-gray-400 uppercase tracking-widest mb-5">Aksi Cepat</h3>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('user.tagihan') }}"
                   class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3.5 rounded-xl shadow-md transition">
                    <i class="fa-solid fa-file-invoice-dollar"></i> Lihat Tagihan
                </a>
                <a href="{{ route('user.upload') }}"
                   class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3.5 rounded-xl shadow-md transition">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Upload Bukti Bayar
                </a>
                <a href="{{ route('user.riwayat') }}"
                   class="flex items-center gap-2 bg-slate-700 hover:bg-slate-800 text-white font-bold px-6 py-3.5 rounded-xl shadow-md transition">
                    <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Pembayaran
                </a>
                <a href="{{ route('user.cari') }}"
                   class="flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white font-bold px-6 py-3.5 rounded-xl shadow-md transition">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari Kos
                </a>
            </div>
        </div>

    </main>
</div>

</body>
</html>