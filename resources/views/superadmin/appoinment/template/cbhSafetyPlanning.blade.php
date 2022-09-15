<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>BCBA Trainee Supervision Monthly Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/')}}/form-style.css">
</head>

<body>
<div class="treatment-plan">
    <div class="content">
        <div class="flex-div">
            <div class="col-item">
                <div class="logo"><a href="#">
                        @if (file_exists($logo->logo) && !empty($logo->logo))
                            <img src="{{asset($logo->logo)}}"
                                 alt="" class="logo_img">
                        @endif
                    </a>
                </div>
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
        <!-- headers -->
      
    

        <form action="#">
                <div class="page-title mb_40">
                    <h1>Safety Plan </h1>
                </div>
                <div class="top-part">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Client Name:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <input type="date" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Staff Name:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <input type="date" placeholder="Enter Here...">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">Triggers and Stressors <span class="text-danger">(Behaviors, situations and
                            circumstances that put you at emotional risk)</span></h5>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <div class="flex-div first"><span></span> <span>
                                            <textarea class="form-control"
                                                placeholder="Enter Here..."></textarea></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">Things to do <span class="text-danger">(My goals for healthy behavior)</span></h5>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <div class="flex-div first"><span></span> <span>
                                            <textarea class="form-control"
                                                placeholder="Enter Here..."></textarea></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">Warning Signs <span class="text-danger">(Your behavior signals that show you’re
                            growing more and more at risk)</span></h5>
                    <ul>
                        <li><input type="text" placeholder="Enter here.." class="form-control form-control-sm"></li>
                        <li><input type="text" placeholder="Enter here.." class="form-control form-control-sm"></li>
                        <li><input type="text" placeholder="Enter here.." class="form-control form-control-sm"
                                value="Call someone and ask for help."></li>
                    </ul>
                </div>
                <div class="top-part">
                    <h5 class="title">People to call</span></h5>
                    <ul>
                        <li><input type="text" placeholder="Enter here.." class="form-control form-control-sm"></li>
                        <li><input type="text" placeholder="Enter here.." class="form-control form-control-sm"></li>
                        <li><input type="text" placeholder="Enter here.." class="form-control form-control-sm"
                                value="1 (800) 273-8255, National Suicide Prevention Lifeline"></li>
                        <li><input type="text" placeholder="Enter here.." class="form-control form-control-sm"
                                value="211"></li>
                        <li><input type="text" placeholder="Enter here.." class="form-control form-control-sm"
                                value="911"></li>
                    </ul>
                </div>
                <div class="top-part">
                    <h5 class="title">My Coping Skills</span></h5>
                    <ul>
                        <li><input type="text" placeholder="What I can do to be calm and stay safe IN THE MOMENT:"
                                class="form-control form-control-sm"></li>
                        <li><input type="text" placeholder="Who is my support person?"
                                class="form-control form-control-sm"></li>
                        <li><input type="text" placeholder="What can my support person do to help me? "
                                class="form-control form-control-sm"></li>
                    </ul>
                </div>
                <div class="top-part">
                    <h5 class="title">Reminders</span></h5>
                    <ul>
                        <li>If taking medications, Take as ordered – do not change the dose or time unless directed by
                            your physician.</li>
                        <li>If you experience side effects from your medications – notify your Psychiatrist or PCP</li>
                        <li>For Children/Adolescents – Medication should be kept out of reach and in a secure place</li>
                        <li>Keep all appointments as scheduled </li>
                    </ul>
                </div>

                <ul class="list-inline mt-3">
                    <li class="list-inline-item">
                      <a href="#" data-target="#signatureModal" data-toggle="modal">Provider Signature<i class="fa fa-signature"></i></a>
                    </li>
                    <li class="list-inline-item float-right">
                      <a href="#" data-target="#signatureModal2" data-toggle="modal">Caregiver Signature<i class="fa fa-signature"></i></a>
                    </li>
                  </ul>
                
                <div class="section_bottom">
                    <div class="button-row flex-div">
                        <div class="save-prog"><button type="submit"><span class="cloud-icon"><i
                                        class="fas fa-cloud"></i></span>
                                Save</button></div>
                        <div class="print"><button type="button"><span class="print-icon"><i
                                        class="fas fa-print"></i></span>Print</button>
                        </div>
                    </div>
                </div>




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
                    <p><strong>{{$name_location->facility_name}}</strong> {{$name_location->address}}. {{$name_location->city}}
                            , {{$name_location->state}} {{$name_location->zip}}
                    </p>
                </div>
                <div class="col-item">
                    <p><a href="tel:{{$name_location->phone_one}}">Phone: {{$name_location->phone_one}},</a> &nbsp;<a
                            href="mailto:{{$name_location->email}}"> <span>Email:</span>
                            {{$name_location->email}},</a>&nbsp;<a href="{{$name_location->email}}">{{$name_location->email}}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jq Files -->
<script src="{{asset('assets/dashboard//')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/bootstrap.min.js"></script>
@include('superadmin.appoinment.include.forms_js_include')
</body>

</html>
