<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Services\InvitationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct(protected InvitationService $invitation_service){}
    
    public function create(): View {
        return view('users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse {
        $validated = $request->validated();

        /** @var \App\Models\Company $company */
        $company = auth()->user()->company;

        $this->invitation_service->sendInvitationEmail($company, $validated);

        return redirect()->route('dashboard')->with('success', 'User invited successfully! check mails for password reset link');
    }
}
