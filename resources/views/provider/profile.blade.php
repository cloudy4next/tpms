<?php
$check = 0;
if (isset($flag)) {
    if ($flag["pass"] == "password") {
        $check = 1;
    } else {
        $check = 0;
    }
}

?>


@extends('layouts.provider')
@section('css')

@endsection
@section('provider')
    <div class="iq-card">
        <div class="iq-card-body">
            <ul class="iq-edit-profile d-flex nav nav-pills">
            </ul>
            <div class="tab-content">

                <div class="tab-pane fade active show" id="chang-pwd" role="tabpanel">
                    <div class="iq-card">
                        <div class="iq-card-body">
                            <form method="POST" action="{{ route('provider.profile.password.update')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="cpass">Current Password:</label>
                                        <a href="#" class="float-right">Forgot Password</a>
                                        <input type="Password" class="form-control" id="cpass" placeholder=""
                                               name="current_pass">
                                    </div>
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
                         <form method="POST" action="{{ route('provider.profile.email.update')}}">
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
                         <form method="POST" action="{{ route('provider.profile.contact.update')}}">
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
        $(document).ready(function () {
            $(document).on('focusout', '#cpass', function () {
                selector = $(this);
                $.ajax({
                    url: "{{route('provider.profile.verify.password')}}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'current_pass': selector.val()
                    },
                    success: function (data) {
                        if (data == "wrong") {
                            selector.removeClass('is-valid').addClass('is-invalid');
                            toastr["error"]("Current password is wrong!", "ALERT!");
                        } else {
                            selector.removeClass('is-invalid').addClass('is-valid');
                        }
                    }
                });
            });

            $(document).on('click', '#submit_btn', function (e) {
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
