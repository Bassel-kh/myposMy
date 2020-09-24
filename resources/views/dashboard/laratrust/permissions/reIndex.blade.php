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
        /*div .dt-buttons{*/
        /*    float : left;*/
        /*}*/

        .dataTables_length{
            float : right;
        }
        /*.dataTables_wrapper .dt-buttons {*/
        /*    float:none;*/
        /*    text-align:center;*/
        /*}*/
        .dt-buttons{
            /*left:20%;*/
        }

    </style>

    @endif
    @if(app()->getLocale() == 'en')
        <style>
            .dataTables_filter {
                float: right !important;
            }

            /*.dt-buttons{*/
            /*    left:25%;*/
            /*}*/

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
    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item active"><i class=" fa fa-users " style="color: blue;"></i> {{__('site.permissions')}}</li>
@stop
<!-- /.content-header -->
@section('Main_content')
{{--    --}}

<div class="container" style="width: 100%;">
    <div class="row justify-content-center">
        <div class="col-sm-2 col-md-10 col-lg-12">
            <div class="card">
                <div class="card-header">{{__('site.Permission_Dashboard')}}</div>
                <div class="card-body">
                    <div class="mb-2">
                    <a class="btn btn-primary btn-sm" href="{{ route('dashboard.permissions.create') }}">{{__('site.create_new_permission')}}</a>
                    <!-- Button-Add trigger Add Permission modal -->

                    <button type="button" class="btn btn-sm  btn-primary"onclick="show_create_model(event.target)" id="Ajax_create_btn" >

                        <i class="fa fa-plus"></i> Ajax @lang('site.create')

                    </button>
                    <!-- ./ Button-Add trigger Add Permission modal -->
                    </div>
                    <table  class="table table-hover my-2 data-table">
                        <thead>
                            <tr id="">
                                <th class="th-sm" scope="col">#</th>
                                <th class="th-sm" scope="col">id</th>
                                <th class="th-sm" scope="col">{{__('site.name')}}</th>
                                <th class="th-sm" scope="col">{{__('site.display_name')}}</th>
                                <th class="th-sm" scope="col">{{__('site.description')}}</th>
                                <th class="th-sm" scope="col">{{__('site.create')}}</th>
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
                <h5 class="modal-title" id="ModalLabel"></h5>
            </div>
            <div class="modal-body">
                <form id="create_permission" >
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="hidden" name="post_id" id="post_id">
                            <label class="form-label">{{__('site.permission_name')}}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >
                            <span id="nameError" class="alert-message text-danger"></span>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('site.display_name')}}</label>
                            <input type="text" id="display_name" name="display_name" class="form-control" value="--">
                            <span id="display_nameError" class="alert-message text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{__('site.description')}}</label>
                        <input type="text"  id="description" name="description" class="form-control" value="--">
                        <span id="descriptionError" class="alert-message text-danger"></span>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{__('site.Close')}}</button>
                <button id="create_permission_btn" type="button" onclick="addPermission(event.target)" class="btn btn-primary btn-sm">{{__('site.create_new_permission')}}</button>
            </div>
        </div>
    </div>
</div><!-- ./ Add Permission Model -->
<!--Begin ///////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<!--End ///////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

@endsection

@section('scripts')
{{--    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>--}}
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>

<!-- To Export datatable Excel  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<!-- ./To Export datatable Excel  -->
<!-- To Export datatable PDF  -->
        {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>--}}
        {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>--}}

        {{--<script src="{{asset('js/pdfmake.min.js')}}"></script>--}}
        {{--<script src="{{asset('js/vfs_fonts.js')}}"></script>--}}
<!-- ./ To Export datatable PDF  -->
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>


