<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/')}}/form-style.css">
    <style> 
        input[type="text"],
        input[type="email"],
        textarea,
        input[type="date"] {
            outline:0px !important;
            -webkit-appearance:none;
            box-shadow: none !important;
            border: 1px solid grey !important;
            border-radius: none !important;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea,
        input[type="date"]:focus {
            outline:0px !important;
            -webkit-appearance:none;
            box-shadow: none !important;
        }

        .custom_label {
            color: #207ac7 !important;
            font-weight: bold !important;
        }

        .sign1,.sign2 {
            width: 200px;
            height: 100px;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
        }

        .image_list,.signature_list {
            display: none;
        }

        .sign_container {
            width: 200mm;
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

        <div class="page-title mb_40">
            <h1>{{$title}}</h1>
        </div>

        <div class="container">
            <form action="{{route('superadmin.setting.forms.builder.save')}}" method="post"
                  enctype="multipart/form-data" id="buildeform">
                @csrf
                <div class="render-wrap"></div>
                <div class="sign_container">
                    <ul class="list-inline mt-3 image_list">
                        <li class="list-inline-item">
                            <img src="" alt="" class="sign1">
                        </li>
                        <li class="list-inline-item float-right">
                            <img src="" alt="" class="sign2">
                        </li>
                    </ul>
                    <ul class="list-inline mt-3 signature_list">
                        <li class="list-inline-item">
                            <b>Provider Signature</b>
                        </li>
                        <li class="list-inline-item float-right me-4">
                            <b>Caregiver Signature</b>
                        </li>
                    </ul>
                </div>
            </form>
            <ul class="list-inline mt-3 no-print">
                <li class="list-inline-item">
                    <a href="#" data-target="#signatureModal" data-toggle="modal">Provider Signature<i class="fa fa-signature"></i></a>
                </li>
                <li class="list-inline-item float-right">
                    <a href="#" data-target="#signatureModal2" data-toggle="modal">Caregiver Signature<i class="fa fa-signature"></i></a>
                </li>
            </ul>
        </div>

        <div class="section_bottom no-print">
            <div class="button-row flex-div">
                <div class="save-prog"><button type="button" id="save_form"><span class="cloud-icon"><i
                                class="fas fa-cloud"></i></span>
                        Save</button></div>
                <div class="print"><button type="button" id="pdf_btn"><span class="print-icon"><i
                                class="fas fa-print"></i></span>Print</button>
                </div>
            </div>
        </div>
        <form id="signature_form" action="" method="POST" enctype="multipart/form-data">
            @csrf
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
<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> --}}
{{-- <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script> --}}
<script src="{{asset('assets/dashboard/template/')}}/jquery-print.min.js" type="text/javascript"></script>
@include('superadmin.appoinment.include.forms_js_include')

<script>
    check="{{$check}}";
    if(check=="new"){
        $('#pdf_btn').hide();
    }
    data=<?php echo $data;?>;
    console.log(data);
    session_id="{{$session_id}}";
    form_id="{{$form_id}}";
    sign1="{{$sign1}}";
    sign2="{{$sign2}}";
    if(sign1 != null){
        $('.sign1').attr("src",'{{asset("/")}}'+sign1);
    }
    if(sign2 != null) {
        $('.sign2').attr("src",'{{asset("/")}}'+sign2);
    }
    //console.log(data);
    const formRenderInstance=$('.render-wrap').formRender({
        formData: data,
    });

    $('form label').filter(function () {
        return !$(this).prev().is('[type="radio"], [type="checkbox"]')
    }).addClass('custom_label');

    $('#save_form').click(function(){
        $('#signature_form').submit();
    });

    $(document).on('submit','#signature_form',function(e){
        e.preventDefault();
        user_data = formRenderInstance.userData;
        user_data=JSON.stringify(user_data);
        let canvas2 = document.getElementById('sig-canvas');
        let canvas3 = document.getElementById('sig-canvas2');
        let dataURL2 = canvas2.toDataURL();
        let dataURL3 = canvas3.toDataURL();

        let sing_draw = $('.sing_draw').val(dataURL2);
        let sing_draw2 = $('.sing_draw2').val(dataURL3);
        var formData = new FormData(this);
        formData.append('filled_form',user_data);
        formData.append('session_id',session_id);
        formData.append('form_id',form_id);
        $.ajax({
            type: "POST",
            url: "{{ route('superadmin.setting.forms.builder.save.data') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success: function (data) {
                console.log(data);
                sign1=data.sign1;
                sign2=data.sign2;
                if(sign1 != null){
                    $('.sign1').attr("src",'{{asset("/")}}'+sign1);
                }
                if(sign2 != null) {
                    $('.sign2').attr("src",'{{asset("/")}}'+sign2);
                }
                toastr["success"]('Form is submitted successfully!','SUCCESS!');
                $('#pdf_btn').show();
                $('.loading2').hide();
            }
        });
        
    });

    $('#pdf_btn').click(function(){
           // window.print();
           // return false;

           $('.treatment-plan').print({
                globalStyles: true,
                mediaPrint: false,
                stylesheet: "{{asset('assets/dashboard/template/')}}/print-style.css",
                noPrintSelector: ".no-print",
                iframe: true,
                append: null,
                prepend: null,
                manuallyCopyFormValues: true,
                deferred: $.Deferred(),
                timeout: 750,
                title: "{{$title}}",
                doctype: '<!doctype html>'
            });
    });
    $("textarea").each(function () {
      this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
    }).on("input", function () {
      this.style.height = "auto";
      this.style.height = (this.scrollHeight) + "px";
    });

    // function convertPtToInch(pt) { return pt / 72; }
    // function convertInchToMM(inch) { return inch * 25.4; }
    // function convertPtToMM(pt) {
    //     return convertInchToMM(convertPtToInch(pt));
    // }

</script>
@include('superadmin.include.forms_js_include')
</body>

</html>
