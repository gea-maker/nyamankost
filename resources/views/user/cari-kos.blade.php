<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cari Kos - NyamanKost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">

@php $activePage = 'cari'; @endphp
@include('user.partials.sidebar')

<div class="lg:ml-64 flex flex-col min-h-screen">

    @include('user.partials.header', ['title' => 'Cari Kos', 'penyewa' => $penyewa])

    <main class="flex-1 p-6 lg:p-10">

        {{-- PAGE TITLE --}}
        <div class="mb-8">
            <h2 class="text-3xl font-black text-gray-800">Cari Kos Impianmu</h2>
            <p class="text-gray-500 mt-1">Gunakan filter di bawah untuk menemukan kos yang paling sesuai.</p>
        </div>

        {{-- SEARCH FORM --}}
        <form method="GET" action="{{ route('user.cari') }}"
              class="bg-white p-4 rounded-2xl shadow-sm border border-gray-200 flex flex-col sm:flex-row gap-3 mb-8 max-w-4xl">

            <div class="flex-1 flex items-center px-4 bg-gray-50 rounded-xl border border-gray-200 focus-within:border-indigo-400 focus-within:ring-1 focus-within:ring-indigo-300 transition">
                <i class="fa-solid fa-location-dot text-indigo-500 mr-3 flex-shrink-0"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Ketik nama kos atau alamat..."
                       autofocus
                       class="w-full border-none focus:ring-0 py-3 text-sm bg-transparent">
            </div>

            <select name="jenis_kos"
                    class="border border-gray-200 bg-gray-50 text-sm font-medium text-gray-600 cursor-pointer rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                <option value="">Semua Jenis</option>
                <option value="Putra"  {{ request('jenis_kos') == 'Putra'  ? 'selected' : '' }}>Kos Putra</option>
                <option value="Putri"  {{ request('jenis_kos') == 'Putri'  ? 'selected' : '' }}>Kos Putri</option>
                <option value="Campur" {{ request('jenis_kos') == 'Campur' ? 'selected' : '' }}>Kos Campur</option>
            </select>

            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-bold transition flex items-center justify-center gap-2 shadow-md">
                <i class="fa-solid fa-magnifying-glass"></i> Cari
            </button>

            @if(request('search') || request('jenis_kos'))
            <a href="{{ route('user.cari') }}"
               class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-4 py-3 rounded-xl font-bold transition flex items-center justify-center gap-1 text-sm">
                <i class="fa-solid fa-rotate-left"></i> Reset
            </a>
            @endif
        </form>

        {{-- RESULT COUNT --}}
        <p class="text-sm text-gray-500 mb-6 font-medium">
            Menampilkan <span class="font-black text-gray-800">{{ $rekomendasiKos->count() }}</span> kos
            @if(request('search'))
                untuk pencarian "<em class="font-semibold text-indigo-600">{{ request('search') }}</em>"
            @endif
            @if(request('jenis_kos'))
                &bull; Jenis: <span class="font-semibold text-indigo-600">{{ request('jenis_kos') }}</span>
            @endif
        </p>

        {{-- KOS GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse($rekomendasiKos as $kos)
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col group">

                {{-- IMAGE --}}
                <div class="h-56 bg-gray-100 relative overflow-hidden">
                    @if($kos->foto)
                        <img src="{{ asset('uploads/kos/' . $kos->foto) }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50 text-gray-300">
                            <i class="fa-regular fa-image text-5xl"></i>
                        </div>
                    @endif

                    <div class="absolute top-4 left-4">
                        <span class="bg-white/95 backdrop-blur-sm text-gray-800 text-xs font-black px-3 py-1.5 rounded-full shadow-sm uppercase">
                            {{ $kos->jenis_kos }}
                        </span>
                    </div>
                    <div class="absolute top-4 right-4">
                        @if($kos->status_kos == 'Tersedia')
                            <span class="bg-green-500 text-white text-[10px] px-2.5 py-1.5 rounded-full font-black shadow-md">TERSEDIA</span>
                        @elseif($kos->status_kos == 'Penuh')
                            <span class="bg-red-500 text-white text-[10px] px-2.5 py-1.5 rounded-full font-black shadow-md">PENUH</span>
                        @else
                            <span class="bg-yellow-500 text-white text-[10px] px-2.5 py-1.5 rounded-full font-black shadow-md">MAINT.</span>
                        @endif
                    </div>
                </div>

                {{-- CONTENT --}}
                <div class="p-6 flex-1 flex flex-col">
                    <h3 class="font-black text-xl text-gray-800 leading-tight mb-2 group-hover:text-indigo-600 transition">
                        {{ $kos->nama_kos }}
                    </h3>
                    <p class="text-gray-500 text-sm flex items-start flex-1">
                        <i class="fa-solid fa-location-dot mt-1 mr-2 text-indigo-400 flex-shrink-0"></i>
                        <span class="line-clamp-2">{{ $kos->alamat }}</span>
                    </p>

                    <div class="mt-6 pt-5 border-t border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-[11px] text-gray-400 font-bold uppercase mb-0.5">Harga/Bulan</p>
                            <p class="text-indigo-600 font-black text-xl">Rp {{ number_format($kos->harga_per_bulan, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('kos.detail', $kos->id) }}"
                           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-5 py-2.5 rounded-xl transition-all text-sm shadow-md">
                            Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-24 text-center bg-white rounded-3xl border border-gray-100 shadow-sm">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                    <i class="fa-solid fa-house-circle-xmark text-4xl"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-800 mb-2">Kos Tidak Ditemukan</h3>
                <p class="text-gray-500 mb-6">Coba ubah kata kunci atau gunakan filter yang berbeda.</p>
                <a href="{{ route('user.cari') }}" class="inline-flex items-center gap-2 text-indigo-600 font-bold hover:text-indigo-800 transition">
                    <i class="fa-solid fa-rotate-left"></i> Reset Pencarian
                </a>
            </div>
            @endforelse
        </div>

    </main>
</div>

</body>
</html>
