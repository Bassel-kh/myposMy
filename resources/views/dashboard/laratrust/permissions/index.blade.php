@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.permissions_management')}}
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
    <li class="breadcrumb-item active"><i class=" fa fa-users " style="color: blue;"></i> {{__('site.permissions')}}</li>
@stop
<!-- /.content-header -->
@section('Main_content')
<div class="container" style="width: 100%;">
    <div class="row justify-content-center">
        <div class="col-sm-2 col-md-10 col-lg-12">
            <div class="card">
                <div class="card-header">{{__('site.Permission_Dashboard')}}</div>
                <div class="card-body">
                    <div class="mb-2">
                    <a class="btn btn-primary btn-sm" href="{{ route('dashboard.permissions.create') }}">{{__('site.create_new_permission')}}</a>
                    <!-- Button-Add trigger Add Permission modal -->

                    <button type="button" class="btn btn-sm  btn-primary" id="Ajax_create_btn" data-toggle="modal" data-target="#Add_Modal">

                        <i class="fa fa-plus"></i> Ajax @lang('site.create')

                    </button>
                    <!-- ./ Button-Add trigger Add Permission modal -->
                    </div>
                    <table id="permission_table" class="table table-hover my-2 ">
                        <thead>
                            <tr>
                                <th class="th-sm" scope="col">#</th>
                                <th class="th-sm" scope="col">{{__('site.name')}}</th>
                                <th class="th-sm" scope="col">{{__('site.display_name')}}</th>
                                <th class="th-sm" scope="col">{{__('site.description')}}</th>
                                <th class="th-sm" scope="col">{{__('site.created_at')}}</th>
                                <th class="th-sm" scope="col">{{__('site.updated_at')}}</th>
                                <th class="th-sm" scope="col">{{__('site.action')}}</th>
                            </tr>
                        </thead>
                        <tbody class="mb-2">
                            @foreach($permissions as $permission)
                            <tr id="row_{{$permission->id}}">
                                <th class="th-sm" scope="row">{{ $permission->id }}</th>
{{--                                <td><a href="{{ route('dashboard.permissions.show', $permission) }}">{{ Str::limit($permission->name, 25) }}</a></td>--}}
                                <td><a href="#">{{ $permission->name }}</a></td>
                                <td>{{ $permission->display_name }}</td>
                                <td>{{ $permission->description }}</td>
                                <td>{{ $permission->created_at }}</td>
                                <td>{{ $permission->updated_at }}</td>
{{--                                <td>{{ $permission->created_at->diffForHumans() }}</td>--}}
{{--                                <td>{{ $permission->updated_at->diffForHumans() }}</td>--}}
                                <td>
                                    {{-- Ajax --}}
                                    <a href="javascript:void(0)" data-id="{{ $permission->id }}" onclick="editPermission(event.target)" class="btn btn-info btn-sm">{{__('site.edit')}}</a>
                                    <a href="javascript:void(0)" data-id="{{ $permission->id }}" class="btn btn-danger btn-sm" onclick="show_delete_model(event.target)">{{__('site.delete')}}</a>
                                    {{-- ./ Ajax --}}
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
{{--                    {{ $permissions->links() }}--}}
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
                <button type="button" id="confirm_delete_btn" onclick="deletePermission(event.target)"   class="btn btn-sm  btn-danger"><i class="fa fa-trash"></i> {{__('site.confirm_delete')}}</button>
            </div>
        </div>
    </div>
</div><!--./Delete Modal -->

<!-- Add Permission Model -->
<div class="modal fade" id="Add_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">New Permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
{{--                <form id="create_permission" >--}}
{{--                    @csrf--}}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="hidden" name="post_id" id="post_id">
                            <label class="form-label">Permission name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >
                            <span id="nameError" class="alert-message text-danger"></span>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Permission display name</label>
                            <input type="text" id="display_name" name="display_name" class="form-control" value="--">
                            <span id="display_nameError" class="alert-message text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Permission Description</label>
                        <input type="text"  id="description" name="description" class="form-control" value="--">
                        <span id="descriptionError" class="alert-message text-danger"></span>

                    </div>
            {{--                </form>--}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{__('site.Close')}}</button>
                <button id="create_permission_btn" type="button" class="btn btn-primary btn-sm">{{__('site.create_new_permission')}}</button>
            </div>
        </div>
    </div>
</div><!-- ./ Add Permission Model -->

@endsection

@section('scripts')

