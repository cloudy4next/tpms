@php
    if (\Auth::user()->is_up_admin == 1) {
        $admin_id = \Auth::user()->id;
    } else {
        $admin_id = \Auth::user()->up_admin_id;
    }
@endphp

<table class="table table-sm table-bordered c_table" id="export_table">
    <thead>
        <tr>
            <th>Patient Last Name</th>
            <th>Patient First Name</th>
            <th>Supervisor</th>
            <th>Insurance</th>
            <th>Authorization Number</th>
            <th>Date Authorization Expires</th>
        </tr>
    </thead>
    <tbody>
        @foreach($client_auths as $cl_auth)
            <?php
            $client_name = \App\Models\Client::select('client_first_name', 'client_last_name')
                ->where('id', $cl_auth->client_id)->where('admin_id',$admin_id)
                ->first();
            $paor_name = \App\Models\All_payor::select('payor_name')->where('id', $cl_auth->payor_id)->first();
            $sup = \App\Models\Employee::select('id', 'admin_id', 'full_name')->where('id', $cl_auth->supervisor_id)->where('admin_id',$admin_id)->first();
            ?>
            <tr>
                <td>
                    @if ($client_name)
                        {{$client_name->client_last_name}}
                    @endif

                </td>
                <td>
                    @if ($client_name)
                        {{$client_name->client_first_name}}
                    @endif

                </td>
                <td>
                    @if ($sup)
                        {{$sup->full_name}}
                    @endif

                </td>
                <td>
                    @if ($paor_name)
                        {{$paor_name->payor_name}}
                    @endif

                </td>
                <td>
                    {{$cl_auth->authorization_number}}
                </td>
                <td>{{\Carbon\Carbon::parse($cl_auth->end_date)->format('m/d/Y')}}</td>
            </tr>
        @endforeach

    </tbody>
</table>