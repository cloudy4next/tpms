@section('js')
    <script src="{{ asset('assets/tabletoCSV/tableToCsv.js') }}"></script>


    <script>
        jQuery(document).ready(function ($) {
            $('.client_filter').hide();
            $('.payor_filter').hide();
            $('.providerj_filter').hide();
            $('.filter2').hide();
            $('.client_filter2').hide();
            $('.payor_filter2').hide();
            $('.providerj_filter2').hide();
            $('.batch_table').hide();
            $('.gmp').hide();
            $('.to_date').hide();

            // Filter 1
            $('.filter1 select').change(function (event) {
                var value = $(this).val();
                $('.go_btn').click(function (event) {
                    $('.batch_table').show();
                    $('.gmp').show();
                });
                if(value == 0){
                    $('.to_date').show();
                    $('.filter2').show();
                    $('.filter2 select').val(0);
                    $('.client_filter').hide();
                    $('.payor_filter').hide();
                    $('.providerj_filter').hide();
                    $('.client_filter2').hide();
                    $('.payor_filter2').hide();
                    $('.providerj_filter2').hide();
                }
                else if (value == 1) {
                    $('.to_date').show();
                    $('.filter2').show();
                    $('.filter2 select').val(0);
                    $('.client_filter').show();
                    $('.payor_filter').hide();
                    $('.providerj_filter').hide();
                    $('.client_filter2').hide();
                    $('.payor_filter2').hide();
                    $('.providerj_filter2').hide();
                } else if (value == 2) {
                    $('.payor_filter').show();
                    $('.to_date').show();
                    $('.filter2').show();
                    $('.filter2 select').val(0);
                    $('.client_filter').hide();
                    $('.providerj_filter').hide();
                    $('.client_filter2').hide();
                    $('.payor_filter2').hide();
                    $('.providerj_filter2').hide();
                } else if (value == 3) {
                    $('.providerj_filter').show();
                    $('.to_date').show();
                    $('.filter2').show();
                    $('.filter2 select').val(0);
                    $('.client_filter').hide();
                    $('.payor_filter').hide();
                    $('.client_filter2').hide();
                    $('.payor_filter2').hide();
                    $('.providerj_filter2').hide();
                } else {
                    $('.client_filter').hide();
                    $('.payor_filter').hide();
                    $('.providerj_filter').hide();
                    $('.filter2').hide();
                    $('.client_filter2').hide();
                    $('.payor_filter2').hide();
                    $('.providerj_filter2').hide();
                    $('.to_date').hide();
                }
            });
            // Filter 2
            $('.filter2 select').change(function (event) {
                var value = $(this).val();
                if (value == 1) {
                    $('.client_filter2').show();
                    $('.payor_filter2').hide();
                    $('.providerj_filter2').hide();
                } else if (value == 2) {
                    $('.payor_filter2').show();
                    $('.client_filter2').hide();
                    $('.providerj_filter2').hide();
                } else if(value == 3){
                    $('.providerj_filter2').show();
                    $('.client_filter2').hide();
                    $('.payor_filter2').hide();
                } else {
                    $('.client_filter2').hide();
                    $('.payor_filter2').hide();
                    $('.providerj_filter2').hide();
                }
            });
        });

    </script>

    <script>

        var batch_ids;
        var app_ids;
        var process_ids;

        $(document).ready(function () {
            var claim;
            $('.generate_csv').hide();
            $('.download_div').hide();
            $('.show_bact_table').hide();
            $('.show_batch_date').hide();
            $('.show_animation').hide();


            $(document).on('click', '.generate_csv', function () {
                $.ajax({
                    url: "{{route('superadmin.batchingclaim.batching.report')}}",
                    method: "POST",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        "data": claim
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == "success") {
                            toastr["success"]('Report is being generated. You will get notification when it is done!', 'ALERT!');
                        }
                    }
                });
            });

            function reset_filterone(){
                $('.client1').val('');
                $('.payor1').val('');
                $('.providerj').val('');
            }


            function reset_filtertwo(){
                $('.client2').val('');
                $('.payor2').val('');
                $('.providerj2').val('');
            }

            function set_filtertwo(check){
                $('.filter_two').empty();
                $('.filter_two').append(
                    `<option value="0"></option>`
                );
                if(check == 0){
                    $('.filter_two').append(
                        `<option value="1">Patients</option>
                        <option value="2">Insurance</option>
                        <option value="3">CMS-24j Provider</option>`
                    );
                }
                else if(check == 1){
                    $('.filter_two').append(
                        `<option value="2">Insurance</option>
                        <option value="3">CMS-24j Provider</option>`
                    );
                }
                else if(check == 2){
                    $('.filter_two').append(
                        `<option value="1">Patients</option>
                        <option value="3">CMS-24j Provider</option>`
                    );
                }
                else if(check == 3){
                    $('.filter_two').append(
                        `<option value="1">Patients</option>
                        <option value="2">Insurance</option>`
                    );
                }

                if(check == null){
                    $('.filter2').hide();
                }
                else{
                    $('.filter2').show();
                }
            }


            $('.loading2').hide();
            $('.to_date').hide()
            $('.filter_one').change(function () {
                $('.loading2').show();
                reset_filterone();
                var fil_id = $(this).val();
                var date_range_to = $('.date_range_to').val();


                if(fil_id == ''){
                    set_filtertwo(null);
                    $('.to_date').hide();
                    $('.loading2').hide();
                } else if (fil_id == 0) {
                    set_filtertwo(0);
                    $('.to_date').show();
                    $('.loading2').hide();
                } else if (fil_id == 1) {
                    set_filtertwo(1);
                    $('.loading2').show();
                    $('.to_date').show()
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.batchingclaim.get.clients') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            console.log(data)
                            $('.client1').empty();

                            $.each(data, function (index, value) {
                                $('.client1').append(
                                    `<option value="${value.id}">${value.client_full_name}</option>`
                                );
                            });

                            $('.client1').multiselect({includeSelectAllOption: true});
                            $(".client1").multiselect('rebuild');

                            var payor1 = $('.payor1').val('');
                            $('.loading2').hide();

                        }
                    });
                } else if (fil_id == 2) {
                    set_filtertwo(2);
                    $('.loading2').show();
                    $('.to_date').show()
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.batchingclaim.get.payor') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            console.log(data)
                            $('.payor1').empty();

                            $.each(data.payor, function (index, value) {
                                $('.payor1').append(
                                    `<option value="${value.payor_id}">${value.payor_name}</option>`
                                );
                            });

                            $('#payor1').multiselect({includeSelectAllOption: true});
                            $("#payor1").multiselect('rebuild');

                            var client1 = $('.client1').val('');
                            $('.loading2').hide();
                        }
                    });
                } else if (fil_id == 3) {
                    set_filtertwo(3);
                    $('.loading2').show();
                    $('.to_date').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.batchingclaim.get.providerj') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            console.log(data)
                            $('.providerj').empty();
                            $.each(data, function (index, value) {
                                $('.providerj').append(
                                    `<option value="${value.id}">${value.full_name}</option>`
                                );
                            });
                            
                            $('.providerj').multiselect({includeSelectAllOption: true});
                            $(".providerj").multiselect('rebuild');

                            var client1 = $('.client1').val('');
                            var payor1 = $('.payor1').val('');
                            $('.loading2').hide();
                        }
                    });
                }

            });

        
            $('.filter_two').change(function () {
                $('.loading2').show();
                reset_filtertwo();
                var filter = $(this).val();
                var filter1 = $('.filter_one').val();
                var date_range_to = $('.date_range_to').val();
                var client1 = $('.client1').val();
                var payor1 = $('.payor1').val();
                var providerj = $('.providerj').val();


                if (filter == 0) {
                    $('.loading2').hide();
                } else if (filter == 1) {
                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.batchingclaim.get.clients') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            client1: client1,
                            payor1 : payor1,
                            providerj : providerj,
                            filter: filter1,
                        },
                        success: function (data) {
                            $('.client2').empty();
                            // $('.client2').append(
                            //     `<option value="0">select client</option>`
                            // );

                            $.each(data, function (index, value) {
                                $('.client2').append(
                                    `<option value="${value.id}">${value.client_full_name}</option>`
                                );
                            });
                            $('.client2').multiselect({includeSelectAllOption: true});
                            $(".client2").multiselect('rebuild');
                            $('.loading2').hide();

                        }
                    });
                } else if (filter == 2) {
                    $('.loading2').show();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.batchingclaim.get.payor') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            client1: client1,
                            payor1 : payor1,
                            providerj : providerj,
                            filter: filter1,
                        },
                        success: function (data) {
                            console.log(data)
                            $('.payor2').empty();
                            // $('.payor2').append(
                            //     `<option value="0">select payor</option>`
                            // );

                            $.each(data.payor, function (index, value) {
                                $('.payor2').append(
                                    `<option value="${value.payor_id}">${value.payor_name}</option>`
                                );
                            });

                            $('#payor2').multiselect({includeSelectAllOption: true});
                            $("#payor2").multiselect('rebuild');
                            $('.loading2').hide();
                        }
                    });
                } else if (filter == 3) {
                    $('.loading2').show();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.batchingclaim.get.providerj') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            client1: client1,
                            payor1 : payor1,
                            providerj : providerj,
                            filter: filter1,
                        },
                        success: function (data) {
                            $('.providerj2').empty();
                            // $('.providerj2').append(
                            //     `<option value="0">select payor</option>`
                            // );

                            $.each(data, function (index, value) {
                                $('.providerj2').append(
                                    `<option value="${value.id}">${value.full_name}</option>`
                                );
                            });
                            $('.providerj2').multiselect({includeSelectAllOption: true});
                            $(".providerj2").multiselect('rebuild');
                            $('.loading2').hide();
                        }
                    });
                }

            });


            var ENDPOINT = "{{ url('/') }}";
            var page = 1;
            var current_page = 0;
            let bool = false;
            let lastPage;
            var currentscrollHeight = 0;


            $(window).scroll(function () {

                const scrollHeight = $(document).height();
                const scrollPos = Math.floor($(window).height() + $(window).scrollTop());
                const isBottom = scrollHeight - 100 < scrollPos;
                if (isBottom && currentscrollHeight < scrollHeight) {
                    page++;
                    $('.show_animation').show();
                    var myurl = ENDPOINT + '/admin/billing/batching-claim-get-claim?page=' + page
                    getData(myurl);
                    currentscrollHeight = scrollHeight;
                }
            });




            $('#go_btn').click(function () {

                page = 1;
                currentscrollHeight = 0;

                $('.show_bact_table').show();
                $('.show_batch_date').empty();

                $('.no_change_disable').hide();
                $('.change_disable').hide();

                var filter_one = $('.filter_one').val();
                var client1 = $('.client1').val();
                var payor1 = $('.payor1').val();
                var providerj = $('.providerj').val();
                var filter_two = $('.filter_two').val();
                var client2 = $('.client2').val();
                var payor2 = $('.payor2').val();
                var providerj2 = $('.providerj2').val();
                var date_range_to = $('.date_range_to').val();

                var name_location = "{{$name_location->is_combo}}";


                if (filter_one == null || filter_one == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Select sort by", 'ALERT!');
                } else if (filter_one == 1 && (client1 == null || client1 == '')) {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Patient", 'ALERT!');
                } else if (filter_one == 2 && (payor1 == null || payor1 == '')) {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Insurance", 'ALERT!');
                } else if (filter_one == 2 && payor1.length > 5) {
                    $('.loading2').hide();
                    toastr["error"]("Insurance Can be Selected Max 5", 'ALERT!');
                } else if (filter_one == 3 && (providerj == null || providerj == '')) {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Provider", 'ALERT!');
                } else if (date_range_to == '' || date_range_to == null) {
                    $('.loading2').hide();
                    toastr["error"]("Please Select date", 'ALERT!');
                } else {
                    $('.show_animation').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.batchingclaim.get.claim') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'filter_one': filter_one,
                            'client1': client1,
                            'payor1': payor1,
                            'providerj': providerj,
                            'filter_two' : filter_two,
                            'client2' : client2,
                            'payor2' : payor2,
                            'providerj2' : providerj2,
                            'date_range_to': date_range_to,
                        },
                        success: function (data) {
                            console.log(data);
                            process_ids=data.process_ids;
                            batch_ids=data.batch_ids;
                            app_ids=data.app_ids;

                            var claim_length = data.notices.total;
                            claim = data.notices;

                            if (claim_length <= 0) {
                                $('.no_change_disable').show();
                                $('.change_disable').hide();
                            } else {
                                $('.no_change_disable').hide();
                                $('.change_disable').show();
                            }

                            $('.show_batch_date').append(data.view);
                            $('.show_batch_date').show();
                            $('.c_table').trigger('update')
                            $('.download_div').show();
                            $('.batch_table').show();
                            getEditData();
                            $('.show_animation').hide();
                        }
                    });
                }

            });


            function getEditData() {
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.batchingclaim.get.claim.genedi.count') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        console.log(data)

                        if (data <= 0) {
                            $('.has_no_edi').show();
                            $('.has_edi').hide();
                        } else {
                            $('.has_no_edi').hide();
                            $('.has_edi').show();
                        }
                    }
                });
            };


            $('#gen_process').click(function () {
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.batchingclaim.make.process') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'process_ids': process_ids,
                        'batch_ids' : batch_ids,
                        'app_ids' : app_ids,
                    },
                    success: function (data) {
                        console.log(data)
                        if (data == 'process_batch') {
                            $('.show_batch_date').empty();
                            // $('#go_btn').click();
                            $('.loading2').hide();
                        }
                    }
                });

                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.processed.to.edi') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'batch_ids' : batch_ids,
                    },
                    success: function (data) {
                        console.log(data)
                        // getEditDataGen();
                        if (data == 'new_claim_gen_done') {
                            $('.loading2').hide();
                        }

                    }
                });

                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.processed.to.arlegder') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'batch_ids' : batch_ids
                    },
                    success: function (data) {
                        if (data == 'ledger_create') {
                            $('.loading2').hide();
                        }

                    }
                });
            });


        });


        function getData(myurl) {


            var filter_one = $('.filter_one').val();
            var client1 = $('.client1').val();
            var payor1 = $('.payor1').val();
            var providerj = $('.providerj').val();
            var filter_two = $('.filter_two').val();
            var client2 = $('.client2').val();
            var payor2 = $('.payor2').val();
            var providerj2 = $('.providerj2').val();
            var date_range_to = $('.date_range_to').val();

            var name_location = "{{$name_location->is_combo}}";
            $.ajax(
                {
                    url: myurl,
                    type: "POST",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'filter_one': filter_one,
                        'client1': client1,
                        'payor1': payor1,
                        'providerj': providerj,
                        'filter_two' : filter_two,
                        'client2' : client2,
                        'payor2' : payor2,
                        'providerj2' : providerj2,
                        'date_range_to': date_range_to,
                    },
                    datatype: "html"
                }).done(function (data) {

                if (data.notices.total > 0) {
                    $('.show_batch_date').append(data.view);
                    $('.c_table').trigger('update')
                    $('.show_animation').hide();
                } else {
                    $('.show_animation').hide();
                }


                // location.hash = myurl;

            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                
                $('.loading2').hide();
            });
        }


    </script>


    <script>
        $(document).ready(function () {
            $('#generate_mark_processed').click(function () {
                $('.loading2').show();
                var filter_one = $('.filter_one').val();
                var client1 = $('.client1').val();
                var payor1 = $('.payor1').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.processed.to.edi') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'filter_one': filter_one,
                        'client1': client1,
                        'payor1': payor1,
                    },
                    success: function (data) {
                        console.log(data)
                        // getEditDataGen();
                        $('.loading2').hide();
                    }
                });


            })


            function getEditDataGen() {
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.batchingclaim.get.claim.genedi.count') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        console.log(data)

                        if (data <= 0) {
                            $('.has_no_edi').show();
                            $('.has_edi').hide();
                        } else {
                            $('.has_no_edi').hide();
                            $('.has_edi').show();
                        }


                    }
                });
            };

        })
    </script>

    <script>
        var timeStamp = moment().format('MMDYYYYhmmss');
        $(document).on('click', '#download_csv', function () {
            $('#export_table').tableExport({
                type: 'csv',
                fileName: "BatchingClaims_" + timeStamp
            });
        });
        $(document).on('click', '#download_pdf', function () {
            $('#export_table').tableExport({
                type: 'pdf',
                fileName: 'BatchingClaims_' + timeStamp,
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
    </script>


@endsection
