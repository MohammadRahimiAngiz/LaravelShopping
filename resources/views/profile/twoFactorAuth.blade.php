@extends('profile.layoutProfile')

@section('profile')
    <div class="container">
        <h4>Two Factor Auth:</h4>
        <h6 class="card-subtitle text-muted">Current Your Type: <strong style="color:mediumseagreen">
                {{auth()->user()->two_factor_type}}</strong>
            @if(auth()->user()->phone_number)
                & Current Your Phone:
                <strong style="color:mediumseagreen">
                    {{auth()->user()->phone_number}}
                </strong>
            @endif
        </h6>
        <hr>
        @if($errors->any())
            <ul class="alert alert-danger pl-4 ">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <form id="form" action="{{url('profile/twoFactor')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="type">Select Type:</label>
                <select
                    v-model="smsValue"
                    @change="changeData()"
                    name="type" id="type" class="form-control">
                    @foreach( config('twoFactor.types') as $key=> $value )
                        <option
                            value="{{$key}}"
                            {{old('type') == $key || auth()->user()->hasTwoFactor($key) ? 'selected' : ''}}
                        >{{$value}}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group"
                 v-if="sms"
            >
                <label for="phone">Phone</label>
                <input type="text"
                       name="phone"
                       class="form-control"
                       id="phone"
                       placeholder="Please add your phone number"
                       value="{{old('phone') ?? auth()->user()->phone_number}}"
                >
            </div>
            <div class="form-group">
                <button
                    class="btn btn-primary "
                    type="submit"
                    v-if="phone"
                >
                    Update
                </button>
            </div>
        </form>

@endsection
