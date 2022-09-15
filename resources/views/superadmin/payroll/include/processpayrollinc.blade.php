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

            $('.payroll_time').change(function () {
                $('.loading2').show();
                var pay_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.payroll.payor.by.payid') }}",
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


            $('#processpayroll').click(function () {
                $('.loading2').show();
                let prov_id = $('.staff_provider').val();
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
                        url: "{{ route('superadmin.payroll.process.get.data') }}",
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


            $(document).on('click', '.check_all_process', function () {
                if ($(this).prop('checked') == true) {
                    $('.checked_process').each(function () {
                        $(this).prop('checked', true);
                    });
                } else if ($(this).prop('checked') == false) {
                    $('.checked_process').each(function () {
                        $(this).prop('checked', false);
                    });
                }
            })


            $('#ok_btn').click(function () {
                $('.loading2').show();
                let ids = [];
                let action = $('.process_action').val();
                let hours = [];
                let mileages = [];
                h_check=true;
                m_check=true;
                $('.checked_process:checked').each(function () {
                    ids.push($(this).val());
                    h=$(this).closest('tr').find("input[name='acc_hours']").val();
                    m=$(this).closest('tr').find("input[name='acc_miles']").val();
                    if(h==''){
                        h_check=false;
                    }
                    else if(m==''){
                        m_check=false;  
                    }
                    else{
                        hours.push(h)
                        mileages.push(m)
                    }

                });


                ex_hours=true;
                ex_miles=true;
                $('.checked_process:checked').each(function () {

                    var p_hours = jQuery(this).closest('tr').find("input[name='hours_renders']").val();
                    var a_hours = jQuery(this).closest('tr').find("input[name='acc_hours']").val();

                    if(a_hours>p_hours){
                        ex_hours=false;
                    }
                    var p_miles = jQuery(this).closest('tr').find("input[name='miles_renders']").val();
                    var a_miles = jQuery(this).closest('tr').find("input[name='acc_miles']").val();
                    if(a_miles>p_miles){
                        ex_miles=false;
                    }
                });


                if (ids.length <= 0) {
                    $('.loading2').hide();
                    toastr["error"]("Please Select TimeSheet", 'ALERT!');
                } else if (action == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Select action", 'ALERT!');
                } else if (action == 1) {
                    $('.loading2').show();
                    $('.checked_process:checked').each(function () {

                        var hours_val = jQuery(this).closest('tr').find("input[name='hours_renders']").val();


                        jQuery(this).closest('tr').find(
                            "input[name='acc_hours']").val(hours_val);


                        var miles_val = jQuery(this).closest('tr').find("input[name='miles_renders']").val();


                        jQuery(this).closest('tr').find("input[name='acc_miles']").val(miles_val);
                    });
                    $('.loading2').hide();
                } else if (action == 3) {
                    if(h_check==false){
                        $('.loading2').hide();
                        toastr["error"]("Hrs. Accepted is empty.");
                        return false;
                    }
                    else if(m_check == false){
                        $('.loading2').hide();
                        toastr["error"]("Milage. Accepted is empty.");
                        return false;
                    }
                    else if(ex_hours==false){
                        $('.loading2').hide();
                        toastr["error"]("Hrs. Accepted greater than submitted hours.");
                        return false;
                    }
                    else if(ex_miles == false){
                        $('.loading2').hide();
                        toastr["error"]("Mileage Accepted greater than mileage.");
                        return false;  
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.payroll.process.update') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'ids': ids,
                            'hours': hours,
                            'mileages': mileages,
                            'status' :'updating'
                        },
                        success: function (data) {
                            // console.log(data);
                            if(data=="done"){
                                toastr["success"]("Changes saved.");
                            }
                            $('.loading2').hide();
                        }
                    });
                } else if(action==4){
                    if(m_check==false){
                        $('.loading2').hide();
                        toastr["error"]("Add Mileage Approved.");
                        return false; 
                    }
                    else if(h_check==false){
                        $('.loading2').hide();
                        toastr["error"]("Add Hrs. Accepted.");
                        return false;
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.payroll.process.update') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'ids': ids,
                            'hours': hours,
                            'mileages': mileages,
                            'status' :'Acceptance Pending',
                        },
                        success: function (data) {
                            // console.log(data);
                            if(data=="done"){
                                toastr["success"]("Acceptance Pending.");
                            }
                            $('.loading2').hide();
                        }
                    });

                } else if(action==5){
                    if(m_check==false){
                        $('.loading2').hide();
                        toastr["error"]("Add Mileage Approved.");
                        return false; 
                    }
                    else if(h_check==false){
                        $('.loading2').hide();
                        toastr["error"]("Add Hrs. Accepted.");
                        return false;
                    }
                    
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.payroll.process.update') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'ids': ids,
                            'hours': hours,
                            'mileages': mileages,
                            'status' :'Acceptance Approved',
                        },
                        success: function (data) {
                            // console.log(data);
                            if(data=="done"){
                                toastr["success"]("Acceptance Approved.");
                                $('#processpayroll').click();
                            }
                            $('.loading2').hide();
                        }
                    });
                } else if(action == 6){
                    $('.loading2').show();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.revert.payroll') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'd_id': ids,
                        },
                        success: function (data) {
                            $('.loading2').hide();
                            toastr["success"]("Timesheets reverted.");
                            $('#processpayroll').click();
                        }
                    });
                } else {
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
