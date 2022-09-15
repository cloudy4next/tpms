<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Treatment Plan Review</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/')}}/form-style.css">
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
                    </a>
                </div>
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
        <!-- headers -->
      <form action="#">
                <div class="page-title mb_40">
                    <h1>Treatment Plan Review</h1>
                </div>
                <div class="top-part">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Client Name:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Client MR#:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Date:</label>
                                    <input type="date" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Social Security #:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Medicaid # or Group Insurance #:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Gender:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Date of Birth:</label>
                                    <input type="date" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Street Address:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>City:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>State:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Contact Phone #:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Parent/Guardian:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Primary Clinician:</label>
                                    <input type="text" placeholder="Enter Here...">
                                </td>
                                <td>
                                    <label>Date of Master Treatment Plan or last review:</label>
                                    <input type="date" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Dates of Review Period(Last 3 months):</label>
                                    <input type="date" placeholder="Enter Here...">
                                    <label>to:</label>
                                    <input type="date" placeholder="Enter Here...">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">Treatment Plan Review Process:</h5>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <label>This plan is based on a review of goals, objectives, and interventions
                                        with the Client and/or the Clients parent/caregiver in the following
                                        locations:</label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="r" class="form-check-input">Client Home
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="r" class="form-check-input">Client School
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="r" class="form-check-input">Office
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Primary Clinician:</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <input type="date" placeholder="Enter here..">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Next Review Period (Next 3 Months):</label>
                                    <input type="date" placeholder="Enter Here...">
                                    <label>to:</label>
                                    <input type="date" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Based on Face-to-Face contact with:</label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="r3" class="form-check-input">Client
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="r3" class="form-check-input">Parent/Guardian
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="r3" class="form-check-input">Other
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">Diagnostic Impressions:</h5>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td><label>F-Codes:</label></td>
                                <td><label>Diagnosis:</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">Certification Statement:</h5>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" name="r2" class="form-check-input">This Client is at risk for a more
                            intensive, restrictive and costly mental health placement.
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" name="r2" class="form-check-input">This Client’s condition/functional
                            level cannot be improved with less costly services
                        </label>
                    </div>
                </div>
                <div class="top-part">
                    <h5 class="title">CHANGES IN THE MASTER TREATMENT PLAN</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Change(s) in service or frequency of
                                    services
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Change(s) to treatment interventions
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Change(s) in problem(s) areas
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Changes(s) to treatment objectives
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Change(s) in provider
                                    name/credentials
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Change(s) to treatment goals
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Existing problem area closed/goal
                                    met
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">Existing problem area closed/goal
                                    not met
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top-part">
                    <h5 class="title">Explanation of Changes:</h5>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <div class="flex-div first"><span></span> <span>
                                            <textarea class="form-control"
                                                placeholder="Enter Here..."></textarea></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">Current Medications:</h5>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <div class="flex-div first"><span></span> <span>
                                            <textarea class="form-control"
                                                placeholder="Enter Here..."></textarea></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Client is not on any
                                            Medications
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Strengths</label></td>
                                <td><label>Weakness</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <table cellpadding="0" cellspacing="0" class="extra">
                        <tbody>
                            <tr>
                                <td><label>Type of Service</label></td>
                                <td><label>Billing Code</label></td>
                                <td colspan="2"><label>Amount</label></td>
                                <td><label>Frequency</label></td>
                                <td><label>Duration</label></td>
                                <td><label>Provider Title</label></td>
                            </tr>
                            <tr>
                                <td><label>TBOS (Therapeutic Behavioral On-Site)</label></td>
                                <td><label>(H2019 HO)</label></td>
                                <td><label><input type="text" placeholder="Enter here.."></label></td>
                                <td><label>Units</label></td>
                                <td><label>Weekly</label></td>
                                <td><label>6 Months</label></td>
                                <td><label>Therapist</label></td>
                            </tr>
                            <tr>
                                <td><label>Individual Outpatient</label></td>
                                <td><label>(H2019 HR)</label></td>
                                <td><label><input type="text" placeholder="Enter here.."></label></td>
                                <td><label>Units</label></td>
                                <td><label>Weekly</label></td>
                                <td><label>6 Months</label></td>
                                <td><label>Therapist</label></td>
                            </tr>
                            <tr>
                                <td><label>Master Treatment Plan</label></td>
                                <td><label>(H0032)</label></td>
                                <td><label><input type="text" placeholder="Enter here.."></label></td>
                                <td><label>Units</label></td>
                                <td><label>1 time</label></td>
                                <td><label>Per Year</label></td>
                                <td><label>Therapist</label></td>
                            </tr>
                            <tr>
                                <td><label>Treatment Plan Review</label></td>
                                <td><label>(H0032 TS)</label></td>
                                <td><label><input type="text" placeholder="Enter here.."></label></td>
                                <td><label>Units</label></td>
                                <td><label>2 times</label></td>
                                <td><label>Per Year</label></td>
                                <td><label>Therapist</label></td>
                            </tr>
                            <tr>
                                <td><label>Brief Behavioral Health Status Exam</label></td>
                                <td><label>(H2010 HO)</label></td>
                                <td><label><input type="text" placeholder="Enter here.."></label></td>
                                <td><label>Units</label></td>
                                <td><label>1 time</label></td>
                                <td><label>Per Year</label></td>
                                <td><label>Assessor</label></td>
                            </tr>
                            <tr>
                                <td><label>Psychiatric Evaluation</label></td>
                                <td><label>(H2000 HP)</label></td>
                                <td><label><input type="text" placeholder="Enter here.."></label></td>
                                <td><label>Units</label></td>
                                <td><label>Yearly</label></td>
                                <td><label>Per Year</label></td>
                                <td><label>Psychiatrist</label></td>
                            </tr>
                            <tr>
                                <td><label>Medication Management</label></td>
                                <td><label>(T1015)</label></td>
                                <td><label><input type="text" placeholder="Enter here.."></label></td>
                                <td><label>Units</label></td>
                                <td><label>Monthly</label></td>
                                <td><label>6 months</label></td>
                                <td><label>Psychiatrist</label></td>
                            </tr>
                            <tr>
                                <td><label>Group Therapy</label></td>
                                <td><label>(H2019 HQ)</label></td>
                                <td><label><input type="text" placeholder="Enter here.."></label></td>
                                <td><label>Units</label></td>
                                <td><label>Weekly</label></td>
                                <td><label>6 months</label></td>
                                <td><label>Therapist</label></td>
                            </tr>
                            <tr>
                                <td><label>Limited Functional Asmt (CFARS)</label></td>
                                <td><label>(H0031)</label></td>
                                <td><label><input type="text" placeholder="Enter here.."></label></td>
                                <td><label>Units</label></td>
                                <td><label>3 times</label></td>
                                <td><label>Per Year</label></td>
                                <td><label>Therapist</label></td>
                            </tr>
                            <tr>
                                <td><label>Bio-Psychosocial Evaluation</label></td>
                                <td><label>(H0031 HN)</label></td>
                                <td><label><input type="text" placeholder="Enter here.."></label></td>
                                <td><label>Units</label></td>
                                <td><label>1 time</label></td>
                                <td><label>Per Year</label></td>
                                <td><label>Assessor</label></td>
                            </tr>
                            <tr>
                                <td><label>In-Depth Assessment</label></td>
                                <td><label>(H0031 HO)
                                        (H0031 TS)
                                    </label></td>
                                <td><label><input type="text" placeholder="Enter here.."></label></td>
                                <td><label>Units</label></td>
                                <td><label>1 time</label></td>
                                <td><label>Per Year</label></td>
                                <td><label>Therapist</label></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">Discharge Criteria</h5>
                    <p>At this point in the Client’s care, the following are considerations for the discharge at case
                        closing:</p>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td><label>Problem Areas</label></td>
                                <td><label>Discharge Goals</label></td>
                            </tr>
                            <tr>
                                <td><label>Problem #1: </label><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                            <tr>
                                <td><label>Problem #3: </label><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                            <tr>
                                <td><label>Problem #3: </label><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                            <tr>
                                <td><label>Problem #4: </label><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                            <tr>
                                <td><label>Anticipated Length of Services:</label></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="extra mt-3">
                        <tbody>
                            <tr>
                                <td><label>Treatment Problem Areas</label></td>
                                <td><label>Target Date for Completion</label></td>
                                <td><label>Baseline Rate/Duration</label></td>
                                <td><label>Current
                                        Rate/Duration
                                    </label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">Treatment Problem Sheet</h5>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Problem #1:</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <label>Evidenced by:</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Current Rate/Duration:</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <label>Target Goal:</label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gm" class="form-check-input">Goal Met
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gm" class="form-check-input">Goal Not Met
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="extra mt-3">
                        <tbody>
                            <tr>
                                <td><label>Obj. #</label></td>
                                <td><label>Objectives</label></td>
                                <td><label>Target Date</label></td>
                                <td><label>Goal met/Not Met</label></td>
                            </tr>
                            <tr>
                                <td><label>1</label></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="ob1" class="form-check-input">Objective Met
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="ob1" class="form-check-input">Objective Not Met
                                        </label>
                                    </div>
                                    <div class="mt-2">
                                        <label>Describe the progress towards objective/goal:</label>
                                        <input type="text" placeholder="Enter here..">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <label>Interventions</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="extra mt-3">
                        <tbody>
                            <tr>
                                <td><label>Obj. #</label></td>
                                <td><label>New Objectives</label></td>
                                <td><label>Start Date</label></td>
                                <td><label>Target Date</label></td>
                            </tr>
                            <tr>
                                <td><label>1</label></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <label>Interventions</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title text-center">Treatment Plan Review</h5>
                    <h5 class="title">STATEMENT OF ELIGIBILITY/MEDICAL NECESSITY:</h5>
                    <p>I, treating Physician or Licensed Practitioner of Healing Arts certifies that the above-named
                        services are medically necessary and appropriate to client’s diagnosis and treatment needs.</p>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>CLIENT NAME:</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <label>DATE:</label>
                                    <input type="date">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>MR#:</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <label>LICENSED PRACTITIONER OF THE HEALING ARTS:</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>CREDENTIALS</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <label>EFFECTIVE DATE</label>
                                    <input type="date" placeholder="Enter here..">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>PARENT OR LEGAL GUARDIAN</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <label>DATE</label>
                                    <input type="date" placeholder="Enter here..">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>PRIMARY CLINICIAN SIGNATURE & CREDENTIALS:</label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <label>DATE</label>
                                    <input type="date" placeholder="Enter here..">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>PSYCHIATRIST (IF INDICATED) </label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                                <td>
                                    <label>DATE</label>
                                    <input type="date" placeholder="Enter here..">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="#" data-target="#signatureModal" data-toggle="modal">Client Signature<i class="fa fa-signature"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" data-target="#signatureModal" data-toggle="modal">Clinician Signature<i class="fa fa-signature"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="section_bottom">
                    <div class="button-row flex-div">
                        <div class="save-prog"><button type="submit"><span class="cloud-icon"><i
                                        class="fas fa-cloud"></i></span>
                                Save</button></div>
                        <div class="print"><button type="button"><span class="print-icon"><i
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
    </div>
</div>

<!-- Jq Files -->
<script src="{{asset('assets/dashboard//')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/bootstrap.min.js"></script>
@include('superadmin.appoinment.include.forms_js_include')
</body>

</html>
