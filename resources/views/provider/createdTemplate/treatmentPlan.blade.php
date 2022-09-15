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
        <form action="{{route('provider.tp.eight.form.submit')}}" method="post" id="tp_eight_from">
            @csrf
            <div class="page-title mb_40">
                <h1>Treatment Plan</h1>
            </div>
            <div class="top-part" style="margin-top:10px;">
                <div class="row1 flex-div mb_30">
                    <div class="client-name"><label>Client Name:</label>
                        <input type="text" placeholder="Enter Your Name..." name="clname"
                               value="{{$form_eight->clname}}">
                        <input type="hidden" placeholder="Enter Your Name..." name="sessionid" value="{{$session_id}}">
                    </div>
                    <div class="date"><label>Date:</label> <input type="date" name="stdate"
                                                                  value="{{$form_eight->stdate}}"></div>
                </div>
                <div class="row2 mb_30"><span><label>Type of Treatment Plan:</label></span> <span>
                        <input type="checkbox" id="initial" name="init"
                               {{$form_eight->init == 1 ? 'checked' : ''}} value="1"> <label
                            for="initial">initial</label>
                        <input type="checkbox" id="ongoing" name="ongoing"
                               {{$form_eight->ongoing == 1 ? 'checked' : ''}} value="1"><label
                            for="ongoing">ongoing</label></span>
                </div>
            </div>
            <section class="section_1">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td rowspan="2">
                            <div class="flex-div first"><span><label>Goal 1:</label></span> <span> <textarea
                                        rows="1" placeholder="Enter Goal 1..."
                                        name="gl1">{!! $form_eight->gl1 !!}</textarea></span></div>
                        </td>
                        <td><label>Open Date:</label><input type="date" name="gl1opendt"
                                                            value="{{$form_eight->gl1opendt}}"></td>
                    </tr>
                    <tr>
                        <td><label>Target Date:</label> <input type="date" name="gl1trdat"
                                                               value="{{$form_eight->gl1trdat}}"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Objective 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Objective..."
                                        name="gl1obj">{!! $form_eight->gl1obj !!}</textarea></span></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Intervention 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Intervention"
                                        name="gl1inter">{!! $form_eight->gl1inter !!}</textarea></span>
                            </div>
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
                                        rows="1" placeholder="Enter Goal 2..."
                                        name="gl2">{!! $form_eight->gl2 !!}</textarea></span></div>
                        </td>
                        <td><label>Open Date:</label><input type="date" name="gl2opdt" value="{{$form_eight->gl2opdt}}">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Target Date:</label> <input type="date" name="gl2trdt"
                                                               value="{{$form_eight->gl2trdt}}"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Objective 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Objective..."
                                        name="gl2obj">{!! $form_eight->gl2obj !!}</textarea></span></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Intervention 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Intervention"
                                        name="gl2inter">{!! $form_eight->gl2inter !!}</textarea></span>
                            </div>
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
                                        rows="1" placeholder="Enter Goal 3..."
                                        name="gl3">{!! $form_eight->gl3 !!}</textarea></span></div>
                        </td>
                        <td><label>Open Date:</label><input type="date" name="gl3opdt" value="{{$form_eight->gl3opdt}}">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Target Date:</label> <input type="date" name="gl3trdt"
                                                               value="{{$form_eight->gl3trdt}}"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Objective 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Objective..."
                                        name="gl3obj">{!! $form_eight->gl3obj !!}</textarea></span></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Intervention 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Intervention"
                                        name="gl3inter">{!! $form_eight->gl3inter !!}</textarea></span>
                            </div>
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
                                        rows="1" placeholder="Enter Goal 4..."
                                        name="gl4">{!! $form_eight->gl4 !!}</textarea></span></div>
                        </td>
                        <td><label>Open Date:</label><input type="date" name="gl4opdt" value="{{$form_eight->gl4opdt}}">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Target Date:</label> <input type="date" name="gl4trdt"
                                                               value="{{$form_eight->gl4trdt}}"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Objective 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Objective..."
                                        name="gl4obj">{!! $form_eight->gl4obj !!}</textarea></span></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex-div"><span><label>Intervention 1:</label></span> <span><textarea
                                        rows="1" placeholder="Enter Intervention"
                                        name="gl4inter">{!! $form_eight->gl4inter !!}</textarea></span>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
             
            </section>
            <div class="section_bottom">
                <div class="button-row flex-div">
                    <div class="save-prog">
                        <button type="submit"><span class="cloud-icon"><i
                                    class="fas fa-cloud"></i></span>
                            Save
                        </button>
                    </div>
                    <div class="print">
                        <button type="button" class="pdf_btn"><span class="print-icon"><i
                                    class="fas fa-print"></i></span>Print
                        </button>
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

        <form class="pdf_form" action="{{ route('provider.print.form.8')}}" target="_blank" method="POST">
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
    $(document).ready(function () {

        $(document).on('click','.pdf_btn',function(){
            $('.pdf_form').submit();
        })

        $(document).on('submit', '#tp_eight_from', function (e) {
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
                url: "{{route('provider.tp.eight.form.submit')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    console.log(data);
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
