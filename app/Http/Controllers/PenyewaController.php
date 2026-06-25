<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Penyewa;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PENYEWA
    |--------------------------------------------------------------------------
    */

    public function index()
{
    $dataPenyewa = Penyewa::with('kos')
        ->latest()
        ->get();

    $totalPenyewa = Penyewa::count();

    $kamarTerisi = Penyewa::where('status_huni', 'Aktif')
        ->count();

    $jatuhTempo = Penyewa::whereDate(
        'jatuh_tempo',
        now()->toDateString()
    )->count();

    $totalPembayaran = Penyewa::where(
        'status_pembayaran',
        'Lunas'
    )->sum('harga_bulanan');

    return view('pemilik.penyewa.index', compact(

        'dataPenyewa',

        'totalPenyewa',

        'kamarTerisi',

        'jatuhTempo',

        'totalPembayaran'

    ));
}
    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH PENYEWA
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $dataKos = Kos::all();

        return view('pemilik.penyewa.create', compact('dataKos'));
    }
    public function show($id)
    {
        $penyewa = Penyewa::with('kos')->findOrFail($id);

        return view('pemilik.penyewa.show', compact('penyewa'));
    }
    /*
|--------------------------------------------------------------------------
| FORM EDIT
|--------------------------------------------------------------------------
*/

public function edit($id)
{
    $penyewa = Penyewa::findOrFail($id);

    $dataKos = Kos::all();

    return view('pemilik.penyewa.edit', compact(

        'penyewa',

        'dataKos'

    ));
}

/*
|--------------------------------------------------------------------------
| UPDATE
|--------------------------------------------------------------------------
*/

public function update(Request $request, $id)
{
    $request->validate([

        'kos_id' => 'required',

        'nama' => 'required',

        'no_hp' => 'required',

        'nomor_kamar' => 'required',

        'harga_bulanan' => 'required',

        'status_pembayaran' => 'required',

        'tanggal_masuk' => 'required',

        'jatuh_tempo' => 'required',

    ]);

    $penyewa = Penyewa::findOrFail($id);

    $penyewa->update([

        'kos_id' => $request->kos_id,

        'nama' => $request->nama,

        'no_hp' => $request->no_hp,

        'email' => $request->email,

        'nomor_kamar' => $request->nomor_kamar,

        'harga_bulanan' => $request->harga_bulanan,

        'status_pembayaran' => $request->status_pembayaran,

        'tanggal_masuk' => $request->tanggal_masuk,

        'jatuh_tempo' => $request->jatuh_tempo,

    ]);

    return redirect()
        ->route('pemilik.penyewa')
        ->with('success', 'Data penyewa berhasil diupdate');
}

/*
|--------------------------------------------------------------------------
| HAPUS
|--------------------------------------------------------------------------
*/

    public function destroy($id)
    {
        $penyewa = Penyewa::findOrFail($id);

        $penyewa->delete();

        return redirect()
            ->route('pemilik.penyewa')
            ->with('success', 'Penyewa berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENYEWA
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'kos_id' => 'required',

            'nama' => 'required',

            'no_hp' => 'required',

            'email' => 'nullable|email',

            'nomor_kamar' => 'required',

            'harga_bulanan' => 'required|numeric',

            'status_pembayaran' => 'required',

            'tanggal_masuk' => 'required|date',

            'jatuh_tempo' => 'required|date',

        ]);

        Penyewa::create([

            'kos_id' => $request->kos_id,

            'nama' => $request->nama,

            'no_hp' => $request->no_hp,

            'email' => $request->email,

            'nomor_kamar' => $request->nomor_kamar,

            'harga_bulanan' => $request->harga_bulanan,

            'status_pembayaran' => $request->status_pembayaran,

            'tanggal_masuk' => $request->tanggal_masuk,

            'jatuh_tempo' => $request->jatuh_tempo,

            'status_huni' => 'Aktif',

        ]);

        return redirect()
            ->route('pemilik.penyewa')
            ->with('success', 'Penyewa berhasil ditambahkan');
    }
}