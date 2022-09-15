@section('js')
    <script src="{{asset('assets/dashboard/custom/ledger.js')}}"></script>
    <script>
        $('.patient').hide();
        $('.insurance').hide();
        $('.cpt').hide();
        $('.aging').hide();
        $('.daterange').hide();
        $('.download_div').hide();
        $('.download_div2').hide();

        if ($('.sort_by').val() == 2) {
            $('.patient').show();
            $('.insurance').show();
            $('.cpt').show();
            $('.aging').show();
            $('.daterange').show();
            $('.claim_filter').hide();
        }

        $('.postby select').change(function (e) {
            let v = $(this).val();
            if (v == 1) {
                $('.claim_filter').show();
                $('.patient').hide();
                $('.insurance').hide();
                $('.cpt').hide();
                $('.aging').hide();
                $('.daterange').hide();
            } else {
                $('.patient').show();
                $('.insurance').show();
                $('.cpt').show();
                $('.aging').show();
                $('.daterange').show();
                $('.claim_filter').hide();
            }
        });
    </script>
    <script>
        var ENDPOINT = "{{ url('/') }}";
        var page = 1;
        let bool = false;
        let lastPage;
        var current_page = 0;
        var currentscrollHeight = 0;

        $(window).scroll(function () {
            if(bool == true){
                const scrollHeight = $(document).height();
                const scrollPos = Math.floor($(window).height() + $(window).scrollTop());
                const isBottom = scrollHeight - 100 < scrollPos;
                if (isBottom && currentscrollHeight < scrollHeight) {
                    page++;
                    //alert('calling...');
                    var myurl = ENDPOINT + '/admin/billing/ledger-get-data?page=' + page
                    getData(myurl);
                    currentscrollHeight = scrollHeight;
                }
            }
        });

        $(document).ready(function () {
            $('.ledger_table').hide();
            $('.loading2').hide();



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


            //get all client
            $('.loading2').show();
            $.ajax({
                type: "POST",
                url: "{{route('superadmin.ledger.get.all.client')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {

                    $('.all_clients').empty();
                    $.each(data, function (index, value) {
                        $('.all_clients').append(
                            `<option value="${value.id}">${value.client_full_name}</option>`
                        );
                    })
                    $('#all_clients').multiselect({includeSelectAllOption: true});
                    $("#all_clients").multiselect('rebuild');
                    $('.loading2').hide();
                }
            });

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

            $('.reportrange').val();
            $('#view_btn').click(function () {
                var sort_by = $('.sort_by').val();
                var claim_no = $('.claim_no').val();
                var client_id = $('.all_clients').val();
                var cpt = $('.cpt_code').val();
                var reportrange = $('.reportrange').val();
                var fil_cat_name = $('.fil_cat_name').val();
                if ($('.zero_paid').prop('checked') == true) {
                    var zero_paid = 1;
                } else {
                    var zero_paid = 0;

                }


                if(sort_by == 2 && client_id == null){
                    toastr["error"]("Select Patient First.",'ALERT!');
                    return false;
                }
                else if(sort_by == 2 && reportrange == ''){
                    toastr["error"]("Select Date Range.",'ALERT!');
                    return false;
                }
                else if(sort_by == 1 && claim_no == ''){
                    toastr["error"]("Please enter Claim No.", 'ALERT!');
                    return false;
                }                
                
                $('.ledger_table').show();
                $('.show_animation').show();

                page = 1;
                currentscrollHeight = 0;
                fetch_ledger_data(sort_by,claim_no,client_id,cpt,reportrange,fil_cat_name,zero_paid);
            });


            function fetch_ledger_data(sort_by,claim_no,client_id,cpt,reportrange,fil_cat_name,zero_paid){
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.ledger.get')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'sort_by': sort_by,
                        'claim_no': claim_no,
                        'client_id': client_id,
                        'cpt': cpt,
                        'reportrange': reportrange,
                        'fil_cat_name': fil_cat_name,
                        'zero_paid': zero_paid,
                    },
                    success: function (data) {
                        bool = true;
                        $('.ledger_table').show();
                        $('.download_div').show();
                        $('.legder_table_data').empty();
                        $('.legder_table_data').append(data.view);
                        show_totals();
                        $('.show_animation').hide();
                        $(".c_table").trigger('reset');
                        $('.loading2').hide();
                    }
                });
            }



            $('#ok_btn').click(function () {
                $('.loading2').show();
                var status = $('.ledger_transa_status').val();

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
                    toastr["error"]("Please select Ledger");
                }
                else if(notes==null || notes== ''){
                    $('.loading2').hide();
                    toastr["error"]("Add Note!");
                }
                else if (category_name == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Add Category");
                }
                // else if (folowup_date == '') {
                //     $('.loading2').hide();
                //     toastr["error"]("Please Add Followup Date");
                // } 
                else if (notes == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Add Note");
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
        });


        function getData(myurl) {
            var sort_by = $('.sort_by').val();
            var client_id = $('.all_clients').val();
            var payor_id = $('.all_payor').val();
            var cpt = $('.cpt_code').val();
            var reportrange = $('.reportrange').val();
            var fil_cat_name = $('.fil_cat_name').val();
            $('.show_animation').show();
            $.ajax(
                {
                    url: myurl,
                    type: "get",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'sort_by' : sort_by,
                        'client_id': client_id,
                        'payor_id': payor_id,
                        'cpt': cpt,
                        'reportrange': reportrange,
                        'fil_cat_name': fil_cat_name,
                    },
                    datatype: "html"
                }).done(function (data) {
                    $('.ledger_table').show();
                    $('.legder_table_data').append(data.view);
                    $(".c_table").trigger('reset');
                    $('.show_animation').hide();
                    show_totals();

            });
        }

        function convert_float(num){
            if(isNaN(num)){            
                num=num.replace(/\,/g,'');
                return parseFloat(num);
            }
            else{
                return parseFloat(num);
            }
        }


        function show_totals(){

            s_amt=0.00;
            s_pay=0.00;
            s_adj=0.00;
            s_bal=0.00;

            $('.amt_h').each(function(){
                s_amt+=convert_float($(this).val());
            })

            $('.pay_h').each(function(){
                s_pay+=convert_float($(this).val());
            })

            $('.adj_h').each(function(){
                s_adj+=convert_float($(this).val());
            })

            $('.bal_h').each(function(){
                s_bal+=convert_float($(this).val());
            })

            s_amt = s_amt.toFixed(2);
            s_pay = s_pay.toFixed(2);
            s_adj = s_adj.toFixed(2);
            s_bal = s_bal.toFixed(2);

            $('.total_billed_am').text(s_amt);
            $('.total_payment').text(s_pay);
            $('.total_adj').text(s_adj);
            $('.total_bal').text(s_bal);
        }


    </script>
    <script>
        var timeStamp = moment().format('MMDYYYYhmmss');

        file_name = 'LedgerTable_';
        file_name = file_name + timeStamp;

        $(document).ready(function () {
            $('#download_csv').click(function () {
                alert("clicked");
                $('#export_table').tableExport({
                    type: 'csv',
                    fileName: file_name
                });
            });

            $('#download_pdf').click(function () {
                $('#export_table').tableExport({
                    type: 'pdf',
                    fileName: file_name,
                    jspdf: {
                        orientation: "L",
                        autotable: {
                            headerStyles: {
                                fillColor: [32, 122, 199],
                                textColor: 255,
                                fontStyle: 'bold',
                                halign: 'inherit',
                                valign: 'middle',
                            },
                            styles: {
                                overflow: 'linebreak'
                            },
                        }

                    }
                });
            });
        });
    </script>
@endsection