@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Permission Board</div>
                <div class="card-body">
                    <p>Permission <b>{{ $permission->display_name }}</b> was created <b>{{ $permission->created_at->diffForHumans() }}</b> and last updated <b>{{ $permission->updated_at->diffForHumans() }}</b></p>
                    <form method="post" action="{{ route('dashboard.permissions.destroy', $permission) }}">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Are you sure you want to delete this?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
