@component('Admin.layouts.content',['title'=>'Edit Permission:' ])
    @slot('css')
    @endslot
    @slot('script')
    @endslot
    @slot('breadcrumb')
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.permissions.index')}}">Users</a></div>
            <div class="breadcrumb-item">Edit permission</div>
        </div>
    @endslot
    <p class="section-lead">{{$permission->name}}</p>
    <div class="col-12 col-lg-6 col-md-6 p-0">
        <div class="card">
            <form action="{{route('admin.permissions.update',[$permission->id])}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="form-group">
                        <label>Permission</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name')is-invalid @enderror"
                               value="{{ $permission->name }}" required autocomplete="name" autofocus>
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
                                   value="{{ $permission->label }}" required autocomplete="label">
                            @error('label')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary"><i class="fas fa-user-edit mr-1"></i>Save Edit Permission</button>
                    <a href="{{route('admin.permissions.index')}}" class="btn btn-secondary"><i class="fas fa-undo mr-1"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endcomponent
