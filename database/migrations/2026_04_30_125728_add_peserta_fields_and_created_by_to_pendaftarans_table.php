// database/migrations/2025_xx_xx_add_peserta_fields_to_pendaftarans_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            // 1. id_anggota nullable
            $table->unsignedBigInteger('id_anggota')->nullable()->change();

            // 2. Kolom data peserta non-anggota
            $table->string('nama_peserta')->nullable()->after('id_anggota');
            $table->string('kontak_peserta')->nullable()->after('nama_peserta');

            // 3. created_by (foreign ke users)
            $table->unsignedBigInteger('created_by')->nullable()->after('keterangan');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');

            // 4. Hapus unique constraint
            $table->dropUnique(['id_anggota', 'id_kegiatan']);

            // 5. Index
            $table->index(['id_kegiatan', 'status']);
        });
    }

    public function down()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->unique(['id_anggota', 'id_kegiatan']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['nama_peserta', 'kontak_peserta', 'created_by']);
            $table->unsignedBigInteger('id_anggota')->nullable(false)->change();
        });
    }
};