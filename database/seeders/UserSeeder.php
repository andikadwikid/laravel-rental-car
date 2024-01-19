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
                'password' => bcrypt('admin'),
                'role' => 'admin'
            ],
            [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('user'),
                'role' => 'user'
            ],
            [
                'name' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('user'),
                'role' => 'user'
            ],
            [
                'name' => 'user3',
                'email' => 'user3@gmail.com',
                'password' => bcrypt('user'),
                'role' => 'user'
            ],
        ];
        User::insert($data);
    }
}
