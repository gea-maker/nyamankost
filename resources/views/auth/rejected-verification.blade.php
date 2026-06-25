<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Ditolak - NyamanKost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-700 via-yellow-600 to-indigo-900 px-4 py-10">
    <div class="w-full max-w-lg bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl p-8 lg:p-12 text-center border border-white/20">
        
        <!-- Error Icon -->
        <div class="w-24 h-24 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-6 text-red-600">
            <i class="fa-solid fa-circle-xmark text-5xl animate-bounce"></i>
        </div>

        <h2 class="text-3xl font-extrabold text-gray-800">Akun Ditolak</h2>
        <p class="text-gray-600 mt-4 leading-relaxed">
            Mohon maaf <span class="font-semibold text-red-600">{{ Auth::user()->name }}</span>, permohonan pendaftaran akun Anda sebagai <strong>Pemilik Kos</strong> ditolak oleh Admin.
        </p>

        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-xl my-6 text-sm text-left">
            <div class="flex">
                <div class="py-1"><i class="fa-solid fa-circle-exclamation mr-3 text-lg"></i></div>
                <div>
                    <p class="font-bold">Kenapa akun saya ditolak?</p>
                    <p class="text-xs mt-1">Penolakan biasanya terjadi karena data profil atau nomor handphone yang diisikan tidak valid. Silakan hubungi admin untuk verifikasi ulang atau informasi lebih lanjut.</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
            <!-- Contact Admin -->
            <a href="https://wa.me/6281234567890" target="_blank" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg transition duration-200">
                <i class="fa-brands fa-whatsapp mr-2 text-lg"></i> Hubungi Admin
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
