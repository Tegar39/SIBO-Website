<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id('id_absensi');
            $table->foreignId('id_daftar')->constrained('pendaftarans', 'id_daftar')->onDelete('cascade')->unique();
            $table->boolean('hadir')->default(false);
            $table->dateTime('waktu_hadir')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensis');
    }
};