<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instruktur;

class InstrukturSeeder extends Seeder
{
    public function run()
    {
        $instruktur = \App\Models\Instruktur::all();
    
        foreach ($instruktur as $instr) {
            $instr->npm = rand(100000, 999999);
            $instr->save();
        }
    }
    
}