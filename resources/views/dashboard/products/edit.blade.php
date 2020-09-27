@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.products')}}
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item "><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('dashboard.products.index')}}"><i class=" fa fa-products " style="color: blue;"></i> {{__('site.products')}}</a></li>
    <li class="breadcrumb-item active"><i class=" fa fa-plus " style="color: green;"></i> {{__('site.edit')}}</li>

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
    <div class="card with-border  " >
        <div class="card-header" >
            <h3 class="card-title"><i class=" fa fa-plus" style="color: green;"></i> {{ __('site.edit') }}</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body " >
            {{--            @include('partials._errors')--}}
            <form action="{{ route('dashboard.products.update', $product ->id) }}" method="post" enctype="multipart/form-data" >

                {{csrf_field()}}
                {{method_field('put')}}

                <div class="form-group">
                    <label>@lang('site.categories')</label>
                    <select name="category_id" class="form-control">
                        <option value="">@lang('site.all_categories')</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>


            @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.name')</label>
                        <input type="text" name="{{ $locale }}[name]"  class="form-control {{ $errors->has($locale.'.name') ? 'is-invalid' : '' }}" value="{{ $product->translate($locale)->name}}">
                    </div>
                    @error($locale.'.name')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror


            <!-- product description -->
                <div class="form-group">

                    <label>@lang('site.' . $locale . '.description')</label>
                    <textarea type="text" name="{{ $locale }}[description]"  class="form-control ckeditor " >{{ $product->description }} </textarea>

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
                    <img src="{{ $product->image_path }}" style="width: 100px" class="img-thumbnail img_preview_class" alt="">

                </div>
                {{--    ./image      --}}

                <div class="form-group">
                    <label>@lang('site.purchase_price')</label>
                    <input type="number" name="purchase_price" step="0.01" class="form-control" value="{{ $product->purchase_price }}">
                </div>

                <div class="form-group">
                    <label>@lang('site.sale_price')</label>
                    <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ $product->sale_price }}">
                </div>

                <div class="form-group">
                    <label>@lang('site.stock')</label>
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
                </div>

            <!-- END CUSTOM TABS -->
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" ><i class="fa fa-edit"></i>{{__('site.edit')}}</button>
                </div>
            </form>
        </div>
    </div>

@stop
<!--/Main content -->
@section('scripts')
    <script>
        // method 1
        // function readURL(input) {
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();
        //
        //         reader.onload = function(e) {
        //             $('#img_preview').attr('src', e.target.result);
        //         }
        //
        //         reader.readAsDataURL(input.files[0]); // convert to base64 string
        //     }
        // }
        //
        // $("#imgInp").change(function() {
        //     readURL(this);
        // });

        // OR
        // method 2
        $('.image_class').change(function (){

            if(this.files && this.files[0]){
                var reader = new FileReader();

                reader.onload = function (e){
                    $('.img_preview_class').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]); // convert to base64 string
            }
        });
    </script>
@endsection

