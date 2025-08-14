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
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->string('kk')->nullable()->change();
            $table->string('akte')->nullable()->change();
            $table->string('ktp')->nullable()->change();
            $table->string('rapot')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->boolean('kk')->default(false)->change();
            $table->boolean('akte')->default(false)->change();
            $table->boolean('ktp')->default(false)->change();
            $table->boolean('rapot')->default(false)->change();
        });
    }
};
