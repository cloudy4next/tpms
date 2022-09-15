<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Supervision Non-billable</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem14/')}}/css/custom-14.css">
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
        <h2>Supervision Non-billable</h2>
        <h1>SUPERVISION: REGISTERED BEHAVIOR TECHNICIAN</h1>
      </div>
      <form action="" method="POST" id="form_14">
        <section class="section_1 mb_30">
          <h3 class="mb-3">Client Information:</h3>
          <table cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td>
                  <div class="flex-div"><span>
                      <label for="clname">Client Name:</label>
                    </span> <span>
                      <input type="text" id="clname" name="clname">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="dob">DOB:</label>
                    </span> <span>
                      <input type="date" id="dob" name="dob">
                    </span></div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="flex-div"><span>
                      <label for="age">Age:</label>
                    </span> <span>
                      <input type="text" id="age" name="age">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="diagnosis">Diagnosis:</label>
                    </span> <span>
                      <input type="text" id="diagnosis" name="diagnosis">
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
                      <input type="text" id="supname" name="supname">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="regtech">Registered Behavior Technician's Name:</label>
                    </span> <span>
                      <input type="text" id="regtech" name="regtech">
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
                      <label for="sd">Service Date :</label>
                    </span> <span>
                      <input type="date" id="sd" name="sd">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="sst">Service Start Time:</label>
                    </span> <span>
                      <input type="time" id="sst" name="sst">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="set">Service End Time :</label>
                    </span> <span>
                      <input type="time" id="set" name="set">
                    </span></div>
                </td>
              </tr>
            </tbody>
          </table>
        </section>
        <section class="section_2 mb_30">
          <h3 class="mb-3">Parent Training Provided</h3>
          <ul class="list-inline">
            <li class="list-inline-item">
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="supprovide">In Person
                </label>
              </div>
            </li>
            <li class="list-inline-item">
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="supprovide">Remote
                </label>
              </div>
            </li>
          </ul>
        </section>
        <section class="section_2 mb_30">
          <div class="box box1 mb_30">
            <div class="col-title mb_15">
              <h3>
                <label for="pto">SUPERVISION Overview:</label>
              </h3>
            </div>
            <div class="textarea">
              <textarea id="pto" rows="5" name="supoverview"></textarea>
            </div>
          </div>
          <div class="box box2">
            <div class="col-title mb_15">
              <h3>
                <label for="fd">FEEDBACK FROM SUPERVISOR:</label>
              </h3>
            </div>
            <div class="textarea">
              <textarea id="fd" rows="5" name="supfeed"></textarea>
            </div>
          </div>
        </section>
        <section class="section_2 mb_30">
          <table cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td>
                  <div class="flex-div"><span>
                      <label for="pfn">Provider Full Name:</label>
                    </span> <span>
                      <input type="text" id="pfn" name="pfn">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="pcred">Provider Credentials:</label>
                    </span> <span>
                      <input type="text" id="pcred" name="pcred">
                    </span></div>
                </td>
              </tr>
            </tbody>
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
            <div class="mark-sign"><a href="#signatureModal" data-toggle="modal"><span class="mark-icon"><i
                    class="fas fa-check"></i></span> Mark Completed
                and Sign</a></div>
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
