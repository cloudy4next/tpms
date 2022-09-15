<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/custom.css">
    <title>Parent Training Session Note</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/template/tem12/') }}/css/custom-12.css">
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
                <h1>Parent Training Session Note</h1>
            </div>
            <form action="" method="post" id="form_12">
                @csrf
                <section class="section_1 mb_30">
                    <h3 class="mb-3">Client Information:</h3>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="clname">Client Name:</label>
                                        </span> <span>
                                            <input type="text" id="clname" name="clname"
                                                value="{{ $data->clname }}">
                                            <input type="hidden" id="" name="sessionid"
                                                value="{{ $session_id }}">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="dob">DOB:</label>
                                        </span> <span>
                                            <input type="date" id="dob" name="dob"
                                                value="{{ $data->dob }}">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="age">Age:</label>
                                        </span> <span>
                                            <input type="text" id="age" name="age"
                                                value="{{ $data->age }}">
                                        </span></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="diag">Diagnosis:</label>
                                        </span> <span>
                                            <input type="text" id="diag" name="diag"
                                                value="{{ $data->diag }}">
                                        </span></div>
                                </td>
                                <td colspan="2">
                                    <div class="flex-div"><span>
                                            <label for="insured">Insured Id:</label>
                                        </span> <span>
                                            <input type="text" id="insured" name="insured"
                                                value="{{ $data->insured }}">
                                        </span></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_1 mb_30">
                    <h3 class="mb-3">Provider Information:</h3>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="p_name">Provider Name:</label>
                                        </span> <span>
                                            <input type="text" id="p_name" name="p_name"
                                                value="{{ $data->p_name }}">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="cred">Credentials :</label>
                                        </span> <span>
                                            <input type="text" id="cred" name="cred"
                                                value="{{ $data->cred }}">
                                        </span></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_1 mb_30">
                    <h3 class="mb-3">Individual Present:</h3>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="flex-div"><span>
                                            <label>Caregiver:</label>
                                        </span> <span>
                                            <input type="text" name="caregiver" value="{{ $data->caregiver }}">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="clname2">Client Name:</label>
                                        </span> <span>
                                            <input type="text" id="clname2" name="clname2"
                                                value="{{ $data->clname2 }}">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="bcbarad"
                                                {{ $data->bcbarad == 1 ? 'checked' : '' }} value="1">BCBA
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="bcbarad"
                                                {{ $data->bcbarad == 2 ? 'checked' : '' }} value="2">RBT
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="bcbarad"
                                                {{ $data->bcbarad == 3 ? 'checked' : '' }} value="3">Other
                                        </label>
                                    </div>
                                    <input type="text" class="border border-primary" placeholder="Explain.."
                                        name="otherexp" value="{{ $data->otherexp }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_1 mb_30">
                    <h3 class="mb-3">Parent Training Session Date:</h3>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="sd">Service Date :</label>
                                        </span> <span>
                                            <input type="date" id="sd" name="sd"
                                                value="{{ $data->sd }}">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="sst">Service Start Time:</label>
                                        </span> <span>
                                            <input type="time" id="sst" name="sst"
                                                value="{{ \Carbon\Carbon::parse($data->sst)->format('H:i:s') }}">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="set">Service End Time :</label>
                                        </span> <span>
                                            <input type="time" id="set" name="set"
                                                value="{{ \Carbon\Carbon::parse($data->set)->format('H:i:s') }}">
                                        </span></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <h3 class="mb-3">Parent Training Provided</h3>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="in_person"
                                        {{ $data->in_person == 1 ? 'checked' : '' }} value="1">In Person
                                </label>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remote"
                                        {{ $data->remote == 1 ? 'checked' : '' }} value="1">Remote
                                </label>
                            </div>
                        </li>
                    </ul>
                </section>
                <section class="section_2 mb_30">
                    <div class="box box1 mb_30">
                        <div class="col-title mb_15">
                            <h3>
                                <label for="pto">Parent Training Overview:</label>
                            </h3>
                        </div>
                        <div class="textarea">
                            <textarea id="pto" rows="5" name="pto">{{ $data->pto }}</textarea>
                        </div>
                    </div>
                    <div class="box box2">
                        <div class="col-title mb_15">
                            <h3>
                                <label for="fd">Feedback to Parent:</label>
                            </h3>
                        </div>
                        <div class="textarea">
                            <textarea id="fd" rows="5" name="fd">{{ $data->fd }}</textarea>
                        </div>
                    </div>
                </section>
                <section class="section_2 mb_30">
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="pfn">Provider Full Name:</label>
                                        </span> <span>
                                            <input type="text" id="pfn" name="pfn"
                                                value="{{ $data->pfn }}">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="pcred">Provider Credentials:</label>
                                        </span> <span>
                                            <input type="text" id="pcred" name="pcred"
                                                value="{{ $data->pcred }}">
                                        </span></div>
                                </td>
                            </tr>
                        </tbody>
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

            <form class="pdf_form" action="{{ route('superadmin.print.form.12') }}" target="_blank" method="POST">
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

            $(document).on('submit', '#form_12', function(e) {
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
                    url: "{{ route('superadmin.12.form.submit') }}",
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
