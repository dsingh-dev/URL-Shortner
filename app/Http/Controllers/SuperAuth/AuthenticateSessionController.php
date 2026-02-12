<?php

namespace App\Http\Controllers\SuperAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view(SUPER . '.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::guard(SUPER)->attempt($credentials)) {

            $request->session()->regenerate();
            
            return redirect()->route(SUPER . '.dashboard');
        }

        return redirect()->intended(route(SUPER . '.login', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('superadmin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(SUPER . '/login');
    }
}
