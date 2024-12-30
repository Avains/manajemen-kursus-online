<?php

// database/seeders/PendaftaranKursusSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PendaftaranKursus;

class PendaftaranKursusSeeder extends Seeder
{
    public function run()
    {
        PendaftaranKursus::factory(200)->create();
    }
}