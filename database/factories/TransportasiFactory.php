<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transportasi>
 */
class TransportasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'merk' => fake()->randomElement(['Toyota','Suzuki','Honda']),
            'plat' => 'AD '.fake()->randomDigit().' BC',
            'muatan' => '1600lt',
            'pemilik' => fake()->name(),
            'thn' => '2007',
            'warna' => 'Merah',
        ];
    }
}
