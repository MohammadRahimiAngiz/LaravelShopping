@component('Admin.layouts.content',['title'=>'New Role'])
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
            <div class="breadcrumb-item">New Role</div>
        </div>
    @endslot
    <div class="col-12 col-lg-6 col-md-6 p-0">
        <div class="card">
            <form action="{{route('admin.roles.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Role Name</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name')is-invalid @enderror"
                               value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                                   value="{{ old('label') }}" required autocomplete="label">
                            @error('label')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Select Permissions</label>
                        <select class="form-control select2" multiple="" required name="permissions[]">
                            @foreach ($permissions as $permission)
                                <option value="{{$permission->id}}">{{$permission->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary"><i class="fas fa-user-plus mr-1"></i>Save New Role</button>
                    <a href="{{route('admin.roles.index')}}" class="btn btn-secondary"><i class="fas fa-undo mr-1"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endcomponent
