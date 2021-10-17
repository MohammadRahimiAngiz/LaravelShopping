@extends('profile.layoutProfile')
{{--@section('script')--}}
{{--    <script type="text/javascript">form.token.focus();</script>--}}
{{--@endsection--}}
@section('profile')
    <div class="container">
        <form id="form" action="{{route('tokenVerifyPhone')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="token">Enter The Token</label>
                <input autofocus
                    type="text"
                       name="token"
                       class="form-control {{$errors->has('token') ? 'is-invalid' : ''}}"
                       id="token"
                       placeholder="Please Enter Your Token Received From SMS"
                >
                @error('token')
                <span class="invalid-feedback"><strong>{{$message}}</strong></span>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Validate Token</button>
            </div>
        </form>
        <script type="text/javascript">form.token.focus();</script>
    </div>
@endsection
