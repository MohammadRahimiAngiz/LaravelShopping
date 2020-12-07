<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //ACL Users
        $this->middleware('can:show-roles')->only(['index']);
        $this->middleware('can:create-role')->only(['create', 'store']);
        $this->middleware('can:edit-role')->only(['update', 'edit']);
        $this->middleware('can:delete-role')->only(['destroy']);
    }

    public function index()
    {
        $roles = Role::query();
        if ($keyword = \request('search')) {
            $roles = $roles->where('name', 'LIKE', "%{$keyword}%")->orWhere('label', 'LIKE', "%{$keyword}%")->orWhere('id', $keyword);
        }
        $roles = $roles->latest()->paginate(2);
        return view('Admin.Roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('Admin.Roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
            'label' => ['string', 'max:255'],
            'permissions' => ['required', 'array'],
        ]);
        $role = Role::create($data);
        $role->permissions()->sync($data['permissions']);
        return redirect(route('admin.roles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::whereId($id)->first();
//        return $role->permissions->pluck('id')->toArray();
        return view('Admin.Roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'label' => ['string', 'max:255'],
            'permissions' => ['required', 'array'],
        ]);

        $role->update($data);
        $role->permissions()->sync($data['permissions']);
        alert()->success("role: *$role->name* is updated.");
        return redirect(route('admin.roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return back();
    }
}
