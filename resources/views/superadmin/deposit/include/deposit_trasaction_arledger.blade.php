<table class="table-bordered table table-sm c_table">
    <thead>
    <tr>
        <th>DOS</th>
        <th>CPT</th>
        <th>M1</th>
        <th>M2</th>
        <th>M3</th>
        <th>M4</th>
        <th>Billed Amt.</th>
        <th>Adj.</th>
        <th>Payment By</th>
        <th>Payment No.</th>
        <th>Payment Date</th>
        <th>Posted by</th>
    </tr>
    </thead>
    <tbody>
    @foreach($deposits as $deposit)
        <?php
        $dep_app = \App\Models\deposit_apply::where('id',$deposit->deposit_apply_id)->first();
        $dep = \App\Models\deposit::where('id',$dep_app->deopsit_id)->first();
        ?>
    <tr>
        <td>{{\Carbon\Carbon::parse($deposit->dos)->format('m/d/Y')}}</td>
        <td>{{$deposit->cpt}}</td>
        <td>{{$deposit->m1}}</td>
        <td>{{$deposit->m2}}</td>
        <td>{{$deposit->m3}}</td>
        <td>{{$deposit->m4}}</td>
        <td>{{number_format($deposit->amount,2)}}</td>
        <td>{{number_format($deposit->adjustment,2)}}</td>
        <td>{{$deposit->who_paid}}</td>
        <td>{{$deposit->instrument_no}}</td>
        <td>{{\Carbon\Carbon::parse($deposit->created_at)->format('m/d/Y')}}</td>
        <td>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
