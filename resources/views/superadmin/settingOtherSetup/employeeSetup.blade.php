@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu">
                    @include('superadmin.include.settingMenu')
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('superadmin.setting.employee.setup')}}">Credential
                                Setup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.setting.hrnotetype')}}">HR Note Type Setup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.setting.employee.position')}}">Employee
                                Position</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.setting.game.goal')}}">Employee Goals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.setting.game.goal.copay')}}">Copy Employee
                                Goal</a>
                        </li>
                    </ul>
                    <div class="d-inline-block mb-2">
                        <label>Select Credential Type</label>
                        <select class="form-control form-control-sm">
                            <option></option>
                            <option>Behavior Analyst</option>
                            <option>Office Staff</option>
                            <option>Paraprofessional</option>
                        </select>
                    </div>
                    <!-- Credentials -->
                    <div class="row mb-2">
                        <div class="col-md-4 align-self-center">
                            <label>All Credentials</label>
                            <select class="form-control-sm form-control" multiple="">
                                <option>BCABA</option>
                                <option>LMFT</option>
                                <option>Clinical Psychologist</option>
                                <option>LCSW</option>
                                <option>LEP</option>
                                <option>CPR Training</option>
                                <option>Contract 1</option>
                                <option>Contract 2</option>
                                <option>Contracted Provider</option>
                                <option>BAC</option>
                                <option>CPI</option>
                                <option>Annual Eval</option>
                                <option>First Aid</option>
                                <option>Crisis Prevention/Intervention</option>
                                <option>Pro-Act training</option>
                                <option>BCaBA</option>
                                <option>Family Care Safety Registry</option>
                                <option>BLS</option>
                                <option>Blood Born Pathogens</option>
                                <option>Sexual Harassment</option>
                                <option>HIPAA</option>
                                <option>Mandated Reporting</option>
                                <option>Incident Report Training</option>
                                <option>Sensitive Services</option>
                                <option>8-Hour Supervisor Training</option>
                                <option>Hawaii BCBA license</option>
                                <option>LBA certification</option>
                                <option>Short Term Disability</option>
                                <option>IRA</option>
                                <option>Health Insurance Eligibility</option>
                                <option>HIV / Aids Certificate</option>
                                <option>BCBA-D</option>
                                <option>Car Registration</option>
                                <option>Digital Signature Form</option>
                                <option>RBT</option>
                                <option>SLP</option>
                                <option>LMHC</option>
                                <option>Emergency Training</option>
                                <option>OSHA</option>
                                <option>Child/ Dependent Abuse</option>
                                <option>Ethics</option>
                                <option>Domestic Violence</option>
                                <option>CPR Refresher</option>
                                <option>Safety Care Training</option>
                                <option>Counselor</option>
                                <option>Advance Directives</option>
                                <option>Appeals and Grievances</option>
                                <option>Basic Medication</option>
                                <option>Cultural Awareness</option>
                                <option>Culture of Gentleness</option>
                                <option>Environmental Emergencies/Fire Safety</option>
                                <option>Ethics of Touch</option>
                                <option>Hearing Sensitivity</option>
                                <option>Integrated Health</option>
                                <option>Mental Health Ambassador</option>
                                <option>Person Centered Planning</option>
                                <option>Recipient Rights Class</option>
                                <option>Corporate/Regulatory Compliance</option>
                                <option>TB Screening Form</option>
                                <option>Trauma Informed Care</option>
                                <option>Credentialing Packet</option>
                                <option>Resume</option>
                                <option>DDD Training</option>
                                <option>12 hours PD - DDD</option>
                            </select>
                        </div>
                        <div class="col-md-4 align-self-center text-center">
                            <button type="button" class="btn btn-sm btn-primary">Add &gt;&gt;</button>
                            <div>
                                <button type="button" class="btn btn-sm btn-danger mt-2">
                                    &lt;&lt; Remove
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 align-self-center">
                            <label>Facility Selected Credentials</label>
                            <select class="form-control-sm form-control" multiple="">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <!-- Clearance -->
                    <div class="row mb-2">
                        <div class="col-md-4 align-self-center">
                            <label>All Clearance</label>
                            <select class="form-control-sm form-control" multiple="">
                                <option>TB Clearance</option>
                                <option>DOJ Clearance</option>
                                <option>FBI Clearance</option>
                                <option>Finger Printing</option>
                                <option>DMV records report</option>
                                <option>MMR</option>
                                <option>Tdap</option>
                                <option>Hep B</option>
                                <option>Varicella</option>
                                <option>90 Day Probation</option>
                                <option>NSO Registry</option>
                                <option>Abuser Registry</option>
                                <option>FBI Clearance to Local Background</option>
                                <option>L2 Results</option>
                                <option>Local Background</option>
                                <option>Tricare Background</option>
                                <option>ICHAT</option>
                                <option>Central Registry Clearance</option>
                                <option>MDOC</option>
                                <option>NSO</option>
                                <option>OIG</option>
                                <option>Professional License</option>
                                <option>Professional License Verification</option>
                                <option>Recipient Rights Background Check</option>
                                <option>Reference Check</option>
                                <option>SAM</option>
                                <option>TB Test</option>
                                <option>Letter: Does not reside</option>
                                <option>APS</option>
                                <option>CPS</option>
                                <option>KBI</option>
                                <option>Nurse Registry</option>
                                <option>Zero tolerance</option>
                                <option>DDD Clearances</option>
                            </select>
                        </div>
                        <div class="col-md-4 align-self-center text-center">
                            <button type="button" class="btn btn-sm btn-primary">Add &gt;&gt;</button>
                            <div>
                                <button type="button" class="btn btn-sm btn-danger mt-2">
                                    &lt;&lt; Remove
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 align-self-center">
                            <label>Facility Selected Clearance</label>
                            <select class="form-control-sm form-control" multiple="">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <!-- Qualifications -->
                    <div class="row">
                        <div class="col-md-4 align-self-center">
                            <label>All Qualifications</label>
                            <select class="form-control-sm form-control" multiple="">
                                <option>Ph.D</option>
                                <option>Associate Degree</option>
                                <option>Highschool Diploma</option>
                                <option>Psy.D</option>
                                <option>G.E.D</option>
                                <option>COBA</option>
                                <option>Transcripts</option>
                                <option>Certificates</option>
                            </select>
                        </div>
                        <div class="col-md-4 align-self-center text-center">
                            <button type="button" class="btn btn-sm btn-primary">Add &gt;&gt;</button>
                            <div>
                                <button type="button" class="btn btn-sm btn-danger mt-2">
                                    &lt;&lt; Remove
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 align-self-center">
                            <label>Facility Selected Qualifications</label>
                            <select class="form-control-sm form-control" multiple="">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
