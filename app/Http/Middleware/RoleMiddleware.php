<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!$request->user()) {
            abort(403, 'Unauthorized');
        }

        if (!$request->user()->hasAnyRole($roles)) {
            abort(403, 'You don\'t have permission to access this page');
        }

        return $next($request);
    }
}
