<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

test('Invite user page is display', function() {
    $admin = User::factory()->create();

    $response = $this->actingAs($admin)->get(route('invite-user.create'));

    $response->assertOk();
});

test('Create new Admin/Member', function () {
    $company = Company::factory()->create();
    $admin = User::factory()->create([
        'company_id' => $company->id
    ]);

    $request = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'role' => UserRole::ADMIN->value
    ];
    
    $response = $this->actingAs($admin)
                ->post(route('invite-user.store'), $request);

    $response->assertRedirect(route('dashboard'));

    $this->assertDatabaseHas('users', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'company_id' => $company->id,
    ]);

    $user = User::where('email', 'test@example.com')->first();
    $this->assertTrue($user->hasRole(UserRole::ADMIN->value));
});