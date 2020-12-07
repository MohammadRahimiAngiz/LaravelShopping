<?php

namespace App\Http\Controllers\profile;

use App\ActiveToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class tokenAuthController extends Controller
{
    public function getVerifyPhone(Request $request)
    {
//        if (!$request->session()->has('phone')) {
//            return redirect(route('twoFactor'));
//        }
        $request->session()->reflash();
        return view('profile.tokenTwoFactorAuth');
    }

    public function postVerifyPhone(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);
        if (!$request->session()->has('phone')) {
            return redirect(route('twoFactor'));
        }

        $status = ActiveToken::verifyToken($request->token, $request->user());
        if ($status) {
            $request->user()->activeToken()->delete();
            $request->user()->update([
                'two_factor_type' => 'sms',
                'phone_number' => $request->session()->get('phone'),
            ]);
            alert()->success('Your phone number and two-step authentication has been verified', 'The operation was successful');
        }else{
            alert()->error('Your phone number not verified','The operation was unsuccessful');
        }
        return redirect(route('twoFactor'));
    }
}
