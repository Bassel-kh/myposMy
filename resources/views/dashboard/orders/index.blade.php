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
    {{__('site.orders')}}
@stop
@section('Content_header_list_item')

    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item active"><i class=" fa " style="color: blue;"></i> {{__('site.orders')}}</li>

@stop
<!-- /.content-header -->

<!-- Main content -->
@section('Main_content')


    <section class="content">

        <div class="row">

            <div class="col-md-8">

                <div class="card card-primary">

                    <div class="card-header">

                        <h3 class="card-title" style="margin-bottom: 10px">@lang('site.orders') {{ $orders->total() }}</h3>

                        <form action="{{ route('dashboard.orders.index') }}" method="get">

                            <div class="row">

                                <div class="col-md-8">
                                    <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                                </div>

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                </div>

                            </div><!-- end of row -->

                        </form><!-- end of form -->

                    </div><!-- end of card header -->

                    @if ($orders->count() > 0)

                        <div class="card-body table-responsive">

                            <table class="table table-hover">
                                <tr>
                                    <th>@lang('site.client_name')</th>
                                    <th>@lang('site.price')</th>
                                    {{--                                        <th>@lang('site.status')</th>--}}
                                    <th>@lang('site.created_at')</th>
                                    <th>@lang('site.action')</th>
                                </tr>

                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->client->name }}</td>
                                        <td>{{ number_format($order->total_price, 2) }}</td>
                                        {{--<td>--}}
                                        {{--<button--}}
                                        {{--data-status="@lang('site.' . $order->status)"--}}
                                        {{--data-url="{{ route('dashboard.orders.update_status', $order->id) }}"--}}
                                        {{--data-method="put"--}}
                                        {{--data-available-status='["@lang('site.processing')", "@lang('site.finished') "]'--}}
                                        {{--class="order-status-btn btn {{ $order->status == 'processing' ? 'btn-warning' : 'btn-success disabled' }} btn-sm"--}}
                                        {{-->--}}
                                        {{--@lang('site.' . $order->status)--}}
                                        {{--</button>--}}
                                        {{--</td>--}}
                                        <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm order-products"
                                                    data-url="{{ route('dashboard.orders.products', $order->id) }}"
                                                    data-method="get"
                                            >
                                                <i class="fa fa-list"></i>
                                                @lang('site.show')
                                            </button>
                                            @if (auth()->user()->hasPermission('orders_update'))
                                                <a href="{{ route('dashboard.clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> @lang('site.edit')</a>
                                            @else
                                                <a href="#" disabled class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                            @endif

                                            @if (auth()->user()->hasPermission('orders_delete'))
                                                <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="post" style="display: inline-block;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                                </form>

                                            @else
                                                <a href="#" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i> @lang('site.delete')</a>
                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </table><!-- end of table -->

                            {{ $orders->appends(request()->query())->links() }}

                        </div>

                    @else

                        <div class="card-body">
                            <h3>@lang('site.no_records')</h3>
                        </div>

                    @endif

                </div><!-- end of card -->

            </div><!-- end of col -->

            <div class="col-md-4">

                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title" style="margin-bottom: 10px">@lang('site.show_products')</h3>
                    </div><!-- end of card header -->

                    <div class="card-body">

                        <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                            <div class="loader spinner-border text-success"></div>
                            <p style="margin-top: 10px">@lang('site.loading')</p>
                        </div>

                        <div id="order-product-list">

                        </div><!-- end of order product list -->

                    </div><!-- end of card body -->

                </div><!-- end of card -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </section><!-- end of content section -->
@stop
