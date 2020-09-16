@php
    $dir= 'left';
    $dir_ = 'r';
    if(app()->getLocale() == 'en'){
            $dir= 'right';
            $dir_ = 'l';
            }
@endphp
@extends('layouts.dashboard-AdminLte 3.app')

<!-- Content Header (Page header) -->
@section('HeaderTitle')
    {{__('site.permissions_management')}}
@stop
@section('Content_header_list_item')
    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class=" fa fa-tachometer-alt " style="color: red;"></i> {{__('site.dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('dashboard.permissions.index')}}"><i class=" fa fa-user-lock " style="color: green;"></i> {{__('site.permissions')}}</a></li>
    <li class="breadcrumb-item active"><i class=" fa fa-edit " style="color: grey;"></i> {{__('site.create')}}</li>
@stop
@section('Main_content')

    <!-- /.content-header -->
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{__('site.create_new_permission')}}</div>
				<div class="card-body">
					<form id="Permission_form" action="{{ route('dashboard.permissions.store') }}" method="post">
						@csrf
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="form-label">{{__('site.permission_name')}}</label>
                                <input id="" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >
                                <small id="name" class="form-text text-danger"></small>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

							</div>
							<div class="form-group col-md-6">
								<label class="form-label">Permission display name</label>
                                <input id="" type="text" class="form-control @error('display_name') is-invalid @enderror" name="display_name" value="{{ old('display_name') }}" >
                                <small id="display_name" class="form-text text-danger"></small>

                                @error('display_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">Permission Description</label>
                            <input id="" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" >
                            <small id="description" class="form-text text-danger"></small>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

						</div>
						<button id="submit_btn" type="submit" class="btn btn-primary btn-sm">Create new permission</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
{{--    <script src="{{ asset( 'dashboard AdminLte 3_files/plugins/toastr/toastr.min.js') }}"></script>--}}

{{--    <script>--}}
{{--        $(document).on('click','#submit_btn', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            $('#name').text('');--}}
{{--            // $('#name_ar_error').text('');--}}
{{--            // $('#name_en_error').text('');--}}
{{--            // $('#price_error').text('');--}}
{{--            // $('#details_ar_error').text('');--}}
{{--            // $('#details_en_error').text('');--}}

{{--            var formData = new FormData($('#Permission_form')[0])--}}
{{--            $.ajax({--}}
{{--                type:'post',--}}
{{--                url:"{{ route('dashboard.permissions.store') }}",--}}
{{--                --}}{{--data: {--}}
{{--                --}}{{--    _token: "{{csrf_token()}}",--}}

{{--                --}}{{--    'name': $("input[name='name']").val(),--}}
{{--                --}}{{--    'display_name': $("input[name='display_name']").val(),--}}
{{--                --}}{{--    'description': $("input[name='description']").val(),--}}

{{--                --}}{{--},--}}
{{--                data: formData ,--}}
{{--                processData: false,--}}
{{--                contentType: false,--}}
{{--                cache:false,--}}

{{--                success: function (data) {--}}
{{--                    // console.log(response);--}}
{{--                    if(data.status == true){--}}
{{--                        toastr.options = {--}}
{{--                            "closeButton": true,--}}
{{--                            "debug": false,--}}
{{--                            "newestOnTop": false,--}}
{{--                            "progressBar": true,--}}
{{--                            "positionClass": "toast-top-{{$dir}}",--}}
{{--                            "preventDuplicates": false,--}}
{{--                            "showDuration": "3000",--}}
{{--                            "hideDuration": "1000",--}}
{{--                            "timeOut": "5000",--}}
{{--                            "extendedTimeOut": "1000",--}}
{{--                            "showEasing": "swing",--}}
{{--                            "hideEasing": "linear",--}}
{{--                            "showMethod": "fadeIn",--}}
{{--                            "hideMethod": "fadeOut"--}}
{{--                        }--}}

{{--                        toastr["success"](data.msg)--}}
{{--                    }--}}

{{--                },--}}
{{--                error: function (reject) {--}}
{{--                    let response = $.parseJSON(reject.responseText);--}}
{{--                    $.each(response.errors, function (key,val){--}}
{{--                        $("#" + key + "_error").text(val[0]);--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
