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
                            <label>Available Cpt Codes</label>
                            <select class="form-control-sm form-control all_cpt" multiple>

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
                            <label>Excluded Cpt Codes</label>
                            <select class="form-control-sm form-control exclude_cpt" multiple>

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
            fetch_all_cpt()


            $('#removebtn').click(function () {
                $('.loading2').show();
                var exclude_cpt = $('.exclude_cpt').val();
                console.log(exclude_cpt);
                $.ajax({
                    type : "POST",
                    url: "{{route('superadmin.include.cpt')}}",
                    data : {
                        '_token' : "{{csrf_token()}}",
                        'exclude_cpt' : exclude_cpt,
                    },
                    success:function(data){
                        console.log(data)
                        fetch_all_cpt();
                        $('.loading2').hide();
                    }
                });
            })

            $('#addbtn').click(function () {
                var all_cpt = $('.all_cpt').val();
                console.log(all_cpt);

                $.ajax({
                    type : "POST",
                    url: "{{route('superadmin.exclude.cpt')}}",
                    data : {
                        '_token' : "{{csrf_token()}}",
                        'all_cpt' : all_cpt,
                    },
                    success:function(data){
                        console.log(data)
                        fetch_all_cpt();

                    }
                });


            });


            function fetch_all_cpt(){
                $('.loading2').show();
                $.ajax({
                    type : "POST",
                    url: "{{route('superadmin.fetch.all.cpt')}}",
                    data : {
                        '_token' : "{{csrf_token()}}",
                    },
                    success:function(data){
                        console.log(data);

                        $('.all_cpt').empty();
                        $.each(data.included,function (index,value) {
                            $('.all_cpt').append(
                                `<option value="${value.id}">${value.cpt_code}</option>`
                            )
                        });
                        $('.exclude_cpt').empty();
                        $.each(data.excluded,function (index,value) {
                            $('.exclude_cpt').append(
                                `<option value="${value.cpt_code_id}">${value.cpt_code}</option>`
                            )
                        })
                        $('.loading2').hide();

                    }
                });
            }





        })
    </script>
@endsection
