<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - Admin PapiKost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans flex">

    <aside class="w-64 bg-slate-900 text-white min-h-screen flex-shrink-0 flex flex-col justify-between">
        <div>
            <div class="p-6 text-2xl font-black text-yellow-400 border-b border-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-house-chimney"></i> NYAMANKOST
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded-xl hover:bg-slate-800 transition">
                    <i class="fa-solid fa-gauge mr-3 w-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 rounded-xl bg-yellow-400 text-slate-900 font-bold transition">
                    <i class="fa-solid fa-users mr-3 w-5"></i> Data User
                </a>
                <a href="{{ route('admin.kos.index') }}" class="flex items-center p-3 rounded-xl hover:bg-slate-800 transition">
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
                </div>
            </nav>
        </div>
        <div class="p-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center p-3 rounded-xl hover:bg-red-600 text-red-300 hover:text-white transition text-sm">
                    <i class="fa-solid fa-right-from-bracket mr-3"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-grow p-10">
        <div class="mb-8">
            <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-700 mb-2 inline-block">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Tambah Pengguna Baru</h1>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200 max-w-2xl">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="grid gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" class="w-full border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor HP</label>
                        <input type="text" name="no_hp" class="w-full border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Role / Hak Akses</label>
                        <select name="role" class="w-full border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="penyewa">Penyewa</option>
                            <option value="pemilik">Pemilik</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" class="w-full border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500" required>
                    </div>

                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-lg shadow-lg transition mt-4">
                        Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>