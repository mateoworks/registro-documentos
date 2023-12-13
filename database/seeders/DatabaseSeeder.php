<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            DocumentoSeeder::class,
            DepartamentoSeeder::class,
            CarreraSeeder::class,
            PeriodoSeeder::class,
            EmpresaSeeder::class,
            EstudianteSeeder::class,
            PermissionSeeder::class,
            ProyectoSeeder::class,
            AsesoresInternosSeeder::class,
            AreaSeeder::class,
            ResidenciaSeeder::class,
        ]);
        $user = User::factory()->create(['email' => 'email@email.com']);
        $permissions = Permission::all();
        $rolAdmin = Role::create(['name' => 'admin']);

        $rolAdmin->syncPermissions($permissions);
        $user->assignRole($rolAdmin);

        $rolEstudiante = Role::create(['name' => 'estudiante']);
        $estudiante = User::factory()->create(['email' => 'estudiante@email.com']);
        $estudiante->assignRole($rolEstudiante);

        $permissionCapturista = [
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
            'ver departamentos',
            'crear departamentos',
            'editar departamentos',
            'eliminar departamentos',
            'ver carreras',
            'crear carreras',
            'editar carreras',
            'eliminar carreras',
            'ver documentos',
            'crear documentos',
            'editar documentos',
            'eliminar documentos',
            'ver empresas',
            'crear empresas',
            'editar empresas',
            'eliminar empresas',
            'ver entregas',
            'crear entregas',
            'editar entregas',
            'eliminar entregas',
            'ver estudiantes',
            'crear estudiantes',
            'editar estudiantes',
            'eliminar estudiantes',
            'ver periodos',
            'crear periodos',
            'editar periodos',
            'eliminar periodos',
            'ver proyectos',
            'crear proyectos',
            'editar proyectos',
            'eliminar proyectos',
            'ver entregas',
            'crear entregas',
            'editar entregas',
            'eliminar entregas',
        ];
        $rolCapturista = Role::create(['name' => 'capturista']);
        $rolCapturista->syncPermissions($permissionCapturista);
        $capturista = User::factory()->create(['email' => 'capturista@email.com']);
        $capturista->assignRole($rolCapturista);
    }
}
