<!DOCTYPE html>
<html lang="ar" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset( 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' ) }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset( '/dashboard AdminLte 3_files/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css' ) }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset( '/dashboard AdminLte 3_files/plugins/icheck-bootstrap/icheck-bootstrap.min.css' ) }}">

    <!-- JQVMap -->
{{--    <link rel="stylesheet" href="{{ asset( '/dashboard AdminLte 3_files/plugins/jqvmap/jqvmap.min.css' ) }}">--}}
    <!-- Theme style -->
    @if(app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset( '/dashboard AdminLte 3_files/dist/css/adminlte.min.css' ) }}">
    @else
        <link rel="stylesheet" href="{{ asset( '/dashboard AdminLte 3_files/distEn/css/adminlte.min.css' ) }}">
    @endif
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset( '/dashboard AdminLte 3_files/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset( '/dashboard AdminLte 3_files/plugins/daterangepicker/daterangepicker.css' ) }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset( '/dashboard AdminLte 3_files/plugins/summernote/summernote-bs4.css' ) }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('Header')
    <!-- My Alert -->
    <link rel="stylesheet" href="{{ asset( 'dashboard AdminLte 3_files/plugins/toastr/toastr.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset( 'dashboard AdminLte 3_files/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset( 'dashboard AdminLte 3_files/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset( 'css/app.css') }}">

    <style>
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include('layouts.dashboard-AdminLte 3._navBar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('layouts.dashboard-AdminLte 3._aside')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5 class="m-0 font-weight-normal">@yield('HeaderTitle', 'Default Content')</h5>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        @if(app()->getLocale() == 'ar')
                            <ol class="breadcrumb float-sm-left">
                                @yield('Content_header_list_item')
                            </ol>
                        @else
                            <ol class="breadcrumb float-sm-right">
                                @yield('Content_header_list_item')
                            </ol>
                        @endif

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="Main_content content">
            <div class="container-fluid">
                @yield('Main_content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.Main_content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Footer Start -->
    @extends('layouts.dashboard-AdminLte 3._footer')
    <!-- Footer End -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-blue">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/jquery/jquery.min.js' ) }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/jquery-ui/jquery-ui.min.js' ) }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
@if(app()->getLocale() == 'ar')
    <script src="{{ asset( '/dashboard AdminLte 3_files/plugins/bootstrap-4-rtl/js/bootstrap.bundle.min.js' ) }}"></script>
@else
    <script src="{{ asset( '/dashboard AdminLte 3_files/plugins/bootstrap/js/bootstrap.bundle.min.js' ) }}"></script>
@endif
<!-- DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
{{--<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/datatables/jquery.dataTables.min.js' ) }}"></script>--}}
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js' ) }}"></script>
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/datatables-responsive/js/dataTables.responsive.min.js' ) }}"></script>
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/datatables-responsive/js/responsive.bootstrap4.min.js' ) }}"></script>
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js' ) }}"></script>
{{--<!-- AdminLTE App -->--}}
@if(app()->getLocale() == 'ar')
    <script src="{{ asset( '/dashboard AdminLte 3_files/dist/js/adminlte.js' ) }}"></script>
@else
    <script src="{{ asset( '/dashboard AdminLte 3_files/distEn/js/adminlte.js' ) }}"></script>
@endif
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--@if(app()->getLocale() == 'ar')--}}
{{--    <script src="{{ asset( '/dashboard AdminLte 3_files/dist/js/pages/dashboard.js' ) }}"></script>--}}
{{--@else--}}
{{--    <script src="{{ asset( '/dashboard AdminLte 3_files/distEn/js/pages/dashboard.js' ) }}"></script>--}}
{{--@endif--}}
<!-- AdminLTE for demo purposes -->
{{--@if(app()->getLocale() == 'ar')--}}
{{--    <script src="{{ asset( '/dashboard AdminLte 3_files/dist/js/demo.js' ) }}"></script>--}}
{{--@else--}}
{{--    <script src="{{ asset( '/dashboard AdminLte 3_files/distEn/js/demo.js' ) }}"></script>--}}
{{--@endif--}}
<!-- Alert-header -->
<script src="{{ asset( 'dashboard AdminLte 3_files/plugins/toastr/toastr.min.js') }}"></script>
@include('partials._alerts')
<!-- /.Alert-header -->
<!-- scripts -->
@yield('scripts')
<!--/ scripts -->
</body>
</html>
