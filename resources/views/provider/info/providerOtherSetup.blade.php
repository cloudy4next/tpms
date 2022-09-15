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
                                <span class=" font-weight-bold text-orange">Phone:</span> {{$employee->office_phone}}
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
                                         alt="profile-pic">
                                @endif
                                <input type="file" id="file" class="d-none" autocomplete="nope">
                                <label for="file" id="uploadBtn">Upload Photo</label>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('provider.info')}}">Bio’s</a>
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
                        {{--                            <a class="nav-link active" href="{{route('provider.other.setup')}}">Other Setup</a>--}}
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
                    <h2 class="common-title">Other Setup</h2>
                    <form action="{{route('provider.other.setup.update')}}" method="post"
                          enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>Max Hours For Day</label>
                                <input type="text" class="form-control-sm form-control" name="max_hour_per_day"
                                       value="{{$em_setup->max_hour_per_day}}">
                                <input type="hidden" class="form-control-sm form-control" name="em_other_setup_up"
                                       value="{{$employee->id}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Max Hours For Week</label>
                                <input type="text" class="form-control-sm form-control" name="max_hour_per_week"
                                       value="{{$em_setup->max_hour_per_week}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>ADP Employee Id</label>
                                <input type="text" class="form-control-sm form-control" name="adp_employee_id"
                                       value="{{$em_setup->adp_employee_id}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Provider Level</label>
                                <input type="text" class="form-control-sm form-control" name="provider_level"
                                       value="{{$em_setup->provider_level}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Custom2</label>
                                <input type="text" class="form-control-sm form-control" name="custom_two"
                                       value="{{$em_setup->custom_two}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Custom3</label>
                                <input type="text" class="form-control-sm form-control" name="custom_three"
                                       value="{{$em_setup->custom_three}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Custom4</label>
                                <input type="text" class="form-control-sm form-control" name="custom_four"
                                       value="{{$em_setup->custom_four}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Custom5</label>
                                <input type="text" class="form-control-sm form-control" name="custom_five"
                                       value="{{$em_setup->custom_five}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Custom6</label>
                                <input type="text" class="form-control-sm form-control" name="custom_six"
                                       value="{{$em_setup->custom_six}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Highest Degree</label>
                                <input type="text" class="form-control-sm form-control" name="heigh_degree"
                                       value="{{$em_setup->heigh_degree}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Degree Level</label>
                                <select class="form-control-sm form-control" name="degree_level">
                                    <option value=""></option>
                                    <option value="1">Associate degree</option>
                                    <option value="2">Bachelor’s Degree</option>
                                    <option value="3">Master’s Degree</option>
                                    <option value="4">Doctorate</option>
                                    <option selected="selected" value="5">BCBA</option>
                                    <option value="6">BCBA-D</option>
                                    <option value="7">BCABA</option>
                                    <option value="8">High School</option>
                                    <option value="9">Enrolled Masters</option>
                                    <option value="10">RBT</option>
                                    <option value="11">PsyD</option>
                                    <option value="13">LCSW</option>
                                    <option value="15">BT</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>External Software Id</label>
                                <input type="text" class="form-control-sm form-control" name="external_software_id"
                                       value="{{$em_setup->external_software_id}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Signature Valid From</label>
                                <input type="date" class="form-control-sm form-control" name="signature_valid_form"
                                       value="{{$em_setup->signature_valid_form}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Signature Valid To</label>
                                <input type="date" class="form-control-sm form-control" name="signature_valid_to"
                                       value="{{$em_setup->signature_valid_to}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Upload Signature Image</label>
                                <input type="file" name="signature_image">
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="1"
                                               name="paid_time_off" {{$em_setup->paid_time_off == 1 ? 'checked' : ''}}>Is
                                        eligible for paid time off
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="1"
                                               name="exemt_staff" {{$em_setup->exemt_staff == 1 ? 'checked' : ''}}>Exempt
                                        Staff
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="1"
                                               name="gets_paid_holiday" {{$em_setup->gets_paid_holiday == 1 ? 'checked' : ''}}>Gets
                                        paid holidays
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="is_parttime"
                                               value="1" {{$em_setup->is_parttime == 1 ? 'checked' : ''}}>Is Parttime
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="1"
                                               name="is_contractor" {{$em_setup->is_contractor == 1 ? 'checked' : ''}}>Is
                                        Contractor
                                    </label>
                                </div>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="1"
                                               name="provider_render_without" {{$em_setup->provider_render_without == 1 ? 'checked' : ''}}>Prevent
                                        Provider Render Without Notes(for catalyst users)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
