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
        Schema::create('covers', function (Blueprint $table) {
            $table->bigIncrements('id');
            // Cover Madrasah
            $table->string('logo_madrasah')->nullable();
            $table->string('judul_madrasah')->nullable();
            $table->text('deskripsi_madrasah')->nullable();
            $table->string('cover_madrasah')->nullable();

            // Cover SMP
            $table->string('logo_smp')->nullable();
            $table->string('judul_smp')->nullable();
            $table->text('deskripsi_smp')->nullable();
            $table->string('cover_smp')->nullable();

            // Cover Pondok
            $table->string('logo_pondok')->nullable();
            $table->string('judul_pondok')->nullable();
            $table->text('deskripsi_pondok')->nullable();
            $table->string('cover_pondok')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('covers');
    }
};
