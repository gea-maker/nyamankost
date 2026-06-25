<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [

        'penyewa_id',
        'bulan',
        'tahun',
        'jumlah',
        'bukti_bayar',
        'status'

    ];

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class);
    }
}