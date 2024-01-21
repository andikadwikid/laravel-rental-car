<?php

namespace Database\Seeders;

use App\Models\Merk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Toyota',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Honda',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Suzuki',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Mitsubishi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Nissan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        Merk::insert($data);
    }
}
