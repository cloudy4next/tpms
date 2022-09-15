<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>LOCUS WORKSHEET</title>
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
                    <h1>LOCUS WORKSHEET</h1>
                </div>
                <div class="top-part">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Rater Name:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <input type="date" placeholder="Enter Here...">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <p>Please check the applicable ratings within each dimension and record the score in the lower right
                        hand corner. Total
                        your score and determine the recommended level of care.</p>
                </div>
                <div class="top-part">
                    <ol style="list-style-type: lower-roman;">
                        <div class="row">
                            <div class="col-md-6">
                                <li>Risk of Harm
                                    <ol>
                                        <li>Minimal Risk of Harm</li>
                                        <li>Low Risk of Harm</li>
                                        <li>Moderate Risk of Harm</li>
                                        <li>Serious Risk of Harm</li>
                                        <li>Extreme Risk of Harm</li>
                                    </ol>
                                    <p>Score: <input type="text" class="border-bottom border-primary"></p>
                                </li>
                            </div>
                            <div class="col-md-6">
                                <li>Functional Status
                                    <ol>
                                        <li>Minimal Impairment</li>
                                        <li>Mild Impairment</li>
                                        <li>Moderate Impairment</li>
                                        <li>Serious Impairment</li>
                                        <li>Severe Impairment</li>
                                    </ol>
                                    <p>Score: <input type="text" class="border-bottom border-primary"></p>
                                </li>
                            </div>
                            <div class="col-md-6">
                                <li>Co-Morbidity
                                    <ol>
                                        <li>No Co-Morbidity</li>
                                        <li>Minor Co-Morbidity</li>
                                        <li>Significant Co-Morbidity</li>
                                        <li>Major Co-Morbidity</li>
                                        <li>Severe Co-Morbidity</li>
                                    </ol>
                                    <p>Score: <input type="text" class="border-bottom border-primary"></p>
                                </li>
                            </div>
                            <div class="col-md-6">
                                <li>A. Recovery Environment - Level of Stress
                                    <ol>
                                        <li>Low Stress Environment</li>
                                        <li>Mildly Stress Environment</li>
                                        <li>Moderately Stress Environment</li>
                                        <li>Highly Stress Environment</li>
                                        <li>Extremely Stress Environment</li>
                                    </ol>
                                    <p>Score: <input type="text" class="border-bottom border-primary"></p>
                                </li>
                            </div>
                            <div class="col-md-6">
                                <li>B. Recovery Environment - Level of Support
                                    <ol>
                                        <li>Highly Supportive Environment</li>
                                        <li>Supportive Environment</li>
                                        <li>Limited Support Environment</li>
                                        <li>Minimal Support Environment</li>
                                        <li>No Support Environment</li>
                                    </ol>
                                    <p>Score: <input type="text" class="border-bottom border-primary"></p>
                                </li>
                            </div>
                            <div class="col-md-6">
                                <li>Treatment and Recovery History
                                    <ol>
                                        <li>Full Response to Treatment & Recovery Mgmt</li>
                                        <li>Significant Response to Treatment & Recovery Mgmt</li>
                                        <li>Moderate Response to Treatment & Recovery Mgmt</li>
                                        <li>Poor Response to Treatment & Recovery Mgmt</li>
                                        <li>Negligible Response to Treatment</li>
                                    </ol>
                                    <p>Score: <input type="text" class="border-bottom border-primary"></p>
                                </li>
                            </div>
                            <div class="col-md-6">
                                <li>Engagement
                                    <ol>
                                        <li>Optimal Engagement</li>
                                        <li>Positive Engagement</li>
                                        <li>Limited Engagement</li>
                                        <li>Minimal Engagement</li>
                                        <li>Unengaged</li>
                                    </ol>
                                    <p>Score: <input type="text" class="border-bottom border-primary"></p>
                                </li>
                            </div>
                            <div class="col-md-6">
                                <p><b>Composite Score:</b> <input type="text" class="border-bottom border-primary"></p>
                                <p>Level 1 = 10-13</p>
                                <p>Level II = 14 - 16</p>
                                <p>Level III = 17 - 19</p>
                                <p>Level IV = 20 - 22</p>
                                <p>Level V = 23 –27</p>
                                <p>Level VI = 28 or more</p>
                            </div>
                        </div>
                    </ol>
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
