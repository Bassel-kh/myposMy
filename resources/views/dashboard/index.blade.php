@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->

@section('HeaderTitle')
    {{__('site.dashboard')}}
@stop

@section('Content_header_list_item')
    <li class="breadcrumb-item active"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</li>
@stop
<!-- /.content-header -->

@section('Main_content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box New Orders -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$orders}}</h3>

                        <p>{{__('site.orders')}}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('dashboard.orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div> <!-- ./ small box New Orders -->
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$categories}}<sup style="font-size: 20px">%</sup></h3>

                        <p>{{__('site.Categories')}}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$clients}}</h3>

                        <p> {{__('site.clients')}}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('dashboard.clients.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$products}}</h3>

                        <p>{{__('site.products')}}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('dashboard.products.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div>

@endsection
