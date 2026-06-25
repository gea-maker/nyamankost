<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', [App\Http\Controllers\PublicKosController::class, 'index'])->name('home');

Route::get('/kos/{id}', [App\Http\Controllers\PublicKosController::class, 'show'])->name('kos.detail');

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT (berdasarkan role)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'pemilik') {
        if ($user->status_verifikasi === 'menunggu') {
            return redirect()->route('verification.owner.waiting');
        } elseif ($user->status_verifikasi === 'ditolak') {
            return redirect()->route('verification.owner.rejected');
        }
        return redirect()->route('pemilik.dashboard');
    }

    return match ($user->role) {
        'penyewa' => redirect()->route('user.dashboard'),
        default => redirect()->route('user.dashboard'),
    };
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| WAITING & REJECTED VERIFICATION FOR PEMILIK
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/menunggu-verifikasi', function () {
        $user = auth()->user();
        if ($user->role !== 'pemilik' || $user->status_verifikasi !== 'menunggu') {
            return redirect()->route('dashboard');
        }
        return view('auth.waiting-verification');
    })->name('verification.owner.waiting');

    Route::get('/akun-ditolak', function () {
        $user = auth()->user();
        if ($user->role !== 'pemilik' || $user->status_verifikasi !== 'ditolak') {
            return redirect()->route('dashboard');
        }
        return view('auth.rejected-verification');
    })->name('verification.owner.rejected');
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN (perlu auth + verified)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/users', [AdminController::class, 'indexUsers'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'createUsers'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUsers'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUsers'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUsers'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUsers'])->name('admin.users.destroy');
    Route::put('/admin/users/{user}/approve', [AdminController::class, 'approveUser'])->name('admin.users.approve');
    Route::put('/admin/users/{user}/reject', [AdminController::class, 'rejectUser'])->name('admin.users.reject');

    // Admin Kelola Kos
    Route::get('/admin/kos', [AdminController::class, 'indexKos'])->name('admin.kos.index');
    Route::get('/admin/kos/{id}', [AdminController::class, 'showKos'])->name('admin.kos.show');
    Route::delete('/admin/kos/{id}', [AdminController::class, 'destroyKos'])->name('admin.kos.destroy');

    // Admin Transaksi
    Route::get('/admin/transaksi', [AdminController::class, 'indexTransaksi'])->name('admin.transaksi.index');
    Route::put('/admin/transaksi/{id}/terima', [AdminController::class, 'terimaTransaksi'])->name('admin.transaksi.terima');
    Route::put('/admin/transaksi/{id}/tolak', [AdminController::class, 'tolakTransaksi'])->name('admin.transaksi.tolak');

    // Admin Laporan
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
});

/*
|--------------------------------------------------------------------------
| PEMILIK KOS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'owner.verified'])->group(function () {
    Route::get('/dashboard-pemilik', [PemilikController::class, 'dashboard'])->name('pemilik.dashboard');

    Route::get('/dashboard-pemilik/kos/create', [KosController::class, 'create'])->name('pemilik.kos.create');
    Route::post('/dashboard-pemilik/kos', [KosController::class, 'store'])->name('pemilik.kos.store');
    Route::get('/dashboard-pemilik/kos/{id}/edit', [KosController::class, 'edit'])->name('pemilik.kos.edit');
    Route::put('/dashboard-pemilik/kos/{id}', [KosController::class, 'update'])->name('pemilik.kos.update');
    Route::get('/dashboard-pemilik/kos/{id}', [KosController::class, 'show'])->name('pemilik.kos.show');
    Route::delete('/dashboard-pemilik/kos/{id}', [KosController::class, 'destroy'])->name('pemilik.kos.destroy');

    Route::get('/dashboard-pemilik/kelola-kos', [KosController::class, 'kelolaKos'])->name('pemilik.kelola-kos');

    Route::get('/dashboard-pemilik/penyewa-aktif', [PenyewaController::class, 'index'])->name('pemilik.penyewa.index');
    Route::get('/dashboard-pemilik/penyewa/create', [PenyewaController::class, 'create'])->name('pemilik.penyewa.create');
    Route::post('/dashboard-pemilik/penyewa/store', [PenyewaController::class, 'store'])->name('pemilik.penyewa.store');
    Route::get('/dashboard-pemilik/penyewa/{id}', [PenyewaController::class, 'show'])->name('pemilik.penyewa.show');
    Route::get('/dashboard-pemilik/penyewa/{id}/edit', [PenyewaController::class, 'edit'])->name('pemilik.penyewa.edit');
    Route::put('/dashboard-pemilik/penyewa/{id}', [PenyewaController::class, 'update'])->name('pemilik.penyewa.update');
    Route::delete('/dashboard-pemilik/penyewa/{id}', [PenyewaController::class, 'destroy'])->name('pemilik.penyewa.destroy');

    Route::get('/dashboard-pemilik/pembayaran', [PembayaranController::class, 'index'])->name('pemilik.pembayaran');
    Route::put('/dashboard-pemilik/pembayaran/{id}/terima', [PembayaranController::class, 'terima'])->name('pemilik.pembayaran.terima');
    Route::put('/dashboard-pemilik/pembayaran/{id}/tolak', [PembayaranController::class, 'tolak'])->name('pemilik.pembayaran.tolak');
});

/*
|--------------------------------------------------------------------------
| PENYEWA / USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-user', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/dashboard-user/cari-kos', [UserDashboardController::class, 'cariKos'])->name('user.cari');
    Route::get('/tagihan-saya', [UserDashboardController::class, 'tagihan'])->name('user.tagihan');
    Route::get('/upload-pembayaran', [UserDashboardController::class, 'uploadPembayaran'])->name('user.upload');
    Route::post('/upload-pembayaran', [UserDashboardController::class, 'simpanPembayaran'])->name('user.upload.store');
    Route::get('/riwayat-pembayaran', [UserDashboardController::class, 'riwayatPembayaran'])->name('user.riwayat');
});

/*
|--------------------------------------------------------------------------
| LOGIN GOOGLE
|--------------------------------------------------------------------------
*/

Route::get('/login/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/login/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

/*
|--------------------------------------------------------------------------
| OTP VERIFIKASI EMAIL
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/verify-otp', [OtpController::class, 'show'])->name('otp.verify');
    Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp.verify.submit');
    Route::post('/resend-otp', [OtpController::class, 'resend'])->name('otp.resend');
});

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

require __DIR__.'/auth.php';