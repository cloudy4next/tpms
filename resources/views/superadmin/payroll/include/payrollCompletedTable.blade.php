<?php

    if(\Auth::user()->is_up_admin==1){
        $admin_id=\Auth::user()->id;
    }
    else{
        $admin_id=\Auth::user()->up_admin_id;
    }

?>

<table class="table table-sm table-bordered c_table" id="export_table">
    <thead>
    <tr>
        <th data-tableexport-display="none" class="checkbox1"><input type="checkbox" class="select_all_completed"></th>
        <th class="pmnt_pvdr">Provider Name</th>
        <th class="pt_name">Patient Name</th>
        <th class="payroll_status">Payroll Status</th>
        <th class="srvc_bill">Service</th>
        <th class="date_tfrom">DateTimeFrom</th>
        <th class="date_to">DateTimeTo</th>
        <th class="payrate">Pay Rate</th>
        <th class="hrs">Hours</th>
        <th class="app-hrs">Approved Hours</th>
        <th class="milage_rate">Mileage Rate</th>
        <th class="milage">Mileage</th>
        {{-- <th class="title">Title</th> --}}
        <th class="location">Location</th>
    </tr>
    </thead>
    <tbody>
    @foreach($query_exe as $submit_payroll)
        <?php
            $bill_app = \App\Models\Appoinment::select('authorization_activity_id', 'billable', 'client_id', 'schedule_date', 'from_time', 'to_time','location')
                ->where('id', $submit_payroll->appointment_id)
                ->first();
        ?>
        @if($bill_app)
            <?php
            $employee = \App\Models\Employee::select('id', 'full_name', 'title')->where('id', $submit_payroll->provider_id)->first();
            $act = \App\Models\Client_authorization_activity::select('id', 'activity_name')
                ->where('id', $bill_app->authorization_activity_id)
                ->first();

            $location = \App\Models\point_of_service::where('admin_id', $admin_id)->where('pos_code', $bill_app->location)->first();

            $em_payroll = \App\Models\Employee_payroll::select('hourly_rate')->where('employee_id', $submit_payroll->provider_id)->first();
            $client_data = \App\Models\Client::select('client_full_name')->where('id', $bill_app->client_id)->first();
            if (!empty($submit_payroll->timein_one) && !empty($submit_payroll->timein_two) && !empty($submit_payroll->timein_three) && !empty($submit_payroll->timeout_one) && !empty($submit_payroll->timeout_two) && !empty($submit_payroll->timeout_three)) {
                $count_time_one = (($submit_payroll->timein_one . ':' . $submit_payroll->timein_two) . ' ' . $submit_payroll->timein_three);
                $count_time_two = (($submit_payroll->timeout_one . ':' . $submit_payroll->timeout_two) . ' ' . $submit_payroll->timeout_three);
                $date = \Carbon\Carbon::parse($count_time_one)->format("H:i:s");
                $date2 = \Carbon\Carbon::parse($count_time_two)->format("H:i:s");

                $date3 = \Carbon\Carbon::parse($count_time_one)->format("g:i a");
                $date4 = \Carbon\Carbon::parse($count_time_two)->format("g:i a");


                $final_hrs = \Carbon\Carbon::parse($date)->diff($date2)->format('%H:%i');
                $hourdiff = round((strtotime($date2) - strtotime($date)) / 3600, 2);
            } else {
                $final_hrs = 0;
                $hourdiff = 0;
            }

            ?>
            <tr>
                <td data-tableexport-display="none"><input type="checkbox" class="select_in_completed" value="{{$submit_payroll->id}}"></td>
                <td>
                    @if($employee)
                        {{$employee->full_name}}
                    @endif
                </td>
                <td>
                    @if($client_data)
                        {{$client_data->client_full_name}}
                    @elseif($bill_app->billable==2)
                        Non-Billable Client
                    @endif
                </td>
                <td>Submitted to Office</td>
                <td>
                    @if ($bill_app->billable == 1)
                        @if($act)
                            {{$act->activity_name}}
                        @endif
                    @else
                        NONCLI01323_AUTH249
                    @endif
                </td>
                {{-- <td>
                    @if ($bill_app->billable == 2)
                        @if($act)
                            {{$act->activity_name}}
                        @endif
                    @endif
                </td> --}}
                <td>{{\Carbon\Carbon::parse($submit_payroll->schedule_date)->format('m/d/Y')}} {{$date3}}</td>
                <td>{{\Carbon\Carbon::parse($submit_payroll->schedule_date)->format('m/d/Y')}} {{$date4}}</td>
                <td>
                    @if ($em_payroll)
                        {{$em_payroll->hourly_rate}}
                    @endif
                </td>
                <td>
                    @if($submit_payroll->acceped_hours != null || $submit_payroll->acceped_hours != '')
                        {{$submit_payroll->acceped_hours}}
                    @else
                        0.00
                    @endif
                </td>
                <td>
                    @if($hourdiff < 0)
                        {{abs(number_format($hourdiff,2))}}
                    @else
                        {{number_format($hourdiff,2)}}
                    @endif
                </td>
                <td>
                    {{$submit_payroll->miles}}
                </td>
                <td>{{$submit_payroll->acceped_mileage}}</td>
                {{-- <td>
                    @if($employee)
                        {{$employee->title}}
                    @endif
                </td> --}}
                <td>
                    @if($location)
                        {{$location->pos_name}}
                    @endif
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
