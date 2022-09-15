<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>COMPREHENSIVE DIAGNOSTIC EVALUATION
            PSYCHIATRIC EVALUATION AND MANAGEMENT ASSESSMENT</title>
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
          <h1> COMPREHENSIVE DIAGNOSTIC EVALUATION
            PSYCHIATRIC EVALUATION AND MANAGEMENT ASSESSMENT</h1>
        </div>

        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td colspan="2">
                  <label>Client: <input type="text"></label>
                </td>
                <td>
                  <label>Client MR#: <input type="text"></label>
                </td>
                <td>
                  <label>Age: <input type="text"></label>
                </td>
                <td>
                  <label>Diagnosis: <input type="text"></label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Date: <input type="date"></label>
                </td>
                <td>
                  <label>Dr.: <input type="text"></label>
                </td>
                <td>
                  <label>Billing Code: <input type="text"></label>
                </td>
                <td>
                  <label>Time In: <input type="time"></label>
                </td>
                <td>
                  <label>Time Out: <input type="time"></label>
                </td>
              </tr>


            </tbody>
          </table>
        </div>
        <div class="top-part">
          <div>
            <label> Chief Complaint: </label>
            <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>
          </div>
          <div class="pt-4 pb-4">
            <label> History of Present Illness: </label>
            <span>(Describe location, duration, severity, context, associated signs, quality, modifying factors,
              medications)</span>
            <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>
          </div>
          <h5 class="title">Developmental History: </h5>
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td colspan="2">
                  <label>At what age did the child first do the following? Please indicate approximate month and/or year
                    of age </label>
                </td>
              </tr>
              <tr>
                <td>
                  <input type="text" placeholder="Enter...">
                  <label>Sit alone </label>
                </td>
                <td>
                  <input type="text" placeholder="Enter...">
                  <label>Show interest in or attraction to sounds</label>
                </td>
              </tr>
              <tr>
                <td>
                  <input type="text" placeholder="Enter...">
                  <label>Crawl </label>
                </td>
                <td>
                  <input type="text" placeholder="Enter...">
                  <label>Speak first words </label>
                </td>
              </tr>
              <tr>
                <td>
                  <input type="text" placeholder="Enter...">
                  <label>Stand alone </label>
                </td>
                <td>
                  <input type="text" placeholder="Enter...">
                  <label>Speak in sentences </label>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <input type="text" placeholder="Enter...">
                  <label>Stand alone </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <label class="title">Communication</label>
          <div class="mt-4">
            <p>Describe child’ current level of communication ( nonverbal, 1-2-word phrases, complete
              sentences?________________________</p>
            <p>How many words can he/she verbalize?___________________</p>
          </div>
        </div>
        <div class="top-part">
          <h5 class="title">How does the child communicate his/her wants and needs? (check appropriate boxes) </h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td>
                  <label></label>
                </td>
                <td>
                  <label>Sentences </label>
                </td>
                <td>
                  <label>One or two words </label>
                </td>
                <td>
                  <label>Signs </label>
                </td>
                <td>
                  <label>Leading/ Gestures </label>
                </td>
                <td>
                  <label>Voice output device (AAC) </label>
                </td>
                <td>
                  <label>PECS </label>
                </td>
                <td>
                  <label>Inappropriate behavior </label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Request Attention </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Ask for Help </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Request toy/obj </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Request
                    activities </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Refuse/ avoid activity </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Indicate doesn’t want object </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Indicate discomfort </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label></label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
                <td>
                  <label> </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>Can the child label pictures or objects? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label> If yes, how many? <input type="text"></label>
                </td>
              </tr>
              <tr>
                <td><label>Can the child match pictures or objects? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label> If yes, how many? <input type="text"></label>
                </td>
              </tr>
              <tr>
                <td><label>Can the child point to pictures/body parts/objects? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label> If yes, example? <input type="text"></label>
                </td>
              </tr>
              <tr>
                <td><label>Can the child follow 1 step instructions? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label> If yes, example? <input type="text"></label>
                </td>
              </tr>
              <tr>
                <td><label>Can the child imitate movements? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label> If yes, example? <input type="text"></label>
                </td>
              </tr>
              <tr>
                <td><label>Can the child imitate sounds? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label> If yes, example? <input type="text"></label>
                </td>
              </tr>
              <tr>
                <td><label>Can the child fill in words or phrases? </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                </td>
                <td>
                  <label> If yes, example? <input type="text"></label>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Self-care Skills </label>
                  <label>Describe child’s ability to: Dress self </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>

                </td>
                <td>
                  <label> Personal hygiene (wash hands, brush teeth) </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>

                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label class="d-block"> Play/Social Skills </label>
                  <div class="form-check-inline">
                    <label class="form-check-label"> Does the child watch other children?
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">No
                    </label>
                  </div>
                  <div>
                    <div class="form-check-inline">
                      <label class="form-check-label"> Does the child watch other children?
                        <input type="checkbox" class="form-check-input" name="yn">Yes
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">No
                      </label>
                    </div>
                  </div>
                  <div>
                    <div class="form-check-inline">
                      <label class="form-check-label">Does the child engage in appropriate play with other children?
                        <input type="checkbox" class="form-check-input" name="yn">Yes
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">No
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label>Family History: </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label>Social History: </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label>Past psychiatric history (including mental health interventions, prior therapy interventions,
                    medication trials, co-morbid conditions): </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title">
            Problem Behavior
          </h5>
          <table>
            <table cellpadding="0" cellspacing="0" class="extra">
              <tbody>
                <tr>
                  <td><label>Yes</label></td>
                  <td><label>No</label></td>
                  <td><label></label></td>
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
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </td>
                  <td><label>Screaming/crying <input type="text" placeholder="Enter..."> per DAY / WEEK / MONTH </label>
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
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </td>
                  <td><label>Dropping <input type="text" placeholder="Enter..."> per DAY / WEEK / MONTH
                    </label></td>
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
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </td>
                  <td><label>Eloping (running from you) <input type="text" placeholder="Enter..."> per DAY / WEEK /
                      MONTH
                    </label></td>
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
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </td>
                  <td><label> Self-stimulation (flapping, rocking, etc.) <input type="text" placeholder="Enter..."> per
                      DAY / WEEK /
                      MONTH
                    </label></td>
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
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </td>
                  <td><label> Not following directions <input type="text" placeholder="Enter...">
                      per
                      DAY / WEEK /
                      MONTH
                    </label></td>
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
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </td>
                  <td><label> Aggression (hitting, kicking, scratching others) <input type="text"
                        placeholder="Enter...">
                      per
                      DAY / WEEK /
                      MONTH
                    </label></td>
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
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </td>
                  <td><label> Property destruction (throw/break objects) <input type="text" placeholder="Enter...">
                      per
                      DAY / WEEK /
                      MONTH
                    </label></td>
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
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </td>
                  <td><label> Self-injury (hitting/biting self) <input type="text" placeholder="Enter...">
                      per
                      DAY / WEEK /
                      MONTH
                    </label></td>
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
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">
                      </label>
                    </div>
                  </td>
                  <td><label> Other <input type="text" placeholder="Enter...">
                      per
                      DAY / WEEK /
                      MONTH
                    </label>
                    <label class="d-block">Describe</label>
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>

                  </td>


                </tr>
              </tbody>
            </table>
          </table>

        </div>
        <div class="top-part">
          <h5 class="title">
            Review of Systems (ROS)
          </h5>
          <div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">ROS reviewed and no pertinent new information
              </label>
            </div>
          </div>
          <div class="pt-4 pb-3">
            <p class="title text-primary"> Check here if pertinent at this visit: </p>

            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Eyes
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Respiratory
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Ears/Nose/Throat
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Cardiovascular
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Gastrointestinal
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Genitourinary
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Hematologic/Lymph
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Skin
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Neurological
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Endocrine
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Male or Female Only
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Allergies
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="yn">Musculoskeletal
              </label>
            </div>
          </div>

          <label> Describe details of ROS findings: </label>
          <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>

        </div>


        <div class="top-part">
          <h5 class="title"> EXAMINATION SECTION</h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td><label>Ht</label> <input type="text" placeholder="Enter...."></td>
                <td><label>Wt</label> <input type="text" placeholder="Enter...."></td>
                <td><label>BP</label> <input type="text" placeholder="Enter...."></td>
              </tr>
              <tr>
                <td class="title text-center" colspan="3"><label>Constitutional </label></td>
              </tr>
              <tr>
                <td><label> General Appearance: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">WNL
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Abnormal
                    </label>
                  </div>
                </td>
                <td colspan="2">
                  <label> If abnormal, describe: <input type="text" placeholder="Enter..."></label>
                </td>
              </tr>
              <tr>
                <td colspan="3"><label> Vital Signs: </label>
                  <label> If areas of concern in vital signs, describe:
                  </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label class="d-block">Mental Status Exam: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">Speech
                      <input type="checkbox" class="form-check-input" name="yn">Abnormal
                    </label>
                  </div>
                </td>
                <td colspan="2">
                  <label>Describe any abnormalities: </label>
                  <input type="text" placeholder="Enter...">
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <label>Thought Processes: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Abnormal
                    </label>
                  </div>
                  <label class="d-block">Abnormalities:</label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Loose
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Tangential
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Circumstantial
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Hallucinations
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Delusions
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Obsessions
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="3"><label>If other abnormalities, or hallucinations/delusions/obsession, describe:</label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Suicidal Ideation: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Absent
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Present
                    </label>
                  </div>
                </td>
                <td colspan="2">
                  <label>Homicidal Ideation: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Absent
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Present
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Violent Ideation: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Absent
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Present
                    </label>
                  </div>
                </td>
                <td colspan="2"> <label>If present, describe </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Judgment: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Good
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Fair
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Poor
                    </label>
                  </div>
                </td>
                <td>
                  <label>Insight: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Good
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Fair
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Poor
                    </label>
                  </div>
                </td>
                <td><label> If Judgment and/or Insight is poor, describe: </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <label>Orientation: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">X 3
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="yn">Impaired
                    </label>
                  </div>
                  <label> If impaired, describe: </label>
                  <textarea class="form-control" placeholder="Enter Here..."></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="top-part">
          <h5 class="title">
            MENTAL HISTORY
          </h5>
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td colspan="2"><label> General Observations</label></td>
              </tr>
              <tr>
                <td><label>Appearance</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">WNL
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Well Groomed
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Unkept
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Disheveled
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Appears younger than age
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Appears older than age
                    </label>
                  </div>
                  <div>
                    <label> Comment/ Other: </label>
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>

                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Build/Stature</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">WNL
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Thin
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Overweight
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Short
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Tall
                    </label>
                  </div>

                  <div>
                    <label> Comment/ Other: </label>
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>

                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Posture</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">WNL
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Slumped
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Rigid
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Tense
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Atypical
                    </label>
                  </div>

                  <div>
                    <label> Comment/ Other: </label>
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>

                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Eye Contact</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Average
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Avoidant
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Intense
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Intermittent
                    </label>
                  </div>
                  <div>
                    <label> Comment/ Other: </label>
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Activity</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">WNL
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Accelerated
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Slowed
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Stereotyped/Peculiar
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Impulsive
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Agitated
                    </label>
                  </div>

                  <div>
                    <label> Comment/ Other: </label>
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Attitude Toward Examiner</label></td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Cooperative
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Hostile
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Defensive
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Manipulative
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Seductive
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Mistrustful
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Demanding
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Anxious
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Ingratiating
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Confused
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Evasive
                    </label>
                  </div>

                  <div>
                    <label> Comment/ Other: </label>
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label>Attitude Towards Parent/Guardian: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Not Applicable
                    </label>
                  </div>
                  <div class="d-block mt-3">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Positive Interaction
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Ignores Parents
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Disrespectful
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Demanding
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Immature
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Lack of Spontaneity
                      </label>
                    </div>
                    <div>
                      <label> Comment/ Other: </label>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label>Separation (for Children/Adolescent) </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Not Applicable
                    </label>
                  </div>
                  <div class="d-block mt-3">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Unremarkable/age appropriate
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Clingy to parent/guardian, but
                        separates
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Cannot separate
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Disinhibited/does not care
                      </label>
                    </div>
                    <div>
                      <label> Comment/ Other: </label>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label>Mood </label>

                  <div class="d-block mt-3">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Euthymic
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Depressed
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Anxious
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Angry
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Euphoric
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Irritable
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Silly
                      </label>
                    </div>
                    <div>
                      <label> Comment/ Other: </label>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label>Affect </label>

                  <div class="d-block mt-3">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Full
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Constricted
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Flat
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Inappropriate
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Labile
                      </label>
                    </div>
                    <div>
                      <label> Comment/ Other: </label>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label>Speech: </label>
                  <div class="d-block mt-3">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Clear
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Loud
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Slurred
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Rapid
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Pressured
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Overproductive
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Underproductive
                      </label>
                    </div>
                    <div>
                      <label> Comment/ Other: </label>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label>Thought Process: </label>
                  <div class="d-block mt-3">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Logical
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Circumstantial
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Tangential
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Loose
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Racing
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Incoherent
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Concrete
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Blocked
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Flight of Ideas
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Poverty of Content
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Slowed Thinking
                      </label>
                    </div>
                    <div>
                      <label> Comment/ Other: </label>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label>Perception: </label>
                  <div class="d-block mt-3">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">WNL
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Illusions
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Depersonalization
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Derealization
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Re-experiencing
                      </label>
                    </div>
                    <div class="d-block mt-3"><label>
                        Hallucinations:
                      </label></div>
                    <div class="form-check-inline ">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Auditory
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Command
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Visual
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Olfactory
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Tactile
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Gustatory
                      </label>
                    </div>
                    <div>
                      <label> Comment/ Other: </label>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label>Thought Content: </label>
                  <div class="d-block mt-3">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">WNL
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Preoccupations/
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Obsessional
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Depressive
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Paranoid
                      </label>
                    </div>

                    <div class="form-check-inline ">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Self-Deprecatory
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Grandiose
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Phobic
                      </label>
                    </div>

                    <div>
                      <label> Comment/ Other: </label>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label>Delusions: </label>
                  <div class="d-block mt-3">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">None reported
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Control
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Thought Withdrawal
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Thought Insertion
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Thought Broadcasting
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Erotic
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Persecution
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Reference
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Grandeur
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Somatic
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Religious
                      </label>
                    </div>
                    <div>
                      <label> Comment/ Other: </label>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="">
                    <label>Risk Assessment: </label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">None Reported or Observed OR Danger
                        To:
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Erotic
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Persecution
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Reference
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Grandeur
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Somatic
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Religious
                      </label>
                    </div>
                  </div>
                  <div class="mt-3">
                    <label>Self: </label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Ideation
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Plan
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Intent
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Attempt
                      </label>
                    </div>
                  </div>
                  <div class="mt-3">
                    <label>Others: </label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Ideation
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Plan
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Intent
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Attempt
                      </label>
                    </div>
                    <div>
                      <label> Comment: </label>
                      <textarea class="form-control" placeholder="Enter Here..."></textarea>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="">
                    <label>Cognition: </label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">WNL OR Check all that apply below:
                      </label>
                    </div>
                    <label class="d-block">Impairment of : </label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Orientation
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Memory
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Attention/Concentration
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Ability to Abstract
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn"> Fund of Knowledge
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Visuospatial Ability
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Reading and Writing
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Calculation Ability
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="">
                    <label>Intelligence Estimate: </label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">MR
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Borderline
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Average
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Above Average
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="">
                    <label>Insight: </label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">WNL
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Mostly blames others for
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Difficulty acknowledging presence of
                        psychiatric problems
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="">
                    <label>Judgment: </label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">WNL
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">Impaired ability to make reasonable decisions:
                        <input type="checkbox" class="form-check-input" name="yn">Mild
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Moderate
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Severe
                      </label>
                    </div>
                  </div>
                </td>
              </tr>

              <tr>
                <td colspan="2">
                  <div class="">
                    <label>Elaboration on Positive Mental Status Findings: </label>
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="">
                    <label>Summary of Recommendations: </label>
                    <textarea class="form-control" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <label>Prescription(s) Written: </label>
                  <div class="">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">None Prescribed Today
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Prescribed, no changes
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="yn">Prescribed, new/change – see below/see
                        medication list
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td><label>Past Medications </label></td>
                <td><label>Dosage </label></td>
                <td><label>Purpose </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td><label>Current Medications </label></td>
                <td><label>Dosage </label></td>
                <td><label>Purpose </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td><label>New/Added Medications</label></td>
                <td><label>Dosage </label></td>
                <td><label>Purpose </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td><label></label></td>
                <td><label> </label></td>
                <td><label> </label></td>
              </tr>
              <tr>
                <td colspan="3">
                  <div>
                    <label>Diagnostic Impression: </label>
                    <textarea class="form-control border border-primary" placeholder="Enter Here..."></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <label>Follow- Up: </label>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="yn">No
                    </label>
                    <label class="ml-3"> in______ Weeks/ ______ months</label>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"> <label>Psychiatrist Signature/Credentials:</label>
                 <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                  <label>NPI#</label>
                </td>
                <td><label>Date:</label>
                  <input type="date">
                </td>
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
