<?php

use App\Models\Appartement;
use App\Models\EquipementAppartement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    Sanctum::actingAs($this->user);
});

test('can list equipement appartements', function () {
    $equipement = EquipementAppartement::factory()->create();

    $response = $this->getJson('/api/equipement-appartement');

    $response->assertSuccessful()
        ->assertJsonFragment(['id' => $equipement->id]);
});

test('can create equipement appartement', function () {
    $appartement = Appartement::factory()->create();
    $data = [
        'appartement_id' => $appartement->id,
        'nom_equipement' => 'Test Equipment',
        'quantite' => 1,
        'etat' => 'Neuf',
    ];

    $response = $this->postJson('/api/equipement-appartement', $data);

    $response->assertCreated()
        ->assertJsonFragment($data);

    $this->assertDatabaseHas('equipements_appartement', $data);
});

test('can show equipement appartement', function () {
    $equipement = EquipementAppartement::factory()->create();

    $response = $this->getJson("/api/equipement-appartement/{$equipement->id}");

    $response->assertSuccessful()
        ->assertJsonFragment(['id' => $equipement->id]);
});

test('can update equipement appartement', function () {
    $equipement = EquipementAppartement::factory()->create();
    $data = [
        'nom_equipement' => 'Updated Equipment',
        'quantite' => 2,
        'etat' => 'Usé',
    ];

    $response = $this->putJson("/api/equipement-appartement/{$equipement->id}", $data);

    $response->assertSuccessful()
        ->assertJsonFragment($data);

    $this->assertDatabaseHas('equipements_appartement', $data);
});

test('can delete equipement appartement', function () {
    $equipement = EquipementAppartement::factory()->create();

    $response = $this->deleteJson("/api/equipement-appartement/{$equipement->id}");

    $response->assertNoContent();

    $this->assertDatabaseMissing('equipements_appartement', ['id' => $equipement->id]);
});
