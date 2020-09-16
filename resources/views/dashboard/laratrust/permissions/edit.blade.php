@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.permissions_management')}}
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('dashboard.permissions.index')}}"><i class=" fa fa-user-lock " style="color: green;"></i> {{__('site.permissions')}}</a></li>
    <li class="breadcrumb-item active"><i class=" fa fa-edit " style="color: grey;"></i> {{__('site.edit')}}</li>
@stop
<!-- /.content-header -->
@section('Main_content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{__('site.update').' '.__('site.permission')}}</div>
				<div class="card-body">
					<form action="{{ route('dashboard.permissions.update', $permission) }}" method="post">
						@csrf
						@method('PATCH')
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="form-label">{{__('site.permission_name')}} </label>
								<input type="text" name="name" value="{{ $permission->name }}" readonly class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label class="form-label">Permission display name</label>
								<input type="text" name="display_name" value="{{ $permission->display_name }}"  class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">Permission Description</label>
							<input type="text" name="description" value="{{ $permission->description }}"  class="form-control">
						</div>
						<button type="submit" class="btn btn-primary btn-sm">{{__('site.update-permission')}}</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
