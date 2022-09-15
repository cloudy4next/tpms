<table class="table-bordered table table-sm c_table" id="export_table2">
    <thead>
    <tr>
        <th>DOS</th>
        <th>CPT</th>
        <th>M1</th>
        <th>M2</th>

        <th>Billed Amt.</th>
        <th>Payment Amt.</th>
        <th>Adj Amt.</th>
        <th>Status</th>
        <th>Payment By</th>
        <th>Instrument No.</th>
        <th>Payment Date</th>
        <th>Posted by</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $t_allow = 0.00;
        $t_paid = 0.00;
        $t_adj = 0.00;
    ?>
    @foreach($deposits_apllys_trans as $trans)
        <?php
        $dep_app = \App\Models\deposit_apply::where('id', $trans->deposit_apply_id)->first();
        $dep = \App\Models\deposit::where('id', $dep_app->deopsit_id)->first();
        $dep_app_tran = \App\Models\deposit_apply_transaction::where('deposit_apply_id', $dep_app->id)->first();
        $t_allow += (double)$trans->amount;

        ?>
        <tr>

            <td>{{\Carbon\Carbon::parse($trans->dos)->format('m/d/Y')}}</td>
            <td>{{$trans->cpt}}</td>
            <td>{{$trans->m1}}</td>
            <td>{{$trans->m2}}</td>
            <td>{{number_format($trans->amount,2)}}</td>
            <td>
                @if ($dep_app_tran)
                    <?php
                        $t_paid += (double)$dep_app_tran->payment;
                    ?>
                    {{number_format($dep_app_tran->payment,2)}}
                @endif

            </td>
            <td>
                @if ($dep_app_tran)
                    <?php
                        $t_adj += (double)$dep_app_tran->adjustment;
                    ?>
                    {{number_format($dep_app_tran->adjustment,2)}}
                @endif

            </td>
            <td>
                @if ($dep_app_tran)
                    {{$dep_app_tran->status}}
                @endif
            </td>

            <td>{{$trans->who_paid}}</td>
            <td><a href="{{route('superadmin.deposit.view.details',$dep->id)}}"
                   target="_blank">{{$trans->instrument_no}}</a></td>
            <td>{{\Carbon\Carbon::parse($trans->created_at)->format('m/d/Y')}}</td>
            <td>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" class="text-right">Total</td>
            <td><span class="total_allowed">{{number_format($t_allow,2)}}</span></td>
            <td><span class="total_payment">{{number_format($t_paid,2)}}</span></td>
            <td><span class="total_adj">{{number_format($t_adj,2)}}</span></td>
            <td colspan="5"></td>
        </tr>
    </tfoot>
</table>
