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

    <div class="iq-card">
        <div class="iq-card-body">
            <?php
            $client_info = \App\Models\Client_info::where('client_id', $client_id->id)->first();
            ?>
            <h5 class="mb-2">
                <a href="{{route('superadmin.client.list')}}" title="Back To Client"><i
                        class="ri-arrow-left-circle-line text-primary"></i> </a>
                <a href="{{route('superadmin.client.list')}}"
                   class="cmn_a">{{$client_id->client_first_name}} {{$client_id->client_middle}} {{$client_id->client_last_name}}</a>
                | <small>
                    <span
                        class=" font-weight-bold text-orange">DOB:</span> {{\Carbon\Carbon::parse($client_id->client_dob)->format('m/d/Y')}}
                    |
                    <span class=" font-weight-bold text-orange">Phone:</span> {{$client_id->phone_number}} |

                    <span class=" font-weight-bold text-orange">Address:</span>
                    {{$client_id->client_street}} {{$client_id->client_city}} {{$client_id->client_state}} {{$client_id->client_zip}}

                </small>
            </h5>
            <div class="d-lg-flex">
                <div class="client_menu mr-2">
                    <ul class="nav flex-column setting_menu">
                        <li class="nav-item border-0"><img src="{{asset('assets/dashboard/')}}/images/user/01.jpg"
                                                           class="img-fluid d-block mx-auto" alt=""></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.info',$client_id->id)}}">Patient
                                Info</a></li>
                        <li class="nav-item"><a class="nav-link active"
                                                href="{{route('superadmin.client.authorization',$client_id->id)}}">Ins/Authorization</a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.documents',$client_id->id)}}">Documents</a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.portal',$client_id->id)}}">Patient
                                Portal</a></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('superadmin.client.ledger',$client_id->id)}}">Patient
                                Ledger</a></li>
                        {{--                        <li class="nav-item"><a class="nav-link"--}}
                        {{--                                                href="{{route('superadmin.client.activity',$client_id->id)}}">Patient--}}
                        {{--                                Activity</a></li>--}}
                    </ul>
                </div>
                <div class="all_content flex-fill">
                    <div class="overflow-hidden mb-2">
                        <div class="float-left">
                            <h5 class="m-0">Authorizations List</h5>
                        </div>
                        <div class="float-right">
                            <a href="{{route('superadmin.client.authorization,create',$client_id->id)}}"
                               class="btn btn-sm btn-primary">+ Add Authorization</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered c_table auth_table">
                            <thead>
                            <tr>
                                <th>Description</th>
                                <th>Onset Date</th>
                                <th>End Date</th>
                                <th>Insurance</th>
                                <th>Ins. ID</th>
                                <th>Auth No</th>
                                <th>COB</th>
                                <th>Actions</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody class="accordion" id="accordionExample">
                            @foreach($all_authorizations as $authorization)
                                <?php
                                    $payor_name = \App\Models\All_payor::where('id', $authorization->payor_id)->first();
                                    $all_payors = \App\Models\Payor_facility::where('admin_id', $admin_id)
                                        ->where('payor_id', $authorization->payor_id)->first();
                                ?>
                                <tr>
                                    <td data-toggle="collapse" data-target="#singleauth1{{$authorization->id}}"><i
                                            class="ri-play-fill text-primary mr-2"></i>{{$authorization->description}}
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($authorization->onset_date)->format('m/d/Y')}}</td>
                                    <td>{{\Carbon\Carbon::parse($authorization->end_date)->format('m/d/Y')}}</td>
                                    <td>
                                        @if ($all_payors)
                                            {{$all_payors->payor_name}}
                                        @endif
                                    </td>

                                    <td>{{$authorization->uci_id}}</td>
                                    <td>{{$authorization->authorization_number}}</td>
                                    <td>
                                        @if ($authorization->is_primary == 1)
                                            Primary
                                        @elseif ($authorization->is_primary == 2 )
                                            Secondary
                                        @elseif ($authorization->is_primary == 3 )
                                            Tertiary
                                        @else

                                        @endif
                                    </td>
                                    <td style="max-width: 120px;">
                                        <a href="#selectClient{{$authorization->id}}" data-toggle="modal"
                                           class="pr-2" title="Copy Form Rate Table"><i
                                                class="ri-file-copy-line mr-1"></i></a>|
                                        @if ($authorization->is_primary == 1)
                                            <a href="#addactivity{{$authorization->id}}" class="px-2"
                                               data-toggle="modal" title="Add Activity"><i class="ri-add-line"></i></a>|
                                        @endif
                                        <a href="{{route('superadmin.client.authorization.edit',$authorization->id)}}"
                                           class="px-2" title="Edit"><i class="ri-edit-box-line text-success mx-1"
                                                                        aria-hidden="true"></i></a>|
                                        <a href="{{route('superadmin.client.authorization.delete',$authorization->id)}}"
                                           class="pl-2" title="Delete"><i class="ri-delete-bin-line text-danger"
                                                                          aria-hidden="true"></i></a>


                                        @include('superadmin.client.authInc.copyRateInc')

