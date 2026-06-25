<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penyewa;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('penyewa')
            ->latest()
            ->get();

        return view(
            'pemilik.pembayaran.index',
            compact('pembayarans')
        );
    }

    public function terima($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->status = 'Diterima';

        $pembayaran->save();

        $penyewa = $pembayaran->penyewa;

        $penyewa->status_pembayaran = 'Lunas';

        $penyewa->save();

        return back()->with(
            'success',
            'Pembayaran berhasil diterima'
        );
    }

    public function tolak($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->status = 'Ditolak';

        $pembayaran->save();

        return back()->with(
            'success',
            'Pembayaran ditolak'
        );
    }
}