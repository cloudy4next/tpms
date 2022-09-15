@extends('layouts.client')
@section('client')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <h5 class="mb-2">
                <a href="{{route('client.myinfo')}}" title="Back To Client"><i
                        class="ri-arrow-left-circle-line text-primary"></i> </a>
                <a href="{{route('client.myinfo')}}"
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
                                                href="{{route('client.myinfo')}}">Patient
                                Info</a></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('client.myauthorization')}}">Ins/Authorization</a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('client.mydocuments')}}">Documents</a>
                        </li>
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
                        </div>
                    </div>
                    <!-- Add Note -->

                    <!-- view transaction -->
                    <div class="table-responsive mt-2 transaction_table">

                    </div>
                    <!-- add notes -->
                    <div class="add_notes mt-2">
                        <form action="#">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Aging Category</label>
                                    <select class="form-control form-control-sm category_name">
                                        <option></option>
                                        <option value="1">ADD INFO FROM PROVIDER</option>
                                        <option value="2">ADD INFO FROM PATIENT</option>
                                        <option value="3">OUT OF NETWORK PROVIDER</option>
                                        <option value="4">PASSED TFL_NO PROOF</option>
                                        <option value="5">ADJUST</option>
                                        <option value="6">ADJUSTED</option>
                                        <option value="7">APP TO DEDUCTIBLE</option>
                                        <option value="8">APPEAL</option>
                                        <option value="9">APPEAL_TFL</option>
                                        <option value="10">BILL PATIENT</option>
                                        <option value="11">BUNDLED / INCLUSIVE</option>
                                        <option value="12">CAPITATION</option>
                                        <option value="13">COB_ISSUE</option>
                                        <option value="14">CODING MODIFIER</option>
                                        <option value="15">CODING POS</option>
                                        <option value="16">CODING_PROCEDURE</option>
                                        <option value="17">DUPLICATE</option>
                                        <option value="18">INVALID INS INFO</option>
                                        <option value="19">INS NEED MEDICAL RECORDS</option>
                                        <option value="20">MAX BENEFITS EXHAUSTED</option>
                                        <option value="21">MISC</option>
                                        <option value="22">NO AUTH / REFERAL</option>
                                        <option value="23">NO COVERAGE ON DOS</option>
                                        <option value="24">NO NEED TO CALL</option>
                                        <option value="25">NON COVERED</option>
                                        <option value="26">PAID</option>
                                        <option value="27">PATIENT NOT ON FILE</option>
                                        <option value="28">PRE-EXISTING CONDTION</option>
                                        <option value="29">PROVIDER ENROLL</option>
                                        <option value="30">PROVIDER ISSUE</option>
                                        <option value="31">PURGED CLAIMS</option>
                                        <option value="32">REBILL DIFF INS</option>
                                        <option value="33">PAID_INCORR ADDRESS</option>
                                        <option value="34">REFILE - FOLLOW UP</option>
                                        <option value="35">REFILE CORR CLM- FOLLOW UP</option>
                                        <option value="36">REFILE_ PRIMARY EOB</option>
                                        <option value="37">REBILL DIFF INS_TFL</option>
                                        <option value="38">REFILE _TFL</option>
                                        <option value="39">REFILED - FOLLOW UP</option>
                                        <option value="40">REPROCESS- FOLLOW UP</option>
                                        <option value="41">RESOLVED</option>
                                        <option value="42">TO BILL PATIENT</option>
                                        <option value="43">TO FAX</option>
                                        <option value="44">UNDER PROCESS - FOLLOW UP</option>
                                        <option value="45">UNRESOLVED</option>
                                        <option value="46">VOICE MAIL / CALLBACK - FOLLOW UP</option>
                                        <option value="47">REJECTIONS &amp; DENIALS / TASKS - FOLLOW UP
                                        </option>
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
@include('client.info.include.clientLedgerInc')