<div class="modal fade" id="addactivity{{$authorization->id}}"
     data-backdrop="static">
    <div class="modal-dialog text-left modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add/Edit Service</h4>
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('superadmin.client.authorization.ativity.save')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <input type="hidden" value="{{$authorization->treatment_type_id}}" class="tx_type_h">
                        <div class="col-md-5 mb-2">
                            <label>Service</label>
                            <?php
                                $service_id = 0;
                                $sub_table_service = \App\Models\setting_service::where('admin_id', $admin_id)
                                    ->where('facility_treatment_id', $authorization->treatment_type_id)
                                    ->get();
                            ?>
                            <select class="form-control form-control-sm service_main" name="activity_one" required>
                                <?php $i = 1;?>
                                @foreach($sub_table_service as $subtable_ser)
                                    <?php
                                        if($i==1){
                                            $service_id = $subtable_ser->id;
                                        }
                                    ?>
                                    <option value="{{$subtable_ser->description}}" data-id="{{$subtable_ser->id}}">
                                        {{$subtable_ser->description}}
                                    </option>
                                <?php $i++; ?>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Service Sub-Type</label>
                            <?php
                                $sub_table_subservice = \App\Models\all_sub_activity::where('admin_id', $admin_id)
                                    ->where('facility_treatment_id', $authorization->treatment_type_id)
                                    ->where('service_id',$service_id)
                                    ->get();
                            ?>
                            <select class="form-control form-control-sm service_sub_type" name="activity_two">
                                @foreach($sub_table_subservice as $sub_act)
                                    <option value="{{$sub_act->sub_activity}}">{{$sub_act->sub_activity}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>CPT Code</label>
                            <?php
                                $sub_table_cpt = \App\Models\setting_cpt_code::where('admin_id', $admin_id)
                                    ->where('facility_treatment_id', $authorization->treatment_type_id)
                                    ->get();
                            ?>
                            <select class="form-control form-control-sm"
                                    name="cpt_code" required>
                                <option value="">Select</option>
                                @foreach($sub_table_cpt as $cpt)
                                    <option value="{{$cpt->cpt_id}}">{{$cpt->cpt_code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <div class="row no-gutters">
                                <div class="col-md mr-1">
                                    <label>M1</label>
                                    <input type="text"
                                           class="form-control form-control-sm"
                                           name="m1">
                                    <input type="hidden"
                                           class="form-control form-control-sm"
                                           name="client_id"
                                           value="{{$client_id->id}}">
                                    <input type="hidden"
                                           class="form-control form-control-sm"
                                           name="authrization_id"
                                           value="{{$authorization->id}}">
                                </div>
                                <div class="col-md mr-1">
                                    <label>M2</label>
                                    <input type="text"
                                           class="form-control form-control-sm"
                                           name="m2">
                                </div>
                                <div class="col-md mr-1">
                                    <label>M3</label>
                                    <input type="text"
                                           class="form-control form-control-sm"
                                           name="m3">
                                </div>
                                <div class="col-md">
                                    <label>M4</label>
                                    <input type="text"
                                           class="form-control form-control-sm"
                                           name="m4">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 mb-2">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <label>Billed Per</label>
                                    <select
                                        class="form-control form-control-sm billed_type"
                                        name="billed_type" required>
                                        <option value="15 mins">15 mins</option>
                                        <option value="Hour">Hour</option>
                                        <option value="Per Unit" selected>Per
                                            Unit
                                        </option>
                                        <option value="Per Session">Per
                                            Session
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6 align-self-end pl-2">
                                    <select
                                        class="form-control form-control-sm billed_time"
                                        name="billed_time" required>
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
                            <input type="text"
                                   class="form-control form-control-sm"
                                   name="rate" required>
                        </div>
                        <div class="col-md-12">
                            <label>Maximum Frequency allowed</label>
                            <table
                                class="table table-sm table-bordered text-left c_table mb-0">
                                <tr>
                                    <th>Maximum</th>
                                    <td>
                                        <select
                                            class="form-control form-control-sm max_one"
                                            name="hours_max_one" required>
                                            <option value="1">Hours</option>
                                            <option value="3">Unit</option>
                                        </select>
                                    </td>
                                    <th>Per</th>
                                    <td>
                                        <select
                                            class="form-control form-control-sm max_one_select"
                                            name="hours_max_per_one" required>
                                            <option value=""></option>
                                            <option value="Day">Day</option>
                                            <option value="Week">Week</option>
                                            <option value="Month">Month</option>
                                            <option value="Total Auth">Total
                                                Auth
                                            </option>
                                        </select>
                                    </td>
                                    <th>Is</th>
                                    <td style="max-width: 100px;">
                                        <input type="text"
                                               class="form-control form-control-sm"
                                               name="hours_max_is_one" required>
                                    </td>
                                    <th>And</th>
                                </tr>
                                <tr>
                                    <th>Maximum</th>
                                    <td>
                                        <select
                                            class="form-control form-control-sm max_two"
                                            name="hours_max_two">
                                            <option value="1">Hours</option>
                                            <option value="3">Unit</option>
                                        </select>
                                    </td>
                                    <th>Per</th>
                                    <td>
                                        <select
                                            class="form-control form-control-sm max_two_select"
                                            name="hours_max_per_two">
                                            <option value=""></option>
                                            <option value="Day">Day</option>
                                            <option value="Week">Week</option>
                                            <option value="Month">Month</option>
                                            <option value="Total Auth">Total
                                                Auth
                                            </option>
                                        </select>
                                    </td>
                                    <th>Is</th>
                                    <td style="max-width: 100px;">
                                        <input type="text"
                                               class="form-control form-control-sm"
                                               name="hours_max_is_two">
                                    </td>
                                    <th>And</th>
                                </tr>
                                <tr>
                                    <th>Maximum</th>
                                    <td>
                                        <select
                                            class="form-control form-control-sm max_three"
                                            name="hours_max_three">
                                            <option value="1">Hours</option>
                                            <option value="3">Unit</option>
                                        </select>
                                    </td>
                                    <th>Per</th>
                                    <td>
                                        <select
                                            class="form-control form-control-sm max_three_select"
                                            name="hours_max_per_three">
                                            <option value=""></option>
                                            <option value="Day">Day</option>
                                            <option value="Week">Week</option>
                                            <option value="Month">Month</option>
                                            <option value="Total Auth">Total
                                                Auth
                                            </option>
                                        </select>
                                    </td>
                                    <th>Is</th>
                                    <td style="max-width: 100px;">
                                        <input type="text"
                                               class="form-control form-control-sm"
                                               name="hours_max_is_three">
                                    </td>
                                    <th>And</th>
                                </tr>


                            </table>
                        </div>
                        <div class="col-md-12">
                            <label>Notes</label>
                            <textarea class="form-control form-control-sm"
                                      name="notes" rows="2"></textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit"
                        class="btn btn-sm btn-primary ladda-button"
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
                                    <td>
                                        @if ($authorization->is_placeholder == 1 )
                                            <i class="ri-checkbox-blank-circle-fill text-danger"
                                               title="Placeholder"></i> -P
                                        @elseif ($authorization->is_valid == 1 )
                                            <i class="ri-checkbox-blank-circle-fill text-success" title="Active"></i>
                                        @elseif ($authorization->is_valid != 1 )
                                            <i class="ri-checkbox-blank-circle-fill text-danger" title="In-Active"></i>
                                        @elseif ($authorization->is_valid == 1 && $authorization->is_placeholder == 1)
                                            <i class="ri-checkbox-blank-circle-fill text-success" title="Active"></i> -P
                                        @else
                                            <i class="ri-checkbox-blank-circle-fill text-success" title="Active"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9">
                                        <div id="singleauth1{{$authorization->id}}" class="collapse"
                                             data-parent="#accordionExample">
                                            <table class="table table-sm table-bordered bg-light c_table m-0">
                                                <thead style="background: #089239;">
                                                <tr>
                                                    <th>Service</th>
                                                    <th>Cpt code</th>
                                                    <th>Max By</th>
                                                    <th>Frequency</th>
                                                    <th>Auth</th>
                                                    <th>Scheduled</th>
                                                    <th>Rendered</th>
                                                    <th>Remaining</th>

                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $activities_data = \App\Models\Client_authorization_activity::where('authorization_id', $authorization->id)->get();
                                                ?>
                                                @foreach($activities_data as $act)
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
                                                        $cpt_name = \App\Models\setting_cpt_code::where('cpt_id', $act->cpt_code)
                                                                    ->where('admin_id', $admin_id)
                                                                    ->first();

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
                                                            @if ($cpt_name)
                                                                {{$cpt_name->cpt_code}}
                                                            @endif
                                                        </td>
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

                                                        <td>
                                                            @if (empty($act->hours_max_one) && empty($act->hours_max_per_one) && empty($act->hours_max_is_one))
                                                                @if ($authorization->payor_id != 12)
                                                                    <a href="#" title="Frequency not set"><i class="ri-alert-line text-danger pr-2"></i></a>|
                                                                @endif
                                                            @endif

                                                            <a href="#editactivity{{$act->id}}" class="px-2"
                                                               data-toggle="modal" title="Edit">
                                                                <i class="ri-edit-box-line text-success "
                                                                   aria-hidden="true"></i>
                                                            </a>|
                                                            <a href="{{route('superadmin.client.authorization.ativity.delete',$act->id)}}"
                                                               class="px-2" title="Delete"><i
                                                                    class="ri-delete-bin-line text-danger"
                                                                    aria-hidden="true"></i></a>

<div class="modal fade" id="editactivity{{$act->id}}" data-backdrop="static">
    <div class="modal-dialog text-left modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add/Edit Service</h4>
                <button type="button" class="close"
                        data-dismiss="modal">&times;
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('superadmin.client.authorization.ativity.update')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <input type="hidden" value="{{$authorization->treatment_type_id}}" class="tx_type_h">
                        <div class="col-md-5 mb-2">
                            <label>Service</label>
                            <?php
                                $service_id = 0;
                                $sub_table_service_edit = \App\Models\setting_service::where('admin_id', $admin_id)
                                    ->where('facility_treatment_id', $authorization->treatment_type_id)
                                    ->get();
                            ?>
                            <select class="form-control form-control-sm service_main" name="activity_one" required>
                                @foreach($sub_table_service_edit as $sub_tab_ser_ed)

                                    <?php
                                        if($act->activity_one == $sub_tab_ser_ed->description){
                                            $service_id = $sub_tab_ser_ed->id;
                                        }
                                    ?>

                                    <option value="{{$sub_tab_ser_ed->description}}" {{$act->activity_one == $sub_tab_ser_ed->description ? 'selected' : ''}} data-id="{{$sub_tab_ser_ed->id}}">
                                        {{$sub_tab_ser_ed->description}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Service Sub-Type</label>
                            <?php
                                $sub_table_subserviceedit = \App\Models\all_sub_activity::where('admin_id',$admin_id)->where('facility_treatment_id', $authorization->treatment_type_id)->where('service_id',$service_id)->get();
                            ?>
                            <select
                                class="form-control form-control-sm service_sub_type" name="activity_two" required>
                                    <option></option>
                                @foreach($sub_table_subserviceedit as $sub_act)
                                    <option value="{{$sub_act->sub_activity}}" {{$act->activity_two == $sub_act->sub_activity ? 'selected' : ''}}>{{$sub_act->sub_activity}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>CPT Code</label>
                            <?php
                                $sub_table_cptedit = \App\Models\setting_cpt_code::where('admin_id', $admin_id)
                                    ->where('facility_treatment_id', $authorization->treatment_type_id)
                                    ->get();
                            ?>
                            <select
                                class="form-control form-control-sm"
                                name="cpt_code" required>
                                <option value="">Select
                                </option>
                                @foreach($sub_table_cptedit as $cpt)
                                    <option value="{{$cpt->cpt_id}}" {{$act->cpt_code == $cpt->cpt_id ? 'selected' : ''}}>{{$cpt->cpt_code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <div class="row no-gutters">
                                <div class="col-md mr-1">
                                    <label>M1</label>
                                    <input type="text"
                                           class="form-control form-control-sm"
                                           name="m1"
                                           value="{{$act->m1}}"
                                    >
                                    <input type="hidden"
                                           class="form-control form-control-sm"
                                           name="edit_activity_id"
                                           value="{{$act->id}}">
                                    <input type="hidden"
                                           class="form-control form-control-sm"
                                           name="authrization_id"
                                           value="{{$act->authorization_id}}">
                                </div>
                                <div class="col-md mr-1">
                                    <label>M2</label>
                                    <input type="text"
                                           class="form-control form-control-sm"
                                           name="m2"
                                           value="{{$act->m2}}"
                                    >
                                </div>
                                <div class="col-md mr-1">
                                    <label>M3</label>
                                    <input type="text"
                                           class="form-control form-control-sm"
                                           name="m3"
                                           value="{{$act->m3}}"
                                    >
                                </div>
                                <div class="col-md">
                                    <label>M4</label>
                                    <input type="text"
                                           class="form-control form-control-sm"
                                           name="m4"
                                           value="{{$act->m4}}"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 mb-2">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <label>Billed
                                        Per</label>
                                    <select
                                        class="form-control form-control-sm billed_type1"
                                        name="billed_type"
                                        required>
                                        <option
                                            value="15 mins" {{$act->billed_type == "15 mins" ? 'selected' : ''}}>
                                            15 mins
                                        </option>
                                        <option
                                            value="Hour" {{$act->billed_type == "Hour" ? 'selected' : ''}}>
                                            Hour
                                        </option>
                                        <option
                                            value="Per Unit" {{$act->billed_type == "Per Unit" ? 'selected' : ''}}>
                                            Per Unit
                                        </option>
                                        <option
                                            value="Per Session" {{$act->billed_type == "Per Session" ? 'selected' : ''}}>
                                            Per Session
                                        </option>
                                    </select>
                                </div>
                                <div
                                    class="col-md-6 align-self-end pl-2">
                                    <select
                                        class="form-control form-control-sm billed_time1"
                                        name="billed_time"
                                        required>
                                        <option
                                            value="15 min" {{$act->billed_time == "15 min" ? 'selected' : ''}}>
                                            15 min
                                        </option>
                                        <option
                                            value="30 min" {{$act->billed_time == "30 min" ? 'selected' : ''}}>
                                            30 min
                                        </option>
                                        <option
                                            value="45 min" {{$act->billed_time == "45 min" ? 'selected' : ''}}>
                                            45 min
                                        </option>
                                        <option
                                            value="1 hour" {{$act->billed_time == "1 hour" ? 'selected' : ''}}>
                                            1 hour
                                        </option>
                                        <option
                                            value="2 hour" {{$act->billed_time == "2 hour" ? 'selected' : ''}}>
                                            2 hour
                                        </option>
                                        <option
                                            value="1 min" {{$act->billed_time == "1 min" ? 'selected' : ''}}>
                                            1 min
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label>Rate</label>
                            <input type="text"
                                   class="form-control form-control-sm"
                                   name="rate"
                                   value="{{$act->rate}}"
                                   required>
                        </div>
                        <div class="col-md-12">
                            <label>Maximum Frequency
                                allowed</label>
                            <table
                                class="table table-sm table-bordered text-left c_table mb-0">
                                <?php
                                $get_ext_act_app = \App\Models\Appoinment::select('authorization_activity_id', 'is_locked')
                                    ->where('authorization_activity_id', $act->id)
                                    ->where('is_locked', 1)
                                    ->count();

                                ?>
                                <tr>
                                    <th>Maximum</th>
                                    <td>
                                        <select
                                            class="form-control form-control-sm max_one"
                                            name="hours_max_one"
                                            {{$get_ext_act_app > 0 ? '' : ''}} required>
                                            <option
                                                value="1" {{$act->hours_max_one == 1 ? 'selected' :''}}>
                                                Hours
                                            </option>
                                            <option
                                                value="3" {{$act->hours_max_one == 3 ? 'selected' :''}}>
                                                Unit
                                            </option>
                                        </select>
                                    </td>
                                    <th>Per</th>
                                    <td>
                                        <select
                                            class="form-control form-control-sm max_one_select"
                                            name="hours_max_per_one"
                                            {{$get_ext_act_app > 0 ? '' : ''}} required>
                                            <option
                                                value=""></option>
                                            <option
                                                value="Day" {{$act->hours_max_per_one == 'Day' ? 'selected' :''}}>
                                                Day
                                            </option>
                                            <option
                                                value="Week" {{$act->hours_max_per_one == 'Week' ? 'selected' :''}}>
                                                Week
                                            </option>
                                            <option
                                                value="Month" {{$act->hours_max_per_one == 'Month' ? 'selected' :''}}>
                                                Month
                                            </option>
                                            <option
                                                value="Total Auth" {{$act->hours_max_per_one == 'Total Auth' ? 'selected' :''}}>
                                                Total Auth
                                            </option>
                                        </select>
                                    </td>
                                    <th>Is</th>
                                    <td style="max-width: 100px;">
                                        <input type="text"
                                               class="form-control form-control-sm"
                                               name="hours_max_is_one"
                                               value="{{$act->hours_max_is_one}}"
                                               {{$get_ext_act_app > 0 ? '' : ''}} required>
                                    </td>
                                    <th>And</th>
                                </tr>

                                <tr>
                                    <th>Maximum</th>
                                    <td>
                                        <select
                                            class="form-control form-control-sm max_two"
                                            name="hours_max_two"
                                            {{$get_ext_act_app > 0 ? '' : ''}}>
                                            <option
                                                value="1" {{$act->hours_max_two == 1 ? 'selected' :''}}>
                                                Hours
                                            </option>
                                            <option
                                                value="3" {{$act->hours_max_two == 3 ? 'selected' :''}}>
                                                Unit
                                            </option>
                                        </select>
                                    </td>
                                    <th>Per</th>
                                    <td>
                                        <select
                                            class="form-control form-control-sm max_two_select"
                                            name="hours_max_per_two"
                                            {{$get_ext_act_app > 0 ? '' : ''}}>
                                            <option
                                                value=""></option>
                                            <option
                                                value="Day" {{$act->hours_max_per_two == 'Day' ? 'selected' :''}}>
                                                Day
                                            </option>
                                            <option
                                                value="Week" {{$act->hours_max_per_two == 'Week' ? 'selected' :''}}>
                                                Week
                                            </option>
                                            <option
                                                value="Month" {{$act->hours_max_per_two == 'Month' ? 'selected' :''}}>
                                                Month
                                            </option>
                                            <option
                                                value="Total Auth" {{$act->hours_max_per_two == 'Total Auth' ? 'selected' :''}}>
                                                Total Auth
                                            </option>
                                        </select>
                                    </td>
                                    <th>Is</th>
                                    <td style="max-width: 100px;">
                                        <input type="text"
                                               class="form-control form-control-sm"
                                               name="hours_max_is_two"
                                               value="{{$act->hours_max_is_two}}"
                                               {{$get_ext_act_app > 0 ? '' : ''}}>
                                    </td>
                                    <th>And</th>
                                </tr>

                                <tr>
                                    <th>Maximum</th>
                                    <td>
                                        <select
                                            class="form-control form-control-sm max_three"
                                            name="hours_max_three"
                                            {{$get_ext_act_app > 0 ? '' : ''}}>
                                            <option
                                                value="1" {{$act->hours_max_three == 1 ? 'selected' :''}}>
                                                Hours
                                            </option>
                                            <option
                                                value="3" {{$act->hours_max_three == 3 ? 'selected' :''}}>
                                                Unit
                                            </option>
                                        </select>
                                    </td>
                                    <th>Per</th>
                                    <td>
                                        <select
                                            class="form-control form-control-sm max_three_select"
                                            name="hours_max_per_three"
                                            {{$get_ext_act_app > 0 ? '' : ''}}>
                                            <option
                                                value=""></option>
                                            <option
                                                value="Day" {{$act->hours_max_per_three == 'Day' ? 'selected' :''}}>
                                                Day
                                            </option>
                                            <option
                                                value="Week" {{$act->hours_max_per_three == 'Week' ? 'selected' :''}}>
                                                Week
                                            </option>
                                            <option
                                                value="Month" {{$act->hours_max_per_three == 'Month' ? 'selected' :''}}>
                                                Month
                                            </option>
                                            <option
                                                value="Total Auth" {{$act->hours_max_per_three == 'Total Auth' ? 'selected' :''}}>
                                                Total Auth
                                            </option>
                                        </select>
                                    </td>
                                    <th>Is</th>
                                    <td style="max-width: 100px;">
                                        <input type="text"
                                               class="form-control form-control-sm"
                                               name="hours_max_is_three"
                                               value="{{$act->hours_max_is_three}}"
                                               {{$get_ext_act_app > 0 ? '' : ''}}>
                                    </td>
                                    <th></th>
                                </tr>

                            </table>
                        </div>
                        <div class="col-md-12">
                            <label>Notes</label>
                            <textarea
                                class="form-control form-control-sm"
                                name="notes"
                                rows="2">{!! $act->notes !!}</textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit"
                        class="btn btn-sm btn-primary ladda-button"
                        data-style="expand-right">Save
                </button>
                <button type="button"
                        class="btn btn-sm btn-primary"
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
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {


            $('.check_all_rate').click(function () {
                if ($(this).prop("checked") == true) {
                    $('.rate_check').each(function () {
                        $(this).prop('checked', true);
                    });
                } else if ($(this).prop("checked") == false) {
                    $('.rate_check').each(function () {
                        $(this).prop('checked', false);
                    });
                }
            })


            {{--$('.copy_contact_rate').click(function () {--}}
            {{--    var auth_id = $(this).data('id');--}}

            {{--    var array = [];--}}
            {{--    --}}
            {{--    $('.rate_check:checked').each(function () {--}}
            {{--        array.push($(this).val());--}}
            {{--    });--}}

            {{--    console.log(array);--}}

            {{--    if (array == null || array.length <= 0) {--}}

            {{--    } else {--}}
            {{--        $.ajax({--}}
            {{--            type: "POST",--}}
            {{--            url: "{{route('superadmin.copy.contact.rate')}}",--}}
            {{--            data: {--}}
            {{--                '_token': "{{csrf_token()}}",--}}
            {{--                'auth_id': auth_id,--}}
            {{--                'array': array,--}}
            {{--            },--}}
            {{--            success: function (data) {--}}
            {{--                console.log(data);--}}
            {{--                // if (data == 'done') {--}}
            {{--                //     location.reload();--}}
            {{--                //     toastr["success"]("Contract Rate Copied Successfully", 'SUCCESS!');--}}
            {{--                // }--}}
            {{--            }--}}
            {{--        });--}}
            {{--    }--}}


            {{--})--}}


            $('.max_one').change(function () {
                var id = $(this).val();
                if (id == 1) {
                    $('.max_one_select').empty();
                    $('.max_one_select').append(
                        `
                             <option value="0"></option>
                                 <option value="Day">Day</option>
                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                } else {
                    $('.max_one_select').empty();
                    $('.max_one_select').append(
                        `
                             <option value="0"></option>

                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                }

            })


            $('.max_two').change(function () {
                var id = $(this).val();
                if (id == 1) {
                    $('.max_two_select').empty();
                    $('.max_two_select').append(
                        `
                             <option value="0"></option>
                                 <option value="Day">Day</option>
                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                } else {
                    $('.max_two_select').empty();
                    $('.max_two_select').append(
                        `
                             <option value="0"></option>

                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                }

            })

            $('.max_three').change(function () {
                var id = $(this).val();
                if (id == 1) {
                    $('.max_three_select').empty();
                    $('.max_three_select').append(
                        `
                             <option value="0"></option>
                                 <option value="Day">Day</option>
                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                } else {
                    $('.max_three_select').empty();
                    $('.max_three_select').append(
                        `
                             <option value="0"></option>

                                 <option value="Week">Week</option>
                                 <option value="Month">Month</option>
                             <option value="Total Auth">Total Auth</option>
                        `
                    );
                }

            })
        })
    </script>
    <script>
        $(document).ready(function () {
            $('.billed_time').hide();
            $('.billed_time1').hide();
            var billed_type = $('.billed_type').val();
            if (billed_type == "Per Unit") {
                $('.billed_time').show();
            } else if (billed_type == "Per Session") {
                $('.billed_time').hide();
            } else {
                $('.billed_time').hide();
            }


            var billed_type1 = $('.billed_type1').val();
            if (billed_type1 == "Per Unit") {
                $('.billed_time1').show();
            } else if (billed_type1 == "Per Session") {
                $('.billed_time1').hide();
            } else {
                $('.billed_time1').hide();
            }


            $('.billed_type').change(function () {
                var value_data = $(this).val();
                if (value_data == "Per Unit") {
                    $('.billed_time').show();
                } else if (value_data == "Per Session") {
                    $('.billed_time').hide();
                } else {
                    $('.billed_time').hide();
                }
            })


            $('.billed_type1').change(function () {
                var value_data1 = $(this).val();
                if (value_data1 == "Per Unit") {
                    $('.billed_time1').show();
                } else if (value_data1 == "Per Session") {
                    $('.billed_time1').hide();
                } else {
                    $('.billed_time1').hide();
                }
            })


        })
    </script>


    <script>
        $('.service_main').change(function(){
            service_id = $(this).find('option:selected').data('id');
            tx_type = $(this).closest('.row').find('.tx_type_h').val();
            sel = $(this).closest('.row').find('.service_sub_type');
            sel.empty();

            $.ajax({
                url:"{{route('superadmin.client.authorization.fetch.subactivity')}}",
                type:"POST",
                data:{
                    "_token":"{{csrf_token()}}",
                    service_id : service_id,
                    tx_type : tx_type,
                },
                success:function(data){
                    $.each(data,function(i,d){
                        sel.append(`<option value="`+d.sub_activity+`">`+d.sub_activity+`</option>`);
                    })
                }
            });
        })
    </script>







@endsection
