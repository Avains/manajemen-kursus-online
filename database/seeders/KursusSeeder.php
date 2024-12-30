<?php

// database/seeders/KursusSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kursus;


class KursusSeeder extends Seeder
{
    public function run()
    {
        Kursus::factory(100)->create();
    }
}