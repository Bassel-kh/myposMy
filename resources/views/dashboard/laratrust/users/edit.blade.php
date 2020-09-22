@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.create-role')}}
    @php
        $dir= 'left';
        if(app()->getLocale() == 'en'){
                $dir= 'right';
                }
    @endphp
    @if(app()->getLocale() == 'ar')
        <style>

            .dataTables_filter {
                float: left !important;
            }
        </style>
    @endif
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"> <i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item "><a href="{{route('dashboard.roles.index')}}"> <i class="fas fa-traffic-light" style="color: green;"></i> {{__('site.roles')}}</a></li>
    <li class="breadcrumb-item active"><span> <i class=" fas fa-trash " style="color: black;"></i> {{__('site.delete-role')}}</span></li>
@stop
<!-- /.content-header -->
@section('Main_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update a user ( model : {{$modelKey}} )</div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.userTest.update', $user->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="model" value="{{$modelKey}}">
                            <div class="form-group">
                                <label >First Name</label>
                                <input type="text" class="form-control" name="first_name"  value="{{ $user->first_name }}">
                            </div>

                            <div class="form-group">
                                <label >Last Name</label>
                                <input type="text" class="form-control" name="last_name"  value="{{ $user->last_name }}">
                            </div>

                            <div class="form-group">
                                <label >Email</label>
                                <input type="email" class="form-control" name="email"  value="{{ $user->email }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                     <label class="col-xs-4 text-sm p-3" >
                                         Edit User Password
                                        <input type="checkbox" class="form-checkbox h-4 w-4" name="edit_password" id="edit_password" onclick="ifCheck()">
                                     </label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6" id="password" style="display:none">
                                    <label for="inputEmail4">Password</label>
                                    <input type="password"  name="password" class="form-control" >
                                </div>
                                <div class="form-group col-md-6" id="password_confirmation" style="display:none">
                                    <label for="inputPassword4">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" >
                                </div>
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label">Attach role</label>--}}
{{--                                <select class="form-control" name="role">--}}
{{--                                    @foreach($roles as $role)--}}
{{--                                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
                        <!-- Begin ////////////////////////////////////////////////// -->
                            <!-- Roles -->
                            <span class="">Roles</span>
                            <div class="row justify-content-lg-start mx-auto">
                                @foreach($roles as $item)
                                    <div class="col-4">
                                        <label class="col-xs-4 text-sm p-3" >
                                            @if(in_array($item -> id , $user_roles))
                                                <input type="checkbox" class="form-checkbox h-4 w-4" name="roles[]" value="{{$item -> id}}" checked>
                                            @else
                                                <input type="checkbox" class="form-checkbox h-4 w-4" name="roles[]" value="{{$item -> id}}" >
                                            @endif
                                                <span class="ml-2">{{$item -> name}}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <!-- ./ Roles -->

                            <!-- Permissions -->
                            <span class="">Permissions</span>
                            {{--<div class="row justify-content-around mx-auto">--}}
                            <div class="row justify-content-lg-start mx-auto">
                                @foreach($permissions as $item)
                                    <div class="col-4">
                                        <label class="col-xs-4 text-sm p-3" >
                                            @if(in_array($item -> id , $user_permissions))
                                                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="{{$item -> id}}" checked>
                                            @else
                                                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="{{$item -> id}}" >
                                            @endif
                                                <span class="ml-2">{{$item -> name}}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <!-- ./ Permissions -->
                            <!-- End /////////////////////////////////////////////////// -->

                            <button type="submit" class="btn btn-primary btn-sm">Save edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    function ifCheck() {
        // Get the checkbox
        var checkBox = document.getElementById("edit_password");
        // Get the output text
        var password_confirmation = document.getElementById("password_confirmation");
        var password = document.getElementById("password");
        console.log(password);
        console.log(password_confirmation);

        // If the checkbox is checked, display the output text
        if (checkBox.checked == true){
            $('#edit_password').val('edit_password');
            password.style.display = "block";
            password_confirmation.style.display = "block";
        } else {
            $('#edit_password').val('');
            password.style.display = "none";
            password_confirmation.style.display = "none";
        }
    }
</script>
@endsection

