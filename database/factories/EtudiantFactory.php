<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->lastName(),
            'prenoms' => fake()->firstName(),
            'email' => fake()->unique()->safeEmail(),
            'telephone' => fake()->phoneNumber(),
            'sexe' => fake()->randomElement(['Masculin', 'Féminin']),
            'situation_familiale' => fake()->randomElement(['Célibataire', 'Marié(e)', 'Avec enfants']),
            'date_obtention_baccalaureat' => fake()->date(),
            'matricule' => fake()->unique()->bothify('ETU-####'),
            'handicap' => fake()->optional()->word(),
            'photo_profil' => null,
        ];
    }
}
