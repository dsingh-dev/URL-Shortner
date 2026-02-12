<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\User;
use App\Services\InvitationService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CompanyInviteController extends Controller
{
    public function __construct(protected InvitationService $invitationService){}

    public function index()
    {
        return view(SUPER . '.invite-company');
    }

    public function create(StoreCompanyRequest $request) {
        $validated = $request->validated();

        $company = Company::create($validated);

        $this->invitationService->sendInvitationEmail($company, $validated);

        return redirect()->route(SUPER . '.dashboard');
    }
}
