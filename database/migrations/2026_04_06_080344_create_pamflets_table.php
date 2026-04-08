<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pamflets', function (Blueprint $table) {
            $table->id('id_pamflet');
            $table->foreignId('id_kegiatan')->constrained('kegiatans', 'id_kegiatan')->onDelete('cascade');
            $table->string('nama_file');
            $table->string('path_file');
            $table->datetime('tgl_upload')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pamflets');
    }
};