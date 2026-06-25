<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kos', function (Blueprint $table) {

            $table->text('deskripsi')->nullable();

            $table->string('no_hp')->nullable();

            $table->string('instagram')->nullable();

            $table->text('lokasi_maps')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('kos', function (Blueprint $table) {

            $table->dropColumn([
                'deskripsi',
                'no_hp',
                'instagram',
                'lokasi_maps'
            ]);

        });
    }
};