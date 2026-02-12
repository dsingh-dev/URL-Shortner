<?php

use App\Enums\UserRole;
use App\Models\Company;
use App\Models\ShortUrl;
use App\Models\SuperAdmin;
use App\Models\User;

beforeEach(function(){
    $this->company = Company::factory()->create();
    $this->admin = User::factory()->create([
        'company_id' => $this->company->id
    ]);

    $this->admin->assignRole(UserRole::ADMIN->value);
});

test('can Admin and member create shorturls', function () {
    $this->actingAs($this->admin);
    
    $response = $this->post(route('shorturls.store'), [
        'long_url' => 'https://google.com',
    ]);

    $response->assertRedirect(route('dashboard'));
});

test('superadmin cannot create shorturls', function() {
    $superadmin = SuperAdmin::factory()->create();
    
    $this->actingAs($superadmin, SUPER);
    
    $response = $this->post(route('shorturls.store'), [
        'long_url' => 'https://google.com',
    ]);

    $this->assertFalse($superadmin->can('edit-short-url'));

    $response->assertRedirect(route('login'));
});

test('Admin can see all shorturls' , function () {
    $admin = User::factory()->create([
        'company_id' => $this->company->id
    ]); 

    $this->actingAs($this->admin);
    
    $shorturl = ShortUrl::factory()->create([
        'user_id' => $admin->id,
        'company_id' => $this->company->id
    ]);


    $response = $this->get(route('dashboard'));

    $response->assertSee($shorturl->short_code);
    $response->assertSee($shorturl->long_url);
});

test('Memebers can only see their shorturls', function () {
    $member = User::factory()->create([
        'company_id' => $this->company->id
    ]); 
    $another_member = User::factory()->create([
        'company_id' => $this->company->id
    ]); 

    $member->assignRole(UserRole::MEMBER->value);
    $another_member->assignRole(UserRole::MEMBER->value);

    $this->actingAs($member);
    
    $shorturl = ShortUrl::factory()->create([
        'user_id' => $member->id,
        'company_id' => $this->company->id
    ]);

    $response = $this->get(route('dashboard'));

    $response->assertSee($shorturl->short_code);
    $response->assertSee($shorturl->long_url);

    $this->actingAs($another_member);
    
    $response_another_member = $this->get(route('dashboard'));
    $response_another_member->assertDontSee($shorturl->short_code);
    $response_another_member->assertDontSee($shorturl->long_url);
});

test('short urls are publicly resolve', function(){
    $this->actingAs($this->admin);
    $shorturl = ShortUrl::factory()->create();

    $response = $this->get(route('find.shortcode', $shorturl->short_code));

    $response->assertRedirect($shorturl->long_url);
});