{{--    Ajax --}}

    <script>


        $('#permission_table').DataTable({
            "scrollY":        "300px",
            "scrollCollapse": true,
            "paging":         false,

        });


        function show_delete_model(event){
            var id  = $(event).data("id");
            $('#confirm_delete_btn').data("id",id);
            $('#Delete_Modal').modal('show');
        }

        function deletePermission(event) {
            var id  = $(event).data("id");
            let _url = `permissionsAjax/${id}`;

            $.ajax({
                url: _url,
                type: 'DELETE',
                data: {

                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    $("#row_"+id).remove();
                    fun_toastr('success','{{__('site.delete-permission')}}');
                    $('#Delete_Modal').modal('hide');
                    reload_doc();
                }
            });
        }
        $("#Ajax_create_btn").click(function() {
                $('#nameError').text('');
                $('#display_nameError').text('');
                $('#descriptionError').text('');
            }
        );

        $("#create_permission_btn").click(function() {

            // var id = $('#name').val();
            var id = $('#post_id').val();
            var name = $('#name').val();
            var description = $('#description').val();
            var display_name = $('#display_name').val();
            let _url = "{{ route('dashboard.permissionsAjax.store') }}";
            $('#nameError').text('');
            $('#display_nameError').text('');
            $('#descriptionError').text('');

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    id: id,
                    name: name,
                    display_name: display_name,
                    description: description,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    if (response.code === 200) {
                        if (id != "") {
                            $("#row_" + id + " td:nth-child(1)").html(response.data.id);
                            $("#row_" + id + " td:nth-child(2)").html('<a href="#">' + response.data.name + '</a>');
                            $("#row_" + id + " td:nth-child(3)").html(response.data.display_name);
                            $("#row_" + id + " td:nth-child(4)").html(response.data.description);

                            fun_toastr('success','{{__('site.updated_successfully')}}');
                            // reload_doc();
                            table.ajax.reload();
                        } else {
                            $('table tbody').prepend('<tr id="row_' + response.data.id + '"><td>' + response.data.id + '</td><td><a href="#">' + response.data.name + '</a></td><td>' + response.data.display_name + '</td><td>' + response.data.description + '</td><td>' + response.data.created_at + '</td><td>' + response.data.updated_at + '</td><td><a href="javascript:void(0)" data-id="' + response.data.id + '" onclick="editPermission(event.target)" class="btn btn-info btn-sm">{{__('site.edit')}}</a> <a href="javascript:void(0)" data-id="' + response.data.id + '" class="btn btn-danger btn-sm" onclick="show_delete_model(event.target)">{{__('site.delete')}}</a></td></tr>');
                            fun_toastr('success','{{__('site.added_permission_successfully')}}');
                            reload_doc();
                        }
                        $('#name').val('');
                        $('#display_name').val('--');
                        $('#description').val('--');


                        $('#Add_Modal').modal('hide');

                    }
                },
                error: function (response) {
                    $('#nameError').text(response.responseJSON.errors.name);
                    $('#display_nameError').text(response.responseJSON.errors.display_name);
                    $('#descriptionError').text(response.responseJSON.errors.description);

                }
            });
        });


        function editPermission(event) {
            var id  = $(event).data("id");
            let _url = `permissionsAjax/${id}`;
            $('#nameError').text('');
            $('#display_nameError').text('');
            $('#descriptionError').text('');

            $.ajax({
                url: _url,
                type: "GET",
                data: {
                    {{--"_token": "{{ csrf_token() }}",--}}
                },
                success: function(response) {
                    if(response) {
                        $("#post_id").val(response.id);
                        $("#name").val(response.name);
                        $("#display_name").val(response.display_name);
                        $("#description").val(response.description);
                        $('#Add_Modal').modal('show');
                        // $('#name').prop('readonly',true);
                    }
                    else{
                        $('#nameError').text('');
                        $('#display_nameError').text('');
                        $('#descriptionError').text('');

                    }

                }
            });
        }

        function fun_toastr(type, msg) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-{{$dir}}",
                "preventDuplicates": false,
                "showDuration": "3000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            toastr[type](msg)
            // toastr["info"]("My name is Inigo Montoya. You killed my father. Prepare to die!")
            // toastr["warning"]("My name is Inigo Montoya. You killed my father. Prepare to die!")
            // toastr["error"]("My name is Inigo Montoya. You killed my father. Prepare to die!")
        }

            function reload_doc(){
                location.reload(true);
            }

    </script>
@endsection

