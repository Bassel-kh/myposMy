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

    {{__('site.products')}}

@stop

@section('Content_header_list_item')

    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item active"><span><i class=" fa fa-list-alt " style="color: blue;"></i> {{__('site.products')}}</li></span>

@stop
<!-- /.content-header -->

<!-- Main content -->
@section('Main_content')
    <div class="card card-info with-border">

        <div class="card-header">
            <h3 class="card-title ">{{ __('site.products').'  '. $products->total() }} </h3>
        </div>

        <!-- /.card-header -->
        <form action="{{ route('dashboard.products.index') }}" method="get">
            <div class="row p-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"  placeholder="{{__('site.search')}}" value="{{ request()->search }}">
                </div>

                <div class="col-md-4">
                    <select name="category_id" class="form-control">
                        <option value="">@lang('site.all_categories')</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i>@lang('site.search')</button>

                    @if(auth()->user()->hasPermission('products_create'))
                        <a href="{{ route('dashboard.products.create') }}" class="btn btn-sm btn-primary "><i class="fa fa-plus"></i>@lang('site.add')</a>
                    @else
                        <a href="#" class="btn btn-sm btn-primary disabled"><i class="fa fa-plus"></i>@lang('site.add')</a>
                    @endif

                </div>
            </div>
        </form>

        <div class="card-body">
            @if(isset($products) and $products->count() > 0)
                <table class="table table-bordered table-hover text-sm">
                    <thead >
                    <tr>
                        <th>#</th>
                        <th>@lang('site.name')</th>
                        <th>@lang('site.description')</th>
                        <th>@lang('site.Category')</th>
                        <th>@lang('site.image')</th>
                        <th>@lang('site.purchase_price')</th>
                        <th>@lang('site.sale_price')</th>
                        <th>@lang('site.profit_percent') %</th>
                        <th>@lang('site.stock')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{!! $product->description !!}</td>
{{--                                <td>{{ $product->description }}</td>--}}
                                <td>{{ $product->category->name }}</td>
                                <td><img src="{{ $product->image_path }}" style="width: 100px"  class="img-thumbnail" alt=""></td>
                                <td>{{ $product->purchase_price }}</td>
                                <td>{{ $product->sale_price }}</td>
                                <td>{{ $product->profit_percent }} %</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    @if(auth()->user()->hasPermission('products_update'))

                                        <a class="btn btn-sm btn-info" href="{{ route('dashboard.products.edit', $product->id) }}"><i class="fa fa-edit"></i> {{__('site.edit')}}</a>

                                    @else
                                        <a class="btn btn-sm btn-info disabled" href="#"><i class="fa fa-edit"></i> {{__('site.edit')}}</a>
                                    @endif


                                    @if(auth()->user()->hasPermission('products_delete'))

                                            <form id="products_form_{{$product->id}} " action="{{ route('dashboard.products.destroy', $product->id ) }}" method="post" style="display: inline-block">

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
    <div class=""> {{ $products->appends(request()->query())->links() }}</div>
@stop
