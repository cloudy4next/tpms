<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Consent to Treatment/ Client Acknowledgement</title>
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
          <h1>Consent to Treatment/ Client Acknowledgement</h1>
        </div>
        <div class="top-part">
          <h5 class="title"><input type="text" placeholder="INITIAL HERE..."> Consent to Treatment</h5>
          <div>
            <p>I understand that all the information, including Client assessment, treatment notes, etc, are treated
              with
              strict confidentiality and that no information, either verbal or written, will be shared without the
              written
              consent of Client or legal guardian (if the Client is under the age of 18). I understand that individuals
              responsible for care through CLARITY BEHAVIORAL HEALTH will need to have access to confidential
              information
              for the purpose of assessment and treatment coordination. By law, rules of confidentiality do not hold
              under
              the following conditions:</p>
            <p class="font-weight-bold mt-3">1. If abuse or neglect of a minor, disabled, or elderly person is reported
              or
              suspected, the provider
              is legally required to report concern to the Department of Children and Families.</p>
            <p class="font-weight-bold">2. If during services, the professional receives information that someone’s life
              is in danger, that
              professional has a legal duty to warn the threatened individual.
            </p>
            <p class="font-weight-bold">3. If CLARITY BEHAVIORAL HEALTH or staff testimony is subpoenaed by Court Order,
              we are required to
              produce records or appear in court to answer questions about the client.</p>
          </div>
          <div class="mt-3">
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">I consent to treatment taking place at the
                following location(s):
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="yn">Home
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="yn">School
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="yn">Office
                  </label>
                </div>
              </label>
            </div>
          </div>
          <div class=" mt-3">
            <p class=" ml-5 mb-3 "><input type="text" placeholder="INITIAL HERE...">(Initial here) Financial
              Responsibility:
              I understand that I must disclose all insurance coverage. If failure to disclose results in a denied
              claim, I will be financially responsible.
            </p>
            <p class="mb-3"><input type="text" placeholder="INITIAL HERE...">(Initial here) ) I acknowledge that I have
              received a copy of CLARITY BEHAVIORAL HEALTH’ Notice of Privacy Practices.
            </p>
            <p class="mb-3"><input type="text" placeholder="INITIAL HERE...">(Initial here)I have received the Clarity
              Behavioral Health Client Handbook. I was given time to ask questions and I understand the answers that
              were given to me. The Client Handbook has information on the following subjects:
            </p>
            <ul class="mb-3">
              <li>Client Rights and Responsibilities/ CLARITY BEHAVIORAL HEALTH Rights and Responsibilities</li>
              <li>Client Rights and Responsibilities/ CLARITY BEHAVIORAL HEALTH Rights and Responsibilities</li>
              <li>Client Rights and Responsibilities/ CLARITY BEHAVIORAL HEALTH Rights and Responsibilities</li>
            </ul>

            <p class="mb-3"><input type="text" placeholder="INITIAL HERE...">(Initial here) I have been provided with a
              list of Recommendations for Emergencies After Hours.
            </p>
          </div>

          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td><label>Clarity Behavioral Health staff name:</label> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>Signature:</label> <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                </td>
                <td><label>Title:</label> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>Date:</label> <input type="date">
                </td>
              </tr>
              <tr>
                <td><label>Client Name: </label> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>Signature:</label> <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                </td>
                <td colspan="2"><label>Date:</label> <input type="date">
                </td>
              </tr>
              <tr>
                <td><label>Parent Name: </label> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>Signature:</label> <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                </td>
                <td colspan="2"><label>Date:</label> <input type="date">
                </td>
              </tr>
            </tbody>
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
