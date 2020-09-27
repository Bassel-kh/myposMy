@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
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
            <form action="{{ route('dashboard.clients.update', $client ->id) }}" method="post" enctype="multipart/form-data" >

                {{csrf_field()}}
                {{method_field('put')}}

                <div class="form-group">
                    <label>@lang('site.name')</label>
                    <input type="text" name="name" class="form-control" value="{{ $client->name }}">
                </div>

                @for ($i = 0; $i < 2; $i++)
                    <div class="form-group">
                        <label>@lang('site.phone')</label>
                        <input type="text" name="phone[]" class="form-control" value="{{ $client->phone[$i] ?? '' }}">
                    </div>
                @endfor

                <div class="form-group">
                    <label>@lang('site.address')</label>
                    <textarea name="address" class="form-control">{{ $client->address }}</textarea>
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

