<?php

namespace App\Services;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class InvitationService {
    
    public function sendInvitationEmail(Company $company, array $request): void {
        $request['company_id'] = $company->id;
        $request['password'] = null;

        $user = User::create($request);

        Password::sendResetLink([
            'email' => $user->email
        ]);
    }
}