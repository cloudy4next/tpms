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
                                         alt="profile-pic" style="height: 100%">
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
                            <a class="nav-link active" href="{{route('provider.credentials')}}">Credentials /
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
                    <h2 class="common-title">Credentials</h2>
                    <div class="accordion" id="accordion">
                        <!-- Credentials -->
                        <div class="accordion-item mb-3 mt-2">
                            <a href="#divCredentials" class="btn btn-primary text-left btn-block w-100"
                               data-toggle="collapse">Credentials</a>
                            <div class="collapse show border px-3 py-2" id="divCredentials" data-parent="#accordion">
                                @if(count($cred_lists) <= 0)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <span>No Credential Records</span>
                                        <button type="button" class="close text-dark" data-dismiss="alert"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table-bordered table-sm table c_table">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Credential Type</th>
                                                <th>Date Issue</th>
                                                <th>Date Expire</th>
                                                <th>File</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($cred_lists as $credlist)
                                                <tr>
                                                    <td>{{$employee->full_name}}</td>
                                                    <td>{{$credlist->credential_name}}</td>
                                                    <td>{{\Carbon\Carbon::parse($credlist->credential_date_issue)->format('m/d/Y')}}</td>
                                                    <td>{{\Carbon\Carbon::parse($credlist->credential_date_expired)->format('m/d/Y')}}</td>
                                                    <td>
                                                        <ul class="list-inline">
                                                            @if(file_exists($credlist->credential_file) || !empty($credlist->credential_file))
                                                                <li class="list-inline-item">
                                                                    <a href="{{asset($credlist->credential_file)}}"
                                                                       target="_blank"
                                                                       title="View"><i
                                                                            class="ri-eye-line"></i></a>
                                                                </li>
                                                            @endif
                                                            <li class="list-inline-item">
                                                                <a href="#credential_modal{{$credlist->id}}"
                                                                   data-toggle="modal"><i class="las la-edit"
                                                                                          title="Edit"></i></a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a href="{{route('provider.credentials.delete',$credlist->id)}}"
                                                                   title="Delete"><i
                                                                        class="ri-delete-bin-6-line text-danger"></i></a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <!-- Credential Modal -->
                                                <div class="modal fade" id="credential_modal{{$credlist->id}}"
                                                     data-backdrop="static">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4>Edit Credential</h4>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="{{route('provider.credentials.update')}}"
                                                                method="post" autocomplete="off"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="cred_id"
                                                                       value="{{$credlist->id}}">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>Credential</label>
                                                                            <input type="text"
                                                                                   class="form-control-sm form-control"
                                                                                   value="{{$credlist->credential_name}}"
                                                                                   required name="cred_type">
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>Date Issue</label>
                                                                            <input type="date"
                                                                                   class="form-control-sm form-control"
                                                                                   value="{{$credlist->credential_date_issue}}"
                                                                                   required name="date_issue">
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>Date Expired</label>
                                                                            <input type="date"
                                                                                   class="form-control-sm form-control"
                                                                                   value="{{$credlist->credential_date_expired}}"
                                                                                   required name="date_expire">
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>File Name</label>
                                                                            <input type="file" class="form-control-file"
                                                                                   name="cred_file">
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <div class="form-check form-group">
                                                                                <label class="form-check-label">
                                                                                    <input type="checkbox"
                                                                                           class="form-check-input"
                                                                                           value="1"
                                                                                           name="cred_apply" {{$credlist->credential_applicable=="1"?"checked":''}}>Credential
                                                                                    Not Applicable
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                <a class="btn btn-sm btn-primary mb-2" href="#credential_add" data-toggle="modal">Add
                                    Credential</a>
                            </div>
                        </div>
                        <!-- Clearance -->
                        <div class="accordion-item mb-3">
                            <a href="#divClearance" class="btn btn-primary text-left btn-block w-100"
                               data-toggle="collapse">Clearance</a>
                            <div id="divClearance" class="collapse border px-3 py-2" data-parent="#accordion">
                                @if(count($clen_lists) <= 0)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <span>No Clearance Records</span>
                                        <button type="button" class="close text-dark" data-dismiss="alert"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table-bordered table-sm table c_table">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Credential Type</th>
                                                <th>Date Issue</th>
                                                <th>Date Expire</th>
                                                <th>File</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($clen_lists as $cellist)
                                                <tr>
                                                    <td>{{$employee->full_name}}</td>
                                                    <td>{{$cellist->clearance_name}}</td>
                                                    <td>{{\Carbon\Carbon::parse($cellist->clearance_date_issue)->format('m/d/Y')}}</td>
                                                    <td>{{\Carbon\Carbon::parse($cellist->clearance_date_exp)->format('m/d/Y')}}</td>
                                                    <td>
                                                        <ul class="list-inline">
                                                            @if(file_exists($cellist->clearance_file) || !empty($cellist->clearance_file))
                                                                <li class="list-inline-item">
                                                                    <a href="{{asset($cellist->clearance_file)}}"
                                                                       target="_blank"
                                                                       title="View"><i class="ri-eye-line"></i></a>
                                                                </li>
                                                            @endif
                                                            <li class="list-inline-item">
                                                                <a href="#clearance_modal{{$cellist->id}}"
                                                                   data-toggle="modal"><i class="las la-edit"
                                                                                          title="Edit"></i></a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a href="{{route('provider.clearance.delete',$cellist->id)}}"
                                                                   title="Delete"><i
                                                                        class="ri-delete-bin-6-line text-danger"></i></a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>


                                                <!-- Clearance Modal -->
                                                <div class="modal fade" id="clearance_modal{{$cellist->id}}"
                                                     data-backdrop="static">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4>Edit Clearances</h4>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="{{route('provider.clearance.update')}}"
                                                                method="post" autocomplete="off"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="clear_id"
                                                                       value="{{$cellist->id}}">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>Clearance</label>
                                                                            <input type="text"
                                                                                   class="form-control-sm form-control"
                                                                                   value="{{$cellist->clearance_name}}"
                                                                                   required name="clear_type">
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>Date Issue</label>
                                                                            <input type="date"
                                                                                   class="form-control-sm form-control"
                                                                                   value="{{$cellist->clearance_date_issue}}"
                                                                                   required name="date_issue">
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>Date Expired</label>
                                                                            <input type="date"
                                                                                   class="form-control-sm form-control"
                                                                                   value="{{$cellist->clearance_date_exp}}"
                                                                                   required name="date_expire">
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>File Name</label>
                                                                            <input type="file" class="form-control-file"
                                                                                   name="clear_file">
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <div class="form-check form-group">
                                                                                <label class="form-check-label">
                                                                                    <input type="checkbox"
                                                                                           class="form-check-input"
                                                                                           value="1"
                                                                                           name="clear_apply" {{$cellist->clearance_applicable=="1"?"checked":''}}>Credential
                                                                                    Not Applicable
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                <a class="btn btn-sm btn-primary mb-3" href="#clearance_add" data-toggle="modal">Add
                                    Clearance</a>
                            </div>
                        </div>
                        <!-- Qualification -->
                        <div class="accordion-item mb-3">
                            <a href="#divQualification" class="btn btn-primary text-left btn-block w-100"
                               data-toggle="collapse">Qualification</a>
                            <div id="divQualification" class="collapse border px-3 py-2" data-parent="#accordion">
                                @if(count($qua_lists) <= 0)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <span>No Qualification Records</span>
                                        <button type="button" class="close text-dark" data-dismiss="alert"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table-bordered table-sm table c_table">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Credential Type</th>
                                                <th>Date Issue</th>
                                                <th>Date Expire</th>
                                                <th>File</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($qua_lists as $qualist)
                                                <tr>
                                                    <td>{{$employee->full_name}}</td>
                                                    <td>{{$qualist->qualification_name}}</td>
                                                    <td>{{\Carbon\Carbon::parse($qualist->qualification_date_issue)->format('m/d/Y')}}</td>
                                                    <td>{{\Carbon\Carbon::parse($qualist->qualification_date_exp)->format('m/d/Y')}}</td>
                                                    <td>
                                                        <ul class="list-inline">
                                                            @if(file_exists($qualist->qualification_file) || !empty($qualist->qualification_file))
                                                                <li class="list-inline-item">
                                                                    <a href="{{asset($qualist->qualification_file)}}"
                                                                       target="_blank" title="View"><i
                                                                            class="ri-eye-line"></i></a>
                                                                </li>
                                                            @endif
                                                            <li class="list-inline-item">
                                                                <a href="#qual_modal{{$qualist->id}}"
                                                                   data-toggle="modal"><i class="las la-edit"
                                                                                          title="Edit"></i></a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a href="{{route('provider.qualification.delete',$qualist->id)}}"
                                                                   title="Delete"><i
                                                                        class="ri-delete-bin-6-line text-danger"></i></a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <!-- Qualification Modal -->
                                                <div class="modal fade" id="qual_modal{{$qualist->id}}"
                                                     data-backdrop="static">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4>Edit Qualification</h4>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="{{route('provider.qualification.update')}}"
                                                                method="post" autocomplete="off">
                                                                @csrf
                                                                <input type="hidden" name="qual_id"
                                                                       value="{{$qualist->id}}">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>Qualification</label>
                                                                            <input type="text"
                                                                                   class="form-control-sm form-control"
                                                                                   value="{{$qualist->qualification_name}}"
                                                                                   required name="qual_type">
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>Date Issue</label>
                                                                            <input type="date"
                                                                                   class="form-control-sm form-control"
                                                                                   value="{{$qualist->qualification_date_issue}}"
                                                                                   required name="date_issue">
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>Date Expired</label>
                                                                            <input type="date"
                                                                                   class="form-control-sm form-control"
                                                                                   value="{{$qualist->qualification_date_exp}}"
                                                                                   required name="date_expire">
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>File Name</label>
                                                                            <input type="file" class="form-control-file"
                                                                                   name="qual_file">
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <div class="form-check form-group">
                                                                                <label class="form-check-label">
                                                                                    <input type="checkbox"
                                                                                           class="form-check-input"
                                                                                           value="1"
                                                                                           name="clear_apply" {{$qualist->qualification_applicable=="1"?"checked":''}}>Credential
                                                                                    Not Applicable
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>



                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                <a class="btn btn-sm btn-primary mb-3" href="#qual_add" data-toggle="modal">Add
                                    Qualification</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Credential Modal -->
    <div class="modal fade" id="credential_add" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Add Credential</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('provider.credentials.save')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Credential</label>
                                <input type="text" class="form-control-sm form-control" name="cred_type"
                                >
                                <input type="hidden" class="form-control-sm form-control" name="employee_id"
                                       value="{{$employee->id}}">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Date Issue</label>
                                <input type="date" class="form-control-sm form-control" required name="date_issue">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Date Expired</label>
                                <input type="date" class="form-control-sm form-control" required name="date_expire">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>File Name</label>
                                <input type="file" class="form-control-file" name="cred_file">
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-check form-group">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="1"
                                               name="cred_apply">Credential Not Applicable
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Clearance Modal -->
    <div class="modal fade" id="clearance_add" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Add Clearance</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('provider.clearance.save')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Clearance</label>

                                <input type="text" class="form-control-sm form-control" name="clear_type"
                                >
                                <input type="hidden" class="form-control-sm form-control" name="employee_id"
                                       value="{{$employee->id}}">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Date Issue</label>
                                <input type="date" class="form-control-sm form-control" required name="date_issue">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Date Expired</label>
                                <input type="date" class="form-control-sm form-control" required name="date_expire">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>File Name</label>
                                <input type="file" class="form-control-file" name="clear_file">
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-check form-group">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="1"
                                               name="clear_apply">Credential Not Applicable
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Qualification Modal -->
    <div class="modal fade" id="qual_add" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Add Qualification</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('provider.qualification.save')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Clearance</label>

                                <input type="text" class="form-control-sm form-control" name="qual_type"
                                >
                                <input type="hidden" class="form-control-sm form-control" name="employee_id"
                                       value="{{$employee->id}}">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Date Issue</label>
                                <input type="date" class="form-control-sm form-control" required name="date_issue">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Date Expired</label>
                                <input type="date" class="form-control-sm form-control" required name="date_expire">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>File Name</label>
                                <input type="file" class="form-control-file" name="qualification_file">
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-check form-group">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="1"
                                               name="qual_apply">Credential Not Applicable
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
