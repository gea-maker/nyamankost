<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('penyewa_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('bulan');

            $table->integer('tahun');

            $table->decimal('jumlah',12,0);

            $table->string('bukti_bayar')->nullable();

            $table->enum('status',[
                'Menunggu',
                'Diterima',
                'Ditolak'
            ])->default('Menunggu');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};