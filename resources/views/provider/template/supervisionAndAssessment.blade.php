<?php

  $admin_id=\Auth::user()->admin_id;
  $app=\App\Models\Appoinment::select('id','schedule_date','from_time','to_time','client_id')->where('id',$session_id)->first();
  if($app){
    $client=\App\Models\Client::select('client_full_name','client_dob')->where('id',$app->client_id)->first();
    $client_name=$client->client_full_name;
    $client_dob=$client->client_dob;
  }
  else{
    $client_name='';
    $client_dob='';
  }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUPERVISION NON-BILLABLE BRCT</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/')}}/tem60/custom.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/')}}/tem60/custom-6.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
      .logo_img{
        width: 100px;
        height: 100px;
      }
    </style>
</head>

<body>
<div class="supervision-assessment">
        <div class="content">
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
            <form action="" method="POST" id="form_60">
                @csrf
                <input type="hidden" name="sessionid" value="{{$session_id}}">
                
                <div class="page-title mb_40">
                  <h1>SUPERVISION NON-BILLABLE BRCT<br>
                  </h1>
                </div>
                <section class="section_1 mb_30">
                  <h3 class="mb-3">Client Information:</h3>
                  <table cellspacing="0" cellpadding="0">
                    <tbody>
                      <tr>
                        <td>
                          <div class="flex-div"><span>
                              <label for="clname">Client Name:</label>
                            </span> <span>
                              <input type="text" id="clname" name="clname" value="{{$client_name}}">
                            </span></div>
                        </td>
                        <td>
                          <div class="flex-div"><span>
                              <label for="dob">DOB:</label>
                            </span> <span>
                              <input type="date" id="dob" name="dob" value="{{$client_dob==''?'':\Carbon\Carbon::parse($client_dob)->format('Y-m-d')}}">
                            </span></div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="flex-div"><span>
                              <label for="age">Age:</label>
                            </span> <span>
                              <input type="text" id="age" name="age">
                            </span></div>
                        </td>
                        <td>
                          <div class="flex-div"><span>
                              <label for="diagnosis">Diagnosis:</label>
                            </span> <span>
                              <input type="text" id="diagnosis" name="diagnosis">
                            </span></div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </section>
                <section class="section_1 mb_30">
                  <h3 class="mb-3">SUPERVISOR/SUPERVISEE INFORMATION:</h3>
                  <table cellspacing="0" cellpadding="0">
                    <tbody>
                      <tr>
                        <td>
                          <div class="flex-div"><span>
                              <label for="supname">Supervisor's Name (BCBA/BCaBA):</label>
                            </span> <span>
                              <input type="text" id="supname" name="supname">
                            </span></div>
                        </td>
                        <td>
                          <div class="flex-div"><span>
                              <label for="regtech">Registered Behavior Technician's Name:</label>
                            </span> <span>
                              <input type="text" id="regtech" name="regtech">
                            </span></div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </section>
                <section class="section_1 mb_30">
                  <h3 class="mb-3">Supervised Session Date:</h3>
                  <table cellspacing="0" cellpadding="0">
                    <tbody>
                      <tr>
                        <td>
                          <div class="flex-div"><span>
                              <label for="sd">Service Date :</label>
                            </span> <span>
                              <input type="date" id="sd" name="sd" value="{{\Carbon\Carbon::parse($app->schedule_date)->format('Y-m-d')}}">
                            </span></div>
                        </td>
                        <td>
                          <div class="flex-div"><span>
                              <label for="sst">Service Start Time:</label>
                            </span> <span>
                              <input type="time" id="sst" name="sst" value="{{\Carbon\Carbon::parse($app->from_time)->format('H:i:s')}}">
                            </span></div>
                        </td>
                        <td>
                          <div class="flex-div"><span>
                              <label for="set">Service End Time :</label>
                            </span> <span>
                              <input type="time" id="set" name="set" value="{{\Carbon\Carbon::parse($app->to_time)->format('H:i:s')}}">
                            </span></div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </section>
                <section class="section_2 mb_30">
                  <h3 class="mb-3">Parent Training Provided</h3>
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="supprovide">In Person
                        </label>
                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name=supremote>Remote
                        </label>
                      </div>
                    </li>
                  </ul>
                </section>
                <section class="section_3 mb_30">
                  <div class="box box1 mb_30">
                    <div class="col-title mb_15">
                      <h3>
                        <label for="pto">SUPERVISION Overview:</label>
                      </h3>
                    </div>
                    <div class="textarea">
                      <textarea id="pto" rows="5" name="supoverview"></textarea>
                    </div>
                  </div>
                  <div class="box box2">
                    <div class="col-title mb_15">
                      <h3>
                        <label for="fd">FEEDBACK FROM SUPERVISOR:</label>
                      </h3>
                    </div>
                    <div class="textarea">
                      <textarea id="fd" rows="5" name="supfeed"></textarea>
                    </div>
                  </div>
                </section>
                <section>
                  <div class="box box2">
                    <div class="col-title mb_15">
                      <h3>
                        <label><b>Organization and Professionalism</b></label>
                      </h3>
                    </div>
                    <p>1) Refrains from speaking about client during session and in front of client <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="refrain_yes" type="radio" name="refrains" value="1" >
                          </span> <span>
                          <label for="refrain_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="refrain_no" type="radio" name="refrains" value="2" >
                          </span> <span>
                          <label for="refrain_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p>2) Does not mock or mimic client <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="mimic_yes" type="radio" name="mimic" value="1" >
                          </span> <span>
                          <label for="mimic_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="mimic_no" type="radio" name="mimic" value="2" >
                          </span> <span>
                          <label for="mimic_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p>3) Does not compare client to another client <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="compare_yes" type="radio" name="compare" value="1" >
                          </span> <span>
                          <label for="compare_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="compare_no" type="radio" name="compare" value="2" >
                          </span> <span>
                          <label for="compare_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p>4) Only gives demands to own client <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="demands_yes" type="radio" name="demands" value="1" >
                          </span> <span>
                          <label for="demands_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="demands_no" type="radio" name="demands" value="2" >
                          </span> <span>
                          <label for="demands_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p>5) Stays within arm’s reach of client <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="Stays_yes" type="radio" name="Stays" value="1" >
                          </span> <span>
                          <label for="Stays_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="Stays_no" type="radio" name="Stays" value="2" >
                          </span> <span>
                          <label for="Stays_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p>6) RBT arrives on-time and prepared? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="rbt_arrives_yes" type="radio" name="rbt_arrives" value="1" >
                          </span> <span>
                          <label for="rbt_arrives_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="rbt_arrives_no" type="radio" name="rbt_arrives" value="2" >
                          </span> <span>
                          <label for="rbt_arrives_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p>7) RBT begins promptly/avoids wasted time? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="rbt_begins_yes" type="radio" name="rbt_begins" value="1" >
                          </span> <span>
                          <label for="rbt_begins_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="rbt_begins_no" type="radio" name="rbt_begins" value="2" >
                          </span> <span>
                          <label for="rbt_begins_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p>8) Data taken on catalyst in real time <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="catalyst_yes" type="radio" name="catalyst" value="1" >
                          </span> <span>
                          <label for="catalyst_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="catalyst_no" type="radio" name="catalyst" value="2" >
                          </span> <span>
                          <label for="catalyst_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                  </div>
                  <br>
                  <div class="box box2">
                  <div class="col-title mb_15">
                    <h3>
                      <label><b>Direct Instruction</b></label>
                    </h3>
                  </div>
                  <p> 1) Was each target hit at least 5 times in the session <span class="red">*</span></p>
                  <div class="check-box-area">
                    <ul>
                      <li> <span>
                        <input id="session_yes" type="radio" name="session" value="1" >
                        </span> <span>
                        <label for="session_yes">Yes</label>
                        </span></li>
                      <li><span>
                        <input id="session_no" type="radio" name="session" value="2" >
                        </span> <span>
                        <label for="session_no">No</label>
                        </span></li>
                    </ul>
                  </div>
                  <p> 2) RBT establishes instructional control? <span class="red">*</span></p>
                  <div class="check-box-area">
                    <ul>
                      <li> <span>
                        <input id="establishes_yes" type="radio" name="establishes" value="1" >
                        </span> <span>
                        <label for="establishes_yes">Yes</label>
                        </span></li>
                      <li><span>
                        <input id="establishes_no" type="radio" name="establishes" value="2" >
                        </span> <span>
                        <label for="establishes_no">No</label>
                        </span></li>
                    </ul>
                  </div>
                  <p> 3) Instructions and prompts are clear and concise? <span class="red">*</span></p>
                  <div class="check-box-area">
                    <ul>
                      <li> <span>
                        <input id="prompts_yes" type="radio" name="prompts" value="1" >
                        </span> <span>
                        <label for="prompts_yes">Yes</label>
                        </span></li>
                      <li><span>
                        <input id="prompts_no" type="radio" name="prompts" value="2" >
                        </span> <span>
                        <label for="prompts_no">No</label>
                        </span></li>
                    </ul>
                  </div>
                  <p> 4) Sd presented only 1 time before either a response or prompt? (No repeated Sds)? <span class="red">*</span></p>
                  <div class="check-box-area">
                    <ul>
                      <li> <span>
                        <input id="presented_yes" type="radio" name="presented" value="1" >
                        </span> <span>
                        <label for="presented_yes">Yes</label>
                        </span></li>
                      <li><span>
                        <input id="presented_no" type="radio" name="presented" value="2" >
                        </span> <span>
                        <label for="presented_no">No</label>
                        </span></li>
                    </ul>
                  </div>
                  <p> 5) Tone of voice neutral? <span class="red">*</span></p>
                  <div class="check-box-area">
                    <ul>
                      <li> <span>
                        <input id="neutral_yes" type="radio" name="neutral" value="1" >
                        </span> <span>
                        <label for="neutral_yes">Yes</label>
                        </span></li>
                      <li><span>
                        <input id="neutral_no" type="radio" name="neutral" value="2" >
                        </span> <span>
                        <label for="neutral_no">No</label>
                        </span></li>
                    </ul>
                  </div>
                  <p> 6) Correct level of enthusiasm <span class="red">*</span></p>
                  <div class="check-box-area">
                    <ul>
                      <li> <span>
                        <input id="enthusiasm_yes" type="radio" name="enthusiasm" value="1" >
                        </span> <span>
                        <label for="enthusiasm_yes">Yes</label>
                        </span></li>
                      <li><span>
                        <input id="enthusiasm_no" type="radio" name="enthusiasm" value="2" >
                        </span> <span>
                        <label for="enthusiasm_no">No</label>
                        </span></li>
                    </ul>
                  </div>
                  <p> 7) Tasks are mixed and varied across operants? <span class="red">*</span></p>
                  <div class="check-box-area">
                    <ul>
                      <li> <span>
                        <input id="operants_yes" type="radio" name="operants" value="1" >
                        </span> <span>
                        <label for="operants_yes">Yes</label>
                        </span></li>
                      <li><span>
                        <input id="operants_no" type="radio" name="operants" value="2" >
                        </span> <span>
                        <label for="operants_no">No</label>
                        </span></li>
                    </ul>
                  </div>
                  <p> 8) Appropriate ratio of easy (mastered) vs. difficult (acquisition) tasks? 80/20 rule? <span class="red">*</span></p>
                  <div class="check-box-area">
                    <ul>
                      <li> <span>
                        <input id="Appropriate_yes" type="radio" name="Appropriate" value="1" >
                        </span> <span>
                        <label for="Appropriate_yes">Yes</label>
                        </span></li>
                      <li><span>
                        <input id="Appropriate_no" type="radio" name="Appropriate" value="2" >
                        </span> <span>
                        <label for="Appropriate_no">No</label>
                        </span></li>
                    </ul>
                  </div>
                  <p> 9) Errorless teaching is used with appropriate time delay <span class="red">*</span></p>
                  <div class="check-box-area">
                    <ul>
                      <li> <span>
                        <input id="errorless_yes" type="radio" name="errorless" value="1" >
                        </span> <span>
                        <label for="errorless_yes">Yes</label>
                        </span></li>
                      <li><span>
                        <input id="errorless_no" type="radio" name="errorless" value="2" >
                        </span> <span>
                        <label for="errorless_no">No</label>
                        </span></li>
                    </ul>
                  </div>
                  <p> 10) RBT maintains appropriate pace of instruction (inter-trial intervals no more than 3 seconds) <span class="red">*</span></p>
                  <div class="check-box-area">
                    <ul>
                      <li> <span>
                        <input id="rbt_maintains_yes" type="radio" name="rbt_maintains" value="1" >
                        </span> <span>
                        <label for="rbt_maintains_yes">Yes</label>
                        </span></li>
                      <li><span>
                        <input id="rbt_maintains_no" type="radio" name="rbt_maintains" value="2" >
                        </span> <span>
                        <label for="rbt_maintains_no">No</label>
                        </span></li>
                    </ul>
                  </div>
                  <p> 11) Teaches to fluency <span class="red">*</span></p>
                  <div class="check-box-area">
                    <ul>
                      <li> <span>
                        <input id="fluency_yes" type="radio" name="fluency" value="1" >
                        </span> <span>
                        <label for="fluency_yes">Yes</label>
                        </span></li>
                      <li><span>
                        <input id="fluency_no" type="radio" name="fluency" value="2" >
                        </span> <span>
                        <label for="fluency_no">No</label>
                        </span></li>
                    </ul>
                  </div>
                  <p> 12) Updates maintenance targets and practices them within trials <span class="red">*</span></p>
                  <div class="check-box-area">
                    <ul>
                      <li> <span>
                        <input id="maintenance_yes" type="radio" name="maintenance" value="1" >
                        </span> <span>
                        <label for="maintenance_yes">Yes</label>
                        </span></li>
                      <li><span>
                        <input id="maintenance_no" type="radio" name="maintenance" value="2" >
                        </span> <span>
                        <label for="maintenance_no">No</label>
                        </span></li>
                    </ul>
                  </div>
                  <br>
                  <div class="box box3">
                    <div class="col-title mb_15">
                      <h3>
                        <label><b>Reinforcement</b></label>
                      </h3>
                    </div>
                    <p> 1) Were reinforcers delivered immediately <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="immediately_yes" type="radio" name="immediately" value="1" >
                          </span> <span>
                          <label for="immediately_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="immediately_no" type="radio" name="immediately" value="2" >
                          </span> <span>
                          <label for="immediately_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 2) Did the RBT maintain control of the reinforcers? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="rbt_maintain_yes" type="radio" name="rbt_maintain" value="1" >
                          </span> <span>
                          <label for="rbt_maintain_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="rbt_maintain_no" type="radio" name="rbt_maintain" value="2" >
                          </span> <span>
                          <label for="rbt_maintain_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 3) Was the reinforcement schedule appropriate for the learner? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="reinforcement_yes" type="radio" name="reinforcement" value="1" >
                          </span> <span>
                          <label for="reinforcement_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="reinforcement_no" type="radio" name="reinforcement" value="2" >
                          </span> <span>
                          <label for="reinforcement_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 4) Did the RBT utilize differential reinforcement? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="rbt_utilize_yes" type="radio" name="rbt_utilize" value="1" >
                          </span> <span>
                          <label for="rbt_utilize_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="rbt_utilize_no" type="radio" name="rbt_utilize" value="2" >
                          </span> <span>
                          <label for="rbt_utilize_no">No</label>
                          </span></li>
                        <li><span>
                          <input id="rbt_utilize_na" type="radio" name="rbt_utilize" value="3" >
                          </span> <span>
                          <label for="rbt_utilize_na">N/A</label>
                          </span> </li>
                      </ul>
                    </div>
                    <p> 5) Were a variety of reinforcers used? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="variety_yes" type="radio" name="variety" value="1" >
                          </span> <span>
                          <label for="variety_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="variety_no" type="radio" name="variety" value="2" >
                          </span> <span>
                          <label for="variety_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 6) RBT paired behavior-specific praise with tangible reinforcers? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="behavior-specific_yes" type="radio" name="behavior-specific" value="1" >
                          </span> <span>
                          <label for="behavior-specific_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="behavior-specific_no" type="radio" name="behavior-specific" value="2" >
                          </span> <span>
                          <label for="behavior-specific_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 7) Reinforcers were delivered contingent upon correct responses, attending, and lack of inappropriate behavior? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="inappropriate_yes" type="radio" name="inappropriate" value="1" >
                          </span> <span>
                          <label for="inappropriate_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="inappropriate_no" type="radio" name="inappropriate" value="2" >
                          </span> <span>
                          <label for="inappropriate_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                  </div>
                  <br>
                  <div class="box box4">
                    <div class="col-title mb_15">
                      <h3>
                        <label><b>Consequences: Prompting and Error Correction and Errorless Teaching</b></label>
                      </h3>
                    </div>
                    <p> 1) Are prompts provided when necessary? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="necessary_yes" type="radio" name="necessary" value="1" >
                          </span> <span>
                          <label for="necessary_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="necessary_no" type="radio" name="necessary" value="2" >
                          </span> <span>
                          <label for="necessary_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 2) Was there only a 3 second delay between the Sd and the response or prompt <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="response_yes" type="radio" name="response" value="1" >
                          </span> <span>
                          <label for="response_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="response_no" type="radio" name="response" value="2" >
                          </span> <span>
                          <label for="response_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 3) Are transfer trials presented after each prompted response?<span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="trial_presented_no" type="radio" name="trial_presented" value="1" >
                          </span> <span>
                          <label for="trial_presented_no">No</label>
                          </span></li>
                        <li><span>
                          <input id="trial_presented_other" type="radio" name="trial_presented" value="2" >
                          </span> <span>
                          <label for="trial_presented_other">Other</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 4) RBT uses prompts that reliably evoke the appropriate response? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="rbt_uses_yes" type="radio" name="rbt_uses" value="1" >
                          </span> <span>
                          <label for="rbt_uses_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="rbt_uses_no" type="radio" name="rbt_uses" value="2" >
                          </span> <span>
                          <label for="rbt_uses_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 5) Are prompts varied depending on the skill being taught? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="prompt_verified_yes" type="radio" name="prompt_verified" value="1" >
                          </span> <span>
                          <label for="prompt_verified_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="prompt_verified_no" type="radio" name="prompt_verified" value="2" >
                          </span> <span>
                          <label for="prompt_verified_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 6) Were prompts progressively and systematically faded? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="progressively_yes" type="radio" name="progressively" value="1" >
                          </span> <span>
                          <label for="progressively_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="progressively_no" type="radio" name="progressively" value="2" >
                          </span> <span>
                          <label for="progressively_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 7) Are correction procedures implemented correctly? (Re-states Sd with 0 second time delay after error/no response?) <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="implemented_yes" type="radio" name="implemented" value="1" >
                          </span> <span>
                          <label for="implemented_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="implemented_no" type="radio" name="implemented" value="2" >
                          </span> <span>
                          <label for="implemented_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 8) Was every instruction followed by a consequence (reinforcement, prompt, or correction procedure)? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="consequence_yes" type="radio" name="consequence" value="1" >
                          </span> <span>
                          <label for="consequence_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="consequence_no" type="radio" name="consequence" value="2" >
                          </span> <span>
                          <label for="consequence_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                  </div>
                  <br>
                  <div class="box box5">
                    <div class="col-title mb_15">
                      <h3>
                        <label><b>Behavior Management</b></label>
                      </h3>
                    </div>
                    <p> 1) Problem behavior protocols utilized correctly as outlined in Catalyst/BIP <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="behavior-protocols_yes" type="radio" name="behavior-protocols" value="1" >
                          </span> <span>
                          <label for="behavior-protocols_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="behavior-protocols_no" type="radio" name="behavior-protocols" value="2" >
                          </span> <span>
                          <label for="behavior-protocols_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 2) Implements antecedent strategies appropriately when unwanted behaviors are not occurring? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="unwanted_yes" type="radio" name="unwanted" value="1" >
                          </span> <span>
                          <label for="unwanted_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="unwanted_no" type="radio" name="unwanted" value="2" >
                          </span> <span>
                          <label for="unwanted_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 3) Utilizes appropriate behavior intervention when behavior occurs? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="intervention_yes" type="radio" name="intervention" value="1" >
                          </span> <span>
                          <label for="intervention_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="intervention_no" type="radio" name="intervention" value="2" >
                          </span> <span>
                          <label for="intervention_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 4) Provides positive reinforcement for an appropriate behavior following behavior intervention? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="positive-reinforcement_yes" type="radio" name="reinforcement" value="1" >
                          </span> <span>
                          <label for="positive-reinforcement_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="positive-reinforcement_no" type="radio" name="reinforcement" value="2" >
                          </span> <span>
                          <label for="positive-reinforcement_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 5) Maintains composure during procedures? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="composure_yes" type="radio" name="composure" value="1" >
                          </span> <span>
                          <label for="composure_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="composure_no" type="radio" name="composure" value="2" >
                          </span> <span>
                          <label for="composure_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 6) Employs wait/help/prompt strategy when possible <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="strategy_yes" type="radio" name="strategy" value="1" >
                          </span> <span>
                          <label for="strategy_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="strategy_no" type="radio" name="strategy" value="2" >
                          </span> <span>
                          <label for="strategy_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 7) RBT recorded appropriate data? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="recorded_yes" type="radio" name="recorded" value="1" >
                          </span> <span>
                          <label for="recorded_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="recorded_no" type="radio" name="recorded" value="2" >
                          </span> <span>
                          <label for="recorded_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                  </div>
                  <br>
                  <div class="box box6">
                    <div class="col-title mb_15">
                      <h3>
                        <label><b>Data Collection/Program Management</b></label>
                      </h3>
                    </div>
                    <p> 1) Begins session with pairing <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="begins-session_yes" type="radio" name="begins-session" value="1" >
                          </span> <span>
                          <label for="begins-session_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="begins-session_no" type="radio" name="begins-session" value="2" >
                          </span> <span>
                          <label for="begins-session_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 2) Ends session with pairing<span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="ends-session_yes" type="radio" name="ends-session" value="1" >
                          </span> <span>
                          <label for="ends-session_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="ends-session_no" type="radio" name="ends-session" value="2" >
                          </span> <span>
                          <label for="ends-session_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 3) Notes are objective, clear, and complete? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="objective-notes_yes" type="radio" name="objective-notes" value="1" >
                          </span> <span>
                          <label for="objective-notes_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="objective-notes_no" type="radio" name="objective-notes" value="2" >
                          </span> <span>
                          <label for="objective-notes_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 4) All supervisory recommendations are being followed/implemented? <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="supervisory_yes" type="radio" name="supervisory" value="1" >
                          </span> <span>
                          <label for="supervisory_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="supervisory_no" type="radio" name="supervisory" value="2" >
                          </span> <span>
                          <label for="supervisory_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                  </div>
                  <br>
                  <div class="box box7">
                    <div class="col-title mb_15">
                      <h3>
                        <label><b>BCBA Responsibilities</b></label>
                      </h3>
                    </div>
                    <p> 1) Plan validity <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="targets-mastered" type="radio" name="plan-validity" value="1" >
                          </span> <span>
                          <label for="targets-mastered">Targets mastered out during session by BCBA</label>
                          </span></li>
                        <li><span>
                          <input id="targets-added" type="radio" name="plan-validity" value="2" >
                          </span> <span>
                          <label for="targets-added">Targets added during session by BCBA</label>
                          </span></li>
                        <li><span>
                          <input id="plan-appropriate" type="radio" name="plan-validity" value="3" >
                          </span> <span>
                          <label for="plan-appropriate">Plan appropriate without changes</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 2) BCBA/ Clinic Director work with RBT <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="modeling-rbt" type="radio" name="clinic-director" value="1" >
                          </span> <span>
                          <label for="modeling-rbt">Modeling done for RBT for accurate implementation of plan</label>
                          </span></li>
                        <li><span>
                          <input id="rbt-implementing" type="radio" name="clinic-director" value="2" >
                          </span> <span>
                          <label for="rbt-implementing">RBT implementing plan without direction</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 3) Data collection modified for client <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="data-collect_yes" type="radio" name="data-collection" value="1" >
                          </span> <span>
                          <label for="data-collect_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="data-collect_no" type="radio" name="data-collection" value="2" >
                          </span> <span>
                          <label for="data-collect_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                    <p> 4) IOA done during session <span class="red">*</span></p>
                    <div class="check-box-area">
                      <ul>
                        <li> <span>
                          <input id="IOA_yes" type="radio" name="IOAion" value="1" >
                          </span> <span>
                          <label for="IOA_yes">Yes</label>
                          </span></li>
                        <li><span>
                          <input id="IOA_no" type="radio" name="IOAion" value="2" >
                          </span> <span>
                          <label for="IOA_no">No</label>
                          </span></li>
                      </ul>
                    </div>
                  </div>
                </section>
                <section class="section_3 mb_30">
                  <table cellspacing="0" cellpadding="0">
                    <tbody>
                      <tr>
                        <td>
                          <div class="flex-div"><span>
                              <label for="pfn">Provider Full Name:</label>
                            </span> <span>
                              <input type="text" id="pfn" name="pfn">
                            </span></div>
                        </td>
                        <td>
                          <div class="flex-div"><span>
                              <label for="pcred">Provider Credentials:</label>
                            </span> <span>
                              <input type="text" id="pcred" name="pcred">
                            </span></div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </section>
                <br>
                <br>
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
            <form class="pdf_form" action="{{ route('provider.print.form.60')}}" target="_blank" method="POST">
            @csrf
                <input type="hidden" name="session_id" class="session_id" value="{{$session_id}}">
            </form>
        </div>
    </div>
