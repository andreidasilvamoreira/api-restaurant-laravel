<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Cliente 1',
                'email' => 'cliente1@email.com',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Atendente 1',
                'email' => 'atendente1@email.com',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => Hash::make('123456'),
            ],
        ]);
    }
}
