<header class="sticky top-0 z-20 bg-white border-b border-gray-200 shadow-sm" x-data="{ sidebarOpen: false }">
    <div class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center gap-4">
            <button @click="sidebarOpen = true" class="text-gray-500 lg:hidden" x-on:click="document.querySelector('aside').__x.$data.sidebarOpen = true">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <div>
                <h1 class="text-xl font-bold text-gray-800">{{ $title ?? 'Dashboard' }}</h1>
                <p class="text-xs text-gray-400">Selamat datang, {{ Auth::user()->name }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                <p class="text-xs {{ isset($penyewa) && $penyewa ? 'text-green-500' : 'text-gray-400' }} font-medium">
                    {{ isset($penyewa) && $penyewa ? 'Penyewa Aktif' : 'Calon Penyewa' }}
                </p>
            </div>
            @if(Auth::user()->foto_profil)
                <img class="w-10 h-10 rounded-full border-2 border-indigo-200 object-cover"
                     src="{{ asset('storage/'.Auth::user()->foto_profil) }}"
                     alt="Avatar">
            @else
                <img class="w-10 h-10 rounded-full border-2 border-indigo-200 object-cover"
                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=e0e7ff&color=4f46e5"
                     alt="Avatar">
            @endif
        </div>
    </div>
</header>
