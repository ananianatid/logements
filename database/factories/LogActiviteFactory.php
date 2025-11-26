<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogActivite>
 */
class LogActiviteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'utilisateur_id' => Utilisateur::factory(),
            'action' => fake()->word(),
            'table_concernee' => fake()->word(),
            'enregistrement_id' => fake()->randomNumber(),
            'details' => fake()->sentence(),
            'ip_address' => fake()->ipv4(),
        ];
    }
}
