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
                {{--                <form action="{{route('superadmin.import.all.payor')}}" method="post" enctype="multipart/form-data">--}}
                {{--                    @csrf--}}
                {{--                    <div class="form-group">--}}
                {{--                        <input type="file" class="form-control" name="csv_file">--}}
                {{--                        <button type="submit" class="btn btn-success">Submit</button>--}}
                {{--                    </div>--}}
                {{--                </form>--}}
                <div class="all_content flex-fill">
                    <div class="row">
                        <div class="col-md-4">
                            <label>All Insurance</label>
                            <select class="form-control-sm form-control all_payor" multiple>

                            </select>
                            <button type="button" class="btn btn-sm btn-primary viewDetailBtn mt-2"
                                    id="view_details_bforadd">
                                View Details
                            </button>
                        </div>
                        <div class="col-md-4 mt-4">
                            <button type="button" class="btn btn-sm d-block mx-auto btn-primary" id="addbtn">Add
                                &raquo;
                            </button>
                            <button type="button" class="btn btn-sm d-block mx-auto mt-2 btn-danger" id="removebtn">
                                &laquo; Remove
                            </button>
                        </div>
                        <div class="col-md-4">
                            <label>Facility Selected Insurance</label>
                            <select class="form-control-sm form-control f_id" multiple>
                            </select>
                            <button type="button" class="btn btn-sm btn-primary view_details_f_payor mt-2"
                                    id="view_details_f_payor">
                                View Details
                            </button>
                        </div>
                    </div>
                    <!-- View Details -->


                    <fieldset class="mt-2 payorDetail">
                        <legend>Insurance Details</legend>
                        <form action="{{route('superadmin.payor.facility.details.update')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label>Name</label>
                                    <input type="text" class="form-control form-control-sm name" name="name" required>
                                    <input type="hidden" class="form-control form-control-sm f_edit_id" name="f_edit_id"
                                           required>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Address</label>
                                    <input type="text" class="form-control form-control-sm address" name="address"
                                           required>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>City</label>
                                    <input type="text" class="form-control form-control-sm city" name="city" required>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>State</label>
                                    <select class="form-control form-control-sm state" name="state" required>
                                        <option value="AK">Alaska</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District of Columbia</option>
                                        <option value="FM">Federated States of Micronesia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="GU">Guam</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PW">Palau</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VI">Virgin Islands</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                        <option value="AE">Armed Forces Africa</option>
                                        <option value="AA">Armed Forces Americas (except Canada)</option>
                                        <option value="AE">Armed Forces Canada</option>
                                        <option value="AE">Armed Forces Europe</option>
                                        <option value="AE">Armed Forces Middle East</option>
                                        <option value="AP">Armed Forces Pacific</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Zip</label>
                                    <input type="text" class="form-control form-control-sm zip" name="zip" required>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Contact1</label>
                                    <input type="text" class="form-control form-control-sm contact_one"
                                           name="contact_one">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Contact2</label>
                                    <input type="text" class="form-control form-control-sm contact_two"
                                           name="contact_two">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Phone1</label>
                                    <input type="text" class="form-control form-control-sm phone_one" name="phone_one"
                                           data-mask="(000)-000-0000" pattern=".{14,}" autocomplete="off"
                                           maxlength="14">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Phone2</label>
                                    <input type="text" class="form-control form-control-sm phone_two" name="phone_two"
                                           data-mask="(000)-000-0000" pattern=".{14,}" autocomplete="off"
                                           maxlength="14">
                                </div>
                                {{-- <div class="col-md-3 mb-2">
                                    <label>Insurance ID</label>
                                    <input type="text" class="form-control form-control-sm payor_id" name="payor_id">
                                </div> --}}
                                <div class="col-md-3 mb-2 align-self-end">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input is_regional_center" value="1"
                                                   name="is_regional_center">Regional
                                            Center
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Billing abreviation(3 char)</label>
                                    <input type="text" class="form-control form-control-sm billing_aber"
                                           name="billing_aber">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Electronic Insurance ID</label>
                                    <input type="text" class="form-control form-control-sm ele_payor_id"
                                           name="ele_payor_id">
                                </div>
                                <div class="col-md-12 mt-3 " id="showSaveBtn">
                                    <button class="btn btn-sm btn-primary mr-2  ladda-button"
                                            data-style="expand-right">
                                        <span class="ladda-label">Save</span><span class="ladda-spinner"></span>
                                    </button>
                                    <button type="reset" class="btn btn-sm btn-danger"
                                            onclick="window.location.reload();">Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.viewDetailBtn').click(function () {
                $('.loading2').show();
                var all_payor = $('.all_payor').val();

                if (all_payor == null || all_payor == "") {
                    $('.payorDetail').hide();
                    toastr["error"]("Please select Facility Selected Payors ", 'ALERT!');
                } else if (all_payor.length > 1) {
                    $('.payorDetail').hide();
                    toastr["error"]("You have selected multiple payor. Please select one payor", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.get.payor.facility.details')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'all_payor': all_payor,
                        },
                        success: function (data) {
                            console.log(data)

                            $('.name').val(data.name);
                            $('.address').val(data.address);
                            $('.city').val(data.city);
                            $('.state').val(data.state);
                            $('.zip').val(data.zip);
                            $('.contact_one').val(data.contact_one);
                            $('.contact_two').val(data.contact_two);
                            $('.phone_one').val(data.phone_one);
                            $('.phone_two').val(data.phone_two);
                            $('.payor_id').val(data.payor_id);
                            $('.billing_aber').val(data.billing_aber);
                            $('.ele_payor_id').val(data.ele_payor_id);

                            if (data.is_regional_center == 1) {
                                $('.is_regional_center').prop('checked', true)
                            } else {
                                $('.is_regional_center').prop('checked', false)
                            }

                            $('.payorDetail').show();
                            $('#showSaveBtn').hide();

                            $('.loading2').hide();


                        }
                    });
                }

            });


            $('#view_details_f_payor').click(function () {
                $('.loading2').show();
                let f_id = $('.f_id').val();
                if (f_id == null || f_id == "") {
                    $('.payorDetail').hide();
                    toastr["error"]("Please select Facility Selected Payors ", 'ALERT!');
                } else if (f_id.length > 1) {
                    $('.payorDetail').hide();
                    toastr["error"]("You have selected multiple payor. Please select one payor", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.get.payor.selected.facility.details')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'f_id': f_id,
                        },
                        success: function (data) {
                            console.log(data)

                            if (data == "all payor selected") {
                                toastr["error"]("Please select Facility Selected Payors ", 'ALERT!');
                            } else {
                                $('.f_edit_id').val(data.id);
                                $('.name').val(data.payor_name);
                                $('.address').val(data.address);
                                $('.city').val(data.city);
                                $('.state').val(data.state);
                                $('.zip').val(data.zip);
                                $('.contact_one').val(data.contact_one);
                                $('.contact_two').val(data.contact_two);
                                $('.phone_one').val(data.phone_one);
                                $('.phone_two').val(data.phone_two);
                                $('.payor_id').val(data.fpayor_id);
                                $('.billing_aber').val(data.billing_aber);
                                $('.ele_payor_id').val(data.ele_payor_id);

                                if (data.is_regional_center == 1) {
                                    $('.is_regional_center').prop('checked', true)
                                } else {
                                    $('.is_regional_center').prop('checked', false)
                                }

                                $('.payorDetail').show();
                                $('#showSaveBtn').show();
                                $('.loading2').hide();
                            }


                        }
                    });
                }
            })


            $('#view_details_bforadd').click(function () {
                var all_payor_id = $('.all_payor').val();
                console.log(all_payor_id)
                if (all_payor_id == null || all_payor_id == "") {
                    $('.payorDetail').hide();
                    toastr["error"]("Please select Insurance ", 'ALERT!');
                } else if (all_payor_id.length > 1) {
                    $('.payorDetail').hide();
                    toastr["error"]("You have selected multiple payor. Please select one payor", 'ALERT!');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{route('superadmin.get.all.payor.details')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'all_payor_id': all_payor_id,
                        },
                        success: function (data) {
                            console.log(data)

                            if (data == "all payor selected") {
                                toastr["error"]("Please select Insurance ", 'ALERT!');
                            } else {
                                $('.f_edit_id').val(data.id);
                                $('.name').val(data.name);
                                $('.address').val(data.address);
                                $('.city').val(data.city);
                                $('.state').val(data.state);
                                $('.zip').val(data.zip);
                                $('.contact_one').val(data.contact_one);
                                $('.contact_two').val(data.contact_two);
                                $('.phone_one').val(data.phone_one);
                                $('.phone_two').val(data.phone_two);
                                $('.payor_id').val(data.payor_id);
                                $('.billing_aber').val(data.billing_aber);
                                $('.ele_payor_id').val(data.ele_payor_id);
                                $('.payorDetail').show();
                            }


                        }
                    });
                }
            })


        })
    </script>
    <script>
        $(document).ready(function () {

            getAllShow();


            $('#removebtn').click(function () {
                $('.loading2').show();
                var alp = $('.f_id').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.remove.payor.to.facility')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'alp': alp,
                    },
                    success: function (data) {
                        console.log(data)
                        getAllShow();
                        if (data == 'done') {

                        }
                        $('.loading2').hide();
                    }
                });
            })


            $('#addbtn').click(function () {
                var alp = $('.all_payor').val();
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.save.payor.to.facility')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'alp': alp,
                    },
                    success: function (data) {
                        console.log(data)
                        getAllShow();
                        if (data == 'done') {

                        }
                        $('.loading2').hide();
                    }
                });


            });


            function getAllShow() {
                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.setting.get.all.payor')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                    },
                    success: function (data) {
                        console.log('All Payor' + data)
                        $('.all_payor').empty();
                        $.each(data, function (index, value) {
                            $('.all_payor').append(
                                `<option value="${value.facility_payor_id}">${value.payor_name}</option>`
                            )
                        });
                        $('.loading2').hide();

                    }
                });

                $('.loading2').show();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.setting.get.all.payor.facility')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                    },
                    success: function (data) {
                        $('.f_id').empty();
                        $.each(data, function (index, value) {
                            $('.f_id').append(
                                `<option value="${value.id}">${value.payor_name}</option>`
                            )
                        })
                        $('.loading2').hide();
                    }
                });
            }


        })
    </script>
    <script>
        $('.payorDetail').hide();
        $('.viewDetailBtn').click(function (event) {
            $('.payorDetail').show();
        });
    </script>


@endsection

