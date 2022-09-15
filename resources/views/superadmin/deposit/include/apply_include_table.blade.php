<?php

if (Auth::user()->is_up_admin == 1) {
    $admin_id = Auth::user()->id;
} else {
    $admin_id = Auth::user()->up_admin_id;
}

?>

    @foreach($deposits_apllys as $apply)
        <?php
        $gen = \App\Models\setting_name_location::select('admin_id', 'is_combo')->where('admin_id', $admin_id)->first();
        if($gen->is_combo==1){
            $claim_tran = \App\Models\manage_claim_transaction::select('admin_id', 'id', 'claim_id', 'baching_id','cpt')
            ->where('admin_id', $admin_id)
            ->where('cpt',$apply->cpt)
            ->where('baching_id', $apply->batching_claim_id)
            ->first();
        }
        else{
            $claim_tran = \App\Models\manage_claim_transaction::select('admin_id', 'id', 'claim_id', 'baching_id')
            ->where('admin_id', $admin_id)
            ->where('baching_id', $apply->batching_claim_id)
            ->first();   
        }
        ?>
        <tr>
            <td>
                @if ($apply->status_apply == 1)
                    <input type="checkbox" class="checked_data_trans" value="{{$apply->id}}" name="">
                @else
                    <input type="checkbox" class="checked_data checked_data_trans" name="checked_data"
                           value="{{$apply->id}}">
                @endif

                <label></label>
            </td>
            <td>
                @if ($claim_tran)
                    {{$claim_tran->claim_id}}
                @endif
            </td>
            <td>{{\Carbon\Carbon::parse($apply->dos)->format('m/d/Y')}}</td>
            <td>{{$apply->units}}</td>
            <td>{{$apply->cpt}}</td>
            <td>{{$apply->m1}}</td>

            <td>
                <p>{{ number_format($apply->amount,2)}}
                </p>
                <input type="hidden" class="amount" name="amount_val" value="{{$apply->amount}}">
                <input type="hidden" class="amt_h" value="{{$apply->amount}}">
            </td>
            <?php
            if ($gen->is_combo == 1) {
                $dis_am = \App\Models\deposit_apply::distinct()->select('admin_id', 'appointment_id', 'dos')
                    ->where('admin_id', $apply->admin_id)
                    ->where('appointment_id', $apply->appointment_id)
                    ->where('cpt', $apply->cpt)
                    ->where('dos', \Carbon\Carbon::parse($apply->dos)->format('Y-m-d'))
                    ->sum('amount');

                $dis_pay = \App\Models\deposit_apply::select('admin_id', 'appointment_id', 'dos')
                    ->where('admin_id', $apply->admin_id)
                    ->where('appointment_id', $apply->appointment_id)
                    ->where('cpt', $apply->cpt)
                    ->where('dos', \Carbon\Carbon::parse($apply->dos)->format('Y-m-d'))
                    ->sum('payment');

                $dis_adj = \App\Models\deposit_apply::select('admin_id', 'appointment_id', 'dos')
                    ->where('admin_id', $apply->admin_id)
                    ->where('appointment_id', $apply->appointment_id)
                    ->where('cpt', $apply->cpt)
                    ->where('dos', \Carbon\Carbon::parse($apply->dos)->format('Y-m-d'))
                    ->sum('adjustment');


                $dis_bal = \App\Models\deposit_apply::select('admin_id', 'appointment_id', 'dos')
                    ->where('admin_id', $apply->admin_id)
                    ->where('appointment_id', $apply->appointment_id)
                    ->where('cpt', $apply->cpt)
                    ->where('dos', \Carbon\Carbon::parse($apply->dos)->format('Y-m-d'))
                    ->sum('balance');
            } else {
                $dis_am = \App\Models\deposit_apply::distinct()->select('admin_id', 'appointment_id', 'dos')
                    ->where('admin_id', $apply->admin_id)
                    ->where('appointment_id', $apply->appointment_id)
                    ->where('dos', \Carbon\Carbon::parse($apply->dos)->format('Y-m-d'))
                    ->sum('amount');

                $dis_pay = \App\Models\deposit_apply::select('admin_id', 'appointment_id', 'dos')
                    ->where('admin_id', $apply->admin_id)
                    ->where('appointment_id', $apply->appointment_id)
                    ->where('dos', \Carbon\Carbon::parse($apply->dos)->format('Y-m-d'))
                    ->sum('payment');

                $dis_adj = \App\Models\deposit_apply::select('admin_id', 'appointment_id', 'dos')
                    ->where('admin_id', $apply->admin_id)
                    ->where('appointment_id', $apply->appointment_id)
                    ->where('dos', \Carbon\Carbon::parse($apply->dos)->format('Y-m-d'))
                    ->sum('adjustment');


                $dis_bal = \App\Models\deposit_apply::select('admin_id', 'appointment_id', 'dos')
                    ->where('admin_id', $apply->admin_id)
                    ->where('appointment_id', $apply->appointment_id)
                    ->where('dos', \Carbon\Carbon::parse($apply->dos)->format('Y-m-d'))
                    ->sum('balance');
            }


            $balance_amount = (double)$apply->amount - ((double)$dis_pay + (double)$dis_adj);

            ?>
            <td>
                @if ($apply->status_apply == 1)
                    <input type="text" class="form-control form-control-sm payment" name="payment"
                           value="{{number_format($dis_pay,2,'.','')}}" maxlength="8" readonly>
                    <input type="hidden" class="pay_h" value="{{$dis_pay}}">
                @else
                    <input type="text" class="form-control form-control-sm payment" value="0.00" name="payment"
                           maxlength="8">
                    <input type="hidden" class="pay_h" value="0">
                @endif
            </td>
            <td>
                @if ($apply->status_apply == 1)
                    <input type="text" class="form-control form-control-sm adjestment" name="adjustment"
                           value="{{number_format($dis_adj,2,'.','')}}"
                           maxlength="8" readonly>
                    <input type="hidden" class="adj_h" value="{{$dis_adj}}">
                @else
                    <input type="text" class="form-control form-control-sm adjestment" name="adjustment"
                           value="0.00"
                           maxlength="8">
                    <input type="hidden" class="adj_h" value="0">
                @endif

            </td>
            <td>
                <p class="balnace">{{number_format($balance_amount,2)}}</p>
                <input type="hidden" class="cal_balance_val" name="cal_balance_val"
                       value="{{$balance_amount}}">

                <input type="hidden" class="balance_val" name="balance_val"
                       value="{{$balance_amount}}">

                <input type="hidden" class="balance_val_one" name="balance_val_one"
                       value="{{$balance_amount}}">
                <input type="hidden" class="bal_h" value="{{$balance_amount}}">

            </td>
            <td>
                @if ($apply->status_apply == 1)
                    <select class="form-control form-control-sm" disabled>
                        <option value="Contractual Adj" {{$apply->reason == "Contractual Adj" ? 'selected' : ''}}>
                            Contractual Adj
                        </option>
                        <option
                            value="Exceeded Authorized Units" {{$apply->reason == "Exceeded Authorized Units" ? 'selected' : ''}}>
                            Exceeded Authorized Units
                        </option>
                        <option value="Paid by RC" {{$apply->reason == "Paid by RC" ? 'selected' : ''}}>Paid by RC
                        </option>
                        <option value="Billed in Error" {{$apply->reason == "Billed in Error" ? 'selected' : ''}}>Billed
                            in Error
                        </option>
                        <option
                            value="Rebilled Corrected Claim" {{$apply->reason == "Rebilled Corrected Claim" ? 'selected' : ''}}>
                            Rebilled Corrected Claim
                        </option>
                        <option
                            value="Billed to Secondary" {{$apply->reason == "Billed to Secondary" ? 'selected' : ''}}>
                            Billed to Secondary
                        </option>
                    </select>
                @else
                    <select class="form-control form-control-sm resason_name">
                        <option value="Contractual Adj" {{$apply->reason == "Contractual Adj" ? 'selected' : ''}}>
                            Contractual Adj
                        </option>
                        <option
                            value="Exceeded Authorized Units" {{$apply->reason == "Exceeded Authorized Units" ? 'selected' : ''}}>
                            Exceeded Authorized Units
                        </option>
                        <option value="Paid by RC" {{$apply->reason == "Paid by RC" ? 'selected' : ''}}>Paid by RC
                        </option>
                        <option value="Billed in Error" {{$apply->reason == "Billed in Error" ? 'selected' : ''}}>Billed
                            in Error
                        </option>
                        <option
                            value="Rebilled Corrected Claim" {{$apply->reason == "Rebilled Corrected Claim" ? 'selected' : ''}}>
                            Rebilled Corrected Claim
                        </option>
                        <option
                            value="Billed to Secondary" {{$apply->reason == "Billed to Secondary" ? 'selected' : ''}}>
                            Billed to Secondary
                        </option>
                    </select>
                @endif
            </td>
            <td>
                @if ($apply->status_apply == 1)
                    <select class="form-control form-control-sm" disabled>
                        <option value=""></option>
                        <option
                            value="Can not bill separately" {{$apply->status == "Contractual Adj" ? 'selected' : ''}}>
                            Can not bill separately
                        </option>
                        <option value="Closed" {{$apply->status == "Closed" ? 'selected' : ''}}>Closed</option>
                        <option value="Denied" {{$apply->status == "Denied" ? 'selected' : ''}}>Denied</option>
                        <option value="Duplicate Claim" {{$apply->status == "Duplicate Claim" ? 'selected' : ''}}>
                            Duplicate Claim
                        </option>
                        <option value="No Auth Write-Off" {{$apply->status == "No Auth Write-Off" ? 'selected' : ''}}>No
                            Auth Write-Off
                        </option>
                        <option value="Not Applicable" {{$apply->status == "Not Applicable" ? 'selected' : ''}}>Not
                            Applicable
                        </option>
                        <option value="Open" {{$apply->status == "Open" ? 'selected' : ''}}>Open</option>
                        <option value="Overpayment" {{$apply->status == "Overpayment" ? 'selected' : ''}}>Overpayment
                        </option>
                        <option
                            value="Patient Responsibility" {{$apply->status == "Patient Responsibility"  ? 'selected' : ''}}>
                            Patient Responsibility
                        </option>
                        <option value="PR CoIns" {{$apply->status == "PR CoIns" ? 'selected' : ''}}>PR CoIns</option>
                        <option value="PR Copay" {{$apply->status == "PR Copay" ? 'selected' : ''}}>PR Copay</option>
                        <option value="PR Ded" {{$apply->status == "PR Ded" ? 'selected' : ''}}>PR Ded</option>
                        <option
                            value="Primary Paid Max Write-Off" {{$apply->status == "Primary Paid Max Write-Off" ? 'selected' : ''}}>
                            Primary Paid Max Write-Off
                        </option>
                        <option value="Retraction" {{$apply->status == "Retraction" ? 'selected' : ''}}>Retraction
                        </option>
                        <option value="Reverted" {{$apply->status == "Reverted" ? 'selected' : ''}}>Reverted</option>
                        <option value="Secondary Denial" {{$apply->status == "Secondary Denial" ? 'selected' : ''}}>
                            Secondary Denial
                        </option>
                        <option
                            value="Secondary Responsibility" {{$apply->status == "Secondary Responsibility" ? 'selected' : ''}}>
                            Secondary Responsibility
                        </option>
                        <option value="Underpayment" {{$apply->status == "Underpayment" ? 'selected' : ''}}>
                            Underpayment
                        </option>
                        <option value="Write Off" {{$apply->status == "Write Off" ? 'selected' : ''}}>Write Off</option>
                    </select>
                @else
                    <select class="form-control form-control-sm status_name">
                        <option value=""></option>
                        <option
                            value="Can not bill separately" {{$apply->status == "Contractual Adj" ? 'selected' : ''}}>
                            Can not bill separately
                        </option>
                        <option value="Closed" {{$apply->status == "Closed" ? 'selected' : ''}}>Closed</option>
                        <option value="Denied" {{$apply->status == "Denied" ? 'selected' : ''}}>Denied</option>
                        <option value="Duplicate Claim" {{$apply->status == "Duplicate Claim" ? 'selected' : ''}}>
                            Duplicate Claim
                        </option>
                        <option value="No Auth Write-Off" {{$apply->status == "No Auth Write-Off" ? 'selected' : ''}}>No
                            Auth Write-Off
                        </option>
                        <option value="Not Applicable" {{$apply->status == "Not Applicable" ? 'selected' : ''}}>Not
                            Applicable
                        </option>
                        <option value="Open" {{$apply->status == "Open" ? 'selected' : ''}}>Open</option>
                        <option value="Overpayment" {{$apply->status == "Overpayment" ? 'selected' : ''}}>Overpayment
                        </option>
                        <option
                            value="Patient Responsibility" {{$apply->status == "Patient Responsibility"  ? 'selected' : ''}}>
                            Patient Responsibility
                        </option>
                        <option value="PR CoIns" {{$apply->status == "PR CoIns" ? 'selected' : ''}}>PR CoIns</option>
                        <option value="PR Copay" {{$apply->status == "PR Copay" ? 'selected' : ''}}>PR Copay</option>
                        <option value="PR Ded" {{$apply->status == "PR Ded" ? 'selected' : ''}}>PR Ded</option>
                        <option
                            value="Primary Paid Max Write-Off" {{$apply->status == "Primary Paid Max Write-Off" ? 'selected' : ''}}>
                            Primary Paid Max Write-Off
                        </option>
                        <option value="Retraction" {{$apply->status == "Retraction" ? 'selected' : ''}}>Retraction
                        </option>
                        <option value="Reverted" {{$apply->status == "Reverted" ? 'selected' : ''}}>Reverted</option>
                        <option value="Secondary Denial" {{$apply->status == "Secondary Denial" ? 'selected' : ''}}>
                            Secondary Denial
                        </option>
                        <option
                            value="Secondary Responsibility" {{$apply->status == "Secondary Responsibility" ? 'selected' : ''}}>
                            Secondary Responsibility
                        </option>
                        <option value="Underpayment" {{$apply->status == "Underpayment" ? 'selected' : ''}}>
                            Underpayment
                        </option>
                        <option value="Write Off" {{$apply->status == "Write Off" ? 'selected' : ''}}>Write Off</option>
                    </select>
                @endif

            </td>
            <td>
                <?php
                $client_auth_sec = \App\Models\Client_authorization::select('id', 'client_id', 'is_primary', 'payor_id')->where('client_id', $apply->client_id)
                    ->where('is_primary', 2)
                    ->first();

                ?>
                @if ($client_auth_sec)
                    <?php
                    $pay_name = \App\Models\All_payor::select('id', 'payor_name')->where('id', $client_auth_sec->payor_id)->first();
                    ?>
                    @if ($pay_name)
                        {{$pay_name->payor_name}}
                    @endif
                @endif

            </td>
            <td>{{$apply->m2}}</td>
            <td>{{$apply->m3}}</td>
            <td>{{$apply->m4}}</td>
            <td></td>
            <td>
                <?php
                $em_name = \App\Models\Employee::where('id', $apply->provider_24j)->first();
                ?>
                @if ($em_name)
                    {{$em_name->first_name}}  {{$em_name->middle_name}}  {{$em_name->last_name}}
                @endif
            </td>
        </tr>
    @endforeach
