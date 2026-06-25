<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Support\Facades\Auth;

class PemilikController extends Controller
{
    public function dashboard()
    {
        // Ambil semua kos milik user login
        $myKos = Kos::where('id_pemilik', Auth::id())->get();

        // Total properti
        $totalKos = $myKos->count();

        // Hitung kamar terisi
        $kamarTerisi = $myKos->sum(function ($item) {
            return 20 - $item->sisa_kamar;
        });

        // Hitung estimasi omzet
        $omzet = $myKos->sum(function ($item) {
            return (20 - $item->sisa_kamar) * $item->harga_per_bulan;
        });

        // Kirim semua data ke dashboard
        return view('pemilik.dashboard', [
            'myKos' => $myKos,
            'totalKos' => $totalKos,
            'kamarTerisi' => $kamarTerisi,
            'omzet' => $omzet
        ]);
    }
}