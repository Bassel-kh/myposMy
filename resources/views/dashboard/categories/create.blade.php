@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.categories')}}
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item "><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('dashboard.categories.index')}}"><i class=" fa fa-categories " style="color: blue;"></i> {{__('site.Categories')}}</a></li>
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
            <form action="{{ route('dashboard.categories.store') }}" method="post" >

                {{csrf_field()}}
                {{method_field('post')}}


                @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.name')</label>
                        <input type="text" name="{{ $locale }}[name]"  class="form-control {{ $errors->has($locale.'.name') ? 'is-invalid' : '' }}" value="{{ old($locale . '.name') }}">
                    </div>
                    @error($locale.'.name')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                @endforeach

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
