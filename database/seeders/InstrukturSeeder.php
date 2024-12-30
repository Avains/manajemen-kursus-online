<?php

// database/seeders/InstrukturSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instruktur;

class InstrukturSeeder extends Seeder
{
    public function run()
    {
        Instruktur::factory(50)->create();
    }
}