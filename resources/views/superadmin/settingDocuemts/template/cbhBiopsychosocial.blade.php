<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>BIOPSYCHOSOCIAL ASSESSMENT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/')}}/form-style.css">
</head>

<body>
<div class="treatment-plan">
    <div class="content">

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

        <!-- headers -->
            <form action="#">
        <div class="page-title mb_40">
          <h1> BIOPSYCHOSOCIAL ASSESSMENT </h1>
        </div>
        <div class="top-part">
          <table>
            <tbody>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Mental Health (MH)
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Psychiatric Services
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="top-part">
          <h5 class="title">1. Demographic Information:</h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>

              <tr>
                <td><label>Client Name:</label> <input type="text" placeholder="Enter Here..."></td>
                <td><label>Client MR:</label> <input type="text" placeholder="Enter Here..."></td>
                <td><label>Date:</label> <input type="date"></td>
              </tr>
              <tr>
                <td><label>Medicaid#:</label> <input type="text" placeholder="Enter Here..."> </td>
                <td colspan="2"><label> OR Group Insurance#:</label> <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td><label>Date of Birth:</label> <input type="date"></td>
                <td colspan="2">
                  <span><label class="d-block">Gender</label></span>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Male
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Female
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td rowspan="3">
                  <div class="flex-div first"><span><label>Location:</label></span> <span>
                      <textarea class="form-control" placeholder="Enter Location..."></textarea>
                    </span>
                  </div>
                </td>
              <tr>
                <td><label> City:</label> <input type="text" placeholder="Enter Here..."></td>
                <td><label> State:</label> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td colspan="2"><label> Zip Code:</label> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              </tr>
              <tr>
                <td colspan="3"><label> Contact Phone:</label> <input type="text" placeholder="Enter Here..."></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="section_1">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td colspan="2"><label class="title text-primary">A. Service Information: </label></td>
              </tr>
              <tr>
                <td colspan="2"> <label> Date of Service/Assessment: </label><input type="date"></td>
              </tr>
              <tr>
                <td colspan="2">
                  <span><label class="d-block">Service/Assessment Type (Check one only): </label></span>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Brief
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Bio-psychosocial
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">In-Depth
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label d-inline-flex align-items-center">
                      <input type="checkbox" class="form-check-input" name="yn">Others
                      <textarea class="form-control border border-primary ml-2 " placeholder="Explain.."></textarea>
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label class="title text-primary">B. Location of Service: </label></td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Office
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Home
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">School
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Community
                    </label>
                  </div>
                  <div class="form-check-inline ">
                    <label class="form-check-label d-inline-flex align-items-center ">
                      <input type="checkbox" class="form-check-input" name="yn">Others
                      <textarea class="form-control border border-primary ml-2 " placeholder="Explain.."></textarea>
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label class="title text-primary">C. Language /Translator Needs: </label></td>
              </tr>
              <tr>
                <td colspan="2">
                  <span><label class="d-block">Does Client need: </label></span>
                  <span class="form-check-label">
                    <label class="d-inline mr-3">Translator</label>
                  </span>
                  <div class="form-check-inline">
                    <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <span><label class="d-inline-flex align-items-center">Explain <textarea
                          class="form-control border border-primary ml-2" placeholder="Explain.."></textarea></label>
                    </span>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label> Primary language spoken: </label> <input type="text" placeholder="Enter Here..."></td>
                <td><label> Primary language written: </label> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td colspan="2"><label class="title text-primary">D. Source of Information </label>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Client
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Parent/Guardian
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Family Members
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Identify Collaterals
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label class="title text-primary">E. Referral Source Information </label>
                </td>
              </tr>
              <tr>
                <td><label> Relationship to Client (Explain): </label> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label> Name: </label> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label> Address: </label> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label> Phone: </label> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label> Release of information reviewed and signed: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">No
                    </label>
                  </div>
                </td>
                <td>
                  <label> (If the answer is yes):</label>
                  <label> Reason for assessment/referral: </label> <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="top-part mt-4">
          <h5 class="title">2. Results of Risk Assessment</h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td colspan="2"><label>Risk Assessment Results:</label>
                </td>
              </tr>
              <tr>
                <td>
                  <span><label class="d-block">Suicidality:</label></span>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Low
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Moderate
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">High (Transfer to Emergency Care)
                    </label>
                  </div>
                </td>
                <td>
                  <span><label class="d-block">Other Risk Factors:</label></span>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Low
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Moderate
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">High (Transfer to Emergency Care)
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label> If High, immediate referral and disposition</label> <textarea
                    class="form-control" placeholder="Explain..."></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part mt-4">
          <h5 class="title">3. Chief Complaint/Presenting Problems</h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>A. Client’s perception of problems/needs/symptoms/behaviors: </label><input type="text"
                    placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td><label>B. Collateral assessments (previous records): </label><input type="text"
                    placeholder="Enter Here...">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part mt-4">
          <h5 class="title">4. Present Symptoms/Behaviors</h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>Description of current symptoms/behaviors/level of functioning, (description of all/length of
                    time present/impact of above on quality of life).
                  </label><input type="text" placeholder="Enter Here...">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part mt-4">
          <h5 class="title">5. Current Stressors </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>A. Environment:
                  </label><input type="text" placeholder="Enter Here...">
                </td>
                <td><label>B. Family:
                  </label><input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td><label>C. Cultural Preferences:
                  </label><input type="text" placeholder="Enter Here...">
                </td>
                <td><label>D. Ability to Self-Care:
                  </label><input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td><label>E. Language Spoken and Preferred Language:
                  </label><input type="text" placeholder="Enter Here...">
                </td>
                <td><label>F. Community resources accessed by the individual served:
                  </label><input type="text" placeholder="Enter Here...">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part mt-4">
          <h5 class="title">6. Behavioral Health Questions: </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td>
                  <label class="d-block">A. Currently in Behavioral Health Services?
                  </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn"> Yes
                    </label>
                  </div>
                  <label class="d-block">If yes, explain:
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
                <td>
                  <label class="d-block">B. Currently on Medication for Behavioral Health (i.e. ADHD
                  </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn"> Yes
                    </label>
                  </div>
                  <label class="d-block">If yes, explain:
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label class="d-block">C. Previously in Behavioral Health Services/on Behavioral Health medications:
                  </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn"> Yes
                    </label>
                  </div>
                  <label class="d-block">If yes, explain:
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part mt-4 ">
          <h5 class="title"> 7. Treatment History – (Past 3-5 years) </h5>
          <table cellpadding="0" cellspacing="0" class="table-bordered">
            <tbody>
              <tr class="text-center">
                <td scope="col"><label>#</label></td>
                <td scope="col"><label>Services</label></td>
                <td scope="col"><label>Facility/Provider Name</label></td>
                <td scope="col"><label>Dates To/From</label></td>
                <td scope="col"><label>Outcomes</label></td>
              </tr>
              <tr>
                <td>1</td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td>2</td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td>3</td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td>4</td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td>5</td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part mt-4">
          <h5 class="title">8. Mental Status (Describe each) </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td>
                  <label>A. Appearance:
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
                <td>
                  <label>B. Behavior
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>C. Attitude
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
                <td>
                  <label>D. Orientation
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>E. Mood:
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
                <td>
                  <label>F. Affect
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>G. Thought process/Form:
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
                <td>
                  <label>H. Thought Content:
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>I. Insight/Judgment
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
                <td>
                  <label>J. Attention Span:
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>K. Intellectual Functioning:
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
                <td>
                  <label>L. Psychomotor Behavior:
                  </label>
                  <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- 9table -->
        <div class="top-part mt-4">
          <h5 class="title"> 9. Biological Issues/Medical History – Client </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label class="title text-primary">A. Current Medical Concerns </label>
                  <textarea class="form-control" placeholder="Description..."></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part ">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tr>
              <td colspan="5" class="title text-primary">B. Current Medication(s) (List All):
              </td>
            </tr>
            <tbody>
              <tr class="text-center font-weight-bold">
                <td><label>#</label></td>
                <td><label>Medication</label></td>
                <td><label>Dosage/Frequency</label></td>
                <td><label>Prescriber</label></td>
                <td><label>Response</label></td>
              </tr>
              <tr>
                <td>2</td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td>3</td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td>4</td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td>5</td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part mt-4">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td colspan="3"><label class="title text-primary">C. Allergies </label>
                  <label>(List all and reactions): </label>
                  <textarea class="form-control" placeholder="Description..."></textarea>
                </td>
              </tr>
              <tr>
                <td colspan="3"> <label class="title text-primary">D. Nutritional </label></td>
              </tr>
              <tr>
                <td colspan="3">
                  <label class="d-block">Recent weight gain/loss (# of pounds and over what time period):
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">Yes
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">No
                      </label>
                    </div>
                  </label>
                </td>
              </tr>
              <tr class="text-center ">
                <td scope="col" class="font-weight-bold">Weight Gained (lbs.)</td>
                <td scope="col" class="font-weight-bold">Weight Lost (lbs.)</td>
                <td scope="col" class="font-weight-bold">Time Period</td>
              </tr>
              <tr>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td><input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td colspan="3">
                  <label>Change in eating habits: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <label class="d-block"> (If yes, describe): <textarea class="form-control"
                      placeholder="Explain..."></textarea></label>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <label>Eat portion of dairy, fruit/vegetables, lean protein at least once per day? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <label class="d-block"> (If yes, Explain): <textarea class="form-control"
                      placeholder="Explain..."></textarea></label>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <label>Difficulty securing food because of limited resources: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <label class="d-block"> (If yes, Explain): <textarea class="form-control"
                      placeholder="Explain..."></textarea></label>
                </td>
              </tr>
              <tr>
                <td colspan="3"> <label class="title text-primary">E. Eating Disorders </label></td>
              </tr>
              <tr>
                <td>
                  <label>Do you make yourself sick because you feel uncomfortably full? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                </td>
                <td>
                  <label>Do you worry that you have lost control over how much you eat? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                </td>
                <td>
                  <label>Have you recently lost more than 15 lbs. in a 3-month period? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="3"> <label class="title text-primary">F. Physical Pain </label></td>
              </tr>
              <tr>
                <td colspan="3">
                  <label>Are you in any physical pain? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <label class="d-block"> (If yes, Explain): <textarea class="form-control"
                      placeholder="Explain..."></textarea></label>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <label>
                    Does it prevent you from engaging in daily living activities?
                  </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <label class="d-block"> (If yes, Explain): <textarea class="form-control"
                      placeholder="Explain..."></textarea></label>
                </td>
              </tr>
              <tr>
                <td colspan="3"> <label class="title text-primary">G. Family Members Medical/Psychiatric History
                  </label></td>
              </tr>
              <tr>
                <td colspan="3" class="text-center"> <label>Relevant Family Medical/Psychiatric Issues </label></td>
              </tr>
              <tr class="text-center ">
                <td scope="col"><label>Family Member</label></td>
                <td colspan="2"><label>Medical/Psychiatric Issues</label></td>
              </tr>
              <tr class="text-center">
                <td><label>Mother</label></td>
                <td colspan="2"><input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr class="text-center">
                <td><label>Father</label></td>
                <td colspan="2"><input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr class="text-center">
                <td> <label>Siblings</label></td>
                <td colspan="2"><input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr class="text-center">
                <td><label>Grandparents</label></td>
                <td colspan="2"><input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr class="text-center">
                <td><label>Others</label></td>
                <td colspan="2"><input type="text" placeholder="Enter Here..."></td>
              </tr>

              <tr>
                <td colspan="3"> <label class="title text-primary">H. Sleeping Behaviors </label></td>
              </tr>
              <tr>
                <td>
                  <label>
                    Sleeping Patterns: # of hours sleep per 24 hours:
                  </label><input type="text" placeholder="Enter Here...">
                </td>
                <td colspan="2">
                  <label>
                    Change in sleeping patterns:
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">No
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">Yes
                      </label>
                    </div>
                  </label>
                  <label class="d-block">Describe: </label>
                  <textarea class="form-control" placeholder="Describe..."></textarea>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <label>Satisfied with sleeping patterns: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                </td>
              </tr>

              <tr>
                <td colspan="3"> <label class="title text-primary">I. Developmental History (18 years or younger)
                  </label></td>
              </tr>
              <tr>
                <td colspan="3">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Full Term
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Premature
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label>If premature, how many weeks?
                      <input type="text" placeholder="Enter Here...">
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Delivery Method:
                    <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label>Talking at age:
                    <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label>Walking at age:
                    <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Toilet training at age:
                    <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label>Past childhood diseases:
                    <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label>Major Injuries/Physical Trauma (describe):
                    <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
              </tr>
              <tr>
                <td colspan="3"> <label class="title text-primary">J. Alcohol and Substance Use
                  </label></td>
              </tr>
              <tr>
                <td>
                  <label>
                    Smoking
                    <label>Smokes Cigarettes/Chews tobacco: </label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">Yes
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">No
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    If yes how much?
                    <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label>
                    If no, any previous use?
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">Yes
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">No
                      </label>
                    </div>
                  </label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>
                    Number of years of use:
                    <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label>
                    Desire to quit:
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">Yes
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">No
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    Family History and Age of Onset:
                    <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label class="d-block">Alcohol</label>
                  <label>
                    Use of alcohol products (current):
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">No
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">Yes
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>Frequency?</label>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label>
                    Previous use:
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">No
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">Yes
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>Frequency?</label>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>
                    Desire to quit?
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">No
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">Yes
                      </label>
                    </div>
                  </label>
                </td>
                <td colspan="2">
                  <label>Family History and Age of Onset: </label>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td colspan="2"><label>If answered yes to 2 or more questions need for FAST Alcohol Assessment: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                <td><label>Date</label> <input type="date"></td>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label class="d-block">Other Substances</label>
                  <label>
                    Use of other substances (current):
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">No
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">Yes
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>Frequency?</label>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label>
                    Previous use:
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">No
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">Yes
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>Frequency?</label>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>
                    Desire to quit:
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">No
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="yn">Yes
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>Impact on social, family, work:</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label>
                    Explain
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </label>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <label>
                    Family History and Age of Onset:
                    <input type="text" placeholder="Enter Here...">
                  </label>
                </td>

              </tr>
              <tr>
                <td colspan="3">
                  <label>
                    If answered yes to 2 or more questions need for DAST-10 Drug assessment:
                  </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <label>Date <input type="date"></label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /9table -->
        <!-- 10Table -->
        <div class="top-part mt-4">
          <h5 class="title"> 10. Trauma Experiences</h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>History of Trauma – has Client experience history of trauma?</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td><label class="d-block">Explain</label> <textarea class="form-control"
                    placeholder="Explain..."></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td><label>Type</label></td>
                <td><label>No</label></td>
                <td><label>Yes</label></td>
                <td><label>Reported</label></td>
                <td><label>Reported To</label></td>
                <td><label>Explanation</label></td>
              </tr>
              <tr>
                <td><label>Neglect</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td> <input type="text" placeholder="Enter Here..."></td>
                <td colspan="2"> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>Emotional</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td> <input type="text" placeholder="Enter Here..."></td>
                <td colspan="2"> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>Physical</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td> <input type="text" placeholder="Enter Here..."></td>
                <td colspan="2"> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>Sexual</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td> <input type="text" placeholder="Enter Here..."></td>
                <td colspan="2"> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part mt-4">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>In the past, has Client harmed, neglected, or abused any person(s), animals and/or
                    others?</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td><label class="d-block">If yes, explain:</label> <textarea class="form-control"
                    placeholder="Explain..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>Currently, is the Client harming or abusing any person(s), animals, and/or others?</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td><label class="d-block">If yes, explain:</label> <textarea class="form-control"
                    placeholder="Explain..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>If answered yes to 2 or more questions need referral for further Trauma assessment?</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td><label class="d-block">If yes, explain:</label> <textarea class="form-control"
                    placeholder="Explain..."></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- ./10Table -->
        <!-- 11table -->
        <div class="top-part mt-4">
          <h5 class="title"> 11. Legal Involvement</h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>Any past legal involvement? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td><label>If yes, explain: </label> <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>Current legal involvement</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td><label>If yes, explain: </label> <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td colspan="4" class="text-center">
                  <h5 class="title">If yes, complete the table below:</h5>
                </td>
              </tr>
              <tr>
                <td><label>Legal Involvement</label></td>
                <td><label>Yes</label></td>
                <td><label>No</label></td>
                <td><label>Explanation</label></td>
              </tr>
              <tr>
                <td><label>Probation</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>Parole</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>House Arrest</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>Detention</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>Court Ordered Treatment</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>Name and contact information for probation officer: </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>Name and contact information for attorney:</label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Name and contact information for attorney:</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <div class="form-check-inline mb-2">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input">If yes, Release of Information form is
              signed and dated.
            </label>
          </div>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td>
                  <label>How does current legal situation impact treatment? </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Does their current legal situation influence his/her progress in care treatment or services
                  </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Relationship between the presenting conditions and legal involvement:
                  </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- ./11table -->
        <!-- 12table -->
        <div class="top-part mt-4">
          <h5 class="title"> 12. Educational Information: </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>Currently in school: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td><label class="d-block">Explain (Grade/School): </label> <textarea class="form-control"
                    placeholder="Explain..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>Graduated High School: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label>GED:</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Technical/Vocational School: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label>College/University: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <label class="d-block">Degree: </label>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td colspan="5" class="text-center">
                  <h5 class="title">If Client is 18 years or younger – complete this section: </h5>
                </td>
              </tr>
              <tr>
                <td><label>Focus Area</label></td>
                <td><label>Excellent</label></td>
                <td><label>Good</label></td>
                <td><label>Fair</label></td>
                <td><label>Poor</label></td>
              </tr>
              <tr>
                <td><label>Academic Performance</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Relationship with Teacher</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Relationship with peers at school</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>Special learning needs: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td><label>Explain: </label> <textarea class="form-control" placeholder="Explain..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>Special placement in school:</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td><label class="d-block">Explain: </label> <textarea class="form-control"
                    placeholder="Explain..."></textarea>
                </td>
              </tr>
              <tr>
                <td><label>Current IEP:</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td><label>Explain: </label> <span>
                    <textarea class="form-control" placeholder="Enter Here..."></textarea></span>
                </td>
              </tr>
              <tr>
                <td><label>School Name</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea></td>
              </tr>
              <tr>
                <td><label>School Contact</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea></td>
              </tr>
              <tr>
                <td><label>School Contact Information</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea></td>
              </tr>

            </tbody>
          </table>
          <div class="mt-3">
            <label>Permission to collaborate, coordinate with school personnel: </label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="yn">No
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="yn">Yes
              </label>
            </div>
          </div>
          <div class="mt-3">
            <label>If yes, Release of Information (ROI) signed and dated </label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Yes
              </label>
            </div>
          </div>
        </div>
        <div class="top-part">
          <h5 class="title">Educational Adaptations/Needs: </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr class="font-weight-bold">
                <td><label>Focus Area</label></td>
                <td> <label>Explanation</label> </td>
              </tr>
              <tr>

                <td><label>Visual Needs/Adaptations</label></td>
                <td>
                  <div class="flex-div first"><span></span> <span>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea></span>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Auditory Needs/Adaptations</label></td>

                <td>
                  <div class="flex-div first"><span></span> <span>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea></span>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Reading Needs/Adaptations</label></td>
                <td>
                  <div class="flex-div first"><span></span> <span>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea></span>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Barriers to learning</label></td>
                <td>
                  <div class="flex-div first"><span></span> <span>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea></span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- ./12table -->
        <!-- 13 Table -->
        <div class="top-part">
          <h5 class="title">13. Employment/Vocational Background (Adults Only) </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td>
                  <label>Currently Employed</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label> Explain</label> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Past Employment</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label> Explain</label> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Vocational Needs: </label>
                  <input type="text" placeholder="Enter Here...">
                </td>
                <td>
                  <label>Vocational Preferences: </label>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Vocational Goals: </label>
                  <input type="text" placeholder="Enter Here...">
                </td>
                <td>
                  <label>Barriers to employment/work: </label>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- ./13 Table -->
        <!-- 14 Table -->
        <div class="top-part">
          <h5 class="title">14. Military Background (Adults Only) </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td>
                  <label>Served in military: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label> Explain</label> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Branch of service: </label>
                  <input type="text" placeholder="Enter Here...">
                </td>
                <td>
                  <label>Years served: </label>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Combat: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label> Explain</label> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label>Discharged: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Discharge type: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Honorable
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Dishonorable
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Others
                    </label>
                  </div>
                </td>
                <td> <label>Explain:</label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- ./14 Table -->
        <!-- 15table -->
        <div class="top-part">
          <h5 class="title">15. Sexual Orientation </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Heterosexual
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Homosexual
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Bi-sexual
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Other
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Prefers not to answer
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- ./15table -->
        <!-- 16table -->
        <div class="top-part">
          <h5 class="title">16. Social, Leisure, and Recreation (Interests and activities) Check all that apply</h5>
          <div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input"> Prefers solo activities
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input">Prefers small group activities
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input">Prefers team or large group activities
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input"> Spends time with family - <input type="text"
                  placeholder="Enter Hours...">
                hours per day/week
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input"> Spends time with friends - <input type="text"
                  placeholder="Enter Hours...">
                hours per day/week
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input"> Watch TV/movies - <input type="text"
                  placeholder="Enter Hours...">
                hours per day/week
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input"> Plays video games - <input type="text"
                  placeholder="Enter Hours...">
                hours per day/week
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input"> Physical activities outside - <input type="text"
                  placeholder="Enter Hours...">
                hours per day/week (list activities below)
              </label>
            </div>
            <div class="mt-2">
              <label> List leisure and recreational interests: </label><textarea
                class="form-control border border-primary" placeholder="Enter Here..."></textarea>
            </div>

          </div>
        </div>
        <!-- ./16table -->
        <!-- 17 table -->
        <div class="top-part">
          <h5 class="title">17. Family Relationships/Support </h5>
          <h5 class="title text-primary">Describe your relationships with your family members: </h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td class="title text-primary" colspan="5"><label>Adults (18 years of age and older): </label></td>
              </tr>
              <tr>
                <td><label>Relationship</label></td>
                <td><label>Good</label></td>
                <td><label>Fair</label></td>
                <td><label>Poor</label></td>
                <td><label>Explain</label></td>
              </tr>
              <tr>
                <td><label>Child </label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="flex-div first">
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Child </label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="flex-div first">
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Parent </label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="flex-div first">
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Siblings </label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="flex-div first">
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <table cellpadding="0" cellspacing="0" class="mt-4 extra">
            <tbody>
              <tr>
                <td class="title text-primary" colspan="5"><label>Child/youth (17 years of age or younger) </label>
                </td>
              </tr>
              <tr>
                <td><label>Relationship</label></td>
                <td><label>Good</label></td>
                <td><label>Fair</label></td>
                <td><label>Poor</label></td>
                <td><label>Explain</label></td>
              </tr>
              <tr>
                <td><label>Parent </label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="flex-div first">
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Parent </label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="flex-div first">
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Siblings </label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="flex-div first">
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Siblings </label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <div class="flex-div first">
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <table cellpadding="0" cellspacing="0" class="mt-4 extra">
            <tbody>
              <tr>
                <td class="title text-primary" colspan="3"><label>Who do you identify as your greatest natural
                    support? </label>
                </td>
              </tr>
              <tr>
                <td><label>Name</label></td>
                <td><label>Relationship</label></td>
                <td><label>How is he/she supportive?</label></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <input type="text" placeholder="Enter Here...">
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <input type="text" placeholder="Enter Here...">
                  </div>
                </td>
                <td>
                  <div class="flex-div first">
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <input type="text" placeholder="Enter Here...">
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <input type="text" placeholder="Enter Here...">
                  </div>
                </td>
                <td>
                  <div class="flex-div first">
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <input type="text" placeholder="Enter Here...">
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <input type="text" placeholder="Enter Here...">
                  </div>
                </td>
                <td>
                  <div class="flex-div first">
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- ./17 table -->
        <!-- 18 table -->
        <div class="top-part">
          <h5 class="title">18. Assistive/Adaptive Device </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td colspan="2">
                  <label>Does Client use assistive/adaptive devices? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label class="d-block">If yes, check and explain below.</label>

                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Auditory Aids
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Visual aids
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Mobility Device
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn"> Cane
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn"> Brace
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn"> Walker
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn"> Crutches
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn"> Wheelchair
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn"> Service Animal
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn"> Other
                    </label>
                  </div>
                  <div class="mt-2">
                    <label>Explain </label>
                    <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- ./18 table -->
        <!-- 19 table -->
        <div class="top-part">
          <h5 class="title">19. Spiritual Preferences/Needs </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td colspan="2">
                  <label> Is Client spiritually oriented? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>

                </td>
                <td>
                  <div class="flex-div first">
                    <label>Explain </label>
                    <textarea class="form-control" placeholder="Explain Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label> Does Client practice spiritual traditions, beliefs, orientation </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Yes
                    </label>
                  </div>

                </td>
                <td>
                  <div class="flex-div first">
                    <label>To what degree does Client wish to have her/his spiritual traditions, beliefs, orientation,
                      incorporated into services? </label>
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
        <!-- ./19 table -->
        <!-- 20table -->
        <div class="top-part">
          <h5 class="title">20. Summary of Findings/Justification for Services: </h5>
          <div>
            <textarea class="form-control border border-primary" placeholder="Summary Here..."></textarea>
          </div>
        </div>
        <!-- ./20table -->
        <!-- 21 table -->
        <div class="top-part">
          <h5 class="title">21. Diagnostic Impression and Justification for Diagnosis: </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr class="text-center">
                <td>
                  <label class="title"> Diagnostic Impression</label>
                </td>
              </tr>
              <tr>
                <td>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>

            </tbody>
          </table>
          <div>
            <h4 class="title text-primary mt-4">
              Justification for Diagnosis:
            </h4>
            <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>
          </div>
        </div>
        <!-- ./21 table -->
        <!-- 22 table -->
        <div class="top-part">
          <h5 class="title">22. Assessor Recommendation of Treatment and Services</h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td>
                  <label>Check as applicable based on medical necessity:</label>
                </td>
                <td>
                  <label>Client/Guardian:</label>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">CBH Individual Therapy-Mental Health
                      Services
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Accepted
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Declined
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">CBH TBOS Services-Mental Health Services
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Accepted
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Declined
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">CBH Psychiatric Services
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Accepted
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Declined
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">CBH Behavior Analysis Services
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Accepted
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Declined
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Other Services (explain): </label>
                  <textarea class="form-control flex-div" placeholder="Explain Here..."></textarea>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Accepted
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Declined
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- ./22 table -->
        <!-- 23table -->
        <div class="top-part">
          <h5 class="title">23. Client and Family Response to Recommendations and Commitment to
            Services
          </h5>
          <div class="mb-3">
            <div class="form-check-inline d-block">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Client/Family Agree (Complete #1.)
              </label>
            </div>
            <div class="form-check-inline d-block">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Client/Family Disagree/Do not wish
                admission (Complete #2)
              </label>
            </div>
          </div>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td>
                  <label>1. Client and Family goals for treatment and services:
                  </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>1. Client and Family goals for treatment and services:
                    <input type="text" placeholder="Enter Here...">
                  </label>
                  <div class="mt-2">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Client
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Family
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">Referral:
                        <input type="text" placeholder="Enter Here...">
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- ./23table -->
        <!-- 24table -->
        <div class="top-part">
          <h5 class="title">24. Assessor referral to CBH services and a completion of admission
          </h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td colspan="3"><label>Additional assessments needed: </label></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">DAST-10 Drug
                    </label>
                  </div>
                  <label class="d-block">Assessment (Assessor) </label>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">FAST Alcohol
                    </label>
                  </div>
                  <label class="d-block">Assessment (Assessor) </label>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Trauma (Assessor)
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="mt-3">
            <label>Was a Mental Health Advance Directive offered and explained to the Client (Adults
              only)?</label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Yes
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">No
              </label>
            </div>
          </div>
          <div class="mt-3">
            <label>Outcome: </label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Client completed Advance Directive
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Client declined Advance Directive
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Client took Advance Directive to review for
                possible future completion.
              </label>
            </div>
          </div>
          <div class="mt-3 ">
            <label class="title d-block mb-2">Admission Documents Completed: </label>
            <div class="form-check-inline d-block">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Rights and Responsibilities/Grievance
              </label>
            </div>
            <div class="form-check-inline d-block">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Consent to Treatment/Financial Responsibility
              </label>
            </div>
            <div class="form-check-inline d-block">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Coordination of Care
              </label>
            </div>
            <div class="form-check-inline d-block">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Release of Information
              </label>
            </div>
            <div class="form-check-inline d-block">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Advanced Directives (Adults only)
              </label>
            </div>
            <div class="form-check-inline d-block">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">FARS/CFARS
              </label>
            </div>
            <div class="form-check-inline d-block">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Calocus/Locus as indicated
              </label>
            </div>
          </div>
          <table cellpadding="0" cellspacing="0" class="mt-4">
            <tbody>
              <tr>
                <td colspan="3">
                  <label>Completed documents returned to Mental Health Department – Date:</label>
                  <input type="date">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Assessor Name: <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label>Signature: <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                  </label>
                </td>
                <td>
                  <label>Date: <input type="date" placeholder="Enter Here...">
                  </label>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label>Credentials: <input type="text" placeholder="Enter Here..."></label>
                </td>
                <td>
                  <label>Title: <input type="text" placeholder="Enter Here..."></label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Qualified Supervisor Name: <input type="text" placeholder="Enter Here..."></label>
                </td>
                <td>
                  <label>Signature: <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a></label>
                </td>
                <td>
                  <label>Date: <input type="date" placeholder="Enter Here..."></label>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label>Credentials: <input type="text" placeholder="Enter Here..."></label>
                </td>
                <td>
                  <label>Title: <input type="text" placeholder="Enter Here..."></label>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
        <!-- 24table -->


        <div class="section_bottom">
          <div class="button-row flex-div">
            <div class="save-prog"><button type="submit"><span class="cloud-icon"><i class="fas fa-cloud"></i></span>
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
