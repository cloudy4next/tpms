<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/custom.css">
    <title>PRIVATE CLIENT INTAKE FORM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/template/tem9/') }}/css/custom-9.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
        .logo_img {
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
                                <img src="{{ asset($logo->logo) }}" alt="" class="logo_img">
                            @endif

                        </a></div>
                </div>
                <div class="col-item">
                    <div class="info-details">
                        <ul>
                            <li><span>Mail:</span>{{ $name_location->address }}. {{ $name_location->city }}
                                , {{ $name_location->state }} {{ $name_location->zip }}
                            </li>
                            <li><a href="mailto:{{ $name_location->email }}">
                                    <span>Email:</span>{{ $name_location->email }}</a>
                            </li>
                            <li><span>Phone:</span> {{ $name_location->phone_one }}</li>
                            {{-- <li><a href="fax:+18183695800"><span>Fax:</span>818.369.5800</a></li> --}}
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
                                <span><label for="clname">Client Name: </label></span> <span><input type="text"
                                        id="clname" name="clname" value="{{ $data->clname }}"></span>
                                <input type="hidden" name="sessionid" value="{{ $session_id }}">
                            </div>
                        </div>
                        <div class="col-item">
                            <div class="input-area">
                                <span><label for="dob">DOB: </label></span> <span><input type="date"
                                        id="dob" name="dob" value="{{ $data->dob }}"></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex-div mb_30">
                        <div class="col-item">
                            <div class="input-area">
                                <span><label for="adate">Date of Assessment: </label></span> <span><input
                                        type="date" name="doa" value="{{ $data->doa }}"></span>
                            </div>
                        </div>
                        <div class="col-item">
                            <div class="input-area">
                                <span><label>Place of Assessment: </label></span> <span><input type="text"
                                        name="poa" value="{{ $data->poa }}"></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex-div mb_30">
                        <div class="col-item">
                            <div class="input-area">
                                <span><label for="address">Address: </label></span> <span><input type="text"
                                        id="address" name="address" value="{{ $data->address }}"></span>
                            </div>
                        </div>
                        <div class="col-item">
                            <div class="input-area">
                                <span><label>Phone Number: </label></span> <span><input type="tel" maxlength="11"
                                        name="phone" value="{{ $data->phone }}"></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex-div mb_30 grade">
                        <div class="col-item">
                            <div class="input-area">
                                <span><label>Insurance/Id#: </label></span> <span><input type="text" name="insid"
                                        value="{{ $data->insid }}"></span>
                            </div>
                        </div>
                        <div class="col-item">
                            <div class="input-area">
                                <span><label>School/Employer (if applicable): </label> </span> <span><input
                                        type="text" name="school" value="{{ $data->school }}"></span>
                                <span><label>Grade (if applicable): </label></span> <span> <input type="text"
                                        name="grade" value="{{ $data->grade }}"></span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="box">
                        <h3>INTERPRETIVE SUMMARY/PRESENTING PROBLEM:</h3>
                        <textarea rows="5" name="intersum">{{ $data->intersum }}</textarea>
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
                                    <input id="thistory1" type="radio" {{ $data->psyserv == 1 ? 'checked' : '' }}
                                        name="psyserv" value="1"> <label for="thistory1">Yes</label>
                                </li>
                                <li>
                                    <input id="thistory2" type="radio" {{ $data->psyserv == 2 ? 'checked' : '' }}
                                        name="psyserv" value="2"> <label for="thistory2">No</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="box box2 mb_30">
                        <h3>Have you had previous psychotherapy?</h3>
                        <div class="select-area">
                            <ul>
                                <li>
                                    <input id="thistory3" type="radio" {{ $data->prepsy == 1 ? 'checked' : '' }}
                                        name="prepsy" value="1"> <label for="thistory3">No</label>
                                </li>
                                <li>
                                    <span><input id="thistory4" type="radio"
                                            {{ $data->prepsy == 2 ? 'checked' : '' }} name="prepsy" value="2">
                                        <label for="thistory4">Yes,</label></span>
                                </li>
                            </ul>
                            <span><label class="font-normal"> with (previous therapist’s name)</label></span>
                            <span><input type="text" name="prename" value="{{ $data->prename }}"></span>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>Are you currently taking prescribed psychiatric medication (antidepressants or others)?
                        </h3>
                        <div class="select-area">
                            <ul>
                                <li>
                                    <input id="thistory5" type="radio" {{ $data->psymed == 1 ? 'checked' : '' }}
                                        name="psymed" value="1"> <label for="thistory5">No</label>
                                </li>
                                <li class="flex-div">
                                    <span><input id="thistory6" type="radio"
                                            {{ $data->psymed == 2 ? 'checked' : '' }} name="psymed" value="2">
                                        <label for="thistory6">Yes</label> </span>
                                </li>
                            </ul>
                            <p class="font_600">If yes, please list</p>
                            <textarea name="preslist">{{ $data->preslist }}</textarea>
                            <p class="font_600">Prescribed by:</p>
                            <textarea name="presby">{{ $data->presby }}</textarea>
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
                                    <input id="ha-inform1" type="radio" {{ $data->priphy == 1 ? 'checked' : '' }}
                                        name="priphy" value="1"> <label for="ha-inform1">Yes</label>
                                </li>
                                <li>
                                    <input id="ha-inform2" type="radio" {{ $data->priphy == 2 ? 'checked' : '' }}
                                        name="priphy" value="2"> <label for="ha-inform2">No</label>
                                </li>
                            </ul>
                            <p class="font_600">If yes, who is it? &nbsp; &nbsp; <label class="font-normal">Phone:
                                </label>
                                <input type="tel" name="priphone" value="{{ $data->priphone }}">
                            </p>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>Are you currently seeing more than one medical health specialist?</h3>
                        <div class="select-area">
                            <ul>
                                <li>
                                    <input id="ha-inform1" type="radio" {{ $data->mtomed == 1 ? 'checked' : '' }}
                                        name="mtomed" value="1"> <label for="ha-inform1">Yes</label>
                                </li>
                                <li>
                                    <input id="ha-inform2" type="radio" {{ $data->mtomed == 2 ? 'checked' : '' }}
                                        name="mtomed" value="2"> <label for="ha-inform2">No</label>
                                </li>
                            </ul>
                            <p class="font_600">If yes, please list:</p>
                            <textarea name="mtolist">{{ $data->mtolist }}</textarea>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>When was your last physical? </h3>
                        <div class="select-area">
                            <textarea name="lastphy">{{ $data->lastphy }}</textarea>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>Please list any persistent physical symptoms or health concerns (e.g. chronic pain,
                            headaches,
                            hypertension, diabetes, etc.: </h3>
                        <div class="select-area">
                            <textarea name="hconc">{{ $data->hconc }}</textarea>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>Are you currently on medication to manage a physical health concern? If yes, please list:
                        </h3>
                        <div class="select-area">
                            <textarea name="currmed">{{ $data->currmed }}</textarea>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>Are you having any problems with your sleep habits? </h3>
                        <div class="select-area">
                            <ul>
                                <li>
                                    <input id="sl-habits1" type="radio" {{ $data->sleephab == 1 ? 'checked' : '' }}
                                        name="sleephab" value="1"> <label for="sl-habits1">Yes</label>
                                </li>
                                <li>
                                    <input id="sl-habits2" type="radio" {{ $data->sleephab == 2 ? 'checked' : '' }}
                                        name="sleephab" value="2"> <label for="sl-habits2">No</label>
                                </li>
                            </ul>
                            <p class="font_600">If yes, check where applicable:</p>
                            <select name="sleepcheck">
                                <option {{ $data->sleepcheck == 0 ? 'selected' : '' }} value="0">--</option>
                                <option {{ $data->sleepcheck == 1 ? 'selected' : '' }} value="1">Sleeping too
                                    little</option>
                                <option {{ $data->sleepcheck == 2 ? 'selected' : '' }} value="2">Sleeping too
                                    much</option>
                                <option {{ $data->sleepcheck == 3 ? 'selected' : '' }} value="3">Poor quality
                                    sleep</option>
                                <option {{ $data->sleepcheck == 4 ? 'selected' : '' }} value="4">Disturbing
                                    dreams</option>
                                <option {{ $data->sleepcheck == 5 ? 'selected' : '' }} value="5">other</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex-div mb_30">
                        <div class="col-item">
                            <div class="input-area">
                                <span><label>How many times per week do you exercise? </label></span> <span><input
                                        type="text" name="wexc" value="{{ $data->wexc }}"></span>
                            </div>
                        </div>
                        <div class="col-item">
                            <div class="input-area">
                                <span><label>Approximately how long each time? </label></span> <span><input
                                        type="text" name="exclong" value="{{ $data->exclong }}"></span>
                            </div>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>Are you having any difficulty with appetite or eating habits? </h3>
                        <div class="select-area">
                            <ul>
                                <li>
                                    <input id="e-habits1" type="radio" {{ $data->ehabit == 1 ? 'checked' : '' }}
                                        name="ehabit" value="1"> <label for="e-habits1">Yes</label>
                                </li>
                                <li>
                                    <input id="e-habits2" type="radio" {{ $data->ehabit == 2 ? 'checked' : '' }}
                                        name="ehabit" value="2"> <label for="e-habits2">No</label>
                                </li>
                            </ul>
                            <p class="font_600">If yes, check where applicable:</p>
                            <select name="ehabitcheck">
                                <option {{ $data->ehabitcheck == 0 ? 'selected' : '' }} value="0">--</option>
                                <option {{ $data->ehabitcheck == 1 ? 'selected' : '' }} value="1">Eating less
                                </option>
                                <option {{ $data->ehabitcheck == 2 ? 'selected' : '' }} value="2">Eating more
                                </option>
                                <option {{ $data->ehabitcheck == 3 ? 'selected' : '' }} value="3">Bingeing
                                </option>
                                <option {{ $data->ehabitcheck == 4 ? 'selected' : '' }} value="4">Restricting
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>Have you experienced significant weight change in the last 2 months? </h3>
                        <div class="select-area">
                            <ul>
                                <li>
                                    <input id="weight-change1" type="radio"
                                        {{ $data->wchange == 1 ? 'checked' : '' }} name="wchange" value="1">
                                    <label for="weight-change1">Yes</label>
                                </li>
                                <li>
                                    <input id="weight-change2" type="radio"
                                        {{ $data->wchange == 2 ? 'checked' : '' }} name="wchange" value="2">
                                    <label for="weight-change2">No</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>Do you regularly use alcohol? </h3>
                        <div class="select-area">
                            <ul>
                                <li>
                                    <input id="use-alcohol1" type="radio" {{ $data->usealc == 1 ? 'checked' : '' }}
                                        name="usealc" value="1"> <label for="use-alcohol1">Yes</label>
                                </li>
                                <li>
                                    <input id="use-alcohol2" type="radio" {{ $data->usealc == 2 ? 'checked' : '' }}
                                        name="usealc" value="2"> <label for="use-alcohol2">No</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>In a typical month, how often do you have 4 or more drinks in a 24 hour period? </h3>
                        <div class="select-area">
                            <select name="drinkp">
                                <option {{ $data->drinkp == 0 ? 'selected' : '' }} value="0">--</option>
                                <option {{ $data->drinkp == 1 ? 'selected' : '' }} value="1">1 times</option>
                                <option {{ $data->drinkp == 2 ? 'selected' : '' }} value="2">2 times</option>
                                <option {{ $data->drinkp == 3 ? 'selected' : '' }} value="3">3 times</option>
                                <option {{ $data->drinkp == 4 ? 'selected' : '' }} value="4">4 times</option>
                                <option {{ $data->drinkp == 5 ? 'selected' : '' }} value="5">5 times</option>
                                <option {{ $data->drinkp == 6 ? 'selected' : '' }} value="6">6 times</option>
                                <option {{ $data->drinkp == 7 ? 'selected' : '' }} value="7">7 times</option>
                                <option {{ $data->drinkp == 8 ? 'selected' : '' }} value="8">8 times</option>
                            </select>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>How often do you engage recreational drug use? </h3>
                        <div class="select-area">
                            <select name="recdrug">
                                <option {{ $data->recdrug == 0 ? 'selected' : '' }} value="0">Daily</option>
                                <option {{ $data->recdrug == 1 ? 'selected' : '' }} value="1">Weekly</option>
                                <option {{ $data->recdrug == 2 ? 'selected' : '' }} value="2">Monthly</option>
                                <option {{ $data->recdrug == 3 ? 'selected' : '' }} value="3">Rarely</option>
                                <option {{ $data->recdrug == 4 ? 'selected' : '' }} value="4">Never</option>
                            </select>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>Do you smoke cigarettes or use other tobacco products? </h3>
                        <div class="select-area">
                            <select name="cigar">
                                <option {{ $data->cigar == 0 ? 'selected' : '' }} value="0">--</option>
                                <option {{ $data->cigar == 1 ? 'selected' : '' }} value="1">Yes</option>
                                <option {{ $data->cigar == 2 ? 'selected' : '' }} value="2">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>Have you had suicidal thoughts recently?</h3>
                        <div class="select-area">
                            <select name="suith">
                                <option {{ $data->suith == 0 ? 'selected' : '' }} value="0">equently</option>
                                <option {{ $data->suith == 1 ? 'selected' : '' }} value="1">sometimes</option>
                                <option {{ $data->suith == 2 ? 'selected' : '' }} value="2">rarely</option>
                                <option {{ $data->suith == 3 ? 'selected' : '' }} value="3">never</option>
                            </select>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>Have you had them in the past?</h3>
                        <div class="select-area">
                            <select name="suipast">
                                <option {{ $data->suipast == 0 ? 'selected' : '' }} value="0">equently</option>
                                <option {{ $data->suipast == 1 ? 'selected' : '' }} value="1">frequently</option>
                                <option {{ $data->suipast == 2 ? 'selected' : '' }} value="2">sometimes</option>
                                <option {{ $data->suipast == 3 ? 'selected' : '' }} value="3">rarely</option>
                                <option {{ $data->suipast == 4 ? 'selected' : '' }} value="4">never</option>
                            </select>
                        </div>
                    </div>
                    <div class="box mb_30 input-box">
                        <h3>Are you currently in a romantic relationship? </h3>
                        <div class="select-area">
                            <ul>
                                <li>
                                    <input id="romantic-relation1" type="radio"
                                        {{ $data->romrel == 1 ? 'checked' : '' }} name="romrel" value="1">
                                    <label for="romantic-relation1">No</label>
                                </li>
                                <li class="flex-div">
                                    <span><input id="romantic-relation2" type="radio"
                                            {{ $data->romrel == 2 ? 'checked' : '' }} name="romrel" value="2">
                                        <label for="romantic-relation2">Yes </label></span>
                                </li>
                            </ul>
                            <p class="font_600">If yes, how long have you been in this relationship?
                            <p> <span><input type="text" name="rellong" value="{{ $data->rellong }}"></span>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>On a scale of 1-10 (10 being the highest quality), how would you rate your current
                            relationship?
                        </h3>
                        <div class="select-area">
                            <textarea name="relrate">{{ $data->relrate }}</textarea>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>In the last year, have you experienced any significant life changes or stressors? If yes,
                            please
                            explain: </h3>
                        <div class="select-area">
                            <textarea name="lastchange">{{ $data->lastchange }}</textarea>
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
                                            <option {{ $data->depress == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->depress == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->depress == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dramatic mood swings</td>
                                    <td>
                                        <select name="mood">
                                            <option {{ $data->mood == 0 ? 'selected' : '' }} value="0">-</option>
                                            <option {{ $data->mood == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->mood == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rapid speech</td>
                                    <td>
                                        <select name="rapids">
                                            <option {{ $data->rapids == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->rapids == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->rapids == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Extreme anxiety</td>
                                    <td>
                                        <select name="extanx">
                                            <option {{ $data->extanx == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->extanx == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->extanx == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Panic attacks</td>
                                    <td>
                                        <select name="panatt">
                                            <option {{ $data->panatt == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->panatt == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->panatt == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phobias</td>
                                    <td>
                                        <select name="phob">
                                            <option {{ $data->phob == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->phob == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->phob == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sleep disturbances</td>
                                    <td>
                                        <select name="sleepdis">
                                            <option {{ $data->sleepdis == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->sleepdis == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->sleepdis == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hallucinations</td>
                                    <td>
                                        <select name="hallu">
                                            <option {{ $data->hallu == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->hallu == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->hallu == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Unexplained losses of time</td>
                                    <td>
                                        <select name="unlosstime">
                                            <option {{ $data->unlosstime == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->unlosstime == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->unlosstime == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Unexplained memory lapses</td>
                                    <td>
                                        <select name="unexmemory">
                                            <option {{ $data->unexmemory == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->unexmemory == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->unexmemory == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alcohol/substance abuse</td>
                                    <td>
                                        <select name="alabuse">
                                            <option {{ $data->alabuse == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->alabuse == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->alabuse == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Frequent body complaints</td>
                                    <td>
                                        <select name="freqcomp">
                                            <option {{ $data->freqcomp == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->freqcomp == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->freqcomp == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Eating disorder</td>
                                    <td>
                                        <select name="eatdiss">
                                            <option {{ $data->eatdiss == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->eatdiss == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->eatdiss == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Body image problems</td>
                                    <td>
                                        <select name="bodyimg">
                                            <option {{ $data->bodyimg == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->bodyimg == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->bodyimg == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <?php

                                $data = $data2;

                                ?>
                                <tr>
                                    <td>Repetitive thoughts (e.g. obsessions)</td>
                                    <td>
                                        <select name="repth">
                                            <option {{ $data->repth == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->repth == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->repth == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Repetitive behaviors (e.g. frequent checking, hand washing)</td>
                                    <td>
                                        <select name="repbeh">
                                            <option {{ $data->repbeh == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->repbeh == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->repbeh == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Homicidal thoughts</td>
                                    <td>
                                        <select name="homith">
                                            <option {{ $data->homith == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->homith == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->homith == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Suicidal attempts</td>
                                    <td>
                                        <select name="suiattm">
                                            <option {{ $data->suiattm == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->suiattm == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->suiattm == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                        <p class="font_600">If yes, when?</p> <input type="text" name="suiwhen"
                                            value="{{ $data->suiwhen }}">
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
                                    <input id="cn-employed1" type="radio"
                                        {{ $data->curremp == 1 ? 'checked' : '' }} name="curremp" value="1">
                                    <label for="cn-employed1">No</label>
                                </li>
                                <li class="flex-div">
                                    <span><input id="cn-employed2" type="radio"
                                            {{ $data->curremp == 2 ? 'checked' : '' }} name="curremp"
                                            value="2"> <label for="cn-employed2">Yes </label></span>
                                </li>
                            </ul>
                            <div class="flex-div">
                                <p class="font_600">If yes, who is your currently employer/position? </p>
                                <p><span><input type="text" name="emppos" value="{{ $data->emppos }}"></span>
                                </p>
                                <p class="font_600">If yes, are you happy with your current position?</p>
                                <p><span><input type="text" name="emphappy"
                                            value="{{ $data->emphappy }}"></span></p>
                            </div>
                            <p class="font_600">Please list any work-related stressors, if any </p>
                            <p><span>
                                    <textarea rows="5" name="workstress">{{ $data->workstress }}</textarea>
                                </span></p>
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
                                    <input id="religious1" type="radio"
                                        {{ $data->religious == 1 ? 'checked' : '' }} name="religious"
                                        value="1"> <label for="religious1">No</label>
                                </li>
                                <li class="flex-div">
                                    <span><input id="religious2" type="radio"
                                            {{ $data->religious == 2 ? 'checked' : '' }} name="religious"
                                            value="2"> <label for="religious2">Yes
                                        </label></span>
                                </li>
                            </ul>
                            <p class="font_600">If yes, what is your faith? </p>
                            <p><span><input type="text" name="faith" value="{{ $data->faith }}"></span>
                            </p>
                            <p class="font_600">If no, do you consider yourself to be spiritual? </p>
                            <select name="spiritual">
                                <option {{ $data->spiritual == 0 ? 'selected' : '' }} value="0">--</option>
                                <option {{ $data->spiritual == 1 ? 'selected' : '' }} value="1">No</option>
                                <option {{ $data->spiritual == 2 ? 'selected' : '' }} value="2">Yes</option>
                            </select>
                        </div>
                    </div>
                </section>
                <section class="section_7 mb_30">
                    <div class="inner-main-title">
                        <h2>FAMILY MENTAL HEALTH HISTORY</h2>
                    </div>
                    <h3>Has anyone in your family <span class="bracket">(either immediate family members or
                            relatives)</span> experienced difficulties with the following? <span
                            class="bracket">(circle
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
                                            <option {{ $data->difficulty == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->difficulty == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->difficulty == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </th>
                                    <th><strong>Family member</strong></th>
                                </tr>
                                <tr>
                                    <td>Depression</td>
                                    <td>
                                        <select name="depr">
                                            <option {{ $data->depr == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->depr == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->depr == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="depexp" value="{{ $data->depexp }}"></td>
                                </tr>
                                <tr>
                                    <td>Bipolar disorder</td>
                                    <td>
                                        <select name="bipdis">
                                            <option {{ $data->bipdis == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->bipdis == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->bipdis == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="bipdisexp" value="{{ $data->bipdisexp }}"></td>
                                </tr>
                                <tr>
                                    <td>Anxiety disorder</td>
                                    <td>
                                        <select name="anxdis">
                                            <option {{ $data->anxdis == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->anxdis == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->anxdis == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="anxdisexp" value="{{ $data->anxdisexp }}"></td>
                                </tr>
                                <tr>
                                    <td>Panic attacks</td>
                                    <td>
                                        <select name="panicatt">
                                            <option {{ $data->panicatt == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->panicatt == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->panicatt == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="panicattexp" value="{{ $data->panicattexp }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Schizophrenia</td>
                                    <td>
                                        <select name="sch">
                                            <option {{ $data->sch == 0 ? 'selected' : '' }} value="0">-</option>
                                            <option {{ $data->sch == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->sch == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="schexp" value="{{ $data->schexp }}"></td>
                                </tr>
                                <tr>
                                    <td>Alcohol/substance abuse</td>
                                    <td>
                                        <select name="abuse">
                                            <option {{ $data->abuse == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->abuse == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->abuse == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="abusexp" value="{{ $data->abusexp }}"></td>
                                </tr>
                                <tr>
                                    <td>Eating disorders</td>
                                    <td>
                                        <select name="eatdis">
                                            <option {{ $data->eatdis == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->eatdis == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->eatdis == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="eatdisexp" value="{{ $data->eatdisexp }}"></td>
                                </tr>
                                <tr>
                                    <td>Learning disabilities</td>
                                    <td>
                                        <select name="leardis">
                                            <option {{ $data->leardis == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->leardis == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->leardis == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="leardisexp" value="{{ $data->leardisexp }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Trauma history</td>
                                    <td>
                                        <select name="trauma">
                                            <option {{ $data->trauma == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->trauma == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->trauma == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="traumaexp" value="{{ $data->traumaexp }}"></td>
                                </tr>
                                <tr>
                                    <td>Suicide attempts</td>
                                    <td>
                                        <select name="suiatt">
                                            <option {{ $data->suiatt == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->suiatt == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->suiatt == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="suiattexp" value="{{ $data->suiattexp }}"></td>
                                </tr>
                                <tr>
                                    <td>Chronic illness</td>
                                    <td>
                                        <select name="chrill">
                                            <option {{ $data->chrill == 0 ? 'selected' : '' }} value="0">-
                                            </option>
                                            <option {{ $data->chrill == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $data->chrill == 2 ? 'selected' : '' }} value="2">No
                                            </option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="chrillexp" value="{{ $data->chrillexp }}"></td>
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
                            <textarea name="strength">{{ $data->strength }}</textarea>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>What do you like most about yourself? </h3>
                        <div class="select-area">
                            <textarea name="aboutyou">{{ $data->aboutyou }}</textarea>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>What are effective coping strategies that you have learned? </h3>
                        <div class="select-area">
                            <textarea name="copstra">{{ $data->copstra }}</textarea>
                        </div>
                    </div>
                    <div class="box mb_30">
                        <h3>What are your goals for therapy? </h3>
                        <div class="select-area">
                            <textarea name="goalthe">{{ $data->goalthe }}</textarea>
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
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->diagassess == 1 ? 'checked' : '' }} name="diagassess"
                                                value="1"></span> Diagnostic Assessment</td>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->nurse == 1 ? 'checked' : '' }} name="nurse"
                                                value="1"></span> Nursing Assessment & Care
                                    </td>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->psytest == 1 ? 'checked' : '' }} name="psytest"
                                                value="1"></span> Psychological Testing</td>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->psytreat == 1 ? 'checked' : '' }} name="psytreat"
                                                value="1"></span> Psychiatric Treatment</td>
                                </tr>
                                <tr>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->medadmin == 1 ? 'checked' : '' }} name="medadmin"
                                                value="1"></span> Medication Administration
                                    </td>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->commsupport == 1 ? 'checked' : '' }} name="commsupport"
                                                value="1"></span> Community Support
                                        Individual
                                    </td>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->indout == 1 ? 'checked' : '' }} name="indout"
                                                value="1"></span> Individual Outpatient
                                        Services
                                    </td>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->outser == 1 ? 'checked' : '' }} name="outser"
                                                value="1"></span> Family Outpatient Services
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->groupout == 1 ? 'checked' : '' }} name="groupout"
                                                value="1"></span> Group Outpatient Services
                                    </td>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->intenfam == 1 ? 'checked' : '' }} name="intenfam"
                                                value="1"></span> Intensive Family
                                        Intervention
                                    </td>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->stab == 1 ? 'checked' : '' }} name="stab"
                                                value="1"></span> Crisis Stabilization</td>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->struct == 1 ? 'checked' : '' }} name="struct"
                                                value="1"></span> Structured Activity
                                        Supports
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->psyassess == 1 ? 'checked' : '' }} name="psyassess"
                                                value="1"></span>Psychical Assessment</td>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->behass == 1 ? 'checked' : '' }} name="behass"
                                                value="1"></span> Behavior Assistant</td>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->otherr == 1 ? 'checked' : '' }} name="otherr"
                                                value="1"></span> Other</td>
                                    <td><span class="chekmark"><input type="checkbox"
                                                {{ $data->otherr2 == 1 ? 'checked' : '' }} name="otherr2"
                                                value="1"></span> Other</td>
                                </tr>
                            </thead>
                        </table>
                        <ul class="list-inline mt-3">
                    <li class="list-inline-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="add_pro_sig"
                                name="add_pro_sig" {{$data->signature == null?'':'checked'}}>
                            <label class="form-check-label" for="add_pro_sig">
                                Add Provider Signature
                            </label>
                        </div>
                    </li>
                    <li class="list-inline-item float-right">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="add_care_sig"
                                name="add_care_sig" {{$data->updload_sign == null?'':'checked'}}>
                            <label class="form-check-label" for="add_care_sig">
                                Add Caregiver Signature
                            </label>
                        </div>
                    </li>
                </ul>
                    </div>
                </section>
                <section class="section_bottom">
                    <div class="button-row flex-div">
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
                                        <button type="button" class="btn btn-danger p-2"
                                            id="sig-clearBtn">Clear</button>
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
                                                <canvas id="sig-canvas2" height="120"
                                                    style="width: 100%;"></canvas>
                                            </div>
                                            <input type="hidden" class="form-control-file sing_draw2"
                                                name="sing_draw2">
                                        </div>
                                        <button type="button" class="btn btn-danger p-2"
                                            id="sig-clearBtn2">Clear</button>
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
                        <p><strong>{{ $name_location->facility_name }}</strong> {{ $name_location->address }}.
                            {{ $name_location->city }}
                            , {{ $name_location->state }} {{ $name_location->zip }}
                        </p>
                    </div>
                    <div class="col-item">
                        <p><a href="tel:{{ $name_location->phone_one }}">Phone:
                                {{ $name_location->phone_one }},</a> &nbsp;<a
                                href="mailto:{{ $name_location->email }}"> <span>Email:</span>
                                {{ $name_location->email }},</a>&nbsp;<a
                                href="{{ $name_location->email }}">{{ $name_location->email }}</a></p>
                    </div>
                </div>
            </div>
            <form class="pdf_form" action="{{ route('superadmin.print.form.9') }}" target="_blank" method="POST">
                @csrf
                <input type="hidden" name="session_id" class="session_id" value="{{ $session_id }}">
            </form>
        </div>
    </div>
    <!-- Jq Files -->
    <script src="{{ asset('assets/dashboard//') }}/js/jquery.min.js"></script>
    <script src="{{ asset('assets/dashboard//') }}/js/popper.min.js"></script>
    <script src="{{ asset('assets/dashboard//') }}/js/bootstrap.min.js"></script>

    <script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
    <script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.pdf_btn', function() {
                $('.pdf_form').submit();
            })
            $(document).on('submit', '#form_9', function(e) {
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
                    url: "{{ route('superadmin.9.form.submit') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        console.log(data)
                        toastr["success"]("Form Successfully Created", 'SUCCESS!');
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })
        })
    </script>




    @include('superadmin.appoinment.include.forms_js_include')

</body>

</html>
