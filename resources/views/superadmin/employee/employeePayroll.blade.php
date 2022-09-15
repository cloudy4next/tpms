@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
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
                            <a class="active" href="{{route('superadmin.emaployee.payroll',$employee->id)}}">Payroll
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
                            <th class="checkbox"><input type="checkbox" class="check_all"></th>
                            <th>Service</th>
                            <th>Hourly Rate</th>
                            <th>Milage Rate</th>
                            <th>Billable</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($em_payrols as $em_pay)
                            <?php
                            $ser = \App\Models\setting_service::where('id', $em_pay->service_id)->first();
                            ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="in_check" id="{{$em_pay->id}}">
                                    <label></label>
                                </td>
                                <td>
                                    @if ($ser)
                                        <?php
                                        $tret_name = \App\Models\Treatment_facility::where('id', $ser->facility_treatment_id)->first();
                                        ?>
                                        {{$ser->description}} ({{$tret_name->treatment_name}})
                                    @endif
                                </td>
                                <td>{{$em_pay->hourly_rate}}/hr</td>
                                <td>{{$em_pay->milage_rate}} cents/mile</td>
                                <td>Yes</td>
                                <td>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="#editPayroll{{$em_pay->id}}" data-toggle="modal" title="Edit"><i
                                                    class="ri-edit-box-line"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{route('superadmin.emaployee.payroll.delete',$em_pay->id)}}"
                                               title="Delete"><i
                                                    class="ri-delete-bin-line text-danger px-2"></i></a>
                                        </li>
                                    </ul>
                                    <div class="modal fade" id="editPayroll{{$em_pay->id}}" data-backdrop="static">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4>Edit Payroll</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                                <form action="{{route('superadmin.emaployee.payroll.edit')}}"
                                                      method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <label>Service</label>
                                                                <select class="form-control form-control-sm"
                                                                        name="service_id">
                                                                    <option
                                                                        value="0" {{$em_pay->service_id==0? "selected":""}}></option>
                                                                    @foreach($all_service as $serv)
                                                                        <?php
                                                                        $tret_name_two = \App\Models\Treatment_facility::where('id', $serv->facility_treatment_id)->first();
                                                                        ?>
                                                                        <option
                                                                            value="{{$serv->id}}" {{$em_pay->service_id==$serv->id? "selected":""}}>{{$serv->description}}
                                                                            ({{$tret_name_two->treatment_name}})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <label>Hourly Rate</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       value="{{$em_pay->hourly_rate}}" name="hourly">
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <label>Milage Rate (cents/mile)</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       value="{{$em_pay->milage_rate}}" name="milage">
                                                            </div>
                                                            <input type="hidden" value="{{$em_pay->id}}"
                                                                   name="edit_id">
                                                            <input type="hidden"
                                                                   value="{{$em_pay->employee_id}}"
                                                                   name="employee_id">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                        <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br>
                    {{$em_payrols->links()}}
                    <br>
                    <form action="{{route('superadmin.emaployee.payroll.edit.bulk')}}" method="POST" id="bulk_form">
                        <div class="d-flex mb-2">
                            @csrf
                            <div class="align-self-end mr-2">
                                <select class="form-control form-control-sm select_filter">
                                    <option value="0"></option>
                                    <option value="1">Update Hourly &amp; Mileage Rate</option>
                                    <option value="2">Update Hourly Rate</option>
                                    <option value="3">Update Mileage Rate</option>
                                </select>
                            </div>
                            <div class="align-self-end mr-2 hrate">
                                <input type="text" class="form-control form-control-sm hourly_bulk"
                                       placeholder="Hourly Rate" name="hourly_bulk">
                            </div>
                            <div class="align-self-end mr-2 mrate">
                                <input type="text" class="form-control form-control-sm mileage_bulk"
                                       placeholder="Milege Rate" name="mileage_bulk">
                                <input type="hidden" class="custom_check" value="" name="check">
                                <input type="hidden" class="edit_ids" name="edit_ids">
                            </div>
                            <div class="align-self-end mr-2 update_div">
                                <button type="submit" class="btn btn-primary" id="update_btn">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addPayroll">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Add Payroll</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('superadmin.emaployee.payroll.save')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <h6><b>Payroll</b></h6>
                        <p>The staff rates need to be setup before they can be scheduled for plan of care</p>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Service</label>
                                {{--                                <select class="form-control form-control-sm" name="service_id">--}}
                                {{--                                    @foreach($all_service as $serv)--}}
                                {{--                                        <?php--}}
                                {{--                                        $tret_name_one = \App\Models\Treatment_facility::where('id', $serv->facility_treatment_id)->first();--}}
                                {{--                                        ?>--}}
                                {{--                                        <option value="{{$serv->id}}">{{$serv->description}}--}}
                                {{--                                            ({{$tret_name_one->treatment_name}})--}}
                                {{--                                        </option>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </select>--}}


                                <select class="form-control form-control-sm all_service multiselect" id="all_service"
                                        name="service_id" multiple required>
                                    @foreach($all_service as $serv)
                                        <?php
                                        $tret_name_one = \App\Models\Treatment_facility::where('id', $serv->facility_treatment_id)->first();
                                        ?>
                                        <option value="{{$serv->id}}">{{$serv->description}}
                                            ({{$tret_name_one->treatment_name}})
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-6 form-group">
                                <label>Hourly Rate</label>
                                <input type="text" class="form-control hourly_rate form-control-sm" name="hourly_rate">
                                <input type="hidden" class="form-control employee_paroll_id form-control-sm"
                                       name="employee_paroll_id"
                                       value="{{$employee->id}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Milage Rate (cents/mile)</label>
                                <input type="text" class="form-control milage_rate form-control-sm" name="milage_rate">
                            </div>
                            {{--                            <div class="col-md-12 form-group align-self-end">--}}
                            {{--                                <div class="form-check">--}}
                            {{--                                    <label class="form-check-label">--}}
                            {{--                                        <input type="checkbox" class="form-check-input apply_all_activity apply_all"--}}
                            {{--                                               value="1"--}}
                            {{--                                               name="apply_all_activity">Apply to All Service--}}
                            {{--                                    </label>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="save_new" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


@include('superadmin.employee.include.employeePayroll_include');