{{-- ++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
{{-- ./ +++++++++++++++++++++++++++++++++++++++++++++++++ --}}


{{--    Ajax --}}

    <script>

            var table = $('.data-table').DataTable({
                // dom: 'lfrtip<"row"<"col-md-10 offset-md-2 text-center center-block"B>>',
                dom: 'lfrtip<"col-md-2 mx-auto " B>',
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                // dom: 'Bfrtip',

                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                ],

                // buttons: [
                //     'copyHtml5',
                //     'excelHtml5',
                //     //PDF
                //     // {
                //     //     extend: 'pdf',
                //     //     text: 'PDF',
                //     //     customize: function (doc) {
                //     //          doc.defaultStyle =
                //     //             {
                //     //                  // font: 'ِAmiri',
                //     //             };
                //     //     },
                //     //     titleAttr: 'Generate PDF',
                //     //     className: 'btn-outline-danger btn-sm ',
                //     //     exportOptions: {
                //     //         columns: ':not(.select-checkbox)',
                //     //         orthogonal: "myExport",
                //     //         modifier: { order: 'index', page: 'current' }
                //     //     },
                //     // },
                // ],
                processing: true,
                serverSide: true,
                "searchable": false,
                "scrollY": "300px",
                "scrollCollapse": true,
                "paging": true,
                ajax: "{{ route('dashboard.permissionsReAjax.index') }}",

                columns: [
                    {data: 'DT_RowIndex', name: '#'},
                    {data: 'id', name: ''},
                    {data: 'name', name: ''},
                    {data: 'display_name',},
                    {data: 'description',},
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

                // columnDefs: [
                // //revese arabic words for pdf exporting
                //     {
                //         // target columns to reverse words
                //         targets: [2,3,4],
                //         render: function (data, type, row) {
                //             if (type === 'myExport') {
                //                 return data.split(' ').reverse().join(' ');
                //             }
                //             return data;
                //         }
                //     }],

                // columnDefs: [
                //     {
                //         targets: [2,3,4],
                //         className: 'dt-center'
                //     }],
        });
            function show_delete_model(event) {
                var id = $(event).data("id");
                // console.log(id);
                $('#Delete_Modal').modal('show');
                $('#confirm_delete_btn').data("id", id);
            }

            function show_create_model(event) {
                clear_input();
                var pr_btn=$('#create_permission_btn');
                var id = $(event).data("id");
                $('#create_permission_btn').data("id", id);
                $('#create_permission_btn').html('{{__("site.create_new_permission")}}');
                $('#Add_Modal').modal('show');
            }

            function deletePermission(event) {
                var id = $(event).data("id");
                let _url = `permissionsReAjax/${id}`;

                $.ajax({
                    url: _url,
                    type: 'DELETE',
                    data: {

                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        $("#row_" + id).remove();
                        fun_toastr('success', '{{__('site.delete-permission')}}');
                        $('#post_id').val("");
                        $('#Delete_Modal').modal('hide');
                        table.ajax.reload();
                    }
                });
            }

            $("#Ajax_create_btn").click(function () {
                    $('#nameError').text('');
                    $('#display_nameError').text('');
                    $('#descriptionError').text('');
                }
            );

            function addPermission(event) {
                var id = $('#post_id').val();
                var name = $('#name').val();
                var description = $('#description').val();
                var display_name = $('#display_name').val();
                let _url = "{{ route('dashboard.permissionsReAjax.store') }}";
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
                                fun_toastr('success', '{{__('site.updated_successfully')}}');
                                table.ajax.reload();
                            } else {
                                fun_toastr('success', '{{__('site.added_permission_successfully')}}');
                                table.ajax.reload();
                            }
                            $('#name').val('');
                            $('#display_name').val('--');
                            $('#description').val('--');
                            $('#post_id').val("");

                            $('#Add_Modal').modal('hide');

                        }
                    },
                    error: function (response) {
                        $('#nameError').text(response.responseJSON.errors.name);
                        $('#display_nameError').text(response.responseJSON.errors.display_name);
                        $('#descriptionError').text(response.responseJSON.errors.description);

                    }
                });
            }


            function editPermission(event) {
                $('#create_permission_btn').html('{{__("site.update-permission")}}');

                var id = $(event).data("id");
                let _url = `permissionsReAjax/${id}`;
                // clear_input();
                $("#ModalLabel").html("{{__('site.update-permission')}}");

                $.ajax({
                    url: _url,
                    type: "GET",
                    data: {
                        {{--"_token": "{{ csrf_token() }}",--}}
                    },
                    success: function (response) {
                        if (response) {
                            $("#post_id").val(response.id);
                            $("#name").val(response.name);
                            $("#display_name").val(response.display_name);
                            $("#description").val(response.description);
                            $('#Add_Modal').modal('show');
                            $('#name').prop('readonly', true);
                            table.ajax.reload();
                        } else {
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

            function reload_doc() {
                location.reload(true);
            }


            function clear_input() {
                $("#ModalLabel").html('{{__('site.create_new_permission')}}');
                $('#name').prop('readonly', false);
                $("#post_id").val('');
                $("#name").val('');
                $("#display_name").val('');
                $("#description").val('');
                $('#nameError').text('');
                $('#display_nameError').text('');
                $('#descriptionError').text('');
            }
    </script>
<!--Begin ///////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!--End ///////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

@endsection

