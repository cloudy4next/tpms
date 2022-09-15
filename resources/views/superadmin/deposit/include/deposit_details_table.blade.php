<table class="table-bordered table table-sm c_table" id="export_table2">
    <thead>
    <tr>
        <th data-tableexport-display="none">
            <input type="checkbox" class="dep_details_check">
        </th>
        <th>Check Date</th>
        <th>Check No</th>
        <th>Payee</th>
        <th>Type</th>
        <th>Patient</th>
        <th>DOS</th>
        <th>Code</th>
        <th>M1</th>
        <th>Amount</th>
        <th>Payment</th>
        <th>Adjustment</th>
        <th>Reason</th>
        <th>Status</th>
        <th>M2</th>
        <th>M3</th>
        <th>M4</th>
        <th>CreatedDate</th>
        <th>CreatedBy</th>
    </tr>
    </thead>
    <tbody>
    <?php

        $t_amount=0;
        $t_paid=0;
        $t_adj=0;
    ?>
    @foreach($deposits_details as $deyails)
        <?php
            $dep = \App\Models\deposit::where('id',$deyails->deopsit_id)->first();
            $client = \App\Models\Client::where('id',$deyails->client_id)->first();
            $payor = \App\Models\All_payor::where('id',$deyails->payor_id)->first();
        ?>
    <tr>
        <td data-tableexport-display="none">
            <input type="checkbox" class="details_checked" value="{{$deyails->id}}">
        </td>
        <td>{{\Carbon\Carbon::parse($dep->deposit_date)->format('m/d/Y')}}</td>
        <td>{{$dep->instrument}}</td>
        <td>{{$payor->payor_name}}</td>
        <td>
            @if ($dep->payor_type == 1)
                Client
            @else
                Payor
            @endif
        </td>
        <td>
            @if ($client)
                {{$client->client_first_name}} {{$client->client_middle}} {{$client->client_last_name}}
            @endif
        </td>
        <td>{{\Carbon\Carbon::parse($deyails->dos)->format('m/d/Y')}}</td>
        <td>{{$deyails->cpt}}</td>
        <td>{{$deyails->m1}}</td>
        <td>
            <?php $t_amount+=$deyails->amount;?>
            {{$deyails->amount}}
        </td>
        <td>
            <?php $t_paid+=$deyails->payment;?>
            {{$deyails->payment}}
        </td>
        <td>
            <?php $t_adj+=$deyails->adjustment;?>
            {{$deyails->adjustment}}
        </td>
        <td>{{$deyails->reason}}</td>
        <td>{{$deyails->status}}</td>
        <td>{{$deyails->m2}}</td>
        <td>{{$deyails->m3}}</td>
        <td>{{$deyails->m4}}</td>
        <td>{{\Carbon\Carbon::parse($deyails->created_at)->format('m/d/Y')}}</td>
        <td>Admin</td>
    </tr>
    @endforeach
    <tr style="display: none;" data-tableexport-display="always">
        <th colspan="8">Total</th>
        <th>{{number_format($t_amount,2)}}</th>
        <th>{{number_format($t_paid,2)}}</th>
        <th>{{number_format($t_adj,2)}}</th>
        <th colspan="7"></th>
    </tr>
    </tbody>
</table>
