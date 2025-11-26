<?php

namespace Database\Factories;

use App\Models\Appartement;
use App\Models\DossierCandidature;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttributionLogement>
 */
class AttributionLogementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dossier_candidature_id' => DossierCandidature::factory(),
            'appartement_id' => Appartement::factory(),
            'date_attribution' => fake()->date(),
            'date_debut_contrat' => fake()->date(),
            'date_fin_contrat' => fake()->date(),
            'statut_attribution' => fake()->randomElement(['Actif', 'Terminé', 'Résilié']),
        ];
    }
}
