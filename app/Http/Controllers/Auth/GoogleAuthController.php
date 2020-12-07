<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $userGoogle = Socialite::driver('google')->user();
            $user = User::whereEmail($userGoogle->getEmail())->first();
            if ($user) {
                Auth::loginUsingId($user->id);
                $user->markEmailAsVerified();
            } else {
                $newUser = User::create([
                    'name' => $userGoogle->getName(),
                    'email' => $userGoogle->getEmail(),
                    'password' => bcrypt(\Str::random(16)),
                    'two_factor_type' => 'off',
                ]);
                Auth::loginUsingId($newUser->id);
                $newUser->markEmailAsVerified();
            }
            return  redirect('/');
        } catch (\Exception $e) {
            //todo error send
            return 'error';
        }
    }
}
