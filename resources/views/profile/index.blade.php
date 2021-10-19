@extends('profile.layoutProfile')
@section('profile')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">

                </div>
            </div>
            <view-profile-user :user="{{$user}}"></view-profile-user>
        </section>
    </div>
@endsection
