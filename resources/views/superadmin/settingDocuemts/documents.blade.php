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
                    <h5>Statements</h5>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="slogo">
                        <label class="form-check-label" for="slogo">
                            Show Logo
                        </label>
                    </div>
                    <div class="mb-2">
                        <label>Footer Information:</label>
                        <textarea rows="3" class="form-control form-control-sm" style="max-width: 400px;"></textarea>
                    </div>
                    <p>This is the default email message for Statements: <a href="#" class="text-primary">Customize this email</a></p>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th>From:</th>
                                <td>info@laurenhermann.org</td>
                            </tr>
                            <tr>
                                <th>Subject:</th>
                                <td>Your Statement for 12/30/20-1/6/21</td>
                            </tr>
                            <tr>
                                <th>Message:</th>
                                <td>
                                    <p>Hi Jamie,</p>
                                    <p>Attached please find your statement for the period of 12/30/20 - 1/6/21</p>
                                    <p>Thank you.</p>
                                    <p>Ideal Speech Solutions LLC info@laurenhermann.org (570) 520-0767</p>
                                    <button type="submit" class="btn btn-sm btn-primary">Save statement setting</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <h5>Superbills</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="sig">
                        <label class="form-check-label" for="sig">
                            Include Signature Line
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="diag">
                        <label class="form-check-label" for="diag">
                            Show Diagnosis Description
                        </label>
                    </div>
                    <div class="mb-2">
                        <label>Footer Information:</label>
                        <textarea rows="3" class="form-control form-control-sm" style="max-width: 400px;"></textarea>
                    </div>
                    <p>This is the default email message for Superbills: <a href="#" class="text-primary">Customize this email</a></p>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th>From:</th>
                                <td>info@laurenhermann.org</td>
                            </tr>
                            <tr>
                                <th>Subject:</th>
                                <td>Your Statement for 12/30/20-1/6/21</td>
                            </tr>
                            <tr>
                                <th>Message:</th>
                                <td>
                                    <p>Hi Jamie,</p>
                                    <p>Attached please find your statement for the period of 12/30/20 - 1/6/21</p>
                                    <p>Thank you.</p>
                                    <p>Ideal Speech Solutions LLC info@laurenhermann.org (570) 520-0767</p>
                                    <button type="submit" class="btn btn-sm btn-primary">Save superbill setting</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <h5>Invoices</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="logo">
                        <label class="form-check-label" for="logo">
                            Show Logo
                        </label>
                    </div>
                    <div class="mb-2">
                        <label>Footer Information:</label>
                        <textarea rows="3" class="form-control form-control-sm" style="max-width: 400px;"></textarea>
                    </div>
                    <p>This is the default email message for Superbills: <a href="#" class="text-primary">Customize this email</a></p>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th>From:</th>
                                <td>info@laurenhermann.org</td>
                            </tr>
                            <tr>
                                <th>Subject:</th>
                                <td>Your Statement for 12/30/20-1/6/21</td>
                            </tr>
                            <tr>
                                <th>Message:</th>
                                <td>
                                    <p>Hi Jamie,</p>
                                    <p>Attached please find your statement for the period of 12/30/20 - 1/6/21</p>
                                    <p>Thank you.</p>
                                    <p>Ideal Speech Solutions LLC info@laurenhermann.org (570) 520-0767</p>
                                    <button type="submit" class="btn btn-sm btn-primary">Save invoice setting</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <h5>Documentation</h5>
                    <p>Progress Notes, Assessments, Intake Forms, Consent Documents, Diagnosis and Treatment Plans, Chart Notes, and Administrative Notes.</p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="logo3">
                        <label class="form-check-label" for="logo3">
                            Show Logo
                        </label>
                    </div>
                    <div class="mb-2">
                        <label>Footer Information:</label>
                        <textarea rows="3" class="form-control form-control-sm" style="max-width: 400px;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Save documentation setting</button>
                </div>
            </div>
        </div>
    </div>
@endsection
