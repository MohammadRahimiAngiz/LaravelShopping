<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Permission;
use App\User;
use Illuminate\Http\Request;

class permissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin-user-permissions')->only(['create','store']);
    }
    public function create(User $user)
    {
//        return $user->permissions()->pluck('id')->toArray();
        return view('Admin.Users.permission',['user'=>$user]);
    }

    public function store(Request $request, User $user)
    {
        $data = $request->validate([
            'permissions' => ['required', 'array'],
            'roles' => [ 'required', 'array'],
        ]);
        $user->permissions()->sync($data['permissions']);
        $user->roles()->sync($data['roles']);
        alert()->success("user: *$user->name* is Permissions && Roles updated.");
        return redirect(route('admin.users.index'));
    }
}
