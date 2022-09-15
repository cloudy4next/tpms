<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Medication Management Progress Note</title>
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
          <h1>Medication Management Progress Note</h1>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td colspan="2"><label>Client: <input type="text"></label></td>
                <td><label>Client MR#: <input type="text"></label></td>
                <td><label>Age: <input type="text"></label></td>
                <td><label>Diagnosis: <input type="text"></label></td>
              </tr>
              <tr>
                <td><label>Date: <input type="date"></label></td>
                <td><label>Staff: <input type="text"></label></td>
                <td><label>Billing Code: <input type="text"></label></td>
                <td><label>Time In: <input type="time"></label></td>
                <td><label>Time Out: <input type="time"></label></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <label>A. Chief Complaint (reason for visit): </label>
          <div>
            <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>
          </div>
        </div>
        <div class="top-part">
          <label>B. History of Present Illness: (Describe location, duration, severity, context, associated signs,
            quality, modifying factors, medications) </label>
          <div>
            <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>
          </div>
        </div>
        <div class="top-part">
          <label>B. History of Present Illness: (Describe location, duration, severity, context, associated signs,
            quality, modifying factors, medications) </label>
          <div>
            <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>
          </div>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td><label>ROS: </label></td>
                <td><label>Systemic </label></td>
                <td><label>ENT </label></td>
                <td><label>Eyes </label></td>
                <td><label>Lymph </label></td>
                <td><label>Resp </label></td>
                <td><label>CV </label></td>
                <td><label>GI </label></td>
                <td><label>GU </label></td>
                <td><label>Skin </label></td>
                <td><label>MS </label></td>
                <td><label>Endo </label></td>
                <td><label>Neuro </label></td>
                <td><label>Psych </label></td>
                <td><label>Allergy </label></td>
              </tr>
              <tr>
                <td><label>+</label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label>-</label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>


            </tbody>
          </table>
          <div class="d-flex justify-content-between border border-primary border-top-0 pt-4 pb-4">
            <td><label>Explain Positive Responses: <input type="text"></label></td>
            <td><label># of Systems reviewed:_______________________ </label></td>
          </div>
        </div>
        <div class="top-part">
          <label>E. Past, Family, Social History: </label>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">Reviewed PH
            </label>
          </div>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">Reviewed FH
            </label>
          </div>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">Reviewed SH
            </label>
          </div>
          <p class="pt-3"> Since last visit, are there:</p>
          <div>
            <label>Changes in PH: </label>
            <div class="form-check-inline ">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Yes
              </label>
            </div>
            <div class="form-check-inline ">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Yes
              </label>
            </div>
          </div>
          <div>
            <label>Changes in FH: </label>
            <div class="form-check-inline ">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Yes
              </label>
            </div>
            <div class="form-check-inline ">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Yes
              </label>
            </div>
          </div>
          <div>
            <label>Changes in SH: </label>
            <div class="form-check-inline ">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Yes
              </label>
            </div>
            <div class="form-check-inline ">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Yes
              </label>
            </div>
          </div>
        </div>
        <div class="top-part">
          <label>Explain any changes in PFSH: </label>
          <div>
            <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>
          </div>
        </div>
        <div class="top-part">
          <label>F. Examination </label>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td><label>Vitals: </label></td>
                <td colspan="2"><label>Height: <input type="text"> </label></td>
                <td colspan="2"><label>Weight: <input type="text"> </label></td>
                <td colspan="2"><label>BP: <input type="text"> </label></td>
              </tr>
              <tr>
                <td colspan="7"><label>General Appearance: <input type="text"></label></td>
              </tr>
              <tr>
                <td><label>Musculoskeletal</label></td>
                <td></td>
                <td><label>Normal</label></td>
                <td><label>Abnormal</label></td>
                <td><label></label></td>
                <td><label>Normal </label></td>
                <td><label>Abnormal </label></td>
              </tr>
              <tr>
                <td rowspan="3"><label>Gait, station: </label>
                  <label>Strength, tone: </label>
                </td>
                <td><label>Psychiatric</label></td>
                <td><label></label></td>
                <td><label></label></td>
                <td><label></label></td>
                <td><label></label></td>
                <td><label></label></td>
              <tr>
                <td><label>Orientation X 3</label></td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td><label>Mood/Affect</label></td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
              </tr>
              <tr>
                <td><label>Attention Span and concentration</label></td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    Abnormal/Psychotic Thoughts
                  </label>
                </td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
              </tr>
              </tr>
              <!-- 2nd row -->
              <tr>
                <td rowspan="5"><label>Neurological:</label>
                </td>
                <td><label>Language</label></td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td><label>Thought Process</label></td>
                <td><label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label></td>
                <td><label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label></td>
              <tr>
                <td><label>Fund of Knowledge</label></td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td><label>Associations</label></td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
              </tr>

              <tr>
                <td><label>Judgment</label></td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    Speech
                  </label>
                </td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
              </tr>
              <tr>
                <td><label>Recent Memory</label></td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>

                  </label>
                </td>
                <td>
                  <label>

                  </label>
                </td>
                <td>
                  <label>

                  </label>
                </td>
              </tr>
              <tr>
                <td><label>Recent Memory</label></td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </label>
                </td>
                <td>
                  <label>

                  </label>
                </td>
                <td>
                  <label>

                  </label>
                </td>
                <td>
                  <label>

                  </label>
                </td>
              </tr>
              </tr>
              <!-- ./2nd row -->
            </tbody>
          </table>

        </div>
        <div class="top-part">
          <label>G. Suicidal/Homicidal Risk: </label>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">Absent
            </label>
          </div>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">Present, Describe:
            </label>
          </div>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">Ideation
            </label>
          </div>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">Plan
            </label>
          </div>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">Intent
            </label>
          </div>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">Attempt
            </label>
          </div>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">Other
            </label>
          </div>
          <div class="pt-3">
            <p>If Present Explain:____________________________________________________________ </p>
          </div>
        </div>
        <div class="top-part">
          <label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Other Pertinent Findings (e.g. blood sugar,
                other
                medical) and Lab Work Reviewed:
              </label>
            </div>
          </label>
          <div>
            <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>
          </div>
        </div>
        <div class="top-part">
          <label>H.
          </label>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">Prescription(s) Written
            </label>
          </div>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">None Prescribed Today
            </label>
          </div>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">Prescribed, No Changes
            </label>
          </div>
          <div class="form-check-inline ">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">Prescribed, New/Change
            </label>
          </div>
        </div>
        <div class="top-part">
          <h5 class="title">List of Medications:</h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>Medication</label></td>
                <td><label>Dosage</label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label></label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label></label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label></label></td>
              </tr>

              <tr>
                <td><label></label></td>
                <td><label></label></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td colspan="3"><label>Explained rationale, risks/benefits, side effects, & treatment alternatives to
                    Client/guardian
                    (if new and/or changed medication)?</label>
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
                <td colspan="3"><label>For Female Client of Childbearing Age:</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Risk/Benefits of Meds and Pregnancy
                      Discussed
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Not applicable
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Client
                    </label>
                  </div>

                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Understands Information
                    </label>
                  </div>

                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Does Not Understand Information
                    </label>
                  </div>

                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Agrees w/Medication
                    </label>
                  </div>

                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Refuses medication
                    </label>
                  </div>

                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Reports Compliance
                    </label>
                  </div>

                </td>

              </tr>
              <tr>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Client
                    </label>
                  </div>

                </td>
                <td>

                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Understands Information
                    </label>
                  </div>
                </td>
                <td>

                  <div class="form-check-inline ">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Does not Understand Information
                    </label>
                  </div>
                </td>
                <td>

                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Agrees w/medication
                    </label>
                  </div>
                </td>
                <td>

                  <div class="form-check-inline ">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Refuses Medication
                    </label>
                  </div>
                </td>
                <td>

                  <div class="form-check-inline ">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Reports Compliance
                    </label>
                  </div>
                </td>

              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <label>
            <div class="form-check-inline">
              <label class="form-check-label">
                I.
                <input type="checkbox" class="form-check-input" name="yn">Counseling and Coordination of Care
                (Describe):
              </label>
            </div>
          </label>
          <div class="pb-4">
            <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>
          </div>
          <div>
            <label>Time Spent in Counseling and Coordination of Care: ____________________</label>
          </div>
          <div class="pb-4 pt-4">
            <label>
              J. Labs/other Work Up Ordered:
            </label>
            <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>
          </div>
          <div class="pb-4">
            <label>
              K. DSM-5 Diagnosis:
            </label>
            <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>
          </div>
          <div class="pb-4">
            <label>
              L. Plan/ Follow-up:
            </label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">No
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Yes
              </label>
            </div>
            <div class="form-check-inline">
              <label>
                in
                <input type="text" placeholder="Enter Here...">Weeks/ <input type="text"
                  placeholder="Enter Here...">Months
              </label>
            </div>
          </div>
        </div>
        <div class="top-part d-flex justify-content-between">
          <label>Psychiatrist Signature/Credentials: <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a> </label>
          <label>Date: <input type="date"></label>
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
