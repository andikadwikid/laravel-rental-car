<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'alamat' => 'jakarta',
                'no_telp' => '081234567890',
                'no_sim' => '1234567890',
                'password' => bcrypt('admin'),
                'role' => 'admin'
            ],
            [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'alamat' => 'bandung',
                'no_telp' => '081231241241',
                'no_sim' => '787654321',
                'password' => bcrypt('user'),
                'role' => 'user'
            ],
            [
                'name' => 'user2',
                'email' => 'user2@gmail.com',
                'alamat' => 'surabaya',
                'no_telp' => '081234341241',
                'no_sim' => '587234321',
                'password' => bcrypt('user'),
                'role' => 'user'
            ],
            [
                'name' => 'user3',
                'email' => 'user3@gmail.com',
                'alamat' => 'medan',
                'no_telp' => '081234341541',
                'no_sim' => '187238351',
                'password' => bcrypt('user'),
                'role' => 'user'
            ],
        ];
        User::insert($data);
    }
}
