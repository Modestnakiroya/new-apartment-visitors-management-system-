<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{

    public function handle($request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Convert single role to array
        $roles = is_array($roles) ? $roles : [$roles];

        // Check if user has any of the required roles
        foreach ($roles as $role) {
            if ($user->hasAnyRole($role)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
