<!-- Start app top navbar -->

<nav class="navbar main-navbar navbar-expand-lg text-primary-all" style="top:0;">
    <div class="container">
        <a href="{{url('/')}}" class="navbar-brand sidebar-gone-hide">
            <x-logo width="40pt" height="40pt"></x-logo>
            Zhino Arts
        </a>
        {{--        <a href="{{url('/')}}" class="navbar-brand sidebar-gone-hide">{{config('app.brand')}}</a>--}}
        {{--        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>--}}
        <div class="nav-collapse">
            <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#"><i class="fas fa-ellipsis-v"></i></a>
            <ul class="navbar-nav">
                <li class="nav-item active"><a href="#" class="nav-link">Application</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Report Something</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Server Status</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Server Status</a></li>
            </ul>
        </div>

        <ul class="navbar-nav navbar-right">

            @if (Route::has('login'))
                {{--                <div class="top-right links ">--}}
                @auth
                    <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link" >Home</a></li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link" ><i class="fas fa-user mr-1" ></i>Login</a></li>
                    @if (Route::has('register'))
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link" ><i class="fas fa-user-plus mr-1" ></i><span>Register</span></a></li>
                    @endif
                @endauth
                {{--                </div>--}}
            @endif
        </ul>

    </div>
</nav>


{{--<div class="navbar-bg" style="top:73px;"></div>--}}
<nav class="navbar navbar-expand-lg navbar-secondary text-white-all bg-primary bg pt-2" style="top:100px;">
    <div class="container " style=" position:relative;" id="header">
        <ul class="navbar-nav ">
            <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a href="index-0.html" class="nav-link">Analytics</a></li>
                    <li class="nav-item"><a href="index-2.html" class="nav-link">Ecommerce</a></li>
                </ul>
            </li>
            <li class="nav-item ">
                <a href="#" class="nav-link"><i class="far fa-heart"></i><span>Top Navigation</span></a>
            </li>
            {{--            <li class="nav-item dropdown">--}}
            {{--                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="far fa-clone"></i><span>Multiple Dropdown</span></a>--}}
            {{--                <ul class="dropdown-menu">--}}
            {{--                    <li class="nav-item"><a href="#" class="nav-link">Not Dropdown Link</a></li>--}}
            {{--                    <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Hover Me</a>--}}
            {{--                        <ul class="dropdown-menu">--}}
            {{--                            <li class="nav-item"><a href="#" class="nav-link">Link</a></li>--}}
            {{--                            <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Link 2</a>--}}
            {{--                                <ul class="dropdown-menu">--}}
            {{--                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>--}}
            {{--                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>--}}
            {{--                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>--}}
            {{--                                </ul>--}}
            {{--                            </li>--}}
            {{--                            <li class="nav-item"><a href="#" class="nav-link">Link 3</a></li>--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}

        </ul>
        <a href="{{url('/')}}" class="logo" >
            <x-logo width="80pt" height="80pt" ></x-logo>
        </a>
        <ul class="navbar-nav ">
            <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a href="index-0.html" class="nav-link">Analytics</a></li>
                    <li class="nav-item"><a href="index-2.html" class="nav-link">Ecommerce</a></li>
                </ul>
            </li>
            <li class="nav-item ">
                <a href="#" class="nav-link"><i class="far fa-heart"></i><span>Top Navigation</span></a>
            </li>
        </ul>

    </div>
</nav>

<!-- Start top menu -->
