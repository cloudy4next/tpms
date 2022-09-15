<script>
    $(document).ready(function () {

        $('.calender_filter_reportrange').val('');

        $('.billable').change(function () {
            var bil_id = $(this).val();

            if (bil_id == 2) {
                $('.client_name').empty();
                $('.client_name').append(
                    ` <option value="0">Non-Billable Client</option>`
                );

                $('.authorization_id').empty();
                $('.authorization_id').append(
                    ` <option value="0">NONCLI01323_AUTH249</option>`
                );


                $('.client_name').prop("disabled", true);
                $('.authorization_id').prop("disabled", true);


                $('.activity_id').prop("disabled", false);


            } else {

                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.get.all.client') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        $('.client_name').empty();
                        $('.authorization_id').empty();
                        $('.client_name').prop("disabled", false);
                        $('.client_name').append(`<option ></option>`);
                        $.each(data, function (index, value) {
                            $('.client_name').append(
                                ` <option value="${value.id}">${value.text}</option>`
                            );
                        })


                    }
                });


                $('.authorization_id').prop("disabled", false);

            }


        })


        //client name
        $.ajax({
            type: "POST",
            url: "{{ route('superadmin.calender.get.all.client') }}",
            data: {
                '_token': "{{ csrf_token() }}",
            },
            success: function (data) {
                $('.calender_filter_client').prop("disabled", false);
                $('.calender_filter_client').append(`<option></option>`);
                $.each(data, function (index, value) {
                    $('.calender_filter_client').append(
                        ` <option value="${value.id}">${value.client_full_name}</option>`
                    );
                })
            }
        });


        //employee name
        $.ajax({
            type: "POST",
            url: "{{ route('superadmin.calender.get.all.empoyee') }}",
            data: {
                '_token': "{{ csrf_token() }}",
            },
            success: function (data) {
                $('.calender_filter_employee').empty();
                $('.calender_filter_employee').append(`<option></option>`);
                $.each(data, function (index, value) {
                    $('.calender_filter_employee').append(
                        ` <option value="${value.id}">${value.full_name}</option>`
                    );
                })


            }
        });

        console.log('paisi');
        $('#submit_appoinments_callender').click(function (e) {
            e.preventDefault();
            var billable = $('.billable').val();
            var client_id = $('.client_name').val();
            var authorization_id = $('.authorization_id').val();
            var activity_id = $('.activity_id').val();
            var provider_id = $('.provider_id').val();
            var location = $('.location').val();
            var time_duration = $('.time_duration').val();
            var from_time = $('.from_time').val();
            var status = $('.status').val();
            var notes = $('.notes').val();
            var chkrecurrence = $('.chkrecurrence').val();
            var end_date = $('.end_date').val();


            if ($('.daily').prop('checked')) {
                var daily = 1;
            } else {
                var daily = 0;
            }

            if ($('.weekly').prop('checked')) {
                var weekly = 1;
            } else {
                var weekly = 0;
            }


            var array_data = [];
            $(".day_name").each(function () {
                if ($(this).is(':checked')) {
                    var checked = ($(this).val());
                    array_data.push(checked);
                }
            });


            {{--$.ajax({--}}
            {{--    type: "POST",--}}
            {{--    url: "{{ route('superadmin.appoinment.save') }}",--}}
            {{--    data: {--}}
            {{--        '_token': "{{ csrf_token() }}",--}}
            {{--        'billable': billable,--}}
            {{--        'client_id': client_id,--}}
            {{--        'authorization_id': authorization_id,--}}
            {{--        'activity_id': activity_id,--}}
            {{--        'provider_id': provider_id,--}}
            {{--        'location': location,--}}
            {{--        'time_duration': time_duration,--}}
            {{--        'from_time': from_time,--}}
            {{--        'status': status,--}}
            {{--        'notes': notes,--}}
            {{--        'chkrecurrence': chkrecurrence,--}}
            {{--        'daily': daily,--}}
            {{--        'weekly': weekly,--}}
            {{--        'end_date': end_date,--}}
            {{--        'array_data': array_data,--}}
            {{--    },--}}
            {{--    success: function (data) {--}}
            {{--        console.log(data);--}}
            {{--        if (data == 'done') {--}}
            {{--            $('#createAppointement').modal('hide');--}}
            {{--            swal("Appoinment Successfully Created", "", "success");--}}
            {{--        }--}}

            {{--    }--}}
            {{--});--}}


        })

    })
</script>
