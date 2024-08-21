<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengangkutan>
 */
class PengangkutanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pengangkut' => fake()->name(),
            'jarak' => rand(50,80),
            'transportasi_id' => rand(1,5),
            'lokasi_awal' => rand(1,5),
            'lokasi_tujuan' => rand(1,5),
            'harga' => 350,
            'liter' => fake()->randomDigit(),
        ];
    }
}
