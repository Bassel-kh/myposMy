@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4 col-md-8 col-lg-10">
            <div class="card">
                <div class="card-header">Team dashboard</div>
                <div class="card-body">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.teams.create') }}">Create a new team</a>
                    <table class="table table-hover my-2">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Display name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created</th>
                                <th scope="col">Updated</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teams as $team)
                            <tr>
                                <th scope="row">{{ $team->id }}</th>
                                <td><a href="{{ route('admin.teams.show', $team) }}">{{ Str::limit($team->name, 25) }}</a></td>
                                <td>{{ $team->display_name }}</td>
                                <td>{{ $team->description }}</td>
                                <td>{{ $team->created_at->diffForHumans() }}</td>
                                <td>{{ $team->updated_at->diffForHumans() }}</td>
                                <td><a href="{{ route('admin.teams.edit', $team) }}" class="btn btn-primary btn-sm">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $teams->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection