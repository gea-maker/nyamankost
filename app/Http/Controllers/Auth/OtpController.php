<?php

// app/Http/Controllers/Auth/OtpController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpVerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function show()
    {
        if (! session('otp_user_id')) {
            return redirect()->route('register');
        }

        return view('auth.otp-verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp_code' => ['required', 'digits:6'],
        ]);

        $user = User::find(session('otp_user_id'));

        if (! $user) {
            return redirect()->route('register');
        }

        if ($user->otp_code !== $request->otp_code) {
            return back()->withErrors(['otp_code' => 'Kode OTP salah.']);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp_code' => 'Kode OTP sudah expired, silakan kirim ulang.']);
        }

        $user->forceFill([
            'email_verified_at' => now(),
            'otp_code' => null,
            'otp_expires_at' => null,
        ])->save();

        session()->forget('otp_user_id');

        Auth::login($user);

        return redirect()->route('dashboard')->with('status', 'Email berhasil diverifikasi!');
    }

    public function resend()
    {
        $user = User::find(session('otp_user_id'));

        if (! $user) {
            return redirect()->route('register');
        }

        $otp = (string) random_int(100000, 999999);

        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        Mail::to($user->email)->send(new OtpVerificationMail($otp, $user->name));

        return back()->with('status', 'Kode OTP baru telah dikirim.');
    }
}