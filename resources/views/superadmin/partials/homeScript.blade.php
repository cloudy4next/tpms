<script src="{{asset('assets/dashboard/')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/bootstrap.min.js"></script>
<!-- Plugin -->
<script src="{{asset('assets/dashboard/')}}/vendor/date-picker/moment.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/date-picker/daterangepicker.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/ladda-button/spin.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/ladda-button/ladda.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/ladda-button/ladda-activation.js"></script>


{{--<script src="{{asset('assets/dashboard/')}}/selectjs/select2.min.js"></script>--}}



<script src="{{asset('assets/dashboard/')}}/vendor/selectize/selectize.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/jquery.mask.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/tablesorter.min.js"></script>
<!-- Custom JavaScript -->
<script src="{{asset('assets/dashboard/js/bootstrap-notify.min.js')}}"></script>
<!-- Custom JavaScript -->
<script src="{{asset('assets/dashboard/')}}/js/custom.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fecha/2.3.1/fecha.min.js"></script>


@yield('js')


@livewireScripts
<script type="text/javascript">
    window.livewire.on('clientstore', () => {
        $('#createClient').modal('hide');
        swal("Client Successfully Created", "", "success");
    });
</script>


<script>
    jQuery(document).ready(function($) {
        $('#getdetail').click(function(event) {
            /* Act on the event */
            $('.schl_table').show();
        });
        // Recurrence
        $('#rpcheck').click(function(event) {
            $('.daily_div').toggle();
        });
        $('#dailychk').click(function(event) {
            $('.enday_div').show();
            $('.allday').hide();
        });
        $('#weeklychk').click(function(event) {
            $('.enday_div').show();
            $('.allday').show();
        });
    });

</script>


@include('superadmin.include.appoinemnt_js')


<script>
    jQuery(document).ready(function($) {


        $(document).ready(function () {
            $('input').attr('autocomplete', 'nope');
        });

        $('.daily').hide();
        $('.weekly').hide();
        $('.endate').hide();
        $('.perday').hide();
        $('.rpattern').click(function(event) {
            if ($(this).is(':checked')) {
                $('.daily').show();
                $('.weekly').show();
                $('.endate').show();
            } else {
                $('.daily').hide();
                $('.weekly').hide();
                $('.endate').hide();
                $('.perday').hide();
            }
        });
        $('.daily').click(function(event) {
            if ($(this).prop("checked", true)) {
                $('.perday').hide();
            }
        });
        $('.weekly').click(function(event) {
            if ($(this).prop("checked", true)) {
                $('.endate').show();
                $('.perday').show();
            }
        });
    });



</script>



{{--<script>--}}
{{--    $('#recurrenceop').hide();--}}
{{--    $('#chkrecurrence').click(function(event) {--}}
{{--        $('#recurrenceop').toggle();--}}
{{--        $('.perday').hide();--}}
{{--        $('#chkweek').click(function(event) {--}}
{{--            $('.perday').show();--}}
{{--        });--}}
{{--        $('#chkdaily').click(function(event) {--}}
{{--            $('.perday').hide();--}}
{{--        });--}}


{{--        if ($('#chkweek').prop('checked')){--}}
{{--            $('.perday').show();--}}
{{--        }--}}


{{--    });--}}

{{--    // window.location.href = "https://www.tutorialrepublic.com/";--}}

{{--</script>--}}

{{--<x:notify-messages />--}}
{{--@notifyJs--}}
{{--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
<script src="{{asset('assets/toastr/')}}/build/toastr.min.js"></script>

<!-- toastr init -->
<script src="{{asset('assets/toastr/')}}/toastr.init.js"></script>

@include('layouts.message')


<script type="text/javascript">
</script>
