@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.users')}}
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item "><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('dashboard.users.index')}}"><i class=" fa fa-users " style="color: blue;"></i> {{__('site.users')}}</a></li>
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
            <form action="{{ route('dashboard.users.update', $user->id) }}" method="post" enctype="multipart/form-data" >

                {{csrf_field()}}
                {{method_field('put')}}

                <div class="form-group" >
                    <label for="fist_name">{{__('site.first_name')}}</label>
                    <input id="fist_name" class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{ $user->first_name}}"  >
                    @error('first_name')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group ">
                    <label>{{__('site.last_name')}}</label>
                    <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ $user->last_name }}" >
                    @error('last_name')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label>{{__('site.email')}}</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ $user->email }}" >
                    @error('email')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{--    image      --}}
                <div class="form-group">
                    <label>{{__('site.image')}} </label>
                    <input id="imgInp"  class="form-control image_class  @error('image') is-invalid @enderror" type="file" name="image" >
                    @error('image')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{--    ./image      --}}

                {{--    image      --}}
                <div class="form-group">
                    <img id="img_preview" class="img-thumbnail  img_preview_class" src="{{ $user->image_path }}" style="width: 100px;" alt="not found">
                </div>
                {{--    ./image      --}}


            <?php
                $models = ['users','categories', 'products'];
                $maps = ['create', 'read', 'update', 'delete'];

                ?>


                <div class="form-group">
                    <label>{{__('site.permissions')}}</label>

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs m{{$dir_}}-auto p-2">

                            @foreach($models as $index => $model)

                                <li class="nav-item"><a class="nav-link {{$index == 0? 'active':''}}" href="#{{$model}}" data-toggle="tab">{{__('site.'.$model)}}</a></li>

                            @endforeach
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">

                        <div class="tab-content">

                            @foreach($models as $index => $model)

                                <div class="tab-pane {{$index == 0 ?'active':''}} " id="{{$model}}">

                                    @foreach($maps as $map)
                                        {{-- create_user--}}
                                        <label><input type="checkbox" class=" m{{$dir_}}-2" name="permissions[]" {{ $user->hasPermission($model.'_'.$map ) ? 'checked' : '' }} value="{{$model}}_{{$map}}">{{__('site.'.$map)}}</label>
                                    @endforeach

                                </div>
                        @endforeach
                        <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">

                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- ./ form-group -->

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

