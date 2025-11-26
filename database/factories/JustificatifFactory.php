<?php

namespace Database\Factories;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Justificatif>
 */
class JustificatifFactory extends Factory
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
            'type_justificatif' => fake()->word(),
            'fichier_path' => fake()->filePath(),
            'date_depot' => fake()->dateTime(),
            'statut' => fake()->randomElement(['En attente', 'Validé', 'Rejeté']),
        ];
    }
}
