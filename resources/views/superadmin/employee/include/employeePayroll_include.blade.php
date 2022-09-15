@section('js')
    <script>
        jQuery(document).ready(function ($) {
            $('.hrate').hide();
            $('.mrate').hide();
            $('.select_filter').change(function (event) {
                var v = $(this).val();
                if (v == 1) {
                    $('.hrate').show();
                    $('.mrate').show();
                } else if (v == 2) {
                    $('.hrate').show();
                    $('.mrate').hide();
                } else if (v == 3) {
                    $('.hrate').hide();
                    $('.mrate').show();
                } else {
                    $('.hrate').hide();
                    $('.mrate').hide();
                }
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('.loading2').hide();

            $('#all_service').multiselect({includeSelectAllOption: true});
            $("#all_service").multiselect('rebuild');


            $('.apply_all').click(function () {

            });

            // if ($('.apply_all').prop('checked') == true) {
            //     $('.multiselect-all ').click();
            // } else if ($('.apply_all').prop('checked') == false) {
            //     $('#all_service').multiselect({includeSelectAllOption: true});
            //     $("#all_service").multiselect('rebuild');
            // }


            $(document).on('click', '.apply_all', function () {
                if ($(this).prop("checked") == true) {
                    $('.multiselect-all ').click();
                } else {
                    $("#all_service").multiselect("deselectAll", true);
                    $("#all_service").multiselect('rebuild');

                }
            });


            $('#save_new').click(function (e) {
                e.preventDefault();
                $('.loading2').show();
                var ser_id = $('.all_service').val();
                var hourly_rate = $('.hourly_rate').val();
                var employee_paroll_id = $('.employee_paroll_id').val();
                var milage_rate = $('.milage_rate').val();
                // var apply_all_activity = $('.apply_all_activity').val();


                if (ser_id == null || ser_id == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Service", 'ALERT!');
                } else if (milage_rate == null || milage_rate == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please add milage", 'ALERT!');
                } else if (hourly_rate == null || hourly_rate == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please add hourly rate", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.emaployee.payroll.save') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'ser_id': ser_id,
                            'hourly_rate': hourly_rate,
                            'employee_paroll_id': employee_paroll_id,
                            'milage_rate': milage_rate,
                        },
                        success: function (data) {
                            if (data == 'done') {
                                $('.loading2').hide();
                                toastr["success"]("Staff Payroll Successfully Created", 'SUCCESS!');
                                setTimeout(function () {
                                    location.reload()
                                }, 1000)

                            }

                            if (data == 'emp') {
                                $('.loading2').hide();
                                toastr["error"]("Something goes wrong", 'ALERT!');
                            }

                        }


                    });
                }


            })


            $('.check_all').click(function () {
                if ($(this).prop("checked") == true) {
                    $('.in_check').each(function () {
                        $(this).prop("checked", true);
                    });
                } else {
                    $('.in_check').each(function () {
                        $(this).prop("checked", false);
                    });
                }
            });

            $(document).on('click', '#update_btn', function (e) {
                e.preventDefault();
                check = $('.select_filter').val();
                if (check != 0) {
                    var arr = [];
                    $('.in_check').each(function () {
                        if ($(this).prop("checked") == true) {
                            id = $(this).attr("id");
                            arr[arr.length] = id;
                        }
                    });

                    if (arr.length == 0) {
                        toastr["error"]("Please check some records to proceed!");
                    } else {

                        if (check == 1) {
                            h = $('.hourly_bulk').val();
                            h = h.trim();
                            m = $('.mileage_bulk').val();
                            m = m.trim();
                            if (h == '') {
                                toastr["error"]("Please add Hourly Rate to proceed!");
                            } else if (m == '') {
                                toastr["error"]("Please add Mileage Rate to proceed!");

                            } else {
                                $('.edit_ids').val(arr);
                                $('.custom_check').val(check);
                                $('#bulk_form').submit();
                            }
                        } else if (check == 2) {
                            h = $('.hourly_bulk').val();
                            h = h.trim();
                            if (h == '') {
                                toastr["error"]("Please add Hourly Rate to proceed!");
                            } else {
                                $('.edit_ids').val(arr);
                                $('.custom_check').val(check);
                                $('#bulk_form').submit();
                            }
                        } else if (check == 3) {
                            m = $('.mileage_bulk').val();
                            m = m.trim();
                            if (m == '') {
                                toastr["error"]("Please add Mileage Rate to proceed!");

                            } else {
                                $('.edit_ids').val(arr);
                                $('.custom_check').val(check);
                                $('#bulk_form').submit();
                            }
                        }

                    }
                }
            });


        })
    </script>


@endsection
