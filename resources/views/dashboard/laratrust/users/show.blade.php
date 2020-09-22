@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">User Board</div>
				<div class="card-body">
					<p>
{{--						User <b>{{ $user->email }}</b> was created <b>{{ $user->created_at }}</b> and last updated <b>{{ $user->updated_at}}</b>--}}
					</p>
{{--					<form method="post" action="{{ route('dashboard.usersLara.destroy', $user) }}">--}}
{{--						@csrf--}}
{{--						@method('delete')--}}
{{--						<button onclick="return confirm('Are you sure you want to delete this?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>Delete</button>--}}
{{--					</form>--}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
