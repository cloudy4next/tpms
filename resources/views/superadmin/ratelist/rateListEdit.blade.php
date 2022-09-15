@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <form action="{{route('superadmin.ratelist.update')}}" id="rate_list_update" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label>Select Insurace</label>
                        <select class="form-control form-control-sm payor_id" name="payor_id">
                            @foreach($payors as $payo)
                                <option
                                    value="{{$payo->payor_id}}" {{$rate->payor_id == $payo->payor_id ? 'selected' :''}}>{{$payo->payor_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 align-self-end">
                        <input type="file" class="form-control-file" name="payor_file">
                    </div>
                    <div class="col-md-3 align-self-end">
                        <?php
                        $payor_file = \App\Models\Payor_facility::where('payor_id', $rate->payor_id)->first();
                        ?>
                        @if (!empty($payor_file->payor_file) && file_exists($payor_file->payor_file))
                            <?php

                            $get_name = substr($payor_file->payor_file, 31);
                            $ext = pathinfo($payor_file->payor_file, PATHINFO_EXTENSION);
                            ?>
                            @if (strlen($get_name) > 10)
                                <a href="{{route('superadmin.ratelist.file.download',$payor_file->id)}}">{{substr($payor_file->payor_file,27)}}</a>
                            @else
                                <a href="{{route('superadmin.ratelist.file.download',$payor_file->id)}}">{{substr($payor_file->payor_file,27)}}</a>
                            @endif
                            <button type="button" class="btn btn-sm text-primary"><i class="ri-close-circle-line"></i>
                            </button>
                        @endif


                    </div>
                    <div class="col-md-3 align-self-end overflow-hidden">
                        {{--                        <a href="{{route('superadmin.billing.ratelist')}}" class="btn btn-sm btn-primary float-right"--}}
                        {{--                           title="Back To Rate"><i class="ri-arrow-left-circle-line"></i>Back</a>--}}

                        <a href="#" class="btn btn-sm btn-primary float-right ratelistBack"
                           title="Back To Rate"><i class="ri-arrow-left-circle-line"></i>Back</a>
                    </div>
                </div>
                <hr>
                <!-- Form -->
                <h5 class="mb-2">Add/Edit Rate:</h5>

                <div class="row">
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>Select Tx type</label>
                        <select class="form-control form-control-sm tx_type" name="treatment_type" required>
                            @foreach($tratments as $treactment)
                                <option
                                    value="{{$treactment->id}}" {{$treactment->id == $rate->treatment_type  ? 'selected' : ''}}>{{$treactment->treatment_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>Service</label>
                        <select class="form-control form-control-sm rate_service" name="activity_type" required>
                            <option value=""></option>

                        </select>
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>Service Sub-Type</label>
                        <select class="form-control form-control-sm sub_type" name="sub_activity" required>
                            <option></option>
                            @foreach($sub_acts as $act)
                                <option
                                    value="{{$act->id}}" {{$rate->sub_activity == $act->id ? 'selected' : ''}}>{{$act->sub_activity}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>CPT Code</label>
                        <select class="form-control form-control-sm cptcode" name="cpt_code" required>
                            @foreach($cpt_cores as $cpt)
                                <option
                                    value="{{$cpt->id}}" {{$rate->cpt_code == $cpt->id ? 'selected' : ''}}>{{$cpt->service}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="row no-gutters">
                            <div class="col-md">
                                <label>M1</label>
                                <input type="text" class="form-control form-control-sm" name="m1" value="{{$rate->m1}}">
                                <input type="hidden" class="form-control form-control-sm" name="update_rate_id"
                                       value="{{$rate->id}}">
                            </div>
                            <div class="col-md pl-2">
                                <label>M2</label>
                                <input type="text" class="form-control form-control-sm" name="m2" value="{{$rate->m2}}">
                            </div>
                            <div class="col-md pl-2">
                                <label>M3</label>
                                <input type="text" class="form-control form-control-sm" name="m3" value="{{$rate->m3}}">
                            </div>
                            <div class="col-md pl-2">
                                <label>M4</label>
                                <input type="text" class="form-control form-control-sm" name="m4" value="{{$rate->m4}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>Rate Type</label>
                        <select class="form-control form-control-sm billed_type" name="rate_type">
                            <option value=""></option>
                            <option value="Per Unit" {{$rate->rate_type == "Per Unit" ? 'selected' : ''}}>Per Unit
                            </option>
                            <option value="Per Session" {{$rate->rate_type == "Per Session" ? 'selected' : ''}}>Per
                                Session
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2 billed_time">
                        <label>Rate Per</label>
                        <select class="form-control form-control-sm" name="rate_per">
                            <option value=""></option>
                            <option value="15 min" {{$rate->rate_per == "15 min" ? 'selected' : ''}}>15 min</option>
                            <option value="30 min" {{$rate->rate_per == "30 min" ? 'selected' : ''}}>30 min</option>
                            <option value="45 min" {{$rate->rate_per == "45 min" ? 'selected' : ''}}>45 min</option>
                            <option value="1 hour" {{$rate->rate_per == "1 hour" ? 'selected' : ''}}>1 hour</option>
                            <option value="2 hour" {{$rate->rate_per == "2 hour" ? 'selected' : ''}}>2 hour</option>
                            <option value="1 min" {{$rate->rate_per == "1 min" ? 'selected' : ''}}>1 min</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>Contract Rate</label>
                        <input type="text" class="form-control form-control-sm" name="contracted_rate"
                               value="{{$rate->contracted_rate}}">
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>Billing Rate</label>
                        <input type="text" class="form-control form-control-sm" name="billed_rate"
                               value="{{$rate->billed_rate}}">
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>% Increase</label>
                        <input type="text" class="form-control form-control-sm" name="increasing_percentage"
                               value="{{$rate->increasing_percentage}}">
                    </div>
                    <div class="col-md-3 mb-2 align-self-end">
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="active"
                                       value="1" {{$rate->active == 1 ? 'checked' : ''}}>Active
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="add_auth"
                                       value="1" {{$rate->add_auth == 1 ? 'checked' : ''}}>Add to auth
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>Degree Level</label>
                        <select class="form-control form-control-sm" name="degree_level">
                            <option></option>
                            <option
                                value="Associate degree" {{$rate->degree_level == "Associate degree" ? 'selected' : ''}}>
                                Associate degree
                            </option>
                            <option
                                value="Bachelor’s Degree" {{$rate->degree_level == "Bachelor’s Degree" ? 'selected' : ''}}>
                                Bachelor’s Degree
                            </option>
                            <option value="BCABA" {{$rate->degree_level == "BCABA" ? 'selected' : ''}}>BCABA</option>
                            <option value="BCBA" {{$rate->degree_level == "BCBA" ? 'selected' : ''}}>BCBA</option>
                            <option value="BCBA-D" {{$rate->degree_level == "BCBA-D" ? 'selected' : ''}}>BCBA-D</option>
                            <option value="BT" {{$rate->degree_level == "BT" ? 'selected' : ''}}>BT</option>
                            <option value="Doctorate" {{$rate->degree_level == "Doctorate" ? 'selected' : ''}}>
                                Doctorate
                            </option>
                            <option
                                value="Enrolled Masters" {{$rate->degree_level == "Enrolled Masters" ? 'selected' : ''}}>
                                Enrolled Masters
                            </option>
                            <option value="High School" {{$rate->degree_level == "High School" ? 'selected' : ''}}>High
                                School
                            </option>
                            <option value="LCSW" {{$rate->degree_level == "LCSW" ? 'selected' : ''}}>LCSW</option>
                            <option
                                value="Master’s Degree" {{$rate->degree_level == "Master’s Degree" ? 'selected' : ''}}>
                                Master’s Degree
                            </option>
                            <option value="PsyD" {{$rate->degree_level == "PsyD" ? 'selected' : ''}}>PsyD</option>
                            <option value="RBT" {{$rate->degree_level == "RBT" ? 'selected' : ''}}>RBT</option>
                        </select>
                    </div>
                    <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-sm btn-primary mr-2">Save</button>
                        <button type="button" class="btn btn-sm btn-danger cancel_btn">Cancel</button>
                    </div>
                </div>
            </form>
        </div>

    </div>


    <input type="text" class="edit_tx" name="edit_tx" value="{{$rate->treatment_type}}">
    <input type="text" class="edit_service" name="edit_service" value="{{$rate->activity_type}}">
    <input type="text" class="edit_subtype" name="edit_subtype" value="{{$rate->sub_activity}}">
    <input type="text" class="edit_cpt" name="edit_cpt" value="{{$rate->cpt_code}}">

@endsection
@section('js')
    <script>
        $(document).ready(function () {


            $('.ratelistBack').click(function () {
                let payor_id = $('.payor_id').val();
                if (payor_id == 0) {

                } else {
                    let route = "{{url('/admin/billing/rate-list-back')}}" + '/' + payor_id;
                    window.location.href = route;
                }
            });


            $(document).on('submit', '#rate_list_update', function (e) {
                e.preventDefault();
                $('.loading2').show();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{route('superadmin.ratelist.update')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        console.log(data)
                        if (data == 'done') {
                            $('.loading2').hide();
                            $('.ratelistBack').click();
                        } else {
                            $('.loading2').hide();
                        }

                    },
                    error: function (data) {
                        console.log(data);

                    }
                });
            });


            let getEditData = () => {
                $('.loading2').show();
                let tx_type = $('.tx_type').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.ratelist.service')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'tx_type': tx_type
                    },
                    success: function (data) {
                        console.log(data);
                        $('.rate_service').empty();
                        $('.rate_service').append(
                            `<option value=""></option>`
                        );


                        $.each(data, function (index, value) {
                            $('.rate_service').append(
                                `<option value="${value.id}">${value.description}</option>`
                            );
                        });
                        let edit_service = $('.edit_service').val();
                        $('.rate_service').val(edit_service);

                        getSubType(tx_type, edit_service);
                        $('.loading2').hide();
                    }
                });

                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.ratelist.cptcode')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'tx_type': tx_type
                    },
                    success: function (data) {
                        console.log(data);
                        $('.cptcode').empty();
                        $('.cptcode').append(
                            `<option value=""></option>`
                        );


                        $.each(data, function (index, value) {
                            $('.cptcode').append(
                                `<option value="${value.id}">${value.cpt_code}</option>`
                            );
                        });

                        let edit_cpt = $('.edit_cpt').val();
                        $('.cptcode').val(edit_cpt);
                        $('.loading2').hide();
                    }
                });


            };


            function getSubType(tx_type, edit_service) {
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.ratelist.subtype')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'tx_type': tx_type,
                        'rate_service': edit_service
                    },
                    success: function (data) {
                        console.log(data);
                        $('.sub_type').empty();
                        $('.sub_type').append(
                            `<option value=""></option>`
                        );


                        $.each(data, function (index, value) {
                            $('.sub_type').append(
                                `<option value="${value.id}">${value.sub_activity}</option>`
                            );
                        });
                        let edit_subtype = $('.edit_subtype').val();
                        $('.sub_type').val(edit_subtype);
                        $('.loading2').hide();
                    }
                });
            }


            getEditData();


            $('.tx_type').change(function () {
                $('.loading2').show();
                let tx_type = $(this).val();

                console.log(tx_type)
                //get service
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.ratelist.service')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'tx_type': tx_type
                    },
                    success: function (data) {
                        console.log(data);
                        $('.rate_service').empty();
                        $('.rate_service').append(
                            `<option value=""></option>`
                        );


                        $.each(data, function (index, value) {
                            $('.rate_service').append(
                                `<option value="${value.id}">${value.description}</option>`
                            );
                        });
                        $('.loading2').hide();
                    }
                });

                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.ratelist.cptcode')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'tx_type': tx_type
                    },
                    success: function (data) {
                        console.log(data);
                        $('.cptcode').empty();
                        $('.cptcode').append(
                            `<option value=""></option>`
                        );


                        $.each(data, function (index, value) {
                            $('.cptcode').append(
                                `<option value="${value.id}">${value.cpt_code}</option>`
                            );
                        });
                        $('.loading2').hide();
                    }
                });


            });

            $('.rate_service').change(function () {
                $('.loading2').show();
                let tx_type = $('.tx_type').val();
                let rate_service = $('.rate_service').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.get.ratelist.subtype')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'tx_type': tx_type,
                        'rate_service': rate_service
                    },
                    success: function (data) {
                        console.log(data);
                        $('.sub_type').empty();
                        $('.sub_type').append(
                            `<option value=""></option>`
                        );


                        $.each(data, function (index, value) {
                            $('.sub_type').append(
                                `<option value="${value.id}">${value.sub_activity}</option>`
                            );
                        });
                        $('.loading2').hide();
                    }
                });
            })

        })
    </script>
    <script>
        $(document).ready(function () {
            $('.billed_time').hide();
            $('.billed_time1').hide();
            var billed_type = $('.billed_type').val();
            if (billed_type == "Per Unit") {
                $('.billed_time').show();
            } else if (billed_type == "Per Session") {
                $('.billed_time').hide();
            } else {
                $('.billed_time').hide();
            }


            var billed_type1 = $('.billed_type1').val();
            if (billed_type1 == "Per Unit") {
                $('.billed_time1').show();
            } else if (billed_type1 == "Per Session") {
                $('.billed_time1').hide();
            } else {
                $('.billed_time1').hide();
            }


            $('.billed_type').change(function () {
                var value_data = $(this).val();
                if (value_data == "Per Unit") {
                    $('.billed_time').show();
                } else if (value_data == "Per Session") {
                    $('.billed_time').hide();
                } else {
                    $('.billed_time').hide();
                }
            })


            $('.billed_type1').change(function () {
                var value_data1 = $(this).val();
                if (value_data1 == "Per Unit") {
                    $('.billed_time1').show();
                } else if (value_data1 == "Per Session") {
                    $('.billed_time1').hide();
                } else {
                    $('.billed_time1').hide();
                }
            })
        })
    </script>
@endsection
