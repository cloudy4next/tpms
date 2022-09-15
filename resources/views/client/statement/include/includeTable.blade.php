<table class="table table-sm table-bordered c_table statement_table">
    <thead>
    <tr>
        <th class="checkbox"><input type="checkbox" class="select_all"></th>
        <th>Service Date</th>
        <th>Description</th>
        <th>Copay</th>
        <th>Coins</th>
        <th>Deductible</th>
    </tr>
    </thead>
    <tbody>
    @foreach($client_statements as $dep_dat)
        <?php
            $act_name = \App\Models\Client_authorization_activity::where('id', $dep_dat->activity_id)->where('admin_id', Auth::user()->admin_id)->first();
        ?>
        <tr>
            <td>
                <input type="checkbox" class="m-0 st_checked" value="{{$dep_dat->id}}">
            </td>
            <td>{{\Carbon\Carbon::parse($dep_dat->service_date)->format('m/d/Y')}}</td>
            <td>
                @if ($act_name)
                    {{$act_name->activity_name}}
                @endif
            </td>
            <td>
                @if ($dep_dat->status == "PR Copay")
                    {{number_format($dep_dat->co_pay,2)}}
                @else
                    0.00
                @endif
            </td>
            <td>
                @if ($dep_dat->status == "PR CoIns")
                    {{number_format($dep_dat->coins,2)}}
                @else
                    0.00
                @endif
            </td>
            <td>
                @if ($dep_dat->status == "PR Ded")
                    {{number_format($dep_dat->ded,2)}}
                @else
                    0.00
                @endif
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
