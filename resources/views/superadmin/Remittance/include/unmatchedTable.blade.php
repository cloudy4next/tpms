<table class="table table-sm table-bordered c_table unmatched">
    <thead>
        <tr>
            {{-- <th>Billing ID</th>
            <th>Claim</th> --}}
            <th>Service Date</th>
            <th>Cpt</th>
            {{-- <th>M1</th>
            <th>Payer</th>
            <th>Billed Amt</th> --}}
            <th>Paid Amt</th>
            {{-- <th>Adj Amt</th>
            <th>Pat. Res.</th>
            <th>Mode</th> --}}
            <th>Check Date</th>
            <th>Check No</th>
            <th>Check Amt</th>
            {{-- <th>Acc No</th>
            <th>Auth ID</th>
            <th>M2</th>
            <th>M3</th>
            <th>M4</th>
            <th>Claim Type</th> --}}
        </tr>
    </thead>
    <tbody>  
        @foreach($unmatched as $un)
            @php
                $charge=$un["charge_data"];
                $check_date=$un["check_date"];
                $check_number=$un["check_number"];
                $check_amount=$un["check_amount"];
            @endphp
            <tr>
                {{-- <td>Billing ID</td>
                <td>Claim</td> --}}
                <td>{{$charge->service_date}}</td>
                <td>{{$charge->cpt}}</td>
                {{-- <td>M1</td>
                <td>Payer</td>
                <td>Billed Amt</td> --}}
                <td>{{$charge->paid_amount}}</td>
                {{-- <td>Adj Amt</td>
                <td>Pat. Res.</td>
                <td>Mode</td> --}}
                <td>{{$check_date==null?'':\Carbon\Carbon::parse($check_date)->format('m/d/Y')}}</td>
                <td>{{$check_number}}</td>
                <td>{{$check_amount}}</td>
                {{-- <td>Acc No</td>
                <td>Auth ID</td>
                <td>M2</td>
                <td>M3</td>
                <td>M4</td>
                <td>Claim Type</td> --}}
            </tr>
        @endforeach
    </tbody>
</table>