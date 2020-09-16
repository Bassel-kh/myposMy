@php
    $dir= 'left';
    $dir_ = 'r';
    if(app()->getLocale() == 'en'){
            $dir= 'right';
            $dir_ = 'l';
            }
@endphp
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
            <h3 class="card-title ">{{ __('site.users').'  '. $users->total() }} </h3>
        </div>

        <!-- /.card-header -->
        <form action="{{ route('dashboard.users.index') }}" method="get">
            <div class="row p-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"  placeholder="{{__('site.search')}}" value="{{ request()->search }}">
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i>@lang('site.search')</button>

                    @if(auth()->user()->hasPermission('users_create'))
                        <a href="{{ route('dashboard.users.create') }}" class="btn btn-sm btn-primary "><i class="fa fa-plus"></i>@lang('site.add')</a>
                    @else
                        <a href="#" class="btn btn-sm btn-primary disabled"><i class="fa fa-plus"></i>@lang('site.add')</a>
                    @endif

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
                                @if(auth()->user()->hasPermission('users_update'))
                                    <a class="btn btn-sm btn-info" href="{{ route('dashboard.users.edit', $user->id) }}"><i class="fa fa-edit"></i> {{__('site.edit')}}</a>
                                @else
                                    <a class="btn btn-sm btn-info disabled" href="#"><i class="fa fa-edit"></i> {{__('site.edit')}}</a>

                                @endif
                                @if(auth()->user()->hasPermission('users_delete'))

                                    <form id="users_form" action="{{ route('dashboard.users.destroy', $user->id ) }}" method="post" style="display: inline-block">

                                        {{ csrf_field() }}

                                        {{ method_field('delete') }}

                                        <!-- Button-Delete trigger Delete modal -->

                                            <button type="button" class="btn btn-sm  btn-danger" data-toggle="modal" data-target="#Delete_Modal">

                                               <i class="fa fa-trash"></i> @lang('site.delete')

                                            </button>
                                            <!-- ./ Button-Delete trigger Delete modal -->
                                    </form>
                                @else
                                    <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> {{__('site.delete')}}</button>
                                @endif
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
    <div class=""> {{ $users->appends(request()->query())->links() }}</div>


    <!-- Delete Modal -->
    <div class="modal fade" id="Delete_Modal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">{{__('site.confirm_delete')}}</h5>
                </div>
                <div form="users_form" class="modal-body">

                {{__('site.Are_you_sure_you_want_to').__('site.delete').'?'}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{__('site.Close')}}</button>
                    <button type="submit" form="users_form" class="btn btn-sm  btn-danger"><i class="fa fa-trash"></i> @lang('site.confirm_Edit')</button>
                </div>
            </div>
        </div>
    </div><!--./Delete Modal -->
@stop
