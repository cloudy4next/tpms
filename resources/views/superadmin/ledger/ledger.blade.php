@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>

    <div class="iq-card">
        <div class="iq-card-body">
            <h2 class="common-title"> AR Ledger</h2>
            <div class="d-flex">
                <div class="mr-2 postby">
                    <label>Sort By</label>
                    <select class="form-control form-control-sm sort_by">
                        <option value="2">Patient</option>
                        <option value="1">Claim No</option>
                    </select>
                </div>
                <div class="mr-2 claim_filter">
                    <label>Claim No</label>
                    <input class="form-control form-control-sm claim_no" type="text" maxlength="6"
                           placeholder="Claim No" style="max-width: 80px;">
                </div>
                <div class="mr-2 patient">
                    <label>Patient</label>
                    <select class="form-control-sm form-control all_clients multiselect" id="all_clients" multiple>

                    </select>
                </div>
                <div class="mr-2 daterange">
                    <label>Select Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input class="form-control form-control-sm reportrange" readonly>
                    </div>
                </div>
                <div class="mr-2 cpt">
                    <label>CPT Codes</label>
                    <select class="form-control-sm form-control cpt_code">

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
                        <option value="Maximum Benefit Reached - Reprocess">Maximum Benefit Reached - Reprocess</option>
                        <option value="Authorization - Escalation">Authorization - Escalation</option>
                        <option value="Maximum Benefit Reached - Escalation">Maximum Benefit Reached - Escalation
                        </option>
                        <option value="Need Followup">Need Followup</option>
                        <option value="Appealed">Appealed</option>
                        <option value="Claim sent back for reprocess">Claim sent back for reprocess</option>
                        <option value="Claim submitted">Claim submitted</option>
                        <option value="Claim submitted">Sent to posting team</option>
                        <option value="Rebill claim">Rebill claim</option>
                        <option value="Duplicate - Reprocess">Duplicate - Reprocess</option>
                        <option value="Coverage Terminated - Reprocess">Coverage Terminated - Reprocess</option>
                        <option value="Coverage Terminated - Escalation">Coverage Terminated - Escalation</option>
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
                        <option value="Additional Information - Reprocess">Additional Information - Reprocess</option>
                        <option value="Additional information - escalation">Additional information - escalation</option>
                        <option value="Medical records - Reprocess">Medical records - Reprocess</option>
                        <option value="Medical records - Escalation">Medical records - Escalation</option>
                        <option value="Invalid/Missing DX - Reprocess">Invalid/Missing DX - Reprocess</option>
                        <option value="Invalid/Missing DX - Escalation">Invalid/Missing DX - Escalation</option>
                        <option value="Invalid/Missing Modifier - Reprocess">Invalid/Missing Modifier - Reprocess
                        </option>
                        <option value="Invalid/Missing Modifier - Escalation">Invalid/Missing Modifier - Escalation
                        </option>
                        <option value="Need to Transmit">Need to Transmit</option>
                        <option value="Credentialling issue - Escalation">Credentialling issue - Escalation</option>
                        <option value="Paid not posted - Sent to posting team">Paid not posted - Sent to posting team
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
            <div class="ledger_table">
                <div class="table-responsive">
                    <table class="table-bordered table table-sm c_table table-striped" id="export_table">
                        <thead>
                            <tr>
                                <th data-tableexport-display="none" class="checkbox"><input type="checkbox" class="ledger_check_all"></th>
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
                                <th>Claim No</th>
                                <th data-tableexport-display="none">NT</th>
                                <th data-tableexport-display="none">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="legder_table_data">
                            
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
                                    <td>
                                        <div class="comment br animate"></div>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                        <tfoot>
                            <tr data-tableexport-display="none">

                                <td colspan="7" class="text-right">Total</td>
                                <td><span class="total_billed_am"></span></td>
                                <td><span class="total_payment"></span></td>
                                <td><span class="total_adj"></span></td>
                                <td><span class="total_bal"></span></td>
                                <td colspan="4"></td>
                            </tr>

                            <tr style="display:none;" data-tableexport-display="always">
                                <td colspan="6" class="text-right">Total</td>
                                <td><span class="total_billed_am"></span></td>
                                <td><span class="total_payment"></span></td>
                                <td><span class="total_adj"></span></td>
                                <td><span class="total_bal"></span></td>
                                <td colspan="5"></td>
                            </tr>
                        </tfoot>
                    </table>
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
                    <div class="align-self-center ml-auto mt-auto download_div2">
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
            <!-- view transaction -->
            <div class="table-responsive mt-2 transaction_table">

            </div>
            <!-- add notes -->
            <div class="add_notes mt-2">
                <form action="#" id="multi_notes_form">
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
                        <div class="col-md-4 mb-2">
                            <label>Follow Up Date</label>
                            <input type="date" class="form-control form-control-sm folowup_date" name="folowup_date">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Worked Date</label>
                            <input type="date" class="form-control form-control-sm worked_date" name="worked_date">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Notes</label>
                            <textarea class="form-control form-control-sm notes"></textarea>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary  mr-2" id="multi_note_save">Save</button>
                            <button type="button" class="btn btn-danger cancel_btn">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- Add Note -->
    <div class="modal fade" id="editNote">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Add/Edit Note</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('superadmin.legder.add.note')}}" method="post" id="add_notes_form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label>Aging Status</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm sing_category_name"
                                        name="category_name" required>
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
                                    <option value="Authorization - Reprocess">Authorization - Reprocess
                                    </option>
                                    <option value="Maximum Benefit Reached - Reprocess">Maximum Benefit
                                        Reached - Reprocess
                                    </option>
                                    <option value="Authorization - Escalation">Authorization - Escalation
                                    </option>
                                    <option value="Maximum Benefit Reached - Escalation">Maximum Benefit
                                        Reached - Escalation
                                    </option>
                                    <option value="Need Followup">Need Followup</option>
                                    <option value="Appealed">Appealed</option>
                                    <option value="Claim sent back for reprocess">Claim sent back for
                                        reprocess
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
                                    <option value="Predetermination - Reprocess">Predetermination -
                                        Reprocess
                                    </option>
                                    <option value="Predetermination - Escalation">Predetermination -
                                        Escalation
                                    </option>
                                    <option value="Non covered - reprocess">Non covered - reprocess</option>
                                    <option value="Non covered - Escalation">Non covered - Escalation
                                    </option>
                                    <option value="Requested EOB">Requested EOB</option>
                                    <option value="Awaiting for EOB">Awaiting for EOB</option>
                                    <option value="Patient Inactive - Reprocess">Patient Inactive -
                                        Reprocess
                                    </option>
                                    <option value="Patient Inactive - Escalation">Patient Inactive -
                                        Escalation
                                    </option>
                                    <option value="Copay issue">Copay issue</option>
                                    <option value="Out of Network - Reprocess">Out of Network - Reprocess
                                    </option>
                                    <option value="Out of Network - Escalation">Out of Network -
                                        Escalation
                                    </option>
                                    <option value="Under payment">Under payment</option>
                                    <option value="Additional Information - Reprocess">Additional
                                        Information - Reprocess
                                    </option>
                                    <option value="Additional information - escalation">Additional
                                        information - escalation
                                    </option>
                                    <option value="Medical records - Reprocess">Medical records -
                                        Reprocess
                                    </option>
                                    <option value="Medical records - Escalation">Medical records -
                                        Escalation
                                    </option>
                                    <option value="Invalid/Missing DX - Reprocess">Invalid/Missing DX -
                                        Reprocess
                                    </option>
                                    <option value="Invalid/Missing DX - Escalation">Invalid/Missing DX -
                                        Escalation
                                    </option>
                                    <option value="Invalid/Missing Modifier - Reprocess">Invalid/Missing
                                        Modifier - Reprocess
                                    </option>
                                    <option value="Invalid/Missing Modifier - Escalation">Invalid/Missing
                                        Modifier - Escalation
                                    </option>
                                    <option value="Need to Transmit">Need to Transmit</option>
                                    <option value="Credentialling issue - Escalation">Credentialling issue -
                                        Escalation
                                    </option>
                                    <option value="Paid not posted - Sent to posting team">Paid not posted -
                                        Sent to posting team
                                    </option>
                                    <option value="MR submitted">MR submitted</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Follow Up Date</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <input type="date" class="form-control form-control-sm sin_followup_date"
                                       name="followup_date"
                                       required>
                                <input type="hidden" class="form-control form-control-sm hid_ledger_id"
                                       name="ledger_id">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Worked Date</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <input type="date" class="form-control form-control-sm sin_worked_date"
                                       name="worked_date"
                                       required>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Notes</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <textarea class="form-control form-control-sm sin_notes" required
                                          name="notes"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="sing_ssave">Save</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
@include('superadmin.ledger.include.deposit_js')
