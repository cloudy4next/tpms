@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="overflow-hidden">
                <div class="float-left">
                    <h2 class="common-title">Follow Up Bucket</h2>
                </div>
                <div class="float-right"><a href="{{ route('superadmin.dashboard') }}" class="btn btn-sm btn-primary"
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
                    <select class="form-control-sm form-control client_id multiselect" multiple>
                    </select>
                </div>
                <div class="mr-2">
                    <label>Insurance</label>
                    <select class="form-control-sm form-control payor_id multiselect" multiple>

                    </select>
                </div>
                <div class="mr-2">
                    <label>CPT Codes</label>
                    <select class="form-control-sm form-control ctp_code multiselect" multiple>
                    </select>
                </div>
                <div class="mr-2">
                    <label>Aging Status</label>
                    <?php
                        $check = '';
                        if($type == 0){
                            $check = '';
                        }
                        else{
                            $check = 'disabled';
                        }
                    ?>
                    <select class="form-control form-control-sm ser_cat_name" style="max-width: 180px;" {{$check}}>
                        <option></option>
                        <option value="Corrected Claim">Corrected Claim</option>
                        <option value="COB">COB</option>
                        <option value="NCOF-Re-File">NCOF-Re-File</option>
                        <option value="Appeal">Appeal</option>
                        <option value="Reprocessing">Reprocessing</option>
                        <option value="Medical Records" {{$type==4?'selected':''}}>Medical Records</option>
                        <option value="Payor Escalation" {{$type==2?'selected':''}}>Payor Escalation</option>
                        <option value="Provider Escalation" {{$type==1?'selected':''}}>Provider Escalation</option>
                        <option value="MG Escalations" {{$type==3?'selected':''}}>MG Escalations</option>
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

            <div class="ledger_table">
                <div class="table-responsive">
                    <table class="table-bordered table table-sm c_table table-striped" id="export_table">
                        <thead>
                            <tr>
                                <th data-tableexport-display="none" class="checkbox"><input type="checkbox"
                                        class="check_all"></th>
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
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Follow Up Date</label>
                            <input type="date" class="form-control form-control-sm folowup_date">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Worked Date</label>
                            <input type="date" class="form-control form-control-sm worked_date">
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



    <!-- Add Note -->
    <div class="modal fade" id="editNote">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Add/Edit Note</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="#" id="add_notes_form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label>Aging Status</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <select class="form-control form-control-sm sing_category_name" name="category_name" required>
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
                                <input type="date" class="form-control form-control-sm sin_followup_date" name="followup_date"
                                       required>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Worked Date</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <input type="date" class="form-control form-control-sm sin_worked_date"
                                       name="worked_date"
                                       required>
                                <input type="hidden" class="hid_ledger_id">
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
                        <button type="submit" class="btn btn-primary" id="sing_ssave">Save</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>









@endsection
@include('superadmin.ledger.include.arbucket_include_js')
