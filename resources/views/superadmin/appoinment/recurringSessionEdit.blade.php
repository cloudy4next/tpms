@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="overflow-hidden mb-2">
                <div class="float-left">
                    <h5 class="m-0">Edit Recurring Session</h5>
                </div>
                <div class="float-right"><a href="{{ route('superadmin.recurring.session') }}" class="btn btn-sm btn-primary"
                        title="Back To Authorization"><i class="ri-arrow-left-circle-line"></i>Back</a></div>
            </div>

            <form action="{{ route('superadmin.recurring.session.update') }}" method="post">
                @csrf
                <div class="row">
                    <input class="form-control form-control-sm rec_id" type="hidden" name="rec_id"
                        value="{{ $session_data->recurring_id }}" />
                    <div class="col-md-3 mb-2">
                        <label>Patient Name</label>
                        <select class="form-control" placeholder="Select Client" disabled>
                            <option></option>
                            @foreach ($clients as $cleint)
                                <option value="{{ $cleint->id }}"
                                    {{ $session_data->client_id == $cleint->id ? 'selected' : '' }}>
                                    {{ $cleint->client_first_name }} {{ $cleint->client_middle }}
                                    {{ $cleint->client_last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Auth</label>
                        <select class="form-control authorization_id" placeholder="Select Auth" name="authorization_id"
                            required>
                            <option></option>
                            @foreach ($authorization as $auth)
                                <option value="{{ $auth->id }}"
                                    {{ $session_data->authorization_id == $auth->id ? 'selected' : '' }}>
                                    {{ $auth->authorization_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Service</label>
                        <select class="form-control activity_id" placeholder="Select Activity" name="activity_id" required>
                            <option></option>
                            @foreach ($activity as $act)
                                <option value="{{ $act->id }}"
                                    {{ $session_data->authorization_activity_id == $act->id ? 'selected' : '' }}>
                                    {{ $act->activity_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Provider Name</label>
                        <select class="form-control provider_id" placeholder="Select Provider" name="provider_id" required>
                            <option></option>
                            @foreach ($provider as $pro)
                                <option value="{{ $pro->id }}"
                                    {{ $session_data->provider_id == $pro->id ? 'selected' : '' }}>{{ $pro->first_name }}
                                    {{ $pro->middle_name }} {{ $pro->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>POS</label>
                        <select class="form-control location" placeholder="Select Location" name="location" required>
                            <option></option>
                            <option value=""></option>
                            <option value="03" {{ $session_data->location == '03' ? 'selected' : '' }}>School (03)
                            </option>
                            <option value="11" {{ $session_data->location == '11' ? 'selected' : '' }}>Office (11)
                            </option>
                            <option value="12" {{ $session_data->location == '12' ? 'selected' : '' }}>Home (12)
                            </option>
                            <option value="99" {{ $session_data->location == '99' ? 'selected' : '' }}>Others (99)
                            </option>
                            <option value="02" {{ $session_data->location == '02' ? 'selected' : '' }}>Telehealth (02)
                            </option>
                        </select>
                    </div>
                    <?php
                    $rec_ses = \App\Models\Recurring_session::select('id', 'schedule_date_end', 'schedule_date_start')
                        ->where('id', $session_data->recurring_id)
                        ->first();

                    $time_from = \Carbon\Carbon::parse($session_data->from_time)->format('H:i:s');
                    //$date_time_to = \Carbon\Carbon::parse($session_data->to_time)->format('Y-m-d\TH:i');
                    $time_to = \Carbon\Carbon::parse($session_data->to_time)->format('H:i:s');
                    $date_from = \Carbon\Carbon::parse($rec_ses->schedule_date_start)->format('Y-m-d');
                    $date_to = \Carbon\Carbon::parse($rec_ses->schedule_date_end)->format('Y-m-d');

                    ?>
                    <div class="col-md-3 mb-2">
                        <label>From Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input id="{{ $date_from }}" class="form-control form-control-sm" type="date" required
                                name="to_time" value="{{ $date_from }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>To Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input class="form-control form-control-sm" type="date" required name="to_time"
                                value="{{ $date_to }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="row">
                            <div class="col-md-6">
                                <label>From Time</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input class="form-control form-control-sm from_time" type="time" required
                                        name="from_time" value="{{ $time_from }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>To Time</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input class="form-control form-control-sm to_time" type="time" required
                                        name="to_time" value="{{ $time_to }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Status</label>
                        <select class="form-control status" placeholder="Select Status" name=" " required>
                            <option></option>
                            <option value="Scheduled" {{ $session_data->status == 'Scheduled' ? 'selected' : '' }}>
                                Scheduled
                            </option>
                            <option value="No Show" {{ $session_data->status == 'No Show' ? 'selected' : '' }}>No Show
                            </option>
                            <option value="Hold" {{ $session_data->status == 'Hold' ? 'selected' : '' }}>Hold</option>
                            <option value="Cancelled by Client"
                                {{ $session_data->status == 'Cancelled by Client' ? 'selected' : '' }}>
                                Cancelled by Client
                            </option>
                            <option value="CC more than 24 hrs"
                                {{ $session_data->status == 'CC more than 24 hrs' ? 'selected' : '' }}>
                                CC more than 24 hrs
                            </option>
                            <option value="CC less than 24 hrs"
                                {{ $session_data->status == 'CC less than 24 hrs' ? 'selected' : '' }}>
                                CC less than 24 hrs
                            </option>
                            <option value="Cancelled by Provider"
                                {{ $session_data->status == 'Cancelled by Provider' ? 'selected' : '' }}>
                                Cancelled by Provider
                            </option>
                            <option value="Rendered" {{ $session_data->status == 'Rendered' ? 'selected' : '' }}>Rendered
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Office Notes</label>
                        <textarea class="form-control form-control-sm notes" name="notes">{!! $session_data->notes !!}</textarea>
                    </div>

                    <div class="col-md-12">
                        <hr>
                        {{-- <button id="preview" class="btn btn-sm btn-primary">preview</button> --}}
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" href="#preview_modal"
                            id="sc_btn">Save
                        </button>
                        {{-- <span>
                            <button id="dataSave" type="submit" class="btn btn-sm btn-primary">Save</button> --}}
                    </div>
                </div>
            </form>
        </div>

        <div class="modal fade" id="preview_modal" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">
                        <!--table 1 start-->
                        <p class="mt-2 btn btn-primary text-white bg-red"> This Session will affect</p><span>
                            <p class="mt-2 btn btn-primary text-white bg-red"> Total: {{ count($sessions_not_sheduled) }}
                            </p>
                        </span>
                        <div class="table-responsive legder_table_data" style="max-height: 220px">
                            <table class="table-bordered table table-sm table-striped" role="grid">
                                <thead>
                                    <tr role="row" class="tablesorter-headerRow table-secondary"
                                        style="font-size: 15px">
                                        <th data-tableexport-display="none" class="checkbox1_th"><input type="checkbox"
                                                class="recussion_session_check_all"></th>
                                        <th data-column="1">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                Patient
                                            </div>
                                        </th>
                                        <th data-column="2">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                Service&Hrs
                                            </div>
                                        </th>
                                        <th data-column="3">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                Provider
                                            </div>
                                        </th>
                                        <th data-column="4">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                POS
                                            </div>
                                        </th>
                                        <th data-column="5">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                StartDate
                                            </div>
                                        </th>
                                        <th data-column="6">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                Hour
                                            </div>
                                        </th>
                                        <th data-column="8">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                Status
                                            </div>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody aria-live="polite" aria-relevant="all">
                                    <!--table row start-->
                                    @foreach ($sessions_not_sheduled as $session)
                                        <?php
                                        $payroll_check = \App\Models\timesheet::select('id')
                                            ->where('admin_id', '1')
                                            ->where('appointment_id', $session->id)
                                            ->where('submitted', 1)
                                            ->where('status', 'completed')
                                            ->first();
                                        ?>
                                        <tr>
                                            <td data-tableexport-display="none" class="checkbox1_td">
                                                <input type="checkbox"
                                                    class="check_box recurssion_data_checkbox_appoinment"
                                                    name="recurssion_data_checkbox_appoinment"
                                                    value="{{ $session->id }}">
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
                                                <td>
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
                                            <td>
                                                <?php
                                                $provider = \App\Models\Employee::select('id', 'first_name', 'middle_name', 'last_name')
                                                    ->where('id', $session->provider_id)
                                                    ->first();
                                                ?>
                                                @if ($provider)
                                                    {{ $provider->first_name }} {{ $provider->middle_name }}
                                                    {{ $provider->last_name }}
                                                @endif

                                            </td>
                                            <td>
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
                                                        {{ $place_of_ser->pos_name }} <i
                                                            class="fa fa-video-camera text-success"></i>
                                                    @else
                                                        {{ $place_of_ser->pos_name }}
                                                    @endif
                                                @endif

                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($session->schedule_date)->format('m/d/Y') }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($session->from_time)->format('g:i a') }}
                                                to {{ \Carbon\Carbon::parse($session->to_time)->format('g:i a') }}</td>
                                            <td>

                                                @php
                                                    if ($session->status == 'Rendered') {
                                                        $color = 'badge-success';
                                                    } elseif ($session->status == 'Scheduled') {
                                                        $color = 'badge-secondary';
                                                    } elseif ($session->status == 'No Show') {
                                                        $color = 'badge-danger';
                                                    } elseif ($session->status == 'Cancelled by Client') {
                                                        $color = 'badge-primary';
                                                    } elseif ($session->status == 'Cancelled by Provider') {
                                                        $color = 'badge-primary';
                                                    } else {
                                                        $color = 'badge-light';
                                                    }
                                                @endphp

                                                <span
                                                    class="badge {{ $color }} font-weight-normal">{{ $session->status }}</span>
                                            </td>
                                            <td style="display: none;" data-tableexport-display="always">
                                                {{ $session->status }}</td>
                                        </tr>
                                    @endforeach
                                    <!--table row end-->
                                </tbody>

                            </table>
                        </div>

                        <!--table 2 start-->
                        <p class="mt-2 btn btn-danger text-white bg-red">This
                            Session will not affect
                        </p> <span>
                            <p class="mt-2 btn btn-danger text-white bg-red">Total:
                                {{ count($sessions_sheduled) }}

                            </p>
                        </span>
                        <div class="table-responsive legder_table_data" style="max-height: 220px">
                            <table class="table-bordered table table-sm table-striped" role="grid">
                                <thead>
                                    <tr role="row" class="tablesorter-headerRow table-secondary"
                                        style="font-size: 15px">
                                        <th data-column="1">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                Patient
                                            </div>
                                        </th>
                                        <th data-column="2">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                Service&Hrs
                                            </div>
                                        </th>
                                        <th data-column="3">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                Provider
                                            </div>
                                        </th>
                                        <th data-column="4">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                POS
                                            </div>
                                        </th>
                                        <th data-column="5">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                StartDate
                                            </div>
                                        </th>
                                        <th data-column="6">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                Hour
                                            </div>
                                        </th>
                                        <th data-column="8">
                                            <div class="tablesorter-header-inner fw-normal text-center">
                                                Status
                                            </div>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody aria-live="polite" aria-relevant="all">
                                    <!--table row start-->
                                    @foreach ($sessions_sheduled as $session)
                                        <?php
                                        $payroll_check = \App\Models\timesheet::select('id')
                                            ->where('admin_id', '1')
                                            ->where('appointment_id', $session->id)
                                            ->where('submitted', 1)
                                            ->where('status', 'completed')
                                            ->first();
                                        ?>
                                        <tr>
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
                                                <td>
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
                                            <td>
                                                <?php
                                                $provider = \App\Models\Employee::select('id', 'first_name', 'middle_name', 'last_name')
                                                    ->where('id', $session->provider_id)
                                                    ->first();
                                                ?>
                                                @if ($provider)
                                                    {{ $provider->first_name }} {{ $provider->middle_name }}
                                                    {{ $provider->last_name }}
                                                @endif

                                            </td>
                                            <td>
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
                                                        {{ $place_of_ser->pos_name }} <i
                                                            class="fa fa-video-camera text-success"></i>
                                                    @else
                                                        {{ $place_of_ser->pos_name }}
                                                    @endif
                                                @endif

                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($session->schedule_date)->format('m/d/Y') }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($session->from_time)->format('g:i a') }}
                                                to {{ \Carbon\Carbon::parse($session->to_time)->format('g:i a') }}
                                            </td>
                                            <td>

                                                @php
                                                    if ($session->status == 'Rendered') {
                                                        $color = 'badge-success';
                                                    } elseif ($session->status == 'Scheduled') {
                                                        $color = 'badge-secondary';
                                                    } elseif ($session->status == 'No Show') {
                                                        $color = 'badge-danger';
                                                    } elseif ($session->status == 'Cancelled by Client') {
                                                        $color = 'badge-primary';
                                                    } elseif ($session->status == 'Cancelled by Provider') {
                                                        $color = 'badge-primary';
                                                    } else {
                                                        $color = 'badge-light';
                                                    }
                                                @endphp

                                                <span
                                                    class="badge {{ $color }} font-weight-normal">{{ $session->status }}</span>
                                            </td>
                                            <td style="display: none;" data-tableexport-display="always">
                                                {{ $session->status }}</td>
                                        </tr>
                                    @endforeach
                                    <!--table row end-->
                                </tbody>

                            </table>
                        </div>
                        <!--table 2 end-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="save_data">Save</button>

                        <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('superadmin.appoinment.include.manage_sesstion_include')
