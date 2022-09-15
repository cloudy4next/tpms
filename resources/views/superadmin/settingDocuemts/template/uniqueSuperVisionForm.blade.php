<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unique Supervision Form</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/temone/')}}/css/custom-1.css">
</head>

<body>
<div class="uniq-supervisim-form">
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
            <h1>Unique Supervision Form</h1>
        </div>
        <form action="#">
            <section class="section_1 mb_30">
                <table cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="clname">Trainee:</label>
                    </span> <span>
                      <input type="text" id="clname" name="clname">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="start-time">Start Time:</label>
                    </span> <span>
                      <input type="time" id="start-time" name="start-time">
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
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="supervisor">Supervisor:</label>
                    </span> <span>
                      <input type="text" id="supervisor" name="supervisor">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="end-time">End Time:</label>
                    </span> <span>
                      <input type="time" id="end-time" name="end-time">
                    </span></div>
                        </td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_2 mb_30">
                <div class="flex-div">
                    <div class="col-item">
                        <div class="box box1 mb_30">
                            <table>
                                <thead>
                                <tr>
                                    <th colspan="2">Independent Hours</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><label for="experience">Experience Type</label></td>
                                    <td><input id="experience" type="text" name="experience"></td>
                                </tr>
                                <tr>
                                    <td><label for="setting-name">Setting Name</label></td>
                                    <td><input id="setting-name" type="text" name="setting-name"></td>
                                </tr>
                                <tr>
                                    <td><label for="setting-name">Activity Category</label></td>
                                    <td>
                                        <div class="flex-div select-area"><span>
                            <input id="restricted" type="radio" name="activity-category">
                            <label for="restricted">Restricted</label>
                          </span> <span>
                            <input id="unrestricted" type="radio" name="activity-category">
                            <label for="unrestricted">Unrestricted</label>
                          </span></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="textarea-part" colspan="2"><label for="activity-note">Activity Note <span
                                                class="bracket">(client Initials):</span></label>
                                        <br>
                                        <div class="textarea">
                                            <textarea id="activity-note" rows="5"></textarea>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="box box2 mb_30">
                            <table>
                                <thead>
                                <tr>
                                    <th colspan="2">Month Supervision Period</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><label for="total-hours">Total Hours of Supervision:</label></td>
                                    <td><input id="total-hours" type="time" name="total-hours"></td>
                                </tr>
                                <tr>
                                    <td><label for="total-contacts">Total Number of Contacts:</label></td>
                                    <td><input id="total-contacts" type="text" maxlength="4" name="total-contacts"></td>
                                </tr>
                                <tr>
                                    <td><label for="individual2">Individual:</label></td>
                                    <td><input id="individual2" type="text" name="individual2"></td>
                                </tr>
                                <tr>
                                    <td><label for="group2">Group:</label></td>
                                    <td><input id="group2" type="text" name="group2"></td>
                                </tr>
                                <tr>
                                    <td><label for="trainee-with-clnt">Total number of Observations of the Trainee with
                                            Clients:</label>
                                    </td>
                                    <td><input id="trainee-with-clnt" type="text" name="trainee-with-clnt"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-item">
                        <table>
                            <thead>
                            <tr>
                                <th colspan="2">Supervised Hours:</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><label>Format:</label></td>
                                <td>
                                    <div class="flex-div select-area"> <span>
                          <input id="person" type="radio" name="formate">
                          <label for="person">person</label>
                        </span> <span>
                          <input id="online" type="radio" name="formate">
                          <label for="online">Online</label>
                        </span></div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="experience-2">Experience Types </label></td>
                                <td><input id="experience-2" type="text" name="experience-2"></td>
                            </tr>
                            <tr>
                                <td><label>Supervision Type</label></td>
                                <td>
                                    <div class="flex-div select-area"><span>
                          <input id="supervision-type" type="radio" name=">Supervision Type">
                          <label for="supervision-type">Individual</label>
                        </span> <span>
                          <input id="supervision-group" type="radio" name=">Supervision Type">
                          <label for="supervision-group">Group</label>
                        </span></div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Activity Category</label></td>
                                <td>
                                    <div class="flex-div select-area"> <span>
                          <input id="restricted2" type="radio" name="activity-category2">
                          <label for="restricted2">Restricted</label>
                        </span> <span>
                          <input id="unrestricted2" type="radio" name="activity-category2">
                          <label for="unrestricted2">Unrestricted</label>
                        </span></div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="bst-task">BST - Task List Item: </label></td>
                                <td><input id="bst-task" type="text" name="bst-task"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="textarea-part">
                                        <label for="summery-supervision">Summary of Supervision Activities:</label>
                                        <br>
                                        <div class="textarea">
                                            <textarea id="summery-supervision" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="textarea-part">
                                        <label for="supervision-feedback">Supervisor Feedback: </label>
                                        <br>
                                        <div class="textarea">
                                            <textarea id="supervision-feedback" rows="3"></textarea>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="action-item">Action Items (Homework/research):</label></td>
                                <td><input id="action-item" type="text" name="action-item"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="section_3">
                <div class="box box-last_2">
                    <div class="flex-div mb_40">
                        <div class="col-item">
                            <div class="holder-div">
                                <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i
                                class="fa fa-signature"></i></a>
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
                                <a href="#" data-target="#signatureModal2" data-toggle="modal">Add Signature<i
                                class="fa fa-signature"></i></a>
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
                        <button type="button" class="btn"><span class="cloud-icon"><i
                                    class="fas fa-cloud"></i></span> Save
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
<script src="{{asset('assets/dashboard/')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/bootstrap.min.js"></script>
@include('superadmin.appoinment.include.forms_js_include')
</body>

</html>
