<?php
use App\Models\Appoinment;
use App\Models\Employee;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
if (Auth::user()->is_up_admin == 1) {
    $admin_id = Auth::user()->id;
} else {
    $admin_id = Auth::user()->up_admin_id;
}

$cl = Appoinment::where('admin_id', $admin_id)
    ->where('id', $session_id)
    ->first();
$provider = Employee::where('id', $cl->provider_id)->first();
$client = Client::where('id', $cl->client_id)->first();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/custom.css">
    <title>BEHAVIOR ASSESSMENT SERVICE PLAN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/template/tem16/') }}/css/custom-16.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
        .logo_img {
            width: 100px;
            height: 100px;
        }
    </style>
    <style>
        td input[type=text] {
            width: 90%;
            height: 90%;
        }
    </style>
</head>

<body>
    <div class="parent-training">
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
            <div class="page-title mb_40">
                <h2>FBA Template</h2>
                <h1>BEHAVIOR ASSESSMENT SERVICE PLAN</h1>
            </div>
            <form action="" method="post" id="form_16">
                @csrf
                <section class="section_1 mb_30">
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="rec_name">Recipient Name:</label>
                                        </span> <span>
                                            <input type="text" id="rec_name" name="rec_name"
                                                value="{{ $client->client_full_name }}">
                                            <input type="hidden" id="" name="sessionid"
                                                value="{{ $session_id }}">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="ide">ID:</label>
                                        </span> <span>
                                            <input type="text" id="ide" name="ide">
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
                                            <label for="dob">DOB:</label>
                                        </span> <span>
                                            <input type="date" id="dob" name="dob"
                                                value="{{ $client->client_dob }}">
                                        </span></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="attendens">Parent/Guardian Name:</label>
                                        </span> <span>
                                            <input type="text" name="gname">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="attendens">Guardian Contact No.</label>
                                        </span> <span>
                                            <input type="text" name="gcontact">
                                        </span></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="attendens">Address:</label>
                                        </span> <span>
                                            <input type="text" name="address">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="attendens">Report Completed on:</label>
                                        </span> <span>
                                            <input type="text" name="comdate">
                                        </span></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex-div"><span>
                                            <label for="attendens">Authored by:</label>
                                        </span> <span>
                                            <input type="text" name="auth">
                                        </span></div>
                                </td>
                                <td>
                                    <div>
                                        <label>Name:</label>
                                        <input type="text" name="authname">
                                    </div>
                                    <div>
                                        <label>BACB Certificate:</label>
                                        <input type="text" name="bacbcer">
                                    </div>
                                    <div>
                                        <label>NPI #:</label>
                                        <input type="text" name="npi">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Recipient Diagnosis:</label>
                                    <input type="text" name="recdia">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Referring Physician:</label>
                                    <input type="text" name="refer">
                                </td>
                                <td>
                                    <div>
                                        <label>Name:</label>
                                        <input type="text" name="phyname">
                                    </div>
                                    <div>
                                        <label>NPI:</label>
                                        <input type="text" name="phynpi">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Physician Contact Info:</label>
                                    <input type="text" name="phycontact">
                                </td>
                                <td>
                                    <label>Intervention Settings:</label>
                                    <input type="text" name="intset">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <ul class="list-inline mt-3">
                        <li class="list-inline-item">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="radio1"
                                        value="1">Initial Assessment
                                </label>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="radio1"
                                        value="2">Reassessment
                                </label>
                            </div>
                        </li>
                    </ul>
                </section>
                <section class="section_2 mb_30">
                    <div class="box box1 mb_30">
                        <div class="col-title mb_15">
                            <h3>
                                <label for="pto">BACKGROUND INFORMATION:</label>
                            </h3>
                        </div>
                        <div class="textarea">
                            <textarea id="pto" rows="5" name="bginfo"></textarea>
                        </div>
                    </div>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>DOCUMENTS REVIEWED</h3>
                    </div>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="flex-div"><span>
                                            <label>Medical Issues:</label>
                                        </span> <span>
                                            <input type="text" name="mdissue">
                                        </span></div>
                                </td>
                                <td>
                                    <div class="flex-div"><span>
                                            <label>Reason for Referral:</label>
                                        </span> <span>
                                            <input type="text" name="resref">
                                        </span></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3 class="text-center">ANECDOTAL REPORT</h3>
                    </div>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    Date/Setting
                                </td>
                                <td>Antecedent</td>
                                <td>Behavior</td>
                                <td>Consequence</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="date1"></td>
                                <td><input type="text" name="ant1"></td>
                                <td><input type="text" name="beh1"></td>
                                <td><input type="text" name="con1"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="date2"></td>
                                <td><input type="text" name="ant2"></td>
                                <td><input type="text" name="beh2"></td>
                                <td><input type="text" name="con2"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="date3"></td>
                                <td><input type="text" name="ant3"></td>
                                <td><input type="text" name="beh3"></td>
                                <td><input type="text" name="con3"></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3 class="text-center">STRENGTHS AND WEAKNESSES</h3>
                    </div>
                    <div class="col-title mb_15">
                        <h3>MEDICATION</h3>
                    </div>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    Medication Name
                                </td>
                                <td>Dosage</td>
                                <td>Purpose</td>
                                <td>Side Effects</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="medn1"></td>
                                <td><input type="text" name="dos1"></td>
                                <td><input type="text" name="pur1"></td>
                                <td><input type="text" name="side1"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="medn2"></td>
                                <td><input type="text" name="dos2"></td>
                                <td><input type="text" name="pur2"></td>
                                <td><input type="text" name="side2"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="medn3"></td>
                                <td><input type="text" name="dos3"></td>
                                <td><input type="text" name="pur3"></td>
                                <td><input type="text" name="side3"></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3 class="text-center">
                            BEHAVIOR PLAN COMPONENTS
                        </h3>
                    </div>
                    <div class="col-title mb_15">
                        <h3>Procedural Checklist</h3>
                    </div>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    Behavior Targeted for Reduction
                                </td>
                                <td>Function</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="beh">
                                </td>
                                <td>
                                    <div>
                                        <label>Function/s: </label>
                                        <input type="text" name="func">
                                    </div>
                                    <div>
                                        <label>Baseline:</label>
                                        <input type="text" name="bline">
                                    </div>
                                    <div>
                                        <label>Intensity:</label>
                                        <input type="text" name="inten">
                                    </div>
                                    <div>
                                        <label>Data Measured with </label>
                                        <input type="text" name="datam">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>ASSESSMENTS CONDUCTED/FUNCTION</h3>
                    </div>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Patterns Identified:</label>
                                    <input type="text" name="patid">
                                </td>
                                <td>
                                    <label>Assessment of Basic Language and Learning Skills-Revised:</label>
                                    <input type="text" name="blang">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>FAMILY/CAREGIVER INVOLVEMENT</h3>
                    </div>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Goal 1:</label>
                                    <input type="text" name="goal1">
                                </td>
                                <td>
                                    <label>Goal 2:</label>
                                    <input type="text" name="goal2">
                                </td>
                                <td>
                                    <label>Goal 3:</label>
                                    <input type="text" name="goal3">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="box box1 mb_30">
                        <div class="col-title mb_15">
                            <h3>
                                <label for="pto">GENERALIZATION TRAINING:</label>
                            </h3>
                        </div>
                        <div class="textarea">
                            <textarea id="pto" rows="5" name="gtrain"></textarea>
                        </div>
                    </div>
                </section>
                <section class="section_2 mb_30">
                    <div class="box box1 mb_30">
                        <div class="col-title mb_15">
                            <h3>
                                <label for="pto">TARGET PROBLEM BEHAVIOR GOALS:</label>
                            </h3>
                        </div>
                        <div class="textarea">
                            <textarea id="pto" rows="5" name="tgbgoal"></textarea>
                        </div>
                    </div>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>SKILLS ACQUISITION GOALS</h3>
                    </div>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Context/Antecedent(s):</label>
                                    <input type="text" name="contextant">
                                </td>
                                <td>
                                    <label>Behavior(s)</label>
                                    <input type="text" name="behv">
                                </td>
                                <td>
                                    <label>Function/Consequence(s):</label>
                                    <input type="text" name="funccon">
                                    <input type="text" name="consq">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Preventive Strategies
                                        (antecedent-based)
                                    </label>
                                    <input type="text" name="preventst">
                                </td>
                                <td>
                                    <label>Replacement Skills
                                        (related to function)
                                    </label>
                                    <input type="text" name="repskills">
                                </td>
                                <td>
                                    <label>Management Strategies
                                        (consequence-based)
                                    </label>
                                    <input type="text" name="managest">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>INSTRUCTIONAL GOALS</h3>
                    </div>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Long Term Objective Status:</label>
                                </td>
                                <td>
                                    <label>Long Term Objective</label>
                                </td>
                                <td colspan="5">
                                    <label>Intermediate Objective</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input name="ltstat" type="text">
                                </td>
                                <td>
                                    <input name="ltobj" type="text">
                                </td>
                                <td colspan="5">
                                    <input name="interobj" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Target Behavior</label>
                                </td>
                                <td>
                                    <label>Short Term Objective</label>
                                </td>
                                <td>
                                    <label>Measure</label>
                                </td>
                                <td><label>Status</label></td>
                                <td><label>Baseline Level</label></td>
                                <td><label>Current Level</label></td>
                                <td><label>Mastery Criteria</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="tarbeh"></td>
                                <td><input type="text" name="stobj"></td>
                                <td><input type="text" name="mes"></td>
                                <td><input type="text" name="sttatus"></td>
                                <td><input type="text" name="baselevel"></td>
                                <td><input type="text" name="clevel"></td>
                                <td><input type="text" name="mcriteria"></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>INTERVENTIONS</h3>
                    </div>
                    <div class="col-title mb_15">
                        <h3>PREFERENCE ASSESSMENT</h3>
                    </div>
                    <p>Preference Assessment completed using parent interview, direct observation conducted on
                        ____________</p>
                    <p>Observations and preference assessments indicate that client is highly motivated by the following
                        reinforcers.</p>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Activities</label>
                                </td>
                                <td><input type="text" name="act"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Food/Drink</label>
                                </td>
                                <td><input type="text" name="drink"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Games/Toys </label>
                                </td>
                                <td><input type="text" name="games"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Social </label>
                                </td>
                                <td><input type="text" name="social"></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>RISK ASSESSMENT</h3>
                    </div>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Risk: </label>
                                </td>
                                <td><label>Notes</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="risk"></td>
                                <td><input type="text" name="notes"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Benefit: </label>
                                </td>
                                <td><label>Notes</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="benefit"></td>
                                <td><input type="text" name="nott"></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            MAINTAINING AND TRANSFERRING PROGRESS TO ALL RELEVANT SETTINGS
                        </h3>
                    </div>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Generalization: </label>
                                </td>
                                <td><input type="text" name="genez"></td>
                            </tr>
                            <tr>
                                <td><label>Maintenance</label></td>
                                <td><input type="text" name="maint"></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            PLAN FOR FADING SERVICES
                        </h3>
                    </div>
                    <table cellspacing="0" cellpadding="0" style="width:100%">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Phase: </label>
                                </td>
                                <td><label>Action Steps</label></td>
                                <td><label>Criteria</label></td>
                                <td><label>Time Frame</label></td>
                                <td><label>Service Reduction Behavior Analyst</label></td>
                                <td><label>Service Reduction Behavior Assistant</label></td>
                                <td><label>Next Level of Care of Transition Notes</label></td>
                                <td><label>Description</label></td>
                            </tr>
                            <tr>
                                <td><label>Phase 1</label></td>
                                <td><input type="text" name="actstep1"></td>
                                <td><input type="text" name="crit1"></td>
                                <td><input type="text" name="tframe1"></td>
                                <td><input type="text" name="srba1"></td>
                                <td><input type="text" name="srbas1"></td>
                                <td><input type="text" name="nlct1"></td>
                                <td><input type="text" name="desc1"></td>
                            </tr>
                            <tr>
                                <td><label>Phase 2</label></td>
                                <td><input type="text" name="actstep2"></td>
                                <td><input type="text" name="crit2"></td>
                                <td><input type="text" name="tframe2"></td>
                                <td><input type="text" name="srba2"></td>
                                <td><input type="text" name="srbas2"></td>
                                <td><input type="text" name="nlct2"></td>
                                <td><input type="text" name="desc2"></td>
                            </tr>
                            <tr>
                                <td><label>Phase 3</label></td>
                                <td><input type="text" name="actstep3"></td>
                                <td><input type="text" name="crit3"></td>
                                <td><input type="text" name="tframe3"></td>
                                <td><input type="text" name="srba3"></td>
                                <td><input type="text" name="srbas3"></td>
                                <td><input type="text" name="nlct3"></td>
                                <td><input type="text" name="desc3"></td>
                            </tr>
                            <tr>
                                <td><label>Phase 4</label></td>
                                <td><input type="text" name="actstep4"></td>
                                <td><input type="text" name="crit4"></td>
                                <td><input type="text" name="tframe4"></td>
                                <td><input type="text" name="srba4"></td>
                                <td><input type="text" name="srbas4"></td>
                                <td><input type="text" name="nlct4"></td>
                                <td><input type="text" name="desc4"></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            CRISIS PLAN
                        </h3>
                    </div>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Emergency protocol: </label>
                                </td>
                                <td><input type="text" name="emgprot"></td>
                            </tr>
                            <tr>
                                <td><label>Communication with other providers</label></td>
                                <td><input type="text" name="compr"></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3>
                            Please check boxes as applicable:
                        </h3>
                    </div>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Have you communicated with the recipient's prescriber of psychotropic
                                        drugs?</label>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="psydrug"
                                                value="1">Yes
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="psydrug"
                                                value="2">No
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="psydrug"
                                                value="3">Recipient Declined N/A, provider is the
                                            prescriber
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="psydrug"
                                                value="4">N/A recipient is not on medications
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Have you communicated with the recipient's P.C.P.?</label></td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="pcp"
                                                value="1">Yes
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="pcp"
                                                value="2">No
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="pcp"
                                                value="3">Recipient Declined
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Have you documented the communication or recipient declination?</label></td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="decline"
                                                value="1">Yes
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="decline"
                                                value="2">No
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="decline"
                                                value="3">N/A, I did not contact P.C.P.
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Have you been in communication with other Behavior Health (B.H.) providers
                                        for this
                                        recipient?</label></td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="bh"
                                                value="1">Yes
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="bh"
                                                value="2">No
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="bh"
                                                value="3">N/A
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>If yes, please indicate the type of B.H. provider.</label></td>
                                <td><input type="text" name="bhtype"></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3 class="text-center">
                            SUMMARY AND RECOMMENDATIONS
                        </h3>
                    </div>
                    <div class="col-title mb_15">
                        <h3>
                            Rationale/Justification:
                        </h3>
                    </div>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <label>Services</label>
                                </td>
                                <td class="text-center">Hours per week/Month</td>
                            </tr>
                            <tr>
                                <td><label>Lead Analyst: (H2019)</label></td>
                                <td><input type="text" name="leadh"></td>
                            </tr>
                            <tr>
                                <td><label>RBT (H2014)</label></td>
                                <td><input type="text" name="rbth"></td>
                            </tr>
                            <tr>
                                <td><label>Total recommended hours</label></td>
                                <td><input type="text" name="trh"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellspacing="0" cellpadding="0" class="mt-3">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Service Provider</label>
                                </td>
                                <td><label>Monday</label></td>
                                <td><label>Tuesday</label></td>
                                <td><label>Wednesday</label></td>
                                <td><label>Thursday</label></td>
                                <td><label>Friday</label></td>
                            </tr>
                            <tr>
                                <td>BCBA</td>
                                <td><input type="text" name="bcbam"></td>
                                <td><input type="text" name="bcbatu"></td>
                                <td><input type="text" name="bcbawe"></td>
                                <td><input type="text" name="bcbath"></td>
                                <td><input type="text" name="bcbafri"></td>
                            </tr>
                            <tr>
                                <td>RBT</td>
                                <td><input type="text" name="rbtm"></td>
                                <td><input type="text" name="rbttu"></td>
                                <td><input type="text" name="rbtwe"></td>
                                <td><input type="text" name="rbtth"></td>
                                <td><input type="text" name="rbtfri"></td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Per Rule 59G-1.010, Florida Administrative Code (F.A.C.) </p>
                    <p>CLIENT demonstrates medical necessity for services per the Functional Behavior Assessment and as
                        described
                        below, demonstrates deficits in verbal behavior, self-care, living skills, safety skills,
                        adaptive living
                        skills, and problem behaviors that are functioning as a barrier to further development and
                        places the CLIENT
                        at risk of significant disability and jeopardizes safety. The behavior analysis services
                        described in the
                        plan are necessary to protect life and prevent significant disability; they are also
                        individualized,
                        specific, and consistent with the confirmed diagnosis under treatment, and not more than the
                        patient's
                        needs. They are consistent with generally accepted professional medical standards as determined
                        by the
                        Medicaid program and not are not experimental or investigational. The services are reflective of
                        the level
                        of service that can be safely furnished, and for which there are currently not equally effective
                        and more
                        conservative or less costly treatment is available statewide and are furnished in a manner not
                        primarily
                        intended for the convenience of the recipient, the recipient's caretaker, or the provider</p>
                </section>
                <section class="section_2 mb_30">
                    <div class="col-title mb_15">
                        <h3 class="text-center">
                            CONSENT TO TREATMENT
                        </h3>
                    </div>
                    <p>I hereby provide my consent to implement the behavior support plan for CLIENT developed by Falls
                        Family
                        Center, LLLC on ____________________. I understand that the interventions in this plan have been
                        designed to
                        result in the reduction of PROBLEM BEHAVIORS and enhance CLIENT's skills in communication,
                        socialization,
                        independence, and self-advocacy, as well as improve his/her overall quality of life. I agree
                        that
                        implementation of CLIENT's behavior support plan will occur in the school /home and involve the
                        participation of the following individuals: CAREGIVER NAME (CAREGIVER RELATIONSHIP TO CLIENT).
                        Commitment of
                        these individuals to participate in plan implementation is evidenced by their signatures at the
                        bottom of
                        this form. </p>
                    <p>The interventions included in this behavior support plan include modifications to CLIENT’s
                        surroundings and
                        social conditions to reduce the likelihood of his/her challenging behavior and improve his/her
                        independence,
                        systematic instruction to shape and strengthen adaptive skills, and strategies to manage the
                        consequences of
                        CLIENT’s behavior so that reinforcement is maximized for positive behavior and withheld or
                        minimized for
                        problem behavior. Specific strategies include using visuals/token boards to increase
                        independence, prompting
                        to increase spontaneous skills, and shaping socialization to improve relationships.</p>
                    <p>I have had an opportunity to review the complete behavior support plan verbally and in written
                        form and get
                        clarification in response to any questions I have. I agree to be an active participant in
                        implementing
                        and/or supporting the implementation of this behavior intervention plan, participating in
                        training, and
                        monitoring to promote its success. I have been made aware of potential risks (including the
                        possibility that
                        CLIENT’s behavior may escalate before improving and/or vary across settings based on how the
                        plan is
                        implemented, if relevant) and the anticipated benefits of intervention. I understand that these
                        procedures
                        can only be implemented as written with my approval. I reserve the right to refuse or
                        discontinue consent to
                        the plan or specific intervention practices at any point without repercussions. If I withdraw
                        consent,
                        interventions will be discontinued immediately. I recognize the importance of fidelity and
                        consistency, and
                        therefore agree to make every effort to implement the plan as designed. </p>
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td><label>BACB Name:</label></td>
                                <td><input type="text" name="bacbname"></td>
                            </tr>
                            <tr>
                                <td><label>BACB Certificate: </label></td>
                                <td><input type="text" name="bacbcer"></td>
                            </tr>
                        </tbody>
                    </table>
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

                </section>
                <section class="section_bottom">
                    <div class="button-row flex-div">
                        {{-- <div class="mark-sign"><a href="#signatureModal" data-toggle="modal"><span class="mark-icon"><i
                    class="fas fa-check"></i></span> Mark Completed
                and Sign</a></div> --}}
                        <div class="save-prog"><button type="submit"><span class="cloud-icon"><i
                                        class="fas fa-cloud"></i></span>
                                Save</button></div>
                        <div class="print"><button type="button" class="pdf_btn"><span class="print-icon"><i
                                        class="fas fa-print"></i></span>Print</button></div>

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
                        <p><a href="tel:{{ $name_location->phone_one }}">Phone: {{ $name_location->phone_one }},</a>
                            &nbsp;<a href="mailto:{{ $name_location->email }}"> <span>Email:</span>
                                {{ $name_location->email }},</a>&nbsp;<a
                                href="{{ $name_location->email }}">{{ $name_location->email }}</a></p>
                    </div>
                </div>
            </div>
            <form class="pdf_form" action="{{ route('superadmin.print.form.16') }}" target="_blank" method="POST">
                @csrf
                <input type="hidden" name="session_id" class="session_id" value="{{ $session_id }}">
            </form>
        </div>
    </div>
    <!--/ signature modal -->
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
            $(document).on('submit', '#form_16', function(e) {
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
                    url: "{{ route('superadmin.16.form.submit') }}",
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
