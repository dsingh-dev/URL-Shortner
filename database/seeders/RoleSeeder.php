<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //admin roles
        $roles = [
            'admin',
            'member',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // admin permissions
        $permissions = [
            'edit-short-url',
            'view-short-url',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        //superadmin permission
        $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => SUPER]);

        $super_permission = Permission::firstOrCreate(['name' => 'invite-user', 'guard_name' => SUPER]);
        
        $role->givePermissionTo($super_permission);
    }
}
