@section('js')
    <script>
        $(document).ready(function () {
            $('.loading2').hide();
            $('#add_service').click(function () {
                let treatment_type = $('.treatment_type').val();

                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.subtype.by.tx')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'treatment_type': treatment_type,
                    },
                    success: function (data) {
                        $('.sub_type_acts').empty();

                        $('.sub_type_acts').append(
                            `<option value="">select Sub-Type</option>`
                        );
                        if (data.length > 0) {
                            $.each(data, function (index, value) {
                                $('.sub_type_acts').append(
                                    `<option value="${value.sub_activity}">${value.sub_activity}</option>`
                                );
                            })
                        } else {
                            $('.sub_type_acts').append(
                                `<option value=""></option>`
                            );
                        }

                        $('.loading2').hide();


                    }
                });

                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.service.by.tx')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'treatment_type': treatment_type,
                    },
                    success: function (data) {

                        $('.serivec_tx').empty();
                        $('.serivec_tx').append(
                            `<option value="">Select Service</option>`
                        );
                        if (data.length > 0) {
                            $.each(data, function (index, value) {
                                $('.serivec_tx').append(
                                    `<option value="${value.description}">${value.description}</option>`
                                );
                            })
                        } else {
                            $('.sub_type_acts').append(
                                `<option value=""></option>`
                            );
                        }

                        $('.loading2').hide();


                    }
                });

                $('.loading2').show();
                //get all cpt codes
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.cpt.codes.by.tx')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'treatment_type': treatment_type,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.act_crt_cpt_code').empty();

                        $('.act_crt_cpt_code').append(
                            `<option value="">Select Cpt-Code</option>`
                        );

                        if (data.length > 0) {
                            $.each(data, function (index, value) {
                                $('.act_crt_cpt_code').append(
                                    `<option value="${value.cpt_id}">${value.cpt_code}</option>`
                                );
                            })
                        } else {
                            $('.act_crt_cpt_code').append(
                                `<option value=""></option>`
                            );
                        }
                        $('.loading2').hide();

                    }
                });


            });


            $('.editActModal').click(function () {
                let act_data = $(this).data('id');
                let treatment_type = $('.treatment_type').val();
                sel = $('#editactivity'+act_data);

                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.authdata.by.act')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'act_data': act_data,
                    },
                    success: function (data) {
                        sel.find('.exist_act_one').empty();
                        sel.find('.exist_act_one').val(data.activity_one);

                        sel.find('.exist_act_two').empty();
                        sel.find('.exist_act_two').val(data.activity_two);

                        sel.find('.exist_cpt_code').empty();
                        sel.find('.exist_cpt_code').val(data.cpt_code);

                        getDataEditAct(sel);
                        $('.loading2').hide();

                    }
                });

            });


            function getDataEditAct(sel) {
                $('.loading2').show();
                let treatment_type = $('.treatment_type').val();
                sel.find('.edit_activity_one').empty();
                // edit act server
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.service.by.tx')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'treatment_type': treatment_type,
                    },
                    success: function (data) {
                        if (data.length > 0) {
                            $.each(data, function (index, value) {
                                sel.find('.edit_activity_one').append(
                                    `<option value="${value.description}" data-id="${value.id}">${value.description}</option>`
                                );
                            });
                        } else {
                            sel.find('.edit_activity_one').append(
                                `<option value=""></option>`
                            );
                        }

                        let exit_act_one_val = sel.find('.exist_act_one').val();
                        sel.find('.edit_activity_one').val(exit_act_one_val);
                        let ser_h = sel.find('.edit_activity_one option:selected').data("id");
                        let tx_type = sel.find('.tx_type_h').val();
                        //edit act ser sub type
                        $.ajax({
                            type: "POST",
                            url: "{{route('superadmin.client.authorization.fetch.subactivity')}}",
                            data: {
                                '_token': "{{csrf_token()}}",
                                'tx_type': tx_type,
                                'service_id' : ser_h,
                            },
                            success: function (data) {
                                console.log(data);
                                sel.find('.exit_activity_two').empty().append('<option></option>');
                                $.each(data, function (index, value) {
                                    sel.find('.exit_activity_two').append(
                                        `<option value="${value.sub_activity}">${value.sub_activity}</option>`
                                    );
                                })

                                let exist_act_two = sel.find('.exist_act_two').val();
                                sel.find('.exit_activity_two').val(exist_act_two);

                                $('.loading2').hide();
                            }
                        });
                    }
                });




                //edit act cpt
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.cpt.codes.by.tx')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'treatment_type': treatment_type,
                    },
                    success: function (data) {
                        console.log(data);
                        sel.find('.exist_cpt_code_data').empty();
                        if (data.length > 0) {
                            $.each(data, function (index, value) {
                                sel.find('.exist_cpt_code_data').append(
                                    `<option value="${value.cpt_id}">${value.cpt_code}</option>`
                                );
                            })
                        } else {
                            sel.find('.exist_cpt_code_data').append(
                                `<option value=""></option>`
                            );
                        }


                        let exist_cpt_code = sel.find('.exist_cpt_code').val();
                        sel.find('.exist_cpt_code_data').val(exist_cpt_code);
                        $('.loading2').hide();

                    }
                });


            }


        })
    </script>
        <script>
        $('.service_main').change(function(){
            service_id = $(this).find('option:selected').data('id');
            tx_type = $(this).closest('.row').find('.tx_type_h').val();
            sel = $(this).closest('.row').find('.service_sub_type');
            sel.empty();

            $.ajax({
                url:"{{route('superadmin.client.authorization.fetch.subactivity')}}",
                type:"POST",
                data:{
                    "_token":"{{csrf_token()}}",
                    service_id : service_id,
                    tx_type : tx_type,
                },
                success:function(data){
                    $.each(data,function(i,d){
                        sel.append(`<option value="`+d.sub_activity+`">`+d.sub_activity+`</option>`);
                    })
                }
            });
        })
    </script>
    <script>
        $(document).ready(function () {


            // $('.perunit').attr('disabled', 'disabled');
            // $('.billed_per').change(function (event) {
            //     var v = $(this).val();
            //     if (v == 2) {
            //         $('.perunit').removeAttr('disabled');
            //         $('.perunit').find('option[value="0"]').remove();
            //     } else
            //         $('.perunit').attr('disabled', 'disabled');
            // });


            $('.max_one').change(function () {
                var id = $(this).val();
                if (id == 1) {
                    $('.max_one_select').empty();
                    $('.max_one_select').append(
                        `
                             <option value="0"></option>
                                 <option value="Day">Day</option>
                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                } else {
                    $('.max_one_select').empty();
                    $('.max_one_select').append(
                        `
                             <option value="0"></option>

                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                }

            })


            $('.max_two').change(function () {
                var id = $(this).val();
                if (id == 1) {
                    $('.max_two_select').empty();
                    $('.max_two_select').append(
                        `
                             <option value="0"></option>
                                 <option value="Day">Day</option>
                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                } else {
                    $('.max_two_select').empty();
                    $('.max_two_select').append(
                        `
                             <option value="0"></option>

                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                }

            })

            $('.max_three').change(function () {
                var id = $(this).val();
                if (id == 1) {
                    $('.max_three_select').empty();
                    $('.max_three_select').append(
                        `
                             <option value="0"></option>
                                 <option value="Day">Day</option>
                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                } else {
                    $('.max_three_select').empty();
                    $('.max_three_select').append(
                        `
                             <option value="0"></option>

                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                }

            })
        })
    </script>



    <script>
        $(document).ready(function () {
            var primary = $('.is_primary').val();
            var placeholder = $('.is_placeholder').val();
            var inactive = $('.is_valid').val();


            $('.is_primary').click(function () {
                if ($('.is_primary').is(':checked') && $('.is_placeholder').is(':checked')) {
                    $('.is_valid').prop('checked', false);
                    $('.is_valid').prop('disabled', true);
                } else if ($('.is_primary').is(':checked') && $('.is_placeholder').not(':checked')) {
                    $('.is_valid').prop('disabled', false);
                } else {
                    if ($('.is_primary').is(':checked')) {
                        $('.is_valid').prop('checked', true);
                    }

                    $('.is_valid').prop('disabled', false);
                }
            })


            $('.is_placeholder').click(function () {
                if ($('.is_primary').is(':checked') && $('.is_placeholder').is(':checked')) {
                    $('.is_valid').prop('checked', false);
                    $('.is_valid').prop('disabled', true);
                } else if ($('.is_valid').is(':checked') && $('.is_placeholder').is(':checked')) {
                    $('.is_primary').prop('checked', false);
                    $('.is_primary').prop('disabled', true);
                } else {
                    if ($('.is_primary').is(':checked')) {
                        $('.is_valid').prop('checked', false);
                    }

                    $('.is_valid').prop('disabled', false);
                }
            })


            $('.is_valid').click(function () {
                if ($('.is_valid').is(':checked') && $('.is_placeholder').is(':checked')) {
                    $('.is_primary').prop('checked', false);
                    $('.is_primary').prop('disabled', true);
                } else if ($('.is_primary').is(':checked') && $('.is_placeholder').not(':checked')) {
                    $('.is_valid').prop('disabled', false);
                } else {
                    if ($('.is_valid').is(':checked')) {
                        $('.is_primary').prop('checked', false);
                    }
                    $('.is_primary').prop('disabled', false);
                }
            })

            $('.auth_require_switch').change(function(){
                if($(this).prop("checked") == true){
                    $('.authorization_number').prop("disabled",true);
                    $('.authorization_number').val('N/A');
                }
                else{
                    $('.authorization_number').prop("disabled",false);
                    $('.authorization_number').val('');

                }
            })

            switch_val = $('.auth_require_switch').prop("checked");
            if(switch_val){
                $('.authorization_number').prop("disabled",true);
                $('.authorization_number').val('N/A');
            }
            else{
                $('.authorization_number').prop("disabled",false);
            }


            $('#editAuth').click(function(e){
                e.preventDefault();
                date_val = $('.date_range').val();
                description = $('.description').val();
                disagnosis = $('.diagnosis').val();
                auth_num = $('.authorization_number').val();
                ins_num = $('.ins_number').val();
                if(description == null || description == ''){
                    toastr["error"]("Give description to proceed.","ALERT!");
                }
                else if(date_val == null || date_val == ''){
                    toastr["error"]("Select date to proceed.","ALERT!");
                }
                else if(auth_num == null || auth_num == ''){
                    toastr["error"]("Give Auth Number to proceed.","ALERT!");
                }
                else if(ins_num == null || ins_num == ''){
                    toastr["error"]("Give UCI/Insurance ID to proceed.","ALERT!");
                }
                else if(disagnosis == null || disagnosis == ''){
                    toastr["error"]("Give Diagnosis 1 to proceed.","ALERT!");
                }
                else{
                    $('#edit_auth_form').submit();
                }
            });


        })
    </script>
    <script>
        $(document).ready(function () {
            $('.billed_time').hide();
            $('.billed_time1').hide();
            var billed_type = $('.billed_type').val();
            if (billed_type == "Per Unit") {
                $('.billed_time').show();
            } else if (billed_type == "Per Session") {
                $('.billed_time').hide();
            } else {
                $('.billed_time').hide();
            }


            var billed_type1 = $('.billed_type1').val();
            if (billed_type1 == "Per Unit") {
                $('.billed_time1').show();
            } else if (billed_type1 == "Per Session") {
                $('.billed_time1').hide();
            } else {
                $('.billed_time1').hide();
            }


            $('.billed_type').change(function () {
                var value_data = $(this).val();
                if (value_data == "Per Unit") {
                    $('.billed_time').show();
                } else if (value_data == "Per Session") {
                    $('.billed_time').hide();
                } else {
                    $('.billed_time').hide();
                }
            })


            $('.billed_type1').change(function () {
                var value_data1 = $(this).val();
                if (value_data1 == "Per Unit") {
                    $('.billed_time1').show();
                } else if (value_data1 == "Per Session") {
                    $('.billed_time1').hide();
                } else {
                    $('.billed_time1').hide();
                }
            })


        })
    </script>

@endsection
