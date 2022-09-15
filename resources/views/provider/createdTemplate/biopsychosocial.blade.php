<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biopsychosocial</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem24/')}}/css/custom-24.css">
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
            <form action="" method="POST" id="form_24">
                @csrf
                
                <div class="page-title mb_40">
                    <h1>Biopsychosocial</h1>
                </div>
                <div class="content">
                    <section class="section_1">
                        <div class="box box1">
                            <h3>Presenting Problem<br>
                                <span class="bracket">(Why are they here? In client's own words when possible. Please
                                    include
                                    current behavior/ past 30 days of client’s behavior)</span>
                            </h3>
                            <textarea rows="5" name="presentprob">{{$data->presentprob}}</textarea>
                            <input type="hidden" name="sessionid" class="session_id" value="{{$session_id}}">

                        </div>
                        <div class="box box2">
                            <h3>History:<br>
                                <span class="bracket">(Early symptoms and past diagnosis; describe the onset of
                                    symptoms)</span>
                            </h3>
                            <textarea rows="5" name="history">{{$data->history}}</textarea>
                        </div>
                        <div class="box box3">
                            <h3>Risk of Harm:<br>
                                <span class="bracket">(high risks behaviors i.e. SI/HI, Impulse Control, Substance Use,
                                    Sexual
                                    behavior /Perpetrator)</span>
                            </h3>
                            <textarea rows="5" name="riskharm">{{$data->riskharm}}</textarea>
                        </div>
                        <div class="box box4">
                            <h3>Trauma:<br>
                                <span class="bracket">(i.e. sexual abuse, physical abuse, etc)</span>
                            </h3>
                            <textarea rows="5" name="trauma">{{$data->trauma}}</textarea>
                        </div>
                        <div class="box box6">
                            <h3>Comorbidities:</h3>
                            <textarea rows="5" name="comorbid">{{$data->comorbid}}</textarea>
                        </div>
                        <div class="box box7">
                            <h3>Environmental Stressors:<br>
                                <span class="bracket">(i.e. gang activity, poverty, etc)</span>
                            </h3>
                            <textarea rows="5" name="environ">{{$data->environ}}</textarea>
                        </div>
                        <div class="box box8">
                            <h3>Deficits in Support System:<br>
                                <span class="bracket">(i.e. single parent household)</span>
                            </h3>
                            <textarea rows="5" name="defictsupport">{{$data->defictsupport}}</textarea>
                        </div>
                        <div class="box box9">
                            <h3>Transportation:</h3>
                            <textarea rows="5" name="transportation">{{$data->transportation}}</textarea>
                        </div>
                        <div class="box box10">
                            <h3>What service(s) is the client requesting?<br>
                                <span class="bracket">(What do you want to get out of the services?)</span>
                            </h3>
                            <textarea rows="5" name="clientrequest">{{$data->clientrequest}}</textarea>
                        </div>
                    </section>
                    <section class="section_2">
                        <div class="inner-main-title">
                            <h4>Lifespan/Developmental History</h4>
                        </div>
                        <div class="box box1">
                            <h3>What is the client’s prenatal history?:</h3>
                            <textarea rows="5" name="prenatal">{{$data->prenatal}}</textarea>
                        </div>
                        <div class="box box2">
                            <h3>Health at birth:</h3>
                            <textarea rows="5" name="health">{{$data->health}}</textarea>
                        </div>
                        <div class="box box3">
                            <h3>Developmental milestones:</h3>
                            <textarea rows="5" name="devmile">{{$data->devmile}}</textarea>
                        </div>
                        <div class="box box4">
                            <h3>Special services received during lifetime:</h3>
                            <textarea rows="5" name="specialserv">{{$data->specialserv}}</textarea>
                        </div>
                        <div class="box box5">
                            <h3>Other lifespan/developmental issues: <br>
                                <span class="bracket">(Include mid-life, senior/elder, other issues)</span> </h3>
                            <textarea rows="5" name="otherlife">{{$data->otherlife}}</textarea>
                        </div>
                    </section>
                    <section class="section_3">
                        <div class="inner-main-title">
                            <h4>Education Assessment:</h4>
                        </div>
                        <div class="box box1 flex-div">
                            <div class="col-item">
                                <h3>School currently attending:</h3>
                                <input type="text" value="{{$data->attending}}" name="attending">
                            </div>
                            <div class="col-item">
                                <h3>Grade:</h3>
                                <input type="text" value="{{$data->grade}}" name="grade">
                            </div>
                        </div>
                        <div class="box box2">
                            <h3>Has the client ever been suspended or expelled from school and/or bus?: <br>
                                <span class="bracket">(Include both in-school suspensions and out-of-school suspensions)
                                    If so,
                                    include the number of times, dates of suspension and duration of suspension.</span>
                            </h3>
                            <textarea rows="5" name="expell">{{$data->expell}}</textarea>
                        </div>
                        <div class="box box3">
                            <div class="col-item mb_30">
                                <h3>Does the client have frequent absences?: <br>
                                    <span class="bracket">(Include the number of times consumer has been absent).</span>
                                </h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="yes" type="radio" {{$data->absences == 1 ? 'checked' : ''}} name="absences" value="1"> <label for="yes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="no" type="radio" {{$data->absences == 2 ? 'checked' : ''}} name="absences" value="2"> <label for="no">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item mb_30">
                                <h3>Is the client currently failing, and has the client ever been retained?: <br>
                                </h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="ryes" type="radio" {{$data->retained == 1 ? 'checked' : ''}} name="retained" value="1"> <label for="ryes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="rno" type="radio" {{$data->retained == 2 ? 'checked' : ''}} name="retained" value="2"> <label for="rno">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item mb_30">
                                <h3>Is the client in special education classes?:</h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="eyes" type="radio" {{$data->classes == 1 ? 'checked' : ''}} name="classes" value="1"> <label for="eyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="eno" type="radio" {{$data->classes == 2 ? 'checked' : ''}} name="classes" value="2"> <label for="eno">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_4">
                        <div class="inner-main-title">
                            <h4>Family of Origin History</h4>
                        </div>
                        <div class="box box1">
                            <h3>Family's current and past psychiatric history: </h3>
                            <textarea rows="5" name="pastpsy">{{$data->pastpsy}}</textarea>
                        </div>
                        <div class="box box2">
                            <h3>Family's and client's physical/sexual/emotional abuse history:</h3>
                            <textarea rows="5" name="physical">{{$data->physical}}</textarea>
                        </div>
                        <div class="box box3">
                            <h3>Family's substance use/abuse history:</h3>
                            <textarea rows="5" name="substance">{{$data->substance}}</textarea>
                        </div>
                        <div class="box box4">
                            <h3>Families Presentation of the Problem:</h3>
                            <textarea rows="5" name="present">{{$data->present}}</textarea>
                        </div>
                        <div class="box box5">
                            <h3>Families Expected Outcome for Services:</h3>
                            <textarea rows="5" name="outcome">{{$data->outcome}}</textarea>
                        </div>
                        <div class="box box6">
                            <h3>Client's Current and Significant Past Supports:<br>
                                <span class="bracket">(Social supports, family supports, significant relationships,
                                    religious
                                    and spiritual supports/affiliations.)</span></h3>
                            <textarea rows="5" name="pastsupport">{{$data->pastsupport}}</textarea>
                        </div>
                        <div class="box box7">
                            <h3>Other Providers/Systems involved with:<br>
                                <span class="bracket">(List agencies client is involved with or receiving services from.
                                    For
                                    example: CalWORKs, ASOC, Inpatient/outpatient hospitalization, Rehab centers, etc;
                                    Include
                                    the name of the
                                    agency and primary contact person)</span></h3>
                            <textarea rows="5" name="otherprovider">{{$data->otherprovider}}</textarea>
                        </div>
                        <div class="box box8">
                            <div class="col-item ">
                                <h3>Client's Legal History:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="iprob" type="checkbox" {{$data->lhistinfo == 1 ? 'checked' : ''}} name="lhistinfo" value="1"> <label
                                                for="iprob">Informal
                                                Probation</label>
                                        </li>
                                        <li>
                                            <input id="cws" type="checkbox" {{$data->lhistwel == 1 ? 'checked' : ''}} name="lhistwel" value="1"> <label for="cws">Child
                                                Welfare
                                                Services</label>
                                        </li>
                                        <li>
                                            <input id="rs-order" type="checkbox" {{$data->lhistrestrain == 1 ? 'checked' : ''}} name="lhistrestrain" value="1"> <label
                                                for="rs-order">Restraining Order</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="fprob" type="checkbox" {{$data->lhistformal == 1 ? 'checked' : ''}} name="lhistformal" value="1"> <label
                                                for="fprob">Formal
                                                Probation</label>
                                        </li>
                                        <li>
                                            <input id="conservatorship" type="checkbox" {{$data->lhistconserv == 1 ? 'checked' : ''}} name="lhistconserv" value="1"> <label
                                                for="conservatorship">Conservatorship</label>
                                        </li>
                                        <li>
                                            <input id="non-report" type="checkbox" {{$data->lhistnone == 1 ? 'checked' : ''}} name="lhistnone" value="1"> <label
                                                for="non-report">None reported</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="parole" type="checkbox" {{$data->lhistparole == 1 ? 'checked' : ''}} name="lhistparole" value="1"> <label
                                                for="parole">Parole</label>
                                        </li>
                                        <li>
                                            <input id="dui" type="checkbox" {{$data->lhistdui == 1 ? 'checked' : ''}} name="lhistdui" value="1"> <label for="dui">D. U.
                                                I.</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box9">
                            <span class="bracket">(Describe and, if currently involved, give name of probation officer,
                                parole
                                office, or case manager and estimated start and end dates.)</span></h3>
                            <textarea rows="5" name="probationoff">{{$data->probationoff}}</textarea>
                        </div>
                        <div class="box box10">
                            <div class="col-item ">
                                <h3>Client's Substance Use: <br>
                                    <span class="bracket">(Alcohol and other drugs, check all that apply.)</span></h3>
                                <div class="select-area mtb_10">
                                    <ul>
                                        <li>
                                            <input id="substanceyes" type="radio" {{$data->ssubstance == 1 ? 'checked' : ''}} name="ssubstance" value="1"> <label
                                                for="substanceyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="substanceno" type="radio" {{$data->ssubstance == 2 ? 'checked' : ''}} name="ssubstance" value="2"> <label
                                                for="substanceno">No</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="caffeine" type="checkbox" {{$data->caffeine == 1 ? 'checked' : ''}} name="caffeine" value="1"> <label
                                                for="caffeine">Caffeine</label>
                                        </li>
                                        <li>
                                            <input id="p-medicine" type="checkbox" {{$data->prescr == 1 ? 'checked' : ''}} name="prescr" value="1"> <label
                                                for="p-medicine">Prescription Medication</label>
                                        </li>
                                        <li>
                                            <input id="hallucinogens" type="checkbox" {{$data->halluc == 1 ? 'checked' : ''}} name="halluc" value="1"> <label
                                                for="hallucinogens">Hallucinogens</label>
                                        </li>

