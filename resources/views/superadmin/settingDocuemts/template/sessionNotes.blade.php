<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Session Notes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem13/')}}/css/custom-13.css">
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
        <h1>Session Notes </h1>
      </div>
      <form action="" method="POST" id="form_13">
        <section class="section_1 mb_30">
          <table cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td colspan="3">
                  <div class="flex-div"><span>
                      <label for="clname">Client Name:</label>
                    </span> <span>
                      <input type="text" id="clname" name="clname">
                    </span></div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="flex-div"><span>
                      <label for="sd">Service Date:</label>
                    </span> <span>
                      <input type="date" id="sd" name="sd">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="stime">Start Time:</label>
                    </span> <span>
                      <input type="time" id="stime" name="stime">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="etime">End Time:</label>
                    </span> <span>
                      <input type="time" id="etime" name="etime">
                    </span></div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="flex-div"><span>
                      <label for="units">Units:</label>
                    </span> <span>
                      <input type="number" id="units" name="units">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="sl">Service Location:</label>
                    </span> <span>
                      <input type="text" id="sl" name="sl">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="pxcode">PX Code:</label>
                    </span> <span>
                      <input type="text" id="pxcode" name="pxcode">
                    </span></div>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <label>All Service Code Descriptions </label>
                  <textarea rows="1" class="form-control" name="scd"></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </section>
        <section class="section_2 mb_30">
          <div class="col-title mb_30">
            <h3>Providers: </h3>
          </div>
          <table cellpadding="0" cellspacing="0">
            <tr>
              <td>
                <div class="flex-div">
                  <label for="on">Organization Name:</label>
                  <input type="text" id="on" name="on"></div>
              </td>
              <td>
                <div class="flex-div">
                  <label for="pname">Provider Name:</label>
                  <input type="text" id="pname" name="pname">
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="flex-div">
                  <label for="pcred">Provider Credentials:</label>
                  <input type="text" id="pcr" name="pcr">
                </div>
              </td>
              <td>
                <div class="flex-div">
                  <label for="pnpi">Provider NPI:</label>
                  <input type="text" id="pnpi" name="pnpi">
                </div>
              </td>
            </tr>
          </table>
        </section>
        <section class="section_2 mb_30">
          <div class="col-title mb_30">
            <h3>Procedures Used:</h3>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="skill">Skill Acquisition
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="social">Social Skill Acquisition
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="role">Role Play
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="prem">Premack Principle
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="stimu">Stimulus Prompts
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="modeling">Video Modeling
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="shaping">Shaping
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="contract">Behavior Contract
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="timer">Timer
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="tboard">Token Board
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="selfm">Self Monitor
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="dtt">DTT
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="antm">Antecedent Manipulation
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="selfmn">Self Management
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="diffrein">Differential Reinforcement
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="fct">FCT
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="vaid">Visual Aid
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="errorlearn">Errorless Learning
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="net">NET
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="chaining">Chaining
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="others">Others
            </label>
          </div>
          <textarea rows="1" class="form-control" placeholder="Explain.." name="other2"></textarea>
        </section>
        <section class="section_2 mb_30">
          <div class="col-title mb_30">
            <h3>Goals for Session: </h3>
          </div>
          <table cellpadding="0" cellspacing="0">
            <tr>
              <td class="text-left">
                <label>Service Type:</label>
                <input type="text" name="stype">
              </td>
            </tr>
            <tr>
              <td class="text-left">
                <label>Session Notes:</label>
                <div class="textarea">
                  <textarea id="activities" rows="5" name="sessionnotes"></textarea>
                </div>
              </td>
            </tr>
          </table>
        </section>
        <section class="section_2 mb_30">
          <div class="col-title mb_30">
            <h3>Session Summary: </h3>
          </div>
          <div class="textarea">
            <textarea id="activities" rows="5" name="ssummary"></textarea>
          </div>
        </section>
        <section class="section_2 mb_30">
          <div class="col-title mb_30">
            <h3>Providers: </h3>
          </div>
          <table cellpadding="0" cellspacing="0">
            <tr>
              <td>
                <div class="flex-div">
                  <label for="provider_name">Provider Name :</label>
                  <input type="text" id="provider_name" name="provider_name"></div>
              </td>
              <td>
                <div class="flex-div">
                  <label for="pcredent">Provider Credentials :</label>
                  <input type="text" id="pcredent" name="pcredent">
                </div>
              </td>
            </tr>
          </table>
          <ul class="list-inline mt-3">
            <li class="list-inline-item">
              <a href="#" data-target="#signatureModal" data-toggle="modal">Provider Signature<i class="fa fa-signature"></i></a>
            </li>
            <li class="list-inline-item float-right">
              <a href="#" data-target="#signatureModal2" data-toggle="modal">Caregiver Signature<i class="fa fa-signature"></i></a>
            </li>
          </ul>
        </section>
        <section class="section_bottom">
          <div class="button-row flex-div">
            <div class="save-prog"><button type="button"><span class="cloud-icon"><i class="fas fa-cloud"></i></span>
                Save</button></div>
            <div class="print"><button type="button"><span class="print-icon"><i
                    class="fas fa-print"></i></span>Print</button></div>
            
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
