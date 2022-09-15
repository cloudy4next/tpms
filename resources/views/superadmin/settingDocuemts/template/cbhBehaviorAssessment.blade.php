<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>BEHAVIOR ANALYSIS ASSESSMENT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/')}}/form-style.css">
</head>

<body>
<div class="treatment-plan">
    <div class="content">
    <header>
        <div class="flex-div">
            <div class="col-item">
                <div class="logo"><a href="#"><img
                            src="{{asset('assets/dashboard/template/')}}/logo4.png"
                            alt=""></a></div>
            </div>
            <div class="col-item">
              <div class="info-details">
                <ul>
                  <li> <span>Mail:</span>demo@example.com</li>
                  <li><a href="#"> <span>Email:</span>demo@example.com</a></li>
                  <li><span>Phone:</span> 000-000-0000</li>
                  <li><a href="#"><span>Fax:</span>000.000.0000</a></li>
                </ul>
              </div>
            </div>
        </div>
    </header>
        <!-- headers -->
            <form action="#">
                <div class="page-title mb_40">
                    <h1>BEHAVIOR ANALYSIS ASSESSMENT</h1>
                </div>
                <div class="top-part">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td><label>Recipient Name:</label> <input type="text" placeholder="Enter Here..."></td>
                                <td><label>Recipient ID:</label> <input type="text" placeholder="Enter Here..."></td>
                            </tr>
                            <tr>
                                <td><label>Recipient Age:</label> <input type="text" placeholder="Enter Here..."></td>
                                <td><label>Recipient DOB:</label> <input type="date"></td>
                            </tr>
                            <tr>
                                <td><label>Date of Assessment:</label> <input type="date"></td>
                                <td><label>Date of Initial Assessment Report:</label> <input type="date"></td>
                            </tr>
                            <tr>
                                <td><label>Date of Reassessment Report:</label> <input type="date"></td>
                                <td><label>Recipient Address:</label> <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td><label>Recipient Phone:</label> <input type="text" placeholder="Enter Here...">
                                <td><label>Evaluators Name</label> <input type="text" placeholder="Enter Here...">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Type of Assessment:</label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="toa" class="form-check-input">Initial Assessment
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="toa" class="form-check-input">Reassessment
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">MEDICAL REASONS SUPPORTING THE NEED FOR BA SERVICES/DIAGNOSIS</h5>
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
                    <h5 class="title">DOCUMENTS REVIEWED</h5>
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
                    <h5 class="title">BACKGROUND INFORMATION</h5>
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
                    <h5 class="title">COLLABORATION OF SERVICES AND REFERRALS</h5>
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
                    <h5 class="title">MEDICAL PROBLEMS/MEDICATIONS:</h5>
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
                    <table cellpadding="0" cellspacing="0" class="mt-3">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Medication</label>
                                </td>
                                <td>
                                    <label>Dosage</label>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">EDUCATION STATUS:</h5>
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
                    <h5 class="title">OBSERVATIONS:</h5>
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
                    <h5 class="title">STRENGTHS AND WEAKNESSES</h5>
                    <table cellpadding="0" cellspacing="0" class="extra">
                        <tbody>
                            <tr>
                                <td><label>Communication </label></td>
                                <td><label>Daily Living Skills </label></td>
                                <td><label>Socialization </label></td>
                            </tr>
                            <tr>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">MALADAPTIVE BEHAVIORS</h5>
                    <table cellpadding="0" cellspacing="0" class="extra">
                        <tbody>
                            <tr>
                                <td><label>Behavior(s)</label></td>
                                <td><label>Topographical Definition</label></td>
                                <td><label>Baseline Level & Intensity
                                        Date:
                                    </label></td>
                                <td><label>Measure(s) & Criteria to Discontinue Targeting</label></td>
                                <td><label>Current Status</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter Here.."></td>
                                <td><input type="text" placeholder="Enter Here.."></td>
                                <td>
                                    <div>
                                        <label>Level:</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                    <div>
                                        <label>Intensity:</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <label>Measure(s): Frequency/Duration</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                    <div>
                                        <label>Criteria:</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Met
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Continuing
                                            New
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter Here.."></td>
                                <td><input type="text" placeholder="Enter Here.."></td>
                                <td>
                                    <div>
                                        <label>Level:</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                    <div>
                                        <label>Intensity:</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <label>Measure(s): Frequency/Duration</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                    <div>
                                        <label>Criteria:</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Met
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Continuing
                                            New
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter Here.."></td>
                                <td><input type="text" placeholder="Enter Here.."></td>
                                <td>
                                    <div>
                                        <label>Level:</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                    <div>
                                        <label>Intensity:</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <label>Measure(s): Frequency/Duration</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                    <div>
                                        <label>Criteria:</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Met
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Continuing
                                            New
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter Here.."></td>
                                <td><input type="text" placeholder="Enter Here.."></td>
                                <td>
                                    <div>
                                        <label>Level:</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                    <div>
                                        <label>Intensity:</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <label>Measure(s): Frequency/Duration</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                    <div>
                                        <label>Criteria:</label>
                                        <input type="text" placeholder="Enter Here..">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Met
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Continuing
                                            New
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">Intensity Scales</h5>
                    <table cellpadding="0" cellspacing="0" class="extra">
                        <tbody>
                            <tr>
                                <td><label>Behavior</label></td>
                                <td><label>Level 1: No Impact</label></td>
                                <td><label>Level 2: Mild</label></td>
                                <td><label>Level 3: Moderate </label></td>
                                <td><label>Level 4: Severe </label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">ASSESSMENTS CONDUCTED</h5>
                    <table cellpadding="0" cellspacing="0" class="extra">
                        <tbody>
                            <tr>
                                <td><label>Date</label></td>
                                <td><label>Observer</label></td>
                                <td><label>Setting/Activity</label></td>
                                <td><label>Duration</label></td>
                                <td><label>Tools (e.g., ABC, scatterplot)</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="extra mt-3">
                        <tbody>
                            <tr>
                                <td><label>Target Behavior/Precursors</label></td>
                                <td><label>Antecedent/Setting Events</label></td>
                                <td><label>Hypothesized Function</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">ASSESSMENT DATA COLLECTED</h5>
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
                    <h5 class="title text-center">FAMILY/CAREGIVER INVOLVEMENT</h5>
                    <h5 class="title">Action Plan for Implementation:</h5>
                    <table cellpadding="0" cellspacing="0" class="extra">
                        <tbody>
                            <tr>
                                <td><label>Implementation Goal</label></td>
                                <td><label>Action Steps</label></td>
                                <td><label>Person Responsible</label></td>
                                <td><label>Date Due</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="extra mt-3">
                        <tbody>
                            <tr>
                                <td><label>Family/Staff Involved in Implementation</label></td>
                                <td><label>Frequency of Fidelity Checks</label></td>
                                <td><label>Accuracy Criteria</label></td>
                                <td><label>Tools Used to Measure Fidelity of Training</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="extra mt-3">
                        <tbody>
                            <tr>
                                <td><label>Caregiver Goal(s)</label></td>
                                <td><label>Outcome Measure & Criteria</label></td>
                                <td><label>Baseline Data</label></td>
                                <td><label>Progress Towards Mastery Data</label></td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <label>Caregiver:</label>
                                        <input type="text" placeholder="Enter here..">
                                    </div>
                                    <div>
                                        <label>Goals:</label>
                                        <input type="text" placeholder="Enter here..">
                                    </div>
                                </td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">Monitoring Outcomes</h5>
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
                    <h5 class="title">GENERALIZATION TRAINING</h5>
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
                    <h5 class="title">Maintenance Programs</h5>
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
                    <h5 class="title">SHORT TERM GOALS/OBJECTIVES</h5>
                    <table cellpadding="0" cellspacing="0" class="extra">
                        <tbody>
                            <tr>
                                <td><label>Objectives related to Maladaptive Behaviors</label></td>
                                <td><label>Level</label></td>
                                <td><label>Baseline</label></td>
                                <td><label>Current Rate</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Met
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Continuing
                                            New
                                        </label>
                                    </div>
                                </td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="extra mt-3">
                        <tbody>
                            <tr>
                                <td><label>Skill objectives related to Maladaptive Behaviors</label></td>
                                <td><label>Level</label></td>
                                <td><label>Baseline</label></td>
                                <td><label>Current Rate</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Met
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Continuing
                                            New
                                        </label>
                                    </div>
                                </td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">LONG TERM GOALS/OBJECTIVES</h5>
                    <table cellpadding="0" cellspacing="0" class="extra">
                        <tbody>
                            <tr>
                                <td><label>Objectives related to Maladaptive Behaviors</label></td>
                                <td><label>Level</label></td>
                                <td><label>Baseline</label></td>
                                <td><label>Current Rate</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Met
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Continuing
                                            New
                                        </label>
                                    </div>
                                </td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="extra mt-3">
                        <tbody>
                            <tr>
                                <td><label>Skill objectives related to Maladaptive Behaviors</label></td>
                                <td><label>Level</label></td>
                                <td><label>Baseline</label></td>
                                <td><label>Current Rate</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Met
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Continuing
                                            New
                                        </label>
                                    </div>
                                </td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title text-center">BEHAVIOR PLAN COMPONENTS</h5>
                    <h5 class="title">Hypothesis-Based Interventions: </h5>
                    <table cellpadding="0" cellspacing="0" class="extra">
                        <tbody>
                            <tr>
                                <td colspan="3" class="text-center"><label>Obtain Item/Activity</label></td>
                            </tr>
                            <tr>
                                <td><label>Context/Antecedent(s)</label></td>
                                <td><label>Behavior(s)</label></td>
                                <td><label>Function/Consequence(s)</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                            <tr>
                                <td><label>Preventive Strategies
                                        (antecedent-based)
                                    </label></td>
                                <td><label>Replacement Skills
                                        (related to function)
                                    </label></td>
                                <td><label>Management Strategies
                                        (consequence-based)
                                    </label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td>
                                    <div>
                                        <label>What to do when XXXX demonstrates the replacement or desired
                                            behaviors:</label>
                                        <input type="text" placeholder="Enter here..">
                                    </div>
                                    <div>
                                        <label>What to do when XXXX engages </label>
                                        <input type="text" placeholder="Enter here..">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label for="">Antecedent strategies: </label>
                                    <input type="text" placeholder="Enter here..">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="extra mt-3">
                        <tbody>
                            <tr>
                                <td colspan="3" class="text-center"><label>Escape or Delay task</label></td>
                            </tr>
                            <tr>
                                <td><label>Context/Antecedent(s)</label></td>
                                <td><label>Behavior(s)</label></td>
                                <td><label>Function/Consequence(s)</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                            <tr>
                                <td><label>Preventive Strategies
                                        (antecedent-based)
                                    </label></td>
                                <td><label>Replacement Skills
                                        (related to function)
                                    </label></td>
                                <td><label>Management Strategies
                                        (consequence-based)
                                    </label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="top-part">
                    <h5 class="title">CRISIS STATEMENT</h5>
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
                    <h5 class="title">PREFERENCE ASSESSMENT</h5>
                    <table cellpadding="0" cellspacing="0" class="extra">
                        <tbody>
                            <tr>
                                <td><label>People</label></td>
                                <td><label>Tangibles</label></td>
                                <td><label>Activities</label></td>
                                <td><label>Foods</label></td>
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
                    <h5 class="title text-center">DISCHARGE CRITERIA</h5>
                    <h5 class="title">Fading/Termination Procedures:</h5>
                    <table cellpadding="0" cellspacing="0" class="extra">
                        <tbody>
                            <tr>
                                <td><label>Goals for Reducing Services</label></td>
                                <td><label>Criteria</label></td>
                                <td><label>Time Frame</label></td>
                                <td><label>Service Reduction </label></td>
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
                    <h5 class="title">SUMMARY AND RECOMMENDATIONS:</h5>
                    <table cellpadding="0" cellspacing="0" class="extra">
                        <tbody>
                            <tr>
                                <td><label>HCPCS </label></td>
                                <td><label>Description of Service </label></td>
                                <td><label># of Units / Quarter Hours Requested </label></td>
                                <td><label>Breakdown per Week </label></td>
                                <td><label>Location (Where Services are to be Delivered) </label></td>
                            </tr>
                            <tr>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                                <td><input type="text" placeholder="Enter here.."></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="top-part">
                    <h5 class="title text-center">Consent to Treatment</h5>
                    <p>I hereby provide my consent to implement the behavior support plan for XXXX developed by Clarity
                        Behavioral Health on XXXX. I understand that the interventions in this plan have been designed
                        to result in the reduction of XXXX and enhance XXXX’s skills in XXXX as well as improve his
                        overall quality of life. I agree that implementation of XXXX’s behavior support plan will occur
                        at his home and community and involve the participation of the following individuals: XXXXX.
                        Commitment of these individuals to participate in plan implementation is evidenced by their
                        signatures at the bottom of this form. </p>
                    <p>The particular interventions included in this behavior support plan include modifications to
                        XXXX’s surroundings and social conditions to reduce the likelihood of his challenging behavior
                        and improve his independence, systematic instruction to shape and strengthen adaptive skills,
                        and strategies to manage the consequences of XXXX’s behavior so that reinforcement is maximized
                        for positive behavior and withheld or minimized for problem behavior. </p>
                    <p>I have had an opportunity to review the complete behavior support plan verbally and in written
                        form and get clarification in response to any questions I have. I agree to be an active
                        participant in implementing and/or supporting the implementation of this behavior intervention
                        plan, participating in training and monitoring to promote its success. I have been made aware of
                        potential risks including the possibility that XXXX’s behavior may escalate before improving
                        and/or vary across settings based on how the plan is implemented, if relevant and the
                        anticipated benefits of intervention. I understand that these procedures can only be implemented
                        as written with my approval. I reserve the right to refuse or discontinue consent to the plan or
                        specific intervention practices at any point without repercussions. If I withdraw consent,
                        interventions will be discontinued immediately. I recognize the importance of fidelity and
                        consistency, and therefore agree to make every effort to implement the plan as designed.</p>
                </div>
                <div class="top-part">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Lead Analyst Name:</label>
                                    <input type="text" placeholder="Enter Here..">
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <input type="date">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="#" data-target="#signatureModal" data-toggle="modal">Lead Analyst Signature<i
                                class="fa fa-signature"></i></a>
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
            <p><strong>Demo Institution</strong> somewhere in america</p>
          </div>
          <div class="col-item">
            <p> <a href="tel:000-000-0000">Phone: 000-000-0000,</a> &nbsp;<a href="mailto:">
                <span>Email:</span> demo@example.com,</a>&nbsp; <a href="fax:000.000.0000"> Fax:
                000.000.0000,</a>&nbsp; <a href="https://example.com/">example.com</a> </p>
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
