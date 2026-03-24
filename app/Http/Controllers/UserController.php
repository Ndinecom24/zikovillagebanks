<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\StrongPassword;

class UserController extends Controller
{
    /**
     * Change the authenticated user's password.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8', new StrongPassword],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Your current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'password_changed' => config('constants.password_changed'),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }

    /**
     * Search for staff details (PHRIS integration).
     */
    public function getStaffDetails(Request $request)
    {
        $search = $request->input('search');

        if (empty($search)) {
            return response()->json(['data' => []]);
        }

        $results = \App\Models\PhrisUserDetails::where('employee_number', $search)
            ->orWhere('name', 'LIKE', '%' . $search . '%')
            ->limit(10)
            ->get();

        return response()->json(['data' => $results]);
    }
}
