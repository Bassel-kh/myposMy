@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->

@section('HeaderTitle')
    {{__('site.404_Error_Page')}}
@stop

@section('Content_header_list_item')
    <li class="breadcrumb-item active"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</li>
    <li class="breadcrumb-item "><i class=" fa fa-error" style="color: red;"></i> {{__('site.404_Error_Page')}}</li>

@stop
<!-- /.content-header -->

@section('Main_content')
    @include('layouts.dashboard-AdminLte 3._error_404')
@endsection