<?php

$data=$data2;

?>
                                        <li>
                                            <input id="sedatives" type="checkbox" {{$data->sdativ == 1 ? 'checked' : ''}} name="sdativ" value="1"> <label
                                                for="sedatives">Sedatives</label>
                                        </li>
                                        <li>
                                            <input id="barbituates" type="checkbox" {{$data->barbit == 1 ? 'checked' : ''}} name="barbit" value="1"> <label
                                                for="barbituates">Barbituates</label>
                                        </li>
                                        <li>
                                            <input id="methadone" type="checkbox" {{$data->methad == 1 ? 'checked' : ''}} name="methad" value="1"> <label
                                                for="methadone">Methadone</label>
                                        </li>
                                        <li>
                                            <input id="other" type="checkbox" {{$data->subother == 1 ? 'checked' : ''}} name="subother" value="1"> <label
                                                for="other">Other</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="tobacco" type="checkbox" {{$data->tobacco == 1 ? 'checked' : ''}} name="tobacco" value="1"> <label
                                                for="tobacco">Tobacco</label>
                                        </li>
                                        <li>
                                            <input id="alcohol" type="checkbox" {{$data->alcohol == 1 ? 'checked' : ''}} name="alcohol" value="1"> <label
                                                for="alcohol">Alcohol</label>
                                        </li>
                                        <li>
                                            <input id="marijuana" type="checkbox" {{$data->mariju == 1 ? 'checked' : ''}} name="mariju" value="1"> <label
                                                for="marijuana">Marijuana</label>
                                        </li>
                                        <li>
                                            <input id="tranqulizers" type="checkbox" {{$data->tranqu == 1 ? 'checked' : ''}} name="tranqu" value="1"> <label
                                                for="tranqulizers">Tranqulizers</label>
                                        </li>
                                        <li>
                                            <input id="methamphetamines" type="checkbox" {{$data->metham == 1 ? 'checked' : ''}} name="metham" value="1"> <label
                                                for="methamphetamines">Methamphetamines</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="Over-the-counter" type="checkbox" {{$data->overcount == 1 ? 'checked' : ''}} name="overcount" value="1"> <label
                                                for="Over-the-counter">Over-the-counter Medication</label>
                                        </li>
                                        <li>
                                            <input id="inhalants" type="checkbox" {{$data->inhalant == 1 ? 'checked' : ''}} name="inhalant" value="1"> <label
                                                for="inhalants">Inhalants</label>
                                        </li>
                                        <li>
                                            <input id="stimulants" type="checkbox" {{$data->stimul == 1 ? 'checked' : ''}} name="stimul" value="1"> <label
                                                for="stimulants">Stimulants</label>
                                        </li>
                                        <li>
                                            <input id="cocaine" type="checkbox" {{$data->cocain == 1 ? 'checked' : ''}} name="cocain" value="1"> <label
                                                for="cocaine">Cocaine</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box11">
                            <h3>Client's history of withdrawal, DTs, blackouts (loss of time), seizures, etc. If
                                applicable.
                            </h3>
                            <textarea rows="5" name="withdrawal">{{$data->withdrawal}}</textarea>
                        </div>
                        <div class="box box12">
                            <h3>Ask and record the response to, "What happens when you stop using?":</h3>
                            <textarea rows="5" name="askandrecord">{{$data->askandrecord}}</textarea>
                        </div>
                        <div class="box box13">
                            <h3>What is the longest period of sobriety?:</h3>
                            <textarea rows="5" name="sobriety">{{$data->sobriety}}</textarea>
                        </div>
                        <div class="box box14">
                            <h3>When?:</h3>
                            <textarea rows="5" name="whensobriety">{{$data->whensobriety}}</textarea>
                        </div>
                    </section>
                    <section class="section_5">
                        <div class="inner-main-title">
                            <h1>Mental Health Services History</h1>
                        </div>
                        <div class="box-main-title">
                            <h2>Mental Status Exam</h2>
                        </div>
                        <div class="box box1 flex-div mb_0">
                            <div class="col-item ">
                                <h3>Appearance:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="unremarkable" type="checkbox" {{$data->unremark == 1 ? 'checked' : ''}} name="unremark" value="1"> <label
                                                for="unremarkable">Unremarkable</label>
                                        </li>
                                        <li>
                                            <input id="unkempt" type="checkbox" {{$data->unkempt == 1 ? 'checked' : ''}} name="unkempt" value="1"> <label
                                                for="unkempt">Unkempt</label>
                                        </li>
                                        <li>
                                            <input id="atclothing" type="checkbox" {{$data->atypical == 1 ? 'checked' : ''}} name="atypical" value="1"> <label
                                                for="atclothing">Atypical Clothing</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item ">
                                <h3>Orientation:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="person" type="checkbox" {{$data->person == 1 ? 'checked' : ''}} name="person" value="1"> <label
                                                for="person">Person</label>
                                        </li>
                                        <li>
                                            <input id="place" type="checkbox" {{$data->place == 1 ? 'checked' : ''}} name="place" value="1"> <label
                                                for="place">Place</label>
                                        </li>
                                        <li>
                                            <input id="odate" type="checkbox" {{$data->oridate == 1 ? 'checked' : ''}} name="oridate" value="1"> <label
                                                for="odate">Date</label>
                                        </li>
                                        <li>
                                            <input id="situation" type="checkbox" {{$data->situation == 1 ? 'checked' : ''}} name="situation" value="1"> <label
                                                for="situation">Situation</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item ">
                                <h3>Insight:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="poor" type="checkbox" {{$data->insightpoor == 1 ? 'checked' : ''}} name="insightpoor" value="1"> <label
                                                for="poor">Poor</label>
                                        </li>
                                        <li>
                                            <input id="average" type="checkbox" {{$data->insightaverage == 1 ? 'checked' : ''}} name="insightaverage" value="1"> <label
                                                for="average">Average</label>
                                        </li>
                                        <li>
                                            <input id="good" type="checkbox" {{$data->insightgood == 1 ? 'checked' : ''}} name="insightgood" value="1"> <label
                                                for="good">Good</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item ">
                                <h3>Judgment:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="jpoor" type="checkbox" {{$data->judgpoor == 1 ? 'checked' : ''}} name="judgpoor" value="1"> <label
                                                for="jpoor">Poor</label>
                                        </li>
                                        <li>
                                            <input id="javerage" type="checkbox" {{$data->judgaver == 1 ? 'checked' : ''}} name="judgaver" value="1"> <label
                                                for="javerage">Average</label>
                                        </li>
                                        <li>
                                            <input id="jgood" type="checkbox" {{$data->judggood == 1 ? 'checked' : ''}} name="judggood" value="1"> <label
                                                for="jgood">Good</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box2">
                            <h3>Comments:</h3>
                            <textarea rows="5" name="judgecomment">{{$data->judgecomment}}</textarea>
                        </div>
                    </section>
                    <section class="section_6">
                        <div class="box box3">
                            <div class="col-item ">
                                <h3>Motor Activity:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="unremarkable" type="checkbox" {{$data->motorun == 1 ? 'checked' : ''}} name="motorun" value="1"> <label
                                                for="unremarkable">Unremarkable</label>
                                        </li>
                                        <li>
                                            <input id="restless" type="checkbox" {{$data->motorrest == 1 ? 'checked' : ''}} name="motorrest" value="1"> <label
                                                for="restless">Restless</label>
                                        </li>
                                        <li>
                                            <input id="withdrawn" type="checkbox" {{$data->motorwith == 1 ? 'checked' : ''}} name="motorwith" value="1"> <label
                                                for="withdrawn">Withdrawn</label>
                                        </li>
                                        <li>
                                            <input id="s-speech" type="checkbox" {{$data->motorslurr == 1 ? 'checked' : ''}} name="motorslurr" value="1"> <label
                                                for="s-speech">Slurred Speech</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_7 mb_30">
                        <div class="box-main-title">
                            <h2>Biological Functions:</h2>
                        </div>
                        <div class="select-area">
                            <ul>
                                <li>
                                    <input id="limits" type="checkbox" {{$data->limit == 1 ? 'checked' : ''}} name="limit" value="1"> <label for="limits">All within normal
                                        limits</label>
                                </li>
                            </ul>
                        </div>
                        <div class="box box1">
                            <h3>Sleep Pattern:</h3>
                            <textarea rows="5" name="sleeppat">{{$data->sleeppat}}</textarea>
                        </div>
                        <div class="box box2">
                            <h3>Appetite:</h3>
                            <textarea rows="5" name="appetite">{{$data->appetite}}</textarea>
                        </div>
                        <div class="box box3">
                            <h3>Comments:</h3>
                            <textarea rows="5" name="acomment">{{$data->acomment}}</textarea>
                        </div>
                    </section>
                    <section class="section_8">
                        <div class="box box1">
                            <div class="col-item ">
                                <h3>Affect:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="affeft1" type="checkbox" {{$data->affun == 1 ? 'checked' : ''}} name="affun" value="1"> <label
                                                for="affeft1">Unremarkable</label>
                                        </li>
