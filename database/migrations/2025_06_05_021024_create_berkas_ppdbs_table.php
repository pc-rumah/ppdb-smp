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
        Schema::create('asset_bukti_pendaftaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tahun_ajar')->nullable();
            $table->string('logo_pondok_kiri')->nullable();
            $table->string('logo_pondok_kanan')->nullable();
            $table->string('tanda_tangan')->nullable();
            $table->string('nama_kontak_1')->nullable();
            $table->string('nomor_kontak_1')->nullable();
            $table->string('nama_kontak_2')->nullable();
            $table->string('nomor_kontak_2')->nullable();
            $table->string('ketua_panitia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_ppdb');
    }
};
