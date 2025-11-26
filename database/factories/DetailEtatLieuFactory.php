<?php

namespace Database\Factories;

use App\Models\EtatLieu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailEtatLieu>
 */
class DetailEtatLieuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'etat_lieu_id' => EtatLieu::factory(),
            'element' => fake()->word(),
            'etat' => fake()->randomElement(['Neuf', 'Bon', 'Moyen', 'Dégradé', 'Détérioré']),
            'observations' => fake()->sentence(),
            'photo_path' => fake()->filePath(),
        ];
    }
}
