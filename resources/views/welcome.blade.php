<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NyamanKost - Platform Sewa Kos Terpercaya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .hero-gradient {
            background: linear-gradient(135deg, #fef08a 0%, #facc15 100%);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans">

    {{-- NAVIGATION --}}
    <nav class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50 transition-all">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-10">
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-yellow-400 rounded-xl flex items-center justify-center text-white shadow-lg group-hover:bg-yellow-500 transition">
                        <i class="fa-solid fa-house-chimney text-xl"></i>
                    </div>
                    <span class="text-2xl font-black tracking-tight text-gray-900">Nyamankost</span>
                </a>
                <div class="hidden md:flex gap-8 text-sm font-bold text-gray-500">
                    <a href="#panduan" class="hover:text-yellow-500 transition">Panduan Pemesanan</a>
                    <a href="#rekomendasi" class="hover:text-yellow-500 transition">Cari Kos</a>
                    <a href="#hubungi-kami" class="hover:text-yellow-500 transition">Hubungi Kami</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-lg transition hover:-translate-y-0.5">
                            <i class="fa-solid fa-gauge-high"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-gray-900 transition flex items-center gap-2">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="bg-yellow-400 hover:bg-yellow-500 text-slate-900 px-6 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-yellow-400/30 transition hover:-translate-y-0.5 flex items-center gap-2">
                            Daftar Sekarang <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <header class="relative pt-20 pb-32 overflow-hidden">
        <div class="absolute inset-0 hero-gradient z-0"></div>
        
        {{-- Decorative Blobs --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-yellow-300 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob z-0"></div>
        <div class="absolute -bottom-32 -left-20 w-[400px] h-[400px] bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000 z-0"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="inline-block py-1.5 px-4 rounded-full bg-white/40 text-yellow-900 font-bold text-sm tracking-wide mb-6 shadow-sm border border-white/50 backdrop-blur-sm">
                    <i class="fa-solid fa-star text-yellow-600 mr-1"></i> Pilihan Terbaik Anak Rantau
                </span>
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-tight mb-6 tracking-tight">
                    Cari Kos Ideal <br>
                    <span class="text-white drop-shadow-md">Lebih Mudah & Cepat</span>
                </h1>
                <p class="text-lg md:text-xl text-yellow-900/80 font-medium">Temukan ratusan pilihan kos dengan fasilitas terbaik, lokasi strategis, dan harga yang pas di kantong Anda.</p>
            </div>

            {{-- SEARCH FORM GLASSMORPHISM --}}
            <form method="GET" action="{{ route('home') }}#rekomendasi" class="glass-panel p-3 rounded-full shadow-2xl max-w-4xl mx-auto flex flex-col md:flex-row gap-2">
                <div class="flex-1 flex items-center px-6 border-b md:border-b-0 md:border-r border-gray-200">
                    <i class="fa-solid fa-location-dot text-yellow-500 mr-3 text-lg"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nama kos, daerah, atau kampus..." class="w-full border-none focus:ring-0 py-4 bg-transparent text-gray-700 placeholder-gray-400 font-medium text-lg">
                </div>

                <select name="jenis_kos" class="border-none focus:ring-0 bg-transparent px-6 font-bold text-gray-600 cursor-pointer text-center md:text-left border-b md:border-b-0 md:border-r border-gray-200">
                    <option value="">Semua Jenis</option>
                    <option value="Putra" {{ request('jenis_kos') == 'Putra' ? 'selected' : '' }}>Kos Putra</option>
                    <option value="Putri" {{ request('jenis_kos') == 'Putri' ? 'selected' : '' }}>Kos Putri</option>
                    <option value="Campur" {{ request('jenis_kos') == 'Campur' ? 'selected' : '' }}>Kos Campur</option>
                </select>

                <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-8 py-4 rounded-full font-bold transition flex items-center justify-center gap-2 text-lg shadow-lg">
                    Cari <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </header>

    {{-- HOW IT WORKS (PANDUAN) --}}
    <section id="panduan" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-sm font-black text-yellow-500 tracking-widest uppercase mb-2">Panduan</h2>
                <h3 class="text-4xl font-black text-slate-900 mb-4">Cara Pesan Kos di NyamanKost</h3>
                <p class="text-gray-500 text-lg">Hanya butuh 4 langkah mudah untuk mendapatkan kamar kos impian Anda tanpa harus keluar rumah.</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div class="w-24 h-24 mx-auto bg-yellow-50 rounded-3xl flex items-center justify-center mb-6 group-hover:-translate-y-2 transition duration-300 shadow-sm border border-yellow-100 text-yellow-500">
                        <i class="fa-solid fa-magnifying-glass-location text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">1. Cari Kos</h4>
                    <p class="text-gray-500 text-sm">Gunakan fitur pencarian untuk menemukan kos di area yang Anda inginkan.</p>
                </div>
                <div class="text-center group">
                    <div class="w-24 h-24 mx-auto bg-indigo-50 rounded-3xl flex items-center justify-center mb-6 group-hover:-translate-y-2 transition duration-300 shadow-sm border border-indigo-100 text-indigo-500">
                        <i class="fa-solid fa-building-user text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">2. Pilih Kamar</h4>
                    <p class="text-gray-500 text-sm">Lihat detail fasilitas, foto kamar, dan pilih yang paling cocok dengan Anda.</p>
                </div>
                <div class="text-center group">
                    <div class="w-24 h-24 mx-auto bg-green-50 rounded-3xl flex items-center justify-center mb-6 group-hover:-translate-y-2 transition duration-300 shadow-sm border border-green-100 text-green-500">
                        <i class="fa-solid fa-money-check-dollar text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">3. Pembayaran</h4>
                    <p class="text-gray-500 text-sm">Bayar sewa langsung ke rekening pemilik kos dan upload bukti pembayaran.</p>
                </div>
                <div class="text-center group">
                    <div class="w-24 h-24 mx-auto bg-slate-50 rounded-3xl flex items-center justify-center mb-6 group-hover:-translate-y-2 transition duration-300 shadow-sm border border-slate-200 text-slate-700">
                        <i class="fa-solid fa-key text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">4. Siap Huni</h4>
                    <p class="text-gray-500 text-sm">Setelah diverifikasi, Anda resmi menjadi penyewa dan kamar siap dihuni.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- REKOMENDASI KOS SECTION --}}
    <section id="rekomendasi" class="py-24 bg-gray-50 relative border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <h2 class="text-sm font-black text-yellow-500 tracking-widest uppercase mb-2">Pilihan Terbaik</h2>
                    <h3 class="text-4xl font-black text-slate-900">Rekomendasi Kos</h3>
                </div>
                @if(request('search') || request('jenis_kos'))
                <a href="{{ route('home') }}#rekomendasi" class="text-indigo-600 hover:text-indigo-800 font-bold flex items-center gap-2">
                    <i class="fa-solid fa-rotate-left"></i> Reset Filter
                </a>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($rekomendasiKos as $kos)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col group">
                    
                    {{-- CARD IMAGE --}}
                    <div class="h-56 bg-gray-200 relative overflow-hidden">
                        @if($kos->foto)
                            <img src="{{ asset('uploads/kos/' . $kos->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <i class="fa-regular fa-image text-5xl"></i>
                            </div>
                        @endif
                        
                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                            <span class="bg-white/95 backdrop-blur-sm text-slate-800 text-xs font-black px-3 py-1.5 rounded-xl shadow-sm">
                                {{ strtoupper($kos->jenis_kos) }}
                            </span>
                        </div>

                        <div class="absolute top-4 right-4">
                            @if($kos->status_kos == 'Tersedia')
                                <span class="bg-green-500 text-white text-[10px] px-2.5 py-1.5 rounded-xl font-bold uppercase tracking-wider shadow-md">Tersedia</span>
                            @elseif($kos->status_kos == 'Penuh')
                                <span class="bg-red-500 text-white text-[10px] px-2.5 py-1.5 rounded-xl font-bold uppercase tracking-wider shadow-md">Penuh</span>
                            @else
                                <span class="bg-yellow-500 text-white text-[10px] px-2.5 py-1.5 rounded-xl font-bold uppercase tracking-wider shadow-md">Maint.</span>
                            @endif
                        </div>
                    </div>

                    {{-- CARD CONTENT --}}
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="mb-2">
                            <h3 class="font-black text-xl text-slate-900 leading-tight group-hover:text-yellow-600 transition">{{ $kos->nama_kos }}</h3>
                        </div>

                        <p class="text-gray-500 text-sm flex items-start mt-1 flex-1">
                            <i class="fa-solid fa-location-dot mt-1 mr-2 text-gray-400"></i>
                            <span class="line-clamp-2 leading-relaxed">{{ $kos->alamat }}</span>
                        </p>

                        <div class="mt-6 pt-5 border-t border-gray-100 flex items-end justify-between">
                            <div>
                                <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wider mb-1">Harga Mulai</p>
                                <p class="text-yellow-600 font-black text-xl">Rp {{ number_format($kos->harga_per_bulan, 0, ',', '.') }}<span class="text-xs font-medium text-gray-400">/bln</span></p>
                            </div>
                            <a href="{{ route('kos.detail', $kos->id) }}" class="w-10 h-10 rounded-full bg-slate-50 hover:bg-yellow-400 hover:text-slate-900 text-slate-400 flex items-center justify-center transition-all">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                        <i class="fa-solid fa-house-circle-xmark text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2">Yaaah, Kos Tidak Ditemukan</h3>
                    <p class="text-gray-500 max-w-md mx-auto">Kami tidak dapat menemukan kos yang sesuai dengan kriteria pencarian Anda. Coba gunakan filter lain.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="py-20 bg-slate-900 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-4xl font-black text-white mb-6">Punya Properti Kos? Gabung Menjadi Mitra NyamanKost!</h2>
            <p class="text-slate-400 text-lg mb-10">Kelola kamar, tagihan, dan penyewa dalam satu dashboard pintar. Daftarkan kos Anda sekarang dan nikmati kemudahannya.</p>
            <a href="{{ route('register') }}" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-slate-900 font-black px-8 py-4 rounded-full text-lg shadow-xl shadow-yellow-400/20 transition hover:-translate-y-1">
                Daftar Sebagai Pemilik <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
        </div>
    </section>

    {{-- FOOTER / HUBUNGI KAMI --}}
    <footer id="hubungi-kami" class="bg-white pt-20 pb-10 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <div class="lg:col-span-2">
                    <a href="/" class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center text-white">
                            <i class="fa-solid fa-house-chimney text-sm"></i>
                        </div>
                        <span class="text-2xl font-black tracking-tight text-slate-900">Nyamankost</span>
                    </a>
                    <p class="text-gray-500 leading-relaxed mb-6 max-w-sm">Platform manajemen dan pencarian kos nomor 1 yang menjembatani kenyamanan penyewa dan kemudahan pemilik kos.</p>
                    <div class="flex items-center gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-yellow-400 hover:text-white transition">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-yellow-400 hover:text-white transition">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-green-500 hover:text-white transition">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-wider text-sm">Eksplorasi</h4>
                    <ul class="space-y-4 text-gray-500">
                        <li><a href="#panduan" class="hover:text-yellow-600 transition">Panduan Pemesanan</a></li>
                        <li><a href="#rekomendasi" class="hover:text-yellow-600 transition">Cari Kos Terdekat</a></li>
                        <li><a href="#" class="hover:text-yellow-600 transition">Promo Menarik</a></li>
                        <li><a href="#" class="hover:text-yellow-600 transition">Blog & Artikel</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-wider text-sm">Hubungi Kami</h4>
                    <ul class="space-y-4 text-gray-500">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-map-location-dot mt-1 text-yellow-500"></i>
                            <span> Jl. Bathin Alam, Sungai Alam, Bengkalis, Riau 28711</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-envelope text-yellow-500"></i>
                            <span>refisgea@gmail.com</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-phone text-yellow-500"></i>
                            <span>(+62)81265342848</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-gray-400">
                <p>&copy; 2026 NyamanKost. Seluruh Hak Cipta dilindungi.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-gray-800 transition">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-gray-800 transition">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>