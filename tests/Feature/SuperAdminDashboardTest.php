<?php

use App\Models\SuperAdmin;

test('dashboard page is displayed for super admin', function () {
    $admin = SuperAdmin::factory()->create();

    $response = $this->actingAs($admin, SUPER)
        ->get(route(SUPER . '.dashboard'));

    $response->assertOk();
    $response->assertViewIs(SUPER . '.dashboard');
});