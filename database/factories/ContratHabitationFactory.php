<?php

namespace Database\Factories;

use App\Models\AttributionLogement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContratHabitation>
 */
class ContratHabitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attribution_id' => AttributionLogement::factory(),
            'numero_contrat' => fake()->unique()->bothify('CTR-####'),
            'fichier_contrat_path' => fake()->filePath(),
            'date_signature' => fake()->date(),
            'caution_montant' => fake()->randomFloat(2, 50000, 200000),
            'caution_payee' => fake()->boolean(),
            'reglement_signe' => fake()->boolean(),
        ];
    }
}
