@extends('Admin.master')
@section('css')
    {{$css}}
@endsection
@section('content')
    <div class="section-header d-block">
        {{$breadcrumb}}
    </div>
    <div class="section-body">
        <h2 class="section-title">{{$title}}</h2>
        {{$slot}}
    </div>
@endsection
@section('script')
    {{$script}}
@endsection
