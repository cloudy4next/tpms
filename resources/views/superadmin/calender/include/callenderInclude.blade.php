@section('js')

    <script>
        $(document).ready(function () {

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

        });


    </script>



    {{--    google calender render--}}
    <script>
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
                    var strt_time = event_start.start;
                    var time = moment(strt_time).utc().format('MM/DD/Y');
                    $('#sc_modal').modal('show');
                    $('#sc_btn').click();
                    $('.rpattern-switch').hide();
                    sc_date_s.val(time);
                },
                events: function (info, callback) {

                    $('#calender_go_btn').click(function () {
                        $('.is_clicked').val(1);
                    })

                    var is_click = $('.is_clicked').val();
                    $('.loading2').show();
                    if (is_click == 0) {
                        $('.loading2').show();
                        $.ajax({
                            url: "{{ route('superadmin.get.calender.data') }}",
                            data: {
                                // our hypothetical feed requires UNIX timestamps
                                start: info.start.valueOf(),
                                end: info.end.valueOf(),
                            },
                            success: function (doc) {
                                callback(doc);
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
                                info.revert();
                            }
                        }
                    });
                },
                eventClick: function (info) {
                    app_id = info.event.id;
                    $('.show_viewbtndiv1').hide();
                    $('.show_viewbtndiv').hide();
                    $('#su_form').trigger('reset');
                    su_session_id = app_id;
                    get_single_session(su_session_id);
                    $('#su_sub_lock_btn').hide();
                    $('#su_modal').modal("show");
                },

                eventDidMount: function (info) {
                    let $el = $(info.el);
                    if (info.event.extendedProps.icon == 'camera') {
                        $el.find('.fc-event-title').append('<i class="fa fa-video-camera pl-2"></i>');
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


            // domtoimage.toJpeg(node, options).then(function (dataUrl)
            // {
                // var doc = new jsPDF('L', 'mm', 'a4');
                // doc.addImage(dataUrl, 'JPEG', 10, 10, 277,190);
                // doc.save('Test.pdf');
            // });
        }

    </script>
@endsection
