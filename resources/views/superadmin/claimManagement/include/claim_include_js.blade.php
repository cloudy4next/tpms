@section('js')
    <script src="{{ asset('assets/dashboard/custom/claim_manage.js') }}"></script>
    <script>
        $('.loading2').hide();
        $('.download_div').hide();

        $(document).ready(function () {
            $('.search_filter').hide();
            $('.filter_by').change(function () {
                reset_filterone();
                var f_id = $(this).val();
                $('.loading2').show();
                if (f_id == 0) {
                    $('.loading2').hide();
                } else if (f_id == 1) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.batchid') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.batch_id').empty();
                            $('.batch_id').append(
                                `<option value=""></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.batch_id').append(
                                    `<option value="${value.batch_id}">${value.batch_id}</option>`
                                );
                            })

                            $('.loading2').hide();
                        }
                    });
                } else if (f_id == 2) {
                    $('.loading2').hide();
                } else if (f_id == 3) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.payor') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.payor').empty();
                            if (data.name_loca != 1) {
                                $('.payor').append(
                                    `<option value=""></option>`
                                );
                            }

                            $.each(data.payors, function (index, value) {
                                $('.payor').append(
                                    `<option value="${value.payor_id}">${value.payor_name}</option>`
                                );
                            })

                            if (data.name_loca == 1) {
                                $('#payor').multiselect({includeSelectAllOption: true});
                                $("#payor").multiselect('rebuild');
                            }

                            $('.loading2').hide();
                        }
                    });
                } else if (f_id == 4) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.client') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.client').empty();
                            $('.client').append(
                                `<option value=""></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.client').append(
                                    `<option value="${value.id}">${value.client_full_name}</option>`
                                );
                            })

                            $('.loading2').hide();
                        }
                    });
                } else if (f_id == 5) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.treating.employee') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.treating_therapist').empty();
                            $('.treating_therapist').append(
                                `<option value=""></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.treating_therapist').append(
                                    `<option value="${value.id}">${value.full_name}</option>`
                                );
                            })
                            $('.loading2').hide();
                        }
                    });
                } else if (f_id == 6) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.cms.employee') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.cms_emloyee').empty();
                            $('.cms_emloyee').append(
                                `<option value=""></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.cms_emloyee').append(
                                    `<option value="${value.id}">${value.full_name}</option>`
                                );
                            })
                            $('.loading2').hide();
                        }
                    });
                } else if (f_id == 7) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.activitytype') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.activitytype').empty();
                            $('.activitytype').append(
                                `<option value=""></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.activitytype').append(
                                    `<option value="${value.id}">${value.activity_one}</option>`
                                );
                            })
                            $('.loading2').hide();
                        }
                    });
                } else if (f_id == 8) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.claimstatus') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.claimstatus').empty();
                            $('.claimstatus').append(
                                `<option value=""></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.claimstatus').append(
                                    `<option value="${value.status}">${value.status}</option>`
                                );
                            })
                            $('.loading2').hide();
                        }
                    });
                } else {
                    $('.loading2').hide();
                }
            });


            $('.filter_by1').change(function () {
                reset_filtertwo();
                var f_id = $(this).val();
                $('.loading2').show();
                if (f_id == 0) {
                    $('.loading2').hide();
                } else if (f_id == 1) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.batchid') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.batch_id_one').empty();
                            $('.batch_id_one').append(
                                `<option value=""></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.batch_id_one').append(
                                    `<option value="${value.batch_id}">${value.batch_id}</option>`
                                );
                            })
                            $('.loading2').hide();
                        }
                    });
                } else if (f_id == 2) {
                    $('.loading2').hide();
                } else if (f_id == 3) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.payor') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.payor_one').empty();
                            if (data.name_loca != 1) {
                                $('.payor_one').append(
                                    `<option value=""></option>`
                                );
                            }

                            $.each(data.payors, function (index, value) {
                                $('.payor_one').append(
                                    `<option value="${value.payor_id}">${value.payor_name}</option>`
                                );
                            })

                            if (data.name_loca == 1) {
                                $('#payor_one').multiselect({includeSelectAllOption: true});
                                $("#payor_one").multiselect('rebuild');
                            }
                            $('.loading2').hide();
                        }
                    });
                } else if (f_id == 4) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.client') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.client_one').empty();
                            $('.client_one').append(
                                `<option value=""></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.client_one').append(
                                    `<option value="${value.id}">${value.client_full_name}</option>`
                                );
                            })
                            $('.loading2').hide();
                        }
                    });
                } else if (f_id == 5) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.treating.employee') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.treating_therapist_one').empty();
                            $('.treating_therapist_one').append(
                                `<option value=""></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.treating_therapist_one').append(
                                    `<option value="${value.id}">${value.full_name}</option>`
                                );
                            })
                            $('.loading2').hide();
                        }
                    });
                } else if (f_id == 6) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.cms.employee') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.cms_emloyee_one').empty();
                            $('.cms_emloyee_one').append(
                                `<option value=""></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.cms_emloyee_one').append(
                                    `<option value="${value.id}">${value.full_name}</option>`
                                );
                            })
                            $('.loading2').hide();
                        }
                    });
                } else if (f_id == 7) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.activitytype') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.activitytype_one').empty();
                            $('.activitytype_one').append(
                                `<option value=""></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.activitytype_one').append(
                                    `<option value="${value.id}">${value.activity_one}</option>`
                                );
                            })
                            $('.loading2').hide();
                        }
                    });
                } else if (f_id == 8) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.claimstatus') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $('.claimstatus_one').empty();
                            $('.claimstatus_one').append(
                                `<option value=""></option>`
                            );
                            $.each(data, function (index, value) {
                                $('.claimstatus_one').append(
                                    `<option value="${value.status}">${value.status}</option>`
                                );
                            })
                            $('.loading2').hide();
                        }
                    });
                } else {
                    $('.loading2').hide();
                }
            });


        })
 
        function reset_filterone(){
            $('.batch_id').val("");
            $('.claim_name').val("");
            $('.payor').val("");
            $('.client').val("");
            $('.treating_therapist').val("");
            $('.cms_emloyee').val("");
            $('.activitytype').val("");
            $('.claimstatus').val("");
            $('.reportrange').val("");
            $('.sumiteddate').val("");
        }


        function reset_filtertwo(){
            $('.batch_id_one').val("");
            $('.claim_name_one').val("");
            $('.payor_one').val("");
            $('.client_one').val("");
            $('.treating_therapist_one').val("");
            $('.cms_emloyee_one').val("");
            $('.activitytype_one').val("");
            $('.claimstatus_one').val("");
            $('.reportrange_one').val("");
            $('.sumiteddate_one').val("");
        }

        $(document).ready(function () {

            $('.table_transaction').hide();
            $('#get_claim').click(function () {
                $('.loading2').show();
                $('.claim_tran_show').hide();

                var batch_id = $('.batch_id').val();
                var claim_name = $('.claim_name').val();
                var payor = $('.payor').val();
                var client = $('.client').val();
                var treating_therapist = $('.treating_therapist').val();
                var cms_emloyee = $('.cms_emloyee').val();
                var activitytype = $('.activitytype').val();
                var claimstatus = $('.claimstatus').val();
                var reportrange = $('.reportrange').val();
                var sumiteddate = $('.sumiteddate').val();


                var batch_id_one = $('.batch_id_one').val();
                var claim_name_one = $('.claim_name_one').val();
                var payor_one = $('.payor_one').val();
                var client_one = $('.client_one').val();
                var treating_therapist_one = $('.treating_therapist_one').val();
                var cms_emloyee_one = $('.cms_emloyee_one').val();
                var activitytype_one = $('.activitytype_one').val();
                var claimstatus_one = $('.claimstatus_one').val();
                var reportrange_one = $('.reportrange_one').val();
                var sumiteddate_one = $('.sumiteddate_one').val();


                var filter_by = $('.filter_by').val();
                var filter_by1 = $('.filter_by1').val();

                if (filter_by == 0) {
                    $('.loading2').hide();
                } else if (filter_by == 3 && payor == null || payor == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Insurance", 'ALERT!');
                } else if (filter_by == 3 && payor.length > 5) {
                    $('.loading2').hide();
                    toastr["error"]("Insurance Can be Selected Max 5", 'ALERT!');
                } else if (filter_by1 == 3 && payor_one == null || payor_one == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Insurance", 'ALERT!');
                } else if (filter_by1 == 3 && payor_one.length > 5) {
                    $('.loading2').hide();
                    toastr["error"]("Insurance Can be Selected Max 5", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.claim.get.claimbyfilter') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'batch_id': batch_id,
                            'claim_name': claim_name,
                            'payor': payor,
                            'client': client,
                            'treating_therapist': treating_therapist,
                            'cms_emloyee': cms_emloyee,
                            'activitytype': activitytype,
                            'claimstatus': claimstatus,
                            'reportrange': reportrange,
                            'sumiteddate': sumiteddate,

                            'batch_id_one': batch_id_one,
                            'claim_name_one': claim_name_one,
                            'payor_one': payor_one,
                            'client_one': client_one,
                            'treating_therapist_one': treating_therapist_one,
                            'cms_emloyee_one': cms_emloyee_one,
                            'activitytype_one': activitytype_one,
                            'claimstatus_one': claimstatus_one,
                            'reportrange_one': reportrange_one,
                            'sumiteddate_one': sumiteddate_one,
                        },
                        success: function (data) {
                            console.log(data);
                            if (data == 'not seleted') {
                                $('.claimdatashow').hide();
                                $('.loading2').hide();
                            } else {
                                // $('.claim_details').show();
                                // $('.claimdatashow').show();
                                $('.claimdatashow').empty().append(data.view);
                                $('.download_div').show();

                                $(".c_table").tablesorter();
                                $('.loading2').hide();
                            }
                            // var batch_id = $('.batch_id').val('');
                            // var claim_name = $('.claim_name').val('');
                            // var payor = $('.payor').val('');
                            // var client = $('.client').val('');
                            // var treating_therapist = $('.treating_therapist').val('');
                            // var cms_emloyee = $('.cms_emloyee').val('');
                            // var activitytype = $('.activitytype').val('');
                            // var claimstatus = $('.claimstatus').val('');
                            // var reportrange = $('.reportrange').val('');
                            // var sumiteddate = $('.sumiteddate').val('');


                            $('.select_action_div').show();
                            $('.trasac_ac_div').hide();
                        }
                    });
                }


            });


            $(document).on('click', '.select_all_claim', function () {
                if ($(this).prop("checked") == true) {
                    $('.claim_id_select').each(function () {
                        $(this).prop('checked', true);
                        jQuery(this).closest('tr').find(".add_claim_ids").prop('disabled', false);
                    });
                }
            })

            $(document).on('click', '.select_all_claim', function () {
                if ($(this).prop("checked") == false) {
                    $('.claim_id_select').each(function () {
                        $(this).prop('checked', false);
                        jQuery(this).closest('tr').find(".add_claim_ids").prop('disabled', true);
                    });
                }
            })


            $(document).on('click', '.transaction_check_all', function () {
                if ($(this).prop("checked") == true) {
                    $('.transaction_single').each(function () {
                        $(this).prop('checked', true);
                    });
                }
            })

            $(document).on('click', '.transaction_check_all', function () {
                if ($(this).prop("checked") == false) {
                    $('.transaction_single').each(function () {
                        $(this).prop('checked', false);
                    });
                }
            })


            $(document).on('click', '.claim_id_select_form', function () {
                jQuery(this).closest('tr').find(".add_claim_ids").prop('disabled', false);
            })


            $('#ok_btn').click(function () {

                $('.loading2').show();
                $('.claim_tran_show').hide();
                var ac_id = $('.select_option_1').val();

                var array = [];
                $('.claim_id_select:checked').each(function () {
                    array.push($(this).val());
                });


                if (array.length <= 0 || array == null) {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Claim", 'ALERT!');
                } else {
                    if (ac_id == 1) {
                        $('.loading2').hide();
                        $('#claim_tran_submit').submit();
                    } else if (ac_id == 2) {
                        $('.loading2').hide();
                        $('#claim_tran_submit').submit();
                    } else if (ac_id == 3) {

                        $.ajax({
                            type: "POST",
                            url: "{{ route('superadmin.billing.claim.management.push.sftp') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'claim_id': array,
                            },
                            success: function (data) {
                                console.log(data)
                                if (data == "connection_problem") {
                                    $('.loading2').hide();
                                    toastr["error"]("SFTP Connection Problem", 'ALERT!');
                                }

                                if (data == "authentication_failed") {
                                    $('.loading2').hide();
                                    toastr["error"]("SFTP Authentication Failed", 'ALERT!');
                                }

                                if (data == "inv_cren") {
                                    $('.loading2').hide();
                                    toastr["error"]("Invalid SFTP Credentials", 'ALERT!');
                                }


                                if (data == "not_uploaded") {
                                    $('.loading2').hide();
                                    toastr["error"]("Something Went Wrong", 'ALERT!');
                                }

                                if (data == "file_not_open") {
                                    $('.loading2').hide();
                                    toastr["error"]("SFTP Directory Not Open", 'ALERT!');
                                }

                                if (data == "function_not_exist") {
                                    $('.loading2').hide();
                                    toastr["error"]("SFTP Connection Problem", 'ALERT!');
                                }

                                if (data == "file_uploaded") {
                                    $('.loading2').hide();
                                    toastr["success"]("SFTP File Uploaded Successfully", 'Success!');
                                }
                            }
                        });
                    } else if (ac_id == 4) {
                        console.log('done');
                        $.ajax({
                            type: "POST",
                            url: "{{ route('superadmin.billing.claim.management.history') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'claim_id': array,
                            },
                            success: function (data) {
                                console.log(data)
                                $('.table_transaction').show();
                                $('.claim_transaction').show();
                                $('.search_filter').show();
                                $('.claim_transaction').empty().append(data.view);
                                $('.claim_tran_show').show();
                                $('.trasac_ac_div').show();
                                $('.download_div').show();
                                $(".c_table").tablesorter();
                                $('.loading2').hide();
                            }
                        });
                    } else if (ac_id == 5) {

                        $.ajax({
                            type: "POST",
                            url: "{{ route('superadmin.billing.claim.management.sec.claim.generate') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'claim_id': array,
                            },
                            success: function (data) {
                                console.log(data)
                                if (data == "empty") {
                                    $('.loading2').hide();
                                    toastr["error"]("No Data Found", 'ALERT!');
                                }

                                if (data == "nosecauth") {
                                    $('.loading2').hide();
                                    toastr["error"]("No Secondary Authorization Found",
                                        'ALERT!');
                                }

                                $('.loading2').hide();

                            }
                        });
                    } else if (ac_id == 6) {
                        console.log(array);
                        $.ajax({
                            type: "POST",
                            url: "{{ route('superadmin.claim.generate.837') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'claim_id': array,
                            },
                            success: function (data) {
                                console.log(data);
                                if(data["status"] == "success"){
                                    var url = "{{ url('admin/billing/claim-management-generate-837/download') }}" + '/' + data["msg"];
                                    var win = window.open(url, '_blank');
                                    // setTimeout(function () {
                                    //     win.close();
                                    // }, 1000);
                                    $('.loading2').hide();
                                    return false;
                                }
                                else if(data["status"] == "error"){
                                    toastr["error"](data["msg"]);
                                    $('.loading2').hide();
                                }
                            }
                        });


                    } else if(ac_id==7){
                        $('.loading2').hide();
                        $('#codeBoxBulk').modal('show');
                    } else {
                        $('.loading2').hide();
                    }
                }


            });


            $('.search_transaction').keyup(function () {
                $('.loading2').show();
                var search = $(this).val();
                var array = [];
                $('.claim_id_select:checked').each(function () {
                    array.push($(this).val());
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.billing.claim.management.history.search') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'claim_id': array,
                        'search': search,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.table_transaction').show();
                        $('.claim_transaction').show();
                        $('.search_filter').show();
                        $('.claim_transaction').empty().append(data.view);
                        $(".c_table").tablesorter();
                        $('.claim_tran_show').show();
                        $('.loading2').hide();
                    }
                });
            })


            $('#cl_tran_ok_btn').click(function () {
                $('.loading2').show();
                var action_id = $('.claim_transacton_action').val();
                var array = [];
                $('.transaction_single:checked').each(function () {
                    array.push($(this).val());
                });


                if (action_id == 1) {

                    if (array.length === 0) {
                        $('.loading2').hide();
                        toastr["error"]("Please Select Transaction", 'ALERT!');
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('superadmin.billing.claim.rebuiiled.transaction') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'claim_id': array,
                            },
                            success: function (data) {
                                console.log(data)

                                if (data == 'rebullid_done') {
                                    $('.claimdatashow').hide();
                                    $('.claim_transaction').hide();
                                    $('.select_action_div').hide();
                                    $('.trasac_ac_div').hide();

                                    $('.filter_by').val(0);
                                    $('.filter_by1').val(0);
                                    $('.loading2').hide();
                                    // location.reload();
                                }


                            }
                        });
                    }


                } else if (action_id == 2) {
                    if (array.length === 0) {
                        toastr["error"]("Please Select Transaction", 'ALERT!');
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('superadmin.billing.claim.split.transaction') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'claim_id': array,
                            },
                            success: function (data) {
                                console.log(data)
                                if (data == "done") {
                                    $('.table_transaction').hide();
                                    $('.claim_transaction').hide();
                                    // toastr["success"]("Transaction Successfully Split",'SUCCESS!');
                                } else if (data == 'have single transaction') {
                                    // toastr["error"]("You Cant Not Split The Selected Session ",'WARNING!');
                                } else {
                                    // toastr["error"]("You can not Split ",'SUCCESS!');
                                }
                                $('.filter_by').val(0);
                                $('.filter_by1').val(0);
                                $('.loading2').hide();
                            }
                        });
                    }


                } else {
                    toastr["error"]("Something Went Wrong", 'ALERT!');
                }


            });


            $('#claim_save').click(function () {
                var array = [];
                var authno = [];
                $('.claim_id_select:checked').each(function () {
                    array.push($(this).val());
                    authno.push(jQuery(this).closest('tr').find(".auth_no").val());
                });

                if (array.length <= 0) {
                    toastr["error"]("Please Select Claim", 'WARNING!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.billing.claim.update.auth') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'claim_id': array,
                            'authno': authno,
                        },
                        success: function (data) {
                            console.log(data)
                            toastr["success"]("Manage Claim Updated Successfully", 'SUCCESS!');
                        }
                    });
                }


            });


            $(document).on('click', '.show_sing_hcfa', function () {
                $('#singleclaimfrom').submit();
            })


        })
    </script>


    <script>
        var timeStamp= moment().format('MMDYYYYhmmss');

        $(document).on('click', '#download_csv', function () {
            $('#export_table').tableExport({
                type: 'csv',
                fileName: "ManageClaims_"+timeStamp
            });
        });
        $(document).on('click', '#download_pdf', function () {
            $('#export_table').tableExport({
                type: 'pdf',
                fileName: 'ManageClaims_'+timeStamp,
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


    <script>
        $(document).on('click','.view_code_btn',function(){
            $('.box_19').val('');
            $('.resubmit_code').val('');
            $('.orginal_ref_no').val('');
            $('.auth_no').val('');
            $('.claim_id').val('');

            box_19=$(this).data('box19');
            resub=$(this).data('resub');
            ref=$(this).data('ref');
            auth=$(this).data('auth');
            claimId=$(this).data('claim');

            $('.box_19').val(box_19);
            $('.resubmit_code').val(resub);
            $('.orginal_ref_no').val(ref);
            $('.auth_no').val(auth);
            $('.claim_id').val(claimId);

            $('#codeBox').modal("show");
        })


        $(document).on('click','#codeSubmit',function(){
            var array = [];
            var box19 = [];
            var resubmitcode = [];
            var orginal = [];
            array.push($('.claim_id').val());
            box19.push($('.box_19').val());
            resubmitcode.push($('.resubmit_code').val());
            orginal.push($('.orginal_ref_no').val());

            if (array.length <= 0) {
                toastr["error"]("Please Select Claim", 'WARNING!');
            } else {
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.billing.claim.update.data') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'claim_id': array,
                        'box19': box19,
                        'resubmitcode': resubmitcode,
                        'orginal': orginal,
                    },
                    success: function (data) {
                        console.log(data)
                        $('#get_claim').click();
                        $('#codeBox').modal("hide");
                        toastr["success"]("Manage Claim Updated Successfully", 'SUCCESS!');
                    }
                });
            }
        })

        $(document).on('click','#codeSubmitBulk',function(){
            bulk_update_code();
        })


        function bulk_update_code(){
            var array = [];
            var box19 = [];
            var resubmitcode = [];
            var orginal = [];
            $('.claim_id_select:checked').each(function () {
                array.push($(this).val());
                box19.push($('.box_19_b').val());
                resubmitcode.push($('.resubmit_code_b').val());
                orginal.push($('.orginal_ref_no_b').val());
            });

            if (array.length <= 0) {
                toastr["error"]("Please Select Claim", 'WARNING!');
            } else {
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.billing.claim.update.data') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'claim_id': array,
                        'box19': box19,
                        'resubmitcode': resubmitcode,
                        'orginal': orginal,
                    },
                    success: function (data) {
                        console.log(data)
                        $('#get_claim').click();
                        $('#codeBoxBulk').modal("hide");
                        toastr["success"]("Manage Claim Updated Successfully", 'SUCCESS!');
                    }
                });
            }
        }


    </script>






@endsection
