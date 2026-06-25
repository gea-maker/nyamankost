<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::table('kos', function (Blueprint $table) {
        $table->string('foto')->nullable()->after('nama_kos');
        $table->integer('sisa_kamar')->default(0)->after('harga_per_bulan');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kos', function (Blueprint $table) {
            //
        });
    }
};
