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
            ProyectoSeeder::class,
            PermissionSeeder::class,
        ]);
        $user = User::factory()->create(['email' => 'email@email.com']);
        $permissions = Permission::all();
        $rolAdmin = Role::create(['name' => 'admin']);

        $rolAdmin->syncPermissions($permissions);
        $user->assignRole($rolAdmin);

        $rolEstudiante = Role::create(['name' => 'estudiante']);
        $estudiante = User::factory()->create(['email' => 'estudiante@email.com']);
        $estudiante->assignRole($rolEstudiante);

        $rolCapturista = Role::create(['name' => 'capturista']);
        $capturista = User::factory()->create(['email' => 'capturista@email.com']);
        $capturista->assignRole($rolCapturista);
    }
}
