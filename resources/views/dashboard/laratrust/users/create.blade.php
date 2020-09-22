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
    <li class="breadcrumb-item "><a href="{{route('dashboard.userTest.index')}}"> <i class="fas fa-users" style="color: blue;"></i> {{__('site.users')}}</a></li>
    <li class="breadcrumb-item active"><span> <i class=" fas fa-user " style="color: black;"> </i> {{__('site.create_new_user')}} </span></li>
@stop
<!-- /.content-header -->
@section('Main_content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Create a user</div>
				<div class="card-body">
					<form action="{{ route('dashboard.userTest.store') }}" method="post">
						@csrf
                        <div class="form-group">
                            <label for="">User model to assign roles/permissions</label>
                            <select  class="form-control col-md-4 target @error('model') is-invalid @enderror" name="model" id="model">
                                <option value="" >Select a user model</option>
                                @foreach($modelsKeys as $model)
                                    <option value="{{$model}}">{{$model}}</option>
                                @endforeach
                            </select>
                            <small id="model" class="form-text text-danger"></small>

                            @error('model')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror


                        </div>
                        <div class="form-group">
                            <label class="form-label">first name</label>
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror">
                            <small id="first_name" class="form-text text-danger"></small>

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div><div class="form-group">
                            <label class="form-label">last_name</label>
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"">
                            <small id="last_name" class="form-text text-danger"></small>

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
						<div class="form-group">
							<label class="form-label">Email</label>
							<input type="email" name="email" class="form-control @error('email') is-invalid @enderror"">
                            <small id="email" class="form-text text-danger"></small>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="form-label">Password</label>
								<input type="password" name="password" class="form-control @error('password') is-invalid @enderror"">
                                <small id="password" class="form-text text-danger"></small>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
							<div class="form-group col-md-6">
								<label class="form-label">Confirm Password</label>
								<input type="password" name="password_confirmation" class="form-control">
							</div>
						</div>
						<div class="form-group">
{{--							<label class="form-label">Attach role</label>--}}
{{--							<select class="form-control" name="role">--}}
{{--								@foreach($roles as $role)--}}
{{--								<option value="{{ $role->id }}">{{ $role->display_name }}</option>--}}
{{--								@endforeach--}}
{{--							</select>--}}
                            <label class="form-label">Attach role</label>
                            <div class="row justify-content-lg-start mx-auto">
                                @foreach($roles as $role)
                                    <div class="col-4">
                                        <label class="col-xs-4 text-sm p-3" >
                                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" >
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            {{-- Permissions --}}
                            <label class="form-label">Attach Permission</label>
                            <div class="row justify-content-lg-start mx-auto">
                                @foreach($permissions as $permission)
                                    <div class="col-4">
                                        <label class="col-xs-4 text-sm p-3" >
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
						</div>
						<button type="submit" class="btn btn-primary btn-sm">Create user</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
