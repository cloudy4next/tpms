<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Release of Information from CBH to Other Organization</title>
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
                    <h1>Release of Information from CBH to Other Organization</h1>
                </div>
                <div class="top-part">
                    <p>I, <input type="text" class="border-primary border-bottom">(print name of Client or
                        parent/guardian, if minor child), hereby authorize: CBH, Inc. - <input type="text"
                            class="border-primary border-bottom"> (print name of CBH staff)</p>
                    <p>To release information consisting of (indicate the specific information that may be released,
                        i.e. Psychiatric, Medical Records or Information; Social History, Psychological Records or
                        Information, Educational or School Records, etc) <span class="font-weight-bold">LIST
                            SPECIFICALLY WHAT YOU WANT RELEASED:</span></p>
                </div>
                <div class="top-part">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Assessment (Type and Date):</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Treatment Plan/Review (Type and Date):</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Summary (Type and Date):</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Behavioral Analysis (Type and Date):</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Other Testing (Type and Date):</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Other (Explain):</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Regarding:</label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="r" class="form-check-input">Myself
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="r" class="form-check-input">Minor Child
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="r" class="form-check-input">Other(Explain)
                                        </label>
                                    </div>
                                    <input type="text" class="border-bottom border-primary">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Check one:</label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Child Name
                                        </label>
                                    </div>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Date of Birth
                                        </label>
                                    </div>
                                    <input type="date">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">For the purpose of assisting with diagnosis, treatment, or rehabilitation to:</h5>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <label>Enter Name and Address of Organization to whom the information is being
                                        released:</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <p>I understand that only the above specified information can be disclosed by the above specified
                        organization.</p>
                    <p>This information has been disclosed to you from the records protected by Federal confidentiality
                        rules (42 CFR part 2). The federal rules prohibit you from making any further disclosure of this
                        information unless further disclosure is expressly permitted by the 42 CFR part 2. A general
                        authorization for the release of medical or other information is not sufficient for this
                        purpose.</p>
                    <p>This consent or authorization for release of information shall be effective the date of signature
                        and shall expire one year from the date of signature, which is (enter date) <input type="date"
                            class="border-bottom border-primary">, or at the time services are concluded if before one
                        year, or at anytime if revoked by the Client and/or parent/guardian. I also understand that I
                        may revoke this consent or authorization at anytime, providing I notify the program in writing
                        to this effect. Revocation has no effect on action previously taken.</p>
                </div>
                <div class="top-part">
                    <h5 class="title">For the purpose of assisting with diagnosis, treatment, or rehabilitation to:</h5>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Client’s Name:</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <input type="date" placeholder="Enter here..">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Parent/Guardian’s Name:</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <input type="date">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Witness Name:</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <input type="date">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="#" data-target="#signatureModal" data-toggle="modal">Client’s Signature<i class="fa fa-signature"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" data-target="#signatureModal" data-toggle="modal">Guardian’s Signature<i class="fa fa-signature"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" data-target="#signatureModal" data-toggle="modal">Witness Signature<i class="fa fa-signature"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="top-part">
                    <p>If the Client has difficulty understanding or reading this document, please print the name of the
                        person who read this document or explained it to the Client in the field above. (include
                        signature and date). </p>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>CBH Staff Name:</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <input type="date" placeholder="Enter here..">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="#" data-target="#signatureModal" data-toggle="modal">CBH Staff Signature<i class="fa fa-signature"></i></a>
                </div>
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
