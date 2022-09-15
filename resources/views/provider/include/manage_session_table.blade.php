@foreach ($sessions as $session)
    <?php
    $bilable = $session->billable;
    $payroll_check = \App\Models\timesheet::select('id')
        ->where('admin_id', \Auth::user()->admin_id)
        ->where('appointment_id', $session->id)
        ->where('submitted', 1)
        ->where('status', 'completed')
        ->first();
    ?>
    <tr>
        <td>
            @if ($session->is_locked == 0)
                <input type="checkbox" class="data_checkbox_appoinment" name="data_checkbox_appoinment[]"
                    value="{{ $session->id }}">
                <label></label>
            @elseif($payroll_check)
                <input type="checkbox" class="data_checkbox_appoinment" name="data_checkbox_appoinment[]" disabled
                    value="{{ $session->id }}">
            @else
                <input type="checkbox" class="data_checkbox_appoinment" name="data_checkbox_appoinment[]" disabled
                    value="{{ $session->id }}">
                <label></label>
            @endif
        </td>
        <td>
            @if ($session->is_locked == 1)
                <a href="#"><i class="ri-lock-line mx-2 text-danger" title="Billing"></i></a>
            @elseif($payroll_check)
                <a href="#"><i class="ri-lock-line mx-2 text-danger" title="Timesheet"></i></a>
            @else
                <a href="#"><i class="ri-lock-unlock-fill mx-2 text-primary" title="Un-Lock"></i></a>
            @endif

        </td>
        @if ($session->billable == 1)
            <td class="p_th_remove">
                <?php
                $client = \App\Models\Client::select('id', 'client_full_name')
                    ->where('id', $session->client_id)
                    ->first();
                $check_sing_client = \App\Models\Appoinment_signature::where('session_id', $session->id)
                    ->where('user_type', 1)
                    ->first();
                ?>
                @if ($client)
                    <a href="{{ route('provider.client.info', $client->id) }}"
                        target="_blank">{{ $client->client_full_name }}</a>
                    @if ($check_sing_client)
                        <a href="#signatureModalPatient" class="patintsignmodal" data-id="{{ $session->id }}"
                            data-toggle="modal" title="Signature"><i class="ri-pen-nib-line text-success ml-2"></i></a>
                    @else
                        <a href="#signatureModalPatient" class="patintsignmodal" data-id="{{ $session->id }}"
                            data-toggle="modal" title="Signature"><i class="ri-pen-nib-line text-muted ml-2"></i></a>
                    @endif
                @endif

            </td>
            <td class="s_th_remove">
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

            $check_prov_sing = \App\Models\Appoinment_signature::where('session_id', $session->id)
                ->where('user_type', 2)
                ->first();
            ?>
            @if ($provider)
                {{ $provider->first_name }} {{ $provider->middle_name }} {{ $provider->last_name }}

                @if ($check_prov_sing)
                    <a href="#signatureModalProvider" class="providersignmodal" data-id="{{ $session->id }}"
                        data-toggle="modal" title="Signature"><i class="ri-pen-nib-line text-success ml-2"></i></a>
                @else
                    <a href="#signatureModalProvider" class="providersignmodal" data-id="{{ $session->id }}"
                        data-toggle="modal" title="Signature"><i class="ri-pen-nib-line text-muted ml-2"></i></a>
                @endif
            @endif
        </td>
        <td>
            <?php
            $place_of_ser = \App\Models\point_of_service::where('admin_id', Auth::user()->admin_id)
                ->where('pos_code', $session->location)
                ->first();
            ?>

            @if ($place_of_ser)
                @if ($place_of_ser->pos_code == '02' || $place_of_ser->pos_code == '10')
                    {{ $place_of_ser->pos_name }} <span class="pl-1"><i
                            class="fa fa-video-camera text-success"></i></span>
                @else
                    {{ $place_of_ser->pos_name }}
                @endif
            @endif
        </td>
        <td>{{ \Carbon\Carbon::parse($session->schedule_date)->format('m/d/Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($session->from_time)->format('g:i a') }}
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

            <span class="badge {{ $color }} font-weight-normal">{{ $session->status }}</span>
        </td>
        <td>

            <div class="dropdown">
                <button class="btn dropdown-toggle p-0 text-primary" type="button" data-toggle="dropdown"
                    data-boundary="viewport">
                    <i class="ri-more-fill"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-right session-dd">
                    <a href="javascript:void(0);" class="dropdown-item addNoteForms" data-id="{{ $session->id }}"><i
                            class="ri-add-line mr-2"></i>Add Notes</a>
                    <a href="javascript:void(0);" data-id="{{ $session->id }}"
                        class="createdNoteform dropdown-item"><i class="ri-eye-line mr-2"></i>View Notes</a>
                    <a href="javascript:void(0);" title="Address" class="dropdown-item view_add_btn"><i
                            class="ri-map-pin-line mr-2"></i>Address</a>
                    @if ($session->is_locked == 0 || !$payroll_check)
                        <a href="javascript:void(0);" data-id="{{ $session->id }}"
                            class="appoinemt_details dropdown-item" title="Comments"><i
                                class="ri-pencil-line mr-2"></i>Edit Session</a>
                    @endif
                    <a href="javascript:void(0);" title="View Signature" class="dropdown-item view_sig_btn"><i
                            class="ri-pen-nib-line mr-2"></i>View
                        Signature</a>
                </div>
            </div>
        </td>




        <input type="hidden" value="{{ $session->id }}" class="h_session_id">
        <?php
        $sing_file = \App\Models\Appoinment_signature::where('session_id', $session->id)
            ->where('user_type', 1)
            ->first();
        $sing_file_pro = \App\Models\Appoinment_signature::where('session_id', $session->id)
            ->where('user_type', 2)
            ->first();

        ?>
        @if ($sing_file)
            @if (!empty($sing_file->signature) && file_exists($sing_file->signature))
                <input type="hidden" value="{{ asset($sing_file->signature) }}" class="h_client_image">
                <input type="hidden"
                    value="{{ \Carbon\Carbon::parse($sing_file->sign_time, 'EST')->format('m/d/Y g:i a') }}"
                    class="h_client_date">
            @else
                <input type="hidden" value="empty" class="h_client_image">
                <input type="hidden" value="empty" class="h_client_date">
            @endif
        @else
            <input type="hidden" value="empty" class="h_client_image">
            <input type="hidden" value="empty" class="h_client_date">
        @endif


        @if ($sing_file_pro)
            @if (!empty($sing_file_pro->signature) && file_exists($sing_file_pro->signature))
                <input type="hidden" value="{{ asset($sing_file_pro->signature) }}" class="h_provider_image">
                <input type="hidden"
                    value="{{ \Carbon\Carbon::parse($sing_file_pro->sign_time_pro, 'EST')->format('m/d/Y g:i a') }}"
                    class="h_provider_date">
            @else
                <input type="hidden" value="empty" class="h_provider_image">
                <input type="hidden" value="empty" class="h_provider_date">
            @endif
        @else
            <input type="hidden" value="empty" class="h_provider_image">
            <input type="hidden" value="empty" class="h_provider_date">
        @endif

        <?php
        $addresss = 'empty';
        ?>

        @if ($session->location == 11 && $session->billable == 1)
            <?php
            $client = \App\Models\Client::where('id', $session->client_id)->first();
            $zone = \App\Models\setting_name_location_box_two::where('id', $client->zone)->first();
            ?>
            @if ($zone)
                <?php
                $addresss = $zone->address . ' ' . $zone->city . ' ' . $zone->state . ' ' . $zone->zip;
                ?>
            @endif
        @elseif ($session->location == 12 && $session->billable == 1)
            <?php
            $client = \App\Models\Client::where('id', $session->client_id)->first();
            $addresss = $client->client_street . ' ' . $client->client_city . ' ' . $client->client_state . ' ' . $client->client_zip;
            ?>
        @elseif ($session->location == 03)
            <?php
            $addresss = 'School';
            ?>
        @elseif ($session->location == 99)
            <?php
            $addresss = 'Others';
            ?>
        @elseif ($session->location == 02)
            <?php
            $addresss = 'Telehealth';
            ?>
        @else
            <?php
            $addresss = 'Not Set';
            ?>
        @endif

        <input type="hidden" value="{{ $addresss }}" class="h_address">
        <input type="hidden" value="{{ $session->location }}" class="h_location">
        <input type="hidden" value="{{ $session->billable }}" class="h_billable">

    </tr>

    {{-- <script>
            bilable="{{$bilable}}";
            if(bilable==1){
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
                            // e.preventDefault();
                        }
                    }, false);
                    document.body.addEventListener("touchend", function (e) {
                        if (e.target == canvas) {
                            // e.preventDefault();
                        }
                    }, false);
                    document.body.addEventListener("touchmove", function (e) {
                        if (e.target == canvas) {
                            // e.preventDefault();
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
            }
        </script>
        <script>

                    var canvas2 = document.getElementById("sig-canvas2");
                    var ctx = canvas2.getContext("2d");
                    ctx.strokeStyle = "#222222";
                    ctx.lineWidth = 4;
                    var drawing = false;
                    var mousePos = {
                        x: 0,
                        y: 0
                    };
                    var lastPos = mousePos;
                    canvas2.addEventListener("mousedown", function (e) {
                        drawing = true;
                        lastPos = getMousePos(canvas2, e);
                    }, false);
                    canvas2.addEventListener("mouseup", function (e) {
                        drawing = false;
                    }, false);
                    canvas2.addEventListener("mousemove", function (e) {
                        mousePos = getMousePos(canvas2, e);
                    }, false);
                    // Add touch event support for mobile
                    canvas2.addEventListener("touchstart", function (e) {
                    }, false);
                    canvas2.addEventListener("touchmove", function (e) {
                        var touch = e.touches[0];
                        var me = new MouseEvent("mousemove", {
                            clientX: touch.clientX,
                            clientY: touch.clientY
                        });
                        canvas2.dispatchEvent(me);
                    }, false);
                    canvas2.addEventListener("touchstart", function (e) {
                        mousePos = getTouchPos(canvas2, e);
                        var touch = e.touches[0];
                        var me = new MouseEvent("mousedown", {
                            clientX: touch.clientX,
                            clientY: touch.clientY
                        });
                        canvas2.dispatchEvent(me);
                    }, false);
                    canvas2.addEventListener("touchend", function (e) {
                        var me = new MouseEvent("mouseup", {});
                        canvas2.dispatchEvent(me);
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
                        if (e.target == canvas2) {
                            // e.preventDefault();
                        }
                    }, false);
                    document.body.addEventListener("touchend", function (e) {
                        if (e.target == canvas2) {
                            // e.preventDefault();
                        }
                    }, false);
                    document.body.addEventListener("touchmove", function (e) {
                        if (e.target == canvas2) {
                            // e.preventDefault();
                        }
                    }, false);
                    (function drawLoop() {
                        requestAnimFrame(drawLoop);
                        renderCanvas();
                    })();

                    function clearCanvas() {
                        canvas2.width = canvas2.width;
                    }

                    // Set up the UI
                    var sigText = document.getElementById("sig-dataUrl");
                    var sigImage = document.getElementById("sig-image");
                    var clearBtn = document.getElementById("sig-clearBtn2");
                    var submitBtn = document.getElementById("sig-submitBtn");
                    clearBtn.addEventListener("click", function (e) {
                        clearCanvas();
                        // sigText.innerHTML = "Data URL for your signature will go here!";
                        // sigImage.setAttribute("src", "");
                    }, false);
        </script> --}}
@endforeach

{{-- {{ $sessions->links() }} --}}
