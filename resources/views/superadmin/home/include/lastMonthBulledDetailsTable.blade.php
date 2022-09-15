<?php
    if(\Auth::user()->is_up_admin==1){
        $admin_id=\Auth::user()->id;
    }
    else{
        $admin_id=\Auth::user()->up_admin_id;
    }
?>



<table class="table table-sm table-bordered c_table" id="export_table2">
    <thead>
    <tr>
        <th>Claim No.</th>
        <th>Payor</th>
        <th>Patient</th>
        <th>Service Date</th>
        <th>CPT</th>
        <th>M1</th>
        <th>M2</th>
        <th>M3</th>
        <th>M4</th>
        <th>Units</th>
        <th>Total Charge</th>
        <th>Created Date</th>
        <th>Paid</th>
    </tr>
    </thead>
    <tbody>
    @foreach($last_month_claim_details as $claim_details)
        <?php
            $dep_app_trac = \App\Models\deposit_apply_transaction::select('id', 'admin_id', 'batching_claim_id', 'appointment_id', 'payment')
                ->where('admin_id', $admin_id)
                ->where('appointment_id', $claim_details->appointment_id)
                ->first();
            $payor = \App\Models\All_payor::select('id', 'payor_name')->where('id', $claim_details->payor_id)->first();
            $client = \App\Models\Client::select('id', 'admin_id', 'client_full_name')->where('id', $claim_details->client_id)
                ->where('admin_id', $admin_id)
                ->first();
        ?>
        <tr>
            <td>{{$claim_details->claim_id}}</td>
            <td>
                @if ($payor)
                    {{ $payor->payor_name }}
                @endif
            </td>
            <td>
                @if($client)
                    {{$client->client_full_name}}
                @endif
            </td>
            <td>{{\Carbon\Carbon::parse($claim_details->schedule_date)->format('m/d/Y')}}</td>
            <td>{{$claim_details->cpt}}</td>
            <td>{{$claim_details->m1}}</td>
            <td>{{$claim_details->m2}}</td>
            <td>{{$claim_details->m3}}</td>
            <td>{{$claim_details->m4}}</td>
            <td>{{is_numeric($claim_details->units)?number_format($claim_details->units,2):$claim_details->units}}</td>
            <td>{{is_numeric($claim_details->billed_am)?number_format($claim_details->billed_am,2):$claim_details->billed_am}}</td>
            <td>{{\Carbon\Carbon::parse($claim_details->created_at)->format('m/d/Y')}}</td>
            <td>
                @if ($dep_app_trac)
                    {{is_numeric($dep_app_trac->payment) ? number_format($dep_app_trac->payment,2) : $dep_app_trac->payment}}
                @else
                    0.00
                @endif
                {{--            {{is_numeric($dep_app_trac) ? number_format($dep_app_trac,2) : $dep_app_trac->payment}}--}}

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
