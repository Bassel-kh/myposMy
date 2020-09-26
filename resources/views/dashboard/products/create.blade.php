@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.products')}}
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item "><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('dashboard.products.index')}}"><i class=" fa fa-products " style="color: blue;"></i> {{__('site.products')}}</a></li>
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
            <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">

                {{csrf_field()}}
                {{method_field('post')}}

                <div class="form-group">
                    <label>@lang('site.Categories')</label>
                    <select name="category_id" class="form-control">
                        <option value="">@lang('site.all_categories')</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                @foreach (config('translatable.locales') as $locale)
                    <!-- product name -->
                        <div class="form-group">

                            <label>@lang('site.' . $locale . '.name')</label>
                            <input type="text" name="{{ $locale }}[name]"  class="form-control {{ $errors->has($locale.'.name') ? 'is-invalid' : '' }}" value="{{ old($locale . '.name') }}">

                        </div>
                        @error($locale.'.name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    <!-- ./ product name -->

                    <!-- product description -->
                        <div class="form-group">

                            <label>@lang('site.' . $locale . '.description')</label>
                            <textarea type="text" name="{{ $locale }}[description]"  class="form-control ckeditor " >{{ old($locale . '.description') }} </textarea>

                        </div>
                        @error($locale.'.description')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    <!-- ./ product description -->
                @endforeach

                {{--    image      --}}
                <div class="form-group">
                    <label>{{__('site.image')}}</label>
                    <input id="imgInp" class="form-control image_class  @error('image') is-invalid @enderror" type="file" name="image" >
                    @error('image')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <img id="img_preview" class="img-thumbnail  img_preview_class" src="{{asset('uploads/products_images/default.png')}}" style="width: 100px;" alt="not found">
                </div>
                {{--    ./image      --}}

                <div class="form-group">
                    <label>@lang('site.purchase_price')</label>
                    <input type="number" name="purchase_price" step="0.01" class="form-control" value="{{ old('purchase_price') }}">
                </div>

                <div class="form-group">
                    <label>@lang('site.sale_price')</label>
                    <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ old('sale_price') }}">
                </div>

                <div class="form-group">
                    <label>@lang('site.stock')</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
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
