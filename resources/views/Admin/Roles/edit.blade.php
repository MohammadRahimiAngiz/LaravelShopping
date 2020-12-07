@component('Admin.layouts.content',['title'=>'Edit Role:' ])
    @slot('css')
        <link rel="stylesheet" href="/css/admin/css/select2.min.css">
    @endslot
    @slot('script')
        <script src="/js/admin/select2.full.min.js"></script>
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.roles.index')}}">Roles</a></div>
            <div class="breadcrumb-item">Edit Role</div>
        </div>
    @endslot
    <p class="section-lead">{{$role->name}}</p>
    <div class="col-12 col-lg-6 col-md-6 p-0">
        <div class="card">
            <form action="{{route('admin.roles.update',[$role->id])}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name')is-invalid @enderror"
                               value="{{ $role->name }}" required autocomplete="name" autofocus>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-bars"></i>
                                </div>
                            </div>
                            <input id="label" type="text" name="label"
                                   class="form-control @error('label')is-invalid @enderror"
                                   value="{{ $role->label }}" required autocomplete="label">
                            @error('label')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Select Permissions</label>
                        <select class="form-control select2" multiple="" required name="permissions[]" id="permissions">
                            @foreach (\App\Permission::all() as $permission)
                                <option
                                    {{in_array($permission->id,$role->permissions->pluck('id')->toArray()) ? 'selected' : ''}}
                                    value="{{$permission->id}}">
                                    {{$permission->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary"><i class="fas fa-user-edit mr-1"></i>Save Edit Role</button>
                    <a href="{{route('admin.roles.index')}}" class="btn btn-secondary"><i class="fas fa-undo mr-1"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endcomponent
