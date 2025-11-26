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

        // Agent Role
        $agent = Role::firstOrCreate(['name' => 'agent']);
        $agent->givePermissionTo([
            // Etudiants: C, R, U
            'ajouter etudiant', 'lire etudiant', 'modifier etudiant',
            // Justificatifs: R, U
            'lire justificatif', 'modifier justificatif',
            // Antecedents Logement: C, R, U
            'ajouter antecedent_logement', 'lire antecedent_logement', 'modifier antecedent_logement',
            // Dossiers Candidature: R, U
            'lire dossier_candidature', 'modifier dossier_candidature',
            // Attributions Logement: C, R, U, D
            'ajouter attribution_logement', 'lire attribution_logement', 'modifier attribution_logement', 'supprimer attribution_logement',
            // Contrats Habitation: C, R, U
            'ajouter contrat_habitation', 'lire contrat_habitation', 'modifier contrat_habitation',
            // Etats Lieux: C, R, U, D
            'ajouter etat_lieu', 'lire etat_lieu', 'modifier etat_lieu', 'supprimer etat_lieu',
            // Details Etat Lieux: C, R, U, D
            'ajouter detail_etat_lieu', 'lire detail_etat_lieu', 'modifier detail_etat_lieu', 'supprimer detail_etat_lieu',
            // Batiments: R, U
            'lire batiment', 'modifier batiment',
            // Appartements: R, U
            'lire appartement', 'modifier appartement',
            // Equipements Appartement: R, U
            'lire equipement_appartement', 'modifier equipement_appartement',
            // Incidents Maintenance: R, U
            'lire incident_maintenance', 'modifier incident_maintenance',
            // Exclusions: C, R, U
            'ajouter exclusion', 'lire exclusion', 'modifier exclusion',
            // Logs Activite: R
            'lire log_activite',
        ]);

        // Technicien Role
        $technicien = Role::firstOrCreate(['name' => 'technicien']);
        $technicien->givePermissionTo([
            // Incidents Maintenance: R, U
            'lire incident_maintenance', 'modifier incident_maintenance',
            // Appartements: R
            'lire appartement',
            // Batiments: R
            'lire batiment',
        ]);

        // Comptable Role
        $comptable = Role::firstOrCreate(['name' => 'comptable']);
        $comptable->givePermissionTo([
            // Paiements: C, R, U
            'ajouter paiement', 'lire paiement', 'modifier paiement',
            // Etudiants: R
            'lire etudiant',
            // Attributions Logement: R
            'lire attribution_logement',
            // Contrats Habitation: R
            'lire contrat_habitation',
            // Incidents Maintenance: R
            'lire incident_maintenance',
        ]);
    }
}
