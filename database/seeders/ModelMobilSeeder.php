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
                'kode' => 'M001',
                'nama' => 'Hybrid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'M002',
                'nama' => 'Sedan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'M003',
                'nama' => 'SUV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'M004',
                'nama' => 'Pickup',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'M005',
                'nama' => 'MPV',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        ModelMobil::insert($data);
    }
}
