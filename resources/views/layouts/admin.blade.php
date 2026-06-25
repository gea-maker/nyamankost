<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} - NYAMANKOST</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 shadow-xl fixed h-full">
            <div class="p-6 text-2xl font-black text-blue-500 border-b border-slate-800 flex items-center gap-2 uppercase">
                <i class="fa-solid fa-house-chimney-window"></i> NYAMANKOST
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white font-bold' : 'hover:bg-slate-800' }}">
                    <i class="fa-solid fa-gauge mr-3 w-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 rounded-xl transition {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white font-bold' : 'hover:bg-slate-800' }}">
                    <i class="fa-solid fa-users mr-3 w-5"></i> Data User
                </a>
                <a href="#" class="flex items-center p-3 rounded-xl hover:bg-slate-800 transition">
                    <i class="fa-solid fa-hotel mr-3 w-5"></i> Kelola Kos
                </a>
                <div class="pt-10 border-t border-slate-800">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center p-3 rounded-xl hover:bg-red-600 transition text-sm">
                            <i class="fa-solid fa-right-from-bracket mr-3 w-5"></i> Keluar
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <main class="flex-grow ml-64">
            <header class="bg-white py-4 px-10 shadow-sm flex justify-between items-center sticky top-0 z-40">
                <h2 class="font-bold text-slate-700 uppercase tracking-wider">Admin Panel</h2>
                <div class="flex items-center gap-3">
                    <span class="text-sm font-bold">{{ Auth::user()->name }}</span>
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="p-8">
                {{ $slot }} </div>
        </main>
    </div>
</body>
</html>