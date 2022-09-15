<table class="table-sm table table-bordered mt-2 mb-2 c_table">
    <thead>
    <tr>
        <th>Patient Name</th>
        <th>Service</th>
        <th>Max By</th>
        <th>Frequency</th>
        <th>Auth</th>
        <th>Scheduled</th>
        <th>Rendered</th>
        <th>Remaining</th>
        <th>Start Date</th>
        <th>End Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($appoientment as $app)
        <?php

        $activity = \App\Models\Client_authorization_activity::where('id', $app->authorization_activity_id)->first();
        $appo = \App\Models\Appoinment::select('client_id','billable')->where('id', $app->id)->first();
        $scheduled_hrs_get = \App\Models\Appoinment::where('admin_id', Auth::user()->admin_id)->where('authorization_activity_id', $activity->id)
            ->sum('time_duration');
        $rendered_hrs_get = \App\Models\Appoinment::where('admin_id', Auth::user()->admin_id)->where('authorization_activity_id', $activity->id)
            ->sum('time_duration');
        $scheduled_hrs = $scheduled_hrs_get / 60;
        $rendered_hrs = $rendered_hrs_get / 60;

        $rem_hours = $activity->hours_max_is_one - $scheduled_hrs;
        $all_sub_acts = \App\Models\all_sub_activity::where('admin_id', Auth::user()->admin_id)->get();
        $cpt_cores = \App\Models\setting_service::where('admin_id', Auth::user()->admin_id)->get();
        $get_ext_act_app = \App\Models\Appoinment::select('authorization_activity_id')
            ->where('authorization_activity_id', $activity->id)
            ->count();
        $client_info = \App\Models\Client::select('id','client_full_name')->where('id',$appo->client_id)->first();
        ?>
        <tr>
            <td>
                @if($appo->billable == 1)
                    @if($client_info)
                        {{$client_info->client_full_name}}
                    @endif
                @else
                    Non-Billable Client
                @endif
            </td>
            <td>{{ $activity->activity_one }} {{ $activity->activity_two }}</td>
            <td>
                @if ($activity->hours_max_one == 1)
                    Hours
                @elseif($activity->hours_max_one == 2)
                    Amount
                @elseif($activity->hours_max_one == 3)
                    Unit
                @else
                    Not Set
                @endif
            </td>
            <td>{{ $activity->hours_max_per_one }}</td>
            <td>{{ $activity->hours_max_is_one }}</td>
            <td>
                @if ($scheduled_hrs <= 1)
                    @if ($scheduled_hrs > $activity->hours_max_is_one)
                        - {{ $scheduled_hrs }}
                        @if ($activity->hours_max_one == 1)
                            Hr
                        @elseif ($activity->hours_max_one == 2)
                            Am
                        @elseif ($activity->hours_max_one == 3)
                            Unit
                        @endif

                    @else
                        {{ $scheduled_hrs }}
                        @if ($activity->hours_max_one == 1)
                            Hrs
                        @elseif ($activity->hours_max_one == 2)
                            Am
                        @elseif ($activity->hours_max_one == 3)
                            Unit
                        @endif
                    @endif

                @else
                    @if ($scheduled_hrs > $activity->hours_max_is_one)
                        {{ $scheduled_hrs }} @if ($activity->hours_max_one == 1)
                            Hrs
                        @elseif ($activity->hours_max_one == 2)
                            Am
                        @elseif ($activity->hours_max_one == 3)
                            Unit
                        @endif
                    @else
                        {{ $scheduled_hrs }} @if ($activity->hours_max_one == 1)
                            Hrs
                        @elseif ($activity->hours_max_one == 2)
                            Am
                        @elseif ($activity->hours_max_one == 3)
                            Unit
                        @endif
                    @endif
                @endif
            </td>
            <td>
                @if ($rendered_hrs <= 1)
                    {{ $rendered_hrs }} @if ($activity->hours_max_one == 1)
                        Hr
                    @elseif ($activity->hours_max_one == 2)
                        Am
                    @elseif ($activity->hours_max_one == 3)
                        Unit
                    @endif
                @else
                    {{ $rendered_hrs }} @if ($activity->hours_max_one == 1)
                        Hrs
                    @elseif ($activity->hours_max_one == 2)
                        Am
                    @elseif ($activity->hours_max_one == 3)
                        Unit
                    @endif
                @endif
            </td>
            <td>
                @if ($rem_hours <= 1)
                    {{ $rem_hours }} @if ($activity->hours_max_one == 1)
                        Hr
                    @elseif ($activity->hours_max_one == 2)
                        Am
                    @elseif ($activity->hours_max_one == 3)
                        Unit
                    @endif
                @else
                    {{ $rem_hours }} @if ($activity->hours_max_one == 1)
                        Hrs
                    @elseif ($activity->hours_max_one == 2)
                        Am
                    @elseif ($activity->hours_max_one == 3)
                        Unit
                    @endif
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($activity->onset_date)->format('m/d/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($activity->end_date)->format('m/d/Y') }}</td>
           
        </tr>
    @endforeach
    </tbody>
</table>
