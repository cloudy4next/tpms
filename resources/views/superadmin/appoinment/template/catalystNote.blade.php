<?php
use App\Models\Appoinment;
use App\Models\Employee;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

if (Auth::user()->is_up_admin == 1) {
    $admin_id = Auth::user()->id;
} else {
    $admin_id = Auth::user()->up_admin_id;
}

$cl = Appoinment::where('admin_id', $admin_id)
    ->where('id', $session_id)
    ->first();
$provider = Employee::where('id', $cl->provider_id)->first();
$client = Client::where('id', $cl->client_id)->first();
if ($provider->credential_type == 11) {
    $cred = 'Paraprofessional ';
} elseif ($provider->credential_type == 12) {
    $cred = 'Behavior Analyst';
} else {
    $cred = '';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOAP Notes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/') }}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/template/tem11/') }}/css/custom-11.css">

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
                        </a>
                    </div>
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
            <form action="{{ route('superadmin.sn.eleven.form.submit') }}" method="post" id="cn_eleven_from">
                @csrf
                <div class="page-title mb_40">
                    <h1> SOAP Notes</h1>
                </div>
                <div class="top-part" style="margin-top:10px;">
                    <div class="row1 flex-div mb_30">
                        <div class="client-name"><label>Client Name:</label> <input type="text"
                                placeholder="Enter Your Name..." name="clname"
                                value="{{ $client->client_full_name }}">
                            <input type="hidden" placeholder="Enter Your Name..." name="sessionid"
                                value="{{ $session_id }}">
                        </div>
                        <div class="date"><label>DOS:</label> <input type="date" name="stdate"
                                value="{{ $cl->schedule_date }}"></div>
                    </div>
                    <div class="row1 flex-div mb_30">
                        <div class="client-name"><label>Therapist:</label> <input type="text"
                                placeholder="Enter Your Name..." name="terp"></div>
                        <div class="date"><label>Start Time:</label> <input type="time" name="sttitme"
                                value="{{ \Carbon\Carbon::parse($cl->from_time)->format('H:i:s') }}"></div>
                        <div class="date"><label>End Time:</label> <input type="time" name="endtime"
                                value="{{ \Carbon\Carbon::parse($cl->to_time)->format('H:i:s') }}"></div>
                    </div>
                    <div class="mb_30">
                        <label class="d-block mb-2">Notes</label>
                        <textarea class="form-control border" rows="3" placeholder="Enter Notes..." name="notes"></textarea>
                    </div>
                </div>
                <section class="section_1">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td><label>Question</label></td>
                                <td><label>Answer</label></td>
                            </tr>
                            <tr>
                                <td rowspan="3">
                                    <div class="flex-div first"><span><label>Location:</label></span> <span>
                                            <textarea class="form-control" placeholder="Enter Location..." name="location"></textarea>
                                        </span>
                                    </div>
                                </td>
                                <td><label>Date:</label><input type="date" name="lodate"></td>
                            </tr>
                            <tr>
                                <td><label>Start Time:</label> <input type="time" name="losttime"></td>
                            </tr>
                            <tr>
                                <td><label>End Time:</label> <input type="time" name="loendtime"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex-div">
                                        <span><label>Location of
                                                Service:</label></span> <span>
                                            <textarea class="form-control" placeholder="Enter Location of Service..." name="los"></textarea>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <span><label class="d-block">Supervisor Present?</label></span>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="spyn"
                                                value="1">Yes
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="spyn"
                                                value="2">No
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><label class="d-block">Caregiver Participated in Session?</label></span>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="cpins"
                                                value="1">Yes
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="cpins"
                                                value="2">No
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex-div"><span><label>Strategies used during session:
                                            </label></span> <span>
                                            <textarea class="form-control" placeholder="Enter here..." name="suds"></textarea>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex-div"><span><label>Targets worked on during session:
                                            </label></span> <span>
                                            <textarea class="form-control" placeholder="Enter here..." name="twods"></textarea>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex-div"><span><label>What
                                                notable
                                                maladaptive
                                                behaviors
                                                were
                                                observed?
                                            </label></span> <span>
                                            <textarea class="form-control" placeholder="Enter here..." name="wnmbwo"></textarea>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex-div"><span><label>If "Other",
                                                please
                                                describe
                                                behaviors:
                                            </label></span> <span>
                                            <textarea class="form-control" placeholder="Enter here..." name="iopdb"></textarea>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex-div"><span><label>Notes:
                                            </label></span> <span>
                                            <textarea class="form-control" placeholder="Enter here..." name="note2"></textarea>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="flex-div"><span><label>Location
                                                Address:
                                            </label></span> <span>
                                            <textarea class="form-control" placeholder="Enter here..." name="ladd"></textarea>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <ul class="list-inline mt-3">
                        <li class="list-inline-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="add_pro_sig"
                                    name="add_pro_sig">
                                <label class="form-check-label" for="add_pro_sig">
                                    Add Provider Signature
                                </label>
                            </div>
                        </li>
                        <li class="list-inline-item float-right">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="add_care_sig"
                                    name="add_care_sig">
                                <label class="form-check-label" for="add_care_sig">
                                    Add Caregiver Signature
                                </label>
                            </div>
                        </li>
                    </ul>
                </section>
                <div class="section_bottom">
                    <div class="button-row flex-div">
                        {{-- <div class="mark-sign"><a href="#signatureModal" data-toggle="modal"><span class="mark-icon"><i
                                    class="fas fa-check"></i></span> Mark
                            Completed and Sign</a></div> --}}
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
            <form class="pdf_form" action="{{ route('superadmin.print.form.11') }}" target="_blank" method="POST">
                @csrf
                <input type="hidden" name="session_id" class="session_id" value="{{ $session_id }}">
            </form>
        </div>
    </div>
    <!-- signature modal -->

    <!--/ signature modal -->
    <!-- Jq Files -->
    <script src="{{ asset('assets/dashboard/') }}/js/jquery.min.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/js/popper.min.js"></script>
    <script src="{{ asset('assets/dashboard/') }}/js/bootstrap.min.js"></script>
    <!-- Signature -->
    <script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
    <script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>
    <script>
        $(document).ready(function() {
            $('.pdf_btn').hide();
            $(document).on('click', '.pdf_btn', function() {
                $('.pdf_form').submit();
            })
            $(document).on('submit', '#cn_eleven_from', function(e) {
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
                    url: "{{ route('superadmin.sn.eleven.form.submit') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        console.log(data);
                        if (data == "done") {
                            $('.pdf_btn').show();
                        }
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
