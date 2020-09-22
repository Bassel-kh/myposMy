@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.roles_management')}}
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
    <li class="breadcrumb-item active"><span> <i class=" fas fa-edit " style="color: black;"></i> {{__('site.update-role')}}</span></li>
@stop
<!-- /.content-header -->
@section('Main_content')
<div class="row">
	<div class="col-md-8 col-lg-8 mx-auto">
		<div class="card">
			<div class="card-header">{{__('site.editing')}} {{ $role->name }} </div>
			<div class="card-body">
				<form action="{{ route('dashboard.roles.update', $role) }}" method="POST">
					@csrf
					@method('PATCH')
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="form-label">{{__('site.role_name')}}<span class="form-required">*</span></label>
								<input type="text" name="name" value="{{ $role->name }}" class="form-control" required="" readonly>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="form-label">{{__('site.display_name')}}</label>
								<input type="text" name="display_name" value="{{ $role->display_name }}"  class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label class="form-label">{{__('site.description')}}</label>
								<input type="text" name="description" value="{{ $role->description }}"  class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card mb-3">
								<div class="card-header">{{__('site.permissions')}}</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Box</th>
													<th>{{__('site.role_name')}}</th>
													<th>{{__('site.display_name')}}</th>
													<th>{{__('site.description')}}</th>
												</tr>
											</thead>
											<tbody>
												@foreach($permissions as $item)
												<tr>
													<td>
														@if(in_array($item->id, $role_permissions))
														<input type="checkbox" name="permissions[]" value="{{ $item->id }}" checked>
														@else
														<input type="checkbox" name="permissions[]" value="{{ $item->id }}">
														@endif
													</td>
													<td>{{ $item->name }}</td>
													<td>{{ $item->display_name }}</td>
													<td>{{ $item->description }}</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-footer">
						<button type="submit" class="btn btn-primary btn-sm">{{__('site.update-role')}}</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
