@php $sidebarOpen = false; @endphp
<div x-data="{ sidebarOpen: false }">

    {{-- SIDEBAR --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed top-0 left-0 h-full w-64 z-40 bg-indigo-600 flex flex-col justify-between transition-transform duration-300 ease-in-out shadow-xl">

        <div>
            {{-- LOGO --}}
            <div class="flex items-center gap-3 px-6 py-7 border-b border-indigo-500/50">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-600 shadow-md flex-shrink-0">
                    <i class="fa-solid fa-house text-xl"></i>
                </div>
                <span class="text-xl font-black text-white tracking-wide uppercase">Nyamankost</span>
            </div>

            {{-- NAVIGATION --}}
            <nav class="mt-6 px-3 space-y-1">
                <a href="{{ route('user.dashboard') }}"
                   class="flex items-center px-4 py-3 rounded-xl {{ isset($activePage) && $activePage == 'dashboard' ? 'bg-white/20 text-white font-bold border border-white/20' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }} transition">
                    <i class="fa-solid fa-gauge-high w-5 text-base"></i>
                    <span class="ml-3">Dashboard</span>
                </a>

                <a href="{{ route('user.cari') }}"
                   class="flex items-center px-4 py-3 rounded-xl {{ isset($activePage) && $activePage == 'cari' ? 'bg-white/20 text-white font-bold border border-white/20' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }} transition">
                    <i class="fa-solid fa-magnifying-glass w-5 text-base"></i>
                    <span class="ml-3">Cari Kos</span>
                </a>

                <a href="{{ route('user.riwayat') }}"
                   class="flex items-center px-4 py-3 rounded-xl {{ isset($activePage) && $activePage == 'riwayat' ? 'bg-white/20 text-white font-bold border border-white/20' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }} transition">
                    <i class="fa-solid fa-clock-rotate-left w-5 text-base"></i>
                    <span class="ml-3">Riwayat Bayar</span>
                </a>

                <div class="pt-4 mt-4 border-t border-indigo-500/50">
                    <p class="px-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest mb-2">Pengaturan</p>
                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center px-4 py-3 rounded-xl text-indigo-100 hover:bg-indigo-700 hover:text-white transition">
                        <i class="fa-solid fa-user-gear w-5 text-base"></i>
                        <span class="ml-3">Profil Saya</span>
                    </a>
                </div>
            </nav>
        </div>

        {{-- LOGOUT --}}
        <div class="px-4 mb-8">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="flex items-center justify-center w-full px-4 py-3 text-red-200 border border-red-400/40 hover:bg-red-500 hover:text-white hover:border-transparent rounded-xl transition font-medium text-sm">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- OVERLAY mobile --}}
    <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
         class="fixed inset-0 z-30 bg-black/50 lg:hidden" style="display:none;"></div>

    {{-- MOBILE TOGGLE stored so header can use it --}}
</div>
