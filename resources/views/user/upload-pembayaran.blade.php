<x-app-layout>

<div class="flex h-screen bg-gray-50" x-data="{ sidebarOpen: false }">

    {{-- ============================= --}}
    {{-- SIDEBAR PENYEWA --}}
    {{-- ============================= --}}
    <div :class="sidebarOpen ? 'flex' : 'hidden'"
         @click.away="sidebarOpen = false"
         class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-indigo-600 lg:translate-x-0 lg:static lg:inset-0 flex flex-col justify-between lg:flex shadow-xl">
        
        <div>
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-indigo-600">
                        <i class="fa-solid fa-house text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-white tracking-wider uppercase">Nyamankost</span>
                </div>
            </div>

            <nav class="mt-10">
                <a href="{{ route('user.dashboard') }}" class="flex items-center px-6 py-3 text-indigo-100 hover:bg-indigo-700 hover:text-white transition font-medium">
                    <i class="fa-solid fa-gauge-high w-6 text-lg"></i>
                    <span class="mx-3">Dashboard Penyewa</span>
                </a>
                
                <a href="{{ route('home') }}" class="flex items-center px-6 py-3 text-indigo-100 hover:bg-indigo-700 hover:text-white transition font-medium">
                    <i class="fa-solid fa-magnifying-glass w-6 text-lg"></i>
                    <span class="mx-3">Cari Kos</span>
                </a>

                <a href="{{ route('user.riwayat') }}" class="flex items-center px-6 py-3 text-indigo-100 hover:bg-indigo-700 hover:text-white transition font-medium">
                    <i class="fa-solid fa-clock-rotate-left w-6 text-lg"></i>
                    <span class="mx-3">Riwayat Pembayaran</span>
                </a>

                <div class="pt-6 pb-2 border-t border-indigo-500/50 mt-6">
                    <p class="px-6 text-xs font-bold text-indigo-300 uppercase tracking-widest mb-3">Pengaturan</p>
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-6 py-3 text-indigo-100 hover:bg-indigo-700 hover:text-white transition font-medium">
                        <i class="fa-solid fa-user-gear w-6 text-lg"></i>
                        <span class="mx-3">Profil Saya</span>
                    </a>
                </div>
            </nav>
        </div>

        <div class="px-6 mb-10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center w-full px-4 py-2.5 text-red-200 border border-red-400/50 hover:bg-red-500 hover:text-white hover:border-transparent rounded-xl transition duration-200 font-medium">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    {{-- ============================= --}}
    {{-- MAIN CONTENT --}}
    {{-- ============================= --}}
    <div class="flex-1 flex flex-col overflow-hidden">
        
        {{-- HEADER --}}
        <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200 shadow-sm">
            <div class="flex items-center">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div class="relative mx-4 lg:mx-0 flex items-center gap-3">
                    <a href="{{ route('user.dashboard') }}" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-indigo-100 hover:text-indigo-600 transition">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <h2 class="text-2xl font-bold text-gray-800">Upload Bukti Bayar</h2>
                </div>
            </div>
            
            {{-- USER BADGE --}}
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-indigo-500 font-medium">Penyewa Aktif</p>
                </div>
                @if(Auth::user()->foto_profil)
                    <img class="object-cover w-10 h-10 rounded-full border-2 border-indigo-200 shadow-sm"
                         src="{{ asset('storage/'.Auth::user()->foto_profil) }}"
                         alt="Avatar">
                @else
                    <img class="object-cover w-10 h-10 rounded-full border-2 border-indigo-200 shadow-sm"
                         src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=e0e7ff&color=4f46e5"
                         alt="Avatar">
                @endif
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="flex-1 overflow-y-auto p-6 lg:p-10 bg-gray-50">
            
            <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-cloud-arrow-up text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">Kirim Bukti Pembayaran</h3>
                    <p class="text-gray-500 mt-2">Pastikan bukti transfer terlihat jelas agar cepat diverifikasi oleh pemilik kos.</p>
                </div>

                @if(session('success'))
                <div class="mb-6 flex items-center p-4 text-green-800 border border-green-300 rounded-xl bg-green-50">
                    <i class="fa-solid fa-circle-check text-green-600 mr-3 text-lg"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                @endif

                <form action="{{ route('user.upload.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="bg-indigo-50 border border-indigo-100 p-5 rounded-2xl mb-6">
                        <p class="text-sm text-indigo-800 font-medium mb-1">Informasi Tagihan</p>
                        <div class="flex justify-between items-center">
                            <span class="text-indigo-600 font-bold">Total Pembayaran:</span>
                            <span class="text-2xl font-black text-indigo-700">Rp {{ number_format($penyewa->harga_bulanan, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Upload File (JPG, PNG)</label>
                        <input type="file" name="bukti_bayar" accept="image/*" required
                               class="w-full text-gray-500 border border-gray-200 rounded-xl p-3 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('bukti_bayar')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-[#16a34a] hover:bg-green-700 text-white font-bold py-3.5 rounded-xl shadow-lg transition duration-300 flex items-center justify-center">
                        <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Bukti Pembayaran
                    </button>
                </form>

            </div>

        </main>
    </div>
</div>

</x-app-layout>