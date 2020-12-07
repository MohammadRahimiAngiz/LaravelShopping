<?php

namespace App\Http\Controllers\Auth;

use App\ActiveToken;
use App\Http\Controllers\Controller;
use App\Notifications\activeCode;
use App\Notifications\LoginToWebsite;
use App\Providers\RouteServiceProvider;
use App\Rules\Recaptcha;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

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

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasTwoFactorAuthenticatedEnabled()) {
            $request->session()->flash('auth', [
                'userId' => $user->id,
                'using_sms' => false,
                'remember' => $request->has('remember'),
            ]);
            auth()->logout();
            if ($user->hasSmsTwoFactorAuthenticationEnabled()) {
                $request->session()->push('auth.using_sms', true);
                $token = ActiveToken::generateToken($user);
//                 send code sms
                $user->notify(new activeCode($token, $user->phone_number));
            }
            return redirect(route('2fa.token'));
        }
        $user->notify(new LoginToWebsite());
        return false;
    }

    protected function validateLogin(Request $request)
    {
        if(session()->has('count')){
            session()->increment('count');
        }else{
            session(['count'=>0]);
        }
//        dd(session('count'));
        if(session('count')>4){
            $request->validate([
                $this->username() => 'required|string',
                'password' => 'required|string',
                'g-recaptcha-response' => ['required', new Recaptcha],
            ],
                [
                    'g-recaptcha-response.required' => 'Please Select the reCAPTCHA Checkbox!!'
                ]
            );
        }else{
            $request->validate([
                $this->username() => 'required|string',
                'password' => 'required|string',
            ]);
        }
    }

//    public function login(Request $request)
//    {
//        return $request->all();
//    }
}
