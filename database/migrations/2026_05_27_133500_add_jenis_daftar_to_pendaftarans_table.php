<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            if (! Schema::hasColumn('pendaftarans', 'jenis_daftar')) {
                $table->enum('jenis_daftar', ['self', 'other', 'admin'])
                    ->default('self')
                    ->after('kontak_peserta');
            }
        });

        // Data lama yang dibuat admin biasanya tidak punya id_anggota.
        // Data anggota lama dianggap sebagai pendaftaran diri sendiri agar riwayat tetap aman.
        DB::table('pendaftarans')
            ->whereNull('id_anggota')
            ->update(['jenis_daftar' => 'admin']);
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftarans', 'jenis_daftar')) {
                $table->dropColumn('jenis_daftar');
            }
        });
    }
};
