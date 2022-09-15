<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speech Language Progress Report</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem27/')}}/css/custom-27.css">
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
            <form class="theraly-common-page" id="form_27" method="POST">
                @csrf
                <div class="page-title mb_40">
                    <h1>Speech Language Progress Report</h1>
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
                                    <input type="date" id="dob" name="dob" value="{{ $data->dob }}">
                                </span> </div>
                        </div>
                        <div class="col-item">
                            <div class="input-area"> <span>
                                    <label for="address">Address: </label>
                                </span> <span>
                                    <input type="text" placeholder="Enter Address" id="address" name="address" value="{{ $data->address }}">
                                </span> </div>
                        </div>
                        <div class="col-item">
                            <div class="input-area"> <span>
                                    <label for="summery-date">Date of Summary: </label>
                                </span> <span>
                                    <input type="date" id="summery-date" name="sdate" value="{{ $data->sdate}}">
                                </span> </div>
                        </div>
                        <div class="col-item">
                            <div class="input-area"> <span>
                                    <label>CPT Code(s): </label>
                                </span> <span>
                                    <input type="text" name="cpt" value="{{$data->cpt}}">
                                </span> </div>
                        </div>
                        <div class="col-item">
                            <div class="input-area"> <span>
                                    <label>CA: </label>
                                </span> <span>
                                    <input type="text" name="ca" value="{{ $data->ca }}">
                                </span> </div>
                        </div>
                        <div class="col-item">
                            <div class="input-area"> <span>
                                    <label>ICD Code(s): </label>
                                </span> <span>
                                    <input type="text" name="icd" value="{{ $data->icd }}">
                                </span> </div>
                        </div>
                    </div>
                </section>
                <section class="section_2">
                    <div class="box box_1">
                        <h3>Background Information:</h3>
                        <textarea rows="5" placeholder="Enter Background Information..." name="backinfo">{{$data->backinfo}}</textarea>
                    </div>
                </section>
                <section class="section_3">
                    <div class="inner-main-title">
                        <h2>Summary of Therapy</h2>
                    </div>
                    <div class="box box_1 mb_30">
                        <h3>LONG TERM GOAL <span class="bracket">(Instrumental Outcomes)</span>:</h3>
                        <textarea rows="5" placeholder="Enter long term goal..." name="ltgoal">{{$data->ltgoal}}</textarea>
                    </div>
                    <div class="box box_2 mb_30">
                        <h3>SHORT TERM GOALS <span class="bracket">(Intermediate Outcomes):</span></h3>
                        <textarea rows="5" placeholder="Enter short term goal..." name="stgoal">{{$data->stgoal}}</textarea>
                    </div>
                    <div class="box box_3 mb_30">
                        <h3>Intervention Strategies:</h3>
                        <textarea rows="5" placeholder="Enter intervention strategies..." name="intstra">{{$data->intstra}}</textarea>
                    </div>
                    <div class="box box_4 mb_30">
                        <h3>Response to Therapy:</h3>
                        <textarea rows="5" placeholder="Enter response to therapy..." name="resth">{{$data->resth}}</textarea>
                    </div>
                    <div class="box box_5 mb_30">
                        <h3>Testing Done During the Semester:</h3>
                        <textarea rows="5" placeholder="Enter testing done during the semester..." name="testsem">{{$data->testsem}}</textarea>
                    </div>
                    <div class="box box_6 mb_30">
                        <h3>Recommendations:</h3>
                        <textarea rows="5" placeholder="Enter recommendations..." name="recom">{{$data->recom}}</textarea>
                    </div>
                    <div class="box box_7 mb_30">
                        <h3>Medical Necessity:</h3>
                        <textarea rows="5" placeholder="Enter medical necessity..." name="mednec">{{$data->mednec}}</textarea>
                    </div>
                    <div class="box box_8 mb_30">
                        <h3>Recommendations:</h3>
                        <textarea rows="5" placeholder="Enter recommendations" name="recomm">{{$data->recomm}}</textarea>
                    </div>
                    <div class="box box_9 mb_30">
                        <h3>LONG TERM GOALS:</h3>
                        <textarea rows="5" placeholder="Enter long term goal..." name="ltgoal2">{{$data->ltgoal2}}</textarea>
                    </div>
                    <div class="box box_10 mb_30">
                        <h3>SHORT TERM GOALS:</h3>
                        <textarea rows="5" placeholder="Enter short term goal..." name="stgoal2">{{$data->stgoal2}}</textarea>
                    </div>
                    <div class="box box11">
                        <div class="flex-div">
                            <div class="col-item">
                                <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                                <br>
                                <label>Kathleen Sposato, M.S., CCC-SLP,TSSLD</label>
                            </div>
                            <div class="col-item">
                                <a href="#" data-target="#signatureModal2" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                                <br>
                                <label>Christiana Neophtyou, M.S., CCC-SLP</label>
                                <br>
                                <label>Director of speech language progress report, PLLC</label>
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
            <form class="pdf_form" action="{{ route('superadmin.print.form.27')}}" target="_blank" method="POST">
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
        $(document).on('submit', '#form_27', function (e) {
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
                url: "{{route('superadmin.27.form.submit')}}",
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

@include('superadmin.appoinment.include.forms_js_include')
</body>

</html>
