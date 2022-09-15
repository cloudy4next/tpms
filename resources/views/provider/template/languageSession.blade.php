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
    <title>Speech Language Session Note</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem28/')}}/css/custom-28.css">
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
            <form method="POST" id="form_28">
                @csrf
                <div class="page-title mb_40">
                    <h1>Speech Language Session Note</h1>
                </div>
                <div class="content theraly-common-page">
                    <section class="section mb_40">
                        <table cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="flex-div"><span><label for="clname">Client’s Name:</label></span>
                                            <span><input type="text" id="clname" name="clname" value="{{$client->client_full_name}}"></span></div>
                                            <input type="hidden" name="sessionid" class="session_id" value="{{$session_id}}">

                                    </td>
                                    <td>
                                        <div class="flex-div"><span><label for="dob">Date of Birth:</label></span>
                                            <span><input type="date" id="dob" name="dob" value="{{ $client->client_dob }}"></span></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex-div"><span><label>ICD-10 Code:</label></span> <span><input
                                                    type="text" name="icd"></span></div>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                    <section class="section_2 mb_40">
                        <table cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="flex-div"><span><label for="dos">Date of session:</label></span>
                                            <span><input type="date" id="dos" name="dos1"></span></div>
                                    </td>
                                    <td>
                                        <div class="flex-div"><span><label>CPT Code:</label></span> <span><input
                                                    type="text" name="cpt1"></span></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div><span><label>Short-term goals Addressed:</label> <br></span>
                                            <span><textarea rows="5"
                                                    placeholder="Enter short-term goals..." name="stg1"></textarea></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div><span><label>Activity, progress & carryover:</label> <br></span>
                                            <span><textarea rows="5"
                                                    placeholder="Enter Activity, progress & carryover..." name="apc1"></textarea></span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                    <section class="section_3">
                        <table cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="flex-div"><span><label for="dos">Date of session:</label></span>
                                            <span><input type="date" id="dos" name="dos2"></span></div>
                                    </td>
                                    <td>
                                        <div class="flex-div"><span><label>CPT Code:</label></span> <span><input
                                                    type="text" name="cpt2"></span></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div><span><label>Short-term goals Addressed:</label> <br></span>
                                            <span><textarea rows="5"
                                                    placeholder="Enter short-term goals..." name="stg2"></textarea></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div><span><label>Activity, progress & carryover:</label> <br></span>
                                            <span><textarea rows="5"
                                                    placeholder="Enter Activity, progress & carryover..." name="apc2"></textarea></span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                    <section>
                        <div class="box box-last_2">
                            <div class="flex-div">
                                <div class="col-item">
                                    <input type="text" name="name1">
                                    <br>
                                    <label>Name</label>
                                </div>
                                <div class="col-item">
                                    <input type="text" name="name2">
                                    <br>
                                    <label>Name</label>
                                    <br>
                                    <label></label>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                
                <div class="section_bottom">
                    <div class="button-row flex-div">
                        <div class="save-prog"><button type="submit"><span class="cloud-icon"><i
                                        class="fas fa-cloud"></i></span>
                                Save</button></div>
                        <div class="print"><button type="button" class="pdf_btn"><span class="print-icon"><i
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
            <form class="pdf_form" action="{{ route('provider.print.form.28')}}" target="_blank" method="POST">
            @csrf
                <input type="hidden" name="session_id" class="session_id" value="{{$session_id}}">
            </form>
        </div>
    </div>
<!-- Jq Files -->
<script src="{{asset('assets/dashboard//')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>
<script>
    $(document).ready(function () {
      $('.pdf_btn').hide();

      $(document).on('click','.pdf_btn',function(){
            $('.pdf_form').submit();
        })
        $(document).on('submit', '#form_28', function (e) {
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
                url: "{{route('provider.28.form.submit')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    console.log(data)
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
