@section('js')
    <script>
        $('.client_filter').hide();
        $('.datrange').hide();
        $('.deposit_table').hide();
        $('.postby select').change(function (e) {
            let v = $(this).val();
            if (v == 1) {
                $('.claim_filter').show();
                $('.client_filter').hide();
                $('.datrange').hide();
            } else {
                $('.client_filter').show();
                $('.datrange').show();
                $('.claim_filter').hide();
            }
        });

        $('.include_closed').prop('checked', false)

    </script>
    <script>
        $('.loading2').hide();
        $('.deposit_table').hide();

        var ENDPOINT = "{{ url('/') }}";
        var page = 1;
        let bool = false;
        let lastPage;
        var current_page = 0;
        var currentscrollHeight = 0;

        $(window).scroll(function () {
            const scrollHeight = $(document).height();
            const scrollPos = Math.floor($(window).height() + $(window).scrollTop());
            const isBottom = scrollHeight - 100 < scrollPos;
            if (isBottom && currentscrollHeight < scrollHeight) {
                page++;
                //alert('calling...');
                var myurl = ENDPOINT + '/admin/billing/deposit-apply-data-get?page=' + page
                getData(myurl);
                currentscrollHeight = scrollHeight;
            }
        });

        $(document).ready(function () {



            $('.okbtn').hide();
            $('.action_id').change(function () {
                $('.okbtn').show();
            })

            $(document).on('click', '.dep_apply_check_all', function () {
                if ($(this).prop('checked') == true) {
                    $('.checked_data').each(function () {
                        $(this).prop('checked', true);
                    })
                }

                if ($(this).prop('checked') == true) {
                    $('.checked_data_trans').each(function () {
                        $(this).prop('checked', true);
                    })
                }


                if ($(this).prop('checked') == false) {
                    $('.checked_data').each(function () {
                        $(this).prop('checked', false);
                    })
                }

                if ($(this).prop('checked') == false) {
                    $('.checked_data_trans').each(function () {
                        $(this).prop('checked', false);
                    })
                }

            });


            $('.check_all_client').click(function () {
                if ($(this).prop('checked') == true) {

                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.get.deposit.apply.show.all.client')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                        },
                        success: function (data) {
                            console.log(data);
                            $('.client_id').empty();
                            $.each(data, function (index, value) {
                                $('.client_id').append(
                                    `<option value="${value.id}">${value.client_full_name}</option>`
                                );
                            })
                            $('.loading2').hide();
                        }
                    });

                }


                if ($(this).prop('checked') == false) {
                    var deopsit_id = $('.deopsit_id').val();
                    console.log(deopsit_id);
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.get.deposit.apply.show.payor.client')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'deopsit_id': deopsit_id
                        },
                        success: function (data) {
                            console.log(data);
                            $('.client_id').empty();
                            $.each(data, function (index, value) {
                                $('.client_id').append(
                                    `<option value="${value}">${value.client_full_name}</option>`
                                );
                            })
                            $('.loading2').hide();
                        }
                    });

                }


            })


            $('#ok_btn').click(function () {
                var value_data = $(".action_id").val();
                var dep_client_id = $(".client_id").val();
                var dep_apply_id = "{{$dep_apply_id}}";

                if (value_data == 1) {
                    $('.loading2').show();

                    var trs_ids = [];
                    var trs_ids = [];

                    $('.checked_data_trans:checked').each(function () {
                        var id = $(this).val();
                        trs_ids.push(id);
                    });

                    if ($('.include_closed').prop('checked') == true) {
                        var include_closed = 1;
                    } else {
                        var include_closed = 0;
                    }

                    console.log('trns id ' + trs_ids);
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.get.deposit.apply.transaction.data')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'trs_ids': trs_ids,
                            'dep_client_id': dep_client_id,
                            'include_closed': include_closed,
                            'dep_apply_id': dep_apply_id,
                        },
                        success: function (data) {
                            console.log(data);
                            $('.transaction_table').empty();
                            $('.transaction_table').html(data.view);
                            $(".c_table").tablesorter();
                            $('.transaction_table').show();
                            $('.loading2').hide();
                        }
                    });


                } else if (value_data == 2) {
                    $('.loading2').show();
                    $('.checked_data:checked').each(function () {

                        var adj = $(this).closest('tr').find(".adjestment").val();
                        var pa = $(this).closest('tr').find(".payment").val();

                        if (adj == 0 || adj == 0.00 && pa == 0 || pa == 0.00) {
                            $(this).closest('tr').find(".adjestment").val(0);
                            var amount = $(this).closest('tr').find(".amount").val();
                            $(this).closest('tr').find(".payment").val(amount);

                            $(this).closest('tr').find(".cal_balance_val").val(0);
                            $(this).closest('tr').find(".balance_val").val(0);
                            var show_data = `<p class="balnace">0</p>`;
                            $(this).closest('tr').find(".balnace").replaceWith(show_data);
                            $(this).closest('tr').find(".status_name").val("Closed");
                        }


                    });
                    $('.loading2').hide();
                } else if (value_data == 3) {
                    $('.checked_data:checked').each(function () {

                        var adj = $(this).closest('tr').find(".adjestment").val();
                        var pa = $(this).closest('tr').find(".payment").val();

                        if (adj == 0 || adj == 0.00 && pa == 0 || pa == 0.00) {
                            $(this).closest('tr').find(".adjestment").val(0);
                            var amount = $(this).closest('tr').find(".cal_balance_val").val();
                            $(this).closest('tr').find(".payment").val(amount);

                            $(this).closest('tr').find(".cal_balance_val").val(0);
                            $(this).closest('tr').find(".balance_val").val(0);
                            var show_data = `<p class="balnace">0</p>`;
                            $(this).closest('tr').find(".balnace").replaceWith(show_data);
                            $(this).closest('tr').find(".status_name").val("Closed");
                        }


                    });
                }

            })
        });


    </script>
    <script>

        $(document).ready(function () {
            $('#show').click(function () {
                $('.apply_data').empty();
                $('.deposit_table').show();
                $('.show_animation').show();

                page = 1;
                currentscrollHeight = 0;

                var post_by_deposit = $('.post_by_deposit').val();
                var claim_number = $('.claim_number').val();
                var client_id = $('.client_id').val();
                var date_range = $('.reportrange').val();
                var deopsit_id = $('.deopsit_id').val();

                if ($('.include_closed').prop('checked') == true) {
                    var include_closed = 1;
                } else {
                    var include_closed = 0;
                }


                if (post_by_deposit == 2 && client_id == "" || client_id == null) {
                    toastr["error"]("Please Select Client", 'ALERT!');
                } else if (post_by_deposit == 2 && date_range == "" || date_range == null) {
                    toastr["error"]("Please Select Date Range", 'ALERT!');
                } else if (post_by_deposit == 1 && claim_number == '') {
                    toastr["error"]("Please Enter Claim Number", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.get.deposit.apply.data')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'post_by_deposit': post_by_deposit,
                            'claim_number': claim_number,
                            'client_id': client_id,
                            'date_range': date_range,
                            'deopsit_id': deopsit_id,
                            'include_closed': include_closed,
                        },
                        success: function (data) {
                            console.log(data);
                            $('.apply_data').empty();
                            $('.apply_data').html(data.view);
                            $(".c_table").tablesorter();
                            $('.deposit_table').show();
                            show_totals();
                            $('.show_animation').hide();
                            // showPayAdj();
                        }
                    });
                }


            });


            function print_bottom_balance(){
                var t_b = 0;
                $('.bal_h').each(function(){
                    t_b+=convert_float($(this).val());
                })
                console.log(t_b)
                $('.tran_t_bal').text(to_us_string(t_b));
            }

            $(document).on('change', '.payment', function () {
                var payment1 = convert_float($(this).val());
                var adjustment2 = convert_float($(this).closest('tr').find(".adjestment").val());
                var balance = convert_float($(this).closest('tr').find(".balance_val_one").val());


                if (payment1 == '' || payment1 == null) {
                    payment = 0;
                } else {
                    payment = payment1;
                }


                if (adjustment2 == '' || adjustment2 == null) {
                    adjustment = 0;
                } else {
                    adjustment = adjustment2;
                }

                // var sub_total = parseFloat(payment) + parseFloat(adjustment);
                var sub_total = payment + adjustment;
                
                var total = balance - sub_total;

                var show_data = `<p class="balnace">${to_us_string(total)}</p>`;
                $(this).closest('tr').find(".balnace").replaceWith(show_data);
                $(this).closest('tr').find(".cal_balance_val").val(total.toFixed(2));
                $(this).closest('tr').find(".bal_h").val(total.toFixed(2));
           
                jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);

                if (total == 0 || total == 0.00) {
                    $(this).closest('tr').find(".status_name").val("Closed");
                }

                if (total > 0 || total > 0.00 && total > balance) {
                    $(this).closest('tr').find(".status_name").val("Underpayment");
                }

                if (total < 0) {
                    $(this).closest('tr').find(".status_name").val("Overpayment");
                }

                if ($(this).val() == '' && $(this).closest('tr').find(".adjestment").val() == '') {
                    $(this).closest('tr').find(".status_name").val("Open");
                }
                show_totals();
                getAm();
            });

            function getAm() {
                var am = [];
                $('.checked_data:checked').each(function () {
                    var p_am = jQuery(this).closest('tr').find(".payment").val();
                    if (p_am != '' || p_am != null) {
                        am.push(p_am);
                    }
                });


                let sum = 0;
                var total_dep_amount = $('.total_dep_amount').val();
                total_dep_amount=convert_float(total_dep_amount);
                var total_app_am = $('.total_app_am').val();
                total_app_am=convert_float(total_app_am);
                for (let i = 0; i < am.length; i++) {
                    if (am[i] == '' || am[i] == null) {
                        var aam = parseFloat(0);
                    } else {
                        var aam = parseFloat(am[i]);
                    }

                    sum += parseFloat(aam);
                }


                var fi_am = parseFloat(sum) + parseFloat(total_app_am);
                var d_final_am = parseFloat(total_dep_amount) - parseFloat(fi_am);

                var show_p_am = `<p class="d_p_am" style="margin-bottom: 0px;">${to_us_string(fi_am)}</p>`;
                $('.d_p_am').replaceWith(show_p_am);

                var show_rm_am = `<p class="d_r_am" style="margin-bottom: 0px;">${to_us_string(d_final_am)}</p>`;
                $('.d_r_am').replaceWith(show_rm_am);

            }


            $(document).on('change', '.adjestment', function () {

                var payment1 = convert_float($(this).closest('tr').find(".payment").val());
                var adjustment2 = convert_float($(this).val());
                var balance = convert_float($(this).closest('tr').find(".balance_val_one").val());


                if (payment1 == '' || payment1 == null) {
                    payment = 0;
                } else {
                    payment = payment1;
                }


                if (adjustment2 == '' || adjustment2 == null) {
                    adjustment = 0;
                } else {
                    adjustment = adjustment2;
                }
                var sub_total = payment + adjustment;

                var total = balance - sub_total;
                var show_data = `<p class="balnace">${to_us_string(total)}</p>`;
                $(this).closest('tr').find(".balnace").replaceWith(show_data);
                $(this).closest('tr').find(".bal_h").val(total.toFixed(2));
                $(this).closest('tr').find(".cal_balance_val").val(total.toFixed(2));


                jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);


                if (total == 0 || total == 0.00) {
                    $(this).closest('tr').find(".status_name").val("Closed");
                }

                if (total > 0 || total > 0.00 && total > balance) {
                    $(this).closest('tr').find(".status_name").val("Underpayment");
                }

                if (total < 0) {
                    $(this).closest('tr').find(".status_name").val("Overpayment");
                }


                if ($(this).val() == '' && $(this).closest('tr').find(".payment").val() == '') {
                    $(this).closest('tr').find(".status_name").val("Open");
                }

                show_totals();

            });


            $(document).on('click', '#save', function () {
                $('.loading2').show();
                var ids = [];
                var payment = [];
                var adjuestment = [];
                var balance = [];
                var Updated_balance = [];
                var resaon_data = [];
                var status = [];

                var status_check = false;
                $('.checked_data:checked').each(function () {
                    ids.push($(this).val());
                    payment.push($(this).closest('tr').find(".payment").val());
                    adjuestment.push($(this).closest('tr').find(".adjestment").val());
                    balance.push($(this).closest('tr').find(".balance_val").val());
                    Updated_balance.push($(this).closest('tr').find(".cal_balance_val").val());
                    resaon_data.push($(this).closest('tr').find('.resason_name :selected').val());
                    status.push($(this).closest('tr').find('.status_name :selected').val());
                    b = $(this).closest('tr').find(".cal_balance_val").val();
                    s = $(this).closest('tr').find('.status_name :selected').val();

                    if((b == 0.00 || b == 0) && s != 'Closed' ){
                        status_check = true;
                    }
                });

                if(status_check == true){
                    $('.loading2').hide();
                    toastr["error"]("0 Balance should have status closed.");
                    return false;
                }

                // console.log(Updated_balance)

                if (ids.length <= 0 || ids == null || ids == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Claim", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.get.deposit.apply.data.save')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'ids': ids,
                            'payment': payment,
                            'adjuestment': adjuestment,
                            'balance': balance,
                            'Updated_balance': Updated_balance,
                            'resaon_data': resaon_data,
                            'status': status,
                        },
                        success: function (data) {
                            console.log(data);
                            $('#show').click();
                            // showPayAdj();
                            $('.loading2').hide();
                        }
                    });
                }


            });


            function showPayAdj() {
                $('.loading2').show();
                var dep_id_show = $('.dep_id_show').val();
                var client_id = $('.client_id').val();
                console.log(dep_id_show);
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.deposit.apply.get.adj.pay.total')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'dep_id_show': dep_id_show,
                        'client_id': client_id,
                    },
                    success: function (data) {
                        console.log(data);
                        var show_pay = `<th class="show_total_all_dep_pay">Payment Total: ${data.payment}</th>`;
                        $('.show_total_all_dep_pay').replaceWith(show_pay);
                        var show_adj = `<th class="show_total_all_dep_adj">Adjustment Total: ${data.adjustment}</th>`;
                        $('.show_total_all_dep_adj').replaceWith(show_adj);
                        $('.loading2').hide();
                    }
                });
            }

        })
        function getData(myurl){
            $('.show_animation').show();

            var post_by_deposit = $('.post_by_deposit').val();
            var claim_number = $('.claim_number').val();
            var client_id = $('.client_id').val();
            var date_range = $('.reportrange').val();
            var deopsit_id = $('.deopsit_id').val();


            if ($('.include_closed').prop('checked') == true) {
                var include_closed = 1;
            } else {
                var include_closed = 0;
            }

            $.ajax({
                url: myurl,
                data: {
                    '_token': "{{csrf_token()}}",
                    'post_by_deposit': post_by_deposit,
                    'claim_number': claim_number,
                    'client_id': client_id,
                    'date_range': date_range,
                    'deopsit_id': deopsit_id,
                    'include_closed': include_closed,
                },
                success: function (data) {
                    // console.log(data);
                    $('.apply_data').append(data.view);
                    show_totals();
                    // $(".c_table").tablesorter();
                    $('.c_table').trigger('update')
                    $('.show_animation').hide();
                    // $('.deposit_table').show();
                    // showPayAdj();
                    // $('.loading2').hide();
                }
            });
        }
        function show_totals(){

            s_amt=0;
            s_pay=0;
            s_adj=0;
            s_bal=0;

            $('.amt_h').each(function(){
                s_amt+=convert_float($(this).val());
            })

            $('.payment').each(function(){
                s_pay+=convert_float($(this).val());
            })

            $('.adjestment').each(function(){
                s_adj+=convert_float($(this).val());
            })

            $('.bal_h').each(function(){
                s_bal+=convert_float($(this).val());
            })

            $('.tran_h_amt').val(s_amt);
            $('.tran_h_pay').val(s_pay);
            $('.tran_h_adj').val(s_adj);
            $('.tran_h_bal').val(s_bal);

            s_amt =to_us_string(s_amt);
            s_pay =to_us_string(s_pay);
            s_adj =to_us_string(s_adj);
            s_bal =to_us_string(s_bal);
            // s_amt = s_amt.toFixed(2);
            // s_pay = s_pay.toFixed(2);
            // s_adj = s_adj.toFixed(2);
            // s_bal = s_bal.toFixed(2);

            $('.tran_t_amt').text(s_amt);
            $('.tran_t_pay').text(s_pay);
            $('.tran_t_adj').text(s_adj);
            $('.tran_t_bal').text(s_bal);
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

        function to_us_string(num){
            if(isNaN(num)){            
                num=num.replace(/\,/g,'');
                num=parseFloat(num);
            }
            num =num.toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            return num;
        }

    </script>
@endsection
