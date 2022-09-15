@extends('layouts.superadmin')
@section('css')
    <style>
        .loader_img {
            position: absolute;
            margin: auto;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width:  400px;
        }
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
        }

        .loader_title {
            margin-top: 580px;
        }

    </style>
@endsection

@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="overflow-hidden">
                <div class="float-left">
                    <h5 class="common-title">KPI Report by Insurance</h5>
                </div>
            </div>
                <form action="" target="_blank" method="POST" id="insurance_form">
                    @csrf
            <div class="d-flex">
                <!-- Client Name -->

                <div class="mr-2 mb-2 patient">
                    <label>Insurances</label>
                    <select class="form-control form-control-sm ses_insurance_id multiselect" name="ins_id" id="ses_insurance_id" multiple required>
                    </select>
                </div>
                <div class="mr-2 date-range">
                    <label>Date Range</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input class="form-control form-control-sm reportrange" name="date_range" required>
                    </div>
                </div>
                <div class="align-self-end mb-2">
                    <button type="button" class="btn btn-sm btn-primary go_btn" id="">Print</button>
                </div>
                <div class="loader text-center" style="display: none;">
                    <h4 class="common-title loader_title">Report is being generated. Please wait!</h4>
                    <img src="{{asset('assets/report/insurance.gif')}}" class="loader_img">
                </div>
            </div>
        </form>
        <form method="GET" target="_blank" action="{{route('superadmin.open.pdf.by.ajax')}}" id="view_form">
            @csrf
            <input type="hidden" value="" name="file_path" class="file_path">
        </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $('#ses_insurance_id').multiselect();
            $('.loading2').show();
            $.ajax({
                type: "POST",
                url: "{{route('superadmin.setting.get.all.payor.facility')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {
                    console.log(data);
                    $('.ses_insurance_id').empty();
                    $.each(data, function (index, value) {
                        $('.ses_insurance_id').append(
                            `<option value="${value.payor_id}">${value.payor_name}</option>`
                        )
                    });

                    $('#ses_insurance_id').multiselect({includeSelectAllOption: true});
                    $("#ses_insurance_id").multiselect('rebuild');

                    $('.loading2').hide();

                }
            });

            $('.go_btn').click(function(){
                ses=$('.ses_insurance_id').val();
                ses_i_id=JSON.stringify(ses);
                $('#insurance_id').val(ses_i_id);

                if(ses!==null){
                    if($('.reportrange').val()==''){
                        toastr["error"]("Please select date range.", 'ALERT!');
                    }
                    else{
                        date_range=$('.reportrange').val();
                        $('.loader').show();
                        $.ajax({
                            url:"{{route('superadmin.kpi.report.by.insurance')}}",
                            data:{
                                '_token': '{{csrf_token()}}',
                                'date_range':date_range,
                                'insurance_id':ses_i_id,
                            },
                            method:"POST",
                            success:function(data){
                                // console.log(data);
                                if(data=="success"){
                                    $('.loader').hide();
                                    toastr["success"]("Your File is generating. Once done you get notification");
                                }
                            }
                        });
                    }
                }
                else{
                    toastr["error"]("Please select Patient(s).", 'ALERT!');
                }
            });
        });
    </script>
@endsection
