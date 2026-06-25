<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NyamanKost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-700 via-yellow-600 to-indigo-900 px-4 py-10">
    <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden grid lg:grid-cols-2">

        {{-- PANEL KIRI --}}
        <div class="hidden lg:flex flex-col justify-center items-center bg-gradient-to-br from-indigo-700 to-yellow-600 text-white p-16">
            <div class="w-28 h-28 rounded-full bg-white/20 flex items-center justify-center mb-8">
                <i class="fa-solid fa-house text-6xl"></i>
            </div>
            <h1 class="text-5xl font-bold tracking-wider">NYAMANKOST</h1>
            <p class="mt-6 text-center text-indigo-100 text-lg leading-relaxed max-w-md">
                Sistem Manajemen Kos Modern untuk Pemilik dan Penyewa.
                Kelola kamar, data penyewa, pembayaran, dan laporan dengan mudah dalam satu platform.
            </p>
            <div class="mt-12 grid grid-cols-3 gap-8 text-center">
                <div>
                    <i class="fa-solid fa-users text-3xl"></i>
                    <p class="mt-3">Penyewa</p>
                </div>
                <div>
                    <i class="fa-solid fa-building text-3xl"></i>
                    <p class="mt-3">Kos</p>
                </div>
                <div>
                    <i class="fa-solid fa-money-bill-wave text-3xl"></i>
                    <p class="mt-3">Pembayaran</p>
                </div>
            </div>
        </div>

        {{-- PANEL LOGIN --}}
        <div class="p-10 lg:p-16 flex flex-col justify-center">

            <div class="text-center mb-8">
                <div class="lg:hidden mb-4">
                    <i class="fa-solid fa-house text-5xl text-indigo-600"></i>
                </div>
                <h2 class="text-4xl font-bold text-gray-800">Selamat Datang</h2>
                <p class="text-gray-500 mt-3">Masuk ke akun NyamanKost Anda</p>

                <div class="mt-4">
                    <a href="{{ route('google.login') }}"
                       class="w-full flex items-center justify-center gap-3 border border-gray-300 py-3 rounded-xl hover:bg-gray-50 transition">
                        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-5 h-5">
                        <span class="font-medium">Masuk dengan Google</span>
                    </a>
                </div>
            </div>

            {{-- NOTIF ERROR (salah email/password + sisa percobaan) --}}
            @if ($errors->any())
                <div class="mb-5 rounded-xl bg-red-50 border border-red-300 p-4 flex items-start gap-3">
                    <i class="fa-solid fa-circle-exclamation text-red-500 mt-0.5 text-lg"></i>
                    <ul class="text-red-600 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- COUNTDOWN LOCKOUT --}}
            @if(session('lockout_until'))
                <div class="mb-5 rounded-xl bg-orange-50 border border-orange-300 p-5 text-center" id="lockout-box">
                    <div class="flex items-center justify-center gap-2 mb-2">
                        <i class="fa-solid fa-lock text-orange-500 text-xl"></i>
                        <p class="text-orange-700 font-semibold text-base">Akun Dikunci Sementara</p>
                    </div>
                    <p class="text-orange-500 text-sm mb-3">Terlalu banyak percobaan login. Silakan tunggu:</p>
                    <div class="inline-flex items-center justify-center bg-orange-100 border border-orange-300 rounded-2xl px-8 py-3">
                        <span class="text-4xl font-bold text-orange-700 tracking-widest" id="countdown">03:00</span>
                    </div>
                    <p class="text-orange-400 text-xs mt-3">Tombol login akan aktif kembali secara otomatis</p>
                </div>
            @endif

            {{-- SUCCESS --}}
            @if(session('status'))
                <div class="mb-5 rounded-xl bg-green-50 border border-green-300 p-4 flex items-center gap-3 text-green-700">
                    <i class="fa-solid fa-circle-check text-green-500"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf

                {{-- EMAIL --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="Masukkan Email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 @error('email') border-red-400 bg-red-50 @enderror">
                </div>

                {{-- PASSWORD --}}
                <div class="mt-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            placeholder="Masukkan Password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 @error('email') border-red-400 bg-red-50 @enderror">
                        <button type="button" onclick="togglePassword()" class="absolute right-4 top-3.5 text-gray-400 hover:text-gray-600">
                            <i id="eyeIcon" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                {{-- REMEMBER + LUPA PASSWORD --}}
                <div class="mt-5 flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600">
                        <span class="text-sm text-gray-600">Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                {{-- CAPTCHA --}}
                <div class="mt-5">
                    {!! NoCaptcha::display() !!}
                    @error('g-recaptcha-response')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- TOMBOL LOGIN --}}
                <div class="mt-6">
                    <button
                        type="submit"
                        id="submit-btn"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white py-3 rounded-xl font-semibold shadow-lg transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Masuk ke Akun
                    </button>
                </div>

                {{-- REGISTER --}}
                <div class="text-center mt-6">
                    <span class="text-gray-500">Belum punya akun?</span>
                    <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:text-indigo-800">
                        Daftar di sini
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const password = document.getElementById('password');
    const eyeIcon  = document.getElementById('eyeIcon');
    if (password.type === 'password') {
        password.type = 'text';
        eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        password.type = 'password';
        eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

@if(session('lockout_until'))
(function () {
    const lockoutUntil = new Date("{{ session('lockout_until') }}").getTime();
    const countdownEl  = document.getElementById('countdown');
    const lockoutBox   = document.getElementById('lockout-box');
    const submitBtn    = document.getElementById('submit-btn');

    // Nonaktifkan tombol saat terkunci
    submitBtn.disabled = true;

    const timer = setInterval(function () {
        const now  = new Date().getTime();
        const diff = lockoutUntil - now;

        if (diff <= 0) {
            clearInterval(timer);
            lockoutBox.innerHTML = `
                <div class="flex items-center justify-center gap-2">
                    <i class="fa-solid fa-circle-check text-green-500 text-xl"></i>
                    <p class="text-green-700 font-semibold">Silakan coba login kembali.</p>
                </div>`;
            submitBtn.disabled = false;
            return;
        }

        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
        countdownEl.textContent =
            String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
    }, 1000);
})();
@endif
</script>

{!! NoCaptcha::renderJs() !!}

</body>
</html>