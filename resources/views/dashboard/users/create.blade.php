@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.users')}}
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item "><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('dashboard.users.index')}}"><i class=" fa fa-users " style="color: blue;"></i> {{__('site.users')}}</a></li>
    <li class="breadcrumb-item active"><i class=" fa fa-plus " style="color: green;"></i> {{__('site.add')}}</li>

@stop
<!-- /.content-header -->
<!-- Main content -->
@section('Main_content')
    <div class="card with-border  " style="width: 50%; margin: 0 auto;float: none;margin-bottom: 10px;">
        <div class="card-header">
            <h3 class="card-title"><i class=" fa fa-plus" style="color: green;"></i> {{ __('site.add') }}</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body ">
{{--            @include('partials._errors')--}}
            <form action="{{ route('dashboard.users.store') }}" method="post">

                {{csrf_field()}}
                {{method_field('post')}}

                <div class="form-group">
                    <label for="fist_name">{{__('site.first_name')}}</label>
                    <input id="fist_name" class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{old('first_name')}}"  >
                    @error('first_name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group ">
                    <label>{{__('site.last_name')}}</label>
                    <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{old('last_name')}}" >
                    @error('last_name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label>{{__('site.email')}}</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{old('email')}}" >
                    @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label>{{__('site.password')}}</label>
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" >
                    @error('password')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{__('site.password_confirmation')}}</label>
                    <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" >
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit" ><i class="fa fa-plus"></i>{{__('site.add')}}</button>
                </div>
            </form>
        </div>
    </div>

@stop
<!--/Main content -->
