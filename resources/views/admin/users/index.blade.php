<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - Admin PapiKost</title>
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
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Manajemen Pengguna</h1>
            <a href="{{ route('admin.users.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg font-bold shadow-md transition">
                <i class="fa-solid fa-plus mr-2"></i> Tambah User
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-sm font-bold text-gray-600">NAMA</th>
                        <th class="px-6 py-4 text-sm font-bold text-gray-600">EMAIL / NO HP</th>
                        <th class="px-6 py-4 text-sm font-bold text-gray-600">ROLE</th>
                        <th class="px-6 py-4 text-sm font-bold text-gray-600">STATUS VERIFIKASI</th>
                        <th class="px-6 py-4 text-sm font-bold text-gray-600 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $user->email }} <br> <span class="text-xs text-gray-400">{{ $user->no_hp }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->role == 'admin')
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Admin</span>
                            @elseif($user->role == 'pemilik')
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Pemilik</span>
                            @else
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Penyewa</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($user->role == 'pemilik')
                                @if($user->status_verifikasi == 'menunggu')
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-bold uppercase">Menunggu Verifikasi</span>
                                @elseif($user->status_verifikasi == 'disetujui')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Disetujui</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Ditolak</span>
                                @endif
                            @else
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold uppercase">Otomatis Disetujui</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                @if($user->role == 'pemilik')
                                    @if($user->status_verifikasi == 'menunggu' || $user->status_verifikasi == 'ditolak')
                                        <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="inline">
                                            @csrf @method('PUT')
                                            <button type="submit" class="text-green-600 hover:bg-green-50 p-2 rounded-lg transition" title="Setujui Akun Pemilik">
                                                <i class="fa-solid fa-check text-lg"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($user->status_verifikasi == 'menunggu' || $user->status_verifikasi == 'disetujui')
                                        <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menolak akun pemilik ini?')">
                                            @csrf @method('PUT')
                                            <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition" title="Tolak Akun Pemilik">
                                                <i class="fa-solid fa-xmark text-lg"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endif
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:bg-blue-50 p-2 rounded-lg transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                @if($user->id != Auth::id())
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>