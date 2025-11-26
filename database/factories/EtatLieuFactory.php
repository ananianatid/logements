<?php

namespace Database\Factories;

use App\Models\AttributionLogement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EtatLieu>
 */
class EtatLieuFactory extends Factory
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
            'type_etat' => fake()->randomElement(['Entrée', 'Sortie']),
            'date_etat' => fake()->date(),
            'observation_generale' => fake()->sentence(),
            'agent_responsable' => fake()->name(),
            'signature_etudiant_path' => fake()->filePath(),
            'signature_agent_path' => fake()->filePath(),
        ];
    }
}
