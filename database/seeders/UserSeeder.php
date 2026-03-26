<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'Administrador Justo Paz',
            'email' => 'admin@justopaz.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);
    }
}