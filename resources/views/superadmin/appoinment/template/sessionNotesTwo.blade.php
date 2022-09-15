<?php

if (\Auth::user()->is_up_admin == 1) {
    $admin_id = \Auth::user()->id;
} else {
    $admin_id = \Auth::user()->up_admin_id;
}

$facility = \App\Models\setting_name_location::select('facility_name')
    ->where('admin_id', $admin_id)
    ->first();

$app = \App\Models\Appoinment::select('id', 'schedule_date', 'from_time', 'to_time', 'client_id')
    ->where('id', $session_id)
    ->first();
if ($app) {
    $client = \App\Models\Client::select('client_full_name', 'client_dob', 'client_city', 'client_state', 'client_street', 'client_zip')
        ->where('id', $app->client_id)
        ->first();
    $client_name = $client->client_full_name;
    $client_dob = $client->client_dob;
    $client_address = $client->client_street . ' , ' . $client->client_city . ' , ' . $client->client_state . ' ' . $client->client_zip;
} else {
    $client = '';
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervision and Assessment</title>
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/template/') }}/tem61/custom.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/template/') }}/tem61/custom-6.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
        .logo_img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="session-note">
        <header>
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
        </header>
        <div class="content">
            <form action="" method="POST" id="form_61">
                @csrf
                <input type="hidden" name="sessionid" value="{{ $session_id }}">

                <div class="page-title mb_40">
                    <h1>Session Notes<br>
                    </h1>
                </div>
                <section>
                    <div class="flex-row flex-row_1">
                        <div class="col-item mb_30">
                            <div class="flex-div"> <span>
                                    <label for="clname">Client Full Name:</label>
                                </span> <span>
                                    <input id="clname" type="text" name="clname" value="{{ $client_name }}">
                                </span> </div>
                        </div>

                        <div class="col-item mb_30">
                            <div class="flex-div"> <span>
                                    <label for="birth-date">Client Birth Date:</label>
                                </span> <span>
                                    <input id="birth-date" type="date" name="birth_date"
                                        value="{{ $client_dob }}">
                                </span> </div>
                        </div>

                        <div class="col-item mb_30">
                            <div class="flex-div"> <span>
                                    <label for="cl-designation">Client Diagnosis:</label>
                                </span> <span>
                                    <input id="cl-designation" type="text" name="client_diag">
                                </span> </div>
                        </div>
                    </div>

                    <div class="flex-row flex-row_2">
                        <div class="col-item mb_30">
                            <div class="flex-div"> <span>
                                    <label for="payor-fname">Payor (Subscriber) Full Name:</label>
                                </span> <span>
                                    <input id="payor-fname" type="text" name="payor_full_name">
                                </span> </div>
                        </div>
                        <div class="col-item mb_30">
                            <div class="flex-div"> <span>
                                    <label for="home-address">Client Full Home Address:</label>
                                </span>
                                <span>
                                    <textarea id="home-address" rows="1" cols="30" placeholder="Please Fill Home Address" name="home_address">{{ $client_address }}</textarea>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="flex-row flex-row_3">
                        <div class="col-item mb_30">
                            <div class="flex-div"> <span>
                                    <label for="session-date">Session Date:</label>
                                </span> <span>
                                    <input id="session-date" type="date" name="session_date"
                                        value="{{ \Carbon\Carbon::parse($app->schedule_date)->format('Y-m-d') }}">
                                </span> </div>
                        </div>
                        <div class="col-item mb_30">
                            <div class="flex-div"> <span>
                                    <label for="service-location">Service location Type:</label>
                                </span>
                                <span>
                                    <input id="service-location" type="text" name="service_location">
                                </span>
                            </div>
                        </div>

                        <div class="col-item mb_30">
                            <div class="flex-div"> <span>
                                    <label for="service-unit">Service Units this code:</label>
                                </span>
                                <span>
                                    <input id="service-unit" type="text" name="service_unit">
                                </span>
                            </div>
                        </div>


                    </div>



                    <div class="flex-row flex-row_4">
                        <div class="col-item mb_30">
                            <div class="flex-div"> <span>
                                    <label for="start-time">Service Start Time:</label>
                                </span> <span>
                                    <input id="start-time" type="time" name="start_time"
                                        value="{{ \Carbon\Carbon::parse($app->from_time)->format('H:i:s') }}">
                                </span> </div>
                        </div>
                        <div class="col-item mb_30">
                            <div class="flex-div"> <span>
                                    <label for="end-time">Session End Time:</label>
                                </span>
                                <span>
                                    <input id="end-time" type="time" name="end_time"
                                        value="{{ \Carbon\Carbon::parse($app->to_time)->format('H:i:s') }}">
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex-row flex-row_4 mb_30">
                        <label for="service-loc">Service location full address: **Must include number, street, city,
                            state, zip code**</label>
                        <textarea id="service-loc" style="margin-top: 10px;" rows="2" cols="100vw" name="service_loc"></textarea>
                    </div>

                    <div class="flex-row flex-row_5 mb_30">
                        <label for="attendees">All attendees in session: (First and last names of each)</label>
                        <textarea id="attendees" style="margin-top: 10px;" rows="2" cols="100vw" name="attendees"></textarea>
                    </div>


                    <div class="flex-row flex-row_6 mb_30">
                        <label for="entire_age">Parent/Guardian present during session: Someone over the age of 18 must
                            be present during entire session.</label>
                        <input id="entire_age" type="text" name="entire_age">
                    </div>



                    <div class="flex-row flex-row_7 mb_30">
                        <div class="flex-div">
                            <h3>Location of Parent meeting if RBT is working 1:1 with client during same timeframe:
                            </h3> <br>
                            <div class="check-box-area">
                                <ul>
                                    <li><span>
                                            <input id="timeframe-yes" type="radio" name="timeframe_rbt"
                                                value="1">
                                        </span><span>
                                            <label for="timeframe-yes">Room A</label>
                                        </span></li>
                                    <li><span>
                                            <input id="timeframe-no" type="radio" name="timeframe_rbt"
                                                value="2">
                                        </span> <span>
                                            <label for="timeframe-no">Room B</label>
                                        </span></li>
                                </ul>
                            </div>
                        </div>

                    </div>


                    <div class="flex-row flex-row_8 mb_30">
                        <label for="authorized-aba">Name of the authorized ABA supervisor: Full Name and credentials
                            (example Jane Doe, BCBA)</label>
                        <textarea id="authorized-aba" style="margin-top: 10px;" rows="2" cols="100vw" name="auth_aba"></textarea>
                    </div>

                    <div class="flex-row flex-row_9 mb_30">
                        <div class="box">
                            <h3 style="text-style:normal;"><span class="red">Code used for this session: </span>
                                **If you more than one code during session you must complete a note for each code.</h3>
                            <br>
                            <h3 class="red">If supervision is being conducted do not use this form. You must use
                                supervision form related to your credentialing.</h3>
                        </div>
                    </div>


                    <div class="flex-row flex-row_10 mb_30">
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <div class="flex-div">
                                            <span>

                                            </span>
                                            <span>
                                                <label for="analystcodes">Board Certified Behavior Analyst
                                                    Codes</label>
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="flex-div">
                                            <span>

                                            </span>
                                            <span>
                                                <label for="techniciancodes">Registered Behavior Technician
                                                    Codes</label>
                                            </span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="abadirect" type="checkbox" name="abadirect"
                                                    value="ABA Direct Therapy by BCBA 97153">
                                            </span>
                                            <span>
                                                <label for="abadirect">ABA Direct Therapy by BCBA 97153</label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="RBT97153" type="checkbox" name="RBT97153"
                                                    value="ABA Direct Therapy by RBT 97153">
                                            </span>
                                            <span>
                                                <label for="RBT97153">ABA Direct Therapy by RBT 97153</label>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="Modification-97155" type="checkbox"
                                                    name="modification_97155" value="Behavior Modification-97155">
                                            </span>
                                            <span>
                                                <label for="Modification-97155">Behavior Modification-97155</label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="H2019-Direct" type="checkbox" name="direct_h2"
                                                    value="H2019-Direct BlueCare clients Only">
                                            </span>
                                            <span>
                                                <label for="H2019-Direct">H2019-Direct BlueCare clients Only</label>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="flex-row flex-row_11 mb_30">

                        <h3>Stressor(s)/Extraordinary Events/ Significant Changes since last session with provider
                            filling out this note: </h3><span class="red"><strong>Circle responses to all the
                                following:</strong> </span> <br>
                        <div class="flex-div-area">
                            <div class="flex-div">
                                <label>1) Medication:</label>
                                <div class="check-box-area">
                                    <ul>
                                        <li><span>
                                                <input id="medication_yes" type="radio" name="medication"
                                                    value="1">
                                            </span><span>
                                                <label for="medication_yes">Yes</label>
                                            </span></li>
                                        <li><span>
                                                <input id="medication_no" type="radio" name="medication"
                                                    value="2">
                                            </span> <span>
                                                <label for="medication_no">No</label>
                                            </span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="flex-div">
                                <label>2) Living situation:</label>
                                <div class="check-box-area">
                                    <ul>
                                        <li><span>
                                                <input id="living_situation_yes" type="radio"
                                                    name="living_situation" value="1">
                                            </span><span>
                                                <label for="living_situation_yes">Yes</label>
                                            </span></li>
                                        <li><span>
                                                <input id="living_situation_no" type="radio"
                                                    name="living_situation" value="2">
                                            </span> <span>
                                                <label for="living_situation_no">No</label>
                                            </span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="flex-div">
                                <label>3) Insurance:</label>
                                <div class="check-box-area">
                                    <ul>
                                        <li><span>
                                                <input id="Insurance_yes" type="radio" name="insurance"
                                                    value="1">
                                            </span><span>
                                                <label for="Insurance_yes">Yes</label>
                                            </span></li>
                                        <li><span>
                                                <input id="Insurance_no" type="radio" name="insurance"
                                                    value="2">
                                            </span> <span>
                                                <label for="Insurance_no">No</label>
                                            </span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="flex-div">
                                <label>4) Illness:</label>
                                <div class="check-box-area">
                                    <ul>
                                        <li><span>
                                                <input id="Illness_yes" type="radio" name="illness"
                                                    value="1">
                                            </span><span>
                                                <label for="Illness_yes">Yes</label>
                                            </span></li>
                                        <li><span>
                                                <input id="Illness_no" type="radio" name="illness" value="2">
                                            </span> <span>
                                                <label for="Illness_no">No</label>
                                            </span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="flex-div last">
                                <label>5) Other notable changes?:</label>
                                <div class="check-box-area">
                                    <ul>
                                        <li><span>
                                                <input id="NONE" type="radio" name="other_notable_change"
                                                    value="1">
                                            </span><span>
                                                <label for="NONE">NONE</label>
                                            </span></li>
                                        <li><span>
                                                <input id="family-activities" type="radio"
                                                    name="other_notable_change" value="2">
                                            </span> <span>
                                                <label for="family-activities">or: Home family activities</label>
                                            </span></li>

                                        <li><span>
                                                <input id="Inappropriate" type="radio" name="other_notable_change"
                                                    value="3">
                                            </span> <span>
                                                <label for="Inappropriate">Inappropriate behaviors in school</label>
                                            </span></li>

                                        <li><span>
                                                <input id="Inappropriate-community" type="radio"
                                                    name="other_notable_change" value="4">
                                            </span> <span>
                                                <label for="Inappropriate-community">Inappropriate behaviors in
                                                    community</label>
                                            </span></li>


                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="flex-row flex-row_12 mb_30">
                        <div class="box">
                            <label style="text-style:normal;"> <span class="red">If yes to any changes above,
                                    please list in detail changes and impact on client. Medications changes noted by RBT
                                    must be communicated to BCBA on date of session.</span> <span
                                    style="color: #000;">(This section is required if YES.)</span></label> <br>
                            <textarea id="change_text" style="margin-top: 10px;" rows="2" cols="100vw" name="changes_text"></textarea>
                        </div>
                    </div>


                    <div class="flex-row flex-row_13 mb_30">
                        <div class="flex-div">
                            <label> Danger to: <span style="color:#000">(circle or highlight response)</span> </label>
                            <br>
                            <div class="check-box-area">
                                <ul>
                                    <li><span>
                                            <input id="danger-none" type="radio" name="danger" value="1">
                                        </span><span>
                                            <label for="danger-none">None</label>
                                        </span></li>
                                    <li><span>
                                            <input id="danger-self" type="radio" name="danger" value="2">
                                        </span> <span>
                                            <label for="danger-self">Self </label>
                                        </span></li>
                                    <li><span>
                                            <input id="danger-others" type="radio" name="danger" value="3">
                                        </span> <span>
                                            <label for="danger-others">Others </label>
                                        </span></li>
                                    <li><span>
                                            <input id="danger-property" type="radio" name="danger"
                                                value="4">
                                        </span> <span>
                                            <label for="danger-property">Property </label>
                                        </span></li>
                                </ul>
                            </div>
                        </div>

                    </div>





                    <div class="flex-row flex-row_14 mb_30">
                        <div class="flex-div">
                            <label>If selected any option besides none select appropriate response: Danger = Yes you
                                must select one of the following: </label> <br>
                            <div class="check-box-area">
                                <ul>
                                    <li><span>
                                            <input id="ideation-danger" type="radio" value="1"
                                                name="response_danger">
                                        </span><span>
                                            <label for="ideation-danger">Ideation</label>
                                        </span></li>
                                    <li><span>
                                            <input id="plan-danger" type="radio" value="2"
                                                name="response_danger">
                                        </span> <span>
                                            <label for="plan-danger">Plan </label>
                                        </span></li>
                                    <li><span>
                                            <input id="attempt-danger" type="radio" value="3"
                                                name="response_danger">
                                        </span> <span>
                                            <label for="attempt-danger">Attempt </label>
                                        </span></li>
                                    <li><span>
                                            <input id="intent-danger" type="radio" value="4"
                                                name="response_danger">
                                        </span> <span>
                                            <label for="intent-danger">Intent </label>
                                        </span></li>
                                    <li><span>
                                            <input id="other-danger" type="radio" value="5"
                                                name="response_danger">
                                        </span> <span>
                                            <label for="other-danger">Other </label>
                                        </span></li>
                                </ul>
                            </div>
                        </div>

                    </div>



                    <div class="flex-row flex-row_15 mb_30">
                        <div class="box">
                            <label style="text-style:normal; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                                <span class="red">***If YES selected you must notify your supervising BCBA
                                    immediately. The BCBA will contact the office if warranted. </span></label> <br>

                        </div>
                    </div>


                    <div class="flex-row flex-row_15 mb_30">
                        <div class="box">
                            <label style="text-style:normal;"> Disposition of client upon arrival: Must be more than
                                "same" and one-word answers:</label> <br>
                            <textarea id="client_dispo" style="margin-top: 10px;" rows="2" cols="100vw" name="client_dispo"></textarea>
                            <label>Activities/Goals/Objectives worked on during this session: (Must follow treatment
                                plan.)</label>
                        </div>
                    </div>



                    <div class="flex-row flex-row_16  mb_30">
                        <table>

                            <thead>
                                <tr>
                                    <th>
                                        <div class="flex-div">
                                            <span>
                                                <label for="Skill-1">Skill Acquisition</label>
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="flex-div">
                                            <span>
                                                <label for="Behavior">Behavior Contract </label>
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="flex-div">
                                            <span>
                                                <label for="Reinforcement">Differential Reinforcement </label>
                                            </span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="Social-Skill" type="checkbox"
                                                    value="Social Skill Acquisition" name="social_skill">
                                            </span>
                                            <span>
                                                <label for="Social-Skill">Social Skill Acquisition </label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="Timer" type="checkbox" value="Timer" name="timer">
                                            </span>
                                            <span>
                                                <label for="Timer">Timer</label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="FCT" type="checkbox" value="FCT" name="fct">
                                            </span>
                                            <span>
                                                <label for="FCT">FCT</label>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="roleplay" type="checkbox" value="Role Play"
                                                    name="roleplay">
                                            </span>
                                            <span>
                                                <label for="roleplay">Role Play</label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="tokenboard" type="checkbox" value="Token Board"
                                                    name="tokenboard">
                                            </span>
                                            <span>
                                                <label for="tokenboard">Token Board</label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="visualaid" type="checkbox" value="Visual Aid"
                                                    name="visualaid">
                                            </span>
                                            <span>
                                                <label for="visualaid">Visual Aid</label>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="Premack" type="checkbox" value="Premack Principle"
                                                    name="premack">
                                            </span>
                                            <span>
                                                <label for="Premack">Premack Principle</label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="selfmonitor" type="checkbox" value="Self Monitor"
                                                    name="selfmonitor">
                                            </span>
                                            <span>
                                                <label for="selfmonitor">Self Monitor</label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="Errorless" type="checkbox" value="Errorless Learning"
                                                    name="errorless">
                                            </span>
                                            <span>
                                                <label for="Errorless">Errorless Learning</label>
                                            </span>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="Stimulus" type="checkbox" value="Stimulus Prompts"
                                                    name="stimulus">
                                            </span>
                                            <span>
                                                <label for="Stimulus">Stimulus Prompts</label>
                                            </span>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="DTT" type="checkbox" value="DTT" name="dtt">
                                            </span>
                                            <span>
                                                <label for="DTT">DTT</label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="NET" type="checkbox" value="NET" name="net">
                                            </span>
                                            <span>
                                                <label for="NET">NET</label>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="videomodeling" type="checkbox" value="Video Modeling"
                                                    name="videomodeling">
                                            </span>
                                            <span>
                                                <label for="videomodeling">Video Modeling</label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="Antecedent" type="checkbox"
                                                    value="Antecedent Manipulation" name="antecedent">
                                            </span>
                                            <span>
                                                <label for="Antecedent">Antecedent Manipulation</label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="Chaining" type="checkbox" value="Chaining"
                                                    name="chaining">
                                            </span>
                                            <span>
                                                <label for="Chaining">Chaining</label>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="Shaping" type="checkbox" value="Shaping"
                                                    name="shaping">
                                            </span>
                                            <span>
                                                <label for="Shaping">Shaping</label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="selfmanagement" type="checkbox" value="Self Management"
                                                    name="selfmanagement">
                                            </span>
                                            <span>
                                                <label for="selfmanagement">Self Management</label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-div">
                                            <span>
                                                <input id="Other" type="checkbox" value="Other" name="other">
                                            </span>
                                            <span>
                                                <label for="Other">Other</label>
                                            </span>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>


                    <div class="flex-row flex-row_17 mb_30">
                        <h3>If other list below what procedures were used:</h3>
                        <label style="color:#333;" for="Goals/Targets"> <span class="red">1)</span> Goals/Targets-
                            Must include goal from treatment plan and must be identical to what is written in the
                            treatment plan. Trials Ran etc. Examples: matching and identifying</label>
                        <textarea id="Goals/Targets" style="margin-top: 10px;" rows="2" cols="100vw" name="goals"></textarea>
                    </div>

                    <div class="flex-row flex-row_18 mb_30">
                        <label style="color:#333;" for="Approach/ Measures"> <span class="red">2)</span> Treatment
                            Approach/ Measures: How did you work on goal(s) from #1? What tools/techniques/supplies did
                            you use? <span class="red"> This section must be more than a sentence or
                                two.</span></label>
                        <textarea id="Approach/ Measures" style="margin-top: 10px;" rows="2" cols="100vw" name="approach"></textarea>
                    </div>


                    <div class="flex-row flex-row_19 mb_30">
                        <div class="box">
                            <h3 style="text-style:normal;"> Next Scheduled Session:</h3>

                            <div class="flex-row">
                                <div class="col-item mb_30">
                                    <div class="flex-div"> <span>
                                            <label for="nextshd-date">Date:</label>
                                        </span> <span>
                                            <input id="nextshd-date" type="date" name="nextshd_date">
                                        </span> </div>
                                </div>

                                <div class="col-item mb_30">
                                    <div class="flex-div"> <span>
                                            <label for="nextshd-time">Time:</label>
                                        </span> <span>
                                            <input id="nextshd-time" type="time" name="nextshd_time">
                                        </span> </div>
                                </div>

                                <div class="col-item mb_30">
                                    <div class="flex-div"> <span>
                                            <label for="location-type">Location Type:</label>
                                        </span> <span>
                                            <input id="location-type" type="text" name="nextshd_loc">
                                        </span> </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="flex-row flex-row_20 mb-30">
                        <div class="col-item">
                            <h4 style="margin-bottom: 0px;" class="red">Provider Signature: Must be signed using
                                signing software or printed and signed-cannot be a typed signature: <span
                                    style="color:#000; font-size: 16px; font-weight: normal;">By signing you are
                                    agreeing that what you are submitting is and accurate.</span></h4>
                            <ul class="list-inline mt-3">
                                <li class="list-inline-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            id="add_pro_sig" name="add_pro_sig">
                                        <label class="form-check-label" for="add_pro_sig">
                                            Add Provider Signature
                                        </label>
                                    </div>
                                </li>
                                <li class="list-inline-item float-right">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            id="add_care_sig" name="add_care_sig">
                                        <label class="form-check-label" for="add_care_sig">
                                            Add Caregiver Signature
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <br>
                    <div class="flex-row flex-row_21 mb-30">
                        <h4 class="red"><span style="font-weight:600;">Form is only valid for processioning if all
                                areas are complete and correct.</span> <span
                                style="font-weight: normal; font-size: 16px;">If parts of this form are incomplete you
                                will be asked to send corrections before billing can be submitted. </span> <span
                                style="color:#000; font-size: 16px;">This is a medical record and is not to be shared
                                without permission from {{ $facility->facility_name }}</span></h4>
                    </div>













                </section>
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
            <form class="pdf_form" action="{{ route('superadmin.print.form.61') }}" target="_blank" method="POST">
                @csrf
                <input type="hidden" name="session_id" class="session_id" value="{{ $session_id }}">
            </form>
        </div>
    </div>
    <!-- Jq Files -->
    <script src="{{ asset('assets/dashboard//') }}/js/jquery.min.js"></script>
    <script src="{{ asset('assets/dashboard//') }}/js/popper.min.js"></script>
    <script src="{{ asset('assets/dashboard//') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/dashboard/template/') }}/js/jform.min.js"></script>
    <script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
    <script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>
    <script>
        $(document).ready(function() {
            $('.pdf_btn').hide();

            $(document).on('click', '.pdf_btn', function() {
                $('.pdf_form').submit();
            })
            $(document).on('submit', '#form_61', function(e) {
                e.preventDefault();

                if ($('select[name="comby"]').val() == 0) {
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

                data_obj = $('#form_61').jform();
                data_obj = JSON.parse(data_obj);
                delete data_obj["sing_draw"];
                delete data_obj["sing_draw2"];
                data_obj = JSON.stringify(data_obj);
                formData.append('data_obj', data_obj);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('superadmin.61.form.submit') }}",
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
