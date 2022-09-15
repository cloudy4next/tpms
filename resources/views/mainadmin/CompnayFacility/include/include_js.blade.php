@section('js')
    <script>
        $(document).ready(function () {
            $.ajax({
                type: "POST",
                url: "{{route('mainadmin.company.get.all')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {
                    console.log(data);
                    // location.reload();
                    $('.all_compnay').empty();
                    $('.all_compnay').append(
                        `<option value="0">select company</option>`
                    )
                    $.each(data, function (index, value) {
                        $('.all_compnay').append(
                            `<option value="${value.id}">${value.company_name}</option>`
                        )
                    })

                }
            });

            $('.addcom_btn').click(function () {
                $('.is_edit').val(1);
                var com_name = $('.com_name').val('');
                var com_address = $('.com_address').val('');
                var com_city = $('.com_city').val('');
                var com_state = $('.com_state').val('');
                var com_zip = $('.com_zip').val('');
                var com_phone = $('.com_phone').val('');
                var com_email = $('.com_email').val('');
                var com_website = $('.com_website').val('');
                $('.com_is_active').prop('checked', false);

            })


            $('.all_compnay').change(function () {
                $('.is_edit').val(0);
                var com_id = $(this).val();
                var edit_id = $('.edit_id').val(com_id);

                $.ajax({
                    type: "POST",
                    url: "{{route('mainadmin.company.get.company.details')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'com_id': com_id
                    },
                    success: function (data) {
                        console.log(data);
                        var com_name = $('.com_name').val(data.company_name);
                        var com_address = $('.com_address').val(data.company_address);
                        var com_city = $('.com_city').val(data.company_city);
                        var com_state = $('.com_state').val(data.company_state);
                        var com_zip = $('.com_zip').val(data.company_zip);
                        var com_phone = $('.com_phone').val(data.company_phone);
                        var com_email = $('.com_email').val(data.company_email);
                        var com_website = $('.com_website').val(data.company_website);

                        if (data.is_active == 1) {
                            $('.com_is_active').prop('checked', true);
                        } else {
                            $('.com_is_active').prop('checked', false);
                        }

                    }
                });

            })


            $('#save_compnay').click(function (e) {
                e.preventDefault();
                var is_edit = $('.is_edit').val();
                var edit_id = $('.edit_id').val();
                var com_name = $('.com_name').val();
                var com_address = $('.com_address').val();
                var com_city = $('.com_city').val();
                var com_state = $('.com_state').val();
                var com_zip = $('.com_zip').val();
                var com_phone = $('.com_phone').val();
                var com_email = $('.com_email').val();
                var com_website = $('.com_website').val();

                if ($('.com_is_active').prop('checked') == true) {
                    var com_is_active = 1;
                } else {
                    var com_is_active = 0;
                }

                if (is_edit == 1) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('mainadmin.company.save')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'com_is_active': com_is_active,
                            'com_name': com_name,
                            'com_address': com_address,
                            'com_city': com_city,
                            'com_state': com_state,
                            'com_zip': com_zip,
                            'com_phone': com_phone,
                            'com_email': com_email,
                            'com_website': com_website,
                        },
                        success: function (data) {
                            console.log(data);
                            var com_name = $('.com_name').val('');
                            var com_address = $('.com_address').val('');
                            var com_city = $('.com_city').val('');
                            var com_state = $('.com_state').val('');
                            var com_zip = $('.com_zip').val('');
                            var com_phone = $('.com_phone').val('');
                            var com_email = $('.com_email').val('');
                            var com_website = $('.com_website').val('');
                            $('.com_is_active').prop('checked', false);
                            getAllCom();
                        }
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{route('mainadmin.company.update')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'is_edit': is_edit,
                            'edit_id': edit_id,
                            'com_is_active': com_is_active,
                            'com_name': com_name,
                            'com_address': com_address,
                            'com_city': com_city,
                            'com_state': com_state,
                            'com_zip': com_zip,
                            'com_phone': com_phone,
                            'com_email': com_email,
                            'com_website': com_website,
                        },
                        success: function (data) {
                            console.log(data);
                            getAllCom();
                        }
                    });
                }


                function getAllCom() {
                    $.ajax({
                        type: "POST",
                        url: "{{route('mainadmin.company.get.all')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                        },
                        success: function (data) {
                            console.log(data);
                            // location.reload();
                            $('.all_compnay').empty();
                            $('.all_compnay').append(
                                `<option value="0">select company</option>`
                            )
                            $.each(data, function (index, value) {
                                $('.all_compnay').append(
                                    `<option value="${value.id}">${value.company_name}</option>`
                                )
                            })

                        }
                    });
                }


            });


            $('.s_admin_fac').change(function () {
                let sadminfac = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{route('mainadmin.get.admin.byfaicility')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'sadminfac': sadminfac
                    },
                    success: function (data) {
                        console.log(data);
                        // location.reload();
                        $('.up_admin_id').empty();
                        $('.up_admin_id').append(
                            `<option value="">select admin</option>`
                        )
                        $.each(data, function (index, value) {
                            $('.up_admin_id').append(
                                `<option value="${value.id}">${value.first_name} ${value.last_name}</option>`
                            )
                        })

                    }
                });
            })


        })
    </script>

    <script>
        $(document).ready(function () {
            $('.sub_password').keyup(function () {
                let text = $(this).val().length;
                console.log(text)
                if (text < 8) {
                    let pass = `<span class="text-danger error_msg_subpass">Password must be at least 8 characters</span>`
                    $('.error_msg_subpass').replaceWith(pass);
                } else {
                    let pass = `<span class="text-danger error_msg_subpass"></span>`;
                    $('.error_msg_subpass').replaceWith(pass);
                }
            })
        })
    </script>


    <script>
        jQuery(document).ready(function ($) {
            $('.com_detail').hide();
            $('.addedit_facility').hide();
            $('.exist_facility').hide();
            $('.addfacility_btn').hide();
            $('.selectcom').change(function (event) {
                $('.com_detail').show();
                $('.exist_facility').show();
                $('.addfacility_btn').show();
            });
            $('.addfacility_btn').click(function (event) {
                $('.addedit_facility').show();
                var all_compnay = $('.all_compnay').val();
                $('.comnay_id').empty().val(all_compnay);
            });
            $('.cancel_btn').click(function (event) {
                $('.com_detail').hide();
                $('.addedit_facility').hide();
                $('.exist_facility').hide();
                $('.addfacility_btn').hide();
            });
            $('.cancel_facility').click(function (event) {
                $('.addedit_facility').hide();
            });
            $('.addcom_btn').click(function (event) {
                $('.com_detail').show();
                $('.addedit_facility').hide();
                $('.exist_facility').show();
                $('.addfacility_btn').hide();
            });
            $('.detail_btn').click(function (event) {
                event.preventDefault();
                $('.com_detail').show();
                $('.addedit_facility').show();
                $('.exist_facility').show();
                $('.addfacility_btn').show();
            });
        });
    </script>
@endsection
