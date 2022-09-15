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
                    <h5 class="common-title">KPI Report by Patients</h5>
                </div>
            </div>
                <form action="" target="_blank" method="POST" id="patient_form">
                    @csrf
            <div class="d-flex">
                <!-- Client Name -->

                <div class="mr-2 mb-2 patient">
                    <label>Patients</label>
                    <select class="form-control form-control-sm ses_client_id multiselect" name="p_id" id="ses_client_id" multiple required>
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
                    <img src="{{asset('assets/report/patient.gif')}}" class="loader_img">
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
            $('#ses_client_id').multiselect();
            $('.loading2').show();
            $.ajax({
                type: "POST",
                url: "{{route('superadmin.get.session.client.all')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {
                    console.log(data);
                    $('.ses_client_id').empty();
                    $.each(data, function (index, value) {
                        $('.ses_client_id').append(
                            `<option value="${value.id}">${value.client_full_name}</option>`
                        )
                    });


                    $('#ses_client_id').multiselect({includeSelectAllOption: true});
                    $("#ses_client_id").multiselect('rebuild');


                    $('.loading2').hide();

                }
            });


            $('.go_btn').click(function(){
                ses=$('.ses_client_id').val();
                ses_c_id=JSON.stringify(ses);

                if(ses!==null){
                    if($('.reportrange').val()==''){
                        toastr["error"]("Please select date range.", 'ALERT!');
                    }
                    else{
                        date_range=$('.reportrange').val();
                        $('.loader').show();
                        $.ajax({
                            url:"{{route('superadmin.kpi.report.by.patient')}}",
                            data:{
                                '_token': '{{csrf_token()}}',
                                'date_range':date_range,
                                'client_id':ses_c_id,
                            },
                            method:"POST",
                            success:function(data){
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

