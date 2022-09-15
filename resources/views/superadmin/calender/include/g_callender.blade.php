<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            editable: true,
            headerToolbar: {
                left: 'prevYear,prev,next,nextYear today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,dayGridDay,listWeek'
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

            events: function (info, callback) {


                $('#calender_go_btn').click(function () {
                    $('.is_clicked').val(1);
                })

                var is_click = $('.is_clicked').val();
                // console.log(is_click)

                if (is_click == 0) {
                    $.ajax({
                        url: "{{ route('superadmin.get.calender.data') }}",

                        data: {
                            // our hypothetical feed requires UNIX timestamps
                            start: info.start.valueOf(),
                            end: info.end.valueOf(),
                        },
                        success: function (doc) {

                            console.log(doc)
                            console.log('not clicked')
                            callback(doc);
                        }
                    });
                }


                $('#calender_go_btn').click(function () {
                    var calender_filter_client = $('.calender_filter_client').val();
                    var calender_filter_employee = $('.calender_filter_employee').val();
                    var calender_filter_location = $('.calender_filter_location').val();
                    var calender_filter_reportrange = $('.calender_filter_reportrange').val();
                    var calender_filter_status = $('.calender_filter_status').val();


                    $.ajax({
                        url: "{{ route('superadmin.get.calender.data.filter') }}",

                        data: {
                            'calender_filter_client': calender_filter_client,
                            'calender_filter_employee': calender_filter_employee,
                            'calender_filter_location': calender_filter_location,
                            'calender_filter_reportrange': calender_filter_reportrange,
                            'calender_filter_status': calender_filter_status,
                            start: info.start.valueOf(),
                            end: info.end.valueOf(),
                        },
                        success: function (doc) {
                            calendar.refetchEvents()
                            calendar.removeAllEventSources()
                            calendar.addEventSource(doc)
                            console.log(doc)
                            console.log('clicked')
                            callback(doc);
                        }
                    });
                })


            },
            eventDrop: function (info) {
                var strt_time = info.event.start;
                var time = moment(strt_time).format("YYYY-MM-DD h:mm:ss");
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.get.calender.data.update') }}",
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
                    url: "{{ route('superadmin.get.calender.data.single') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': info.event.id,
                    },
                    success: function (data) {


                        var time = moment(new Date(data.from_time)).format(
                            'YYYY-MM-DDThh:mm:ss.SSS');
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

                    }
                });


                function getClientData() {
                    var client_id = $('.c_id').val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.appoinment.client.get') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'client_id': client_id,
                        },
                        success: function (data) {
                            $('.client_name').empty();
                            $('.client_name').append(
                                ` <option value="${data.id}" >${data.name}</option>`
                            );


                        }
                    });
                }

                function getData(a_id) {
                    var client_id = $('.c_id').val();
                    var au_id = $('.auth_id').val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.appoinment.autho.get') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'client_id': client_id,
                        },
                        success: function (data) {
                            $('.authorization_id').empty();
                            $('.authorization_id').append(
                                `<option value="0"></option>`);
                            $.each(data, function (index, value) {
                                $('.authorization_id').append(
                                    ` <option value="${value.id}" >${value.text}</option>`
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
                        url: "{{ route('superadmin.appoinment.autho.activity.get') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'auth_id': auth_id,
                        },
                        success: function (data) {
                            $('.activity_id').empty();
                            $('.activity_id').append(`<option value="0"></option>`);
                            $.each(data, function (index, value) {
                                $('.activity_id').append(
                                    ` <option value="${value.id}">${value.text}</option>`
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
                        url: "{{ route('superadmin.get.all.provider') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            console.log(data)
                            $('.provider_id').empty();
                            $('.provider_id').append(`<option value="0"></option>`);
                            $.each(data, function (index, value) {
                                $('.provider_id').append(
                                    ` <option value="${value.id}">${value.text}</option>`
                                );
                            });

                            $('.provider_id').val(prov_id);

                        }
                    });
                }
            },
            eventDidMount: function(info) {
                let $el = $(info.el);
                // console.log(info.event.extendedProps.icon);
                if(info.event.extendedProps.icon=='camera'){
                    $el.find('.fc-event-title').append('<i class="fa fa-video-camera pl-2"></i>');
                    //console.log(info.event.icon);
                }

            }


        });
        calendar.render();
    });
</script>
