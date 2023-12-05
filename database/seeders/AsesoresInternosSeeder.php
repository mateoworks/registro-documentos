<?php

namespace Database\Seeders;

use App\Models\AsesorInterno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsesoresInternosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AsesorInterno::factory()->count(10)->create();
    }
}
