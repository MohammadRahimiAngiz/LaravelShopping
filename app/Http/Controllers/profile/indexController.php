<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\User;

//use AshAllenDesign\MailboxLayer\Facades\MailboxLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class indexController extends Controller
{
    public function index()
    {
        return view('profile.index', ['user' => Auth::user()]);
    }

    public function UploadImageUser(Request $request)
    {
        $user = User::findOrFail($request['id']);
        Storage::disk('public')->delete($user->avatar);
        $path = Storage::disk('public')->putFile(
            'avatars', $request->file('avatar')
        );
        $data = [
            'avatar' => $path,
            'id' => $request['id'],
        ];
        $user->update($data);
        return $user->avatar;
    }

    public function editUser(Request $request)
    {
        if (!$this->uniqueEmailUser($request['id'], $request['email'])) {
            return 0;
        } else {
            $user = User::findOrFail($request['id']);
            $data = [
                'name' => $request['name'],
                'email' => $request['email'],
                'phone_number' => $request['phone_number'],
                'id' => $request['id'],
            ];
            if (!is_null($request['password'])) {
                $data['password'] = bcrypt($request->password);
            }
            $user->update($data);
            $data['avatar'] = $user->avatar;
            $filtered = collect($data)->filter(function ($value, $key) {
                return $key != 'password';
            });
            return $data;
        }
    }

    public function uniqueEmailUser($id, $email)
    {
        $users = User::all();
        $users = $users->diff(User::whereIn('id', [$id])->get());
        $users = $users->reject(function ($user) use ($email) {
            return $user->email !== $email;
        });
        return collect($users)->isEmpty();
    }
}
