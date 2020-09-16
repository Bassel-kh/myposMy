@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Create a new team</div>
				<div class="card-body">
					<form action="{{ route('admin.teams.update', $team) }}" method="post">
						@csrf
						@method('PATCH')
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="form-label">Team name</label>
								<input type="text" name="name" value="{{ $team->name }}" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label class="form-label">Team display name</label>
								<input type="text" name="display_name" value="{{ $team->display_name }}"  class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">Team Description</label>
							<input type="text" name="description" value="{{ $team->description }}"  class="form-control">
						</div>
						<button type="submit" class="btn btn-primary btn-sm">Update team</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection