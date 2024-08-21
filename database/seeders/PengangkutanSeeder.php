<?php

namespace Database\Seeders;

use App\Models\Pengangkutan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengangkutanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengangkutan::factory()->count(3)->forUser([
            'name' => 'user1'
        ])->create();
    }
}
