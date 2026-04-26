<?php

namespace App\Http\Middleware;

use App\Models\RoleBasedAccess\Role;
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

        $user = auth()->user();

        // Super-admin bypasses all permission checks
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Auto-assign the 'member' role if the user has no roles at all.
        // This is a safety-net for users created before role assignment was wired up.
        if ($user->roles()->count() === 0) {
            $memberRole = Role::where('slug', config('chilolezo.roles.member', 'member'))->first();
            if ($memberRole) {
                $user->assignRole($memberRole);
                $user->load('roles'); // refresh loaded relationship
            }
        }

        foreach ($permissions as $permission) {
            if ($user->hasPermission($permission)) {
                return $next($request);
            }
        }

        abort(403, 'You do not have the required permission to access this resource.');
    }
}
