<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $resources = [
            'user',
            'appartement',
            'batiment',
            'etudiant',
            'utilisateur',
            'antecedent_logement',
            'attribution_logement',
            'contrat_habitation',
            'dossier_candidature',
            'equipement_appartement',
            'justificatif',
            'detail_etat_lieu',
            'etat_lieu',
            'exclusion',
            'incident_maintenance',
            'log_activite',
            'paiement',
        ];

        $actions = ['lire', 'ajouter', 'modifier', 'supprimer'];

        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "{$action} {$resource}", 'guard_name' => 'web']);
            }
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $comptable = Role::firstOrCreate(['name' => 'comptable']);
        $comptable->givePermissionTo([
            'lire paiement',
            'ajouter paiement',
            'modifier paiement',
            'supprimer paiement',
            'lire contrat_habitation',
            'lire etudiant',
            'lire appartement',
            'lire batiment',
        ]);
    }
}
