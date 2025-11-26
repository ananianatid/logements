<?php

namespace Database\Factories;

use App\Models\Batiment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appartement>
 */
class AppartementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'batiment_id' => Batiment::factory(),
            'numero' => fake()->unique()->bothify('Apt-##'),
            'etage' => fake()->numberBetween(0, 5),
            'type_appartement' => fake()->randomElement(['Studio', 'T1', 'T2', 'Chambre partagée']),
            'capacite_personnes' => fake()->numberBetween(1, 4),
            'disponibilite' => fake()->boolean(),
            'etat' => fake()->randomElement(['Neuf', 'Bon', 'Moyen', 'Nécessite réparations', 'Hors service']),
            'superficie' => fake()->randomFloat(2, 15, 50),
            'loyer_mensuel' => fake()->randomFloat(2, 20000, 100000),
        ];
    }
}
