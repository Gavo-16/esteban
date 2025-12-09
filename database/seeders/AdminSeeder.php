<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Usuario Prueba 1',
            'email' => 'user1@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        User::create([
            'name' => 'Usuario Prueba 2',
            'email' => 'user2@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        User::create([
            'name' => 'Admin Prueba',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);
    }
}
