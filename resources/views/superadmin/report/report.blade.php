@extends('layouts.superadmin')
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection
@section('superadmin')
    <div class="iq-card">
        <form action="{{ route('superadmin.report.show') }}" method="post" id="report_form">
            @csrf
            <div class="iq-card-body">
                <div class="row">
                    <div class="col-md-3">
                        <!-- all-report -->
                        <label>All Report</label>

                        <select class="form-control form-control-sm reportFilter" name="report_type">
                            <option value="0"></option>
                            {{--                            <option value="1">Insurance Collection</option>--}}
                            {{--                            <option value="2">Payment Deposits</option>--}}
                            {{--                            <option value="3">Payment Deposit Breakdown</option>--}}
                            {{--                            <option value="4">Billed Sessions</option>--}}
                            {{--                            <option value="5">Sessions Pending Billing</option>--}}
                            {{--                            <option value="6">Max Total Auth Utilization</option>--}}
                            {{--                            <option value="7">Authorization Breakdown</option>--}}
                            {{--                            <option value="8">Provider Session Notes</option>--}}
                            {{--                            <option value="9">Schedule</option>--}}
                            {{--                            <option value="10">Patient Schedule</option>--}}
                            {{--                            <option value="11">Staff Schedule</option>--}}
                            {{--                            <option value="12">Schedule Billable</option>--}}
                            <option value="13">AR Ledger with Balance</option>
                            {{-- <option value="14">Aging by IBD (initial billed date)</option> --}}
                            {{--                            <option value="15">Primary AR</option>--}}
                            {{--                            <option value="16">Payee Rate list</option>--}}
                            {{--                            <option value="17">Patient AR-Ledger w/ Note & Payee</option>--}}
                            {{--                            <option value="18">Expired Auths</option>--}}
                            {{--                            <option value="19">Expiring Auths</option>--}}
                            {{-- <option value="20">Patient Responsibility</option> --}}
                        </select>
                    </div>
                    <div class="mr-2">
                        <label>Date Type</label>
                        <select class="form-control form-control-sm filter-date" name="date_type">
                            <option value="0" selected></option>
                            <option value="1">Specific Date</option>
                            <option value="2">Date Range</option>
                        </select>
                    </div>
                    <div class="mr-2 specific-date">
                        <label>Select Date</label>
                        <input type="date" class="form-control form-control-sm single_date" name="single_date">
                    </div>
                    <div class="mr-2 date-range">
                        <label>Date Range</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input class="form-control form-control-sm reportrange" name="date_range">
                        </div>
                    </div>
                    <div class="col-md-4 align-self-end">
                        <button type="button" class="btn btn-sm btn-primary export_btn" id="getdetailReport">Go
                        </button>
                    </div>
                    <div class="align-self-end ml-auto download_div">
                        <div class="dropdown">
                            <button class="btn btn-sm p-0 dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="ri-download-2-line"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right download-icon-show">
                                <a class="dropdown-item" href="#" id="download_pdf"><i
                                        class="fa fa-file-pdf-o mr-2 text-danger"></i>Download PDF</a>
                                <a class="dropdown-item" href="#" id="download_csv"><i
                                        class="fa fa-file-excel-o mr-2 text-success"></i>Download CSV</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Export Modal -->
                <div class="modal fade" id="exporta" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Export Report</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <h6>Export report with selective fields. Please select some to proceed.</h6>
                                <div class="mb-2">
                                    <div class="form-check">
                                        <div class="exportContent">
                                            <!-- Insurance Collection -->
                                            <div class="fieldIc">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Payorid">Payorid
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Payor Name">Payor Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Billed Amount">Billed
                                                        Amount
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Adjustment">Adjustment
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Allowed Amount">Allowed
                                                        Amount
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Guarantor Paid">Guarantor Paid
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label" for="checkbox">
                                                        <input type="checkbox" class="form-check-input checkbox"
                                                               name="f1_check[]" value="Insurance Paid">Insurance
                                                        Paid
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Secondary Insurance Paid">Secondary
                                                        Insurance
                                                        Paid
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Total Paid">Total Paid
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Patient Responsibility">Patient
                                                        Responsibility
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Insurance Responsibility">Insurance
                                                        Responsibility
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Balance">Balance
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Billed Year">Billed Year
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Billed Month">Billed Month
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Insurance / Billed Amount%">Insurance
                                                        /
                                                        Billed
                                                        Amount%
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f1_check[]" value="Collection">Collection %
                                                    </label>
                                                </div>
                                                <!--/ field -->
                                            </div>
                                            <!-- Payment Deposits -->
                                            <div class="fieldPd">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f2_check[]" value="Payee Name">Payee Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f2_check[]" value="Deposit Date">Deposit Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f2_check[]" value="Check No">Check No
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f2_check[]" value="Check Date">Check Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f2_check[]" value="Check Type">Check Type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f2_check[]" value="Allocated Check Amt.">Allocated
                                                        Check
                                                        Amt.
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f2_check[]" value="Unallocated">Unallocated
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f2_check[]" value="Description">Description
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Payment Deposit Breakdown -->
                                            <div class="fieldPdb">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Deposit Date">Deposit Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Payee Type">Payee Type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Payee Name">Payee Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Check Date">Check Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Check Number">Check Number
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Check Amount">Check Amount
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Allocated Check Amount">Allocated
                                                        Check
                                                        Amount
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Unallocated Amount">Unallocated
                                                        Amount
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Patient Name">Patient Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="DOS">DOS
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Payment Amount">Payment
                                                        Amount
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Region">Region
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Adjustment Amount">Adjustment
                                                        Amount
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Tx Type">Tx Type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f3_check[]" value="Description">Description
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Billed Sessions -->
                                            <div class="fieldBs">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Patient Last name">Patient Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Patient First name">Patient
                                                        First
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Session Rendered Date">Session
                                                        Rendered Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Start Time">Start Time
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="End Time">End
                                                        Time
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Payor Name">Payor Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Activity">Activity
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Description">Description
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Staff last name">Staff last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Staff first name">Staff first
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Render Last name">Render Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Render First name">Render First
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Rendering Provider Degree">Rendering
                                                        Provider
                                                        Degree
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Zone">Zone
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="CPT">CPT
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Modifier">Modifier
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Individual Npi">Individual
                                                        Npi
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="DOB">DOB
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Pos">Pos
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Charge per unit">Charge per
                                                        unit
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Units">Units
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Total">Total
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Original Bill Date Created">Original
                                                        Bill
                                                        Date
                                                        Created
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Resubmitted Date">Resubmitted
                                                        Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Auth Number">Auth
                                                        Number
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Billing Modifier2">Billing
                                                        Modifier2
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Billing Modifier3">Billing
                                                        Modifier3
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Billing Modifier4">Billing
                                                        Modifier4
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Uci">Uci
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f4_check[]" value="Claim#">Claim#
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Sessions Pending Billing -->
                                            <div class="fieldSpb">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Patient Last name">Patient Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Patient First name">Patient
                                                        First
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Payor number">Payor number
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Activity rendered date">Activity
                                                        rendered date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Activity">Activity
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="CPT">CPT
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="M1">M1
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="M2">M2
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Pos">Pos
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Units">Units
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Charge per unit">Charge per
                                                        unit
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Contracted rate">Contracted
                                                        rate
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Billed Rate">Billed Rate
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Total Charge">Total Charge
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="TLast Name">TLast Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="TFirst Name">TFirst Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="TNPI">TNPI
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Hours">Hours
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Auth number">Auth
                                                        number
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Auth start date">Auth
                                                        start date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Auth end date">Auth
                                                        end date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Supervisor Last Name">Supervisor
                                                        Last
                                                        Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Supervisor First Name">Supervisor
                                                        First Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Render Last name">Render Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Render First name">Render First
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Highest Degree">Highest
                                                        Degree
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Start Time">Start Time
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="End Time">End
                                                        Time
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Payor Name">Payor Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Zone">Zone
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="DOB">DOB
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f5_check[]" value="Uci">Uci
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Max Total Auth Utilization -->
                                            <div class="fieldMtau">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="Patient Name">Patient Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="Zone name">Zone
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="Activity Type">Activity Type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="Payor">Payor
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="Supervisor">Supervisor
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="Start date">Start date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="End date">End
                                                        date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="Frequency">Frequency
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="Hours total">Hours total
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="Total Scheduled">Total
                                                        Scheduled
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="Scheduled Units">Scheduled
                                                        Units
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="Total Rendered">Total
                                                        Rendered
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="Rendered Units">Rendered
                                                        Units
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f6_check[]" value="Remaining To Sch">Remaining To
                                                        Sch
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Authorization Breakdown -->
                                            <div class="fieldAb">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Last name">Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="First name">First name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Supervisor last name">Supervisor
                                                        last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Supervisor first name">Supervisor
                                                        first name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Zone">Zone
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="UCI Insurance">UCI
                                                        Insurance
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Vendor">Vendor
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Auth">Auth
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Auth Start">Auth
                                                        Start
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Auth End">Auth
                                                        End
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Payor">Payor
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Activity type">Activity
                                                        type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Sub type">Sub
                                                        type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Activity auth start">Activity
                                                        auth
                                                        start
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Activity auth end">Activity
                                                        auth
                                                        end
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Rate per">Rate
                                                        per
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Mins In Unit">Mins
                                                        In Unit
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Rate">Rate
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Service code">Service code
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Max By">Max
                                                        By
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Freq">Freq
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Value">Value
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Gender">Gender
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Dob">Dob
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Address1">Address1
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Address2">Address2
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="City">City
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="State">State
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Zip">Zip
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Phone1">Phone1
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Phone2">Phone2
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Patient id">Patient id
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Episode id">Episode id
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Auth id">Auth
                                                        id
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Auth details regional id">Auth
                                                        details regional id
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Auth details regional max id">Auth
                                                        details regional max id
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Facility id">Facility id
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Is primaryauth">Is
                                                        primaryauth
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="PlaceHolder">PlaceHolder
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="External Acct Number">External
                                                        Acct
                                                        Number
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Custom1">Custom1
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Service Coordinator">Service
                                                        Coordinator
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Service Sub Code">Service Sub
                                                        Code
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f7_check[]" value="Correspondance email">Correspondance
                                                        email
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Provider Session Notes -->
                                            <div class="fieldPsn">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f8_check[]" value="Patient Last Name">Patient Last
                                                        Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f8_check[]" value="Patient First Name">Patient
                                                        First
                                                        Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f8_check[]" value="Activity Type">Activity
                                                        Type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f8_check[]" value="Subtype">Subtype
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f8_check[]" value="Activity scheduled date">Activity
                                                        scheduled date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f8_check[]" value="Render Date">Render Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f8_check[]" value="Service Type">Service Type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f8_check[]" value="Service Type Code">Service Type
                                                        Code
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f8_check[]" value="Related To Patient">Related To
                                                        Patient
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f8_check[]" value="Has Signature">Has
                                                        Signature
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f8_check[]" value="Activity Status">Activity
                                                        Status
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f8_check[]" value="Hours Rendered">Hours
                                                        Rendered
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Schedule -->
                                            <div class="fieldschedule">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Patient First Name">Patient
                                                        First
                                                        Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Patient Last name">Patient Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Middle name">Middle name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Staff Last name">Staff Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Staff First
                                                            name">Staff First
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Payor">Payor
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Activity type">Activity
                                                        type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Activity Sub Type">Activity Sub
                                                        Type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Schedule Date">Schedule
                                                        Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Render Date">Render Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Render End Date">Render End
                                                        Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Location">Location
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Status">Status
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Duration">Duration
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Zone name">Zone
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Supervisor last name">Supervisor
                                                        last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Supervisor first name">Supervisor
                                                        first name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Created By">Created By
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="f9_check"
                                                               value="Create Date">Create Date
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Patient Schedule -->
                                            <div class="fieldcs">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Patient First Name">Patient
                                                        First
                                                        Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Patient Last name">Patient Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Middle name">Middle name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Staff Last name">Staff Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Staff First name">Staff First
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Payor">Payor
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Activity type">Activity
                                                        type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Activity Sub Type">Activity Sub
                                                        Type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Schedule Date">Schedule
                                                        Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Schedule Date To">Schedule
                                                        Date
                                                        To
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Render Date">Render Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Location">Location
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Status">Status
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Duration">Duration
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Supervisor Last name">Supervisor
                                                        Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f10_check[]" value="Supervisor First name">Supervisor
                                                        First name
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Staff Schedule -->
                                            <div class="fieldss">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Patient First Name">Patient
                                                        First
                                                        Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Patient Last name">Patient Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Middle name">Middle name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Staff Last name">Staff Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Staff First name">Staff First
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Payor">Payor
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Activity type">Activity
                                                        type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Activity Sub Type">Activity Sub
                                                        Type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Schedule Date">Schedule
                                                        Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Render Date">Render Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Location">Location
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Status">Status
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Duration Sch">Duration Sch
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Zone">Zone
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Supervisor Last name">Supervisor
                                                        Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Supervisor First name">Supervisor
                                                        First name
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f11_check[]" value="Create date">Create date
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Schedule Billable -->
                                            <div class="fieldsb">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Patient First Name">Patient
                                                        First
                                                        Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Patient Last name">Patient Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Staff Last name">Staff Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Staff First name">Staff First
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Payor">Payor
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Cpt code">Cpt
                                                        code
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Activity type">Activity
                                                        type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Activity Sub Type">Activity Sub
                                                        Type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Schedule Date">Schedule
                                                        Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Render Date From">Render Date
                                                        From
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Render Date TO">Render Date
                                                        TO
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Duration Render in Hours">Duration
                                                        Render in Hours
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Location">Location
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f12_check[]" value="Status">Status
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- AR Ledger with Balance -->
                                            <div class="fieldalwb">

                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="PATIENT">PATIENT
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="DOB">DOB
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="THERAPIST">THERAPIST
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="SUPERVISOR">SUPERVISOR
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="INSURANCE">INSURANCE
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="MEMBER ID">MEMBER ID
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="DOS">DOS
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="CPT">CPT
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="UNITS">UNITS
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="BILLED DATE">BILLED DATE
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="ALLOWED AMOUNT">ALLOWED AMOUNT
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="INS PAID">INS PAID
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="ADJUSTMENT">ADJUSTMENT
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="PT PAID">PT PAID
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="SEC PAID">SEC PAID
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="CHECK NO">CHECK NO
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="CHECK DATE">CHECK DATE
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="INS BAL">INS BAL
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="TOTAL BAL">TOTAL BAL
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="STATUS">STATUS
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="COPAY">COPAY
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="COINS">COINS
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="DED">DED
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="CLAIM NO">CLAIM NO
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="AGING CATEGORY">AGING CATEGORY
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="AGING NOTES">AGING NOTES
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="AGING WORKED DATE">AGING WORKED
                                                        DATE
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="NEXT FOLLOW UP DATE">NEXT
                                                        FOLLOW UP DATE
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="LOCATION">LOCATION
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="ZONE">ZONE
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="AUTH START DATE">AUTH START
                                                        DATE
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="AUTH END DATE">AUTH END DATE
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f13_check[]" value="AUTH NO">AUTH NO
                                                    </label>
                                                </div>


                                            </div>
                                            <!-- Aging by IBD (initial billed date) -->
                                            <div class="fieldabi">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f14_check[]" value="Last Name">Last
                                                        Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f14_check[]" value="First Name">First Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f14_check[]" value="Payor">Payor
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f14_check[]" value="0 to 30">0 to
                                                        30
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f14_check[]" value="31 to 45">31
                                                        to 45
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f14_check[]" value="46 to 60">46
                                                        to 60
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f14_check[]" value="61 to 90">61
                                                        to 90
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f14_check[]" value="91 to 150">91
                                                        to 150
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f14_check[]" value="OLD">OLD
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f14_check[]" value="Total">Total
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f14_check[]" value="Facility Id">Facility Id
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Primary AR -->
                                            <div class="fieldpar">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="Payor">Payor
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="Patient">Patient
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="DOB">DOB
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="Dx1">Dx1
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="Dx2">Dx2
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="Dx3">Dx3
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="Dx4">Dx4
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="DOS">DOS
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="CPT Code">CPT
                                                        Code
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="Date billed">Date
                                                        billed
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="Claim Number">Claim Number
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="Allowed Amount">Allowed
                                                        Amount
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="Adjustment">Adjustment
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f15_check[]" value="Aging Notes">Aging Notes
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Payee Rate list -->
                                            <div class="fieldprl">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f16_check[]" value="Name">Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f16_check[]" value="Activity Type">Activity
                                                        Type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f16_check[]" value="Sub type">Sub
                                                        type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f16_check[]" value="Service Code">Service Code
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f16_check[]" value="Cpt code">Cpt
                                                        code
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f16_check[]" value="M1">M1
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f16_check[]" value="Rate Per">Rate
                                                        Per
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f16_check[]" value="Mins per unit">Mins
                                                        per unit
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f16_check[]" value="Contracted Rate">Contracted
                                                        Rate
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f16_check[]" value="Billing Rate">Billing Rate
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f16_check[]" value="M2">M2
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f16_check[]" value="M3">M3
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f16_check[]" value="M4">M4
                                                    </label>
                                                </div>

                                            </div>
                                            <!-- Patient AR-Ledger w/ Note & Payee -->
                                            <div class="fieldcarl">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="Patient Name">Patient Name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="Payor">Payor
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="Billed Amount">Billed
                                                        Amount
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="Adjustment">Adjustment
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="Allowed Amount">Allowed
                                                        Amount
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="Guarantor Paid">Guarantor
                                                        Paid
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="Insurance Paid">Insurance
                                                        Paid
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="Secondary Insurance Paid">Secondary
                                                        Insurance
                                                        Paid
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="Total Paid">Total Paid
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="Patient Responsibility">Patient
                                                        Responsibility
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="Insurance Responsibility">Insurance
                                                        Responsibility
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="Balance">Balance
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="AR Note">AR
                                                        Note
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="AR Note Worked Date">AR
                                                        Note Worked Date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f17_check[]" value="AR Note Follow up Date">AR
                                                        Note Follow up Date
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Expired Auths -->
                                            <div class="fieldea">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f18_check[]" value="Patient Lastname">Patient
                                                        Lastname
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f18_check[]" value="Patient Firstname">Patient
                                                        Firstname
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f18_check[]" value="Auth start date">Auth
                                                        start date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f18_check[]" value="Auth end date">Auth
                                                        end date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f18_check[]" value="Is placeholder">Is
                                                        placeholder
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Expiring Auths -->
                                            <div class="fieldexpiringauth">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f19_check[]" value="Patient Lastname">Patient
                                                        Lastname
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f19_check[]" value="Patient Firstname">Patient
                                                        Firstname
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f19_check[]" value="Auth start date">Auth
                                                        start date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f19_check[]" value="Auth end date">Auth
                                                        end date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f19_check[]" value="Is placeholder">Is
                                                        placeholder
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Patient Responsibility -->
                                            <div class="fieldpr">

                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Last name">Last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="First name">First name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Address1">Address1
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="City">City
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="State">State
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Zip">Zip
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Facility address1">Facility
                                                        address1
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Facility city">Facility
                                                        city
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Facility state">Facility
                                                        state
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Facility zip">Facility zip
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Activity rendered date">Activity
                                                        rendered date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Activity type">Activity
                                                        type
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Cpt code billed">Cpt
                                                        code billed
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Units">Units
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Payment amount">Payment
                                                        amount
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Patient payment amount">Patient
                                                        payment amount
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Payor payment amount">Payor
                                                        payment
                                                        amount
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Contractual adjustment">Contractual
                                                        adjustment
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Balance">Balance
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Date of deposit">Date
                                                        of deposit
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Who paid payor">Who
                                                        paid payor
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Staff last name">Staff last
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Staff first name">Staff first
                                                        name
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Description">Description
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Treatment type">Treatment
                                                        type
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Diagnosis">Diagnosis
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="f20_check[]" value="Cpt Description">Cpt
                                                        Description
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary continue_btn">Continue</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row page_container">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        Loaded Pages: <span class="current_page font-weight-bold"></span> / <span class="total_pages font-weight-bold"></span>
                    </div>
                </div>
                <br>

                <!-- Table -->
                <div class="calendar_table session_table">
                    <div class="table-responsive appointement_page">
                        <table class="table table-sm table-bordered c_table ses_table appointment" id="export_table">
                            <thead>
                                <tr>
                        <!--PATIENT,DOB,THERAPIST,SUPERVISOR,INSURANCE,"MEMBER ID",DOS,CPT,UNITS,"BILLED DATE","Billed Amount","ALLOWED AMOUNT","INS PAID",ADJUSTMENT,"PT PAID","SEC PAID","CHECK NO","CHECK DATE","INS BAL","TOTAL BAL",STATUS,COPAY,COINS,DED,"CLAIM NO","AGING CATEGORY","AGING NOTES","AGING WORKED DATE","NEXT FOLLOW UP DATE",LOCATION,ZONE,"AUTH START DATE","AUTH END DATE","AUTH NO"-->
                        <th data-column="1" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">  Patient</div>
                        </th>
                        <th data-column="2" class="bg-info">
                            <div class="font-weight-normal text-nowrap">DOB</div>
                        </th>
                        <th data-column="3" class="bg-info">
                            <div class="font-weight-normal text-nowrap">THERAPIST</div>
                        </th>
                        <th data-column="4" class="bg-info">
                            <div class="font-weight-normal text-nowrap">SUPERVISOR</div>
                        </th>

                        <th data-column="5" class="bg-info">
                            <div class="font-weight-normal text-nowrap">INSURANCE</div>
                        </th>
                        <th data-column="6" class="bg-info " >
                            <div class="font-weight-normal text-nowrap">MEMBER ID</div>
                        </th>
                        <th data-column="7" class="bg-info">
                            <div class="font-weight-normal text-nowrap">DOS</div>
                        </th>
                        <th data-column="8" class="bg-info">
                            <div class="font-weight-normal text-nowrap">CPT</div>
                        </th>
                        <th data-column="9" class="bg-info">
                            <div class="font-weight-normal text-nowrap">UNITS</div>
                        </th>
                        <th data-column="10" class="bg-info">
                            <div class="font-weight-normal text-nowrap">BILLED DATE</div>
                        </th>
                        <th data-column="11" class="bg-info">
                            <div class="font-weight-normal text-nowrap">BILLED AMOUNT</div>
                        </th>
                        <th data-column="12" class="bg-info">
                            <div class="font-weight-normal text-nowrap">ALLOWED AMOUNT</div>
                        </th>
                        <th data-column="13" class="bg-info">
                            <div class="font-weight-normal text-nowrap">INS PAID</div>
                        </th>
                        <th data-column="14" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">ADJUSTMENT</div>
                        </th>
                        <th data-column="15" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">PT PAID</div>
                        </th>
                        <th data-column="17" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">CHECK NO</div>
                        </th>
                        <th data-column="18" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">CHECK DATE</div>
                        </th>

                        <th data-column="20" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">TOTAL BAL</div>
                        </th>
                        <th data-column="21" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">STATUS</div>
                        </th>
                        <th data-column="22" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">COPAY</div>
                        </th>
                        <th data-column="23" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">COINS</div>
                        </th>
                        <th data-column="24" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">DED</div>
                        </th>
                        <th data-column="25" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">CLAIM NO</div>
                        </th>
                        {{-- <th data-column="26" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">AGING CATEGORY</div>
                        </th>
                        <th data-column="27" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">AGING NOTES</div>
                        </th> --}}
                        <th data-column="28" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">AGING WORKED DATE</div>
                        </th>
                        <th data-column="29" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">NEXT FOLLOW UP DATE</div>
                        </th>
                        <th data-column="1" class="bg-info " style="display: none;" data-tableexport-display="always">
                            <div class="font-weight-normal">  Notes</div>
                        </th>
                        <th data-column="30" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">LOCATION</div>
                        </th>
                        <th data-column="30" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">ZONE</div>
                        </th>
                        <th data-column="31" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">AUTH START DATE</div>
                                </th>
                        <th data-column="32" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">AUTH END DATE</div>
                        </th>
                        <th data-column="33" class="bg-info ">
                            <div class="font-weight-normal text-nowrap">AUTH NO</div>
                        </th>
                                </tr>
                            </thead>

                            <tbody class="show_data">

                            </tbody>

                            <tbody class="show_animation">
                                @for ($i = 0; $i < 40; $i++)
                                    <tr data-tableexport-display="none">
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td class="p_th_remove">
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td class="s_th_remove">
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>
                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>

                                        <td>
                                            <div class="comment br animate"></div>
                                        </td>


                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>

                <br>
                <div class="row page_container">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        Loaded Pages: <span class="current_page font-weight-bold"></span> / <span class="total_pages font-weight-bold"></span>
                    </div>
                </div>
                <br>

            </div>

        </form>
    </div>
@endsection
@include('superadmin.report.include.includescript')
