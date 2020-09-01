<!DOCTYPE html>
<html lang="ar" >
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
    <link rel="stylesheet" href="{{ asset( '/dashboard AdminLte 3_files/plugins/jqvmap/jqvmap.min.css' ) }}">
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
        @yield('content')
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
<!-- Bootstrap -->
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/bootstrap/js/bootstrap.bundle.min.js' ) }}"></script>
<!-- ChartJS -->
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/chart.js/Chart.min.js' ) }}"></script>
<!-- Sparkline -->
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/sparklines/sparkline.js' ) }}"></script>
<!-- JQVMap -->
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/jqvmap/jquery.vmap.min.js' ) }}"></script>
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/jqvmap/maps/jquery.vmap.usa.js' ) }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/jquery-knob/jquery.knob.min.js' ) }}"></script>
<!-- daterangepicker -->
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/moment/moment.min.js' ) }}"></script>
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/daterangepicker/daterangepicker.js' ) }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js' ) }}"></script>
<!-- Summernote -->
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/summernote/summernote-bs4.min.js' ) }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset( '/dashboard AdminLte 3_files/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js' ) }}"></script>
<!-- AdminLTE App -->
@if(app()->getLocale() == 'ar')
    <script src="{{ asset( '/dashboard AdminLte 3_files/dist/js/adminlte.js' ) }}"></script>
@else
    <script src="{{ asset( '/dashboard AdminLte 3_files/distEn/js/adminlte.js' ) }}"></script>
@endif
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
@if(app()->getLocale() == 'ar')
    <script src="{{ asset( '/dashboard AdminLte 3_files/dist/js/pages/dashboard.js' ) }}"></script>
@else
    <script src="{{ asset( '/dashboard AdminLte 3_files/distEn/js/pages/dashboard.js' ) }}"></script>
@endif
<!-- AdminLTE for demo purposes -->
@if(app()->getLocale() == 'ar')
    <script src="{{ asset( '/dashboard AdminLte 3_files/dist/js/demo.js' ) }}"></script>
@else
    <script src="{{ asset( '/dashboard AdminLte 3_files/distEn/js/demo.js' ) }}"></script>
@endif
</body>
</html>
