<?php
if (\Auth::user()->is_up_admin == 1) {
    $admin_id = \Auth::user()->id;
} else {
    $admin_id = \Auth::user()->up_admin_id;
}
?>
@foreach ($ledger_lists as $list)
    <?php
    //  print_r($list);
        $client = \App\Models\Client::select('id', 'client_full_name', 'client_dob')->where('id','=', $list['client_id'])->first();
        $provider = \App\Models\Employee::select('id', 'full_name')->where('id', $list['provider_id'])->first();
        $auth = \App\Models\Client_authorization::select('id', 'uci_id', 'onset_date', 'end_date', 'authorization_number', 'supervisor_id')->where('id', $list['authorization_id'])->first();
        $super = \App\Models\Employee::select('id', 'full_name')->where('id', $auth->supervisor_id)->first();
        $adj = \App\Models\deposit_apply::select('payment', 'batching_claim_id')->where('batching_claim_id', $list['batching_id'])->sum('payment');
        $copay = \App\Models\deposit_apply_transaction::select('balance', 'batching_claim_id', 'status')->where('batching_claim_id', $list['batching_id'])->where('status', "PR Copay")->sum('balance');
        $coins = \App\Models\deposit_apply_transaction::select('batching_claim_id', 'status', 'balance')->where('batching_claim_id', $list['batching_id'])->where('status', "PR CoIns")->sum('balance');
        $deduct = \App\Models\deposit_apply_transaction::select('batching_claim_id', 'status', 'balance')->where('batching_claim_id', $list['batching_id'])->where('status', "PR Ded")->sum('balance');
        $claim = \App\Models\manage_claim_transaction::select('admin_id', 'claim_id', 'baching_id')->where('baching_id', $list['batching_id'])->where('admin_id', $list['admin_id'])->first();
        $ledger_note = \App\Models\ledger_note::where('ledger_id', $list['id'])->where('admin_id',$admin_id)->orderBy('id','DESC')->first();
        $zone = \App\Models\setting_name_location_box_two::where('id', $client->zone)->where('admin_id', $client->admin_id)->first();
        $payor_name = \App\Models\All_payor_detail::where('payor_id', $list['payor_id'])->where('admin_id', $list['admin_id'])->first();
        $name_loca = \App\Models\setting_name_location::select('id', 'admin_id', 'is_combo')->where('admin_id', $list['admin_id'])->first();
        $total_am = 0;
        $total_pay = 0;
        $total_adj = 0;
        $total_bal = 0;

        if ($name_loca->is_combo == 1) {
            $deposit_aplly_1 = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                ->where('appointment_id', $list['appointment_id'])
                ->where('dos', $list['schedule_date'])
                ->where('cpt', $list['cpt'])
                ->where('admin_id', $list['admin_id'])
                ->first();


            $deposit_aplly_2 = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id', 'deopsit_id')
                ->where('appointment_id', $list['appointment_id'])
                ->where('dos', $list['schedule_date'])
                ->where('cpt', $list['cpt'])
                ->where('admin_id', $list['admin_id'])
                ->first();
        } else {
            $deposit_aplly_1 = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                ->where('appointment_id', $list['appointment_id'])
                ->where('dos', $list['schedule_date'])
                ->where('admin_id', $list['admin_id'])
                ->first();


            $deposit_aplly_2 = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id', 'deopsit_id')
                ->where('appointment_id', $list['appointment_id'])
                ->where('dos', $list['schedule_date'])
                ->where('admin_id', $list['admin_id'])
                ->first();
        }


        if ($deposit_aplly_2) {
            $dep_data_single = \App\Models\deposit::where('id', $deposit_aplly_2->deopsit_id)->first();
        } else {
            $dep_data_single = \App\Models\deposit::where('id', 0)->first();
        }


        $check_dep_data = \App\Models\deposit_apply::distinct()->select('deopsit_id', 'appointment_id', 'dos', 'admin_id')
            ->where('appointment_id', $list['appointment_id'])
            ->where('dos', $list['schedule_date'])
            ->where('admin_id', $list['admin_id'])
            ->first();

        if ($name_loca->is_combo == 1) {
            $last_status = \App\Models\deposit_apply::select('id', 'appointment_id', 'dos', 'admin_id', 'status')
                ->where('appointment_id', $list['appointment_id'])
                ->where('dos', $list['schedule_date'])
                ->where('cpt', $list['cpt'])
                ->where('admin_id', $list['admin_id'])
                ->orderBy('id', 'desc')
                ->first();

            $billed_am = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                ->where('appointment_id', $list['appointment_id'])
                ->where('dos', $list['schedule_date'])
                ->where('admin_id', $list['admin_id'])
                ->where('cpt', $list['cpt'])
                ->sum('billed_am');


            $deposit_aplly_pay = \App\Models\deposit_apply::select('appointment_id', 'dos', 'admin_id')
                ->where('appointment_id', $list['appointment_id'])
                ->where('dos', $list['schedule_date'])
                ->where('admin_id', $list['admin_id'])
                ->where('cpt', $list['cpt'])
                ->sum('payment');

            $deposit_aplly_adj = \App\Models\deposit_apply::select('appointment_id', 'dos', 'amount')
                ->where('appointment_id', $list['appointment_id'])
                ->where('dos', $list['schedule_date'])
                ->where('admin_id', $list['admin_id'])
                ->where('cpt', $list['cpt'])
                ->sum('adjustment');
        } else {
            $last_status = \App\Models\deposit_apply::select('id', 'appointment_id', 'dos', 'admin_id', 'status')
                ->where('appointment_id', $list['appointment_id'])
                ->where('dos', $list['schedule_date'])
                ->where('admin_id', $list['admin_id'])
                ->orderBy('id', 'desc')
                ->first();


            $billed_am = \App\Models\deposit_apply::distinct()->select('appointment_id', 'dos', 'admin_id')
                ->where('appointment_id', $list['appointment_id'])
                ->where('dos', $list['schedule_date'])
                ->where('admin_id', $list['admin_id'])
                ->sum('billed_am');


            $deposit_aplly_pay = \App\Models\deposit_apply::select('appointment_id', 'dos', 'admin_id')
                ->where('appointment_id', $list['appointment_id'])
                ->where('dos', $list['schedule_date'])
                ->where('admin_id', $list['admin_id'])
                ->sum('payment');

            $deposit_aplly_adj = \App\Models\deposit_apply::select('appointment_id', 'dos', 'amount')
                ->where('appointment_id', $list['appointment_id'])
                ->where('dos', $list['schedule_date'])
                ->where('admin_id', $list['admin_id'])
                ->sum('adjustment');
        }
        $v1 = "PR CoIns";
        $v2 = "PR Copay";
        $v3 = "PR Ded";

        if ($name_loca->is_combo == 1) {
            $check_who_paid = \App\Models\deposit_apply_transaction::select('id', 'admin_id', 'batching_claim_id', 'appointment_id', 'dos', 'who_paid', 'client_id', 'payment')
                ->where('batching_claim_id', $list['batching_id'])
                ->where('cpt', $list['cpt'])
                ->where('admin_id', $list['admin_id'])
                ->get();
        } else {
            $check_who_paid = \App\Models\deposit_apply_transaction::select('id', 'admin_id', 'batching_claim_id', 'appointment_id', 'dos', 'who_paid', 'client_id', 'payment')
                ->where('batching_claim_id', $list['batching_id'])
                ->where('admin_id', $list['admin_id'])
                ->get();
        }


        $sum_pt_bal = \App\Models\deposit_apply::select('appointment_id', 'dos', 'amount')
            ->where('appointment_id', $list['appointment_id'])
            ->where('dos', $list['schedule_date'])
            ->where('admin_id', $list['admin_id'])
            ->where(function ($query) use ($v1, $v2, $v3) {
                $query->where('status', '=', $v1);
                $query->orWhere('status', '=', $v2);
                $query->orWhere('status', '=', $v3);
            })->sum('payment');


        $t_pat_paid = 0;
        $t_payo_paid = 0;
        foreach ($check_who_paid as $who_paid) {
            $check_pt = \App\Models\Client::select('id', 'client_full_name', 'admin_id')
                ->where('admin_id', $who_paid->admin_id)
                ->where('client_full_name', $who_paid->who_paid)
                ->first();

            if ($check_pt) {
                $t_pat_paid += $who_paid->payment;
            } else {
                $t_pat_paid += 0;
            }

            $check_payor = \App\Models\All_payor_detail::select('payor_name', 'admin_id')
                ->where('admin_id', $who_paid->admin_id)
                ->where('payor_name', $who_paid->who_paid)
                ->first();

            $check_payor1 = \App\Models\All_payor::select('id', 'payor_name')
                ->where('payor_name', $who_paid->who_paid)
                ->first();

            if ($check_payor) {
                $t_payo_paid += $who_paid->payment;
            } elseif ($check_payor1) {
                $t_payo_paid += $who_paid->payment;
            } else {
                $t_payo_paid += 0;
            }
        }


        $sub_total = $deposit_aplly_pay + $deposit_aplly_adj;
        $balance = $billed_am - $sub_total;


        if ($deposit_aplly_1) {
            $total_am += $billed_am;
            $total_pay += $deposit_aplly_pay;
            $total_adj += $deposit_aplly_adj;
            $total_bal += $balance;
        } else {
            $total_am += $list['billed_am'];
            $total_pay += 0.00;
            $total_adj += 0.00;
            $total_bal += $list['billed_am'];
        }

    ?>

    <tr>
        <td>{{ $client->client_full_name}}</td>
        <td>{{ \Carbon\Carbon::parse($client->client_dob)->format('m/d/Y') }}</td>
        <td>{{ isset($provider) ? $provider->full_name : '' }}</td>
        <td> {{isset($super) ? $super->full_name : ''}}</td>
        <td>{{isset($payor_name) ? $payor_name->payor_name : ''}}</td>
        <td>{{isset($auth) ? $auth->uci_id : '',}}</td>
        <td>{{$list['schedule_date'] }} </td>
        <td>{{$list['cpt']}} </td>
        <td>{{ $list['units']}} </td>
        <td>{{ \Carbon\Carbon::parse($list['created_at'])->format('m/d/Y') }}</td>
        <td>{{number_format($total_am, 2)}}</td>
        <td>{{number_format($total_am, 2)}}</td>
        <td>{{number_format($t_payo_paid, 2)}}</td>
        <td>{{number_format($total_adj, 2)}}</td>
        <td>{{ number_format($t_pat_paid, 2)}}</td>
        <td>{{ isset($dep_data_single) ? $dep_data_single->instrument : '' }}</td>
        <td>{{  isset($dep_data_single) ? \Carbon\Carbon::parse($dep_data_single->instrument_date)->format('m/d/Y') : ''}}</td>
        <td>{{number_format($total_bal, 2)}}</td>
        <td>{{isset($last_status) ? $last_status->status : '' }}</td>
        <td>{{is_numeric($copay) ? number_format($copay, 2) : 0.00}}</td>
        <td>{{is_numeric($coins) ? number_format($coins, 2) : 0.00}}</td>
        <td>{{ is_numeric($deduct) ? number_format($deduct, 2) : 0.00 }}</td>
        <td>{{ isset($claim) ? $claim->claim_id : ''}}</td>
        {{-- <td>{{ isset($ledger_note) ? $ledger_note->category_name : ''}}</td>
        <td>{{ isset($ledger_note) ? $ledger_note->notes : ''}}</td> --}}
        <td>{{ isset($ledger_note) ? $ledger_note->worked_date : ''}}</td>
        <td>{{  isset($ledger_note) ? $ledger_note->followup_date : '' }}</td>
        <?php
            $notes_string='';
            $ledger_notes = \App\Models\ledger_note::select('id','admin_id','notes','worked_date','ledger_id','category_name')->where('ledger_id',$list["id"])->where('admin_id',$admin_id)->get();
            foreach($ledger_notes as $note){
                $work_date = \Carbon\Carbon::parse($note->worked_date)->format('m/d/Y');
                $notes_string.='['.$work_date.']'.' - '.$note->category_name.' - '.$note->notes."\n";
            }
        ?>

        <td  style="display: none;" data-tableexport-display="always">
            {{$notes_string}}
        </td>
        <td>{{$list['location'] }}</td>
        <td>{{isset($zone) ? $zone->zone_name : '' }}</td>
        <td>{{isset($auth) ? \Carbon\Carbon::parse($auth->onset_date)->format('m/d/Y') : '' }}</td>
        <td>{{ isset($auth) ? \Carbon\Carbon::parse($auth->end_date)->format('m/d/Y') : ''}}</td>
        <td>{{ isset($auth) ? $auth->authorization_number : '' }}</td>
        


    </tr>
@endforeach
