<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.I.R.P. Progress Note Form</title>
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/template/tem25/') }}/css/custom-25.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
        .logo_img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="treatment-plan birp-progress">
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
            <form action="" method="POST" id="form_25">
                @csrf
                <div class="page-title mb_40">
                    <h1>B.I.R.P. Progress Note Form</h1>
                </div>
                <div class="content">
                    <section class="section_1">
                        <div class="flex-div">
                            <!------left column start------------>
                            <div class="left">
                                <div class="col-item1 col-item mb_30">
                                    <h3>Person(s) Involved <span class="bracket">(at least one must be
                                            selected):</span> </h3>
                                    <div class="checkbox-area flex-div">
                                        <ul>
                                            <li class="group group_1">
                                                <input type="checkbox" value="1" id="Consumer"
                                                    name="consumer"><label for="Consumer">Consumer</label>
                                                <input type="hidden" name="sessionid" value="{{ $session_id }}">

                                            </li>
                                            <li class="group group_2">
                                                <input type="checkbox" value="1" id="Other"
                                                    name="pother"><label for="Other">Other</label>
                                            </li>
                                            <li class="group group_3">
                                                <input type="checkbox" value="1" id="fosterp"
                                                    name="pparent"><label for="fosterp">Foster
                                                    Parents</label>
                                            </li>
                                        </ul>
                                        <ul>
                                            <li class="group group_4">
                                                <input type="checkbox" value="1" id="parent"
                                                    name="parent"><label for="parent">Parent/Guardian</label>
                                            </li>
                                            <li class="group group_5">
                                                <input type="checkbox" value="1" id="staff"
                                                    name="pgaurdian"><label for="staff">Group Home
                                                    Staff</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-item1 col-item mb_30">
                                    <h3>Consumer's Overall Affect: </h3>
                                    <div class="checkbox-area flex-div">
                                        <ul>
                                            <li class="group group_1">
                                                <input type="radio" value="1" id="agitated"
                                                    name="affect"><label for="agitated">Agitated</label>
                                            </li>
                                            <li class="group group_2">
                                                <input type="radio" value="2" id="calm"
                                                    name="affect"><label for="calm">Calm</label>
                                            </li>
                                            <li class="group group_3">
                                                <input type="radio" value="3" id="flat"
                                                    name="affect"><label for="flat">Flat</label>
                                            </li>
                                        </ul>
                                        <ul>
                                            <li class="group group_4">
                                                <input type="radio" value="4" id="n-a"
                                                    name="affect"><label for="n-a">N/A</label>
                                            </li>
                                            <li class="group group_5">
                                                <input type="radio" value="5" id="sad"
                                                    name="affect"><label for="sad">Sad</label>
                                            </li>
                                            <li class="group group_1">
                                                <input type="radio" value="6" id="angry"
                                                    name="affect"><label for="angry">Angry</label>
                                            </li>
                                        </ul>
                                        <ul>
                                            <li class="group group_2">
                                                <input type="radio" value="7" id="defiant"
                                                    name="affect"><label for="defiant">Defiant</label>
                                            </li>
                                            <li class="group group_3">
                                                <input type="radio" value="8" id="happy"
                                                    name="affect"><label for="happy">Happy</label>
                                            </li>
                                            <li class="group group_4">
                                                <input type="radio" value="9" id="other"
                                                    name="affect"><label for="other">Other</label>
                                            </li>
                                        </ul>
                                        <ul>
                                            <li class="group group_5">
                                                <input type="radio" value="10" id="suicidal"
                                                    name="affect"><label for="suicidal">Suicidal</label>
                                            </li>
                                            <li class="group group_1">
                                                <input type="radio" value="11" id="anxious"
                                                    name="affect"><label for="anxious">Anxious</label>
                                            </li>
                                            <li class="group group_2">
                                                <input type="radio" value="12" id="energetic"
                                                    name="affect"><label for="energetic">Energetic</label>
                                            </li>
                                        </ul>
                                        <ul>
                                            <li class="group group_3">
                                                <input type="radio" value="13" id="moody"
                                                    name="affect"><label for="moody">Moody</label>
                                            </li>
                                            <li class="group group_4">
                                                <input type="radio" value="14" id="playful"
                                                    name="affect"><label for="playful">Playful</label>
                                            </li>
                                            <li class="group group_5">
                                                <input type="radio" value="15" id="tired"
                                                    name="affect"><label for="tired">Tired</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-item1 col-item mb_30">
                                    <h3>Progress: Consumer met his/her goal this session:</h3>
                                    <div class="inner">
                                        <select name="proselect">
                                            <option selected="selected" value="-">-</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-item1 col-item mb_30">
                                    <h3>Add New Goals for:</h3>
                                    <div class="inner">
                                        <select name="newselect">
                                            <option value="Whitis">Whitis</option>
                                            <option value="Serenity">Serenity</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!------right column start------------>
                            <div class="right">
                                <div class="col-item1 col-item mb_30">
                                    <h3>Contact Type:</h3>
                                    <div class="checkbox-area flex-div">
                                        <ul>
                                            <li class="group group_1">
                                                <input type="radio" value="1" id="f2f"
                                                    name="contacttype"><label for="f2f">Face
                                                    to
                                                    Face</label>
                                            </li>
                                            <li class="group group_2">
                                                <input type="radio" value="2" id="phone"
                                                    name="contacttype"><label for="phone">Phone</label>
                                            </li>
                                            <li class="group group_3">
                                                <input type="radio" value="3" id="attempts"
                                                    name="contacttype"><label for="attempts">Attempts</label>
                                            </li>
                                        </ul>
                                        <ul>
                                            <li class="group group_4">
                                                <input type="radio" value="4" id="telehealth"
                                                    name="contacttype"> <label for="telehealth">Telehealth</label>
                                            </li>
                                            <li class="group group_5">
                                                <input type="radio" value="5" id="na"
                                                    name="contacttype"><label for="na">N/A</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-item1 col-item mb_30">
                                    <h3>Relevant changes in medical condition and/or medications (health and safety
                                        stressor)
                                        since last visit?</h3>
                                    <div class="checkbox-area">
                                        <ul>
                                            <li class="group group_1"><input type="radio" value="1"
                                                    id="yes" name="stressor"><label for="yes">yes</label>
                                            </li>
                                            <li class="group group_2">
                                                <input type="radio" value="2" id="none-reported"
                                                    name="stressor"><label for="none-reported">None Reported</label>
                                            </li>
                                        </ul>
                                        <div class="inner"><label>if yes, please explain:</label><br>
                                            <textarea rows="1" name="stressexp"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-item1 col-item mb_30">
                                    <h3>Comments:</h3>
                                    <div class="inner">
                                        <textarea rows="1" name="stresscomm"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_2">
                        <input type="checkbox" value="1" name="imi"> <label><strong>Include Mileage
                                Information?</strong></label>
                        <br>
                        <br>
                        <h3 style="color:#207ac7;">Service Plan Objectives/Interventions</h3>
                        <div class="desc-text">
                            <p><span class="warning"><img src="warning-icon.png" alt="" /></span> <strong>At
                                    least one
                                    GOAL,
                                    OBJECTIVE, and INTERVENTION must be selected.</strong>
                            </p>
                        </div>
                        <div class="service-plan">
                            <div class="col-item">
                                <p><strong>Goal:</strong></p>
                                <div class="inner">
                                    <select name="goalselect">
                                        <option value="Goal 1">Goal 1</option>
                                        <option value="Goal 2">Goal 2</option>
                                        <option value="Goal 3">Goal 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-item">
                                <p><strong>Objective:</strong></p>
                                <div class="inner">
                                    <select name="objselect">
                                        <option value="Objective 1">Objective1</option>
                                        <option value="Objective 2">Objective2</option>
                                        <option value="Objective 3">Objective3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-item">
                                <p><strong>Intervention:</strong></p>
                                <div class="inner">
                                    <select name="intselect">
                                        <option value="Intervention 1">Intervention 1</option>
                                        <option value="Intervention 2">Intervention 2</option>
                                        <option value="Intervention 3">Intervention 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_3 section-common mb_30">
                        <div class="flex-div">
                            <div class="col-item">
                                <h3>Non-Billable Note?</h3>
                                <div class="inner">
                                    <textarea rows="5" name="nonbill"></textarea>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_4 section-common">
                        <div class="flex-div">
                            <div class="col-item">
                                <h3>Behavior</h3>
                                <div class="tabs themebox">
                                    <input type="radio" value="1" name="tabs" id="tab1"
                                        checked="checked">
                                    <label for="tab1" class="nomarginleft icon_1">Encouraged</label>
                                    <div class="tab">
                                        <h2>Encouraged</h2>
                                        <textarea rows="18" name="enc1"></textarea>
                                    </div>
                                    <input type="radio" value="2" name="tabs" id="tab2">
                                    <label for="tab2" class="icon_2">Formulated</label>
                                    <div class="tab">
                                        <h2>Formulated</h2>
                                        <textarea rows="18" name="formul1"></textarea>
                                    </div>
                                    <input type="radio" value="3" name="tabs" id="tab3">
                                    <label for="tab3" class="icon_3">Assisted</label>
                                    <div class="tab">
                                        <h2>Assisted</h2>
                                        <textarea rows="18" name="ass1"></textarea>
                                    </div>
                                    <input type="radio" value="4" name="tabs" id="tab4">
                                    <label for="tab4" class="icon_4">Reminded</label>
                                    <div class="tab">
                                        <h2>Reminded</h2>
                                        <textarea rows="18" name="reminded1"></textarea>
                                    </div>
                                    <input type="radio" value="5" name="tabs" id="tab5">
                                    <label for="tab5" class="icon_5">Urged</label>
                                    <div class="tab">
                                        <h2>Urged</h2>
                                        <textarea rows="18" name="urged1"></textarea>
                                    </div>
                                    <input type="radio" value="6" name="tabs" id="tab6">
                                    <label for="tab6" class="icon_6">Referred</label>
                                    <div class="tab">
                                        <h2>Referred</h2>
                                        <textarea rows="18" name="refer1"></textarea>
                                    </div>
                                    <input type="radio" value="7" name="tabs" id="tab7">
                                    <label for="tab7" class="icon_7">Engaged</label>
                                    <div class="tab">
                                        <h2>Engaged</h2>
                                        <textarea rows="18" name="engage1"></textarea>
                                    </div>
                                    <input type="radio" value="8" name="tabs" id="tab8">
                                    <label for="tab8" class="icon_8">Confirmed</label>
                                    <div class="tab">
                                        <h2>Confirmed</h2>
                                        <textarea rows="18" name="confirm1"></textarea>
                                    </div>
                                    <input type="radio" value="9" name="tabs" id="tab9">
                                    <label for="tab9" class="icon_9">Responded</label>
                                    <div class="tab">
                                        <h2>Responded</h2>
                                        <textarea rows="18" name="resp1"></textarea>
                                    </div>
                                    <input type="radio" value="10" name="tabs" id="tab10">
                                    <label for="tab10" class="icon_10">Directed</label>
                                    <div class="tab">
                                        <h2>Directed</h2>
                                        <textarea rows="18" name="direct1"></textarea>
                                    </div>
                                    <input type="radio" value="11" name="tabs" id="tab11">
                                    <label for="tab11" class="icon_11">Arranged</label>
                                    <div class="tab">
                                        <h2>Arranged</h2>
                                        <textarea rows="18" name="arr1"></textarea>
                                    </div>
                                    <input type="radio" value="12" name="tabs" id="tab12">
                                    <label for="tab12" class="icon_12">Assured</label>
                                    <div class="tab">
                                        <h2>Assured</h2>
                                        <textarea rows="18" name="assur1"></textarea>
                                    </div>
                                    <input type="radio" value="13" name="tabs" id="tab13">
                                    <label for="tab13" class="icon_13">Rescheduled</label>
                                    <div class="tab">
                                        <h2>Rescheduled</h2>
                                        <textarea rows="18" name="resch1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_5 section-common">
                        <div class="flex-div">
                            <div class="col-item">
                                <h3>Intervention</h3>
                                <div class="tabs themebox">
                                    <input type="radio" value="1" name="sftabs" id="sftab1"
                                        checked="checked">
                                    <label for="sftab1" class="nomarginleft icon_1">Encouraged</label>
                                    <div class="tab">
                                        <h2>Encouraged</h2>
                                        <textarea rows="18" name="enc2"></textarea>
                                    </div>
                                    <input type="radio" value="2" name="sftabs" id="sftab2">
                                    <label for="sftab2" class="icon_2">Formulated</label>
                                    <div class="tab">
                                        <h2>Formulated</h2>
                                        <textarea rows="18" name="fomul2"></textarea>
                                    </div>
                                    <input type="radio" value="3" name="sftabs" id="sftab3">
                                    <label for="sftab3" class="icon_3">Assisted</label>
                                    <div class="tab">
                                        <h2>Assisted</h2>
                                        <textarea rows="18" name="ass2"></textarea>
                                    </div>
                                    <input type="radio" value="4" name="sftabs" id="sftab4">
                                    <label for="sftab4" class="icon_4">Reminded</label>
                                    <div class="tab">
                                        <h2>Reminded</h2>
                                        <textarea rows="18" name="reminded2"></textarea>
                                    </div>
                                    <input type="radio" value="5" name="sftabs" id="sftab5">
                                    <label for="sftab5" class="icon_5">Urged</label>
                                    <div class="tab">
                                        <h2>Urged</h2>
                                        <textarea rows="18" name="urged2"></textarea>
                                    </div>
                                    <input type="radio" value="6" name="sftabs" id="sftab6">
                                    <label for="sftab6" class="icon_6">Referred</label>
                                    <div class="tab">
                                        <h2>Referred</h2>
                                        <textarea rows="18" name="refer2"></textarea>
                                    </div>
                                    <input type="radio" value="7" name="sftabs" id="sftab7">
                                    <label for="sftab7" class="icon_7">Engaged</label>
                                    <div class="tab">
                                        <h2>Engaged</h2>
                                        <textarea rows="18" name="engage2"></textarea>
                                    </div>
                                    <input type="radio" value="8" name="sftabs" id="sftab8">
                                    <label for="sftab8" class="icon_8">Confirmed</label>
                                    <div class="tab">
                                        <h2>Confirmed</h2>
                                        <textarea rows="18" name="confirm2"></textarea>
                                    </div>
                                    <input type="radio" value="9" name="sftabs" id="sftab9">
                                    <label for="sftab9" class="icon_9">Responded</label>
                                    <div class="tab">
                                        <h2>Responded</h2>
                                        <textarea rows="18" name="resp2"></textarea>
                                    </div>
                                    <input type="radio" value="10" name="sftabs" id="sftab10">
                                    <label for="sftab10" class="icon_10">Directed</label>
                                    <div class="tab">
                                        <h2>Directed</h2>
                                        <textarea rows="18" name="direct2"></textarea>
                                    </div>
                                    <input type="radio" value="11" name="sftabs" id="sftab11">
                                    <label for="sftab11" class="icon_11">Arranged</label>
                                    <div class="tab">
                                        <h2>Arranged</h2>
                                        <textarea rows="18" name="arr2"></textarea>
                                    </div>
                                    <input type="radio" value="12" name="sftabs" id="sftab12">
                                    <label for="sftab12" class="icon_12">Assured</label>
                                    <div class="tab">
                                        <h2>Assured</h2>
                                        <textarea rows="18" name="assur2"></textarea>
                                    </div>
                                    <input type="radio" value="13" name="sftabs" id="sftab13">
                                    <label for="sftab13" class="icon_13">Rescheduled</label>
                                    <div class="tab">
                                        <h2>Rescheduled</h2>
                                        <textarea rows="18" name="resch2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_6 section-common">
                        <div class="flex-div">
                            <div class="col-item">
                                <h3>Response</h3>
                                <div class="tabs themebox">
                                    <input type="radio" value="1" name="sxtabs" id="sxtab1"
                                        checked="checked">
                                    <label for="sxtab1" class="nomarginleft icon_1">Encouraged</label>
                                    <div class="tab">
                                        <h2>Encouraged</h2>
                                        <textarea rows="18" name="enc3"></textarea>
                                    </div>
                                    <input type="radio" value="2" name="sxtabs" id="sxtab2">
                                    <label for="sxtab2" class="icon_2">Formulated</label>
                                    <div class="tab">
                                        <h2>Formulated</h2>
                                        <textarea rows="18" name="formul3"></textarea>
                                    </div>
                                    <input type="radio" value="3" name="sxtabs" id="sxtab3">
                                    <label for="sxtab3" class="icon_3">Assisted</label>
                                    <div class="tab">
                                        <h2>Assisted</h2>
                                        <textarea rows="18" name="ass3"></textarea>
                                    </div>
                                    <input type="radio" value="4" name="sxtabs" id="sxtab4">
                                    <label for="sxtab4" class="icon_4">Reminded</label>
                                    <div class="tab">
                                        <h2>Reminded</h2>
                                        <textarea rows="18" name="reminded3"></textarea>
                                    </div>
                                    <input type="radio" value="5" name="sxtabs" id="sxtab5">
                                    <label for="sxtab5" class="icon_5">Urged</label>
                                    <div class="tab">
                                        <h2>Urged</h2>
                                        <textarea rows="18" name="urged3"></textarea>
                                    </div>
                                    <input type="radio" value="6" name="sxtabs" id="sxtab6">
                                    <label for="sxtab6" class="icon_6">Referred</label>
                                    <div class="tab">
                                        <h2>Referred</h2>
                                        <textarea rows="18" name="refer3"></textarea>
                                    </div>
                                    <input type="radio" value="7" name="sxtabs" id="sxtab7">
                                    <label for="sxtab7" class="icon_7">Engaged</label>
                                    <div class="tab">
                                        <h2>Engaged</h2>
                                        <textarea rows="18" name="engage3"></textarea>
                                    </div>
                                    <input type="radio" value="8" name="sxtabs" id="sxtab8">
                                    <label for="sxtab8" class="icon_8">Confirmed</label>
                                    <div class="tab">
                                        <h2>Confirmed</h2>
                                        <textarea rows="18" name="confirm3"></textarea>
                                    </div>
                                    <input type="radio" value="9" name="sxtabs" id="sxtab9">
                                    <label for="sxtab9" class="icon_9">Responded</label>
                                    <div class="tab">
                                        <h2>Responded</h2>
                                        <textarea rows="18" name="resp3"></textarea>
                                    </div>
                                    <input type="radio" value="10" name="sxtabs" id="sxtab10">
                                    <label for="sxtab10" class="icon_10">Directed</label>
                                    <div class="tab">
                                        <h2>Directed</h2>
                                        <textarea rows="18" name="direct3"></textarea>
                                    </div>
                                    <input type="radio" value="11" name="sxtabs" id="sxtab11">
                                    <label for="sxtab11" class="icon_11">Arranged</label>
                                    <div class="tab">
                                        <h2>Arranged</h2>
                                        <textarea rows="18" name="arr3"></textarea>
                                    </div>
                                    <input type="radio" value="12" name="sxtabs" id="sxtab12">
                                    <label for="sxtab12" class="icon_12">Assured</label>
                                    <div class="tab">
                                        <h2>Assured</h2>
                                        <textarea rows="18" name="assur3"></textarea>
                                    </div>
                                    <input type="radio" value="13" name="sxtabs" id="sxtab13">
                                    <label for="sxtab13" class="icon_13">Rescheduled</label>
                                    <div class="tab">
                                        <h2>Rescheduled</h2>
                                        <textarea rows="18" name="resch3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_7 section-common">
                        <div class="flex-div">
                            <div class="col-item">
                                <h3>Plan</h3>
                                <div class="tabs themebox">
                                    <input type="radio" value="1" name="sntabs" id="sntab1"
                                        checked="checked">
                                    <label for="sntab1" class="nomarginleft icon_1">Encouraged</label>
                                    <div class="tab">
                                        <h2>Encouraged</h2>
                                        <textarea rows="18" name="enc4"></textarea>
                                    </div>
                                    <input type="radio" value="2" name="sntabs" id="sntab2">
                                    <label for="sntab2" class="icon_2">Formulated</label>
                                    <div class="tab">
                                        <h2>Formulated</h2>
                                        <textarea rows="18" name="formul4"></textarea>
                                    </div>
                                    <input type="radio" value="3" name="sntabs" id="sntab3">
                                    <label for="sntab3" class="icon_3">Assisted</label>
                                    <div class="tab">
                                        <h2>Assisted</h2>
                                        <textarea rows="18" name="ass4"></textarea>
                                    </div>
                                    <input type="radio" value="4" name="sntabs" id="sntab4">
                                    <label for="sntab4" class="icon_4">Reminded</label>
                                    <div class="tab">
                                        <h2>Reminded</h2>
                                        <textarea rows="18" name="reminded4"></textarea>
                                    </div>
                                    <input type="radio" value="5" name="sntabs" id="sntab5">
                                    <label for="sntab5" class="icon_5">Urged</label>
                                    <div class="tab">
                                        <h2>Urged</h2>
                                        <textarea rows="18" name="urged4"></textarea>
                                    </div>
                                    <input type="radio" value="6" name="sntabs" id="sntab6">
                                    <label for="sntab6" class="icon_6">Referred</label>
                                    <div class="tab">
                                        <h2>Referred</h2>
                                        <textarea rows="18" name="refer4"></textarea>
                                    </div>
                                    <input type="radio" value="7" name="sntabs" id="sntab7">
                                    <label for="sntab7" class="icon_7">Engaged</label>
                                    <div class="tab">
                                        <h2>Engaged</h2>
                                        <textarea rows="18" name="engage4"></textarea>
                                    </div>
                                    <input type="radio" value="8" name="sntabs" id="sntab8">
                                    <label for="sntab8" class="icon_8">Confirmed</label>
                                    <div class="tab">
                                        <h2>Confirmed</h2>
                                        <textarea rows="18" name="confirm4"></textarea>
                                    </div>
                                    <input type="radio" value="9" name="sntabs" id="sntab9">
                                    <label for="sntab9" class="icon_9">Responded</label>
                                    <div class="tab">
                                        <h2>Responded</h2>
                                        <textarea rows="18" name="resp4"></textarea>
                                    </div>
                                    <input type="radio" value="10" name="sntabs" id="sntab10">
                                    <label for="sntab10" class="icon_10">Directed</label>
                                    <div class="tab">
                                        <h2>Directed</h2>
                                        <textarea rows="18" name="direct4"></textarea>
                                    </div>
                                    <input type="radio" value="11" name="sntabs" id="sntab11">
                                    <label for="sntab11" class="icon_11">Arranged</label>
                                    <div class="tab">
                                        <h2>Arranged</h2>
                                        <textarea rows="18" name="arr4"></textarea>
                                    </div>
                                    <input type="radio" value="12" name="sntabs" id="sntab12">
                                    <label for="sntab12" class="icon_12">Assured</label>
                                    <div class="tab">
                                        <h2>Assured</h2>
                                        <textarea rows="18" name="assu4"></textarea>
                                    </div>
                                    <input type="radio" value="13" name="sntabs" id="sntab13">
                                    <label for="sntab13" class="icon_13">Rescheduled</label>
                                    <div class="tab">
                                        <h2>Rescheduled</h2>
                                        <textarea rows="18" name="resch4"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_8 full-width section-common">
                        <div class="flex-div">
                            <div class="col-item">
                                <h3>Strengths (optional):</h3>
                                <div class="tabs themebox">
                                    <div class="tab">
                                        <textarea rows="5" name="strength"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_9 full-width section-common mb_30">
                        <div class="flex-div">
                            <div class="col-item">
                                <h3>Transitional Considerations: (optional)</h3>
                                <div class="tabs themebox">
                                    <div class="tab">
                                        <textarea rows="5" name="transitional"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_10">
                        <div class="flex-div full-width">
                            <div class="col-item1  col-item mb_30">
                                <h3>Additional Comments/Information: <br>
                                    <span class="bracket"> Use this section to put additional information that will be
                                        printed
                                        out on your notes (i.e.
                                        County, Case Worker, misc. comments)</span>
                                </h3>
                                <div class="tabs">
                                    <textarea rows="1" name="additional"></textarea>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_bottom">
                        <div class="flex-div">
                            <div class="col-item">
                                <h3>Change Client Status?</h3>
                                <div class="inner">
                                    <select name="statusselect">
                                        <option value="Active"> Active </option>
                                        <option value="Active">Active</option>
                                        <option value="Active">Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-item">
                                <div>
                                    <h3>Next Appointment <span class="bracket">(optional):</span></h3>
                                </div>
                                <div class="date"><input type="date" name="nextapp"></div>
                            </div>
                        </div>
                    </section>
                    <ul class="list-inline mt-3">
                        <li class="list-inline-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="add_pro_sig"
                                    name="add_pro_sig">
                                <label class="form-check-label" for="add_pro_sig">
                                    Add Provider Signature
                                </label>
                            </div>
                        </li>
                        <li class="list-inline-item float-right">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="add_care_sig"
                                    name="add_care_sig">
                                <label class="form-check-label" for="add_care_sig">
                                    Add Caregiver Signature
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
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
                        <p><a href="tel:{{ $name_location->phone_one }}">Phone: {{ $name_location->phone_one }},</a>
                            &nbsp;<a href="mailto:{{ $name_location->email }}"> <span>Email:</span>
                                {{ $name_location->email }},</a>&nbsp;<a
                                href="{{ $name_location->email }}">{{ $name_location->email }}</a></p>
                    </div>
                </div>
            </div>
            <form class="pdf_form" action="{{ route('superadmin.print.form.25') }}" target="_blank" method="POST">
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
            $('.pdf_btn').hide();

            $(document).on('click', '.pdf_btn', function() {
                $('.pdf_form').submit();
            })
            $(document).on('submit', '#form_25', function(e) {
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
                    url: "{{ route('superadmin.25.form.submit') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        console.log(data)
                        if (data == "done") {
                            $('.pdf_btn').show();
                        }
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
