@section('js')
    <script src="{{ asset('assets/dashboard/custom/billing.js') }}"></script>
    <script>
        $('.loading2').hide();
        $('.table_data_show').hide();
        $('.show_animation').hide()
        var sr_check = 2;
        var s_check = 2;
        var data_check = 2;

        $('.run_scrubbing_btn').hide();
        $('.download_div').hide();

        function fill_scrubbing_modal(c_id, errors) {
            var sel=$('#scrubbing_modal').find('.error_list');
            sel.html('');
            html = '<ol>';
            $.each(errors, function (i, warn) {
                html += '<li style="color: black;">' + warn.description + '</li>';
            });
            html += '</ol>';

            sel.html(html);

        }
        var scrubbing_records;

        function apply_scrubbing(data) {
            // console.log(data);
            scrubbing_records=data;
            $('.s_pro_name_td, .s_hours_td, .s_date_td').removeClass('text-danger');
            $('.cpt_name, .rates_name, .m1_name, .m2_name, .m3_name, .m4_name, .unit_name').removeClass('border-danger');
            $.each(data, function (i, record) {
                tclaim_id = record.claim_id;
                //console.log("claim id"+tclaim_id);
                rec = $('#row_' + tclaim_id).find('.s_status');
                if (record.error.length > 0) {
                    $('#row_' + tclaim_id).attr('s-prevent', record.prevent);
                    $('#row_' + tclaim_id).find('.s_modal').show();
                    // fill_scrubbing_modal(tclaim_id, record.error);
                    $.each(record.error, function (index, val) {
                        if (val.code == 1) {
                            $('#row_' + tclaim_id).find('.s_pro_name_td').addClass('text-danger');
                        } else if (val.code == 2) {
                            $('#row_' + tclaim_id).find('.cpt_name').addClass('border-danger');
                        } else if (val.code == 3) {
                            $('#row_' + tclaim_id).find('.cpt_name , .rates_name').addClass('border-danger');
                        } else if (val.code == 4) {
                            $('#row_' + tclaim_id).find('.m1_name, .m2_name, .m3_name, .m4_name').addClass('border-danger');
                        } else if (val.code == 5) {
                            $('#row_' + tclaim_id).find('.m1_name, .m2_name, .m3_name, .m4_name').addClass('border-danger');
                        } else if (val.code == 6) {
                            $('#row_' + tclaim_id).find('.unit_name').addClass('border-danger');

                        } else if (val.code == 8) {
                            $('#row_' + tclaim_id).find('.unit_name').addClass('border-danger');
                        } else if (val.code == 9) {
                            $('#row_' + tclaim_id).find('.unit_name').addClass('border-danger');
                            $('#row_' + tclaim_id).find('.s_date_td').addClass('text-danger');
                        } else if (val.code == 10) {
                            $('#row_' + tclaim_id).find('.s_hours_td').addClass('text-danger');
                            $('#row_' + tclaim_id).find('.unit_name').addClass('border-danger');
                        }
                    });
                } else {
                    $('#row_' + tclaim_id).attr('s-prevent', '2');
                    $('#row_' + tclaim_id).find('.s_modal').hide();
                }
            });


            if (data_check == 1) {
                saving_claims();
            }
        }


        $(document).on('click','#scrubbing_modal_btn',function(){
            cl_id=$(this).data("id");
            // console.log('CLaim id is :'+cl_id);
            // console.log(scrubbing_records);

            $.each(scrubbing_records, function(i, record){
                if(record.claim_id == cl_id){
                    console.log(record.error);
                    fill_scrubbing_modal(cl_id, record.error);
                    return false;
                }
            });
            $('#scrubbing_modal').modal('show');
        })


        function run_scrubbing(s_main) {
            if (s_main.length > 0) {
                $.ajax({
                    url: "{{route('superadmin.run.scrubbing')}}",
                    method: "POST",
                    data: {
                        "_token": "{{csrf_token()}}",
                        "data": JSON.stringify(s_main),

                    },
                    success: function (data) {
                        console.log(data);
                        apply_scrubbing(data);
                    }
                });
            } else {
                toastr["error"]("Please check claims to proceed.");
            }
        }

        function pre_scrubbing() {
            $('.claim_checked').each(function () {
                var sel = $(this).closest('tr');
                sel.find('.s_insurance').val($('.all_payor').val());
                sel.find('.s_cpt').val(sel.find('.cpt_name').val());
                sel.find('.s_location').val(sel.find('.location').val());
                sel.find('.s_m1').val(sel.find('.m1_name').val());
                sel.find('.s_m2').val(sel.find('.m2_name').val());
                sel.find('.s_m3').val(sel.find('.m3_name').val());
                sel.find('.s_m4').val(sel.find('.m4_name').val());
                sel.find('.s_unit').val(sel.find('.unit_name').val());
                sel.find('.s_rate').val(sel.find('.rates_name').val());
                sel.find('.s_cms').val(sel.find('.cms_24j_name').val());
                sel.find('.s_qual').val(sel.find('.qualifier_id').val());
            })

            s_main = [];
            $('.claim_checked').each(function () {
                var sel = $(this).closest('tr');
                if ($(this).is(":checked")) {
                    var claim = {
                        ins_id: sel.find('.s_insurance').val(),
                        id: sel.find('.s_id').val(),
                        clientId: sel.find('.s_client_id').val(),
                        scheduleDate: sel.find('.s_schedule_date').val(),
                        providerId: sel.find('.s_provider_id').val(),
                        activityId: sel.find('.s_activity_id').val(),
                        hours: sel.find('.s_hours').val(),
                        activityType: sel.find('.s_activity_type').val(),
                        cpt: sel.find('.s_cpt').val(),
                        location: sel.find('.s_location').val(),
                        m1: sel.find('.s_m1').val(),
                        m2: sel.find('.s_m2').val(),
                        m3: sel.find('.s_m3').val(),
                        m4: sel.find('.s_m4').val(),
                        unit: sel.find('.s_unit').val(),
                        rate: sel.find('.s_rate').val(),
                        cms: sel.find('.s_cms').val(),
                        qual: sel.find('.s_qual').val(),
                        status: sel.find('.s_status').val(),
                        auth_id: sel.find('.s_auth_id').val(),
                    };
                    s_main.push(claim);
                }
            })

            run_scrubbing(s_main);
        }

        $('.run_scrubbing_btn').click(function () {
            sr_check = 1;
            data_check = 2;
            pre_scrubbing();
        })

        $('.loading2').hide();


        function saving_claims() {
            var id = [];
            s_check = 2;
            $('.claim_checked:checked').each(function () {
                id.push($(this).val());
                if ($(this).closest('tr').attr("s-prevent") == 1) {
                    s_check = 1;
                }
            });

            if (s_check == 1) {
                toastr["error"]("Please check scrubbing.");
                return false;
            }


            var action = $('.action').val();
            $('.loading2').show();
            var cms_provider_id = $('.cms_provider').val();
            var id_qualifiers_val = $('.id_qualifiers').val();
            var mo_one_val = $('.mo_one').val();
            var mo_two_val = $('.mo_two').val();
            var mo_three_val = $('.mo_three').val();
            var mo_four_val = $('.mo_four').val();
            var rate_val = $('.rate_val').val();
            var pos_val = $('.pos_val').val();
            var cpt_val = $('.cpt_val').val();
            var unit_val = $('.unit_val').val();
            var tele_mod_value = $('.tele_mod_value').val();

            if (id.length > 0) {
                if (action != '') {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.procession.claim.update') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'id': id,
                            'action': action,
                            'cms_provider_id': cms_provider_id,
                            'id_qualifiers_val': id_qualifiers_val,
                            'mo_one_val': mo_one_val,
                            'mo_two_val': mo_two_val,
                            'mo_three_val': mo_three_val,
                            'mo_four_val': mo_four_val,
                            'rate_val': rate_val,
                            'pos_val': pos_val,
                            'cpt_val': cpt_val,
                            'unit_val': unit_val,
                            'tele_mod_value': tele_mod_value,
                        },
                        success: function (data) {
                            console.log(data)

                            $('.24j_select').hide();
                            $('.qualifier_select').hide();
                            $('.mupdate_select').hide();
                            $('.urate_select').hide();
                            $('.cpt_select').hide();
                            $('.pos_select').hide();
                            $('.action').val('');


                            if (action == 1) {
                                $('.claim_checked:checked').each(function () {
                                    jQuery(this).closest('tr').find(
                                        ".bil_status_show").empty();
                                    jQuery(this).closest('tr').find(
                                        ".bil_status_show").append(
                                        `<i class="ri-checkbox-blank-circle-fill text-success" title="Ready to Bill"></i>`
                                    );
                                });

                                if (data == 0) {
                                    $('.ready_to_bill_status').empty();
                                    $('.ready_to_bill_status1').empty();
                                    $('.ready_to_bill_status').append(
                                        `<option></option>
                                            <option value="Ready To Bill">Ready to Bill</option>`
                                    );
                                    $('.ready_to_bill_status1').append(
                                        `<option></option>
                                            <option value="Ready To Bill">Ready to Bill</option>`
                                    );
                                } else {
                                    $('.ready_to_bill_status').empty();
                                    $('.ready_to_bill_status1').empty();
                                    $('.ready_to_bill_status').append(
                                        `<option></option>
                                        <option value="Ready To Bill">Ready to Bill</option>
                                        <option value="Pending for Approval">Clarification Pending</option>`
                                    );
                                    $('.ready_to_bill_status1').append(
                                        `<option></option>
                                        <option value="Ready To Bill">Ready to Bill</option>
                                        <option value="Pending for Approval">Clarification Pending</option>`
                                    );
                                }

                                console.log(data);

                            } else if (action == 2) {
                                $('.claim_checked:checked').each(function () {
                                    jQuery(this).closest('tr').find(
                                        ".bil_status_show").empty();
                                    jQuery(this).closest('tr').find(
                                        ".bil_status_show").append(
                                        `<i class="ri-checkbox-blank-circle-fill text-danger" title="Clarification Pending"></i>`
                                    );
                                });

                                if (data == 0) {
                                    $('.ready_to_bill_status').empty();
                                    $('.ready_to_bill_status1').empty();
                                    $('.ready_to_bill_status').append(
                                        `<option></option>
                                            <option value="Ready To Bill">Ready to Bill</option>`
                                    );
                                    $('.ready_to_bill_status1').append(
                                        `<option></option>
                                            <option value="Ready To Bill">Ready to Bill</option>`
                                    );
                                } else {
                                    $('.ready_to_bill_status').empty();
                                    $('.ready_to_bill_status1').empty();
                                    $('.ready_to_bill_status').append(
                                        `<option></option>
                                        <option value="Ready To Bill">Ready to Bill</option>
                                        <option value="Pending for Approval">Clarification Pending</option>`
                                    );
                                    $('.ready_to_bill_status1').append(
                                        `<option></option>
                                        <option value="Ready To Bill">Ready to Bill</option>
                                        <option value="Pending for Approval">Clarification Pending</option>`
                                    );
                                }

                            } else if (action == 3) {

                                $('.ready_to_bill_status').empty();
                                $('.ready_to_bill_status1').empty();
                                $('.ready_to_bill_status').append(
                                    `<option></option>
                                            <option value="Ready To Bill">Ready to Bill</option>`
                                );
                                $('.ready_to_bill_status1').append(
                                    `<option></option>
                                            <option value="Ready To Bill">Ready to Bill</option>`
                                );


                                $('.table_data_show').hide();
                                $('.pt_table').hide();
                            } else if (action == 4) {
                                $('.claim_checked:checked').each(function () {
                                    jQuery(this).closest('tr').remove();
                                });
                            } else if (action == 5) {
                                $('.claim_checked:checked').each(function () {
                                    jQuery(this).closest('tr').find(
                                        "select[name='cms_24j_name']").empty();
                                    jQuery(this).closest('tr').find(
                                        "select[name='cms_24j_name']").append(
                                        `<option value="${data.id}">${data.first_name} ${data.middle_name} ${data.last_name}</option>`
                                    );
                                });
                            } else if (action == 6) {
                                $('.claim_checked:checked').each(function () {
                                    jQuery(this).closest('tr').find(
                                        "select[name='qualifier_id_val']").val(
                                        data);

                                });
                            } else if (action == 7) {

                                if (mo_one_val != '' || mo_one_val != null) {
                                    console.log('paisi');
                                }

                                $('.claim_checked:checked').each(function () {
                                    if (mo_one_val == '' || mo_one_val == null) {

                                    } else {
                                        jQuery(this).closest('tr').find(
                                            "input[name='m1_name']").val(
                                            mo_one_val)
                                    }

                                    if (mo_two_val == '' || mo_two_val == null) {

                                    } else {
                                        jQuery(this).closest('tr').find(
                                            "input[name='m2_name']").val(
                                            mo_two_val)
                                    }

                                    if (mo_three_val == '' || mo_three_val ==
                                        null) {

                                    } else {
                                        jQuery(this).closest('tr').find(
                                            "input[name='m3_name']").val(
                                            mo_three_val)
                                    }

                                    if (mo_four_val == '' || mo_four_val == null) {

                                    } else {
                                        jQuery(this).closest('tr').find(
                                            "input[name='m4_name']").val(
                                            mo_four_val)
                                    }

                                });
                            } else if (action == 8) {
                                $('.table_data_show').hide();
                                $('.pt_table').hide();
                            } else if (action == 9) {
                                $('.claim_checked:checked').each(function () {
                                    if (rate_val == '' || rate_val == null) {

                                    } else {
                                        jQuery(this).closest('tr').find(
                                            "input[name='rates_name']").val(
                                            parseFloat(rate_val).toFixed(2))
                                    }
                                });
                            } else if (action == 10) {
                                $('.claim_checked:checked').each(function (index, value) {

                                    if (data[index] != null || data[index] != '') {
                                        jQuery(this).closest('tr').find(
                                            "input[name='rates_name']").val(
                                            parseFloat(data[index]['billed_rate']).toFixed(2))
                                    }

                                });
                            } else if (action == 11) {
                                $('.claim_checked:checked').each(function () {


                                    if (cpt_val == '' || cpt_val == null) {

                                    } else {
                                        jQuery(this).closest('tr').find(".cpt_name")
                                            .val(cpt_val);
                                    }

                                    if (unit_val == '' || unit_val == null) {

                                    } else {
                                        let desc_unit = parseFloat(unit_val)
                                            .toFixed(2);
                                        jQuery(this).closest('tr').find(
                                            ".unit_name").val(desc_unit);
                                    }
                                });
                            } else if (action == 12) {
                                $('.table_data_show').hide();
                                $('.pt_table').hide();
                            } else if (action == 14) {
                                $('.claim_checked:checked').each(function () {

                                    if (pos_val == '' || pos_val == null) {

                                    } else {
                                        jQuery(this).closest('tr').find(
                                            "input[name='location']").val(
                                            pos_val)
                                    }
                                });
                            } else if (action == 15) {


                                $('.claim_checked:checked').each(function () {

                                    var tmod_m1 = jQuery(this).closest('tr').find(
                                        "input[name='m1_name']").val();
                                    var tmod_m2 = jQuery(this).closest('tr').find(
                                        "input[name='m2_name']").val();
                                    var tmod_m3 = jQuery(this).closest('tr').find(
                                        "input[name='m3_name']").val();
                                    var tmod_m4 = jQuery(this).closest('tr').find(
                                        "input[name='m4_name']").val();

                                    if (tmod_m1 == null || tmod_m1 == "") {
                                        jQuery(this).closest('tr').find(
                                            "input[name='m1_name']").val(
                                            tele_mod_value);
                                    } else if (tmod_m1 != null || tmod_m1 != "") {
                                        var tmod_m2 = jQuery(this).closest('tr')
                                            .find("input[name='m2_name']").val();
                                        if (tmod_m2 == null || tmod_m2 == "") {
                                            jQuery(this).closest('tr').find(
                                                "input[name='m2_name']").val(
                                                tele_mod_value);
                                        } else if (tmod_m2 != null || tmod_m2 !=
                                            "") {
                                            if (tmod_m3 == null || tmod_m3 == "") {
                                                jQuery(this).closest('tr').find(
                                                    "input[name='m3_name']")
                                                    .val(tele_mod_value);
                                            } else if (tmod_m3 != null || tmod_m3 !=
                                                "") {
                                                if (tmod_m4 == null || tmod_m4 ==
                                                    "") {
                                                    jQuery(this).closest('tr').find(
                                                        "input[name='m4_name']")
                                                        .val(tele_mod_value);
                                                }
                                            }
                                        }
                                    }

                                });
                                $('.update_tele_mod_input').hide();
                            } else {
                                $('.table_data_show').show();
                                $('.pt_table').show();
                            }

                            $('.claim_checked:checked').each(function () {
                                $(this).prop('checked', false);
                            });


                            $('.all_checked').prop('checked', false);
                            $('.loading2').hide();
                        }
                    });

                } else {

                    var cpt = [];
                    $('.claim_checked:checked').each(function () {
                        cpt.push(jQuery(this).closest('tr').find("input[name='cpt_name']")
                            .val())
                    });

                    var m1_name = [];
                    $('.claim_checked:checked').each(function () {
                        m1_name.push(jQuery(this).closest('tr').find("input[name='m1_name']")
                            .val())
                    });

                    var m2_name = [];
                    $('.claim_checked:checked').each(function () {
                        m2_name.push(jQuery(this).closest('tr').find("input[name='m2_name']")
                            .val())
                    });

                    var location = [];
                    $('.claim_checked:checked').each(function () {
                        location.push(jQuery(this).closest('tr').find("input[name='location']")
                            .val())
                    });

                    var unit_name = [];
                    $('.claim_checked:checked').each(function () {
                        unit_name.push(jQuery(this).closest('tr').find(
                            "input[name='unit_name']").val())
                    });

                    var rates_name = [];
                    $('.claim_checked:checked').each(function () {
                        rates_name.push(jQuery(this).closest('tr').find(
                            "input[name='rates_name']").val())
                    });

                    var m3_name = [];
                    $('.claim_checked:checked').each(function () {
                        m3_name.push(jQuery(this).closest('tr').find("input[name='m3_name']")
                            .val())
                    });

                    var m4_name = [];
                    $('.claim_checked:checked').each(function () {
                        m4_name.push(jQuery(this).closest('tr').find("input[name='m4_name']")
                            .val())
                    });

                    var qualifier_id = [];

                    $('.claim_checked:checked').each(function () {
                        qualifier_id.push($(this).closest('tr').find('.qualifier_id :selected')
                            .val());
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.procession.claim.update') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'id': id,
                            'cpt': cpt,
                            'm1_name': m1_name,
                            'm2_name': m2_name,
                            'location': location,
                            'unit_name': unit_name,
                            'rates_name': rates_name,
                            'm3_name': m3_name,
                            'm4_name': m4_name,
                            'qualifier_id': qualifier_id,

                        },
                        success: function (data) {
                            console.log(data)
                            $('.claim_checked:checked').each(function () {
                                var unit = jQuery(this).closest('tr').find(
                                    "input[name='unit_name']").val();
                                jQuery(this).closest('tr').find(
                                    "input[name='unit_name']").val(parseFloat(
                                    unit).toFixed(2))

                                var rate = jQuery(this).closest('tr').find(
                                    "input[name='rates_name']").val();
                                jQuery(this).closest('tr').find(
                                    "input[name='rates_name']").val(parseFloat(
                                    rate).toFixed(2))

                                $(this).prop('checked', false);
                            });
                            $('.all_checked').prop('checked', false);


                            $('.loading2').hide();
                        }
                    });

                }

            } else {
                $('.loading2').hide();
                alert("Please select checkbox");
            }
        }

        $(document).ready(function () {


            // $(".c_table").tablesorter();

            var ENDPOINT = "{{ url('/') }}";
            var page = 1;
            var current_page = 0;
            let bool = false;
            let lastPage;
            var currentscrollHeight = 0;
            $('.table_data_show').scroll(function () {

                const scrollHeight = $('.table_data_show').prop('scrollHeight');
                const scrollPos = Math.floor($('.table_data_show').height() + $('.table_data_show').scrollTop());
                const isBottom = scrollHeight - 100 < scrollPos;
                if (isBottom && currentscrollHeight < scrollHeight) {
                    page++;
                    //alert('calling...');
                    $('.show_animation').show()
                    var myurl = ENDPOINT + '/admin/billing-record-get?page=' + page
                    getData(myurl);
                    currentscrollHeight = scrollHeight;
                }


                // var scrollHeight = $(".table_data_show").prop('scrollHeight');
                // var divHeight = $(".table_data_show").height();
                // var scrollerEndPoint = scrollHeight - divHeight;
                //
                // var divScrollerTop = $(".table_data_show").scrollTop();
                // if (divScrollerTop == scrollerEndPoint) {
                //     page++;
                //     //alert('calling...');
                //     var myurl = ENDPOINT + '/admin/billing-record-get?page=' + page
                //     getData(myurl);
                //     currentscrollHeight = scrollHeight;
                //     console.log(page)
                // }


            })


            $('#run').click(function (e) {
                e.preventDefault();
                $('.table_data_show').show()
                $('.show_animation').show()

                page = 1;
                currentscrollHeight = 0;

                var to_date = $('.select_date').val();
                var payor_id = $('.all_payor').val();
                var client1 = $('.client1').val();
                var treating_therapist = $('.treating_therapist').val();
                var cms_therapist = $('.cms_therapist').val();
                var activitytype = $('.activitytype').val();
                var ready_to_bill_status = $('.ready_to_bill_status').val();
                var reportrange = $('.reportrange').val();
                var degree_level = $('.degree_level').val();
                var zone = $('.zone').val();
                var cptcode = $('.cptcode').val();
                var pos = $('.pos').val();
                var modifire = $('.modifire').val();


                var client2 = $('.client2').val();
                var treating_therapist1 = $('.treating_therapist1').val();
                var cms_therapist1 = $('.cms_therapist1').val();
                var activitytype1 = $('.activitytype1').val();
                var ready_to_bill_status1 = $('.ready_to_bill_status1').val();
                var reportrange1 = $('.reportrange1').val();
                var degree_level1 = $('.degree_level1').val();
                var zone1 = $('.zone1').val();
                var cptcode1 = $('.cptcode1').val();
                var pos1 = $('.pos1').val();
                var modifire1 = $('.modifire1').val();


                var zero_units_select = $('.filter_id_one').val();

                if (zero_units_select == 10) {
                    var zero_units = 1;
                } else {
                    var zero_units = 0;
                }

                var zero_units_select_one = $('.filter_id_two').val();

                if (zero_units_select_one == 10) {
                    var zero_units_one = 1;
                } else {
                    var zero_units_one = 0;
                }


                if ($('.filter_id_one').val() == 0) {
                    $('.loading2').hide();
                } else {

                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.billing.recored') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                            'client1': client1,
                            'treating_therapist': treating_therapist,
                            'cms_therapist': cms_therapist,
                            'activitytype': activitytype,
                            'ready_to_bill_status': ready_to_bill_status,
                            'reportrange': reportrange,
                            'degree_level': degree_level,
                            'zone': zone,
                            'cptcode': cptcode,
                            'modifire': modifire,
                            'pos': pos,
                            'zero_units': zero_units,

                            'client2': client2,
                            'treating_therapist1': treating_therapist1,
                            'cms_therapist1': cms_therapist1,
                            'activitytype1': activitytype1,
                            'ready_to_bill_status1': ready_to_bill_status1,
                            'reportrange1': reportrange1,
                            'degree_level1': degree_level1,
                            'zone1': zone1,
                            'cptcode1': cptcode1,
                            'modifire1': modifire1,
                            'pos1': pos1,
                            "zero_units_one": zero_units_one
                        },
                        success: function (data) {
                            console.log(data);


                            if (data == 'not seleted') {
                                $('.table_data_show').hide();
                                $('.loading2').hide();

                            } else {

                                $('.bill_data_show').empty().append(data.view);
                                $('.table_data_show').show();
                                $('.show_animation').hide()
                                $('.run_scrubbing_btn').show();
                                $('.download_div').show();
                                $('.c_table').trigger('update')
                                $('.s_modal').hide();


                            }


                        }
                    });
                }


            });


            $(document).on('click', '#save_data', function () {
                var action = $('.action').val();
                if (sr_check == 2) {
                    saving_claims();
                } else {
                    if (action != '') {
                        var cms_provider_id = $('.cms_provider').val();
                        var id_qualifiers_val = $('.id_qualifiers').val();
                        var mo_one_val = $('.mo_one').val();
                        var mo_two_val = $('.mo_two').val();
                        var mo_three_val = $('.mo_three').val();
                        var mo_four_val = $('.mo_four').val();
                        var rate_val = $('.rate_val').val();
                        var pos_val = $('.pos_val').val();
                        var cpt_val = $('.cpt_val').val();
                        var unit_val = $('.unit_val').val();
                        var tele_mod_value = $('.tele_mod_value').val();
                        $('.claim_checked:checked').each(function () {
                            var sel = $(this).closest('tr');

                            if (action == 5) {
                                if (cms_provider_id != '')
                                    sel.find('.cms_24j_name').val(cms_provider_id);
                            } else if (action == 6) {
                                if (id_qualifiers_val != '')
                                    sel.find('.qualifier_id').val(id_qualifiers_val);
                            } else if (action == 7) {
                                if (mo_one_val != '')
                                    sel.find('.m1_name').val(mo_one_val);
                                if (mo_two_val != '')
                                    sel.find('.m2_name').val(mo_two_val);
                                if (mo_three_val != '')
                                    sel.find('.m3_name').val(mo_three_val);
                                if (mo_four_val != '')
                                    sel.find('.m4_name').val(mo_four_val);
                            } else if (action == 9) {
                                if (rate_val != '')
                                    sel.find('.rates_name').val(rate_val);
                            } else if (action == 11) {
                                if (cpt_val != '')
                                    sel.find('.cpt_name').val(cpt_val);
                                if (unit_val != '')
                                    sel.find('.unit_name').val(unit_val);
                            } else if (action == 14) {
                                if (pos_val != '')
                                    sel.find('.location').val(pos_val);
                            } else if (action == 15) {
                                var tmod_m1 = sel.find('.m1_name').val();
                                var tmod_m2 = sel.find('.m2_name').val();
                                var tmod_m3 = sel.find('.m3_name').val();
                                var tmod_m4 = sel.find('.m4_name').val();

                                if (tmod_m1 == null || tmod_m1 == "") {
                                    sel.find('m1_name').val(tele_mod_value);
                                } else if (tmod_m1 != null || tmod_m1 != "") {
                                    if (tmod_m2 == null || tmod_m2 == "") {
                                        sel.find("m2_name").val(tele_mod_value);
                                    } else if (tmod_m2 != null || tmod_m2 != "") {
                                        if (tmod_m3 == null || tmod_m3 == "") {
                                            sel.find('m3_name').val(tele_mod_value);
                                        } else if (tmod_m3 != null || tmod_m3 != "") {
                                            if (tmod_m4 == null || tmod_m4 == "") {
                                                sel.find('m4_name').val(tele_mod_value);
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }


                    data_check = 1;
                    pre_scrubbing();
                }

            });


            $('.action').change(function () {
                var action_type = $(this).val();
                if (action_type == 5) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.action.get.csm.provider') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {


                            $('.cms_provider').empty();

                            $.each(data, function (index, value) {
                                $('.cms_provider').append(
                                    `<option value="${value.id}">${value.full_name}</option>`
                                );
                            })

                            $('.loading2').hide();
                        }
                    });
                }
            });


            $('#select_all').click(function () {
                $('.claim_checked').each(function () {
                    $(this).prop('checked', true);
                });
            });

            $('#un_selectall').click(function () {
                $('.claim_checked').each(function () {
                    $(this).prop('checked', false);
                });
            });


            $(document).on('click', '.all_checked', function () {

                if ($(this).prop("checked") == true) {
                    $('.claim_checked').each(function () {
                        $(this).prop('checked', true);
                    });
                } else if ($(this).prop("checked") == false) {
                    $('.claim_checked').each(function () {
                        $(this).prop('checked', false);
                    });
                }
            })


            $(document).on('keyup', '.cpt_name', function () {
                jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);
            })

            $(document).on('keyup', '.m1_name', function () {
                jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);
            })

            $(document).on('keyup', '.m2_name', function () {
                jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);
            })

            $(document).on('keyup', '.location', function () {
                jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);
            })

            $(document).on('keyup', '.unit_name', function () {
                jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);
            })

            $(document).on('keyup', '.rates_name', function () {
                jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);
            })

            $(document).on('keyup', '.m3_name', function () {
                jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);
            })

            $(document).on('keyup', '.m4_name', function () {
                jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);
            });

            $(document).on('change', '.qualifier_id', function () {
                jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);
            })


        })


        function getData(myurl) {
            // $('.show_animation').show();
            var to_date = $('.select_date').val();
            var payor_id = $('.all_payor').val();
            var client1 = $('.client1').val();
            var treating_therapist = $('.treating_therapist').val();
            var cms_therapist = $('.cms_therapist').val();
            var activitytype = $('.activitytype').val();
            var ready_to_bill_status = $('.ready_to_bill_status').val();
            var reportrange = $('.reportrange').val();
            var degree_level = $('.degree_level').val();
            var zone = $('.zone').val();
            var cptcode = $('.cptcode').val();
            var pos = $('.pos').val();
            var modifire = $('.modifire').val();


            var client2 = $('.client2').val();
            var treating_therapist1 = $('.treating_therapist1').val();
            var cms_therapist1 = $('.cms_therapist1').val();
            var activitytype1 = $('.activitytype1').val();
            var ready_to_bill_status1 = $('.ready_to_bill_status1').val();
            var reportrange1 = $('.reportrange1').val();
            var degree_level1 = $('.degree_level1').val();
            var zone1 = $('.zone1').val();
            var cptcode1 = $('.cptcode1').val();
            var pos1 = $('.pos1').val();
            var modifire1 = $('.modifire1').val();


            var zero_units_select = $('.filter_id_one').val();

            if (zero_units_select == 10) {
                var zero_units = 1;
            } else {
                var zero_units = 0;
            }

            var zero_units_select_one = $('.filter_id_two').val();

            if (zero_units_select_one == 10) {
                var zero_units_one = 1;
            } else {
                var zero_units_one = 0;
            }
            $.ajax(
                {
                    url: myurl,
                    type: "POST",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'to_date': to_date,
                        'payor_id': payor_id,
                        'client1': client1,
                        'treating_therapist': treating_therapist,
                        'cms_therapist': cms_therapist,
                        'activitytype': activitytype,
                        'ready_to_bill_status': ready_to_bill_status,
                        'reportrange': reportrange,
                        'degree_level': degree_level,
                        'zone': zone,
                        'cptcode': cptcode,
                        'modifire': modifire,
                        'pos': pos,
                        'zero_units': zero_units,

                        'client2': client2,
                        'treating_therapist1': treating_therapist1,
                        'cms_therapist1': cms_therapist1,
                        'activitytype1': activitytype1,
                        'ready_to_bill_status1': ready_to_bill_status1,
                        'reportrange1': reportrange1,
                        'degree_level1': degree_level1,
                        'zone1': zone1,
                        'cptcode1': cptcode1,
                        'modifire1': modifire1,
                        'pos1': pos1,
                        "zero_units_one": zero_units_one
                    },
                    datatype: "html"
                }).done(function (data) {
                console.log(data)
                $('.show_animation').hide()
                $('.bill_data_show').append(data.view);
                $('.s_modal').hide();

                $('.c_table').trigger('update')


                // location.hash = myurl;

            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
                $('.loading2').hide();
            });
        }


    </script>

    {{-- Fetching the data --}}
    <script>
        $('.filter1').hide();
        $(document).ready(function () {


            //to date get data
            $('#go').click(function () {
                var to_date = $('.select_date').val();
                $('.loading2').show();
                if (to_date == "" || to_date == null) {
                    $('.loading2').hide();
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.record.by.date') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                        },
                        success: function (data) {

                            console.log(data)
                            $('.all_payor').empty();
                            if (data.name_loca != 1) {
                                $('.all_payor').append(
                                    `<option value=""></option>`
                                );
                            }

                            $.each(data.payors, function (index, value) {
                                $('.all_payor').append(
                                    `<option value="${value.payor_id}">${value.payor_name}</option>`
                                );
                            });
                            $('#all_payor').multiselect({includeSelectAllOption: true});
                            $("#all_payor").multiselect('rebuild');


                            $('.loading2').hide();
                        }
                    });
                }

            });


            $('.all_payor').change(function () {
                {{--$('.loading2').show();--}}
                {{--$('.filter1').show();--}}
                {{--$('.filter_btn').show();--}}
                {{--$('.first_payor').show();--}}
                {{--$('.filter_id_one').val('')--}}
                {{--$('.filter_id_two').val('')--}}

                {{--let pay_id = $(this).val();--}}
                {{--var to_date = $('.select_date').val();--}}

                {{--if (pay_id != "") {--}}
                {{--    $.ajax({--}}
                {{--        type: "POST",--}}
                {{--        url: "{{ route('superadmin.billing.update.billing.data') }}",--}}
                {{--        data: {--}}
                {{--            '_token': "{{ csrf_token() }}",--}}
                {{--            'pay_id': pay_id,--}}
                {{--            'to_date': to_date,--}}
                {{--        },--}}
                {{--        success: function (data) {--}}
                {{--            console.log(data)--}}

                {{--            $('.loading2').hide();--}}
                {{--        }--}}
                {{--    });--}}
                {{--}--}}

                $('.filter_id_one').val('');
            });


            $('.filter_id_one').change(function () {
                var filter_id = $(this).val();
                var payor_id = $('.all_payor').val();
                var to_date = $('.select_date').val();


                if (payor_id == null || payor_id == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Insurance", 'ALERT!');
                } else if (payor_id.length > 5) {
                    $('.loading2').hide();
                    toastr["error"]("Insurance Can be Selected Max 5", 'ALERT!');
                } else if (filter_id == 1) {
                    //get client
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.clients') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.client1').empty();
                            $('.client1').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.client1').append(
                                    `<option value="${value.id}">${value.client_full_name}</option>`
                                );
                            });


                        }
                    });
                } else if (filter_id == 2) {

                    //treating_therapist
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.treating.therapist') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.treating_therapist').empty();
                            $('.treating_therapist').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.treating_therapist').append(
                                    `<option value="${value.id}">${value.first_name} ${value.middle_name} ${value.last_name}</option>`
                                );
                            })
                        }
                    });
                } else if (filter_id == 3) {

                    //cms_therapist
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.csm.therapist') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.cms_therapist').empty();
                            $('.cms_therapist').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.cms_therapist').append(
                                    `<option value="${value.id}">${value.first_name} ${value.middle_name} ${value.last_name}</option>`
                                );
                            })
                        }
                    });
                } else if (filter_id == 4) {
                    //activity type
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.activity.type') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.activitytype').empty();
                            $('.activitytype').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.activitytype').append(
                                    `<option value="${value.id}">${value.activity_one}</option>`
                                );
                            })
                        }
                    });

                } else if (filter_id == 7) {
                    //degree level
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.degree.level') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.degree_level').empty();
                            $('.degree_level').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.degree_level').append(
                                    `<option value="${value.id}">${value.activity_two}</option>`
                                );
                            })
                        }
                    });
                } else if (filter_id == 8) {
                    //get all zone
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.zone') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.zone').empty();
                            $('.zone').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.zone').append(
                                    `<option value="${value.zone}">${value.zone}</option>`
                                );
                            })
                        }
                    });
                } else if (filter_id == 9) {
                    //get cpt code
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.cpt.code') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.cptcode').empty();
                            $('.cptcode').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.cptcode').append(
                                    `<option value="${value.service}">${value.service}</option>`
                                );
                            })
                        }
                    });
                } else if (filter_id == 12) {
                    //get modifire
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.modifire') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.modifire').empty();
                            $('.modifire').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.modifire').append(
                                    `<option value="${value}">${value}</option>`
                                );
                            })
                        }
                    });
                }


            })


            $('.filter_id_two').change(function () {
                var filter_id_two = $(this).val();
                var payor_id = $('.all_payor').val();
                var to_date = $('.select_date').val();


                if (payor_id == null || payor_id == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Insurance", 'ALERT!');
                } else if (payor_id.length > 5) {
                    $('.loading2').hide();
                    toastr["error"]("Insurance Can be Selected Max 5", 'ALERT!');
                } else if (filter_id_two == 1) {
                    //get client
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.clients') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id
                        },
                        success: function (data) {

                            $('.client2').empty();
                            $('.client2').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.client2').append(
                                    `<option value="${value.id}">${value.client_full_name}</option>`
                                );
                            })
                        }
                    });
                } else if (filter_id_two == 2) {

                    //treating_therapist
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.treating.therapist') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.treating_therapist1').empty();
                            $('.treating_therapist1').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.treating_therapist1').append(
                                    `<option value="${value.id}">${value.first_name} ${value.middle_name} ${value.last_name}</option>`
                                );
                            })
                        }
                    });
                } else if (filter_id_two == 3) {

                    //cms_therapist
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.csm.therapist') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.cms_therapist1').empty();
                            $('.cms_therapist1').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.cms_therapist1').append(
                                    `<option value="${value.id}">${value.first_name} ${value.middle_name} ${value.last_name}</option>`
                                );
                            })
                        }
                    });
                } else if (filter_id_two == 4) {
                    //activity type
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.activity.type') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.activitytype1').empty();
                            $('.activitytype1').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.activitytype1').append(
                                    `<option value="${value.id}">${value.activity_one}</option>`
                                );
                            })
                        }
                    });

                } else if (filter_id_two == 7) {
                    //degree level
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.degree.level') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.degree_level1').empty();
                            $('.degree_level1').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.degree_level1').append(
                                    `<option value="${value.id}">${value.activity_two}</option>`
                                );
                            })
                        }
                    });
                } else if (filter_id_two == 8) {
                    //get all zone
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.zone') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.zone1').empty();
                            $('.zone1').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.zone1').append(
                                    `<option value="${value.zone}">${value.zone}</option>`
                                );
                            })
                        }
                    });
                } else if (filter_id_two == 9) {
                    //get cpt code
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.cpt.code') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.cptcode1').empty();
                            $('.cptcode1').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.cptcode1').append(
                                    `<option value="${value.zone}">${value.service}</option>`
                                );
                            })
                        }
                    });
                } else if (filter_id_two == 12) {
                    //get modifire
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.get.modifire') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'to_date': to_date,
                            'payor_id': payor_id,
                        },
                        success: function (data) {

                            $('.modifire1').empty();
                            $('.modifire1').append(
                                `<option></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.modifire1').append(
                                    `<option value="${value}">${value}</option>`
                                );
                            })
                        }
                    });
                }


            });


        })
    </script>

    {{-- CSV/PDF --}}
    <script>
        var timeStamp = moment().format('MMDYYYYhmmss');
        $('#download_csv').click(function () {
            $('#export_table').tableExport({
                type: 'csv',
                fileName: "ProcessingClaims_" + timeStamp
            });
        });
        $('#download_pdf').click(function () {
            $('#export_table').tableExport({
                type: 'pdf',
                fileName: 'ProcessingClaims_' + timeStamp,
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
                            columnWidth: 'auto',
                            overflow: 'auto'
                        }
                    }

                }
            });
        });
    </script>


    <script>

    </script>
@endsection
