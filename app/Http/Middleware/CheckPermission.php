<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     * Usage: middleware('permission:create-ipp') or middleware('permission:create-ipp,edit-ipp')
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized.');
        }

        foreach ($permissions as $permission) {
            if (auth()->user()->hasPermission($permission)) {
                return $next($request);
            }
        }

        abort(403, 'You do not have the required permission to access this resource.');
    }
}
