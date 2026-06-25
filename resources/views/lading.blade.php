<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NYAMANKOST - Cari Kost Nyaman & Aman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-slate-900">

    <nav class="bg-white py-4 px-6 shadow-sm flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <div class="bg-blue-600 p-2 rounded-lg text-white">
                <i class="fa-solid fa-house-chimney-window text-xl"></i>
            </div>
            <span class="text-2xl font-black tracking-tighter text-slate-900 uppercase">NYAMANKOST</span>
        </div>
        <div class="hidden md:flex gap-8 font-bold text-gray-600">
            <a href="#" class="hover:text-blue-600">Panduan</a>
            <a href="#" class="hover:text-blue-600">Cari Kost</a>
        </div>
        <div class="flex gap-4">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="bg-slate-900 text-white px-6 py-2 rounded-full font-bold">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-bold self-center mr-2">Masuk</a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full font-bold hover:bg-blue-700 transition">Daftar</a>
            @endauth
        </div>
    </nav>

    <section class="bg-blue-600 pt-20 pb-32 px-6 text-center text-white">
        <h1 class="text-5xl md:text-6xl font-black leading-tight mb-4">DAPATKAN KOS <br> IMPIANMU SEKARANG</h1>
        <p class="text-xl font-medium opacity-90 mb-10">Hunian nyaman, harga aman, hati tenang bersama NYAMANKOST.</p>
        
        <div class="max-w-4xl mx-auto bg-white p-3 rounded-2xl shadow-2xl flex items-center border border-gray-100">
            <div class="flex-grow flex items-center px-4">
                <i class="fa-solid fa-location-dot text-blue-600 mr-3"></i>
                <input type="text" placeholder="Cari nama properti / alamat / kota..." class="w-full border-none focus:ring-0 text-slate-800 font-medium">
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-xl font-black transition">
                CARI
            </button>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 -mt-16 mb-20">
        <div class="bg-white p-8 rounded-3xl shadow-xl">
            <h2 class="text-3xl font-black mb-8 text-slate-800">Rekomendasi Kos</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($kos as $item)
                <div class="border border-gray-100 rounded-2xl overflow-hidden hover:shadow-lg transition">
                    <img src="https://via.placeholder.com/400x250" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-xs font-bold text-blue-600 uppercase bg-blue-50 px-2 py-1 rounded">{{ $item->jenis_kos }}</span>
                        <h3 class="text-lg font-bold mt-2">{{ $item->nama_kos }}</h3>
                        <p class="text-gray-500 text-sm mb-4"><i class="fa-solid fa-map-pin mr-1"></i> {{ $item->alamat }}</p>
                        <div class="flex justify-between items-center border-t pt-4">
                            <span class="text-xl font-black">Rp {{ number_format($item->harga_per_bulan, 0, ',', '.') }}</span>
                            <span class="text-red-500 font-bold text-xs">Sisa {{ $item->sisa_kamar }} Kamar</span>
                        </div>
                    </div>
                </div>
                @empty
                <p class="col-span-3 text-center py-10 text-gray-400 italic">Belum ada data kost di sistem NYAMANKOST.</p>
                @endforelse
            </div>
        </div>
    </section>
    <nav class="bg-white py-4 px-6 shadow-sm flex justify-between items-center sticky top-0 z-50">
    <div class="flex items-center gap-2">
        <div class="bg-blue-600 p-2 rounded-lg text-white">
            <i class="fa-solid fa-house-chimney-window text-xl"></i>
        </div>
        <span class="text-2xl font-black tracking-tighter text-slate-900 uppercase">NYAMANKOST</span>
    </div>

    <div class="flex gap-4 items-center">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="bg-slate-900 text-white px-6 py-2 rounded-full font-bold hover:bg-blue-600 transition">
                    <i class="fa-solid fa-gauge mr-1"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="font-bold text-slate-700 hover:text-blue-600 mr-2">Masuk</a>
                
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full font-bold hover:bg-blue-700 shadow-lg shadow-blue-100 transition">
                        Coba Gratis
                    </a>
                @endif
            @endauth
        @endif
    </div>
</nav>

</body>
</html>