<?php

$data=$data3;

?>
                                        <li>
                                            <input id="affeft2" type="checkbox" {{$data->affcrit == 1 ? 'checked' : ''}} name="affcrit" value="1"> <label for="affeft2">Self
                                                Critical</label>
                                        </li>
                                        <li>
                                            <input id="affeft3" type="checkbox" {{$data->affflat == 1 ? 'checked' : ''}} name="affflat" value="1"> <label
                                                for="affeft3">Flat</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="affeft4" type="checkbox" {{$data->affangr == 1 ? 'checked' : ''}} name="affangr" value="1"> <label
                                                for="affeft4">Angry</label>
                                        </li>
                                        <li>
                                            <input id="affeft5" type="checkbox" {{$data->affeuph == 1 ? 'checked' : ''}} name="affeuph" value="1"> <label
                                                for="affeft5">Euphoric</label>
                                        </li>
                                        <li>
                                            <input id="affeft6" type="checkbox" {{$data->affsilly == 1 ? 'checked' : ''}} name="affsilly" value="1"> <label
                                                for="affeft6">Silly</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="affeft7" type="checkbox" {{$data->affirri == 1 ? 'checked' : ''}} name="affirri" value="1"> <label
                                                for="affeft7">Irritable</label>
                                        </li>
                                        <li>
                                            <input id="affeft8" type="checkbox" {{$data->affdepr == 1 ? 'checked' : ''}} name="affdepr" value="1"> <label
                                                for="affeft8">Depressed</label>
                                        </li>
                                        <li>
                                            <input id="affeft9" type="checkbox" {{$data->affhope == 1 ? 'checked' : ''}} name="affhope" value="1"> <label
                                                for="affeft9">Hopelessness</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box2">
                            <div class="col-item ">
                                <h3>Depressive-Like Behavior:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="d-like1" type="checkbox" {{$data->depnone == 1 ? 'checked' : ''}} name="depnone" value="1"> <label
                                                for="d-like1">None</label>
                                        </li>
                                        <li>
                                            <input id="d-like2" type="checkbox" {{$data->dephypo == 1 ? 'checked' : ''}} name="dephypo" value="1"> <label
                                                for="d-like2">Hypoactive</label>
                                        </li>
                                        <li>
                                            <input id="d-like3" type="checkbox" {{$data->depfati == 1 ? 'checked' : ''}} name="depfati" value="1"> <label
                                                for="d-like3">Fatigue</label>
                                        </li>
                                        <li>
                                            <input id="d-like4" type="checkbox" {{$data->depfee == 1 ? 'checked' : ''}} name="depfee" value="1"> <label
                                                for="d-like4">Feelings
                                                of Worthlessness</label>
                                        </li>
                                        <li>
                                            <input id="d-like5" type="checkbox" {{$data->depguilt == 1 ? 'checked' : ''}} name="depguilt" value="1"> <label
                                                for="d-like5">Guilt
                                                Feelings</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="d-like6" type="checkbox" {{$data->dephelpless == 1 ? 'checked' : ''}} name="dephelpless" value="1"> <label
                                                for="d-like6">Feelings
                                                of Helpless/Hopeless</label>
                                        </li>
                                        <li>
                                            <input id="d-like7" type="checkbox" {{$data->depirrit == 1 ? 'checked' : ''}} name="depirrit" value="1"> <label
                                                for="d-like7">Irritability</label>
                                        </li>
                                        <li>
                                            <input id="d-like8" type="checkbox" {{$data->deppoor == 1 ? 'checked' : ''}} name="deppoor" value="1"> <label
                                                for="d-like8">Poor
                                                Concentration</label>
                                        </li>
                                        <li>
                                            <input id="d-like9" type="checkbox" {{$data->depsadn == 1 ? 'checked' : ''}} name="depsadn" value="1"> <label
                                                for="d-like9">Sadness</label>
                                        </li>
                                        <li>
                                            <input id="d-like10" type="checkbox" {{$data->depsexual == 1 ? 'checked' : ''}} name="depsexual" value="1"> <label
                                                for="d-like10">Change
                                                in Sexaul Interest</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="d-like11" type="checkbox" {{$data->deploss == 1 ? 'checked' : ''}} name="deploss" value="1"> <label
                                                for="d-like11">Loss
                                                of Ability to Enjoy (Anhedonia)</label>
                                        </li>
                                        <li>
                                            <input id="d-like12" type="checkbox" {{$data->depwithdraw == 1 ? 'checked' : ''}} name="depwithdraw" value="1"> <label
                                                for="d-like12">Withdrawn</label>
                                        </li>
                                        <li>
                                            <input id="d-like13" type="checkbox" {{$data->depself == 1 ? 'checked' : ''}} name="depself" value="1"> <label
                                                for="d-like13">Self-Blame/Self-Criticism</label>
                                        </li>
                                        <li>
                                            <input id="d-like14" type="checkbox" {{$data->depinter == 1 ? 'checked' : ''}} name="depinter" value="1"> <label
                                                for="d-like14">Loss
                                                of Interest</label>
                                        </li>
                                        <li>
                                            <input id="d-like15" type="checkbox" {{$data->depcry == 1 ? 'checked' : ''}} name="depcry" value="1"> <label
                                                for="d-like15">Crying</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box3">
                            <h3>Comments:</h3>
                            <textarea rows="5" name="deprcomm">{{$data->deprcomm}}</textarea>
                        </div>
                        <div class="box box4">
                            <div class="col-item ">
                                <h3>Thinking:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="think-1" type="checkbox" {{$data->thinun == 1 ? 'checked' : ''}} name="thinun" value="1"> <label
                                                for="think-1">Unremarkable</label>
                                        </li>
                                        <li>
                                            <input id="think-2" type="checkbox" {{$data->thindiss == 1 ? 'checked' : ''}} name="thindiss" value="1"> <label
                                                for="think-2">Distracted</label>
                                        </li>
                                        <li>
                                            <input id="think-3" type="checkbox" {{$data->thindel == 1 ? 'checked' : ''}} name="thindel" value="1"> <label
                                                for="think-3">Delusions</label>
                                        </li>
                                        <li>
                                            <input id="think-4" type="checkbox" {{$data->thinhyp == 1 ? 'checked' : ''}} name="thinhyp" value="1"> <label
                                                for="think-4">Hypochondriasis</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="think-5" type="checkbox" {{$data->thindis == 1 ? 'checked' : ''}} name="thindis" value="1"> <label
                                                for="think-5">Disorganized</label>
                                        </li>
                                        <li>
                                            <input id="think-6" type="checkbox" {{$data->thinsus == 1 ? 'checked' : ''}} name="thinsus" value="1"> <label
                                                for="think-6">Suspicious</label>
                                        </li>
                                        <li>
                                            <input id="think-7" type="checkbox" {{$data->thinobs == 1 ? 'checked' : ''}} name="thinobs" value="1"> <label
                                                for="think-7">Obsessions</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="think-8" type="checkbox" {{$data->thinfli == 1 ? 'checked' : ''}} name="thinfli" value="1"> <label
                                                for="think-8">Flight of
                                                Ideas</label>
                                        </li>
                                        <li>
                                            <input id="think-9" type="checkbox" {{$data->thinconf == 1 ? 'checked' : ''}} name="thinconf" value="1"> <label
                                                for="think-9">Confused</label>
                                        </li>
                                        <li>
                                            <input id="think-10" type="checkbox" {{$data->thingrand == 1 ? 'checked' : ''}} name="thingrand" value="1"> <label
                                                for="think-10">Delusions Obsessions Grandiosity</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box5">
                            <h3>Comments:</h3>
                            <textarea rows="5" name="thinkcomm">{{$data->thinkcomm}}</textarea>
                        </div>
                        <div class="box box6">
                            <div class="col-item ">
                                <h3>Attitude:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="att-1" type="checkbox" {{$data->attun == 1 ? 'checked' : ''}} name="attun" value="1"> <label
                                                for="att-1">Unremarkable</label>
                                        </li>
                                        <li>
                                            <input id="att-2" type="checkbox" {{$data->attego == 1 ? 'checked' : ''}} name="attego" value="1"> <label
                                                for="att-2">Egocentric</label>
                                        </li>
                                        <li>
                                            <input id="att-3" type="checkbox" {{$data->attsar == 1 ? 'checked' : ''}} name="attsar" value="1"> <label
                                                for="att-3">Sarcastic</label>
                                        </li>
                                        <li>
                                            <input id="att-4" type="checkbox" {{$data->attres == 1 ? 'checked' : ''}} name="attres" value="1"> <label
                                                for="att-4">Resistant</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="att-5" type="checkbox" {{$data->attcont == 1 ? 'checked' : ''}} name="attcont" value="1"> <label
                                                for="att-5">Controlling</label>
                                        </li>
