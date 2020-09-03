@extends('layouts.dashboard-AdminLte 3.app')

    <!-- Content Header (Page header) -->
    @section('Content_header_list-item')
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('site.dashboard')}}</a></li>
    @stop
        <!-- /.content-header -->
@section('Main_content')
@endsection
