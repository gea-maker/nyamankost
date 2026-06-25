<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - NyamanKost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-10">

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Verifikasi Email</h2>
            <p class="text-gray-500 mt-2">Masukkan 6 digit kode yang dikirim ke email Anda</p>
        </div>

        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm text-center">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-xl bg-red-100 border border-red-300 p-4">
                <ul class="list-disc list-inside text-red-600 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('otp.verify.submit') }}">
            @csrf
            <input
                type="text"
                name="otp_code"
                maxlength="6"
                required
                autofocus
                placeholder="123456"
                class="w-full text-center text-2xl tracking-widest px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500">

            <button type="submit" class="w-full mt-4 bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transition">
                Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('otp.resend') }}" class="text-center mt-4">
            @csrf
            <button type="submit" class="text-indigo-600 text-sm hover:underline">
                Kirim ulang kode OTP
            </button>
        </form>

    </div>
</div>

</body>
</html>