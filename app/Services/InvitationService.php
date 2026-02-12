<?php

namespace App\Services;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;

class InvitationService {
    
    public function sendInvitationEmail(Company $company, array $request): void {
        $request['company_id'] = $company->id;
        $request['password'] = null;
        $request['role'] ??= 'admin';

        $user = User::create($request);

        Password::sendResetLink([
            'email' => $user->email
        ]);

        $role = Role::where('name', $request['role'])->where('guard_name', 'web')->first();
        if ($role) {
            $user->assignRole($role);
        }
    }
}