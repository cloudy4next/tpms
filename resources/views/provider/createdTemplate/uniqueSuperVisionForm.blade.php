<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unique Supervision Form</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/temone/')}}/css/custom-1.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">

    <style>
      .logo_img{
        width: 100px;
        height: 100px;
      }
    </style>
</head>

<body>
<div class="uniq-supervisim-form">
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
            <h1>Unique Supervision Form</h1>
        </div>
        <form action="{{route('provider.usp.form.one.submit')}}" method="post" id="usp_one_form">
            @csrf
            <section class="section_1 mb_30">
                <table cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="clname">Trainee:</label>
                    </span> <span>
                      <input type="text" id="clname" name="tr_name" class="tr_name" value="{{$form_one->tr_name}}">
                      <input type="hidden" id="clname" name="sessionid" class="sessionid" value="{{$session_id}}">
                    </span>
                            </div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="start-time">Start Time:</label>
                    </span> <span>
                      <input type="time" id="start-time" name="starttm" class="tr_name" value="{{\Carbon\Carbon::parse($form_one->starttm)->format('H:i:s')}}">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="date">Date:</label>
                    </span> <span>
                      <input type="date" id="date" name="stdate" class="stdate" value="{{$form_one->stdate}}">
                    </span></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="supervisor">Supervisor:</label>
                    </span> <span>
                      <input type="text" id="supervisor" name="supervisor" value="{{$form_one->supervisor}}"
                             class="supervisor">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="end-time">End Time:</label>
                    </span> <span>
                      <input type="time" id="end-time" name="endtime" class="endtime" value="{{\Carbon\Carbon::parse($form_one->endtime)->format('H:i:s')}}">
                    </span></div>
                        </td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_2 mb_30">
                <div class="flex-div">
                    <div class="col-item">
                        <div class="box box1 mb_30">
                            <table>
                                <thead>
                                <tr>
                                    <th colspan="2">Independent Hours</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><label for="experience">Experience Type</label></td>
                                    <td><input id="experience" type="text" name="exptyp" value="{{$form_one->exptyp}}"
                                               class="exptyp"></td>
                                </tr>
                                <tr>
                                    <td><label for="setting-name">Setting Name</label></td>
                                    <td><input id="setting-name" type="text" name="stgname"
                                               value="{{$form_one->stgname}}" class="stgname"></td>
                                </tr>
                                <tr>
                                    <td><label for="setting-name">Activity Category</label></td>
                                    <td>
                                        <div class="flex-div select-area"><span>
                            <input id="restricted" type="radio" name="actcat" class="actcat"
                                   {{$form_one->actcat == 1 ? 'checked' : ''}} value="1">
                            <label for="restricted">Restricted</label>
                          </span> <span>
                            <input id="unrestricted" type="radio" name="actcat"
                                   {{$form_one->actcat == 2 ? 'checked' : ''}} class="actcat" value="2">
                            <label for="unrestricted">Unrestricted</label>
                          </span></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="textarea-part" colspan="2"><label for="activity-note">Activity Note <span
                                                class="bracket">(client Initials):</span></label>
                                        <br>
                                        <div class="textarea">
                                            <textarea id="activity-note" name="actnote" class="actnote"
                                                      rows="5">{!! $form_one->actnote !!}</textarea>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="box box2 mb_30">
                            <table>
                                <thead>
                                <tr>
                                    <th colspan="2">Month Supervision Period</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><label for="total-hours">Total Hours of Supervision:</label></td>
                                    <td><input id="total-hours" type="time" name="tlhrs" value="{{\Carbon\Carbon::parse($form_one->tlhrs)->format('H:i:s')}}"
                                               class="tlhrs"></td>
                                </tr>
                                <tr>
                                    <td><label for="total-contacts">Total Number of Contacts:</label></td>
                                    <td><input id="total-contacts" type="text" maxlength="4" name="tlcon"
                                               value="{{$form_one->tlcon}}" class="tlcon">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="individual2">Individual:</label></td>
                                    <td><input id="individual2" type="text" name="individual"
                                               value="{{$form_one->individual}}" class="individual"></td>
                                </tr>
                                <tr>
                                    <td><label for="group2">Group:</label></td>
                                    <td><input id="group2" type="text" name="group2" value="{{$form_one->group2}}"
                                               class="group2"></td>
                                </tr>
                                <tr>
                                    <td><label for="trainee-with-clnt">Total number of Observations of the Trainee with
                                            Clients:</label>
                                    </td>
                                    <td><input id="trainee-with-clnt" type="text" name="traineewithclnt"
                                               value="{{$form_one->traineewithclnt}}"
                                               class="traineewithclnt"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-item">
                        <table>
                            <thead>
                            <tr>
                                <th colspan="2">Supervised Hours:</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><label>Format:</label></td>
                                <td>
                                    <div class="flex-div select-area"> <span>
                          <input id="person" type="radio" name="formate"
                                 {{$form_one->formate == 1 ? 'checked' : ''}} class="formate" value="1">
                          <label for="person">person</label>
                        </span> <span>
                          <input id="online" type="radio" name="formate"
                                 {{$form_one->formate == 2 ? 'checked' : ''}} class="formate" value="2">
                          <label for="online">Online</label>
                        </span></div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="experience-2">Experience Types </label></td>
                                <td><input id="experience-2" type="text" name="experience2"
                                           value="{{$form_one->experience2}}" class="experience2"></td>
                            </tr>
                            <tr>
                                <td><label>Supervision Type</label></td>
                                <td>
                                    <div class="flex-div select-area"><span>
                          <input id="supervision-type" type="radio" name="supervisiontype"
                                 {{$form_one->supervisiontype == 1 ? 'checked' : ''}} class="supervisiontype"
                                 value="1">
                          <label for="supervision-type">Individual</label>
                        </span> <span>
                          <input id="supervision-group" type="radio" name="supervisiontype"
                                 {{$form_one->supervisiontype == 2 ? 'checked' : ''}} class="supervisiontype"
                                 value="2">
                          <label for="supervision-group">Group</label>
                        </span></div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Activity Category</label></td>
                                <td>
                                    <div class="flex-div select-area"> <span>
                          <input id="restricted2" type="radio" name="actcat2"
                                 {{$form_one->actcat2 == 1 ? 'checked' : ''}} class="actcat2" value="1">
                          <label for="restricted2">Restricted</label>
                        </span> <span>
                          <input id="unrestricted2" type="radio" name="actcat2"
                                 {{$form_one->actcat2 == 2 ? 'checked' : ''}} class="actcat2" value="2">
                          <label for="unrestricted2">Unrestricted</label>
                        </span></div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="bst-task">BST - Task List Item: </label></td>
                                <td><input id="bst-task" type="text" name="bsttask" value="{{$form_one->bsttask}}"
                                           class="bsttask"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="textarea-part">
                                        <label for="summery-supervision">Summary of Supervision Activities:</label>
                                        <br>
                                        <div class="textarea">
                                            <textarea id="summery-supervision" name="sumsup" class="sumsup"
                                                      rows="3">{!! $form_one->sumsup !!}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="textarea-part">
                                        <label for="supervision-feedback">Supervisor Feedback: </label>
                                        <br>
                                        <div class="textarea">
                                            <textarea id="supervision-feedback" name="supfeed" class="supfeed"
                                                      rows="3">{!! $form_one->supfeed !!}</textarea>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="action-item">Action Items (Homework/research):</label></td>
                                <td><input id="action-item" type="text" name="actitem" value="{{$form_one->actitem}}"
                                           class="actitem"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="section_3">
                <div class="box box-last_2">
                    <div class="flex-div mb_40">
                        <div class="col-item">
                            <div class="holder-div">
                                <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i
                                class="fa fa-signature"></i></a>
                                <br>
                                <span>
                    <label for="bacb-sign">Supervisee/BACB ID#</label>
                    <input maxlength="4" type="text" name="bcbaid" value="{{$form_one->bcbaid}}" class="bcbaid">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="holder-div">
                                <input id="bacb-sign-date" type="date" name="signdate" value="{{$form_one->signdate}}"
                                       class="signdate">
                                <br>
                                <label for="bacb-sign-date">Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="flex-div">
                        <div class="col-item">
                            <div class="holder-div">
                                <a href="#" data-target="#signatureModal2" data-toggle="modal">Add Signature<i
                                class="fa fa-signature"></i></a>
                                <br>
                                <span>
                    <label for="suupervisor-sign">Supervisor/BACB ID#</label>
                    <input maxlength="4" type="text" name="bacbid2" value="{{$form_one->bacbid2}}" class="bacbid2">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="holder-div">
                                <input id="suupervisor-sign-date" type="date" name="signdate2"
                                       value="{{$form_one->signdate2}}" class="signdate2">
                                <br>
                                <label for="suupervisor-sign-date">Date</label>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section_bottom">
                <div class="button-row flex-div">
                    <div class="save-prog">
                        <button type="submit" class="btn"><span class="cloud-icon"><i
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

        <form class="pdf_form" action="{{ route('provider.print.form.1')}}" target="_blank" method="POST">
            @csrf
            <input type="hidden" name="session_id" class="session_id" value="{{$session_id}}">
        </form>
    </div>
</div>
<!-- signature modal -->

<!--/ signature modal -->
<!-- Jq Files -->
<script src="{{asset('assets/dashboard/')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/bootstrap.min.js"></script>

<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>

<!-- Signature -->
<script>
    $(document).ready(function () {

        $(document).on('click','.pdf_btn',function(){
            $('.pdf_form').submit();
        })


        let sessionid = $('.sessionid').val();

        $(document).on('submit', '#usp_one_form', function (e) {
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
                url: "{{route('provider.usp.form.one.submit')}}",
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
