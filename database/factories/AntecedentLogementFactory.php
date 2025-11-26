<?php

namespace Database\Factories;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AntecedentLogement>
 */
class AntecedentLogementFactory extends Factory
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
            'regularite_paiements' => fake()->randomElement(['Excellent', 'Bon', 'Moyen', 'Mauvais']),
            'troubles_colocation' => fake()->boolean(),
            'description_troubles' => fake()->sentence(),
        ];
    }
}
