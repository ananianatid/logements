<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can access their profile via api', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user, 'sanctum')
        ->getJson('/api/user');

    $response->assertOk()
        ->assertJson([
            'id' => $user->id,
            'email' => $user->email,
        ]);
});
