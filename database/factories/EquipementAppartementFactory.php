<?php

namespace Database\Factories;

use App\Models\Appartement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipementAppartement>
 */
class EquipementAppartementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'appartement_id' => Appartement::factory(),
            'nom_equipement' => fake()->word(),
            'quantite' => fake()->numberBetween(1, 5),
            'etat' => fake()->randomElement(['Neuf', 'Bon', 'Usé', 'Défectueux']),
        ];
    }
}
