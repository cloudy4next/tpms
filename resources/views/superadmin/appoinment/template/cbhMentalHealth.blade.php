<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <title>Mental Health Advance Directive</title>
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
          <h1>Mental Health Advance Directive</h1>
        </div>
        <div class="top-part">
          <div>
            <p>If you believe you will be hospitalized for mental health care in the future and that your doctor may
              think you aren’t able to make good decisions about your treatment, then completing a mental health advance
              directive will ensure that your treatment choices are known. It is important that you decide NOW, what
              types of treatment you do or do not want and to appoint a friend or family member to make the mental
              health care decisions that you want carried out. You may always change your preferences or surrogate
              later. </p>
            <p>You can use the following Advance Directive form to direct your future care.</p>
            <ul>
              <li> Reach each section of the form carefully and talk about your choices with someone you trust.</li>
              <li> The person you choose to be your health care surrogate and alternate must be a competent adult
                whose civil rights have not been taken away. The person you choose should not be a mental health
                professional, an employee of a facility that might provide services to you, an employee of the
                Department of Children and Family Services or a member of the Local Advocacy Council. </li>
              <li> You should sign the form in front two witnesses. </li>
              <li> Make sure your surrogate understands your wishes and is willing to accept the responsibility. Your
                surrogate (and a back-up alternate surrogate if you wish) should sign this form now or at a later time
                to show they are aware you have chosen them to be your surrogate.</li>
              <li> Have copies made and give them to your surrogate, your case manager, your doctor, the hospital or
                crisis unit at which you are most likely to be treated, your family and anyone else who might be
                involved in your care. Discuss your choices with each of them. </li>
              <li>The document should be readily available if you need it. If you travel, be sure to take a copy with
              <li>The document should be readily available if you need it. If you travel, be sure to take a copy with
                you. </li>
            </ul>
          </div>
          <div class="mt-3">
            <p> Your advance directive will not take effect unless a physician decides that you are not competent to
              make
              your own treatment decisions. If you are in a psychiatric facility, you will have an attorney appointed to
              represent your interests and a hearing in front of a judge or a hearing master. A health care surrogate is
              not authorized to consent to treatment for a person.</p>
          </div>
          <div class=" mt-3">
            <textarea class="form-control border border-dark" placeholder="Enter Here..."></textarea>
          </div>
          <div class=" mt-5">
            <p>I, ___________________________________________being of sound mind, willfully and voluntarily execute this
              mental health advance directive assure that if I should found unable to consent to my own mental health
              treatment, my choices regarding my treatment will be carried out despite my inability to make informed
              decisions for myself. </p>
            <p>If a guardian, guardian advocate, or other decision maker is appointed by a court to make health care
              or mental health decisions for me, I intend to use this document to take precedence over all other means
              of determining my intent while competent. This document represents my wishes, and it should be given to
              the greatest possible legal weight and respect. If the surrogate(s) named in this directive are not
              available, my wishes shall be binding on whosoever is appointed to make such decisions. </p>
            <p>If I become unable to make decisions about my own mental health treatment, I have authorized a mental
              health care surrogate to make certain treatment decisions for me. </p>
          </div>
          <div class="mt-3">
            <label>My mental health care surrogate is:</label>
          </div>
          <div class="mt-3 ">
            <label>Name: ________________________________________________________</label>
            <label class="d-block mt-4">Address: ________________________________________________________</label>
            <div class="d-flex justify-content-between">
              <label class="d-block mt-4">Day Telephone:
                __________________________</label>
              <label class="d-block mt-4">Evening Telephone:
                __________________________</label>
            </div>
          </div>
        </div>

        <div class="top-part">
          <label>Complete the following or initial in the blank marked yes or no:</label>
          <div>
            A. If I become unable to give consent to mental health treatment, I give my mental health care surrogate
            full power and authority to make mental health care decisions for me. This includes the right to consent,
            refuse consent, or withdraw consent to any mental health care, treatment, service or procedure consistent
            with any instructions and/or limitations I have stated in this advance directive. If I have not expressed
            a choice in this advance directive, I authorize my surrogate to make the decision that (s)he determines is
            the decision I would make If I were competent to do so. <div class="form-check-inline">
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
          <div class="mt-4">
            <label> B. My choices of treatment facilities are as follows: </label>
            <p>1. In the event my psychiatric condition is serious enough to require 24-hour care, I would prefer to
              receive this care in this/these facilities:</p>
            <div class="d-flex justify-content-around mb-4 mt-4">
              <div>
                Facility: ___________________________
              </div>
              <div>
                Facility: ___________________________
              </div>
            </div>
            <p>1. In the event my psychiatric condition is serious enough to require 24-hour care, I would prefer to
              receive this care in this/these facilities:</p>
            <div class="d-flex justify-content-around mb-4 mt-4">
              <div>
                Facility: ___________________________
              </div>
              <div>
                Facility:___________________________
              </div>
            </div>
            <label> C. My choice of a treating physician is:</label>
            <div class="d-flex justify-content-around mb-4 mt-4">
              <div>
                1st choice of physician: ___________________________
              </div>
              <div>
                2nd choice of physician: ___________________________
              </div>
            </div>
            <p> I do not wish to be treated by the following physicians (optional): </p>
            <div class="d-flex justify-content-around mb-4 mt-4">
              <div>
                Name of physician: ___________________________
              </div>
              <div>
                Name of physician: ___________________________
              </div>
            </div>
            <label> D. My wishes about confidentiality of my admission to a facility and my treatment while there
              are:</label>
            <div>
              1. My representative may be notified of my involuntary admission
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
            <div>
              2. Any person who seeks to contact me while I am in a facility may be told I am there
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
            <div>
              3. I consent to release of information about my condition and treatment plan
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
              <label> To the following persons: </label>
              <div class="p-2">
                1. <input type="text" placeholder="Enter..">
                2. <input type="text" placeholder="Enter..">
              </div>
              <div class="p-2">
                3. <input type="text" placeholder="Enter..">
                4. <input type="text" placeholder="Enter..">
              </div>
            </div>





          </div>
          <div>
            <p>4. If I am unable to give consent, I want staff to immediately notify the following persons that I have
              been admitted to a psychiatric facility. </p>

            <div class="mt-4 d-flex justify-content-between">
              <div>
                <label>Name: ______________________</label>
              </div>
              <div>
                <label>Relationship: ______________________</label>
              </div>
            </div>
            <div class="mt-4 ">
              <div>
                <label>Address: ______________________</label>
              </div>
            </div>
            <div class="mt-4 d-flex justify-content-between">
              <div>
                <label>Day Telephone: ______________________</label>
              </div>
              <div>
                <label>Evening Telephone: ______________________</label>
              </div>
            </div>
            <div class="mt-4 d-flex justify-content-between">
              <div>
                <label>Name: ______________________</label>
              </div>
              <div>
                <label>Relationship: ______________________</label>
              </div>
            </div>
            <div class="mt-4 ">
              <div>
                <label>Address: ______________________</label>
              </div>
            </div>
            <div class="mt-4 d-flex justify-content-between">
              <div>
                <label>Day Telephone: ______________________</label>
              </div>
              <div>
                <label>Evening Telephone: ______________________</label>
              </div>
            </div>
          </div>
        </div>
        <div class="top-part">
          <label>E. If I am not able to consent to my own treatment or to refuse medications relating to my mental
            health treatment, I have initialed one of the following, which represents my wishes: </label>
          <div>
            <p class="mt-4"> 1. _______ I consent to the medications that Dr. ______________________________ recommends.
            </p>
            <p class="mt-4"> 2. _______ I consent to the medications agreed to by my mental health care surrogate
              after consulting with my treating physician and any other individuals my surrogate deems appropriate,
              with the exceptions found in #3 below. </p>
            <p class="mt-4"> 3. _______ I specifically do not consent and I do not authorize my mental health care
              surrogate to consent to the administration of the following medications or their respective brand name,
              trade name, or generic equivalents: (list names of drugs and reason for refusal) </p>
            <p class="mt-4"> 4. _______ I am willing to take the medications excluded in #3 above if my only reason for
              excluding them is their side effects and the dosage can be adjusted to eliminate those side effects.</p>
            <p class="mt-4"> 5. _______ I have the following other preferences about psychiatric medications: .
              <textarea class="form-control" placeholder="Enter Here..."></textarea>

            </p>
          </div>
        </div>
        <div class="top-part">
          <label>F. Florida law prohibits a mental health care surrogate from consenting to experimental treatments that
            have not been approved by a federally approved institutional review board without my prior written consent
            or the expressed </label>
          <div>
            <p class="mt-3">consent to my participation in experimental drug studies or drug trials.
              <div class="ml-5">approval of the court.</div>
            </p>
            <p class="mt-4 ml-5"> _______ I _______ I do not wish to participate in experimental drug studies or drug
              trials.
            </p>
          </div>
        </div>
        <div class="top-part">
          <label>G. My wishes regarding Electroconvulsive Therapy (ECT) are as follows: </label>
          <div>
            <p class="mt-3"> 1. _______ My surrogate may not consent to ECT without expressed court approval.

            </p>
            <p class="mt-4"> 2. _______ I authorize my surrogate to consent to ECT, but only (initial one of the
              following):
            </p>
            <p class="mt-4 ml-5"> a. _______ with the number of treatments the attending psychiatrist thinks is
              appropriate; OR
            </p>
            <p class="mt-4 ml-5"> b. _______ with the number of treatments that Dr. ___________________ thinks is
              appropriate; OR
            </p>
            <p class="mt-4 ml-5"> c. _______ for no more than the following number ECT treatments:
              _______________________
            </p>
            <p class="mt-4 "> 3. Other instructions and wishes regarding ECT are as follows:
              <textarea class="form-control border border-dark" placeholder="Enter Here..."></textarea>

            </p>
          </div>
        </div>
        <div class="top-part">
          <label>H. I _______ have/_______ have not attached a personal safety preference form, previously known as a
            de-escalation preference form, regarding my preferences to this advance directive. </label>
        </div>
        <div class="top-part">
          <label>I. Other instructions I wish to make about my mental health care are (use additional pages, if needed):
          </label>
          <textarea class="form-control border border-dark" placeholder="Enter Here..."></textarea>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="yn">(check here if other pages are used)
            </label>
          </div>
        </div>
        <div class="top-part">
          <h5 class="title text-center">Signature</h5>
          <p>By signing here, I indicate that I fully understand that this advance directive will permit my mental
            health care surrogate to make decisions and to provide, withhold or withdraw consent for my mental health
            treatment. </p>
          <p>Printed Name (Declarant): ___________________________</p>
          <div class="d-flex justify-content-between">
            <p>Signature: ___________________________</p>
            <p>Date: ___________________________</p>
          </div>
        </div>
        <div class="top-part">
          <h5 class="title text-center">Witnesses</h5>
          <p>This advance directive was signed by _________________ in our presence. At his/her
            request, we have signed our names below as witnesses. We declare that, at the time this advance directive
            was signed, the Declarant, according to our best knowledge and belief, was of sound mind and under no
            constraint or undue influence. We further declare that we are both adults, are not designated in this
            advance directive as the mental health care surrogate, and at least one of us is neither person’s spouse nor
            blood relative. </p>
          <p>Dated at ______________(county and state) This ______ day of ___________________(month),
            ________ (Year).</p>
        </div>
        <div class="top-part">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr class="text-center">
                <td><label>Witness 1</label></td>
                <td><label>Witness 2</label></td>
              </tr>
              <tr>
                <td><label>Signature of Witness 1: ________ </label></td>
                <td><label>Signature of Witness 1: ________ </label></td>
              </tr>
              <tr>
                <td><label>Printed name of witness 1: ________ </label></td>
                <td><label>Printed name of witness 1: ________ </label></td>
              </tr>
              <tr>
                <td><label>Home address of witness 1: ________ </label></td>
                <td><label>Home address of witness 2: ________ </label></td>
              </tr>
              <tr>
                <td><label>City, State, Zip Code of Witness 1:
                  </label><textarea class="form-control" placeholder="Enter Here..."></textarea></td>
                <td><label>City, State, Zip Code of Witness 2:
                  </label><textarea class="form-control" placeholder="Enter Here..."></textarea></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="top-part">
          <h5 class="title text-center">Acknowledgement of Health Care Surrogate/Alternate</h5>
          <p>I, ____________________________________, mental health care surrogate designated by
            _________________________________, hereby accept the designation. </p>
          <div class="mt-5 d-flex justify-content-between">
            <label>
              Signature of Mental Health Care Surrogate: <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
            </label>
            <label>Date: _____________</label>
          </div>
        </div>
        <div class="top-part pt-5">

          <p>I, ____________________________ _, alternate mental health care surrogate designated by
            _____________________________, here by accept the designation. </p>
          <div class="mt-5 d-flex justify-content-between">
            <label>
              Signature of Alternate Mental Health Care Surrogate: <a href="#" data-target="#signatureModal" data-toggle="modal">Add Signature<i class="fa fa-signature"></i></a>
            </label>
            <label>Date: _____________</label>
          </div>
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
