<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Supervision Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem15/')}}/css/custom-15.css">
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
        <h2>Supervision Form</h2>
        <h1>SUPERVISION: REGISTERED BEHAVIOR TECHNICIAN</h1>
      </div>
      <form action="" method="post" id="form_15">
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
                <td>
                  <div class="flex-div"><span>
                      <label for="age">Age:</label>
                    </span> <span>
                      <input type="text" id="age" name="age">
                    </span></div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="flex-div"><span>
                      <label for="cldiag">Claims Diagnosis:</label>
                    </span> <span>
                      <input type="text" id="cldiag" name="cldiag">
                    </span></div>
                </td>
                <td colspan="2">
                  <div class="flex-div"><span>
                      <label for="insured">Insured Id:</label>
                    </span> <span>
                      <input type="text" id="insured" name="insured">
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
                      <label for="sd">Session Date:</label>
                    </span> <span>
                      <input type="date" id="sd" name="sd">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="sst">Start Time:</label>
                    </span> <span>
                      <input type="time" id="sst" name="sst">
                    </span></div>
                </td>
                <td>
                  <div class="flex-div"><span>
                      <label for="set">End Time :</label>
                    </span> <span>
                      <input type="time" id="set" name="set">
                    </span></div>
                </td>
              </tr>
            </tbody>
          </table>
        </section>
        <section class="section_2 mb_30">
          <h3 class="mb-3">Supervision provided</h3>
          <ul class="list-inline">
            <li class="list-inline-item">
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="supprovide">In Person
                </label>
              </div>
            </li>
            <li class="list-inline-item">
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="supprovide">Remote
                </label>
              </div>
            </li>
          </ul>
        </section>
        <section class="section_2 mb_30 rbt">
          <h3 class="mb-3 text-center">RBT® TASK LIST ITEMS</h3>
          <ol style="list-style-type:upper-alpha;">
            <li>
              <span class="text-danger">Measurement</span>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="a_1">A-1 Prepare for data collection
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="a_2">A-2 Implement continuous measurement procedures (e.g.,
                  frequency, duration)
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="a_3">A-3 Implement discontinuous measurement procedures
                  (e.g., partial & whole interval, momentary time sampling)
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="a_4">A-4 Implement permanent-product recording procedures
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="a_5">A-5 Enter data and update graphs
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="a_6">A-6 Describe behavior and environment in observable
                  and
                  measurable terms
                </label>
              </div>
            </li>
            <li>
              <span class="text-danger">Assessment</span>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="b_1">B-1 Conduct preference assessments
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="b_2">B-2 Assist with individualized assessment procedures
                  (e.g., curriculum-based, developmental, social skills)
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="b_3">B-3 Assist with functional assessment procedures
                </label>
              </div>
            </li>
            <li>
              <span class="text-danger">Skill Acquisition</span>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="c_1">C-1 Identify the essential components of a written
                  skill
                  acquisition plan
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="c_2">C-2 Prepare for the session as required by the skill
                  acquisition plan
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="c_3">C-3 Use contingencies of reinforcement (e.g.,
                  conditioned/unconditioned reinforcement,
                  continuous/intermittent schedules).
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="c_4">C-4 Implement discrete-trial teaching procedures
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="c_4">C-5 Implement naturalistic teaching procedures (e.g.,
                  incidental teaching)
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="c_6">C-6 Implement task analyzed chaining procedures.
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="c_7">C-7 Implement discrimination training
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="c_8">C-8 Implement stimulus control transfer procedures
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="c_9">C-9 Implement prompt and prompt fading procedures
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="c_10">C-10 Implement generalization and maintenance
                  procedures
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="c_11">C-11 Implement shaping procedures
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="c_12">C-12 Implement token economy procedures
                </label>
              </div>
            </li>
            <li>
              <span class="text-danger">Behavior Reduction</span>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="d_1">D-1 Identify essential components of a written
                  behavior
                  reduction plan
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="d_2">D-2 Describe common functions of behavior
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="d_3">D-3 Implement interventions based on modification of
                  antecedents such as motivating operations
                  and discriminative stimuli
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="d_4">D-4 Implement differential reinforcement procedures
                  (e.g., DRA, DRO).
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="d_5">D-5 Implement extinction procedures
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="d_6">D-6 Implement crisis/emergency procedures according to
                  protocol
                </label>
              </div>
            </li>
            <li>
              <span class="text-danger">E-Documentation and Reporting</span>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="e_1">E-1 Effectively communicate with a supervisor in an
                  ongoing manner
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="e_2">E-2 Actively seek clinical direction from supervisor
                  in
                  a timely manner
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="e_3">E-3 Report other variables that might affect the
                  client
                  in a timely manner
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="e_4">E-4 Generate objective session notes for service
                  verification by describing what occurred during the sessions, in
                  accordance with applicable legal, regulatory, and workplace requirements.
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="e_5">E-5 Comply with applicable legal, regulatory, and
                  workplace data collection, storage, transportation, and
                  documentation requirements
                </label>
              </div>
            </li>
            <li>
              <span class="text-danger">Professional Conduct and Scope of Practice</span>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="f_1">F-1 Describe the BACB’s RBT supervision requirements
                  and
                  the role of RBTs in the service-delivery system.
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="f_2">F-2 Respond appropriately to feedback and maintain or
                  improve performance accordingly
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="f_3">F-3 Communicate with stakeholders (e.g., family,
                  caregivers, other professionals) as authorized
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="f_4">F-4 Maintain professional boundaries (e.g., avoid dual
                  relationships, conflicts of interest, social media contacts).
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="f_5">F-5 Maintain client dignity
                </label>
              </div>
            </li>
          </ol>
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
                <label for="fd">Feedback to SUPERVISEr:</label>
              </h3>
            </div>
            <div class="textarea">
              <textarea id="fd" rows="5" name="supfeed"></textarea>
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
