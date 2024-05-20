<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, string $role)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/home'); // Redirect to home if not authenticated
        }

        $user = Auth::user();

        // Check if the authenticated user has the required role directly
        if ($user->role === $role) {
            return $next($request); // Allow request to proceed
        }

        return redirect('/home'); // Redirect to home if role does not match
    }
}

