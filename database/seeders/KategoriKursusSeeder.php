<?php

// database/seeders/KategoriKursusSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriKursus;


KategoriKursus::create([
    'nama_kategori' => 'sint',
    'deskripsi' => 'Provident corporis eaque exercitationem voluptas.',
]);

class KategoriKursusSeeder extends Seeder
{
    public function run()
    {
        KategoriKursus::factory(10)->create();
    }
}