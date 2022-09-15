@extends('layouts.superadmin')
@section('superadmin')
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
                            <a class="active" href="{{route('superadmin.emaployee.department',$employee->id)}}">Department
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
                        {{--                    <li class="nav-item">--}}
                        {{--                        <a class="nav-link" href="staff-activity.html">Staff Activity</a>--}}
                        {{--                    </li>--}}
                    </ul>
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h2 class="common-title">Supervisor</h2>
                    <form action="{{route('superadmin.employee.department.save')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="d-inline-block form-group mr-4">
                            <label>Is this provider a supervisor?</label>
                            <select class="form-control form-control-sm" name="is_supervisor">
                                <option value="0"></option>
                                <option value="1" {{$exist_dep->is_supervisor == 1 ? 'selected' : ''}}>Yes</option>
                                <option value="2" {{$exist_dep->is_supervisor == 2 ? 'selected' : ''}}>No</option>
                            </select>
                            <input type="hidden" name="employee_dep_id" value="{{$exist_dep->employee_id}}">
                        </div>
                        @if($exist_dep->is_supervisor != 1)
                            <div class="d-inline-block form-group">
                                <label>Supervisor</label>
                                <select class="form-control form-control-sm" name="supervisor_id">
                                    <option value="0">Select Supervisor</option>
                                    @foreach($clients as $client)
                                        @if($client->id != $employee->id)
                                            <option value="{{$client->id}}" {{$exist_dep->supervisor_id == $client->id ? 'selected' : ''}}>{{$client->first_name}} {{$client->middle_name}} {{$client->last_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
