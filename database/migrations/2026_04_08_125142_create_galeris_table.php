<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('galeris', function (Blueprint $table) {
            $table->id('id_foto');
            $table->foreignId('id_kegiatan')->constrained('kegiatans', 'id_kegiatan')->onDelete('cascade');
            $table->string('judul_foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('path_file');
            $table->dateTime('tgl_upload')->nullable();
            $table->boolean('is_unggulan')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('galeris');
    }
};