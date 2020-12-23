<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class permissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //ACL Users
        $this->middleware('can:show-permissions')->only(['index']);
        $this->middleware('can:create-permission')->only(['create', 'store']);
        $this->middleware('can:edit-permission')->only(['update', 'edit']);
        $this->middleware('can:delete-permission')->only(['destroy']);
    }

    public function index()
    {
        $permissions = Permission::query();

        if ($keyword = \request('search')) {
            $permissions = $permissions->where('name', 'LIKE', "%{$keyword}%")->orWhere('label', 'LIKE', "%{$keyword}%")->orWhere('id', $keyword);
        }
        $permissions = $permissions->latest()->paginate(20);
        return view('Admin.Permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.permissions.create');
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
            'name' => ['required', 'string', 'max:255', 'unique:permissions'],
            'label' => ['string', 'max:255'],
        ]);
        Permission::create([
            'name' => $data['name'],
            'label' => $data['label'],
        ]);
        return redirect(route('admin.permissions.index'));
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::whereId($id)->first();
        return view('Admin.Permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($permission->id)],
            'label' => ['string', 'max:255'],
        ]);

        $permission->update($data);
        alert()->success("permission: *$permission->name* is updated.");
        return redirect(route('admin.permissions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back();
    }
}
