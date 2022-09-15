@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu">
                    @include('superadmin.include.settingMenu')
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h6>Click on each Service name to edit</h6>
                    <p class="mb-2">Service Descriptions are shown throughout the SimplePractice platform internally, in
                        some client communications and in Superbills.</p>
                    <a href="#addservice" class="btn btn-sm btn-primary mb-3" data-toggle="modal">Add new
                        service</a>
                    <div class="modal fade" id="addservice" data-backdrop="static">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Add/Edit Service</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form action="{{route('superadmin.setting.services.save')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <form action="#" method="post">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Tx ype</label>
                                                    <select class="form-control form-control-sm"
                                                            name="facility_treatment_id" required>
                                                        <option value=""></option>
                                                        @foreach($facility_treatment as $fac_treet)
                                                            <option
                                                                value="{{$fac_treet->id}}">{{$fac_treet->treatment_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Service Type</label>
                                                    <select class="form-control form-control-sm" name="type" required>
                                                        <option value="1">Billable</option>
                                                        <option value="2">Non-Billable</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Service</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="description">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Billed Per</label>
                                                    <select class="form-control form-control-sm" name="per_session">
                                                        <option value=""></option>
                                                        <option value="per_unit">Per Unit</option>
                                                        <option value="per_session">Per Session</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Duration</label>
                                                    <select class="form-control form-control-sm" name="duration">
                                                        <option value="5">5 min</option>
                                                        <option value="10">10 min</option>
                                                        <option value="15">15 min</option>
                                                        <option value="20">20 min</option>
                                                        <option value="25">25 min</option>
                                                        <option value="30">30 min</option>
                                                        <option value="35">35 min</option>
                                                        <option value="40">40 min</option>
                                                        <option value="45">45 min</option>
                                                        <option value="50">50 min</option>
                                                        <option value="55">55 min</option>
                                                        <option value="60">60 min</option>
                                                        <option value="65">1:05 hrs</option>
                                                        <option value="70">1:10 hrs</option>
                                                        <option value="75">1:15 hrs</option>
                                                        <option value="80">1:20 hrs</option>
                                                        <option value="85">1:25 hrs</option>
                                                        <option value="90">1:30 hrs</option>
                                                        <option value="95">1:35 hrs</option>
                                                        <option value="100">1:40 hrs</option>
                                                        <option value="105">1:45 hrs</option>
                                                        <option value="110">1:50 hrs</option>
                                                        <option value="115">1:55 hrs</option>
                                                        <option value="120">2:00 hrs</option>
                                                        <option value="125">2:05 hrs</option>
                                                        <option value="130">2:10 hrs</option>
                                                        <option value="135">2:15 hrs</option>
                                                        <option value="140">2:20 hrs</option>
                                                        <option value="145">2:25 hrs</option>
                                                        <option value="150">2:30 hrs</option>
                                                        <option value="155">2:35 hrs</option>
                                                        <option value="160">2:40 hrs</option>
                                                        <option value="165">2:45 hrs</option>
                                                        <option value="170">2:50 hrs</option>
                                                        <option value="175">2:55 hrs</option>
                                                        <option value="180">3:00 hrs</option>
                                                        <option value="185">3:05 hrs</option>
                                                        <option value="190">3:10 hrs</option>
                                                        <option value="195">3:15 hrs</option>
                                                        <option value="200">3:20 hrs</option>
                                                        <option value="205">3:25 hrs</option>
                                                        <option value="210">3:30 hrs</option>
                                                        <option value="215">3:35 hrs</option>
                                                        <option value="220">3:40 hrs</option>
                                                        <option value="225">3:45 hrs</option>
                                                        <option value="230">3:50 hrs</option>
                                                        <option value="235">3:55 hrs</option>
                                                        <option value="240">4:00 hrs</option>
                                                        <option value="245">4:05 hrs</option>
                                                        <option value="250">4:10 hrs</option>
                                                        <option value="255">4:15 hrs</option>
                                                        <option value="260">4:20 hrs</option>
                                                        <option value="265">4:25 hrs</option>
                                                        <option value="270">4:30 hrs</option>
                                                        <option value="275">4:35 hrs</option>
                                                        <option value="280">4:40 hrs</option>
                                                        <option value="285">4:45 hrs</option>
                                                        <option value="290">4:50 hrs</option>
                                                        <option value="295">4:55 hrs</option>
                                                        <option value="300">5:00 hrs</option>
                                                        <option value="305">5:05 hrs</option>
                                                        <option value="310">5:10 hrs</option>
                                                        <option value="315">5:15 hrs</option>
                                                        <option value="320">5:20 hrs</option>
                                                        <option value="325">5:25 hrs</option>
                                                        <option value="330">5:30 hrs</option>
                                                        <option value="335">5:35 hrs</option>
                                                        <option value="340">5:40 hrs</option>
                                                        <option value="345">5:45 hrs</option>
                                                        <option value="350">5:50 hrs</option>
                                                        <option value="355">5:55 hrs</option>
                                                        <option value="360">6:00 hrs</option>
                                                        <option value="365">6:05 hrs</option>
                                                        <option value="370">6:10 hrs</option>
                                                        <option value="375">6:15 hrs</option>
                                                        <option value="380">6:20 hrs</option>
                                                        <option value="385">6:25 hrs</option>
                                                        <option value="390">6:30 hrs</option>
                                                        <option value="395">6:35 hrs</option>
                                                        <option value="400">6:40 hrs</option>
                                                        <option value="405">6:45 hrs</option>
                                                        <option value="410">6:50 hrs</option>
                                                        <option value="415">6:55 hrs</option>
                                                        <option value="420">7:00 hrs</option>
                                                        <option value="425">7:05 hrs</option>
                                                        <option value="430">7:10 hrs</option>
                                                        <option value="435">7:15 hrs</option>
                                                        <option value="440">7:20 hrs</option>
                                                        <option value="445">7:25 hrs</option>
                                                        <option value="450">7:30 hrs</option>
                                                        <option value="455">7:35 hrs</option>
                                                        <option value="460">7:40 hrs</option>
                                                        <option value="465">7:45 hrs</option>
                                                        <option value="470">7:50 hrs</option>
                                                        <option value="475">7:55 hrs</option>
                                                        <option value="480">8 hrs</option>
                                                        <option value="540">9 hrs</option>
                                                        <option value="600">10 hrs</option>
                                                        <option value="660">11 hrs</option>
                                                        <option value="720">12 hrs</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Mileage</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="mileage">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <h6 class="mt-2">Services</h6>
                    <div class="table-responsive">
                        <table class="table-bordered table-sm table c_table">
                            <thead>
                            <tr>
                                <th>Tx Type</th>
                                <th>Service Type</th>
                                <th>Service</th>
                                <th>Duration</th>
                                <th>Mileage</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($set_services as $serv)
                                <?php
                                $treat_name = \App\Models\Treatment_facility::where('id', $serv->facility_treatment_id)->first();
                                ?>
                                <tr>
                                    <td>
                                        @if ($treat_name)
                                            {{$treat_name->treatment_name}}
                                        @else
                                            Not Set
                                        @endif
                                    </td>
                                    <td>
                                        @if ($serv->type == 1)
                                            Billable
                                        @elseif ($serv->type == 2)
                                            Non-Billable
                                        @else
                                            Not Set
                                        @endif
                                    </td>
                                    <td>{!! $serv->description !!}</td>
                                    <td>{{$serv->duration}}</td>
                                    <td>{{$serv->mileage}}</td>
                                    <td>
                                        <a href="#editService{{$serv->id}}" data-toggle="modal"><i
                                                class="ri-edit-box-line px-2"></i></a>|
                                        <a href="{{route('superadmin.setting.services.delete',$serv->id)}}"><i
                                                class="ri-delete-bin-line text-danger px-2"></i></a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editService{{$serv->id}}" data-backdrop="static">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4>Add/Edit Service</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>
                                            <form action="{{route('superadmin.setting.services.update')}}"
                                                  method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Tx ype</label>
                                                            <select class="form-control form-control-sm"
                                                                    name="facility_treatment_id_edit" required>
                                                                <option value=""></option>
                                                                @foreach($facility_treatment as $fac_treet)
                                                                    <option
                                                                        value="{{$fac_treet->id}}" {{$fac_treet->id == $serv->facility_treatment_id ? 'selected' : ''}}>{{$fac_treet->treatment_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Type</label>
                                                            <select class="form-control form-control-sm" name="type">
                                                                <option value="1" {{$serv->type == 1 ? 'selected' :''}}>
                                                                    Billable
                                                                </option>
                                                                <option value="2" {{$serv->type == 2 ? 'selected' :''}}>
                                                                    Non-Billable
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Service</label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                   name="description" value="{{$serv->description}}">
                                                            <input type="hidden" class="form-control form-control-sm"
                                                                   name="service_edit" value="{{$serv->id}}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Duration</label>
                                                            <select class="form-control form-control-sm"
                                                                    name="duration">
                                                                <option
                                                                    value="5" {{$serv->duration == 5 ? 'selected' :''}}>
                                                                    5 min
                                                                </option>
                                                                <option
                                                                    value="10" {{$serv->duration == 10 ? 'selected' :''}}>
                                                                    10 min
                                                                </option>
                                                                <option
                                                                    value="15" {{$serv->duration == 15 ? 'selected' :''}}>
                                                                    15 min
                                                                </option>
                                                                <option
                                                                    value="20" {{$serv->duration == 20 ? 'selected' :''}}>
                                                                    20 min
                                                                </option>
                                                                <option
                                                                    value="25" {{$serv->duration == 25 ? 'selected' :''}}>
                                                                    25 min
                                                                </option>
                                                                <option
                                                                    value="30" {{$serv->duration == 30 ? 'selected' :''}}>
                                                                    30 min
                                                                </option>
                                                                <option
                                                                    value="35" {{$serv->duration == 35 ? 'selected' :''}}>
                                                                    35 min
                                                                </option>
                                                                <option
                                                                    value="40" {{$serv->duration == 40 ? 'selected' :''}}>
                                                                    40 min
                                                                </option>
                                                                <option
                                                                    value="45" {{$serv->duration == 45 ? 'selected' :''}}>
                                                                    45 min
                                                                </option>
                                                                <option
                                                                    value="50" {{$serv->duration == 50 ? 'selected' :''}}>
                                                                    50 min
                                                                </option>
                                                                <option
                                                                    value="55" {{$serv->duration == 55 ? 'selected' :''}}>
                                                                    55 min
                                                                </option>
                                                                <option
                                                                    value="60" {{$serv->duration == 60 ? 'selected' :''}}>
                                                                    60 min
                                                                </option>
                                                                <option
                                                                    value="65" {{$serv->duration == 65 ? 'selected' :''}}>
                                                                    1:05 hrs
                                                                </option>
                                                                <option
                                                                    value="70" {{$serv->duration == 70 ? 'selected' :''}}>
                                                                    1:10 hrs
                                                                </option>
                                                                <option
                                                                    value="75" {{$serv->duration == 75 ? 'selected' :''}}>
                                                                    1:15 hrs
                                                                </option>
                                                                <option
                                                                    value="80" {{$serv->duration == 80 ? 'selected' :''}}>
                                                                    1:20 hrs
                                                                </option>
                                                                <option
                                                                    value="85" {{$serv->duration == 85 ? 'selected' :''}}>
                                                                    1:25 hrs
                                                                </option>
                                                                <option
                                                                    value="90" {{$serv->duration == 90 ? 'selected' :''}}>
                                                                    1:30 hrs
                                                                </option>
                                                                <option
                                                                    value="95" {{$serv->duration == 95 ? 'selected' :''}}>
                                                                    1:35 hrs
                                                                </option>
                                                                <option
                                                                    value="100" {{$serv->duration == 100 ? 'selected' :''}}>
                                                                    1:40 hrs
                                                                </option>
                                                                <option
                                                                    value="105" {{$serv->duration == 105 ? 'selected' :''}}>
                                                                    1:45 hrs
                                                                </option>
                                                                <option
                                                                    value="110" {{$serv->duration == 110 ? 'selected' :''}}>
                                                                    1:50 hrs
                                                                </option>
                                                                <option
                                                                    value="115" {{$serv->duration == 115 ? 'selected' :''}}>
                                                                    1:55 hrs
                                                                </option>
                                                                <option
                                                                    value="120" {{$serv->duration == 120 ? 'selected' :''}}>
                                                                    2:00 hrs
                                                                </option>
                                                                <option
                                                                    value="125" {{$serv->duration == 125 ? 'selected' :''}}>
                                                                    2:05 hrs
                                                                </option>
                                                                <option
                                                                    value="130" {{$serv->duration == 130 ? 'selected' :''}}>
                                                                    2:10 hrs
                                                                </option>
                                                                <option
                                                                    value="135" {{$serv->duration == 135 ? 'selected' :''}}>
                                                                    2:15 hrs
                                                                </option>
                                                                <option
                                                                    value="140" {{$serv->duration == 140 ? 'selected' :''}}>
                                                                    2:20 hrs
                                                                </option>
                                                                <option
                                                                    value="145" {{$serv->duration == 145 ? 'selected' :''}}>
                                                                    2:25 hrs
                                                                </option>
                                                                <option
                                                                    value="150" {{$serv->duration == 150 ? 'selected' :''}}>
                                                                    2:30 hrs
                                                                </option>
                                                                <option
                                                                    value="155" {{$serv->duration == 155 ? 'selected' :''}}>
                                                                    2:35 hrs
                                                                </option>
                                                                <option
                                                                    value="160" {{$serv->duration == 160 ? 'selected' :''}}>
                                                                    2:40 hrs
                                                                </option>
                                                                <option
                                                                    value="165" {{$serv->duration == 165 ? 'selected' :''}}>
                                                                    2:45 hrs
                                                                </option>
                                                                <option
                                                                    value="170" {{$serv->duration == 170 ? 'selected' :''}}>
                                                                    2:50 hrs
                                                                </option>
                                                                <option
                                                                    value="175" {{$serv->duration == 175 ? 'selected' :''}}>
                                                                    2:55 hrs
                                                                </option>
                                                                <option
                                                                    value="180" {{$serv->duration == 180 ? 'selected' :''}}>
                                                                    3:00 hrs
                                                                </option>
                                                                <option
                                                                    value="185" {{$serv->duration == 185 ? 'selected' :''}}>
                                                                    3:05 hrs
                                                                </option>
                                                                <option
                                                                    value="190" {{$serv->duration == 190 ? 'selected' :''}}>
                                                                    3:10 hrs
                                                                </option>
                                                                <option
                                                                    value="195" {{$serv->duration == 195 ? 'selected' :''}}>
                                                                    3:15 hrs
                                                                </option>
                                                                <option
                                                                    value="200" {{$serv->duration == 200 ? 'selected' :''}}>
                                                                    3:20 hrs
                                                                </option>
                                                                <option
                                                                    value="205" {{$serv->duration == 205 ? 'selected' :''}}>
                                                                    3:25 hrs
                                                                </option>
                                                                <option
                                                                    value="210" {{$serv->duration == 210 ? 'selected' :''}}>
                                                                    3:30 hrs
                                                                </option>
                                                                <option
                                                                    value="215" {{$serv->duration == 215 ? 'selected' :''}}>
                                                                    3:35 hrs
                                                                </option>
                                                                <option
                                                                    value="220" {{$serv->duration == 220 ? 'selected' :''}}>
                                                                    3:40 hrs
                                                                </option>
                                                                <option
                                                                    value="225" {{$serv->duration == 225 ? 'selected' :''}}>
                                                                    3:45 hrs
                                                                </option>
                                                                <option
                                                                    value="230" {{$serv->duration == 230 ? 'selected' :''}}>
                                                                    3:50 hrs
                                                                </option>
                                                                <option
                                                                    value="235" {{$serv->duration == 235 ? 'selected' :''}}>
                                                                    3:55 hrs
                                                                </option>
                                                                <option
                                                                    value="240" {{$serv->duration == 240 ? 'selected' :''}}>
                                                                    4:00 hrs
                                                                </option>
                                                                <option
                                                                    value="245" {{$serv->duration == 245 ? 'selected' :''}}>
                                                                    4:05 hrs
                                                                </option>
                                                                <option
                                                                    value="250" {{$serv->duration == 250 ? 'selected' :''}}>
                                                                    4:10 hrs
                                                                </option>
                                                                <option
                                                                    value="255" {{$serv->duration == 255 ? 'selected' :''}}>
                                                                    4:15 hrs
                                                                </option>
                                                                <option
                                                                    value="260" {{$serv->duration == 260 ? 'selected' :''}}>
                                                                    4:20 hrs
                                                                </option>
                                                                <option
                                                                    value="265" {{$serv->duration == 265 ? 'selected' :''}}>
                                                                    4:25 hrs
                                                                </option>
                                                                <option
                                                                    value="270" {{$serv->duration == 270 ? 'selected' :''}}>
                                                                    4:30 hrs
                                                                </option>
                                                                <option
                                                                    value="275" {{$serv->duration == 275 ? 'selected' :''}}>
                                                                    4:35 hrs
                                                                </option>
                                                                <option
                                                                    value="280" {{$serv->duration == 280 ? 'selected' :''}}>
                                                                    4:40 hrs
                                                                </option>
                                                                <option
                                                                    value="285" {{$serv->duration == 285 ? 'selected' :''}}>
                                                                    4:45 hrs
                                                                </option>
                                                                <option
                                                                    value="290" {{$serv->duration == 290 ? 'selected' :''}}>
                                                                    4:50 hrs
                                                                </option>
                                                                <option
                                                                    value="295" {{$serv->duration == 295 ? 'selected' :''}}>
                                                                    4:55 hrs
                                                                </option>
                                                                <option
                                                                    value="300" {{$serv->duration == 300 ? 'selected' :''}}>
                                                                    5:00 hrs
                                                                </option>
                                                                <option
                                                                    value="305" {{$serv->duration == 305 ? 'selected' :''}}>
                                                                    5:05 hrs
                                                                </option>
                                                                <option
                                                                    value="310" {{$serv->duration == 310 ? 'selected' :''}}>
                                                                    5:10 hrs
                                                                </option>
                                                                <option
                                                                    value="315" {{$serv->duration == 315 ? 'selected' :''}}>
                                                                    5:15 hrs
                                                                </option>
                                                                <option
                                                                    value="320" {{$serv->duration == 320 ? 'selected' :''}}>
                                                                    5:20 hrs
                                                                </option>
                                                                <option
                                                                    value="325" {{$serv->duration == 325 ? 'selected' :''}}>
                                                                    5:25 hrs
                                                                </option>
                                                                <option
                                                                    value="330" {{$serv->duration == 330 ? 'selected' :''}}>
                                                                    5:30 hrs
                                                                </option>
                                                                <option
                                                                    value="335" {{$serv->duration == 335 ? 'selected' :''}}>
                                                                    5:35 hrs
                                                                </option>
                                                                <option
                                                                    value="340" {{$serv->duration == 340 ? 'selected' :''}}>
                                                                    5:40 hrs
                                                                </option>
                                                                <option
                                                                    value="345" {{$serv->duration == 345 ? 'selected' :''}}>
                                                                    5:45 hrs
                                                                </option>
                                                                <option
                                                                    value="350" {{$serv->duration == 350 ? 'selected' :''}}>
                                                                    5:50 hrs
                                                                </option>
                                                                <option
                                                                    value="355" {{$serv->duration == 355 ? 'selected' :''}}>
                                                                    5:55 hrs
                                                                </option>
                                                                <option
                                                                    value="360" {{$serv->duration == 360 ? 'selected' :''}}>
                                                                    6:00 hrs
                                                                </option>
                                                                <option
                                                                    value="365" {{$serv->duration == 365 ? 'selected' :''}}>
                                                                    6:05 hrs
                                                                </option>
                                                                <option
                                                                    value="370" {{$serv->duration == 370 ? 'selected' :''}}>
                                                                    6:10 hrs
                                                                </option>
                                                                <option
                                                                    value="375" {{$serv->duration == 375 ? 'selected' :''}}>
                                                                    6:15 hrs
                                                                </option>
                                                                <option
                                                                    value="380" {{$serv->duration == 380 ? 'selected' :''}}>
                                                                    6:20 hrs
                                                                </option>
                                                                <option
                                                                    value="385" {{$serv->duration == 385 ? 'selected' :''}}>
                                                                    6:25 hrs
                                                                </option>
                                                                <option
                                                                    value="390" {{$serv->duration == 390 ? 'selected' :''}}>
                                                                    6:30 hrs
                                                                </option>
                                                                <option
                                                                    value="395" {{$serv->duration == 395 ? 'selected' :''}}>
                                                                    6:35 hrs
                                                                </option>
                                                                <option
                                                                    value="400" {{$serv->duration == 400 ? 'selected' :''}}>
                                                                    6:40 hrs
                                                                </option>
                                                                <option
                                                                    value="405" {{$serv->duration == 405 ? 'selected' :''}}>
                                                                    6:45 hrs
                                                                </option>
                                                                <option
                                                                    value="410" {{$serv->duration == 410 ? 'selected' :''}}>
                                                                    6:50 hrs
                                                                </option>
                                                                <option
                                                                    value="415" {{$serv->duration == 415 ? 'selected' :''}}>
                                                                    6:55 hrs
                                                                </option>
                                                                <option
                                                                    value="420" {{$serv->duration == 420 ? 'selected' :''}}>
                                                                    7:00 hrs
                                                                </option>
                                                                <option
                                                                    value="425" {{$serv->duration == 425 ? 'selected' :''}}>
                                                                    7:05 hrs
                                                                </option>
                                                                <option
                                                                    value="430" {{$serv->duration == 430 ? 'selected' :''}}>
                                                                    7:10 hrs
                                                                </option>
                                                                <option
                                                                    value="435" {{$serv->duration == 435 ? 'selected' :''}}>
                                                                    7:15 hrs
                                                                </option>
                                                                <option
                                                                    value="440" {{$serv->duration == 440 ? 'selected' :''}}>
                                                                    7:20 hrs
                                                                </option>
                                                                <option
                                                                    value="445" {{$serv->duration == 445 ? 'selected' :''}}>
                                                                    7:25 hrs
                                                                </option>
                                                                <option
                                                                    value="450" {{$serv->duration == 450 ? 'selected' :''}}>
                                                                    7:30 hrs
                                                                </option>
                                                                <option
                                                                    value="455" {{$serv->duration == 455 ? 'selected' :''}}>
                                                                    7:35 hrs
                                                                </option>
                                                                <option
                                                                    value="460" {{$serv->duration == 460 ? 'selected' :''}}>
                                                                    7:40 hrs
                                                                </option>
                                                                <option
                                                                    value="465" {{$serv->duration == 465 ? 'selected' :''}}>
                                                                    7:45 hrs
                                                                </option>
                                                                <option
                                                                    value="470" {{$serv->duration == 470 ? 'selected' :''}}>
                                                                    7:50 hrs
                                                                </option>
                                                                <option
                                                                    value="475" {{$serv->duration == 475 ? 'selected' :''}}>
                                                                    7:55 hrs
                                                                </option>
                                                                <option
                                                                    value="480" {{$serv->duration == 480 ? 'selected' :''}}>
                                                                    8 hrs
                                                                </option>
                                                                <option
                                                                    value="540" {{$serv->duration == 540 ? 'selected' :''}}>
                                                                    9 hrs
                                                                </option>
                                                                <option
                                                                    value="600" {{$serv->duration == 600 ? 'selected' :''}}>
                                                                    10 hrs
                                                                </option>
                                                                <option
                                                                    value="660" {{$serv->duration == 660 ? 'selected' :''}}>
                                                                    11 hrs
                                                                </option>
                                                                <option
                                                                    value="720" {{$serv->duration == 720 ? 'selected' :''}}>
                                                                    12 hrs
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Mileage</label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                   name="mileage" value="{{$serv->mileage}}">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            </tbody>
                        </table>
                        {{$set_services->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
