<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Medication Consent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/')}}/form-style.css">
    <style>
      input[type=text] {
        border-bottom: 1px solid black;
      }
    </style>
</head>

<body>
<div class="treatment-plan">
    <header>
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
    </header>
    <div class="content">
        <!-- headers -->
      <form action="#">
        <div class="page-title mb_40">
          <h1>Medication Consent</h1>
        </div>
        <div class="top-part">
          <div class="d-flex justify-content-between">
            <label>Patient’s Name:<input type="text"> </label>
            <label>Patient MR#:<input type="text"> </label>
          </div>
          <div class="text-center pt-4">
            <label><input type="text"> </label>
            <p>(NAME(S) OF PSYCHOTROPIC MEDICATION)</p>
          </div>
          <p>I have been informed that Brenda White, M.D. recommends that I received one or more of the above
            medications for the treatment of my psychiatric disturbance. I have been informed about the nature of the
            treatment, reasonable alternative treatments, as well as no treatment, and the risks of possible side
            effects have been explained to me. If I fail to comply with the treatment or choose to see another
            provider, I am obligated to inform Dr. White about that decision.</p>
          <label>This medication ____ is/ ____ is not FDA approved. (There is evidence of good results with
            this)</label>
          <p>I understand that although the substantial side effects of this treatment have been explained to me, that
            there may be other side effects, and <b>that I should promptly inform Brenda White, M.D.</b> if there are
            any
            unexpected changes in my condition. Further information on prescribed medication can be found on the website
            www.nami.org.</p>
          <label>I understand that I am not forced to take medication and that I am encouraged to discuss my
            medication further with Brenda White, M.D. should I have further questions about it or about continuing to
            take it. I also understand that I should not mix alcohol with sedating medications and exercise caution
            while driving or use of machinery.</label>
          <p>
            I understand that my doctor believes that medications are likely to help me, but that there is no
            guarantee as to results that may be expected. I understand that I have to take responsibility to
            administer the said medications and to keep them in safekeeping away from children. I will follow up with
            the visits as recommended by Dr. White.<br> <br>
            On this basis I authorize Brenda White, M.D. to prescribe medications at such intervals as recommended.
          </p>
          <h5 class="title text-center">I ACCEPT ( <input type="text" placeholder="Enter Here...">
            )</h5>
          <label class="title">PATIENT/PARENT/GUARDIAN SIGNATURE:
            <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a></label>
          <div class="d-flex justify-content-between pt-4">
            <label class="title">PRINT NAME:<input type="text"> </label>
            <label class="title">DATE:<input type="date"> </label>
          </div>
          <div class="d-flex justify-content-between pt-4 pb-4">
            <label class="title">PHYSICIAN SIGNATURE:<input type="text"></label>
            <label class="title">DATE:<input type="date"></label>
          </div>

          <h5 class="title text-center">I DECLINE ( <input type="text" placeholder="Enter Here...">
            )</h5>
          <label class="title">PATIENT/PARENT/GUARDIAN SIGNATURE:
            <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a></label>
          <div class="d-flex justify-content-between pt-4">
            <label class="title">PRINT NAME:<input type="text"></label>
            <label class="title">DATE:<input type="date"></label>
          </div>
          <div class="d-flex justify-content-between pt-4 pb-4">
            <label class="title">PHYSICIAN SIGNATURE: <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a></label>
            <label class="title">DATE:<input type="date"> </label>
          </div>
          <div class="d-flex justify-content-between pt-4 pb-4">
            <label class="title">WITNESS SIGNATURE:<a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a></label>
            <label class="title">DATE:<input type="date"></label>
          </div>


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
