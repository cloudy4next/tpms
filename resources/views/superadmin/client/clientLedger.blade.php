@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <h5 class="mb-2">
                <a href="{{route('superadmin.client.list')}}" title="Back To Client"><i
                        class="ri-arrow-left-circle-line text-primary"></i> </a>
                <a href="{{route('superadmin.client.list')}}"
                   class="cmn_a">{{$client_id->client_first_name}} {{$client_id->client_middle}} {{$client_id->client_last_name}}</a>
                | <small>
                    <span
                        class=" font-weight-bold text-orange">DOB:</span> {{\Carbon\Carbon::parse($client_id->client_dob)->format('m/d/Y')}}
                    |
                    <span class=" font-weight-bold text-orange">Phone:</span> {{$client_id->phone_number}} |
                    <span class=" font-weight-bold text-orange">Address:</span>
                    {{$client_id->client_street}} {{$client_id->client_city}} {{$client_id->client_state}} {{$client_id->client_zip}}


                </small>
            </h5>
            <div class="d-lg-flex">
                <div class="client_menu mr-2">
                    <ul class="nav flex-column setting_menu">
                        <!-- Profile Picture -->
                        <li class="nav-item border-0"><img src="{{asset('assets/dashboard/')}}/images/user/01.jpg"
                                                           class="img-fluid d-block mx-auto" alt=""></li>
                        <li class="nav-item"><a class="nav-link "
                                                href="{{route('superadmin.client.info',$client_id->id)}}">Patient
                                Info</a></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.authorization',$client_id->id)}}">Ins/Authorization</a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.documents',$client_id->id)}}">Documents</a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.portal',$client_id->id)}}">Patient
                                Portal</a></li>
                        <li class="nav-item"><a class="nav-link active"
                                                href="{{route('superadmin.client.ledger',$client_id->id)}}">Patient
                                Ledger</a></li>
                    </ul>
                </div>
                <div class="all_content flex-fill">
                    <h5 class="common-title">Patient Ar Ledger</h5>
                    <!-- filter -->
                    <div class="d-flex">
                        <div class="mr-2 patient">
                            <label>Patient</label>
                            <select class="form-control-sm form-control all_clients">
                                <option value="{{$client_id->id}}">{{$client_id->client_full_name}}</option>
                            </select>
                        </div>
                        <div class="mr-2 daterange">
                            <label>Select Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input class="form-control form-control-sm reportrange">
                            </div>
                        </div>
                        <div class="mr-2 cpt">
                            <label>CPT Codes</label>
                            <select class="form-control-sm form-control cpt_code">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="mr-2 aging">
                            <label>Aging Status</label>
                            <select class="form-control form-control-sm fil_cat_name" style="max-width: 200px;">
                                <option></option>
                                <option value="Corrected Claim">Corrected Claim</option>
                                <option value="COB">COB</option>
                                <option value="NCOF-Re-File">NCOF-Re-File</option>
                                <option value="Appeal">Appeal</option>
                                <option value="Reprocessing">Reprocessing</option>
                                <option value="Medical Records">Medical Records</option>
                                <option value="Payor Escalation">Payor Escalation</option>
                                <option value="Provider Escalation">Provider Escalation</option>
                                <option value="MG Escalations">MG Escalations</option>
                                <option value="Write Off">Write Off</option>
                                <option value="Overpayment">Overpayment</option>
                                <option value="Timely Filing">Timely Filing</option>
                                <option value="Paid to Patient">Paid to Patient</option>
                                <option value="V-Mail/ Follow up">V-Mail/ Follow up</option>
                                <option value="Paid">Paid</option>
                                <option value="In Process">In Process</option>
                                <option value="To call">To call</option>
                                <option value="Authorization - Reprocess">Authorization - Reprocess</option>
                                <option value="Maximum Benefit Reached - Reprocess">Maximum Benefit Reached -
                                    Reprocess
                                </option>
                                <option value="Authorization - Escalation">Authorization - Escalation</option>
                                <option value="Maximum Benefit Reached - Escalation">Maximum Benefit Reached -
                                    Escalation
                                </option>
                                <option value="Need Followup">Need Followup</option>
                                <option value="Appealed">Appealed</option>
                                <option value="Claim sent back for reprocess">Claim sent back for reprocess</option>
                                <option value="Claim submitted">Claim submitted</option>
                                <option value="Claim submitted">Sent to posting team</option>
                                <option value="Rebill claim">Rebill claim</option>
                                <option value="Duplicate - Reprocess">Duplicate - Reprocess</option>
                                <option value="Coverage Terminated - Reprocess">Coverage Terminated - Reprocess</option>
                                <option value="Coverage Terminated - Escalation">Coverage Terminated - Escalation
                                </option>
                                <option value="Set to pay">Set to pay</option>
                                <option value="Lack of information">Lack of information</option>
                                <option value="Predetermination - Reprocess">Predetermination - Reprocess</option>
                                <option value="Predetermination - Escalation">Predetermination - Escalation</option>
                                <option value="Non covered - reprocess">Non covered - reprocess</option>
                                <option value="Non covered - Escalation">Non covered - Escalation</option>
                                <option value="Requested EOB">Requested EOB</option>
                                <option value="Awaiting for EOB">Awaiting for EOB</option>
                                <option value="Patient Inactive - Reprocess">Patient Inactive - Reprocess</option>
                                <option value="Patient Inactive - Escalation">Patient Inactive - Escalation</option>
                                <option value="Copay issue">Copay issue</option>
                                <option value="Out of Network - Reprocess">Out of Network - Reprocess</option>
                                <option value="Out of Network - Escalation">Out of Network - Escalation</option>
                                <option value="Under payment">Under payment</option>
                                <option value="Additional Information - Reprocess">Additional Information - Reprocess
                                </option>
                                <option value="Additional information - escalation">Additional information -
                                    escalation
                                </option>
                                <option value="Medical records - Reprocess">Medical records - Reprocess</option>
                                <option value="Medical records - Escalation">Medical records - Escalation</option>
                                <option value="Invalid/Missing DX - Reprocess">Invalid/Missing DX - Reprocess</option>
                                <option value="Invalid/Missing DX - Escalation">Invalid/Missing DX - Escalation</option>
                                <option value="Invalid/Missing Modifier - Reprocess">Invalid/Missing Modifier -
                                    Reprocess
                                </option>
                                <option value="Invalid/Missing Modifier - Escalation">Invalid/Missing Modifier -
                                    Escalation
                                </option>
                                <option value="Need to Transmit">Need to Transmit</option>
                                <option value="Credentialling issue - Escalation">Credentialling issue - Escalation
                                </option>
                                <option value="Paid not posted - Sent to posting team">Paid not posted - Sent to posting
                                    team
                                </option>
                                <option value="MR submitted">MR submitted</option>
                            </select>
                        </div>
                        <div class="align-self-end mr-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input zero_paid" id="zp" checked>
                                <label class="custom-control-label" for="zp">Zero Paid</label>
                            </div>
                        </div>
                        <div class="align-self-end">
                            <button type="submit" class="btn btn-sm btn-primary view_btn" id="view_btn">View</button>
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
                    <div class="ledger_table mt-3">
                        <div class="table-responsive legder_table_data">

                        </div>
                        <div class="d-flex">
                            <div class="mr-2">
                                <select class="form-control form-control-sm select_btn ledger_transa_status">
                                    <option value="0"></option>
                                    <option value="1">View Transaction</option>
                                    <option value="2">Add Note</option>
                                </select>
                            </div>
                            <div class="align-self-end">
                                <button type="button" class="btn btn-sm btn-primary" id="ok_btn">Ok</button>
                            </div>
                            <div class="align-self-end ml-auto download_div2">
                                <div class="dropdown">
                                    <button class="btn btn-sm p-0 dropdown-toggle" type="button"
                                        data-toggle="dropdown">
                                        <i class="ri-download-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right download-icon-show">
                                        <a class="dropdown-item" href="#" id="download_pdf2"><i class="fa fa-file-pdf-o mr-2 text-danger"></i>Download PDF</a>
                                        <a class="dropdown-item" href="#" id="download_csv2"><i class="fa fa-file-excel-o mr-2 text-success"></i>Download CSV</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add Note -->

                    <!-- view transaction -->
                    <div class="table-responsive mt-2 transaction_table">

                    </div>
                    <!-- add notes -->
                    <div class="add_notes mt-2">
                        <form action="#" id="add_multinote_form">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Aging Category</label>
                                    <select class="form-control form-control-sm category_name">
                                        <option></option>
                                        <option value="Corrected Claim">Corrected Claim</option>
                                        <option value="COB">COB</option>
                                        <option value="NCOF-Re-File">NCOF-Re-File</option>
                                        <option value="Appeal">Appeal</option>
                                        <option value="Reprocessing">Reprocessing</option>
                                        <option value="Medical Records">Medical Records</option>
                                        <option value="Payor Escalation">Payor Escalation</option>
                                        <option value="Provider Escalation">Provider Escalation</option>
                                        <option value="MG Escalations">MG Escalations</option>
                                        <option value="Write Off">Write Off</option>
                                        <option value="Overpayment">Overpayment</option>
                                        <option value="Timely Filing">Timely Filing</option>
                                        <option value="Paid to Patient">Paid to Patient</option>
                                        <option value="V-Mail/ Follow up">V-Mail/ Follow up</option>
                                        <option value="Paid">Paid</option>
                                        <option value="In Process">In Process</option>
                                        <option value="To call">To call</option>
                                        <option value="Authorization - Reprocess">Authorization - Reprocess</option>
                                        <option value="Maximum Benefit Reached - Reprocess">Maximum Benefit Reached -
                                            Reprocess
                                        </option>
                                        <option value="Authorization - Escalation">Authorization - Escalation</option>
                                        <option value="Maximum Benefit Reached - Escalation">Maximum Benefit Reached -
                                            Escalation
                                        </option>
                                        <option value="Need Followup">Need Followup</option>
                                        <option value="Appealed">Appealed</option>
                                        <option value="Claim sent back for reprocess">Claim sent back for reprocess
                                        </option>
                                        <option value="Claim submitted">Claim submitted</option>
                                        <option value="Claim submitted">Sent to posting team</option>
                                        <option value="Rebill claim">Rebill claim</option>
                                        <option value="Duplicate - Reprocess">Duplicate - Reprocess</option>
                                        <option value="Coverage Terminated - Reprocess">Coverage Terminated -
                                            Reprocess
                                        </option>
                                        <option value="Coverage Terminated - Escalation">Coverage Terminated -
                                            Escalation
                                        </option>
                                        <option value="Set to pay">Set to pay</option>
                                        <option value="Lack of information">Lack of information</option>
                                        <option value="Predetermination - Reprocess">Predetermination - Reprocess
                                        </option>
                                        <option value="Predetermination - Escalation">Predetermination - Escalation
                                        </option>
                                        <option value="Non covered - reprocess">Non covered - reprocess</option>
                                        <option value="Non covered - Escalation">Non covered - Escalation</option>
                                        <option value="Requested EOB">Requested EOB</option>
                                        <option value="Awaiting for EOB">Awaiting for EOB</option>
                                        <option value="Patient Inactive - Reprocess">Patient Inactive - Reprocess
                                        </option>
                                        <option value="Patient Inactive - Escalation">Patient Inactive - Escalation
                                        </option>
                                        <option value="Copay issue">Copay issue</option>
                                        <option value="Out of Network - Reprocess">Out of Network - Reprocess</option>
                                        <option value="Out of Network - Escalation">Out of Network - Escalation</option>
                                        <option value="Under payment">Under payment</option>
                                        <option value="Additional Information - Reprocess">Additional Information -
                                            Reprocess
                                        </option>
                                        <option value="Additional information - escalation">Additional information -
                                            escalation
                                        </option>
                                        <option value="Medical records - Reprocess">Medical records - Reprocess</option>
                                        <option value="Medical records - Escalation">Medical records - Escalation
                                        </option>
                                        <option value="Invalid/Missing DX - Reprocess">Invalid/Missing DX - Reprocess
                                        </option>
                                        <option value="Invalid/Missing DX - Escalation">Invalid/Missing DX -
                                            Escalation
                                        </option>
                                        <option value="Invalid/Missing Modifier - Reprocess">Invalid/Missing Modifier -
                                            Reprocess
                                        </option>
                                        <option value="Invalid/Missing Modifier - Escalation">Invalid/Missing Modifier -
                                            Escalation
                                        </option>
                                        <option value="Need to Transmit">Need to Transmit</option>
                                        <option value="Credentialling issue - Escalation">Credentialling issue -
                                            Escalation
                                        </option>
                                        <option value="Paid not posted - Sent to posting team">Paid not posted - Sent to
                                            posting team
                                        </option>
                                        <option value="MR submitted">MR submitted</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Worked Date</label>
                                    <input type="date" class="form-control form-control-sm worked_date">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Follow Up Date</label>
                                    <input type="date" class="form-control form-control-sm folowup_date">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Notes</label>
                                    <textarea class="form-control form-control-sm notes"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2" id="multi_note_save">Save
                                    </button>
                                    <button type="button" class="btn btn-danger"
                                            onClick="window.location.reload();">Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('superadmin.client.include.clientLedgerInc')
