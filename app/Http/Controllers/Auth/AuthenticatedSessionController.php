<?php

// app/Http/Controllers/Auth/AuthenticatedSessionController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    const MAX_ATTEMPTS = 3;
    const LOCKOUT_MINS = 3;

    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $ip    = $request->ip();
        $email = $request->email;

        // Ambil atau buat record attempt
        $attempt = LoginAttempt::firstOrCreate(
            ['email' => $email, 'ip_address' => $ip],
            ['attempts' => 0]
        );

        // [1] Cek apakah sedang terkunci
        if ($attempt->isLocked()) {
            $seconds = $attempt->secondsRemaining();
            throw ValidationException::withMessages([
                'email' => "Akun terkunci. Coba lagi dalam {$seconds} detik.",
            ])->status(429);
        }

        // [2] Coba login
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {

            $attempt->increment('attempts');

            // [3] Jika sudah >= MAX_ATTEMPTS, kunci akun
            if ($attempt->fresh()->attempts >= self::MAX_ATTEMPTS) {
                $lockedUntil = now()->addMinutes(self::LOCKOUT_MINS);

                $attempt->update([
                    'locked_until' => $lockedUntil,
                    'attempts'     => 0,
                ]);

                // Simpan ke session untuk countdown di view
                session(['lockout_until' => $lockedUntil->toIso8601String()]);

                throw ValidationException::withMessages([
                    'email' => 'Terlalu banyak percobaan. Akun dikunci selama ' . self::LOCKOUT_MINS . ' menit.',
                ])->status(429);
            }

            // [4] Belum terkunci, tampilkan sisa percobaan
            $sisa = self::MAX_ATTEMPTS - $attempt->fresh()->attempts;

            throw ValidationException::withMessages([
                'email' => "Email atau password salah. Sisa percobaan: {$sisa}x.",
            ]);
        }

        // [5] Login berhasil — reset semua
        $attempt->update(['attempts' => 0, 'locked_until' => null]);
        session()->forget('lockout_until');

        $request->session()->regenerate();

        return redirect()->intended('dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}