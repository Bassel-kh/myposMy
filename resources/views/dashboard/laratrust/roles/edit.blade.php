@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-6 col-lg-6 mx-auto">
		<div class="card">
			<div class="card-header">Editing {{ $role->name }} </div>
			<div class="card-body">
				<form action="{{ route('admin.roles.update', $role) }}" method="POST">
					@csrf
					@method('PATCH')
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="form-label">Rolle Navn<span class="form-required">*</span></label>
								<input type="text" name="name" value="{{ $role->name }}" class="form-control" required="">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="form-label">Visningsnavn</label>
								<input type="text" name="display_name" value="{{ $role->display_name }}"  class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label class="form-label">Description</label>
								<input type="text" name="description" value="{{ $role->description }}"  class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card mb-3">
								<div class="card-header">Permissions</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Box</th>
													<th>Navn</th>
													<th>Display Navn</th>
													<th>Description</th>
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
						<button type="submit" class="btn btn-primary btn-sm">Update role</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection