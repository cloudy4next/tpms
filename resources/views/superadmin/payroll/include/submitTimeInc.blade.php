@section('js')
    <script>
        $('.payroll-checkbox').hide();
        $('.payroll-format').hide();
        $('.payroll-btn').hide();
        $('.payroll-table').hide();
        $('.download_div').hide();
        $('.choose-payroll select').change(function (e) {
            $('.payroll-checkbox').show();
            $('.payroll-format').show();
            $('.payroll-btn').show();
            $('.payroll-table').show();
            $('.download_div').show();
        });
        $('.download_div').hide();
    </script>

    <script>
        $(document).ready(function () {

            $(document).on('click','.select_all_submit',function(){
                if($(this).prop("checked")==true){
                    $('.select_in_submit').each(function(){
                        $(this).prop("checked",true);
                    })
                }
                else{
                    $('.select_in_submit').each(function(){
                        $(this).prop("checked",false);
                    });
                }
            })


            let getPayrollTime = () => {
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.payroll.pay.period.time.get') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        $('.payroll_time').empty();
                        $('.payroll_time').append(
                            `<option value="0">Select Payroll Period(s)</option>`
                        )
                        data.forEach((time) => {

                            var star = moment(new Date(time.start_date)).utc().format(
                                'MM/DD/YYYY');
                            var end = moment(new Date(time.end_date)).utc().format(
                                'MM/DD/YYYY');

                            $('.payroll_time').append(
                                `<option value="${time.id}">${star} - ${end}</option>`
                            )
                        });
                        $('.loading2').hide();

                    }
                });
            };

            getPayrollTime();

            function payroll_submit_get_data(pay_time){
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.payroll.submission.get') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'pay_id':pay_time
                    },
                    success: function (data) {
                        $('.download_div').show();
                        $('.payroll_submit_list').show();
                        $('.payroll_submit_list').empty().append(data.view);
                        $('.loading2').hide();

                    }
                });
            }

            var pay_time=0;
            $('.payroll_time').change(function () {
                pay_time = $(this).val();
                if (pay_time == 0) {
                    toastr["error"]("Please Select Period Time", 'ALERT!');
                } else {
                    payroll_submit_get_data(pay_time);
                }
            })

            $('#ok_btn').click(function () {
                $('.loading2').show();
                let ids = [];
                let action = $('.process_action').val();

                $('.select_in_submit:checked').each(function () {
                    ids.push($(this).val());
                });


                if (ids.length <= 0) {
                    $('.loading2').hide();
                    toastr["error"]("Please Select TimeSheet", 'ALERT!');
                } else if (action == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Select action", 'ALERT!');
                } else if (action == 1) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.payroll.submit.update') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'ids': ids,
                            'status' :'Completed'
                        },
                        success: function (data) {
                            // console.log(data);
                            if(data=="done"){
                                toastr["success"]("Status changed.");
                                payroll_submit_get_data(pay_time);
                            }
                            $('.loading2').hide();
                        }
                    });
                    
                } else if (action == 2) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.payroll.submit.update') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'ids': ids,
                            'status' :'Acceptance Pending'
                        },
                        success: function (data) {
                            // console.log(data);
                            if(data=="done"){
                                toastr["success"]("Status changed.");
                                payroll_submit_get_data(pay_time);
                            }
                            $('.loading2').hide();
                        }
                    });
                }else {
                    $('.loading2').hide();
                }


            })

        })
    </script>

    <script>
        var timeStamp= moment().format('MMDYYYYhmmss');
        $(document).on('click', '#download_csv', function () {
            $('#export_table').tableExport({
                type: 'csv',
                mso: {
                    fileFormat:'csv',
                },
                fileName: "PayrollList_"+timeStamp
            });
        });
        $(document).on('click', '#download_excel', function () {
            $('#export_table').tableExport({
                type: 'excel',
                mso: {
                    fileFormat:'xlsx',
                },
                fileName: "PayrollList_"+timeStamp
            });
        });
        $(document).on('click', '#download_pdf', function () {
            $('#export_table').tableExport({
                type: 'pdf',
                fileName: 'PayrollList_'+timeStamp,
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
