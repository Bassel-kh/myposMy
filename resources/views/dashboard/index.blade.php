@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->

@section('HeaderTitle')
    {{__('site.dashboard')}}
@stop

@section('Content_header_list_item')
    <li class="breadcrumb-item active"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</li>
@stop
<!-- /.content-header -->

@section('Main_content')
@endsection
