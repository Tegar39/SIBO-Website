<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_anggota');
            $table->string('judul');
            $table->text('pesan');
            $table->boolean('is_read')->default(false);
            $table->string('tipe')->default('alfa'); // alfa, reminder, dll
            $table->timestamps();

            $table->foreign('id_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifikasis');
    }
};