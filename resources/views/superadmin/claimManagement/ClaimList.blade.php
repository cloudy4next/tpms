@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <ul class="nav nav-tabs mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('superadmin.billing')}}">Processing Claim(s)
                        <span class="badge badge-warning ml-2">Step - 1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('superadmin.billing.batching.claim')}}">Batching Claim(s)
                        <span class="badge badge-warning ml-2">Step - 1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('superadmin.billing.claim.management')}}">Manage
                        claim(s)
                        <span class="badge badge-warning ml-2">Step - 1</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                {{-- <h2 class="common-title">Manage Claim(s)</h2> --}}
                <!-- Filters -->
                <div class="d-flex mb-2">
                    <!-- filter1 -->
                    <div class="filter1 mr-2">
                        <label>Sort By</label>
                        <select class="form-control form-control-sm filter_by">
                            <option value="0"></option>
                            <option value="1">Batch</option>
                            <option value="2">Claim</option>
                            <option value="3">Insurance</option>
                            <option value="4">Patients</option>
                            <option value="5">Tx Provider</option>
                            <option value="6">24J Provider</option>
                            <option value="7">Service Type</option>
                            <option value="8"> Claim Status</option>
                            <option value="9">Date Range</option>
                            <option value="10">Date Of Submission</option>
                            <option value="11">Submission Type</option>
                        </select>
                        <div class="text-danger filter1_warning"><i class="ri-error-warning-line"></i>Select Filter
                        </div>
                    </div>
                    <!-- Batch -->
                    <div class="batch1 mr-2">
                        <label>Batch</label>
                        <select class="form-control form-control-sm batch_id">
                        </select>
                        <div class="text-danger batch_warning"><i class="ri-error-warning-line"></i>Select Batch</div>
                    </div>
                    <!-- Claim -->
                    <div class="claim1 mr-2">
                        <label>Claim</label>
                        <input type="text" class="form-control form-control-sm claim_name">
                        <div class="text-danger claim_warning"><i class="ri-error-warning-line"></i>Enter Claim</div>
                    </div>
                    <!-- Insurance -->
                    <div class="payor1 mr-2">
                        <label>Insurance</label>
                        @if($name_loca->is_combo == 1)
                            <select class="form-control form-control-sm payor multiselect" name="payor"
                                    id="payor"
                                    multiple required>
                            </select>
                        @else
                            <select class="form-control form-control-sm payor">

                            </select>
                        @endif
                        <div class="text-danger payor_warning"><i class="ri-error-warning-line"></i>Select Payor</div>
                    </div>
                    <!-- Patients -->
                    <div class="client1 mr-2">
                        <label>Patiens</label>
                        <select class="form-control form-control-sm client">

                        </select>
                        <div class="text-danger client_warning"><i class="ri-error-warning-line"></i>Select Clients
                        </div>
                    </div>
                    <!-- Tx Therapist -->
                    <div class="tt1 mr-2">
                        <label>Tx Provider</label>
                        <select class="form-control form-control-sm treating_therapist">

                        </select>
                        <div class="text-danger tt_warning"><i class="ri-error-warning-line"></i>Select Therapist</div>
                    </div>
                    <!-- 24J Provider -->
                    <div class="cms1 mr-2">
                        <label>24J Provider</label>
                        <select class="form-control form-control-sm cms_emloyee">

                        </select>
                        <div class="text-danger cms_warning"><i class="ri-error-warning-line"></i>Select CMS</div>
                    </div>
                    <!-- Service Type -->
                    <div class="activity1 mr-2">
                        <label>Service Type</label>
                        <select class="form-control form-control-sm activitytype">
                        </select>
                        <div class="text-danger activity_warning"><i class="ri-error-warning-line"></i>Select Activity
                            Type
                        </div>
                    </div>
                    <!-- Status of Claim -->
                    <div class="soc1 mr-2">
                        <label>Claim Status</label>
                        <select class="form-control form-control-sm claimstatus">
                            <option value="0"></option>
                            <option value="1">lorem</option>
                            <option value="2">ipsum</option>
                        </select>
                        <div class="text-danger soc_warning"><i class="ri-error-warning-line"></i>Select Status of Claim
                        </div>
                    </div>
                    <!-- Date Range -->
                    <div class="dateRange1 mr-2">
                        <label>Date Range</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input class="form-control form-control-sm reportrange">
                        </div>
                        <div class="text-danger dateRange_warning"><i class="ri-error-warning-line"></i>Select Date
                            Range
                        </div>
                    </div>
                    <!-- Date of Submission -->
                    <div class="subDate1 mr-2">
                        <label>Submitted Date</label>
                        <input type="text" class="form-control form-control-sm sumiteddate" id="datepicker" readonly
                               autocomplete="nope" placeholder="mm/dd/yyyy">
                        <div class="text-danger subDate_warning"><i class="ri-error-warning-line"></i>Select Submitted
                            Date
                        </div>
                    </div>
                    <!-- Submission Type -->
                    <div class="submission1 mr-2">
                        <label>Submission Type</label>
                        <select class="form-control form-control-sm">
                            <option value="0"></option>
                            <option value="1">lorem</option>
                            <option value="2">ipsum</option>
                        </select>
                        <div class="text-danger submission_warning"><i class="ri-error-warning-line"></i>Select
                            Submission
                            Type
                        </div>
                    </div>
                    <!-- Claim Total -->
                    <div class="claimTotal1 mr-2">
                        <label>Claim Total</label>
                        <input type="text" class="form-control form-control-sm">
                        <div class="text-danger claimTotal_warning"><i class="ri-error-warning-line"></i>Enter Claim
                            Total
                        </div>
                    </div>
                    <!-- filter-2 -->
                    <div class="filter2 mr-2">
                        <label>Sort By</label>
                        <select class="form-control form-control-sm filter_by1">
                            <option value="0"></option>
                            <option value="1">Batch</option>
                            <option value="2">Claim</option>
                            <option value="3">Insurance</option>
                            <option value="4">Patients</option>
                            <option value="5">Tx Provider</option>
                            <option value="6">24J Provider</option>
                            <option value="7">Service Type</option>
                            <option value="8"> Claim Status</option>
                            <option value="9">Date Range</option>
                            <option value="10">Date Of Submission</option>
                            <option value="11">Submission Type</option>
                        </select>
                    </div>
                    <!-- batch-2 -->
                    <div class="batch2 mr-2">
                        <label>Batch</label>
                        <select class="form-control form-control-sm batch_id_one">
                        </select>
                    </div>
                    <!-- Claim-2 -->
                    <div class="claim2 mr-2">
                        <label>Claim</label>
                        <input type="text" class="form-control form-control-sm claim_name_one">
                    </div>
                    <!-- Insurance-2 -->
                    <div class="payor2 mr-2">
                        <label>Insurance</label>


                        @if($name_loca->is_combo == 1)
                            <select class="form-control form-control-sm payor_one multiselect" name="payor_one"
                                    id="payor_one"
                                    multiple required>
                            </select>
                        @else
                            <select class="form-control form-control-sm payor_one">
                            </select>
                        @endif
                    </div>
                    <!-- Patients-2 -->
                    <div class="client2 mr-2">
                        <label>Patients</label>
                        <select class="form-control form-control-sm client_one">
                        </select>
                    </div>
                    <!-- Tx Therapist-2 -->
                    <div class="tt2 mr-2">
                        <label>Tx Provider</label>
                        <select class="form-control form-control-sm treating_therapist_one">

                        </select>
                    </div>
                    <!-- 24J Provider-2 -->
                    <div class="cms2 mr-2">
                        <label>24J Provider</label>
                        <select class="form-control form-control-sm cms_emloyee_one">

                        </select>
                    </div>
                    <!-- Service Type-2 -->
                    <div class="activity2 mr-2">
                        <label>Service Type</label>
                        <select class="form-control form-control-sm activitytype_one">

                        </select>
                    </div>
                    <!-- Status of Claim-2 -->
                    <div class="soc2 mr-2">
                        <label>Claim Status</label>
                        <select class="form-control form-control-sm claimstatus_one">

                        </select>
                    </div>
                    <!-- Date Range-2 -->
                    <div class="dateRange2 mr-2">
                        <label>Date Range</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input class="form-control form-control-sm reportrange reportrange_one">
                        </div>
                    </div>
                    <!-- Date of Submission-2 -->
                    <div class="subDate2 mr-2">
                        <label>Submitted Date</label>
                        <input type="date" class="form-control form-control-sm sumiteddate_one">
                    </div>
                    <!-- Submission Type-2 -->
                    <div class="submission2 mr-2">
                        <label>Submission Type</label>
                        <select class="form-control form-control-sm">
                            <option value="0"></option>
                            <option value="1">lorem</option>
                            <option value="2">ipsum</option>
                        </select>
                    </div>
                    <!-- Claim Total-2 -->
                    <div class="claimTotal2 mr-2">
                        <label>Claim Total</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <!-- buttons -->
                    <div class="align-self-end filter_btn">
                        <button type="button" class="btn btn-sm btn-primary mr-2 claim_btn" id="get_claim">Get
                            Claim(s)
                        </button>
                        <button type="button" class="btn btn-sm btn-danger"
                                onclick="window.location.reload();">Cancel
                        </button>
                    </div>
                    <div class="align-self-center ml-auto mt-auto download_div">
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
                <!-- table -->
                <div class="claim_details">
                    <form action="{{ route('superadmin.claim.with.background') }}" method="post" id="claim_tran_submit"
                          target="_blank">
                        @csrf
                        <div class="table-responsive claimTable claimdatashow">

                        </div>
                        <!-- claim Option -->
                        <div class="d-flex">
                            <div class="align-self-end mr-2 select_action">
                                <select class="form-control form-control-sm select_option_1"
                                        name="action_type_selected">
                                    <option value=""></option>
                                    <option value="1">HCFA with background</option>
                                    <option value="2">HCFA without background</option>
                                    <option value="3">Push OA SFTP</option>
                                    <option value="4">Show Detail(s)</option>
                                    <option value="5">Create Secondary Claim</option>
                                    <option value="6">Generate 837 File</option>
                                    <option value="7">Codes Bulk Update</option>
                                </select>
                            </div>
                            <div class="align-self-end">
                                <button type="button" class="btn btn-sm btn-primary" id="ok_btn">Ok</button>
                                <button type="button" class="btn btn-sm btn-primary" id="claim_save">Save</button>
                            </div>
                            <div class="align-self-end ml-auto search_filter">
                                <div class="input-group">
                                    <input type="search" class="form-control form-control-sm search_transaction"
                                           placeholder="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm" type="button"><i
                                                class="ri-search-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- transaction table -->
                    <div class="table_transaction mt-2 trasac_ac_div">
                        <div class="table-responsive claim_transaction">

                        </div>
                        <!-- Filter -->
                        <div class="d-flex">
                            <div class="align-self-end mr-2">
                                <select class="form-control form-control-sm claim_transacton_action">
                                    <option value="1">Retract billed Session(s)</option>
                                    <option value="2">Split Session(s)</option>
                                </select>
                            </div>
                            <div class="align-self-end">
                                <button type="button" class="btn btn-sm btn-primary mr-2" id="cl_tran_ok_btn">OK
                                </button>
                                <button type="button" class="btn btn-sm btn-danger"
                                        onclick="window.location.reload();">Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="codeBox" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Corrected Claim</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>Box 19</label>
                        <input type="text" class="form-control form-control-sm box_19">
                    </div>
                    <div class="col-md-6">
                        <label>Resub. Code</label>
                        <input type="text" class="form-control form-control-sm resubmit_code">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label>Org. Ref. No.</label>
                        <input type="text" class="form-control form-control-sm orginal_ref_no">
                    </div>
                    <input type="hidden" class="form-control form-control-sm claim_id">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="codeSubmit">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="codeBoxBulk" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add Codes</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>Box 19</label>
                        <input type="text" class="form-control form-control-sm box_19_b">
                    </div>
                    <div class="col-md-6">
                        <label>Resub. Code</label>
                        <input type="text" class="form-control form-control-sm resubmit_code_b">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label>Org. Ref. No.</label>
                        <input type="text" class="form-control form-control-sm orginal_ref_no_b">
                    </div>
                    <input type="hidden" class="form-control form-control-sm claim_id">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="codeSubmitBulk">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection
@include('superadmin.claimManagement.include.claim_include_js')
