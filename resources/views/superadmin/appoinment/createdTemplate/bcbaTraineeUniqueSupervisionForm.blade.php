<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCBA Trainee Unique Supervision Form</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/temfour/')}}/css/custom-4.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">

    <style>
      .logo_img{
        width: 100px;
        height: 100px;
      }
    </style>
</head>

<body>
<div class="bcba-uniq-supervision">
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
            <h1>BCBA Trainee Unique Supervision Form</h1>
        </div>
        <form action="{{route('superadmin.btusf.form.four.submit')}}" method="post" id="btusf_four_form">
            @csrf
            <section class="section_1 mb_30">
                <table cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="date">Date:</label>
                    </span> <span>
                      <input type="date" id="date" name="stdate" value="{{$form_four->stdate}}" class="stdate">
                      <input type="hidden" id="" name="sessionid" value="{{$session_id}}">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="time">Time:</label>
                    </span> <span>
                      <input type="text" id="time" name="sttime" value="{{$form_four->sttime}}" class="sttime">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="trainee">Trainee:</label>
                    </span> <span>
                      <input type="text" id="trainee" name="trainee" value="{{$form_four->trainee}}" class="trainee">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="restrict-hours">Restricted Hours:</label>
                    </span> <span>
                      <input type="text" id="restrict-hours" name="restricthours" value="{{$form_four->restricthours}}"
                             class="restricthours">
                    </span></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="setting">Setting:</label>
                    </span> <span>
                      <input type="text" id="setting" name="setting" value="{{$form_four->setting}}" class="setting">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="num-client">Number of Clients:</label>
                    </span> <span>
                      <input type="text" maxlength="5" id="num-client" name="numclient"
                             value="{{$form_four->numclient}}" class="numclient">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="c-purchaging">Credential Pursuing:</label>
                    </span> <span>
                      <input type="text" id="c-purchaging" name="cpurchaging" value="{{$form_four->cpurchaging}}"
                             class="cpurchaging">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="unrestrict-hours">Unrestricted Hours:</label>
                    </span> <span>
                      <input type="text" id="unrestrict-hours" name="unrestricthours"
                             value="{{$form_four->unrestricthours}}" class="unrestricthours">
                    </span></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex-div"><span>
                      <label for="supervising-bcba">Supervising BCBA: </label>
                    </span> <span>
                      <input type="text" id="supervising-bcba" name="supervisingbcba"
                             value="{{$form_four->supervisingbcba}}" class="supervisingbcba">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="bcba">BCBA: </label>
                    </span> <span>
                      <input type="text" maxlength="5" id="bcba" name="bcba" value="{{$form_four->bcba}}" class="bcba">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="session-length">Session Length:</span></label>
                                </span> <span>
                      <input type="text" id="session-length" name="seslength" value="{{$form_four->seslength}}"
                             class="seslength">
                    </span></div>
                        </td>
                        <td>
                            <div class="flex-div"><span>
                      <label for="no-hs">Number of Hours Supervised:</label>
                    </span> <span>
                      <input type="text" id="no-hs" name="nohs" value="{{$form_four->nohs}}" class="nohs">
                    </span></div>
                        </td>
                    </tr>
                    <!-- <tr>
                    <td colspan="4"><div class="flex-div"><span>
                        <label for="no-hour-s">Total Number of Hours for Supervisory Period: </label>
                        </span> <span>
                        <input type="text="no-hour-s" name="no-hour-s">
                        </span></div></td>
                  </tr>-->
                    </tbody>
                </table>
            </section>
            <section class="section_2 mb_30">
                <div class="box box1 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="topic-feedback">Type of Supervision: </label>
                        </h3>
                    </div>
                    <ul class="checkbox-area">
                        <li>
                            <div class="flex-div"> <span>
                    <input id="person" type="checkbox" name="suptypes1"
                           {{$form_four->suptypes1 == 1 ? 'checked' : ''}} class="suptypes1" value="1">
                    <label for="person">In person </label>
                  </span></div>
                        </li>
                        <li>
                            <div class="flex-div"> <span>
                    <input id="telehealth" type="checkbox" name="suptypes2"
                           {{$form_four->suptypes2 == 1 ? 'checked' : ''}} class="suptypes2" value="1">
                    <label for="telehealth">Telehealth</label>
                  </span></div>
                        </li>
                        <li>
                            <div class="flex-div"> <span>
                    <input id="group-meeting" type="checkbox" name="suptypes3"
                           {{$form_four->suptypes3 == 1 ? 'checked' : ''}} class="suptypes3" value="1">
                    <label for="group-meeting">Group Meeting </label>
                  </span></div>
                        </li>
                    </ul>
                </div>
            </section>
            <section class="section_3">
                <div class="inner-main-title">
                    <h2>Evaluation of Performance</h2>
                </div>
                <div class="box box1 mb_30">
                    <div class="col-title mb_15">
                        <h3>Evaluation of Supervisee Performance:
                            </label>
                        </h3>
                    </div>
                    <p class="red"><strong><span>S</span> – satisfactory <span>NI</span> - needs improvement
                            <span>U</span> -
                            unsatisfactory <span>N/A</span> – not applicable</strong></p>
                    <div class="evaluation-of-performance">
                        <ul>
                            <li>Arrives on time for supervision: <br>
                                <div class="select-area"> <span>
                      <input type="radio" id="s1" name="arotime" class="arotime"
                             {{$form_four->arotime == 1 ? 'checked' : ''}} value="1">
                      <label for="s1">S</label>
                    </span> <span>
                      <input type="radio" id="ni1" name="arotime" class="arotime"
                             {{$form_four->arotime == 2 ? 'checked' : ''}} value="2">
                      <label for="ni1">NI</label>
                    </span> <span>
                      <input type="radio" id="u1" name="arotime" class="arotime"
                             {{$form_four->arotime == 3 ? 'checked' : ''}} value="3">
                      <label for="u1">U</label>
                    </span> <span>
                      <input type="radio" id="na1" name="arotime" class="arotime"
                             {{$form_four->arotime == 4 ? 'checked' : ''}} value="4">
                      <label for="na1">N/A</label>
                    </span></div>
                            </li>
                            <li>Maintains professional and courteous interactions with: Clients/consumers Other service
                                providers/
                                Coworkers:<br>
                                <div class="select-area"> <span>
                      <input type="radio" id="s2" name="coworkers" class="coworkers"
                             {{$form_four->coworkers == 1 ? 'checked' : ''}} value="1">
                      <label for="s2">S</label>
                    </span> <span>
                      <input type="radio" id="ni2" name="coworkers" class="coworkers"
                             {{$form_four->coworkers == 2 ? 'checked' : ''}} value="2">
                      <label for="ni2">NI</label>
                    </span> <span>
                      <input type="radio" id="u2" name="coworkers" class="coworkers"
                             {{$form_four->coworkers == 3 ? 'checked' : ''}} value="3">
                      <label for="u2">U</label>
                    </span> <span>
                      <input type="radio" id="na2" name="coworkers" class="coworkers"
                             {{$form_four->coworkers == 4 ? 'checked' : ''}} value="4">
                      <label for="na2">N/A</label>
                    </span></div>
                            </li>
                            <li>Maintains appropriate attire & demeanor Initiates professional self-improvement: <br>
                                <div class="select-area"> <span>
                      <input type="radio" id="s3" name="selfimprovement" class="selfimprovement"
                             {{$form_four->selfimprovement == 1 ? 'checked' : ''}} value="1">
                      <label for="s3">S</label>
                    </span> <span>
                      <input type="radio" id="ni3" name="selfimprovement" class="selfimprovement"
                             {{$form_four->selfimprovement == 2 ? 'checked' : ''}} value="2">
                      <label for="ni3">NI</label>
                    </span> <span>
                      <input type="radio" id="u3" name="selfimprovement" class="selfimprovement"
                             {{$form_four->selfimprovement == 3 ? 'checked' : ''}} value="3">
                      <label for="u3">U</label>
                    </span> <span>
                      <input type="radio" id="na3" name="selfimprovement" class="selfimprovement"
                             {{$form_four->selfimprovement == 4 ? 'checked' : ''}} value="4">
                      <label for="na3">N/A</label>
                    </span></div>
                            </li>
                            <li>Accepts supervisory feedback appropriately: <br>
                                <div class="select-area"> <span>
                      <input type="radio" id="s4" name="appropriately" class="appropriately"
                             {{$form_four->appropriately == 1 ? 'checked' : ''}} value="1">
                      <label for="s4">S</label>
                    </span> <span>
                      <input type="radio" id="ni4" name="appropriately" class="appropriately"
                             {{$form_four->appropriately == 2 ? 'checked' : ''}} value="2">
                      <label for="ni4">NI</label>
                    </span> <span>
                      <input type="radio" id="u4" name="appropriately" class="appropriately"
                             {{$form_four->appropriately == 3 ? 'checked' : ''}} value="3">
                      <label for="u4">U</label>
                    </span> <span>
                      <input type="radio" id="na4" name="appropriately" class="appropriately"
                             {{$form_four->appropriately == 4 ? 'checked' : ''}} value="4">
                      <label for="na4">N/A</label>
                    </span></div>
                            </li>
                            <li>Seeks supervision appropriately/ asks questions when needed: <br>
                                <div class="select-area"> <span>
                      <input type="radio" id="s5" name="seeks" class="seeks"
                             {{$form_four->seeks == 1 ? 'checked' : ''}} value="1">
                      <label for="s5">S</label>
                    </span> <span>
                      <input type="radio" id="ni5" name="seeks" class="seeks"
                             {{$form_four->seeks == 2 ? 'checked' : ''}} value="2">
                      <label for="ni5">NI</label>
                    </span> <span>
                      <input type="radio" id="u5" name="seeks" class="seeks"
                             {{$form_four->seeks == 3 ? 'checked' : ''}} value="3">
                      <label for="u5">U</label>
                    </span> <span>
                      <input type="radio" id="na5" name="seeks" class="seeks"
                             {{$form_four->seeks == 4 ? 'checked' : ''}} value="4">
                      <label for="na5">N/A</label>
                    </span></div>
                            </li>
                            <li>Timely submission of tasks assigned: <br>
                                <div class="select-area"> <span>
                      <input type="radio" id="s6" name="submission" class="submission"
                             {{$form_four->submission == 1 ? 'checked' : ''}} value="1">
                      <label for="s6">S</label>
                    </span> <span>
                      <input type="radio" id="ni6" name="submission" class="submission"
                             {{$form_four->submission == 2 ? 'checked' : ''}} value="2">
                      <label for="ni6">NI</label>
                    </span> <span>
                      <input type="radio" id="u6" name="submission" class="submission"
                             {{$form_four->submission == 3 ? 'checked' : ''}} value="3">
                      <label for="u6">U</label>
                    </span> <span>
                      <input type="radio" id="na6" name="submission" class="submission"
                             {{$form_four->submission == 4 ? 'checked' : ''}} value="4">
                      <label for="na6">N/A</label>
                    </span></div>
                            </li>
                            <li>Communicates effectively:<br>
                                <div class="select-area"> <span>
                      <input type="radio" id="s7" name="communicates" class="communicates"
                             {{$form_four->communicates == 1 ? 'checked' : ''}} value="1">
                      <label for="s7">S</label>
                    </span> <span>
                      <input type="radio" id="ni7" name="communicates" class="communicates"
                             {{$form_four->communicates == 2 ? 'checked' : ''}} value="2">
                      <label for="ni7">NI</label>
                    </span> <span>
                      <input type="radio" id="u7" name="communicates" class="communicates"
                             {{$form_four->communicates == 3 ? 'checked' : ''}} value="3">
                      <label for="u7">U</label>
                    </span> <span>
                      <input type="radio" id="na7" name="communicates" class="communicates"
                             {{$form_four->communicates == 4 ? 'checked' : ''}} value="4">
                      <label for="na7">N/A</label>
                    </span></div>
                            </li>
                            <li>Demonstrates appropriate sensitivity to nonbehavioral providers <span class="red">(teachers, other
                    healthcare providers, caregivers etc)</span>:<br>
                                <div class="select-area"> <span>
                      <input type="radio" id="s8" name="sensitivity" class="sensitivity"
                             {{$form_four->sensitivity == 1 ? 'checked' : ''}} value="1">
                      <label for="s8">S</label>
                    </span><span>
                      <input type="radio" id="ni8" name="sensitivity" class="sensitivity"
                             {{$form_four->sensitivity == 2 ? 'checked' : ''}} value="2">
                      <label for="ni8">NI</label>
                    </span> <span>
                      <input type="radio" id="u8" name="sensitivity" class="sensitivity"
                             {{$form_four->sensitivity == 3 ? 'checked' : ''}} value="3">
                      <label for="u8">U</label>
                    </span> <span>
                      <input type="radio" id="na8" name="sensitivity" class="sensitivity"
                             {{$form_four->sensitivity == 4 ? 'checked' : ''}} value="4">
                      <label for="na8">N/A</label>
                    </span></div>
                            </li>
                            <li>Acquisition of target behavior-analytic skills:<br>
                                <div class="select-area"> <span>
                      <input type="radio" id="s9" name="behanalytic" class="behanalytic"
                             {{$form_four->behanalytic == 1 ? 'checked' : ''}} value="1">
                      <label for="s9">S</label>
                    </span> <span>
                      <input type="radio" id="ni9" name="behanalytic" class="behanalytic"
                             {{$form_four->behanalytic == 2 ? 'checked' : ''}} value="2">
                      <label for="ni9">NI</label>
                    </span> <span>
                      <input type="radio" id="u9" name="behanalytic" class="behanalytic"
                             {{$form_four->behanalytic == 3 ? 'checked' : ''}} value="3">
                      <label for="u9">U</label>
                    </span> <span>
                      <input type="radio" id="na9" name="behanalytic" class="behanalytic"
                             {{$form_four->behanalytic == 4 ? 'checked' : ''}} value="4">
                      <label for="na9">N/A</label>
                    </span></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            <section class="section_4 mb_30">
                <div class="box box1 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="topic-feedback">Topics/Feedback Discussed in Supervision/Follow up:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="topic-feedback" name="feeds" cols="feeds"
                                  rows="5">{!! $form_four->feeds !!}</textarea>
                    </div>
                </div>
                <div class="box box2">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="needs">Task List Items Covered:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="needs" rows="5" name="tlic" class="tlic">{!! $form_four->tlic !!}</textarea>
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
                    <input maxlength="4" type="text" name="bacb" value="{{$form_four->bacb}}" class="bacb">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="holder-div">
                                <input id="bacb-sign-date" type="date" name="bacbdate" value="{{$form_four->bacbdate}}"
                                       class="bacbdate">
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
                    <input maxlength="4" type="text" name="bacb2" value="{{$form_four->bacb2}}">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="holder-div">
                                <input id="suupervisor-sign-date" type="date" name="bacbdate2"
                                       value="{{$form_four->bacbdate2}}" class="bacbdate2">
                                <br>
                                <label for="suupervisor-sign-date">Date</label>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section_bottom">
                <div class="button-row flex-div">
                    {{-- <div class="mark-sign"><a href="#signatureModal" data-toggle="modal"><span class="mark-icon"><i
                                    class="fas fa-check"></i></span> Mark Completed
                            and Sign</a></div> --}}
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
        <form class="pdf_form" action="{{ route('superadmin.print.form.4')}}" target="_blank" method="POST">
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

    $(document).on('click','.pdf_btn',function(){
            $('.pdf_form').submit();
        })

    $(document).on('submit', '#btusf_four_form', function (e) {
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
            url: "{{route('superadmin.btusf.form.four.submit')}}",
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
</script>
@include('superadmin.appoinment.include.forms_js_include')

</body>

</html>
