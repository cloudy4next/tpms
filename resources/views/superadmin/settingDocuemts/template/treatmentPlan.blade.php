<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TREATMENT PLAN</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem8/')}}/css/custom-8.css">
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
        <form action="#">
            <div class="page-title mb_40">
                <h1>Treatment Plan</h1>
            </div>
            <div class="top-part" style="margin-top:10px;">
                <div class="row1 flex-div mb_30">
                    <div class="client-name"><label>Client Name:</label> <input type="text"
                                                                                placeholder="Enter Your Name..."></div>
                    <div class="date"><label>Date:</label> <input type="date"></div>
                </div>
                <div class="row2 mb_30"><span><label>Type of Treatment Plan:</label></span> <span><input
                            type="checkbox" id="initial"> <label for="initial">initial</label> <input
                            type="checkbox" id="ongoing"><label for="ongoing">ongoing</label></span></div>
            </div>
            <section class="section_1">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td rowspan="2">
                            <div class="flex-div first"><span><label>Goal 1:</label></span> <span> <textarea
                                        rows="1" placeholder="Enter Goal 1..."></textarea></span></div>
                        </td>
                        <td><label>Open Date:</label><input type="date"></td>
                    </tr>
                    <tr>
                        <td><label>Target Date:</label> <input type="date"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Objective 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Objective..."></textarea></span></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Intervention 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Intervention"></textarea></span></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_2">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td rowspan="2">
                            <div class="flex-div first"><span><label>Goal 2:</label></span> <span> <textarea
                                        rows="1" placeholder="Enter Goal 2..."></textarea></span></div>
                        </td>
                        <td><label>Open Date:</label><input type="date"></td>
                    </tr>
                    <tr>
                        <td><label>Target Date:</label> <input type="date"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Objective 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Objective..."></textarea></span></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Intervention 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Intervention"></textarea></span></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_3">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td rowspan="2">
                            <div class="flex-div first"><span><label>Goal 3:</label></span> <span> <textarea
                                        rows="1" placeholder="Enter Goal 3..."></textarea></span></div>
                        </td>
                        <td><label>Open Date:</label><input type="date"></td>
                    </tr>
                    <tr>
                        <td><label>Target Date:</label> <input type="date"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Objective 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Objective..."></textarea></span></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Intervention 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Intervention"></textarea></span></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_4">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td rowspan="2">
                            <div class="flex-div first"><span><label>Goal 4:</label></span> <span> <textarea
                                        rows="1" placeholder="Enter Goal 4..."></textarea></span></div>
                        </td>
                        <td><label>Open Date:</label><input type="date"></td>
                    </tr>
                    <tr>
                        <td><label>Target Date:</label> <input type="date"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Objective 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Objective..."></textarea></span></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Intervention 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Intervention"></textarea></span></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <div class="section_bottom">
                <div class="button-row flex-div">
                    <div class="mark-sign"><a href="#signatureModal" data-toggle="modal"><span class="mark-icon"><i
                                    class="fas fa-check"></i></span> Mark
                            Completed and Sign</a></div>
                    <div class="save-prog">
                        <button type="button"><span class="cloud-icon"><i
                                    class="fas fa-cloud"></i></span>
                            Save
                        </button>
                    </div>
                    <div class="print">
                        <button type="button"><span class="print-icon"><i
                                    class="fas fa-print"></i></span>Print
                        </button>
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
<!-- signature modal -->
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
                        </div>
                        <button type="button" class="btn btn-danger p-2" id="sig-clearBtn">Clear</button>
                    </div>
                    <div class="tab-pane fade" id="uploadsig">
                        <label>Upload File</label>
                        <input type="file" class="form-control-file">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary">Save
                    Signature
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--/ signature modal -->
<!-- Jq Files -->
<script src="{{asset('assets/dashboard//')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/bootstrap.min.js"></script>
@include('superadmin.appoinment.include.forms_js_include')
</body>

</html>
