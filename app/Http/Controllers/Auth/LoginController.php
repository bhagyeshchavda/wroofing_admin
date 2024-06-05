<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the login request
        $this->validateLogin($request);

        // Check if the user has too many login attempts
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Attempt to log the user in
        if ($this->attemptLogin($request)) {
            $user = Auth::user();

            // Check if the user's role is 'admin'
            if($user->status == 'Inactive'){
                // Log the user out if they are not an admin
                Auth::logout();
                return redirect()->back()->withErrors([
                    'email' => 'Your account is deactivated'
                ]);
            }
            if ($user->role == 'admin' && $user->status == 'Active') {
                // Redirect admin users to the admin dashboard
                return redirect()->route('admin.home');
            } else {
                // Log the user out if they are not an admin
                Auth::logout();
                return redirect()->back()->withErrors([
                    'email' => 'You do not have access to this section.'
                ]);
            }
        }

        // Increment login attempts
        $this->incrementLoginAttempts($request);

        // Return a failed login response
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Override the default authenticated method to handle custom redirection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role == 'admin') {
            return redirect()->route('admin.home');
        }
        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin');
    }
}

