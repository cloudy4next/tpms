@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <form action="{{ route('superadmin.ratelist.save') }}" id="rate_list_save" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label>Select Insurace</label>
                        <select class="form-control form-control-sm payor_id" name="payor_id" required>
                            <option value=""></option>
                            @foreach ($payors as $payo)
                                <option value="{{ $payo->payor_id }}" {{ $payo->payor_id == $p_id ? 'selected' : '' }}>
                                    {{ $payo->payor_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 align-self-end">
                        <input type="file" class="form-control-file" name="payor_file">
                    </div>
                    <div class="col-md-3 align-self-end show_file_div">
                        <a href="#" class="have_file">filenameeee.txt</a>
                        <button type="button" class="btn btn-sm text-primary"><i class="ri-close-circle-line"></i>
                        </button>
                    </div>
                    <div class="col-md-3 align-self-end overflow-hidden">
                        {{-- <a href="{{route('superadmin.billing.ratelist')}}" class="btn btn-sm btn-primary float-right" --}}
                        {{-- title="Back To Rate"><i class="ri-arrow-left-circle-line"></i>Back</a> --}}

                        <a href="#" class="btn btn-sm btn-primary float-right ratelistBack" title="Back To Rate"><i
                                class="ri-arrow-left-circle-line"></i>Back</a>
                    </div>
                </div>
                <hr>
                <!-- Form -->
                <h5 class="mb-2">Add/Edit Rate:</h5>

                <div class="row">
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>Select Tx type</label>
                        <select class="form-control form-control-sm tx_type" name="treatment_type" required>
                            <option value=""></option>
                            @foreach ($tratments as $treactment)
                                <option value="{{ $treactment->id }}">{{ $treactment->treatment_name }}</option>
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
                        <label>Survice Sub-Type</label>
                        <select class="form-control form-control-sm sub_type" name="sub_activity">
                            <option></option>
                            @foreach ($sub_acts as $act)
                                <option value="{{ $act->id }}">{{ $act->sub_activity ?? 'N/A' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>CPT Code</label>
                        <select class="form-control form-control-sm cptcode" name="cpt_code" required>
                            @foreach ($cpt_cores as $cpt)
                                <option value="{{ $cpt->id }}">{{ $cpt->service }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="row no-gutters">
                            <div class="col-md">
                                <label>M1</label>
                                <input type="text" class="form-control form-control-sm" name="m1">
                            </div>
                            <div class="col-md pl-2">
                                <label>M2</label>
                                <input type="text" class="form-control form-control-sm" name="m2">
                            </div>
                            <div class="col-md pl-2">
                                <label>M3</label>
                                <input type="text" class="form-control form-control-sm" name="m3">
                            </div>
                            <div class="col-md pl-2">
                                <label>M4</label>
                                <input type="text" class="form-control form-control-sm" name="m4">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>Rate Type</label>
                        <select class="form-control form-control-sm billed_type" name="rate_type">
                            <option value=""></option>
                            <option value="Per Unit" selected>Per Unit</option>
                            <option value="Per Session">Per Session</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2 billed_time">
                        <label>Rate Per</label>
                        <select class="form-control form-control-sm " name="rate_per">
                            <option value=""></option>
                            <option value="15 min">15 min</option>
                            <option value="30 min">30 min</option>
                            <option value="45 min">45 min</option>
                            <option value="1 hour">1 hour</option>
                            <option value="2 hour">2 hour</option>
                            <option value="1 min">1 min</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>Contract Rate</label>
                        <input type="text" class="form-control form-control-sm" name="contracted_rate">
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>Billing Rate</label>
                        <input type="text" class="form-control form-control-sm" name="billed_rate">
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>% Increase</label>
                        <input type="text" class="form-control form-control-sm" name="increasing_percentage">
                    </div>
                    <div class="col-md-3 col-xl-2 mb-2">
                        <label>Degree Level</label>
                        <select class="form-control form-control-sm" name="degree_level">
                            <option></option>
                            <option value="Associate degree">Associate degree</option>
                            <option value="Bachelor’s Degree">Bachelor’s Degree</option>
                            <option value="BCABA">BCABA</option>
                            <option value="BCBA">BCBA</option>
                            <option value="BCBA-D">BCBA-D</option>
                            <option value="BT">BT</option>
                            <option value="Doctorate">Doctorate</option>
                            <option value="Enrolled Masters">Enrolled Masters</option>
                            <option value="High School">High School</option>
                            <option value="LCSW">LCSW</option>
                            <option value="Master’s Degree">Master’s Degree</option>
                            <option value="PsyD">PsyD</option>
                            <option value="RBT">RBT</option>
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-3 mb-2 align-self-end">
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="active" value="1">Active
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="add_auth" value="1">Add to
                                auth
                            </label>
                        </div>
                    </div>

                    <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-sm btn-primary mr-2">Save</button>
                        <button type="button" class="btn btn-sm btn-danger cancel_btn">Cancel</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {

            $('.show_file_div').hide();


            $('.ratelistBack').click(function() {
                console.log('done');
                let payor_id = $('.payor_id').val();
                if (payor_id == 0) {

                } else {
                    let route = "{{ url('/admin/billing/rate-list-back') }}" + '/' + payor_id;
                    window.location.href = route;
                }
            });


            $(document).on('submit', '#rate_list_save', function(e) {
                e.preventDefault();
                $('.loading2').show();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('superadmin.ratelist.save') }}",
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
                    error: function(data) {
                        console.log(data);

                    }
                });
            });


            $('.payor_id').change(function() {
                var p_id = $(this).val();

                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.get.ratelist.data') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'p_id': p_id,
                    },
                    success: function(data) {
                        console.log(data);
                        $('.ratelist_tbl').empty();
                        $('.ratelist_tbl').html(data.view);
                        $('.attachment').show();
                        $('.addrate_btn').show();
                        $('.rate_table').show();
                        $('.loading2').hide();
                        getFileName(p_id);
                    }
                });

            })

            function getFileName(payorid) {
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.ratelist.get.payor.filename') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'payorid': payorid,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.have_file == 1) {
                            var url = "{{ url('admin/billing/rate-list-file-download') }}" + '/' + data
                                .data;
                            var file = url + '/' + data.download_path;
                            var downLink =
                                `<a href="${url}" target="_blank" class="have_file">${data.filename}</a>`;
                            $('.have_file').replaceWith(downLink);
                            $('.show_file_div').show();
                        } else {
                            $('.show_file_div').hide();
                        }
                        $('.loading2').hide();
                    }
                });
            }


            $('.tx_type').change(function() {
                let tx_type = $(this).val();

                console.log(tx_type)
                //get service
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.get.ratelist.service') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'tx_type': tx_type
                    },
                    success: function(data) {
                        console.log(data);
                        $('.rate_service').empty();
                        $('.rate_service').append(
                            `<option value=""></option>`
                        );


                        $.each(data, function(index, value) {
                            $('.rate_service').append(
                                `<option value="${value.id}">${value.description}</option>`
                            );
                        })
                    }
                });


                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.get.ratelist.cptcode') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'tx_type': tx_type
                    },
                    success: function(data) {
                        console.log(data);
                        $('.cptcode').empty();
                        $('.cptcode').append(
                            `<option value=""></option>`
                        );


                        $.each(data, function(index, value) {
                            $('.cptcode').append(
                                `<option value="${value.id}">${value.cpt_code}</option>`
                            );
                        })
                    }
                });


            });

            $('.rate_service').change(function() {

                let tx_type = $('.tx_type').val();
                let rate_service = $('.rate_service').val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.get.ratelist.subtype') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'tx_type': tx_type,
                        'rate_service': rate_service
                    },
                    success: function(data) {
                        console.log(data);
                        $('.sub_type').empty();
                        $('.sub_type').append(
                            `<option value=""></option>`
                        );


                        $.each(data, function(index, value) {
                            $('.sub_type').append(
                                `<option value="${value.id}">${value.sub_activity}</option>`
                            );
                        })
                    }
                });
            })


        })
    </script>
    <script>
        $(document).ready(function() {
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


            $('.billed_type').change(function() {
                var value_data = $(this).val();
                if (value_data == "Per Unit") {
                    $('.billed_time').show();
                } else if (value_data == "Per Session") {
                    $('.billed_time').hide();
                } else {
                    $('.billed_time').hide();
                }
            })


            $('.billed_type1').change(function() {
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
