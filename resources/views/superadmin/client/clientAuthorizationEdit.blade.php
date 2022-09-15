<?php

    if(Auth::user()->is_up_admin==1){
        $admin_id = Auth::user()->id;
    }
    else{
        $admin_id = Auth::user()->up_admin_id;
    }


?>


@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <?php
        $client_info = \App\Models\Client_info::where('client_id', $client_id->id)->first();
        ?>
        <div class="iq-card-body">
            <h5 class="mb-2">
                <a href="{{ route('superadmin.client.authorization', $client_id->id) }}" title="Back To Client"><i
                        class="ri-arrow-left-circle-line text-primary"></i> </a>
                <a href="{{ route('superadmin.client.authorization', $client_id->id) }}"
                   class="cmn_a">{{ $client_id->client_first_name }} {{ $client_id->client_middle }}
                    {{ $client_id->client_last_name }}</a> |
                <small>
                    <span class=" font-weight-bold text-orange">DOB:</span>
                    {{ \Carbon\Carbon::parse($client_id->client_dob)->format('m/d/Y') }} |
                    <span class=" font-weight-bold text-orange">Phone:</span> {{ $client_id->phone_number }} |
                    <span class=" font-weight-bold text-orange">Address:</span>
                    {{ $client_id->client_street }} {{ $client_id->client_city }} {{ $client_id->client_state }}
                    {{ $client_id->client_zip }}
                </small>
            </h5>
            <form action="{{ route('superadmin.client.authorization.update') }}" method="post"
                  enctype="multipart/form-data" autocomplete="off" id="edit_auth_form">
                @csrf
            <div class="overflow-hidden mb-2">
                <div class="float-left">
                    <h5 class="m-0">Edit Auth</h5>
                </div>
                <div class="float-right">
                    <div class="custom-control custom-switch billable-switch">
                        <input type="checkbox" class="custom-control-input auth_require_switch" id="bn" {{$edit_authorization->is_required == 1? 'checked':''}} name="is_required" value="1">
                        <label class="custom-control-label mr-5" for="bn">Auth Not Required</label>
                        <a href="{{route('superadmin.client.authorization',$client_id->id)}}" class="btn btn-sm btn-primary"
                           title="Back To Authorization"><i class="ri-arrow-left-circle-line"></i>Back</a>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>Description <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm description" name="description"
                               value="{{ $edit_authorization->description }}" required>
                        <input type="hidden" class="form-control form-control-sm" name="client_id"
                               value="{{ $client_id->id }}">
                        <input type="hidden" class="form-control form-control-sm" name="edit_authorization_id"
                               value="{{ $edit_authorization->id }}">
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>Insurance <span class="text-danger">*</span></label>
                        <div class="ui-widget">
                            <select class="form-control form-control-sm" placeholder="Search" name="payor_id" required>
                                @foreach ($all_payors as $payor)
                                    <?php
                                        $show_payor = \App\Models\All_payor::where('id', $payor->payor_id)->first();
                                    ?>
                                    @if ($show_payor)
                                        <option value="{{ $payor->payor_id }}"
                                            {{ $edit_authorization->payor_id == $payor->payor_id ? 'selected' : '' }}>
                                            {{ $payor->payor_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>Tx Type <span class="text-danger">*</span></label>
                        <div class="ui-widget">
                            <select class="form-control form-control-sm treatment_type" placeholder="Search"
                                    name="treatment_type"
                                    required>
                                @foreach ($treatment_types as $tret_type)
                                    <option value="{{ $tret_type->treatment_name }}"
                                        {{ $edit_authorization->treatment_type == $tret_type->treatment_name ? 'selected' : '' }}>
                                        {{ $tret_type->treatment_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>SUPV. Provider <span class="text-danger">*</span></label>
                        <div class="ui-widget">
                            <select class="form-control form-control-sm" placeholder="Search" name="supervisor_id"
                                    required>
                                <option value="0">Choose Supervisor</option>
                                @if (count($supervisor) > 0 )
                                    @foreach ($supervisor as $superv)
                                        <?php
                                        $employe_name = \App\Models\Employee::where('id', $superv->employee_id)
                                            ->first();
                                        ?>
                                        <option value="{{ $employe_name->id }}"
                                            {{ $edit_authorization->supervisor_id == $employe_name->id ? 'selected' : '' }}>
                                            {{ $employe_name->first_name }} {{ $employe_name->middle_name }}
                                            {{ $employe_name->last_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>Select Date <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <?php

                            $date_time_from = \Carbon\Carbon::parse($edit_authorization->onset_date)->format('Y-m-d\TH:i');
                            $date_time_to = \Carbon\Carbon::parse($edit_authorization->end_date)->format('Y-m-d\TH:i');
                            ?>
                            <input class="form-control form-control-sm reportrange date_range" name="select_date"
                                   value="{{ $edit_authorization->selected_date }}" readonly required>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>Authorization Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm authorization_number" name="authorization_number"
                               value="{{ $edit_authorization->authorization_number }}">
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>UCI / Insurance ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm ins_number" name="uci_id"
                               value="{{ $edit_authorization->uci_id }}" required>
                    </div>

                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>COB <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm" name="is_primary" required>
                            <option>Select Any</option>
                            <option value="1" {{ $edit_authorization->is_primary == 1 ? 'selected' : '' }}>
                                Primary
                            </option>
                            <option value="2" {{ $edit_authorization->is_primary == 2 ? 'selected' : '' }}>
                                Secondary
                            </option>
                            <option value="3" {{ $edit_authorization->is_primary == 3 ? 'selected' : '' }}>
                                Tertiary
                            </option>
                        </select>
                    </div>

                    {{--                    <div class="col-md-4 col-lg-3 mb-2">--}}
                    {{--                        <div class="d-inline-block mr-2">--}}
                    {{--                            <label>Max By Total Auth</label>--}}
                    {{--                            <select class="form-control form-control-sm" name="max_total_auth">--}}
                    {{--                                <option></option>--}}
                    {{--                                <option--}}
                    {{--                                    value="Hours" {{ $edit_authorization->max_total_auth == 'Hours' ? 'selected' : '' }}>--}}
                    {{--                                    Hours--}}
                    {{--                                </option>--}}
                    {{--                                <option--}}
                    {{--                                    value="Unit" {{ $edit_authorization->max_total_auth == 'Unit' ? 'selected' : '' }}>--}}
                    {{--                                    Unit--}}
                    {{--                                </option>--}}
                    {{--                            </select>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="d-inline-block">--}}
                    {{--                            <label>Value</label>--}}
                    {{--                            <input type="text" class="form-control form-control-sm" style="max-width: 70px;"--}}
                    {{--                                   name="value"--}}
                    {{--                                   value="{{ $edit_authorization->value }}">--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>Upload Authorization</label>
                        <div class="d-flex">
                            <div class="mr-2 align-self-center">
                                <label for="file-up">
                                    {{-- <a role="button" class="btn btn-sm btn-primary text-white">Upload File</a> --}}
                                    <input id="file-up" type="file" name="upload_authorization">
                                </label>
                            </div>
                            <div class="align-self-center">
                                @if (!empty($edit_authorization->upload_authorization) && file_exists($edit_authorization->upload_authorization))
                                    <?php
                                    $get_name = substr($edit_authorization->upload_authorization, 31);
                                    $ext = pathinfo($edit_authorization->upload_authorization, PATHINFO_EXTENSION);
                                    ?>

                                    @if (strlen($get_name) > 10)
                                        <a href="{{ asset($edit_authorization->upload_authorization) }}" target="_blank"
                                           title="{{ substr($edit_authorization->upload_authorization, 31) }}">
                                            @else
                                                <a href="{{ asset($edit_authorization->upload_authorization) }}"
                                                   target="_blank"
                                                   title="{{ $edit_authorization->upload_authorization }}.{{ $ext }}">
                                                    @endif

                                                    @if (strlen($get_name) > 10)
                                                        {{ $get_name }}
                                                    @else
                                                        {{ $get_name }}
                                                    @endif
                                                </a>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <div class="d-inline-block mr-2">
                            <label>Diagnosis1 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm diagnosis" style="max-width: 100px;"
                                   name="diagnosis_one" value="{{ $edit_authorization->diagnosis_one }}" required>
                        </div>
                        <div class="d-inline-block">
                            <label>Diagnosis2</label>
                            <input type="text" class="form-control form-control-sm" style="max-width: 100px;"
                                   name="diagnosis_two" value="{{ $edit_authorization->diagnosis_two }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <div class="d-inline-block">
                            <label>Diagnosis3</label>
                            <input type="text" class="form-control form-control-sm" style="max-width: 100px;"
                                   name="diagnosis_three" value="{{ $edit_authorization->diagnosis_three }}">
                        </div>
                        <div class="d-inline-block">
                            <label>Diagnosis4</label>
                            <input type="text" class="form-control form-control-sm" style="max-width: 100px;"
                                   name="diagnosis_four" value="{{ $edit_authorization->diagnosis_four }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <div class="d-inline-block">
                            <label>Deductible</label>
                            <input type="text" class="form-control form-control-sm" style="max-width: 150px;"
                                   name="deductible" value="{{ $edit_authorization->deductible }}">
                        </div>
                        <div class="d-inline-block">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="in_network" value="1"
                                        {{ $edit_authorization->in_network == 1 ? 'checked' : '' }}>In Network
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>CoPay</label>
                        <input type="text" class="form-control form-control-sm" style="max-width: 150px;" name="copay"
                               value="{{ $edit_authorization->copay }}">
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>CMS 4 (Insured Name)</label>
                        <?php
                        $client_gran_info = \App\Models\Client_guarantar_info::where('client_id', $client_info->client_id)->first();
                        if (($client_gran_info && $edit_authorization->cms_four == null) || $edit_authorization->cms_four == ''){
                        ?>
                        <input type="text" class="form-control form-control-sm" name="cms_four" value="{{ $client_gran_info->guarantor_first_name }} {{ $client_gran_info->guarantor_last_name }}">
                        <?php } else {  ?>
                            <input type="text" class="form-control form-control-sm" name="cms_four" value="{{ $edit_authorization->cms_four }}">
                        <?php } ?>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2">
                        <label>CMS 11 (Group No)</label>
                        <input type="text" class="form-control form-control-sm" name="csm_eleven"
                               value="{{ $edit_authorization->csm_eleven }}">
                    </div>
                    <div class="col-md-3 align-self-center mb-2">
                        {{--                        <div class="form-check">--}}
                        {{--                            <label class="form-check-label">--}}
                        {{--                                <input type="checkbox" class="form-check-input" name="is_valid"--}}
                        {{--                                       value="1" {{ $edit_authorization->is_valid == 1 ? 'checked' : '' }}>Is Active--}}
                        {{--                            </label>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="form-check">--}}
                        {{--                            <label class="form-check-label">--}}
                        {{--                                <input type="checkbox" class="form-check-input" name="is_placeholder"--}}
                        {{--                                       value="1" {{ $edit_authorization->is_placeholder == 1 ? 'checked' : '' }}>Is--}}
                        {{--                                Placeholder--}}
                        {{--                            </label>--}}
                        {{--                        </div>--}}


                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="ac" name="is_valid"
                                   value="1" {{ $edit_authorization->is_valid == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="ac">Active</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="ph" name="is_placeholder"
                                   value="1" {{ $edit_authorization->is_placeholder == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="ph">Placeholder</label>
                        </div>


                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Notes</label>
                        <textarea class="form-control form-control-sm"
                                  name="notes">{!! $edit_authorization->notes !!}</textarea>
                    </div>

                    <div class="col-md-12"></div>
                    <div class="col-lg-2 align-self-start mt-2">
                        <button type="submit" class="btn btn-primary" id="editAuth">Save Auth</button>
                        <a href="{{ route('superadmin.client.authorization', $client_id->id) }}">
                            <button type="button" class="btn btn-danger">Cancel</button>
                        </a>
                    </div>
            </form>
            <div class="col-lg-8 align-self-start">
                <div class="table-responsive">
                    <table class="table-sm table table-bordered mt-2 mb-2 c_table">
                        <thead>
                        <tr>
                            <th>Service</th>
                            <th>Max By</th>
                            <th>Frequency</th>
                            <th>Auth</th>
                            <th>Scheduled</th>
                            <th>Rendered</th>
                            <th>Remaining</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($activities as $act)

                            <?php

                                $sch_min = \App\Models\Appoinment::where('admin_id', $admin_id)
                                    ->where('client_id', $client_id->id)
                                    ->where('authorization_activity_id', $act->id)
                                    ->sum('time_duration');
                                $ren_min = \App\Models\Appoinment::where('admin_id', $admin_id)
                                    ->where('client_id', $client_id->id)
                                    ->where('authorization_activity_id', $act->id)
                                    ->where('status', 'Rendered')
                                    ->sum('time_duration');

                                $sch = 0;
                                $ren = 0;
                                $rem = 0;

                                if ($act->hours_max_one == 1){
                                    $sch = $sch_min / 60;
                                    $ren = $ren_min / 60;
                                    $t_s = $sch;
                                    $rem = $act->hours_max_is_one - $t_s;
                                }
                                else if($act->hours_max_one == 2){
                                    $sch = $sch_min / 60;
                                    $ren = $ren_min / 60;
                                    $t_s = $sch;
                                    $rem = $act->hours_max_is_one - $t_s;
                                }
                                else if($act->hours_max_one == 3){
                                    $t_s = $sch_min;
                                    $units = 0;

                                    if($act->billed_type == 'Per Unit'){
                                        if($act->billed_time == '15 min'){
                                            $sch = round($sch_min/15,2);
                                            $ren = round($ren_min/15,2);
                                            $units = round($t_s/15,2);
                                        }
                                        else if($act->billed_time == '30 min'){
                                            $sch = round($sch_min/30,2);
                                            $ren = round($ren_min/30,2);
                                            $units = round($t_s/30,2);
                                        }
                                        else if($act->billed_time == '45 min'){
                                            $sch = round($sch_min/45,2);
                                            $ren = round($ren_min/45,2);
                                            $units = round($t_s/45,2);
                                        }
                                        else if($act->billed_time == '1 hour'){
                                            $sch = round($sch_min/60,2);
                                            $ren = round($ren_min/60,2);
                                            $units = round($t_s/60,2);
                                        }
                                        else if($act->billed_time == '2 hour'){
                                            $sch = round($sch_min/120,2);
                                            $ren = round($ren_min/120,2);
                                            $units = round($t_s/120,2);
                                        }
                                        else if($act->billed_time == '1 min'){
                                            $sch = round($sch_min/1,2);
                                            $ren = round($ren_min/1,2);
                                            $units = round($t_s/1,2);
                                        }
                                    }

                                    $rem = $act->hours_max_is_one - $units;
                                }
                                else{
                                    $sch = 0;
                                    $ren = 0;
                                    $rem = 0;
                                }
                            ?>

                            <tr>
                                <td>{{ $act->activity_one }} {{ $act->activity_two }}</td>
                                <td>
                                    @if ($act->hours_max_one == 1)
                                        Hours
                                    @elseif($act->hours_max_one == 2)
                                        Amount
                                    @elseif($act->hours_max_one == 3)
                                        Unit
                                    @else
                                        Not Set
                                    @endif
                                </td>
                                <td>{{ $act->hours_max_per_one }}</td>
                                <td>{{ $act->hours_max_is_one }}</td>
                                <td>
                                    {{round($sch,2)}}
                                    @if ($act->hours_max_one == 1)
                                        Hrs
                                    @elseif($act->hours_max_one == 2)
                                        Am
                                    @elseif($act->hours_max_one == 3)
                                        Units
                                    @endif
                                </td>
                                <td>
                                    {{round($ren,2)}}
                                    @if ($act->hours_max_one == 1)
                                        Hrs
                                    @elseif($act->hours_max_one == 2)
                                        Am
                                    @elseif($act->hours_max_one == 3)
                                        Units
                                    @endif
                                </td>
                                <td>
                                    {{round($rem,2)}}
                                    @if ($act->hours_max_one == 1)
                                        Hrs
                                    @elseif($act->hours_max_one == 2)
                                        Am
                                    @elseif($act->hours_max_one == 3)
                                        Units
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($act->onset_date)->format('m/d/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($act->end_date)->format('m/d/Y') }}</td>
                                <td>
                                    <a href="#editactivity{{ $act->id }}" data-toggle="modal" title="Edit"><i
                                            class="fa fa-pencil text-success mr-2 editActModal" data-id="{{$act->id}}"
                                            aria-hidden="true"></i></a>
                                    <a href="{{ route('superadmin.client.authorization.ativity.delete', $act->id) }}"
                                       title="Delete"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>


<div class="modal fade" id="editactivity{{ $act->id }}"
data-backdrop="static">
<div
class="modal-dialog text-left  modal-dialog-scrollable modal-dialog-centered">
<div class="modal-content">
<div class="modal-header">
    <h4>Add/Edit Service</h4>
    <button type="button" class="close"
            data-dismiss="modal">&times;
    </button>
</div>
<div class="modal-body">
    <form
        action="{{ route('superadmin.client.authorization.ativity.update') }}"
        method="post" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-md-5 mb-2">
                <label>Service</label>
                <select
                    class="form-control form-control-sm edit_activity_one service_main"
                    name="activity_one" required>
                    <option></option>
                </select>
                <input type="hidden" class="exist_act_one">
            </div>
            <div class="col-md-4 mb-2">
                <label>Service Sub-Type</label>
                <select
                    class="form-control form-control-sm exit_activity_two service_sub_type"
                    name="activity_two" required>
                    <?php
                        $t_type = \App\Models\Client_authorization::where('id', $act->authorization_id)->first();
                    ?>
                </select>
                <input type="hidden" value="{{$t_type->treatment_type_id}}" class="tx_type_h">
                <input type="hidden" class="exist_act_two">
            </div>
            <div class="col-md-3 mb-2">
                <label>CPT Code</label>
                
                <select
                    class="form-control form-control-sm exist_cpt_code_data"
                    name="cpt_code" required>
                    
                </select>
                <input type="hidden" class="exist_cpt_code">
            </div>
            <div class="col-md-5">
                <div class="row no-gutters">
                    <div class="col-md mr-1">
                        <label>M1</label>
                        <input type="text"
                               class="form-control form-control-sm"
                               name="m1" value="{{ $act->m1 }}"
                        >
                        <input type="hidden"
                               class="form-control form-control-sm"
                               name="edit_activity_id"
                               value="{{ $act->id }}">
                        <input type="hidden"
                               class="form-control form-control-sm"
                               name="authrization_id"
                               value="{{ $act->authorization_id }}">
                    </div>
                    <div class="col-md mr-1">
                        <label>M2</label>
                        <input type="text"
                               class="form-control form-control-sm"
                               name="m2" value="{{ $act->m2 }}"
                        >
                    </div>
                    <div class="col-md mr-1">
                        <label>M3</label>
                        <input type="text"
                               class="form-control form-control-sm"
                               name="m3" value="{{ $act->m3 }}"
                        >
                    </div>
                    <div class="col-md">
                        <label>M4</label>
                        <input type="text"
                               class="form-control form-control-sm"
                               name="m4" value="{{ $act->m4 }}"
                        >
                    </div>
                </div>
            </div>
            <div class="col-md-5 mb-2">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <label>Billed Per</label>
                        <select
                            class="form-control form-control-sm billed_type1"
                            name="billed_type" required>
                            <option value="15 mins"
                                {{ $act->billed_type == '15 mins' ? 'selected' : '' }}>
                                15 mins
                            </option>
                            <option value="Hour"
                                {{ $act->billed_type == 'Hour' ? 'selected' : '' }}>
                                Hour
                            </option>
                            <option value="Per Unit"
                                {{ $act->billed_type == 'Per Unit' ? 'selected' : '' }}>
                                Per Unit
                            </option>
                            <option value="Per Session"
                                {{ $act->billed_type == 'Per Session' ? 'selected' : '' }}>
                                Per Session
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6 align-self-end pl-2">
                        <select
                            class="form-control form-control-sm billed_time1"
                            name="billed_time" required>
                            <option value="15 min"
                                {{ $act->billed_time == '15 min' ? 'selected' : '' }}>
                                15 min
                            </option>
                            <option value="30 min"
                                {{ $act->billed_time == '30 min' ? 'selected' : '' }}>
                                30 min
                            </option>
                            <option value="45 min"
                                {{ $act->billed_time == '45 min' ? 'selected' : '' }}>
                                45 min
                            </option>
                            <option value="1 hour"
                                {{ $act->billed_time == '1 hour' ? 'selected' : '' }}>
                                1 hour
                            </option>
                            <option value="2 hour"
                                {{ $act->billed_time == '2 hour' ? 'selected' : '' }}>
                                2 hour
                            </option>
                            <option value="1 min"
                                {{ $act->billed_time == '1 min' ? 'selected' : '' }}>
                                1 min
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-2">
                <label>Rate</label>
                <input type="text" class="form-control form-control-sm"
                       name="rate" value="{{ $act->rate }}" required>
            </div>
            <div class="col-md-12">
                <label>Maximum Frequency allowed</label>
                <table class="table table-sm table-bordered text-left c_table mb-0">
                    <?php
                    $get_ext_act_app = \App\Models\Appoinment::select('authorization_activity_id', 'is_locked')
                        ->where('authorization_activity_id', $act->id)
                        ->where('is_locked', 1)
                        ->count();
                    ?>
                    <tbody>
                    <tr>
                        <th>Maximum</th>
                        <td>
                            <select
                                class="form-control form-control-sm max_one"
                                name="hours_max_one" {{ $get_ext_act_app > 0 ? 'disabled' : '' }} required>
                                <option value="1"
                                    {{ $act->hours_max_one == 1 ? 'selected' : '' }}>
                                    Hours
                                </option>
                                <option value="3"
                                    {{ $act->hours_max_one == 3 ? 'selected' : '' }}>
                                    Unit
                                </option>
                            </select>
                        </td>
                        <th>Per</th>
                        <td>
                            <select
                                class="form-control form-control-sm max_one_select"
                                name="hours_max_per_one"
                                {{ $get_ext_act_app > 0 ? 'disabled' : '' }} required>
                                <option value=""></option>
                                <option value="Day"
                                    {{ $act->hours_max_per_one == 'Day' ? 'selected' : '' }}>
                                    Day
                                </option>
                                <option value="Week"
                                    {{ $act->hours_max_per_one == 'Week' ? 'selected' : '' }}>
                                    Week
                                </option>
                                <option value="Month"
                                    {{ $act->hours_max_per_one == 'Month' ? 'selected' : '' }}>
                                    Month
                                </option>
                                <option value="Total Auth"
                                    {{ $act->hours_max_per_one == 'Total Auth' ? 'selected' : '' }}>
                                    Total Auth
                                </option>
                            </select>
                        </td>
                        <th>Is</th>
                        <td style="max-width: 100px;">
                            <input type="text"
                                   class="form-control form-control-sm"
                                   name="hours_max_is_one"
                                   value="{{ $act->hours_max_is_one }}"
                                   {{ $get_ext_act_app > 0 ? 'disabled' : '' }} required>
                        </td>
                        <th>And</th>
                    </tr>
                    <tr>
                        <th>Maximum</th>
                        <td>
                            <select class="form-control form-control-sm max_two" name="hours_max_two">
                                <option value="1" {{ $act->hours_max_two == 1 ? 'selected' : '' }}> Hours </option>
                                <option value="3" {{ $act->hours_max_two == 3 ? 'selected' : '' }}> Unit </option>
                            </select>
                        </td>
                        <th>Per</th>
                        <td>
                            <select class="form-control form-control-sm max_two_select" name="hours_max_per_two">
                                <option value="0"></option>
                                <option value="Day" {{ $act->hours_max_per_two == 'Day' ? 'selected' : '' }}> Day </option>
                                <option value="Week" {{ $act->hours_max_per_two == 'Week' ? 'selected' : '' }}> Week </option>
                                <option value="Month" {{ $act->hours_max_per_two == 'Month' ? 'selected' : '' }}> Month </option>
                                <option value="Total Auth" {{ $act->hours_max_per_two == 'Total Auth' ? 'selected' : '' }}> Total Auth </option>
                            </select>
                        </td>
                        <th>Is</th>
                        <td style="max-width: 100px;">
                            <input type="text" class="form-control form-control-sm" name="hours_max_is_two" value="{{ $act->hours_max_is_two }}">
                        </td>
                        <th>And</th>
                    </tr>
                    <tr>
                        <th>Maximum</th>
                        <td>
                            <select class="form-control form-control-sm max_three" name="hours_max_three">
                                <option value="1" {{ $act->hours_max_three == 1 ? 'selected' : '' }}> Hours </option>
                                <option value="3" {{ $act->hours_max_three == 3 ? 'selected' : '' }}> Unit </option>
                            </select>
                        </td>
                        <th>Per</th>
                        <td>
                            <select class="form-control form-control-sm max_three_select" name="hours_max_per_three">
                                <option value="0"></option>
                                <option value="Day" {{ $act->hours_max_per_three == 'Day' ? 'selected' : '' }}> Day </option>
                                <option value="Week" {{ $act->hours_max_per_three == 'Week' ? 'selected' : '' }}> Week </option>
                                <option value="Month" {{ $act->hours_max_per_three == 'Month' ? 'selected' : '' }}> Month </option>
                                <option value="Total Auth" {{ $act->hours_max_per_three == 'Total Auth' ? 'selected' : '' }}> Total Auth </option>
                            </select>
                        </td>
                        <th>Is</th>
                        <td style="max-width: 100px;">
                            <input type="text" class="form-control form-control-sm" name="hours_max_is_three" value="{{ $act->hours_max_is_three }}">
                        </td>
                        <th></th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <label>Notes</label>
                <textarea class="form-control form-control-sm"
                          name="notes"
                          rows="2">{!! $act->notes !!}</textarea>
            </div>
        </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-sm btn-primary ladda-button"
            data-style="expand-right">Save
    </button>
    <button type="button" class="btn btn-sm btn-primary"
            data-dismiss="modal">Close
    </button>
</div>
</form>
</div>
</div>
</div>


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$activities->links()}}
                </div>

            </div>
            <div class="col-lg-2 align-self-start mt-2">
                <button type="button" class="btn btn-sm btn-primary" id="add_service" data-toggle="modal"
                        data-target="#addactivity">+
                    Add
                    Service
                </button>
            </div>
        </div>

    </div>
    </div>


    <div class="modal fade" id="addactivity" data-backdrop="static">
        <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Add/Edit Service</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('superadmin.client.authorization.ativity.save') }}" method="post"
                          autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <label>Service</label>
                                <select class="form-control form-control-sm serivec_tx" name="activity_one" required>
                                    <option value="Assessment">Assessment</option>
                                    <option value="Direct Behavior Therapy">Direct Behavior Therapy</option>
                                    <option value="Report Writing">Report Writing</option>
                                    <option value="Supervision">Supervision</option>
                                    <option value="Team Meeting">Team Meeting</option>
                                    <option value="Travel Time (Billable)">Travel Time (Billable)</option>
                                    <option value="ABA CON">ABA CON</option>
                                    <option value="Updated Behavior Plan">Updated Behavior Plan</option>
                                    <option value="OA">OA</option>
                                    <option value="Parent Training">Parent Training</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Service Sub-Type</label>
                                <select class="form-control form-control-sm sub_type_acts" name="activity_two" required>
                                    @foreach ($all_sub_acts as $sub_act)
                                        <option value="{{ $sub_act->sub_activity }}">{{ $sub_act->sub_activity }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>CPT Code</label>
                                <div class="ui-widget">

                                    <select class="form-control form-control-sm act_crt_cpt_code" name="cpt_code"
                                            required>
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row no-gutters">
                                    <div class="col-md mr-1">
                                        <label>M1</label>
                                        <input type="text" class="form-control form-control-sm" name="m1">
                                        <input type="hidden" class="form-control form-control-sm" name="client_id"
                                               value="{{ $client_id->id }}">
                                        <input type="hidden" class="form-control form-control-sm" name="authrization_id"
                                               value="{{ $edit_authorization->id }}">
                                    </div>
                                    <div class="col-md mr-1">
                                        <label>M2</label>
                                        <input type="text" class="form-control form-control-sm" name="m2">
                                    </div>
                                    <div class="col-md mr-1">
                                        <label>M3</label>
                                        <input type="text" class="form-control form-control-sm" name="m3">
                                    </div>
                                    <div class="col-md">
                                        <label>M4</label>
                                        <input type="text" class="form-control form-control-sm" name="m4">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 mb-2">
                                <div class="row no-gutters">
                                    <div class="col-md-6">
                                        <label>Billed Per</label>
                                        <select class="form-control form-control-sm billed_type" name="billed_type"
                                                required>
                                            <option value="15 mins">15 mins</option>
                                            <option value="Hour">Hour</option>
                                            <option value="Per Unit" selected>Per Unit</option>
                                            <option value="Per Session">Per Session</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 align-self-end pl-2 create_billed_time_div">
                                        <select class="form-control form-control-sm billed_time" name="billed_time"
                                                required>
                                            <option value="15 min">15 min</option>
                                            <option value="30 min">30 min</option>
                                            <option value="45 min">45 min</option>
                                            <option value="1 hour">1 hour</option>
                                            <option value="2 hour">2 hour</option>
                                            <option value="1 min">1 min</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label>Rate</label>
                                <input type="text" class="form-control form-control-sm" name="rate" required>
                            </div>
                            <div class="col-md-12">
                                <label>Maximum Frequency allowed</label>
                                <table class="table table-sm table-bordered text-left c_table mb-0">
                                    <tr>
                                        <th>Maximum</th>
                                        <td>
                                            <select class="form-control form-control-sm max_one" name="hours_max_one"
                                                    required>
                                                <option value="1">Hours</option>
                                                <option value="3">Unit</option>
                                            </select>
                                        </td>
                                        <th>Per</th>
                                        <td>
                                            <select class="form-control form-control-sm max_one_select"
                                                    name="hours_max_per_one" required>
                                                <option value=""></option>
                                                <option value="Day">Day</option>
                                                <option value="Week">Week</option>
                                                <option value="Month">Month</option>
                                                <option value="Total Auth">Total Auth</option>
                                            </select>
                                        </td>
                                        <th>Is</th>
                                        <td style="max-width: 100px;">
                                            <input type="text" class="form-control form-control-sm"
                                                   name="hours_max_is_one" required>
                                        </td>
                                        <th>And</th>
                                    </tr>
                                    {{--                                    <tr>--}}
                                    {{--                                        <th>Maximum</th>--}}
                                    {{--                                        <td>--}}
                                    {{--                                            <select class="form-control form-control-sm max_two" name="hours_max_two">--}}
                                    {{--                                                <option value="1">Hours</option>--}}
                                    {{--                                                <option value="3">Unit</option>--}}
                                    {{--                                            </select>--}}
                                    {{--                                        </td>--}}
                                    {{--                                        <th>Per</th>--}}
                                    {{--                                        <td>--}}
                                    {{--                                            <select class="form-control form-control-sm max_two_select"--}}
                                    {{--                                                    name="hours_max_per_two">--}}
                                    {{--                                                <option value="0"></option>--}}
                                    {{--                                                <option value="Day">Day</option>--}}
                                    {{--                                                <option value="Week">Week</option>--}}
                                    {{--                                                <option value="Month">Month</option>--}}
                                    {{--                                                <option value="Total Auth">Total Auth</option>--}}
                                    {{--                                            </select>--}}
                                    {{--                                        </td>--}}
                                    {{--                                        <th>Is</th>--}}
                                    {{--                                        <td style="max-width: 100px;">--}}
                                    {{--                                            <input type="text" class="form-control form-control-sm"--}}
                                    {{--                                                   name="hours_max_is_two">--}}
                                    {{--                                        </td>--}}
                                    {{--                                        <th>And</th>--}}
                                    {{--                                    </tr>--}}

                                </table>
                            </div>
                            <div class="col-md-12">
                                <label>Notes</label>
                                <textarea class="form-control form-control-sm" name="notes" rows="2"></textarea>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-sm btn-primary ladda-button"
                            data-style="expand-right">Save
                    </button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@include('superadmin.client.include.editAuthJs')
