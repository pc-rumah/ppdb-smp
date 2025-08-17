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
            $table->bigIncrements('id');
            $table->string('no_pendaftaran')->unique();
            $table->string('jenis_pendaftaran');
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('foto');
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');

            // alamat
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('dusun');
            $table->string('rt');
            $table->string('rw');
            $table->string('desa_kelurahan');
            $table->string('kecamatan');
            $table->string('kabupaten_kota');
            $table->string('provinsi');

            $table->char('provinsi_id', 2)->nullable()->index()->after('provinsi');
            $table->char('kabupaten_id', 4)->nullable()->index()->after('provinsi_id');
            $table->char('kecamatan_id', 7)->nullable()->index()->after('kabupaten_id');
            $table->char('desa_id', 10)->nullable()->index()->after('kecamatan_id');

            // berkas
            $table->string('kk')->nullable();
            $table->string('akte')->nullable();
            $table->string('ktp')->nullable();
            $table->string('rapot')->nullable();

            // data
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
