<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function username()
    {
        return 'login';
    }

    /**
     * Get the needed authorization credentials from the request.
     * Accepts username, email, or phone number.
     */
    protected function credentials(Request $request)
    {
        $login = $request->input('login');

        // Determine which field the user is logging in with
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } elseif (preg_match('/^\+?[0-9]{9,15}$/', preg_replace('/[\s\-]/', '', $login))) {
            $field = 'mobile_no';
            $login = preg_replace('/[\s\-]/', '', $login);
        } else {
            $field = 'username';
        }

        return [
            $field     => $login,
            'password' => $request->input('password'),
        ];
    }

    /**
     * Validate the user login request.
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'Please enter your username, email, or phone number.',
        ]);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function authenticated(Request $request, $user)
    {
        // Invalidate any previous session for single-device enforcement
        $user->current_session_id = session()->getId();

        // Increase the count for the login
        $user->total_login = (($user->total_login ?? 0)) + 1;
        $user->save();

        // Log the login event
        ActivityLog::record([
            'log_type'     => 'auth',
            'event'        => 'login',
            'description'  => "User \"{$user->name}\" logged in",
            'subject_type' => get_class($user),
            'subject_id'   => $user->id,
        ]);
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Clear session binding on logout.
     */
    protected function loggedOut(Request $request)
    {
        // User is already null here — logout is logged in the logout() override below
    }

    /**
     * Log the user out and record the activity.
     */
    public function logout(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            ActivityLog::record([
                'log_type'     => 'auth',
                'event'        => 'logout',
                'description'  => "User \"{$user->name}\" logged out",
                'subject_type' => get_class($user),
                'subject_id'   => $user->id,
            ]);
        }

        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new \Illuminate\Http\JsonResponse([], 204)
            : redirect('/');
    }
}
