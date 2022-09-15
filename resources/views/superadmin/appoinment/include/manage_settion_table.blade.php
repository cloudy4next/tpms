<?php
if (\Auth::user()->is_up_admin == 1) {
    $admin_id = \Auth::user()->id;
} else {
    $admin_id = \Auth::user()->up_admin_id;
}
?>
@foreach ($sessions as $session)
    <?php
    $payroll_check = \App\Models\timesheet::select('id')
        ->where('admin_id', $admin_id)
        ->where('appointment_id', $session->id)
        ->where('submitted', 1)
        ->where('status', 'completed')
        ->first();
    ?>

    <tr>
        <td data-tableexport-display="none" class="checkbox1_td">
            @if ($session->is_locked == 1)
                <input type="checkbox" class="check_box data_checkbox_appoinment" name="data_checkbox_appoinment" disabled
                    value="{{ $session->id }}">
            @elseif($payroll_check)
                <input type="checkbox" class="check_box data_checkbox_appoinment" name="data_checkbox_appoinment" disabled
                    value="{{ $session->id }}">
            @else
                <input type="checkbox" class="check_box data_checkbox_appoinment" name="data_checkbox_appoinment"
                    value="{{ $session->id }}">
            @endif
        </td>
        <td data-tableexport-display="none" class="lock_td">

            @if ($session->is_locked == 1)
                <a href="#"><i class="ri-lock-line mx-2 text-danger" title="Billing"></i></a>
            @elseif($payroll_check)
                <a href="#"><i class="ri-lock-line mx-2 text-danger" title="Timesheet"></i></a>
            @else
                <a href="#"><i class="ri-lock-unlock-fill mx-2 text-primary" title="Un-Lock"></i></a>
            @endif
        </td>
        @if ($session->billable == 1)
            <td class="patient_td">
                <?php
                $client = \App\Models\Client::select('id', 'client_full_name')
                    ->where('id', $session->client_id)
                    ->first();
                ?>
                @if ($client)
                    {{ $client->client_full_name }}
                @endif

            </td>
            <td class="service_td" data-tableexport-display="none">
                <?php

                $auth = \App\Models\Client_authorization_activity::select('id', 'activity_name')
                    ->where('id', $session->authorization_activity_id)
                    ->first();
                $hours = $session->time_duration / 60;
                ?>
                @if ($auth)
                    {{ $auth->activity_name }}
                    @if ($hours >= 1)
                        ({{ number_format($hours, 2) }} Hr)
                    @else
                        ({{ number_format($hours, 2) }} Hrs)
                    @endif
                @endif

            </td>
        @endif

        <td style="display: none;" data-tableexport-display="always">
            <?php

            $auth = \App\Models\Client_authorization_activity::select('id', 'activity_name')
                ->where('id', $session->authorization_activity_id)
                ->first();
            ?>
            @if ($auth)
                {{ $auth->activity_name }}
            @endif
        </td>

        <td style="display: none;" data-tableexport-display="always">
            <?php
                $hours = $session->time_duration / 60;
            ?>
            {{number_format($hours, 2)}}
        </td>
        <td style="display:none;" data-tableexport-display="always">
            <?php
                $auth_num = \App\Models\Client_authorization::select('id','authorization_number')->where('id',$session->authorization_id)->first();
                if($auth_num){
                    $auth_num = $auth_num->authorization_number;
                }
                else{
                    $auth_num = '';
                }
            ?>
            {{$auth_num}}
        </td>
        <td class="provider_td">
            <?php
            $provider = \App\Models\Employee::select('id', 'first_name', 'middle_name', 'last_name')
                ->where('id', $session->provider_id)
                ->first();
            ?>
            @if ($provider)
                {{ $provider->first_name }} {{ $provider->middle_name }} {{ $provider->last_name }}
            @endif

        </td>
        <td class="pos_td">
            <?php
            if (Auth::user()->is_up_admin == 1) {
                $place_of_ser = \App\Models\point_of_service::where('admin_id', Auth::user()->id)
                    ->where('pos_code', $session->location)
                    ->first();
            } else {
                $place_of_ser = \App\Models\point_of_service::where('admin_id', Auth::user()->up_admin_id)
                    ->where('pos_code', $session->location)
                    ->first();
            }

            ?>

            @if ($place_of_ser)
                @if ($place_of_ser->pos_code == '02' || $place_of_ser->pos_code == '10')
                    {{ $place_of_ser->pos_name }} <i class="fa fa-video-camera text-success"></i>
                @else
                    {{ $place_of_ser->pos_name }}
                @endif
            @endif

        </td>
        <td class="sch_date_td">{{ \Carbon\Carbon::parse($session->schedule_date)->format('m/d/Y') }}</td>
        <td class="hrs_td">{{ \Carbon\Carbon::parse($session->from_time)->format('g:i a') }}
            to {{ \Carbon\Carbon::parse($session->to_time)->format('g:i a') }}</td>
        <td data-tableexport-display="none" class="status_td">

            @php
                if ($session->status == 'Rendered') {
                    $color="badge-success";
                } elseif ($session->status == 'Scheduled') {
                    $color="badge-secondary";
                } elseif ($session->status == 'No Show') {
                    $color="badge-danger";
                } elseif ($session->status == 'Cancelled by Client') {
                    $color="badge-primary";
                } elseif ($session->status == 'Cancelled by Provider') {
                    $color="badge-primary";
                } else {
                    $color="badge-light";
                }
            @endphp

            <span class="badge {{ $color }} font-weight-normal">{{ $session->status }}</span>
        </td>
        <td style="display: none;" data-tableexport-display="always">{{ $session->status }}</td>
        <td data-tableexport-display="none" class="action_td">
            <div class="dropdown">
                <button class="btn dropdown-toggle p-0 text-primary" type="button" data-toggle="dropdown"
                    data-boundary="viewport">
                    <i class="ri-more-fill"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right session-dd">
                    <a href="javascript:void(0);" class="dropdown-item addNoteForms"
                        data-session="{{ $session->id }}"><i class="ri-add-line mr-2"></i>Add
                        Notes</a>

                    <?php
                    $leg_notes_count = \App\Models\Session_notes_avail::where('session_id', $session->id)->count();

                    ?>
                    @php
                        if ($leg_notes_count > 0) {
                                $color="text-success";
                        } else {
                            $color="";
                        }
                    @endphp
                    <a href="javascript:void(0);" data-id="{{ $session->id }}"
                        class="createdNoteform dropdown-item {{ $color }} font-weight-normal"><i
                            class="ri-eye-line mr-2"></i>View Notes</a>
                    @if ($session->is_locked == 0 && !$payroll_check)
                        <a href="#su_modal" data-id="{{ $session->id }}" data-toggle="modal"
                            class="dropdown-item editApp edit_session_btn"><i class="ri-pencil-line mr-2"></i>Edit
                            Session</i></a>
                    @else
                    @endif
                </div>
            </div>
        </td>
    </tr>
@endforeach
