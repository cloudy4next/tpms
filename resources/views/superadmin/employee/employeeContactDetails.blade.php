@extends('layouts.superadmin')
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="overflow-hidden mb-2">
                <div class="float-left">
                    <h5><a href="#" class="cmn_a">{{ $employee_name->full_name }}</a> | <small><span
                                class="font-weight-bold text-orange">DOB:</span>
                            {{ $employee_name->staff_birthday != null ? \Carbon\Carbon::parse($employee_name->staff_birthday)->format('m/d/Y') : '' }}
                            | <small><span class="font-weight-bold text-orange">NPI:</span>
                                {{ $employee_name->individual_npi }}|
                                <span class=" font-weight-bold text-orange">Phone:</span> {{ $employee_name->office_phone }}
                            </small></h5>
                </div>
                <div class="float-right">
                    <a href="{{ route('superadmin.employee') }}" class="btn btn-sm btn-primary"><i
                            class="ri-arrow-left-circle-line"></i>Back</a>
                </div>
            </div>
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="all_menu">
                    <ul class="nav flex-column employee_menu">
                        <!-- Profile Picture -->
                        <li class="nav-item border-0 text-center">
                            <div class="profile-pic-div">
                                @if ($employee_name->profile_photo == null)
                                    <img src="{{ asset('assets/dashboard/') }}/images/user/01.jpg " class="img-fluid"
                                        id="photo" alt="aba+">
                                @else
                                    <img class="profile-pic" src="{{ asset($employee_name->profile_photo) }}"
                                        alt="profile-pic" style="height: 100%">
                                @endif
                                <input type="file" id="file" class="d-none" autocomplete="nope">
                                <label for="file" id="uploadBtn">Upload Photo</label>
                            </div>
                        </li>
                        <!--/ Profile Picture -->
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('superadmin.emaployee.biographic', $employee->employee_id) }}">Bio’s</a>
                        </li>
                        <li class="nav-item">
                            <a class="active"
                                href="{{ route('superadmin.emaployee.contact.details', $employee->employee_id) }}">Contact
                                Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('superadmin.emaployee.credentials', $employee->employee_id) }}">Credentials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('superadmin.emaployee.department', $employee->employee_id) }}">Department
                                Supervisor(s)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('superadmin.emaployee.payroll', $employee->employee_id) }}">Payroll
                                Setup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('superadmin.emaployee.other.setup', $employee->employee_id) }}">Other
                                Setup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('superadmin.emaployee.leave.tracking', $employee->employee_id) }}">Leave
                                Tracking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('superadmin.emaployee.payor.exclusion', $employee->employee_id) }}">Insurance
                                Exclusion(s)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('superadmin.emaployee.subactivity.exclusion', $employee->employee_id) }}">Service
                                Sub-Type Exclusions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('superadmin.emaployee.client.exclusion', $employee->employee_id) }}">Patient
                                Exclusion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('superadmin.employee.portal', $employee->employee_id) }}">Staff
                                Portal</a>
                        </li>
                        {{-- <li class="nav-item"> --}}
                        {{-- <a class="nav-link" href="staff-activity.html">Staff Activity</a> --}}
                        {{-- </li> --}}
                    </ul>
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h2 class="common-title">Contact Details</h2>
                    <div class="accordion" id="contactaccordion">
                        <!-- accordion-item -->
                        <div class="accordion-item mb-3">
                            <a href="#item1" class="btn btn-primary text-left btn-block w-100"
                                data-toggle="collapse">Contact
                                Details</a>
                            <div class="collapse show border px-3 py-2" id="item1" data-parent="#contactaccordion">
                                <form action="{{ route('superadmin.emaployee.contact.details.update') }}" method="post"
                                    autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label>Address1</label>
                                            <input type="text" class="form-control form-control-sm" name="address_one"
                                                value="{{ $employee->address_one }}">
                                            <input type="hidden" class="form-control form-control-sm"
                                                name="employee_contact_edit" value="{{ $employee->employee_id }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Address2</label>
                                            <input type="text" class="form-control form-control-sm" name="address_two"
                                                value="{{ $employee->address_two }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control form-control-sm" name="city"
                                                value="{{ $employee->city }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>State</label>
                                            {{-- <select class="form-control form-control-sm" name="state">
                                                <option value="AL">Alabama</option>
                                                <option value="AK">Alaska</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AZ">Arizona</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="AE">Armed Forces Africa</option>
                                                <option value="AA">Armed Forces Americas (except Canada)</option>
                                                <option value="AE">Armed Forces Canada</option>
                                                <option value="AE">Armed Forces Europe</option>
                                                <option value="AE">Armed Forces Middle East</option>
                                                <option value="AP">Armed Forces Pacific</option>
                                                <option value="CA">California</option>
                                                <option value="CO">Colorado</option>
                                                <option value="CT">Connecticut</option>
                                                <option value="DE">Delaware</option>
                                                <option value="DC">District of Columbia</option>
                                                <option value="FM">Federated States of Micronesia</option>
                                                <option value="FL">Florida</option>
                                                <option value="GA">Georgia</option>
                                                <option value="GU">Guam</option>
                                                <option value="HI">Hawaii</option>
                                                <option value="ID">Idaho</option>
                                                <option value="IL">Illinois</option>
                                                <option value="IN">Indiana</option>
                                                <option value="IA">Iowa</option>
                                                <option value="KS">Kansas</option>
                                                <option value="KY">Kentucky</option>
                                                <option value="LA">Louisiana</option>
                                                <option value="ME">Maine</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MD">Maryland</option>
                                                <option value="MA">Massachusetts</option>
                                                <option value="MI">Michigan</option>
                                                <option value="MN">Minnesota</option>
                                                <option value="MS">Mississippi</option>
                                                <option value="MO">Missouri</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NV">Nevada</option>
                                                <option value="NH">New Hampshire</option>
                                                <option value="NJ">New Jersey</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="NY">New York</option>
                                                <option value="NC">North Carolina</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="MP">Northern Mariana Islands</option>
                                                <option value="OH">Ohio</option>
                                                <option value="OK">Oklahoma</option>
                                                <option value="OR">Oregon</option>
                                                <option value="PW">Palau</option>
                                                <option value="PA">Pennsylvania</option>
                                                <option value="PR">Puerto Rico</option>
                                                <option value="RI">Rhode Island</option>
                                                <option value="SC">South Carolina</option>
                                                <option value="SD">South Dakota</option>
                                                <option value="TN">Tennessee</option>
                                                <option value="TX">Texas</option>
                                                <option value="UT">Utah</option>
                                                <option value="VT">Vermont</option>
                                                <option value="VI">Virgin Islands</option>
                                                <option value="VA">Virginia</option>
                                                <option value="WA">Washington</option>
                                                <option value="WV">West Virginia</option>
                                                <option value="WI">Wisconsin</option>
                                                <option value="WY">Wyoming</option>
                                            </select> --}}
                                            <select class="form-control form-control-sm" name="state">
                                                <option value="AK" {{ $employee->state == 'AK' ? 'selected' : '' }}>
                                                    Alaska
                                                </option>
                                                <option value="AL" {{ $employee->state == 'AL' ? 'selected' : '' }}>
                                                    Alabama
                                                </option>
                                                <option value="AS" {{ $employee->state == 'AS' ? 'selected' : '' }}>
                                                    American Samoa
                                                </option>
                                                <option value="AZ" {{ $employee->state == 'AZ' ? 'selected' : '' }}>
                                                    Arizona
                                                </option>
                                                <option value="AR" {{ $employee->state == 'AR' ? 'selected' : '' }}>
                                                    Arkansas
                                                </option>
                                                <option value="CA" {{ $employee->state == 'CA' ? 'selected' : '' }}>
                                                    California
                                                </option>
                                                <option value="CO" {{ $employee->state == 'CO' ? 'selected' : '' }}>
                                                    Colorado
                                                </option>
                                                <option value="CT" {{ $employee->state == 'CT' ? 'selected' : '' }}>
                                                    Connecticut
                                                </option>
                                                <option value="DE" {{ $employee->state == 'DE' ? 'selected' : '' }}>
                                                    Delaware
                                                </option>
                                                <option value="DC" {{ $employee->state == 'DC' ? 'selected' : '' }}>
                                                    District of Columbia
                                                </option>
                                                <option value="FM" {{ $employee->state == 'FM' ? 'selected' : '' }}>
                                                    Federated States of Micronesia
                                                </option>
                                                <option value="FL" {{ $employee->state == 'FL' ? 'selected' : '' }}>
                                                    Florida
                                                </option>
                                                <option value="GA" {{ $employee->state == 'GA' ? 'selected' : '' }}>
                                                    Georgia
                                                </option>
                                                <option value="GU" {{ $employee->state == 'GU' ? 'selected' : '' }}>
                                                    Guam
                                                </option>
                                                <option value="HI" {{ $employee->state == 'HI' ? 'selected' : '' }}>
                                                    Hawaii
                                                </option>
                                                <option value="ID" {{ $employee->state == 'ID' ? 'selected' : '' }}>
                                                    Idaho
                                                </option>
                                                <option value="IL" {{ $employee->state == 'IL' ? 'selected' : '' }}>
                                                    Illinois
                                                </option>
                                                <option value="IN" {{ $employee->state == 'IN' ? 'selected' : '' }}>
                                                    Indiana
                                                </option>
                                                <option value="IA" {{ $employee->state == 'IA' ? 'selected' : '' }}>
                                                    Iowa
                                                </option>
                                                <option value="KS" {{ $employee->state == 'KS' ? 'selected' : '' }}>
                                                    Kansas
                                                </option>
                                                <option value="KY" {{ $employee->state == 'KY' ? 'selected' : '' }}>
                                                    Kentucky
                                                </option>
                                                <option value="LA" {{ $employee->state == 'LA' ? 'selected' : '' }}>
                                                    Louisiana
                                                </option>
                                                <option value="ME" {{ $employee->state == 'ME' ? 'selected' : '' }}>
                                                    Maine
                                                </option>
                                                <option value="MH" {{ $employee->state == 'MH' ? 'selected' : '' }}>
                                                    Marshall Islands
                                                </option>
                                                <option value="MD" {{ $employee->state == 'MD' ? 'selected' : '' }}>
                                                    Maryland
                                                </option>
                                                <option value="MA" {{ $employee->state == 'MA' ? 'selected' : '' }}>
                                                    Massachusetts
                                                </option>
                                                <option value="MI" {{ $employee->state == 'MI' ? 'selected' : '' }}>
                                                    Michigan
                                                </option>
                                                <option value="MN" {{ $employee->state == 'MN' ? 'selected' : '' }}>
                                                    Minnesota
                                                </option>
                                                <option value="MS" {{ $employee->state == 'MS' ? 'selected' : '' }}>
                                                    Mississippi
                                                </option>
                                                <option value="MO" {{ $employee->state == 'MO' ? 'selected' : '' }}>
                                                    Missouri
                                                </option>
                                                <option value="MT" {{ $employee->state == 'MT' ? 'selected' : '' }}>
                                                    Montana
                                                </option>
                                                <option value="NE" {{ $employee->state == 'NE' ? 'selected' : '' }}>
                                                    Nebraska
                                                </option>
                                                <option value="NV" {{ $employee->state == 'NV' ? 'selected' : '' }}>
                                                    Nevada
                                                </option>
                                                <option value="NH" {{ $employee->state == 'NH' ? 'selected' : '' }}>
                                                    New Hampshire
                                                </option>
                                                <option value="NJ" {{ $employee->state == 'NJ' ? 'selected' : '' }}>
                                                    New Jersey
                                                </option>
                                                <option value="NM" {{ $employee->state == 'NM' ? 'selected' : '' }}>
                                                    New Mexico
                                                </option>
                                                <option value="NY" {{ $employee->state == 'NY' ? 'selected' : '' }}>
                                                    New York
                                                </option>
                                                <option value="North Carolina"
                                                    {{ $employee->state == 'NC' ? 'selected' : '' }}>
                                                    North Carolina
                                                </option>
                                                <option value="ND" {{ $employee->state == 'ND' ? 'selected' : '' }}>
                                                    North Dakota
                                                </option>
                                                <option value="MP" {{ $employee->state == 'MP' ? 'selected' : '' }}>
                                                    Northern Mariana Islands
                                                </option>
                                                <option value="OH" {{ $employee->state == 'OH' ? 'selected' : '' }}>
                                                    Ohio
                                                </option>
                                                <option value="OK" {{ $employee->state == 'OK' ? 'selected' : '' }}>
                                                    Oklahoma
                                                </option>
                                                <option value="OR" {{ $employee->state == 'OR' ? 'selected' : '' }}>
                                                    Oregon
                                                </option>
                                                <option value="PW" {{ $employee->state == 'PW' ? 'selected' : '' }}>
                                                    Palau
                                                </option>
                                                <option value="PA" {{ $employee->state == 'PA' ? 'selected' : '' }}>
                                                    Pennsylvania
                                                </option>
                                                <option value="PR" {{ $employee->state == 'PR' ? 'selected' : '' }}>
                                                    Puerto Rico
                                                </option>
                                                <option value="RI" {{ $employee->state == 'RI' ? 'selected' : '' }}>
                                                    Rhode Island
                                                </option>
                                                <option value="SC" {{ $employee->state == 'SC' ? 'selected' : '' }}>
                                                    South Carolina
                                                </option>
                                                <option value="SD" {{ $employee->state == 'SD' ? 'selected' : '' }}>
                                                    South Dakota
                                                </option>
                                                <option value="TN" {{ $employee->state == 'TN' ? 'selected' : '' }}>
                                                    Tennessee
                                                </option>
                                                <option value="TX" {{ $employee->state == 'TX' ? 'selected' : '' }}>
                                                    Texas
                                                </option>
                                                <option value="UT" {{ $employee->state == 'UT' ? 'selected' : '' }}>
                                                    Utah
                                                </option>
                                                <option value="VT" {{ $employee->state == 'VT' ? 'selected' : '' }}>
                                                    Vermont
                                                </option>
                                                <option value="VI" {{ $employee->state == 'VI' ? 'selected' : '' }}>
                                                    Virgin Islands
                                                </option>
                                                <option value="VA" {{ $employee->state == 'VA' ? 'selected' : '' }}>
                                                    Virginia
                                                </option>
                                                <option value="WA" {{ $employee->state == 'WA' ? 'selected' : '' }}>
                                                    Washington
                                                </option>
                                                <option value="WV" {{ $employee->state == 'WV' ? 'selected' : '' }}>
                                                    West Virginia
                                                </option>
                                                <option value="WI" {{ $employee->state == 'WI' ? 'selected' : '' }}>
                                                    Wisconsin
                                                </option>
                                                <option value="WY" {{ $employee->state == 'WY' ? 'selected' : '' }}>
                                                    Wyoming
                                                </option>
                                                <option value="AE" {{ $employee->state == 'AE' ? 'selected' : '' }}>
                                                    Armed Forces Africa
                                                </option>
                                                <option value="AA (except Canada)"
                                                    {{ $employee->state == 'AA' ? 'selected' : '' }}>
                                                    Armed Forces Americas (except Canada)
                                                </option>
                                                <option value="AE" {{ $employee->state == 'AE' ? 'selected' : '' }}>
                                                    Armed Forces Canada
                                                </option>
                                                <option value="AE" {{ $employee->state == 'AE' ? 'selected' : '' }}>
                                                    Armed Forces Europe
                                                </option>
                                                <option value="AE" {{ $employee->state == 'AE' ? 'selected' : '' }}>
                                                    Armed Forces Middle East
                                                </option>
                                                <option value="AP" {{ $employee->state == 'AP' ? 'selected' : '' }}>
                                                    Armed Forces Pacific
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Zip</label>
                                            <input type="text" class="form-control form-control-sm" name="zip"
                                                value="{{ $employee->zip }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Mobile</label>
                                            <input type="text" class="form-control form-control-sm" name="mobile"
                                                value="{{ $employee->mobile }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Fax</label>
                                            <input type="text" class="form-control form-control-sm" name="fax"
                                                value="{{ $employee->fax }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Main Phone</label>
                                            <input type="text" class="form-control form-control-sm" name="main_phone"
                                                value="{{ $employee->main_phone }}">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Address Note</label>
                                            <textarea class="form-control form-control-sm" name="address_note">{!! $employee->address_note !!}</textarea>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <button type="submit" class="btn btn-sm btn-primary">Save Contact</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- accordion-item -->
                        <div class="accordion-item mb-3">
                            <a href="#item2" class="btn btn-primary text-left btn-block w-100"
                                data-toggle="collapse">Emergency
                                Contact Details</a>
                            <div class="collapse border px-3 py-2" id="item2" data-parent="#contactaccordion">
                                <form action="{{ route('superadmin.emaployee.emergency.contact.details.update') }}"
                                    method="post" autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label>Contact Name</label>
                                            <input type="text" class="form-control form-control-sm"
                                                name="em_contact_name" value="{{ $employee_em->contact_name }}">
                                            <input type="hidden" class="form-control form-control-sm"
                                                name="em_contact_update" value="{{ $employee_em->employee_id }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Address1</label>
                                            <input type="text" class="form-control form-control-sm"
                                                name="em_address_one" value="{{ $employee_em->address_one }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Address2</label>
                                            <input type="text" class="form-control form-control-sm"
                                                name="em_address_two" value="{{ $employee_em->address_two }}">
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3 form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control form-control-sm" name="em_city"
                                                value="{{ $employee_em->city }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>State</label>
                                            <select class="form-control form-control-sm" name="em_state">
                                                <option value="AL">Alabama</option>
                                                <option value="AK">Alaska</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AZ">Arizona</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="AE">Armed Forces Africa</option>
                                                <option value="AA">Armed Forces Americas (except Canada)</option>
                                                <option value="AE">Armed Forces Canada</option>
                                                <option value="AE">Armed Forces Europe</option>
                                                <option value="AE">Armed Forces Middle East</option>
                                                <option value="AP">Armed Forces Pacific</option>
                                                <option value="CA">California</option>
                                                <option value="CO">Colorado</option>
                                                <option value="CT">Connecticut</option>
                                                <option value="DE">Delaware</option>
                                                <option value="DC">District of Columbia</option>
                                                <option value="FM">Federated States of Micronesia</option>
                                                <option value="FL">Florida</option>
                                                <option value="GA">Georgia</option>
                                                <option value="GU">Guam</option>
                                                <option value="HI">Hawaii</option>
                                                <option value="ID">Idaho</option>
                                                <option value="IL">Illinois</option>
                                                <option value="IN">Indiana</option>
                                                <option value="IA">Iowa</option>
                                                <option value="KS">Kansas</option>
                                                <option value="KY">Kentucky</option>
                                                <option value="LA">Louisiana</option>
                                                <option value="ME">Maine</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MD">Maryland</option>
                                                <option value="MA">Massachusetts</option>
                                                <option value="MI">Michigan</option>
                                                <option value="MN">Minnesota</option>
                                                <option value="MS">Mississippi</option>
                                                <option value="MO">Missouri</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NV">Nevada</option>
                                                <option value="NH">New Hampshire</option>
                                                <option value="NJ">New Jersey</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="NY">New York</option>
                                                <option value="NC">North Carolina</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="MP">Northern Mariana Islands</option>
                                                <option value="OH">Ohio</option>
                                                <option value="OK">Oklahoma</option>
                                                <option value="OR">Oregon</option>
                                                <option value="PW">Palau</option>
                                                <option value="PA">Pennsylvania</option>
                                                <option value="PR">Puerto Rico</option>
                                                <option value="RI">Rhode Island</option>
                                                <option value="SC">South Carolina</option>
                                                <option value="SD">South Dakota</option>
                                                <option value="TN">Tennessee</option>
                                                <option value="TX">Texas</option>
                                                <option value="UT">Utah</option>
                                                <option value="VT">Vermont</option>
                                                <option value="VI">Virgin Islands</option>
                                                <option value="VA">Virginia</option>
                                                <option value="WA">Washington</option>
                                                <option value="WV">West Virginia</option>
                                                <option value="WI">Wisconsin</option>
                                                <option value="WY">Wyoming</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Zip</label>
                                            <input type="text" class="form-control form-control-sm" name="em_zip"
                                                value="{{ $employee_em->zip }}">
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3 form-group">
                                            <label>Mobile</label>
                                            <input type="text" class="form-control form-control-sm" name="em_mobile"
                                                value="{{ $employee_em->mobile }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Fax</label>
                                            <input type="text" class="form-control form-control-sm" name="em_fax"
                                                value="{{ $employee_em->fax }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Main Phone</label>
                                            <input type="text" class="form-control form-control-sm"
                                                name="em_main_phone" value="{{ $employee_em->main_phone }}">
                                        </div>
                                        <div class="col-md-12"></div>
                                        <div class="col-md-6 form-group">
                                            <label>Address Note</label>
                                            <textarea class="form-control form-control-sm" name="em_address_note">{!! $employee_em->address_note !!}</textarea>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <button type="submit" class="btn btn btn-primary">Save Emergency Contact
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- accordion-item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
