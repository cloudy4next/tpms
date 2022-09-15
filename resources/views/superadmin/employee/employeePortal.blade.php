@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <!-- text -->
            <div class="overflow-hidden mb-2">
                <div class="float-left">
                    <h5><a href="#" class="cmn_a">{{$employee->full_name}}</a> | <small><span
                                class="font-weight-bold text-orange">DOB:</span> {{$employee->staff_birthday != null ? \Carbon\Carbon::parse($employee->staff_birthday)->format('m/d/Y') : ''}}
                            | <small><span
                                    class="font-weight-bold text-orange">NPI:</span> {{$employee->individual_npi}} |
                                <span
                                    class=" font-weight-bold text-orange">Phone:</span> {{$employee->office_phone}}
                            </small></h5>
                </div>
                <div class="float-right">
                    <a href="{{route('superadmin.employee')}}" class="btn btn-sm btn-primary"><i
                            class="ri-arrow-left-circle-line"></i>Back</a>
                </div>
            </div>
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="all_menu">
                    <ul class="nav flex-column employee_menu">
                        <!-- Profile Picture -->
                        <li class="nav-item border-0 text-center">
                            <div class="profile-pic-div">
                                @if($employee->profile_photo==null)
                                    <img src="{{asset('assets/dashboard/')}}/images/user/01.jpg" class="img-fluid"
                                         id="photo"
                                         alt="aba+">
                                @else
                                    <img class="profile-pic" src="{{asset($employee->profile_photo)}}"
                                         alt="profile-pic" style="height: 100%">
                                @endif
                                <input type="file" id="file" class="d-none" autocomplete="nope">
                                <label for="file" id="uploadBtn">Upload Photo</label>
                            </div>
                        </li>
                        <!--/ Profile Picture -->
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{route('superadmin.emaployee.biographic',$employee->id)}}">Bio’s</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.contact.details',$employee->id)}}">Contact
                                Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.credentials',$employee->id)}}">Credentials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.department',$employee->id)}}">Department
                                Supervisor(s)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.payroll',$employee->id)}}">Payroll
                                Setup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.other.setup',$employee->id)}}">Other
                                Setup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.leave.tracking',$employee->id)}}">Leave
                                Tracking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.payor.exclusion',$employee->id)}}">Insurance
                                Exclusion(s)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{route('superadmin.emaployee.subactivity.exclusion',$employee->id)}}">Service
                                Sub-Type Exclusions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.client.exclusion',$employee->id)}}">Patient
                                Exclusion</a>
                        </li>
                        <li class="nav-item">
                            <a class="active" href="{{route('superadmin.employee.portal',$employee->id)}}">Staff
                                Portal</a>
                        </li>
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="staff-activity.html">Staff Activity</a>--}}
                        {{--                        </li>--}}
                    </ul>
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <h4 class="common-title">Staff Portal Features</h4>
                            <form action="{{route('superadmin.employee.portal.geatures.save')}}" method="post">
                                @csrf

                                <label class="d-block text-muted">Select which features are available for
                                    this Staff Portal.</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="1"
                                               {{$new_fet->is_secure == 1 ? 'checked' :''}} name="is_secure"
                                               autocomplete="nope">Use secure messaging
                                    </label>
                                    <input type="hidden" class="form-check-input" value="{{$employee->id}}"
                                           name="fet_em_id"
                                    >
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="1"
                                               {{$new_fet->access_billing == 1 ? 'checked' :''}} name="access_billing"
                                               autocomplete="nope">Access billing documents
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="1"
                                               {{$new_fet->pay_balance == 1 ? 'checked' :''}} name="pay_balance"
                                               autocomplete="nope">Pay a balance with credit card using Stripe
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary mt-2">Save
                                    Features
                                </button>
                            </form>
                            <div class="mt-3">
                                <h2 class="common-title">Share Password Change Link</h2>
                                <p>Select an expiration date & generate the link to share it with user.
                                    Remember that anyone who has access to this link can change the password for relavent user.</p>
                                <div class="d-flex">
                                    <div class="align-self-center mr-2 mb-3 mt-2">
                                        <label class="text-danger">Link Expiration Date</label>
                                    </div>
                                    <div class="align-self-center mb-3 flex-fill">
                                        <input type="date" class="form-control form-control-sm expiry_date" style="max-width:100%">
                                    </div>
                                    <div class="align-self-center mb-3 ml-2">
                                        <button class="btn btn-sm btn-primary" type="button" id="gen_reset_link">Generate Link</button>
                                    </div>
                                </div>
                                <div class="show_box">
                                    
                                <div class="input-group mb-3">
                                    <input type="text" value=""
                                        class="form-control form-control-sm link_box" id="link_box">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-danger copy_btn" type="button">Copy</button>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="align-self-center mr-2 mb-3 mt-2">
                                        <label>Email: </label>
                                    </div>
                                    <div class="align-self-center mb-3 flex-fill">
                                        <select class="form-control form-control-sm email_selector" style="max-width:100%">
                                            <option value="{{$employee->office_email}} ">
                                                {{$employee->office_email}} (current)
                                            </option>
                                        </select>
                                        <input type="hidden" value="{{$employee->id}}" id="e_id">
                                    </div>
                                    <div class="align-self-center mb-3 ml-2">
                                        <button type="button" class="btn btn-sm btn-danger send_link">Send Link</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (Auth::user()->is_up_admin == 1) {
                            $id = Auth::user()->id;
                        } else {
                            $id = Auth::user()->up_admin_id;
                        }


                        $reg = \App\Models\portal_access_email::where('admin_id', $id)->where('provider_id', $employee->id)->where('is_use', 1)->count();
                        $non_reg = \App\Models\portal_access_email::where('admin_id', $id)->where('provider_id', $employee->id)->where('is_use', 0)->count();
                        ?>


                        <div class="col-md-6 mb-2">
                            <h4 class="common-title">Staff Portal Access</h4>
                            <form action="{{route('superadmin.employee.portal.send.access')}}" method="post">
                                @csrf
                                <label class="d-block mb-2 text-muted">Staff will create their own
                                    accounts to access your Staff Portal.</label>
                                <label>Email: </label>
                                <div class="d-inline-block">
                                    <select class="form-control form-control-sm" name="access_email">
                                        <option value="{{$employee->office_email}} ">
                                            {{$employee->office_email}} (current)
                                        </option>
                                    </select>
                                    <input type="hidden" name="employee_id" value="{{$employee->id}}">
                                </div>
                                @if($reg>0)
                                    <div class="alert alert-success alert-dismissible mt-2 mb-2" role="alert">
                                        Staff has signed Up!
                                        <button type="button" class="close text-success" data-dismiss="alert"
                                                aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @elseif($non_reg>0)
                                    <div class="alert alert-danger alert-dismissible mt-2 mb-2" role="alert">
                                        Invitation sent — Staff has not signed in yet.
                                        <button type="button" class="close text-danger" data-dismiss="alert"
                                                aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @else

                                @endif

                                <button type="submit" class="btn btn-sm btn-secondary">Send
                                    Invitation
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section("js")

    <script>
        $(document).ready(function(){
            var e_id;
            var ex_date;
            var url;
            var email;
            function generate_link(){
                $.ajax({
                    url:"{{route('superadmin.employee.reset.link')}}",
                    method:"POST",
                    data:{
                        "_token":"{{csrf_token()}}",
                        e_id:e_id,
                        ex_date:ex_date,
                    },
                    success:function(data){
                        //console.log(data);
                        url=data;
                        $('.link_box').val(data);
                        $('.show_box').show();

                    }
                });
            }


            function send_link(){
                $.ajax({
                    url:"{{route('superadmin.send.staff.reset.password')}}",
                    method:"POST",
                    data:{
                        "_token":"{{csrf_token()}}",
                        e_id:e_id,
                        email:email,
                        url:url
                    },
                    success:function(data){
                        console.log(data);
                        if(data=="success"){
                            toastr["success"]("Password Reset Link was sent.");
                        }
                    }
                });
            }

            $('.show_box').hide();

            $('#gen_reset_link').click(function(){
                e_id=$('#e_id').val();
                ex_date=$('.expiry_date').val();
                if(Date.parse(ex_date)){
                    generate_link();
                }
                else{
                    toastr["error"]("Please select expiration date.");
                }
            })

            $(document).on('click','.copy_btn',function(){
                var text = document.getElementById("link_box");
                text.select();    
                document.execCommand("copy");
            })


            $(document).on('click','.send_link',function(){
                email=$('.email_selector').val();
                send_link(url);
            })



        });
    </script>

@endsection
