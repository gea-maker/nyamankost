<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - NyamanKost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-700 via-yellow-600 to-indigo-900 px-4 py-10">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8 sm:p-10 border border-gray-100/50">

        <div class="text-center mb-8">
            <div class="w-20 h-20 rounded-full bg-indigo-50 flex items-center justify-center mx-auto mb-4 text-indigo-600 shadow-inner">
                <i class="fa-solid fa-key text-4xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Lupa Password?</h2>
            <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                Jangan khawatir. Masukkan alamat email Anda di bawah ini, dan kami akan mengirimkan link untuk mengatur ulang password Anda.
            </p>
        </div>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-red-100 border border-red-300 p-4">
                <ul class="list-disc list-inside text-red-600 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- SUCCESS STATUS --}}
        @if(session('status'))
            <div class="mb-6 rounded-xl bg-green-100 border border-green-300 p-4 text-green-700 text-sm font-medium">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="Masukkan Email Anda"
                        class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 transition duration-200">
                </div>
            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="mt-8">
                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold shadow-lg transition duration-200 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-paper-plane text-sm"></i>
                    Kirim Link Reset
                </button>
            </div>

            {{-- BACK TO LOGIN --}}
            <div class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 inline-flex items-center justify-center gap-2 transition duration-200">
                    <i class="fa-solid fa-arrow-left text-sm"></i>
                    Kembali ke Login
                </a>
            </div>
        </form>

    </div>

</div>

</body>
</html>
