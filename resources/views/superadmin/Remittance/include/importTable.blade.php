<table class="table table-sm table-bordered c_table">
    <thead>
        <tr>
            <th><input type="checkbox" class="all_check"></th>
            <th>Billing ID</th>
            <th>Claim</th>
            <th>Service Date</th>
            <th>Cpt</th>
            <th>M1</th>
            <th>Payer</th>
            <th>Billed Amt</th>
            <th>Paid Amt</th>
            <th>Adj Amt</th>
            <th>Pat. Res.</th>
            <th>Mode</th>
            <th>Check Date</th>
            <th>Check No</th>
            <th>Check Amt</th>
            <th>Acc No</th>
            <th>Auth ID</th>
            <th>M2</th>
            <th>M3</th>
            <th>M4</th>
            <th>Claim Type</th>
        </tr>
    </thead>
    <tbody>

        @foreach($ncd as $rec)
        <tr>
            <td><input type="checkbox" class="in_check" id="{{$rec->id}}"></td>
            <td>Billing ID</td>
            <td>Claim</td>
            <td>{{$rec->service_date}}</td>
            <td>{{$rec->cpt}}</td>
            <td>M1</td>
            <td>Payer</td>
            <td>Billed Amt</td>
            <td>{{$rec->paid_amount}}</td>
            <td>Adj Amt</td>
            <td>Pat. Res.</td>
            <td>Mode</td>

            @php
                $check=\App\Models\eremittance_checkdata::where('id',$rec->eremit_check_id)->first();

            @endphp


            @if($check)
            <td>{{$check->check_date==null?'':\Carbon\Carbon::parse($check->check_date)->format('m/d/Y')}}</td>
            <td>{{$check->check_number}}</td>
            <td>{{$check->check_amount}}</td>
            @else
            <td></td>
            <td></td>
            <td></td>
            @endif
            <td>Acc No</td>
            <td>Auth ID</td>
            <td>M2</td>
            <td>M3</td>
            <td>M4</td>
            <td>Claim Type</td>
        </tr>
        @endforeach
    </tbody>
</table>