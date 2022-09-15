<?php

    if(Auth::user()->is_up_admin == 1){
        $admin_id = Auth::user()->id;
    }
    else{
        $admin_id = Auth::user()->up_admin_id;
    }

?>

<table class="table table-sm table-bordered c_table" id="etable">
    <thead>
    <tr>
        <th>Patient</th>
        <th>Service & Hrs</th>
        <th>Provider</th>
        <th>POS</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Hours</th>
        <th width="10%">Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($recurring_sessions as $rec_ses)
        <?php
        $start_time = \Carbon\Carbon::parse($rec_ses->schedule_date_start)->format('m/d/Y');
        $end_time = \Carbon\Carbon::parse($rec_ses->schedule_date_end)->format('m/d/Y');
        $hours_form = \Carbon\Carbon::parse($rec_ses->horus_form)->format('h:i a');
        $hours_to = \Carbon\Carbon::parse($rec_ses->horus_to)->format('h:i a');
        $minutes = \Carbon\Carbon::parse($rec_ses->horus_form)->diffInMinutes(\Carbon\Carbon::parse($rec_ses->horus_to));
        $t_h = number_format($minutes/60,2);

        ?>
        <tr>
            <td>
                @if($rec_ses->client_id == null)
                    Non-Billable Client
                @else
                    {{ $rec_ses->client_name }}
                @endif
            </td>
            <td>
                @if($rec_ses->activity_name == null)
                    
                @else
                    {{ $rec_ses->activity_name }}
                @endif

                @if($t_h >1)
                    ({{$t_h}} Hrs)</td>
                @else
                    ({{$t_h}} Hr)</td>
                @endif
            <td>{{ $rec_ses->provider_name }}</td>
            <td>
            <?php
                $place_of_ser = \App\Models\point_of_service::where('admin_id', $admin_id)
                        ->where('pos_code', $rec_ses->location)->first();

                ?>

                @if ($place_of_ser)
                    @if($place_of_ser->pos_code=="02" || $place_of_ser->pos_code=="10")
                        {{$place_of_ser->pos_name}} <i class="fa fa-video-camera text-success"></i>
                    @else
                        {{$place_of_ser->pos_name}}
                    @endif
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($rec_ses->schedule_date_start)->format('m/d/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($rec_ses->schedule_date_end)->format('m/d/Y') }}</td>
            <td>{{ $hours_form }} to {{ $hours_to }}</td>
            <td>
                
            @php
                if($rec_ses->status=="Rendered")    $color="badge-success";
                else if($rec_ses->status=="Scheduled")    $color="badge-secondary";
                else if($rec_ses->status=="No Show")    $color="badge-danger";
                else if($rec_ses->status=="Cancelled by Client")    $color="badge-primary";
                else if($rec_ses->status=="Cancelled by Provider")    $color="badge-primary";
                else $color="badge-light";
            @endphp

            <span class="badge {{$color}} font-weight-normal">{{$rec_ses->status}}</span>
            </td>
            <td><a href="{{ route('superadmin.edit.recurring.session', $rec_ses->id) }}"><i
                        class="fa fa-pencil-square-o" title="Edit"></i></td>
        </tr>
    @endforeach


    </tbody>
</table>
