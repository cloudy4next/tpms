<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Behavior Analysis Progress Note</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/')}}/form-style.css">
</head>

<body>
<div class="treatment-plan">
    <div class="content">
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
        <!-- headers -->
            <form action="#">
                <div class="page-title mb_40">
                    <h1>Behavior Analysis Progress Note</h1>
                </div>
                <div class="top-part">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td><label>Client Name:</label> <input type="text" placeholder="Enter Here..."></td>
                                <td><label>DOB:</label> <input type="date"></td>
                            </tr>
                            <tr>
                                <td><label>Authorization Period:</label> <input type="text" placeholder="Enter Here...">
                                <td><label>Staff Name and Credential:</label> <input type="text"
                                        placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Insurance:</label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Medicaid
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Private Pay
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Other
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label>Total Authorized Units:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Date:</label>
                                    <input type="date" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Time In:</label>
                                    <input type="time" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Time Out:</label>
                                    <input type="time" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Total Units:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Target Behaviors for Decease:</label>
                                    <div class="flex-div first"><span></span> <span>
                                            <textarea class="form-control"
                                                placeholder="Enter Here..."></textarea></span>
                                    </div>
                                </td>
                                <td>
                                    <label>Rate during session:</label>
                                    <div class="flex-div first"><span></span> <span>
                                            <textarea class="form-control"
                                                placeholder="Enter Here..."></textarea></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Training Addressed During Session:</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Functional Communication
                                            Training
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Role Modeling
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Social Skill Training
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Parent Training
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Shaping
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Planned Ignore
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Task Analysis
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Token Economy
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Positive Reinforcement
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Environmental Modifications
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Response Blocking
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Tolerance Training
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Extinction
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Other
                                        </label>
                                    </div>
                                    <textarea class="form-control border border-primary" placeholder="Explain.."></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Individualized Behavioral Goals :</label>
                                    <div class="flex-div first"><span></span> <span>
                                            <textarea class="form-control"
                                                placeholder="Enter Here..."></textarea></span>
                                    </div>
                                </td>
                                <td>
                                    <label>Current Rate/Percentage:</label>
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
                    <h5 class="title">Session Information/Progress:</h5>
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
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>BCBA/BCABA/RBT/BA Credentials:</label>
                                    <input type="text" placeholder="Enter Here..">
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <input type="date">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
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
            <p><strong>Demo Institution</strong> somewhere in america</p>
          </div>
          <div class="col-item">
            <p> <a href="tel:000-000-0000">Phone: 000-000-0000,</a> &nbsp;<a href="mailto:">
                <span>Email:</span> demo@example.com,</a>&nbsp; <a href="fax:000.000.0000"> Fax:
                000.000.0000,</a>&nbsp; <a href="https://example.com/">example.com</a> </p>
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
