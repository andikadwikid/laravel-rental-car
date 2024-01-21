<?php

namespace Database\Seeders;

use App\Models\ModelMobil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModelMobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Hybrid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sedan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'SUV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pickup',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'MPV',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        ModelMobil::insert($data);
    }
}
