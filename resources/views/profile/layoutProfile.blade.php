@extends('layouts.app')
@section('script')
<script type="text/javascript">form.token.focus();</script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('profile') ? 'active' : ''}}" href="{{route('profile')}}">Index</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('profile/twoFactor') ? 'active' : ''}}" href="{{route('twoFactor')}}">To Factor Auth</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                   @yield('profile')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
