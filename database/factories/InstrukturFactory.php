<?php

namespace Database\Factories;

use App\Models\Instruktur;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstrukturFactory extends Factory
{
    protected $model = Instruktur::class;

    public function definition()
    {
        return [
            'nama_instruktur' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'telepon' => $this->faker->phoneNumber,
            'alamat' => $this->faker->address,
        ];
    }
}