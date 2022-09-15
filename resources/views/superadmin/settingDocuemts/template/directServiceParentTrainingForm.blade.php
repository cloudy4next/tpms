<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Direct-Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/temtwo/')}}/css/custom-2.css">
</head>

<body>
<div class="parent-training">
    <header>
        <div class="flex-div">
            <div class="col-item">
                <div class="logo"><a href="#"><img
                            src="{{asset('assets/dashboard/template/')}}/logo4.png"
                            alt=""></a></div>
            </div>
            <div class="col-item">
              <div class="info-details">
                <ul>
                  <li> <span>Mail:</span>demo@example.com</li>
                  <li><a href="#"> <span>Email:</span>demo@example.com</a></li>
                  <li><span>Phone:</span> 000-000-0000</li>
                  <li><a href="#"><span>Fax:</span>000.000.0000</a></li>
                </ul>
              </div>
            </div>
        </div>
    </header>
    <div class="content">
        <div class="page-title mb_40">
            <h1>Direct-Service <br>
                Parent Training Note </h1>
        </div>
        <form action="#">
            <section class="section_1 mb_30">
                <table cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="child-name">Child Name:</label>
                    </span> <span>
                      <input type="text" id="child-name" name="child-name">
                    </span></div>
                        </td>
                        <td colspan="2">
                            <div class="flex-div"><span>
                      <label for="attendens">Attendees:</label>
                    </span> <span>
                      <input type="text" id="attendens" name="attendens">
                    </span></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="start-time">Start Time:</label>
                    </span> <span>
                      <input type="time" id="start-time" name="start-time">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="End-time">End Time:</label>
                    </span> <span>
                      <input type="time" id="end-time" name="end-time">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="date">Date:</label>
                    </span> <span>
                      <input type="date" id="date" name="date">
                    </span></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_2 mb_30">
                <div class="col-title mb_30">
                    <h3>Goals for Session: </h3>
                    <span class="red">Check the box to the left of one or more goals that apply to this session</span>
                </div>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <input id="1st-row" type="checkbox" checked="checked" name="goals-for-session">
                        </td>
                        <td><label for="1st-row">Explained specific behavior analytic concept / technique /
                                procedure</label></td>
                    </tr>
                    <tr>
                        <td>
                            <input id="2st-row" type="checkbox" name="goals-for-session">
                        </td>
                        <td><label for="2st-row">Role played new procedure / technique</label></td>
                    </tr>
                    <tr>
                        <td>
                            <input id="3st-row" type="checkbox" name="goals-for-session">
                        </td>
                        <td><label for="3st-row">Gave performance feedback to parent on implementation</label></td>
                    </tr>
                    <tr>
                        <td>
                            <input id="4st-row" type="checkbox" name="goals-for-session">
                        </td>
                        <td><label for="4st-row">Modified / created new goal based on parent information</label></td>
                    </tr>
                    <tr>
                        <td>
                            <input id="5st-row" type="checkbox" name="goals-for-session">
                        </td>
                        <td><label for="5st-row">Modeled protocol with child (if child present (0368T/0369T)</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="6st-row" type="checkbox" name="goals-for-session">
                        </td>
                        <td><label for="6st-row">Other: </label></td>
                    </tr>
                </table>
            </section>
            <section class="section_2 mb_30">
                <div class="box box1 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="activities">Activities:</label>
                        </h3>
                        <span class="red">What activities did you engage in to help the client move closer to his/her goals
                through
                parent training? What materials did you use? A general summary will suffice.</span>
                    </div>
                    <div class="textarea">
                        <textarea id="activities" rows="5"></textarea>
                    </div>
                </div>
                <div class="box box2">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="needs">Needs:</label>
                        </h3>
                        <span class="red">What activities did you engage in to help the client move closer to his/her goals
                through
                parent training? What materials did you use? A general summary will suffice.</span>
                    </div>
                    <div class="textarea">
                        <textarea id="needs" rows="5"></textarea>
                    </div>
                </div>

            </section>
            <ul class="list-inline mt-3">
                    <li class="list-inline-item">
                      <a href="#" data-target="#signatureModal" data-toggle="modal">Provider Signature<i class="fa fa-signature"></i></a>
                    </li>
                    <li class="list-inline-item float-right">
                      <a href="#" data-target="#signatureModal2" data-toggle="modal">Caregiver Signature<i class="fa fa-signature"></i></a>
                    </li>
                  </ul>
            <section class="section_bottom">
                <div class="button-row flex-div">
                    <div class="save-prog">
                        <button type="button"><span class="cloud-icon"><i class="fas fa-cloud"></i></span>
                            Save
                        </button>
                    </div>
                    <div class="print">
                        <button type="button"><span class="print-icon"><i
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
        <section class="footer-section">
        <div class="flex-div">
          <div class="col-item">
            <p><strong>Demo Institution</strong> somewhere in america</p>
          </div>
          <div class="col-item">
            <p> <a href="tel:000-000-0000">Phone: 000-000-0000,</a> &nbsp;<a href="mailto:">
                <span>Email:</span> demo@example.com,</a>&nbsp; <a href="fax:000.000.0000"> Fax:
                000.000.0000,</a>&nbsp; <a href="https://example.com/">example.com</a> </p>
          </div>
        </div>
      </section>
    </div>
</div>
<!-- signature modal -->
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
                        </div>
                        <button type="button" class="btn btn-danger p-2" id="sig-clearBtn">Clear</button>
                    </div>
                    <div class="tab-pane fade" id="uploadsig">
                        <label>Upload File</label>
                        <input type="file" class="form-control-file">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary">Save
                    Signature
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--/ signature modal -->
<!-- Jq Files -->
<script src="{{asset('assets/dashboard//')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/bootstrap.min.js"></script>
@include('superadmin.appoinment.include.forms_js_include')
</body>

</html>
