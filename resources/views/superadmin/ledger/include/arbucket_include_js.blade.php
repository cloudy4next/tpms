@section('js')
    <script>
        jQuery(document).ready(function ($) {
            $('.download_div').hide();
            $('.ledger_table').hide();
            $('.transaction_table').hide();
            $('.add_notes').hide();
            $('.view_btn').click(function (event) {
                $('.ledger_table').show();
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            int_sel = $('.select_date');
            function fetch_clients(){
                check_date = int_sel.val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.ar.followup.bucket.filter.data.client')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'check_date': check_date,
                    },
                    success: function (data) {
                        $('.client_id').empty();
                        $.each(data, function (index, value) {
                            $('.client_id').append(
                                `<option value="${value.client.id}">${value.client.client_full_name}</option>`
                            );
                        });
                        $('.client_id').multiselect({includeSelectAllOption: true});
                        $('.client_id').multiselect('rebuild');
                        $('.loading2').hide();
                    }
                });
            }

            function fetch_payor(){
                check_date = int_sel.val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.ar.followup.bucket.filter.data.payor')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'check_date': check_date,
                    },
                    success: function (data) {
                        $('.payor_id').empty();
                        $.each(data, function (index, value) {
                            $('.payor_id').append(
                                `<option value="${value.payor.payor_id}">${value.payor.payor_name}</option>`
                            );
                        });
                        $('.payor_id').multiselect({includeSelectAllOption: true});
                        $('.payor_id').multiselect('rebuild');
                        $('.loading2').hide();
                    }
                });
            }

            function fetch_cpt(){
                check_date = int_sel.val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.ar.followup.bucket.filter.data.cpt')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'check_date': check_date,
                    },
                    success: function (data) {
                        $('.ctp_code').empty();
                        $.each(data, function (index, value) {
                            $('.ctp_code').append(
                                `<option value="${value.cpt_code}">${value.cpt_code}</option>`
                            );
                        });
                        $('.ctp_code').multiselect({includeSelectAllOption: true});
                        $('.ctp_code').multiselect('rebuild');
                        $('.loading2').hide();
                    }
                });
            }


            fetch_clients();
            fetch_payor();
            fetch_cpt();


            $('#ok_btn').click(function () {
                $('.loading2').show();
                var status = $('.select_btn').val();

                var ids = [];
                $('.leg_tbl_check:checked').each(function () {
                    var id = $(this).val();
                    ids.push(id);
                })


                if (status == 1) {
                    $('.add_notes').hide();
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.ledger.get.transaction')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'status': status,
                            'ids': ids,
                        },
                        success: function (data) {
                            console.log(data);
                            if (data == 'none') {
                                $('.transaction_table').hide();
                                $('.loading2').hide();
                            } else {
                                $('.transaction_table').show();
                                $('.transaction_table').empty();
                                $('.transaction_table').append(data.view);
                                $('.download_div2').show();
                                $('.loading2').hide();
                            }
                        }
                    });
                } else {
                    $('.transaction_table').hide();
                    $('.loading2').hide();
                    $('#multi_notes_form')[0].reset();
                    var time = moment().utc().format('YYYY-MM-DD');
                    $('.worked_date').val(time);
                    $('.add_notes').show();
                }
            });

            $(document).on('click', '.check_all', function () {
                if ($(this).prop('checked') == true) {
                    $('.leg_tbl_check').each(function () {
                        $(this).prop('checked', true);
                    })
                }

                if ($(this).prop('checked') == false) {
                    $('.leg_tbl_check').each(function () {
                        $(this).prop('checked', false);
                    })
                }

            });

            $('.select_date').change(function () {
                fetch_clients();
                fetch_payor();
                fetch_cpt();
            })


            $('.data_range').val('');
            $('#view_btn').click(function () {
                $('.show_animation').show();
                $('.bucket_tbody').empty();
                var select_date = $('.select_date').val();
                var client_id = $('.client_id').val();
                var payor_id = $('.payor_id').val();
                var ctp_code = $('.ctp_code').val();
                var data_range = $('.data_range').val();
                var ser_cat_name = $('.ser_cat_name').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.ar.followup.bucket.filter')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'select_date': select_date,
                        'client_id': client_id,
                        'payor_id': payor_id,
                        'ctp_code': ctp_code,
                        'data_range': data_range,
                        'ser_cat_name': ser_cat_name,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.download_div').show();
                        $('.bucket_tbody').empty().append(data.view);
                        $('.bucket_tbody').show();
                        $('.show_animation').hide();
                        $('.loading2').hide();
                    }
                });
            });


            $('#view_btn01').click(function () {
                $('.show_animation').show();
                $('.bucket_tbody').empty();
                var select_date = $('.select_date').val();
                var client_id = $('.client_id').val();
                var payor_id = $('.payor_id').val();
                var ctp_code = $('.ctp_code').val();
                var data_range = $('.data_range').val();
                var ser_cat_name = $('.ser_cat_name').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.ar.followup.bucket.filter')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'select_date': select_date,
                        'client_id': client_id,
                        'payor_id': payor_id,
                        'ctp_code': ctp_code,
                        'data_range': data_range,
                        'ser_cat_name': ser_cat_name,
                    },
                    success: function (data) {
                        $('.download_div').show();
                        $('.bucket_tbody').empty().append(data.view);
                        $('.bucket_tbody').show();
                        $('.show_animation').hide();
                        $('.loading2').hide();
                    }
                });
            });

            $(document).on('click', '.addNoteLedger', function () {
                let ledger_id = $(this).data('id');
                $('.hid_ledger_id').val(ledger_id);
                $('#add_notes_form')[0].reset();
                var time = moment().utc().format('YYYY-MM-DD');
                $('.sin_worked_date').val(time);
            });

            $(document).on('click', '#sing_ssave', function (e) {
                e.preventDefault();
                $('.loading2').show();
                var sing_category_name = $('.sing_category_name').val();
                var sin_followup_date = $('.sin_followup_date').val();
                var hid_ledger_id = $('.hid_ledger_id').val();
                var sin_worked_date = $('.sin_worked_date').val();
                var sin_notes = $('.sin_notes').val();


                if(sing_category_name==null || sing_category_name== ''){
                    $('.loading2').hide();
                    toastr["error"]("Select Category!");
                }
                else if(sin_notes==null || sin_notes== ''){
                    $('.loading2').hide();
                    toastr["error"]("Add Note!");
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.legder.add.note')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'category_name': sing_category_name,
                            'followup_date': sin_followup_date,
                            'ledger_id': hid_ledger_id,
                            'worked_date': sin_worked_date,
                            'notes': sin_notes,
                        },
                        success: function (data) {
                            console.log(data)
                            $('#add_notes_form').trigger('reset');
                            $('#editNote').modal('hide');
                            $('#view_btn').click();
                            if (data == 'note_successfully_added') {
                                toastr["success"]("Note successfully added", 'SUCCESS!');
                            } else if (data == 'ledger_not_found') {
                                toastr["error"]("Ledger Not Found", 'ALERT!');
                            } else {
                                $('.loading2').hide();
                            }

                            $('.loading2').hide();
                        }
                    });  
                }
            })


            $('#multi_note_save').click(function (e) {
                e.preventDefault();
                $('.loading2').show();
                var ids = [];
                var category_name = $('.category_name').val();
                var folowup_date = $('.folowup_date').val();
                var worked_date = $('.worked_date').val();
                var notes = $('.notes').val();
                $('.leg_tbl_check:checked').each(function () {
                    var id = $(this).data("id");
                    ids.push(id);
                });

                if (ids.length <= 0) {
                    $('.loading2').hide();
                    toastr["error"]("Please select Ledger", 'ALERT!');
                } else if (category_name == '' || category_name== null) {
                    $('.loading2').hide();
                    toastr["error"]("Please Add Category", 'ALERT!');
                }
                // else if (folowup_date == '') {
                //     $('.loading2').hide();
                //     toastr["error"]("Please Add Followup Date", 'ALERT!');
                // }
                else if (notes == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Add Note", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.ledger.get.multi.note.save')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'ids': ids,
                            'category_name': category_name,
                            'folowup_date': folowup_date,
                            'worked_date': worked_date,
                            'notes': notes,
                        },
                        success: function (data) {
                            console.log(data);
                            if (data == 'done') {
                                $('.add_notes').hide();
                                $('#view_btn').click();
                                toastr["success"]("Note successfully added", 'SUCCESS!');
                            } else {
                                toastr["error"]("Something Went Wrong", 'ALERT!');
                            }
                            $('.loading2').hide();
                        }
                    });
                }
            })
        })
    </script>


    <script>
    var timeStamp= moment().format('MMDYYYYhmmss');

        $('#download_csv').click(function(){
            $('#export_table').tableExport({
                type:'csv',
                fileName:"ArFollowupBucket_"+timeStamp
            });
        });

        $('#download_pdf').click(function(){
            $('#export_table').tableExport({
                type:'pdf',
                fileName:"ArFollowupBucket_"+timeStamp,
                jspdf: {
                    orientation: "L",
                    autotable: {
                        headerStyles: {
                            fillColor: [32,122,199],
                            textColor: 255,
                            fontStyle: 'bold',
                            halign: 'inherit',
                            valign: 'middle',
                        },
                        styles:{
                            overflow:"linebreak",
                        }
                    }
                }
            });
        });
</script>
@endsection
