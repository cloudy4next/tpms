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
        <form action="" method="post" target="_blank" id="month_form">
            @csrf
            <div class="iq-card-body">
                <div class="overflow-hidden">
                <div class="float-left">
                    <h5 class="common-title">KPI Report by Months</h5>
                </div>
            </div>
                <div class="row pl-3">
                    <div class="mr-2 date-range">
                        <label>Date Range</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input class="form-control form-control-sm reportrange" name="date_range">
                        </div>
                    </div>
                    <div class="col-md-4 align-self-end">
                        <button type="button" class="btn btn-sm btn-primary submit_btn">Print
                        </button>
                    </div>
                    <div class="loader text-center" style="display: none;">
                        <h4 class="common-title loader_title">Report is being generated. Please wait!</h4>
                        <img src="{{asset('assets/report/month.gif')}}" class="loader_img">
                    </div>
                </div>
            </div>
        </form>
        <form method="GET" target="_blank" action="{{route('superadmin.open.pdf.by.ajax')}}" id="view_form">
            @csrf
            <input type="hidden" value="" name="file_path" class="file_path">
        </form>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $('.submit_btn').click(function(){
                if($('.reportrange').val()==''){
                    toastr["error"]('Please select date range to proceed.','ALERT!');
                }
                else{
                    date_range=$('.reportrange').val();
                    $('.loader').show();
                    $.ajax({
                        url:"{{route('superadmin.kpi.report.by.months')}}",
                        data:{
                            '_token': '{{csrf_token()}}',
                            'date_range':date_range,
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
            });
        });
    </script>
@endsection
