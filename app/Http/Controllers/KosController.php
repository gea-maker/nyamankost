<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\KosFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KosController extends Controller
{
    // =====================================
    // FORM TAMBAH KOS
    // =====================================

    public function create()
    {
        return view('pemilik.kos.create');
    }

    // =====================================
    // SIMPAN DATA KOS
    // =====================================

    public function store(Request $request)
    {
        $request->validate([

            'nama_kos'        => 'required|string|max:255',

            'jenis_kos'       => 'required',

            'harga_per_bulan' => 'required|numeric',

            'sisa_kamar'      => 'required|integer',

            'alamat'          => 'required',

            'status_kos'      => 'required',

            'deskripsi'       => 'nullable',

            'no_hp'           => 'nullable',

            'instagram'       => 'nullable',

            'lokasi_maps'     => 'nullable',

            'fasilitas'       => 'nullable|array',

            'foto'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'fotos.*'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        /*
        |--------------------------------------------------------------------------
        | FASILITAS
        |--------------------------------------------------------------------------
        */

        $fasilitas = null;

        if ($request->has('fasilitas')) {

            $fasilitas = implode(', ', $request->fasilitas);
        }

        /*
        |--------------------------------------------------------------------------
        | FOTO UTAMA
        |--------------------------------------------------------------------------
        */

        $namaFoto = null;

        if ($request->hasFile('foto')) {

            $foto = $request->file('foto');

            $namaFoto = time() . '_' . $foto->getClientOriginalName();

            $foto->move(public_path('uploads/kos'), $namaFoto);
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA KOS
        |--------------------------------------------------------------------------
        */

        $kos = new Kos();

        $kos->id_pemilik = Auth::id();

        $kos->nama_kos = $request->nama_kos;

        $kos->foto = $namaFoto;

        $kos->alamat = $request->alamat;

        $kos->harga_per_bulan = $request->harga_per_bulan;

        $kos->sisa_kamar = $request->sisa_kamar;

        $kos->jenis_kos = $request->jenis_kos;

        $kos->fasilitas = $fasilitas;

        $kos->status_kos = $request->status_kos;

        $kos->deskripsi = $request->deskripsi;

        $kos->no_hp = $request->no_hp;

        $kos->instagram = $request->instagram;

        $kos->lokasi_maps = $request->lokasi_maps;

        $kos->save();

        /*
        |--------------------------------------------------------------------------
        | MULTI FOTO GALERI
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('fotos')) {

            foreach ($request->file('fotos') as $file) {

                $namaMultiFoto = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/kos'), $namaMultiFoto);

                KosFoto::create([

                    'kos_id' => $kos->id,

                    'foto' => $namaMultiFoto,

                ]);
            }
        }

        return redirect()
            ->route('pemilik.dashboard')
            ->with('success', 'Kos berhasil ditambahkan');
    }

    // =====================================
    // DETAIL KOS
    // =====================================

    public function show($id)
    {
        $kos = Kos::findOrFail($id);

        return view('pemilik.kos.show', compact('kos'));
    }

    // =====================================
    // FORM EDIT
    // =====================================

    public function edit($id)
    {
        $kos = Kos::findOrFail($id);

        return view('pemilik.kos.edit', compact('kos'));
    }

    // =====================================
    // UPDATE DATA KOS
    // =====================================

    public function update(Request $request, $id)
    {
        $request->validate([

            'nama_kos'        => 'required|string|max:255',

            'jenis_kos'       => 'required',

            'harga_per_bulan' => 'required|numeric',

            'sisa_kamar'      => 'required|integer',

            'alamat'          => 'required',

            'status_kos'      => 'required',

            'deskripsi'       => 'nullable',

            'no_hp'           => 'nullable',

            'instagram'       => 'nullable',

            'lokasi_maps'     => 'nullable',

            'fasilitas'       => 'nullable|array',

            'foto'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'fotos.*'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $kos = Kos::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | FASILITAS
        |--------------------------------------------------------------------------
        */

        $fasilitas = null;

        if ($request->has('fasilitas')) {

            $fasilitas = implode(', ', $request->fasilitas);
        }

        /*
        |--------------------------------------------------------------------------
        | FOTO UTAMA
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            if ($kos->foto && file_exists(public_path('uploads/kos/' . $kos->foto))) {

                unlink(public_path('uploads/kos/' . $kos->foto));
            }

            $foto = $request->file('foto');

            $namaFoto = time() . '_' . $foto->getClientOriginalName();

            $foto->move(public_path('uploads/kos'), $namaFoto);

            $kos->foto = $namaFoto;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */

        $kos->nama_kos = $request->nama_kos;

        $kos->alamat = $request->alamat;

        $kos->harga_per_bulan = $request->harga_per_bulan;

        $kos->sisa_kamar = $request->sisa_kamar;

        $kos->jenis_kos = $request->jenis_kos;

        $kos->fasilitas = $fasilitas;

        $kos->status_kos = $request->status_kos;

        $kos->deskripsi = $request->deskripsi;

        $kos->no_hp = $request->no_hp;

        $kos->instagram = $request->instagram;

        $kos->lokasi_maps = $request->lokasi_maps;

        $kos->save();

        /*
        |--------------------------------------------------------------------------
        | MULTI FOTO GALERI
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('fotos')) {

            foreach ($request->file('fotos') as $file) {

                $namaMultiFoto = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/kos'), $namaMultiFoto);

                KosFoto::create([

                    'kos_id' => $kos->id,

                    'foto' => $namaMultiFoto,

                ]);
            }
        }

        return redirect()
            ->route('pemilik.dashboard')
            ->with('success', 'Data kos berhasil diupdate');
    }

    // =====================================
    // HAPUS KOS
    // =====================================

    public function destroy($id)
    {
        $kos = Kos::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | HAPUS FOTO UTAMA
        |--------------------------------------------------------------------------
        */

        if ($kos->foto && file_exists(public_path('uploads/kos/' . $kos->foto))) {

            unlink(public_path('uploads/kos/' . $kos->foto));
        }

        /*
        |--------------------------------------------------------------------------
        | HAPUS GALERI FOTO
        |--------------------------------------------------------------------------
        */

        foreach ($kos->fotos as $foto) {

            if (file_exists(public_path('uploads/kos/' . $foto->foto))) {

                unlink(public_path('uploads/kos/' . $foto->foto));
            }

            $foto->delete();
        }

        /*
        |--------------------------------------------------------------------------
        | HAPUS DATA KOS
        |--------------------------------------------------------------------------
        */

        $kos->delete();

        return redirect()
            ->route('pemilik.dashboard')
            ->with('success', 'Data kos berhasil dihapus');
    }
    // =====================================
// KELOLA KOS
// =====================================

public function kelolaKos(Request $request)
{
    $query = Kos::where('id_pemilik', Auth::id());

    // SEARCH
    if ($request->search) {

        $query->where('nama_kos', 'like', '%' . $request->search . '%');
    }

    // FILTER STATUS
    if ($request->status_kos) {

        $query->where('status_kos', $request->status_kos);
    }

    $dataKos = $query->latest()->get();

    return view('pemilik.kos.kelola', compact('dataKos'));
}
}