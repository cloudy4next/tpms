@php
$admin_id=Auth::user()->admin_id;

$c_check='';
$p_check='';

@endphp

<table class="table table-sm table-bordered c_table" id="export_table">
    <thead>
    <tr>
        <th data-tableexport-display="none">
            <input type="checkbox" class="check_box select_all_ts">
        </th>
        <th>Date</th>
        <th>Provider</th>
        <th>Patient</th>
        <th>Actvity</th>
        <th>Time in</th>
        <th>Time out</th>
        <th>Hours</th>
        <th>Miles</th>
        <th>Submitted</th>
        <td style="display: none;" data-tableexport-display="always">Provider Sig.</td>
        <td style="display: none;" data-tableexport-display="always">Patient Sig.</td>
    </tr>
    </thead>
    <tbody>
    @foreach($query_exe as $query)
        <?php
            $app = \App\Models\Appoinment::select('time_duration', 'from_time', 'to_time', 'authorization_activity_id','billable')->where('id', $query->appointment_id)->first();
        ?>
        @if($app)
            <?php
            $client = \App\Models\Client::select('client_full_name')->where('id', $query->client_id)->first();
            $provider = \App\Models\Employee::select('full_name')->where('id', $query->provider_id)->first();
            $act = \App\Models\Client_authorization_activity::select('activity_name')->where('id', $query->activity_id)->first();

            if($act){
                $service = \App\Models\setting_service::where('description', $act->activity_one)->where('admin_id', $admin_id)->first();
            }
            
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
            $time = ($app->time_duration / 60);
            ?>
            <tr>
                <td data-tableexport-display="none">
                    <input type="checkbox" class="check_box select_in_ts" value="{{$query->id}}">
                </td>
                <td>{{\Carbon\Carbon::parse($query->schedule_date)->format('m/d/Y')}}</td>
                <td>
                    {{$query->full_name}}
                    <?php
                        $pro_sig=\App\Models\Appoinment_signature::select('id','signature','sign_time_pro')->where('session_id',$query->appointment_id)->where('user_type',2)->first();
                    ?>
                    @if($pro_sig)
                        <?php $p_check='Available';  ?>
                        <i class="ri-pen-nib-line text-success view_sig_btn" data-img="{{$pro_sig->signature}}" data-date="{{\Carbon\Carbon::parse($pro_sig->sign_time_pro,'EST')->format('m/d/Y g:i a')}}"></i>
                    @else
                        <?php $p_check='N/A';  ?>
                        <i class="ri-pen-nib-line text-light"></i>
                    @endif
                </td>
                <td>
                    @if ($client)
                        {{$client->client_full_name}}
                        <?php
                            $c_sig=\App\Models\Appoinment_signature::select('id','signature','sign_time')->where('session_id',$query->appointment_id)->where('user_type',1)->first();
                        ?>
                        @if($c_sig)
                            <?php $c_check='Available';  ?>
                            <i class="ri-pen-nib-line text-success view_sig_btn" data-img="{{$c_sig->signature}}" data-date="{{\Carbon\Carbon::parse($c_sig->sign_time,'EST')->format('m/d/Y g:i a')}}"></i>
                        @else
                            <?php $c_check='N/A';  ?>
                            <i class="ri-pen-nib-line text-light"></i>
                        @endif
                    @elseif($app->billable==2)
                        <?php $c_check='N/A';  ?>
                        Non-Billable Client
                    @endif
                </td>
                <td>
                    @if ($act)
                        {{$act->activity_name}}
                    @elseif($app->billable==2)
                        NONCLI01323_AUTH249
                    @endif
                </td>
                <td data-tableexport-display="none">
                    <ul class="list-inline time-in-out">
                        <li class="list-inline-item">
                            <input type="text" class="form-control form-control-sm timein_one" name="timein_one"
                                   value="{{$query->timein_one}}">
                            <input type="hidden" value="{{$query->id}}" class="form-control form-control-sm timesheetid">
                        </li>
                        <li class="list-inline-item">
                            <input type="text" class="form-control form-control-sm timein_two" name="timein_two"
                                   value="{{$query->timein_two}}">
                        </li>
                        <li class="list-inline-item">
                            <select class="form-control form-control-sm timein_three" name="timein_three">
                                <option value="am" {{$query->timein_three == 'AM' || $query->timein_three=='am' ? 'selected' :''}}>AM</option>
                                <option value="pm" {{$query->timein_three == 'PM' || $query->timein_three=='pm' ? 'selected' :''}}>PM</option>
                            </select>
                        </li>
                    </ul>
                </td>
                <td style="display: none;" data-tableexport-display="always">
                    {{$query->timein_one.':'.$query->timein_two.' '.$query->timein_three}}
                </td>
                <td data-tableexport-display="none">
                    <ul class="list-inline time-in-out">
                        <li class="list-inline-item">
                            <input type="text" class="form-control form-control-sm timeout_one" name="timeout_one"
                                   value="{{$query->timeout_one}}">
                        </li>
                        <li class="list-inline-item">
                            <input type="text" class="form-control form-control-sm timeout_two" name="timeout_two"
                                   value="{{$query->timeout_two}}">
                        </li>
                        <li class="list-inline-item">
                            <select class="form-control form-control-sm timeout_three" name="timeout_three">
                                <option value="am" {{$query->timeout_three == 'AM' || $query->timeout_three == 'am' ? 'selected' :''}}>AM</option>
                                <option value="pm" {{$query->timeout_three == 'PM' || $query->timeout_three == 'pm' ? 'selected' :''}}>PM</option>
                            </select>
                        </li>
                    </ul>
                </td>
                <td style="display: none;" data-tableexport-display="always">
                    {{$query->timeout_one.':'.$query->timeout_two.' '.$query->timeout_three}}
                </td>
                <td>
                    {{number_format($hourdiff,2)}}
                </td>

                <td data-tableexport-display="none">


                    <input type="text" class="form-control form-control-sm miles" name="miles"
                           value="{{$query->miles}}">
                </td>
                <td data-tableexport-display="none">
                    @if($query->submitted == 1)
                        <i class="ri-check-fill text-success" style="font-size: 22px;"></i>
                    @else
                        <i class="ri-close-fill text-danger" style="font-size: 22px;"></i>
                    @endif
                </td>
                <td style="display:none;" data-tableexport-display="always">
                    @if($query->submitted == 1)
                        Yes
                    @else
                        No
                    @endif
                </td>
                <td style="display:none;" data-tableexport-display="always">{{$query->miles}}</td>
                <td style="display: none;" data-tableexport-display="always">{{$p_check}}</td>
                <td style="display: none;" data-tableexport-display="always">{{$c_check}}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>


<script>
    $(document).on('click','.view_sig_btn',function(){
        path=$(this).data("img");
        sig_date=$(this).data("date");
        real_path="{{asset('/')}}";
        $('#sig_img').attr("src",real_path+path);
        $('#sig_date').text(sig_date);
        $('#view_sig').modal("show");
    })
</script>