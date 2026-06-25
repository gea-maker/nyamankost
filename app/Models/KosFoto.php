<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KosFoto extends Model
{
    protected $table = 'kos_fotos';

    protected $fillable = [

        'kos_id',

        'foto',

    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI KE KOS
    |--------------------------------------------------------------------------
    */

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
}