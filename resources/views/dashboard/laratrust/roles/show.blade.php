@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.create-role')}}
    @php
        $dir= 'left';
        if(app()->getLocale() == 'en'){
                $dir= 'right';
                }
    @endphp
    @if(app()->getLocale() == 'ar')
        <style>

            .dataTables_filter {
                float: left !important;
            }
        </style>
    @endif
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"> <i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item "><a href="{{route('dashboard.roles.index')}}"> <i class="fas fa-traffic-light" style="color: green;"></i> {{__('site.roles')}}</a></li>
    <li class="breadcrumb-item active"><span> <i class=" fas fa-trash " style="color: black;"></i> {{__('site.delete-role')}}</span></li>
@stop
<!-- /.content-header -->
@section('Main_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Role Board</div>
                <div class="card-body">
                    <p>{{ __('site.role')  }} <b>{{ $role->name }}</b> {{ __('site.was_created')  }} <b>{{ $role->created_at->diffForHumans() }}</b> {{ __('site.and')  }} {{ __('site.last_updated')  }} <b>{{ $role->updated_at->diffForHumans() }}</b></p>
                    <form method="post" action="{{ route('dashboard.roles.destroy', $role) }}">
                        @csrf
                        @method('delete')
                        <button  type="submit" onclick="" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>{{__('site.delete')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
