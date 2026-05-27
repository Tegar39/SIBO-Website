<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        Kategori::firstOrCreate(
            ['nama' => 'pelatihan'],
            ['deskripsi' => 'Kategori kegiatan pelatihan anggota.']
        );

        Kategori::firstOrCreate(
            ['nama' => 'rutinan'],
            ['deskripsi' => 'Kategori kegiatan rutin organisasi.']
        );

        Kategori::firstOrCreate(
            ['nama' => 'penampilan / kontes'],
            ['deskripsi' => 'Kategori kegiatan penampilan, lomba, atau kontes.']
        );
    }
}