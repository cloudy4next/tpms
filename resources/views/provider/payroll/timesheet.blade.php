@extends('layouts.provider')
@section('provider')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <h2 class="common-title">Timesheet(s) Submission</h2>
            <!-- filter -->
            <div class="d-flex mb-4">
                <div class="mr-3 choose-payroll">
                    <label>Choose Payroll Period</label>
                    <select class="form-control form-control-sm payroll_time">

                    </select>
                </div>
                <div class="mr-3 choose-status">
                    <label>Status</label>
                    <select class="form-control form-control-sm status_select">
                        <option value="0"></option>
                        <option value="1">Submitted</option>
                        <option value="2">Not Submitted</option>
                    </select>
                </div>
                <div class="mr-3 align-self-end choose-list">
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <button type="button"
                                    class="btn btn-sm btn-primary day">Go
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="align-self-end ml-auto download_div">
                    <div class="dropdown">
                        <button class="btn btn-sm p-0 dropdown-toggle" type="button"
                                data-toggle="dropdown">
                            <i class="ri-download-2-line"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right download-icon-show">
                            <a class="dropdown-item" href="#" id="download_pdf"><i class="fa fa-file-pdf-o mr-2 text-danger"></i>Download PDF</a>   
                            <a class="dropdown-item" href="#" id="download_csv"><i class="fa fa-file-excel-o mr-2 text-success"></i>Download CSV</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Day Table -->
            <div class="day-wrapper">
                <ul class="list-inline day-list mb-2">
                    <li class="list-inline-item">
                        <a href="#" class="btn btn-sm btn-primary-outline dayname" data-id="Monday">Monday</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="btn btn-sm btn-primary-outline dayname" data-id="Tuesday">Tuesday</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="btn btn-sm btn-primary-outline dayname" data-id="Wednesday">Wednesday</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="btn btn-sm btn-primary-outline dayname" data-id="Thursday">Thursday</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="btn btn-sm btn-primary-outline dayname" data-id="Friday">Friday</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="btn btn-sm btn-primary-outline dayname" data-id="Saturday">Saturday</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="btn btn-sm btn-primary-outline dayname" data-id="Sunday">Sunday</a>
                    </li>
                </ul>
                <div class="day-table">
                    <div class="table-responsive timesheettbl">


                    </div>
                </div>
                <div class="d-flex actiondiv">
                    <div class="mr-3">
                        <select class="form-control form-control-sm timesheet_action">
                            <option value="">Select Any Action</option>
                            <option value="1">Save Changes</option>
                            <option value="3">Submit Timesheet</option>
                        </select>
                    </div>
                    <div class="mr-3 align-self-end">
                        <button type="button" class="btn btn-sm btn-primary" id="save_btn">OK</button>
                    </div>
                </div>
                <!-- modal -->
                <div class="modal fade" id="addday" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Add</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form action="#">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label>Activity</label>
                                            <select class="form-control form-control-sm" required>
                                                <option>Regular Time</option>
                                                <option>Training & Admin</option>
                                                <option>Fill-In</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>From</label>
                                            <div class="row no-gutters">
                                                <div class="col-md">
                                                    <input type="text" class="form-control form-control-sm"
                                                           placeholder="hh" required>
                                                </div>
                                                <div class="col-md">
                                                    <input type="text" class="form-control form-control-sm"
                                                           placeholder="mm" required>
                                                </div>
                                                <div class="col-md">
                                                    <select class="form-control form-control-sm" required>
                                                        <option>AM</option>
                                                        <option>PM</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>To</label>
                                            <div class="row no-gutters">
                                                <div class="col-md">
                                                    <input type="text" class="form-control form-control-sm"
                                                           placeholder="hh" required>
                                                </div>
                                                <div class="col-md">
                                                    <input type="text" class="form-control form-control-sm"
                                                           placeholder="mm" required>
                                                </div>
                                                <div class="col-md">
                                                    <select class="form-control form-control-sm" required>
                                                        <option>AM</option>
                                                        <option>PM</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Miles</label>
                                            <input type="text" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--/ modal -->
            </div>
            {{-- <!-- week table -->
            <div class="week-table table-responsive">
                <table class="table table-sm table-bordered c_table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Hours Billable</th>
                        <th>Mileage</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- pay period table -->
            <div class="pay-period-table table-responsive">
                <table class="table table-sm table-bordered c_table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Patient</th>
                        <th>Service</th>
                        <th>Check In</th>
                        <th>Check out</th>
                        <th>Hours</th>
                        <th>Accepted Hrs</th>
                        <th>Mileage</th>
                        <th>Accepted Mileage</th>
                        <th>Submission Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- week table --> --}}
        </div>
    </div>


<div class="modal fade" id="view_sig" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Signature</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="tab-pane fade show active" id="sig_box">
                    <div class="show-sig">
                        <img src="" alt="Signature" class="img-fluid" id="sig_img">
                        <p class="mt-2" id="sig_date"></p>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





@endsection
@include('provider.payroll.include.timesheetinc')
