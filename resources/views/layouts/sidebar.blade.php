@php
    $menuClass = "flex items-center gap-3 px-4 py-3 rounded-2xl transition";
@endphp

<aside class="w-64 min-h-screen bg-indigo-900 text-white flex flex-col justify-between shadow-xl">

    <div>

        <div class="p-6 border-b border-indigo-800">

            <h1 class="text-2xl font-extrabold tracking-wider">
                NYAMANKOST
            </h1>

            <p class="text-xs text-indigo-200 mt-1">
                Sistem Manajemen Kos
            </p>

        </div>

        <nav class="mt-6 px-3 space-y-2">

            {{-- Dashboard --}}
            <a href="{{ route('pemilik.dashboard') }}"
               class="{{ $menuClass }}
               {{ request()->routeIs('pemilik.dashboard')
                    ? 'bg-indigo-600 text-white shadow-lg'
                    : 'text-indigo-100 hover:bg-indigo-700' }}">

                <i class="fa-solid fa-gauge-high w-5"></i>
                <span>Dashboard</span>

            </a>

            {{-- Kelola Kos --}}
            <a href="{{ route('pemilik.kelola-kos') }}"
               class="{{ $menuClass }}
               {{ request()->routeIs('pemilik.kelola-kos*')
                    ? 'bg-indigo-600 text-white shadow-lg'
                    : 'text-indigo-100 hover:bg-indigo-700' }}">

                <i class="fa-solid fa-building w-5"></i>
                <span>Kelola Kos</span>

            </a>

            {{-- Penyewa --}}
            <a href="{{ route('pemilik.penyewa.index') }}"
               class="{{ $menuClass }}
               {{ request()->routeIs('pemilik.penyewa*')
                    ? 'bg-indigo-600 text-white shadow-lg'
                    : 'text-indigo-100 hover:bg-indigo-700' }}">

                <i class="fa-solid fa-users w-5"></i>
                <span>Penyewa Aktif</span>

            </a>

            {{-- Pembayaran --}}
            <a href="{{ route('pemilik.pembayaran') }}"
               class="{{ $menuClass }}
               {{ request()->routeIs('pemilik.pembayaran*')
                    ? 'bg-indigo-600 text-white shadow-lg'
                    : 'text-indigo-100 hover:bg-indigo-700' }}">

                <i class="fa-solid fa-money-bill-wave w-5"></i>
                <span>Pembayaran</span>

            </a>

        </nav>

    </div>

    <div class="p-4">

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="w-full flex items-center justify-center gap-2 border border-red-300 text-red-200 hover:bg-red-500 hover:border-red-500 hover:text-white py-3 rounded-2xl transition">

                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Keluar</span>

            </button>

        </form>

    </div>

</aside>