<?php

namespace Database\Factories;

use App\Models\AttributionLogement;
use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exclusion>
 */
class ExclusionFactory extends Factory
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
            'motif' => fake()->word(),
            'description_motif' => fake()->sentence(),
            'date_decision' => fake()->date(),
            'statut_exclusion' => fake()->randomElement(['En cours', 'Effective', 'Annulée']),
            'date_effective' => fake()->date(),
            'agent_responsable' => fake()->name(),
        ];
    }
}
