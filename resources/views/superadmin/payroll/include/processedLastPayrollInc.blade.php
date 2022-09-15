@section('js')
    <script>
        $('.staff-process').hide();
        $('.view-btn').hide();
        $('.timesheet-table').hide();
        $('.choose-payroll select').change(function (e) {
            $('.staff-process').show(150);
            $('.view-btn').show(150);
        });
        $('.process-btn').click(function (e) {
            $('.timesheet-table').show();
        });
        $('.download_div').hide();
    </script>
    <script>
        $(document).ready(function () {

            let getPayrollTime = () => {
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.completed.payroll.pay.period.time.get') }}",
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

            $('.payroll_time').change(function () {
                $('.loading2').show();
                var pay_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.completed.payroll.payor.by.payid') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'pay_id': pay_id
                    },
                    success: function (data) {
                        console.log(data)
                        $('.staff_provider').empty();
                        data.forEach((prv) => {
                            $('.staff_provider').append(
                                `<option value="${prv.id}">${prv.full_name}</option>`
                            )
                        });
                        $(".staff_provider").multiselect('rebuild');

                        $('.loading2').hide();
                    }
                });
            });


            $('#completedpayroll').click(function () {
                $('.loading2').show();
                let prov_id = $('.staff_provider').val();
                console.log(prov_id);
                let pay_id = $('.payroll_time').val();
                if (pay_id == 0) {
                    $('.loading2').hide();
                    $('.timesheet-table').hide();
                    toastr["error"]("Please Select Pay Period", 'ALERT!');
                } else if (prov_id == null) {
                    $('.loading2').hide();
                    $('.timesheet-table').hide();
                    toastr["error"]("Please Select Staff", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.completed.payroll.get') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'pay_id': pay_id,
                            'prov_id': prov_id
                        },
                        success: function (data) {
                            $('.download_div').show();
                            $('.processpaytable').show();
                            $('.processpaytable').empty().append(data.view);
                            $('.loading2').hide();
                        }
                    });
                }


            });


            $(document).on('click', '.select_all_completed', function () {
                if ($(this).prop('checked') == true) {
                    $('.select_in_completed').each(function () {
                        $(this).prop('checked', true);
                    });
                } else if ($(this).prop('checked') == false) {
                    $('.select_in_completed').each(function () {
                        $(this).prop('checked', false);
                    });
                }
            })


            $('#ok_btn').click(function () {
                $('.loading2').show();
                let ids = [];
                let action = $('.process_action').val();
                $('.select_in_completed:checked').each(function () {
                    ids.push($(this).val());
                });
                if (ids.length <= 0) {
                    $('.loading2').hide();
                    toastr["error"]("Please Select TimeSheet", 'ALERT!');
                }else if (action == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Select action", 'ALERT!');
                } else if (action == 1) {
                    update_completed_status(ids,'Acceptance Pending');
                } else if (action == 2) {
                    update_completed_status(ids,'Acceptance Approved');
                } else {
                    $('.loading2').hide();
                }
            })


            function update_completed_status(id_arr,status){
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.completed.payroll.update.status') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'ids': id_arr,
                        'status': status
                    },
                    success: function (data) {
                        if(data=="done"){
                            $('.loading2').hide();
                            toastr["success"]("Status changed.","SUCCESS!");
                            $('#completedpayroll').click();
                        }
                    }
                });
            }

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
                fileName: "PayrollSubmitList_"+timeStamp
            });
        });
        $(document).on('click', '#download_excel', function () {
            $('#export_table').tableExport({
                type: 'excel',
                mso: {
                    fileFormat:'xlsx',
                },
                fileName: "PayrollSubmitList_"+timeStamp
            });
        });
        $(document).on('click', '#download_pdf', function () {
            $('#export_table').tableExport({
                type: 'pdf',
                fileName: 'PayrollSubmitList_'+timeStamp,
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
