<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecurityMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->isSecurity()) {
            return redirect()->route('login')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
