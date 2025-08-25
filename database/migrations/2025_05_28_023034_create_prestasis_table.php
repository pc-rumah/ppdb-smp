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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('foto')->nullable();
            $table->string('juara');
            $table->string('title');
            $table->string('subjudul');

            $table->enum('status', ['pending', 'pending-delete', 'approved', 'rejected'])->default('pending');
            $table->json('previous_data')->nullable();
            $table->string('new_gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
