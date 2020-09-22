@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4 col-md-8 col-lg-10">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('dashboard.roles_assignment.create') }}">Create a new user</a>

                    <div class="form-group">
                        <label for="">User model to assign roles/permissions</label>
                        <select  class="form-control col-md-3" id="">
                                <option value="initial" disabled selected>Select a user model</option>
{{--                            @foreach($models as $model)--}}
                                <option value="users">Users</option>
                                <option value="admins">Admins</option>
                                <option value="customers">Customers</option>
{{--                            @endforeach--}}
                        </select>
                    </div>
                    <table class="table table-hover my-2">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Created</th>
                                <th scope="col">Updated</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
{{--                                <td><a href="{{ route('dashboard.roles_assignment.show', $user) }}">{{ Str::limit($user->username, 25) }}</a></td>--}}
                                <td><a href="{{ route('dashboard.userTest.show', $user) }}">{{ $user->first_name }}</a></td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                @foreach($user->roles as $role)
                                    {{ $role->display_name }}
                                @endforeach
                                </td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>{{ $user->updated_at->diffForHumans() }}</td>
{{--                                <td><a href="{{ route('dashboard.userTest.edit', $user) }}" class="btn btn-primary btn-sm">Edit</a></td>--}}
                                <td><a href="{{ route('dashboard.userTest.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
