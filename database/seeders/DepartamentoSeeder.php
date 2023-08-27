<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departamento::factory()->create([
            'nombre' => 'Departamento de Ingenierías',
        ]);

        Departamento::factory()->create([
            'nombre' => 'Departamento de Ciencias Básicas',
        ]);

        Departamento::factory()->create([
            'nombre' => 'Departamento de Gestión Empresarial',
        ]);
    }
}
