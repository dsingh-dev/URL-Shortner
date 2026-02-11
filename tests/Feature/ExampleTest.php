<?php

use App\Models\User;

it('returns a redirect response on unauthenticated user', function () {
    $response = $this->get('/');

    $response->assertStatus(302);
});

it('returns a successful response on authenticated user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/');

    $response->assertStatus(200);
});
