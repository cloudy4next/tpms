<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Outpatient Treatment Request [OTR] Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem10/')}}/css/custom-10.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
      .logo_img{
        width: 100px;
        height: 100px;
      }
    </style>
</head>

<body>
<div class="out-patient-treatment">
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
        <div class="page-title mb_40">
            <h1>Outpatient Treatment Request [OTR] Form:</h1>
            <h2>Diagnosis</h2>
        </div>
        <form action="" method="POST" id="form_10">
          @csrf
            <section class="section_1" style="margin-top: 10px;">
                <div class="flex-div">
                    <div class="colitem-1 column">
                        <div class="inner">
                            <div class="sr-number">1)</div>
                            <div>
                      <input type="hidden" id="" name="sessionid" value="{{$session_id}}">
                                <h3>Level of Care: Risk of Harm-- ? </h3>
                                <div class="fill-area"><textarea placeholder="" rows="1" name="riskharm">{{$data->riskharm}}</textarea></div>
                            </div>
                        </div>
                    </div>

                    <div class="colitem-2 column">
                        <div class="inner">
                            <div class="sr-number">2)</div>
                            <div>
                                <h3>Level of Care: Functional Status--?</h3>
                                <div class="fill-area"><textarea placeholder="" rows="1" name="funcstatus">{{$data->funcstatus}}</textarea></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-div">
                    <div class="colitem-3 column">
                        <div class="inner">
                            <div class="sr-number">3)</div>
                            <div>
                                <h3>Level of Care: Co-Morbidities-- ? </h3>
                                <div class="fill-area"><textarea placeholder="" rows="1" name="comorbid">{{$data->comorbid}}</textarea></div>
                            </div>
                        </div>
                    </div>

                    <div class="colitem-4 column">
                        <div class="inner">
                            <div class="sr-number">4)</div>
                            <div>
                                <h3>. Level of Care: Environmental Stressors-- ?</h3>
                                <div class="fill-area"><textarea placeholder="" rows="1" name="envstress">{{$data->envstress}}</textarea></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-div">
                    <div class="colitem-5 column">
                        <div class="inner">
                            <div class="sr-number">5)</div>
                            <div>
                                <h3>Level of Care: Support in the Environment --? </h3>
                                <div class="fill-area"><textarea placeholder="" rows="1" name="suppenv">{{$data->suppenv}}</textarea></div>
                            </div>
                        </div>
                    </div>

                    <div class="colitem-6 column">
                        <div class="inner">
                            <div class="sr-number">6)</div>
                            <div>
                                <h3>Level of Care: Response to Current Treatment Plan--?</h3>
                                <div class="fill-area"><textarea placeholder="" rows="1" name="rescurr">{{$data->rescurr}}</textarea></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-div">
                    <div class="colitem-7 column">
                        <div class="inner">
                            <div class="sr-number">7)</div>
                            <div>
                                <h3>Level of Care: Acceptance and Engagement--?</h3>
                                <div class="fill-area"><textarea placeholder="" rows="1" name="acceng">{{$data->acceng}}</textarea></div>
                            </div>
                        </div>
                    </div>

                    <div class="colitem-8 column">
                        <div class="inner">
                            <div class="sr-number">8)</div>
                            <div>
                                <h3>Transportation Available--?</h3>
                                <div class="fill-area"><textarea placeholder="" rows="1" name="transp">{{$data->transp}}</textarea></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-div">
                    <div class="colitem-9 column">
                        <div class="inner">
                            <div class="sr-number">9)</div>
                            <div>
                                <h3>Presenting Problems – ?</h3>
                                <div class="fill-area"><textarea placeholder="" rows="1" name="present">{{$data->present}}</textarea></div>
                            </div>
                        </div>
                    </div>

                    <div class="colitem-10 column">
                        <div class="inner">
                            <div class="sr-number">10)</div>
                            <div>
                                <h3>Current Need for Treatment--? </h3>
                                <div class="fill-area"><textarea placeholder="" rows="1" name="currtreat">{{$data->currtreat}}</textarea></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-div">
                    <div class="colitem-11 column">
                        <div class="inner">
                            <div class="sr-number">11)</div>
                            <div>
                                <h3>Detail Member Behavior within Past 30 days--? </h3>
                                <div class="fill-area"><textarea placeholder="" rows="1" name="detail30">{{$data->detail30}}</textarea></div>
                            </div>
                        </div>
                    </div>

                    <div class="colitem-12 column">
                        <div class="inner">
                            <div class="sr-number">12)</div>
                            <div>
                                <h3>Current Medications--? </h3>
                                <div class="fill-area"><textarea placeholder="" rows="1" name="currmed">{{$data->currmed}}</textarea></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="colitem-13 column">
                    <div class="inner">
                        <div class="sr-number">13)</div>
                        <div>
                            <h3>Treatment History/Facility --?</h3>
                            <div class="fill-area"><textarea placeholder="" rows="1" name="treat">{{$data->treat}}</textarea></div>
                        </div>
                    </div>
                </div>
            </section>
         
            <section class="section_bottom">
                <div class="button-row flex-div">
                    <div class="save-prog">
                        <button type="submit"><span class="cloud-icon"><i
                                    class="fas fa-cloud"></i></span> Save
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
        <form class="pdf_form" action="{{ route('provider.print.form.10')}}" target="_blank" method="POST">
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

      $(document).on('click','.pdf_btn',function(){
            $('.pdf_form').submit();
        })
        $(document).on('submit', '#form_10', function (e) {
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
                url: "{{route('provider.10.form.submit')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    console.log(data)
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
