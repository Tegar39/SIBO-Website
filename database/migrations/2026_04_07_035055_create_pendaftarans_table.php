<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id('id_daftar');
            $table->foreignId('id_anggota')->constrained('anggotas', 'id_anggota')->onDelete('cascade');
            $table->foreignId('id_kegiatan')->constrained('kegiatans', 'id_kegiatan')->onDelete('cascade');
            $table->dateTime('tgl_daftar');
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'batal'])->default('pending');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->unique(['id_anggota', 'id_kegiatan']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftarans');
    }
};