<?php

namespace App\Http\Controllers\SuperAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAuth\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View|RedirectResponse
    {
        if (Auth::guard(SUPER)->check()) {
            return redirect()->route(SUPER . '.dashboard');
        }
        
        return view(SUPER . '.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route(SUPER . '.dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard(SUPER)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route(SUPER . '.login');
    }
}
