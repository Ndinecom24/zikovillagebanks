<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Ensures a user can only be logged in on one browser/device at a time.
 * If the stored session ID doesn't match the current one, the user is logged out.
 */
class SingleSession
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // If user has a stored session and it doesn't match the current one, log out
            if ($user->current_session_id && $user->current_session_id !== session()->getId()) {
                // Clear the stored session so the new login can proceed
                $user->current_session_id = null;
                $user->save();

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->with('error', 'You have been logged out because your account was accessed from another browser.');
            }
        }

        return $next($request);
    }
}
