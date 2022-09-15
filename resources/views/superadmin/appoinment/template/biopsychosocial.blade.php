<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biopsychosocial</title>
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard//') }}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/template/tem24/') }}/css/custom-24.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
        .logo_img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="treatment-plan">
        <div class="content">
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
            <form action="" method="POST" id="form_24">
                @csrf

                <div class="page-title mb_40">
                    <h1>Biopsychosocial</h1>
                </div>
                <div class="content">
                    <section class="section_1">
                        <div class="box box1">
                            <h3>Presenting Problem<br>
                                <span class="bracket">(Why are they here? In client's own words when possible. Please
                                    include
                                    current behavior/ past 30 days of client’s behavior)</span>
                            </h3>
                            <textarea rows="5" name="presentprob"></textarea>
                            <input type="hidden" name="sessionid" class="session_id" value="{{ $session_id }}">

                        </div>
                        <div class="box box2">
                            <h3>History:<br>
                                <span class="bracket">(Early symptoms and past diagnosis; describe the onset of
                                    symptoms)</span>
                            </h3>
                            <textarea rows="5" name="history"></textarea>
                        </div>
                        <div class="box box3">
                            <h3>Risk of Harm:<br>
                                <span class="bracket">(high risks behaviors i.e. SI/HI, Impulse Control, Substance Use,
                                    Sexual
                                    behavior /Perpetrator)</span>
                            </h3>
                            <textarea rows="5" name="riskharm"></textarea>
                        </div>
                        <div class="box box4">
                            <h3>Trauma:<br>
                                <span class="bracket">(i.e. sexual abuse, physical abuse, etc)</span>
                            </h3>
                            <textarea rows="5" name="trauma"></textarea>
                        </div>
                        <div class="box box6">
                            <h3>Comorbidities:</h3>
                            <textarea rows="5" name="comorbid"></textarea>
                        </div>
                        <div class="box box7">
                            <h3>Environmental Stressors:<br>
                                <span class="bracket">(i.e. gang activity, poverty, etc)</span>
                            </h3>
                            <textarea rows="5" name="environ"></textarea>
                        </div>
                        <div class="box box8">
                            <h3>Deficits in Support System:<br>
                                <span class="bracket">(i.e. single parent household)</span>
                            </h3>
                            <textarea rows="5" name="defictsupport"></textarea>
                        </div>
                        <div class="box box9">
                            <h3>Transportation:</h3>
                            <textarea rows="5" name="transportation"></textarea>
                        </div>
                        <div class="box box10">
                            <h3>What service(s) is the client requesting?<br>
                                <span class="bracket">(What do you want to get out of the services?)</span>
                            </h3>
                            <textarea rows="5" name="clientrequest"></textarea>
                        </div>
                    </section>
                    <section class="section_2">
                        <div class="inner-main-title">
                            <h4>Lifespan/Developmental History</h4>
                        </div>
                        <div class="box box1">
                            <h3>What is the client’s prenatal history?:</h3>
                            <textarea rows="5" name="prenatal"></textarea>
                        </div>
                        <div class="box box2">
                            <h3>Health at birth:</h3>
                            <textarea rows="5" name="health"></textarea>
                        </div>
                        <div class="box box3">
                            <h3>Developmental milestones:</h3>
                            <textarea rows="5" name="devmile"></textarea>
                        </div>
                        <div class="box box4">
                            <h3>Special services received during lifetime:</h3>
                            <textarea rows="5" name="specialserv"></textarea>
                        </div>
                        <div class="box box5">
                            <h3>Other lifespan/developmental issues: <br>
                                <span class="bracket">(Include mid-life, senior/elder, other issues)</span>
                            </h3>
                            <textarea rows="5" name="otherlife"></textarea>
                        </div>
                    </section>
                    <section class="section_3">
                        <div class="inner-main-title">
                            <h4>Education Assessment:</h4>
                        </div>
                        <div class="box box1 flex-div">
                            <div class="col-item">
                                <h3>School currently attending:</h3>
                                <input type="text" name="attending">
                            </div>
                            <div class="col-item">
                                <h3>Grade:</h3>
                                <input type="text" name="grade">
                            </div>
                        </div>
                        <div class="box box2">
                            <h3>Has the client ever been suspended or expelled from school and/or bus?: <br>
                                <span class="bracket">(Include both in-school suspensions and out-of-school suspensions)
                                    If so,
                                    include the number of times, dates of suspension and duration of suspension.</span>
                            </h3>
                            <textarea rows="5" name="expell"></textarea>
                        </div>
                        <div class="box box3">
                            <div class="col-item mb_30">
                                <h3>Does the client have frequent absences?: <br>
                                    <span class="bracket">(Include the number of times consumer has been
                                        absent).</span>
                                </h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="yes" type="radio" name="absences" value="1">
                                            <label for="yes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="no" type="radio" name="absences" value="2">
                                            <label for="no">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item mb_30">
                                <h3>Is the client currently failing, and has the client ever been retained?: <br>
                                </h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="ryes" type="radio" name="retained" value="1">
                                            <label for="ryes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="rno" type="radio" name="retained" value="2">
                                            <label for="rno">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item mb_30">
                                <h3>Is the client in special education classes?:</h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="eyes" type="radio" name="classes" value="1">
                                            <label for="eyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="eno" type="radio" name="classes" value="2">
                                            <label for="eno">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_4">
                        <div class="inner-main-title">
                            <h4>Family of Origin History</h4>
                        </div>
                        <div class="box box1">
                            <h3>Family's current and past psychiatric history: </h3>
                            <textarea rows="5" name="pastpsy"></textarea>
                        </div>
                        <div class="box box2">
                            <h3>Family's and client's physical/sexual/emotional abuse history:</h3>
                            <textarea rows="5" name="physical"></textarea>
                        </div>
                        <div class="box box3">
                            <h3>Family's substance use/abuse history:</h3>
                            <textarea rows="5" name="substance"></textarea>
                        </div>
                        <div class="box box4">
                            <h3>Families Presentation of the Problem:</h3>
                            <textarea rows="5" name="present"></textarea>
                        </div>
                        <div class="box box5">
                            <h3>Families Expected Outcome for Services:</h3>
                            <textarea rows="5" name="outcome"></textarea>
                        </div>
                        <div class="box box6">
                            <h3>Client's Current and Significant Past Supports:<br>
                                <span class="bracket">(Social supports, family supports, significant relationships,
                                    religious
                                    and spiritual supports/affiliations.)</span>
                            </h3>
                            <textarea rows="5" name="pastsupport"></textarea>
                        </div>
                        <div class="box box7">
                            <h3>Other Providers/Systems involved with:<br>
                                <span class="bracket">(List agencies client is involved with or receiving services
                                    from.
                                    For
                                    example: CalWORKs, ASOC, Inpatient/outpatient hospitalization, Rehab centers, etc;
                                    Include
                                    the name of the
                                    agency and primary contact person)</span>
                            </h3>
                            <textarea rows="5" name="otherprovider"></textarea>
                        </div>
                        <div class="box box8">
                            <div class="col-item ">
                                <h3>Client's Legal History:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="iprob" type="checkbox" name="lhistinfo" value="1">
                                            <label for="iprob">Informal
                                                Probation</label>
                                        </li>
                                        <li>
                                            <input id="cws" type="checkbox" name="lhistwel" value="1">
                                            <label for="cws">Child
                                                Welfare
                                                Services</label>
                                        </li>
                                        <li>
                                            <input id="rs-order" type="checkbox" name="lhistrestrain"
                                                value="1"> <label for="rs-order">Restraining Order</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="fprob" type="checkbox" name="lhistformal" value="1">
                                            <label for="fprob">Formal
                                                Probation</label>
                                        </li>
                                        <li>
                                            <input id="conservatorship" type="checkbox" name="lhistconserv"
                                                value="1"> <label for="conservatorship">Conservatorship</label>
                                        </li>
                                        <li>
                                            <input id="non-report" type="checkbox" name="lhistnone" value="1">
                                            <label for="non-report">None reported</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="parole" type="checkbox" name="lhistparole" value="1">
                                            <label for="parole">Parole</label>
                                        </li>
                                        <li>
                                            <input id="dui" type="checkbox" name="lhistdui" value="1">
                                            <label for="dui">D. U.
                                                I.</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box9">
                            <span class="bracket">(Describe and, if currently involved, give name of probation officer,
                                parole
                                office, or case manager and estimated start and end dates.)</span></h3>
                            <textarea rows="5" name="probationoff"></textarea>
                        </div>
                        <div class="box box10">
                            <div class="col-item ">
                                <h3>Client's Substance Use: <br>
                                    <span class="bracket">(Alcohol and other drugs, check all that apply.)</span>
                                </h3>
                                <div class="select-area mtb_10">
                                    <ul>
                                        <li>
                                            <input id="substanceyes" type="radio" name="ssubstance"
                                                value="1"> <label for="substanceyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="substanceno" type="radio" name="ssubstance" value="2">
                                            <label for="substanceno">No</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="caffeine" type="checkbox" name="caffeine" value="1">
                                            <label for="caffeine">Caffeine</label>
                                        </li>
                                        <li>
                                            <input id="p-medicine" type="checkbox" name="prescr" value="1">
                                            <label for="p-medicine">Prescription Medication</label>
                                        </li>
                                        <li>
                                            <input id="hallucinogens" type="checkbox" name="halluc" value="1">
                                            <label for="hallucinogens">Hallucinogens</label>
                                        </li>
                                        <li>
                                            <input id="sedatives" type="checkbox" name="sdativ" value="1">
                                            <label for="sedatives">Sedatives</label>
                                        </li>
                                        <li>
                                            <input id="barbituates" type="checkbox" name="barbit" value="1">
                                            <label for="barbituates">Barbituates</label>
                                        </li>
                                        <li>
                                            <input id="methadone" type="checkbox" name="methad" value="1">
                                            <label for="methadone">Methadone</label>
                                        </li>
                                        <li>
                                            <input id="other" type="checkbox" name="subother" value="1">
                                            <label for="other">Other</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="tobacco" type="checkbox" name="tobacco" value="1">
                                            <label for="tobacco">Tobacco</label>
                                        </li>
                                        <li>
                                            <input id="alcohol" type="checkbox" name="alcohol" value="1">
                                            <label for="alcohol">Alcohol</label>
                                        </li>
                                        <li>
                                            <input id="marijuana" type="checkbox" name="mariju" value="1">
                                            <label for="marijuana">Marijuana</label>
                                        </li>
                                        <li>
                                            <input id="tranqulizers" type="checkbox" name="tranqu" value="1">
                                            <label for="tranqulizers">Tranqulizers</label>
                                        </li>
                                        <li>
                                            <input id="methamphetamines" type="checkbox" name="metham"
                                                value="1"> <label for="methamphetamines">Methamphetamines</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="Over-the-counter" type="checkbox" name="overcount"
                                                value="1"> <label for="Over-the-counter">Over-the-counter
                                                Medication</label>
                                        </li>
                                        <li>
                                            <input id="inhalants" type="checkbox" name="inhalant" value="1">
                                            <label for="inhalants">Inhalants</label>
                                        </li>
                                        <li>
                                            <input id="stimulants" type="checkbox" name="stimul" value="1">
                                            <label for="stimulants">Stimulants</label>
                                        </li>
                                        <li>
                                            <input id="cocaine" type="checkbox" name="cocain" value="1">
                                            <label for="cocaine">Cocaine</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box11">
                            <h3>Client's history of withdrawal, DTs, blackouts (loss of time), seizures, etc. If
                                applicable.
                            </h3>
                            <textarea rows="5" name="withdrawal"></textarea>
                        </div>
                        <div class="box box12">
                            <h3>Ask and record the response to, "What happens when you stop using?":</h3>
                            <textarea rows="5" name="askandrecord"></textarea>
                        </div>
                        <div class="box box13">
                            <h3>What is the longest period of sobriety?:</h3>
                            <textarea rows="5" name="sobriety"></textarea>
                        </div>
                        <div class="box box14">
                            <h3>When?:</h3>
                            <textarea rows="5" name="whensobriety"></textarea>
                        </div>
                    </section>
                    <section class="section_5">
                        <div class="inner-main-title">
                            <h1>Mental Health Services History</h1>
                        </div>
                        <div class="box-main-title">
                            <h2>Mental Status Exam</h2>
                        </div>
                        <div class="box box1 flex-div mb_0">
                            <div class="col-item ">
                                <h3>Appearance:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="unremarkable" type="checkbox" name="unremark" value="1">
                                            <label for="unremarkable">Unremarkable</label>
                                        </li>
                                        <li>
                                            <input id="unkempt" type="checkbox" name="unkempt" value="1">
                                            <label for="unkempt">Unkempt</label>
                                        </li>
                                        <li>
                                            <input id="atclothing" type="checkbox" name="atypical" value="1">
                                            <label for="atclothing">Atypical Clothing</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item ">
                                <h3>Orientation:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="person" type="checkbox" name="person" value="1">
                                            <label for="person">Person</label>
                                        </li>
                                        <li>
                                            <input id="place" type="checkbox" name="place" value="1">
                                            <label for="place">Place</label>
                                        </li>
                                        <li>
                                            <input id="odate" type="checkbox" name="oridate" value="1">
                                            <label for="odate">Date</label>
                                        </li>
                                        <li>
                                            <input id="situation" type="checkbox" name="situation" value="1">
                                            <label for="situation">Situation</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item ">
                                <h3>Insight:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="poor" type="checkbox" name="insightpoor" value="1">
                                            <label for="poor">Poor</label>
                                        </li>
                                        <li>
                                            <input id="average" type="checkbox" name="insightaverage"
                                                value="1"> <label for="average">Average</label>
                                        </li>
                                        <li>
                                            <input id="good" type="checkbox" name="insightgood" value="1">
                                            <label for="good">Good</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item ">
                                <h3>Judgment:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="jpoor" type="checkbox" name="judgpoor" value="1">
                                            <label for="jpoor">Poor</label>
                                        </li>
                                        <li>
                                            <input id="javerage" type="checkbox" name="judgaver" value="1">
                                            <label for="javerage">Average</label>
                                        </li>
                                        <li>
                                            <input id="jgood" type="checkbox" name="judggood" value="1">
                                            <label for="jgood">Good</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box2">
                            <h3>Comments:</h3>
                            <textarea rows="5" name="judgecomment"></textarea>
                        </div>
                    </section>
                    <section class="section_6">
                        <div class="box box3">
                            <div class="col-item ">
                                <h3>Motor Activity:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="unremarkable" type="checkbox" name="motorun" value="1">
                                            <label for="unremarkable">Unremarkable</label>
                                        </li>
                                        <li>
                                            <input id="restless" type="checkbox" name="motorrest" value="1">
                                            <label for="restless">Restless</label>
                                        </li>
                                        <li>
                                            <input id="withdrawn" type="checkbox" name="motorwith" value="1">
                                            <label for="withdrawn">Withdrawn</label>
                                        </li>
                                        <li>
                                            <input id="s-speech" type="checkbox" name="motorslurr" value="1">
                                            <label for="s-speech">Slurred Speech</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_7 mb_30">
                        <div class="box-main-title">
                            <h2>Biological Functions:</h2>
                        </div>
                        <div class="select-area">
                            <ul>
                                <li>
                                    <input id="limits" type="checkbox" name="limit" value="1"> <label
                                        for="limits">All within normal
                                        limits</label>
                                </li>
                            </ul>
                        </div>
                        <div class="box box1">
                            <h3>Sleep Pattern:</h3>
                            <textarea rows="5" name="sleeppat"></textarea>
                        </div>
                        <div class="box box2">
                            <h3>Appetite:</h3>
                            <textarea rows="5" name="appetite"></textarea>
                        </div>
                        <div class="box box3">
                            <h3>Comments:</h3>
                            <textarea rows="5" name="acomment"></textarea>
                        </div>
                    </section>
                    <section class="section_8">
                        <div class="box box1">
                            <div class="col-item ">
                                <h3>Affect:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="affeft1" type="checkbox" name="affun" value="1">
                                            <label for="affeft1">Unremarkable</label>
                                        </li>
                                        <li>
                                            <input id="affeft2" type="checkbox" name="affcrit" value="1">
                                            <label for="affeft2">Self
                                                Critical</label>
                                        </li>
                                        <li>
                                            <input id="affeft3" type="checkbox" name="affflat" value="1">
                                            <label for="affeft3">Flat</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="affeft4" type="checkbox" name="affangr" value="1">
                                            <label for="affeft4">Angry</label>
                                        </li>
                                        <li>
                                            <input id="affeft5" type="checkbox" name="affeuph" value="1">
                                            <label for="affeft5">Euphoric</label>
                                        </li>
                                        <li>
                                            <input id="affeft6" type="checkbox" name="affsilly" value="1">
                                            <label for="affeft6">Silly</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="affeft7" type="checkbox" name="affirri" value="1">
                                            <label for="affeft7">Irritable</label>
                                        </li>
                                        <li>
                                            <input id="affeft8" type="checkbox" name="affdepr" value="1">
                                            <label for="affeft8">Depressed</label>
                                        </li>
                                        <li>
                                            <input id="affeft9" type="checkbox" name="affhope" value="1">
                                            <label for="affeft9">Hopelessness</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box2">
                            <div class="col-item ">
                                <h3>Depressive-Like Behavior:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="d-like1" type="checkbox" name="depnone" value="1">
                                            <label for="d-like1">None</label>
                                        </li>
                                        <li>
                                            <input id="d-like2" type="checkbox" name="dephypo" value="1">
                                            <label for="d-like2">Hypoactive</label>
                                        </li>
                                        <li>
                                            <input id="d-like3" type="checkbox" name="depfati" value="1">
                                            <label for="d-like3">Fatigue</label>
                                        </li>
                                        <li>
                                            <input id="d-like4" type="checkbox" name="depfee" value="1">
                                            <label for="d-like4">Feelings
                                                of Worthlessness</label>
                                        </li>
                                        <li>
                                            <input id="d-like5" type="checkbox" name="depguilt" value="1">
                                            <label for="d-like5">Guilt
                                                Feelings</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="d-like6" type="checkbox" name="dephelpless" value="1">
                                            <label for="d-like6">Feelings
                                                of Helpless/Hopeless</label>
                                        </li>
                                        <li>
                                            <input id="d-like7" type="checkbox" name="depirrit" value="1">
                                            <label for="d-like7">Irritability</label>
                                        </li>
                                        <li>
                                            <input id="d-like8" type="checkbox" name="deppoor" value="1">
                                            <label for="d-like8">Poor
                                                Concentration</label>
                                        </li>
                                        <li>
                                            <input id="d-like9" type="checkbox" name="depsadn" value="1">
                                            <label for="d-like9">Sadness</label>
                                        </li>
                                        <li>
                                            <input id="d-like10" type="checkbox" name="depsexual" value="1">
                                            <label for="d-like10">Change
                                                in Sexaul Interest</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="d-like11" type="checkbox" name="deploss" value="1">
                                            <label for="d-like11">Loss
                                                of Ability to Enjoy (Anhedonia)</label>
                                        </li>
                                        <li>
                                            <input id="d-like12" type="checkbox" name="depwithdraw" value="1">
                                            <label for="d-like12">Withdrawn</label>
                                        </li>
                                        <li>
                                            <input id="d-like13" type="checkbox" name="depself" value="1">
                                            <label for="d-like13">Self-Blame/Self-Criticism</label>
                                        </li>
                                        <li>
                                            <input id="d-like14" type="checkbox" name="depinter" value="1">
                                            <label for="d-like14">Loss
                                                of Interest</label>
                                        </li>
                                        <li>
                                            <input id="d-like15" type="checkbox" name="depcry" value="1">
                                            <label for="d-like15">Crying</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box3">
                            <h3>Comments:</h3>
                            <textarea rows="5" name="deprcomm"></textarea>
                        </div>
                        <div class="box box4">
                            <div class="col-item ">
                                <h3>Thinking:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="think-1" type="checkbox" name="thinun" value="1">
                                            <label for="think-1">Unremarkable</label>
                                        </li>
                                        <li>
                                            <input id="think-2" type="checkbox" name="thindiss" value="1">
                                            <label for="think-2">Distracted</label>
                                        </li>
                                        <li>
                                            <input id="think-3" type="checkbox" name="thindel" value="1">
                                            <label for="think-3">Delusions</label>
                                        </li>
                                        <li>
                                            <input id="think-4" type="checkbox" name="thinhyp" value="1">
                                            <label for="think-4">Hypochondriasis</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="think-5" type="checkbox" name="thindis" value="1">
                                            <label for="think-5">Disorganized</label>
                                        </li>
                                        <li>
                                            <input id="think-6" type="checkbox" name="thinsus" value="1">
                                            <label for="think-6">Suspicious</label>
                                        </li>
                                        <li>
                                            <input id="think-7" type="checkbox" name="thinobs" value="1">
                                            <label for="think-7">Obsessions</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="think-8" type="checkbox" name="thinfli" value="1">
                                            <label for="think-8">Flight of
                                                Ideas</label>
                                        </li>
                                        <li>
                                            <input id="think-9" type="checkbox" name="thinconf" value="1">
                                            <label for="think-9">Confused</label>
                                        </li>
                                        <li>
                                            <input id="think-10" type="checkbox" name="thingrand" value="1">
                                            <label for="think-10">Delusions Obsessions Grandiosity</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box5">
                            <h3>Comments:</h3>
                            <textarea rows="5" name="thinkcomm"></textarea>
                        </div>
                        <div class="box box6">
                            <div class="col-item ">
                                <h3>Attitude:</h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="att-1" type="checkbox" name="attun" value="1">
                                            <label for="att-1">Unremarkable</label>
                                        </li>
                                        <li>
                                            <input id="att-2" type="checkbox" name="attego" value="1">
                                            <label for="att-2">Egocentric</label>
                                        </li>
                                        <li>
                                            <input id="att-3" type="checkbox" name="attsar" value="1">
                                            <label for="att-3">Sarcastic</label>
                                        </li>
                                        <li>
                                            <input id="att-4" type="checkbox" name="attres" value="1">
                                            <label for="att-4">Resistant</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="att-5" type="checkbox" name="attcont" value="1">
                                            <label for="att-5">Controlling</label>
                                        </li>
                                        <li>
                                            <input id="att-6" type="checkbox" name="atthost" value="1">
                                            <label for="att-6">Hostile</label>
                                        </li>
                                        <li>
                                            <input id="att-7" type="checkbox" name="attneg" value="1">
                                            <label for="att-7">Negativistic</label>
                                        </li>
                                        <li>
                                            <input id="att-8" type="checkbox" name="attpass" value="1">
                                            <label for="att-8">Passive</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="att-9" type="checkbox" name="attaggr" value="1">
                                            <label for="att-9">Passive-Aggressive</label>
                                        </li>
                                        <li>
                                            <input id="att-10" type="checkbox" name="attsedu" value="1">
                                            <label for="att-10">Seductive</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box7">
                            <h3>Comments:</h3>
                            <textarea rows="5" name="attitudecomm"></textarea>
                        </div>
                        <div class="box box8">
                            <h3>Medical History/Information:</h3>
                            <textarea rows="5" name="medhistory"></textarea>
                        </div>
                        <div class="box box9">
                            <h3>Medical Conditions:<br>
                                <span class="bracket">(List significant past and present medical conditions, including
                                    allergies, recent lab results, etc .)</span>
                            </h3>
                            <textarea rows="5" name="medcond"></textarea>
                        </div>
                    </section>
                    <section class="section_9">
                        <div class="box box1">
                            <div class="flex-div">
                                <div class="col-item">
                                    <h3>Primary Care Physician's Contact Information:</h3>
                                    <textarea rows="1" name="contactinfo"></textarea>
                                </div>
                                <div class="col-item">
                                    <h3>Date of last physical examinations:</h3>
                                    <input type="date" name="lastdate">
                                </div>
                            </div>
                        </div>
                        <div class="box box2">
                            <div class="col-item mb_30">
                                <h3>Current with immunizations?: <br>
                                </h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="imyes" type="radio" name="immunizations"
                                                value="1"> <label for="imyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="imno" type="radio" name="immunizations"
                                                value="2"> <label for="imno">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box3">
                            <div class="flex-div">
                                <div class="col-item">
                                    <h3>Consumer’s Height:</h3>
                                    <input type="text" name="height">
                                </div>
                                <div class="col-item">
                                    <h3>Consumer’s Weight:</h3>
                                    <input type="text" name="weight">
                                </div>
                            </div>
                        </div>
                        <div class="box box4">
                            <div class="col-item mb_30">
                                <h3>Consumer Satisfied with Current Weight?: <br>
                                </h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="satisfiedna" type="radio" name="satisfied" value="1">
                                            <label for="satisfiedna">N/A</label>
                                        </li>
                                        <li>
                                        <li>
                                            <input id="satisfiedyes" type="radio" name="satisfied" value="2">
                                            <label for="satisfiedyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="satisfiedno" type="radio" name="satisfied" value="3">
                                            <label for="satisfiedno">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item mb_30">
                                <h3>Ever Diagnosed with an Eating Disorder?:
                                </h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="diagnosedna" type="radio" name="diagnosed" value="1">
                                            <label for="diagnosedna">N/A</label>
                                        </li>
                                        <li>
                                            <input id="diagnosedyes" type="radio" name="diagnosed" value="2">
                                            <label for="diagnosedyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="diagnosedno" type="radio" name="diagnosed" value="3">
                                            <label for="diagnosedno">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-item mb_30">
                                <h3>Consumer Need a Referral for a Nutritional Assessment?:</h3>
                                <div class="select-area">
                                    <ul>
                                        <li>
                                            <input id="referralna" type="radio" name="referral" value="1">
                                            <label for="referralna">N/A</label>
                                        </li>
                                        <li>
                                            <input id="referralyes" type="radio" name="referral" value="2">
                                            <label for="referralyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="referralno" type="radio" name="referral" value="3">
                                            <label for="referralno">No</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_10">
                        <div class="inner-main-title">
                            <h1>Medication History</h1>
                        </div>
                        <div class="wrap-flex-div">
                            <div class="srno">
                                <h2>1</h2>
                            </div>
                            <div class="box box1">
                                <div class="flex-div mb_30">
                                    <div class="col-item ">
                                        <h3>Medication Name</h3>
                                        <input type="text" name="med">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Dosage/ Frequency</h3>
                                        <input type="text" name="dosage">
                                    </div>
                                </div>
                                <div class="flex-div mb_30">
                                    <div class="col-item">
                                        <h3>Effective</h3>
                                        <input type="text" name="effect">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Compliance</h3>
                                        <input type="text" name="compli">
                                    </div>
                                </div>
                                <div class="full mb_30">
                                    <div class="col-item">
                                        <h3>Prescribed By</h3>
                                        <input type="text" name="prescrr">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-flex-div">
                            <div class="srno">
                                <h2>2</h2>
                            </div>
                            <div class="box box1">
                                <div class="flex-div mb_30">
                                    <div class="col-item ">
                                        <h3>Medication Name</h3>
                                        <input type="text" name="medname">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Dosage/ Frequency</h3>
                                        <input type="text" name="dosefreq">
                                    </div>
                                </div>
                                <div class="flex-div mb_30">
                                    <div class="col-item">
                                        <h3>Effective</h3>
                                        <input type="text" name="effective">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Compliance</h3>
                                        <input type="text" name="compl">
                                    </div>
                                </div>
                                <div class="full mb_30">
                                    <div class="col-item">
                                        <h3>Prescribed By</h3>
                                        <input type="text" name="presby">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-flex-div">
                            <div class="srno">
                                <h2>3</h2>
                            </div>
                            <div class="box box1">
                                <div class="flex-div mb_30">
                                    <div class="col-item ">
                                        <h3>Medication Name</h3>
                                        <input type="text" name="med3">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Dosage/ Frequency</h3>
                                        <input type="text" name="freq3">
                                    </div>
                                </div>
                                <div class="flex-div mb_30">
                                    <div class="col-item">
                                        <h3>Effective</h3>
                                        <input type="text" name="effect3">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Compliance</h3>
                                        <input type="text" name="compl3">
                                    </div>
                                </div>
                                <div class="full mb_30">
                                    <div class="col-item">
                                        <h3>Prescribed By</h3>
                                        <input type="text" name="pres3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-flex-div">
                            <div class="srno">
                                <h2>4</h2>
                            </div>
                            <div class="box box1">
                                <div class="flex-div mb_30">
                                    <div class="col-item ">
                                        <h3>Medication Name</h3>
                                        <input type="text" name="med4">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Dosage/ Frequency</h3>
                                        <input type="text" name="freq4">
                                    </div>
                                </div>
                                <div class="flex-div mb_30">
                                    <div class="col-item">
                                        <h3>Effective</h3>
                                        <input type="text" name="effect4">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Compliance</h3>
                                        <input type="text" name="compl4">
                                    </div>
                                </div>
                                <div class="full mb_30">
                                    <div class="col-item">
                                        <h3>Prescribed By</h3>
                                        <input type="text" name="pres4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-flex-div">
                            <div class="srno">
                                <h2>5</h2>
                            </div>
                            <div class="box box1">
                                <div class="flex-div mb_30">
                                    <div class="col-item ">
                                        <h3>Medication Name</h3>
                                        <input type="text" name="med5">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Dosage/ Frequency</h3>
                                        <input type="text" name="freq5">
                                    </div>
                                </div>
                                <div class="flex-div mb_30">
                                    <div class="col-item">
                                        <h3>Effective</h3>
                                        <input type="text" name="effect5">
                                    </div>
                                    <div class="col-item ">
                                        <h3>Compliance</h3>
                                        <input type="text" name="compl5">
                                    </div>
                                </div>
                                <div class="full mb_30">
                                    <div class="col-item">
                                        <h3>Prescribed By</h3>
                                        <input type="text" name="pres5">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_11">
                        <div class="box box1">
                            <h3>Daily Living Skills :<br>
                                <span class="bracket">(Personal Care, Laundry, Cleaning)</span>
                            </h3>
                            <textarea rows="5" name="dailyliving"></textarea>
                        </div>
                        <div class="box box2">
                            <h3>Daily Living Skills :<br>
                                <span class="bracket">(List All Tasks that consumer is able to
                                    complete/Strengths)</span>
                            </h3>
                            <textarea rows="5" name="alltask"></textarea>
                        </div>
                        <div class="box box3">
                            <div class="col-item mb_30">
                                <h3>Does client require assistive technology?<br>
                                </h3>
                                <div class="select-area mtb_10">
                                    <ul>
                                        <li>
                                            <input id="technologyes" type="radio" name="technology"
                                                value="1"> <label for="technologyes">Yes</label>
                                        </li>
                                        <li>
                                            <input id="technologno" type="radio" name="technology" value="2">
                                            <label for="technologno">No</label>
                                        </li>
                                    </ul>
                                </div>
                                <span class="bracket">(If yes, specify what is needed.)</span>
                                <textarea rows="5" name="assisrequire"></textarea>
                            </div>
                        </div>
                        <div class="box box5">
                            <h3>Relationship Analysis:<br>
                                <span class="bracket">(Consumer's relationship status, gender identity, etc.)</span>
                            </h3>
                            <textarea rows="5" name="relationana"></textarea>
                        </div>
                    </section>
                    <section class="section_12">
                        <div class="inner-main-title">
                            <h1>Current Symptoms/Problems <br><span class="bracket">Rate severity and duration for
                                    each:</span>
                            </h1>
                        </div>
                        <div class="box box1">
                            <table cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Severity</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Anxiety</td>
                                        <td><input type="text" name="anxtxt"></td>
                                        <td><input type="time" name="anxtime"></td>
                                    </tr>
                                    <tr>
                                        <td>Panic Attacks</td>
                                        <td><input type="text" name="pantxt"></td>
                                        <td><input type="time" name="pantime"></td>
                                    </tr>
                                    <tr>
                                        <td>Phobia Compulsive</td>
                                        <td><input type="text" name="photxt"></td>
                                        <td><input type="time" name="photime"></td>
                                    </tr>
                                    <tr>
                                        <td>Obessive</td>
                                        <td><input type="text" name="obesstxt"></td>
                                        <td><input type="time" name="obesstime"></td>
                                    </tr>
                                    <tr>
                                        <td>Somatization</td>
                                        <td><input type="text" name="somatxt"></td>
                                        <td><input type="time" name="somatime"></td>
                                    </tr>
                                    <tr>
                                        <td>Depression</td>
                                        <td><input type="text" name="deprtxt"></td>
                                        <td><input type="time" name="deprtime"></td>
                                    </tr>
                                    <tr>
                                        <td>Impaired Memory</td>
                                        <td><input type="text" name="impatxt"></td>
                                        <td><input type="time" name="impatime"></td>
                                    </tr>
                                    <tr>
                                        <td>Poor Self Care Skills</td>
                                        <td><input type="text" name="poortxt"></td>
                                        <td><input type="time" name="poortime"></td>
                                    </tr>
                                    <tr>
                                        <td>Loss of Interest</td>
                                        <td><input type="text" name="inttxt"></td>
                                        <td><input type="time" name="inttime"></td>
                                    </tr>
                                    <tr>
                                        <td>Sexual Dysfunction</td>
                                        <td><input type="text" name="dystxt"></td>
                                        <td><input type="time" name="dystime"></td>
                                    </tr>
                                    <tr>
                                        <td>Weight Change</td>
                                        <td><input type="text" name="weighttxt"></td>
                                        <td><input type="time" name="weighttime"></td>
                                    </tr>
                                    <tr>
                                        <td>Bizarre Ideation</td>
                                        <td><input type="text" name="bizarrtxt"></td>
                                        <td><input type="time" name="bizarrtime"></td>
                                    </tr>
                                    <tr>
                                        <td>Bizarre Behavior</td>
                                        <td><input type="text" name="bbtxt"></td>
                                        <td><input type="time" name="bbtime"></td>
                                    </tr>
                                    <tr>
                                        <td>Paranoid Ideation</td>
                                        <td><input type="text" name="pitxt"></td>
                                        <td><input type="time" name="pitime"></td>
                                    </tr>
                                    <tr>
                                        <td>Poor Judgment</td>
                                        <td><input type="text" name="pjtxt"></td>
                                        <td><input type="time" name="pjtime"></td>
                                    </tr>
                                    <tr>
                                        <td>Poor Interpersonal Skills</td>
                                        <td><input type="text" name="pistxt"></td>
                                        <td><input type="time" name="pistime"></td>
                                    </tr>
                                    <tr>
                                        <td>Conduct Problems</td>
                                        <td><input type="text" name="cptxt"></td>
                                        <td><input type="time" name="cptime"></td>
                                    </tr>
                                    <tr>
                                        <td>School Problems</td>
                                        <td><input type="text" name="sptxt"></td>
                                        <td><input type="time" name="sptime"></td>
                                    </tr>
                                    <tr>
                                        <td>Family Problems</td>
                                        <td><input type="text" name="fptxt"></td>
                                        <td><input type="time" name="fptime"></td>
                                    </tr>
                                    <tr>
                                        <td>Indep Living Problems</td>
                                        <td><input type="text" name="indetxt"></td>
                                        <td><input type="time" name="indetime"></td>
                                    </tr>
                                    <tr>
                                        <td class="other">Other <input type="text" name="othr"></td>
                                        <td><input type="text" name="othtxt"></td>
                                        <td><input type="time" name="othtime"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <section class="section_13">
                        <div class="box box1">
                            <h3>Briefly describe identified Symptoms:</h3>
                            <textarea rows="5" value="idensymp"></textarea>
                        </div>
                        <div class="box box2">
                            <h3>Summary of Consumer's SNAPS</h3>
                            <textarea rows="5" name="summarycons"></textarea>
                        </div>
                        <div class="box box3">
                            <h3>(Consumer's Goals/Hopes for the Future)</h3>
                            <textarea rows="5" name="cghfuture"></textarea>
                        </div>
                        <div class="box box4">
                            <h3>What things do you like about yourself?:</h3>
                            <textarea rows="5" name="likeyour"></textarea>
                        </div>
                        <div class="box box5">
                            <h3>What things would you like to improve about your behaviors/symptoms & how?</h3>
                            <textarea rows="5" name="likeimprove"></textarea>
                        </div>
                        <div class="box box6">
                            <h3>What accomplishments are you most proud of in your personal life?:</h3>
                            <textarea rows="5" name="proudlife"></textarea>
                        </div>
                        <div class="box box7">
                            <h3>Consumer's and family's expectations from participating in this program?:</h3>
                            <textarea rows="5" name="expectpart"></textarea>
                        </div>
                    </section>
                    <section class="section_14">
                        <div class="inner-main-title">
                            <h4>Summary of consumer's SNAPS <br>
                                <span class="bracket">(Strengths, Needs, Abilities and Preferences)</span>
                            </h4>
                        </div>
                        <div class="box box1">
                            <h3>Strengths:</h3>
                            <textarea rows="5" name="strength"></textarea>
                        </div>
                        <div class="box box2">
                            <h3>Needs:</h3>
                            <textarea rows="5" name="needs"></textarea>
                        </div>
                        <div class="box box3">
                            <h3>Abilities:</h3>
                            <textarea rows="5" name="abilities"></textarea>
                        </div>
                        <div class="box box4">
                            <h3>Preferences:</h3>
                            <textarea rows="5" name="prefer"></textarea>
                        </div>
                        <div class="box box5">
                            <h3>Problems List:</h3>
                            <textarea rows="5" name="problemlist"></textarea>
                        </div>
                    </section>
                    <section class="section_15">
                        <div class="inner-main-title">
                            <h4>Clinical Summary<br>
                            </h4>
                        </div>
                        <div class="box box1">
                            <h3>Diagnostic Rationale/Summary of Findings:<br>
                                <span class="bracket">(Strengths, Needs, Abilities and Preferences)</span>
                            </h3>
                            <textarea rows="5" name="diagrational"></textarea>
                        </div>
                        <div class="box box2">
                            <h3>Interpretive Summary:</h3>
                            <textarea rows="5" name="intersumm"></textarea>
                        </div>
                        <div class="box box3">
                            <div class="col-item ">
                                <h3>Recommended Services:<br>
                                    <span class="bracket">(Check all that apply.)</span>
                                </h3>
                                <div class="select-area more-select">
                                    <ul>
                                        <li>
                                            <input id="rservices-1" type="checkbox" name="rscomm"
                                                value="1"> <label for="rservices-1">Community referrals made,
                                                no further services
                                                needed</label>
                                        </li>
                                        <li>
                                            <input id="rservices-2" type="checkbox" name="rsmed"
                                                value="1"> <label for="rservices-2">Medication
                                                assessment</label>
                                        </li>
                                        <li>
                                            <input id="rservices-3" type="checkbox" name="rsind"
                                                value="1"> <label for="rservices-3">Individual therapy</label>
                                        </li>
                                        <li>
                                            <input id="rservices-4" type="checkbox" name="rsfam"
                                                value="1"> <label for="rservices-4">Family therapy</label>
                                        </li>
                                        <li>
                                            <input id="rservices-5" type="checkbox" name="rstesting"
                                                value="1"> <label for="rservices-5">Testing</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="rservices-6" type="checkbox" name="rscare"
                                                value="1"> <label for="rservices-6">By primary care
                                                physician</label>
                                        </li>
                                        <li>
                                            <input id="rservices-7" type="checkbox" name="rsbtl"
                                                value="1"> <label for="rservices-7">Brief therapy
                                                Long-term</label>
                                        </li>
                                        <li>
                                            <input id="rservices-8" type="checkbox" name="rscoll"
                                                value="1"> <label for="rservices-8">Collateral</label>
                                        </li>
                                        <li>
                                            <input id="rservices-9" type="checkbox" name="rsreha"
                                                value="1"> <label for="rservices-9">Day rehab/treatment</label>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <input id="rservices-10" type="checkbox" name="rsasoc"
                                                value="1"> <label for="rservices-10">By ASOC or CSOG
                                                psychiatrist</label>
                                        </li>
                                        <li>
                                            <input id="rservices-11" type="checkbox" name="rsltt"
                                                value="1"> <label for="rservices-11">Long-term therapy</label>
                                        </li>
                                        <li>
                                            <input id="rservices-12" type="checkbox" name="rsgrou"
                                                value="1"> <label for="rservices-12">Group</label>
                                        </li>
                                        <li>
                                            <input id="rservices-13" type="checkbox" name="rsother"
                                                value="1"> <label for="rservices-13">Other</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box box4">
                            <h3>If community referrals were made, please describe:</h3>
                            <textarea rows="5" name="referrall"></textarea>
                        </div>
                        <div class="box box5">
                            <h3>If client was placed on 1013, please give details:<br>
                                <span class="bracket">(IE: Which hospital, how transported, etc.)</span>
                            </h3>
                            <textarea rows="5" name="whichhospital"></textarea>
                        </div>
                        <div class="box box6">
                            <h3>DSM V<br>
                            </h3>
                            <textarea rows="5" name="dsmv"></textarea>
                        </div>
                        <div class="box box7">
                            <h3>Recommendations for Treatment/ Services:<br>
                                <span class="bracket">(Please indicate what services you are recommended and how each
                                    service
                                    can benefit the client)</span>
                            </h3>
                            <textarea rows="5" name="rectreat"></textarea>
                        </div>
                        <div class="box box-8">
                            <h3>Projected date of Discharge/Transition:<br>
                            </h3>
                            <div class="flex-div">
                                <div class="col-item">
                                    <input type="date" name="projectdate">
                                </div>
                            </div>
                        </div>
                        <div class="box box9">
                            <h3>Anticipated Stepdown:<br>
                                <span class="bracket">(Please include specific step-down linkage in client’s area,
                                    frequency, of
                                    attendance, and contact information of services that you will recommend once they
                                    have
                                    successfully
                                    completed services with A.C.E)</span>
                            </h3>
                            <textarea rows="5" name="clarea"></textarea>
                        </div>
                        <div class="box box10">
                            <h3>Discharge Plan:<br>
                                <span class="bracket">(Place all Objectives from the Treatment Plan in this section;
                                    the
                                    steps
                                    the individual has agreed to do to accomplish the goals)</span>
                            </h3>
                            <textarea rows="5" name="dischplan"></textarea>
                        </div>
                    </section>
                </div>
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
                <div class="section_bottom m-0">
                    <div class="button-row flex-div">
                        <div class="save-prog"><button type="submit"><span class="cloud-icon"><i
                                        class="fas fa-cloud"></i></span>
                                Save</button></div>
                        <div class="print"><button type="button" class="pdf_btn"><span class="print-icon"><i
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
                                                <canvas id="sig-canvas" height="120"
                                                    style="width: 100%;"></canvas>
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
            <form class="pdf_form" action="{{ route('superadmin.print.form.24') }}" target="_blank"
                method="POST">
                @csrf
                <input type="hidden" name="session_id" class="session_id" value="{{ $session_id }}">
            </form>
        </div>
    </div>
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
            $(document).on('submit', '#form_24', function(e) {
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
                    url: "{{ route('superadmin.24.form.submit') }}",
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
