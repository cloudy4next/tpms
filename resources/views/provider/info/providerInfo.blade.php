@extends('layouts.provider')
@section('provider')
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
                    <a href="{{route('provider.info')}}" class="btn btn-sm btn-primary"><i
                            class="ri-arrow-left-circle-line"></i>Back</a>
                </div>
            </div>
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="all_menu">

                    <ul class="nav flex-column setting_menu">
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
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('provider.info')}}">Bio’s</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('provider.contact.details')}}">Contact Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('provider.credentials')}}">Credentials /
                                Qualifications</a>
                        </li>
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="{{route('provider.department')}}">Department Supervisor(s)</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="{{route('provider.payroll')}}">Payroll Setup</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="{{route('provider.other.setup')}}">Other Setup</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="{{route('provider.leave.tracking')}}">Leave Tracking</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="{{route('provider.payor.exclusion')}}">Insurance Exclusion(s)</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="{{route('provider.subactivity.exclusion')}}">Service Sub-Type--}}
                        {{--                                Exclusions</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="{{route('provider.client.exclusion')}}">Patient Exclusions</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="staff-activity.html">Staff Activity</a>--}}
                        {{--                        </li>--}}
                    </ul>
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h2 class="common-title">Bio’s</h2>
                    <form action="{{route('provider.biographic.update')}}" method="post" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="profile-img-edit">
                                    @if(file_exists($employee->profile_photo) && !empty($employee->profile_photo))
                                        <img class="profile-pic" src="{{asset($employee->profile_photo)}}"
                                             alt="profile-pic">
                                    @else
                                        <img class="profile-pic" src="{{asset('assets/dashboard/')}}/images/user/01.jpg"
                                             alt="profile-pic">
                                    @endif
                                    <div class="p-image">
                                        <label class="upload-button">
                                            <i class="ri-pencil-line"></i>
                                            <input type="file" title="Add Image" accept="image/*" name="profile_photo">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control form-control-sm" id="fname" name="first_name"
                                       value="{{$employee->first_name}}">
                                <input type="hidden" class="form-control form-control-sm" id="fname"
                                       name="employee_edit_id" value="{{$employee->id}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="mname">Middle Intial</label>
                                <input type="text" class="form-control form-control-sm" id="mname" name="middle_name"
                                       value="{{$employee->middle_name}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control form-control-sm" id="lname" name="last_name"
                                       value="{{$employee->last_name}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="nname">Nickname</label>
                                <input type="text" class="form-control form-control-sm" id="nname" name="nickname"
                                       value="{{$employee->nickname}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="bd">Staff Birthday</label>
                                <input type="date" class="form-control form-control-sm" id="bd" name="staff_birthday"
                                       value="{{$employee->staff_birthday}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="ssn">SSN</label>
                                <input type="text" class="form-control form-control-sm" id="ssn" name="ssn"
                                       value="{{$employee->ssn}}">
                            </div>
                            {{--                            <div class="col-md-3 form-group">--}}
                            {{--                                <label>Staff Other Id</label>--}}
                            {{--                                <input type="text" class="form-control form-control-sm" name="staff_other_id"--}}
                            {{--                                       value="{{$employee->staff_other_id}}">--}}
                            {{--                            </div>--}}
                            <div class="col-md-3 form-group">
                                <label>Office Phone</label>
                                <input type="text" class="form-control form-control-sm" name="office_phone"
                                       value="{{$employee->office_phone}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Office Fax</label>
                                <input type="text" class="form-control form-control-sm" name="office_fax"
                                       value="{{$employee->office_fax}}">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Office Email</label>
                                <input type="email" class="form-control form-control-sm" name="office_email"
                                       value="{{$employee->office_email}}">
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="d-block">Drivers License &amp; Expiration Date</label>
                                <div class="form-inline">
                                    <input type="text" class="form-control form-control-sm mr-2" name="driver_license"
                                           value="{{$employee->driver_license}}">
                                    <input type="date" class="form-control form-control-sm" name="license_exp_date"
                                           value="{{$employee->license_exp_date}}">
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Title</label>
                                <select class="form-control form-control-sm" name="title">
                                    <option selected="selected" value=""></option>
                                    @foreach($assign_type as $type)
                                        <option
                                            value="{{$type->id}}" {{$employee->title == $type->id ? 'selected' : ''}}>{{$type->type_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Hiring Date with Company</label>
                                <input type="date" class="form-control form-control-sm" name="hir_date_compnay"
                                       value="{{$employee->driver_license}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Credential Type</label>
                                <select class="form-control form-control-sm" name="credential_type">
                                    <option value="0">Select</option>
                                    @foreach($assign_type as $st_types)
                                        <option
                                            value="{{$st_types->id}}" {{$employee->credential_type == $st_types->id ? 'selected' : ''}}>
                                            {{$st_types->type_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Tx Type</label>
                                <select class="form-control form-control-sm" name="treatment_type">
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
                                <label>Language(s)</label>
                                <input type="text" class="form-control form-control-sm" name="language"
                                       value="{{$employee->language}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Taxonomy Code</label>
                                <input type="text" class="form-control form-control-sm" name="taxonomy_code"
                                       value="{{$employee->taxonomy_code}}">
                            </div>
                            @php
                                $tz_list = \App\Models\Timezone::orderBy('offset','ASC')->orderBy('name','ASC')->get();
                            @endphp
                            <div class="col-md-3 mb-2">
                                <label>Default Timezone:</label>
                                <select class="form-control form-control-sm" name="default_tz" required>
                                    <option value="0"
                                            disabled {{$employee->timezone==null?'selected':''}}>Set a
                                        default timezone
                                    </option>
                                    @foreach($tz_list as $tz)
                                        <option value="{{$tz->name}}" {{$employee->timezone==$tz->name?'selected':''}}>{{'('.$tz->diff_from_gtm.') '.$tz->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please Provide Default POS</div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="d-block">Gender</label>
                                <div class="custom-control custom-radio custom-control-inline mb-1">
                                    <input type="radio" id="male" name="gender" value="1"
                                           {{$employee->gender == 1 ? 'checked' : ''}} class="custom-control-input">
                                    <label class="custom-control-label" for="male">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline mb-1">
                                    <input type="radio" id="female" name="gender" value="2"
                                           {{$employee->gender == 2 ? 'checked' : ''}} class="custom-control-input">
                                    <label class="custom-control-label" for="female">Female</label>
                                </div>
                                {{-- <div class="form-check">--}}
                                {{-- <input class="form-check-input" type="checkbox" value="1" id="ms" name="military_service" {{$employee->military_service == 1 ? 'checked' : ''}}>--}}
                                {{-- <label class="form-check-label" for="ms">--}}
                                {{-- Military Service--}}
                                {{-- </label>--}}
                                {{-- </div>--}}
                                {{-- <div class="form-check">--}}
                                {{-- <input class="form-check-input" type="checkbox" value="1" id="Therapist" name="therapist_bill" {{$employee->therapist_bill == 1 ? 'checked' : ''}}>--}}
                                {{-- <label class="form-check-label" for="Therapist">--}}
                                {{-- Therapist Billable For Private Insurance--}}
                                {{-- </label>--}}
                                {{-- </div>--}}
                                {{-- <div class="form-check">--}}
                                {{-- <input class="form-check-input" type="checkbox" value="1" id="actv" name="is_staff_active" {{$employee->is_staff_active == 1 ? 'checked' : ''}}>--}}
                                {{-- <label class="form-check-label" for="actv">--}}
                                {{-- Is Staff Active--}}
                                {{-- </label>--}}
                                {{-- </div>--}}
                                {{-- <div class="form-check">--}}
                                {{-- <input class="form-check-input" type="checkbox" value="1" id="encre" name="enable_fource_creation" {{$employee->enable_fource_creation == 1 ? 'checked' : ''}}>--}}
                                {{-- <label class="form-check-label" for="encre">--}}
                                {{-- Enable Force Creation--}}
                                {{-- </label>--}}
                                {{-- </div>--}}
                                {{-- <div class="form-check">--}}
                                {{-- <input class="form-check-input" type="checkbox" value="1" id="hasca" name="has_catalsty_access" {{$employee->has_catalsty_access == 1 ? 'checked' : ''}}>--}}
                                {{-- <label class="form-check-label" for="hasca">--}}
                                {{-- Has Catalyst Access--}}
                                {{-- </label>--}}
                                {{-- </div>--}}
                            </div>
                            {{-- <div class="col-md-6 form-group">--}}
                            {{-- <label>Notes</label>--}}
                            {{-- <textarea class="form-control form-control-sm" name="notes">{!! $employee->notes !!}</textarea>--}}
                            {{-- </div>--}}
                            <div class="col-md-12 form-group">
                                {{-- <button type="submit" class="btn btn-sm btn-primary mr-3">Create/Manage Access</button>--}}
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
