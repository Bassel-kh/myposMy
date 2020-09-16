
@php
    $dir= 'left';
    if(app()->getLocale() == 'en'){
            $dir= 'right';
            }
@endphp
@if (session('success'))

{{--<script src="{{ asset( 'dashboard AdminLte 3_files/plugins/toastr/toastr.min.js') }}"></script>--}}

<script>

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

    toastr["success"]("{{ session('success') }}")
    // toastr["info"]("My name is Inigo Montoya. You killed my father. Prepare to die!")
    // toastr["warning"]("My name is Inigo Montoya. You killed my father. Prepare to die!")
    // toastr["error"]("My name is Inigo Montoya. You killed my father. Prepare to die!")
</script>

@endif

@if (session('fail'))

{{--    <script src="{{ asset( 'dashboard AdminLte 3_files/plugins/toastr/toastr.min.js') }}"></script>--}}

    <script>

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

        toastr["error"]("{{ session('success') }}")
        // toastr["info"]("My name is Inigo Montoya. You killed my father. Prepare to die!")
        // toastr["warning"]("My name is Inigo Montoya. You killed my father. Prepare to die!")
        // toastr["error"]("My name is Inigo Montoya. You killed my father. Prepare to die!")
    </script>

@endif



