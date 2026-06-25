<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kos - Admin NYAMANKOST</title>
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
                <h2 class="font-bold text-slate-700">Kelola Data Kos</h2>
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
                {{-- STATISTIK RINGKAS --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase">Total Kos</p>
                            <h3 class="text-2xl font-black text-slate-800">{{ $totalKos }}</h3>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase">Kos Aktif</p>
                            <h3 class="text-2xl font-black text-slate-800">{{ $kosAktif }}</h3>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-red-100 text-red-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-door-closed"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase">Kos Penuh</p>
                            <h3 class="text-2xl font-black text-slate-800">{{ $kosPenuh }}</h3>
                        </div>
                    </div>
                </div>

                {{-- SEARCH & FILTER --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                    <form action="{{ route('admin.kos.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                        <div class="flex-1 min-w-[200px]">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Cari Kos</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama kos atau alamat..."
                                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition">
                        </div>
                        <div class="min-w-[160px]">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Status</label>
                            <select name="status_kos" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status_kos') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ request('status_kos') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                        <div class="min-w-[160px]">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Jenis</label>
                            <select name="jenis_kos" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition">
                                <option value="">Semua Jenis</option>
                                <option value="putra" {{ request('jenis_kos') == 'putra' ? 'selected' : '' }}>Putra</option>
                                <option value="putri" {{ request('jenis_kos') == 'putri' ? 'selected' : '' }}>Putri</option>
                                <option value="campur" {{ request('jenis_kos') == 'campur' ? 'selected' : '' }}>Campur</option>
                            </select>
                        </div>
                        <button type="submit" class="bg-slate-900 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-yellow-400 hover:text-slate-900 transition-all duration-300">
                            <i class="fa-solid fa-magnifying-glass mr-2"></i>Filter
                        </button>
                        @if(request('search') || request('status_kos') || request('jenis_kos'))
                            <a href="{{ route('admin.kos.index') }}" class="bg-gray-200 text-gray-600 px-6 py-2.5 rounded-xl font-bold hover:bg-gray-300 transition">
                                <i class="fa-solid fa-rotate-left mr-2"></i>Reset
                            </a>
                        @endif
                    </form>
                </div>

                {{-- ALERT SUCCESS --}}
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-xl shadow-sm">
                        <i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}
                    </div>
                @endif

                {{-- TABLE --}}
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                    @if($dataKos->count() > 0)
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Kos</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Pemilik</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Jenis</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Harga/Bulan</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Sisa Kamar</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($dataKos as $kos)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($kos->foto)
                                            <img src="{{ asset('uploads/kos/' . $kos->foto) }}" alt="{{ $kos->nama_kos }}" class="w-12 h-12 rounded-xl object-cover border border-gray-200">
                                        @else
                                            <div class="w-12 h-12 bg-gray-200 rounded-xl flex items-center justify-center text-gray-400">
                                                <i class="fa-solid fa-image"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-bold text-slate-800">{{ $kos->nama_kos }}</p>
                                            <p class="text-xs text-gray-400">{{ Str::limit($kos->alamat, 30) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700">{{ $kos->pemilik->name ?? 'Tidak Diketahui' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $jenisColors = [
                                            'putra' => 'bg-blue-100 text-blue-700',
                                            'putri' => 'bg-pink-100 text-pink-700',
                                            'campur' => 'bg-purple-100 text-purple-700',
                                        ];
                                        $color = $jenisColors[$kos->jenis_kos] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span class="{{ $color }} px-3 py-1 rounded-full text-xs font-bold uppercase">{{ $kos->jenis_kos }}</span>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-700">Rp {{ number_format($kos->harga_per_bulan, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    @if($kos->sisa_kamar == 0)
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">PENUH</span>
                                    @else
                                        <span class="text-sm font-bold text-green-600">{{ $kos->sisa_kamar }} kamar</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($kos->status_kos == 'aktif')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Aktif</span>
                                    @else
                                        <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-xs font-bold uppercase">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.kos.show', $kos->id) }}" class="text-blue-500 hover:bg-blue-50 p-2 rounded-lg transition" title="Lihat Detail">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.kos.destroy', $kos->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kos ini? Semua data terkait akan ikut terhapus.')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition" title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="p-16 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl text-gray-300">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-400">Belum Ada Data Kos</h3>
                        <p class="text-gray-400 mt-2">Data kos akan muncul setelah pemilik mendaftarkan kos mereka.</p>
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

</body>
</html>
