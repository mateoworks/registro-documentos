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
        $rol = Role::create(['name' => 'admin']);
        $rol->syncPermissions($permissions);
        $user->assignRole($rol);
    }
}
