<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>DISCHARGE SUMMARY</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/')}}/form-style.css">
</head>

<body>
<div class="treatment-plan">
  
    <div class="content">
        <div class="flex-div">
            <div class="col-item">
                <div class="logo"><a href="#">
                        @if (file_exists($logo->logo) && !empty($logo->logo))
                            <img src="{{asset($logo->logo)}}"
                                 alt="" class="logo_img">
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-item">
                <div class="info-details">
                    <ul>
                        <li><span>Mail:</span>{{$name_location->address}}. {{$name_location->city}}
                            , {{$name_location->state}} {{$name_location->zip}}
                        </li>
                        <li><a href="mailto:{{$name_location->email}}"> <span>Email:</span>{{$name_location->email}}</a>
                        </li>
                        <li><span>Phone:</span> {{$name_location->phone_one}}</li>
                        {{--                        <li><a href="fax:+18183695800"><span>Fax:</span>818.369.5800</a></li>--}}
                    </ul>
                </div>
            </div>
        </div>
  
        <!-- headers -->
      <form action="#">
        <div class="page-title mb_40">
          <h1>DISCHARGE SUMMARY</h1>
        </div>
        <div class="content discharge-summary">
          <div class="section_1">
            <div class="colitem-1 column">
              <div class="row1"> <span class="sr-number">1)</span>
                <div class="date">
                  <div class="start-date"><span><label>Session Date:</label> <input
                        type="date"></span></div>
                  <div class="discharge-date"><label>Discharge Date:</label> <input type="date"></div>
                </div>
              </div>
            </div>
            <div class="colitem-2 column">
              <div class="inner">
                <div class="sr-number">2)</div>
                <div>
                  <h3>What is the living situation at discharge? </h3>
                  <div class="fill-area"><textarea
                      placeholder="Enter the living situation at discharge..."></textarea></div>
                </div>
              </div>
            </div>
            <div class="colitem-3 column">
              <div class="inner">
                <div class="sr-number">3)</div>
                <div>
                  <h3>What are the Strengths, Needs, Abilities and Preferences of the individual?
                  </h3>
                  <div class="inner">
                    <div class="lable-text">
                      <P><strong>Strengths: ?</strong></P>
                    </div>
                    <div class="fill-area"><input type="text" placeholder="Enter Strengths...">
                    </div>
                  </div>
                  <div class="inner">
                    <div class="lable-text">
                      <P><strong>Needs: ?</strong> </P>
                    </div>
                    <div class="fill-area"><input type="text" placeholder="Enter Needs..."></div>
                  </div>
                  <div class="inner">
                    <div class="lable-text">
                      <P><strong>Abilities: ? </strong> </P>
                    </div>
                    <div class="fill-area"><input type="text" placeholder="Enter Abilities...">
                    </div>
                  </div>
                  <div class="inner">
                    <div class="lable-text">
                      <P><strong>Preferences: ? </strong> </P>
                    </div>
                    <div class="fill-area"><input type="text" placeholder="Enter Preferences...">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="colitem-4 column">
              <div class="inner">
                <div class="sr-number">4)</div>
                <div>
                  <h3>What Services and support did Resilient Focused Family Therapy Provide, while in
                    care?
                  </h3>
                  <div class="fill-area"><textarea
                      placeholder="Enter Services and support did Resilient Focused Family Therapy Provide, while in care..."></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="colitem-5 column">
              <div class="inner">
                <div class="sr-number">5)</div>
                <div>
                  <h3>Significant findings </h3>
                  <div class="fill-area"><textarea
                      placeholder="Enter Significant findings..."></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="colitem-6 column">
              <div class="inner">
                <div class="sr-number">6)</div>
                <div>
                  <h3>Summary of goals achieved</h3>
                  <div class="fill-area"><textarea
                      placeholder="Enter Summary of goals achieved..."></textarea></div>
                </div>
              </div>
            </div>
            <div class="colitem-7 column">
              <div class="inner">
                <div class="sr-number">7)</div>
                <div>
                  <h3>Summary of goals not achieved</h3>
                  <div class="fill-area"><textarea
                      placeholder="Enter Summary of goals not achieved..."></textarea></div>
                </div>
              </div>
            </div>
            <div class="colitem-8 column">
              <div class="inner">
                <div class="sr-number">8)</div>
                <div>
                  <h3>Current support system</h3>
                  <div class="fill-area"><textarea
                      placeholder="Enter Current support system..."></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="colitem-9 column">
              <div class="inner">
                <div class="sr-number">9)</div>
                <div>
                  <h3>Overall Recommendations</h3>
                  <div class="fill-area"><textarea
                      placeholder="Enter Overall Recommendations..."></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="colitem-10 column">
              <div class="inner">
                <div class="sr-number">10)</div>
                <div>
                  <h3>What outside organization did you refer client too? If not referred out, please
                    explain.
                  </h3>
                  <div class="fill-area"><textarea
                      placeholder="Enter outside organization did you refer client too? If not referred out, please explain..."></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="colitem-11 column">
              <div class="inner">
                <div class="sr-number">11)</div>
                <div>
                  <h3>What is the plan of services, please include if an appointment was scheduled
                    (Please be
                    specific)? </h3>
                  <div class="fill-area"><textarea
                      placeholder="Enter the plan of services, please include if an appointment was scheduled (Please be specific)?..."></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="colitem-12 column">
              <div class="inner">
                <div class="sr-number">12)</div>
                <div>
                  <h3>Any medical needs post discharge?</h3>
                  <div class="fill-area"><textarea
                      placeholder="Enter Any medical needs post discharge?..."></textarea></div>
                </div>
              </div>
            </div>
            <div class="colitem-13 column">
              <div class="inner">
                <div class="sr-number">13)</div>
                <div>
                  <h3>What is the reason for discontinuing services?</h3>
                  <div class="fill-area"><textarea
                      placeholder="Enter the reason for discontinuing services..."></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="colitem-14 column">
              <div class="inner">
                <div class="sr-number">14)</div>
                <div>
                  <h3>Summary of Discharge</h3>
                  <div class="fill-area"><textarea
                      placeholder="Enter Summary of Discharge..."></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
                    <p><strong>{{$name_location->facility_name}}</strong> {{$name_location->address}}. {{$name_location->city}}
                            , {{$name_location->state}} {{$name_location->zip}}
                    </p>
                </div>
                <div class="col-item">
                    <p><a href="tel:{{$name_location->phone_one}}">Phone: {{$name_location->phone_one}},</a> &nbsp;<a
                            href="mailto:{{$name_location->email}}"> <span>Email:</span>
                            {{$name_location->email}},</a>&nbsp;<a href="{{$name_location->email}}">{{$name_location->email}}</a></p>
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
