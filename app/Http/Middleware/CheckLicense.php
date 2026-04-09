<?php

namespace App\Http\Middleware;

use App\Models\Subscription\License;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLicense
{
    /**
     * Ensure the authenticated user's village bank has a valid (active, non-expired) license.
     * Skips checking for super-admins (user_role_id = 1).
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Super-admins bypass license check
        if ($user->user_role_id == 1) {
            return $next($request);
        }

        // Determine the user's village bank
        $villageBankId = session('current_village_bank_id');

        if (!$villageBankId) {
            // Try to get from user's village bank memberships
            $firstBank = $user->villageBanks()->first();
            if ($firstBank) {
                $villageBankId = $firstBank->id;
                session(['current_village_bank_id' => $villageBankId]);
            }
        }

        if (!$villageBankId) {
            return redirect()->route('welcome')
                ->with('error', 'No village bank associated with your account. Please apply for a subscription.');
        }

        // Check for a valid license
        $hasValidLicense = License::where('village_bank_id', $villageBankId)
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->exists();

        if (!$hasValidLicense) {
            return redirect()->route('license.expired')
                ->with('error', 'Your village bank license has expired or is invalid. Please renew your subscription.');
        }

        return $next($request);
    }
}
