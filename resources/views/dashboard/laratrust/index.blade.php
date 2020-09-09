@php
    $dir= 'vendor/laratrust/laratrust.css';
    if(app()->getLocale() == 'ar'){
            $dir= 'vendor/laratrust/laratrust_rtl.css';

            }
@endphp
@extends('layouts.dashboard-AdminLte 3.app')

@section('Header')
    <link href="{{ asset($dir) }}" rel="stylesheet">
@stop
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.permissions')}}
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item"><a href="{{url('dashboard/permission')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.permissions_management')}}</a></li>
    <li class="breadcrumb-item active"><i class=" fa fa-users " style="color: blue;"></i> </li>
@stop
<!-- /.content-header -->
<!-- Main content -->
@section('Main_content')
    @include('dashboard.laratrust.laratrustTab')
@stop
