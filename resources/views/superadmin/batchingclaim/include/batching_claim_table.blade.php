@foreach($sessions as $bat_claim)
    <?php
    if (Auth::user()->is_up_admin == 1) {
        $admin_id = Auth::user()->id;
    } else {
        $admin_id = Auth::user()->up_admin_id;
    }

    $proc_claim = \App\Models\Processing_claim::select('id', 'admin_id', 'time_duration')
        ->where('id', $bat_claim->processing_claim_id)
        ->where('admin_id', $admin_id)
        ->first();


    $claint = \App\Models\Client::select('id', 'admin_id', 'client_full_name')->where('id', $bat_claim->client_id)
        ->where('admin_id', $admin_id)
        ->first();

    $provider = \App\Models\Employee::select('id', 'admin_id', 'full_name')->where('id', $bat_claim->provider_id)
        ->where('admin_id', $admin_id)
        ->first();
    $cms_24_provider = \App\Models\Employee::select('id', 'admin_id', 'full_name')->where('id', $bat_claim->cms_24j)
        ->where('admin_id', $admin_id)
        ->first();

    $payor_name = \App\Models\Payor_facility::select('id', 'admin_id', 'payor_name')
        ->where('admin_id', $admin_id)
        ->where('payor_id', $bat_claim->payor_id)
        ->first();

    ?>
    <tr>
        <td>
            @if ($claint)
                {{$claint->client_full_name}}
                <input type="hidden" name="batching_claim_id" value="{{$bat_claim->id}}">
                <input type="hidden" name="batching_claim_rate" value="{{$bat_claim->rate}}">
            @endif


        </td>
        <td>
            @if ($cms_24_provider)
                {{$cms_24_provider->full_name}}
            @endif

        </td>
        <td>
            @if ($provider)
                {{$provider->full_name}}
            @endif
        </td>
        <td>

            @if ($payor_name)
                {{$payor_name->payor_name}}
            @endif
        </td>
        <td data-tableexport-display="none">
            <?php
            $activity = \App\Models\Client_authorization_activity::where('id', $bat_claim->activity_id)->first();
            if ($proc_claim) {
                $hours = $proc_claim->time_duration / 60;
            } else {
                $hours = '';
            }

            ?>
            @if ($activity)
                {{$activity->activity_name}} ({{number_format((double)$hours,2)}} Hrs)
            @endif

        </td>
        <td style="display: none;" data-tableexport-display="always">
            @if ($activity)
                {{$activity->activity_name}}
            @endif
        </td>
        <td style="display: none;" data-tableexport-display="always">
            {{number_format((double)$hours,2)}}
        </td>
        <td style="display: none;" data-tableexport-display="always">
            <?php
                $auth_num = \App\Models\Client_authorization::select('id','authorization_number')->where('id',$bat_claim->authorization_id)->first();
                if($auth_num){
                    $auth_num = $auth_num->authorization_number;
                }
                else{
                    $auth_num = '';
                }
            ?>
            {{$auth_num}}
        </td>
        <td>{{\Carbon\Carbon::parse($bat_claim->schedule_date)->format('m/d/Y')}}</td>
        <td>{{$bat_claim->cpt}}</td>
        <td>{{$bat_claim->location}}</td>
        <td>{{$bat_claim->m1}}</td>
        <td>{{$bat_claim->m2}}</td>
        <td>{{$bat_claim->m3}}</td>
        <td>{{$bat_claim->m4}}</td>
        <td>
            {{number_format((float)$bat_claim->billed_am,2)}}
        </td>
        <td>
            {{ number_format((float)$bat_claim->units,2)}}
        </td>
        {{-- <td>{{$bat_claim->status}}</td> --}}

    </tr>
@endforeach
