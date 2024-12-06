<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan model User diimpor
use Illuminate\Support\Facades\Hash; // Impor Hash

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password123'), 
            'role' => 'admin', 
        ]);
    }
} 