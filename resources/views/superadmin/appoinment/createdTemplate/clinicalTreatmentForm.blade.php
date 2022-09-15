<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinical Treatment, Management, & Modification Notes</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/temsev/')}}/css/custom-7.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
</head>
<style>
    .logo_img {
        width: 100px;
        height: 100px;
    }
</style>

<body>
<div class="clinical-case-management">
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
            <h1>Clinical Treatment, Management, & Modification Notes</h1>
        </div>
        <form action="" method="POST" id="form_7">
            @csrf
            <section class="section_1 mb_40">
                <div class="box box_1">
                    <div class="flex-div row-flex div_33 mb_30">
                        <div class="col-item">
                            <div class="flex-div"> <span>
        <label for="clname">Client Full Name:</label>
      </span> <span>
        <input id="clname" type="text" name="clname" value="{{$data->clname}}">
        <input type="hidden" name="sessionid" value="{{$session_id}}">
      </span></div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div"> <span>
        <label for="date">Date:</label>
      </span> <span>
        <input id="date" type="date" name="date" value="{{$data->date}}">
      </span></div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div"> <span>
        <label for="start-time">Start Time:</label>
      </span> <span>
        <input id="start-time" type="time" name="stime" value="{{\Carbon\Carbon::parse($data->stime)->format('H:i:s')}}">
      </span></div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div"> <span>
        <label for="end-time">End Time:</label>
      </span> <span>
        <input id="end-time" type="time" name="etime" value="{{\Carbon\Carbon::parse($data->etime)->format('H:i:s')}}">
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
              <input id="home" type="checkbox" name="setting" value="1" {{$data->setting == 1 ? 'checked' : ''}}>
            </span><span>
              <label for="home">Home</label>
            </span></li>
                                        <li><span>
              <input id="community" type="checkbox" name="community" value="1" {{$data->community == 1 ? 'checked' : ''}}>
            </span> <span>
              <label for="community">Community</label>
            </span></li>
                                        <li><span>
              <input id="clinic" type="checkbox" name="clinic" value="1" {{$data->clinic == 1 ? 'checked' : ''}}>
            </span> <span>
              <label for="clinic">Clinic/Office </label>
            </span></li>
                                        <li><span>
              <input id="school" type="checkbox" name="school" value="1" {{$data->school == 1 ? 'checked' : ''}}>
            </span> <span>
              <label for="school">School</label>
            </span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section_2 mb_30">
                <div class="col-item mb_30">
                    <div class="flex-div">
                        <div>
                            <label>1. Signs/Symptoms Observed <span
                                    class="bracket red">(check all that apply):</span></label>
                        </div>
                        <div class="check-box-area">
                            <ul>
                                <li><span>
          <input id="language-improvement" type="checkbox" name="langimp" value="1"    {{$data->langimp == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="language-improvement">Rec. Language Impairment </label>
        </span></li>
                                <li><span>
          <input id="exp-language" type="checkbox" name="explang" value="1"    {{$data->explang == 1 ? 'checked' : ''}}>
        </span> <span>
          <label for="exp-language">Exp Language Impairment </label>
        </span></li>
                                <li><span>
          <input id="socials-skills" type="checkbox" name="ssdef" value="1"    {{$data->ssdef == 1 ? 'checked' : ''}}>
        </span> <span>
          <label for="socials-skills">Social Skills Deficits </label>
        </span></li>
                                <li><span>
          <input id="repetitive" type="checkbox" name="repbeh" value="1" {{$data->repbeh == 1 ? 'checked' : ''}}>
        </span> <span>
          <label for="repetitive">Repetitive Behaviors </label>
        </span></li>
                                <li><span>
          <input id="interests" type="checkbox" name="resint" value="1"{{$data->resint == 1 ? 'checked' : ''}}>
        </span> <span>
          <label for="interests">Restricted Interests </label>
        </span></li>
                                <li><span>
          <input id="hyper" type="checkbox" name="hyper" value="1" {{$data->hyper == 1 ? 'checked' : ''}}>
        </span> <span>
          <label for="hyper">Hyper/Hypo-reactivity to sensory input</label>
        </span></li>
                                <li><span>
          <input id="insistence" type="checkbox" name="insist" value="1"  {{$data->insist == 1 ? 'checked' : ''}}>
        </span> <span>
          <label for="insistence">Insistence on sameness </label>
        </span></li>
                                <li><span>
          <input id="report-filled" type="checkbox" name="harmself" value="1" {{$data->harmself == 1 ? 'checked' : ''}}>
        </span> <span>
          <label for="report-filled">Harm to self or others* *Was an Incident Report filled out within 24
            hours? </label>
        </span>
                                    <div class="check-box-area">
                                        <ul>
                                            <li><span>
                <input id="report-filled-yes" type="radio" name="report" value="1" {{$data->report == 1 ? 'checked' : ''}}>
              </span><span>
                <label for="report-filled-yes">Yes</label>
              </span></li>
                                            <li><span>
                <input id="report-filled-no" type="radio" name="report" value="2" {{$data->report == 2 ? 'checked' : ''}}>
              </span> <span>
                <label for="report-filled-no">No</label>
              </span></li>
                                            <li><span>
                <input id="report-filled-na" type="radio" name="report" value="3" {{$data->report == 3 ? 'checked' : ''}}>
              </span><span>
                <label for="report-filled-na">N/A</label>
              </span></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-item mb_30">
                    <div class="flex-div">
                        <div>
                            <label>2. Goals for Session <span class="bracket red">(check all that apply, at least one modification
        must be checked)</span>:</label>
                        </div>
                        <div class="check-box-area">
                            <ul>
                                <li><span>
          <input id="rapport" type="checkbox" name="brc" value="1" {{$data->brc == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="rapport">Build rapport with client/family/tech </label>
        </span></li>
                                <li><span>
          <input id="goal-teaching" type="checkbox" name="mag" value="1" {{$data->mag == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="goal-teaching">Modify acquisition goal, teaching technique, and/or procedure </label>
        </span></li>
                                <li><span>
          <input id="interventaion-plan" type="checkbox" name="mac" value="1" {{$data->mac == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="interventaion-plan">Modify any component of Behavior Intervention Plan</label>
        </span></li>
                                <li><span>
          <input id="procedure" type="checkbox" name="mpg" value="1" {{$data->mpg == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="procedure">Modify parent goal, teaching technique, and/or procedure </label>
        </span></li>
                                <li><span>
          <input id="schedule" type="checkbox" name="mrs" value="1" {{$data->mrs == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="schedule">Modify Reinforcement Schedule </label>
        </span></li>
                                <li><span>
          <input id="goal-procedure" type="checkbox" name="mmg" value="1" {{$data->mmg == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="goal-procedure">Modify maintenance goal and/or procedure </label>
        </span></li>
                                <li><span>
          <input id="ttp" type="checkbox" name="bmg" value="1" {{$data->bmg == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="ttp">Baseline/Mastery/Generalization Probes to modify goals, teaching technique,
            and/or
            procedure</label>
        </span></li>
                                <li><span>
          <input id="mtt" type="checkbox" name="mtt" value="1" {{$data->mtt == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="mtt">Model teaching to technician </label>
        </span></li>
                                <li><span>
          <input id="pt" type="checkbox" name="ptr" value="1" {{$data->ptr == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="pt">Parent Training </label>
        </span></li>
                                <li><span>
          <input id="assessment-skills" type="checkbox" name="asskill" value="1" {{$data->asskill == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="assessment-skills">Assessment of Skills <span class="bracket red">(standardized or
              curriculum-based) </span> </label>
        </span></li>
                                <li><span>
          <input id="inter-observer" type="checkbox" name="intobs" value="1" {{$data->intobs == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="inter-observer">Inter-observer agreement (IOA) data collection </label>
        </span></li>
                                <li><span>
          <input id="other-describe" type="checkbox" name="othdes" value="1" {{$data->othdes == 1 ? 'checked' : ''}}>
        </span><span class="other">
          <label for="other-describe">Other- Describe: </label>
          <input type="text" name="othdesexp" value="{{$data->othdesexp}}">
        </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-item mb_30">
                    <div class="flex-div">
                        <div>
                            <label>3. Targeted Domains <span class="bracket red"> (check all that apply)</span>:</label>
                        </div>
                        <div class="check-box-area">
                            <ul>
                                <li><span>
          <input id="language-communication" type="checkbox" name="lcomm" value="1" {{$data->lcomm == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="language-communication">Language/Communication </label>
        </span></li>
                                <li><span>
          <input id="acquisition-goal" type="checkbox" name="ttp" value="1" {{$data->ttp == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="acquisition-goal">Modify acquisition goal, teaching technique, and/or procedure
          </label>
        </span></li>
                                <li><span>
          <input id="tsocials-skills" type="checkbox" name="socskill" value="1" {{$data->socskill == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="tsocials-skills">Social Skills </label>
        </span></li>
                                <li><span>
          <input id="tplay-skills" type="checkbox" name="playskill" value="1" {{$data->playskill == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="tplay-skills">Play Skills</label>
        </span></li>
                                <li><span>
          <input id="adaptive-skills" type="checkbox" name="adapskill" value="1" {{$data->adapskill == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="adaptive-skills">Adaptive Skills </label>
        </span></li>
                                <li><span>
          <input id="self-management" type="checkbox" name="selfman" value="1" {{$data->selfman == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="self-management">Executive Functioning Skills <span class="bracket red">
              (self-management, organization, tolerance, and inhibition) </span></label>
        </span></li>
                                <li><span>
          <input id="moto-skills" type="checkbox" name="motoskill" value="1" {{$data->motoskill == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="moto-skills">Motor Skills </label>
        </span></li>
                                <li><span>
          <input id="target-safety" type="checkbox" name="tarsafe" value="1" {{$data->tarsafe == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="target-safety">Safety</label>
        </span></li>
                                <li><span>
          <input id="disruptive-behavior" type="checkbox" name="disrupt" value="1" {{$data->disrupt == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="disruptive-behavior">Disruptive Behavior </label>
        </span></li>
                                <li><span>
          <input id="target-other-describe" type="checkbox" name="taroth" value="1" {{$data->taroth == 1 ? 'checked' : ''}}>
        </span><span class="other">
          <label for="target-other-describe">Other- Describe: </label>
          <input type="text" name="tarothdes" value="{{$data->tarothdes}}">
        </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-item mb_30">
                    <div class="flex-div">
                        <div>
                            <label>4. ABT/RBT’s Techniques Utilized <span class="bracket red"> (check all that
        apply)</span>:</label>
                        </div>
                        <div class="check-box-area">
                            <ul>
                                <li><span>
          <input id="discrete-trial" type="checkbox" name="dtt" value="1" {{$data->dtt == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="discrete-trial">Discrete Trial (DTT) </label>
        </span></li>
                                <li><span>
          <input id="tu-net" type="checkbox" name="net" value="1" {{$data->net == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="tu-net">Natural Environment Teaching (NET)</label>
        </span></li>
                                <li><span>
          <input id="tu-vb" type="checkbox" name="vb" value="1" {{$data->vb == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="tu-vb">Verbal Behavior (VB) </label>
        </span></li>
                                <li><span>
          <input id="tu-shaping" type="checkbox" name="shaping" value="1" {{$data->shaping == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="tu-shaping">Shaping</label>
        </span></li>
                                <li><span>
          <input id="cyhaining-task" type="checkbox" name="chaining" value="1" {{$data->chaining == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="cyhaining-task">Chaining/Task Analysis </label>
        </span></li>
                                <li><span>
          <input id="tu-bst" type="checkbox" name="bst" value="1" {{$data->bst == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="tu-bst">Behavior Skills Training (BST) </label>
        </span></li>
                                <li><span>
          <input id="incidental-teaching" type="checkbox" name="incteach" value="1" {{$data->incteach == 1 ? 'checked' : ''}}>
        </span><span>

          <label for="incidental-teaching">Incidental Teaching </label>
        </span></li>
                                <li><span>
          <input id="prompting-fading" type="checkbox" name="propmt" value="1" {{$data->propmt == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="prompting-fading"> Prompting/Fading </label>
        </span></li>
                                <?php

                                $data = $data2;

                                ?>
                                <li><span>
          <input id="antecedent-m" type="checkbox" name="antec" value="1" {{$data->antec == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="antecedent-m">Antecedent Modifications</label>
        </span></li>
                                <li><span>
          <input id="Positive-negative" type="checkbox" name="pnrein" value="1" {{$data->pnrein == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="Positive-negative">Positive/Negative Reinforcement</label>
        </span></li>
                                <li><span>
          <input id="token-economy" type="checkbox" name="tokenecon" value="1" {{$data->tokenecon == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="token-economy">Token Economy</label>
        </span></li>
                                <li><span>
          <input id="diff-reinforential" type="checkbox" name="diffrein" value="1" {{$data->diffrein == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="diff-reinforential">Differential Reinforcement</label>
        </span></li>
                                <li><span>
          <input id="tu-unishment" type="checkbox" name="nonharm" value="1" {{$data->nonharm == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="tu-unishment">Non-harmful, safe, caregiver-approved Positive/Negative
            Punishment</label>
        </span></li>
                                <li><span>
          <input id="tu-other-describe" type="checkbox" name="tuother" value="1" {{$data->tuother == 1 ? 'checked' : ''}}>
        </span><span class="other">
          <label for="tu-other-describe">Other- Describe: </label>
          <input type="text" name="tuotherdes" value="{{$data->tuotherdes}}">
        </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-item mb_30">
                    <div class="flex-div">
                        <div>
                            <label>5. Overall Response to Treatment <span class="bracket red"> (check all that
        apply)</span>:</label>
                        </div>
                        <div class="check-box-area">
                            <p class="red bracket">Client responded positively to ABA therapy today exhibited by: </p>
                            <ul>
                                <li><span>
          <input id="absence-p-behave" type="checkbox" name="absbeh" value="1" {{$data->absbeh == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="absence-p-behave">Absence of Problem Behavior </label>
        </span></li>
                                <li><span>
          <input id="decrease-problem" type="checkbox" name="decbeh" value="1" {{$data->decbeh == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="decrease-problem">Decrease of Problem Behavior </label>
        </span></li>
                                <li><span>
          <input id="mastery-target" type="checkbox" name="mastar" value="1" {{$data->mastar == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="mastery-target">Mastery of Targets </label>
        </span></li>
                                <li><span>
          <input id="mastery-goals" type="checkbox" name="masgoal" value="1" {{$data->masgoal == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="mastery-goals">Mastery of Goals </label>
        </span></li>
                                <li><span>
          <input id="maintainance-mastery-goals" type="checkbox" name="maingoal" value="1" {{$data->maingoal == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="maintainance-mastery-goals">Maintenance of Mastered Goals </label>
        </span></li>
                                <li><span>
          <input id="rapid-goals" type="checkbox" name="rapidgoal" value="1" {{$data->rapidgoal == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="rapid-goals">Rapid Progress Toward Goals </label>
        </span></li>
                                <li><span>
          <input id="steady-goals" type="checkbox" name="steadygoal" value="1" {{$data->steadygoal == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="steady-goals">Steady Progress towards Goals</label>
        </span></li>
                            </ul>
                        </div>
                        <div class="check-box-area">
                            <p class="red bracket">Client responded negatively/did not respond to ABA therapy today
                                exhibited by:
                            </p>
                            <ul>
                                <li><span>
          <input id="increase-prob-behave" type="checkbox" name="incbeh" value="1" {{$data->incbeh == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="increase-prob-behave">Increase in problem behavior </label>
        </span></li>
                                <li><span>
          <input id="bp-ineffective" type="checkbox" name="behplan" value="1" {{$data->behplan == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="bp-ineffective">Behavior Plan was Ineffective</label>
        </span></li>
                                <li><span>
          <input id="lack-motivation" type="checkbox" name="lackmot" value="1" {{$data->lackmot == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="lack-motivation">Lack of Motivation </label>
        </span></li>
                                <li><span>
          <input id="regression-skills" type="checkbox" name="regresskill" value="1" {{$data->regresskill == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="regression-skills">Regression of Skills</label>
        </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section_3 mb_40">
                <div class="box box_1 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="treatment-plan"> Treatment Plan Details and Protocol Modification conducted
                                <span
                                    class="red bracket">(refer to items checked in section #2 to elaborate)</span>:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="treatment-plan" rows="5" name="tpdetail"> {{$data->tpdetail}}</textarea>
                    </div>
                </div>
                <div class="box box_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="new-behavior"> New Behaviors of Concern/Recommendations: </label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="new-behavior" rows="5" name="newbeh"> {{$data->newbeh}}</textarea>
                    </div>
                </div>
                <div class="box box_3 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="parent-comments"> Parent Comments/Questions Discussed: </label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="parent-comments" rows="5" name="ptdiss"> {{$data->ptdiss}}</textarea>
                    </div>
                </div>
                <div class="box box_4 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="follow-up"> Follow Up: </label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="follow-up" rows="5" name="followup">{{$data->followup}} </textarea>
                    </div>
                </div>
            </section>
            <section class="section_5 mb_40">
                <div class="col-item mb_30">
                    <div class="flex-div">
                        <div>
                            <label>ABT/RBT PRESENT <span class="bracket red">(list all full names)</span>:</label>
                        </div>
                        <div class="check-box-area">
                            <ul>
                                <li><span>
          <input id="in-person" type="checkbox" name="inperson" value="1" {{$data->inperson == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="in-person">In Person</label>
        </span></li>
                                <li><span>
          <input id="art-rbt-remote" type="checkbox" name="remote" value="1" {{$data->remote == 1 ? 'checked' : ''}}>
        </span> <span>
          <label for="art-rbt-remote">Remote</label>
        </span></li>
                                <li><span>
          <input id="art-rbt-group" type="checkbox" name="group" value="1" {{$data->group == 1 ? 'checked' : ''}}>
        </span> <span>
          <label for="art-rbt-group">Group </label>
        </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="box box_1 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="observation-note">Observation Notes <span class="red bracket">(elaboration on any sections
        checked on first page)</span>:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="observation-note" rows="5" name="obsnote"> {{$data->obsnote}}</textarea>
                    </div>
                </div>
            </section>
            <section class="section_6 mb_40">
                <div class="inner-main-title">
                    <h2>ABT/RBT Feedback </h2>
                    <br>
                    <span class="red bracket">(refer to any sections checked on first page if needed)</span>
                </div>
                <div class="col-item mb_30">
                    <div class="flex-div">
                        <div>
                            <label>ABT/RBT Activity:</label>
                        </div>
                        <div class="check-box-area">
                            <ul>
                                <li><span>
          <input id="art-rbt-data-reviwes" type="checkbox" name="datreview" value="1" {{$data->datreview == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="art-rbt-data-reviwes">Data Review</label>
        </span></li>
                                <li><span>
          <input id="art-rbt-observation" type="checkbox" name="observation" value="1" {{$data->observation == 1 ? 'checked' : ''}}>
        </span> <span>
          <label for="art-rbt-observation">Observation</label>
        </span></li>
                                <li><span>
          <input id="art-rbt-protocol" type="checkbox" name="protdemon" value="1" {{$data->protdemon == 1 ? 'checked' : ''}}>
        </span> <span>
          <label for="art-rbt-protocol">Protocol Demonstration/Modification</label>
        </span></li>
                                <li><span>
          <input id="art-rbt-tmeeting" type="checkbox" name="teammeeting" value="1" {{$data->teammeeting == 1 ? 'checked' : ''}}>
        </span> <span>
          <label for="art-rbt-tmeeting">Team Meeting</label>
        </span></li>
                                <li><span>
          <input id="art-rbt-other" type="checkbox" name="datother" value="1" {{$data->datother == 1 ? 'checked' : ''}}>
        </span><span class="other">
          <label for="art-rbt-other">Other:</label>
          <input type="text" name="datotherexp" value="{{$data->datotherexp}}">
        </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="box box_1 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="activities-feedback">Positive Feedback Given:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="activities-feedback" rows="5" name="posfeed">{{$data->posfeed}} </textarea>
                    </div>
                </div>
                <div class="box box_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="art-rbt-tech">Teach:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="art-rbt-tech" rows="5" name="teach"> {{$data->teach}}</textarea>
                    </div>
                </div>
                <div class="box box_3 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="activities-model">Model:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="activities-model" rows="5" name="moddel"> {{$data->moddel}}</textarea>
                    </div>
                </div>
                <div class="box box_4 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="activities-coach">Coach:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="activities-coach" rows="5" name="coach">{{$data->coach}} </textarea>
                    </div>
                </div>
                <div class="box box_5 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="activities-review">Review/Feedback:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="activities-review" rows="5" name="review"> {{$data->review}}</textarea>
                    </div>
                </div>
                <div class="box box_6 mb_30">
                    <div class="flex-div">
                        <div>
                            <label>IOA Collected? <span class="red bracket"></span>:</label>
                        </div>
                        <div class="check-box-area">
                            <ul>
                                <li><span>
          <input id="io-yes" type="radio" name="ioa" value="1" {{$data->ioa == 1 ? 'checked' : ''}}>
        </span><span>
          <label for="io-yes">Yes</label>
        </span></li>
                                <li><span>
          <input id="io-no" type="radio" name="ioa" value="2" {{$data->ioa == 2 ? 'checked' : ''}}>
        </span> <span>
          <label for="io-no">No</label>
        </span></li>
                            </ul>
                        </div>
                        <p>
                            <label for="indicate-program"><span class="red bracket">so, please indicate program and data here or on
        a
        separate DTT sheet:</span> </label>
                        </p>
                        <div class="textarea">
                            <textarea rows="5" name="dttsheet">{{$data->dttsheet}}</textarea>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section_7 mb_40">
                <div class="inner-main-title">
                    <h2>ABT/RBT GOALS DATA COLLECTION</h2>
                </div>
                <div class="box box_1 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="goal-1">Goal 1:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="goal-1" rows="5" name="goal1"> {{$data->goal1}}</textarea>
                    </div>
                </div>
                <div class="box box_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="goal-2">Goal 2:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="goal-2" rows="5" name="goal2"> {{$data->goal2}}</textarea>
                    </div>
                </div>
                <div class="box box_3 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            <label for="goal-3">Goal 3:</label>
                        </h3>
                    </div>
                    <div class="textarea">
                        <textarea id="goal-3" rows="5" name="goal3"> {{$data->goal3}}</textarea>
                    </div>
                </div>
            </section>
            <section class="section_4 signature-section mb_40">
                <p>I agree with the session date, times, and notes listed above. </p>
                <div class="flex-div row-flex div_33 mb_30">
                    <div class="col-item">
                        <div class="flex-div"> <span>
                <label for="parent-sign">Parent/Caregiver Signature:</label>
            </span> <span>
            <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i
                    class="fa fa-signature"></i></a>
                        </div>
                        <div class="col-item">
                            <div class="flex-div"> <span>
                <label for="parent-print-name">Print Name: </label>
            </span> <span>
            <input id="parent-print-name" type="text" name="parprint" value="{{$data->parprint}}">
        </span></div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div"> <span>
                <label for="parent-sign-date">Date:</label>
            </span><span>
            <input id="parent-sign-date" type="date" name="pardate" value="{{$data->pardate}}">
        </span></div>
                        </div>
                    </div>
                    <div class="flex-div row-flex div_33 mb_30">
                        <div class="col-item">
                            <div class="flex-div">
                <span>
                    <label for="pm-cm-sign">PM or CM Signature & Credential: </label>
                </span>
                                <span>
                    <a href="#" data-target="#signatureModal2" data-toggle="modal">Add Signature<i
                            class="fa fa-signature"></i></a>
                </span>
                            </div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div">
                <span>
                    <label for="pm-cm-print-name">Print Name: </label>
                </span>
                                <span>
                    <input id="pm-cm-print-name" type="text" name="pmprint" value="{{$data->pmprint}}">
                </span>
                            </div>
                        </div>
                        <div class="col-item">
                            <div class="flex-div">
                <span>
                    <label for="pm-cm-sign-date">Date:</label>
                </span>
                                <span>
                    <input id="pm-cm-sign-date" type="date" name="pmdate" value="{{$data->pmdate}}">
                </span>
                            </div>
                        </div>
                    </div>
            </section>
            <section class="section_bottom">
                <div class="button-row flex-div">
                    <div class="save-prog">
                        <button type="submit"><span class="cloud-icon"><i class="fas fa-cloud"></i></span> Save</button>
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
                    <p><strong>{{$name_location->facility_name}}</strong> {{$name_location->address}}
                        . {{$name_location->city}}
                        , {{$name_location->state}} {{$name_location->zip}}
                    </p>
                </div>
                <div class="col-item">
                    <p><a href="tel:{{$name_location->phone_one}}">Phone: {{$name_location->phone_one}},</a> &nbsp;<a
                            href="mailto:{{$name_location->email}}"> <span>Email:</span>
                            {{$name_location->email}},</a>&nbsp;<a
                            href="{{$name_location->email}}">{{$name_location->email}}</a></p>
                </div>
            </div>
        </div>


        <form class="pdf_form" action="{{ route('superadmin.print.form.7')}}" target="_blank" method="POST">
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

        $(document).on('click', '.pdf_btn', function () {
            $('.pdf_form').submit();
        })
        $(document).on('submit', '#form_7', function (e) {
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
                url: "{{route('superadmin.7.form.submit')}}",
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
