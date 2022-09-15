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
                        {{--                            <a class="nav-link " href="{{route('provider.department')}}">Department Supervisor(s)</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link active" href="{{route('provider.payroll')}}">Payroll Setup</a>--}}
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
                    <div class="overflow-hidden mb-3">
                        <div class="float-left">
                            <h2 class="common-title">Payroll Setup</h2>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#addPayroll"><i class="las la-plus mr-1" aria-hidden="true"></i>Add
                                Payroll
                            </button>
                        </div>
                    </div>
                    <table class="table table-sm table-bordered c_table">
                        <thead>
                        <tr>
                            <th>Select</th>
                            <th>Service</th>
                            <th>Hourly Rate</th>
                            <th>Milage Rate</th>
                            <th>Billable</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($em_payrols as $em_pay)
                            <?php
                            $ser = \App\Models\all_sub_activity::select('sub_activity')
                                ->where('id', $em_pay->activity)->first();
                            ?>
                            <tr>
                                <td>
                                    <input type="checkbox">
                                    <label></label>
                                </td>
                                <td>
                                    @if ($ser)
                                        {{$ser->sub_activity}}
                                    @endif
                                </td>
                                <td>{{$em_pay->hourly_rate}}/hr</td>
                                <td>{{$em_pay->milage_rate}} cents/mile</td>
                                <td>Yes</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$em_payrols->links()}}
                    <div class="d-inline-block form-group">
                        <i class="las la-share icon"></i>
                        <button type="button" class="btn btn-sm btn-primary mr-2">Select All</button>
                        <button type="button" class="btn btn-sm btn-primary mr-2">Unselect All</button>
                        <div class="d-inline-block form-group">
                            <select class="form-control form-control-sm">
                                <option value="0"></option>
                                <option value="3">Update Hourly &amp; Mileage Rate</option>
                                <option value="1">Update Hourly Rate</option>
                                <option value="2">Update Mileage Rate</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addPayroll">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Payroll</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('provider.payroll.save')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <h6><b>Payroll</b></h6>
                        <p>The staff rates need to be setup before they can be scheduled for plan of care</p>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Service</label>
                                <select class="form-control form-control-sm" name="activity">
                                    @foreach($all_sub_act as $act)
                                        <option value="{{$act->id}}">{{$act->sub_activity}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Hourly Rate</label>
                                <input type="text" class="form-control form-control-sm" name="hourly_rate">
                                <input type="hidden" class="form-control form-control-sm" name="employee_paroll_id"
                                       value="{{$employee->id}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Milage Rate (cents/mile)</label>
                                <input type="text" class="form-control form-control-sm" name="milage_rate">
                            </div>
                            <div class="col-md-12 form-group align-self-end">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="1"
                                               name="apply_all_activity">Apply to All Service
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
