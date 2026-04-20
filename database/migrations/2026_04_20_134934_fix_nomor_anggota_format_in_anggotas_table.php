<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Ubah tipe kolom menjadi string(5)
        Schema::table('anggotas', function (Blueprint $table) {
            $table->string('nomor_anggota', 5)->nullable(false)->change();
        });

        // Update nomor anggota menjadi format 5 digit berurutan
        $anggotaList = Anggota::orderBy('id_anggota')->get();
        $counter = 1;
        foreach ($anggotaList as $anggota) {
            $newNumber = str_pad($counter, 5, '0', STR_PAD_LEFT);
            $anggota->nomor_anggota = $newNumber;
            $anggota->save();
            $counter++;
        }

        // Hapus unique constraint jika ada (agar bisa ditambahkan ulang)
        try {
            Schema::table('anggotas', function (Blueprint $table) {
                $table->dropUnique('anggotas_nomor_anggota_unique');
            });
        } catch (\Exception $e) {
            // Jika index tidak ada, abaikan
        }

        // Tambahkan unique constraint
        Schema::table('anggotas', function (Blueprint $table) {
            $table->unique('nomor_anggota');
        });
    }

    public function down()
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->dropUnique(['nomor_anggota']);
            $table->string('nomor_anggota')->change();
        });
    }
};