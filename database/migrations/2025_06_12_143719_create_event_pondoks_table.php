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
        Schema::create('event_pondok', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('lokasi');
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->string('waktu_selesai')->nullable();
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_pondok');
    }
};
