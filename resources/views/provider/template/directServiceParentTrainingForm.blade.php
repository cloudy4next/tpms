<?php
use App\Models\Appoinment;
use App\Models\Employee;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

$cl=Appoinment::where('admin_id',Auth::user()->admin_id)->where('id',$session_id)->first();
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
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Direct-Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/temtwo/')}}/css/custom-2.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
      .logo_img{
        width: 100px;
        height: 100px;
      }
    </style>
</head>

<body>
<div class="parent-training">
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
            <h1>Direct-Service <br>
                Parent Training Note </h1>
        </div>
        <form action="{{route('provider.dsptn.two.form.submit')}}" method="post" id="dsptn_two_form">
            @csrf
            <section class="section_1 mb_30">
                <table cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="child-name">Child Name:</label>
                    </span> <span>
                      <input type="text" id="child-name" name="childname" class="childname" value="{{$client->client_full_name}}">
                      <input type="hidden" id="childname" name="sessionid" value="{{$session_id}}">
                    </span></div>
                        </td>
                        <td colspan="2">
                            <div class="flex-div"><span>
                      <label for="attendens">Attendees:</label>
                    </span> <span>
                      <input type="text" id="attendens" name="attendens" class="attendens">
                    </span></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="start-time">Start Time:</label>
                    </span> <span>
                      <input type="time" id="start-time" name="starttime" class="starttime" value="{{\Carbon\Carbon::parse($cl->from_time)->format('H:i:s')}}">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="End-time">End Time:</label>
                    </span> <span>
                      <input type="time" id="end-time" name="endtime" class="endtime" value="{{\Carbon\Carbon::parse($cl->to_time)->format('H:i:s')}}">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="date">Date:</label>
                    </span> <span>
                      <input type="date" id="date" name="stdate" class="stdate" value="{{ $cl->schedule_date}}">
                    </span></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_2 mb_30">
                <div class="col-title mb_30">
                    <h3>Goals for Session: </h3>
                    <span class="red">Check the box to the left of one or more goals that apply to this session</span>
                </div>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <input id="1st-row" type="checkbox" name="goals1" class="goals1"
                                   value="1">
                        </td>
                        <td><label for="1st-row">Explained specific behavior analytic concept / technique /
                                procedure</label></td>
                    </tr>
                    <tr>
                        <td>
                            <input id="2st-row" type="checkbox" name="goals2" class="goals2" value="1">
                        </td>
                        <td><label for="2st-row">Role played new procedure / technique</label></td>
                    </tr>
                    <tr>
                        <td>
                            <input id="3st-row" type="checkbox" name="goals3" class="goals3" value="1">
                        </td>
                        <td><label for="3st-row">Gave performance feedback to parent on implementation</label></td>
                    </tr>
                    <tr>
                        <td>
                            <input id="4st-row" type="checkbox" name="goals4" class="goals4" value="1">
                        </td>
                        <td><label for="4st-row">Modified / created new goal based on parent information</label></td>
                    </tr>
                    <tr>
                        <td>
                            <input id="5st-row" type="checkbox" name="goals5" class="goals5" value="1">
                        </td>
                        <td><label for="5st-row">Modeled protocol with child (if child present (0368T/0369T)</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="6st-row" type="checkbox" name="goals6" class="goals6" value="1">
                        </td>
                        <td><label for="6st-row">Other: </label></td>
                    </tr>
                </table>
            </section>
            <section class="section_2 mb_30">
                <div class="box box1 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="activities">Activities:</label>
                        </h3>
                        <span class="red">What activities did you engage in to help the client move closer to his/her goals
                through
                parent training? What materials did you use? A general summary will suffice.</span>
                    </div>
                    <div class="textarea">
                        <textarea id="activities" name="act" class="act" rows="5"></textarea>
                    </div>
                </div>
                <div class="box box2">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="needs">Needs:</label>
                        </h3>
                        <span class="red">What activities did you engage in to help the client move closer to his/her goals
                through
                parent training? What materials did you use? A general summary will suffice.</span>
                    </div>
                    <div class="textarea">
                        <textarea id="needs" name="needs" class="needs" rows="5"></textarea>
                    </div>
                </div>
            </section>
         
            <section class="section_bottom">
                <div class="button-row flex-div">
                    <div class="save-prog">
                        <button type="submit"><span class="cloud-icon"><i class="fas fa-cloud"></i></span>
                            Save
                        </button>
                    </div>
                    <div class="print">
                        <button type="button" class="pdf_btn"><span class="print-icon"><i
                                    class="fas fa-print"></i></span>Print
                        </button>
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
        <form class="pdf_form" action="{{ route('provider.print.form.2')}}" target="_blank" method="POST">
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
<!-- Signature -->
<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>
<script>
    $(document).ready(function () {
        $('.pdf_btn').hide();

      $(document).on('click','.pdf_btn',function(){
            $('.pdf_form').submit();
        })
        $(document).on('submit', '#dsptn_two_form', function (e) {
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
                url: "{{route('provider.dsptn.two.form.submit')}}",
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
    })

</script>

@include('provider.include.forms_js_include')

</body>

</html>
