
@extends('layouts.dashboard-AdminLte 3.app')
<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.create-role')}}
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
            .dataTables_length{
                float : right;
            }

        </style>

    @endif
    @if(app()->getLocale() == 'en')
        <style>
            .dataTables_filter {
                float: right !important;
            }

            .dataTables_length{
                float : left;
            }
        </style>

    @endif
    {{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

    {{--    https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css--}}
    {{--    https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css--}}
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"> <i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item "><a href="{{route('dashboard.roles.index')}}"> <i class="fas fa-traffic-light" style="color: green;"></i> {{__('site.roles')}}</a></li>
    <li class="breadcrumb-item active"><span> <i class=" fas fa-trash " style="color: black;"></i> {{__('site.delete-role')}}</span></li>
@stop
<!-- /.content-header -->
@section('Main_content')
    <div class="container" style="width: 100%;">
        <div class="row justify-content-center">
            <div class="col-sm-2 col-md-10 col-lg-12">
                <div class="card" >
                    <div class="card-header card-h-green text-white" >{{__('site.users_Dashboard')}}</div>
                    <div class="card-body">
{{--                        <a class="btn btn-primary btn-sm mb-2" href="{{ route('dashboard.userTest.create') }}">Create a new user</a>--}}
                        <div class="mb-2">
                            <!-- Button-Add trigger Add Permission modal -->

                            <button type="button" class="btn btn-sm  btn-primary" onclick="show_create_model(event.target)" id="Ajax_create_btn" >

                                <i class="fa fa-plus"></i> Ajax {{__('site.create_new_user')}}

                            </button>
                            <!-- ./ Button-Add trigger Add Permission modal -->
                        </div>

                        <div class="form-group">
                            <label for="">User model to assign roles/permissions</label>
                            <select  class="form-control col-md-3 target" id="dynamic_select">
                                <option value="" >Select a user model</option>
                                @foreach($modelsKeys as $key => $model)
                                    @if($key == 0)
                                        <option value="/dashboard/userTestAjax?model={{$model}}" data-id="{{$key}}" selected>{{$model}}</option>
                                    @else
                                        <option value="/dashboard/userTestAjax?model={{$model}}" data-id="{{$key}}" >{{$model}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <table  class="table table-hover my-2 data-table">
                            <thead>
                            <tr id="">
                                <th class="th-sm" scope="col">#</th>
                                <th class="th-sm" scope="col">id</th>
                                <th class="th-sm" scope="col">{{__('site.first_name')}}</th>
                                <th class="th-sm" scope="col">{{__('site.last_name')}}</th>
                                <th class="th-sm" scope="col">{{__('site.email')}}</th>
{{--                                <th class="th-sm" scope="col">{{__('site.roles')}}</th>--}}
{{--                                <th class="th-sm" scope="col">{{__('site.permissions')}}</th>--}}
                                <th class="th-sm" scope="col">{{__('site.created_at')}}</th>
                                <th class="th-sm" scope="col">{{__('site.updated_at')}}</th>
                                <th class="th-sm" scope="col">{{__('site.action')}}</th>
                            </tr>
                            </thead>
                            <tbody class="mb-2">

                            </tbody>

                        </table>
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
                    <h5 class="modal-title" >{{__('site.confirm_delete')}}</h5>
                </div>
                <div class="modal-body">

                    {{__('site.Are_you_sure_you_want_to').__('site.delete').'?'}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{__('site.Close')}}</button>
                    <button type="button" id="confirm_delete_btn" onclick="deleteUser(event.target)"   class="btn btn-sm  btn-danger"><i class="fa fa-trash"></i> {{__('site.confirm_delete')}}</button>
                </div>
            </div>
        </div>
    </div><!--./Delete Modal -->

    <!-- Add user Model -->
    <div class="modal fade" id="Add_Modal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"></h5>
                </div>
                <div class="modal-body">
                    <form id="form_user" action="{{ route('dashboard.userTestAjax.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="post_id">
                            <label for="">User model to assign roles/permissions</label>
                            <select  class="form-control col-md-4 target @error('model') is-invalid @enderror" name="model"  id="model">
                                <option value="" >Select a user model</option>
                                @foreach($modelsKeys as $key => $model)

                                        <option value="{{$model}}" data-id="{{$key}}" >{{$model}}</option>

                                @endforeach
                            </select>
                            <span id="modelError" class="alert-message text-danger"></span>








                        </div>
                        <div class="form-group">
                            <label class="form-label">first name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror">
                            <span id="first_nameError" class="alert-message text-danger"></span>

                        </div>

                        <div class="form-group">
                            <label class="form-label">last_name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror">
                            <span id="last_nameError" class="alert-message text-danger"></span>

                        </div>

                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror">
                            <span id="emailError" class="alert-message text-danger"></span>
                        </div>

                         <div class="form-row">
                            <div class="form-group">
                                <label class="col-xs-4 text-sm p-3" id="edit_password_div">
                                    <input type="checkbox" class="form-checkbox h-4 w-4" name="edit_password" id="edit_password" onclick="ifCheck()">
                                    Edit User Password
                                </label>
                            </div>
                        </div>
                        <div class="form-group" id="password_fields">
                            <div>
                                <label class="form-label m-2">Password</label>
                                <input type="password"  name="password" class="form-control  col-xl-6 rounded @error('password') is-invalid @enderror" onfocus="this.value=''">
                                <span id="passwordError" class="alert-message text-danger"></span>
                            </div>
                            <div>
                                <label class="form-label m-2 border-r">Confirm Password</label>
                                <input type="password"  name="password_confirmation" class="form-control  col-xl-6 rounded" onfocus="this.value=''">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6" id="password" >

                            </div>
                            <div class="form-group col-md-6" id="password_confirmation" >
                               </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Attach role</label>
                            <div class="row justify-content-lg-start mx-auto">
                                @foreach($roles as $role)
                                    <div class="col-4">
                                        <label class="col-xs-4 text-sm p-3" >
                                            <input type="checkbox" name="roles[]" id="{{$role->name}}"  value="{{ $role->id }}" >
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            {{-- Permissions --}}
                            <label class="form-label">Attach Permission</label>
                            <div class="row justify-content-lg-start mx-auto">
                                @foreach($permissions as $permission)
                                    <div class="col-4">
                                        <label class="col-xs-4 text-sm p-3" >
                                            <input type="checkbox" name="permissions[]" id="{{$permission->name}}" value="{{ $permission->id }}" >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{__('site.Close')}}</button>
                            <button type="submit" id="form_btn" class="btn btn-primary btn-sm">Create user</button>
{{--                            <button id="create_permission_btn" type="button" onclick="addPermission(event.target)" class="btn btn-primary btn-sm">{{__('site.create_new_permission')}}</button>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- ./ Add User Model -->
    </div>
    <!--Begin ///////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


    <!--End ///////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <!-- To Export datatable Excel  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- ./To Export datatable Excel  -->
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>

    {{-- ++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
    {{-- ./ +++++++++++++++++++++++++++++++++++++++++++++++++ --}}


    {{--    Ajax --}}

    <script>
        var url;
        var model="users";
        var method="POST";
        var edit = false;
        var checkBox = document.getElementById("edit_password");
        $(function(){
            // bind change event to select
            $('#dynamic_select').on('change', function () {
                url = $(this).val(); // get selected value
                if (url) { // require a URL
                    model= $(this).find(":selected").text();
                    table.ajax.url(url);
                    table.ajax.reload();
                    // console.log(model);
                }
                return false;
            });
        });

        function show_create_model(event) {
            clear_input();
            clear_check();
            clear_Error();
            var id = $(event).data("id");
            edit=false;
            $('#model option:not(:selected)').attr('disabled', false);
            $('#form_btn').html('Create user');
            $('#create_user_btn').data("id", id);
            $('#edit_password').val('');
            $('#edit_password_div').hide();
            $('#password_fields').show();
            $('#Add_Modal').modal('show');
            method='POST';

        }

        function show_delete_model(event) {
            var id = $(event).data("id");
            // console.log(id);
            $('#Delete_Modal').modal('show');
            $('#confirm_delete_btn').data("id", id);
            method='Delete';
        }

        // create user
        $("#form_user").submit(function(e) {
            e.preventDefault(); // prevent actual form submit
            let form = $(this);
            let _url = form.attr('action'); //get submit url [replace url here if desired]
            if(edit) {
                let id= $('#post_id').val();
                _url=`userTestAjax/${id}`;
            }
            $.ajax({
                type: "POST",
                method: method,
                url: _url,
                data: form.serialize(), // serializes form input
                success: function(response){
                    if (response.code === 200) {
                        if(!edit){
                            fun_toastr('success', '{{__('site.added_user_successfully')}}');
                        }else {
                            fun_toastr('success', '{{__('site.updated_successfully')}}');
                        }
                        table.ajax.reload();
                        $('#Add_Modal').modal('hide');
                        clear_input();
                        clear_check();

                    }
                },
                error: function (response) {
                    clear_Error();
                    $('#modelError').text(response.responseJSON.errors.model);
                    $('#first_nameError').text(response.responseJSON.errors.first_name);
                    $('#last_nameError').text(response.responseJSON.errors.last_name);
                    $('#emailError').text(response.responseJSON.errors.email);
                    $('#passwordError').text(response.responseJSON.errors.password);
                }
            });

            // clear_Error();
        });


        function editUser(event) {
            clear_input();
            clear_check();
            clear_Error();
            // ifCheck();
            $('#password_fields').hide();
            $('#edit_password').prop('checked', false);
            // $('#checkbox').attr('checked', false);
            $('#edit_password').val('');
            edit=true; // Edit user
            method ='PATCH'; // Form method
            let id = $(event).data("id");
            let _url = `userTestAjax/${id}/edit`;
            $('#model option:not(:selected)').attr('disabled', false);
            $("#model").val(model);
            $('#model option:not(:selected)').attr('disabled', true);
            $('#form_btn').html('Update user');
            $('#edit_password_div').show();
            $("#ModalLabel").html("{{__('site.update-user')}}");
            $.ajax({
                url: _url,
                type: "GET",
                data: {
                    "model": model,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    if (response.code === 200) {
                        let roles =response.user_roles;
                        let permissions =response.user_permissions;
                        for (let i in roles) {
                            // console.log(roles[i]);
                            $(`#${roles[i]}`).prop('checked', true);
                        }
                        for (let j in permissions) {
                            // console.log(permissions[j]);
                            $(`#${permissions[j]}`).prop('checked', true);
                        }
                        $("#post_id").val(response.user.id);
                        $("#first_name").val(response.user.first_name);
                        $("#last_name").val(response.user.last_name);
                        $("#email").val(response.user.email);
                        $('#Add_Modal').modal('show');
                    }
                },
            });
            // clear_input();
            // clear_check();
        }

        function deleteUser(event) {
            var id = $(event).data("id");
            let _url = `userTestAjax/${id}`;
            $.ajax({
                url: _url,
                type: 'POST',
                method: method,
                data: {
                    "id" : id,
                    "model" :model,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    if (response.code === 200) {
                        $("#row_" + id).remove();
                        fun_toastr('warning', '{{__('site.delete_user_successfully')}}');
                        $('#post_id').val("");
                        $('#Delete_Modal').modal('hide');
                        table.ajax.reload();
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

        function clear_input() {
            {{--document.getElementsByTagName('input').value = "";--}}
            {{--$("#ModalLabel").html('{{__('site.create_new_user')}}');--}}
            {{--$("#post_id").val('');--}}
            {{--$("#model").val("");--}}
            {{--$("#last_name").val('');--}}
            {{--$("#first_name").val('');--}}
            {{--$("#email").val('');--}}
            {{--$("#password").val('');--}}
            {{--$('#password-confirm').val('');--}}
            $("#form_user")[0].reset();

        }
        function clear_Error() {
            $("#modelError").html("");
            $("#last_nameError").html('');
            $("#first_nameError").html('');
            $("#emailError").html('');
            $("#passwordError").html('');
            $('#password-confirm').text('');
        }

        function clear_check() {
            @foreach($permissions as $permission)
            $('#{{$permission->name}}').prop('checked', false);
            @endforeach

            @foreach($roles as $role)
            $('#{{$role->name}}').prop('checked', false);
            @endforeach

        }


        var table = $('.data-table').DataTable({
            dom: 'lfrtip<"col-md-2 mx-auto " B>',
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            buttons: [
                'copyHtml5',
                'excelHtml5',
            ],

            processing: true,
            serverSide: true,
            "searchable": false,
            "scrollY": "300px",
            "scrollCollapse": true,
            "paging": true,
            ajax: "{{ route('dashboard.userTestAjax.index') }}",
            // ajax: url,

            columns: [
                {data: 'DT_RowIndex', name: '#'},
                {data: 'id', name: ''},
                {data: 'first_name', name: ''},
                {data: 'last_name',},
                {data: 'email',},
                // {data: 'roles',},
                // {data: 'permissions',},
                {data: 'created_at', name: ''},
                {data: 'updated_at', name: ''},
                {data: 'action', name: '', orderable: false, searchable: false},
            ],
            "language": {
                "loadingRecords": "{{__('site.loadingRecords')}}",
                "processing": "{{__('site.processing' )}}",
                "zeroRecords": "{{__('site.zeroRecords' )}}",
                "infoEmpty": "{{__('site.infoEmpty')}}",
                "info": "{{__('site.info' )}}",
                "search": "{{__('site.search')}}:",
                "lengthMenu": "{{__('site.lengthMenu')}}",

                "paginate": {
                    "previous": "{{__('site.previous')}}",
                    "next": "{{__('site.next')}}"

                }
            },

        });

        function ifCheck() {
            // Get the checkbox
            // var checkBox = document.getElementById("edit_password");
            // Get the output text
            let password_fields = $("#password_fields");
            let password_confirmation = $("#password_confirmation");
            let password = $("#password");

            // If the checkbox is checked, display the output text
            if (checkBox.checked === true){
                $('#edit_password').val('edit_password');
                password_fields.show();
            } else {
                $('#edit_password').val('');
                password_fields.hide();
            }
        }

    </script>
@endsection

