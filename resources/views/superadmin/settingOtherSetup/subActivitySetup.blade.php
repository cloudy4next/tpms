@extends('layouts.superadmin')
@section('superadmin')
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
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('superadmin.setting.sub.activity.setup')}}">Service/Activity
                                Sub Types</a>
                        </li>
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="{{route('superadmin.setting.adp.codes')}}">ADP Codes</a>--}}
                        {{--                        </li>--}}
                    </ul>
                    <h6>Service Sub Types</h6>
                    <!-- Filter -->
                    <div class="d-flex my-2">
                        <div class="mr-2 type_filter">
                            <label>Tx Type</label>
                            <select class="form-control form-control-sm treatment_type">
                                <option value="">Select</option>
                                @foreach($facility_treatment as $tret_type)
                                    <option value="{{$tret_type->id}}">{{$tret_type->treatment_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mr-2 type_filter">
                            <label>Type</label>
                            <select class="form-control form-control-sm is_billbale">

                            </select>
                        </div>
                        <div class="mr-2 activity_billable">
                            <label>Service </label>
                            <select class="form-control form-control-sm service_id">
                                <option value=""></option>
                                @foreach($all_service as $service)
                                    <option value="{{$service->id}}">{{$service->description}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mr-2 activity_nonbillable">
                            <label>Service</label>
                            <select class="form-control form-control-sm">
                                <option value="0"></option>
                                <option value="1">Drive Time (Unbillable)</option>
                                <option value="2">Regular Time</option>
                                <option value="3">Training &amp; Admin</option>
                                <option value="4">Fill-In</option>
                                <option value="5">Other</option>
                                <option value="6">Public Holiday</option>
                                <option value="7">Paid Time Off</option>
                                <option value="8">Unpaid</option>
                            </select>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="activity_table sub_act_data">

                    </div>
                    <!-- Edit -->

                    {{--    create sub act--}}
                    <div class="create_new_sub_act">
                        <hr>
                        <h6>Add/Edit Service Sub Type</h6>
                        <form action="#">
                            <div class="d-flex">
                                <div class="mr-4">
                                    <label>Description</label>
                                    <input type="text" class="form-control form-control-sm new_desc">
                                </div>
                                
                                <div class="align-self-center">
                                    <button type="button" class="btn btn-sm btn-primary mr-3" id="create_new_act">Save
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger cancel_edit">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    {{--    edit sub act--}}
                    <div class="edit_activity">
                        <hr>
                        <h6>Add/Edit Service Sub Type</h6>
                        <form action="#">
                            <div class="d-flex">
                                <div class="mr-4">
                                    <label>Description</label>
                                    <input type="text" class="form-control form-control-sm desc">
                                    <input type="hidden" class="form-control form-control-sm act_edit_id">
                                </div>

                                <div class="align-self-center">
                                    <button type="submit" class="btn btn-sm btn-primary mr-3" id="act_update">Save
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger cancel_edit">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@include('superadmin.settingOtherSetup.include.subActivityjs')
