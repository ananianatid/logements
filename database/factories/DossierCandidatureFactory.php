<?php

namespace Database\Factories;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DossierCandidature>
 */
class DossierCandidatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'etudiant_id' => Etudiant::factory(),
            'annee_universitaire' => fake()->year() . '-' . (fake()->year() + 1),
            'date_soumission' => fake()->dateTime(),
            'statut' => fake()->randomElement(['En cours', 'Validé', 'Rejeté', 'En attente paiement', 'Attribué']),
            'score_selection' => fake()->randomFloat(2, 0, 20),
            'commentaire_admin' => fake()->sentence(),
        ];
    }
}
