@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('Content_header_list_item')
    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item active">{{__('site.users')}}</li>
@stop
<!-- /.content-header -->
<!-- Main content -->
@section('Main_content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title ">{{ __('site.users') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if(isset($users) and $users->count() > 0)
                <table class="table table-bordered  text-sm">
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

                        @endforeach
                    </tbody>
                </table> <!-- end of table -->
            @else
                <h3>{{__('site.no_data_found')}}</h3>
            @endif


        </div>
    </div>
@stop
