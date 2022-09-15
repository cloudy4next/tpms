<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Supervision Note</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/temfive/')}}/css/custom-5.css">
</head>

<body>
<div class="monthly-sup-note">
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
            <h1>Monthly Supervision Note</h1>
        </div>
        <form action="#">
            <section class="section_1">
                <div class="box box_1">
                    <div class="flex-div row-flex div_33 mb_30">
                        <div class="col-item">
                            <div class="flex-div"> <span>
                    <label for="clname">Client Name:</label>
                  </span> <span>
                    <input id="clname" type="text" name="clname">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div"> <span>
                    <label for="date">Date:</label>
                  </span> <span>
                    <input id="date" type="date" name="date">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div"> <span>
                    <label for="time">Time:</label>
                  </span> <span>
                    <input id="time" type="time" name="time">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div"> <span>
                    <label for="rbt">RBT(s) Supervised:</label>
                  </span> <span>
                    <input id="rbt" type="text" name="rbt">
                  </span></div>
                        </div>
                        <div class="flex-div row-flex row2">
                            <div class="col-item">
                                <div class="flex-div">
                                    <div>
                                        <label>Format:</label>
                                    </div>
                                    <div class="check-box-area">
                                        <ul>
                                            <li><span>
                            <input id="in-person" type="checkbox" name="format">
                          </span><span>
                            <label for="in-person">In-person</label>
                          </span></li>
                                            <li><span>
                            <input id="remote" type="checkbox" name="format">
                          </span> <span>
                            <label for="remote">Remote</label>
                          </span></li>
                                            <li><span>
                            <input id="group" type="checkbox" name="format">
                          </span> <span>
                            <label for="group">Group</label>
                          </span></li>
                                            <li><span>
                            <input id="team-meeting" type="checkbox" name="format">
                          </span> <span>
                            <label for="team-meeting">Team Meeting</label>
                          </span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-div row-flex row2 mb_30">
                            <div class="col-item">
                                <div class="flex-div">
                                    <div>
                                        <label>Activities:</label>
                                    </div>
                                    <div class="check-box-area">
                                        <ul>
                                            <li><span>
                            <input id="data-review" type="checkbox" name="activities">
                          </span><span>
                            <label for="data-review">Data Review</label>
                          </span></li>
                                            <li><span>
                            <input id="observation" type="checkbox" name="activities">
                          </span> <span>
                            <label for="observation">Observation</label>
                          </span></li>
                                            <li><span>
                            <input id="protocol" type="checkbox" name="activities">
                          </span> <span>
                            <label for="protocol">Protocol Demonstration/Modification</label>
                          </span></li>
                                            <li><span>
                            <input id="ateam-meeting" type="checkbox" name="activities">
                          </span> <span>
                            <label for="ateam-meeting">Team Meeting</label>
                          </span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section_2">
                <div class="box box1 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="goal-reviews">Goals Reviewed <span class="bracket red">(fill in progress
                    update)</span>:</label>
                        </h3>
                    </div>
                    <div class="textarea mb_30">
                        <textarea id="goal-reviews" rows="5"></textarea>
                    </div>
                </div>
                <div class="box box2">
                    <div class="flex-div row-flex row2 mb_30">
                        <div class="col-item">
                            <div class="flex-div">
                                <div>
                                    <label>Overall Response to Treatment:</label>
                                </div>
                                <div class="check-box-area">
                                    <ul>
                                        <li><span>
                          <input id="making-progress" type="checkbox" name="response-treat">
                        </span><span>
                          <label for="making-progress">Making Progress</label>
                        </span></li>
                                        <li><span>
                          <input id="regression" type="checkbox" name="response-treat">
                        </span> <span>
                          <label for="regression">Regression</label>
                        </span></li>
                                        <li><span>
                          <input id="maintaining" type="checkbox" name="response-treat">
                        </span> <span>
                          <label for="maintaining">Maintaining</label>
                        </span></li>
                                        <li><span>
                          <input id="maintaining-n/a" type="checkbox" name="response-treat">
                        </span> <span>
                          <label for="maintaining-n/a">N/A</label>
                        </span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box3">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="feedback">Feedback / Suggestions:</label>
                        </h3>
                    </div>
                    <div class="textarea mb_30">
                        <textarea id="feedback" rows="5"></textarea>
                    </div>
                </div>
                <div class="box box4">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="p-concern-discus">Parent/Caregiver Concerns Discussed:</label>
                        </h3>
                    </div>
                    <div class="textarea mb_30">
                        <textarea id="p-concern-discus" rows="5"></textarea>
                    </div>
                </div>
                <div class="box box5">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="p-concern-discus"><b> Did RBT</b> provide services in accordance with BACB
                                Guidelines for
                                Responsible Conduct for Behavior Analysts?</label>
                        </h3>
                        <div class="check-box-area">
                            <ul>
                                <li><span>
                      <input id="rbt-yes" type="radio" name="did-rbt">
                    </span><span>
                      <label for="rbt-yes">Yes</label>
                    </span></li>
                                <li><span>
                      <input id="rbt-no" type="radio" name="did-rbt">
                    </span> <span>
                      <label for="rbt-no">No</label>
                    </span></li>
                            </ul>
                        </div>
                        <span class="bracket red">If no, please explain conduct and actions taken on back</span>
                    </div>
                    <div class="textarea mb_30">
                        <textarea id="p-concern-discus" rows="5"></textarea>
                    </div>
                </div>
            </section>
            <div class="section_3">
                <div class="flex-div row-flex div_33 mb_30">
                    <div class="col-item">
                        <div class="flex-div"> <span>
                  <label for="supervisor-sign">Supervisor Signature:</label>
                </span> <span>
                  <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                </span></div>
                    </div>
                    <div class="col-item">
                        <div class="flex-div"> <span>
                  <label for="supervisor-name">Name:</label>
                </span> <span>
                  <input id="supervisor-name" type="text" name="supervisor-name">
                </span></div>
                    </div>
                    <div class="col-item">
                        <div class="flex-div"> <span>
                  <label for="sign-date">Date:</label>
                </span> <span>
                  <input id="sign-date" type="date" name="sign-date">
                </span></div>
                    </div>
                </div>
            </div>
            <section class="section_bottom">
                <div class="button-row flex-div">
                    <div class="save-prog">
                        <button type="button"><span class="cloud-icon"><i class="fas fa-cloud"></i></span> Save</button>
                    </div>
                    <div class="print">
                        <button type="button"><span class="print-icon"><i class="fas fa-print"></i></span>Print</button>
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

<!-- Jq Files -->
<script src="{{asset('assets/dashboard//')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/bootstrap.min.js"></script>


@include('superadmin.appoinment.include.forms_js_include')
</body>

</html>
