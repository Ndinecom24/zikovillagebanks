<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Ensures non-super-admin users have a village bank selected in session.
 * If not, redirects to home with a flag to trigger the selector modal.
 */
class EnsureVillageBankSelected
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Not logged in or super-admin — skip
        if (!$user || $user->user_role_id == 1) {
            return $next($request);
        }

        // Already has a bank selected
        if (session('current_village_bank_id')) {
            return $next($request);
        }

        // Check how many banks the user belongs to
        $bankCount = $user->villageBanks()->where('status', 'active')->count();

        if ($bankCount === 0) {
            // No banks — let them through (component will show "No Bank" message)
            return $next($request);
        }

        if ($bankCount === 1) {
            // Auto-select the only bank
            $bank = $user->villageBanks()->where('status', 'active')->first();
            session([
                'current_village_bank_id'   => $bank->id,
                'current_village_bank_name' => $bank->name,
            ]);
            return $next($request);
        }

        // Multiple banks, none selected — force selection
        // If this IS the home page, let it through (the modal will auto-open via Livewire)
        if ($request->routeIs('home')) {
            return $next($request);
        }

        // Redirect to home so the modal can show
        return redirect()->route('home')->with('force_bank_selector', true);
    }
}
