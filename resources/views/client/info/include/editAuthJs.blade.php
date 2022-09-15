@section('js')
    <script>
        $(document).ready(function () {
            $('#add_service').click(function () {
                let treatment_type = $('.treatment_type').val();


                $.ajax({
                    type: "POST",
                    url: "{{route('client.myauthorization.get.subtype.by.tx')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'treatment_type': treatment_type,
                    },
                    success: function (data) {
                        $('.sub_type_acts').empty();
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


                    }
                });


                $.ajax({
                    type: "POST",
                    url: "{{route('client.myauthorization.get.service.by.tx')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'treatment_type': treatment_type,
                    },
                    success: function (data) {

                        $('.serivec_tx').empty();
                        if (data.length > 0) {
                            $.each(data, function (index, value) {
                                $('.serivec_tx').append(
                                    `<option value="${value.description}">${value.description}</option>`
                                );
                            })
                        } else {
                            $('.serivec_tx').append(
                                `<option value=""></option>`
                            );
                        }


                    }
                });


                //get all cpt codes
                $.ajax({
                    type: "POST",
                    url: "{{route('client.myauthorization.get.cpt.codes.by.tx')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'treatment_type': treatment_type,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.act_crt_cpt_code').empty();
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


                    }
                });


            });


            $('.editActModal').click(function () {
                let act_data = $(this).data('id');
                let treatment_type = $('.treatment_type').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('client.myauthorization.get.authdata.by.act')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'act_data': act_data,
                    },
                    success: function (data) {
                        $('.exist_act_one').empty();
                        $('.exist_act_one').val(data.activity_one);

                        $('.exist_act_two').empty();
                        $('.exist_act_two').val(data.activity_two);

                        $('.exist_cpt_code').empty();
                        $('.exist_cpt_code').val(data.cpt_code);

                        getDataEditAct();

                    }
                });

            });


            function getDataEditAct() {

                let treatment_type = $('.treatment_type').val();
                // edit act server
                $.ajax({
                    type: "POST",
                    url: "{{route('client.myauthorization.get.service.by.tx')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'treatment_type': treatment_type,
                    },
                    success: function (data) {

                        $('.edit_activity_one').empty();
                        if (data.length > 0) {
                            $.each(data, function (index, value) {
                                $('.edit_activity_one').append(
                                    `<option value="${value.description}">${value.description}</option>`
                                );
                            });
                        } else {
                            $('.edit_activity_one').append(
                                `<option value=""></option>`
                            );
                        }

                        let exit_act_one_val = $('.exist_act_one').val();
                        $('.edit_activity_one').val(exit_act_one_val);
                    }
                });


                //edit act ser sub type
                $.ajax({
                    type: "POST",
                    url: "{{route('client.myauthorization.get.subtype.by.tx')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'treatment_type': treatment_type,
                    },
                    success: function (data) {
                        $('.exit_activity_two').empty();
                        if (data.length > 0) {
                            $.each(data, function (index, value) {
                                $('.exit_activity_two').append(
                                    `<option value="${value.sub_activity}">${value.sub_activity}</option>`
                                );
                            })
                        } else {
                            $('.exit_activity_two').append(
                                `<option value=""></option>`
                            );
                        }

                        let exist_act_two = $('.exist_act_two').val();
                        $('.exit_activity_two').val(exist_act_two);


                    }
                });


                //edit act cpt
                $.ajax({
                    type: "POST",
                    url: "{{route('client.myauthorization.get.cpt.codes.by.tx')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'treatment_type': treatment_type,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.exist_cpt_code_data').empty();
                        if (data.length > 0) {
                            $.each(data, function (index, value) {
                                $('.exist_cpt_code_data').append(
                                    `<option value="${value.cpt_id}">${value.cpt_code}</option>`
                                );
                            })
                        } else {
                            $('.exist_cpt_code_data').append(
                                `<option value=""></option>`
                            );
                        }


                        let exist_cpt_code = $('.exist_cpt_code').val();
                        $('.exist_cpt_code_data').val(exist_cpt_code);

                    }
                });


            }


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
                $('.billed_time').show();
            } else {
                $('.billed_time').hide();
            }


            var billed_type1 = $('.billed_type1').val();
            if (billed_type1 == "Per Unit") {
                $('.billed_time1').show();
            } else if (billed_type1 == "Per Session") {
                $('.billed_time1').show();
            } else {
                $('.billed_time1').hide();
            }


            $('.billed_type').change(function () {
                var value_data = $(this).val();
                if (value_data == "Per Unit") {
                    $('.billed_time').show();
                } else if (value_data == "Per Session") {
                    $('.billed_time').show();
                } else {
                    $('.billed_time').hide();
                }
            })


            $('.billed_type1').change(function () {
                var value_data1 = $(this).val();
                if (value_data1 == "Per Unit") {
                    $('.billed_time1').show();
                } else if (value_data1 == "Per Session") {
                    $('.billed_time1').show();
                } else {
                    $('.billed_time1').hide();
                }
            })


        })
    </script>

@endsection
