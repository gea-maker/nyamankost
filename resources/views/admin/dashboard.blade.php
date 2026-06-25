<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - NYAMANKOST</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 shadow-xl">
            <div class="p-6 text-2xl font-black text-yellow-400 border-b border-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-house-chimney"></i> NYAMANKOST
            </div>
            
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-yellow-400 text-slate-900 font-bold' : 'hover:bg-slate-800' }}">
                    <i class="fa-solid fa-gauge mr-3 w-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 rounded-xl transition {{ request()->routeIs('admin.users.*') ? 'bg-yellow-400 text-slate-900 font-bold' : 'hover:bg-slate-800' }}">
                    <i class="fa-solid fa-users mr-3 w-5"></i> Data User
                </a>
                <a href="{{ route('admin.kos.index') }}" class="flex items-center p-3 rounded-xl transition {{ request()->routeIs('admin.kos.*') ? 'bg-yellow-400 text-slate-900 font-bold' : 'hover:bg-slate-800' }}">
                    <i class="fa-solid fa-hotel mr-3 w-5"></i> Kelola Kos
                </a>
                <a href="{{ route('admin.transaksi.index') }}" class="flex items-center p-3 rounded-xl transition {{ request()->routeIs('admin.transaksi.*') ? 'bg-yellow-400 text-slate-900 font-bold' : 'hover:bg-slate-800' }}">
                    <i class="fa-solid fa-wallet mr-3 w-5"></i> Transaksi
                </a>
                <a href="{{ route('admin.laporan') }}" class="flex items-center p-3 rounded-xl transition {{ request()->routeIs('admin.laporan') ? 'bg-yellow-400 text-slate-900 font-bold' : 'hover:bg-slate-800' }}">
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

        <main class="flex-grow">
            <header class="bg-white py-4 px-10 shadow-sm flex justify-between items-center">
                <h2 class="font-bold text-slate-700">Panel Kendali Admin</h2>
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
                <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-64 h-64 bg-yellow-400/10 rounded-full"></div>
                    
                    <div class="relative z-10">
                        <h1 class="text-4xl font-black text-slate-900 mb-4">Selamat Datang, Admin! 👋</h1>
                        <p class="text-slate-500 text-lg max-w-2xl leading-relaxed">
                            Aplikasi NYAMANKOST siap dikelola. Pantau performa bisnis, validasi data user, 
                            dan pastikan sistem berjalan lancar. Hari ini ada {{ \App\Models\User::count() }} pengguna terdaftar di sistem Anda.
                        </p>
                        
                        <div class="mt-8 flex gap-4">
                            <a href="{{ route('admin.users.index') }}" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-bold hover:bg-yellow-400 hover:text-slate-900 transition-all duration-300 shadow-lg shadow-slate-200">
                                Mulai Kelola User
                            </a>
                            <a href="{{ route('admin.laporan') }}" class="bg-white border-2 border-slate-200 text-slate-600 px-8 py-3 rounded-xl font-bold hover:bg-slate-50 transition">
                                Lihat Laporan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-10">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-4 text-xl">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <p class="text-gray-400 text-sm font-bold uppercase">Total User</p>
                        <h3 class="text-3xl font-black">{{ \App\Models\User::count() }}</h3>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center mb-4 text-xl">
                            <i class="fa-solid fa-house-circle-check"></i>
                        </div>
                        <p class="text-gray-400 text-sm font-bold uppercase">Kos Aktif</p>
                        <h3 class="text-3xl font-black">{{ \App\Models\Kos::count() }}</h3>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-4 text-xl">
                            <i class="fa-solid fa-money-bill-trend-up"></i>
                        </div>
                        <p class="text-gray-400 text-sm font-bold uppercase">Transaksi Masuk</p>
                        <h3 class="text-3xl font-black">{{ \App\Models\Pembayaran::where('status', 'Menunggu')->count() }}</h3>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center mb-4 text-xl">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <p class="text-gray-400 text-sm font-bold uppercase">Penyewa Aktif</p>
                        <h3 class="text-3xl font-black">{{ \App\Models\Penyewa::where('status_huni', 'Aktif')->count() }}</h3>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>