<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyewas', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELASI KOS
            |--------------------------------------------------------------------------
            */

            $table->foreignId('kos_id')
                  ->constrained('kos')
                  ->onDelete('cascade');

            /*
            |--------------------------------------------------------------------------
            | DATA PENYEWA
            |--------------------------------------------------------------------------
            */

            $table->string('nama');

            $table->string('no_hp');

            $table->string('email')->nullable();

            $table->string('foto')->nullable();

            /*
            |--------------------------------------------------------------------------
            | DATA KAMAR
            |--------------------------------------------------------------------------
            */

            $table->string('nomor_kamar');

            /*
            |--------------------------------------------------------------------------
            | PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            $table->bigInteger('harga_bulanan');

            $table->enum('status_pembayaran', [

                'Lunas',

                'Menunggu',

                'Menunggak'

            ])->default('Menunggu');

            /*
            |--------------------------------------------------------------------------
            | TANGGAL
            |--------------------------------------------------------------------------
            */

            $table->date('tanggal_masuk');

            $table->date('jatuh_tempo');

            /*
            |--------------------------------------------------------------------------
            | STATUS HUNI
            |--------------------------------------------------------------------------
            */

            $table->enum('status_huni', [

                'Aktif',

                'Keluar'

            ])->default('Aktif');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyewas');
    }
};