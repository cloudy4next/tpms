<table class="table table-sm table-bordered c_table matched">
    <thead>
        <tr>
           {{--  <th>Billing ID</th> --}}
            <th>Claim</th>
            <th>Service Date</th>
            <th>Cpt</th>
            <th>M1</th>
            <th>Payer</th>
            <th>Billed Amt</th>
            <th>Paid Amt</th>
            <th>Adj Amt</th>
            <th>Pat. Res.</th>
           {{--  <th>Mode</th> --}}
            <th>Check Date</th>
            <th>Check No</th>
            <th>Check Amt</th>
         {{--    <th>Acc No</th> --}}
            <th>Auth ID</th>
            <th>M2</th>
            <th>M3</th>
            <th>M4</th>
       {{--      <th>Claim Type</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach($matched as $match)
            @php
                $rec=$match["charge_data"];
                $check_date=$match["check_date"];
                $check_number=$match["check_number"];
                $check_amount=$match["check_amount"];
                $claim=\App\Models\manage_claim_transaction::where('control_number',$rec->charge_control_number)->first();
                $payor=\App\Models\All_payor::where('id',$claim->payor_id)->first();
                $pr=$rec->copay_amount+$rec->ded_amount+$rec->coins_amount;
                if($rec->write_off_amount!=null && $rec->write_off_amount!=''){
                    $adj=$rec->write_off_amount;
                }
                else{
                    $adj=0.00;
                }
            @endphp
        <tr>
            {{-- <td>Billing ID</td> --}}
            <td>{{$claim->claim_id}}</td>
            <td>{{$rec->service_date}}</td>
            <td>{{$rec->cpt}}</td>
            <td>{{$claim->m1}}</td>
            <td>{{$payor->payor_name}}</td>
            <td>{{$claim->billed_am}}</td>
            <td>{{$rec->paid_amount}}</td>
            <td>{{$adj}}</td>     
            <td>{{$pr}}</td>  {{-- cpay+ded+coin --}}
         {{--    <td>Mode</td> --}}
            <td>{{$check_date==null?'':\Carbon\Carbon::parse($check_date)->format('m/d/Y')}}</td>
            <td>{{$check_number}}</td>
            <td>{{$check_amount}}</td>
         {{--    <td>Acc No</td> --}}
            <td>{{$claim->authorization_id}}</td>
            <td>{{$claim->m2}}</td>
            <td>{{$claim->m3}}</td>
            <td>{{$claim->m4}}</td>
           {{--  <td>Claim Type</td> --}}
        </tr>
        @endforeach
    </tbody>
</table>