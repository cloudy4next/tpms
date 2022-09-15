<table class="table table-sm table-bordered c_table">
    <thead>
    <tr>
        <th><input type="checkbox" class="transaction_check_all"></th>
        <th>Claim</th>
        <th>Pt. Name</th>
        <th>Ins</th>
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
        @if($name_location->is_combo == 1)
            <th>Auth No.</th>
        @endif
    </tr>
    </thead>
    <tbody>

    @foreach($query_exe as $data)
        <?php
        if(Auth::user()->is_up_admin==1){
            $admin_id=Auth::user()->id;
        }
        else{
            $admin_id=Auth::user()->up_admin_id;
        }

        $dep_app_trac = \App\Models\deposit_apply_transaction::select('id', 'admin_id', 'batching_claim_id', 'appointment_id', 'payment')
            ->where('admin_id', $admin_id)
            ->where('appointment_id', $data->appointment_id)
            ->first();

        $auth = \App\Models\Client_authorization::select('id', 'admin_id', 'authorization_number')
            ->where('admin_id', $admin_id)
            ->where('id', $data->authorization_id)
            ->first();

        $pt_name = \App\Models\Client::select('id', 'admin_id', 'client_full_name')
            ->where('admin_id', $admin_id)
            ->where('id', $data->client_id)
            ->first();

        $payor_name = \App\Models\All_payor_detail::select('id', 'admin_id', 'payor_name')
            ->where('admin_id', $admin_id)
            ->where('payor_id', $data->payor_id)
            ->first();

        ?>
        <tr>
            <td>
                @if ($dep_app_trac)
                    <input type="checkbox" class="" value="{{$data->id}}" disabled>
                @else
                    <input type="checkbox" class="transaction_single" value="{{$data->id}}">
                @endif

            </td>
            <td>{{$data->claim_id}}</td>
            <td>
                @if($pt_name)
                    {{$pt_name->client_full_name}}
                @endif
            </td>
            <td>
                @if($payor_name)
                    {{$payor_name->payor_name}}
                @endif
            </td>
            <td>{{\Carbon\Carbon::parse($data->schedule_date)->format('m/d/Y')}}</td>
            <td>{{$data->cpt}}</td>
            <td>{{$data->m1}}</td>
            <td>{{$data->m2}}</td>
            <td>{{$data->m3}}</td>
            <td>{{$data->m4}}</td>
            <td>{{is_numeric($data->units)?number_format($data->units,2):$data->units}}</td>
            <td>{{is_numeric($data->billed_am)?number_format($data->billed_am,2):$data->billed_am}}</td>
            <td>{{\Carbon\Carbon::parse($data->created_at)->format('m/d/Y')}}</td>
            <td>
                @if ($dep_app_trac)
                    {{is_numeric($dep_app_trac->payment) ? number_format($dep_app_trac->payment,2) : $dep_app_trac->payment}}
                @else
                    0.00
                @endif
                {{--            {{is_numeric($dep_app_trac) ? number_format($dep_app_trac,2) : $dep_app_trac->payment}}--}}

            </td>
            @if($name_location->is_combo == 1)
                <td>{{ $data->auth_no }}</td>
            @endif
        </tr>
    @endforeach

    </tbody>
</table>