<?php

$data=$data4;

?>
                                        <li>
                                            <input id="att-6" type="checkbox" {{$data->atthost == 1 ? 'checked' : ''}} name="atthost" value="1"> <label
                                                for="att-6">Hostile</label>
                                        </li>
                                        <li>
                                            <input id="att-7" type="checkbox" {{$data->attneg == 1 ? 'checked' : ''}} name="attneg" value="1"> <label
                                                for="att-7">Negativistic</label>
                                        </li>
                                        <li>
                                            <input id="att-8" type="checkbox" {{$data->attpass == 1 ? 'checked' : ''}} name="attpass" value="1"> <label
                                                for="att-8">Passive</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="att-9" type="checkbox" {{$data->attaggr == 1 ? 'checked' : ''}} name="attaggr" value="1"> <label
                                                for="att-9">Passive-Aggressive</label>
                                        </li>
                                        <li>
                                            <input id="att-10" type="checkbox" {{$data->attsedu == 1 ? 'checked' : ''}} name="attsedu" value="1"> <label
                                                for="att-10">Seductive</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box7">
                            <h3>Comments:</h3>
                            <textarea rows="5" name="attitudecomm">{{$data->attitudecomm}}</textarea>
                        </div>
                        <div class="box box8">
                            <h3>Medical History/Information:</h3>
                            <textarea rows="5" name="medhistory">{{$data->medhistory}}</textarea>
                        </div>
                        <div class="box box9">
                            <h3>Medical Conditions:<br>
                                <span class="bracket">(List significant past and present medical conditions, including
                                    allergies, recent lab results, etc .)</span>
                            </h3>
                            <textarea rows="5" name="medcond">{{$data->medcond}}</textarea>
                        </div>
                    </section>
                    <section class="section_9">
                        <div class="box box1">
                            <div class="flex-div">
                                <div class="col-item">
                                    <h3>Primary Care Physician's Contact Information:</h3>
                                    <textarea rows="1" name="contactinfo">{{$data->contactinfo}}</textarea>
                                </div>
                                <div class="col-item">
                                    <h3>Date of last physical examinations:</h3>
                                    <input type="date" value="{{$data->lastdate}}" name="lastdate">
                                </div>
                            </div>
                        </div>
                        <div class="box box2">
                            <div class="col-item mb_30">
                                <h3>Current with immunizations?: <br>
                                </h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="imyes" type="radio" {{$data->immunizations == 1 ? 'checked' : ''}} name="immunizations" value="1"> <label
                                                for="imyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="imno" type="radio" {{$data->immunizations == 2 ? 'checked' : ''}} name="immunizations" value="2"> <label
                                                for="imno">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box3">
                            <div class="flex-div">
                                <div class="col-item">
                                    <h3>Consumer’s Height:</h3>
                                    <input type="text" value="{{$data->height}}" name="height">
                                </div>
                                <div class="col-item">
                                    <h3>Consumer’s Weight:</h3>
                                    <input type="text" value="{{$data->weight}}" name="weight">
                                </div>
                            </div>
                        </div>
                        <div class="box box4">
                            <div class="col-item mb_30">
                                <h3>Consumer Satisfied with Current Weight?: <br>
                                </h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="satisfiedna" type="radio" {{$data->satisfied == 1 ? 'checked' : ''}} name="satisfied" value="1"> <label
                                                for="satisfiedna">N/A</label>
                                        </li>
                                        <li>
                                        <li>
                                            <input id="satisfiedyes" type="radio" {{$data->satisfied == 2 ? 'checked' : ''}} name="satisfied" value="2"> <label
                                                for="satisfiedyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="satisfiedno" type="radio" {{$data->satisfied == 3 ? 'checked' : ''}} name="satisfied" value="3"> <label
                                                for="satisfiedno">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item mb_30">
                                <h3>Ever Diagnosed with an Eating Disorder?:
                                </h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="diagnosedna" type="radio" {{$data->diagnosed == 1 ? 'checked' : ''}} name="diagnosed" value="1"> <label
                                                for="diagnosedna">N/A</label>
                                        </li>
                                        <li>
                                            <input id="diagnosedyes" type="radio" {{$data->diagnosed == 2 ? 'checked' : ''}} name="diagnosed" value="2"> <label
                                                for="diagnosedyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="diagnosedno" type="radio" {{$data->diagnosed == 3 ? 'checked' : ''}} name="diagnosed" value="3"> <label
                                                for="diagnosedno">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item mb_30">
                                <h3>Consumer Need a Referral for a Nutritional Assessment?:</h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="referralna" type="radio" {{$data->referral == 1 ? 'checked' : ''}} name="referral" value="1"> <label
                                                for="referralna">N/A</label>
                                        </li>
                                        <li>
                                            <input id="referralyes" type="radio" {{$data->referral == 2 ? 'checked' : ''}} name="referral" value="2"> <label
                                                for="referralyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="referralno" type="radio" {{$data->referral == 3 ? 'checked' : ''}} name="referral" value="3"> <label
                                                for="referralno">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_10">
                        <div class="inner-main-title">
                            <h1>Medication History</h1>
                        </div>
                        <div class="wrap-flex-div">
                            <div class="srno">
                                <h2>1</h2>
                            </div>
                            <div class="box box1">
                                <div class="flex-div mb_30">
                                    <div class="col-item ">
                                        <h3>Medication Name</h3>
                                        <input type="text" value="{{$data->med}}" name="med">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Dosage/ Frequency</h3>
                                        <input type="text" value="{{$data->dosage}}" name="dosage">
                                    </div>
                                </div>
                                <div class="flex-div mb_30">
                                    <div class="col-item">
                                        <h3>Effective</h3>
                                        <input type="text" value="{{$data->effect}}" name="effect">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Compliance</h3>
                                        <input type="text" value="{{$data->compli}}" name="compli">
                                    </div>
                                </div>
                                <div class="full mb_30">
                                    <div class="col-item">
                                        <h3>Prescribed By</h3>
                                        <input type="text" value="{{$data->prescrr}}" name="prescrr">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-flex-div">
                            <div class="srno">
                                <h2>2</h2>
                            </div>
                            <div class="box box1">
                                <div class="flex-div mb_30">
                                    <div class="col-item ">
                                        <h3>Medication Name</h3>
                                        <input type="text" value="{{$data->medname}}" name="medname">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Dosage/ Frequency</h3>
                                        <input type="text" value="{{$data->dosefreq}}" name="dosefreq">
                                    </div>
                                </div>
                                <div class="flex-div mb_30">
                                    <div class="col-item">
                                        <h3>Effective</h3>
                                        <input type="text" value="{{$data->effective}}" name="effective">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Compliance</h3>
                                        <input type="text" value="{{$data->compl}}" name="compl">
                                    </div>
                                </div>
                                <div class="full mb_30">
                                    <div class="col-item">
                                        <h3>Prescribed By</h3>
                                        <input type="text" value="{{$data->presby}}" name="presby">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-flex-div">
                            <div class="srno">
                                <h2>3</h2>
                            </div>
                            <div class="box box1">
                                <div class="flex-div mb_30">
                                    <div class="col-item ">
                                        <h3>Medication Name</h3>
                                        <input type="text" value="{{$data->med3}}" name="med3">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Dosage/ Frequency</h3>
                                        <input type="text" value="{{$data->freq3}}" name="freq3">
                                    </div>
                                </div>
                                <div class="flex-div mb_30">
                                    <div class="col-item">
                                        <h3>Effective</h3>
                                        <input type="text" value="{{$data->effect3}}" name="effect3">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Compliance</h3>
                                        <input type="text" value="{{$data->compl3}}" name="compl3">
                                    </div>
                                </div>
                                <div class="full mb_30">
                                    <div class="col-item">
                                        <h3>Prescribed By</h3>
                                        <input type="text" value="{{$data->pres3}}" name="pres3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-flex-div">
                            <div class="srno">
                                <h2>4</h2>
                            </div>
                            <div class="box box1">
                                <div class="flex-div mb_30">
                                    <div class="col-item ">
                                        <h3>Medication Name</h3>
                                        <input type="text" value="{{$data->med4}}" name="med4">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Dosage/ Frequency</h3>
                                        <input type="text" value="{{$data->freq4}}" name="freq4">
                                    </div>
                                </div>
                                <div class="flex-div mb_30">
                                    <div class="col-item">
                                        <h3>Effective</h3>
                                        <input type="text" value="{{$data->effect4}}" name="effect4">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Compliance</h3>
                                        <input type="text" value="{{$data->compl4}}" name="compl4">
                                    </div>
                                </div>
                                <div class="full mb_30">
                                    <div class="col-item">
                                        <h3>Prescribed By</h3>
                                        <input type="text" value="{{$data->pres4}}" name="pres4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-flex-div">
                            <div class="srno">
                                <h2>5</h2>
                            </div>
                            <div class="box box1">
                                <div class="flex-div mb_30">
                                    <div class="col-item ">
                                        <h3>Medication Name</h3>
                                        <input type="text" value="{{$data->med5}}" name="med5">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Dosage/ Frequency</h3>
                                        <input type="text" value="{{$data->freq5}}" name="freq5">
                                    </div>
                                </div>
                                <div class="flex-div mb_30">
                                    <div class="col-item">
                                        <h3>Effective</h3>
                                        <input type="text" value="{{$data->effect5}}" name="effect5">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Compliance</h3>
                                        <input type="text" value="{{$data->compl5}}" name="compl5">
                                    </div>
                                </div>

