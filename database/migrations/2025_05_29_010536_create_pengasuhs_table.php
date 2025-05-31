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
        Schema::create('pengasuh', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan')->nullable(); // Contoh: Pengasuh Utama
            $table->string('foto')->nullable(); // Path ke file foto
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengasuh');
    }
};
