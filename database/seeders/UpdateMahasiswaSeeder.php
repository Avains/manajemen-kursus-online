<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateMahasiswaSeeder extends Seeder
{
    public function run()
    {
        $universitas = [];
        for ($i = 1; $i <= 20; $i++) {
            $universitas[] = "Universitas $i";
        }

        $nimCounter = 100001;

        $mahasiswa = DB::table('mahasiswa')->get();

        foreach ($mahasiswa as $mhs) {
            DB::table('mahasiswa')
                ->where('id', $mhs->id)
                ->update([
                    'nim' => $nimCounter++,
                    'nama_universitas' => $universitas[array_rand($universitas)]
                ]);
        }
    }
}
