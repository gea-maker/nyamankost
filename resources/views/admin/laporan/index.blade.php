<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Admin NYAMANKOST</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
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
                <a href="{{ route('admin.transaksi.index') }}" class="flex items-center p-3 rounded-xl hover:bg-slate-800 transition">
                    <i class="fa-solid fa-wallet mr-3 w-5"></i> Transaksi
                </a>
                <a href="{{ route('admin.laporan') }}" class="flex items-center p-3 rounded-xl bg-yellow-400 text-slate-900 font-bold transition">
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
                <h2 class="font-bold text-slate-700">Laporan & Statistik</h2>
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
                {{-- OVERVIEW CARDS --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    {{-- Total User --}}
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-lg">
                                <i class="fa-solid fa-users"></i>
                            </div>
                        </div>
                        <p class="text-gray-400 text-xs font-bold uppercase">Total User</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $totalUser }}</h3>
                        <div class="mt-2 text-xs text-gray-400">
                            <span class="text-blue-500 font-bold">{{ $totalPemilik }}</span> Pemilik · 
                            <span class="text-green-500 font-bold">{{ $totalPenyewa }}</span> Penyewa
                        </div>
                    </div>

                    {{-- Total Kos --}}
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center text-lg">
                                <i class="fa-solid fa-building"></i>
                            </div>
                        </div>
                        <p class="text-gray-400 text-xs font-bold uppercase">Total Kos</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $totalKos }}</h3>
                        <div class="mt-2 text-xs text-gray-400">
                            <span class="text-green-500 font-bold">{{ $kosAktif }}</span> Aktif · 
                            <span class="text-orange-500 font-bold">{{ $totalKamarTersisa }}</span> Kamar Tersisa
                        </div>
                    </div>

                    {{-- Penyewa Aktif --}}
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-lg">
                                <i class="fa-solid fa-people-roof"></i>
                            </div>
                        </div>
                        <p class="text-gray-400 text-xs font-bold uppercase">Penyewa Aktif</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $totalPenyewaAktif }}</h3>
                        <div class="mt-2 text-xs text-gray-400">
                            <span class="text-red-500 font-bold">{{ $penyewaMenunggak->count() }}</span> Menunggak
                        </div>
                    </div>

                    {{-- Total Pendapatan --}}
                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-5 rounded-2xl shadow-sm text-white">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 bg-white/20 text-white rounded-xl flex items-center justify-center text-lg">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </div>
                        </div>
                        <p class="text-emerald-100 text-xs font-bold uppercase">Total Pendapatan</p>
                        <h3 class="text-2xl font-black mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                        <div class="mt-2 text-xs text-emerald-100">
                            Bulan ini: <span class="font-bold text-white">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    {{-- CHART PENDAPATAN --}}
                    <div class="md:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-chart-line text-yellow-500"></i> Pendapatan 6 Bulan Terakhir
                        </h3>
                        <div class="relative" style="height: 280px;">
                            <canvas id="chartPendapatan"></canvas>
                        </div>
                    </div>

                    {{-- CHART PEMBAYARAN STATUS --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-chart-pie text-yellow-500"></i> Status Pembayaran
                        </h3>
                        <div class="relative flex items-center justify-center" style="height: 220px;">
                            <canvas id="chartStatus"></canvas>
                        </div>
                        <div class="mt-4 space-y-2">
                            <div class="flex items-center justify-between text-sm">
                                <span class="flex items-center gap-2"><span class="w-3 h-3 bg-green-500 rounded-full inline-block"></span> Diterima</span>
                                <span class="font-bold text-slate-700">{{ $pembayaranDiterima }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="flex items-center gap-2"><span class="w-3 h-3 bg-yellow-500 rounded-full inline-block"></span> Menunggu</span>
                                <span class="font-bold text-slate-700">{{ $pembayaranMenunggu }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="flex items-center gap-2"><span class="w-3 h-3 bg-red-500 rounded-full inline-block"></span> Ditolak</span>
                                <span class="font-bold text-slate-700">{{ $pembayaranDitolak }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    {{-- KOS TERPOPULER --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-fire text-orange-500"></i> Kos Terpopuler
                        </h3>
                        @if($kosTerpopuler->count() > 0)
                        <div class="space-y-3">
                            @foreach($kosTerpopuler as $index => $k)
                            <div class="flex items-center gap-4 p-3 rounded-xl {{ $index == 0 ? 'bg-yellow-50 border border-yellow-200' : 'bg-gray-50' }}">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-black
                                    {{ $index == 0 ? 'bg-yellow-400 text-slate-900' : ($index == 1 ? 'bg-gray-300 text-slate-700' : ($index == 2 ? 'bg-orange-300 text-slate-700' : 'bg-gray-200 text-gray-500')) }}">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-slate-800 text-sm">{{ $k->nama_kos }}</p>
                                    <p class="text-xs text-gray-400">{{ Str::limit($k->alamat, 40) }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                        {{ $k->penyewas_count }} penyewa
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="py-8 text-center text-gray-400">
                            <i class="fa-solid fa-chart-bar text-3xl mb-2"></i>
                            <p>Belum ada data kos.</p>
                        </div>
                        @endif
                    </div>

                    {{-- JATUH TEMPO MINGGU INI --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-bell text-red-500"></i> Jatuh Tempo Minggu Ini
                            @if($jatuhTempoMingguIni->count() > 0)
                                <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full font-bold ml-1">{{ $jatuhTempoMingguIni->count() }}</span>
                            @endif
                        </h3>
                        @if($jatuhTempoMingguIni->count() > 0)
                        <div class="space-y-3">
                            @foreach($jatuhTempoMingguIni as $jt)
                            <div class="flex items-center gap-4 p-3 rounded-xl bg-red-50 border border-red-200">
                                <div class="w-10 h-10 bg-red-100 text-red-600 rounded-xl flex items-center justify-center text-lg">
                                    <i class="fa-solid fa-calendar-xmark"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-slate-800 text-sm">{{ $jt->nama }}</p>
                                    <p class="text-xs text-gray-400">{{ $jt->kos->nama_kos ?? '-' }} · Kamar {{ $jt->nomor_kamar }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs font-bold text-red-600">{{ \Carbon\Carbon::parse($jt->jatuh_tempo)->format('d M Y') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="py-8 text-center text-gray-400">
                            <i class="fa-solid fa-circle-check text-3xl mb-2 text-green-300"></i>
                            <p>Tidak ada jatuh tempo minggu ini. 🎉</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- PENYEWA MENUNGGAK --}}
                @if($penyewaMenunggak->count() > 0)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation text-yellow-500"></i> Penyewa Menunggak
                        <span class="bg-yellow-500 text-white text-xs px-2 py-0.5 rounded-full font-bold ml-1">{{ $penyewaMenunggak->count() }}</span>
                    </h3>
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-xs font-bold text-gray-500 uppercase">Nama</th>
                                <th class="px-4 py-3 text-xs font-bold text-gray-500 uppercase">Kos</th>
                                <th class="px-4 py-3 text-xs font-bold text-gray-500 uppercase">Kamar</th>
                                <th class="px-4 py-3 text-xs font-bold text-gray-500 uppercase">Harga Bulanan</th>
                                <th class="px-4 py-3 text-xs font-bold text-gray-500 uppercase">Jatuh Tempo</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($penyewaMenunggak as $pm)
                            <tr class="hover:bg-red-50 transition">
                                <td class="px-4 py-3 font-bold text-slate-700">{{ $pm->nama }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $pm->kos->nama_kos ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $pm->nomor_kamar }}</td>
                                <td class="px-4 py-3 text-sm font-bold text-slate-700">Rp {{ number_format($pm->harga_bulanan, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">
                                        {{ \Carbon\Carbon::parse($pm->jatuh_tempo)->format('d M Y') }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </main>
    </div>

    {{-- CHART.JS SCRIPTS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart Pendapatan
            const ctxPendapatan = document.getElementById('chartPendapatan').getContext('2d');
            new Chart(ctxPendapatan, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(collect($pendapatanPerBulan)->pluck('label')) !!},
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: {!! json_encode(collect($pendapatanPerBulan)->pluck('jumlah')) !!},
                        backgroundColor: [
                            'rgba(16, 185, 129, 0.2)',
                            'rgba(16, 185, 129, 0.3)',
                            'rgba(16, 185, 129, 0.4)',
                            'rgba(16, 185, 129, 0.5)',
                            'rgba(16, 185, 129, 0.7)',
                            'rgba(16, 185, 129, 0.9)',
                        ],
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 2,
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    }
                }
            });

            // Chart Status Pembayaran
            const ctxStatus = document.getElementById('chartStatus').getContext('2d');
            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: ['Diterima', 'Menunggu', 'Ditolak'],
                    datasets: [{
                        data: [{{ $pembayaranDiterima }}, {{ $pembayaranMenunggu }}, {{ $pembayaranDitolak }}],
                        backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                    },
                    cutout: '65%',
                }
            });
        });
    </script>

</body>
</html>
