<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Batiment>
 */
class BatimentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->unique()->words(2, true),
            'type_batiment' => fake()->randomElement(['Résidence', 'Cité universitaire', 'Bloc']),
            'capacite_totale' => fake()->numberBetween(10, 100),
            'disponibilite' => fake()->numberBetween(0, 10),
            'adresse' => fake()->address(),
            'description' => fake()->sentence(),
        ];
    }
}
