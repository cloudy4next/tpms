<?php
use App\Models\Appoinment;
use App\Models\Employee;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

$cl=Appoinment::where('admin_id',Auth::user()->admin_id)->where('id',$session_id)->first();
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
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>PRIVATE CLIENT INTAKE FORM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem9/')}}/css/custom-9.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
      .logo_img{
        width: 100px;
        height: 100px;
      }
    </style>
</head>

<body>
<div class="pvt-insurance">
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
            <h1>PRIVATE CLIENT INTAKE FORM</h1>
        </div>
        <form action="" method="POST" id="form_9">
            @csrf
            <section class="section_1 mb_30">
                <div class="flex-div mb_30">
                    <div class="col-item">
                        <div class="input-area">
                            <span><label for="clname">Client Name: </label></span> <span><input type="text" id="clname" name="clname" value="{{$client->client_full_name}}"></span>
                            <input type="hidden" name="sessionid" value="{{$session_id}}">
                        </div>
                    </div>
                    <div class="col-item">
                        <div class="input-area">
                            <span><label for="dob">DOB: </label></span> <span><input type="date" id="dob" name="dob" value="{{ $client->client_dob }}"></span>
                        </div>
                    </div>
                </div>
                <div class="flex-div mb_30">
                    <div class="col-item">
                        <div class="input-area">
                            <span><label for="adate">Date of Assessment: </label></span> <span><input type="date" name="doa" value="{{ $cl->schedule_date}}"></span></div>
                    </div>
                    <div class="col-item">
                        <div class="input-area">
                            <span><label>Place of Assessment: </label></span> <span><input type="text" name="poa"></span>
                        </div>
                    </div>
                </div>
                <div class="flex-div mb_30">
                    <div class="col-item">
                        <div class="input-area">
                            <span><label for="address">Address: </label></span> <span><input type="text" id="address" name="address"></span>
                        </div>
                    </div>
                    <div class="col-item">
                        <div class="input-area">
                            <span><label>Phone Number: </label></span> <span><input type="tel" maxlength="11" name="phone"></span>
                        </div>
                    </div>
                </div>
                <div class="flex-div mb_30 grade">
                    <div class="col-item">
                        <div class="input-area">
                            <span><label>Insurance/Id#: </label></span> <span><input type="text" name="insid"></span>
                        </div>
                    </div>
                    <div class="col-item">
                        <div class="input-area">
                            <span><label>School/Employer (if applicable): </label> </span> <span><input type="text" name="school"></span>
                            <span><label>Grade (if applicable): </label></span> <span> <input type="text" name="grade"></span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="box">
                    <h3>INTERPRETIVE SUMMARY/PRESENTING PROBLEM:</h3>
                    <textarea rows="5" name="intersum"></textarea>
                </div>
            </section>
            <section class="section_2">
                <div class="inner-main-title">
                    <h2>TREATMENT HISTORY</h2>
                </div>
                <div class="box box1 mb_30">
                    <h3>Are you currently receiving psychiatric services, professional counseling or psychotherapy
                        elsewhere? </h3>
                    <div class="select-area">
                        <ul>
                            <li>
                                <input id="thistory1" type="radio" name="psyserv" value="1"> <label
                                    for="thistory1">Yes</label>
                            </li>
                            <li>
                                <input id="thistory2" type="radio" name="psyserv" value="2"> <label for="thistory2">No</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="box box2 mb_30">
                    <h3>Have you had previous psychotherapy?</h3>
                    <div class="select-area">
                        <ul>
                            <li>
                                <input id="thistory3" type="radio" name="prepsy" value="1"> <label for="thistory3">No</label>
                            </li>
                            <li>
                  <span><input id="thistory4" type="radio" name="prepsy" value="2"> <label for="thistory4">Yes,</label></span>
                            </li>
                        </ul>
                        <span><label class="font-normal"> with (previous therapist’s name)</label></span>
                        <span><input type="text" name="prename"></span>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>Are you currently taking prescribed psychiatric medication (antidepressants or others)?
                    </h3>
                    <div class="select-area">
                        <ul>
                            <li>
                                <input id="thistory5" type="radio" name="psymed" value="1"> <label for="thistory5">No</label>
                            </li>
                            <li class="flex-div">
                  <span><input id="thistory6" type="radio" name="psymed" value="2"> <label for="thistory6">Yes</label> </span>
                            </li>
                        </ul>
                        <p class="font_600">If yes, please list</p> <textarea name="preslist"></textarea>
                        <p class="font_600">Prescribed by:</p> <textarea name="presby"></textarea>
                    </div>
                </div>
            </section>
            <section class="section_4">
                <div class="inner-main-title">
                    <h2>HEALTH AND SOCIAL INFORMATION</h2>
                </div>
                <div class="box mb_30">
                    <h3>Do you currently have a primary physician? </h3>
                    <div class="select-area">
                        <ul>
                            <li>
                                <input id="ha-inform1" type="radio" name="priphy" value="1"> <label
                                    for="ha-inform1">Yes</label>
                            </li>
                            <li>
                                <input id="ha-inform2" type="radio" name="priphy" value="2"> <label
                                    for="ha-inform2">No</label>
                            </li>
                        </ul>
                        <p class="font_600">If yes, who is it? &nbsp; &nbsp; <label class="font-normal">Phone:
                            </label>
                            <input type="tel" name="priphone"></p>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>Are you currently seeing more than one medical health specialist?</h3>
                    <div class="select-area">
                        <ul>
                            <li>
                                <input id="ha-inform1" type="radio" name="mtomed" value="1"> <label
                                    for="ha-inform1">Yes</label>
                            </li>
                            <li>
                                <input id="ha-inform2" type="radio" name="mtomed" value="2"> <label
                                    for="ha-inform2">No</label>
                            </li>
                        </ul>
                        <p class="font_600">If yes, please list:</p>
                        <textarea name="mtolist"></textarea>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>When was your last physical? </h3>
                    <div class="select-area">
                        <textarea name="lastphy"></textarea>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>Please list any persistent physical symptoms or health concerns (e.g. chronic pain,
                        headaches,
                        hypertension, diabetes, etc.: </h3>
                    <div class="select-area">
                        <textarea name="hconc"></textarea>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>Are you currently on medication to manage a physical health concern? If yes, please list:
                    </h3>
                    <div class="select-area">
                        <textarea name="currmed"></textarea>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>Are you having any problems with your sleep habits? </h3>
                    <div class="select-area">
                        <ul>
                            <li>
                                <input id="sl-habits1" type="radio" name="sleephab" value="1"> <label
                                    for="sl-habits1">Yes</label>
                            </li>
                            <li>
                                <input id="sl-habits2" type="radio" name="sleephab" value="2"> <label
                                    for="sl-habits2">No</label>
                            </li>
                        </ul>
                        <p class="font_600">If yes, check where applicable:</p>
                        <select name="sleepcheck">
                            <option value="0">--</option>
                            <option value="1">Sleeping too little</option>
                            <option value="2">Sleeping too much</option>
                            <option value="3">Poor quality sleep</option>
                            <option value="4">Disturbing dreams</option>
                            <option value="5">other</option>
                        </select>
                    </div>
                </div>
                <div class="flex-div mb_30">
                    <div class="col-item">
                        <div class="input-area">
                            <span><label>How many times per week do you exercise? </label></span> <span><input type="text" name="wexc"></span>
                        </div>
                    </div>
                    <div class="col-item">
                        <div class="input-area">
                            <span><label>Approximately how long each time? </label></span> <span><input type="text" name="exclong"></span>
                        </div>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>Are you having any difficulty with appetite or eating habits? </h3>
                    <div class="select-area">
                        <ul>
                            <li>
                                <input id="e-habits1" type="radio" name="ehabit" value="1"> <label
                                    for="e-habits1">Yes</label>
                            </li>
                            <li>
                                <input id="e-habits2" type="radio" name="ehabit" value="2"> <label
                                    for="e-habits2">No</label>
                            </li>
                        </ul>
                        <p class="font_600">If yes, check where applicable:</p>
                        <select name="ehabitcheck">
                            <option selected="selected" value="0">--</option>
                            <option value="1">Eating less</option>
                            <option value="2">Eating more</option>
                            <option value="3">Bingeing</option>
                            <option value="4">Restricting</option>
                        </select>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>Have you experienced significant weight change in the last 2 months? </h3>
                    <div class="select-area">
                        <ul>
                            <li>
                                <input id="weight-change1" type="radio" name="wchange" value="1"> <label for="weight-change1">Yes</label>
                            </li>
                            <li>
                                <input id="weight-change2" type="radio" name="wchange" value="2"> <label
                                    for="weight-change2">No</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>Do you regularly use alcohol? </h3>
                    <div class="select-area">
                        <ul>
                            <li>
                                <input id="use-alcohol1" type="radio" name="usealc" value="1"> <label
                                    for="use-alcohol1">Yes</label>
                            </li>
                            <li>
                                <input id="use-alcohol2" type="radio" name="usealc" value="2"> <label
                                    for="use-alcohol2">No</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>In a typical month, how often do you have 4 or more drinks in a 24 hour period? </h3>
                    <div class="select-area">
                        <select name="drinkp">
                            <option value="0" selected="selected">--</option>
                            <option value="1">1 times</option>
                            <option value="2">2 times</option>
                            <option value="3">3 times</option>
                            <option value="4">4 times</option>
                            <option value="5">5 times</option>
                            <option value="6">6 times</option>
                            <option value="7">7 times</option>
                            <option value="8">8 times</option>
                        </select>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>How often do you engage recreational drug use? </h3>
                    <div class="select-area">
                        <select name="recdrug">
                            <option value="0" selected="selected">Daily</option>
                            <option value="1">Weekly</option>
                            <option value="2">Monthly</option>
                            <option value="3">Rarely</option>
                            <option value="4">Never</option>
                        </select>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>Do you smoke cigarettes or use other tobacco products? </h3>
                    <div class="select-area">
                        <select name="cigar">
                            <option value="0" selected="selected">--</option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                        </select>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>Have you had suicidal thoughts recently?</h3>
                    <div class="select-area">
                        <select name="suith">
                            <option value="0" selected="selected">equently</option>
                            <option value="1">sometimes</option>
                            <option value="2">rarely</option>
                            <option value="3">never</option>
                        </select>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>Have you had them in the past?</h3>
                    <div class="select-area">
                        <select name="suipast">
                            <option value="0" selected="selected">equently</option>
                            <option value="1">frequently</option>
                            <option value="2">sometimes</option>
                            <option value="3">rarely</option>
                            <option value="4">never</option>
                        </select>
                    </div>
                </div>
                <div class="box mb_30 input-box">
                    <h3>Are you currently in a romantic relationship? </h3>
                    <div class="select-area">
                        <ul>
                            <li>
                                <input id="romantic-relation1" type="radio" name="romrel" value="1"> <label for="romantic-relation1">No</label>
                            </li>
                            <li class="flex-div">
                  <span><input id="romantic-relation2" type="radio" name="romrel" value="2"> <label for="romantic-relation2">Yes </label></span>
                            </li>
                        </ul>
                        <p class="font_600">If yes, how long have you been in this relationship?
                        <p> <span><input type="text" name="rellong"></span>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>On a scale of 1-10 (10 being the highest quality), how would you rate your current relationship?
                    </h3>
                    <div class="select-area">
                        <textarea name="relrate"></textarea>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>In the last year, have you experienced any significant life changes or stressors? If yes,
                        please
                        explain: </h3>
                    <div class="select-area">
                        <textarea name="lastchange"></textarea>
                    </div>
                </div>
                <div class="box mb_30 table-box">
                    <h3>Have you ever experienced any of the following?</h3>
                    <table>
                        <tbody>
                        <tr>
                            <td>Extreme depressed mood</td>
                            <td>
                                <select name="depress">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Dramatic mood swings</td>
                            <td>
                                <select name="mood">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Rapid speech</td>
                            <td>
                                <select name="rapids">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Extreme anxiety</td>
                            <td>
                                <select name="extanx">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Panic attacks</td>
                            <td>
                                <select name="panatt">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Phobias</td>
                            <td>
                                <select name="phob">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Sleep disturbances</td>
                            <td>
                                <select name="sleepdis">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Hallucinations</td>
                            <td>
                                <select name="hallu">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Unexplained losses of time</td>
                            <td>
                                <select name="unlosstime">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Unexplained memory lapses</td>
                            <td>
                                <select name="unexmemory">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Alcohol/substance abuse</td>
                            <td>
                                <select name="alabuse">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Frequent body complaints</td>
                            <td>
                                <select name="freqcomp">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Eating disorder</td>
                            <td>
                                <select name="eatdiss">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Body image problems</td>
                            <td>
                                <select name="bodyimg">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Repetitive thoughts (e.g. obsessions)</td>
                            <td>
                                <select name="repth">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Repetitive behaviors (e.g. frequent checking, hand washing)</td>
                            <td>
                                <select name="repbeh">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Homicidal thoughts</td>
                            <td>
                                <select name="homith">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Suicidal attempts</td>
                            <td>
                                <select name="suiattm">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                                <p class="font_600">If yes, when?</p> <input type="text" name="suiwhen">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="section_5 mb_30">
                <div class="inner-main-title">
                    <h2>OCCUPATIONAL INFORMATION</h2>
                </div>
                <div class="box mb_30 input-box">
                    <h3>Are you currently employed? </h3>
                    <div class="select-area">
                        <ul>
                            <li>
                                <input id="cn-employed1" type="radio" name="curremp" value="1"> <label
                                    for="cn-employed1">No</label>
                            </li>
                            <li class="flex-div">
                  <span><input id="cn-employed2" type="radio" name="curremp" value="2"> <label
                                            for="cn-employed2">Yes </label></span>
                            </li>
                        </ul>
                        <div class="flex-div">
                            <p class="font_600">If yes, who is your currently employer/position? </p>
                            <p><span><input type="text" name="emppos"></span></p>
                            <p class="font_600">If yes, are you happy with your current position?</p>
                            <p><span><input type="text" name="emphappy"></span></p>
                        </div>
                        <p class="font_600">Please list any work-related stressors, if any </p>
                        <p><span><textarea rows="5" name="workstress"></textarea></span></p>
                    </div>
                </div>
            </section>
            <section class="section_6 mb_30">
                <div class="inner-main-title">
                    <h2>RELIGIOUS/SPIRITUAL INFORMATION</h2>
                </div>
                <h3>Do you consider yourself to be religious?</h3>
                <div class="box input-box">
                    <div class="select-area">
                        <ul>
                            <li>
                                <input id="religious1" type="radio" name="religious" value="1"> <label
                                    for="religious1">No</label>
                            </li>
                            <li class="flex-div">
                  <span><input id="religious2" type="radio" name="religious" value="2"> <label
                                            for="religious2">Yes
                    </label></span>
                            </li>
                        </ul>
                        <p class="font_600">If yes, what is your faith? </p>
                        <p><span><input type="text" name="faith"></span>
                        </p>
                        <p class="font_600">If no, do you consider yourself to be spiritual? </p>
                        <select name="spiritual">
                            <option value="0" selected="selected">--</option>
                            <option value="1">No</option>
                            <option value="2">Yes</option>
                        </select>
                    </div>
                </div>
            </section>
            <section class="section_7 mb_30">
                <div class="inner-main-title">
                    <h2>FAMILY MENTAL HEALTH HISTORY</h2>
                </div>
                <h3>Has anyone in your family <span class="bracket">(either immediate family members or
              relatives)</span> experienced difficulties with the following? <span class="bracket">(circle
              any
              that apply and list family member, e.g. sibling parent, uncle, etc.)</span></h3>
                <br>
                <div class="box mb_30 table-box">
                    <h3>Have you ever experienced any of the following?</h3>
                    <table>
                        <tbody>
                        <tr>
                            <th><strong>Difficulty</strong></th>
                            <th>
                                <select name="difficulty">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </th>
                            <th><strong>Family member</strong></th>
                        </tr>
                        <tr>
                            <td>Depression</td>
                            <td>
                                <select name="depr">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                            <td><input type="text" name="depexp"></td>
                        </tr>
                        <tr>
                            <td>Bipolar disorder</td>
                            <td>
                                <select name="bipdis">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                            <td><input type="text" name="bipdisexp"></td>
                        </tr>
                        <tr>
                            <td>Anxiety disorder</td>
                            <td>
                                <select name="anxdis">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                            <td><input type="text" name="anxdisexp"></td>
                        </tr>
                        <tr>
                            <td>Panic attacks</td>
                            <td>
                                <select name="panicatt">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                            <td><input type="text" name="panicattexp"></td>
                        </tr>
                        <tr>
                            <td>Schizophrenia</td>
                            <td>
                                <select name="sch">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                            <td><input type="text" name="schexp"></td>
                        </tr>
                        <tr>
                            <td>Alcohol/substance abuse</td>
                            <td>
                                <select name="abuse">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                            <td><input type="text" name="abusexp"></td>
                        </tr>
                        <tr>
                            <td>Eating disorders</td>
                            <td>
                                <select name="eatdis">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                            <td><input type="text" name="eatdisexp"></td>
                        </tr>
                        <tr>
                            <td>Learning disabilities</td>
                            <td>
                                <select name="leardis">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                            <td><input type="text" name="leardisexp"></td>
                        </tr>
                        <tr>
                            <td>Trauma history</td>
                            <td>
                                <select name="trauma">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                            <td><input type="text" name="traumaexp"></td>
                        </tr>
                        <tr>
                            <td>Suicide attempts</td>
                            <td>
                                <select name="suiatt">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                            <td><input type="text" name="suiattexp"></td>
                        </tr>
                        <tr>
                            <td>Chronic illness</td>
                            <td>
                                <select name="chrill">
                                    <option value="0" selected="selected">-</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </td>
                            <td><input type="text" name="chrillexp"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="section_8">
                <div class="inner-main-title">
                    <h2>OTHER INFORMATION</h2>
                </div>
                <div class="box mb_30">
                    <h3>What do you consider to be your strengths? </h3>
                    <div class="select-area">
                        <textarea name="strength"></textarea>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>What do you like most about yourself? </h3>
                    <div class="select-area">
                        <textarea name="aboutyou"></textarea>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>What are effective coping strategies that you have learned? </h3>
                    <div class="select-area">
                        <textarea name="copstra"></textarea>
                    </div>
                </div>
                <div class="box mb_30">
                    <h3>What are your goals for therapy? </h3>
                    <div class="select-area">
                        <textarea name="goalthe"></textarea>
                    </div>
                </div>
                <div class="table-box">
                    <table>
                        <thead>
                        <tr>
                            <th colspan="4">
                                <div class="inner-main-title">
                                    <h2>SERVICES BEING PROVIDED TO CONSUMER (Please check all that apply)</h2>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td><span class="chekmark"><input type="checkbox" name="diagassess" value="1"></span> Diagnostic Assessment</td>
                            <td><span class="chekmark"><input type="checkbox" name="nurse" value="1"></span> Nursing Assessment & Care
                            </td>
                            <td><span class="chekmark"><input type="checkbox" name="psytest" value="1"></span> Psychological Testing</td>
                            <td><span class="chekmark"><input type="checkbox" name="psytreat" value="1"></span> Psychiatric Treatment</td>
                        </tr>
                        <tr>
                            <td><span class="chekmark"><input type="checkbox" name="medadmin" value="1"></span> Medication Administration
                            </td>
                            <td><span class="chekmark"><input type="checkbox" name="commsupport" value="1"></span> Community Support
                                Individual
                            </td>
                            <td><span class="chekmark"><input type="checkbox" name="indout" value="1"></span> Individual Outpatient
                                Services
                            </td>
                            <td><span class="chekmark"><input type="checkbox" name="outser" value="1"></span> Family Outpatient Services
                            </td>
                        </tr>
                        <tr>
                            <td><span class="chekmark"><input type="checkbox" name="groupout" value="1"></span> Group Outpatient Services
                            </td>
                            <td><span class="chekmark"><input type="checkbox" name="intenfam" value="1"></span> Intensive Family
                                Intervention
                            </td>
                            <td><span class="chekmark"><input type="checkbox" name="stab" value="1"></span> Crisis Stabilization</td>
                            <td><span class="chekmark"><input type="checkbox" name="struct" value="1"></span> Structured Activity
                                Supports
                            </td>
                        </tr>
                        <tr>
                            <td><span class="chekmark"><input type="checkbox" name="psyassess" value="1"></span>Psychical Assessment</td>
                            <td><span class="chekmark"><input type="checkbox" name="behass" value="1"></span> Behavior Assistant</td>
                            <td><span class="chekmark"><input type="checkbox" name="otherr" value="1"></span> Other</td>
                            <td><span class="chekmark"><input type="checkbox" name="otherr2" value="1"></span> Other</td>
                        </tr>
                        </thead>
                    </table>
                  
                </div>
            </section>
            <section class="section_bottom">
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
      <form class="pdf_form" action="{{ route('provider.print.form.9')}}" target="_blank" method="POST">
            @csrf
            <input type="hidden" name="session_id" class="session_id" value="{{$session_id}}">
        </form>
    </div>
</div>
<!--/ signature modal -->
<!-- Jq Files -->
<script src="{{asset('assets/dashboard//')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/bootstrap.min.js"></script>

<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>

<script>
    $(document).ready(function () {
      $('.pdf_btn').hide();

      $(document).on('click','.pdf_btn',function(){
            $('.pdf_form').submit();
        })
        $(document).on('submit', '#form_9', function (e) {
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
                url: "{{route('provider.9.form.submit')}}",
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
