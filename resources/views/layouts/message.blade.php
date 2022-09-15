{{--@if(Session::has('success'))--}}
{{--    <script>--}}
{{--        swal("{{Session::get('success')}}", "", "success");--}}
{{--    </script>--}}
{{--@endif--}}

{{--@if(Session::has('alert'))--}}
{{--    <script>--}}
{{--        swal("{{Session::get('alert')}}", "", "warning");--}}
{{--    </script>--}}
{{--@endif--}}




@if (session('success'))
    <script type="text/javascript">
        $(document).ready(function(){
            toastr["success"]("{{Session::get('success')}}.",'SUCCESS!');
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        });
    </script>
@endif

@if (session('alert'))
    <script type="text/javascript">
        $(document).ready(function(){
            toastr["error"]("{{Session::get('alert')}}.",'ALERT!');
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        });
    </script>
@endif



