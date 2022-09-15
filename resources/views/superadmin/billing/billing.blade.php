@extends('layouts.superadmin')
@section('css')

@endsection
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body bill_page">

            <ul class="nav nav-tabs mb-2">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('superadmin.billing')}}">Processing Claim(s)
                        <span class="badge badge-warning ml-2">Step - 1</span>
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('superadmin.billing.batching.claim')}}">Batching Claim(s)
                        <span class="badge badge-warning ml-2">Step - 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('superadmin.billing.claim.management')}}">Manage claim(s)
                        <span class="badge badge-warning ml-2">Step - 3</span>
                    </a>
                </li>
            </ul>
            {{-- <h2 class="common-title"> Processing Claim(s)</h2> --}}
            <div class="tab-content">
                <div class="d-flex">
                    <div class="mb-2 mr-2 to_date">
                        <label>To Date</label>
                        <input class="form-control form-control-sm select_date" type="text" id="datepicker"
                               placeholder="mm/dd/yyyy" readonly>
                        <div class="text-danger date_warning"><i class="ri-error-warning-line"></i>Select Date</div>
                    </div>
                    <div class="align-self-end mb-2 mr-2 generate_btn">
                        <button type="button" class="btn btn-sm btn-primary" id="go">Go</button>
                    </div>
                    <div class="mb-2 mr-2 first_payor">
                        <label>Insurance</label>
                        @if($name_loca->is_combo == 1)
                            <select class="form-control form-control-sm all_payor multiselect" name="all_payor"
                                    id="all_payor"
                                    multiple required>
                            </select>
                        @else
                            <select class="form-control form-control-sm all_payor">
                            </select>
                        @endif
                    </div>
                    <div class="mb-2 mr-2 filter1">
                        <label>Sort By</label>
                        <select class="form-control form-control-sm filter_id_one">
                            <option value=""></option>
                            <option value="1">Patient(s)</option>
                            <option value="2">Tx Providers</option>
                            <option value="3">CMS Therapist</option>
                            <option value="4">Service Type</option>
                            <option value="5"> Claim Status</option>
                            <option value="6">Date Range</option>
                            <option value="7">Degree Level</option>
                            <option value="8">Region</option>
                            <option value="9">CPT Code</option>
                            <option value="10">Zero Units</option>
                            <option value="11">Place Of Service</option>
                            <option value="12">Modifier</option>
                        </select>
                        <div class="text-danger filter_warning"><i class="ri-error-warning-line"></i>Select Filter</div>
                    </div>
                    <!-- Clients -->
                    <div class="mb-2 mr-2 client_filter">
                        <label>Patients</label>
                        <select class="form-control form-control-sm client1">

                        </select>
                    </div>
                    <!-- Treating Therapist -->
                    <div class="mb-2 mr-2 tt_filter">
                        <label>Tx Provider</label>
                        <select class="form-control form-control-sm treating_therapist">
                        </select>
                    </div>
                    <!-- CMS Therapist -->
                    <div class="mb-2 mr-2 cmst_filter">
                        <label>CMS Therapist</label>
                        <select class="form-control form-control-sm cms_therapist">

                        </select>
                    </div>
                    <!-- Activity Type -->
                    <div class="mb-2 mr-2 atype_filter">
                        <label>Service Type</label>
                        <select class="form-control form-control-sm activitytype">
                        </select>
                    </div>
                    <!-- Status of Claim -->
                    <div class="mb-2 mr-2 soc_filter">
                        <label> Claim Status</label>
                        <select class="form-control form-control-sm ready_to_bill_status">
                            <option></option>
                            <option value="Ready To Bill">Ready to Bill</option>
                            @if ($count_pending_for_aproval > 0)
                                {{--                                <option value="Clarification Pending">Clarification Pending</option>--}}
                                <option value="Pending for Approval">Clarification Pending</option>
                                {{--                                <option value="Pending for Approval">Pending for Approval</option>--}}
                            @endif
                        </select>
                    </div>
                    <!-- Date Range -->
                    <div class="mb-2 mr-2 date_filter">
                        <label>Date Range</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input class="form-control form-control-sm reportrange">
                        </div>
                    </div>
                    <!-- Degree Level -->
                    <div class="mb-2 mr-2 degree_filter">
                        <label>Degree Level</label>
                        <select class="form-control form-control-sm degree_level">

                        </select>
                    </div>
                    <!-- Zone -->
                    <div class="mb-2 mr-2 zone_filter">
                        <label>Region</label>
                        <select class="form-control form-control-sm zone">

                        </select>
                    </div>
                    <!-- CPT Code -->
                    <div class="mb-2 mr-2 cpt_filter">
                        <label>CPT Code</label>
                        <select class="form-control form-control-sm cptcode">

                        </select>
                    </div>
                    <!-- Place Of Service -->
                    <div class="mb-2 mr-2 pos_filter">
                        <label>Place Of Service</label>
                        <select class="form-control form-control-sm pos">
                            <option></option>
                            <option value="03">School (03)</option>
                            <option value="11">Office (11)</option>
                            <option value="12">Home (12)</option>
                            <option value="99">Other Place of Service (99)</option>
                            <option value="02">Telehealth (02)</option>
                            <option value="41">Ambulance-Land (41)</option>
                            <option value="53">Community Mental Health Center (53)</option>
                        </select>
                    </div>
                    <!-- Modifier -->
                    <div class="mb-2 mr-2 modifier_filter">
                        <label>Modifier</label>
                        <select class="form-control form-control-sm modifire">

                        </select>
                    </div>
                    <!-- Filter 2 -->
                    <div class="mb-2 mr-2 filter2">
                        <label>Sort By</label>
                        <select class="form-control form-control-sm filter_id_two">
                            <option value=""></option>
                            <option value="1">Patient(s)</option>
                            <option value="2">Tx Provider</option>
                            <option value="3">CMS Therapist</option>
                            <option value="4">Service Type</option>
                            <option value="5">Claim Status</option>
                            <option value="6">Date Range</option>
                            <option value="7">Degree Level</option>
                            <option value="8">Region</option>
                            <option value="9">CPT Code</option>
                            <option value="10">Zero Units</option>
                            <option value="11">Place Of Service</option>
                            <option value="12">Modifier</option>
                        </select>
                    </div>
                    <!-- Clients 2 -->
                    <div class="mb-2 mr-2 client_filter2">
                        <label>Patients</label>
                        <select class="form-control form-control-sm client2">

                        </select>
                    </div>
                    <!-- Treating Therapist 2 -->
                    <div class="mb-2 mr-2 tt_filter2">
                        <label>Tx Provider</label>
                        <select class="form-control form-control-sm treating_therapist1">

                        </select>
                    </div>
                    <!-- CMS Therapist 2 -->
                    <div class="mb-2 mr-2 cmst_filter2">
                        <label>CMS Therapist</label>
                        <select class="form-control form-control-sm cms_therapist1">

                        </select>
                    </div>
                    <!-- Activity Type 2 -->
                    <div class="mb-2 mr-2 atype_filter2">
                        <label>Service Type</label>
                        <select class="form-control form-control-sm activitytype1">

                        </select>
                    </div>
                    <!-- Status of Claim 2 -->
                    <div class="mb-2 mr-2 soc_filter2">
                        <label>Claim Status</label>
                        <select class="form-control form-control-sm ready_to_bill_status1">
                            <option></option>
                            <option value="Ready To Bill">Ready to Bill</option>
                            @if ($count_pending_for_aproval > 0)
                                <option value="Pending for Approval">Clarification Pending</option>
                                {{--                            <option value="Pending for Approval">Pending for Approval</option>--}}
                            @endif
                        </select>
                    </div>
                    <!-- Date Range 2 -->
                    <div class="mb-2 mr-2 date_filter2">
                        <label>Date Range</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input class="form-control form-control-sm reportrange1">
                        </div>
                    </div>
                    <!-- Degree Level 2 -->
                    <div class="mb-2 mr-2 degree_filter2">
                        <label>Degree Level</label>
                        <select class="form-control form-control-sm degree_level1">

                        </select>
                    </div>
                    <!-- Zone 2 -->
                    <div class="mb-2 mr-2 zone_filter2">
                        <label>Region</label>
                        <select class="form-control form-control-sm zone1">

                        </select>
                    </div>
                    <!-- CPT Code 2 -->
                    <div class="mb-2 mr-2 cpt_filter2">
                        <label>CPT Code</label>
                        <select class="form-control form-control-sm cptcode1">

                        </select>
                    </div>
                    <!-- Place Of Service 2 -->
                    <div class="mb-2 mr-2 pos_filter2">
                        <label>Place Of Service</label>
                        <select class="form-control form-control-sm pos1">
                            <option></option>
                            <option value="03">School (03)</option>
                            <option value="11">Office (11)</option>
                            <option value="12">Home (12)</option>
                            <option value="99">Other Place of Service (99)</option>
                            <option value="02">Telehealth (02)</option>
                            <option value="41">Ambulance-Land (41)</option>
                            <option value="53">Community Mental Health Center (53)</option>
                        </select>
                    </div>
                    <!-- Modifier 2 -->
                    <div class="mb-2 mr-2 modifier_filter2">
                        <label>Modifier</label>
                        <select class="form-control form-control-sm modifire1">

                        </select>
                    </div>
                    <!-- Filter Button -->
                    <div class="align-self-end mb-2 filter_btn">
                        <button type="button" class="btn btn-sm mr-1 view_btn btn-primary" id="run">Run</button>
                        <button type="button" class="btn btn-sm btn-danger" onClick="window.location.reload();">Cancel
                        </button>
                        <button class="btn btn-warning btn-sm run_scrubbing_btn">Scrubbing</button>
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
                <!-- Process Billing Table -->
                <div class="pt_table">
                    <div class="table-responsive p_table table_data_show">


                        <table class="table table-sm table-bordered c_table bill_table" id="export_table">
                            <thead>
                            <tr>
                                <th style="display: none;" data-tableexport-display="always">Patients</th>
                                <th style="display: none;" data-tableexport-display="always">DOS</th>
                                <th style="display: none;" data-tableexport-display="always">Tx. Provider</th>
                                <th style="display: none;" data-tableexport-display="always">Service & Hrs</th>
                                <th style="display: none;" data-tableexport-display="always">Cpt</th>
                                <th style="display: none;" data-tableexport-display="always">POS</th>
                                <th style="display: none;" data-tableexport-display="always">M1</th>
                                <th style="display: none;" data-tableexport-display="always">M2</th>
                                <th style="display: none;" data-tableexport-display="always">M3</th>
                                <th style="display: none;" data-tableexport-display="always">M4</th>
                                <th style="display: none;" data-tableexport-display="always">Units</th>
                                <th style="display: none;" data-tableexport-display="always">Rate</th>
                                <th style="display: none;" data-tableexport-display="always">Rendering 24-J</th>
                                <th style="width: 50px; display:none;" data-tableexport-display="always">ID</th>
                                <th style="display: none;" data-tableexport-display="always">Status</th>




                                <th class="checkbox1_th" data-tableexport-display="none"><input type="checkbox" class="all_checked checkbox1"></th>
                                <th class="patient_th" style="min-width: 100px;" data-tableexport-display="none">Patients</th>
                                <th class="dos_th" data-tableexport-display="none" style="width: 90px; max-width: 90px;">DOS</th>
                                <th class="tx_provider_th" data-tableexport-display="none">Tx. Provider</th>
                                <th class="service_hrs_th" data-tableexport-display="none">Service & Hrs.</th>
                                <th class="cpt_th" data-tableexport-display="none" style="width: 70px;">Cpt</th>
                                <th class="pos_th" data-tableexport-display="none" style="width: 60px;">POS</th>
                                <th class="m1_name_th" style="width: 60px;" data-tableexport-display="none">M1</th>
                                <th class="m2_name_th" style="width: 60px;" data-tableexport-display="none">M2</th>
                                <th class="m3_name_th" style="width: 60px;" data-tableexport-display="none">M3</th>
                                <th class="m4_name_th" data-tableexport-display="none">M4</th>
                                <th class="unit_name_th" style="width: 70px;" data-tableexport-display="none">Units</th>
                                <th class="rates_name_th" data-tableexport-display="none">Rate</th>
                                <th class="cms_24j_name_th" data-tableexport-display="none">Rendering 24-J</th>
                                <th class="qualifier_id_th" data-tableexport-display="none">ID Qual</th>
                                <th style="width: 60px;" data-tableexport-display="none">Status</th>
                            </tr>
                            </thead>
                            <tbody class="bill_data_show">


                            </tbody>


                            <tbody class="show_animation">
                            @for($i=0;$i<40;$i++)
                                <tr>
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
                    <!-- options -->
                    <div class="d-flex">
                        <div class="align-self-end mr-2">
                            <i class="las la-share icon"></i>
                        </div>

                        <div class="align-self-end mr-2 select_action">
                            <select class="form-control form-control-sm action">
                                <option value="">Select Action</option>
                                <option value="1">Ready to Bill</option>
                                <option value="2">Clarification Pending</option>
                                <option value="3">Retract</option>
                                <option value="4">Non-billable Serv.</option>
                                <option value="5">24J Provider Update</option>
                                <option value="6">Update ID Qual</option>
                                <option value="7">Modifier Update</option>
                                {{--                                <option value="8">Round Off</option>--}}
                                <option value="9">Update Charge Amount</option>
                                {{--                                <option value="10">Apply Rates From Rate Table</option>--}}
                                <option value="11">Add CPT Codes</option>
                                <option value="12">Update Tx. Provider as 24J</option>
                                <option value="13">Update 24J to Practice NPI</option>
                                <option value="14">Update POS</option>
                                <option value="15">Update Tele MOD</option>
                            </select>
                        </div>
                        <div class="align-self-end mr-2 24j_select">
                            <label>CMS Provider</label>
                            <select class="form-control form-control-sm cms_provider">
                                <option value="0"></option>
                            </select>
                        </div>
                        <div class="align-self-end mr-2 qualifier_select">
                            <label>Different ID/Qualifiers</label>
                            <select class="form-control form-control-sm id_qualifiers" name="id_qualifiers">
                                <option value="0B">0B</option>
                                <option value="1B">1B</option>
                                <option value="1C">1C</option>
                                <option value="1D">1D</option>
                                <option value="1G">1G</option>
                                <option value="1H">1H</option>
                                <option value="EI">EI</option>
                                <option value="G2">G2</option>
                                <option value="LU">LU</option>
                                <option value="N5">N5</option>
                                <option value="SY">SY</option>
                                <option value="X5">X5</option>
                                <option value="ZZ">ZZ</option>
                            </select>
                        </div>
                        <div class="align-self-end mr-2 mupdate_select">
                            <div class="d-flex">
                                <div class="mr-2">
                                    <label>M1</label>
                                    <input type="text" class="form-control form-control-sm mo_one"
                                           style="max-width: 100px;">
                                </div>
                                <div class="mr-2">
                                    <label>M2</label>
                                    <input type="text" class="form-control form-control-sm mo_two"
                                           style="max-width: 100px;">
                                </div>
                                <div class="mr-2">
                                    <label>M3</label>
                                    <input type="text" class="form-control form-control-sm mo_three"
                                           style="max-width: 100px;">
                                </div>
                                <div>
                                    <label>M4</label>
                                    <input type="text" class="form-control form-control-sm mo_four"
                                           style="max-width: 100px;">
                                </div>
                            </div>
                        </div>
                        <div class="align-self-end mr-2 urate_select">
                            <label>Contract Amount</label>
                            <input type="text" class="form-control form-control-sm rate_val">
                        </div>
                        <div class="align-self-end mr-2 cpt_select">
                            <div class="d-flex">
                                <div class="mr-2">
                                    <label class="d-block">CPT1 & Units:</label>
                                    <div class="d-inline-block">
                                        <input type="text" class="form-control form-control-sm cpt_val"
                                               style="max-width: 100px;">
                                    </div>
                                    <div class="d-inline-block">
                                        <input type="text" class="form-control form-control-sm unit_val"
                                               style="max-width: 50px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="align-self-end mr-2 pos_select">
                            <label>Place Of Service</label>
                            <select class="form-control form-control-sm pos_val">
                                <option value="03">School (03)</option>
                                <option value="11">Office (11)</option>
                                <option value="12">Home (12)</option>
                                <option value="99">Other Place of Service (99)</option>
                                <option value="02">Telehealth (02)</option>
                                <option value="41">Ambulance-Land (41)</option>
                                <option value="53">Community Mental Health Center (53)</option>
                            </select>
                        </div>
                        <div class="align-self-end mr-2 update_tele_mod_input">
                            <label>Tel Mod Value</label>
                            <input type="text" class="form-control form-control-sm tele_mod_value">
                        </div>
                        <div class="align-self-end">
                            <button type="button" class="btn btn-sm btn-primary" id="save_data">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="scrubbing_modal" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                </div>

                <div class="modal-body">
                    <h5 class="common-title mb-3">Issues in claim:</h5>
                    <div class="error_list">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@include('superadmin.billing.include.billing_include')
