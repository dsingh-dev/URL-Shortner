<?php

use App\Models\Company;
use App\Models\SuperAdmin;

test('Invite client page is display', function() {
    $admin = SuperAdmin::factory()->create();

    $response = $this->actingAs($admin, SUPER)->get(route(SUPER . '.invite-company.create'));

    $response->assertOk();
});

test('Create new company and user', function () {
    $admin = SuperAdmin::factory()->create();

    $request = [
        'name' => 'test',
        'email' => 'test@example.com'
    ];
    
    $response = $this->actingAs($admin, SUPER)
                ->post(route(SUPER . '.invite-company.store'), $request);

    $response->assertRedirect(route(SUPER . '.dashboard'));

    $this->assertDatabaseHas('companies', [
        'name' => 'test',
    ]);

    $this->assertDatabaseHas('users', [
        'name' => 'test',
        'email' => 'test@example.com'
    ]);
});