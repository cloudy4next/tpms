@section('js')
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridDay',
                timeZone: 'EST',
                editable: false,
                displayEventTime: true,
                headerToolbar: {
                    left: 'prevYear,prev,next,nextYear today',
                    center: 'title',
                    right: 'dayGridDay,timeGridWeek,dayGridMonth'
                },
                dateClick: function (info) {
                    $('#createAppointement').modal("show");
                    let selectedDate = '';
                    if (info.view.type === 'dayGridMonth') {
                        selectedDate = info.dateStr + 'T00:00'
                    } else {
                        selectedDate = info.dateStr.slice(0, 16);
                    }
                    $('.calendar-date-time').val(selectedDate)
                },
                eventTimeFormat: { // like '14:30:00'
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                },

                events: function (info, callback) {

                    $('#calender_go_btn').click(function () {
                        $('.is_clicked').val(1);
                    })

                    var is_click = $('.is_clicked').val();
                    console.log(is_click)
                    $('.loading2').show();
                    if (is_click == 0) {
                        $('.loading2').show();
                        $.ajax({
                            url: "{{ route('client.get.mycalender.data') }}",

                            data: {
                                // our hypothetical feed requires UNIX timestamps
                                start: info.start.valueOf(),
                                end: info.end.valueOf(),
                            },
                            success: function (doc) {

                                // console.log(doc)
                                // console.log('not clicked')

                                callback(doc);
                                $('.loading2').hide();
                            }
                        });
                    }


                    $('#calender_go_btn').click(function () {
                        $('.loading2').show();
                        var calender_filter_client = $('.calender_filter_client').val();
                        var calender_filter_employee = $('.calender_filter_employee').val();
                        var calender_filter_location = $('.calender_filter_location').val();
                        var calender_filter_reportrange = $('.calender_filter_reportrange')
                            .val();
                        var calender_filter_status = $('.calender_filter_status').val();


                        $.ajax({
                            url: "{{ route('client.get.mycalender.data.filter') }}",

                            data: {
                                'calender_filter_client': calender_filter_client,
                                'calender_filter_employee': calender_filter_employee,
                                'calender_filter_location': calender_filter_location,
                                'calender_filter_reportrange': calender_filter_reportrange,
                                'calender_filter_status': calender_filter_status,
                                'start': info.start.valueOf(),
                                'end': info.end.valueOf(),
                                backgroundColor: 'red',
                            },
                            success: function (doc) {
                                calendar.refetchEvents()
                                calendar.removeAllEventSources()
                                calendar.addEventSource(doc)
                                callback(doc);
                                $('.loading2').hide();
                            }
                        });
                    })


                },
                eventDrop: function (info) {
                    var strt_time = info.event.start;
                    var time = moment(strt_time).format("YYYY-MM-DD h:mm:ss");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('client.mycalender.session.drop') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'id': info.event.id,
                            'from_time': time,
                        },
                        success: function (data) {
                            // console.log(data);
                        }
                    });
                },
                eventClick: function (info) {


                    if (info.view.type == "dayGridMonth") {

                    } else if (info.view.type == "timeGridWeek") {

                    } else if (info.view.type == "dayGridDay") {

                    } else {

                    }


                    $.ajax({
                        type: "POST",
                        url: "{{ route('client.get.calender.data.single') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'id': info.event.id,
                        },
                        success: function (data) {

                            console.log(data)
                            // var time = moment(new Date(data.from_time)).format(
                            //     'YYYY-MM-DDThh:mm:ss.SSS');

                            var time = moment(new Date(data.from_time)).format(
                                'MM/DD/YYYY hh:mm A');

                            $('#accccc').prop('checked', true);
                            var client = $('.client_name').val(data.client_id);
                            $('.c_id').empty().val(data.client_id);
                            $('.auth_id').empty().val(data.authorization_id);
                            $('.act_id').empty().val(data.authorization_activity_id);
                            $('.prov_id').empty().val(data.provider_id);
                            $('.location').val(data.location);
                            $('.time_duration').val(data.time_duration);
                            $('.from_time').val(time);
                            // $('.from_time').val("2013-03-18T13:00");
                            // $('.from_time').val(data.from_time);
                            $('.status').val(data.status);
                            $('.notes').val(data.notes);
                            getClientData();
                            getData();
                            getDataAct();
                            getDataEmployee();
                            $('.authorization_id').val(data.authorization_id);
                            $('#createAppointement').modal("show");
                            $('.callender_edit_single').val(data.id);


                        }
                    });


                    function getClientData() {
                        var client_id = $('.c_id').val();
                        $.ajax({
                            type: "POST",
                            url: "{{ route('client.calender.client.get') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'client_id': client_id,
                            },
                            success: function (data) {
                                $('.client_name').empty();
                                $('.client_name').append(
                                    ` <option value="${data.id}" >${data.client_full_name}</option>`
                                );


                            }
                        });
                    }

                    function getData(a_id) {
                        var client_id = $('.c_id').val();
                        var au_id = $('.auth_id').val();
                        $.ajax({
                            type: "POST",
                            url: "{{ route('client.calender.autho.get') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'client_id': client_id,
                            },
                            success: function (data) {
                                console.log(data);
                                $('.authorization_id').empty();
                                $('.authorization_id').append(
                                    `<option value="0"></option>`);
                                $.each(data, function (index, value) {
                                    $('.authorization_id').append(
                                        ` <option value="${value.id}" >${value.authorization_name}</option>`
                                    );
                                });

                                $('.authorization_id').val(au_id);


                            }
                        });
                    }

                    function getDataAct() {
                        var auth_id = $('.auth_id').val();
                        var act_id = $('.act_id').val();
                        $.ajax({
                            type: "POST",
                            url: "{{ route('client.calender.autho.activity.get') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'auth_id': auth_id,
                            },
                            success: function (data) {
                                $('.activity_id').empty();
                                $('.activity_id').append(`<option value="0"></option>`);
                                $.each(data, function (index, value) {
                                    $('.activity_id').append(
                                        ` <option value="${value.id}">${value.activity_name}</option>`
                                    );
                                });

                                $('.activity_id').val(act_id);

                            }
                        });
                    }

                    function getDataEmployee() {
                        var prov_id = $('.prov_id').val();
                        $.ajax({
                            type: "POST",
                            url: "{{ route('client.calender.get.all.provider') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                            },
                            success: function (data) {

                                $('.provider_id').empty();
                                $('.provider_id').append(`<option value="0"></option>`);
                                $.each(data, function (index, value) {
                                    $('.provider_id').append(
                                        ` <option value="${value.id}">${value.full_name}</option>`
                                    );
                                });

                                $('.provider_id').val(prov_id);

                            }
                        });
                    }


                }


            });
            calendar.render();
        });
    </script>


    <script>
        $(document).ready(function () {

            $('.calender_filter_reportrange').val('');


            $('#submit_appoinment').click(function (e) {
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


                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.appoinment.save') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'billable': billable,
                        'client_id': client_id,
                        'authorization_id': authorization_id,
                        'activity_id': activity_id,
                        'provider_id': provider_id,
                        'location': location,
                        'time_duration': time_duration,
                        'from_time': from_time,
                        'status': status,
                        'notes': notes,
                        'chkrecurrence': chkrecurrence,
                        'daily': daily,
                        'weekly': weekly,
                        'end_date': end_date,
                        'array_data': array_data,
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == 'done') {
                            $('#createAppointement').modal('hide');
                            swal("Appoinment Successfully Created", "", "success");
                        }

                    }
                });


            })

        })
    </script>
@endsection

