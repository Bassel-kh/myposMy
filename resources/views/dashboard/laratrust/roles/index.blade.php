@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4 col-md-8 col-lg-10">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.roles.create') }}">Create a new role</a>
                    <table class="table table-hover my-2">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Display Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created</th>
                                <th scope="col">Updated</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <th scope="row">{{ $role->id }}</th>
                                <td><a href="{{ route('admin.roles.show', $role) }}">{{ Str::limit($role->name, 25) }}</a></td>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->created_at->diffForHumans() }}</td>
                                <td>{{ $role->updated_at->diffForHumans() }}</td>
                                <td><a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary btn-sm">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection