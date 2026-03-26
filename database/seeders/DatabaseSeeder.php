<?php

namespace Database\Seeders;

use App\Models\Aliado;
use App\Models\Conciliacion;
use App\Services\AliadoNivelService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);
    }
}