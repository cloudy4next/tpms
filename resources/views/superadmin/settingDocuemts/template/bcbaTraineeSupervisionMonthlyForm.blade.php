<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>BCBA Trainee Supervision Monthly Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/temthree/')}}/css/custom-3.css">
</head>

<body>
<div class="bcba-sup-monthly">
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
            <h1>BCBA Trainee Supervision Monthly Form</h1>
        </div>
        <form action="#">
            <section class="section_1 mb_30">
                <table cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="date">Date:</label>
                    </span> <span>
                      <input type="date" id="date" name="date">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="time">Time:</label>
                    </span> <span>
                      <input type="text" id="time" name="time">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="trainee">Trainee:</label>
                    </span> <span>
                      <input type="text" id="trainee" name="trainee">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="restrict-hours">Restricted Hours:</label>
                    </span> <span>
                      <input type="text" id="restrict-hours" name="restrict-hours">
                    </span></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="setting">Setting:</label>
                    </span> <span>
                      <input type="text" id="setting" name="setting">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="num-client">Number of Clients:</label>
                    </span> <span>
                      <input type="text" maxlength="5" id="num-client" name="num-client">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="c-purchaging">Credential Pursuing:</label>
                    </span> <span>
                      <input type="text" id="c-purchaging" name="c-purchaging">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="unrestrict-hours">Unrestricted Hours:</label>
                    </span> <span>
                      <input type="text" id="unrestrict-hours" name="unrestrict-hours">
                    </span></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="supervising-bcba">Supervising BCBA: </label>
                    </span> <span>
                      <input type="text" id="supervising-bcba" name="supervising-bcba">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="bcba">BCBA: </label>
                    </span> <span>
                      <input type="text" maxlength="5" id="bcba" name="bcba">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="no-hour-i">Number of Hours Independent <span class="red">(without supervisor
                          present)</span>:</label>
                    </span> <span>
                      <input type="text" id="no-hour-i" name="no-hour-i">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="no-hs">Number of Hours Supervised:</label>
                    </span> <span>
                      <input type="text" id="no-hs" name="no-hs">
                    </span></div>
                        </td>
                    </tr>
                    <!-- <tr>
                    <td colspan="4"><div class="flex-div"><span>
                        <label for="no-hour-s">Total Number of Hours for Supervisory Period: </label>
                        </span> <span>
                        <input type="text="no-hour-s" name="no-hour-s">
                        </span></div></td>
                  </tr>-->
                    </tbody>
                </table>
            </section>
            <section class="section_2 mb_30">
                <div class="box box1 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="topic-feedback">Topics/Feedback Discussed in Supervision/Follow up:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="topic-feedback" rows="5"></textarea>
                    </div>
                </div>
                <div class="box box2">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="needs">Task List Items Covered:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="needs" rows="5"></textarea>
                    </div>
                </div>
            </section>
            <section class="section_3">
                <div class="box box-last_2">
                    <div class="flex-div mb_40">
                        <div class="col-item">
                            <div class="holder-div">
                                <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                                <br>
                                <span>
                    <label for="bacb-sign">Supervisee/BACB ID#</label>
                    <input maxlength="4" type="text">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="holder-div">
                                <input id="bacb-sign-date" type="date">
                                <br>
                                <label for="bacb-sign-date">Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="flex-div">
                        <div class="col-item">
                            <div class="holder-div">
                                <a href="#" data-target="#signatureModal2" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                                <br>
                                <span>
                    <label for="suupervisor-sign">Supervisor/BACB ID#</label>
                    <input maxlength="4" type="text">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="holder-div">
                                <input id="suupervisor-sign-date" type="date">
                                <br>
                                <label for="suupervisor-sign-date">Date</label>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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

<!-- Jq Files -->
<script src="{{asset('assets/dashboard//')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/bootstrap.min.js"></script>
@include('superadmin.appoinment.include.forms_js_include')
</body>

</html>
