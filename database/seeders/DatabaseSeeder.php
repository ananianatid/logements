<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'role'=>'agent'
        ]);

        $this->call([
            RolePermissionSeeder::class,
            EtudiantSeeder::class,
            BatimentSeeder::class,
            UtilisateurSeeder::class,
            AppartementSeeder::class,
            DossierCandidatureSeeder::class,
            AttributionLogementSeeder::class,
            AntecedentLogementSeeder::class,
            ContratHabitationSeeder::class,
            EquipementAppartementSeeder::class,
            JustificatifSeeder::class,
            EtatLieuSeeder::class,
            DetailEtatLieuSeeder::class,
            ExclusionSeeder::class,
            IncidentMaintenanceSeeder::class,
            LogActiviteSeeder::class,
            PaiementSeeder::class,
        ]);
    }
}
