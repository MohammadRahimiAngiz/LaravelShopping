<?php

namespace App\Http\Controllers\auth;

use App\ActiveToken;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class authTokenController extends Controller
{
    public function getToken(Request $request)
    {
//        if (!$request->session()->has('auth')) {
//            return redirect(route('login'));
//        }
        $request->session()->reflash();
        return view('auth.token');
    }

    public function postToken(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);
        if (!$request->session()->has('auth')) {
            return redirect(route('login'));
        }
        $user = User::findOrFail($request->session()->get('auth.userId'));
        $status = ActiveToken::verifyToken($request->input('code'), $user);
        if (!$status) {
            alert()->error('Please enter the correct code after entering the mobile', 'Incorrect Code!');
            return redirect(route('login'));
        }
        if (auth()->loginUsingId($user->id, $request->session()->get('auth.remember'))) {
            $user->activeToken()->delete();
            alert()->success('Your authentication has been verified', 'Code Verified');
            return redirect('/home');
        }
        return redirect('login');
    }
}
