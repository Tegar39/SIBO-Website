<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        Kategori::firstOrCreate(['nama' => 'KDB'], ['deskripsi' => 'Kader Desa Bersama (Budaya)']);
        Kategori::firstOrCreate(['nama' => 'KNB'], ['deskripsi' => 'Kader Nuansa Baru (Olahraga)']);
    }
}