<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>FARS Form</title>
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
          <h1> FARS Form </h1>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td>
                  <label> Client Name:</label>
                </td>
                <td>
                  <label> Last: <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label> First: <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label> Middle: <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
              </tr>
              <tr>
                <td colspan="3"> <label>Initial Evaluation Date from Adult MH Outcome Form at admission to
                    agency:</label></td>
                <td>
                  <label> Date: <input type="date"></label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>1. *Social Security #:</label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
                <td>
                  <label>2. Provider ID #:</label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>3. *Purpose of Evaluation:</label>
                </td>
                <td colspan="3">
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="d-flex">
          <div>
            <label>Choices: 1- </label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Admission to Agency
              </label>
            </div>
          </div>
          <div>
            <label> 2- </label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">6 Month Eval
              </label>
            </div>
          </div>
          <div>
            <label> 3- </label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Annual Eval
              </label>
            </div>
          </div>
          <div>
            <label> 4- </label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Discharge from Agency
              </label>
            </div>
          </div>
          <div>
            <label> 5- </label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Administrative Discharge
              </label>
            </div>
          </div>
          <div>
            <label> 6- </label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">None of the Above
              </label>
            </div>
          </div>


        </div>
        <div class="top-part mt-4">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td>
                  <label> 4. *Evaluation Date: <input type="date"></label>
                </td>
                <td>
                  <label> 5. *District: <input type="text" placeholder="Enter Here..."></label>
                </td>
                <td>
                  <label> 6. *Site ID:</label>
                </td>
                <td>
                  <label><input type="text" placeholder="00"></label>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label> 7. M-GAF Score: <input type="text" placeholder="Enter Here..."></label>
                </td>
                <td colspan="2">
                  <label> 1-99 {used for clients who are receiving medications-only service}</label>
                </td>
              </tr>
              <tr>
                <td colspan="4"><label>NOTE: If score entered, selection of Rating Scales is Not Required</label></td>
              </tr>
              <tr>
                <td colspan="2"><label>8. *FARS Rater ID: <input type="text" placeholder="Enter Here..."></label></td>
                <td colspan="2"><label>NOTE: Full Rater ID is required </label></td>
              </tr>
              <tr>
                <td rowspan="4">
                  <label>Definition for first two digits:</label>
              <tr>
                <td><label>01- Non Degree Trained Technician</label></td>
                <td><label>04 – MA/MS</label></td>
                <td><label>07 – MD/DO – Board Certified</label></td>
              </tr>
              <tr>
                <td><label>02- Non Degree Trained Technician</label></td>
                <td><label>05 – MA/MS Licensed Practitioner</label></td>
                <td></td>
              </tr>
              <tr>
                <td><label>03- Non Degree Trained Technician</label></td>
                <td><label>06 – PhD/PsyD/EdD – Licensed Practitioner</label></td>
                <td></td>
              </tr>
              </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">*FARS Problem Severity Rating Scales: </h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td colspan="10">
                  <label> Assign a severity Rating Number to each Section to describe the consumer’s problems or assets
                    during the last 3 weeks. Mark an “X” through this section if completing this form at the 3 or
                    9-month interval</label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>1.
                    No
                    Problem
                  </label>
                </td>
                <td>
                  <label>2.
                    Less Than
                    Slight

                  </label>
                </td>
                <td>
                  <label>3.
                    Slight
                    Problem
                  </label>
                </td>
                <td>
                  <label>4.
                    Slight to
                    Moderate
                  </label>
                </td>
                <td>
                  <label>5.
                    Moderate
                    Problem
                  </label>
                </td>
                <td>
                  <label>6.
                    Moderate to
                    Severe
                  </label>
                </td>
                <td>
                  <label>7.
                    Severe
                    Problem
                  </label>
                </td>
                <td>
                  <label>8.
                    Severe
                    Extreme
                  </label>
                </td>
                <td>
                  <label>9.
                    Extreme
                    Problem
                  </label>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="top-part ">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tr>
              <td>
                <label>a. *Depression:</label>
              </td>
              <td></td>
              <td>
                <label>f. *Medical/Physical:</label>
              </td>
              <td></td>
              <td>
                <label>k. *Family Environment:</label>
              </td>

              <td>
                <label>p. *Danger to Others:</label>
              </td>
              <td></td>
            </tr>
            <tr>
              <td>
                <label>b. *Anxiety:</label>
              </td>
              <td></td>
              <td>
                <label>g. *Traumatic Stress:</label>
              </td>
              <td></td>
              <td>
                <label>l. *ADL Functioning:</label>
              </td>

              <td>
                <label>q. *Danger to Self:</label>
              </td>
              <td></td>
            </tr>
            <tr>
              <td>
                <label>c. *Hyper Affective:</label>
              </td>
              <td></td>
              <td>
                <label>h. *Substance Abuse:</label>
              </td>
              <td></td>
              <td>
                <label>m. *Socio-Legal:</label>
              </td>

              <td>
                <label>r. *Security Management:</label>
              </td>
              <td></td>
            </tr>
            <tr>
              <td>
                <label>d. *Thought Process:</label>
              </td>
              <td></td>
              <td>
                <label>i. *Interpersonal Relationships:</label>
              </td>
              <td></td>
              <td>
                <label>n. *Work/School Perform:</label>
              </td>
              <td>
                <label></label>
              </td>
              <td></td>
            </tr>
            <tr>
              <td>
                <label>e. *Cognitive Performace</label>
              </td>
              <td></td>
              <td>
                <label>j. *Family Relationships:</label>
              </td>
              <td></td>
              <td>
                <label>o. *Ability to Care for Self:</label>
              </td>
              <td>
                <label></label>
              </td>
              <td></td>
            </tr>

          </table>
          <p class="title text-primary">(*Mandatory Fields)</p>
        </div>
        <div class="top-part ">
          <table cellpadding="0" cellspacing="0">
            <tr>
              <td>
                <label>CBH Representative:<input type="text"></label>
              </td>
              <td>
                  <label class="fs-6">(Print Name) <input type="text"></label>
              </td>
            </tr>
            <tr>
              <td>
                <label>CBH Representative Signature:
                  <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                </label>
              </td>
              <td>
                <label>Date: <input type="date">
                </label>
              </td>
            </tr>
          </table>
        </div>
        <div class="top-part ">
          <h5 class="title text-center">ADULT MH Outcomes/FARS Form Schedule</h5>
          <table cellpadding="0" cellspacing="0">
            <tr>
              <td class="text-center" colspan="2">
                <label>~ Upon admission or initiation – MH Outcomes and FARS Section Only</label>
              </td>
            </tr>
            <tr>
              <td class="text-center">
                <label>~ 3 months – MH OutcomesOnly</label>
              </td>
              <td class="text-center">
                <label>~ 6 months – MH Outcomes and FARS</label>
              </td>
            </tr>
            <tr>
              <td class="text-center">
                <label>~ 9 months – MH Outcomes Section Only</label>
              </td>
              <td class="text-center">
                <label>~ 12 months – MH Outcomes and FARS</label>
              </td>
            </tr>

          </table>
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
