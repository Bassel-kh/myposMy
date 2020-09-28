@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
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
@stop
@section('HeaderTitle')
    {{__('site.clients')}}
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item "><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('dashboard.clients.index')}}"><i class=" fa fa-clients " style="color: blue;"></i> {{__('site.clients')}}</a></li>
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

            @include('partials._errors')

            <section class="content">

                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-primary">

                            <div class="card-header">

                                <h3 class="card-title" style="margin-bottom: 10px">@lang('site.categories')</h3>

                            </div><!-- end of card header -->

                            <div class="card-body">

                                @foreach ($categories as $category)

                                    <div class="panel-group">

                                        <div class="panel panel-info">

                                            <div class="panel-heading bg-dark rounded">
                                                <h4 class="panel-title  m-2">
                                                    <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                                </h4>
                                            </div>

                                            <div id="{{ str_replace(' ', '-', $category->name) }}" class="panel-collapse collapse">

                                                <div class="panel-body">

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
                                                                    <td>{{ $product->sale_price }}</td>
                                                                    <td>
                                                                        <a href=""
                                                                           id="product-{{ $product->id }}"
                                                                           data-name="{{ $product->name }}"
                                                                           data-id="{{ $product->id }}"
                                                                           data-price="{{ $product->sale_price }}"
                                                                           class="btn {{ in_array($product->id, $order->products->pluck('id')->toArray()) ? 'btn-default disabled' : 'btn-success add-product-btn' }} btn-sm">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </table><!-- end of table -->

                                                    @else
                                                        <h5>@lang('site.no_records')</h5>
                                                    @endif

                                                </div><!-- end of panel body -->

                                            </div><!-- end of panel collapse -->

                                        </div><!-- end of panel primary -->

                                    </div><!-- end of panel group -->

                                @endforeach

                            </div><!-- end of card body -->

                        </div><!-- end of card -->

                    </div><!-- end of col -->

                    <div class="col-md-6">

                        <div class="card card-primary">

                            <div class="card-header">

                                <h3 class="card-title">@lang('site.orders')</h3>

                            </div><!-- end of card header -->

                            <div class="card-body">

                                @include('partials._errors')

                                <form action="{{ route('dashboard.clients.orders.update', ['order' => $order->id, 'client' => $client->id]) }}" method="post">

                                    {{ csrf_field() }}
                                    {{ method_field('put') }}

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>@lang('site.product')</th>
                                            <th>@lang('site.quantity')</th>
                                            <th>@lang('site.price')</th>
                                        </tr>
                                        </thead>

                                        <tbody class="order-list">

                                        @foreach ($order->products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td><input type="number" name="products[{{ $product->id }}][quantity]" data-price="{{ number_format($product->sale_price, 2) }}" class="form-control input-sm product-quantity" min="1" value="{{ $product->pivot->quantity }}"></td>
                                                <td class="product-price">{{ number_format($product->sale_price * $product->pivot->quantity, 2) }}</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm remove-product-btn" data-id="{{ $product->id }}"><span class="fa fa-trash"></span></button>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>

                                    </table><!-- end of table -->

                                    <h4>@lang('site.total') : <span class="total-price">{{ number_format($order->total_price, 2) }}</span></h4>

                                    <button class="btn btn-primary btn-block" id="form-btn"><i class="fa fa-edit"></i> @lang('site.edit_order')</button>

                                </form><!-- end of form -->

                            </div><!-- end of card body -->

                        </div><!-- end of card -->

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </section><!-- end of content -->
        </div><!-- end of card body -->
    </div>

    <div class="row">
        <div class="col-md-6"></div>
        <div class="card-body col-md-6 text-{{$dir}}">
            @if ($orders->count() > 0)
                <div class="card-group mb-2">

                    <div class="card ">
                        <div class="card-heading bg-gradient-success rounded">
                            <h4 class="card-title m-2">
                                @lang('site.previous_orders')
                                <small>{{ $orders->total() }}</small>
                            </h4>
                        </div>

                        <div class="card-body">

                            @foreach ($orders as $order)

                                <div class="card-group">

                                    <div class="card card-success">

                                        <div class="card-heading rounded bg-gradient-gray">
                                            <h4 class="card-title m-2" >
                                                <a data-toggle="collapse" href="#_{{ $order->id }}" >{{ $order->created_at->toFormattedDateString() }}</a>

                                            </h4>
                                        </div>

                                        <div id="_{{ $order->id }}" class="card-collapse collapse">

                                            <div class="card-body">
                                                <ul class="list-group">
                                                    @foreach ($order->products as $product)
                                                        <li class="list-group-item text-center">{{ $product->name }}</li>
                                                    @endforeach
                                                </ul>

                                            </div><!-- end of card body -->

                                        </div><!-- end of card collapse -->

                                    </div><!-- end of card primary -->

                                </div><!-- end of card group -->

                            @endforeach

                            {{ $orders->links() }}

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div>
            @endif
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

