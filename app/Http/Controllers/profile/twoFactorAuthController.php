<?php

namespace App\Http\Controllers\Profile;

use App\ActiveToken;
use App\Http\Controllers\Controller;
use App\Notifications\activeCode;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class twoFactorAuthController extends Controller
{
    public function manageTwoFactor()
    {
        return view('profile.twoFactorAuth');
    }

    public function postManageTwoFactor(Request $request)
    {
        $data = $this->validateRequestData($request);
        if ($this->isRequestTypeOff($data['type'])) {
            $request->user()->update([
                'two_factor_type' => 'off'
            ]);
        }
        if ($this->isRequestTypeSms($data['type'])) {
            //validate phone number
            if ($data['phone'] !== $request->user()->phone_number) {
                //generate code
                return $this->createCodeAndSms($request, $data['phone']);
            } else {
                $request->user()->update([
                    'two_factor_type' => 'sms',
                ]);
                alert()->info('If necessary, please change the phone number','SMS authentication enabled')->autoclose(5000);
            }
        }
        return back();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validateRequestData(Request $request): array
    {
        $data = $request->validate([
            'type' => 'required | in:sms,off',
            'phone' => ['required_unless:type,off', Rule::unique('users', 'phone_number')->ignore($request->user()->id)],
        ]);
        return $data;
    }

    /**
     * @param $type
     * @return bool
     */
    public function isRequestTypeOff($type): bool
    {
        return $type === 'off';
    }

    /**
     * @param $type
     * @return bool
     */
    public function isRequestTypeSms($type): bool
    {
        return $type === 'sms';
    }

    /**
     * @param Request $request
     * @param $phone
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createCodeAndSms(Request $request, $phone)
    {
        $token = ActiveToken::generateToken($request->user());
        $request->session()->flash('phone', $phone);
        // send sms
        $request->user()->notify(new activeCode($token, $phone));
        return redirect(route('tokenVerifyPhone'));
    }

}
