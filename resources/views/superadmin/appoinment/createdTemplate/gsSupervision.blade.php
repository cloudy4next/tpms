<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervision Form</title>
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/template/tem22/') }}/css/custom-22.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
        .logo_img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="treatment-plan">
        <div class="content">
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
            <form action="" method="POST" id="form_22">
                @csrf
                <div class="page-title mb_40">
                    <h1>Supervision Form</h1>
                </div>
                <section class="section_1">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label class="text-primary">Deficits Addressed</label>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="defict"
                                                        value="1" {{ $data->defict == 1 ? 'checked' : '' }}>Social
                                                </label>
                                                <input type="hidden" name="sessionid" value="{{ $session_id }}">
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="defict"
                                                        value="2" {{ $data->defict == 2 ? 'checked' : '' }}>Play
                                                    Skills
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="defict"
                                                        value="3"
                                                        {{ $data->defict == 3 ? 'checked' : '' }}>Expressive
                                                    Language
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="defict"
                                                        value="4"
                                                        {{ $data->defict == 4 ? 'checked' : '' }}>Receptive
                                                    Language
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="defict"
                                                        value="5"
                                                        {{ $data->defict == 5 ? 'checked' : '' }}>Maladaptive
                                                    Behaviors
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="defict"
                                                        value="6"
                                                        {{ $data->defict == 6 ? 'checked' : '' }}>Restrictive
                                                    and Repetitive Interests
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label class="text-primary">Problem Behavior Observed</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter here..." name="pbo">{{ $data->pbo }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="text-primary">Interventions Used</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter here..." name="iu">{{ $data->iu }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="text-primary">Progress Noted</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter here..." name="pn">{{ $data->pn }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="text-primary">Feedback Provided to Therapist</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter here..." name="fpt">{{ $data->fpt }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_3">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="client"
                                                        value="1"
                                                        {{ $data->client == 1 ? 'checked' : '' }}>Client
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="therapist"
                                                        value="1"
                                                        {{ $data->therapist == 1 ? 'checked' : '' }}>Therapist
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                        name="render_prov" value="1"
                                                        {{ $data->render_prov == 1 ? 'checked' : '' }}>Rendering
                                                    Provider
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
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
                <div class="section_bottom">
                    <div class="button-row flex-div">
                        <div class="save-prog"><button type="submit"><span class="cloud-icon"><i
                                        class="fas fa-cloud"></i></span>
                                Save</button></div>
                        <div class="print"><button type="button" class="pdf_btn"><span class="print-icon"><i
                                        class="fas fa-print"></i></span>Print</button>
                        </div>

                    </div>
                </div>

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
                        <p><strong>{{ $name_location->facility_name }}</strong> {{ $name_location->address }}.
                            {{ $name_location->city }}
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
            <form class="pdf_form" action="{{ route('superadmin.print.form.22') }}" target="_blank" method="POST">
                @csrf
                <input type="hidden" name="session_id" class="session_id" value="{{ $session_id }}">
            </form>
        </div>
    </div>
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
            $(document).on('submit', '#form_22', function(e) {
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
                    url: "{{ route('superadmin.22.form.submit') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        console.log(data)
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
