@component('Admin.layouts.content',['title'=>'Permissions && Roles User: '])
    @slot('css')
        <link rel="stylesheet" href="/css/admin/css/select2.min.css">
    @endslot
    @slot('script')
        <script src="/js/admin/select2.full.min.js"></script>
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.users.index')}}">Users</a></div>
            <div class="breadcrumb-item">New Role</div>
        </div>
    @endslot
    <p class="section-lead">
        <i class="fas fa-user-shield mr-1"></i>
        {{$user->name}}<br/><small class="text-muted">{{$user->email}}</small>
    </p>
    <div class="col-12 col-lg-6 col-md-6 p-0">
        <div class="card">
            <form action="{{route('admin.user.permissions.store',$user->id)}}" method="POST">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label><i class="fas fa-shield-alt"></i> Select Permissions</label>
                        <select class="form-control select2" multiple="" required name="permissions[]">
                            @foreach (\App\Permission::all() as $permission)
                                <option
                                    {{in_array($permission->id,$user->permissions->pluck('id')->toArray()) ? 'selected' : ''}}
                                    value="{{$permission->id}}">{{$permission->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-shield-alt"></i> Select Roles</label>
                        <select class="form-control select2" multiple="" required name="roles[]">
                            @foreach (\App\Role::all() as $role)
                                <option
                                    {{in_array($role->id,$user->roles->pluck('id')->toArray()) ? 'selected' : ''}}
                                    value="{{$role->id}}">{{$role->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary"><i class="fas fa-shield-alt mr-1"></i>Save</button>
                    <a href="{{route('admin.users.index')}}" class="btn btn-secondary"><i class="fas fa-undo mr-1"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endcomponent
