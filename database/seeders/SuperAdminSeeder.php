<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_count = SuperAdmin::all()->count();
        if ($admin_count > 0) return;

        $user = SuperAdmin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('12345678'),
        ]);

        $role = Role::findByName('superadmin', SUPER);

        if(!$role) return;

        $user->assignRole($role);
    }
}
