<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    protected $table = 'kos';

    protected $fillable = [

        'id_pemilik',

        'nama_kos',

        'foto',

        'alamat',

        'harga_per_bulan',

        'sisa_kamar',

        'jenis_kos',

        'fasilitas',

        'status_kos',

        'deskripsi',

        'no_hp',

        'instagram',

        'lokasi_maps',

    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI FOTO GALERI
    |--------------------------------------------------------------------------
    */

    public function fotos()
    {
        return $this->hasMany(KosFoto::class);
    }
    /*
|--------------------------------------------------------------------------
| RELASI PENYEWA
|--------------------------------------------------------------------------
*/

    public function penyewas()
    {
        return $this->hasMany(Penyewa::class);
    }

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'id_pemilik');
    }
}