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

        </style>
    @endif
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"> <i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item "><a href="{{route('dashboard.roles.index')}}"> <i class="fas fa-traffic-light" style="color: green;"></i> {{__('site.roles')}}</a></li>
    <li class="breadcrumb-item active"><span> <i class=" fas fa-trash " style="color: black;"></i> {{__('site.delete-role')}}</span></li>
@stop
<!-- /.content-header -->
@section('Main_content')
<div class="container">
    <div class="row justify-content-center">
        <div >
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('dashboard.userTest.create') }}">Create a new user</a>

                    <div class="form-group">
                        <label for="">User model to assign roles/permissions</label>
                        <select  class="form-control col-md-3 target" id="dynamic_select">
                                <option value="initial" >Select a user model</option>
                            @foreach($modelsKeys as $model)
                                <option value="/dashboard/userTest?model={{$model}}">{{$model}}</option>
                            @endforeach
                        </select>
                    </div>
                    <table class="table table-hover my-2">
                        <thead>
                            <tr>
                                <th class="th-sm" scope="col">#</th>
                                <th class="th-sm" scope="col">First name</th>
                                <th class="th-sm" scope="col">Last Name</th>
                                <th class="th-sm" scope="col">Email</th>
                                <th class="th-sm" scope="col">Roles</th>
                                <th class="th-sm" scope="col">Created</th>
                                <th class="th-sm" scope="col">Updated</th>
                                <th class="th-sm" scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr id="row_{{$user->id}}">
                                <th>{{ $user->id }}</th>
{{--                                <td><a href="{{ route('dashboard.userTest.show', $user) }}">{{ Str::limit($user->username, 25) }}</a></td>--}}
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
                                <td><a href="{{ route('dashboard.userTest.edit',[$user->id, 'model'=>$modelKey]) }}" class="btn btn-primary btn-sm"><span><i class="fas fa-edit"></i> {{ __('site.edit') }}</span></a></td>
                                  <td>
                                        <a  class="btn btn-danger btn-sm delete"  id="model_show_btn" data-id="{{$user->id}}" onclick="show_delete_model(event.target)"  >
                                           <i class="fas fa-trash"></i> {{ __('site.delete') }}
                                        </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
{{--                    {{ $users->links() }}--}}
                    @if ($modelKey)
                        {{ $users->appends(['model' => $modelKey])->links() }}
                    @endif

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
                <button id="confirm_delete_btn" type="button" class="btn btn-danger btn-sm" onclick="deleteUser(event.target)">{{__('site.confirm_delete')}}</button>

            </div>
        </div>
    </div>
</div><!--./Delete Modal -->

@endsection
@section('scripts')
    <script>

        // $( ".target" ).change(function() {
        //     // alert( "Handler for .change() called." );
        //     let model =$( "#target option:selected" ).val();
        //     // console.log(model);
        //     $.get( `/dashboard/userTest/index?model=${model}`);
        //
        //
        // });

        $(function(){
            // bind change event to select
            $('#dynamic_select').on('change', function () {
                var url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location = url; // redirect
                }
                return false;
            });
        });



        function show_delete_model(event){
            let id  = $(event).data("id");
            if(typeof id === 'undefined'){
                // id  = $(event).data("id");
                console.log(id);
            }else {
                // console.log(id);
                $('#confirm_delete_btn').data("id", id);
                $('#Delete_Modal').modal('show');
            }
        }

        function deleteUser(event) {
            // var id  = $(event).attr("id");
            let id = $('#confirm_delete_btn').data('id');
            // console.log(id);
            let _url = `userTest/${id}`;

                $.ajax({
                    url: _url,
                    type: 'POST',
                    method: 'Delete',
                    data: {
                        "model": "{{$modelKey}}",
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        $("#row_" + id).remove();
                        fun_toastr('success', '{{__('site.delete-permission')}}');
                        $('#Delete_Modal').modal('hide');
                        // reload_doc();
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
