@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
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
                            <label>All Staff Types</label>
                            <select class="form-control-sm form-control all_em_type" multiple>
                            </select>
                        </div>
                        <div class="col-md-4 align-self-center text-center">
                            <button type="button" class="btn btn-sm btn-primary " id="addbtn">Add >></button>
                            <div>
                                <button type="button" class="btn btn-sm btn-danger mt-2" id="removebtn">
                                    << Remove</button>
                            </div>
                        </div>
                        <div class="col-md-4 align-self-center">
                            <label>Facility Selected Staff Types</label>
                            <select class="form-control-sm form-control assign_type" multiple>
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

            getAllShow();
            $('#addbtn').click(function () {
                var types = $('.all_em_type').val();
                // $('.loading2').show();
                $.ajax({
                    type : "POST",
                    url: "{{route('superadmin.save.employee.type')}}",
                    data : {
                        '_token' : "{{csrf_token()}}",
                        'types' : types,
                    },
                    success:function(data){
                        console.log(data)
                        getAllShow();
                        if (data == 'done'){
                            $('.loading2').hide();
                        }
                        $('.loading2').hide();
                    }
                });


            });




            $('#removebtn').click(function () {
                $('.loading2').show();
                var assign_type = $('.assign_type').val();
                $.ajax({
                    type : "POST",
                    url: "{{route('superadmin.remove.employee.type')}}",
                    data : {
                        '_token' : "{{csrf_token()}}",
                        'assign_type' : assign_type,
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







            function getAllShow(){
                $('.loading2').show();
                $.ajax({
                    type : "POST",
                    url: "{{route('superadmin.setting.get.employee.type')}}",
                    data : {
                        '_token' : "{{csrf_token()}}",
                    },
                    success:function(data){

                        $('.all_em_type').empty();
                        $.each(data,function (index,value) {
                            $('.all_em_type').append(
                                `<option value="${value.id}">${value.type_name}</option>`
                            )
                        });
                        $('.loading2').hide();

                    }
                });

                $('.loading2').show();
                $.ajax({
                    type : "POST",
                    url: "{{route('superadmin.setting.get.assign.employee.type')}}",
                    data : {
                        '_token' : "{{csrf_token()}}",
                    },
                    success:function(data){

                        $('.assign_type').empty();
                        $.each(data,function (index,value) {
                            $('.assign_type').append(
                                `<option value="${value.id}">${value.type_name}</option>`
                            )
                        })
                        $('.loading2').hide();
                    }
                });
            }
        })
    </script>
@endsection
