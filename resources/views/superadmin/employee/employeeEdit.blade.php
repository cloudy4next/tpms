@extends('layouts.superadmin')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/vendor/color/colorPick.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/vendor/color/colorPick.dark.theme.css">
@endsection
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
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
                            <a class="active"
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
                            <a class="nav-link" href="{{route('superadmin.employee.portal',$employee->id)}}">Staff
                                Portal</a>
                        </li>
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="{{route('superadmin.employee.activity',$employee->id)}}">Staff--}}
                        {{--                                Activity</a>--}}
                        {{--                        </li>--}}
                    </ul>

                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h2 class="common-title">Bio’s</h2>
                    <form action="{{route('superadmin.emaployee.biographic.update')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="first_name"
                                       value="{{$employee->first_name}}" required>
                                <input type="hidden" class="form-control form-control-sm" id="fname"
                                       name="employee_edit_id" value="{{$employee->id}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Middle Name</label>
                                <input type="text" class="form-control form-control-sm" name="middle_name"
                                       value="{{$employee->middle_name}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="last_name"
                                       value="{{$employee->last_name}}" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Nickname</label>
                                <input type="text" class="form-control form-control-sm" name="nickname"
                                       value="{{$employee->middle_name}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Staff Birthday <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" name="staff_birthday"
                                       value="{{$employee->staff_birthday}}" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>SSN</label>
                                <input type="text" class="form-control form-control-sm" name="ssn"
                                       data-mask="00-0000000" placeholder="XX-YYYYYYY"
                                       value="{{$employee->ssn}}">
                            </div>
                            {{--                            <div class="col-md-3 form-group">--}}
                            {{--                                <label>Staff Id <span class="text-danger">*</span></label>--}}
                            {{--                                <input type="text" class="form-control form-control-sm" name="staff_other_id"--}}
                            {{--                                       value="{{$employee->staff_other_id}}" required>--}}
                            {{--                            </div>--}}
                            <div class="col-md-3 form-group">
                                <label>Office Phone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control form-control-sm" name="office_phone"
                                       data-mask="(000)-000-0000" pattern=".{14,}" placeholder="(XXX)-YYY-ZZZZ"
                                       value="{{$employee->office_phone}}" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Office Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-sm" name="office_email"
                                       value="{{$employee->office_email}}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Drivers License & Expiration Date</label>
                                <div class="row no-gutters">
                                    <div class="col-md pr-2">
                                        <input type="text" class="form-control form-control-sm" name="driver_license"
                                               value="{{$employee->driver_license}}">
                                    </div>
                                    <div class="col-md">
                                        <input type="date" class="form-control form-control-sm" name="license_exp_date"
                                               value="{{$employee->license_exp_date}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Title</label>
                                <input type="text" class="form-control form-control-sm" name="title"
                                       value="{{$employee->title}}">
                                {{--                                <select class="form-control form-control-sm" name="title">--}}
                                {{--                                    <option selected="selected" value=""></option>--}}
                                {{--                                    @foreach($assign_type as $type)--}}
                                {{--                                        <option--}}
                                {{--                                            value="{{$type->id}}" {{$employee->title == $type->id ? 'selected' : ''}}>{{$type->type_name}}</option>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </select>--}}
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Hiring Date with Company</label>
                                <input type="date" class="form-control form-control-sm" name="hir_date_compnay"
                                       value="{{$employee->hir_date_compnay}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Credential Type</label>
                                <select class="form-control form-control-sm" name="credential_type">
                                    <option value="0">Select</option>
                                    @foreach($employee_staff_type as $st_types)
                                        <option
                                            value="{{$st_types->id}}" {{$employee->credential_type == $st_types->id ? 'selected' : ''}}>
                                            {{$st_types->type_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Tx Type <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" name="treatment_type" required>
                                    <option value="0">Select Tx Type</option>
                                    @foreach ($tx_types as $txtype)
                                        <option
                                            value="{{$txtype->id}}" {{$employee->treatment_type == $txtype->id ? 'selected' : ''}}>{{$txtype->treatment_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Individual NPI</label>
                                <input type="text" class="form-control form-control-sm" name="individual_npi"
                                       value="{{$employee->individual_npi}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>CAQH Id</label>
                                <input type="number" class="form-control form-control-sm" name="caqh_id"
                                       value="{{$employee->caqh_id}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Service Area Zip</label>
                                <input type="text" class="form-control form-control-sm" name="service_area_zip"
                                       value="{{$employee->service_area_zip}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Termination Date</label>
                                <input type="date" class="form-control form-control-sm" name="terminated_date"
                                       value="{{$employee->terminated_date}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Language(s)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="language"
                                       value="{{$employee->language}}" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Taxonomy Code</label>
                                <input type="text" class="form-control form-control-sm" name="taxonomy_code"
                                       value="{{$employee->taxonomy_code}}">
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Background Color</label>
                                <div class="colorPickSelector"
                                     style="background-color: {{$employee->back_color}} !important;">
                                    <input type="color" class="form-control form-control-sm d-none" name="back_color"
                                           value="{{$employee->back_color}}">
                                </div>
                                <div class="custom-control custom-switch  mt-3">
                                    <input type="checkbox" class="custom-control-input employeeswt" value="1" id="ac2" name="session_check" {{$employee->session_check==1? "checked":""}}>
                                    <label class="custom-control-label" for="ac2">Create Session</label>
                                </div>
                            </div>

                            <div class="col-md-3 form-group">
                                <label class="d-block">Gender <span class="text-danger">*</span></label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="male" name="gender" value="1"
                                           {{$employee->gender == 1 ? 'checked' : ''}}
                                           class="custom-control-input" required>
                                    <label class="custom-control-label" for="male">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="female" name="gender" value="2"
                                           {{$employee->gender == 2 ? 'checked' : ''}}
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="female">Female</label>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Notes</label>
                                <textarea class="form-control form-control-sm"
                                          name="notes">{!! $employee->notes !!}</textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn btn-sm btn-primary mr-2">Save</button>
                                <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/dashboard/')}}/vendor/color/colorPick.js"></script>
    <script>

        let color = "{{$employee->back_color != null ? $employee->back_color : '#E0EBF5'}}";

        $(".colorPickSelector").colorPick({
            'initialColor': color,
            'allowRecent': false,
            'allowCustomColor': false,
            'palette': ["#E0EBF5", "#FFE8E8", "#E5F6EE", "#FCEFDC", "#B0DDC8", "#AACBEE", "#FEE9A6", "#FBCBC7",
                "#B2EBF2", "#C5CAE9", "#FFECB3", "#D7CCC8", "#B3E6CC", "#B2DFDB", "#FFCDD2"
            ],
            'onColorSelected': function () {
                $(".colorPickSelector input").val(this.color);
                this.element.css({
                    'backgroundColor': this.color,
                });
            }
        });
    </script>
@endsection
