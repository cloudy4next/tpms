@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="overflow-hidden">
                <div class="float-left"><h2 class="common-title">Follow Up Bucket</h2></div>
                <div class="float-right"><a href="{{route('superadmin.dashboard')}}" class="btn btn-sm btn-primary"
                                            title="Back to dashboard"><i class="ri-arrow-left-circle-line"></i>Back</a>
                </div>
            </div>
            <!-- filter -->
            <div class="d-flex">
                <div class="mr-2">
                    <label>Select</label>
                    <select class="form-control-sm form-control select_date">
                        <option value="1">Today's Follow Up</option>
                        <option value="2">Last 7 days</option>
                        <option value="3">Last 15 days</option>
                        <option value="4">Last 30 days</option>
                        <option value="5">30 days & Over</option>
                    </select>
                </div>
                <div class="mr-2">
                    <label>Patients</label>
                    <select class="form-control-sm form-control client_id">
                    </select>
                </div>
                <div class="mr-2">
                    <label>Insurance</label>
                    <select class="form-control-sm form-control payor_id">

                    </select>
                </div>
                <div class="mr-2">
                    <label>CPT Codes</label>
                    <select class="form-control-sm form-control ctp_code">
                    </select>
                </div>
                <div class="mr-2">
                    <label>Aging Status</label>
                    <select class="form-control form-control-sm ser_cat_name" readonly style="max-width: 200px;">
                        @if ($type_id == 4)
                            <option value="Medical Records" {{$type_id == 4 ? 'selected' : ''}}>Medical Records</option>
                        @elseif ($type_id == 2)
                            <option value="Payor Escalation" {{$type_id == 2 ? 'selected' : ''}}>Payor Escalation
                            </option>
                        @elseif($type_id == 1)
                            <option value="Provider Escalation" {{$type_id == 1 ? 'selected' : ''}}>Provider
                                Escalation
                            </option>
                        @elseif($type_id == 3)
                            <option value="MG Escalations" {{$type_id == 3 ? 'selected' : ''}}>MG Escalations</option>
                        @else
                            Not Set
                        @endif

                    </select>
                </div>
                <div class="mr-2">
                    <label>Select Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input class="form-control form-control-sm data_range reportrange">
                    </div>
                </div>
                <div class="align-self-end mr-2">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">Zero Paid
                        </label>
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
            <div class="ledger_table">
                <div class="table-responsive">
                    <table class="table-bordered table table-sm c_table table-striped" id="export_table">
                        <thead>
                            <tr>
                                <th data-tableexport-display="none" class="checkbox"><input type="checkbox" class="check_all"></th>
                                <th>Patient</th>
                                <th>Provider(24J)</th>
                                <th>DOS</th>
                                <th>CPT</th>
                                <th>Unit</th>
                                <th>Date Billed</th>
                                <th>Allwd. $</th>
                                <th>Paid</th>
                                <th>Adj</th>
                                <th>Balance</th>
                                <th>Insurance Name</th>
                                {{-- <th>Claim No</th> --}}
                                <th data-tableexport-display="none">NT</th>
                                <th data-tableexport-display="none">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bucket_tbody">
                            
                        </tbody>
                        <tbody class="show_animation">
                            @for($i=0;$i<40;$i++)
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
                                </tr>
                            @endfor
                        </tbody>

                    </table>
                </div>
                <div class="d-flex">
                    <div class="mr-2">
                        <select class="form-control form-control-sm select_btn">
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
            <!-- view transaction -->
            <div class="table-responsive mt-2 transaction_table">
                <table class="table-bordered table table-sm c_table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Dos</th>
                        <th>Code</th>
                        <th>M1</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Adjustment</th>
                        <th>Who Paid</th>
                        <th>Instrument No</th>
                        <th>Posted Date</th>
                        <th>M2</th>
                        <th>M3</th>
                        <th>M4</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>lorem</td>
                        <td>lorem</td>
                        <td>lorem</td>
                        <td>lorem</td>
                        <td>lorem</td>
                        <td>loremm</td>
                    </tr>
                    <tr>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>lorem</td>
                        <td>lorem</td>
                        <td>lorem</td>
                        <td>lorem</td>
                        <td>lorem</td>
                        <td>loremm</td>
                    </tr>
                    <tr>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>lorem</td>
                        <td>lorem</td>
                        <td>lorem</td>
                        <td>lorem</td>
                        <td>lorem</td>
                        <td>loremm</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- add notes -->
            <div class="add_notes mt-2">
                <form action="#">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label>Aging Status</label>
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
                            </select>
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
                            <button type="submit" class="btn btn-primary mr-2" id="multi_note_save">Save</button>
                            <button type="button" class="btn btn-danger cancel_btn">Cancel</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@include('superadmin.ledger.include.arbucket_include_js')
