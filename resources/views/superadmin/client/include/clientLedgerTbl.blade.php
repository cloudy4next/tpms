<?php

if (Auth::user()->is_up_admin == 1) {
    $admin_id = Auth::user()->id;
} else {
    $admin_id = Auth::user()->up_admin_id;
}


?>


<table class="table-bordered table table-sm c_table table-striped" id="export_table">
    <thead>
    <tr>
        <th class="checkbox" data-tableexport-display="none"><input type="checkbox" class="ledger_check_all"></th>
        <th>Patient</th>
        <th>Provider(24J)</th>
        <th>DOS</th>
        <th>CPT</th>
        <th>Unit</th>
        <th>Date Billed</th>
        <th>Billed Amt</th>
        <th>Allowed Amt</th>
        <th>Paid</th>
        <th>Adj</th>
        <th>Balance</th>
        <th>Insurance Name</th>
        <th>Claim No</th>
        <th data-tableexport-display="none">NT</th>
        <th data-tableexport-display="none">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $total_am = 0;
    $total_pay = 0;
    $total_adj = 0;
    $total_bal = 0;
    ?>
    @foreach($legder_data as $led_data)



        <?php
        $client = \App\Models\Client::where('id', $led_data->client_id)->first();
        $em_name = \App\Models\Employee::where('id', $led_data->cms_24j)->first();
        $act = \App\Models\Client_authorization_activity::where('id', $led_data->activity_id)->first();
        $payor = \App\Models\All_payor_detail::select('admin_id', 'payor_id', 'payor_name')->where('payor_id', $led_data->payor_id)
            ->where('admin_id', $admin_id)
            ->first();

        $claim = \App\Models\manage_claim_transaction::select('admin_id', 'claim_id', 'baching_id')->where('baching_id', $led_data->batching_id)->where('admin_id', $admin_id)->first();
        $name_loca = \App\Models\setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $admin_id)->first();


        if ($name_loca->is_combo == 1) {
            $deposit_aplly_1 = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id', 'cpt')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('cpt', $led_data->cpt)
                ->where('admin_id', $admin_id)
                ->first();

            $billed_am = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id', 'cpt')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('cpt', $led_data->cpt)
                ->where('admin_id', $admin_id)
                ->sum('billed_am');


            $deposit_aplly_pay = \App\Models\deposit_apply::select('appointment_id', 'dos', 'admin_id', 'cpt')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('cpt', $led_data->cpt)
                ->where('admin_id', $admin_id)
                ->sum('payment');


            $deposit_aplly_adj = \App\Models\deposit_apply::select('appointment_id', 'dos', 'amount', 'cpt')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('cpt', $led_data->cpt)
                ->where('admin_id', $admin_id)
                ->sum('adjustment');
        } else {
            $deposit_aplly_1 = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('admin_id', $admin_id)
                ->first();

            $billed_am = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('admin_id', $admin_id)
                ->sum('billed_am');


            $deposit_aplly_pay = \App\Models\deposit_apply::select('appointment_id', 'dos', 'admin_id')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('admin_id', $admin_id)
                ->sum('payment');


            $deposit_aplly_adj = \App\Models\deposit_apply::select('appointment_id', 'dos', 'amount')
                ->where('appointment_id', $led_data->appointment_id)
                ->where('dos', $led_data->schedule_date)
                ->where('admin_id', $admin_id)
                ->sum('adjustment');
        }






        $sub_total = $deposit_aplly_pay + $deposit_aplly_adj;
        $balance = $billed_am - $sub_total;

        if ($deposit_aplly_1) {
            $total_am += $billed_am;
            $total_pay += $deposit_aplly_pay;
            $total_adj += $deposit_aplly_adj;
            $total_bal += $balance;
        } else {
            $total_am += $led_data->billed_am;
            $total_pay += 0.00;
            $total_adj += 0.00;
            $total_bal += $led_data->billed_am;
        }
        ?>
        <tr>
            <td data-tableexport-display="none">
                <input type="checkbox" class="leg_tbl_check" value="{{$led_data->batching_id}}" data-id="{{$led_data->id}}">
            </td>
            <td>
                @if ($client)
                    <a href="{{route('superadmin.client.info',$client->id)}}"
                       target="_blank">{{$client->client_full_name}}</a>
                @endif
            </td>
            <td>
                @if ($em_name)
                    {{$em_name->first_name}} {{$em_name->middle_name}} {{$em_name->last_name}}
                @endif
            </td>
            <td>{{\Carbon\Carbon::parse($led_data->schedule_date)->format('m/d/Y')}}</td>
            <td>{{$led_data->cpt}}</td>
            <td>{{$led_data->units}}</td>
            <td>
                @if ($led_data->created_at != null || $led_data->created_at != '')
                    {{\Carbon\Carbon::parse($led_data->created_at)->format('m/d/Y')}}
                @endif
            </td>
            <td>
                @if ($deposit_aplly_1)
                    {{number_format($billed_am,2)}}
                @else
                    {{number_format($led_data->billed_am)}}
                @endif
            </td>
            <td>
                @if ($deposit_aplly_1)
                    {{number_format($billed_am,2)}}
                @else
                    {{number_format($led_data->billed_am)}}
                @endif
            </td>
            <td>
                {{number_format($deposit_aplly_pay,2)}}

            </td>
            <td>
                {{number_format($deposit_aplly_adj,2)}}
            </td>
            <td>
                @if ($deposit_aplly_1)
                    {{number_format($balance,2)}}
                @else
                    {{number_format($led_data->billed_am)}}
                @endif


            </td>
            <td>
                @if ($payor)
                    {{$payor->payor_name}}
                @endif
            </td>
            <td>
                @if ($claim)
                    <a href="{{ route('superadmin.claim.show.hcfa',$claim->claim_id) }}"
                       target="_blank">{{$claim->claim_id}}</a>
                @endif

            </td>
            <td data-tableexport-display="none">
                <?php
                $leg_notes_count = \App\Models\ledger_note::select('ledger_id')->where('ledger_id', $led_data->id)->count();
                ?>
                @if ($leg_notes_count > 0)
                    <i class="ri-file-add-fill text-success"></i>
                @else
                    <i class="ri-file-add-fill text-muted"></i>
                @endif

            </td>
            <td data-tableexport-display="none">

                <a href="#editNote" data-id="{{$led_data->id}}" title="Add Notes"
                   data-toggle="modal" class="addNoteLedgerSingle"><i
                        class="ri-add-circle-line"></i></a>
                <a href="#chat{{$led_data->id}}" data-id="{{$led_data->id}}" class="chat_data" data-toggle="modal"><i
                        class="ri-message-2-line ml-2"></i></a>
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
                                            <select class="form-control form-control-sm single_category_name"
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
                                            <input type="date" class="form-control form-control-sm single_followup_date"
                                                   name="followup_date"
                                                   required>
                                            <input type="hidden" class="form-control form-control-sm single_ledger_id"
                                                   name="ledger_id">
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label>Worked Date</label>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <input type="date" class="form-control form-control-sm single_workded_date"
                                                   name="worked_date"
                                                   required>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label>Notes</label>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <textarea class="form-control form-control-sm single_note" required
                                                      name="notes"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="single_save_note">Save</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="chat{{$led_data->id}}">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Ar Followup</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body show_comment">
                                <?php
                                $comments = \App\Models\ledger_note::where('ledger_id', $led_data->id)->get();
                                ?>
                                @foreach($comments as $com)
                                    <?php
                                    $follwo_date = \Carbon\Carbon::parse($com->followup_date)->format('m/d/Y');
                                    $client_name = \App\Models\Client::where('admin_id', $admin_id)->where('id', $com->client_id)->first();
                                    ?>
                                    <div class="row">
                                        <div class="col-md-2 mb-3">
                                            <img src="{{asset('assets/dashboard/')}}/images/user/01.jpg"
                                                 class="img-fluid" alt="user">
                                        </div>
                                        <div class="col-md-10 mb-3">
                                            <div class="talkbubble">
                                                <h6 class="overflow-hidden">{{$client_name->client_full_name}} <span
                                                        class="badge badge-secondary">{{$com->category_name}}</span>
                                                    <small
                                                        class="text-muted float-right">({{$follwo_date}} 6:09
                                                        PM)</small></h6>
                                                <hr>
                                                <p>{!! $com->notes !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>

    <tr data-tableexport-display="none">

        <td colspan="7" class="text-right">Total</td>
        <td><span class="total_billed_am">{{number_format($total_am,2)}}</span></td>
        <td><span class="total_billed_am">{{number_format($total_am,2)}}</span></td>
        <td><span class="total_payment">{{number_format($total_pay,2)}}</span></td>
        <td><span class="total_adj">{{number_format($total_adj,2)}}</span></td>
        <td><span class="total_bal">{{number_format($total_bal,2)}}</span></td>
        <td colspan="4"></td>
    </tr>

    <tr data-tableexport-display="always" style="display: none;">
        <td colspan="6" class="text-right">Total</td>
        <td><span class="total_billed_am">{{number_format($total_am,2)}}</span></td>
        <td><span class="total_billed_am">{{number_format($total_am,2)}}</span></td>
        <td><span class="total_payment">{{number_format($total_pay,2)}}</span></td>
        <td><span class="total_adj">{{number_format($total_adj,2)}}</span></td>
        <td><span class="total_bal">{{number_format($total_bal,2)}}</span></td>
        <td colspan="5"></td>
    </tr>
    </tfoot>
</table>

{{$legder_data->links()}}
