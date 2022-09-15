@section('js')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script>
        $('.loading2').hide();
        $('.checkavail').hide();
        $('.mindegree').hide();
        $('.apptype').hide();
        $('.gender_filter').hide();
        $('.zone_filter').hide();
        $('.zip_filter').hide();
        $('.language_filter').hide();
        $('.calendar_table').hide();
        $('.go_btn').click(function(event) {
            $('.calendar_table').show();
        });
        $('.download_div').hide();
        var client_email = '';
        var client_name = '';

        $(document).on('click', '.check_all', function() {
            if ($(this).prop('checked') == true) {
                $('#video_check_form input[type="checkbox"]:visible').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('#video_check_form input[type="checkbox"]:visible').each(function() {
                    $(this).prop('checked', false);
                });
            }
        })


        $('.billable-switch input').click(function(e) {
            if ($(this).prop("checked") == true) {
                $('.billable-switch label').text('Billable');
                $('.ses_app_type').val(1);
                $('.patient').show();
                $('.authorization').show();
                $('.pos').show();
                $('.date').show();
                $('.status').show();
                $('.session_table').hide();
                $('.p_th_remove').each(function() {
                    $(this).show();
                })
                $('.s_th_remove').each(function() {
                    $(this).show();
                })
            } else if ($(this).prop("checked") == false) {
                $('.billable-switch label').text('Non-Billable');
                $('.ses_app_type').val(2);
                $('.patient').hide();
                $('.authorization').hide();
                $('.pos').hide();
                $('.date').hide();
                $('.status').hide();
                $('.session_table').hide();
                $('.p_th_remove').each(function() {
                    $(this).hide();
                })
                $('.s_th_remove').each(function() {
                    $(this).hide();
                })
            }
        });

        $('.ses_app_type').val(1);
    </script>

    <script>
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getData(page);
                }
            }
        });


        $(document).ready(function() {

            $(document).on('click', '.editAppLock', function() {
                toastr["error"]("This Session Has Active Billing", 'ALERT!');
            })


            $(document).on('click', '.session_check_all', function() {
                if ($(this).prop('checked') == true) {
                    $('.data_checkbox_appoinment').each(function() {
                        if ($(this).prop('disabled')) {
                            $(this).prop('checked', false);
                        } else {
                            $(this).prop('checked', true);
                        }

                    })
                }


                if ($(this).prop('checked') == false) {
                    $('.data_checkbox_appoinment').each(function() {
                        if ($(this).prop('disabled')) {
                            $(this).prop('checked', false);
                        } else {
                            $(this).prop('checked', false);
                        }
                    })
                }

            });

            $(document).on('click', '.recussion_session_check_all', function() {
                if ($(this).prop('checked') == true) {
                    $('.recurssion_data_checkbox_appoinment').each(function() {
                        if ($(this).prop('disabled')) {
                            $(this).prop('checked', false);
                        } else {
                            $(this).prop('checked', true);
                        }

                    })
                }


                if ($(this).prop('checked') == false) {
                    $('.recurssion_data_checkbox_appoinment').each(function() {
                        if ($(this).prop('disabled')) {
                            $(this).prop('checked', false);

                        } else {
                            $(this).prop('checked', false);
                        }
                    })
                }

            });

            $(document).on('click', '#save_data', function() {


                var check_array = [];
                var location = $('.location').val();
                var provider_id = $('.provider_id').val();
                var from_time = $('.from_time').val();
                var to_time = $('.to_time').val();
                var status = $('.status').val();
                var service = $('.activity_id').val();
                var auth = $('.authorization_id').val();
                var rec_id = $('.rec_id').val();
                var notes = $('.notes').val();



                $('input[name="recurssion_data_checkbox_appoinment"]:checked').each(function() {
                    if ($(this).is(':checked')) {
                        var checked = ($(this).val());
                        check_array.push(checked);
                    }
                })

                // console.log(rec_id);

                if (check_array == null || check_array == "") {
                    toastr["error"]("Please select appoinment", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.recurring.session.update') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'check_array': check_array,
                            'location': location,
                            'provider_id': provider_id,
                            'from_time': from_time,
                            'to_time': to_time,
                            'status': status,
                            'activity_id': service,
                            'authorization_id': auth,
                            'rec_id': rec_id,
                            'notes': notes,

                        },
                        success: function(data) {
                            console.log(data);
                            if (data == "success") {
                                toastr["success"]('Successfully Updated');
                                $('#preview_modal').modal('hide');
                            } else {
                                toastr["error"]('Unexpected error occurred');

                            }

                        }
                    });
                }
            });




            $(document).on('click', '.share_link', function() {

                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val($(this).attr('id')).select();
                document.execCommand("copy");
                $temp.remove();
                toastr["success"]('Link copied to clipboard.');

            });

            $(document).on('click', '.telehealth_session_id', function() {
                $('#su_modal').modal("hide");
            })

            $(document).on('click', '.meet_start', function() {
                notchecked = 0;
                $('#video_check_form input[type="checkbox"]:visible').each(function() {
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
                    var client_email = '';
                    client_email = $('.client_email').val();
                    let ses_id = $(this).data('id');
                    if (client_email != '') {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('superadmin.meet.session.start') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'ses_id': ses_id
                            },
                            success: function(data) {
                                if (data.status == 'success') {
                                    $('.loading2').hide();
                                    $('#vdoApp').modal('hide');
                                    toastr["success"](
                                        'Telehealth link has been shared with ' +
                                        client_name + ' (' + client_email + ').',
                                        'Success!', {
                                            onHidden: function() {
                                                window.open(data.url);
                                            }
                                        });
                                }
                            }
                        });
                    }
                }
            })


            $('#ses_client_id').multiselect();
            $('.loading2').show();
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.get.session.client.all') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    $('.ses_client_id').empty();
                    $.each(data, function(index, value) {
                        $('.ses_client_id').append(
                            `<option value="${value.id}">${value.client_full_name}</option>`
                        )
                    });


                    $('#ses_client_id').multiselect({
                        includeSelectAllOption: true
                    });
                    $("#ses_client_id").multiselect('rebuild');


                    $('.loading2').hide();

                }
            });


            $('#ses_emaployee_id').multiselect();
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.get.all.employee') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    $('.ses_emaployee_id').empty();
                    if (data.length > 0) {
                        $.each(data, function(index, value) {
                            $('.ses_emaployee_id').append(
                                `<option value="${value.id}">${value.full_name}</option>`
                            );
                        });
                    }


                    $('#ses_emaployee_id').multiselect({
                        includeSelectAllOption: true
                    });
                    $("#ses_emaployee_id").multiselect('rebuild');
                    $('.loading2').hide();

                }
            });


            $(document).on('click', '.addNoteForms', function() {
                $('.loading2').show();
                var session_id = $(this).data("session");
                $('.from_session_id_hidden').val(session_id);
                $('#formNote').modal("show");
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.get.appoinment.templatename') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        console.log('template is ', data);
                        $('.formType').empty();
                        $('.formType').append(
                            `<option value=""></option>`
                        )
                        $.each(data, function(index, value) {
                            $('.formType').append(
                                `<option value="${value.id}">${value.template_name}</option>`
                            )
                        })
                        $('.loading2').hide();

                    }
                });
            });


            $(document).on('click', '.createdNoteform', function() {
                let ses_id = $(this).data('id');
                $('.created_from_session_id_hidden').val(ses_id);
                $('#createdFormNote').modal("show");
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.get.appoinment.created.templatename') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'ses_id': ses_id
                    },
                    success: function(data) {
                        console.log('template is ', data);
                        $('.CreatedformType').empty();
                        $('.formType').append(
                            `<option value=""></option>`
                        )
                        if (data.form_one != null) {
                            $('.CreatedformType').append(
                                `<option value="1">Unique Supervision Form</option>`
                            )
                        }

                        if (data.form_two != null) {
                            $('.CreatedformType').append(
                                `<option value="2">Direct Service Parent Training Form</option>`
                            )
                        }

                        if (data.form_three != null) {
                            $('.CreatedformType').append(
                                `<option value="3">BCBA Trainee Supervision Monthly Form</option>`
                            )
                        }

                        if (data.form_four != null) {
                            $('.CreatedformType').append(
                                `<option value="4">BCBA Trainee Unique Supervision Form</option>`
                            )
                        }

                        if (data.form_five != null) {
                            $('.CreatedformType').append(
                                `<option value="5">Monthly Supervision Form</option>`
                            )
                        }

                        if (data.form_six != null) {
                            $('.CreatedformType').append(
                                `<option value="6">Therapist Communication/Session Notes</option>`
                            )
                        }

                        if (data.form_7 != null) {
                            $('.CreatedformType').append(
                                `<option value="7">Clinical Treatment, Management & Modification Notes</option>`
                            )
                        }

                        if (data.form_eight != null) {
                            $('.CreatedformType').append(
                                `<option value="8">Treatment Plan</option>`
                            )
                        }


                        if (data.form_9 != null) {
                            $('.CreatedformType').append(
                                `<option value="9">Private Client Intake Form</option>`
                            )
                        }

                        if (data.form_10 != null) {
                            $('.CreatedformType').append(
                                `<option value="10">Outpatient Treatment Request Form</option>`
                            )
                        }


                        if (data.form_eleven != null) {
                            $('.CreatedformType').append(
                                `<option value="11">SOAP Notes</option>`
                            )
                        }

                        if (data.form_12 != null) {
                            $('.CreatedformType').append(
                                `<option value="12">Parent Training Session Note</option>`
                            )
                        }

                        if (data.form_13 != null) {
                            $('.CreatedformType').append(
                                `<option value="13">Session Notes</option>`
                            )
                        }

                        if (data.form_14 != null) {
                            $('.CreatedformType').append(
                                `<option value="14">Supervision Non-Billable Note</option>`
                            )
                        }

                        if (data.form_15 != null) {
                            $('.CreatedformType').append(
                                `<option value="15">Supervision</option>`
                            )
                        }

                        if (data.form_16 != null) {
                            $('.CreatedformType').append(
                                `<option value="16">FBA</option>`
                            )
                        }

                        if (data.form_17 != null) {
                            $('.CreatedformType').append(
                                `<option value="17">CP Clinical Form</option>`
                            )
                        }

                        if (data.form_18 != null) {
                            $('.CreatedformType').append(
                                `<option value="18">CP Notes Form</option>`
                            )
                        }

                        if (data.form_19 != null) {
                            $('.CreatedformType').append(
                                `<option value="19">CP SOAP Form</option>`
                            )
                        }

                        if (data.form_20 != null) {
                            $('.CreatedformType').append(
                                `<option value="20">GS Assessment Form</option>`
                            )
                        }

                        if (data.form_21 != null) {
                            $('.CreatedformType').append(
                                `<option value="21">GS Parent Training Form</option>`
                            )
                        }

                        if (data.form_22 != null) {
                            $('.CreatedformType').append(
                                `<option value="22">GS Supervision Form</option>`
                            )
                        }

                        if (data.form_23 != null) {
                            $('.CreatedformType').append(
                                `<option value="23">GS Treatment Plan Form</option>`
                            )
                        }

                        if (data.form_24 != null) {
                            $('.CreatedformType').append(
                                `<option value="24">Biopsychosocial Form</option>`
                            )
                        }

                        if (data.form_25 != null) {
                            $('.CreatedformType').append(
                                `<option value="25">BIRP Progress Form</option>`
                            )
                        }

                        if (data.form_26 != null) {
                            $('.CreatedformType').append(
                                `<option value="26">Discharge Summary</option>`
                            )
                        }

                        if (data.form_27 != null) {
                            $('.CreatedformType').append(
                                `<option value="27">Speech Language Progress Report</option>`
                            )
                        }

                        if (data.form_28 != null) {
                            $('.CreatedformType').append(
                                `<option value="28">Speech Language Session Note</option>`
                            )
                        }

                        if (data.form_29 != null) {
                            $('.CreatedformType').append(
                                `<option value="29">Diagnosis Session Form</option>`
                            )
                        }

                        if (data.form_30 != null) {
                            $('.CreatedformType').append(
                                `<option value="30">Datasheet</option>`
                            )
                        }

                        if (data.form_60 != null) {
                            $('.CreatedformType').append(
                                `<option value="60">Supervision and Assessment</option>`
                            )
                        }

                        if (data.form_61 != null) {
                            $('.CreatedformType').append(
                                `<option value="61">Session Notes 2</option>`
                            )
                        }

                        if (data.custom.length > 0) {
                            $.each(data.custom, function(index, val) {
                                $('.CreatedformType').append(
                                    `<option value="custom-` + val.id + `">` +
                                    val
                                    .name + `</option>`
                                )
                            });

                        }
                    }
                });
            })


            $('#getdetailappoinment').click(function(e) {
                e.preventDefault();
                getAppSessionData();


            });


            var ENDPOINT = "{{ url('/') }}";
            var page = 1;
            var current_page = 0;
            let bool = false;
            let lastPage;
            var currentscrollHeight = 0;


            $(window).scroll(function() {

                const scrollHeight = $(document).height();
                const scrollPos = Math.floor($(window).height() + $(window).scrollTop());
                const isBottom = scrollHeight - 100 < scrollPos;
                if (isBottom && currentscrollHeight < scrollHeight) {
                    page++;
                    //alert('calling...');
                    var myurl = ENDPOINT + '/admin/appoinement-get-data?page=' + page
                    getData(myurl);
                    currentscrollHeight = scrollHeight;
                }
            });


            let getAppSessionData = () => {
                // $('.loading2').show();
                $('.show_animation').show();
                // $('.show_data').hide();
                $('.show_data').empty();
                $('.show_data').hide();
                page = 1;
                currentscrollHeight = 0;
                let client_array = [];
                var ses_client_id = $('.ses_client_id').val();


                var ses_emaployee_id = $('.ses_emaployee_id').val();
                var ses_reportrange = $('.ses_reportrange').val();

                var ses_app_type = $('.ses_app_type').val();

                var ses_status = $('.ses_status').val();

                if (ses_app_type == 1) {

                    if (ses_client_id == '' || ses_client_id == null) {
                        $('.show_data').hide();
                        $('.show_animation').hide();
                        toastr["error"]("Please select patient", 'ALERT!');
                    } else if (ses_reportrange == '' || ses_reportrange == null) {
                        $('.show_data').hide();
                        $('.show_animation').hide();
                        toastr["error"]("Please select date range", 'ALERT!');
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('superadmin.get.appoinment.data') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'ses_client_id': ses_client_id,
                                'ses_emaployee_id': ses_emaployee_id,
                                'ses_reportrange': ses_reportrange,
                                'ses_app_type': ses_app_type,
                                'ses_status': ses_status,
                            },
                            success: function(data) {
                                console.log(data);
                                $('.show_animation').hide();
                                if (data == 'date_max_error') {
                                    $('.loading2').hide();
                                    $('.show_data').hide();
                                    $('.show_animation').hide();
                                    toastr["error"]("Date range max five months", 'ALERT!');
                                } else {
                                    $('.show_data').append(data.view)
                                    $('.show_data').show();
                                    $('.download_div').show();
                                    $('.show_animation').hide();
                                    $('.c_table').trigger('update')
                                }


                            }
                        });
                    }


                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.get.appoinment.data.nonbil') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'ses_emaployee_id': ses_emaployee_id,
                            'ses_app_type': ses_app_type,
                        },
                        success: function(data) {
                            console.log(data);
                            $('.show_data').empty();
                            $('.show_data').append(data.view)
                            $('.show_data').show();
                            $('.download_div').show();

                            $('.show_animation').hide();

                            $('.c_table').trigger('update')

                        }
                    });
                }
            }


            $(document).on('click', '#update_status', function() {


                var check_array = [];
                var chnage_status = $('.chnage_session_status').val();


                $('input[name="data_checkbox_appoinment"]:checked').each(function() {
                    if ($(this).is(':checked')) {
                        var checked = ($(this).val());
                        check_array.push(checked);
                    }
                })

                console.log(chnage_status)
                console.log(check_array)

                if (check_array == null || check_array == "") {
                    toastr["error"]("Please select appoinment", 'ALERT!');
                } else if (chnage_status == "") {
                    toastr["error"]("Please select status", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.update.appoinment.status') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'check_array': check_array,
                            'chnage_status': chnage_status,
                        },
                        success: function(data) {
                            console.log(data);
                            $('#getdetailappoinment').click();
                        }
                    });
                }
            });
        });


        var array_data = [];

        function getData(myurl) {
            $('.show_animation').show();
            let client_array = [];
            var ses_client_id = $('.ses_client_id').val();


            var ses_emaployee_id = $('.ses_emaployee_id').val();
            var ses_reportrange = $('.ses_reportrange').val();

            var ses_app_type = $('.ses_app_type').val();

            var ses_status = $('.ses_status').val();
            $.ajax({
                url: myurl,
                type: "POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'ses_client_id': ses_client_id,
                    'ses_emaployee_id': ses_emaployee_id,
                    'ses_reportrange': ses_reportrange,
                    'ses_app_type': ses_app_type,
                    'ses_status': ses_status,
                },
                datatype: "html"
            }).done(function(data) {
                console.log(data)
                $('.show_animation').hide();
                if (data.count_ses > 0) {
                    $('.show_data').append(data.view)
                    // $(".c_table").tablesorter();
                    $('.c_table').trigger('update')
                    $('.show_animation').hide();
                } else {
                    $('.c_table').trigger('update')
                    $('.show_animation').hide();
                }


                // location.hash = myurl;

            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
                $('.loading2').hide();
            });
        }
    </script>

    <script>
        var timeStamp = moment().format('MMDYYYYhmmss');
        $('#download_csv').click(function() {
            $('#export_table').tableExport({
                type: 'csv',
                fileName: 'ManageSession_' + timeStamp
            });
        });

        $('#download_pdf').click(function() {
            $('#export_table').tableExport({
                type: 'pdf',
                fileName: 'ManageSession_' + timeStamp,
                jspdf: {
                    orientation: "L",
                    autotable: {
                        styles: {
                            overflow: 'linebreak'
                        },
                        headerStyles: {
                            fillColor: [32, 122, 199],
                            textColor: 255,
                            fontStyle: 'bold',
                            halign: 'inherit',
                            valign: 'middle',
                        }
                    }

                }
            });
        });
    </script>
@endsection
