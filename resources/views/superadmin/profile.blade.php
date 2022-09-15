<?php
$check = 0;
if (isset($flag)) {
    if ($flag['pass'] == 'password') {
        $check = 1;
    } else {
        $check = 0;
    }
}

?>


@extends('layouts.superadmin')
@section('css')
@endsection
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <ul class="iq-edit-profile d-flex nav nav-pills">
                <li class="col-md-6 p-0">
                    <a class="nav-link {{ $check == 0 ? 'active' : '' }}" data-toggle="pill" href="#personal-information">
                        Personal Information
                    </a>
                </li>
                <li class="col-md-6 p-0">
                    <a class="nav-link {{ $check == 1 ? 'active' : '' }}" data-toggle="pill" href="#chang-pwd">
                        Change Password
                    </a>
                </li>
                {{-- <li class="col-md-3 p-0">
                   <a class="nav-link" data-toggle="pill" href="#emailandsms">
                      Email and SMS
                   </a>
                </li>
                <li class="col-md-3 p-0">
                   <a class="nav-link" data-toggle="pill" href="#manage-contact">
                      Manage Contact
                   </a>
                </li> --}}
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade {{ $check == 0 ? 'active show' : '' }}" id="personal-information" role="tabpanel">
                    <div class="iq-card">
                        <div class="iq-card-body">
                            <form id="personal_form" action="{{ route('superadmin.profile.personal.update') }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="profile-img-edit">
                                            <img class="profile-pic" src="{{ asset($data->profile_photo) }}"
                                                alt="profile-pic">
                                            <div class="p-image">
                                                <label class="upload-button">
                                                    <i class="ri-pencil-line"></i>
                                                    <input type="file" title="Add Image" accept="image/*"
                                                        name="profile_photo">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                        <label for="fname">First Name:</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Enter here.."
                                            value="{{ Auth::user()->first_name }}" name="first_name">
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                        <label for="lname">Last Name:</label>
                                        <input type="text" class="form-control" id="lname" placeholder="Enter here.."
                                            value="{{ Auth::user()->last_name }}" name="last_name">
                                    </div>{{-- <div class="col-sm-6 col-lg-3 mb-3">
                                       <label for="uname">User Name:</label>
                                       <input type="text" class="form-control" id="uname" placeholder="Enter here.." value="{{$data->user_name}}" name="user_name">
                                    </div> --}}
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                        <label for="cname">City:</label>
                                        <input type="text" class="form-control" id="cname" placeholder="Enter here.."
                                            value="{{ $data->city }}" name="city">
                                    </div>
                                    {{-- <div class="col-sm-6 col-lg-3 mb-3">
                                       <label for="dob">Date Of Birth:</label>
                                       <input class="form-control" type="date" id="dob" value="{{Auth::user()->dob}}" name="dob">
                                    </div> --}}
                                    {{-- <div class="col-sm-6 col-lg-3 mb-3">
                                       <label>Marital Status:</label>
                                       <select class="form-control" id="exampleFormControlSelect1" name="marital">
                                          <option {{$data->marital==NULL?'selected':''}} disabled>Select Marital Status</option>
                                          <option value="Single" {{$data->marital=='Single'?'selected':''}}>Single</option>
                                          <option value="Married" {{$data->marital=='Married'?'selected':''}}>Married</option>
                                          <option value="Widowed" {{$data->marital=='Widowed'?'selected':''}}>Widowed</option>
                                          <option value="Divorced" {{$data->marital=='Divorced'?'selected':''}}>Divorced</option>
                                          <option value="Separated" {{$data->marital=='Separated'?'selected':''}}>Separated </option>
                                       </select>
                                    </div> --}}
                                    {{-- <div class="col-sm-6 col-lg-3 mb-3">
                                       <label>Age:</label>
                                       <select class="form-control" id="exampleFormControlSelect2" name="age">
                                            <option {{$data->age==NULL?'selected':''}} disabled>Select Age</option>
                                          <option value="12-18" {{$data->age=='12-18'? 'selected':''}}>12-18</option>
                                          <option value="19-32" {{$data->age=='19-32'? 'selected':''}}>19-32</option>
                                          <option value="33-45" {{$data->age=='33-45'? 'selected':''}}>33-45</option>
                                          <option value="46-62" {{$data->age=='46-62'? 'selected':''}}>46-62</option>
                                          <option value="63 >" {{$data->age=='63 >'? 'selected':''}}>63 > </option>
                                       </select>
                                    </div> --}}
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                        <label>Country:</label>
                                        <select class="form-control" id="exampleFormControlSelect3" name="country">
                                            <option {{ $data->country == null ? 'selected' : '' }} disabled>Select Country
                                            </option>
                                            <option value="Caneda" {{ $data->country == 'Caneda' ? 'selected' : '' }}>Caneda
                                            </option>
                                            <option value="Noida" {{ $data->country == 'Noida' ? 'selected' : '' }}>Noida
                                            </option>
                                            <option value="USA" {{ $data->country == 'USA' ? 'selected' : '' }}>USA
                                            </option>
                                            <option value="India" {{ $data->country == 'India' ? 'selected' : '' }}>India
                                            </option>
                                            <option value="Africa" {{ $data->country == 'Africa' ? 'selected' : '' }}>
                                                Africa
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                        <label>State:</label>
                                        <select class="form-control" id="exampleFormControlSelect4" name="state">
                                            {{-- <option {{$data->state==NULL?'selected':''}} disabled>Select State</option>
                                            <option value="California" {{$data->state=='California'?'selected':''}}>
                                                California
                                            </option>
                                            <option value="Florida" {{$data->state=='Florida'?'selected':''}}>Florida
                                            </option>
                                            <option value="Georgia" {{$data->state=='Georgia'?'selected':''}}>Georgia
                                            </option>
                                            <option value="Connecticut" {{$data->state=='Connecticut'?'selected':''}}>
                                                Connecticut
                                            </option>
                                            <option value="Louisiana" {{$data->state=='Louisiana'?'selected':''}}>
                                                Louisiana
                                            </option>
                                        </select> --}}
                                            <option value="Alaska" {{ $data->state == 'Alaska' ? 'selected' : '' }}>
                                                Alaska
                                            </option>
                                            <option value="Alabama" {{ $data->state == 'Alabama' ? 'selected' : '' }}>
                                                Alabama
                                            </option>
                                            <option value="American Samoa"
                                                {{ $data->state == 'American Samoa' ? 'selected' : '' }}>
                                                American Samoa
                                            </option>
                                            <option value="Arizona" {{ $data->state == 'Arizona' ? 'selected' : '' }}>
                                                Arizona
                                            </option>
                                            <option value="Arkansas" {{ $data->state == 'Arkansas' ? 'selected' : '' }}>
                                                Arkansas
                                            </option>
                                            <option value="California"
                                                {{ $data->state == 'California' ? 'selected' : '' }}>
                                                California
                                            </option>
                                            <option value="Colorado" {{ $data->state == 'Colorado' ? 'selected' : '' }}>
                                                Colorado
                                            </option>
                                            <option value="Connecticut"
                                                {{ $data->state == 'Connecticut' ? 'selected' : '' }}>
                                                Connecticut
                                            </option>
                                            <option value="Delaware" {{ $data->state == 'Delaware' ? 'selected' : '' }}>
                                                Delaware
                                            </option>
                                            <option value="District of Columbia"
                                                {{ $data->state == 'District of Columbia' ? 'selected' : '' }}>
                                                District of Columbia
                                            </option>
                                            <option value="Federated States of Micronesia"
                                                {{ $data->state == 'Federated States of Micronesia' ? 'selected' : '' }}>
                                                Federated States of Micronesia
                                            </option>
                                            <option value="Florida" {{ $data->state == 'Florida' ? 'selected' : '' }}>
                                                Florida
                                            </option>
                                            <option value="Georgia" {{ $data->state == 'Georgia' ? 'selected' : '' }}>
                                                Georgia
                                            </option>
                                            <option value="Guam" {{ $data->state == 'Guam' ? 'selected' : '' }}>
                                                Guam
                                            </option>
                                            <option value="Hawaii" {{ $data->state == 'Hawaii' ? 'selected' : '' }}>
                                                Hawaii
                                            </option>
                                            <option value="Idaho" {{ $data->state == 'Idaho' ? 'selected' : '' }}>
                                                Idaho
                                            </option>
                                            <option value="Illinois" {{ $data->state == 'Illinois' ? 'selected' : '' }}>
                                                Illinois
                                            </option>
                                            <option value="Indiana" {{ $data->state == 'Indiana' ? 'selected' : '' }}>
                                                Indiana
                                            </option>
                                            <option value="Iowa" {{ $data->state == 'Iowa' ? 'selected' : '' }}>
                                                Iowa
                                            </option>
                                            <option value="Kansas" {{ $data->state == 'Kansas' ? 'selected' : '' }}>
                                                Kansas
                                            </option>
                                            <option value="Kentucky" {{ $data->state == 'Kentucky' ? 'selected' : '' }}>
                                                Kentucky
                                            </option>
                                            <option value="Louisiana" {{ $data->state == 'Louisiana' ? 'selected' : '' }}>
                                                Louisiana
                                            </option>
                                            <option value="Maine" {{ $data->state == 'Maine' ? 'selected' : '' }}>
                                                Maine
                                            </option>
                                            <option value="Marshall Islands"
                                                {{ $data->state == 'Marshall Islands' ? 'selected' : '' }}>
                                                Marshall Islands
                                            </option>
                                            <option value="Maryland" {{ $data->state == 'Maryland' ? 'selected' : '' }}>
                                                Maryland
                                            </option>
                                            <option value="Massachusetts"
                                                {{ $data->state == 'Massachusetts' ? 'selected' : '' }}>
                                                Massachusetts
                                            </option>
                                            <option value="Michigan" {{ $data->state == 'Michigan' ? 'selected' : '' }}>
                                                Michigan
                                            </option>
                                            <option value="Minnesota" {{ $data->state == 'Minnesota' ? 'selected' : '' }}>
                                                Minnesota
                                            </option>
                                            <option value="Mississippi"
                                                {{ $data->state == 'Mississippi' ? 'selected' : '' }}>
                                                Mississippi
                                            </option>
                                            <option value="Missouri" {{ $data->state == 'Missouri' ? 'selected' : '' }}>
                                                Missouri
                                            </option>
                                            <option value="Montana" {{ $data->state == 'Montana' ? 'selected' : '' }}>
                                                Montana
                                            </option>
                                            <option value="Nebraska" {{ $data->state == 'Nebraska' ? 'selected' : '' }}>
                                                Nebraska
                                            </option>
                                            <option value="Nevada" {{ $data->state == 'Nevada' ? 'selected' : '' }}>
                                                Nevada
                                            </option>
                                            <option value="New Hampshire"
                                                {{ $data->state == 'New Hampshire' ? 'selected' : '' }}>
                                                New Hampshire
                                            </option>
                                            <option value="New Jersey"
                                                {{ $data->state == 'New Jersey' ? 'selected' : '' }}>
                                                New Jersey
                                            </option>
                                            <option value="New Mexico"
                                                {{ $data->state == 'New Mexico' ? 'selected' : '' }}>
                                                New Mexico
                                            </option>
                                            <option value="New York" {{ $data->state == 'New York' ? 'selected' : '' }}>
                                                New York
                                            </option>
                                            <option value="North Carolina"
                                                {{ $data->state == 'North Carolina' ? 'selected' : '' }}>
                                                North Carolina
                                            </option>
                                            <option value="North Dakota"
                                                {{ $data->state == 'North Dakota' ? 'selected' : '' }}>
                                                North Dakota
                                            </option>
                                            <option value="Northern Mariana Islands"
                                                {{ $data->state == 'Northern Mariana Islands' ? 'selected' : '' }}>
                                                Northern Mariana Islands
                                            </option>
                                            <option value="Ohio" {{ $data->state == 'Ohio' ? 'selected' : '' }}>
                                                Ohio
                                            </option>
                                            <option value="Oklahoma" {{ $data->state == 'Oklahoma' ? 'selected' : '' }}>
                                                Oklahoma
                                            </option>
                                            <option value="Oregon" {{ $data->state == 'Oregon' ? 'selected' : '' }}>
                                                Oregon
                                            </option>
                                            <option value="Palau" {{ $data->state == 'Palau' ? 'selected' : '' }}>
                                                Palau
                                            </option>
                                            <option value="Pennsylvania"
                                                {{ $data->state == 'Pennsylvania' ? 'selected' : '' }}>
                                                Pennsylvania
                                            </option>
                                            <option value="Puerto Rico"
                                                {{ $data->state == 'Puerto Rico' ? 'selected' : '' }}>
                                                Puerto Rico
                                            </option>
                                            <option value="Rhode Island"
                                                {{ $data->state == 'Rhode Island' ? 'selected' : '' }}>
                                                Rhode Island
                                            </option>
                                            <option value="South Carolina"
                                                {{ $data->state == 'South Carolina' ? 'selected' : '' }}>
                                                South Carolina
                                            </option>
                                            <option value="South Dakota"
                                                {{ $data->state == 'South Dakota' ? 'selected' : '' }}>
                                                South Dakota
                                            </option>
                                            <option value="Tennessee" {{ $data->state == 'Tennessee' ? 'selected' : '' }}>
                                                Tennessee
                                            </option>
                                            <option value="Texas" {{ $data->state == 'Texas' ? 'selected' : '' }}>
                                                Texas
                                            </option>
                                            <option value="Utah" {{ $data->state == 'Utah' ? 'selected' : '' }}>
                                                Utah
                                            </option>
                                            <option value="Vermont" {{ $data->state == 'Vermont' ? 'selected' : '' }}>
                                                Vermont
                                            </option>
                                            <option value="Virgin Islands"
                                                {{ $data->state == 'Virgin Islands' ? 'selected' : '' }}>
                                                Virgin Islands
                                            </option>
                                            <option value="Virginia" {{ $data->state == 'Virginia' ? 'selected' : '' }}>
                                                Virginia
                                            </option>
                                            <option value="Washington"
                                                {{ $data->state == 'Washington' ? 'selected' : '' }}>
                                                Washington
                                            </option>
                                            <option value="West Virginia"
                                                {{ $data->state == 'West Virginia' ? 'selected' : '' }}>
                                                West Virginia
                                            </option>
                                            <option value="Wisconsin" {{ $data->state == 'Wisconsin' ? 'selected' : '' }}>
                                                Wisconsin
                                            </option>
                                            <option value="Wyoming" {{ $data->state == 'Wyoming' ? 'selected' : '' }}>
                                                Wyoming
                                            </option>
                                            <option value="Armed Forces Africa"
                                                {{ $data->state == 'Armed Forces Africa' ? 'selected' : '' }}>
                                                Armed Forces Africa
                                            </option>
                                            <option value="Armed Forces Americas (except Canada)"
                                                {{ $data->state == 'Armed Forces Americas (except Canada)' ? 'selected' : '' }}>
                                                Armed Forces Americas (except Canada)
                                            </option>
                                            <option value="Armed Forces Canada"
                                                {{ $data->state == 'Armed Forces Canada' ? 'selected' : '' }}>
                                                Armed Forces Canada
                                            </option>
                                            <option value="Armed Forces Europe"
                                                {{ $data->state == 'Armed Forces Europe' ? 'selected' : '' }}>
                                                Armed Forces Europe
                                            </option>
                                            <option value="Armed Forces Middle East"
                                                {{ $data->state == 'Armed Forces Middle East' ? 'selected' : '' }}>
                                                Armed Forces Middle East
                                            </option>
                                            <option value="Armed Forces Pacific"
                                                {{ $data->state == 'Armed Forces Pacific' ? 'selected' : '' }}>
                                                Armed Forces Pacific
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                        <label for="zipcode">Zip Code:</label>
                                        <input type="text" class="form-control" id="zipcode"
                                            placeholder="Enter here.." value="{{ $data->zip }}" name="zip">
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                        <label class="d-block">Gender:</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadio6" class="custom-control-input"
                                                {{ Auth::user()->gender == 'Male' ? 'checked' : '' }} name="gender"
                                                value="Male">
                                            <label class="custom-control-label" for="customRadio6"> Male </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadio7" class="custom-control-input"
                                                {{ Auth::user()->gender == 'Female' ? 'checked' : '' }} name="gender"
                                                value="Female">
                                            <label class="custom-control-label" for="customRadio7"> Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade {{ $check == 1 ? 'active show' : '' }}" id="chang-pwd" role="tabpanel">
                    <div class="iq-card">
                        <div class="iq-card-body">
                            <form method="POST" action="{{ route('superadmin.profile.password.update') }}">
                                @csrf
                                <div class="row">
                                    {{-- <div class="col-md-4 mb-3">
                                       <label for="cpass">Current Password:</label>
                                       <a href="#" class="float-right">Forgot Password</a>
                                       <input type="Password" class="form-control" id="cpass" placeholder="" name="current_pass">
                                    </div> --}}
                                    <div class="col-md-4 mb-3">
                                        <label for="npass">New Password:</label>
                                        <input type="Password" class="form-control" id="npass" placeholder=""
                                            name="new_pass">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="vpass">Confirm Password:</label>
                                        <input type="Password" class="form-control" id="vpass" placeholder=""
                                            name="verify_pass">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary mr-2" id="submit_btn">Submit</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- <div class="tab-pane fade" id="emailandsms" role="tabpanel">
                   <div class="iq-card">
                      <div class="iq-card-body">
                         <form method="POST" action="{{ route('superadmin.profile.email.update')}}">
                           @csrf
                            <div class="row mb-3">
                               <label class="col-md-3" for="emailnotification">Email Notification:</label>
                               <div class="col-md-9 custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" id="emailnotification" name="email_not" {{Auth::user()->email_not=='yes'? 'checked' :''}} value="yes">
                                  <label class="custom-control-label" for="emailnotification"></label>
                               </div>
                            </div>
                            <div class="row mb-3">
                               <label class="col-md-3" for="smsnotification">SMS Notification:</label>
                               <div class="col-md-9 custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" id="smsnotification" name="sms_not" value="yes" {{Auth::user()->sms_not=='yes'? 'checked' :''}}>
                                  <label class="custom-control-label" for="smsnotification"></label>
                               </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                         </form>
                      </div>
                   </div>
                </div>
                <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                   <div class="iq-card">
                      <div class="iq-card-body">
                         <form method="POST" action="{{ route('superadmin.profile.contact.update')}}">
                           @csrf
                            <div class="row">
                               <div class="col-md-4 mb-3">
                                  <label for="cno">Contact Number:</label>
                                  <input type="text" class="form-control form-control-sm"
                                     data-mask="(000)-000-0000" pattern=".{14,}" required="" autocomplete="nope"
                                     maxlength="14" placeholder="(000)-000-0000" id="cno" name="phone" value="{{Auth::user()->phone}}">
                               </div>
                               <div class="col-md-4 mb-3">
                                  <label for="email">Email:</label>
                                  <input type="text" class="form-control" id="email"
                                     placeholder="example@demo.com" name="email" value="{{Auth::user()->email}}">
                               </div>
                               <div class="col-md-4 mb-3">
                                  <label for="url">Url:</label>
                                  <input type="text" class="form-control" id="url" placeholder="https://demo.com/" name="url" value="{{Auth::user()->url}}">
                               </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-danger">cancel</button>
                         </form>
                      </div>
                   </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // $(document).on('focusout','#cpass',function(){
            //     selector=$(this);
            //     $.ajax({
            //         url:"{{ route('superadmin.profile.verify.password') }}",
            //         method:"POST",
            //         data:{
            //             "_token": "{{ csrf_token() }}",
            //             'current_pass':selector.val()
            //         },
            //         success:function(data){
            //             if(data=="wrong"){
            //                 selector.removeClass('is-valid').addClass('is-invalid');
            //                 toastr["error"]("Current password is wrong!","ALERT!");
            //             }
            //             else{
            //                 selector.removeClass('is-invalid').addClass('is-valid');
            //             }
            //         }
            //     });
            // });

            $(document).on('click', '#submit_btn', function(e) {
                e.preventDefault();
                if ($('#npass').val() == $('#vpass').val()) {
                    if ($('#npass').val().length < 8) {
                        $('#npass, #vpass').removeClass('is-valid').addClass('is-invalid');
                        toastr["error"]("Password length must be minimum 8 characters!", "ALERT!");

                    } else {
                        $('#npass, #vpass').removeClass('is-invalid').addClass('is-valid');
                        if ($('#cpass').hasClass('is-invalid')) {
                            toastr["error"]("Current password is wrong!", "ALERT!");
                        } else {
                            $(this).parent('form').submit();
                        }
                    }
                } else {
                    $('#npass, #vpass').removeClass('is-valid').addClass('is-invalid');
                    toastr["error"]("Password didn't match!", "ALERT!");
                }
            })

        })
    </script>
@endsection
