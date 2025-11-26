<?php

namespace Database\Factories;

use App\Models\Appartement;
use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncidentMaintenance>
 */
class IncidentMaintenanceFactory extends Factory
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
            'etudiant_id' => Etudiant::factory(),
            'type_incident' => fake()->word(),
            'description' => fake()->sentence(),
            'priorite' => fake()->randomElement(['Faible', 'Moyenne', 'Haute', 'Urgente']),
            'statut' => fake()->randomElement(['Signalé', 'En cours', 'Résolu', 'Clôturé']),
            'date_signalement' => fake()->dateTime(),
            'date_resolution' => fake()->dateTime(),
            'technicien_assigne' => fake()->name(),
            'cout_reparation' => fake()->randomFloat(2, 1000, 50000),
        ];
    }
}
