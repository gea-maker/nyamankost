<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;

class PublicKosController extends Controller
{
    // =====================================
    // HOME
    // =====================================

    public function index(Request $request)
    {
        $query = Kos::query();

        // SEARCH
        if ($request->search) {

            $query->where('nama_kos', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%');
        }

        // FILTER JENIS
        if ($request->jenis_kos) {

            $query->where('jenis_kos', $request->jenis_kos);
        }

        // FILTER STATUS
        if ($request->status_kos) {

            $query->where('status_kos', $request->status_kos);
        }

        $allKos = $query->latest()->get();

        return view('welcome', [
        'rekomendasiKos' => $allKos
        ]);
    }

    // =====================================
    // DETAIL
    // =====================================

    public function show($id)
    {
        $kos = Kos::findOrFail($id);

        return view('public.detail', compact('kos'));
    }
}