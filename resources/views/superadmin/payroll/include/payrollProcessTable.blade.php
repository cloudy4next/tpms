<table class="table table-sm table-bordered c_table" id="export_table">
    <thead>
    <tr>
        <th data-tableexport-display="none" class="checkbox1"><input type="checkbox" class="check_all_process"></th>
        <th class="time-date">Time & Date</th>
        <th class="patient">Provider</th>
        <th class="patient">Patient</th>
        <th class="srvc-location">Srvc. Location</th>
        <th class="service">Service</th>
        <th class="tx-hrs">Tx Hrs</th>
        <th class="submiss-hrs">Submission Hrs.</th>
        <th class="hrs.accept" style="width: 60px;">Hrs. Accepted</th>
        <th class="milage">Mileage</th>
        <th class="milage-approve" style="width: 60px;">Mileage Approved</th>
    </tr>
    </thead>
    <tbody>
    @foreach($query_exe as $query)
        <?php
            $app = \App\Models\Appoinment::select('schedule_date', 'location', 'authorization_id', 'time_duration','billable')->where('id', $query->appointment_id)->first();
        ?>
        @if($app)
            <?php
            $client = \App\Models\Client::select('client_full_name')->where('id', $query->client_id)->first();
            $auth = \App\Models\Client_authorization::select('authorization_name')->where('id', $app->authorization_id)->first();
            $time = $app->time_duration / 60;
            if (!empty($query->timein_one) && !empty($query->timein_two) && !empty($query->timein_three) && !empty($query->timeout_one) && !empty($query->timeout_two) && !empty($query->timeout_three)) {
                $count_time_one = (($query->timein_one . ':' . $query->timein_two) . ' ' . $query->timein_three);
                $count_time_two = (($query->timeout_one . ':' . $query->timeout_two) . ' ' . $query->timeout_three);
                $date = \Carbon\Carbon::parse($count_time_one)->format("H:i:s");
                $date2 = \Carbon\Carbon::parse($count_time_two)->format("H:i:s");

                $final_hrs = \Carbon\Carbon::parse($date)->diff($date2)->format('%H:%i');


                $hourdiff = round((strtotime($date2) - strtotime($date)) / 3600, 2);
            } else {
                $final_hrs = 0;
                $hourdiff = 0;
            }


            ?>
            <tr>
                <td data-tableexport-display="none"><input type="checkbox" class="checked_process" value="{{$query->id}}"></td>
                <td>{{\Carbon\Carbon::parse($app->schedule_date)->format('m/d/Y')}}</td>
                <td>
                    {{$query->full_name}}
                </td>
                <td>
                    @if($client)
                    {{$client->client_full_name}}
                    @elseif($app->billable==2)
                        Non-Billable Client
                    @endif
                </td>
                <td>
                    {{$app->location}}
                </td>
                <td>
                    @if($auth)
                    {{$auth->authorization_name}}
                    @elseif($app->billable==2)
                        NONCLI01323_AUTH249
                    @endif
                </td>
                <td>
                    {{number_format($time,2)}}
                </td>
                <td>
                    @if($hourdiff < 0)
                        {{abs(number_format($hourdiff,2))}}
                        <input type="hidden" class="hours_renders" name="hours_renders" value="{{abs($hourdiff)}}">
                    @else
                        {{number_format($hourdiff,2)}}
                        <input type="hidden" class="hours_renders" name="hours_renders" value="{{$hourdiff}}">
                    @endif
                </td>
                <td style="display: none;" data-tableexport-display="always">
                    {{$query->acceped_hours}}
                </td>
                <td data-tableexport-display="none">
                    @if($query->acceped_hours===NUll)
                        <input type="text" class="form-control form-control-sm acc_hours" name="acc_hours" value="">
                    @else
                        <input type="text" class="form-control form-control-sm acc_hours" name="acc_hours" value="{{$query->acceped_hours}}">

                    @endif
                </td>
                <td>
                    {{$query->miles}}
                    <input type="hidden" class="miles_renders" name="miles_renders" value="{{$query->miles}}">
                </td>
                <td style="display: none;" data-tableexport-display="always">
                    {{$query->acceped_mileage}}
                </td>
                <td data-tableexport-display="none">
                    @if($query->acceped_mileage===NULL)
                        <input type="text" class="form-control form-control-sm acc_miles" name="acc_miles" value="">
                    @else
                        <input type="text" class="form-control form-control-sm acc_miles" name="acc_miles" value="{{$query->acceped_mileage}}">
                    @endif
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
