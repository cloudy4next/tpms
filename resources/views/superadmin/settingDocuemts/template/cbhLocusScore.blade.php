<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>LOCUS Score Sheet</title>
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
                    <h1>LOCUS Score Sheet</h1>
                </div>
                <div class="top-part">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Agency Name:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Client Name/Number:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <table cellpadding="0" cellspacing="0" class="extra text-center">
                                <tbody>
                                    <tr>
                                        <td colspan="5"><label>Dimension 1: Risk of Harm</label> </td>
                                    </tr>
                                    <tr>
                                        <td><label>Min Risk</label></td>
                                        <td><label>Low Risk</label></td>
                                        <td><label>Mod Risk</label></td>
                                        <td><label>Serious Risk</label></td>
                                        <td><label>Extreme Risk</label></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>a</td>
                                        <td>b</td>
                                        <td>c</td>
                                        <td>d</td>
                                        <td>e</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 mb-3">
                            <table cellpadding="0" cellspacing="0" class="extra text-center">
                                <tbody>
                                    <tr>
                                        <td colspan="5"><label>Dimension 2: Functional Status </label> </td>
                                    </tr>
                                    <tr>
                                        <td><label>Min Impairment</label></td>
                                        <td><label>Low Impairment</label></td>
                                        <td><label>Mod Impairment</label></td>
                                        <td><label>Serious Impairment</label></td>
                                        <td><label>Extreme Impairment</label></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>a</td>
                                        <td>b</td>
                                        <td>c</td>
                                        <td>d</td>
                                        <td>e</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 mb-3">
                            <table cellpadding="0" cellspacing="0" class="extra text-center">
                                <tbody>
                                    <tr>
                                        <td colspan="5"><label>Dimension 3: Co-Morbidity </label> </td>
                                    </tr>
                                    <tr>
                                        <td><label>No Comorbidity</label></td>
                                        <td><label>Minor Comorbidity</label></td>
                                        <td><label>Signif. Comorbidity</label></td>
                                        <td><label>Major Comorbidity</label></td>
                                        <td><label>Severe Comorbidity</label></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>a</td>
                                        <td>b</td>
                                        <td>c</td>
                                        <td>d</td>
                                        <td>e</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 mb-3">
                            <table cellpadding="0" cellspacing="0" class="extra text-center">
                                <tbody>
                                    <tr>
                                        <td colspan="5"><label>Dimension 4A: Recovery Environment Stress </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Low Stress</label></td>
                                        <td><label>Mildly Stressful</label></td>
                                        <td><label>Moderately Stressful</label></td>
                                        <td><label>Highly Stressful</label></td>
                                        <td><label>Extremely Stressful</label></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>a</td>
                                        <td>b</td>
                                        <td>c</td>
                                        <td>d</td>
                                        <td>e</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 mb-3">
                            <table cellpadding="0" cellspacing="0" class="extra text-center">
                                <tbody>
                                    <tr>
                                        <td colspan="5"><label>Dimension 4B: Recovery Environment Support </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Highly Supportive</label></td>
                                        <td><label>Supportive</label></td>
                                        <td><label>Limited Support</label></td>
                                        <td><label>Minimal Support</label></td>
                                        <td><label>No Support</label></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>a</td>
                                        <td>b</td>
                                        <td>c</td>
                                        <td>d</td>
                                        <td>e</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 mb-3">
                            <table cellpadding="0" cellspacing="0" class="extra text-center">
                                <tbody>
                                    <tr>
                                        <td colspan="5"><label>Dimension 5: Treatment and Recover History </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Fully Responsive</label></td>
                                        <td><label>Significant Response</label></td>
                                        <td><label>Moderate Response</label></td>
                                        <td><label>Poor Response</label></td>
                                        <td><label>Negative Response</label></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>a</td>
                                        <td>b</td>
                                        <td>c</td>
                                        <td>d</td>
                                        <td>e</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 mb-3">
                            <table cellpadding="0" cellspacing="0" class="extra text-center">
                                <tbody>
                                    <tr>
                                        <td colspan="5"><label>Dimension 6: Engagement </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Optimal Engagement</label></td>
                                        <td><label>Positive Engagement</label></td>
                                        <td><label>Limited Engagement</label></td>
                                        <td><label>Minimal Engagement</label></td>
                                        <td><label>Un-engaged</label></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>a</td>
                                        <td>b</td>
                                        <td>c</td>
                                        <td>d</td>
                                        <td>e</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p>COMPOSITE SCORE: <input type="text" class="border-bottom border-primary"></p>
                    <p>Instructions:
                        Circle the scores that best describe client's current circumstances and
                        clinical presentation. Then choose the highest score in which at least
                        one answer is circled. Place that score in the box for the dimension on
                        the right of the page. Add all scores for the composite score. </p>
                    <p>NOTE: </p>
                    <p> Any score of 4 or 5 in Dimensions 1, 2, or 3 have independent
                        placement criteria required regardless of the composite score or scores
                        on other dimensions.</p>
                </div>
                <div class="top-part">
                    <table cellpadding="0" cellspacing="0" class="extra">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Reviewer Name:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Reviewer Credentials:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Date::</label>
                                    <input type="date" placeholder="Enter Here...">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="#" data-target="#signatureModal" data-toggle="modal">BACB Signature<i class="fa fa-signature"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" data-target="#signatureModal" data-toggle="modal">Caregiver Signature<i class="fa fa-signature"></i></a>
                        </li>
                    </ul>
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
