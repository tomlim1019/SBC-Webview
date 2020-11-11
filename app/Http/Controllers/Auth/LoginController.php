<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Owner;
use Illuminate\Support\Facades\Auth;


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

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /*
    public function login(Request $request)
    {
       $user = Owner::where('username', $request->username)
                    ->where('password',md5($request->password))
                    ->first();
        if($user)
            Auth::login($user);
       return redirect('/');
    }
    */

    protected function attemptLogin(Request $request)
    {
        $user = \App\Models\Owner::where([
            'username' => $request->username,
            'password' => md5($request->password)
        ])->first();
        
        if ($user) {
            $this->guard()->login($user, $request->has('remember'));

            return true;
        }

        return false;
    }

}
