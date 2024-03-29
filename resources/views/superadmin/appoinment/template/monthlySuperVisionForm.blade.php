<?php
use App\Models\Appoinment;
use App\Models\Employee;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

if(Auth::user()->is_up_admin==1){
    $admin_id=Auth::user()->id;
}
else{
    $admin_id=Auth::user()->up_admin_id;
}

$cl=Appoinment::where('admin_id',$admin_id)->where('id',$session_id)->first();
$provider=Employee::where('id',$cl->provider_id)->first();
$client=Client::where('id',$cl->client_id)->first();
if($provider->credential_type==11){
  $cred='Paraprofessional ';
}
else if($provider->credential_type==12){
  $cred='Behavior Analyst';
}
else{
  $cred='';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Supervision Note</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/temfive/')}}/css/custom-5.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
      .logo_img{
        width: 100px;
        height: 100px;
      }
    </style>
</head>

<body>
<div class="monthly-sup-note">
    <header>
        <div class="flex-div">
            <div class="col-item">
                <div class="logo"><a href="#">
                        @if (file_exists($logo->logo) && !empty($logo->logo))
                            <img src="{{asset($logo->logo)}}"
                                 alt="" class="logo_img">
                        @endif

                    </a></div>
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
        <div class="page-title mb_40">
            <h1>Monthly Supervision Note</h1>
        </div>
        <form action="{{route('superadmin.msn.five.form.submit')}}" method="post" id="msn_five_form">
            @csrf
            <section class="section_1">
                <div class="box box_1">
                    <div class="flex-div row-flex div_33 mb_30">
                        <div class="col-item">
                            <div class="flex-div"> <span>
                    <label for="clname">Client Name:</label>
                  </span> <span>
                    <input id="clname" type="text" name="clname" value="{{$client->client_full_name}}">
                    <input id="" type="hidden" name="sessionid" value="{{$session_id}}">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div"> <span>
                    <label for="date">Date:</label>
                  </span> <span>
                    <input id="date" type="date" name="stdate" value="{{ $cl->schedule_date}}">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div"> <span>
                    <label for="time">Time:</label>
                  </span> <span>
                    <input id="time" type="time" name="sttime">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div"> <span>
                    <label for="rbt">RBT(s) Supervised:</label>
                  </span> <span>
                    <input id="rbt" type="text" name="rbts">
                  </span></div>
                        </div>
                        <div class="flex-div row-flex row2">
                            <div class="col-item">
                                <div class="flex-div">
                                    <div>
                                        <label>Format:</label>
                                    </div>
                                    <div class="check-box-area">
                                        <ul>
                                            <li><span>
                            <input id="in-person" type="checkbox" name="format1" value="1">
                          </span><span>
                            <label for="in-person">In-person</label>
                          </span></li>
                                            <li><span>
                            <input id="remote" type="checkbox" name="format2" value="2">
                          </span> <span>
                            <label for="remote">Remote</label>
                          </span></li>
                                            <li><span>
                            <input id="group" type="checkbox" name="format3" value="3">
                          </span> <span>
                            <label for="group">Group</label>
                          </span></li>
                                            <li><span>
                            <input id="team-meeting" type="checkbox" name="format4" value="4">
                          </span> <span>
                            <label for="team-meeting">Team Meeting</label>
                          </span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-div row-flex row2 mb_30">
                            <div class="col-item">
                                <div class="flex-div">
                                    <div>
                                        <label>Activities:</label>
                                    </div>
                                    <div class="check-box-area">
                                        <ul>
                                            <li><span>
                            <input id="data-review" type="checkbox" name="activities1" value="1">
                          </span><span>
                            <label for="data-review">Data Review</label>
                          </span></li>
                                            <li><span>
                            <input id="observation" type="checkbox" name="activities2" value="2">
                          </span> <span>
                            <label for="observation">Observation</label>
                          </span></li>
                                            <li><span>
                            <input id="protocol" type="checkbox" name="activities3" value="3">
                          </span> <span>
                            <label for="protocol">Protocol Demonstration/Modification</label>
                          </span></li>
                                            <li><span>
                            <input id="ateam-meeting" type="checkbox" name="activities4" value="4">
                          </span> <span>
                            <label for="ateam-meeting">Team Meeting</label>
                          </span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section_2">
                <div class="box box1 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="goal-reviews">Goals Reviewed <span class="bracket red">(fill in progress
                    update)</span>:</label>
                        </h3>
                    </div>
                    <div class="textarea mb_30">
                        <textarea id="goal-reviews" name="goals" rows="5"></textarea>
                    </div>
                </div>
                <div class="box box2">
                    <div class="flex-div row-flex row2 mb_30">
                        <div class="col-item">
                            <div class="flex-div">
                                <div>
                                    <label>Overall Response to Treatment:</label>
                                </div>
                                <div class="check-box-area">
                                    <ul>
                                        <li><span>
                          <input id="making-progress" type="checkbox" name="responsetreat1" value="1">
                        </span><span>
                          <label for="making-progress">Making Progress</label>
                        </span></li>
                                        <li><span>
                          <input id="regression" type="checkbox" name="responsetreat2" value="2">
                        </span> <span>
                          <label for="regression">Regression</label>
                        </span></li>
                                        <li><span>
                          <input id="maintaining" type="checkbox" name="responsetreat3" value="3">
                        </span> <span>
                          <label for="maintaining">Maintaining</label>
                        </span></li>
                                        <li><span>
                          <input id="maintaining-n/a" type="checkbox" name="responsetreat4" value="5">
                        </span> <span>
                          <label for="maintaining-n/a">N/A</label>
                        </span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box3">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="feedback">Feedback / Suggestions:</label>
                        </h3>
                    </div>
                    <div class="textarea mb_30">
                        <textarea id="feedback" name="feed" rows="5"></textarea>
                    </div>
                </div>
                <div class="box box4">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="p-concern-discus">Parent/Caregiver Concerns Discussed:</label>
                        </h3>
                    </div>
                    <div class="textarea mb_30">
                        <textarea id="p-concern-discus" name="pcondis" rows="5"></textarea>
                    </div>
                </div>
                <div class="box box5">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="p-concern-discus"><b> Did RBT</b> provide services in accordance with BACB
                                Guidelines for
                                Responsible Conduct for Behavior Analysts?</label>
                        </h3>
                        <div class="check-box-area">
                            <ul>
                                <li><span>
                      <input id="rbt-yes" type="radio" name="rbt" value="1">
                    </span><span>
                      <label for="rbt-yes">Yes</label>
                    </span></li>
                                <li><span>
                      <input id="rbt-no" type="radio" name="rbt" value="2">
                    </span> <span>
                      <label for="rbt-no">No</label>
                    </span></li>
                            </ul>
                        </div>
                        <span class="bracket red">If no, please explain conduct and actions taken on back</span>
                    </div>
                    <div class="textarea mb_30">
                        <textarea id="p-concern-discus" name="rbt_exp" rows="5"></textarea>
                    </div>
                </div>
            </section>
            <div class="section_3">
                <div class="flex-div row-flex div_33 mb_30">
                    <div class="col-item">
                        <div class="flex-div"> <span>
                  <label for="supervisor-sign">Supervisor Signature:</label>
                </span> <span>
                  <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                </span></div>
                    </div>
                    <div class="col-item">
                        <div class="flex-div"> <span>
                  <label for="supervisor-name">Name:</label>
                </span> <span>
                  <input id="supervisor-name" type="text" name="supervisorname">
                </span></div>
                    </div>
                    <div class="col-item">
                        <div class="flex-div"> <span>
                  <label for="sign-date">Date:</label>
                </span> <span>
                  <input id="sign-date" type="date" name="signdate">
                </span></div>
                    </div>
                </div>
            </div>
            <section class="section_bottom">
                <div class="button-row flex-div">
                    <div class="save-prog">
                        <button type="submit"><span class="cloud-icon"><i class="fas fa-cloud"></i></span> Save</button>
                    </div>
                    <div class="print">
                        <button type="button" class="pdf_btn"><span class="print-icon"><i class="fas fa-print"></i></span>Print</button>
                    </div>
                    
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
        <form class="pdf_form" action="{{ route('superadmin.print.form.5')}}" target="_blank" method="POST">
            @csrf
            <input type="hidden" name="session_id" class="session_id" value="{{$session_id}}">
        </form>
    </div>
</div>
<!-- signature modal -->

<!--/ signature modal -->
<!-- Jq Files -->
<script src="{{asset('assets/dashboard//')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/bootstrap.min.js"></script>

<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>
<!-- Signature -->
<script>
    $('.pdf_btn').hide();

      $(document).on('click','.pdf_btn',function(){
            $('.pdf_form').submit();
        })
    $(document).on('submit', '#msn_five_form', function (e) {
        e.preventDefault();
        let canvas2 = document.getElementById('sig-canvas');
            let canvas3 = document.getElementById('sig-canvas2');
            let dataURL2 = canvas2.toDataURL();
            let dataURL3 = canvas3.toDataURL();

            let sing_draw = $('.sing_draw').val(dataURL2);
            let sing_draw2 = $('.sing_draw2').val(dataURL3);

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: "{{route('superadmin.msn.five.form.submit')}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                console.log(data);
                if(data=="done"){
                      $('.pdf_btn').show();
                    }
                toastr["success"]("Form Successfully Created", 'SUCCESS!');
            },
            error: function (data) {
                console.log(data);
            }
        });
    })
</script>
@include('superadmin.appoinment.include.forms_js_include')

</body>

</html>
