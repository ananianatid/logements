<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BatimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Batiment::create([
            'nom' => 'Batiment A',
            'type_batiment' => 'Résidence',
            'capacite_totale' => 100,
            'adresse' => '123 Rue Principale',
            'description' => 'Un bâtiment résidentiel moderne.',
        ]);

        \App\Models\Batiment::create([
            'nom' => 'Batiment B',
            'type_batiment' => 'Cité universitaire',
            'capacite_totale' => 250,
            'adresse' => '456 Avenue de la Liberté',
            'description' => 'Une cité universitaire spacieuse.',
        ]);
    }
}
