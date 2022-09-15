<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Form</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem20/')}}/css/custom-20.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
      .logo_img{
        width: 100px;
        height: 100px;
      }
    </style>
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
                    <h1>Assessment Form</h1>
                </div>
                <section class="section_1">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label class="text-primary">Task Completed</label>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="task">Direct
                                                    Assessment
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="task">Indirect
                                                    Assessment
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="task">Creating Goals
                                                    Language
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="task">Creating
                                                    Behavior Intervention Plan
                                                    Language
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="task">Creating
                                                    Report
                                                    Language
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label class="text-primary">Assessment Tools Used (Specify Indirect or Direct)</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter here..." name="assesstool"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="text-primary">Description of Tasks Completed</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter here..." name="destask"></textarea>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </section>
                <section class="section_3">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="client" value="1">Client
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="therapist" value="1">Therapist
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="render_prov" value="1">Rendering Provider
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                    <ul class="list-inline mt-3">
                    <li class="list-inline-item">
                      <a href="#" data-target="#signatureModal" data-toggle="modal">Provider Signature<i class="fa fa-signature"></i></a>
                    </li>
                    <li class="list-inline-item float-right">
                      <a href="#" data-target="#signatureModal2" data-toggle="modal">Caregiver Signature<i class="fa fa-signature"></i></a>
                    </li>
                  </ul>
                <div class="section_bottom">
                    <div class="button-row flex-div">
                        <div class="save-prog"><button type="button"><span class="cloud-icon"><i
                                        class="fas fa-cloud"></i></span>
                                Save</button></div>
                        <div class="print"><button type="button" class="pdf_btn"><span class="print-icon"><i
                                        class="fas fa-print"></i></span>Print</button>
                        </div>
                        
                    </div>
                </div>

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
<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>


@include('superadmin.appoinment.include.forms_js_include')
</body>

</html>
