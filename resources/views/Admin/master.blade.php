<!DOCTYPE html>
<html lang="en">

<!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="/css/admin/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/admin/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/css/admin/css/select2.min.css">
    <!-- CSS Libraries -->
    @yield('css')
    <!-- Template CSS -->
    <link rel="stylesheet" href="/css/admin/css/style.min.css">
    <link rel="stylesheet" href="/css/admin/css/components.min.css">
    <!-- Laravel-file-manager -->
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
</head>

<body class="layout-4">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <!-- Start app top navbar -->
    @include('Admin.layouts.navbar')
    <!-- Start main left sidebar menu -->
    @include('Admin.layouts.sidebar')
    <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                @yield('content')
            </section>
        </div>
        <!-- Start app Footer part -->
        @include('Admin.layouts.footer')
    </div>

</div>

<!-- General JS Scripts -->
<script src="/js/admin/lib.vendor.bundle.js"></script>
<script src="/js/admin/CodiePie.js"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="/js/admin/scripts.js"></script>
<script src="/js/admin/admin.js"></script>
<script src="/js/admin/jquery-ui.min.js"></script>
<script src="/js/admin/select2.full.min.js"></script>
{{--<script src="/js/app.js"></script>--}}
{{--<script src="/js/admin/vue.js"></script>--}}
@yield('script')
@include('sweet::alert')
</body>
</html>
