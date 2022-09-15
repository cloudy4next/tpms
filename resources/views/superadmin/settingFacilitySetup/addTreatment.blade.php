@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu">
                    @include('superadmin.include.settingMenu')
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <div class="row">
                        <div class="col-md-4 align-self-center">
                            <label>All Treatments</label>
                            <select class="form-control-sm form-control all_treatment" multiple>

                            </select>
                        </div>
                        <div class="col-md-4 align-self-center text-center">
                            <button type="button" class="btn btn-sm btn-primary" id="addbtn">Add >></button>
                            <div>
                                <button type="button" class="btn btn-sm btn-danger mt-2" id="removebtn">
                                    << Remove</button>
                            </div>
                        </div>
                        <div class="col-md-4 align-self-center">
                            <label>Facility Selected Treatments</label>
                            <select class="form-control-sm form-control assign_treatment" multiple>

                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            getAllShow()


            $('#removebtn').click(function () {
                $('.loading2').show();
                var assign_treatment = $('.assign_treatment').val();
                $.ajax({
                    type : "POST",
                    url: "{{route('superadmin.remove.treatment.to.facility')}}",
                    data : {
                        '_token' : "{{csrf_token()}}",
                        'assign_treatment' : assign_treatment,
                    },
                    success:function(data){
                        console.log(data)
                        getAllShow();
                        if (data == 'done'){

                        }
                        $('.loading2').hide();
                    }
                });
            })

            $('#addbtn').click(function () {
                var alp = $('.all_treatment').val();

                $.ajax({
                    type : "POST",
                    url: "{{route('superadmin.save.treatment.to.facility')}}",
                    data : {
                        '_token' : "{{csrf_token()}}",
                        'alp' : alp,
                    },
                    success:function(data){
                        console.log(data)
                        getAllShow();

                    }
                });


            });


            function getAllShow(){
                $('.loading2').show();
                $.ajax({
                    type : "POST",
                    url: "{{route('superadmin.treatment.get')}}",
                    data : {
                        '_token' : "{{csrf_token()}}",
                    },
                    success:function(data){
                        console.log(data)
                        $('.all_treatment').empty();
                        $.each(data,function (index,value) {
                            $('.all_treatment').append(
                                `<option value="${value.id}">${value.treatment_name}</option>`
                            )
                        });
                        $('.loading2').hide();

                    }
                });

                $('.loading2').show();
                $.ajax({
                    type : "POST",
                    url: "{{route('superadmin.get.assign.treatment')}}",
                    data : {
                        '_token' : "{{csrf_token()}}",
                    },
                    success:function(data){
                        console.log(data)
                        $('.assign_treatment').empty();
                        $.each(data,function (index,value) {
                            $('.assign_treatment').append(
                                `<option value="${value.id}">${value.treatment_name}</option>`
                            )
                        })
                        $('.loading2').hide();
                    }
                });
            }





        })
    </script>
@endsection
