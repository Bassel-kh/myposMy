@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.clients')}}
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item "><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('dashboard.clients.index')}}"><i class=" fa fa-clients " style="color: blue;"></i> {{__('site.clients')}}</a></li>
    <li class="breadcrumb-item active"><i class=" fa fa-plus " style="color: green;"></i> {{__('site.add')}}</li>

@stop
<!-- /.content-header -->
<!-- Main content -->
@section('Main_content')
    @php
        $dir= 'left';
        $dir_ = 'l';
        if(app()->getLocale() == 'en'){
                $dir= 'right';
                $dir_ = 'r';
                }
    @endphp

    {{--    <div class="card with-border  " style="width: 50%; margin: 0 auto;float: none;margin-bottom: 10px;">--}}
<div class="card with-border col-xl-7 grid-width-50  mx-auto" >
    <div class="card-header" >
            <h3 class="card-title"><i class=" fa fa-plus" style="color: green;"></i> {{ __('site.add') }}</h3>
        </div>

        <!-- /.card-header -->
@include('partials._errors')
        <div class="card-body " >
{{--            @include('partials._errors')--}}
            <form action="{{ route('dashboard.clients.store') }}" method="post" >

                {{csrf_field()}}
                {{method_field('post')}}

                <div class="form-group">
                    <label>@lang('site.name')</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>

                @for ($i = 0; $i < 2; $i++)
                    <div class="form-group">
                        <label>@lang('site.phone')</label>
                        <input type="text" name="phone[]" class="form-control" >
                    </div>
                @endfor

                <div class="form-group">
                    <label>@lang('site.address')</label>
                    <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit" ><i class="fa fa-plus"></i>{{__('site.add')}}</button>
                </div>
            </form>
        </div>
    </div>



@stop
<!--/Main content -->
@section('scripts')
    <script>
    </script>
@endsection
