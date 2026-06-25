<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - NyamanKost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    {{-- ============================= --}}
    {{-- SIDEBAR --}}
    {{-- ============================= --}}
    <aside class="w-64 bg-slate-900 text-white flex-shrink-0 shadow-xl flex flex-col justify-between">
        <div>
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
                <div class="pt-6 pb-2 border-t border-slate-800 mt-6">
                    <p class="px-3 text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">Pengaturan</p>
                    <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-xl bg-yellow-400 text-slate-900 font-bold transition">
                        <i class="fa-solid fa-user-gear mr-3 w-5"></i> Profil Saya
                    </a>
                </div>
            </nav>
        </div>
        <div class="p-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center p-3 rounded-xl hover:bg-red-600 transition text-sm text-red-300 hover:text-white">
                    <i class="fa-solid fa-right-from-bracket mr-3 w-5"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ============================= --}}
    {{-- MAIN CONTENT --}}
    {{-- ============================= --}}
    <main class="flex-grow overflow-y-auto">

        {{-- HEADER --}}
        <header class="bg-white py-4 px-10 shadow-sm flex justify-between items-center sticky top-0 z-10">
            <div>
                <h1 class="font-bold text-slate-700 text-lg">Profil Saya</h1>
                <p class="text-xs text-slate-400">Kelola informasi akun administrator Anda</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm font-bold text-slate-600">{{ Auth::user()->name }}</span>
                @if(Auth::user()->foto_profil)
                    <img class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-sm"
                         src="{{ asset('storage/'.Auth::user()->foto_profil) }}"
                         alt="Foto Profil">
                @else
                    <div class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center font-black text-slate-900 border-2 border-white shadow-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
            </div>
        </header>

        <div class="p-10 max-w-5xl mx-auto">

            {{-- PROFILE HERO CARD --}}
            <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-3xl p-8 mb-8 relative overflow-hidden shadow-xl">
                <div class="absolute -right-10 -top-10 w-52 h-52 bg-yellow-400/10 rounded-full"></div>
                <div class="absolute -right-4 -bottom-10 w-36 h-36 bg-yellow-400/5 rounded-full"></div>
                <div class="relative z-10 flex items-center gap-6">
                    <div class="flex-shrink-0">
    @if($user->foto_profil)
        <img
            src="{{ asset('storage/'.$user->foto_profil) }}"
            alt="Foto Profil"
            class="w-24 h-24 rounded-2xl object-cover border-4 border-yellow-400 shadow-lg">
    @else
        <div class="w-24 h-24 rounded-2xl bg-yellow-400 flex items-center justify-center text-4xl font-black text-slate-900 shadow-lg">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
    @endif
</div>
                    <div>
                        <p class="text-yellow-400 text-xs font-bold uppercase tracking-widest mb-1">Administrator</p>
                        <h2 class="text-3xl font-black text-white">{{ $user->name }}</h2>
                        <p class="text-slate-400 mt-1 text-sm">{{ $user->email }}</p>

<form method="POST"
      action="{{ route('profile.update') }}"
      enctype="multipart/form-data"
      class="mt-3">

    @csrf
    @method('PATCH')

    <input type="hidden" name="name" value="{{ $user->name }}">
    <input type="hidden" name="email" value="{{ $user->email }}">
    <input type="hidden" name="no_hp" value="{{ $user->no_hp }}">

    <input
        type="file"
        name="foto_profil"
        onchange="this.form.submit()"
        class="text-xs text-white file:bg-yellow-400 file:text-slate-900 file:border-0 file:px-3 file:py-2 file:rounded-lg file:font-bold">
