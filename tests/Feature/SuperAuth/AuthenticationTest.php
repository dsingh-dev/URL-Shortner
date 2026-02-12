<?php

use App\Models\SuperAdmin;
use App\Models\User;

test('Super login screen can be rendered', function () {
    $response = $this->get(route(SUPER . '.login'));

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $admin = SuperAdmin::factory()->create();

    $response = $this->post(route(SUPER . '.login'), [
        'email' => $admin->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated(SUPER);
    $response->assertRedirect(route(SUPER . '.dashboard', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $user = SuperAdmin::factory()->create();

    $this->post(SUPER . '.login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest(SUPER);
});

test('users can logout', function () {
    $user = SuperAdmin::factory()->create();

    $response = $this->actingAs($user, SUPER)->post(route(SUPER . '.logout'));

    $this->assertGuest(SUPER);
    $response->assertRedirect(route(SUPER . '.login'));
});
