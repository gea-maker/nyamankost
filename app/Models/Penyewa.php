<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    protected $fillable = [

        'user_id',
        'kos_id',
        'nama',
        'email',
        'no_hp',
        'nomor_kamar',
        'harga_bulanan',
        'status_pembayaran',
        'tanggal_masuk',
        'jatuh_tempo',
        'status_huni'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}