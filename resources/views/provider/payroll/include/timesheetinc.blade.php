
@section('js')
    <script>
        $('.day-wrapper').hide();
        $('.week-table').hide();
        $('.pay-period-table').hide();
        $('.download_div').hide();

        $('.week').click(function (e) {
            $(this).addClass('btn-danger');
            $('.pp').removeClass('btn-danger');
            $('.day').removeClass('btn-danger');
            $('.week-table').show();
            $('.pay-period-table').hide();
            $('.day-wrapper').hide();
        });
        $('.pp').click(function (e) {
            $(this).addClass('btn-danger');
            $('.week').removeClass('btn-danger');
            $('.day').removeClass('btn-danger');
            $('.week-table').hide();
            $('.pay-period-table').show();
            $('.day-wrapper').hide();
        });
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('click','.select_all_ts',function(){
                if($(this).prop("checked")==true){
                    $('.select_in_ts').each(function(){
                        $(this).prop('checked',true);
                    })
                }
                else{
                    $('.select_in_ts').each(function(){
                        $(this).prop('checked',false);
                    })
                }
            })


            let getPayrollTime = () => {
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('provider.payroll.pay.period.time.get') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        $('.payroll_time').empty();
                        $('.payroll_time').append(
                            `<option value="">Select Payroll Period(s)</option>`
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

            var pay_id=0;
            $('.day').click(function () {
                $('.loading2').show();
                pay_id = $('.payroll_time').val();
                status = $('.status_select').val();

                if (pay_id == null || pay_id == '') {
                    $('.loading2').hide();
                    toastr["error"]("Please Select Pay Period", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('provider.payroll.timesheet.appoinment') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'pay_id': pay_id,
                            'status' : status,
                        },
                        success: function (data) {
                            $('.day-wrapper').show();
                            $('.download_div').show();
                            $('.timesheettbl').empty().append(data.view);
                            $('.c_table').tablesorter();
                            $('.timesheettbl').show();
                            $('.loading2').hide();
                        }
                    });
                }
            });


            $('#save_btn').click(function () {
                action=$('.timesheet_action').val();
                var del_ids=[];
                $('.select_in_ts').each(function () {
                    if($(this).prop("checked")==true){
                        del_ids.push($(this).val());
                    }
                });

                if(del_ids.length==0){
                    toastr["error"]("Please check timesheets to proceed.");
                }
                else if(action==""){
                    toastr["error"]("Please select action to proceed.");
                }
                else if(action==1){
                    let ids = [];
                    var timein_one = [];
                    var timein_two = [];
                    var timein_three = [];
                    var timeout_one = [];
                    var timeout_two = [];
                    var timeout_three = [];
                    var miles = [];

                    $('.select_in_ts').each(function () {
                        if($(this).prop("checked")==true){
                            ids.push($(this).val());
                            timein_one.push($(this).closest('tr').find("input[name='timein_one']").val());
                            timein_two.push($(this).closest('tr').find("input[name='timein_two']").val());
                            timein_three.push($(this).closest('tr').find("select[name='timein_three']").val());
                            timeout_one.push($(this).closest('tr').find("input[name='timeout_one']").val());
                            timeout_two.push($(this).closest('tr').find("input[name='timeout_two']").val());
                            timeout_three.push($(this).closest('tr').find("select[name='timeout_three']").val());
                            miles.push($(this).closest('tr').find("input[name='miles']").val());
                        }
                    });

                    if(ids.length==0){
                        toastr["error"]("Please check timesheets to proceed.");
                        return false;
                    }

                    $('.loading2').show();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('provider.payroll.timesheet.save') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'ids': ids,
                            'pay_id':pay_id,
                            'timein_one': timein_one,
                            'timein_two': timein_two,
                            'timein_three': timein_three,
                            'timeout_one': timeout_one,
                            'timeout_two': timeout_two,
                            'timeout_three': timeout_three,
                            'miles': miles,
                        },
                        success: function (data) {
                            if(data=="done"){
                                toastr["success"]("Saved successfully.");
                            }
                            else if(data=="expired"){
                                toastr["error"]("Date is greater than last date to submit timesheet.");
                            }
                            $('.loading2').hide();
                        }
                    });
                }
                else if(action==2){
                    $('.loading2').show();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('provider.payroll.timesheet.delete.single') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'd_id': del_ids,
                        },
                        success: function (data) {
                            $('.day').click();
                            $('.loading2').hide();
                            toastr["success"]("Moved to Unbillable Timesheet.");
                        }
                    });
                }
                else if(action==3){
                    $('.loading2').show();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('provider.timesheet.submit') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'ids': del_ids,
                        },
                        success: function (data) {
                            $('.loading2').hide();
                            toastr["success"]("Timesheet submitted.");
                        }
                    });
                }
            });

            $('.dayname').click(function () {
                $('.loading2').show();
                let dayname = $(this).data('id');
                let payroll_time = $('.payroll_time').val();
                let payroll_status = $('.status_select').val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('provider.payroll.timesheet.bydayname') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'dayname': dayname,
                        'payroll_time': payroll_time,
                        'status' : payroll_status,
                    },
                    success: function (data) {
                        $('.timesheettbl').show();
                        $('.download_div').show();
                        $('.timesheettbl').empty().append(data.view);
                        $('.loading2').hide();

                    }
                });

            })
        })
    </script>

    <script>
        var timeStamp= moment().format('MMDYYYYhmmss');

        $('#download_csv').click(function(){
            $('#export_table').tableExport({
                type:'csv',
                fileName:'Timesheet_'+timeStamp
            });
        });

        $('#download_pdf').click(function(){
            $('#export_table').tableExport({
                type:'pdf',
                fileName:'Timesheet_'+timeStamp,
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
