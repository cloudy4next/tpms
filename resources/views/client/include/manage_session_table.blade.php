<table class="table table-sm table-bordered c_table">
    <thead>
    <tr>
        <th><input type="checkbox" class="session_check_all"></th>
        <th><i class="ri-lock-line text-white" title="Lock"></i></th>
        <th>Notes</th>
        <th>Patient</th>
        <th>Service & Hrs.</th>
        <th>Provider</th>
        <th>Scheduled Date</th>
        <th>Hours</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    @foreach($sessions as $session)
        <tr>
            <td>
                @if ($session->is_locked == 0)
                    <input type="checkbox" class="data_checkbox_appoinment" name="data_checkbox_appoinment[]"
                           value="{{$session->id}}">
                    <label></label>
                @else
                    <input type="checkbox" class="data_checkbox_appoinment" name="data_checkbox_appoinment[]" disabled
                           value="{{$session->id}}">
                    <label></label>
                @endif
            </td>
            <td>
                @if ($session->is_locked == 1)

                    <a href="#"><i class="ri-lock-line mx-2 text-danger" title="Lock"></i></a>
                @else
                    <a href="#"><i class="ri-lock-unlock-fill mx-2 text-primary" title="Un-Lock"></i></a>
                @endif

            </td>
            <td>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="#"
                           target="_blank"><i class="ri-pages-line text-primary"
                                              title="View Notes"></i></a>
                    </li>
                </ul>


                <div class="modal fade" id="formNote" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                        <form action="{{route('provider.session.note.form.open')}}" method="post" target="_blank">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Add Notes</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <label>Select Form</label>

                                    <select class="form-control form-control-sm formTypeProvider"
                                            name="note_id_provider"
                                            style="max-width: 300px;">
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="noteSubmit">Go</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </td>
            <td>
                <?php
                $client = \App\Models\Client::select('id', 'client_full_name')->where('id', $session->client_id)->first();
                $check_sing_client = \App\Models\Appoinment_signature::where('session_id', $session->id)->where('user_type', 1)->first();
                ?>
                @if ($client)
                    <a href="{{route('provider.client.info',$client->id)}}"
                       target="_blank">{{$client->client_full_name}}</a>
                    @if ($check_sing_client)
                        <a href="#signatureModalPatient" class="patintsignmodal" data-id="{{$session->id}}"
                           data-toggle="modal" title="Signature"><i
                                class="ri-pen-nib-line text-success ml-2"></i></a>
                    @else
                        <a href="#signatureModalPatient" class="patintsignmodal" data-id="{{$session->id}}"
                           data-toggle="modal" title="Signature"><i
                                class="ri-pen-nib-line text-muted ml-2"></i></a>
                    @endif



                    <div class="modal fade" id="signatureModalPatient" data-backdrop="static">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                            <form method="post" id="client_sing_form" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4>Add signature</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            {{--                                        <li class="nav-item">--}}
                                            {{--                                            <a class="nav-link active" data-toggle="tab" href="#selectsig">Draw</a>--}}
                                            {{--                                        </li>--}}
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#drawsig">Draw</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#uploadsig">Upload</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="selectsig">
                                                <div class="row mb-2">
                                                    <div class="col-md-12">
                                                        <label>Full Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm"
                                                               id="sig-name">
                                                    </div>

                                                </div>
                                                <label>Preview</label>
                                                <div class="signature-preview">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show active" id="drawsig">
                                                <div class="row mb-2">
                                                    <div class="col-md-12">
                                                        <canvas id="sig-canvas" height="120"
                                                                style="width: 100%;"></canvas>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-danger p-2" id="sig-clearBtn">Clear
                                                </button>
                                                <input type="hidden" class="form-control-file sing_draw_txt"
                                                       name="sing_draw_txt">
                                                <input type="hidden" class="form-control-file sing_seccid"
                                                       name="sessionid">
                                                <input type="hidden" class="client_sing_id" name="sess_client_id">
                                            </div>
                                            <div class="tab-pane fade" id="uploadsig">
                                                <label>Upload File</label>
                                                <input type="file" class="form-control-file" name="sing_file">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-outline-primary" id="sig-submitBtn">Save
                                            Signature
                                        </button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                @endif

            </td>
            <td>
                <?php

                $auth = \App\Models\Client_authorization_activity::select('id', 'activity_name')->where('id', $session->authorization_activity_id)->first();
                $hours = $session->time_duration / 60;
                ?>
                @if ($auth)
                    {{$auth->activity_name}}
                    @if ($hours >= 1)
                        ({{$hours}} Hr)
                    @else
                    ({{$hours}} Hrs)
                    @endif

                @endif
            </td>
            <td>
                <?php
                $provider = \App\Models\Employee::select('id', 'first_name', 'middle_name', 'last_name')->where('id', $session->provider_id)->first();

                $check_prov_sing = \App\Models\Appoinment_signature::where('session_id', $session->id)->where('user_type', 2)->first();
                ?>
                @if ($provider)
                    {{$provider->first_name}} {{$provider->middle_name}} {{$provider->last_name}}
                @endif
            </td>
            <td>{{\Carbon\Carbon::parse($session->schedule_date)->format('m/d/Y')}}</td>
            <td>{{\Carbon\Carbon::parse($session->from_time)->format('g:i a')}}
                to {{\Carbon\Carbon::parse($session->to_time)->format('g:i a')}}</td>
            <td>{{$session->status}}</td>
            <td>
                <a href="#addressModal{{$session->id}}" title="Address" data-toggle="modal"><i
                        class="ri-map-pin-line mr-2"></i></a>
                <a href="#createAppointement{{$session->id}}" class="appoinemt_details" data-toggle="modal"
                   data-id="{{$session->id}}"
                   title="Comments"><i
                        class="ri-edit-box-line"></i></a>
                <a href="#viewSignature{{$session->id}}" data-toggle="modal" title="View"><i
                        class="ri-eye-line ml-2"></i></a>

                <!-- address modal -->
                <div class="modal fade" id="addressModal{{$session->id}}" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Treatment Location</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                @if ($session->location == 11)
                                    <?php
                                    $client = \App\Models\Client::where('id', $session->client_id)->first();
                                    $zone = \App\Models\setting_name_location_box_two::where('id', $client->zone)->first();

                                    ?>

                                    @if ($zone)
                                        {{$zone->address}} {{$zone->city}} {{$zone->state}} {{$zone->zip}}
                                    @endif

                                @elseif ($session->location == 12)
                                    <?php
                                    $client = \App\Models\Client::where('id', $session->client_id)->first();

                                    ?>
                                    {{$client->client_street}} {{$client->client_city}} {{$client->client_state}} {{$client->client_zip}}
                                @elseif ($session->location == 03)
                                    School
                                @elseif ($session->location == 99)
                                    Others
                                @elseif ($session->location == 02)
                                    Telehealth
                                @else
                                    Not Set
                                @endif
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-primary">Go to Google Maps</a>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ address modal -->
                <!-- signature modal -->


                <div class="modal fade apmodelclose" id="createAppointement{{$session->id}}" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Edit Appoinments</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <form id="appoinemtnsubmitform" method="post" class="needs-validation" novalidate>

                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <label>Patient Name</label>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <select
                                                class="form-control form-control-sm client_name appooinment_craete_client_id session_app_client_name"
                                                id="client_name" name="client_id" disabled>
                                                <option
                                                    value="{{Auth::user()->id}}">{{Auth::user()->client_full_name}}</option>
                                            </select>
                                            <input type="hidden" class="form-check-input edit_sess_id"
                                                   name="edit_sess_id" value="{{$session->id}}">
                                            <div class="invalid-feedback error_client">Enter Patient Name</div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label>Auth</label>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <?php
                                            $auths = \App\Models\Client_authorization::where('client_id', $session->client_id)->get();
                                            ?>
                                            <select
                                                class="form-control form-control-sm appooinment_craete_authorization_id session_app_client_auth"
                                                name="authorization_id" id="authorization_id" disabled required>
                                                @foreach($auths as $auth)
                                                    <option
                                                        value="{{$auth->id}}" {{$session->authorization_id == $auth->id ? 'selected' :''}}>
                                                        {{$auth->description}}
                                                        ({{\Carbon\Carbon::parse($auth->onset_date)->format('m.d.Y')}}
                                                        to {{\Carbon\Carbon::parse($auth->onset_date)->format('m.d.Y')}}
                                                        ) | {{$auth->authorization_number}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback error_auth">Enter Auth</div>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <label>Service</label>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <?php
                                            $activities = \App\Models\Client_authorization_activity::where('client_id', $session->client_id)->get();
                                            ?>
                                            <select
                                                class="form-control form-control-sm appooinment_craete_activity_id session_app_client_act"
                                                name="activity_id" id="activity_id" disabled required>
                                                @foreach($activities as $act)
                                                    <option
                                                        value="{{$act->id}}" {{$session->authorization_activity_id == $act->id ? 'selected' :''}}>{{$act->activity_name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback error_activity">Enter Service</div>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <label>Provider Name</label>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <?php
                                            $employees = \App\Models\Employee::orderby('first_name', 'asc')->get();
                                            ?>
                                            <select
                                                class="form-control form-control-sm appooinment_craete_provider_id session_app_provider"
                                                name="provider_id" id="provider_id" disabled required>
                                            </select>
                                            <div class="invalid-feedback error_provider">Enter Provider Name</div>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <label>POS</label>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <?php
                                            $poin_service = \App\Models\point_of_service::where('admin_id', Auth::user()->id)->get();
                                            ?>
                                            <select
                                                class="form-control form-control-sm appooinment_craete_location_name session_app_location"
                                                id="location" name="location" disabled required>
                                                <option value=""></option>
                                                @foreach($poin_service as $pos_ser)
                                                    <option
                                                        value="{{$pos_ser->pos_code}}" {{$session->location == $pos_ser->pos_code ? 'selected' : ''}}>{{$pos_ser->pos_name}}
                                                        ({{$pos_ser->pos_code}})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback error_location">Enter Location</div>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <label>Time Duration</label>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <select
                                                class="form-control form-control-sm appooinment_craete_time_duration session_app_time_dur"
                                                name="time_duration" id="time_duration" disabled required>
                                                <option></option>
                                                <option value="15">
                                                    15 mins
                                                </option>
                                                <option value="30">
                                                    30 mins
                                                </option>
                                                <option value="45">
                                                    45 mins
                                                </option>
                                                <option value="60">1
                                                    Hour
                                                </option>
                                                <option value="75">1
                                                    Hour 15 mins
                                                </option>
                                                <option value="90" }>1
                                                    Hour 30 mins
                                                </option>
                                                <option
                                                    value="105">1
                                                    Hour 45 mins
                                                </option>
                                                <option
                                                    value="120">2
                                                    Hour
                                                </option>
                                                <option
                                                    value="135">2
                                                    Hour 15 mins
                                                </option>
                                                <option
                                                    value="150">2
                                                    Hour 30 mins
                                                </option>
                                                <option
                                                    value="165">2
                                                    Hour 45 mins
                                                </option>
                                                <option
                                                    value="180">3
                                                    Hour
                                                </option>
                                                <option
                                                    value="195">3
                                                    Hour 15 mins
                                                </option>
                                                <option
                                                    value="210">3
                                                    Hour 30 mins
                                                </option>
                                                <option
                                                    value="225">3
                                                    Hour 45 mins
                                                </option>
                                                <option
                                                    value="240">4
                                                    Hour
                                                </option>
                                                <option
                                                    value="255">4
                                                    Hour 15 mins
                                                </option>
                                                <option
                                                    value="270">4
                                                    Hour 30 mins
                                                </option>
                                                <option
                                                    value="285">4
                                                    Hour 45 mins
                                                </option>
                                                <option
                                                    value="300">5
                                                    Hour
                                                </option>
                                                <option
                                                    value="315">5
                                                    Hour 15 mins
                                                </option>
                                                <option
                                                    value="330">5
                                                    Hour 30 mins
                                                </option>
                                                <option
                                                    value="345">5
                                                    Hour 45 mins
                                                </option>
                                                <option value="360">
                                                    6 Hour
                                                </option>
                                                <option
                                                    value="375">6
                                                    Hour 15 mins
                                                </option>
                                                <option
                                                    value="390">6
                                                    Hour 30 mins
                                                </option>
                                                <option
                                                    value="405">6
                                                    Hour 45 mins
                                                </option>
                                                <option
                                                    value="420">7
                                                    Hour
                                                </option>
                                                <option
                                                    value="435" }>7
                                                    Hour 15 mins
                                                </option>
                                                <option
                                                    value="450">7
                                                    Hour 30 mins
                                                </option>
                                                <option
                                                    value="465">7
                                                    Hour 45 mins
                                                </option>
                                                <option
                                                    value="480">8
                                                    Hour
                                                </option>
                                                <option
                                                    value="495">8
                                                    Hour 15 mins
                                                </option>
                                                <option
                                                    value="510">8
                                                    Hour 30 mins
                                                </option>
                                                <option
                                                    value="525">8
                                                    Hour 45 mins
                                                </option>
                                                <option
                                                    value="540">9
                                                    Hour
                                                </option>
                                                <option
                                                    value="555">9
                                                    Hour 15 mins
                                                </option>
                                                <option
                                                    value="570">9
                                                    Hour 30 mins
                                                </option>
                                                <option
                                                    value="585">9
                                                    Hour 45 mins
                                                </option>
                                                <option
                                                    value="600">10
                                                    Hour
                                                </option>
                                            </select>
                                            <div class="invalid-feedback error_time_duration">Enter Time Duration</div>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <label>Date & Time</label>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <?php
                                                $date_time_from = \Carbon\Carbon::parse($session->from_time)->format('Y-m-d\TH:i');
                                                ?>
                                                <input class="form-control form-control-sm appooinment_craete_from_time"
                                                       name="from_time" disabled value="{{$date_time_from}}"
                                                       type="datetime-local" required>
                                                <div class="invalid-feedback error_from_time">Enter Date & Time</div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <label>Status</label>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <select
                                                class="form-control form-control-sm appooinment_craete_status_name  session_app_time_status"
                                                name="status" id="status" required>
                                                <option value=""></option>
                                                <option
                                                    value="Scheduled">
                                                    Scheduled
                                                </option>
                                                <option
                                                    value="No Show">
                                                    No Show
                                                </option>
                                                <option value="Hold">
                                                    Hold
                                                </option>
                                                <option
                                                    value="Cancelled by Client">
                                                    Cancelled by Client
                                                </option>
                                                <option
                                                    value="CC more than 24 hrs">
                                                    CC more than 24 hrs
                                                </option>
                                                <option
                                                    value="CC less than 24 hrs">
                                                    CC less than 24 hrs
                                                </option>
                                                <option
                                                    value="Cancelled by Provider">
                                                    Cancelled by Provider
                                                </option>
                                                <option
                                                    value="Rendered">
                                                    Rendered
                                                </option>
                                            </select>
                                            <div class="invalid-feedback error_status">Enter Status</div>
                                        </div>


                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="modal fade" id="viewSignature{{$session->id}}" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Signature</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#patSig">Patient
                                            Signature</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#providerSig">Provider Signature</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="patSig">
                                        <div class="show-sig">
                                            <?php
                                            $sing_file = \App\Models\Appoinment_signature::where('session_id', $session->id)->where('user_type', 1)->first();
                                            $sing_file_pro = \App\Models\Appoinment_signature::where('session_id', $session->id)->where('user_type', 2)->first();

                                            ?>
                                            @if ($sing_file)
                                                @if (!empty($sing_file->signature) && file_exists($sing_file->signature))
                                                    <img src="{{asset($sing_file->signature)}}" alt="Signature"
                                                         class="img-fluid">
                                                    <p class="mt-2">{{\Carbon\Carbon::parse($sing_file->sign_time,'EST')->format('m/d/Y g:i a')}}</p>
                                                @endif
                                            @endif
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="providerSig">
                                        <div class="show-sig">
                                            @if ($sing_file_pro)
                                                @if (!empty($sing_file_pro->signature) && file_exists($sing_file_pro->signature))
                                                    <img src="{{asset($sing_file_pro->signature)}}" alt="Signature"
                                                         class="img-fluid">
                                                    <p class="mt-2">{{\Carbon\Carbon::parse($sing_file_pro->sign_time_pro,'EST')->format('m/d/Y g:i a')}}</p>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </td>
        </tr>





        <script>
            (function () {
                window.requestAnimFrame = (function (callback) {
                    return window.requestAnimationFrame ||
                        window.webkitRequestAnimationFrame ||
                        window.mozRequestAnimationFrame ||
                        window.oRequestAnimationFrame ||
                        window.msRequestAnimaitonFrame ||
                        function (callback) {
                            window.setTimeout(callback, 1000 / 60);
                        };
                })();
                var canvas = document.getElementById("sig-canvas");
                var ctx = canvas.getContext("2d");
                ctx.strokeStyle = "#222222";
                ctx.lineWidth = 4;
                var drawing = false;
                var mousePos = {
                    x: 0,
                    y: 0
                };
                var lastPos = mousePos;
                canvas.addEventListener("mousedown", function (e) {
                    drawing = true;
                    lastPos = getMousePos(canvas, e);
                }, false);
                canvas.addEventListener("mouseup", function (e) {
                    drawing = false;
                }, false);
                canvas.addEventListener("mousemove", function (e) {
                    mousePos = getMousePos(canvas, e);
                }, false);
                // Add touch event support for mobile
                canvas.addEventListener("touchstart", function (e) {
                }, false);
                canvas.addEventListener("touchmove", function (e) {
                    var touch = e.touches[0];
                    var me = new MouseEvent("mousemove", {
                        clientX: touch.clientX,
                        clientY: touch.clientY
                    });
                    canvas.dispatchEvent(me);
                }, false);
                canvas.addEventListener("touchstart", function (e) {
                    mousePos = getTouchPos(canvas, e);
                    var touch = e.touches[0];
                    var me = new MouseEvent("mousedown", {
                        clientX: touch.clientX,
                        clientY: touch.clientY
                    });
                    canvas.dispatchEvent(me);
                }, false);
                canvas.addEventListener("touchend", function (e) {
                    var me = new MouseEvent("mouseup", {});
                    canvas.dispatchEvent(me);
                }, false);

                function getMousePos(canvasDom, mouseEvent) {
                    var rect = canvasDom.getBoundingClientRect();
                    return {
                        x: mouseEvent.clientX - rect.left,
                        y: mouseEvent.clientY - rect.top
                    }
                }

                function getTouchPos(canvasDom, touchEvent) {
                    var rect = canvasDom.getBoundingClientRect();
                    return {
                        x: touchEvent.touches[0].clientX - rect.left,
                        y: touchEvent.touches[0].clientY - rect.top
                    }
                }

                function renderCanvas() {
                    if (drawing) {
                        ctx.moveTo(lastPos.x, lastPos.y);
                        ctx.lineTo(mousePos.x, mousePos.y);
                        ctx.stroke();
                        lastPos = mousePos;
                    }
                }

                // Prevent scrolling when touching the canvas
                document.body.addEventListener("touchstart", function (e) {
                    if (e.target == canvas) {
                        e.preventDefault();
                    }
                }, false);
                document.body.addEventListener("touchend", function (e) {
                    if (e.target == canvas) {
                        e.preventDefault();
                    }
                }, false);
                document.body.addEventListener("touchmove", function (e) {
                    if (e.target == canvas) {
                        e.preventDefault();
                    }
                }, false);
                (function drawLoop() {
                    requestAnimFrame(drawLoop);
                    renderCanvas();
                })();

                function clearCanvas() {
                    canvas.width = canvas.width;
                }

                // Set up the UI
                var sigText = document.getElementById("sig-dataUrl");
                var sigImage = document.getElementById("sig-image");
                var clearBtn = document.getElementById("sig-clearBtn");
                var submitBtn = document.getElementById("sig-submitBtn");
                clearBtn.addEventListener("click", function (e) {
                    clearCanvas();
                    // sigText.innerHTML = "Data URL for your signature will go here!";
                    // sigImage.setAttribute("src", "");
                }, false);


            })();
        </script>

        <script>
            // const sigName = document.querySelector('#sig-name');
            // const sigPreview = document.querySelector('.signature-preview');
            // sigName.addEventListener('input', function (e) {
            //     sigPreview.innerText = sigName.value;
            // });
        </script>




    @endforeach
    </tbody>
</table>
{{$sessions->links()}}



