<?php

use App\Models\User;

test('dashboard page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('dashboard'));

    $response->assertOk();
    $response->assertViewIs('dashboard');
});