@section('js')
    <script>
        client_email = '';
        client_name = '';

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
                        url: "{{route('provider.meet.session.start')}}",
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
        })


        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                timeZone: 'EST',
                editable: true,
                displayEventTime: true,
                disableDragging: true,

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
                            url: "{{ route('provider.get.calender.data') }}",

                            data: {
                                // our hypothetical feed requires UNIX timestamps
                                start: info.start.valueOf(),
                                end: info.end.valueOf(),
                            },
                            success: function (doc) {

                                // console.log(doc)
                                // console.log('not clicked')

                                callback(doc);
                                $('#filterModal').modal("hide");
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
                            url: "{{ route('provider.get.calender.data.filter') }}",

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
                                $('#filterModal').modal("hide");
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
                    info.revert();
                },
                eventClick: function (info) {


                    if (info.view.type == "dayGridMonth") {

                    } else if (info.view.type == "timeGridWeek") {

                    } else if (info.view.type == "dayGridDay") {

                    } else {

                    }


                    $.ajax({
                        type: "POST",
                        url: "{{ route('provider.get.calender.data.single') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'id': info.event.id,
                        },
                        success: function (data) {

                            console.log(data)
                            // var time = moment(new Date(data.from_time)).format(
                            //     'YYYY-MM-DDThh:mm:ss.SSS');


                            client_email = data.email;
                            client_name = data.name;
                            payroll_check = data.pay_check;
                            data = data.data;

                            $('#accccc').prop('checked', true);
                            var client = $('.client_name').val(data.client_id);
                            $('.c_id').empty().val(data.client_id);
                            $('.auth_id').empty().val(data.authorization_id);
                            $('.act_id').empty().val(data.authorization_activity_id);
                            $('.prov_id').empty().val(data.provider_id);
                            $('.location').val(data.location);

                            $('.status').val(data.status);
                            $('.notes').val(data.notes);

                            if(data.billable == 1){
                                getClientData();
                                getData();
                                getDataAct();
                                $('.authorization_id').val(data.authorization_id);
                            }
                            else{
                                $('.client_name').html(
                                    ` <option>Non-Billable Client</option>`
                                );
                                $('.authorization_id').html(
                                    ` <option>NONCLI01323_AUTH249</option>`
                                );

                                $('.activity_id').html(
                                    `
                                    <option selected="selected" value="1">Regular Time </option>
                                    <option value="2">Training &amp; Admin</option>
                                    <option value="3">Fill-In</option>
                                    <option value="4">Other</option>
                                    <option value="5">Public Holiday</option>
                                    <option value="6">Paid Time Off</option>
                                    <option value="7">Unpaid</option>
                                `
                                );
                                $('.activity_id').val(data.authorization_activity_id);
                            }

                            getDataEmployee();
                            var time = moment(new Date(data.schedule_date)).utc().format(
                                'MM/DD/YYYY');

                            const datepicker = MCDatepicker.create({
                                    el: '#proup_app_date_time',
                                    selectedDate: new Date(time),
                                    autoClose: true,
                                    dateFormat: 'mm/dd/yyyy',
                                    showCalendarDisplay: false
                                }
                            )


                            $('.procal_app_date_time').val(time)


                            var formtime = moment(new Date(data.from_time)).format(
                                'HH:mm');

                            $('.procal_sess_start_time').val(formtime);


                            var to_time = moment(new Date(data.to_time)).format(
                                'HH:mm');

                            $('.procal_sess_to_time').val(to_time);


                            $('#createAppointement').modal("show");
                            $('.callender_edit_single').val(data.id);

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
                                $('#submit_appoinments').hide();
                                $('#submit_appoinments_locked').show();
                            } else if (payroll_check == 1) {
                                $('#submit_appoinments').hide();
                                $('#submit_appoinments_locked').show();
                            } else {
                                $('#submit_appoinments_locked').hide();
                                $('#submit_appoinments').show();
                            }

                        }
                    });


                    function getClientData() {
                        var client_id = $('.c_id').val();
                        $.ajax({
                            type: "POST",
                            url: "{{ route('provider.appoinment.client.get') }}",
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
                            url: "{{ route('provider.appoinment.autho.get') }}",
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
                            url: "{{ route('provider.appoinment.autho.activity.get') }}",
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
                            url: "{{ route('provider.get.all.provider') }}",
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
                url: "{{ route('provider.calender.get.all.client') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                },
                success: function (data) {
                    $('.calender_filter_client').prop("disabled", false);
                    $.each(data, function (index, value) {
                        $('.calender_filter_client').append(
                            ` <option value="${value.id}">${value.client_full_name}</option>`
                        );
                    })

                    $('.calender_filter_client').multiselect({includeSelectAllOption: true});
                    $(".calender_filter_client").multiselect('rebuild');

                }
            });


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

