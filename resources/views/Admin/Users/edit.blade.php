@component('Admin.layouts.content',['title'=>'Edit User:' ])
    @slot('css')
    @endslot
    @slot('script')
    @endslot
    @slot('breadcrumb')
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.users.index')}}">Users</a></div>
            <div class="breadcrumb-item">Edit User</div>
        </div>
    @endslot
    <p class="section-lead">{{$user->name}}</p>
    <div class="col-12 col-lg-6 col-md-6 p-0">
        <div class="card">
            <form action="{{route('admin.users.update',[$user->id])}}" method="POST">
                @csrf
                @method('PATCH')
                {{--                <div class="card-header">--}}
                {{--                    <h4>Server-side Validation</h4>--}}
                {{--                </div>--}}
                <div class="card-body">
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name')is-invalid @enderror"
                               value="{{ $user->name }}" required autocomplete="name" autofocus>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-at"></i>
                                </div>
                            </div>
                            <input id="email" type="email" name="email"
                                   class="form-control @error('email')is-invalid @enderror"
                                   value="{{ $user->email }}" required autocomplete="email">
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid  @enderror "
                                   id="password" autocomplete="new-password"
                                   data-indicator="pwindicator">
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <input id="password-confirm" type="password"
                                   class="form-control" name="password_confirmation"
                                   autocomplete="new-password"
                                   data-indicator="pwindicator">
                        </div>
                    </div>
                    @if (!$user->hasVerifiedEmail())
                        <div class="form-group">
                            <label class="custom-switch mt-2">
                                <input id="verifyEmail" type="checkbox" name="verifyEmail" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Verify Email User</span>
                            </label>
                        </div>
                    @endif

                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary"><i class="fas fa-user-edit mr-1"></i>Save Edit User</button>
                    <a href="{{route('admin.users.index')}}" class="btn btn-secondary"><i class="fas fa-undo mr-1"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endcomponent
