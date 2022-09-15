@extends('layouts.superadmin')
@section('superadmin')
    <?php
        if(Auth::user()->is_up_admin==1){
            $admin_id=Auth::user()->id;
        }
        else{
            $admin_id=Auth::user()->up_admin_id;
        }

    ?>


    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu">
                    @include('superadmin.include.settingMenu')
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h5 class="common-title">Deleted Timesheet Statements</h5>
                    <div class="table-responsive p_table timesheet_table">
                        <table class="table table-sm table-bordered c_table">
                            <thead>
                            <tr>
                                <th class="checkbox"><input type="checkbox" class="all_check"></th>
                                <th>Date</th>
                                <th>Patient</th>
                                <th>Actvity</th>
                                <th>Time in</th>
                                <th>Time out</th>
                                <th>Hours</th>
                                <th>Miles</th>
                                <th>Status</th>
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


                                $act = \App\Models\Client_authorization_activity::where('id', $app->authorization_activity_id)->first();
                                if (!empty($query->timein_one) && !empty($query->timein_two) && !empty($query->timein_three) && !empty($query->timeout_one) && !empty($query->timeout_two) && !empty($query->timeout_three)) {
                                    $count_time_one = (($query->timein_one . ':' . $query->timein_two) . ' ' . $query->timein_three);
                                    $count_time_two = (($query->timeout_one . ':' . $query->timeout_two) . ' ' . $query->timeout_three);
                                    $date = \Carbon\Carbon::parse($count_time_one)->format("H:i:s");
                                    $date2 = \Carbon\Carbon::parse($count_time_two)->format("H:i:s");

                                    $final_hrs = \Carbon\Carbon::parse($date)->diff($date2)->format('%H:%i');


                                    $hourdiff = round((strtotime($date2) - strtotime($date)) / 3600, 1);
                                } else {
                                    $final_hrs = 0;
                                    $hourdiff = 0;
                                }

                                $time = ($app->time_duration / 60);

                                ?>
                                <tr>
                                    <td><input type="checkbox" class="in_check" id="{{$query->id}}"></td>
                                    <td>{{\Carbon\Carbon::parse($query->schedule_date)->format('m/d/Y')}}</td>
                                    <td>
                                        @if ($client)
                                            {{$client->client_full_name}}
                                        @elseif($app->billable ==2)
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
                                    <td>
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
                                                    <option value="AM" {{$query->timein_three == 'AM' ? 'selected' :''}}>AM</option>
                                                    <option value="PM" {{$query->timein_three == 'PM' ? 'selected' :''}}>PM</option>
                                                </select>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
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
                                                    <option value="AM" {{$query->timeout_three == 'AM' ? 'selected' :''}}>AM</option>
                                                    <option value="PM" {{$query->timeout_three == 'PM' ? 'selected' :''}}>PM</option>
                                                </select>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        {{number_format($hourdiff,2)}}
                                    </td>

                                    <td>


                                        <input type="text" class="form-control form-control-sm miles" name="miles"
                                               value="{{$query->miles}}">
                                    </td>
                                    <td>Ready to Submit</td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="d-flex">
                        <div>
                            <select class="form-control form-control-sm operation">
                                <option value="">Select Any</option>
                                <option value="1">Revert</option>
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-primary ml-2 save_btn" type="button">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>

        function revert_records(records){
            $.ajax({
                url:"{{route('superadmin.revert.timesheet')}}",
                method:"POST",
                data:{
                    "_token":"{{csrf_token()}}",
                    "records":records
                },
                success:function(data){
                    if(data=="success"){
                        window.location.reload();
                    }
                }
            });
        }

        $('.all_check').click(function(){
            $('.in_check').each(function(){
                if($(this).prop("checked")==true){
                    $(this).prop("checked",false);
                }
                else{
                    $(this).prop("checked",true);
                }
            })
        });

        $('.save_btn').click(function(){
            arr=[];
            val=$('.operation>option:selected').val();
            $('.in_check').each(function(){
                if($(this).prop("checked")==true){
                    arr.push($(this).attr("id"));
                }
            })
            if(val==1){
                revert_records(arr);
            }
        })
    </script>
@endsection