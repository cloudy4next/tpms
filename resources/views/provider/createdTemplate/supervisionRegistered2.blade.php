<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Supervision Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem15/')}}/css/custom-15.css">
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
                            <img src="{{asset($logo->logo)}}"
                                 alt="" class="logo_img">
                        @endif

                    </a></div>
            </div>
            <div class="col-item">
                <div class="info-details">
                    <ul>
                        <li><span>Mail:</span>{{$name_location->address}}. {{$name_location->city}}
                            , {{$name_location->state}} {{$name_location->zip}}
                        </li>
                        <li><a href="mailto:{{$name_location->email}}"> <span>Email:</span>{{$name_location->email}}</a>
                        </li>
                        <li><span>Phone:</span> {{$name_location->phone_one}}</li>
                        {{--                        <li><a href="fax:+18183695800"><span>Fax:</span>818.369.5800</a></li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="content">
        <div class="page-title mb_40">
            <h2>Supervision Form</h2>
            <h1>SUPERVISION: REGISTERED BEHAVIOR TECHNICIAN</h1>
        </div>
        <form action="" method="post" id="form_15">
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
                      <input type="text" id="clname" name="clname" value="{{ $data->clname }}">
                      <input type="hidden" id="" name="sessionid" value="{{$session_id}}">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="dob">DOB:</label>
                    </span> <span>
                      <input type="date" id="dob" name="dob" value="{{ $data->dob }}">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="age">Age:</label>
                    </span> <span>
                      <input type="text" id="age" name="age" value="{{ $data->age }}">
                    </span></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="cldiag">Claims Diagnosis:</label>
                    </span> <span>
                      <input type="text" id="cldiag" name="cldiag" value="{{ $data->cldiag }}">
                    </span></div>
                        </td>
                        <td colspan="2">
                            <div class="flex-div"><span>
                      <label for="insured">Insured Id:</label>
                    </span> <span>
                      <input type="text" id="insured" name="insured" value="{{ $data->insured }}">
                    </span></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_1 mb_30">
                <h3 class="mb-3">SUPERVISOR/SUPERVISEE INFORMATION:</h3>
                <table cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="supname">Supervisor's Name (BCBA/BCaBA):</label>
                    </span> <span>
                      <input type="text" id="supname" name="supname" value="{{ $data->supname }}">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="regtech">Registered Behavior Technician's Name:</label>
                    </span> <span>
                      <input type="text" id="regtech" name="regtech" value="{{ $data->regtech }}">
                    </span></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_1 mb_30">
                <h3 class="mb-3">Supervised Session Date:</h3>
                <table cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="sd">Session Date:</label>
                    </span> <span>
                      <input type="date" id="sd" name="sd" value="{{ $data->sd }}">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="sst">Start Time:</label>
                    </span> <span>
                      <input type="time" id="sst" name="sst" value="{{\Carbon\Carbon::parse($data->sst)->format('H:i:s')}}">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="set">End Time :</label>
                    </span> <span>
                      <input type="time" id="set" name="set" value="{{\Carbon\Carbon::parse($data->set)->format('H:i:s')}}">
                    </span></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_2 mb_30">
                <h3 class="mb-3">Supervision provided</h3>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="supprovide"
                                       {{$data->supprovide == 1 ? 'checked' : ''}} value="1">In Person
                            </label>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="supprovide"
                                       {{$data->supprovide == 2 ? 'checked' : ''}} value="2">Remote
                            </label>
                        </div>
                    </li>
                </ul>
            </section>
            <section class="section_2 mb_30 rbt">
                <h3 class="mb-3 text-center">RBT® TASK LIST ITEMS</h3>
                <ol style="list-style-type:upper-alpha;">
                    <li>
                        <span class="text-danger">Measurement</span>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="a_1"
                                       {{$data->a_1 == 1 ? 'checked' : ''}} value="1">A-1 Prepare for data collection
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="a_2"
                                       {{$data->a_2 == 1 ? 'checked' : ''}} value="1">A-2 Implement continuous
                                measurement procedures (e.g.,
                                frequency, duration)
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="a_3"
                                       {{$data->a_3 == 1 ? 'checked' : ''}} value="1">A-3 Implement discontinuous
                                measurement procedures
                                (e.g., partial & whole interval, momentary time sampling)
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="a_4"
                                       {{$data->a_4 == 1 ? 'checked' : ''}} value="1">A-4 Implement permanent-product
                                recording procedures
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="a_5"
                                       {{$data->a_5 == 1 ? 'checked' : ''}} value="1">A-5 Enter data and update graphs
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="a_6"
                                       {{$data->a_6 == 1 ? 'checked' : ''}} value="1">A-6 Describe behavior and
                                environment in observable
                                and
                                measurable terms
                            </label>
                        </div>
                    </li>
                    <li>
                        <span class="text-danger">Assessment</span>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="b_1"
                                       {{$data->b_1 == 1 ? 'checked' : ''}} value="1">B-1 Conduct preference assessments
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="b_2"
                                       {{$data->b_2 == 1 ? 'checked' : ''}} value="1">B-2 Assist with individualized
                                assessment procedures
                                (e.g., curriculum-based, developmental, social skills)
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="b_3"
                                       {{$data->b_3 == 1 ? 'checked' : ''}} value="1">B-3 Assist with functional
                                assessment procedures
                            </label>
                        </div>
                    </li>
                    <li>
                        <span class="text-danger">Skill Acquisition</span>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="c_1"
                                       {{$data->c_1 == 1 ? 'checked' : ''}} value="1">C-1 Identify the essential
                                components of a written
                                skill
                                acquisition plan
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="c_2"
                                       {{$data->c_2 == 1 ? 'checked' : ''}} value="1">C-2 Prepare for the session as
                                required by the skill
                                acquisition plan
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="c_3"
                                       {{$data->c_3 == 1 ? 'checked' : ''}} value="1">C-3 Use contingencies of
                                reinforcement (e.g.,
                                conditioned/unconditioned reinforcement,
                                continuous/intermittent schedules).
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="c_4"
                                       {{$data->c_4 == 1 ? 'checked' : ''}} value="1">C-4 Implement discrete-trial
                                teaching procedures
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="c_5"
                                       {{$data->c_5 == 1 ? 'checked' : ''}} value="1">C-5 Implement naturalistic
                                teaching procedures (e.g.,
                                incidental teaching)
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="c_6"
                                       {{$data->c_6 == 1 ? 'checked' : ''}} value="1">C-6 Implement task analyzed
                                chaining procedures.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="c_7"
                                       {{$data->c_7 == 1 ? 'checked' : ''}} value="1">C-7 Implement discrimination
                                training
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="c_8"
                                       {{$data->c_8 == 1 ? 'checked' : ''}} value="1">C-8 Implement stimulus control
                                transfer procedures
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="c_9"
                                       {{$data->c_9 == 1 ? 'checked' : ''}} value="1">C-9 Implement prompt and prompt
                                fading procedures
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="c_10"
                                       {{$data->c_10 == 1 ? 'checked' : ''}} value="1">C-10 Implement generalization and
                                maintenance
                                procedures
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="c_11"
                                       {{$data->c_11 == 1 ? 'checked' : ''}} value="1">C-11 Implement shaping procedures
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="c_12"
                                       {{$data->c_12 == 1 ? 'checked' : ''}} value="1">C-12 Implement token economy
                                procedures
                            </label>
                        </div>
                    </li>
                    <li>
                        <span class="text-danger">Behavior Reduction</span>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="d_1"
                                       {{$data->d_1 == 1 ? 'checked' : ''}} value="1">D-1 Identify essential components
                                of a written
                                behavior
                                reduction plan
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="d_2"
                                       {{$data->d_2 == 1 ? 'checked' : ''}} value="1">D-2 Describe common functions of
                                behavior
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="d_3"
                                       {{$data->d_3 == 1 ? 'checked' : ''}} value="1">D-3 Implement interventions based
                                on modification of
                                antecedents such as motivating operations
                                and discriminative stimuli
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="d_4"
                                       {{$data->d_4 == 1 ? 'checked' : ''}} value="1">D-4 Implement differential
                                reinforcement procedures
                                (e.g., DRA, DRO).
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="d_5"
                                       {{$data->d_5 == 1 ? 'checked' : ''}} value="1">D-5 Implement extinction
                                procedures
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="d_6"
                                       {{$data->d_6 == 1 ? 'checked' : ''}} value="1">D-6 Implement crisis/emergency
                                procedures according to
                                protocol
                            </label>
                        </div>
                    </li>
                    <li>
                        <span class="text-danger">E-Documentation and Reporting</span>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="e_1"
                                       {{$data->e_1 == 1 ? 'checked' : ''}} value="1">E-1 Effectively communicate with a
                                supervisor in an
                                ongoing manner
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="e_2"
                                       {{$data->e_2 == 1 ? 'checked' : ''}} value="1">E-2 Actively seek clinical
                                direction from supervisor
                                in
                                a timely manner
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="e_3"
                                       {{$data->e_3 == 1 ? 'checked' : ''}} value="1">E-3 Report other variables that
                                might affect the
                                client
                                in a timely manner
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="e_4"
                                       {{$data->e_4 == 1 ? 'checked' : ''}} value="1">E-4 Generate objective session
                                notes for service
                                verification by describing what occurred during the sessions, in
                                accordance with applicable legal, regulatory, and workplace requirements.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="e_5"
                                       {{$data->e_5 == 1 ? 'checked' : ''}} value="1">E-5 Comply with applicable legal,
                                regulatory, and
                                workplace data collection, storage, transportation, and
                                documentation requirements
                            </label>
                        </div>
                    </li>
                    <li>
                        <span class="text-danger">Professional Conduct and Scope of Practice</span>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="f_1"
                                       {{$data->f_1 == 1 ? 'checked' : ''}} value="1">F-1 Describe the BACB’s RBT
                                supervision requirements
                                and
                                the role of RBTs in the service-delivery system.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="f_2"
                                       {{$data->f_2 == 1 ? 'checked' : ''}} value="1">F-2 Respond appropriately to
                                feedback and maintain or
                                improve performance accordingly
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="f_3"
                                       {{$data->f_3 == 1 ? 'checked' : ''}} value="1">F-3 Communicate with stakeholders
                                (e.g., family,
                                caregivers, other professionals) as authorized
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="f_4"
                                       {{$data->f_4 == 1 ? 'checked' : ''}} value="1">F-4 Maintain professional
                                boundaries (e.g., avoid dual
                                relationships, conflicts of interest, social media contacts).
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="f_5"
                                       {{$data->f_5 == 1 ? 'checked' : ''}} value="1">F-5 Maintain client dignity
                            </label>
                        </div>
                    </li>
                </ol>
            </section>
            <section class="section_2 mb_30">
                <div class="box box1 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="pto">SUPERVISION Overview:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="pto" rows="5" name="supoverview">{{ $data->supoverview}}</textarea>
                    </div>
                </div>
                <div class="box box2">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="fd">Feedback to SUPERVISEr:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="fd" rows="5" name="supfeed">{{ $data->supfeed}}</textarea>
                    </div>
                </div>
            
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
                                    <button type="button" class="btn btn-danger p-2" id="sig-clearBtn">Clear</button>
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
                                            <canvas id="sig-canvas2" height="120" style="width: 100%;"></canvas>
                                        </div>
                                        <input type="hidden" class="form-control-file sing_draw2"
                                               name="sing_draw2">
                                    </div>
                                    <button type="button" class="btn btn-danger p-2" id="sig-clearBtn2">Clear</button>
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
                    <p><strong>{{$name_location->facility_name}}</strong> {{$name_location->address}}
                        . {{$name_location->city}}
                        , {{$name_location->state}} {{$name_location->zip}}
                    </p>
                </div>
                <div class="col-item">
                    <p><a href="tel:{{$name_location->phone_one}}">Phone: {{$name_location->phone_one}},</a> &nbsp;<a
                            href="mailto:{{$name_location->email}}"> <span>Email:</span>
                            {{$name_location->email}},</a>&nbsp;<a
                            href="{{$name_location->email}}">{{$name_location->email}}</a></p>
                </div>
            </div>
        </div>

        <form class="pdf_form" action="{{ route('provider.print.form.15')}}" target="_blank" method="POST">
            @csrf
            <input type="hidden" name="session_id" class="session_id" value="{{$session_id}}">
        </form>
    </div>
</div>
<!--/ signature modal -->
<!-- Jq Files -->
<script src="{{asset('assets/dashboard//')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>
<script>
    $(document).ready(function () {

        $(document).on('click', '.pdf_btn', function () {
            $('.pdf_form').submit();
        })

        $(document).on('submit', '#form_15', function (e) {
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
                url: "{{route('provider.15.form.submit')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    console.log(data);
                    toastr["success"]("Form Successfully Created", 'SUCCESS!');


                },
                error: function (data) {
                    console.log(data);
                }
            });
        })
    })
</script>
@include('provider.include.forms_js_include')
</body>

</html>
