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
            $table->id();
            $table->string('tahun_ajar');
            $table->string('logo_pondok_kiri');
            $table->string('logo_pondok_kanan');
            $table->string('tanda_tangan');
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
