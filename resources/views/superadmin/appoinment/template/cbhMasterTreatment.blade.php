<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Master Treatment Plan</title>
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
          <h1> Master Treatment Plan </h1>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td>
                  <label> Client Name: <input type="text" placeholder="Enter Here..."></label>
                </td>
                <td>
                  <label> Client MR# <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label> Intake Date: <input type="date" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label> Completion Date: <input type="date">
                  </label>
                </td>
              </tr>

              <tr>
                <td>
                  <label>*Social Security #: <input type="text" placeholder="Enter Here..."></label>
                </td>
                <td>
                  <label>Medicaid # or Group Insurance #: <input type="text" placeholder="Enter Here..."></label>
                </td>
                <td>
                  <label>Gender:
                    <div class="form-check-inline d-block">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Male
                      </label>
                    </div>
                  </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Female
                    </label>
                  </div>
                </td>
                <td>
                  <label>Date of Birth: <input type="date">
                  </label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Street Address:</label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td>
                  <label>City: <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label>State: <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label>Contact Phone #:<input type="text" placeholder="Enter Here...">
                  </label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Parent/Guardian:
                  </label>
                </td>
                <td><input type="text" placeholder="Enter Here..."></td>
                <td>
                  <label>Primary Clinician:
                  </label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td colspan="3"><label>Effective Date: (Date certified by Licensed Practitioner of Healing Arts)</label>
                </td>
                <td>
                  <input type="date">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">Treatment Development Process:</h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td colspan="2">
                  <label> Problems, Strengths/Weakness, and Intervention sections developed with participation by the
                    Client and the Client’s parent/caregiver in</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Client Home
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Client School
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Office
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Primary Clinician: <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <label>Date: <input type="date">
                  </label>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label> Based on Face to Face contact with: </label>
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
                      <input type="checkbox" class="form-check-input" name="yn">Other
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
                <td>
                  <label> F-Codes:</label>
                </td>
                <td>
                  <label> Diagnosis:</label>
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
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">Certification Statement:</h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <label>This Client is at risk for a more intensive, restrictive and costly mental health
                    placement.</label>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <label>This Client’s condition/functional level cannot be improved with less costly services.</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">Barriers to Treatment:</h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td class="text-center">
                  <label>Strengths</label>
                </td>
                <td class="text-center"><label>Weakness</label></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody class="text-center">
              <tr>
                <td colspan="8"></td>
              </tr>
              <tr>
                <td colspan="2">
                  <label>Type of Service</label>
                </td>
                <td><label>Billing Code</label></td>
                <td colspan="2"><label>Amount</label></td>
                <td><label>Frequency</label></td>
                <td><label>Duration</label></td>
                <td><label>Provider Title</label></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td><label>TBOS (Therapeutic Behavioral On-Site)</label></td>
                <td>
                  <label>(H2019 HO)</label>
                </td>
                <td><input type="text"></td>
                <td><label>Units</label></td>
                <td><label>Weekly</label></td>
                <td><label>6 Months</label></td>
                <td><label>Therapist</label></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td><label>Individual Outpatient</label></td>
                <td>
                  <label>(H2019 HR)</label>
                </td>
                <td><input type="text"></td>
                <td><label>Units</label></td>
                <td><label>Weekly</label></td>
                <td><label>6 Months</label></td>
                <td><label>Therapist</label></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td><label>Master Treatment Plan</label></td>
                <td>
                  <label>(H0032)</label>
                </td>
                <td><input type="text"></td>
                <td><label>Units</label></td>
                <td><label>1 time</label></td>
                <td><label>Per Year</label></td>
                <td><label>Therapist</label></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td><label>Treatment Plan Review</label></td>
                <td>
                  <label>(H0032 TS)</label>
                </td>
                <td><input type="text"></td>
                <td><label>Units</label></td>
                <td><label>2 times</label></td>
                <td><label>Per Year</label></td>
                <td><label>Therapist</label></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td><label>Brief Behavioral Health Status Exam</label></td>
                <td>
                  <label>(H2010 HO)</label>
                </td>
                <td><input type="text"></td>
                <td><label>Units</label></td>
                <td><label>1 time</label></td>
                <td><label>Per Year</label></td>
                <td><label>Assessor</label></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td><label>Psychiatric Evaluation</label></td>
                <td>
                  <label>(H2000 HP)</label>
                </td>
                <td><input type="text"></td>
                <td><label>Time</label></td>
                <td><label>Yearly</label></td>
                <td><label>Per Year</label></td>
                <td><label>Psychiatrist</label></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td><label>Medication Management</label></td>
                <td>
                  <label>(T1015)</label>
                </td>
                <td><input type="text"></td>
                <td><label>Unit</label></td>
                <td><label>Monthly</label></td>
                <td><label>6 Months</label></td>
                <td><label>Therapist</label></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td><label>Group Therapy</label></td>
                <td>
                  <label>(H2019 HQ)</label>
                </td>
                <td><input type="text"></td>
                <td><label>Units</label></td>
                <td><label>Weekly</label></td>
                <td><label>6 Months</label></td>
                <td><label>Therapist</label></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td><label>Limited Functional Asmt (CFARS)</label></td>
                <td>
                  <label>(H0031)</label>
                </td>
                <td><input type="text"></td>
                <td><label>Unit</label></td>
                <td><label>3 times</label></td>
                <td><label>Per Year</label></td>
                <td><label>Therapist</label></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td><label>Bio-Psychosocial Evaluation</label></td>
                <td>
                  <label>(H0031 HN)</label>
                </td>
                <td><input type="text"></td>
                <td><label>Unit</label></td>
                <td><label>1 time</label></td>
                <td><label>Per Year</label></td>
                <td><label>Assessor</label></td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td><label>In-Depth Assessment</label></td>
                <td>
                  <label>(H0031 HO)
                    (H0031 TS)</label>
                </td>
                <td><input type="text"></td>
                <td><label>Unit</label></td>
                <td><label>1 time</label></td>
                <td><label>Per Year</label></td>
                <td><label>Therapist</label></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">Attachments:</h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <label>Problem #1:</label>
                </td>
                <td>
                  <label><input type="text"></label>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <label>Problem #2:</label>
                </td>
                <td>
                  <label><input type="text"></label>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <label>Problem #3:</label>
                </td>
                <td>
                  <label><input type="text"></label>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">
                    </label>
                  </div>
                </td>
                <td>
                  <label>Problem #4:</label>
                </td>
                <td>
                  <label><input type="text"></label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">Discharge Criteria:</h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td colspan="3"><label>At this point in the Client’s care, the following are considerations for the
                    discharge at
                    case closing:</label></td>
              </tr>
              <tr>
                <td><label>Problem Areas</label></td>
                <td><label>Discharge Goals</label></td>
              </tr>
              <tr>
                <td>
                  <label>Problem #1: <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Problem #2: <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Problem #3: <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Problem #4: <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Anticipated Length of Services:
                  </label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">
            Treatment Problem Sheet
          </h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td>
                  <label>Problem #1:
                  </label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Evidenced by:</label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Admission Baseline:</label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Target Goal:</label>
                </td>
                <td>
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
                <td><label>Obj. # </label></td>
                <td><label>Short Term Objective</label></td>
                <td><label>Target Date</label></td>
                <td><label>Interventions</label></td>
              </tr>
              <tr>
                <td><label>1.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>2.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>3.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>4.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>5.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">
            Treatment Problem Sheet
          </h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td>
                  <label>Problem #2:
                  </label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Evidenced by:</label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Admission Baseline:</label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Target Goal:</label>
                </td>
                <td>
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
                <td><label>Obj. # </label></td>
                <td><label>Short Term Objective</label></td>
                <td><label>Target Date</label></td>
                <td><label>Interventions</label></td>
              </tr>
              <tr>
                <td><label>1.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>2.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>3.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>4.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>5.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">
            Treatment Problem Sheet
          </h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td>
                  <label>Problem #3:
                  </label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Evidenced by:</label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Admission Baseline:</label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Target Goal:</label>
                </td>
                <td>
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
                <td><label>Obj. # </label></td>
                <td><label>Short Term Objective</label></td>
                <td><label>Target Date</label></td>
                <td><label>Interventions</label></td>
              </tr>
              <tr>
                <td><label>1.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>2.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>3.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>4.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>5.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">
            Treatment Problem Sheet
          </h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td>
                  <label>Problem #4:
                  </label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Evidenced by:</label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Admission Baseline:</label>
                </td>
                <td>
                  <input type="text" placeholder="Enter Here...">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Target Goal:</label>
                </td>
                <td>
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
                <td><label>Obj. # </label></td>
                <td><label>Short Term Objective</label></td>
                <td><label>Target Date</label></td>
                <td><label>Interventions</label></td>
              </tr>
              <tr>
                <td><label>1.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>2.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>3.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>4.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>5.</label></td>
                <td> <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
                <td> <input type="date"></td>
                <td> <input type="text" placeholder="Enter Here..."></td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class=" title text-center">VERIFICATION PAGE</h5>
          <div>
            <p class="font-weight-bold">I have participated in the development of treatment objectives and the initial
              discharge goals.
              Furthermore, my signature indicates that I am willing to be involved in treatment and the achievement of
              treatment goals. </p>
          </div>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td class="pt-4"><a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                  <p class="font-weight-bold">Client Signature</p>
                  <label>I acknowledge by signing I have received a copy of this
                    document</label>
                </td>
                <td><label>Date:</label><input type="date"></td>
              </tr>

              <tr>
                <td class="pt-4"><a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                  <p class="font-weight-bold">Parent/Guardian Signature</p>
                  <label>I acknowledge by signing I have received a copy of this document</label>
                </td>
                <td><label>Date:</label><input type="date"></td>
              </tr>
              <tr>
                <td class="pt-4"><a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                  <p class="font-weight-bold">Therapist Signature and Credentials</p>
                </td>
                <td><label>Date:</label><input type="date"></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><label class="title ">STATEMENT OF ELIGIBILITY/MEDICAL
                    NECESSITY:</label>
                  <p class="pt-3 font-weight-bold text-left">I, treating Physician or Licensed Practitioner of Healing
                    Arts certifies that the above named
                    services are medically necessary and appropriate to Client’s diagnosis and treatment needs.</p>
                </td>
              </tr>
              <tr>
                <td class="pt-4"><a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                  <p class="font-weight-bold">Treating Physician/Licensed Practitioner of Healing Arts Signature</p>
                </td>
                <td><label>Date:</label><input type="date"></td>
              </tr>
            </tbody>
          </table>
        </div>
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
