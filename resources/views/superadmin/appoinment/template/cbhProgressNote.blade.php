<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>PROGRESS NOTE</title>
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
          <h1>PROGRESS NOTE</h1>
        </div>

        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td>
                  <label>Name of Client: <input type="text"></label>
                </td>
                <td>
                  <label>DOB: <input type="date"></label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Client MR #: <input type="text"></label>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Child
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Youth
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Adult
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label>Date of Service: <input type="date"></label>
                </td>

              </tr>
              <tr>
                <td>
                  <label>Service Provider Name: <input type="text"></label>
                </td>
                <td>
                  <label>Credentials: <input type="text"></label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Actual Start Time: <input type="time"></label>
                </td>
                <td>
                  <label>Actual Stop Time: <input type="time"></label>
                </td>
              </tr>
              <tr>
                <td colspan="2"> <label>Documentation Time: <input type="time"></label></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">A. Service Provided: </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td>
                  <label class="mr-3">Mental Health (MH) </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Individual
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Family
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Group
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">TBOS
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">B. Location of Services: </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Office
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Home
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Community
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">School
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn"> Other (explain) <input type="text"
                        placeholder="Enter...">
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">c. Observations of Client (affect, behaviors, functioning, and symptoms, out of range of
            baseline): <input type="text" placeholder="Enter..."> </h5>

        </div>
        <h5 class="title">D. Level of Risk: </h5>
        <div class="top-part d-flex justify-content-start">

          <div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">High – Disposition (date/time/place)
              </label>
            </div>
            <div class="form-check-inline d-block">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Moderate – Crisis plan attached
              </label>
            </div>
            <div class="form-check-inline d-block">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Low
              </label>
            </div>
          </div>
          <div class="ml-5">
            <div class="form-check-inline">
              <label class="form-check-label">Baker acted
                <input type="checkbox" class="form-check-input" name="yn">Yes
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">No
              </label>
            </div>
          </div>
        </div>
        <div class="top-part">
          <h5 class="title">E. (G) – Goals/Objectives Link to Service: <input type="text" placeholder="Enter..."></h5>
        </div>
        <div class="top-part">
          <h5 class="title">F. (I) – Intervention(s) Provided: <input type="text" placeholder="Enter..."></h5>
        </div>
        <div class="top-part">
          <h5 class="title">
            G. (R) – Clients Response to Interventions:
            <input type="text" placeholder="Enter..."></h5>
        </div>
        <div class="top-part">
          <h5 class="title">
            H. (P) – Plan for next steps – include date and time of next appointment as well as the plan:
            <input type="text" placeholder="Enter..."></h5>
        </div>
        <div class="top-part">
          <h5 class="title">
            I. (ED) – Estimated Discharge plan – disposition (Length of Service and Date):
            <input type="text" placeholder="Enter..."></h5>
        </div>
        <div class="top-part mt-5">
          <label>Provider Signature: <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a></label>
          <label class="d-block mt-3 mb-3">Provider Name: <input type="text" placeholder="Enter...."></label>
          <label class=" mt-3 mb-3">Credentials: <input type="text" placeholder="Enter...."></label>
          <label class=" mt-3 mb-3">Title: <input type="text" placeholder="Enter...."></label>
          <label class=" mt-3 mb-3">Date of Note: <input type="date" placeholder="Enter...."></label>
        </div>


        <div class="section_bottom">
          <div class="button-row flex-div">
            <div class="save-prog"><button type="submit"><span class="cloud-icon"><i class="fas fa-cloud"></i></span>
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
