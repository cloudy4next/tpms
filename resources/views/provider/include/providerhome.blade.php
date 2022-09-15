@section('js')
    <script>
        $('.loading2').hide();
        var client_email = '';
        var client_name = '';
        var app_type_check = 1;

        // $(window).on('hashchange', function() {
        //     if (window.location.hash) {
        //         var page = window.location.hash.replace('#', '');
        //         if (page == Number.NaN || page <= 0) {
        //             return false;
        //         } else {
        //             getData(page);
        //         }
        //     }
        // });

        $(document).on('click', '.check_all', function() {
            if ($(this).prop('checked') == true) {
                $('#video_check_form input[type="checkbox"]:visible').each(function() {
                    $(this).prop('checked', true);
                    // console.log($(this).prop("checked"));
                });
            } else {
                $('#video_check_form input[type="checkbox"]:visible').each(function() {
                    $(this).prop('checked', false);
                });
            }
        })

        $(document).ready(function() {

            $('.daterange-filter').hide();
            $('.client-filter').hide();
            $('.payperiod-filter').hide();
            $('.providerScheduler-table').hide();
            $('.activity-table').hide();
            $('.goBtn').click(function(event) {
                $('.providerScheduler-table').show();
            });
            $('.schedule-filter select').change(function(event) {
                let v = $(this).val();
                if (v == 5) {
                    $('.daterange-filter').show();
                    $('.client-filter').hide();
                    $('.payperiod-filter').hide();
                } else if (v == 6) {
                    $('.daterange-filter').show();
                    $('.client-filter').show();
                    $('.payperiod-filter').hide();
                } else if (v == 11) {
                    $('.daterange-filter').hide();
                    $('.client-filter').hide();
                    $('.payperiod-filter').show();
                } else {
                    $('.daterange-filter').hide();
                    $('.client-filter').hide();
                    $('.payperiod-filter').hide();
                }
            });
            $('#okBtn').click(function(e) {
                let v = $('.select-box select').val();
                if (v == 2) {
                    $('.activity-table').show();
                } else if (v == 4) {
                    $('.activity-table').hide();
                    $('#renderModal').modal('show');
                } else {
                    $('.activity-table').hide();
                    $('#renderModal').modal('hide');
                }
            });


            // $(document).on('click', '.pagination a', function(event) {
            //     event.preventDefault();


            //     $('li').removeClass('active');
            //     $(this).parent('li').addClass('active');

            //     var myurl = $(this).attr('href');
            //     // console.log(myurl);
            //     var newurl = myurl.substr(0, myurl.length - 1);

            //     var page = $(this).attr('href').split('page=')[1];
            //     var newurldata = (newurl + page);
            //     // console.log(newurldata);
            //     getData(myurl);
            // });


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

            })

            $('#ses_client').multiselect();
            $('.search_by').change(function() {
                $('.loading2').show();
                var ser = $(this).val();
                if (ser == 6) {

                    $.ajax({
                        type: "POST",
                        url: "{{ route('provider.session.get.clients') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            // console.log(data);
                            $('.ses_client').empty();
                            $.each(data, function(index, value) {
                                $('.ses_client').append(
                                    `<option value="${value.id}">${value.client_full_name}</option>`
                                )
                            });

                            $('#ses_client').multiselect({
                                includeSelectAllOption: true
                            });
                            $("#ses_client").multiselect('rebuild');

                            $('.loading2').hide();
                        }
                    });
                } else {
                    $('.loading2').hide();
                }
            });



            $('.billable-switch input').click(function(e) {
                if ($(this).prop("checked") == true) {
                    $('.billable-switch label').text('Billable');
                    $('.ses_app_type').val(1);
                    $('.patient').show();
                    $('.authorization').show();
                    $('.pos').show();
                    $('.date').show();
                    $('.status').show();
                    $('.all_secction').hide();
                    $('.p_th_remove').each(function() {
                        $(this).show();
                    })
                    $('.s_th_remove').each(function() {
                        $(this).show();
                    })
                    $('.schedule-filter').show();
                    $('.client-filter').show();

                    app_type_check = 1;


                } else if ($(this).prop("checked") == false) {
                    $('.billable-switch label').text('Non-Billable');
                    $('.ses_app_type').val(2);
                    $('.patient').hide();
                    $('.authorization').hide();
                    $('.pos').hide();
                    $('.date').hide();
                    $('.status').hide();
                    $('.all_secction').hide();
                    $('.schedule-filter').hide();
                    $('.client-filter').hide();
                    $('.p_th_remove').each(function() {
                        $(this).hide();
                    })
                    $('.s_th_remove').each(function() {
                        $(this).hide();
                    })
                    app_type_check = 2;
                }

            });

            $('#go_btn').click(function() {
                $('.show_animation').show();
                $('.all_secction').empty();
                let ses_proiders = $('.ses_proiders').val();
                let ses_client = $('.ses_client').val();
                let search_by = $('.search_by').val();
                let date_ranger = $('.date_ranger').val();
                page = 1;
                currentscrollHeight = 0;

                if (search_by == '' && app_type_check == 1) {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Client", 'ALERT!');
                } else {

                    $.ajax({
                        type: "POST",
                        url: "{{ route('provider.session.get.appoinments') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'ses_proiders': ses_proiders,
                            'ses_client': ses_client,
                            'search_by': search_by,
                            'date_ranger': date_ranger,
                            'app_type_check': app_type_check,
                        },
                        success: function(data) {
                            // console.log(data.view);
                            $('.show_animation').hide();
                            $('.all_secction').empty().html(data.view);
                            var billbele_check = $('#bn').prop('checked');
                            if (billbele_check == true) {
                                $('.b_col').show();

                            } else {
                                $('.b_col').hide();

                            }
                            $('.all_secction').show();

                        }
                    });
                }


            });


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
                    let ses_id = $(this).data('id');
                    if (client_email != '') {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('provider.meet.session.start') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'ses_id': ses_id
                            },
                            success: function(data) {
                                // console.log(data)
                                if (data.status == 'success') {
                                    $('.loading2').hide();
                                    $('#vdoApp').modal('hide');
                                    toastr["success"]('Telehealth link has been shared with ' +
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

            $('#okBtn').click(function() {
                $('.loading2').show();
                let type = $('.action_type').val();
                var check_array = [];
                $('.data_checkbox_appoinment:checked').each(function() {
                    var checked = ($(this).val());
                    check_array.push(checked);
                });

                if (check_array == null || check_array == "") {
                    $('.loading2').hide();
                    toastr["error"]("Please select appoinment", 'ALERT!');

                } else if (type == 0) {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Action", 'ALERT!');
                } else if (type == 1) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('provider.appoinment.delete') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'check_array': check_array,
                        },
                        success: function(data) {
                            $('#go_btn').click();
                            $('.loading2').hide();
                        }
                    });
                } else if (type == 2) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('provider.session.monthly.utilization') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'check_array': check_array,
                        },
                        success: function(data) {
                            $('.utilization_table').empty().html(data.view);
                            $('.loading2').hide();
                        }
                    });
                } else if (type == 4) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('provider.session.update.render') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'check_array': check_array,
                        },
                        success: function(data) {
                            $('#go_btn').click();
                            $('.loading2').hide();
                        }
                    });
                }
            });

            //upload singnature image
            {{-- $(document).on('click', '#sig-submitBtna', function (e) { --}}
            {{-- e.preventDefault(); --}}
            {{-- let canvas = document.getElementById('sig-canvas'); --}}
            {{-- let dataURL = canvas.toDataURL(); --}}
            {{-- let sing_seccid = $('.sing_seccid').val(); --}}
            {{-- let client_sing_id = $('.client_sing_id').val(); --}}
            {{-- let formData = new FormData('#client_sing_forma'); --}}
            {{-- console.log(formData) --}}
            {{-- if (dataURL != null || dataURL != "") { --}}
            {{-- $.ajax({ --}}
            {{-- type: "POST", --}}
            {{-- url: "{{route('provider.session.singature.save')}}", --}}
            {{-- data: { --}}
            {{-- '_token': "{{csrf_token()}}", --}}
            {{-- 'dataURL': dataURL, --}}
            {{-- 'sing_seccid': sing_seccid, --}}
            {{-- 'client_sing_id': client_sing_id, --}}

            {{-- }, --}}
            {{-- success: function (data) { --}}
            {{-- console.log(data) --}}
            {{-- console.log('done'); --}}
            {{-- $('#signatureModalPatient').modal('hide'); --}}
            {{-- } --}}
            {{-- }); --}}
            {{-- } --}}


            {{-- }); --}}


            $(document).on('click', '.patintsignmodal', function() {
                let ses_id = $(this).data('id');
                $('#sig-clearBtn').click();
                $.ajax({
                    type: "POST",
                    url: "{{ route('provider.session.id.data.get') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'ses_id': ses_id,

                    },
                    success: function(data) {
                        // console.log(data)
                        $('.sing_seccid').empty();
                        $('.sing_seccid').val(data.id);
                        $('.client_sing_id').empty();
                        $('.client_sing_id').val(data.client_id);
                        $('.sing_draw_txt').val('');

                    }
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //client sing form
            $(document).on('submit', '#client_sing_form', function(e) {
                e.preventDefault();

                $('.loading2').show();
                if (app_type_check == 1) {

                    let canvas = document.getElementById('sig-canvas');
                    let dataURL = canvas.toDataURL();

                    let sing_draw_txt = $('.sing_draw_txt').val(dataURL);
                    let sing_seccid = $('.sing_seccid').val();
                    let client_sing_id = $('.client_sing_id').val();
                    $('#signatureModalPatient').modal('hide');
                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('provider.session.singature.save') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            this.reset();
                            // console.log(data);
                            // $('.loading2').hide();
                            getDataFilter();


                        },
                        error: function(data) {
                            // console.log(data);
                        }
                    });
                }
            });

            function getDataFilter() {
                $('.loading2').show();
                $('.modal-backdrop').hide();

                let ses_proiders = $('.ses_proiders').val();
                let ses_client = $('.ses_client').val();
                let search_by = $('.search_by').val();
                let date_ranger = $('.date_ranger').val();
                $('#signatureModalPatient').hide();
                $.ajax({
                    type: "POST",
                    url: "{{ route('provider.session.get.appoinments') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'ses_proiders': ses_proiders,
                        'ses_client': ses_client,
                        'search_by': search_by,
                        'date_ranger': date_ranger,
                        'app_type_check': app_type_check,
                    },
                    success: function(data) {
                        // console.log(data);

                        $('.all_secction').show();
                        $('.all_secction').empty().html(data.view);
                        $('.loading2').hide();

                    }
                });
            }


            //provider sing file
            $(document).on('click', '.providersignmodal', function() {
                let ses_id = $(this).data('id');
                $('#sig-clearBtn2').click();
                $.ajax({
                    type: "POST",
                    url: "{{ route('provider.session.id.data.get') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'ses_id': ses_id,

                    },
                    success: function(data) {
                        // console.log(data)
                        $('.sing_seccid_provider').empty();
                        $('.sing_seccid_provider').val(data.id);
                        $('.client_sing_id_provider').empty();
                        $('.client_sing_id_provider').val(data.client_id);
                        $('.sing_draw_txt').val('');
                    }
                });
            });

            $(document).on('submit', '#client_sing_form_provider', function(e) {
                e.preventDefault();
                $('.loading2').show();
                let canvas2 = document.getElementById('sig-canvas2');
                let dataURL2 = canvas2.toDataURL();

                let sing_draw_txt_provider = $('.sing_draw_txt_provider').val(dataURL2);
                let sing_seccid_provider = $('.sing_seccid_provider').val();
                let client_sing_id_provider = $('.client_sing_id_provider').val();

                var formData = new FormData(this);
                $('#signatureModalProvider').modal('hide');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('provider.session.singature.save.provider') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        // console.log('provider');
                        getDataFilterProvider();
                        // $('.loading2').hide();
                    },
                    error: function(data) {
                        // console.log(data);
                    }
                });
            });


            function getDataFilterProvider() {
                $('.modal-backdrop').hide();
                $('.loading2').show();
                let ses_proiders = $('.ses_proiders').val();
                let ses_client = $('.ses_client').val();
                let search_by = $('.search_by').val();
                let date_ranger = $('.date_ranger').val();
                $('#signatureModalProvider').hide();
                $.ajax({
                    type: "POST",
                    url: "{{ route('provider.session.get.appoinments') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'ses_proiders': ses_proiders,
                        'ses_client': ses_client,
                        'search_by': search_by,
                        'app_type_check': app_type_check,
                        'date_ranger': date_ranger,
                    },
                    success: function(data) {
                        // console.log(data);

                        $('.all_secction').show();
                        $('.all_secction').empty().html(data.view);
                        $('.loading2').hide();

                    }
                });
            }
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
                    var myurl = ENDPOINT + '/provider/get-all-sessions?page=' + page;
                    console.log(myurl);
                    getData(myurl);
                    currentscrollHeight = scrollHeight;
                }
            });

            // $('#go_btn').click(function(e) {
            //     e.preventDefault();
            //     getAppSessionData();

            // });

            $('.show_animation').hide();

            // let getAppSessionData = () => {
            //     $('.show_animation').show();
            //     $('.all_secction').empty();
            //     $('.all_secction').hide();
            //     page = 1;
            //     currentscrollHeight = 0;

            //     $('.modal-backdrop').hide();
            //     let ses_proiders = $('.ses_proiders').val();
            //     let ses_client = $('.ses_client').val();
            //     let search_by = $('.search_by').val();
            //     let date_ranger = $('.date_ranger').val();
            //     $('#signatureModalProvider').hide();

            //     $.ajax({
            //         type: "POST",
            //         url: "{{ route('provider.session.get.appoinments') }}",
            //         data: {
            //             '_token': "{{ csrf_token() }}",
            //             'ses_proiders': ses_proiders,
            //             'ses_client': ses_client,
            //             'search_by': search_by,
            //             'app_type_check': app_type_check,
            //             'date_ranger': date_ranger,
            //         },
            //         success: function(data) {
            //             console.log(data);
            //             $('.all_secction').append(data.view)
                        
            //             $('.all_secction').show();
            //             $('.show_animation').hide();
            //             $('.c_table').trigger('update')

            //         }
            //     });

            // }


            $(document).on('click', '.appoinemt_details', function() {
                $('.loading2').show();
                let app_id = $(this).data('id');
                $('.billable_check_true, .billable_check_false, .telehealth_check').hide();


                // $('.session_app_location option[value="'+location+'"]').prop("selected",true);

                $.ajax({
                    type: "POST",
                    url: "{{ route('provider.session.app.get.details') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'app_id': app_id,
                        'billable': app_type_check
                    },
                    success: function(data) {
                        // console.log(data)

                        if (app_type_check == 1) {

                            client_email = data.client.email;
                            client_name = data.client.client_full_name;

                            $('.billable_check_true').show();
                            $('.edit_sess_id').val(data.app.id);

                            $('.session_app_client_name').empty().append(
                                `<option value="${data.client.id}">${data.client.client_full_name}</option>`
                            );

                            $('.session_app_client_auth').empty().append(
                                `<option value="${data.auth.id}">${data.auth.authorization_name}</option>`
                            );

                            $('.session_app_client_act').empty().append(
                                `<option value="${data.act.id}">${data.act.activity_name}</option>`
                            );

                            $('.session_app_provider').empty().append(
                                `<option value="${data.prov.id}">${data.prov.full_name}</option>`
                            );

                            $('.session_app_location').val(data.app.location);


                            var time = moment(new Date(data.app.schedule_date)).utc().format(
                                'MM/DD/YYYY');

                            const datepicker = MCDatepicker.create({
                                el: '#proup_app_date_time',
                                selectedDate: new Date(time),
                                autoClose: true,
                                dateFormat: 'mm/dd/yyyy',
                                showCalendarDisplay: false
                            })


                            $('.proup_app_date_time').val(time)


                            var formtime = moment(new Date(data.app.from_time)).format(
                                'HH:mm');

                            $('.proedit_sess_start_time').val(formtime);


                            var to_time = moment(new Date(data.app.to_time)).format(
                                'HH:mm');

                            $('.proedit_sess_to_time').val(to_time);


                            $('.session_app_time_status').val(data.app.status);
                            $('.session_app_notes').val(data.app.notes);


                            $('.client_email').val(client_email);
                            $('.meet_start').attr('data-id', data.app.id);

                        } else {

                            $('.billable_check_false').show();

                            $('.edit_sess_id').val(data.app.id);

                            $('.session_app_client_name').empty().append(
                                ` <option value="1">Non-Billable Client</option>`
                            );

                            $('.session_app_client_auth').empty().append(
                                ` <option value="1">NONCLI01323_AUTH249</option>`
                            );

                            $('.session_app_client_act').empty().append(
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

                            $('.session_app_client_act, .session_app_client_auth').prop(
                                'disabled', true);

                            $('.session_app_provider').empty().append(
                                `<option value="${data.prov.id}">${data.prov.full_name}</option>`
                            );

                            $('.session_app_location').val(data.app.location);


                            var time = moment(new Date(data.app.schedule_date)).utc().format(
                                'MM/DD/YYYY');

                            const datepicker = MCDatepicker.create({
                                el: '#proup_app_date_time',
                                selectedDate: new Date(time),
                                autoClose: true,
                                dateFormat: 'mm/dd/yyyy',
                                showCalendarDisplay: false
                            })


                            $('.proup_app_date_time').val(time)


                            var formtime = moment(new Date(data.app.from_time)).format(
                                'HH:mm');

                            $('.proedit_sess_start_time').val(formtime);


                            var to_time = moment(new Date(data.app.to_time)).format(
                                'HH:mm');

                            $('.proedit_sess_to_time').val(to_time);


                            $('.session_app_time_status').val(data.app.status);
                            $('.session_app_notes').val(data.app.notes);
                        }

                        if (app_type_check == 1 && data.app.location == "02") {
                            $('.telehealth_session_id').attr("data-id", app_id);
                            $('.telehealth_check').show();
                        }

                        if (data.app.is_locked != 0) {
                            $('.app_not_locket').hide();
                            $('.app_locked').show();
                        } else {
                            $('.app_locked').hide();
                            $('.app_not_locket').show();
                        }
                        $('.loading2').hide();

                        $('#eeditAppointement').modal("show");
                    }
                });
            });


            $(document).on('click', '.addNoteForms', function() {
                $('.loading2').show();
                $('.from_session_id_hidden').val('');
                session_id = $(this).data("id");
                $('.from_session_id_hidden').val(session_id);
                $.ajax({
                    type: "POST",
                    url: "{{ route('provider.session.get.templatename') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        // console.log('template is ', data);
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
                        $('#formNote').modal('show');
                    }
                });
            })

            $(document).on('click', '.createdNoteform', function() {
                let ses_id = $(this).data('id');
                $('.created_from_session_id_hidden').val(ses_id);
                $('#createdFormNote').modal("show");
                $.ajax({
                    type: "POST",
                    url: "{{ route('provider.get.appoinment.created.templatename') }}",
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
                                    `<option value="custom-` + val.id + `">` + val
                                    .name + `</option>`
                                )
                            });

                        }
                    }
                });
            })


            $(document).on('click', '#update_appoinment', function(e) {
                e.preventDefault();
                let appooinment_craete_status_name = $('.session_app_time_status').val();
                let edit_sess_id = $('.edit_sess_id').val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('provider.session.update') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'edit_sess_id': edit_sess_id,
                        'appooinment_craete_status_name': appooinment_craete_status_name,
                    },
                    success: function(data) {
                        // console.log(data)

                        if (data == 'done') {
                            $('.loading2').hide();
                            $('#eeditAppointement').modal("hide");
                            getDataAfterSubmitAPP();
                        }

                    }
                });
            });


            function getDataAfterSubmitAPP() {
                $('#go_btn').click();
            }

        });


        function getData(myurl) {
            let ses_proiders = $('.ses_proiders').val();
            let ses_client = $('.ses_client').val();
            let search_by = $('.search_by').val();
            let date_ranger = $('.date_ranger').val();
            $('.show_animation').show();
            $.ajax({
                url: myurl,
                type: "get",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'ses_proiders': ses_proiders,
                    'ses_client': ses_client,
                    'search_by': search_by,
                    'date_ranger': date_ranger,
                    'app_type_check': app_type_check
                },
                datatype: "html"
            }).done(function(data) {
                $('.all_secction').append(data.view);
                $('.c_table').trigger('update');
                $('.show_animation').hide();

            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
                $('.loading2').hide();
                $('.show_animation').hide();
            });
        }
    </script>



    <script>
        $(document).on('click', '.view_sig_btn', function() {

            $('.client_sig_image').attr('src', '');
            $('.client_sig_date').text('');
            $('.provider_sig_image').attr('src', '');
            $('.provider_sig_date').text('');

            $('.client_sig_image, .client_sig_date, .provider_sig_image, .provider_sig_date').hide();
            c_image = $(this).closest('tr').find('.h_client_image').val();
            c_date = $(this).closest('tr').find('.h_client_date').val();

            p_image = $(this).closest('tr').find('.h_provider_image').val();
            p_date = $(this).closest('tr').find('.h_provider_date').val();


            // console.log(c_image,c_date,p_image,p_date);

            if (c_image != 'empty') {
                $('.client_sig_image').attr('src', c_image);
                $('.client_sig_image').show();
            }
            if (c_date != 'empty') {
                $('.client_sig_date').text(c_date);
                $('.client_sig_date').show();
            }
            if (p_image != 'empty') {
                $('.provider_sig_image').attr('src', p_image);
                $('.provider_sig_image').show();
            }
            if (p_date != 'empty') {
                $('.provider_sig_date').text(p_date);
                $('.provider_sig_date').show();
            }


            $('#viewSignature').modal('show');

        })

        $(document).on('click', '.view_add_btn', function() {
            $('.address_modal_body').text('');
            addresss = $(this).closest('tr').find('.h_address').val();
            if (addresss != 'empty') {
                $('.address_modal_body').text(addresss);
            }
            $('#addressModal').modal('show');
        })


        $(document).on('click', '.addNoteForms', function() {
            $('.from_session_id_hidden').val('');
            session_id = $(this).data("id");
            $('.from_session_id_hidden').val(session_id);
            $('#formNote').modal('show');
        })
    </script>



    <script src="{{ asset('assets/dashboard/vendor/') }}/signature/sketchpad.js"></script>
    <script>
        $('#signatureModalPatient').on('shown.bs.modal', function() {
            var modalDialogHeight = $(this).find('.modal-body').outerHeight(true);
            var modalDialogWidth = $(this).find('.modal-body').outerWidth(true);

            var sketchpad = new Sketchpad({
                element: '#sig-canvas',
                height: modalDialogHeight - 190,
                width: modalDialogWidth - 35
            });

            sketchpad.penSize = 3;
            $('#sig-clearBtn').click(function() {
                sketchpad.clear();
            })
        });


        $('#signatureModalProvider').on('shown.bs.modal', function() {
            var modalDialogHeight = $(this).find('.modal-body').outerHeight(true);
            var modalDialogWidth = $(this).find('.modal-body').outerWidth(true);

            var sketchpad2 = new Sketchpad({
                element: '#sig-canvas2',
                height: modalDialogHeight - 190,
                width: modalDialogWidth - 35
            });

            sketchpad2.penSize = 3;
            $('#sig-clearBtn2').click(function() {
                sketchpad2.clear();
            })
        });
    </script>
@endsection
