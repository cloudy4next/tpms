@section('js')

    <script>
        $(document).ready(function () {
            $('.show_viewbtndiv1').hide();
            $('.show_viewbtndiv').hide();
            $('.calender_filter_reportrange').val('');
            client_email = '';
            client_name = '';

            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.calender.get.all.client') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                },
                success: function (data) {

                    $('.calender_filter_client').append(`<option></option>`);
                    $.each(data, function (index, value) {
                        $('.calender_filter_client').append(
                            ` <option value="${value.id}">${value.client_full_name}</option>`
                        );
                    });

                }
            });

            $(document).on('click', '.meet_start', function () {
                notchecked = 0;
                $('#video_check_form input[type="checkbox"]:visible').each(function () {
                    if ($(this).prop('checked') == false) {
                        notchecked = 1;
                        return false;
                    }
                });

                // alert(notchecked);
                if (notchecked == 1) {
                    toastr["error"]('Acknowledge all to start your session.', 'ALERT!');
                } else {
                    $('.loading2').show();
                    let ses_id = $(this).data('id');
                    if (client_email != '') {
                        $.ajax({
                            type: "POST",
                            url: "{{route('superadmin.meet.session.start')}}",
                            data: {
                                '_token': "{{csrf_token()}}",
                                'ses_id': ses_id
                            },
                            success: function (data) {
                                console.log(data)
                                if (data.status == 'success') {
                                    $('.loading2').hide();
                                    $('#vdoApp').modal('hide');
                                    toastr["success"]('Telehealth link has been shared with ' + client_name + ' (' + client_email + ').', 'Success!', {
                                        onHidden: function () {
                                            window.open(data.url);
                                        }
                                    });
                                }
                            }
                        });
                    }
                }
            })


            $(document).on('click', '.check_all', function () {
                if ($(this).prop('checked') == true) {
                    $('#video_check_form input[type="checkbox"]:visible').each(function () {
                        $(this).prop('checked', true);
                    });
                } else {
                    $('#video_check_form input[type="checkbox"]:visible').each(function () {
                        $(this).prop('checked', false);
                    });
                }
            });


            //client name
            $('.loading2').show();
            $.ajax({
                type: "POST",
                url: "{{route('superadmin.get.all.client')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {
                    $('.cal_create_client').empty();
                    $('.authorization_id').empty();
                    $('.cal_create_client').append(`<option value="0"></option>`);
                    $.each(data, function (index, value) {
                        $('.cal_create_client').append(
                            ` <option value="${value.id}">${value.text}</option>`
                        );
                    });
                    $('.loading2').hide();


                }
            });


            //authorization name
            $('.cal_create_client').change(function () {
                $('.loading2').show();
                var client_id = $(this).val();
                $('.cal_create_auth').empty();
                $('.cal_create_act').empty();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.appoinment.autho.get')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'client_id': client_id,
                    },
                    success: function (data) {
                        console.log(data)

                        $('.cal_create_auth').append(`<option value="0"></option>`);
                        $.each(data, function (index, value) {
                            $('.cal_create_auth').append(
                                ` <option value="${value.id}">${value.text}</option>`
                            );
                        });
                        $('.loading2').hide();

                    }
                });


            });


            //activity name
            $('.cal_create_auth').change(function () {
                $('.loading2').show();
                var auth_id = $(this).val();
                $('.cal_create_act').empty();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.appoinment.autho.activity.get')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'auth_id': auth_id,
                    },
                    success: function (data) {

                        $('.cal_create_act').append(`<option value="0"></option>`);
                        $.each(data, function (index, value) {
                            $('.cal_create_act').append(
                                ` <option value="${value.id}">${value.text}</option>`
                            );
                        });
                        $('.loading2').hide();

                    }
                });


            });


            //employee name
            $('.loading2').show();
            $.ajax({
                type: "POST",
                url: "{{route('superadmin.get.all.provider')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {
                    $('.cal_create_pro').empty();
                    $('.cal_create_pro').append(`<option value="0"></option>`);
                    $.each(data, function (index, value) {
                        $('.cal_create_pro').append(
                            ` <option value="${value.id}">${value.text}</option>`
                        );
                    });
                    $('.loading2').hide();


                }
            });


            $('#cal_create_app_save').click(function (e) {
                e.preventDefault();
                let cal_create_client = $('.cal_create_client').val();
                let cal_create_auth = $('.cal_create_auth').val();
                let cal_create_act = $('.cal_create_act').val();
                let cal_create_pro = $('.cal_create_pro').val();
                let cal_create_location = $('.cal_create_location').val();
                let cal_create_form_date = $('.cal_create_form_date').val();
                let cal_create_from_time = $('.cal_create_from_time').val();
                let cal_create_to_time = $('.cal_create_to_time').val();
                let cal_create_status = $('.cal_create_status').val();

                if (cal_create_client == 0) {
                    $('.btnloding').hide();
                    toastr["error"]("Please Select Client", 'ALERT!');
                } else if (cal_create_auth == 0) {
                    $('.btnloding').hide();
                    toastr["error"]("Please Select Auth", 'ALERT!');
                } else if (cal_create_act == 0) {
                    $('.btnloding').hide();
                    toastr["error"]("Please Select Activity", 'ALERT!');
                } else if (cal_create_pro == 0) {
                    $('.btnloding').hide();
                    toastr["error"]("Please Select Provider", 'ALERT!');
                } else if (cal_create_location == '' || cal_create_location == null) {
                    $('.btnloding').hide();
                    toastr["error"]("Please Select Location", 'ALERT!');
                } else if (cal_create_form_date == '' || cal_create_form_date == null) {
                    $('.btnloding').hide();
                    toastr["error"]("Please Select From Date", 'ALERT!');
                } else if (cal_create_from_time == '' || cal_create_from_time == null) {
                    $('.btnloding').hide();
                    toastr["error"]("Please Select From Time", 'ALERT!');
                } else if (cal_create_to_time == '' || cal_create_to_time == null) {
                    $('.btnloding').hide();
                    toastr["error"]("Please Select To Time", 'ALERT!');
                } else if (cal_create_status == '' || cal_create_status == null) {
                    $('.btnloding').hide();
                    toastr["error"]("Please Select Status", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.calender.session.createnew')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'cal_create_client': cal_create_client,
                            'cal_create_auth': cal_create_auth,
                            'cal_create_act': cal_create_act,
                            'cal_create_pro': cal_create_pro,
                            'cal_create_location': cal_create_location,
                            'cal_create_form_date': cal_create_form_date,
                            'cal_create_from_time': cal_create_from_time,
                            'cal_create_to_time': cal_create_to_time,
                            'cal_create_status': cal_create_status,
                        },
                        success: function (data) {
                            console.log(data);
                            if (data == 'appoinemtcreatedcal') {
                                $('.btnloding').hide();
                                $('#callenderAppointementCreate').modal('hide');
                                toastr["success"]("Appoinment Successfully Created", 'SUCCESS!');
                            }

                            if (data == "errorauthhour") {
                                $('.btnloding').hide();
                                toastr["error"]("You are scheduling over the authorized hours. Please Check the approved hours set in the system", 'ALERT!');
                            }

                            if (data == "error1") {
                                $('.btnloding').hide();
                                toastr["error"]("You are scheduling the session prior to the auth start date", 'ALERT!');
                            }

                            if (data == "error2") {
                                $('.btnloding').hide();
                                toastr["error"]("You are scheduling the session after to the auth end date", 'ALERT!');
                            }

                            if (data == "error3") {
                                $('.btnloding').hide();
                                toastr["error"]("The Recurrence end date is prior auth start date", 'ALERT!');
                            }

                            if (data == "error4") {
                                $('.btnloding').hide();
                                toastr["error"]("The Recurrence end date is after auth start date", 'ALERT!');
                            }
                            if (data == "error5") {
                                $('.btnloding').hide();
                                toastr["error"]("You are scheduling over the authorized hours", 'ALERT!');
                            }
                            if (data == "error6") {
                                $('.btnloding').hide();
                                toastr["error"]("Patient Is In-Active.Please Make Active Patient", 'ALERT!');
                            }

                            if (data == "error7") {
                                $('.btnloding').hide();
                                toastr["error"]("You are scheduling the session prior to the auth start date", 'ALERT!');
                            }
                            if (data == "error8") {
                                $('.btnloding').hide();
                                toastr["error"]("You are scheduling the session after to the auth end date", 'ALERT!');
                            }
                            if (data == "error9") {
                                $('.btnloding').hide();
                                toastr["error"]("Provider already has Scheduled this time", 'ALERT!');
                            }
                            if (data == "error10") {
                                $('.btnloding').hide();
                                toastr["error"]("Session is more then 8 hours", 'ALERT!');
                            }

                            if (data == "error11") {
                                $('.btnloding').hide();
                                toastr["error"]("Authorization and Activity is not belongs to Patient", 'ALERT!');
                            }

                            if (data == "holiday_sepup") {
                                $('.btnloding').hide();
                                toastr["error"]("You are Scheduling on a Holiday", 'ALERT!');
                            }


                        }
                    });
                }


            })


        });


    </script>



    {{--    google calender render--}}
    <script>
        staff_id="{{$emp->id}}";
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                timeZone: false,
                displayEventTime: true,
                editable: true,
                headerToolbar: {
                    left: 'prevYear,prev,next,nextYear today',
                    center: 'title',
                    right: 'dayGridDay,timeGridWeek,dayGridMonth'
                },
                dateClick: function (info) {
                    // $('#createAppointement').modal("show");
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
                selectable: true,
                selectHelper: true,
                select: function (event_start, event_end, allDay) {
                    $('.loading2').show();
                    var strt_time = event_start.start;
                    // var time = moment(strt_time).utc().format('Y-MM-DD');
                    var time = moment(strt_time).utc().format('MM/DD/Y');
                    $('#callenderAppointementCreate').modal('show');
                    const datepicker = MCDatepicker.create({
                            el: '#cal_create_form_date',
                            selectedDate: new Date(time),
                            autoClose: true,
                            dateFormat: 'mm/dd/yyyy'
                        }
                    )
                    $('.cal_create_form_date').val(time);
                    $('.loading2').hide();
                },
                events: function (info, callback) {

                    console.log(info)
                    $('#calender_go_btn').click(function () {
                        $('.is_clicked').val(1);
                    })

                    var is_click = $('.is_clicked').val();
                    // console.log(is_click)
                    $('.loading2').show();
                    if (is_click == 0) {
                        $('.loading2').show();
                        $.ajax({
                            url: "{{ route('superadmin.employee.schedule.data.get') }}",
                            data: {
                                // our hypothetical feed requires UNIX timestamps
                                start: info.start.valueOf(),
                                end: info.end.valueOf(),
                                staff_id: staff_id,
                            },
                            success: function (doc) {
                                callback(doc);
                                // let i = document.createElement('i');
                                // i.className = 'fa';
                                // i.classList.add('fa-video-camera');
                                // $('.fc-event-main').prepend(i);

                                $('#filterModal').modal('hide');

                                $('.loading2').hide();
                            }
                        });
                    }


                    $('#calender_go_btn').click(function () {
                        $('.loading2').show();

                        let calender_filter_client = $('.calender_filter_client').val();
                        let calender_filter_employee = $('.calender_filter_employee').val();
                        let calender_filter_location = $('.calender_filter_location').val();
                        let calender_filter_reportrange = $('.calender_filter_reportrange').val();
                        let calender_filter_status = $('.calender_filter_status').val();

                        $.ajax({
                            url: "{{ route('superadmin.get.calender.data.filter') }}",
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
                                console.log(doc)
                                console.log('clicked')
                                callback(doc);

                                // var i = document.createElement('i');
                                // i.className = 'fa';
                                // i.classList.add('fa-video-camera');
                                // element.find('div.fc-event-title-container').prepend(i);


                                $('#filterModal').modal('hide');
                                $('.loading2').hide();
                            }
                        });
                    })


                },

                eventDrop: function (info) {
                    var strt_time = info.event.start;
                    // var time = moment(strt_time).format("YYYY-MM-DD h:mm:ss");
                    var time = moment(strt_time).utc().format('Y-MM-DD HH:mm:ss');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.get.calender.data.dropupdate') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'id': info.event.id,
                            'from_time': time,
                        },
                        success: function (data) {
                            console.log(data);
                            if (data == "holiday_sepup") {
                                $('.btnloding').hide();
                                toastr["error"]("You have selected schedule holiday", 'ALERT!');
                            }
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

                            console.log(data)
                            client_email = data.email;
                            client_name = data.name;
                            data = data.data;
                            // if (data.billable == 1) {
                            //     $('#accccc').prop('checked', true);
                            // } else if (data.billable == 2) {
                            //     $('#accccc').prop('checked', false);
                            // }

                            $('.callender_edit_single').val(data.id)


                            var time = moment(new Date(data.schedule_date)).utc().format(
                                'MM/DD/YYYY');

                            var formtime = moment(new Date(data.from_time)).format(
                                'HH:mm:ss');

                            var to_time = moment(new Date(data.to_time)).format(
                                'HH:mm:ss');

                            $("#callenderAppointement input[type='date']").flatpickr({
                                enableTime: false,
                                dateFormat: "m/d/Y",
                                defaultDate: new Date(time)
                            });


                            var client = $('.client_name').val(data.client_id);
                            $('.c_id').empty().val(data.client_id);
                            $('.auth_id').empty().val(data.authorization_id);
                            $('.act_id').empty().val(data.authorization_activity_id);
                            $('.prov_id').empty().val(data.provider_id);
                            $('.callender_location').val(data.location);
                            // $('.callender_time_duration').val(data.time_duration);
                            $('.callender_from_date').val(time);
                            $('.callender_form_time').val(formtime);
                            $('.callender_to_time').val(to_time);
                            // $('.from_time').val("2013-03-18T13:00");
                            $('.callender_status').val(data.status);
                            $('.callender_notes').val(data.notes);
                            getClientData();
                            getData();
                            getDataAct();
                            getDataEmployee();
                            $('.authorization_id').val(data.authorization_id);
                            $('#callenderAppointement').modal("show");


                            if (data.location == 02) {
                                $('.show_viewbtndiv1').show();
                                $('.show_viewbtndiv').show();
                                $('.meet_start').attr('data-id', data.id);
                            } else if (data.location == 10) {
                                $('.show_viewbtndiv1').show();
                                $('.show_viewbtndiv').show();
                                $('.meet_start').attr('data-id', data.id);
                            } else {
                                $('.show_viewbtndiv1').hide();
                                $('.show_viewbtndiv').hide();
                            }

                            $('.start_btn').attr('data-id', data.id);
                            $('.client_email').val(client_email);

                            if (data.is_locked != 0) {
                                $('#submit_appoinments_callender').hide();
                                $('#submit_appoinments_callender_locked').show();
                            } else {
                                $('#submit_appoinments_callender').show();
                                $('#submit_appoinments_callender_locked').hide();
                            }


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
                                $('.callender_client_name').empty();
                                $('.callender_client_name').append(
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
                                $('.callender_authorization_id').empty();
                                $('.callender_authorization_id').append(
                                    `<option value="0"></option>`);
                                $.each(data, function (index, value) {
                                    $('.callender_authorization_id').append(
                                        ` <option value="${value.id}" >${value.text}</option>`
                                    );
                                });

                                $('.callender_authorization_id').val(au_id);


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
                                $('.callender_activity_id').empty();
                                $('.callender_activity_id').append(`<option value="0"></option>`);
                                $.each(data, function (index, value) {
                                    $('.callender_activity_id').append(
                                        ` <option value="${value.id}">${value.text}</option>`
                                    );
                                });

                                $('.callender_activity_id').val(act_id);

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
                                $('.callender_provider_id').empty();
                                $('.callender_provider_id').append(`<option value="0"></option>`);
                                $.each(data, function (index, value) {
                                    $('.callender_provider_id').append(
                                        ` <option value="${value.id}">${value.text}</option>`
                                    );
                                });

                                $('.callender_provider_id').val(prov_id);

                            }
                        });
                    }
                },

                eventDidMount: function (info) {
                    let $el = $(info.el);
                    // console.log(info.event.extendedProps.icon);
                    if (info.event.extendedProps.icon == 'camera') {
                        $el.find('.fc-event-title').append('<i class="fa fa-video-camera pl-2"></i>');
                        //console.log(info.event.icon);
                    }

                }
            });
            calendar.render();

        });
    </script>

    <script src="{{ asset('assets/') }}/dashboard/js/printCanvas/jspdf.js"></script>
    <script src="{{ asset('assets/') }}/dashboard/js/printCanvas/domtoimage.js"></script>
    <script>
        $(document).on('click','#print_calendar',function(){
            var timeStamp = moment().format('MMDYYYYhmmss');
            var fileName = 'Calendar_'+timeStamp;
            print(fileName);
        })

        function print(fileName)
        {
            $('.loading2').show();
            var node = document.getElementById('calendar');
            var options = {
                quality: 100,
            };

            const scale = 3600 / node.offsetWidth;
            node.shot_loading = true;

            domtoimage
            .toPng(node, {
                height: node.offsetHeight * scale,
                width: node.offsetWidth * scale,
                style: {
                transform: "scale(" + scale + ")",
                transformOrigin: "top left",
                width: node.offsetWidth + "px",
                height: node.offsetHeight + "px"
                }
            })
            .then(dataUrl => {
                this.baseData = dataUrl;
                this.shot_loading = false;
                var doc = new jsPDF('L', 'mm', 'a4');
                doc.addImage(dataUrl, 'JPEG', 10, 10, 277,190);
                $('.loading2').hide();
                doc.save(fileName+'.pdf');
            })
            .catch(error => {
                this.shot_loading = false;
                $('.loading2').hide();
                toastr["error"]("Some error occurred.");
            });
        }

    </script>
@endsection
