<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penyewa;
use App\Models\Pembayaran;

class UserDashboardController extends Controller
{
    public function index()
    {
        $penyewa = Penyewa::where('user_id', Auth::id())->first();

        return view('user.dashboard', compact('penyewa'));
    }

    public function cariKos(Request $request)
    {
        $penyewa = Penyewa::where('user_id', Auth::id())->first();

        $query = \App\Models\Kos::query();

        if ($request->search) {
            $query->where('nama_kos', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%');
        }
        if ($request->jenis_kos) {
            $query->where('jenis_kos', $request->jenis_kos);
        }

        $rekomendasiKos = $query->latest()->get();

        return view('user.cari-kos', compact('penyewa', 'rekomendasiKos'));
    }

    public function tagihan()
    {
        $penyewa = Penyewa::where('user_id', Auth::id())->first();
        if(!$penyewa) return redirect()->route('user.dashboard')->with('error', 'Anda belum menjadi penyewa aktif.');

        return view('user.tagihan', compact('penyewa'));
    }

    public function uploadPembayaran()
    {
        $penyewa = Penyewa::where('user_id', Auth::id())->first();
        if(!$penyewa) return redirect()->route('user.dashboard')->with('error', 'Anda belum menjadi penyewa aktif.');

        return view('user.upload-pembayaran', compact('penyewa'));
    }

    public function simpanPembayaran(Request $request)
    {
        $request->validate([
            'bukti_bayar' => 'required|image'
        ]);

        $penyewa = Penyewa::where('user_id', Auth::id())->first();
        if(!$penyewa) return redirect()->route('user.dashboard')->with('error', 'Anda belum menjadi penyewa aktif.');

        $file = $request->file('bukti_bayar');
        $namaFile = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/pembayaran'), $namaFile);

        Pembayaran::create([
            'penyewa_id' => $penyewa->id,
            'bulan' => now()->translatedFormat('F'),
            'tahun' => now()->year,
            'jumlah' => $penyewa->harga_bulanan,
            'bukti_bayar' => $namaFile,
            'status' => 'Menunggu'
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diupload dan menunggu verifikasi.');
    }

    public function riwayatPembayaran()
    {
        $penyewa = Penyewa::where('user_id', Auth::id())->first();
        
        $riwayat = [];
        if($penyewa) {
            $riwayat = Pembayaran::where('penyewa_id', $penyewa->id)->latest()->get();
        }

        return view('user.riwayat-pembayaran', compact('riwayat', 'penyewa'));
    }
}