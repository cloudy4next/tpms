@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <h2 class="common-title">Payroll</h2>
            <ul class="nav nav-tabs mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('superadmin.process.payroll')}}">Processing Payroll<span class="badge badge-warning ml-2">Step - 1</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('superadmin.submit.payroll')}}">Payroll Submission<span class="badge badge-warning ml-2">Step - 2</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('superadmin.completed.payroll')}}">Processed Payroll<span class="badge badge-warning ml-2">Step - 3</span></a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- filter -->
                <div class="d-flex my-3">
                    <div class="mr-3 choose-payroll">
                        <label>Choose Payroll Submission Period</label>
                        <select class="form-control form-control-sm payroll_time">

                        </select>
                    </div>
                    {{-- <div class="mr-3 align-self-end payroll-checkbox">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="payroll">Detailed
                            </label>
                        </div>
                    </div>
                    <div class="mr-3 align-self-end payroll-checkbox">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="payroll">Consolidated
                            </label>
                        </div>
                    </div> --}}
                    {{-- <div class="mr-3 align-self-end payroll-btn">
                        <button type="button" class="btn btn-sm btn-danger"
                                onclick="window.location.reload();">Cancel
                        </button>
                    </div> --}}
                    <div class="align-self-center mt-auto ml-auto download_div">
                        <div class="dropdown">
                            <button class="btn btn-sm p-0 dropdown-toggle" type="button"
                                data-toggle="dropdown">
                                <i class="ri-download-2-line"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right download-icon-show">
                                <a class="dropdown-item" href="#" id="download_csv"><i class="fa fa-file-excel-o mr-2 text-success"></i>Download CSV</a>
                                <a class="dropdown-item" href="#" id="download_pdf"><i class="fa fa-file-pdf-o mr-2 text-danger"></i>Download PDF</a>
                                <a class="dropdown-item" href="#" id="download_excel"><i class="fa fa-file-excel-o mr-2 text-success"></i>Download Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- table -->
                <div class="payroll-table">
                    <div class="table-responsive payroll_submit_list payroll_submission payrol_submission">

                    </div>
                    <!-- action -->
                    <div class="d-flex actiondiv">
                        <div class="mr-3">
                            <select class="form-control form-control-sm process_action">
                                <option value="0">Select Any</option>
                                <option value="1">Complete and Paid</option>
                                <option value="2">Pending</option>
                            </select>
                        </div>
                        <div class="mr-3 align-self-end">
                            <button type="button" class="btn btn-sm btn-primary" id="ok_btn">OK</button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
@include('superadmin.payroll.include.submitTimeInc')
