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
        Schema::create('tendik', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 40);
            $table->string('no_nik', 20)->unique();
            $table->string('no_gtk', 20)->unique();
            $table->string('no_nuptk', 20)->unique();
            $table->string('tempat_tanggal_lahir', 20);
            $table->dateTime('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Kristen', 'Buddha', 'Khonghucu', 'Hindu', 'Katolik']);
            $table->text('alamat');
            $table->enum('status_kepegawaian', ['Aktif', 'Tidak aktif']);
            $table->string('no_rekening', 20)->unique();
            $table->string('posisi_jabatan', 40);
            $table->string('email', 30)->unique();
            $table->enum('pendidikan_terakhir', ['Smp', 'Sma', 'S1', 'S2', 'S3']);
            $table->dateTime('tanggal_masuk');
            $table->dateTime('tanggal_keluar');
            $table->string('foto');
            $table->string('foto_ktp');
            $table->string('foto_surat_keterangan_mengajar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tendik');
    }
};
