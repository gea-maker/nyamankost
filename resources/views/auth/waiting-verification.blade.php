<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Verifikasi - NyamanKost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-700 via-yellow-600 to-indigo-900 px-4 py-10">
    <div class="w-full max-w-lg bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl p-8 lg:p-12 text-center border border-white/20">
        
        <!-- Animated Icon -->
        <div class="w-24 h-24 rounded-full bg-yellow-100 flex items-center justify-center mx-auto mb-6 text-yellow-600 animate-pulse">
            <i class="fa-solid fa-clock-rotate-left text-5xl"></i>
        </div>

        <h2 class="text-3xl font-extrabold text-gray-800">Menunggu Verifikasi</h2>
        <p class="text-gray-600 mt-4 leading-relaxed">
            Halo <span class="font-semibold text-indigo-600">{{ Auth::user()->name }}</span>, akun Anda sebagai <strong>Pemilik Kos</strong> telah terdaftar dan saat ini sedang menunggu verifikasi oleh Admin kami.
        </p>

        <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded-xl my-6 text-sm text-left">
            <div class="flex">
                <div class="py-1"><i class="fa-solid fa-circle-info mr-3 text-lg"></i></div>
                <div>
                    <p class="font-bold">Info Penting</p>
                    <p class="text-xs mt-1">Kami akan memverifikasi kelayakan akun Anda secepatnya. Silakan periksa kembali halaman ini secara berkala atau hubungi tim support kami.</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
            <!-- Refresh Page Button -->
            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg transition duration-200">
                <i class="fa-solid fa-arrows-rotate mr-2"></i> Perbarui Status
            </a>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                @csrf
                <button type="submit" class="w-full sm:w-auto bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl font-semibold transition duration-200">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Keluar
                </button>
            </form>
        </div>
        
    </div>
</div>

</body>
</html>
