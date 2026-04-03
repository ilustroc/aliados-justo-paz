<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@justopaz.com'],
            [
                'name' => 'Administrador Justo Paz',
                'password' => Hash::make('admin123'),
                'role' => 'administrador',
                'email_verified_at' => now(),
            ]
        );
    }
}