<?php
$check=0;
 if(isset($flag)){
    if($flag["pass"]=="password"){
        $check=1;
    }
    else{
        $check=0;
    }
 }

?>


@extends('layouts.client')
@section('css')
    
@endsection
@section('client')
    <div class="iq-card">
               <div class="iq-card-body">
                  <ul class="iq-edit-profile d-flex nav nav-pills">
                     {{-- <li class="col-md-3 p-0">
                        <a class="nav-link {{ $check==0?'active':''}}" data-toggle="pill" href="#personal-information">
                           Personal Information
                        </a>
                     </li> --}}
                     <li class="col-md-12 p-0">
                        <a class="nav-link {{ $check==1?'active':''}}" data-toggle="pill" href="#chang-pwd">
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
                     {{-- <div class="tab-pane fade {{ $check==0?'active show':''}}" id="personal-information" role="tabpanel">
                        <div class="iq-card">
                           <div class="iq-card-body">
                              <form id="personal_form" action="{{route('client.profile.personal.update')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                 <div class="row">
                                    <div class="col-md-12 mb-3">
                                       <div class="profile-img-edit">
                                          <img class="profile-pic" src="{{asset(Auth::user()->profile_photo)}}" alt="profile-pic">
                                          <div class="p-image">
                                             <label class="upload-button">
                                                <i class="ri-pencil-line"></i>
                                                <input type="file" title="Add Image" accept="image/*" name="profile_photo">
                                             </label>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                       <label for="fname">First Name:</label>
                                       <input type="text" class="form-control" id="fname" placeholder="Enter here.." value="{{Auth::user()->client_first_name}}" name="first_name">
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                       <label for="lname">Last Name:</label>
                                       <input type="text" class="form-control" id="lname" placeholder="Enter here.." value="{{Auth::user()->client_last_name}}" name="last_name">
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                       <label for="uname">User Name:</label>
                                       <input type="text" class="form-control" id="uname" placeholder="Enter here.." value="{{Auth::user()->client_u_name}}" name="user_name">
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                       <label for="cname">City:</label>
                                       <input type="text" class="form-control" id="cname" placeholder="Enter here.." value="{{Auth::user()->client_city}}" name="city">
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                       <label class="d-block">Gender:</label>
                                       <div class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" id="customRadio6"
                                             class="custom-control-input"  {{ Auth::user()->client_gender=='1'?'checked':''}} name="gender" value="1">
                                          <label class="custom-control-label" for="customRadio6"> Male </label>
                                       </div>
                                       <div class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" id="customRadio7"
                                             class="custom-control-input" {{Auth::user()->client_gender=='2'?'checked':''}} name="gender" value="2">
                                          <label class="custom-control-label" for="customRadio7"> Female
                                          </label>
                                       </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                       <label for="dob">Date Of Birth:</label>
                                       <input class="form-control" type="date" id="dob" value="{{Auth::user()->client_dob}}" name="dob">
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                       <label>Marital Status:</label>
                                       <select class="form-control" id="exampleFormControlSelect1" name="marital">
                                          <option {{Auth::user()->client_marital==NULL?'selected':''}} disabled>Select Marital Status</option>
                                          <option value="Single" {{Auth::user()->client_marital=='Single'?'selected':''}}>Single</option>
                                          <option value="Married" {{Auth::user()->client_marital=='Married'?'selected':''}}>Married</option>
                                          <option value="Widowed" {{Auth::user()->client_marital=='Widowed'?'selected':''}}>Widowed</option>
                                          <option value="Divorced" {{Auth::user()->client_marital=='Divorced'?'selected':''}}>Divorced</option>
                                          <option value="Separated" {{Auth::user()->client_marital=='Separated'?'selected':''}}>Separated </option>
                                       </select>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                       <label>Age:</label>
                                       <select class="form-control" id="exampleFormControlSelect2" name="age">
                                            <option {{Auth::user()->client_age==NULL?'selected':''}} disabled>Select Age</option>
                                          <option value="12-18" {{Auth::user()->client_age=='12-18'? 'selected':''}}>12-18</option>
                                          <option value="19-32" {{Auth::user()->client_age=='19-32'? 'selected':''}}>19-32</option>
                                          <option value="33-45" {{Auth::user()->client_age=='33-45'? 'selected':''}}>33-45</option>
                                          <option value="46-62" {{Auth::user()->client_age=='46-62'? 'selected':''}}>46-62</option>
                                          <option value="63 >" {{Auth::user()->client_age=='63 >'? 'selected':''}}>63 > </option>
                                       </select>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                       <label>Country:</label>
                                       <select class="form-control" id="exampleFormControlSelect3" name="country">
                                        <option {{Auth::user()->client_country==NULL?'selected':''}} disabled>Select Country</option>
                                          <option value="Caneda" {{Auth::user()->client_country=='Caneda'?'selected':''}}>Caneda</option>
                                          <option value="Noida" {{Auth::user()->client_country=='Noida'?'selected':''}}>Noida</option>
                                          <option value="USA" {{Auth::user()->client_country=='USA'?'selected':''}}>USA</option>
                                          <option value="India" {{Auth::user()->client_country=='India'?'selected':''}}>India</option>
                                          <option value="Africa" {{Auth::user()->client_country=='Africa'?'selected':''}}>Africa</option>
                                       </select>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 mb-3">
                                       <label>State:</label>
                                       <select class="form-control" id="exampleFormControlSelect4" name="state">
                                        <option {{Auth::user()->client_state==NULL?'selected':''}} disabled>Select State</option>
                                          <option value="California" {{Auth::user()->client_state=='California'?'selected':''}}>California</option>
                                          <option value="Florida" {{Auth::user()->client_state=='Florida'?'selected':''}}>Florida</option>
                                          <option value="Georgia" {{Auth::user()->client_state=='Georgia'?'selected':''}}>Georgia</option>
                                          <option value="Connecticut" {{Auth::user()->client_state=='Connecticut'?'selected':''}}>Connecticut</option>
                                          <option value="Louisiana" {{Auth::user()->client_state=='Louisiana'?'selected':''}}>Louisiana</option>
                                       </select>
                                    </div>
                                    <div class="col-sm-6 col-lg-6 mb-3">
                                       <label>Address:</label>
                                       <textarea class="form-control" name="address" rows="5" name="address">{{ Auth::user()->client_address}}</textarea>
                                    </div>
                                 </div>
                                 <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                 <button type="reset" class="btn btn-danger">Cancel</button>
                              </form>
                           </div>
                        </div>
                     </div> --}}
                     <div class="tab-pane fade {{ $check==1?'active show':''}}" id="chang-pwd" role="tabpanel">
                        <div class="iq-card">
                           <div class="iq-card-body">
                              <form method="POST" action="{{ route('client.profile.password.update')}}">
                                @csrf
                                 <div class="row">
                                    <div class="col-md-4 mb-3">
                                       <label for="cpass">Current Password:</label>
                                       <a href="#" class="float-right">Forgot Password</a>
                                       <input type="Password" class="form-control" id="cpass" placeholder="" name="current_pass">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                       <label for="npass">New Password:</label>
                                       <input type="Password" class="form-control" id="npass" placeholder="" name="new_pass">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                       <label for="vpass">Confirm Password:</label>
                                       <input type="Password" class="form-control" id="vpass" placeholder="" name="verify_pass">
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
                              <form method="POST" action="{{ route('client.profile.email.update')}}">
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
                              <form method="POST" action="{{ route('client.profile.contact.update')}}">
                                @csrf
                                 <div class="row">
                                    <div class="col-md-4 mb-3">
                                       <label for="cno">Contact Number:</label>
                                       <input type="text" class="form-control form-control-sm"
                                          data-mask="(000)-000-0000" pattern=".{14,}" required="" autocomplete="nope"
                                          maxlength="14" placeholder="(000)-000-0000" id="cno" name="phone" value="{{Auth::user()->phone_number}}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                       <label for="email">Email:</label>
                                       <input type="text" class="form-control" id="email"
                                          placeholder="example@demo.com" name="email" value="{{Auth::user()->login_email}}">
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
        $(document).ready(function(){
            $(document).on('focusout','#cpass',function(){
                selector=$(this);
                $.ajax({
                    url:"{{route('client.profile.verify.password')}}",
                    method:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        'current_pass':selector.val()
                    },
                    success:function(data){
                        if(data=="wrong"){
                            selector.removeClass('is-valid').addClass('is-invalid');
                            toastr["error"]("Current password is wrong!","ALERT!");
                        }
                        else{
                            selector.removeClass('is-invalid').addClass('is-valid');
                        }
                    }
                });
            });

            $(document).on('click','#submit_btn',function(e){
                e.preventDefault();
                if($('#npass').val()==$('#vpass').val()){
                    if($('#npass').val().length<8){
                        $('#npass, #vpass').removeClass('is-valid').addClass('is-invalid');
                        toastr["error"]("Password length must be minimum 8 characters!","ALERT!");

                    }
                    else{
                        $('#npass, #vpass').removeClass('is-invalid').addClass('is-valid');
                        if($('#cpass').hasClass('is-invalid')){
                            toastr["error"]("Current password is wrong!","ALERT!");
                        }
                        else{
                            $(this).parent('form').submit();   
                        }
                    }
                }
                else{
                    $('#npass, #vpass').removeClass('is-valid').addClass('is-invalid');
                    toastr["error"]("Password didn't match!","ALERT!");
                }
            })

        })
    </script>



@endsection
