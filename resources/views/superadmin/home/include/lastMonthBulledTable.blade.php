<?php

    if(\Auth::user()->is_up_admin==1){
        $admin_id=\Auth::user()->id;
    }
    else{
        $admin_id=\Auth::user()->up_admin_id;
    }


?>


<table class="table table-sm table-bordered c_table" id="export_table">
    <thead>
    <tr>
        <th>Batch No</th>
        <th>Date</th>
        <th>Total</th>
        <th data-tableexport-display="none">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($last_month_claim as $bulled_claim)
        <?php
            $manange_claim = \App\Models\manage_claim::where('batch_id', $bulled_claim->batch_id)
                ->where('admin_id',$admin_id)
                ->first();
            $payor = \App\Models\All_payor::where('id', $manange_claim->payor_id)->first();
            $client = \App\Models\Client::select('id', 'admin_id', 'client_full_name')->where('id', $manange_claim->client_id)
                ->where('admin_id',$admin_id)
                ->first();

            $total = \App\Models\manage_claim_transaction::where('admin_id', $admin_id)
                ->where('batch_id', $manange_claim->batch_id)
                ->sum('billed_am');

        ?>
        <tr>
            <td>{{$manange_claim->batch_id}}</td>
            <td>{{\Carbon\Carbon::parse($manange_claim->created_at)->format('m/d/Y')}}</td>
            <td>{{is_numeric($total) ? number_format($total,2):$total}}</td>
            <td data-tableexport-display="none">
                <button type="button" title="Details" class="btn p-0 detail batchdetails"
                        data-id="{{$manange_claim->batch_id}}"><i
                        class="ri-file-line text-primary"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


