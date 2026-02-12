<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Services\InvitationService;

class UserController extends Controller
{
    public function __construct(protected InvitationService $invitation_service){}
    
    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $this->invitation_service->sendInvitationEmail(auth()->user()->company, $validated);

        return redirect()->route('dashboard')->with('success', 'User invited successfully! check mails for password reset link');
    }
}