<!-- Jq Files -->
<script src="{{asset('assets/dashboard//')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/bootstrap.min.js"></script>
<script src="{{asset('assets/dashboard/template/')}}/js/jform.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>
<script>
    $(document).ready(function () {
      $('.pdf_btn').hide();

      $(document).on('click','.pdf_btn',function(){
            $('.pdf_form').submit();
        })
        $(document).on('submit', '#form_60', function (e) {
            e.preventDefault();

            if($('select[name="comby"]').val()==0){
              toastr["error"]("Please select completed by to continue.");
              return false;
            }
            let canvas2 = document.getElementById('sig-canvas');
            let canvas3 = document.getElementById('sig-canvas2');
            let dataURL2 = canvas2.toDataURL();
            let dataURL3 = canvas3.toDataURL();

            let sing_draw = $('.sing_draw').val(dataURL2);
            let sing_draw2 = $('.sing_draw2').val(dataURL3);

            var formData = new FormData(this);

            data_obj=$('#form_60').jform();
            data_obj=JSON.parse(data_obj);
            delete data_obj["sing_draw"];
            delete data_obj["sing_draw2"];
            data_obj=JSON.stringify(data_obj);
            formData.append('data_obj',data_obj);           

            $.ajax({
                type: 'POST',
                url: "{{route('provider.60.form.submit')}}",
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
