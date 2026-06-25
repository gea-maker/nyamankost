<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_login_attempts_table.php
public function up(): void
{
    Schema::create('login_attempts', function (Blueprint $table) {
        $table->id();
        $table->string('email');
        $table->string('ip_address', 45);
        $table->integer('attempts')->default(0);
        $table->timestamp('locked_until')->nullable();
        $table->timestamps();

        $table->index(['email', 'ip_address']);
    });
}

public function down(): void
{
    Schema::dropIfExists('login_attempts');
}
};
