<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Admin NYAMANKOST</title>
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
                <a href="{{ route('admin.kos.index') }}" class="flex items-center p-3 rounded-xl hover:bg-slate-800 transition">
                    <i class="fa-solid fa-hotel mr-3 w-5"></i> Kelola Kos
                </a>
                <a href="{{ route('admin.transaksi.index') }}" class="flex items-center p-3 rounded-xl bg-yellow-400 text-slate-900 font-bold transition">
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
                <h2 class="font-bold text-slate-700">Manajemen Transaksi</h2>
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
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase">Total</p>
                            <h3 class="text-xl font-black text-slate-800">{{ $totalTransaksi }}</h3>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase">Menunggu</p>
                            <h3 class="text-xl font-black text-yellow-600">{{ $totalMenunggu }}</h3>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase">Diterima</p>
                            <h3 class="text-xl font-black text-green-600">{{ $totalDiterima }}</h3>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-red-100 text-red-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase">Ditolak</p>
                            <h3 class="text-xl font-black text-red-600">{{ $totalDitolak }}</h3>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-5 rounded-2xl shadow-sm flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 text-white rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </div>
                        <div>
                            <p class="text-emerald-100 text-xs font-bold uppercase">Pendapatan</p>
                            <h3 class="text-lg font-black text-white">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>

                {{-- SEARCH & FILTER --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                    <form action="{{ route('admin.transaksi.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                        <div class="flex-1 min-w-[200px]">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Cari Penyewa</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama penyewa..."
                                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition">
                        </div>
                        <div class="min-w-[140px]">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Status</label>
                            <select name="status" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition">
                                <option value="">Semua</option>
                                <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div class="min-w-[140px]">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Bulan</label>
                            <select name="bulan" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition">
                                <option value="">Semua</option>
                                @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $bln)
                                    <option value="{{ $bln }}" {{ request('bulan') == $bln ? 'selected' : '' }}>{{ $bln }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="min-w-[100px]">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Tahun</label>
                            <input type="number" name="tahun" value="{{ request('tahun') }}" placeholder="{{ date('Y') }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition">
                        </div>
                        <button type="submit" class="bg-slate-900 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-yellow-400 hover:text-slate-900 transition-all duration-300">
                            <i class="fa-solid fa-magnifying-glass mr-2"></i>Filter
                        </button>
                        @if(request('search') || request('status') || request('bulan') || request('tahun'))
                            <a href="{{ route('admin.transaksi.index') }}" class="bg-gray-200 text-gray-600 px-6 py-2.5 rounded-xl font-bold hover:bg-gray-300 transition">
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
                    @if($pembayarans->count() > 0)
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Penyewa</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Kos</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Periode</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Jumlah</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Bukti</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($pembayarans as $p)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-800">{{ $p->penyewa->nama ?? '-' }}</p>
                                    <p class="text-xs text-gray-400">{{ $p->penyewa->no_hp ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $p->penyewa->kos->nama_kos ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $p->bulan }} {{ $p->tahun }}
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-700">
                                    Rp {{ number_format($p->jumlah, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($p->bukti_bayar)
                                        <a href="{{ asset('uploads/pembayaran/' . $p->bukti_bayar) }}" target="_blank"
                                           class="inline-flex items-center gap-1 text-blue-500 hover:text-blue-700 text-sm font-bold transition">
                                            <i class="fa-solid fa-image"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'Menunggu' => 'bg-yellow-100 text-yellow-700',
                                            'Diterima' => 'bg-green-100 text-green-700',
                                            'Ditolak' => 'bg-red-100 text-red-700',
                                        ];
                                        $sc = $statusColors[$p->status] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span class="{{ $sc }} px-3 py-1 rounded-full text-xs font-bold uppercase">{{ $p->status }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $p->created_at ? $p->created_at->format('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($p->status == 'Menunggu')
                                    <div class="flex justify-center gap-2">
                                        <form action="{{ route('admin.transaksi.terima', $p->id) }}" method="POST" class="inline">
                                            @csrf @method('PUT')
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition" title="Terima Pembayaran">
                                                <i class="fa-solid fa-check mr-1"></i>Terima
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.transaksi.tolak', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menolak pembayaran ini?')">
                                            @csrf @method('PUT')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition" title="Tolak Pembayaran">
                                                <i class="fa-solid fa-xmark mr-1"></i>Tolak
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                        <span class="text-gray-400 text-xs">Sudah diproses</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="p-16 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl text-gray-300">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-400">Belum Ada Transaksi</h3>
                        <p class="text-gray-400 mt-2">Data transaksi akan muncul ketika penyewa mengunggah bukti pembayaran.</p>
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

</body>
</html>
