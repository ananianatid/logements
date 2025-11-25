<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'lire etudiant','guard_name' => 'web']);
        Permission::create(['name' => 'ajouter etudiant', 'guard_name' => 'web']);
        Permission::create(['name' => 'modifier etudiant', 'guard_name' => 'web']);
        Permission::create(['name' => 'supprimer etudiant', 'guard_name' => 'web']);

        $admin = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());
    }
}
