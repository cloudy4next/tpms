<script>

    //Selectors for speeding up jquery search
    var loading_s = $('.loading2');
    var sc_client_s = $('#sc_client_id');
    var sc_loading_s = $('#sc_loading');
    var sc_auth_s = $('#sc_auth_id');
    var sc_act_s = $('#sc_act_id');
    var sc_nb_provider_s = $('#sc_nb_provider_id');
    var sc_end_box_s = $('#sc_end_date_box');
    var sc_daily_box_s = $('#sc_daily_check_box');
    var sc_provider_s = $('#sc_provider_id');
    var sc_location_s = $('#sc_location');
    var sc_date_s = $('#datepicker_appoint');
    var sc_from_s = $('#sc_from_time');
    var sc_to_s = $('#sc_to_time');
    var sc_status_s = $('#sc_status');
    var sc_r_check_s = $('#sc_r_check');
    var sc_end_date_s = $('#datepicker_endpoint');
    var sc_daily_check_s = $('#sc_daily_check');

    //Variables being declared as global

    var sc_billable;
    var sc_client_id;
    var sc_authorization_id;
    var sc_activity_id;
    var sc_provider_id;
    var sc_provider_mul_id;
    var sc_location;
    var sc_from_time;
    var sc_form_time_session;
    var sc_to_time_session;
    var sc_status;
    var sc_end_date;
    var sc_day_name;
    var sc_chkrecurrence;
    var sc_daily;


    //functions

    function nb_hide() {
        //function for showing billable content
        sc_client_s.empty();
        sc_auth_s.empty();
        sc_act_s.empty();
        $('#sc_nb_provider_box').hide();
        $('#sc_provider_box').show();
        sc_client_s.prop("disabled", false);
        sc_auth_s.prop("disabled", false);
    }

    function nb_show() {
        //function for showing non-billable content
        sc_client_s.prop("disabled", true);
        sc_auth_s.prop("disabled", true);

        sc_client_s.empty().append(
            ` <option value="1">Non-Billable Client</option>`
        );

        sc_auth_s.empty().append(
            ` <option value="1">NONCLI01323_AUTH249</option>`
        );

        sc_act_s.empty().append(
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

        $('#sc_provider_box').hide();
        $('#sc_nb_provider_box').show();
    }

    function sc_fetch_clients() {
        //function for fetching clients
        $.ajax({
            type: "POST",
            url: "{{route('superadmin.get.all.client')}}",
            data: {
                '_token': "{{csrf_token()}}",
            },
            success: function (data) {
                sc_auth_s.empty();
                sc_client_s.empty();
                sc_client_s.prop("disabled", false);
                sc_client_s.append(`<option value="0"></option>`);
                $.each(data, function (index, value) {
                    sc_client_s.append(
                        ` <option value="${value.id}">${value.text}</option>`
                    );
                });
                loading_s.hide();
            }
        });
    }

    function sc_fetch_providers() {
        //function for fetching providers
        $.ajax({
            type: "POST",
            url: "{{route('superadmin.get.all.provider')}}",
            data: {
                '_token': "{{csrf_token()}}",
            },
            success: function (data) {
                sc_provider_s.empty();
                sc_provider_s.append(`<option value="0"></option>`);
                $.each(data, function (index, value) {
                    sc_provider_s.append(
                        ` <option value="${value.id}">${value.text}</option>`
                    );
                });
                loading_s.hide();
            }
        });
    }

    function sc_fetch_nb_providers() {
        //function for fetching all providers for non-billable
        loading_s.show();
        $.ajax({
            type: "POST",
            url: "{{route('superadmin.get.all.employee')}}",
            data: {
                '_token': "{{csrf_token()}}",
            },
            success: function (data) {
                sc_nb_provider_s.empty();
                if (data.length > 0) {
                    $.each(data, function (index, value) {
                        sc_nb_provider_s.append(
                            `<option value="${value.id}">${value.full_name}</option>`
                        );
                    });
                }
                sc_nb_provider_s.multiselect('rebuild');
                loading_s.hide();
            }
        });
    }

    function sc_fetch_auths() {
        //function for fetching authorizations
        var sc_c_id = sc_client_s.val();
        sc_auth_s.empty().html(`<option value="0"></option>`);
        sc_act_s.empty();
        $.ajax({
            xhr: function () {
                $('.app_progress .progress-bar').css("width", '0%');
                $('.app_progress .progress-bar').show();
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.app_progress .progress-bar').css("width", percentComplete + '%');
                        if (percentComplete === 100) {
                            $('.app_progress .progress-bar').fadeOut();
                        }
                    }
                }, false);
                return xhr;
            },
            type: "POST",
            url: "{{route('superadmin.appoinment.autho.get')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'client_id': sc_c_id,
            },
            success: function (data) {
                // console.log(data)
                $.each(data, function (index, value) {
                    sc_auth_s.append(
                        ` <option value="${value.id}">${value.text}</option>`
                    );
                });
            }
        });
    }

    function sc_fetch_act() {
        //function for fetching activities
        var sc_auth_id = sc_auth_s.val();
        sc_act_s.empty().html(`<option value="0"></option>`);
        $.ajax({
            xhr: function () {
                $('.app_progress .progress-bar').css("width", '0%');
                $('.app_progress .progress-bar').show();
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.app_progress .progress-bar').css("width", percentComplete + '%');
                        if (percentComplete === 100) {
                            $('.app_progress .progress-bar').fadeOut();
                        }
                    }
                }, false);
                return xhr;
            },
            type: "POST",
            url: "{{route('superadmin.appoinment.autho.activity.get')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'auth_id': sc_auth_id,
            },
            success: function (data) {
                $.each(data, function (index, value) {
                    sc_act_s.append(
                        ` <option value="${value.id}">${value.text}</option>`
                    );
                });
            }
        });
    }

    function sc_session_save() {
        sc_loading_s.show();
        $.ajax({
            type: "POST",
            url: "{{route('superadmin.appoinment.save')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'billable': sc_billable,
                'client_id': sc_client_id,
                'authorization_id': sc_authorization_id,
                'activity_id': sc_activity_id,
                'provider_id': sc_provider_id,
                'provider_mul_id': sc_provider_mul_id,
                'location': sc_location,
                'from_time': sc_from_time,
                'form_time_session': sc_form_time_session,
                'to_time_session': sc_to_time_session,
                'status': sc_status,
                'chkrecurrence': sc_chkrecurrence,
                'daily': sc_daily,
                'end_date': sc_end_date,
                'day_name': sc_day_name
            },
            success: function (data) {
                sc_loading_s.hide();
                $('#sc_sub_btn').prop('disabled', false);
                if (data == 'appoinemtcreated') {
                    $('#sc_modal').modal('hide');
                    $('#sc_form').trigger("reset");
                    toastr["success"]("Appoinment Successfully Created", 'SUCCESS!');
                } else if (data == "errorauthhourDay") {
                    toastr["error"]("You are scheduling over the authorized hours per day. Please Check the approved hours set in the system and schedule.", 'ALERT!');
                } else if (data == "errorauthhourWeek") {
                    toastr["error"]("You are scheduling over the authorized hours per week. Please Check the approved hours set in the system and schedule.", 'ALERT!');
                } else if (data == "errorauthhourMonth") {
                    toastr["error"]("You are scheduling over the authorized hours per month. Please Check the approved hours set in the system and schedule.", 'ALERT!');
                } else if (data == "errorauthhourTotal Auth") {
                    toastr["error"]("You are scheduling over the authorized hours. Please Check the approved hours set in the system and schedule.", 'ALERT!');
                } else if (data == "holiday") {
                    toastr["error"]("You are Scheduling on a Holiday", 'ALERT!');
                } else if (data == "authstart") {
                    toastr["error"]("You are scheduling the session prior to the auth start date", 'ALERT!');
                } else if (data == "authend") {
                    toastr["error"]("You are scheduling the session after to the auth end date", 'ALERT!');
                } else if (data == "recauthstart") {
                    toastr["error"]("The Recurrence end date is prior auth start date", 'ALERT!');
                } else if (data == "recauthend") {
                    toastr["error"]("The Recurrence end date is after auth start date", 'ALERT!');
                } else if (data == "inactiveclient") {
                    toastr["error"]("Patient Is In-Active.Please Make Active Patient", 'ALERT!');
                } else if (data == "morethan8") {
                    toastr["error"]("Session is more then 8 hours", 'ALERT!');
                } else if (data == "clientauth") {
                    toastr["error"]("Authorization and Activity is not belongs to Patient", 'ALERT!');
                } else if (data == "timeCheck") {
                    toastr["error"]('Time in "To Time" is past than "From Time".', 'ALERT!');
                } else if (data == "authempty") {
                    toastr["error"]('Please set maximum frequency in Authorization Activity.', 'ALERT!');
                }
                // else if (data == "error9") {
                //     toastr["error"]("Provider already has Scheduled this time", 'ALERT!');
                // }
            }
        });
    }

    $(document).ready(function () {
        loading_s.hide();
        sc_loading_s.hide();
        sc_end_box_s.hide();
        sc_daily_box_s.hide();
        sc_nb_provider_s.multiselect({includeSelectAllOption: true});
        nb_hide();

        //billable switch change event

        $('#bill_switch').change(function () {
            if ($(this).is(':checked')) {
                $('#sc_form').trigger("reset");
                nb_hide();
                loading_s.show();
                sc_fetch_clients();
                sc_end_box_s.hide();
                sc_daily_box_s.hide();
                $('#week_days_box').hide();

            } else {
                $('#sc_form').trigger("reset");
                $(this).prop("checked", false);
                nb_show();
                sc_fetch_nb_providers();
                sc_end_box_s.hide();
                sc_daily_box_s.hide();
                $('#week_days_box').hide();
            }
        });

        //Recurrance content show/hide
        sc_r_check_s.change(function () {
            if ($(this).is(':checked')) {
                sc_end_box_s.show();
                sc_daily_box_s.show();
            } else {
                sc_end_box_s.hide();
                sc_daily_box_s.hide();
            }
        });

        //Weeks days show/hide in recurrance

        sc_daily_check_s.change(function () {
            if ($(this).is(':checked')) {
                sc_daily_box_s.find('label').text('Weekly');
                $('#week_days_box').show();

            } else {
                sc_daily_box_s.find('label').text('Daily');
                $('#week_days_box').hide();

            }
        })

        //Client Id change event(Fetch Authorizations)
        sc_client_s.change(function () {
            sc_fetch_auths();
        });


        //Authorization Change Event(Fetch Activity)
        sc_auth_s.change(function () {
            sc_fetch_act();
        })


        //Select All Providers Button in Non Billable

        $('#sc_sa_provider').click(function () {
            sc_nb_provider_s.multiselect('selectAll');
        })


        //On click Add Appointment List Item
        $('#sc_btn').click(function () {
            $('#sc_form').trigger('reset');
            nb_hide();
            sc_daily_box_s.hide();
            sc_end_box_s.hide();
            sc_daily_box_s.find('label').text('Daily');
            $('.rpattern-switch').show();
            $('#week_days_box').hide();
            sc_fetch_clients();
            sc_fetch_providers();
        });

        //On clicking Add Appointment Button in modal


        $('#sc_sub_btn').click(function (e) {
            e.preventDefault();
            $('#sc_sub_btn').prop('disabled', true);
            if ($('#bill_switch').prop('checked') == true) {
                sc_billable = 1;
            } else {
                sc_billable = 2;
            }
            sc_client_id = sc_client_s.val();
            sc_authorization_id = sc_auth_s.val();
            sc_activity_id = sc_act_s.val();
            sc_provider_id = sc_provider_s.val();
            sc_provider_mul_id = sc_nb_provider_s.val();
            sc_location = sc_location_s.val();
            sc_from_time = sc_date_s.val();
            sc_form_time_session = sc_from_s.val();
            sc_to_time_session = sc_to_s.val();
            sc_status = sc_status_s.val();
            sc_end_date = sc_end_date_s.val();
            sc_day_name = [];

            if (sc_r_check_s.is(':checked')) { sc_chkrecurrence = 1; } else { sc_chkrecurrence = 0;}
            if (sc_daily_check_s.is(':checked')) { sc_daily = 2; } else { sc_daily = 1;}
            
            $(".sc_day_name").each(function () {
                if ($(this).is(':checked')) {
                    var checked = $(this).val();
                    sc_day_name.push(checked);
                }
            });

            if (sc_billable == 1) {
                if (sc_client_id == 0 || sc_client_id == '') {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select Client", 'ALERT!');
                } else if (sc_authorization_id == 0 || sc_authorization_id == '') {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select Auth", 'ALERT!');
                } else if (sc_activity_id == 0 || sc_activity_id == '') {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select Activity", 'ALERT!');
                } else if (sc_provider_id == 0 || sc_provider_id == '') {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select Provider", 'ALERT!');
                } else if (sc_location == null || sc_location == "" || sc_location == 0) {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select Location", 'ALERT!');
                } else if (sc_from_time == null || sc_from_time == "") {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select From Time", 'ALERT!');
                } else if (sc_status == null || sc_status == "") {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select Status", 'ALERT!');
                } else if (sc_chkrecurrence == 1 && (sc_end_date == null || sc_end_date == "")) {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select End Date", 'ALERT!');
                } else if (sc_daily == 2 && sc_day_name.length == 0) {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select Weekly Days", 'ALERT!');
                } else {
                    sc_session_save();
                }
            } else {

                if (sc_provider_mul_id == null || sc_provider_mul_id.length == 0) {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select Provider", 'ALERT!');
                } else if (sc_location == null || sc_location == "" || sc_location == 0) {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select Location", 'ALERT!');
                } else if (sc_from_time == null || sc_from_time == "") {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select Date & Time", 'ALERT!');
                } else if (sc_status == null || sc_status == "") {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select Status", 'ALERT!');
                } else if (sc_chkrecurrence == 1 && (sc_end_date == null || sc_end_date == "")) {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select End Date", 'ALERT!');
                } else if (sc_daily == 2 && sc_day_name.length == 0) {
                    $('#sc_sub_btn').prop('disabled', false);
                    toastr["error"]("Please Select Weekly Days", 'ALERT!');
                } else {
                    sc_session_save();
                }
            }
        })
    })
