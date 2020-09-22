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
    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item active"><span> <i class="fas fa-traffic-light" style="color: green;"> </i> {{__('site.roles')}} </span></li>
@stop
<!-- /.content-header -->
@section('Main_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4 col-md-8 col-lg-10">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <a class="btn btn-primary btn-sm" href="{{ route('dashboard.roles.create') }}">{{__('site.create_new_role')}}</a>
                    <table class="table table-hover my-2">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th class="th-sm" scope="col">{{__('site.name')}}</th>
                                <th class="th-sm" scope="col">{{__('site.display_name')}}</th>
                                <th class="th-sm" scope="col">{{__('site.description')}}</th>
                                <th class="th-sm" scope="col">{{__('site.created_at')}}</th>
                                <th class="th-sm" scope="col">{{__('site.updated_at')}}</th>
                                <th class="th-sm" scope="col">{{__('site.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <th scope="row">{{ $role->id }}</th>
                                <td><a href="{{ route('dashboard.roles.show', $role) }}">{{ Str::limit($role->name, 25) }}</a></td>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->created_at->diffForHumans() }}</td>
                                <td>{{ $role->updated_at->diffForHumans() }}</td>
                                <td><a href="{{ route('dashboard.roles.edit', $role) }}" class="btn btn-primary btn-sm"><span><i class="fas fa-edit"></i> {{__('site.edit')}}</span></a></td>
                                <td>
{{--                                    <a href="{{ route('dashboard.roles.destroy', $role) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> {{__('site.delete')}} </a>--}}
                                    <form id="delete_role_form_{{$role->id}}" method="post" action="{{ route('dashboard.roles.destroy', $role) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-id="{{$role->id}}" data-target="#Delete_Modal" onclick="deleteRole(event.target)">
                                            <i class="fas fa-trash"></i> {{__('site.delete')}}
                                        </button>
{{--                                        <button  type="submit" onclick="" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>{{__('site.delete')}}</button>--}}
                                    </form>
                                </td>
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

<!-- Delete Modal -->
<div class="modal fade" id="Delete_Modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{__('site.confirm_delete')}}</h5>
            </div>
            <div class="modal-body">

                {{__('site.Are_you_sure_you_want_to').__('site.delete').'?'}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{__('site.Close')}}</button>
                <button type="submit" form="" id="confirm_delete_btn"   class="btn btn-sm  btn-danger"><i class="fa fa-trash"></i> {{__('site.confirm_delete')}}</button>
            </div>
        </div>
    </div>
</div><!--./Delete Modal -->

@endsection

@section('scripts')
    <script>
        function deleteRole(event) {
            var id = $(event).data("id");
            var form_id = `delete_role_form_${id}`;
            $('#confirm_delete_btn').attr('form',form_id);
        }
    </script>
@endsection

