<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // web Permissions and roles
        $webPermissions = collect([
            'edit-short-url',
            'invite-user',
        ])->map(fn ($name) =>
            Permission::firstOrCreate([
                'name' => $name,
                'guard_name' => 'web'
            ])
        );

        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $admin->syncPermissions([
            'edit-short-url',
            'invite-user',
        ]);

        $member = Role::firstOrCreate([
            'name' => 'member',
            'guard_name' => 'web'
        ]);

        $member->syncPermissions([
            'edit-short-url',
        ]);

        // Super Permissions and roles
        $superPermission = Permission::firstOrCreate([
            'name' => 'invite-user',
            'guard_name' => SUPER
        ]);

        $super = Role::firstOrCreate([
            'name' => 'superadmin',
            'guard_name' => SUPER
        ]);

        $super->syncPermissions([$superPermission]);
    }
}
