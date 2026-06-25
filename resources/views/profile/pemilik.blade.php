<x-app-layout>
<div class="flex h-screen bg-gray-50" x-data="{ sidebarOpen: false }">

    {{-- ============================= --}}
    {{-- SIDEBAR --}}
    {{-- ============================= --}}
    <div :class="sidebarOpen ? 'flex' : 'hidden'"
         @click.away="sidebarOpen = false"
         class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-indigo-900 lg:translate-x-0 lg:static lg:inset-0 flex flex-col justify-between lg:flex">
        <div>
            <div class="flex items-center justify-center mt-8">
                <span class="text-2xl font-bold text-white tracking-wider uppercase">Nyamankost</span>
            </div>
            <nav class="mt-10">
                <a href="{{ route('pemilik.dashboard') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-800 hover:text-white transition font-medium">
                    <i class="fa-solid fa-gauge-high w-6 text-lg"></i>
                    <span class="mx-3">Dashboard</span>
                </a>
                <a href="{{ route('pemilik.kelola-kos') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-800 hover:text-white transition font-medium">
                    <i class="fa-solid fa-house-chimney w-6 text-lg"></i>
                    <span class="mx-3">Kelola Kos</span>
                </a>
                <a href="{{ route('pemilik.penyewa.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-800 hover:text-white transition font-medium">
                    <i class="fa-solid fa-users w-6 text-lg"></i>
                    <span class="mx-3">Penyewa Aktif</span>
                </a>
                <a href="{{ route('pemilik.pembayaran') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-indigo-800 hover:text-white transition font-medium">
                    <i class="fa-solid fa-money-bill-wave w-6 text-lg"></i>
                    <span class="mx-3">Pembayaran</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center px-6 py-3 text-white bg-indigo-800 border-l-4 border-white font-bold">
                    <i class="fa-solid fa-user-gear w-6 text-lg"></i>
                    <span class="mx-3">Profil Saya</span>
                </a>
            </nav>
        </div>
        <div class="px-6 mb-10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center w-full px-4 py-2.5 text-red-200 border border-red-400/50 hover:bg-red-600 hover:text-white hover:border-transparent rounded-lg transition duration-200 font-medium">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    {{-- ============================= --}}
    {{-- MAIN CONTENT --}}
    {{-- ============================= --}}
    <div class="flex-grow flex flex-col overflow-hidden">

        {{-- HEADER --}}
        <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200 shadow-sm">
            <div class="flex items-center">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div class="relative mx-4 lg:mx-0">
                    <h2 class="text-2xl font-bold text-gray-800">Profil Saya</h2>
                    <p class="text-sm text-gray-500">Kelola informasi akun pemilik kos Anda</p>
                </div>
            </div>
            
            {{-- USER BADGE --}}
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-indigo-500 font-medium">Pemilik Kos</p>
                </div>
                @if(Auth::user()->foto_profil)
                    <img class="object-cover w-10 h-10 rounded-full border-2 border-indigo-500 shadow-sm"
                         src="{{ asset('storage/'.Auth::user()->foto_profil) }}"
                         alt="Avatar">
                @else
                    <img class="object-cover w-10 h-10 rounded-full border-2 border-indigo-500 shadow-sm"
                         src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff"
                         alt="Avatar">
                @endif
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="flex-grow overflow-y-auto p-6 lg:p-10">

            {{-- PROFILE HERO CARD --}}
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-3xl p-8 mb-8 relative overflow-hidden shadow-xl">
                <div class="absolute -right-10 -top-10 w-52 h-52 bg-white/5 rounded-full"></div>
                <div class="absolute -right-4 -bottom-14 w-40 h-40 bg-white/5 rounded-full"></div>
                <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                    <div class="flex-shrink-0">
                        @if($user->foto_profil)
                            <img src="{{ asset('storage/'.$user->foto_profil) }}"
                                 class="w-24 h-24 rounded-2xl shadow-xl border-4 border-white/20 object-cover" alt="Avatar">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ffffff&color=6366f1&size=128"
                                 class="w-24 h-24 rounded-2xl shadow-xl border-4 border-white/20 flex-shrink-0" alt="Avatar">
                        @endif
                    </div>
                    <div class="flex-grow">
                        <p class="text-indigo-200 text-xs font-bold uppercase tracking-widest mb-1">Pemilik Kos</p>
                        <h2 class="text-3xl font-black text-white">{{ $user->name }}</h2>
                        <p class="text-indigo-200 mt-1 text-sm">{{ $user->email }}</p>

                        <form method="POST"
                              action="{{ route('profile.update') }}"
                              enctype="multipart/form-data"
                              class="mt-3">
                            @csrf
                            @method('PATCH')

                            <!-- Hidden inputs to satisfy validation rules -->
                            <input type="hidden" name="name" value="{{ $user->name }}">
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            <input type="hidden" name="no_hp" value="{{ $user->no_hp }}">

                            <input
                                type="file"
                                name="foto_profil"
                                onchange="this.form.submit()"
                                class="text-xs text-white file:bg-white file:text-indigo-700 file:border-0 file:px-3 file:py-2 file:rounded-lg file:font-bold hover:file:bg-indigo-50 cursor-pointer">
                        </form>

                        <div class="flex flex-wrap items-center gap-3 mt-3">
                            <span class="bg-white/10 text-white text-xs px-3 py-1 rounded-full font-semibold border border-white/20">
                                <i class="fa-solid fa-house-chimney mr-1"></i> Pemilik Kos
                            </span>
                            <span class="bg-green-400/20 text-green-300 text-xs px-3 py-1 rounded-full border border-green-400/30 font-semibold">
                                <i class="fa-solid fa-circle-check mr-1"></i> Akun Terverifikasi
                            </span>
                            @if($user->no_hp)
                            <span class="bg-white/10 text-indigo-100 text-xs px-3 py-1 rounded-full">
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
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-user-pen text-indigo-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Informasi Profil</h3>
                            <p class="text-xs text-gray-400">Perbarui nama, email, dan nomor HP Anda</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                        @csrf
                        @method('patch')

                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                            <div class="relative">
                                <i class="fa-solid fa-user absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition text-sm @error('name') border-red-400 @enderror"
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
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition text-sm @error('email') border-red-400 @enderror"
                                    placeholder="Email" required>
                            </div>
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- No HP --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor HP / WhatsApp</label>
                            <div class="relative">
                                <i class="fa-brands fa-whatsapp absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                                <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition text-sm @error('no_hp') border-red-400 @enderror"
                                    placeholder="Contoh: 08123456789">
                            </div>
                            @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl transition-all duration-300 shadow-md mt-2">
                            <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>

                {{-- ======================== --}}
                {{-- UPDATE PASSWORD --}}
                {{-- ======================== --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-lock text-indigo-600"></i>
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
                                <input id="p_current" type="password" name="current_password"
                                    class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition text-sm @error('current_password', 'updatePassword') border-red-400 @enderror"
                                    placeholder="Password lama">
                                <button type="button" onclick="togglePwd('p_current','p_eye1')" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                                    <i id="p_eye1" class="fa-solid fa-eye text-sm"></i>
                                </button>
                            </div>
                            @error('current_password', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- New Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password Baru</label>
                            <div class="relative">
                                <i class="fa-solid fa-lock absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                                <input id="p_new" type="password" name="password"
                                    class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition text-sm @error('password', 'updatePassword') border-red-400 @enderror"
                                    placeholder="Password baru">
                                <button type="button" onclick="togglePwd('p_new','p_eye2')" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                                    <i id="p_eye2" class="fa-solid fa-eye text-sm"></i>
                                </button>
                            </div>
                            @error('password', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password</label>
                            <div class="relative">
                                <i class="fa-solid fa-lock absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                                <input id="p_confirm" type="password" name="password_confirmation"
                                    class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition text-sm"
                                    placeholder="Ulangi password baru">
                                <button type="button" onclick="togglePwd('p_confirm','p_eye3')" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                                    <i id="p_eye3" class="fa-solid fa-eye text-sm"></i>
                                </button>
                            </div>
                            @error('password_confirmation', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-indigo-500 to-indigo-700 hover:from-indigo-600 hover:to-indigo-800 text-white font-bold py-3 rounded-xl transition-all duration-300 shadow-md mt-2">
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
                        <p class="text-xs text-gray-400">Tindakan ini bersifat permanen dan tidak dapat dibatalkan</p>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mb-5">Dengan menghapus akun, seluruh data kos, penyewa, dan riwayat pembayaran yang terkait akan ikut terhapus secara permanen.</p>
                <button onclick="document.getElementById('deleteAccountModal').classList.remove('hidden')"
                    class="bg-red-50 hover:bg-red-600 text-red-600 hover:text-white border border-red-200 hover:border-transparent font-bold px-6 py-2.5 rounded-xl transition-all duration-300">
                    <i class="fa-solid fa-trash mr-2"></i> Hapus Akun Saya
                </button>
            </div>

        </main>
    </div>
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
</x-app-layout>
