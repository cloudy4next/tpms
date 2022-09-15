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
    <title>Therapist Communication/Session Notes</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/temsix/')}}/css/custom-6.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
      .logo_img{
        width: 100px;
        height: 100px;
      }
    </style>
</head>

<body>
<div class="therapist-session-note">
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
            <h1>Therapist Communication/Session Notes <br>
            </h1>
            <span class="bracket"><u><b>Each section must be filled in its entirety.</b></u> If an area does not apply
          during a session date, Please write N/A or none</span>
        </div>
        <form action="{{route('superadmin.tcsn.six.form.submit')}}" method="post" id="tcsn_six_form">
            @csrf
            <section class="section_1">
                <div class="box box_1">
                    <div class="flex-div row-flex div_33 mb_30">
                        <div class="col-item">
                            <div class="flex-div"> <span>
                    <label for="clname">Client Full Name:</label>
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
                    <label for="start-time">Start Time:</label>
                  </span> <span>
                    <input id="start-time" type="time" name="sttime" value="{{\Carbon\Carbon::parse($cl->from_time)->format('H:i:s')}}">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div"> <span>
                    <label for="end-time">End Time:</label>
                  </span> <span>
                    <input id="end-time" type="time" name="endtime" value="{{\Carbon\Carbon::parse($cl->to_time)->format('H:i:s')}}">
                  </span></div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div">
                                <div>
                                    <label>Setting:</label>
                                </div>
                                <div class="check-box-area">
                                    <ul>
                                        <li><span>
                          <input id="home" type="checkbox" name="setting1" value="1">
                        </span><span>
                          <label for="home">Home</label>
                        </span></li>
                                        <li><span>
                          <input id="center" type="checkbox" name="setting2" value="1">
                        </span> <span>
                          <label for="center">Center</label>
                        </span></li>
                                        <li><span>
                          <input id="community" type="checkbox" name="setting3" value="1">
                        </span> <span>
                          <label for="community">Community</label>
                        </span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div">
                                <div>
                                    <label>People Present</label>
                                </div>
                                <div class="check-box-area">
                                    <ul>
                                        <li><span>
                          <input id="pclient" type="checkbox" name="pepresent1" value="1">
                        </span><span>
                          <label for="pclient">Client</label>
                        </span></li>
                                        <li><span>
                          <input id="ptherapist" type="checkbox" name="pepresent2" value="1">
                        </span> <span>
                          <label for="ptherapist">Therapist</label>
                        </span></li>
                                        <li><span>
                          <input id="pparent" type="checkbox" name="pepresent3" value="1">
                        </span> <span>
                          <label for="pparent">Parent</label>
                        </span></li>
                                        <li><span>
                          <input id="pcaregiver" type="checkbox" name="pepresent4" value="1">
                        </span><span>
                          <label for="pcaregiver">Caregiver</label>
                        </span></li>
                                        <li><span>
                          <input id="pbcba" type="checkbox" name="pepresent5" value="1">
                        </span> <span>
                          <label for="pbcba">BCBA</label>
                        </span></li>
                                        <li><span>
                          <input id="pother" type="checkbox" name="pepresent6" value="1">
                        </span> <span>
                          <label for="pother">Other:</label>
                          <input type="text" name="pepresentiotr">
                        </span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section_2 mb_40">
                <div class="box box_1">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td rowspan="2">Any dangerous behaviors during session? <span class="red bracket">(circle all that
                    apply)</span></td>
                            <td>
                                <div class="flex-div"> <span>
                      <input id="aggression" type="checkbox" name="dangerousbehave1" value="1">
                    </span><span>
                      <label for="aggression">Aggression</label>
                    </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                      <input id="non-c" type="checkbox" name="dangerousbehave2" value="1">
                    </span><span>
                      <label for="non-c">Non-compliance</label>
                    </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                      <input id="leaving-area" type="checkbox" name="dangerousbehave3" value="1">
                    </span><span>
                      <label for="leaving-area">Leaving area</label>
                    </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                      <input id="inattention" type="checkbox" name="dangerousbehave4" value="1">
                    </span><span>
                      <label for="inattention">Inattention</label>
                    </span></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="flex-div"> <span>
                      <input id="diff-to-motive" type="checkbox" name="dangerousbehave5" value="1">
                    </span><span>
                      <label for="diff-to-motive">Difficult to motivate</label>
                    </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                      <input id="obsessive" type="checkbox" name="dangerousbehave6" value="1">
                    </span><span>
                      <label for="obsessive">Obsessive/preservative</label>
                    </span></div>
                            </td>
                            <td colspan="2">
                                <div class="flex-div"> <span>
                      <input id="dangerous-other" type="checkbox" name="dangerousbehave7" value="1">
                    </span><span class="other">
                      <label for="dangerous-other">Other:</label>
                      <input type="text" name="dangerousbehaveotr">
                    </span></div>
                            </td>
                        </tr>
                        <tr>
                            <td>ABC LOG</td>
                            <td colspan="4">
                                <div class="flex-div">
                                    <label> Was an ABC Log completed on new or challenging behaviors? </label>
                                    <div class="check-box-area">
                                        <ul>
                                            <li><span>
                            <input id="challange-b-yes" type="radio" name="chabehaviors" value="1">
                          </span><span>
                            <label for="challange-b-yes">Yes</label>
                          </span></li>
                                            <li><span>
                            <input id="challange-b-no" type="radio" name="chabehaviors" value="2">
                          </span> <span>
                            <label for="challange-b-no">No</label>
                          </span></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2">Interventions utilized <span
                                    class="red bracket">(circle all that apply)</span>:
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                      <input id="dtt" type="checkbox" name="dtt" value="1">
                    </span><span>
                      <label for="dtt">Discrete trial training (DTT)</label>
                    </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                      <input id="net" type="checkbox" name="net" value="1">
                    </span><span>
                      <label for="net">Natural Environment Training (NET)</label>
                    </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                      <input id="mt" type="checkbox" name="mt" value="1">
                    </span><span>
                      <label for="mt">Mand training <span class="red bracket">(requests)</span></label>
                    </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                      <input id="ta" type="checkbox" name="ta" value="1">
                    </span><span>
                      <label for="ta">Task analysis (TA)</label>
                    </span></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="flex-div"> <span>
                      <input id="bip" type="checkbox" name="bip" value="1">
                    </span><span>
                      <label for="bip">Behavior Intervention Plan (BIP)</label>
                    </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                      <input id="shaping" type="checkbox" name="shaping" value="1">
                    </span><span>
                      <label for="shaping">Shaping</label>
                    </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                      <input id="bst" type="checkbox" name="bst" value="1">
                    </span><span>
                      <label for="bst">Behavior Skills Training (BST)</label>
                    </span></div>
                            </td>
                            <td colspan="2">
                                <div class="flex-div"> <span>
                      <input id="iu-other" type="checkbox" name="iuotrcheck" value="1">
                    </span><span class="other">
                      <label for="iu-other">Other:</label>
                      <input type="text" name="iuotrchecktxt">
                    </span></div>
                            </td>
                        </tr>
                    </table>
                    <table class="table_2" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td rowspan="3">Program areas worked on<span
                                    class="red bracket">(circle all that apply)</span>:
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="communication" type="checkbox" name="prarcom" value="1">
                      </span><span>
                        <label for="communication">Communication</label>
                      </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="p-reports" type="checkbox" name="proarpair" value="1">
                      </span><span>
                        <label for="p-reports">Pairing/Rapport</label>
                      </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="social-link" type="checkbox" name="proarscoial" value="1">
                      </span><span>
                        <label for="social-link">Social Skills</label>
                      </span></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="self-care" type="checkbox" name="proarsc" value="1">
                      </span><span>
                        <label for="self-care">Adaptive/Self-care</label>
                      </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="play-skill" type="checkbox" name="proarpsk" value="1">
                      </span><span>
                        <label for="play-skill">Play Skills</label>
                      </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="fluency" type="checkbox" name="proarflu" value="1">
                      </span><span>
                        <label for="fluency">Fluency</label>
                      </span></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="tolerance" type="checkbox" name="proartnc" value="1">
                      </span><span>
                        <label for="tolerance">Tolerance of Novelty/Changes</label>
                      </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="regulation" type="checkbox" name="proarsmr" value="1">
                      </span><span>
                        <label for="regulation">Self-Management/Regulation</label>
                      </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="program-other" type="checkbox" name="proarotr" value="1">
                      </span><span class="other">
                        <label for="program-other">Other:</label>
                        <input type="text" name="proarotrtxt">
                      </span></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table_3">
                        <tbody>
                        <tr>
                            <td rowspan="2">Client independent responding over entire session</td>
                            <td><label>1</label>
                            </td>
                            <td><label>2</label>
                            </td>
                            <td><label>3</label>
                            </td>
                            <td><label>4</label>
                            </td>
                            <td><label>5</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="f-correct" type="checkbox" name="ensession1" value="1">
                      </span><span>
                        <label for="f-correct">Few correct</label>
                      </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="s-correct" type="checkbox" name="ensession2" value="1">
                      </span><span>
                        <label for="s-correct">Some correct</label>
                      </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="m-correct" type="checkbox" name="ensession3" value="1">
                      </span><span>
                        <label for="m-correct">Most correct</label>
                      </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="all-correct" type="checkbox" name="ensession4" value="1">
                      </span><span>
                        <label for="all-correct">all correct</label>
                      </span></div>
                            </td>
                            <td>
                                <div class="flex-div"> <span>
                        <input id="none-correct" type="checkbox" name="ensession5" value="1">
                      </span><span>
                        <label for="none-correct">None correct</label>
                      </span></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="section_3 mb_40">
                <table cellpadding="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td colspan="2"><label for="motivating">Things that were motivating/wanted <span
                                    class="red bracket">(even
                      if for problem behavior)</span>:</label>
                            <br>
                            <textarea rows="2" id="motivating" type="text" name="motivating"> </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="well">What went well?</label>
                            <br>
                            <textarea rows="2" id="well" type="text" name="well"></textarea>
                        </td>
                        <td><label for="struggle">What was a struggle?</label>
                            <br>
                            <textarea rows="2" id="struggle" type="text" name="struggle"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="help">What do you need or need help with?</label>
                            <br>
                            <textarea rows="2" id="help" type="text" name="help"> </textarea>
                        </td>
                        <td><label>If this was a supervision session check the appropriate box</label>
                            <br>
                            <div class="flex-div"> <span>
                      <input id="my-q" type="checkbox" name="supsession1" value="1">
                    </span> <span>
                      <label for="my-q">My questions can wait until next supervision session</label>
                    </span></div>
                            <div class="flex-div"> <span>
                      <input id="clarification" type="checkbox" name="supsession2" value="1">
                    </span> <span>
                      <label for="clarification">I still need more clarification on some things before my next
                        session</label>
                    </span></div>
                            <div class="flex-div"> <span>
                      <input id="concerns-q" type="checkbox" name="supsession3" value="1">
                    </span> <span>
                      <label for="concerns-q">All of my questions/concerns were addressed</label>
                    </span></div>
                            <div class="flex-div"> <span>
                      <input id="supervision-na" type="checkbox" name="supsession4" value="1">
                    </span> <span>
                      <label for="supervision-na">N/A</label>
                    </span></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><label for="therapist-comments">Therapist Communication/Comments:</label>
                            <br>
                            <textarea rows="2" id="therapist-comments" type="text"
                                      name="thcomts"> </textarea>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_4">
                <div class="flex-div row-flex div_33 mb_30">
                    <div class="col-item">
                        <div class="flex-div"> <span>
                  <label for="therapist-sign">Therapist Signature:</label>
                </span> <span>
                  <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                </span></div>
                    </div>
                    <div class="col-item">
                        <div class="flex-div"> <span>
                  <label for="print-name">Print Name: </label>
                </span> <span>
                  <input id="print-name" type="text" name="priame1">
                </span></div>
                    </div>
                    <div class="col-item">
                        <div class="flex-div"> <span>
                  <label for="therapist-sign-date">Date:</label>
                </span> <span>
                  <input id="therapist-sign-date" type="date" name="thersigndate1">
                </span></div>
                    </div>
                </div>
                <div class="box box1">
                    <div class="col-title mb_15">
                        <h3>
                            <label><b>Parent Comments/Questions:</b></label>
                        </h3>
                        <p>1) Any dangerous behaviors reported since last sessions? </p>
                        <div class="check-box-area">
                            <ul>
                                <li><span>
                      <input id="pcq-yes" type="radio" name="pcqrbt" value="1">
                    </span><span>
                      <label for="pcq-yes">Yes</label>
                    </span></li>
                                <li><span>
                      <input id="pcq-no" type="radio" name="pcqrbt" value="1">
                    </span> <span>
                      <label for="pcq-no">No</label>
                    </span></li>
                            </ul>
                        </div>
                        <span class="bracket red">Explain if yes: </span>
                    </div>
                    <div class="textarea mb_30">
                        <textarea rows="5" name="pcqrbtexp"></textarea>
                    </div>
                </div>
                <div class="flex-div row-flex div_33 mb_30">
                    <div class="col-item">
                        <div class="flex-div"> <span>
                  <label for="parent-sign">Therapist Signature:</label>
                </span> <span>
                  <a href="#" data-target="#signatureModal2" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                </span></div>
                    </div>
                    <div class="col-item">
                        <div class="flex-div"> <span>
                  <label for="parent-print-name">Print Name: </label>
                </span> <span>
                  <input id="parent-print-name" type="text" name="prname2">
                </span></div>
                    </div>
                    <div class="col-item">
                        <div class="flex-div"> <span>
                  <label for="parent-sign-date">Date:</label>
                </span> <span>
                  <input id="parent-sign-date" type="date" name="thersigndate2">
                </span></div>
                    </div>
                </div>
            </section>
            <br>
            <P><strong class="red">Note:</strong> <i>Please forward all parent comments/questions to program
                    managers/clinical
                    mangers within 48 hours.</i></P>
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
        <form class="pdf_form" action="{{ route('superadmin.print.form.6')}}" target="_blank" method="POST">
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
    $(document).on('submit', '#tcsn_six_form', function (e) {
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
            url: "{{route('superadmin.tcsn.six.form.submit')}}",
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
