@extends('layouts.app')
@section('script')
    <script type="text/javascript">form.code.focus();</script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Two Factor Authentication</h4>
                    </div>
                    <div class="card-body">
                        <form id="form" action="{{route('2fa.token')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="code">Enter The Code</label>
                                <input
                                       type="text"
                                       name="code"
                                       class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"
                                       id="code"
                                       placeholder="Please Enter Your Code Received From SMS"
                                >
                                @error('code')
                                <span class="invalid-feedback"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Validate Token</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>








    {{--    <div class="container">--}}
    {{--        <form action="{{route('2fa.token')}}" method="POST">--}}
    {{--            @csrf--}}

    {{--            <div class="form-group">--}}
    {{--                <label for="token">Enter The Token1</label>--}}
    {{--                <input type="text"--}}
    {{--                       name="token"--}}
    {{--                       class="form-control {{$errors->has('token') ? 'is-invalid' : ''}}"--}}
    {{--                       id="token"--}}
    {{--                       placeholder="Please Enter Your Token Received From SMS"--}}
    {{--                >--}}
    {{--                @error('token')--}}
    {{--                <span class="invalid-feedback"><strong>{{$message}}</strong></span>--}}
    {{--                @enderror--}}
    {{--            </div>--}}
    {{--            <div class="form-group">--}}
    {{--                <button class="btn btn-primary" type="submit">Validate Token</button>--}}
    {{--            </div>--}}
    {{--        </form>--}}
@endsection