</form>
                        <div class="flex items-center gap-4 mt-3">
                            <span class="bg-yellow-400/20 text-yellow-400 text-xs px-3 py-1 rounded-full font-bold border border-yellow-400/30">
                                <i class="fa-solid fa-shield-halved mr-1"></i> Admin
                            </span>
                            @if($user->no_hp)
                            <span class="bg-slate-700 text-slate-300 text-xs px-3 py-1 rounded-full">
                                <i class="fa-solid fa-phone mr-1"></i> {{ $user->no_hp }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- SUCCESS / ERROR NOTIFICATION --}}
            @if(session('status') === 'profile-updated')
            <div class="mb-6 flex items-center p-4 text-green-800 border border-green-300 rounded-xl bg-green-50">
                <i class="fa-solid fa-circle-check text-green-600 mr-3 text-lg"></i>
                <span class="font-medium">Profil berhasil diperbarui!</span>
            </div>
            @endif
            @if(session('status') === 'password-updated')
            <div class="mb-6 flex items-center p-4 text-green-800 border border-green-300 rounded-xl bg-green-50">
                <i class="fa-solid fa-circle-check text-green-600 mr-3 text-lg"></i>
                <span class="font-medium">Password berhasil diperbarui!</span>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- ======================== --}}
                {{-- UPDATE PROFILE INFO --}}
                {{-- ======================== --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-user-pen text-slate-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Informasi Profil</h3>
                            <p class="text-xs text-gray-400">Perbarui nama, email, dan nomor HP Anda</p>
                        </div>
                    </div>

                    <form method="post"
      action="{{ route('profile.update') }}"
      enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                            <div class="relative">
                                <i class="fa-solid fa-user absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-slate-400 focus:border-slate-400 transition text-sm @error('name') border-red-400 @enderror"
                                    placeholder="Nama lengkap" required>
                            </div>
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Email</label>
                            <div class="relative">
                                <i class="fa-solid fa-envelope absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-slate-400 focus:border-slate-400 transition text-sm @error('email') border-red-400 @enderror"
                                    placeholder="Email" required>
                            </div>
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- No HP --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor HP</label>
                            <div class="relative">
                                <i class="fa-solid fa-phone absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                                <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-slate-400 focus:border-slate-400 transition text-sm @error('no_hp') border-red-400 @enderror"
                                    placeholder="Contoh: 08123456789">
                            </div>
                            @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-slate-900 hover:bg-yellow-400 hover:text-slate-900 text-white font-bold py-3 rounded-xl transition-all duration-300 shadow-md mt-2">
                            <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>

                {{-- ======================== --}}
                {{-- UPDATE PASSWORD --}}
                {{-- ======================== --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-lock text-yellow-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Ubah Password</h3>
                            <p class="text-xs text-gray-400">Pastikan menggunakan password yang kuat</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        @method('put')

                        {{-- Current Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password Saat Ini</label>
                            <div class="relative">
                                <i class="fa-solid fa-key absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                                <input id="current_password" type="password" name="current_password"
                                    class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition text-sm @error('current_password', 'updatePassword') border-red-400 @enderror"
                                    placeholder="Password lama">
                                <button type="button" onclick="togglePwd('current_password', 'eye1')" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                                    <i id="eye1" class="fa-solid fa-eye text-sm"></i>
                                </button>
                            </div>
                            @error('current_password', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- New Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password Baru</label>
                            <div class="relative">
                                <i class="fa-solid fa-lock absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                                <input id="new_password" type="password" name="password"
                                    class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition text-sm @error('password', 'updatePassword') border-red-400 @enderror"
                                    placeholder="Password baru">
                                <button type="button" onclick="togglePwd('new_password', 'eye2')" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                                    <i id="eye2" class="fa-solid fa-eye text-sm"></i>
                                </button>
                            </div>
                            @error('password', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password</label>
                            <div class="relative">
                                <i class="fa-solid fa-lock absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                                <input id="confirm_password" type="password" name="password_confirmation"
                                    class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition text-sm"
                                    placeholder="Ulangi password baru">
                                <button type="button" onclick="togglePwd('confirm_password', 'eye3')" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                                    <i id="eye3" class="fa-solid fa-eye text-sm"></i>
                                </button>
                            </div>
                            @error('password_confirmation', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-yellow-400 hover:bg-yellow-500 text-slate-900 font-bold py-3 rounded-xl transition-all duration-300 shadow-md mt-2">
                            <i class="fa-solid fa-shield-halved mr-2"></i> Perbarui Password
                        </button>
                    </form>
                </div>
            </div>

            {{-- DANGER ZONE --}}
            <div class="bg-white rounded-2xl shadow-sm border border-red-100 p-8 mt-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Zona Berbahaya</h3>
                        <p class="text-xs text-gray-400">Tindakan ini tidak dapat dibatalkan</p>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mb-5">Menghapus akun akan menghapus semua data yang terkait secara permanen dari sistem. Pastikan Anda yakin sebelum melanjutkan.</p>
                <button onclick="document.getElementById('deleteAccountModal').classList.remove('hidden')"
                    class="bg-red-50 hover:bg-red-600 text-red-600 hover:text-white border border-red-200 hover:border-transparent font-bold px-6 py-2.5 rounded-xl transition-all duration-300">
                    <i class="fa-solid fa-trash mr-2"></i> Hapus Akun Saya
                </button>
            </div>

        </div>
    </main>
</div>

{{-- DELETE ACCOUNT MODAL --}}
<div id="deleteAccountModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 mx-4">
        <div class="text-center">
            <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-trash text-red-600 text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Hapus Akun?</h3>
            <p class="text-gray-500 text-sm mb-6">Masukkan password Anda untuk mengkonfirmasi penghapusan akun secara permanen.</p>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                <input type="password" name="password" placeholder="Masukkan password Anda"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-400 focus:border-red-400 mb-4 text-sm">
                @error('password', 'userDeletion') <p class="text-red-500 text-xs mb-3">{{ $message }}</p> @enderror
                <div class="flex gap-3">
                    <button type="button" onclick="document.getElementById('deleteAccountModal').classList.add('hidden')"
                        class="flex-1 py-3 border border-gray-200 rounded-xl text-gray-600 hover:bg-gray-50 transition font-medium">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl transition font-bold">
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePwd(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>

</body>
</html>
