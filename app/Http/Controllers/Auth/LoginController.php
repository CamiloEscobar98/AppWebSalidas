<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $roles = \App\Models\Role::all();
        return view('auth.login')->with('roles', $roles);
    }

    public function login(Request $request)
    {
        // return $request->all();
        $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        $role = \App\Models\Role::find($request->role_id);
        if ($this->verifyRole($request, $role->name)) {
            if ($this->attemptLogin($request)) {
                switch ($request->role_id) {
                    case 2:
                        session(['role' => 'estudiante']);
                        break;
                    case 3:
                        session(['role' => 'docente']);
                        break;
                    case 4:
                        session(['role' => 'director']);
                        break;
                    default:
                        session(['role' => 'administrador']);
                        break;
                }
                return $this->sendLoginResponse($request);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        session()->forget('role');
        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/');
    }

    protected function validateLogin(Request $request)
    {
        $rules = [
            $this->username() => ['required', 'string'],
            'password' => ['required', 'string'],
            'role_id' => ['required', 'integer', 'min:0']
        ];
        $attributes = [
            'code' => 'código del usuario',
            'password' => 'contraseña del usuario',
            'role_id' => 'rol del usuario'
        ];
        $request->validate($rules, ['role_id.min' => 'Por favor selecciona un :attribute'], $attributes);
    }

    public function username()
    {
        return 'code';
    }

    public function verifyRole(Request $request, $role)
    {
        $usuario = \App\User::where('code', $request->code)->first();
        return $usuario->hasRole($role);
    }
}
