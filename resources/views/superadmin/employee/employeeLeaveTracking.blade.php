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
                            <a class="active" href="{{route('superadmin.emaployee.leave.tracking',$employee->id)}}">Leave
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

                    <h2 class="common-title">Leaves</h2>
                    @if (count($employee_leave) <= 0)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <span>No Leaves Found</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered c_table">
                            <thead>
                            <tr>
                                <th>Date of holiday</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employee_leave as $leave)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($leave->holiday_date)->format('m/d/Y')}}</td>
                                    <td>{!! $leave->description !!}</td>
                                    <td><a href="{{route('superadmin.employee.leave.delete',$leave->id)}}"><i
                                                class="ri-delete-bin-line text-danger"></i></a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{$employee_leave->links()}}
                        <div class="overflow-hidden">
                            <button type="button" class="btn btn-sm btn-primary float-left add_holiday">Add Time Off
                            </button>
                        </div>
                        <div class="create_holiday">
                            <hr>
                            <h6>Add Time Off</h6>
                            <form action="{{route('superadmin.employee.leave.save')}}" method="post">
                                @csrf
                                <div class="d-flex">
                                    <div class="mr-3 form-inline">
                                        <label class="mr-2">Date</label>
                                        <input type="date" name="leave_date" class="form-control form-control-sm"
                                               required>
                                        <input type="hidden" name="staff_id" value="{{$employee->id}}"
                                               class="form-control form-control-sm" required>
                                    </div>
                                    <div class="mr-3 form-inline">
                                        <label class="mr-2">Description</label>
                                        <textarea name="description" class="form-control form-control-sm"></textarea>
                                    </div>
                                    <div class="align-self-center">
                                        <button type="submit" class="btn btn-sm btn-primary mr-2">Save</button>
                                        <button type="button" class="btn btn-sm btn-danger cancel_btn">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        jQuery(document).ready(function ($) {
            $('.create_holiday').hide();
            $('.add_holiday').click(function (event) {
                $('.create_holiday').show();
                $('.cancel_btn').click(function (event) {
                    $('.create_holiday').hide();
                });
            });
        });
    </script>
@endsection
