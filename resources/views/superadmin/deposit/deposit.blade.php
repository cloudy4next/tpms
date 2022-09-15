@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="overflow-hidden">
                <div class="float-left">
                    <h2 class="common-title"> Cash-Posting
                    </h2>
                </div>
                <div class="float-right">
                    <a href="{{ route('superadmin.add.deposit') }}" class="btn btn-sm btn-primary"><i
                            class="las la-plus"></i>Add Deposit</a>
                </div>
            </div>
            <div class="d-flex mb-2">
                <div class="mr-2">
                    <label for="depositdate">Deposit Date Range</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input class="form-control form-control-sm common_selector reportrange dep_dare_range">
                    </div>
                </div>
                <div class="mr-2">
                    <label for="depositdate1">Check Date Range</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input class="form-control form-control-sm common_selector reportrange2 check_date_rage">
                    </div>
                </div>

                <div class="mr-2">
                    <label>Payee type</label>
                    <select class="form-control form-control-sm common_selector2 payee_type">
                        <option selected="selected" value=""></option>
                        <option value="1">Client</option>
                        <option value="2">Payor</option>
                    </select>
                </div>
                <div class="mr-2">
                    <label>Payee Name</label>
                    <select class="form-control form-control-sm common_selector2 payor_name">
                        <option selected="selected" value=""></option>
                        @foreach ($payor as $p)
                            <option value="{{ $p->payor_id }}">{{ $p->payor_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mr-2">
                    <label>Check No.</label>
                    <input type="text" class="form-control form-control-sm common_selector check_no">
                </div>
                <div class="align-self-end">
                    <button type="button" class="btn btn-sm btn-primary mr-2" id="view_dep">View</button>
                    <button type="reset" class="btn btn-sm btn-danger" onClick="window.location.reload();">Cancel
                    </button>
                </div>
                <div class="align-self-end ml-auto">
                    <div class="custom-control custom-switch un_switch_div">
                        <input type="checkbox" class="custom-control-input un_switch" id="un">
                        <label class="custom-control-label" for="un">All</label>
                    </div>
                </div>
            </div>
            {{-- <div class="float-right">
                <div class="custom-control custom-switch billable-switch">
                    <input type="checkbox" class="custom-control-input ses_app_type" id="bn" checked>
                    <label class="custom-control-label" for="bn">Billable</label>
                </div>
            </div> --}}
            <div class="d-flex justify-content-between">
                <div class="align-self-center mb-2">
                    <h5 class="m-0">Deposit List</h5>
                </div>
                <div class="align-self-center mb-2">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <div class="dropdown">
                                <button class="btn btn-sm p-0 dropdown-toggle" type="button" data-toggle="dropdown">
                                    <i class="ri-download-2-line"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right download-icon-show">
                                    <a class="dropdown-item" href="#" id="download_pdf"><i
                                            class="fa fa-file-pdf-o mr-2 text-danger"></i>Download PDF</a>
                                    <a class="dropdown-item" href="#" id="download_csv"><i
                                            class="fa fa-file-excel-o mr-2 text-success"></i>Download CSV</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table-responsive deposit_table">

            </div>
            <div class="d-flex">
                <div class="align-self-end mr-2">
                    <select class="form-control form-control-sm deposit_action">
                        <option value="0"></option>
                        <option value="1">Show Detail(s)</option>
                    </select>
                </div>
                <div class="align-self-end">
                    <button type="button" class="btn btn-sm btn-primary mr-2" id="go_btn">Go
                    </button>
                </div>
            </div>
            <!-- deposit_details table -->
            <div class="deposit_details">
                <div class="d-flex justify-content-between">
                    <div class="align-self-center mb-2">
                        <h5 class="m-0">Deposit Details</h5>
                    </div>
                    <div class="align-self-center mb-2">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <div class="dropdown">
                                    <button class="btn btn-sm p-0 dropdown-toggle" type="button" data-toggle="dropdown">
                                        <i class="ri-download-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right download-icon-show">
                                        <a class="dropdown-item" href="#" id="download_pdf2"><i
                                                class="fa fa-file-pdf-o mr-2 text-danger"></i>Download PDF</a>
                                        <a class="dropdown-item" href="#" id="download_csv2"><i
                                                class="fa fa-file-excel-o mr-2 text-success"></i>Download CSV</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive deposit_detail_tbl">

                </div>
                <!-- deposit_select -->
                <div class="d-flex">

                    <div class="mr-2">
                        <select class="form-control form-control-sm details_status">
                            <option value="1">Retract Transaction</option>
                        </select>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-primary mr-2" id="details_update">Ok</button>
                        <button type="button" class="btn btn-sm btn-danger cancel_btn">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.loading2').hide();
        jQuery(document).ready(function($) {

            $('.deposit_details').hide();
            $('.check_date_rage').empty();


        });

        $('.reportrange2').attr('placeholder', 'MM/DD/YYYY');
        var start = moment();
        var end = moment().add(30, 'days');

        function cb(start, end) {
            $('.reportrange2').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('.reportrange2').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('.reportrange2').daterangepicker({
            startDate: start,
            endDate: end,
            autoUpdateInput: false,
            ranges: {
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                    'month')]
            }
        }, cb);
        cb(start, end);
    </script>
    <script>
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getData(page);
                }
            }
        });

        $(document).ready(function() {
            $('.loading2').show();
            $('.dep_dare_range').val('')
            $('.check_date_rage').val('')

            function convert_float(num){
                if(isNaN(num)){            
                    num=num.replace(/\,/g,'');
                    return parseFloat(num);
                }
                else{
                    return parseFloat(num);
                }
            }

            $(document).on('change','.un_switch',function(){
                if($(this).prop("checked")==true){
                    $(this).siblings('label').text('Unallocated');
                    $('.deposit_table tbody .data-tr').each(function(){
                        main_s = $(this);
                        sel = $(this).find('.un_h');
                        if(sel.length){
                            un_val = sel.val();
                            un_val = convert_float(un_val);
                            if(un_val>0 || un_val<0){
                                main_s.fadeIn();
                            }
                            else{
                                main_s.fadeOut();
                            }
                        }
                    })
                }
                else{
                    $(this).siblings('label').text('All');
                    $('.deposit_table tbody .data-tr').each(function(){
                        main_s = $(this);
                        main_s.fadeIn();
                    })
                }
            });


            $(document).on('click', '.pagination a', function(event) {
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


            $('.payee_type').change(function() {
                let payee_id = $(this).val();
                if (payee_id == null || payee_id == "") {

                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.get.deposit.payee.type') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'payee_id': payee_id
                        },
                        success: function(data) {
                            console.log(data)
                            $('.payor_name').empty();
                            $('.payor_name').append(
                                `<option value=""></option>`
                            );

                            if (payee_id == 1) {
                                $.each(data, function(index, value) {
                                    $('.payor_name').append(
                                        `<option value="${value.id}">${value.client_full_name}</option>`
                                    );
                                })
                            } else if (payee_id == 2) {
                                $.each(data, function(index, value) {
                                    $('.payor_name').append(
                                        `<option value="${value.payor_id}">${value.payor_name}</option>`
                                    );
                                })
                            }

                            $('.loading2').hide();
                        }
                    });
                }
            })


            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.get.deposit.data') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'default': 'default',
                },
                success: function(data) {
                    console.log(data)
                    $('.deposit_table').empty();
                    $('.deposit_table').html(data.view);
                    $(".c_table").tablesorter();
                    $('.loading2').hide();
                }
            });


            $(document).on('click', '.ddetail_btn', function() {
                $('.loading2').show();
                d_id = $(this).data('id');
                dep_id = [d_id];
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.get.deposit.data.details') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'dep_id': dep_id
                    },
                    success: function(data) {
                        console.log(data);
                        $('.deposit_detail_tbl').empty();
                        $('.deposit_detail_tbl').html(data.view);
                        $(".c_table").tablesorter();
                        $('.deposit_detail_tbl').show();
                        $('.deposit_details').show();
                        $('.loading2').hide();
                    }
                });
            })


            $(document).on('click', '.dep_details_check', function() {
                if ($(this).prop('checked') == true) {
                    $('.details_checked').each(function() {
                        $(this).prop('checked', true);
                    })
                }


                if ($(this).prop('checked') == false) {
                    $('.details_checked').each(function() {
                        $(this).prop('checked', false);
                    })
                }

            })


            $('#details_update').click(function() {
                $('.loading2').hide();
                var d_status = $('.details_status').val();
                var d_id = [];
                if (d_status == 1) {
                    $('.details_checked:checked').each(function() {
                        d_id.push($(this).val());
                    });
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.get.deposit.details.revert') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'd_id': d_id
                    },
                    success: function(data) {
                        console.log(data);
                        $('.deposit_detail_tbl').hide();
                        $('.loading2').hide();
                        window.location.reload;
                    }
                });


            })

            $('#view_dep').click(function() {
                $('.loading2').show();
                $('.un_switch').prop('checked',false);
                $('.un_switch').siblings('label').text('All');
                var dep_dare_range = $('.dep_dare_range').val();
                var check_date_rage = $('.check_date_rage').val();
                var payor_name = $('.payor_name').val();
                var check_no = $('.check_no').val();
                var payee_type = $('.payee_type').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.get.deposit.data') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'dep_dare_range': dep_dare_range,
                        'check_date_rage': check_date_rage,
                        'payor_name': payor_name,
                        'check_no': check_no,
                        'payee_type': payee_type,
                        'default' : 'filter',
                        // 'alloc': alloc,
                    },
                    success: function(data) {
                        console.log(data);
                        $('.deposit_table').empty();
                        $('.deposit_table').html(data.view);
                        $(".c_table").tablesorter();
                        $('.loading2').hide();
                    }
                });


            })


        });


        function getData(myurl) {
            console.log('url is ' + myurl);
            if (myurl !== "deposit_details") {
                $('.loading2').show();
                var dep_dare_range = $('.dep_dare_range').val();
                var check_date_rage = $('.check_date_rage').val();
                var payor_name = $('.payor_name').val();
                var check_no = $('.check_no').val();
                var payee_type = $('.payee_type').val();
                $.ajax({
                    url: myurl,
                    type: "get",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'dep_dare_range': dep_dare_range,
                        'check_date_rage': check_date_rage,
                        'payor_name': payor_name,
                        'check_no': check_no,
                        'payee_type': payee_type,
                    },
                    datatype: "html"
                }).done(function(data) {
                    if (data.data_type == 1) {
                        $('.deposit_table').empty();
                        $('.deposit_table').html(data.view);
                        $(".c_table").tablesorter();
                        $('.loading2').hide();
                    }

                    // location.hash = myurl;

                }).fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server');
                });
            }

        }
    </script>
    <script>
        var timeStamp = moment().format('MMDYYYYhmmss');

        $('#download_csv').click(function() {
            $('#export_table').tableExport({
                type: 'csv',
                fileName: 'DepositList_' + timeStamp
            });
        });

        $('#download_pdf').click(function() {
            $('#export_table').tableExport({
                type: 'pdf',
                fileName: 'DepositList_' + timeStamp,
                jspdf: {
                    orientation: "L",
                    autotable: {
                        styles: {
                            overflow: 'linebreak',
                        },
                        headerStyles: {
                            fillColor: [32, 122, 199],
                            textColor: 255,
                            fontStyle: 'bold',
                            halign: 'inherit',
                            valign: 'middle',
                            columnWidth: 'auto',
                        },
                    }
                }
            });
        });


        $('#download_csv2').click(function() {
            $('#export_table2').tableExport({
                type: 'csv',
                fileName: 'DepositDetails_' + timeStamp
            });
        });

        $('#download_pdf2').click(function() {
            $('#export_table2').tableExport({
                type: 'pdf',
                fileName: 'DepositDetails_' + timeStamp,
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
                            columnWidth: 'auto'
                        }
                    }

                }
            });
        });

        $(document).on('click', '.deposit_all_check', function() {
            $('.deposit_in_check').each(function() {
                if ($(this).prop("checked") == true) {
                    $(this).prop("checked", false);
                } else {
                    $(this).prop("checked", true);
                }
            })
        });

        $('#go_btn').click(function() {
            action = $('.deposit_action').val();
            if (action == 1) {
                var ids = [];
                $('.deposit_in_check').each(function() {
                    if ($(this).is(":checked")) {
                        ids.push($(this).val());
                    }
                })


                if (ids.length > 0) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.get.deposit.data.details') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'dep_id': ids
                        },
                        success: function(data) {
                            //console.log(data);
                            $('.deposit_detail_tbl').empty();
                            $('.deposit_detail_tbl').html(data.view);
                            $(".c_table").tablesorter();
                            $('.deposit_detail_tbl').show();
                            $('.deposit_details').show();
                            $('.loading2').hide();
                        }
                    });
                }
            }
        })
    </script>

    {{-- <script>
        $('.billable-switch input').click(function(e) {
            if ($(this).prop("checked") == true) {
                $('.billable-switch label').text('Billable');

                $('tr').filter(":contains('" + +"')").show();

            } else if ($(this).prop("checked") == false) {
                $('.billable-switch label').text('Non-Billable');

            }
        });
    </script> --}}
@endsection
