<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kos - Admin NYAMANKOST</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        {{-- SIDEBAR --}}
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 shadow-xl">
            <div class="p-6 text-2xl font-black text-yellow-400 border-b border-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-house-chimney"></i> NYAMANKOST
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded-xl hover:bg-slate-800 transition">
                    <i class="fa-solid fa-gauge mr-3 w-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 rounded-xl hover:bg-slate-800 transition">
                    <i class="fa-solid fa-users mr-3 w-5"></i> Data User
                </a>
                <a href="{{ route('admin.kos.index') }}" class="flex items-center p-3 rounded-xl bg-yellow-400 text-slate-900 font-bold transition">
                    <i class="fa-solid fa-hotel mr-3 w-5"></i> Kelola Kos
                </a>
                <a href="{{ route('admin.transaksi.index') }}" class="flex items-center p-3 rounded-xl hover:bg-slate-800 transition">
                    <i class="fa-solid fa-wallet mr-3 w-5"></i> Transaksi
                </a>
                <a href="{{ route('admin.laporan') }}" class="flex items-center p-3 rounded-xl hover:bg-slate-800 transition">
                    <i class="fa-solid fa-chart-pie mr-3 w-5"></i> Laporan
                </a>

                <div class="pt-10 pb-4 border-t border-slate-800">
                    <p class="px-3 text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">Pengaturan</p>
                    <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-xl hover:bg-slate-800 transition text-sm">
                        <i class="fa-solid fa-user-gear mr-3 w-5"></i> Profil Saya
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center p-3 rounded-xl hover:bg-red-600 transition text-sm mt-2">
                            <i class="fa-solid fa-right-from-bracket mr-3 w-5"></i> Keluar
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-grow">
            <header class="bg-white py-4 px-10 shadow-sm flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.kos.index') }}" class="text-slate-400 hover:text-slate-700 transition">
                        <i class="fa-solid fa-arrow-left text-lg"></i>
                    </a>
                    <h2 class="font-bold text-slate-700">Detail Kos</h2>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm font-bold text-slate-600">{{ Auth::user()->name }}</span>
                    @if(Auth::user()->foto_profil)
                        <img class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-sm"
                             src="{{ asset('storage/'.Auth::user()->foto_profil) }}"
                             alt="Foto Profil">
                    @else
                        <div class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center font-bold text-slate-900 border-2 border-white shadow-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                </div>
            </header>

            <div class="p-10">
                {{-- HEADER DETAIL --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                    <div class="relative">
                        @if($kos->foto)
                            <img src="{{ asset('uploads/kos/' . $kos->foto) }}" alt="{{ $kos->nama_kos }}" class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center text-6xl text-slate-400">
                                <i class="fa-solid fa-building"></i>
                            </div>
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-6">
                            <h1 class="text-3xl font-black text-white">{{ $kos->nama_kos }}</h1>
                            <p class="text-white/80 mt-1"><i class="fa-solid fa-location-dot mr-2"></i>{{ $kos->alamat }}</p>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-blue-50 rounded-xl p-4 text-center">
                                <p class="text-xs font-bold text-blue-400 uppercase">Jenis Kos</p>
                                <p class="text-lg font-black text-blue-700 mt-1 capitalize">{{ $kos->jenis_kos }}</p>
                            </div>
                            <div class="bg-green-50 rounded-xl p-4 text-center">
                                <p class="text-xs font-bold text-green-400 uppercase">Harga/Bulan</p>
                                <p class="text-lg font-black text-green-700 mt-1">Rp {{ number_format($kos->harga_per_bulan, 0, ',', '.') }}</p>
                            </div>
                            <div class="bg-yellow-50 rounded-xl p-4 text-center">
                                <p class="text-xs font-bold text-yellow-500 uppercase">Sisa Kamar</p>
                                <p class="text-lg font-black text-yellow-700 mt-1">{{ $kos->sisa_kamar }} Kamar</p>
                            </div>
                            <div class="bg-purple-50 rounded-xl p-4 text-center">
                                <p class="text-xs font-bold text-purple-400 uppercase">Status</p>
                                <p class="text-lg font-black text-purple-700 mt-1 capitalize">{{ $kos->status_kos }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- INFO PEMILIK --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-user-tie text-yellow-500"></i> Informasi Pemilik
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-500">Nama</span>
                                <span class="text-sm font-bold text-slate-700">{{ $kos->pemilik->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-500">Email</span>
                                <span class="text-sm font-bold text-slate-700">{{ $kos->pemilik->email ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-500">No HP Kos</span>
                                <span class="text-sm font-bold text-slate-700">{{ $kos->no_hp ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-sm text-gray-500">Instagram</span>
                                <span class="text-sm font-bold text-slate-700">{{ $kos->instagram ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- FASILITAS & DESKRIPSI --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-list-check text-yellow-500"></i> Fasilitas & Deskripsi
                        </h3>
                        @if($kos->fasilitas)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach(explode(',', $kos->fasilitas) as $fasilitas)
                                    <span class="bg-slate-100 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-bold">
                                        <i class="fa-solid fa-check text-green-500 mr-1"></i>{{ trim($fasilitas) }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-400 text-sm mb-4">Belum ada fasilitas terdaftar.</p>
                        @endif
                        <div class="border-t border-gray-100 pt-4">
                            <p class="text-sm text-gray-500 font-bold mb-2">Deskripsi</p>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $kos->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                        </div>
                    </div>
                </div>

                {{-- GALERI FOTO --}}
                @if($kos->fotos && $kos->fotos->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mt-6">
                    <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-images text-yellow-500"></i> Galeri Foto ({{ $kos->fotos->count() }})
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($kos->fotos as $foto)
                            <img src="{{ asset('uploads/kos/' . $foto->foto) }}" alt="Foto Kos" class="w-full h-40 object-cover rounded-xl border border-gray-200 hover:scale-105 transition-transform duration-300 cursor-pointer">
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- DAFTAR PENYEWA --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mt-6">
                    <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-people-roof text-yellow-500"></i> Penyewa ({{ $kos->penyewas->count() }})
                    </h3>
                    @if($kos->penyewas->count() > 0)
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-xs font-bold text-gray-500 uppercase">Nama</th>
                                <th class="px-4 py-3 text-xs font-bold text-gray-500 uppercase">Kamar</th>
                                <th class="px-4 py-3 text-xs font-bold text-gray-500 uppercase">No HP</th>
                                <th class="px-4 py-3 text-xs font-bold text-gray-500 uppercase">Status Bayar</th>
                                <th class="px-4 py-3 text-xs font-bold text-gray-500 uppercase">Status Huni</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($kos->penyewas as $penyewa)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-slate-700">{{ $penyewa->nama }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $penyewa->nomor_kamar }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $penyewa->no_hp }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusColors = [
                                            'Lunas' => 'bg-green-100 text-green-700',
                                            'Menunggu' => 'bg-yellow-100 text-yellow-700',
                                            'Menunggak' => 'bg-red-100 text-red-700',
                                        ];
                                        $sc = $statusColors[$penyewa->status_pembayaran] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span class="{{ $sc }} px-3 py-1 rounded-full text-xs font-bold">{{ $penyewa->status_pembayaran }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    @if($penyewa->status_huni == 'Aktif')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Aktif</span>
                                    @else
                                        <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-xs font-bold">Keluar</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="py-8 text-center text-gray-400">
                        <i class="fa-solid fa-user-slash text-3xl mb-2"></i>
                        <p>Belum ada penyewa di kos ini.</p>
                    </div>
                    @endif
                </div>

                {{-- MAPS --}}
                @if($kos->lokasi_maps)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mt-6">
                    <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-map-location-dot text-yellow-500"></i> Lokasi Maps
                    </h3>
                    <div class="rounded-xl overflow-hidden border border-gray-200">
                        {!! $kos->lokasi_maps !!}
                    </div>
                </div>
                @endif
            </div>
        </main>
    </div>

</body>
</html>