<?php

$data=$data5;

?>
                                <div class="full mb_30">
                                    <div class="col-item">
                                        <h3>Prescribed By</h3>
                                        <input type="text" value="{{$data->pres5}}" name="pres5">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_11">
                        <div class="box box1">
                            <h3>Daily Living Skills :<br>
                                <span class="bracket">(Personal Care, Laundry, Cleaning)</span>
                            </h3>
                            <textarea rows="5" name="dailyliving">{{$data->dailyliving}}</textarea>
                        </div>
                        <div class="box box2">
                            <h3>Daily Living Skills :<br>
                                <span class="bracket">(List All Tasks that consumer is able to
                                    complete/Strengths)</span>
                            </h3>
                            <textarea rows="5" name="alltask">{{$data->alltask}}</textarea>
                        </div>
                        <div class="box box3">
                            <div class="col-item mb_30">
                                <h3>Does client require assistive technology?<br>
                                </h3>
                                <div class="select-area mtb_10">
                                    <ul>
                                        <li>
                                            <input id="technologyes" type="radio" {{$data->technology == 1 ? 'checked' : ''}} name="technology" value="1"> <label
                                                for="technologyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="technologno" type="radio" {{$data->technology == 2 ? 'checked' : ''}} name="technology" value="2"> <label
                                                for="technologno">No</label>
                                        </li>
                                    </ul>
                                </div>
                                <span class="bracket">(If yes, specify what is needed.)</span>
                                <textarea rows="5" name="assisrequire">{{$data->assisrequire}}</textarea>
                            </div>
                        </div>
                        <div class="box box5">
                            <h3>Relationship Analysis:<br>
                                <span class="bracket">(Consumer's relationship status, gender identity, etc.)</span>
                            </h3>
                            <textarea rows="5" name="relationana">{{$data->relationana}}</textarea>
                        </div>
                    </section>
                    <section class="section_12">
                        <div class="inner-main-title">
                            <h1>Current Symptoms/Problems <br><span class="bracket">Rate severity and duration for
                                    each:</span>
                            </h1>
                        </div>
                        <div class="box box1">
                            <table cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Severity</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Anxiety</td>
                                        <td><input type="text" value="{{$data->anxtxt}}" name="anxtxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->anxtime)->format('H:i:s')}}" name="anxtime"></td>
                                    </tr>
                                    <tr>
                                        <td>Panic Attacks</td>
                                        <td><input type="text" value="{{$data->pantxt}}" name="pantxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->pantime)->format('H:i:s')}}" name="pantime"></td>
                                    </tr>
                                    <tr>
                                        <td>Phobia Compulsive</td>
                                        <td><input type="text" value="{{$data->photxt}}" name="photxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->photime)->format('H:i:s')}}" name="photime"></td>
                                    </tr>
                                    <tr>
                                        <td>Obessive</td>
                                        <td><input type="text" value="{{$data->obesstxt}}" name="obesstxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->obesstime)->format('H:i:s')}}" name="obesstime"></td>
                                    </tr>
                                    <tr>
                                        <td>Somatization</td>
                                        <td><input type="text" value="{{$data->somatxt}}" name="somatxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->somatime)->format('H:i:s')}}" name="somatime"></td>
                                    </tr>
                                    <tr>
                                        <td>Depression</td>
                                        <td><input type="text" value="{{$data->deprtxt}}" name="deprtxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->deprtime)->format('H:i:s')}}" name="deprtime"></td>
                                    </tr>
                                    <tr>
                                        <td>Impaired Memory</td>
                                        <td><input type="text" value="{{$data->impatxt}}" name="impatxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->impatime)->format('H:i:s')}}" name="impatime"></td>
                                    </tr>
                                    <tr>
                                        <td>Poor Self Care Skills</td>
                                        <td><input type="text" value="{{$data->poortxt}}" name="poortxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->poortime)->format('H:i:s')}}" name="poortime"></td>
                                    </tr>
                                    <tr>
                                        <td>Loss of Interest</td>
                                        <td><input type="text" value="{{$data->inttxt}}" name="inttxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->inttime)->format('H:i:s')}}" name="inttime"></td>
                                    </tr>
                                    <tr>
                                        <td>Sexual Dysfunction</td>
                                        <td><input type="text" value="{{$data->dystxt}}" name="dystxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->dystime)->format('H:i:s')}}" name="dystime"></td>
                                    </tr>
                                    <tr>
                                        <td>Weight Change</td>
                                        <td><input type="text" value="{{$data->weighttxt}}" name="weighttxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->weighttime)->format('H:i:s')}}" name="weighttime"></td>
                                    </tr>
                                    <tr>
                                        <td>Bizarre Ideation</td>
                                        <td><input type="text" value="{{$data->bizarrtxt}}" name="bizarrtxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->bizarrtime)->format('H:i:s')}}" name="bizarrtime"></td>
                                    </tr>
                                    <tr>
                                        <td>Bizarre Behavior</td>
                                        <td><input type="text" value="{{$data->bbtxt}}" name="bbtxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->bbtime)->format('H:i:s')}}" name="bbtime"></td>
                                    </tr>
                                    <tr>
                                        <td>Paranoid Ideation</td>
                                        <td><input type="text" value="{{$data->pitxt}}" name="pitxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->pitime)->format('H:i:s')}}" name="pitime"></td>
                                    </tr>
                                    <tr>
                                        <td>Poor Judgment</td>
                                        <td><input type="text" value="{{$data->pjtxt}}" name="pjtxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->pjtime)->format('H:i:s')}}" name="pjtime"></td>
                                    </tr>
                                    <tr>
                                        <td>Poor Interpersonal Skills</td>
                                        <td><input type="text" value="{{$data->pistxt}}" name="pistxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->pistime)->format('H:i:s')}}" name="pistime"></td>
                                    </tr>
                                    <tr>
                                        <td>Conduct Problems</td>
                                        <td><input type="text" value="{{$data->cptxt}}" name="cptxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->cptime)->format('H:i:s')}}" name="cptime"></td>
                                    </tr>
                                    <tr>
                                        <td>School Problems</td>
                                        <td><input type="text" value="{{$data->sptxt}}" name="sptxt"></td>

<?php

$data=$data6;

?>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->sptime)->format('H:i:s')}}" name="sptime"></td>
                                    </tr>
                                    <tr>
                                        <td>Family Problems</td>
                                        <td><input type="text" value="{{$data->fptxt}}" name="fptxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->fptime)->format('H:i:s')}}" name="fptime"></td>
                                    </tr>
                                    <tr>
                                        <td>Indep Living Problems</td>
                                        <td><input type="text" value="{{$data->indetxt}}" name="indetxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->indetime)->format('H:i:s')}}" name="indetime"></td>
                                    </tr>
                                    <tr>
                                        <td class="other">Other <input type="text" value="{{$data->othr}}" name="othr"></td>
                                        <td><input type="text" value="{{$data->othtxt}}" name="othtxt"></td>
                                        <td><input type="time" value="{{\Carbon\Carbon::parse($data->othtime)->format('H:i:s')}}" name="othtime"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <section class="section_13">
                        <div class="box box1">
                            <h3>Briefly describe identified Symptoms:</h3>
                            <textarea rows="5" value="idensymp">{{$data->idensymp}}</textarea>
                        </div>
                        <div class="box box2">
                            <h3>Summary of Consumer's SNAPS</h3>
                            <textarea rows="5" name="summarycons">{{$data->summarycons}}</textarea>
                        </div>
                        <div class="box box3">
                            <h3>(Consumer's Goals/Hopes for the Future)</h3>
                            <textarea rows="5" name="cghfuture">{{$data->cghfuture}}</textarea>
                        </div>
                        <div class="box box4">
                            <h3>What things do you like about yourself?:</h3>
                            <textarea rows="5" name="likeyour">{{$data->likeyour}}</textarea>
                        </div>
                        <div class="box box5">
                            <h3>What things would you like to improve about your behaviors/symptoms & how?</h3>
                            <textarea rows="5" name="likeimprove">{{$data->likeimprove}}</textarea>
                        </div>
                        <div class="box box6">
                            <h3>What accomplishments are you most proud of in your personal life?:</h3>
                            <textarea rows="5" name="proudlife">{{$data->proudlife}}</textarea>
                        </div>
                        <div class="box box7">
                            <h3>Consumer's and family's expectations from participating in this program?:</h3>
                            <textarea rows="5" name="expectpart">{{$data->expectpart}}</textarea>
                        </div>
                    </section>
                    <section class="section_14">
                        <div class="inner-main-title">
                            <h4>Summary of consumer's SNAPS <br>
                                <span class="bracket">(Strengths, Needs, Abilities and Preferences)</span>
                            </h4>
                        </div>
                        <div class="box box1">
                            <h3>Strengths:</h3>
                            <textarea rows="5" name="strength">{{$data->strength}}</textarea>
                        </div>
                        <div class="box box2">
                            <h3>Needs:</h3>
                            <textarea rows="5" name="needs">{{$data->needs}}</textarea>
                        </div>
                        <div class="box box3">
                            <h3>Abilities:</h3>
                            <textarea rows="5" name="abilities">{{$data->abilities}}</textarea>
                        </div>
                        <div class="box box4">
                            <h3>Preferences:</h3>
                            <textarea rows="5" name="prefer">{{$data->prefer}}</textarea>
                        </div>
                        <div class="box box5">
                            <h3>Problems List:</h3>
                            <textarea rows="5" name="problemlist">{{$data->problemlist}}</textarea>
                        </div>
                    </section>
                    <section class="section_15">
                        <div class="inner-main-title">
                            <h4>Clinical Summary<br>
                            </h4>
                        </div>
                        <div class="box box1">
                            <h3>Diagnostic Rationale/Summary of Findings:<br>
                                <span class="bracket">(Strengths, Needs, Abilities and Preferences)</span></h3>
                            <textarea rows="5" name="diagrational">{{$data->diagrational}}</textarea>
                        </div>
                        <div class="box box2">
                            <h3>Interpretive Summary:</h3>
                            <textarea rows="5" name="intersumm">{{$data->intersumm}}</textarea>
                        </div>
                        <div class="box box3">
                            <div class="col-item ">
                                <h3>Recommended Services:<br>
                                    <span class="bracket">(Check all that apply.)</span>
                                </h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="rservices-1" type="checkbox" {{$data->rscomm == 1 ? 'checked' : ''}} name="rscomm" value="1"> <label
                                                for="rservices-1">Community referrals made, no further services
                                                needed</label>
                                        </li>
                                        <li>
                                            <input id="rservices-2" type="checkbox" {{$data->rsmed == 1 ? 'checked' : ''}} name="rsmed" value="1"> <label
                                                for="rservices-2">Medication assessment</label>
                                        </li>
                                        <li>
                                            <input id="rservices-3" type="checkbox" {{$data->rsind == 1 ? 'checked' : ''}} name="rsind" value="1"> <label
                                                for="rservices-3">Individual therapy</label>
                                        </li>
                                        <li>
                                            <input id="rservices-4" type="checkbox" {{$data->rsfam == 1 ? 'checked' : ''}} name="rsfam" value="1"> <label
                                                for="rservices-4">Family therapy</label>
                                        </li>
                                        <li>
                                            <input id="rservices-5" type="checkbox" {{$data->rstesting == 1 ? 'checked' : ''}} name="rstesting" value="1"> <label
                                                for="rservices-5">Testing</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="rservices-6" type="checkbox" {{$data->rscare == 1 ? 'checked' : ''}} name="rscare" value="1"> <label
                                                for="rservices-6">By primary care physician</label>
                                        </li>
                                        <li>
                                            <input id="rservices-7" type="checkbox" {{$data->rsbtl == 1 ? 'checked' : ''}} name="rsbtl" value="1"> <label
                                                for="rservices-7">Brief therapy Long-term</label>
                                        </li>
                                        <li>
                                            <input id="rservices-8" type="checkbox" {{$data->rscoll == 1 ? 'checked' : ''}} name="rscoll" value="1"> <label
                                                for="rservices-8">Collateral</label>
                                        </li>
                                        <li>
                                            <input id="rservices-9" type="checkbox" {{$data->rsreha == 1 ? 'checked' : ''}} name="rsreha" value="1"> <label
                                                for="rservices-9">Day rehab/treatment</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="rservices-10" type="checkbox" {{$data->rsasoc == 1 ? 'checked' : ''}} name="rsasoc" value="1"> <label
                                                for="rservices-10">By ASOC or CSOG psychiatrist</label>
                                        </li>
                                        <li>
                                            <input id="rservices-11" type="checkbox" {{$data->rsltt == 1 ? 'checked' : ''}} name="rsltt" value="1"> <label
                                                for="rservices-11">Long-term therapy</label>
                                        </li>
                                        <li>
                                            <input id="rservices-12" type="checkbox" {{$data->rsgrou == 1 ? 'checked' : ''}} name="rsgrou" value="1"> <label
                                                for="rservices-12">Group</label>
                                        </li>
                                        <li>
                                            <input id="rservices-13" type="checkbox" {{$data->rsother == 1 ? 'checked' : ''}} name="rsother" value="1"> <label
                                                for="rservices-13">Other</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box4">
                            <h3>If community referrals were made, please describe:</h3>
                            <textarea rows="5" name="referrall">{{$data->referrall}}</textarea>
                        </div>
                        <div class="box box5">
                            <h3>If client was placed on 1013, please give details:<br>
                                <span class="bracket">(IE: Which hospital, how transported, etc.)</span>
                            </h3>
                            <textarea rows="5" name="whichhospital">{{$data->whichhospital}}</textarea>
                        </div>
                        <div class="box box6">
                            <h3>DSM V<br>
                            </h3>
                            <textarea rows="5" name="dsmv">{{$data->dsmv}}</textarea>
                        </div>
                        <div class="box box7">
                            <h3>Recommendations for Treatment/ Services:<br>
                                <span class="bracket">(Please indicate what services you are recommended and how each
                                    service
                                    can benefit the client)</span>
                            </h3>
                            <textarea rows="5" name="rectreat">{{$data->rectreat}}</textarea>
                        </div>
                        <div class="box box-8">
                            <h3>Projected date of Discharge/Transition:<br>
                            </h3>
                            <div class="flex-div">
                                <div class="col-item">
                                    <input type="date" value="{{$data->projectdate}}" name="projectdate">
                                </div>
                            </div>
                        </div>
                        <div class="box box9">
                            <h3>Anticipated Stepdown:<br>
                                <span class="bracket">(Please include specific step-down linkage in client’s area,
                                    frequency, of
                                    attendance, and contact information of services that you will recommend once they
                                    have
                                    successfully
                                    completed services with A.C.E)</span>
                            </h3>
                            <textarea rows="5" name="clarea">{{$data->clarea}}</textarea>
                        </div>
                        <div class="box box10">
                            <h3>Discharge Plan:<br>
                                <span class="bracket">(Place all Objectives from the Treatment Plan in this section; the
                                    steps
                                    the individual has agreed to do to accomplish the goals)</span>
                            </h3>
                            <textarea rows="5" name="dischplan">{{$data->dischplan}}</textarea>
                        </div>
                    </section>
                </div>
              
                <div class="section_bottom m-0">
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
            <form class="pdf_form" action="{{ route('provider.print.form.24')}}" target="_blank" method="POST">
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
        $(document).on('submit', '#form_24', function (e) {
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
                url: "{{route('provider.24.form.submit')}}",
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
