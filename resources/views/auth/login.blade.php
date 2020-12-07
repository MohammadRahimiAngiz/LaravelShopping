@extends('layouts.app')
@section('script')

    <script type="text/javascript">form.email.focus();</script>
@endsection

@section('content')
    <div class="container" >
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-light" >
                    <div class="card-header">{{ __('Login') }} </div>
                    <div class="card-body">
                        <form id="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if (session()->has('count') && session('count')>4)
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <x-recaptcha :has-error="$errors->has('g-recaptcha-response')"></x-recaptcha>
                                        @error('g-recaptcha-response')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class=" btn btn-primary btn-block">
                                        <i class="fas fa-user" style="font-size: 16px;"></i>
                                        {{ __('Login') }}
                                    </button>

                                    <a href="{{route('auth.google')}}" class="btn btn-danger btn-block text-white">
                                        <i class="fab fa-google-plus-g" style="font-size: 16px;"></i>
                                        Login With Google
                                    </a>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link " href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
