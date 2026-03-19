<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     * Usage: middleware('role:admin') or middleware('role:admin,editor')
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized.');
        }

        if (!auth()->user()->hasAnyRole($roles)) {
            abort(403, 'You do not have the required role to access this resource.');
        }

        return $next($request);
    }
}
