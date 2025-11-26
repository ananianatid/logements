<?php

namespace Database\Factories;

use App\Models\AttributionLogement;
use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paiement>
 */
class PaiementFactory extends Factory
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
            'attribution_id' => AttributionLogement::factory(),
            'type_paiement' => fake()->randomElement(['Caution', 'Loyer', 'Pénalité', 'Réparation']),
            'montant' => fake()->randomFloat(2, 5000, 100000),
            'methode_paiement' => fake()->randomElement(['Flooz', 'Mixx', 'Xpress', 'Virement bancaire', 'Espèces']),
            'reference_transaction' => fake()->unique()->uuid(),
            'statut_paiement' => fake()->randomElement(['En attente', 'Validé', 'Échoué', 'Remboursé']),
            'date_paiement' => fake()->dateTime(),
            'mois_concerne' => fake()->monthName(),
            'recu_path' => fake()->filePath(),
        ];
    }
}
