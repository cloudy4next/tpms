<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/custom.css">
    <title>Session Notes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/template/tem13/') }}/css/custom-13.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
        .logo_img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="parent-training">
        <header>
            <div class="flex-div">
                <div class="col-item">
                    <div class="logo"><a href="#">
                            @if (file_exists($logo->logo) && !empty($logo->logo))
                                <img src="{{ asset($logo->logo) }}" alt="" class="logo_img">
                            @endif

                        </a></div>
                </div>
                <div class="col-item">
                    <div class="info-details">
                        <ul>
                            <li><span>Mail:</span>{{ $name_location->address }}. {{ $name_location->city }}
                                , {{ $name_location->state }} {{ $name_location->zip }}
                            </li>
                            <li><a href="mailto:{{ $name_location->email }}">
                                    <span>Email:</span>{{ $name_location->email }}</a>
                            </li>
                            <li><span>Phone:</span> {{ $name_location->phone_one }}</li>
                            {{-- <li><a href="fax:+18183695800"><span>Fax:</span>818.369.5800</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="content">
            <div class="page-title mb_40">
                <h1>Session Notes </h1>
            </div>
            <form action="" method="POST" id="form_13">
                @csrf
                <section class="section_1 mb_30">
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td colspan="3">
                                    <div class="flex-div"><span>
                                            <label for="clname">Client Name:</label>
                                        </span> <span>
                                            <input type="text" id="clname" name="clname"
                                                value="{{ $data->clname }}">
                                            <input type="hidden" id="" name="sessionid"
                                                value="{{ $session_id }}">
                                        </span></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="sd">Service Date:</label>
                                        </span> <span>
                                            <input type="date" id="sd" name="sd"
                                                value="{{ $data->sd }}">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="stime">Start Time:</label>
                                        </span> <span>
                                            <input type="time" id="stime" name="stime"
                                                value="{{ \Carbon\Carbon::parse($data->stime)->format('H:i:s') }}">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="etime">End Time:</label>
                                        </span> <span>
                                            <input type="time" id="etime" name="etime"
                                                value="{{ \Carbon\Carbon::parse($data->etime)->format('H:i:s') }}">
                                        </span></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="units">Units:</label>
                                        </span> <span>
                                            <input type="number" id="units" name="units"
                                                value="{{ $data->units }}">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="sl">Service Location:</label>
                                        </span> <span>
                                            <input type="text" id="sl" name="sl"
                                                value="{{ $data->sl }}">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="pxcode">PX Code:</label>
                                        </span> <span>
                                            <input type="text" id="pxcode" name="pxcode"
                                                value="{{ $data->pxcode }}">
                                        </span></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label>All Service Code Descriptions </label>
                                    <textarea rows="1" class="form-control" name="scd">{{ $data->scd }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_30">
                        <h3>Providers: </h3>
                    </div>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <div class="flex-div">
                                    <label for="on">Organization Name:</label>
                                    <input type="text" id="on" name="on" value="{{ $data->on }}">
                                </div>
                            </td>
                            <td>
                                <div class="flex-div">
                                    <label for="pname">Provider Name:</label>
                                    <input type="text" id="pname" name="pname" value="{{ $data->pname }}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="flex-div">
                                    <label for="pcred">Provider Credentials:</label>
                                    <input type="text" id="pcr" name="pcr"
                                        value="{{ $data->pcr }}">
                                </div>
                            </td>
                            <td>
                                <div class="flex-div">
                                    <label for="pnpi">Provider NPI:</label>
                                    <input type="text" id="pnpi" name="pnpi"
                                        value="{{ $data->pnpi }}">
                                </div>
                            </td>
                        </tr>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_30">
                        <h3>Procedures Used:</h3>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="skill"
                                {{ $data->skill == 1 ? 'checked' : '' }} value="1">Skill Acquisition
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="social"
                                {{ $data->social == 1 ? 'checked' : '' }} value="1">Social Skill Acquisition
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="role"
                                {{ $data->role == 1 ? 'checked' : '' }} value="1">Role Play
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="prem"
                                {{ $data->prem == 1 ? 'checked' : '' }} value="1">Premack Principle
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="stimu"
                                {{ $data->stimu == 1 ? 'checked' : '' }} value="1">Stimulus Prompts
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="modeling"
                                {{ $data->modeling == 1 ? 'checked' : '' }} value="1">Video Modeling
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="shaping"
                                {{ $data->shaping == 1 ? 'checked' : '' }} value="1">Shaping
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="contract"
                                {{ $data->contract == 1 ? 'checked' : '' }} value="1">Behavior Contract
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="timer"
                                {{ $data->timer == 1 ? 'checked' : '' }} value="1">Timer
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="tboard"
                                {{ $data->tboard == 1 ? 'checked' : '' }} value="1">Token Board
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="selfm"
                                {{ $data->selfm == 1 ? 'checked' : '' }} value="1">Self Monitor
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="dtt"
                                {{ $data->dtt == 1 ? 'checked' : '' }} value="1">DTT
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="antm"
                                {{ $data->antm == 1 ? 'checked' : '' }} value="1">Antecedent Manipulation
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="selfmn"
                                {{ $data->selfmn == 1 ? 'checked' : '' }} value="1">Self Management
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="diffrein"
                                {{ $data->diffrein == 1 ? 'checked' : '' }} value="1">Differential Reinforcement
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="fct"
                                {{ $data->fct == 1 ? 'checked' : '' }} value="1">FCT
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="vaid"
                                {{ $data->vaid == 1 ? 'checked' : '' }} value="1">Visual Aid
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="errorlearn"
                                {{ $data->errorlearn == 1 ? 'checked' : '' }} value="1">Errorless Learning
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="net"
                                {{ $data->net == 1 ? 'checked' : '' }} value="1">NET
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="chaining"
                                {{ $data->chaining == 1 ? 'checked' : '' }} value="1">Chaining
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="others"
                                {{ $data->others == 1 ? 'checked' : '' }} value="1">Others
                        </label>
                    </div>
                    <textarea rows="1" class="form-control" placeholder="Explain.." name="other2">{{ $data->other2 }}</textarea>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_30">
                        <h3>Goals for Session: </h3>
                    </div>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="text-left">
                                <label>Service Type:</label>
                                <input type="text" name="stype" value="{{ $data->stype }}">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                <label>Session Notes:</label>
                                <div class="textarea">
                                    <textarea id="activities" rows="5" name="sessionnotes">{{ $data->sessionnotes }}</textarea>
                                </div>
                            </td>
                        </tr>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_30">
                        <h3>Session Summary: </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="activities" rows="5" name="ssummary">{{ $data->ssummary }}</textarea>
                    </div>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_30">
                        <h3>Providers: </h3>
                    </div>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <div class="flex-div">
                                    <label for="provider_name">Provider Name :</label>
                                    <input type="text" id="provider_name" name="provider_name"
                                        value="{{ $data->provider_name }}">
                                </div>
                            </td>
                            <td>
                                <div class="flex-div">
                                    <label for="pcredent">Provider Credentials :</label>
                                    <input type="text" id="pcredent" name="pcredent"
                                        value="{{ $data->pcredent }}">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <ul class="list-inline mt-3">
                    <li class="list-inline-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="add_pro_sig"
                                name="add_pro_sig" {{$data->signature == null?'':'checked'}}>
                            <label class="form-check-label" for="add_pro_sig">
                                Add Provider Signature
                            </label>
                        </div>
                    </li>
                    <li class="list-inline-item float-right">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="add_care_sig"
                                name="add_care_sig" {{$data->updload_sign == null?'':'checked'}}>
                            <label class="form-check-label" for="add_care_sig">
                                Add Caregiver Signature
                            </label>
                        </div>
                    </li>
                </ul>
                </section>
                <section class="section_bottom">
                    <div class="button-row flex-div">
                        {{-- <div class="mark-sign"><a href="#signatureModal" data-toggle="modal"><span class="mark-icon"><i
                            class="fas fa-check"></i></span> Mark Completed
                        and Sign</a></div> --}}
                        <div class="save-prog">
                            <button type="submit"><span class="cloud-icon"><i class="fas fa-cloud"></i></span>
                                Save
                            </button>
                        </div>
                        <div class="print">
                            <button type="button" class="pdf_btn"><span class="print-icon"><i
                                        class="fas fa-print"></i></span>Print
                            </button>
                        </div>

                    </div>
                </section>
                <!-- signature modal provider -->
                <div class="modal fade" id="signatureModal" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Add signature</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#drawsig">Draw</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#uploadsig">Upload</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="drawsig">
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <canvas id="sig-canvas" height="120" style="width: 100%;"></canvas>
                                            </div>
                                            <input type="hidden" class="form-control-file sing_draw"
                                                name="sing_draw">
                                        </div>
                                        <button type="button" class="btn btn-danger p-2"
                                            id="sig-clearBtn">Clear</button>
                                    </div>
                                    <div class="tab-pane fade" id="uploadsig">
                                        <label>Upload File</label>
                                        <input type="file" class="form-control-file" name="updload_sign">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Add
                                    Signature
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- signature modal caregiver -->
                <div class="modal fade" id="signatureModal2" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Add signature</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#drawsig2">Draw</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#uploadsig2">Upload</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="drawsig2">
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <canvas id="sig-canvas2" height="120"
                                                    style="width: 100%;"></canvas>
                                            </div>
                                            <input type="hidden" class="form-control-file sing_draw2"
                                                name="sing_draw2">
                                        </div>
                                        <button type="button" class="btn btn-danger p-2"
                                            id="sig-clearBtn2">Clear</button>
                                    </div>
                                    <div class="tab-pane fade" id="uploadsig2">
                                        <label>Upload File</label>
                                        <input type="file" class="form-control-file" name="updload_sign2">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Add
                                    Signature
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="footer-section">
                <div class="flex-div">
                    <div class="col-item">
                        <p><strong>{{ $name_location->facility_name }}</strong> {{ $name_location->address }}
                            . {{ $name_location->city }}
                            , {{ $name_location->state }} {{ $name_location->zip }}
                        </p>
                    </div>
                    <div class="col-item">
                        <p><a href="tel:{{ $name_location->phone_one }}">Phone: {{ $name_location->phone_one }},</a>
                            &nbsp;<a href="mailto:{{ $name_location->email }}"> <span>Email:</span>
                                {{ $name_location->email }},</a>&nbsp;<a
                                href="{{ $name_location->email }}">{{ $name_location->email }}</a></p>
                    </div>
                </div>
            </div>

            <form class="pdf_form" action="{{ route('superadmin.print.form.13') }}" target="_blank" method="POST">
                @csrf
                <input type="hidden" name="session_id" class="session_id" value="{{ $session_id }}">
            </form>
        </div>
    </div>
    <!--/ signature modal -->
    <!-- Jq Files -->
    <script src="{{ asset('assets/dashboard//') }}/js/jquery.min.js"></script>
    <script src="{{ asset('assets/dashboard//') }}/js/popper.min.js"></script>
    <script src="{{ asset('assets/dashboard//') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
    <script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>

    <script>
        $(document).ready(function() {

            $(document).on('click', '.pdf_btn', function() {
                $('.pdf_form').submit();
            })

            $(document).on('submit', '#form_13', function(e) {
                e.preventDefault();
                let canvas2 = document.getElementById('sig-canvas');
                let canvas3 = document.getElementById('sig-canvas2');
                let dataURL2 = canvas2.toDataURL();
                let dataURL3 = canvas3.toDataURL();

                let sing_draw = $('.sing_draw').val(dataURL2);
                let sing_draw2 = $('.sing_draw2').val(dataURL3);

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('superadmin.13.form.submit') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        console.log(data);
                        toastr["success"]("Form Successfully Created", 'SUCCESS!');


                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })
        })
    </script>

    @include('superadmin.appoinment.include.forms_js_include')


</body>

</html>
