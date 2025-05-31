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
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran')->unique();
            $table->enum('jenis_pendaftaran', ['online', 'offline']);
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);

            //alamat
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('dusun');
            $table->string('rt');
            $table->string('rw');
            $table->string('desa_kelurahan');
            $table->string('kecamatan');
            $table->string('kabupaten_kota');
            $table->string('provinsi');

            //berkas
            $table->boolean('kk')->default(false);
            $table->boolean('akte')->default(false);
            $table->boolean('ktp')->default(false);
            $table->boolean('rapot')->default(false);

            //data
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('no_wa');
            $table->string('email')->nullable();
            $table->string('asal_sekolah');
            $table->boolean('administrasi_lunas')->default(false);
            $table->string('bukti_pembayaran')->nullable();
            $table->string('bukti_pendaftaran')->nullable();
            $table->text('piagam_penghargaan')->nullable();
            $table->foreignId('saudaras_id')->constrained();
            $table->string('penanggung_jawab');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftars');
    }
};
