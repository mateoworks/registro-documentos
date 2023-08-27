<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);
        Permission::create(['name' => 'restaurar usuarios']);
        Permission::create(['name' => 'forzar eliminacion usuarios']);

        Permission::create(['name' => 'ver departamentos']);
        Permission::create(['name' => 'crear departamentos']);
        Permission::create(['name' => 'editar departamentos']);
        Permission::create(['name' => 'eliminar departamentos']);
        Permission::create(['name' => 'restaurar departamentos']);
        Permission::create(['name' => 'forzar eliminacion departamentos']);

        Permission::create(['name' => 'ver carreras']);
        Permission::create(['name' => 'crear carreras']);
        Permission::create(['name' => 'editar carreras']);
        Permission::create(['name' => 'eliminar carreras']);
        Permission::create(['name' => 'restaurar carreras']);
        Permission::create(['name' => 'forzar eliminacion carreras']);

        Permission::create(['name' => 'ver documentos']);
        Permission::create(['name' => 'crear documentos']);
        Permission::create(['name' => 'editar documentos']);
        Permission::create(['name' => 'eliminar documentos']);
        Permission::create(['name' => 'restaurar documentos']);
        Permission::create(['name' => 'forzar eliminacion documentos']);

        Permission::create(['name' => 'ver empresas']);
        Permission::create(['name' => 'crear empresas']);
        Permission::create(['name' => 'editar empresas']);
        Permission::create(['name' => 'eliminar empresas']);
        Permission::create(['name' => 'restaurar empresas']);
        Permission::create(['name' => 'forzar eliminacion empresas']);

        Permission::create(['name' => 'ver entregas']);
        Permission::create(['name' => 'crear entregas']);
        Permission::create(['name' => 'editar entregas']);
        Permission::create(['name' => 'eliminar entregas']);
        Permission::create(['name' => 'restaurar entregas']);
        Permission::create(['name' => 'forzar eliminacion entregas']);

        Permission::create(['name' => 'ver estudiantes']);
        Permission::create(['name' => 'crear estudiantes']);
        Permission::create(['name' => 'editar estudiantes']);
        Permission::create(['name' => 'eliminar estudiantes']);
        Permission::create(['name' => 'restaurar estudiantes']);
        Permission::create(['name' => 'forzar eliminacion estudiantes']);

        Permission::create(['name' => 'ver periodos']);
        Permission::create(['name' => 'crear periodos']);
        Permission::create(['name' => 'editar periodos']);
        Permission::create(['name' => 'eliminar periodos']);
        Permission::create(['name' => 'restaurar periodos']);
        Permission::create(['name' => 'forzar eliminacion periodos']);

        Permission::create(['name' => 'ver proyectos']);
        Permission::create(['name' => 'crear proyectos']);
        Permission::create(['name' => 'editar proyectos']);
        Permission::create(['name' => 'eliminar proyectos']);
        Permission::create(['name' => 'restaurar proyectos']);
        Permission::create(['name' => 'forzar eliminacion proyectos']);
    }
}
