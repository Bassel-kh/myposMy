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
    <li class="breadcrumb-item active"><span> <i class=" fas fa-road " style="color: black;"></i> {{__('site.create-role')}}</span></li>
@stop
<!-- /.content-header -->
@section('Main_content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{__('site.create_new_role')}} </div>
				<div class="card-body">
					<form action="{{ route('dashboard.roles.store') }}" method="post">
						@csrf
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputEmail4">{{__('site.role_name')}} </label>
								<input type="text" name="name" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">{{__('site.display_name')}} </label>
								<input type="text" name="display_name" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="formGroupExampleInput">{{__('site.description')}}</label>
							<input type="text" name="description" class="form-control">
						</div>
						<button type="submit" class="btn btn-primary btn-sm">{{__('site.create_new_role')}} </button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
