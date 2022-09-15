<table class="table table-sm table-bordered c_table matched">
    <thead>
        <tr>
            <th>Control Number</th> 
            {{-- <th>Claim</th> --}}
            <th>Service Date</th>
            <th>Cpt</th>
            <th>Submitted Amt.</th>
            {{-- <th>M1</th>
            <th>Payer</th>
            <th>Billed Amt</th> --}}
            <th>Paid Amt</th>
            <th>Copay</th>
            <th>CoIns.</th>
            <th>Ded.</th>
            {{-- <th>Adj Amt</th>
            <th>Pat. Res.</th>
            <th>Mode</th> --}}
            <th>Adj. 1</th>
            <th>Adj. 2</th>
            <th>Adj. 3</th>
            <th>Adj. 4</th>
            <th>Adj. 5</th>
            <th>WriteOff</th>
            {{-- <th>Acc No</th>
            <th>Auth ID</th>
            <th>M2</th>
            <th>M3</th>
            <th>M4</th>
            <th>Claim Type</th> --}}
        </tr>
    </thead>
    <tbody>

    @foreach($check_array as $check)
        @php
            $check_date=$check["check_date"];
            $check_number=$check["check_number"];
            $check_amount=$check["check_amount"];
            $t_submit=0;
            $t_paid=0;
            $t_copay=0;
            $t_conis=0;
            $t_ded=0;
            $t_adj1=0;
            $t_adj2=0;
            $t_adj3=0;
            $t_adj4=0;
            $t_adj5=0;
            $t_wo=0;

        @endphp
        @foreach($check["ERAVisitPayments"] as $visit)
            @foreach($visit["ERAChargePayments"] as $charge)

                @php
                    $t_submit+=$charge["submitted_amount"];
                    $t_paid+=$charge["paid_amount"];
                    $t_copay+=$charge["copay_amount"];
                    $t_conis+=$charge["coins_amount"];
                    $t_ded+=$charge["ded_amount"];
                    $t_adj1+=$charge["other_adj_amt_one"];
                    $t_adj2+=$charge["other_adj_amt_two"];
                    $t_adj3+=$charge["other_adj_amt_three"];
                    $t_adj4+=$charge["other_adj_amt_four"];
                    $t_adj5+=$charge["other_adj_amt_five"];
                    $t_wo+=$charge["write_off_amount"];
                @endphp
                <tr>
                    <input type="hidden" id="charge_control_number" value="{{$charge["charge_control_number"]}}">
                    <td>{{$charge["charge_control_number"]}}</td>
                    {{-- <td>Claim</td> --}}
                    <td>{{$charge["service_date"]==null?'':\Carbon\Carbon::parse($charge["service_date"])->format('m/d/Y')}}</td>
                    <td>{{$charge["cpt"]}}</td>
                    <td>{{$charge["submitted_amount"]}}</td>
                    {{-- <td>M1</td>
                    <td>Payer</td>
                    <td>Billed Amt</td> --}}
                    <td>{{$charge["paid_amount"]}}</td>
                    <td>{{$charge["copay_amount"]}}</td>
                    <td>{{$charge["coins_amount"]}}</td>
                    <td>{{$charge["ded_amount"]}}</td>
                    <td>{{$charge["other_adj_amt_one"]}}</td>
                    <td>{{$charge["other_adj_amt_two"]}}</td>
                    <td>{{$charge["other_adj_amt_three"]}}</td>
                    <td>{{$charge["other_adj_amt_four"]}}</td>
                    <td>{{$charge["other_adj_amt_five"]}}</td>
                    <td>{{$charge["write_off_amount"]}}</td>
                    {{-- <td>Adj Amt</td>
                    <td>Pat. Res.</td>
                    <td>Mode</td> --}}
                    {{-- <td>Acc No</td>
                    <td>Auth ID</td>
                    <td>M2</td>
                    <td>M3</td>
                    <td>M4</td>
                    <td>Claim Type</td> --}}
                </tr>


            @endforeach
        @endforeach
                <tr>
                    <th colspan="3">Total</th>
                    <th>{{$t_submit}}</th>
                    <th>{{$t_paid}}</th>
                    <th>{{$t_copay}}</th>
                    <th>{{$t_conis}}</th>
                    <th>{{$t_ded}}</th>
                    <th>{{$t_adj1}}</th>
                    <th>{{$t_adj2}}</th>
                    <th>{{$t_adj3}}</th>
                    <th>{{$t_adj4}}</th>
                    <th>{{$t_adj5}}</th>
                    <th>{{$t_wo}}</th>
                </tr>
    @endforeach
    </tbody>
</table>