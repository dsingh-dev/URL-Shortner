<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SuperAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): mixed {
        $guard = SUPER;

        // Debug logging
        Log::info('SuperAuth middleware check', [
            'guard' => $guard,
            'authenticated' => Auth::guard($guard)->check(),
            'web_authenticated' => Auth::guard('web')->check(),
            'session_id' => session()->getId(),
            'url' => $request->fullUrl()
        ]);

        if (!Auth::guard($guard)->check()) {
            Log::info('SuperAuth: User not authenticated with superadmin guard, redirecting to login');
            Auth::guard($guard)->logout();

            return to_route(SUPER . ".login");
        }

        Log::info('SuperAuth: User authenticated, proceeding to dashboard');
        return $next($request);
    }
}
