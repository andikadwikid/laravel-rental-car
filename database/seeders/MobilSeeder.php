<?php

namespace Database\Seeders;

use App\Models\Merk;
use App\Models\Mobil;
use App\Models\ModelMobil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'merk' => Merk::all()->random()->id,
                'model' => ModelMobil::all()->random()->id,
                // 'merk' => 'Toyota',
                // 'model' => 'Hybrid',
                'no_plat' => 'B 1234 AB',
                'tarif' => 250000
            ],
            [
                'merk' => Merk::all()->random()->id,
                'model' => ModelMobil::all()->random()->id,
                // 'merk' => 'Nissan',
                // 'model' => 'Sedan',
                'no_plat' => 'B 1234 AC',
                'tarif' => 300000
            ],
            [
                'merk' => Merk::all()->random()->id,
                'model' => ModelMobil::all()->random()->id,
                // 'merk' => 'Mitsubishi',
                // 'model' => 'SUV',
                'no_plat' => 'B 1234 AD',
                'tarif' => 220000
            ],
            [
                'merk' => Merk::all()->random()->id,
                'model' => ModelMobil::all()->random()->id,
                // 'merk' => 'Suzuki',
                // 'model' => 'Pickup',
                'no_plat' => 'B 1234 AE',
                'tarif' => 280000
            ],
        ];
        Mobil::insert($data);
    }
}
