@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.users')}}
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item active"><i class=" fa fa-users " style="color: blue;"></i> {{__('site.users')}}</li>
@stop
<!-- /.content-header -->
<!-- Main content -->
@section('Main_content')
    <div class="card card-info with-border">
        <div class="card-header">
            <h3 class="card-title ">{{ __('site.users') }}</h3>
        </div>

        <!-- /.card-header -->
        <form action="">
            <div class="row p-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"  placeholder="{{__('site.search')}}">
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i>@lang('site.search')</button>
                    <a href="{{ route('dashboard.users.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</a>
                </div>
            </div>
        </form>
        <div class="card-body">
            @if(isset($users) and $users->count() > 0)
                <table class="table table-bordered table-hover text-sm">
                    <thead >
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>{{__('site.first_name')}}</th>
                        <th>{{__('site.last_name')}}</th>
                        <th>{{__('site.email')}}</th>
                        <th>{{__('site.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user -> first_name }}</td>
                            <td>{{ $user -> last_name }}</td>
                            <td>{{ $user -> email }}</td>
                            <td>
                                <a class="btn btn-sm btn-info" href="{{ route('dashboard.users.edit', $user->id) }}">{{__('site.edit')}}</a>
                                <form action="{{ route('dashboard.users.destroy', $user->id ) }}" method="post" style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-sm  btn-danger">@lang('site.delete')</button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> <!-- end of table -->
            @else
                <h3>{{__('site.no_data_found')}}</h3>
            @endif


        </div>
    </div>
@stop
