@section('js')

    <script>
        $('.download_div').hide();
        $('.download_div2').hide();
        $('.ledger_table').hide();
        $('.transaction_table').hide();
        $('.add_notes').hide();
        $('.view_btn').click(function (e) {
            jQuery("#loading").show().fadeOut(200);
            $('.ledger_table').show();
        });
        $('#ok_btn').click(function (e) {
            let v = $('.select_btn').val();
            if (v == 1) {
                $('.transaction_table').show();
                $('.add_notes').hide();
            } else if (v == 2) {
                $('.transaction_table').hide();
                $('.add_notes').show();
            } else {
                $('.transaction_table').hide();
                $('.add_notes').hide();
            }
        });
    </script>
    <script>
        $(window).on('hashchange', function () {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getData(page);
                }
            }
        });
        $(document).ready(function () {

            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();


                $('li').removeClass('active');
                $(this).parent('li').addClass('active');

                var myurl = $(this).attr('href');
                // console.log(myurl);
                var newurl = myurl.substr(0, myurl.length - 1);

                var page = $(this).attr('href').split('page=')[1];
                var newurldata = (newurl + page);
                // console.log(newurldata);
                getData(myurl);
            });


            $(document).on('click', '.ledger_check_all', function () {
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

            })


            //get all cpt code
            $('.loading2').show();
            $.ajax({
                type: "POST",
                url: "{{route('superadmin.ledger.get.all.cptcode')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {
                    $('.cpt_code').empty();
                    $('.cpt_code').append(
                        `<option></option>`
                    );
                    $.each(data, function (index, value) {
                        $('.cpt_code').append(
                            `<option value="${value.cpt_id}">${value.cpt_code}</option>`
                        );
                    })

                    $('.loading2').hide();
                }
            });


            $('#view_btn').click(function () {
                $('.add_notes').hide();
                $('.loading2').show();
                var client_id = $('.all_clients').val();
                var cpt = $('.cpt_code').val();
                var reportrange = $('.reportrange').val();
                var fil_cat_name = $('.fil_cat_name').val();


                if ($('.zero_paid').prop('checked') == true) {
                    var zero_paid = 1;
                } else {
                    var zero_paid = 0;

                }


                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.client.ledger.get')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'client_id': client_id,
                        'cpt': cpt,
                        'reportrange': reportrange,
                        'fil_cat_name': fil_cat_name,
                        'zero_paid': zero_paid,
                    },
                    success: function (data) {
                        console.log(data)
                        $('.download_div').show();
                        $('.ledger_table').show();
                        $('.legder_table_data').empty();
                        $('.legder_table_data').append(data.view);
                        $(".c_table").tablesorter();
                        $('.loading2').hide();


                    }
                });

            });


            $('#ok_btn').click(function () {
                $('.loading2').show();
                var status = $('.ledger_transa_status').val();
                var ids = [];
                $('.leg_tbl_check:checked').each(function () {
                    var id = $(this).val();
                    ids.push(id);
                });

                if (status == 1) {
                    $('.add_notes').hide();
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.client.ledger.get.transaction')}}",
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
                                $('.download_div2').show();
                                $('.transaction_table').show();
                                $('.transaction_table').empty();
                                $('.transaction_table').append(data.view);
                                $('.loading2').hide();
                            }
                        }
                    });
                } else {
                    $('.transaction_table').hide();
                    $('.loading2').hide();
                    $('#add_multinote_form')[0].reset();
                    var time = moment().utc().format('YYYY-MM-DD');
                    $('.worked_date').val(time);
                    $('.add_notes').show();
                }


            });


            $(document).on('click', '.addNoteLedgerSingle', function () {
                let led_id = $(this).data('id');
                $('.single_ledger_id').val(led_id);
                $('#add_notes_form')[0].reset();
                var time = moment().utc().format('YYYY-MM-DD');
                $('.single_workded_date').val(time);

            });


            $(document).on('click', '#single_save_note', function (e) {
                e.preventDefault();

                var single_ledger_id = $('.single_ledger_id').val();
                var single_category_name = $('.single_category_name').val();
                var single_followup_date = $('.single_followup_date').val();
                var single_workded_date = $('.single_workded_date').val();
                var single_note = $('.single_note').val();

                console.log(single_ledger_id);

                if(single_category_name==null || single_category_name== ''){
                    $('.loading2').hide();
                    toastr["error"]("Select Category!");
                }
                else if(single_note==null || single_note== ''){
                    $('.loading2').hide();
                    toastr["error"]("Add Note!");
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.legder.add.note')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'ledger_id': single_ledger_id,
                            'category_name': single_category_name,
                            'followup_date': single_followup_date,
                            'worked_date': single_workded_date,
                            'notes': single_note,
                        },
                        success: function (data) {
                            console.log(data);
                            if (data == 'note_successfully_added') {
                                $('#editNote').modal('hide');
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


                if (ids.length <= 0 || ids == null) {
                    $('.loading2').hide();
                    toastr["error"]("Please select Ledger", 'ALERT!');
                } else if (category_name == '') {
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
                                toastr["success"]("Note successfully added", 'SUCCESS!');
                                $('#view_btn').click();
                            } else {
                                toastr["error"]("Something Went Wrong", 'ALERT!');
                            }
                            $('.loading2').hide();
                        }
                    });
                }


            })


        });


        function getData(myurl) {
            $('.loading2').show();
            var client_id = $('.all_clients').val();
            var cpt = $('.cpt_code').val();
            var reportrange = $('.reportrange').val();
            var fil_cat_name = $('.fil_cat_name').val();
            if ($('.zero_paid').prop('checked') == true) {
                var zero_paid = 1;
            } else {
                var zero_paid = 0;

            }
            $.ajax(
                {
                    url: myurl,
                    type: "get",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'client_id': client_id,
                        'cpt': cpt,
                        'reportrange': reportrange,
                        'fil_cat_name': fil_cat_name,
                        'zero_paid': zero_paid,
                    },
                    datatype: "html"
                }).done(function (data) {
                console.log(data)
                $('.ledger_table').show();
                $('.legder_table_data').empty();
                $('.legder_table_data').append(data.view);
                $(".c_table").tablesorter();
                $('.loading2').hide();

            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }

    </script>

<script>
    var timeStamp= moment().format('MMDYYYYhmmss');
    $('#download_csv').click(function(){
        $('#export_table').tableExport({
            type:'csv',
            fileName:'PatientLedger'+timeStamp
        });
    });

    $('#download_pdf').click(function(){
        $('#export_table').tableExport({
            type:'pdf',
            fileName:'PatientLedger'+timeStamp,
            jspdf: {
                orientation: "L",
                autotable: {
                    styles: {
                        overflow: 'linebreak'
                    },
                    headerStyles: {
                        fillColor: [32,122,199],
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
    var timeStamp= moment().format('MMDYYYYhmmss');
    $('#download_csv2').click(function(){
        $('#export_table2').tableExport({
            type:'csv',
            fileName:'PatientLedgerTrans_'+timeStamp
        });
    });

    $('#download_pdf2').click(function(){
        $('#export_table2').tableExport({
            type:'pdf',
            fileName:'PatientLedgerTrans_'+timeStamp,
            jspdf: {
                orientation: "L",
                autotable: {
                    styles: {
                        overflow: 'linebreak'
                    },
                    headerStyles: {
                        fillColor: [32,122,199],
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
