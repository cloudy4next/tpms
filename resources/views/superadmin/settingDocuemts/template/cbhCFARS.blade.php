<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>CFARS Form</title>
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
          <h1>CFARS Form</h1>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>Last Name:</label> <input type="text" placeholder="Enter Here..."></td>
                <td><label>First Name:</label> <input type="text" placeholder="Enter Here..."></td>
              </tr>
              <tr>
                <td><label>Social Security #:</label> <input type="text" placeholder="Enter Here..."></td>
                <td><label>Evaluation Date:</label> <input type="date"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>Purpose of Evaluation:<input type="text" placeholder="Enter Here..."></label></td>
              </tr>
              <tr>
                <td><label>1 – Admission/initiation into episode of care</label></td>
                <td><label>4 – Administrative Discharge</label></td>
              </tr>
              <tr>
                <td><label>2 – Six (6) month interval after admission</label></td>
                <td><label>5 – None of the above</label></td>
              </tr>
              <tr>
                <td><label>3 – Discharge from agency</label></td>
                <td><label></label></td>
              </tr>
              <tr>
                <td><label>Rater ID:<input type="text" placeholder="Enter Here..."></label></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td><label>Rater Education / Specialty:<input type="text" placeholder="Enter Here..."></label></td>
              </tr>
              <tr>
                <td><label>01 – Non Degree Trained Technician</label></td>
                <td><label>02 – AA Degree Trained Technician</label></td>
              </tr>
              <tr>
                <td><label>03 – BA/BS – Bachelor’s Degree from an accredited university or college with a major in
                    counseling, social work, psychology, nursing, rehabilitation, special education, health education or
                    related human services field</label></td>
                <td><label>04 – MA/MS – Master’s Degree from an accredited university or college with a major in
                    counseling, social work, psychology, nursing, rehabilitation, special education, health education or
                    related human services field</label>
                </td>
              </tr>
              <tr>
                <td><label>05 – Licensed Practitioner of the Healing Arts MA/MS advanced registered nurse practitioner,
                    physician assistants, clinical social workers, mental health counselors and marriage/family
                    therapist</label>
                </td>
                <td><label>06 – PhD/PsyD/EdD – Licensed Psychologist</label></td>
              </tr>
              <tr>
                <td><label>07 – MD/DO – Board Certified</label></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part ">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr class="text-center">
                <td colspan="3"><label class="title">Respond to following with the appropriate rating for the
                    scale.</label></td>
              </tr>
              <tr>
                <td><label>1 - No Problem</label></td>
                <td><label>4 - Slight to Moderate Problem </label></td>
                <td><label>7 - Severe Problem </label></td>
              </tr>
              <tr>
                <td><label>2 - Less than Slight Problem </label></td>
                <td><label>5 - Moderate Problem</label></td>
                <td><label>8 - Severe/Extreme Problem </label></td>
              </tr>
              <tr>
                <td><label>3 - Slight Problem</label></td>
                <td><label>6 - Moderate /Severe Problem</label></td>
                <td><label>9 - Extreme Problem </label></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>DEPRESSION SCALE</label></td>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>INTERPERSONAL RELATIONSHIP SCALE </label></td>
              </tr>
              <tr>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>ANXIETY SCALE</label></td>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>BEHAVIOR IN HOME SETTING SCALE</label></td>
              </tr>
              <tr>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>HYPERACTIVITY SCALE</label></td>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>ACTIVITIES OF DAILY LIVING (ADL) SCALE</label></td>
              </tr>
              <tr>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>THOUGHT PROCESS SCALE</label></td>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>SOCIAL-LEGAL SCALE</label></td>
              </tr>
              <tr>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>COGNITIVE PERFORMANCE SCALE</label></td>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>WORK / SCHOOL SCALE</label></td>
              </tr>
              <tr>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>MEDICAL/PHYSICAL SCALE</label></td>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>DANGER TO SELF SCALE</label></td>
              </tr>
              <tr>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>TRAUMATIC STRESS SCALE</label></td>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>DANGER TO OTHERS SCALE</label></td>
              </tr>
              <tr>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>SUBSTANCE USE SCALE</label></td>
                <td> <input type="text" placeholder="Enter Here...">
                </td>
                <td><label>SECURITY MANAGEMENT NEEDS</label></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td><label>Signature:</label></td>
                <td><a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
                </td>
                <td><label>Date: <input type="date"> </label> </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0" class="extra">
            <tbody>
              <tr>
                <td><label>Therapist Name:</label></td>
                <td><label> <input type="text" placeholder="Enter Here...">
                  </label>
                </td>
                <td><label>Degree Credentials: <input type="text" placeholder="Enter Here..."></label>
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
