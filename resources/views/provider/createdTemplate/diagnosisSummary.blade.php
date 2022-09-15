<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosis Session Form</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem29/')}}/css/custom-29.css">
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
            <form class="theraly-common-page" method="POST" id="form_29">
                @csrf
                <div class="page-title mb_40">
                    <h1>Diagnosis Session Form</h1>
                </div>
                <section class="section_1  mb_30">
                    <div class="flex-div div_33 mb_30">
                        <div class="col-item">
                            <div class="input-area"> <span>
                                    <label for="clname">Name: </label>
                                </span> <span>
                                    <input type="text" placeholder="Enter your Name" id="clname" name="clname" value="{{$data->clname}}">
                                    <input type="hidden" name="sessionid" class="session_id" value="{{$session_id}}">
                                </span> </div>
                        </div>
                        <div class="col-item">
                            <div class="input-area"> <span>
                                    <label for="dob">DOB: </label>
                                </span> <span>
                                    <input type="date" id="dob" name="dob" name="dob" value="{{ $data->dob }}">
                                </span> </div>
                        </div>
                        <div class="col-item">
                            <div class="input-area"> <span>
                                    <label for="daydate">Date</label>
                                </span> <span>
                                    <input type="date" id="daydate" name="date" name="sdate" value="{{ $data->date}}">
                                </span> </div>
                        </div>
                        <div class="col-item">
                            <div class="input-area"> <span>
                                    <label>ICD:</label>
                                </span> <span>
                                    <input type="text" name="icd" value="{{ $data->icd}}">
                                </span> </div>
                        </div>
                    </div>
                </section>
                <section class="section_2">
                    <div class="box box_1 mb_30">
                        <h3>Reason for testing:</h3>
                        <textarea rows="5" placeholder="Enter The Reason for Testing..." name="reason">{{$data->reason}}</textarea>
                    </div>
                </section>
                <section class="section_3">
                    <div class="box box_1 mb_30">
                        <h3>Tests Administered:</h3>
                        <textarea rows="5" placeholder="Enter Test Administered..." name="testadmin">{{$data->testadmin}}</textarea>
                    </div>
                    <div class="box box_3 mb_30">
                        <h3>Scores:</h3>
                        <textarea rows="5" placeholder="Enter Scores..." name="scores">{{$data->scores}}</textarea>
                    </div>
                    <div class="box box_4 mb_30">
                        <h3>Implications of testing:</h3>
                        <textarea rows="5" placeholder="Enter The Implications of testing..." name="implication">{{$data->implication}}</textarea>
                    </div>
                    <div class="box box_6 mb_30">
                        <h3>Recommendations:</h3>
                        <textarea rows="5" placeholder="Enter Recommendations..." name="recom">{{$data->recom}}</textarea>
                    </div>
                    <div class="box box11">
                        <div class="flex-div">
                            <div class="col-item">
                                <input type="text" name="name1" value="{{ $data->name1}}">
                                <br>
                                <label>Name</label>
                            </div>
                            <div class="col-item">
                                <input type="text" name="name2" value="{{ $data->name2}}">
                                <br>
                                <label>Name</label>
                                <br>
                                <label></label>
                            </div>
                        </div>
                    </div>
                </section>
            
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
            <form class="pdf_form" action="{{ route('provider.print.form.29')}}" target="_blank" method="POST">
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
        $(document).on('submit', '#form_29', function (e) {
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
                url: "{{route('provider.29.form.submit')}}",
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
