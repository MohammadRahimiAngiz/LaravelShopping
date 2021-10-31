<!DOCTYPE html>
<html lang="en">

<!-- layout-top-navigation.html  Tue, 07 Jan 2020 03:35:42 GMT -->
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
{{--    <title>{{env('APP_NAME')}}</title>--}}
    {!! SEO::generate() !!}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/admin/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
{{--    <link rel="stylesheet" href="/css/prism.css">--}}

<!-- Template CSS -->
    @yield('css')
    <link rel="stylesheet" href="/css/style.min.css">
    <link rel="stylesheet" href="/css/components.min.css">

    <style>


        .logo {
            background: #fff;
            width: 120px;
            height: 120px;
            top: 3px;
            position: relative;
            padding-left: 6px;
        }


        .bg {
            background: url('/image/bg.png') top center repeat-x;
            box-shadow: none !important;
        }
    </style>
</head>

<body class="layout-3">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
<div id="app">
    <div class=" container main-wrapper main-wrapper-1">
    @include('home.layouts.header')
    <!-- Start app main Content -->
        <div class="main-content mt-2">
            @yield('content')
        </div>
    </div>
</div>
<!-- General JS Scripts -->
<script src="/js/admin/lib.vendor.bundle.js"></script>
<script src="/js/admin/CodiePie.js"></script>
<script src="/js/admin/scripts.js"></script>
<script src="/js/admin/admin.js"></script>
@yield('script')
@include('sweet::alert')
</body>
</html>
