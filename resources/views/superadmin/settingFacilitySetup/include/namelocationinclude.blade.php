@section('js')
    <script>
        $(document).ready(function () {
            $('.loading2').show();
            $.ajax({
                type: "POST",
                url: "{{route('superadmin.get.working.hour.ajax')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {
                    console.log(data);
                    var mon_time = moment(new Date(data.mon_start_time)).format(
                        'HH:mm');
                    var mon_end = moment(new Date(data.mon_end_time)).format(
                        'HH:mm');

                    $('.mon_start').val(mon_time);
                    $('.mon_end').val(mon_end);


                    var tues_time = moment(new Date(data.tus_start)).format(
                        'HH:mm');
                    var tues_end = moment(new Date(data.tus_end)).format(
                        'HH:mm');

                    $('.tues_start').val(tues_time);
                    $('.tues_end').val(tues_end);


                    var wed_time = moment(new Date(data.wed_start)).format(
                        'HH:mm');
                    var wed_end = moment(new Date(data.wed_end)).format(
                        'HH:mm');

                    $('.wed_start').val(wed_time);
                    $('.wed_end').val(wed_end);


                    var thus_time = moment(new Date(data.thur_start)).format(
                        'HH:mm');
                    var thus_end = moment(new Date(data.thur_end)).format(
                        'HH:mm');

                    $('.thur_start').val(thus_time);
                    $('.thur_end').val(thus_end);


                    var fri_time = moment(new Date(data.fri_start)).format(
                        'HH:mm');
                    var fri_end = moment(new Date(data.fri_end)).format(
                        'HH:mm');

                    $('.fri_start').val(fri_time);
                    $('.fri_end').val(fri_end);


                    var sat_time = moment(new Date(data.sat_start)).format(
                        'HH:mm');
                    var sat_end = moment(new Date(data.sat_end)).format(
                        'HH:mm');

                    $('.sat_start').val(sat_time);
                    $('.sat_end').val(sat_end);


                    var sun_time = moment(new Date(data.sun_start)).format(
                        'HH:mm');
                    var sun_end = moment(new Date(data.sun_end)).format(
                        'HH:mm');

                    $('.sun_start').val(sun_time);
                    $('.sun_end').val(sun_end);


                    $('.loading2').hide();


                }
            });


            $('#copy_times').click(function () {
                $('.loading2').show();
                let mon_start_time = $('.mon_start').val();
                let mon_end_time = $('.mon_end').val();

                $('.copy_start').each(function () {
                    $(this).val(mon_start_time);
                });

                $('.copy_end').each(function () {
                    $(this).val(mon_end_time);
                });

                $('.loading2').hide();

            })


        })
    </script>
    <script>
        $(document).ready(function () {
            $('#add_more_32').click(function () {
                console.log('done')
                $('.add_32_section').append(
                    `
                    <br>
                    <div class="row new_sec_32">
                        <div class="col-md-3 mb-2">
                                            <label>Region Name</label>
                                            <input type="text" class="form-control form-control-sm" name="new_zone_name[]"
                                                   required>
                                            <input type="hidden" class="form-control form-control-sm" name="edit_box_id[]">
                                        </div>
                                         <div class="col-md-3 mb-2" >
                                                        <label>Facility Name</label>
                                                        <input type="text" class="form-control form-control-sm" name="new_facility_name_two[]"
                                                               required>
                                                    </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="row no-gutters">
                                                <div class="col-md-12">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control form-control-sm" name="new_address[]"
                                                           required>
                                                    <div class="invalid-feedback">Please Provide Address
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>City</label>
                                            <input type="text" class="form-control form-control-sm" name="new_city[]"
                                                   required>
                                            <div class="invalid-feedback">Please Provide City</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>State</label>
                                            <select class="form-control form-control-sm" name="new_state[]" required>
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
                                                <option value="AA">Armed Forces Americas (except Canada)
                                                </option>
                                                <option value="AE">Armed Forces Canada</option>
                                                <option value="AE">Armed Forces Europe</option>
                                                <option value="AE">Armed Forces Middle East</option>
                                                <option value="AP">Armed Forces Pacific</option>
                                            </select>
                                            <div class="invalid-feedback">Please Provide State</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Zip</label>
                                            <input type="text" class="form-control form-control-sm" name="new_zip[]"
                                                   required>
                                            <div class="invalid-feedback">Please Provide Zip</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="row no-gutters">
                                                <div class="col-md-10">
                                                    <label>Phone 1</label>
                                                    <input type="text" class="form-control form-control-sm" name="new_phone_one[]"
                                                           required data-mask="(000)-000-0000" pattern=".{14,}"
                                                           required="" autocomplete="off" maxlength="14">
                                                    <div class="invalid-feedback">Please Provide Phone</div>
                                                </div>
                                                <div class="col-md-2 pl-2 align-self-end">
                                                     <button class="btn btn-sm btn-danger remove_add_more" type="button"
                                                            title="Delete"><i class="fa fa-trash"
                                                                              aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-3 mb-2">
                                                        <label>NPI</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control form-control-sm"
                                                                   name="new_npi[]">
                                                            <div class="input-group-append ml-2">
                                                                  <button class="btn btn-sm btn-danger remove_add_more" type="button"
                                                            title="Delete"><i class="fa fa-trash"
                                                                              aria-hidden="true"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                         <div class="col-md-12">
                                                <hr>
                                            </div>
                                        </div>

                    `
                );

                $('.remove_add_more').click(function () {
                    $(this).closest('.new_sec_32').remove();
                })
            });


            $('.remove_exists_32').click(function () {
                var de_id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.remove.exsts.box32')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'de_id': de_id,
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == 'existsbox') {
                            toastr["error"]("This Box 32 has been used to client. You can't delete it", 'ALERT!');
                        } else if (data == 'done') {
                            toastr["success"]("Box 32 Deleted Successfully", 'SUCCESS!');
                            location.reload();
                        }

                    }
                });
            })

        })
    </script>
@endsection
