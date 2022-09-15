@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body bill_page">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('superadmin.billing')}}">Processing Claim(s)
                        <span class="badge badge-warning ml-2">Step - 1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('superadmin.billing.batching.claim')}}">Batching
                        Claim(s)
                        <span class="badge badge-warning ml-2">Step - 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('superadmin.billing.claim.management')}}">Manage claim(s)
                        <span class="badge badge-warning ml-2">Step - 3</span>
                    </a>
                </li>
            </ul>
            {{-- <h2 class="common-title">Batching Claim(s)</h2> --}}
            <div class="tab-content">
                <div class="d-flex">
                    <div class="align-self-end mb-2 mr-2 filter1">
                        <label>Sort By</label>
                        <select class="form-control form-control-sm filter_one">
                            <option value=""></option>
                            <option value="0">All</option>
                            <option value="1">Patients</option>
                            <option value="2">Insurance</option>
                            <option value="3">CMS-24j Provider</option>
                            {{--                            <option value="3">Self-Pay</option>--}}
                        </select>
                    </div>
                    <div class="align-self-end mb-2 mr-2 client_filter">
                        <label>Patient(s)</label>
                        <select class="form-control form-control-sm client1 multiselect" multiple>

                        </select>
                    </div>
                    <div class="align-self-end mb-2 mr-2 payor_filter">
                        <label>Insurance</label>
                        <select class="form-control form-control-sm payor1 multiselect" name="payor1"
                                id="payor1"
                                multiple required>
                        </select>
                    </div>

                    <div class="align-self-end mb-2 mr-2 providerj_filter">
                        <label>Provider</label>
                        <select class="form-control form-control-sm providerj multiselect" multiple>

                        </select>
                    </div>

                    <div class="align-self-end mb-2 mr-2 to_date">
                        <label>To Date</label>
                        <input class="form-control form-control-sm date_range_to" type="text" id="datepicker"
                               placeholder="mm/dd/yyyy" readonly>
                    </div>

                    <div class="align-self-end mb-2 mr-2 filter2">
                        <label>Sort By</label>
                        <select class="form-control form-control-sm filter_two">
                            
                        </select>
                    </div>
                    <div class="align-self-end mb-2 mr-2 client_filter2">
                        <label>Patient(s)</label>
                        <select class="form-control form-control-sm client2 multiselect" multiple>

                        </select>
                    </div>
                    <div class="align-self-end mb-2 mr-2 payor_filter2">
                        <label>Insurance</label>
                        <select class="form-control form-control-sm payor2 multiselect" name="payor2"
                                id="payor2"
                                multiple required>
                        </select>
                    </div>

                    <div class="align-self-end mb-2 mr-2 providerj_filter2">
                        <label>Provider</label>
                        <select class="form-control form-control-sm providerj2 multiselect" multiple>

                        </select>
                    </div>

                    <div class="align-self-end mb-2">
                        <button type="button" class="btn btn-sm btn-primary mr-2 go_btn" id="go_btn">Go</button>

                        <button type="reset" class="btn btn-sm btn-danger mr-2" id="cancel_btn"
                                onClick="window.location.reload();">Cancel
                        </button>
                        {{--                        @if ($data_count_is_mark <= 0)--}}
                        {{--                            <button type="button" class="btn btn-sm no_change_disable  gmp" id="" style="background-color: gray;border-color: gray;color: whitesmoke" disabled>No Generate & Mark Processed</button>--}}
                        {{--                        @else--}}
                        {{--                            <button type="button" class="btn btn-sm change_disable btn-primary gmp" id="gen_process">Generate & Mark Processed</button>--}}
                        {{--                        @endif--}}

                        {{-- <button type="button" class="btn btn-sm no_change_disable  gmp" id=""
                                style="background-color: gray;border-color: gray;color: whitesmoke" disabled>Generate
                            Batch
                        </button> --}}
                        {{-- <button type="button" class="btn btn-sm btn-primary generate_csv" id="">Generate CSV
                        </button> --}}
                        <button type="button" class="btn btn-sm change_disable btn-primary gmp" id="gen_process">
                            Generate Batch
                        </button>

                        {{--                        <button type="button" class="btn btn-sm has_no_edi gmp" id="" style="background-color: gray;border-color: gray;color: whitesmoke" disabled>Preview HCFA</button>--}}
                        {{--                        <button type="button" class="btn btn-sm has_edi btn-primary gmp" id="generate_mark_processed">Preview HCFA</button>--}}

                    </div>
                    <div class="align-self-center mt-auto ml-auto download_div">
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
                <div class="batch_table mt-2">

                    <div class="table-responsive show_bact_table billing-batch">
                        <table class="table table-sm table-bordered c_table" id="export_table">
                            <thead>
                            <tr>
                                <th class="pt_th">Patient</th>
                                <th class="billprovider_th">Billing Provider</th>
                                <th class="treat_therapist">Treating therapist</th>
                                <th class="insurance_th">Insurance</th>
                                <th class="service_th" data-tableexport-display="none">Service</th>
                                <th style="display: none;" data-tableexport-display="always">Service</th>
                                <th style="display: none;" data-tableexport-display="always">Hours</th>
                                <th style="display: none;" data-tableexport-display="always">Auth Number</th>
                                <th class="dos_th">DOS</th>
                                <th class="cpt_th" style="width: 60px;">Cpt</th>
                                <th class="pos_th">POS</th>
                                <th class="m1_th" style="width: 40px;">M1</th>
                                <th class="m2_th" style="width: 40px;">M2</th>
                                <th class="m3_th" style="width: 40px;">M3</th>
                                <th class="m4_th" style="width: 40px;">M4</th>
                                <th class="amount_th">Amount</th>
                                <th class="units_th" style="width: 60px;">Units</th>
                                {{-- <th class="">Status</th> --}}
                            </tr>
                            </thead>
                            <tbody class="show_batch_date">

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
                                    {{-- <td>
                                        <div class="comment br animate"></div>
                                    </td> --}}
                                </tr>
                            @endfor
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('superadmin.batchingclaim.include.batching_cliam_include_script')
