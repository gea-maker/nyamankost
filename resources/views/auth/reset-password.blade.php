<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - NyamanKost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-700 via-yellow-600 to-indigo-900 px-4 py-10">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8 sm:p-10 border border-gray-100/50">

        <div class="text-center mb-8">
            <div class="w-20 h-20 rounded-full bg-indigo-50 flex items-center justify-center mx-auto mb-4 text-indigo-600 shadow-inner">
                <i class="fa-solid fa-shield-halved text-4xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Reset Password</h2>
            <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                Silakan masukkan email Anda dan atur password baru untuk memulihkan akun Anda.
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

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                        value="{{ old('email', $request->email) }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Masukkan Email Anda"
                        class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 transition duration-200">
                </div>
            </div>

            {{-- PASSWORD --}}
            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Masukkan Password Baru"
                        class="w-full pl-11 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 transition duration-200">
                    <button type="button" onclick="togglePassword('password', 'eyeIconPassword')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none">
                        <i id="eyeIconPassword" class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <i class="fa-solid fa-key"></i>
                    </span>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Konfirmasi Password Baru"
                        class="w-full pl-11 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 transition duration-200">
                    <button type="button" onclick="togglePassword('password_confirmation', 'eyeIconConfirm')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none">
                        <i id="eyeIconConfirm" class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="mt-8">
                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold shadow-lg transition duration-200 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-circle-check text-sm"></i>
                    Simpan Password Baru
                </button>
            </div>
        </form>

    </div>

</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

</body>
</html>
