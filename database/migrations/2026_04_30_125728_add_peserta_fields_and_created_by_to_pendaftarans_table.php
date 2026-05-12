<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {

            // Drop foreign key dulu
            $table->dropForeign(['id_anggota']);
            $table->dropForeign(['id_kegiatan']);

            // Hapus unique constraint
            $table->dropUnique(['id_anggota', 'id_kegiatan']);

            // Ubah id_anggota jadi nullable
            $table->unsignedBigInteger('id_anggota')->nullable()->change();

            // Kolom peserta non anggota
            $table->string('nama_peserta')->nullable()->after('id_anggota');
            $table->string('kontak_peserta')->nullable()->after('nama_peserta');

            // created_by
            $table->unsignedBigInteger('created_by')->nullable()->after('keterangan');
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            // Tambah index
            $table->index(['id_kegiatan', 'status']);

            // Buat ulang foreign key
            $table->foreign('id_anggota')
                  ->references('id_anggota')
                  ->on('anggotas')
                  ->onDelete('cascade');

            $table->foreign('id_kegiatan')
                  ->references('id_kegiatan')
                  ->on('kegiatans')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {

            $table->dropForeign(['created_by']);
            $table->dropForeign(['id_anggota']);
            $table->dropForeign(['id_kegiatan']);

            $table->dropColumn([
                'nama_peserta',
                'kontak_peserta',
                'created_by'
            ]);

            $table->unsignedBigInteger('id_anggota')
                  ->nullable(false)
                  ->change();

            $table->unique(['id_anggota', 'id_kegiatan']);

            // balikin FK lagi
            $table->foreign('id_anggota')
                ->references('id_anggota')
                ->on('anggotas')
                ->onDelete('cascade');

            $table->foreign('id_kegiatan')
                  ->references('id_kegiatan')
                  ->on('kegiatans')
                  ->onDelete('cascade');
        });
    }
};