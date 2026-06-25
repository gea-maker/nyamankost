<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kos;
use App\Models\Penyewa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    // ================================================
    // USER MANAGEMENT
    // ================================================

    // Menampilkan semua user
    public function indexUsers() {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // Form Tambah User
    public function createUsers() {
        return view('admin.users.create');
    }

    // Simpan User Baru
    public function storeUsers(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // PERBAIKAN: Menambahkan ',email' agar validasi bekerja lebih spesifik
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required'],
            'no_hp' => ['required'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    // Form Edit User
    public function editUsers(User $user) {
        return view('admin.users.edit', compact('user'));
    }

    // Update User
    public function updateUsers(Request $request, User $user) {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required'],
            'no_hp' => ['required'],
        ];

        if ($request->role === 'pemilik') {
            $rules['status_verifikasi'] = ['required', 'in:menunggu,disetujui,ditolak'];
        }

        $request->validate($rules);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'no_hp' => $request->no_hp,
        ];

        if ($request->role === 'pemilik') {
            $updateData['status_verifikasi'] = $request->status_verifikasi;
        } else {
            $updateData['status_verifikasi'] = 'disetujui';
        }

        $user->update($updateData);

        if($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    // Hapus User
    public function destroyUsers(User $user) {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }

    // Setujui Akun Pemilik
    public function approveUser(User $user) {
        if ($user->role === 'pemilik') {
            $user->update(['status_verifikasi' => 'disetujui']);
            return redirect()->route('admin.users.index')->with('success', "Akun pemilik {$user->name} berhasil disetujui!");
        }
        return redirect()->route('admin.users.index')->with('error', 'User ini bukan pemilik.');
    }

    // Tolak Akun Pemilik
    public function rejectUser(User $user) {
        if ($user->role === 'pemilik') {
            $user->update(['status_verifikasi' => 'ditolak']);
            return redirect()->route('admin.users.index')->with('success', "Akun pemilik {$user->name} berhasil ditolak.");
        }
        return redirect()->route('admin.users.index')->with('error', 'User ini bukan pemilik.');
    }

    // ================================================
    // KELOLA KOS (ADMIN)
    // ================================================

    public function indexKos(Request $request) {
        $query = Kos::with('pemilik');

        // Search
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_kos', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%');
            });
        }

        // Filter status
        if ($request->status_kos) {
            $query->where('status_kos', $request->status_kos);
        }

        // Filter jenis
        if ($request->jenis_kos) {
            $query->where('jenis_kos', $request->jenis_kos);
        }

        $dataKos = $query->latest()->get();
        $totalKos = Kos::count();
        $kosAktif = Kos::where('status_kos', 'aktif')->count();
        $kosPenuh = Kos::where('sisa_kamar', 0)->count();

        return view('admin.kos.index', compact('dataKos', 'totalKos', 'kosAktif', 'kosPenuh'));
    }

    public function showKos($id) {
        $kos = Kos::with(['pemilik', 'fotos', 'penyewas'])->findOrFail($id);
        return view('admin.kos.show', compact('kos'));
    }

    public function destroyKos($id) {
        $kos = Kos::findOrFail($id);

        // Hapus foto utama
        if ($kos->foto && file_exists(public_path('uploads/kos/' . $kos->foto))) {
            unlink(public_path('uploads/kos/' . $kos->foto));
        }

        // Hapus galeri foto
        foreach ($kos->fotos as $foto) {
            if (file_exists(public_path('uploads/kos/' . $foto->foto))) {
                unlink(public_path('uploads/kos/' . $foto->foto));
            }
            $foto->delete();
        }

        $kos->delete();
        return redirect()->route('admin.kos.index')->with('success', 'Data kos berhasil dihapus!');
    }

    // ================================================
    // TRANSAKSI (ADMIN)
    // ================================================

    public function indexTransaksi(Request $request) {
        $query = Pembayaran::with(['penyewa', 'penyewa.kos']);

        // Search
        if ($request->search) {
            $query->whereHas('penyewa', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter bulan
        if ($request->bulan) {
            $query->where('bulan', $request->bulan);
        }

        // Filter tahun
        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        $pembayarans = $query->latest()->get();
        $totalTransaksi = Pembayaran::count();
        $totalDiterima = Pembayaran::where('status', 'Diterima')->count();
        $totalMenunggu = Pembayaran::where('status', 'Menunggu')->count();
        $totalDitolak = Pembayaran::where('status', 'Ditolak')->count();
        $totalPendapatan = Pembayaran::where('status', 'Diterima')->sum('jumlah');

        return view('admin.transaksi.index', compact(
            'pembayarans', 'totalTransaksi', 'totalDiterima',
            'totalMenunggu', 'totalDitolak', 'totalPendapatan'
        ));
    }

    public function terimaTransaksi($id) {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = 'Diterima';
        $pembayaran->save();

        $penyewa = $pembayaran->penyewa;
        if ($penyewa) {
            $penyewa->status_pembayaran = 'Lunas';
            $penyewa->save();
        }

        return back()->with('success', 'Pembayaran berhasil diterima.');
    }

    public function tolakTransaksi($id) {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = 'Ditolak';
        $pembayaran->save();

        return back()->with('success', 'Pembayaran ditolak.');
    }

    // ================================================
    // LAPORAN (ADMIN)
    // ================================================

    public function laporan(Request $request) {
        // Statistik Utama
        $totalUser = User::count();
        $totalPemilik = User::where('role', 'pemilik')->count();
        $totalPenyewa = User::where('role', 'penyewa')->count();
        $totalKos = Kos::count();
        $kosAktif = Kos::where('status_kos', 'aktif')->count();
        $totalKamarTersisa = Kos::sum('sisa_kamar');
        $totalPenyewaAktif = Penyewa::where('status_huni', 'Aktif')->count();

        // Pendapatan
        $totalPendapatan = Pembayaran::where('status', 'Diterima')->sum('jumlah');
        $pendapatanBulanIni = Pembayaran::where('status', 'Diterima')
            ->where('bulan', Carbon::now()->format('F'))
            ->where('tahun', Carbon::now()->year)
            ->sum('jumlah');

        // Pembayaran per status
        $pembayaranDiterima = Pembayaran::where('status', 'Diterima')->count();
        $pembayaranMenunggu = Pembayaran::where('status', 'Menunggu')->count();
        $pembayaranDitolak = Pembayaran::where('status', 'Ditolak')->count();

        // Kos terpopuler (berdasarkan jumlah penyewa)
        $kosTerpopuler = Kos::withCount('penyewas')
            ->orderByDesc('penyewas_count')
            ->take(5)
            ->get();

        // Pendapatan per bulan (6 bulan terakhir) untuk chart
        $pendapatanPerBulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $bulan = $date->format('F');
            $tahun = $date->year;

            $jumlah = Pembayaran::where('status', 'Diterima')
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->sum('jumlah');

            $pendapatanPerBulan[] = [
                'label' => $date->format('M Y'),
                'jumlah' => $jumlah,
            ];
        }

        // Penyewa yang jatuh tempo minggu ini
        $jatuhTempoMingguIni = Penyewa::where('status_huni', 'Aktif')
            ->whereBetween('jatuh_tempo', [Carbon::now(), Carbon::now()->addDays(7)])
            ->with('kos')
            ->get();

        // Penyewa menunggak
        $penyewaMenunggak = Penyewa::where('status_pembayaran', 'Menunggak')
            ->where('status_huni', 'Aktif')
            ->with('kos')
            ->get();

        return view('admin.laporan.index', compact(
            'totalUser', 'totalPemilik', 'totalPenyewa', 'totalKos', 'kosAktif',
            'totalKamarTersisa', 'totalPenyewaAktif', 'totalPendapatan',
            'pendapatanBulanIni', 'pembayaranDiterima', 'pembayaranMenunggu',
            'pembayaranDitolak', 'kosTerpopuler', 'pendapatanPerBulan',
            'jatuhTempoMingguIni', 'penyewaMenunggak'
        ));
    }
}