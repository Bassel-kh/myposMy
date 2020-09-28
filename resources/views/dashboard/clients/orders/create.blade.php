@extends('layouts.dashboard-AdminLte 3.app')

@section('Header')
    <style>
        h4 a:visited {
            color: #643ab0 !important;
        }

        h4  a:hover , h4  a:active {
            color: #ffffff !important;
        }

        h4  a {
            color: #ffffff !important;
        }
    </style>
@endsection
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.clients')}}
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item "><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('dashboard.clients.index')}}"><i class=" fa fa-clients " style="color: blue;"></i> {{__('site.clients')}}</a></li>
{{--    <li class="breadcrumb-item"><a href="{{route('dashboard.orders')}}"><i class=" fa fa-clients " style="color: blue;"></i> {{__('site.clients')}}</a></li>--}}
    <li class="breadcrumb-item active"><i class=" fa fa-plus " style="color: green;"></i> {{__('site.orders')}}</li>

@stop
<!-- /.content-header -->
<!-- Main content -->
@section('Main_content')
    @php
        $dir= 'right';
        $dir_ = 'r';

        if(app()->getLocale() == 'en'){
            $dir= 'left';
            $dir_ = 'l';
        }
    @endphp


@include('partials._errors')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="card-title " style="margin-bottom: 10px">@lang('site.Categories')</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body text-{{$dir}}">

                    @foreach ($categories as $category)

                        <div class="card-group mb-2">

                            <div class="card ">

                                <div class="card-heading bg-dark rounded">
                                    <h4 class="card-title m-2">
                                        <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                    </h4>
                                </div>

                                <div id="{{ str_replace(' ', '-', $category->name) }}" class="card-collapse collapse">

                                    <div class="card-body">

                                        @if ($category->products->count() > 0)

                                            <table class="table table-hover">
                                                <tr>
                                                    <th>@lang('site.name')</th>
                                                    <th>@lang('site.stock')</th>
                                                    <th>@lang('site.price')</th>
                                                    <th>@lang('site.add')</th>
                                                </tr>

                                                @foreach ($category->products as $product)
                                                    <tr>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->stock }}</td>
                                                        <td>{{ number_format($product->sale_price, 2) }}</td>
                                                        <td>
                                                            <a href=""
                                                               id="product-{{ $product->id }}"
                                                               data-name="{{ $product->name }}"
                                                               data-id="{{ $product->id }}"
                                                               data-price="{{ $product->sale_price }}"
                                                               class="btn btn-success btn-sm add-product-btn">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </table><!-- end of table -->

                                        @else
                                            <h5>@lang('site.no_records')</h5>
                                        @endif

                                    </div><!-- end of card body -->

                                </div><!-- end of card collapse -->

                            </div><!-- end of card primary -->

                        </div><!-- end of card group -->

                    @endforeach

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col (left) -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">@lang('site.orders')</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body text-{{$dir}}">

                    <form action="{{ route('dashboard.clients.orders.store', $client->id) }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        @include('partials._errors')

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>@lang('site.product')</th>
                                <th>@lang('site.quantity')</th>
                                <th>@lang('site.price')</th>
                            </tr>
                            </thead>

                            <tbody class="order-list">


                            </tbody>

                        </table><!-- end of table -->

                        <h4>@lang('site.total') : <span class="total-price">0</span></h4>

                        <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i class="fa fa-plus"></i> @lang('site.add_order')</button>

                    </form>
                </div><!-- end of col -->
            </div>
                <!-- /.card-body -->
        </div>
            <!-- /.card -->
    </div>
        <!-- /.col (right) -->

@stop
<!--/Main content -->
@section('scripts')
    <script>
    </script>
@endsection
