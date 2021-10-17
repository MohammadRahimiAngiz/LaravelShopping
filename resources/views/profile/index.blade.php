@extends('profile.layoutProfile')
@section('profile')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">

                </div>
            </div>
{{--            <div class="section-body">--}}
{{--                <h2 class="section-title">Hi,{{$user->name}}</h2>--}}
{{--                <p class="section-lead">Change information about yourself on this page.</p>--}}

{{--                <div class="row mt-sm-4">--}}
                    <view-profile-user :user="{{$user}}"></view-profile-user>
{{--                    <edit-profile-user :user="{{$user}}"></edit-profile-user>--}}
{{--                    <div class="col-12 col-md-12 col-lg-7">--}}
{{--                        <div class="card">--}}
{{--                            <form method="POST" class="needs-validation" action="{{route('profile.edit.user',[$user->id])}}" enctype="multipart/form-data">--}}
{{--                                @csrf--}}
{{--                                @method('PATCH')--}}
{{--                                <div class="card-header">--}}
{{--                                    <h4>Edit Profile</h4>--}}
{{--                                </div>--}}
{{--                                <div class="card-body">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="form-group col-12">--}}
{{--                                            <label>File</label>--}}
{{--                                            <input type="file" class="form-control" name="avatar">--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-12">--}}
{{--                                            <label for="name">Name:</label>--}}
{{--                                            <input type="text" class="form-control @error('name')is-invalid @enderror" value="{{$user->name}}" name="name" >--}}
{{--                                            @error('name')--}}
{{--                                            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="form-group col-md-7 col-12">--}}
{{--                                            <label>Email</label>--}}
{{--                                            <div class="input-group">--}}
{{--                                                <div class="input-group-prepend">--}}
{{--                                                    <div class="input-group-text">--}}
{{--                                                        <i class="fas fa-at"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <input id="email" type="email" name="email" value="{{$user->email}}" required="required" autocomplete="email" class="form-control  @error('email')is-invalid @enderror">--}}
{{--                                                @error('email')--}}
{{--                                                <div class="invalid-feedback">{{$message}}</div>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-5 col-12">--}}
{{--                                            <label>Mobile:</label>--}}
{{--                                            <input type="tel" class="form-control @error('phone_number')is-invalid @enderror" value="{{$user->phone_number}}" name="phone_number">--}}
{{--                                            @error('phone_number')--}}
{{--                                            <div class="invalid-feedback">{{$message}}</div>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-6 col-12">--}}
{{--                                            <label>New Password</label>--}}
{{--                                            <div class="input-group">--}}
{{--                                                <div class="input-group-prepend">--}}
{{--                                                    <div class="input-group-text">--}}
{{--                                                        <i class="fas fa-lock"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <input type="password" name="password" id="password" autocomplete="new-password"  class="form-control @error('password')is-invalid @enderror" >--}}
{{--                                                @error('password')--}}
{{--                                                <div class="invalid-feedback">{{$message}}</div>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-6 col-12">--}}
{{--                                            <label>Confirm New Password</label>--}}
{{--                                            <div class="input-group">--}}
{{--                                                <div class="input-group-prepend">--}}
{{--                                                    <div class="input-group-text">--}}
{{--                                                        <i class="fas fa-lock"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <input id="password-confirm" type="password" name="password_confirmation" autocomplete="new-password"  class="form-control">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="card-footer text-right">--}}
{{--                                    <button type="submit" class="btn btn-primary">Save Changes</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </section>
    </div>
@endsection