</script>

<script>
    //Selectors for speeding up jquery search

    var loading_s = $('.loading2');
    var su_client_s = $('#su_client_id');
    var su_loading_s = $('#su_loading');
    var su_auth_s = $('#su_auth_id');
    var su_act_s = $('#su_act_id');
    var su_provider_s = $('#su_provider_id');
    var su_location_s = $('#su_location');
    var su_date_s = $('#su_from_date');
    var su_from_s = $('#su_from_time');
    var su_to_s = $('#su_to_time');
    var su_status_s = $('#su_status');

    //Variables being declared as global

    var su_client_id;
    var su_authorization_id;
    var su_activity_id;
    var su_provider_id;
    var su_location;
    var su_from_time;
    var su_form_time_session;
    var su_to_time_session;
    var su_status;
    var su_billable;
    var su_session_id;

    function print_nb(act_id) {
        su_client_s.prop("disabled", true);
        su_auth_s.prop("disabled", true);

        su_client_s.html(
            ` <option value="1">Non-Billable Client</option>`
        );

        su_auth_s.html(
            ` <option value="1">NONCLI01323_AUTH249</option>`
        );

        su_act_s.html(
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
        su_act_s.val(act_id);
    }

    function print_client(client_id) {
        su_client_s.html(`<option value="0"></option>`);
        su_client_s.prop("disabled", false);
        $.ajax({
            type: "POST",
            url: "{{route('superadmin.get.all.client')}}",
            data: {
                '_token': "{{csrf_token()}}",
            },
            success: function (data) {
                $.each(data, function (index, value) {
                    su_client_s.append(
                        ` <option value="${value.id}">${value.text}</option>`
                    );
                });
                su_client_s.val(client_id);
            }
        });
    }

    function print_auth(client_id, auth_id = 0) {
        su_auth_s.html(`<option value="0"></option>`);
        su_act_s.empty();
        $.ajax({
            xhr: function () {
                $('.su_progress .progress-bar').css("width", '0%');
                $('.su_progress .progress-bar').show();
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.su_progress .progress-bar').css("width", percentComplete + '%');
                        if (percentComplete === 100) {
                            $('.su_progress .progress-bar').fadeOut();
                        }
                    }
                }, false);
                return xhr;
            },
            type: "POST",
            url: "{{route('superadmin.appoinment.autho.get')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'client_id': client_id,
            },
            success: function (data) {
                $.each(data, function (index, value) {
                    su_auth_s.append(
                        ` <option value="${value.id}">${value.text}</option>`
                    );
                });

                if (auth_id != 0) {
                    su_auth_s.val(auth_id);
                }
            }
        });
    }

    function print_activity(auth_id, act_id = 0) {
        su_act_s.html(`<option value="0"></option>`);
        $.ajax({
            xhr: function () {
                $('.su_progress .progress-bar').css("width", '0%');
                $('.su_progress .progress-bar').show();
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.su_progress .progress-bar').css("width", percentComplete + '%');
                        if (percentComplete === 100) {
                            $('.su_progress .progress-bar').fadeOut();
                        }
                    }
                }, false);
                return xhr;
            },
            type: "POST",
            url: "{{route('superadmin.appoinment.autho.activity.get')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'auth_id': auth_id,
            },
            success: function (data) {
                $.each(data, function (index, value) {
                    su_act_s.append(
                        ` <option value="${value.id}">${value.text}</option>`
                    );
                });
                if (act_id != 0) {
                    su_act_s.val(act_id);
                }
            }
        });
    }

    function print_provider(provider_id) {
        su_provider_s.html(`<option value="0"></option>`);
        $.ajax({
            type: "POST",
            url: "{{route('superadmin.get.all.provider')}}",
            data: {
                '_token': "{{csrf_token()}}",
            },
            success: function (data) {
                $.each(data, function (index, value) {
                    su_provider_s.append(
                        ` <option value="${value.id}">${value.text}</option>`
                    );
                });

                su_provider_s.val(provider_id);
            }
        });
    }

    function print_location(location) {
        su_location_s.val(location);
    }

    function print_time(data) {
        su_date_s.val(date_format(data.schedule_date));
        su_from_s.val(time_format(data.from_time));
        su_to_s.val(time_format(data.to_time));
    }

    function print_status(status) {
        su_status_s.val(status);
    }

    function date_format(date) {
        return moment(new Date(date)).utc().format('MM/DD/YYYY');
    }

    function time_format(time) {
        return moment(new Date(time)).format('HH:mm');
    }

    function get_single_session(id) {
        $.ajax({
            type: "POST",
            url: "{{route('superadmin.appoinment.update.get.details')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'id': id,
            },
            success: function (data) {
                if (data.status != "success") {
                    return false;
                }
                var s = data.app_data;
                su_billable = s.billable;

                if (s.is_locked == 1) {
                    $('#su_sub_btn').hide();
                    $('#su_sub_lock_btn').show();
                } else {
                    $('#su_sub_btn').show();
                    $('#su_sub_lock_btn').hide();
                }

                if (s.location == 02 || s.location == 10) {
                    $('.client_email').val(data.email);
                    $('.show_viewbtndiv1').show();
                    $('.show_viewbtndiv').show();
                    $('.meet_start').attr('data-id', s.id);
                } else {
                    $('.show_viewbtndiv1').hide();
                    $('.show_viewbtndiv').hide();
                }

                if (s.billable == 1) {
                    print_client(s.client_id);
                    print_auth(s.client_id, s.authorization_id);
                    print_activity(s.authorization_id, s.authorization_activity_id);
                } else {
                    print_nb(s.authorization_activity_id);
                }
                print_provider(s.provider_id);
                print_location(s.location);
                print_status(s.status);
                print_time(s);
            }
        });
    }


    function su_session_save() {
        su_loading_s.show();
        $.ajax({
            type: "POST",
            url: "{{route('superadmin.appoinment.update')}}",
            data: {
                '_token': "{{csrf_token()}}",
                "app_id": su_session_id,
                'billable': su_billable,
                'client_id': su_client_id,
                'authorization_id': su_authorization_id,
                'activity_id': su_activity_id,
                'provider_id': su_provider_id,
                'location': su_location,
                'from_time': su_from_time,
                'form_time_session': su_form_time_session,
                'to_time_session': su_to_time_session,
                'status': su_status,
            },
            success: function (data) {
                su_loading_s.hide();
                $('#su_sub_btn').prop('disabled', false);
                if (data == 'sessionUpdated') {
                    $('#su_modal').modal('hide');
                    $('#su_form').trigger("reset");
                    $('#getdetailappoinment').click();
                    toastr["success"]("Appoinment Successfully Updated.", 'SUCCESS!');
                } else if (data == "errorauthhourDay") {
                    toastr["error"]("You are scheduling over the authorized hours per day. Please Check the approved hours set in the system and schedule.", 'ALERT!');
                } else if (data == "errorauthhourWeek") {
                    toastr["error"]("You are scheduling over the authorized hours per week. Please Check the approved hours set in the system and schedule.", 'ALERT!');
                } else if (data == "errorauthhourMonth") {
                    toastr["error"]("You are scheduling over the authorized hours per month. Please Check the approved hours set in the system and schedule.", 'ALERT!');
                } else if (data == "errorauthhourTotal Auth") {
                    toastr["error"]("You are scheduling over the authorized hours. Please Check the approved hours set in the system and schedule.", 'ALERT!');
                } else if (data == "holiday") {
                    toastr["error"]("You are Scheduling on a Holiday", 'ALERT!');
                } else if (data == "authstart") {
                    toastr["error"]("You are scheduling the session prior to the auth start date", 'ALERT!');
                } else if (data == "authend") {
                    toastr["error"]("You are scheduling the session after to the auth end date", 'ALERT!');
                } else if (data == "recauthstart") {
                    toastr["error"]("The Recurrence end date is prior auth start date", 'ALERT!');
                } else if (data == "recauthend") {
                    toastr["error"]("The Recurrence end date is after auth start date", 'ALERT!');
                } else if (data == "inactiveclient") {
                    toastr["error"]("Patient Is In-Active.Please Make Active Patient", 'ALERT!');
                } else if (data == "morethan8") {
                    toastr["error"]("Session is more then 8 hours", 'ALERT!');
                } else if (data == "clientauth") {
                    toastr["error"]("Authorization and Activity is not belongs to Patient", 'ALERT!');
                } else if (data == "timeCheck") {
                    toastr["error"]('Time in "To Time" is past than "From Time".', 'ALERT!');
                } else if (data == "authempty") {
                    toastr["error"]('Please set maximum frequency in Authorization Activity.', 'ALERT!');
                }
            }
        });
    }

    $(document).ready(function () {

        MCDatepicker.create({
                el: '#su_from_date',
                autoClose: true,
                dateFormat: 'mm/dd/yyyy'
            }
        )

        $('#su_loading').hide();

        $(document).on('click', '.edit_session_btn', function () {
            $('.show_viewbtndiv1').hide();
            $('.show_viewbtndiv').hide();
            $('#su_form').trigger('reset');
            su_session_id = $(this).data("id");
            get_single_session(su_session_id);
        });

        su_client_s.change(function () {
            print_auth($(this).val());
        });

        su_auth_s.change(function () {
            print_activity($(this).val());
        })


    })

    $('#su_sub_btn').click(function (e) {
        e.preventDefault();
        $('#su_sub_btn').prop('disabled', true);
        su_client_id = su_client_s.val();
        su_authorization_id = su_auth_s.val();
        su_activity_id = su_act_s.val();
        su_provider_id = su_provider_s.val();
        su_location = su_location_s.val();
        su_from_time = su_date_s.val();
        su_form_time_session = su_from_s.val();
        su_to_time_session = su_to_s.val();
        su_status = su_status_s.val();

        if (su_billable == 1) {
            if (su_client_id == 0 || su_client_id == '') {
                $('#su_sub_btn').prop('disabled', false);
                toastr["error"]("Please Select Client", 'ALERT!');
            } else if (su_authorization_id == 0 || su_authorization_id == '') {
                $('#su_sub_btn').prop('disabled', false);
                toastr["error"]("Please Select Auth", 'ALERT!');
            } else if (su_activity_id == 0 || su_activity_id == '') {
                $('#su_sub_btn').prop('disabled', false);
                toastr["error"]("Please Select Activity", 'ALERT!');
            } else if (su_provider_id == 0 || su_provider_id == '') {
                $('#su_sub_btn').prop('disabled', false);
                toastr["error"]("Please Select Provider", 'ALERT!');
            } else if (su_location == null || su_location == "" || su_location == 0) {
                $('#su_sub_btn').prop('disabled', false);
                toastr["error"]("Please Select Location", 'ALERT!');
            } else if (su_from_time == null || su_from_time == "") {
                $('#su_sub_btn').prop('disabled', false);
                toastr["error"]("Please Select From Time", 'ALERT!');
            } else if (su_status == null || su_status == "") {
                $('#su_sub_btn').prop('disabled', false);
                toastr["error"]("Please Select Status", 'ALERT!');
            } else {
                su_session_save();
            }
        } else {

            if (su_provider_id == 0 || su_provider_id == '') {
                $('#su_sub_btn').prop('disabled', false);
                toastr["error"]("Please Select Provider", 'ALERT!');
            } else if (su_location == null || su_location == "" || su_location == 0) {
                $('#su_sub_btn').prop('disabled', false);
                toastr["error"]("Please Select Location", 'ALERT!');
            } else if (su_from_time == null || su_from_time == "") {
                $('#su_sub_btn').prop('disabled', false);
                toastr["error"]("Please Select Date & Time", 'ALERT!');
            } else if (su_status == null || su_status == "") {
                $('#su_sub_btn').prop('disabled', false);
                toastr["error"]("Please Select Status", 'ALERT!');
            } else {
                su_session_save();
            }
        }
    })
</script>
