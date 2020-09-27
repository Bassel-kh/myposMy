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
    {{__('site.clients')}}
@stop
@section('Content_header_list_item')

    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item active"><span><i class=" fa fa-list-alt " style="color: blue;"></i> {{__('site.clients')}}</li></span>

@stop
<!-- /.content-header -->

<!-- Main content -->
@section('Main_content')
    <div class="card card-info with-border">
        <div class="card-header">
            <h3 class="card-title ">{{ __('site.clients').'  '. $clients->total() }} </h3>
        </div>

        <!-- /.card-header -->
        <form action="{{ route('dashboard.clients.index') }}" method="get">
            <div class="row p-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"  placeholder="{{__('site.search')}}" value="{{ request()->search }}">
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i>@lang('site.search')</button>

                    @if(auth()->user()->hasPermission('clients_create'))
                        <a href="{{ route('dashboard.clients.create') }}" class="btn btn-sm btn-primary "><i class="fa fa-plus"></i>@lang('site.add')</a>
                    @else
                        <a href="#" class="btn btn-sm btn-primary disabled"><i class="fa fa-plus"></i>@lang('site.add')</a>
                    @endif

                </div>
            </div>
        </form>
        <div class="card-body">
            @if(isset($clients) and $clients->count() > 0)
                <table class="table table-bordered table-hover text-sm">
                    <thead >
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>{{__('site.name')}}</th>
                        <th>@lang('site.phone')</th>
                        <th>@lang('site.address')</th>
                        <th>{{__('site.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $index => $client)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $client -> name }}</td>
                                <td>{{ is_array($client->phone) ? implode($client->phone, '-') : $client->phone }}</td>
                                <td>{{ $client -> address}}</td>
                                <td>
                                @if(auth()->user()->hasPermission('clients_update'))
                                    <a class="btn btn-sm btn-info" href="{{ route('dashboard.clients.edit', $client->id) }}"><i class="fa fa-edit"></i> {{__('site.edit')}}</a>
                                @else
                                    <a class="btn btn-sm btn-info disabled" href="#"><i class="fa fa-edit"></i> {{__('site.edit')}}</a>

                                @endif
                                @if(auth()->user()->hasPermission('clients_delete'))

                                    <form id="clients_form_{{$client->id}} " action="{{ route('dashboard.clients.destroy', $client->id ) }}" method="post" style="display: inline-block">

                                        {{ csrf_field() }}

                                        {{ method_field('delete') }}
                                        <button type="submit"  class="btn btn-sm  btn-danger"><i class="fa fa-trash"></i> @lang('site.delete')</button>

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
    <div class=""> {{ $clients->appends(request()->query())->links() }}</div>
@stop
