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
                'kode' => 'M001',
                'nama' => 'Toyota',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'M002',
                'nama' => 'Honda',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'M003',
                'nama' => 'Suzuki',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'M004',
                'nama' => 'Mitsubishi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'M005',
                'nama' => 'Nissan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        Merk::insert($data);
    }
}
