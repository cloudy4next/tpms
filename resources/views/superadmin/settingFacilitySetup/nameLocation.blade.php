@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu">
                    @include('superadmin.include.settingMenu')
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h5 class="common-title">Facility Setup</h5>
                    <!-- accordion -->
                    <div class="accordion" id="box-accordion">
                        <!-- accordion-item -->
                        <div class="accordion-item mb-3">
                            <a href="#item1" class="btn btn-primary text-left btn-block w-100" data-toggle="collapse">Box
                                No 33</a>
                            <div class="collapse show border px-3 py-2" id="item1" data-parent="#box-accordion">
                                <form action="{{ route('superadmin.setting.name.location.save') }}" method="post"
                                      class="needs-validation" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3 mb-2">
                                            <label>Facility Name</label>
                                            <input type="text" class="form-control form-control-sm" name="facility_name"
                                                   value="{{ $name_location->facility_name }}" required>
                                            <div class="invalid-feedback">Please Provide Facility Name</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Address</label>
                                            <input type="text" class="form-control form-control-sm" name="address"
                                                   value="{{ $name_location->address }}" required>
                                            <div class="invalid-feedback">Please Provide Address</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Address 2</label>
                                            <input type="text" class="form-control form-control-sm" name="address_two"
                                                   value="{{ $name_location->address_two }}">
                                            <div class="invalid-feedback">Please Provide Address</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>City</label>
                                            <input type="text" class="form-control form-control-sm" name="city"
                                                   value="{{ $name_location->city }}" required>
                                            <div class="invalid-feedback">Please Provide City</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>State</label>
                                            <select class="form-control form-control-sm" name="state" required>
                                                <option
                                                    value="AK" {{ $name_location->state == 'AK' ? 'selected' : '' }}>
                                                    Alaska
                                                </option>
                                                <option
                                                    value="AL" {{ $name_location->state == 'AL' ? 'selected' : '' }}>
                                                    Alabama
                                                </option>
                                                <option
                                                    value="AS" {{ $name_location->state == 'AS' ? 'selected' : '' }}>
                                                    American
                                                    Samoa
                                                </option>
                                                <option
                                                    value="AZ" {{ $name_location->state == 'AZ' ? 'selected' : '' }}>
                                                    Arizona
                                                </option>
                                                <option
                                                    value="AR" {{ $name_location->state == 'AR' ? 'selected' : '' }}>
                                                    Arkansas
                                                </option>
                                                <option
                                                    value="CA" {{ $name_location->state == 'CA' ? 'selected' : '' }}>
                                                    California
                                                </option>
                                                <option
                                                    value="CO" {{ $name_location->state == 'CO' ? 'selected' : '' }}>
                                                    Colorado
                                                </option>
                                                <option
                                                    value="CT" {{ $name_location->state == 'CT' ? 'selected' : '' }}>
                                                    Connecticut
                                                </option>
                                                <option
                                                    value="DE" {{ $name_location->state == 'DE' ? 'selected' : '' }}>
                                                    Delaware
                                                </option>
                                                <option
                                                    value="DC" {{ $name_location->state == 'DC' ? 'selected' : '' }}>
                                                    District
                                                    of Columbia
                                                </option>
                                                <option
                                                    value="FM" {{ $name_location->state == 'FM' ? 'selected' : '' }}>
                                                    Federated
                                                    States of Micronesia
                                                </option>
                                                <option
                                                    value="FL" {{ $name_location->state == 'FL' ? 'selected' : '' }}>
                                                    Florida
                                                </option>
                                                <option
                                                    value="GA" {{ $name_location->state == 'GA' ? 'selected' : '' }}>
                                                    Georgia
                                                </option>
                                                <option
                                                    value="GU" {{ $name_location->state == 'GU' ? 'selected' : '' }}>
                                                    Guam
                                                </option>
                                                <option
                                                    value="HI" {{ $name_location->state == 'HI' ? 'selected' : '' }}>
                                                    Hawaii
                                                </option>
                                                <option
                                                    value="ID" {{ $name_location->state == 'ID' ? 'selected' : '' }}>
                                                    Idaho
                                                </option>
                                                <option
                                                    value="IL" {{ $name_location->state == 'IL' ? 'selected' : '' }}>
                                                    Illinois
                                                </option>
                                                <option
                                                    value="IN" {{ $name_location->state == 'IN' ? 'selected' : '' }}>
                                                    Indiana
                                                </option>
                                                <option
                                                    value="IA" {{ $name_location->state == 'IA' ? 'selected' : '' }}>
                                                    Iowa
                                                </option>
                                                <option
                                                    value="KS" {{ $name_location->state == 'KS' ? 'selected' : '' }}>
                                                    Kansas
                                                </option>
                                                <option
                                                    value="KY" {{ $name_location->state == 'KY' ? 'selected' : '' }}>
                                                    Kentucky
                                                </option>
                                                <option
                                                    value="LA" {{ $name_location->state == 'LA' ? 'selected' : '' }}>
                                                    Louisiana
                                                </option>
                                                <option
                                                    value="ME" {{ $name_location->state == 'ME' ? 'selected' : '' }}>
                                                    Maine
                                                </option>
                                                <option
                                                    value="MH" {{ $name_location->state == 'MH' ? 'selected' : '' }}>
                                                    Marshall
                                                    Islands
                                                </option>
                                                <option
                                                    value="MD" {{ $name_location->state == 'MD' ? 'selected' : '' }}>
                                                    Maryland
                                                </option>
                                                <option
                                                    value="MA" {{ $name_location->state == 'MA' ? 'selected' : '' }}>
                                                    Massachusetts
                                                </option>
                                                <option
                                                    value="MI" {{ $name_location->state == 'MI' ? 'selected' : '' }}>
                                                    Michigan
                                                </option>
                                                <option
                                                    value="MN" {{ $name_location->state == 'MN' ? 'selected' : '' }}>
                                                    Minnesota
                                                </option>
                                                <option
                                                    value="MS" {{ $name_location->state == 'MS' ? 'selected' : '' }}>
                                                    Mississippi
                                                </option>
                                                <option
                                                    value="MO" {{ $name_location->state == 'MO' ? 'selected' : '' }}>
                                                    Missouri
                                                </option>
                                                <option
                                                    value="MT" {{ $name_location->state == 'MT' ? 'selected' : '' }}>
                                                    Montana
                                                </option>
                                                <option
                                                    value="NE" {{ $name_location->state == 'NE' ? 'selected' : '' }}>
                                                    Nebraska
                                                </option>
                                                <option
                                                    value="NV" {{ $name_location->state == 'NV' ? 'selected' : '' }}>
                                                    Nevada
                                                </option>
                                                <option
                                                    value="NH" {{ $name_location->state == 'NH' ? 'selected' : '' }}>New
                                                    Hampshire
                                                </option>
                                                <option
                                                    value="NJ" {{ $name_location->state == 'NJ' ? 'selected' : '' }}>New
                                                    Jersey
                                                </option>
                                                <option
                                                    value="NM" {{ $name_location->state == 'NM' ? 'selected' : '' }}>New
                                                    Mexico
                                                </option>
                                                <option
                                                    value="NY" {{ $name_location->state == 'NY' ? 'selected' : '' }}>New
                                                    York
                                                </option>
                                                <option
                                                    value="NC" {{ $name_location->state == 'NC' ? 'selected' : '' }}>
                                                    North
                                                    Carolina
                                                </option>
                                                <option
                                                    value="ND" {{ $name_location->state == 'ND' ? 'selected' : '' }}>
                                                    North
                                                    Dakota
                                                </option>
                                                <option
                                                    value="MP" {{ $name_location->state == 'MP' ? 'selected' : '' }}>
                                                    Northern
                                                    Mariana Islands
                                                </option>
                                                <option
                                                    value="OH" {{ $name_location->state == 'OH' ? 'selected' : '' }}>
                                                    Ohio
                                                </option>
                                                <option
                                                    value="OK" {{ $name_location->state == 'OK' ? 'selected' : '' }}>
                                                    Oklahoma
                                                </option>
                                                <option
                                                    value="OR" {{ $name_location->state == 'OR' ? 'selected' : '' }}>
                                                    Oregon
                                                </option>
                                                <option
                                                    value="PW" {{ $name_location->state == 'PW' ? 'selected' : '' }}>
                                                    Palau
                                                </option>
                                                <option
                                                    value="PA" {{ $name_location->state == 'PA' ? 'selected' : '' }}>
                                                    Pennsylvania
                                                </option>
                                                <option
                                                    value="PR" {{ $name_location->state == 'PR' ? 'selected' : '' }}>
                                                    Puerto
                                                    Rico
                                                </option>
                                                <option
                                                    value="RI" {{ $name_location->state == 'RI' ? 'selected' : '' }}>
                                                    Rhode
                                                    Island
                                                </option>
                                                <option
                                                    value="SC" {{ $name_location->state == 'SC' ? 'selected' : '' }}>
                                                    South
                                                    Carolina
                                                </option>
                                                <option
                                                    value="SD" {{ $name_location->state == 'SD' ? 'selected' : '' }}>
                                                    South
                                                    Dakota
                                                </option>
                                                <option
                                                    value="TN" {{ $name_location->state == 'TN' ? 'selected' : '' }}>
                                                    Tennessee
                                                </option>
                                                <option
                                                    value="TX" {{ $name_location->state == 'TX' ? 'selected' : '' }}>
                                                    Texas
                                                </option>
                                                <option
                                                    value="UT" {{ $name_location->state == 'UT' ? 'selected' : '' }}>
                                                    Utah
                                                </option>
                                                <option
                                                    value="VT" {{ $name_location->state == 'VT' ? 'selected' : '' }}>
                                                    Vermont
                                                </option>
                                                <option
                                                    value="VI" {{ $name_location->state == 'VI' ? 'selected' : '' }}>
                                                    Virgin
                                                    Islands
                                                </option>
                                                <option
                                                    value="VA" {{ $name_location->state == 'VA' ? 'selected' : '' }}>
                                                    Virginia
                                                </option>
                                                <option
                                                    value="WA" {{ $name_location->state == 'WA' ? 'selected' : '' }}>
                                                    Washington
                                                </option>
                                                <option
                                                    value="WV" {{ $name_location->state == 'WV' ? 'selected' : '' }}>
                                                    West
                                                    Virginia
                                                </option>
                                                <option
                                                    value="WI" {{ $name_location->state == 'WI' ? 'selected' : '' }}>
                                                    Wisconsin
                                                </option>
                                                <option
                                                    value="WY" {{ $name_location->state == 'WY' ? 'selected' : '' }}>
                                                    Wyoming
                                                </option>
                                                <option
                                                    value="AE" {{ $name_location->state == 'AE' ? 'selected' : '' }}>
                                                    Armed
                                                    Forces Africa
                                                </option>
                                                <option
                                                    value="AA" {{ $name_location->state == 'AA' ? 'selected' : '' }}>
                                                    Armed
                                                    Forces Americas (except Canada)
                                                </option>
                                                <option
                                                    value="AE" {{ $name_location->state == 'AE' ? 'selected' : '' }}>
                                                    Armed
                                                    Forces Canada
                                                </option>
                                                <option
                                                    value="AE" {{ $name_location->state == 'AE' ? 'selected' : '' }}>
                                                    Armed
                                                    Forces Europe
                                                </option>
                                                <option
                                                    value="AE" {{ $name_location->state == 'AE' ? 'selected' : '' }}>
                                                    Armed
                                                    Forces Middle East
                                                </option>
                                                <option
                                                    value="AP" {{ $name_location->state == 'AP' ? 'selected' : '' }}>
                                                    Armed
                                                    Forces Pacific
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">Please Provide State</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Zip</label>
                                            <input type="text" class="form-control form-control-sm" name="zip"
                                                   value="{{ $name_location->zip }}" required>
                                            <div class="invalid-feedback">Please Provide Zip</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Phone 1</label>
                                            <input type="text" class="form-control form-control-sm" name="phone_one"
                                                   value="{{ $name_location->phone_one }}" required
                                                   data-mask="(000)-000-0000" pattern=".{14,}" required=""
                                                   autocomplete="off" maxlength="14">
                                            <div class="invalid-feedback">Please Provide Phone</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Short Code</label>
                                            <input type="text" class="form-control form-control-sm" name="short_code"
                                                   value="{{ $name_location->short_code }}" required>
                                            <div class="invalid-feedback">Please Provide Short Code</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Email</label>
                                            <input type="text" class="form-control form-control-sm" name="email"
                                                   value="{{ $name_location->email }}" required>
                                            <div class="invalid-feedback">Please Provide Email</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>EIN</label>
                                            <input type="text" class="form-control form-control-sm" name="ein"
                                                   value="{{ $name_location->ein }}" required>
                                            <div class="invalid-feedback">Please Provide EIN</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>NPI</label>
                                            <input type="text" class="form-control form-control-sm" name="npi"
                                                   value="{{ $name_location->npi }}" required>
                                            <div class="invalid-feedback">Please Provide NPI</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Taxonomy</label>
                                            <input type="text" class="form-control form-control-sm" name="taxonomy"
                                                   value="{{ $name_location->taxonomy }}" required>
                                            <div class="invalid-feedback">Please Provide NPI</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Contact Person</label>
                                            <input type="text" class="form-control form-control-sm"
                                                   name="contact_person" value="{{ $name_location->contact_person }}"
                                                   required>
                                            <div class="invalid-feedback">Please Provide Contact Person
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Service Area Miles</label>
                                            <input type="text" class="form-control form-control-sm"
                                                   name="service_area_miles"
                                                   value="{{ $name_location->service_area_miles }}" required>
                                            <div class="invalid-feedback">Please Provide Service Area Miles
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>SFTP Username</label>
                                            <input type="text" class="form-control form-control-sm" name="ftp_username"
                                                   value="{{ $name_location->ftp_username }}" required>
                                            <div class="invalid-feedback">SFTP Username</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>SFTP Password</label>
                                            <input type="password" name="ftp_password"
                                                   value="{{ $name_location->ftp_password }}"
                                                   class="form-control form-control-sm" required>
                                            <div class="invalid-feedback">Please Provide SFTP Password</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Default POS</label>
                                            <select class="form-control form-control-sm" name="default_pos" required>
                                                <option value="">As per Location</option>
                                                @foreach($point_of_ser as $pons)
                                                    <option
                                                        value="{{$pons->pos_code}}" {{ $pons->pos_code == $name_location->default_pos ? 'selected' : '' }}>
                                                        {{$pons->pos_name}}
                                                        ({{$pons->pos_code}})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please Provide Default POS</div>
                                        </div>
                                        @php
                                            $tz_list = \App\Models\Timezone::orderBy('offset','ASC')->orderBy('name','ASC')->get();
                                        @endphp
                                        <div class="col-md-3 mb-2">
                                            <label>Default Timezone:</label>
                                            <select class="form-control form-control-sm" name="default_tz" required>
                                                <option value="0"
                                                        disabled {{$name_location->timezone==null?'selected':''}}>Set a
                                                    default timezone
                                                </option>
                                                @foreach($tz_list as $tz)
                                                    <option value="{{$tz->name}}" {{$name_location->timezone==$tz->name?'selected':''}}>{{'('.$tz->diff_from_gtm.') '.$tz->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please Provide Default POS</div>
                                        </div>
                                        <div class="col-md-2 mb-2 align-self-end">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_combo" value="1"
                                                       class="custom-control-input"
                                                       id="compocode" {{$name_location->is_combo == 1 ? 'checked' : ''}}>
                                                <label class="custom-control-label" for="compocode">Combo codes</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2 align-self-end">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="email_reminder" value="1"
                                                       class="custom-control-input"
                                                       id="emailReminder" {{$name_location->email_reminder == 1 ? 'checked' : ''}}>
                                                <label class="custom-control-label" for="emailReminder">Email Reminders</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Select Working Hours</label>
                                            <table class="table-sm working-hour-table">
                                                <tr>
                                                    <?php
                                                    $mon_start = \Carbon\Carbon::parse($wornking_hour->mon_start_time);
                                                    $mon_end = \Carbon\Carbon::parse($wornking_hour->mon_end_time)->format('g:i a');
                                                    ?>
                                                    <td>Monday</td>
                                                    <td><input type="time" name="mon_start"
                                                               class="form-control form-control-sm mon_start"></td>
                                                    <td>to</td>
                                                    <td><input type="time" name="mon_end"
                                                               class="form-control form-control-sm mon_end"
                                                        ></td>
                                                    <td>
                                                        <button type="button" class="btn p-0"><i
                                                                class="ri-add-circle-line"></i></button>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn p-0 " id="copy_times"><i
                                                                class="ri-file-copy-line "
                                                                id="copy_times"></i> Copy time to
                                                            all
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tuesday</td>
                                                    <td><input type="time" name="tues_start"
                                                               class="form-control form-control-sm copy_start tues_start">
                                                    </td>
                                                    <td>to</td>
                                                    <td><input type="time" name="tues_end"
                                                               class="form-control form-control-sm copy_end tues_end">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn p-0"><i
                                                                class="ri-add-circle-line"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Wednesday</td>
                                                    <td><input type="time" name="wed_start"
                                                               class="form-control form-control-sm copy_start wed_start">
                                                    </td>
                                                    <td>to</td>
                                                    <td><input type="time" name="wed_end"
                                                               class="form-control form-control-sm copy_end wed_end">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn p-0"><i
                                                                class="ri-add-circle-line"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Thursday</td>
                                                    <td><input type="time" name="thur_start"
                                                               class="form-control form-control-sm copy_start thur_start">
                                                    </td>
                                                    <td>to</td>
                                                    <td><input type="time" name="thur_end"
                                                               class="form-control form-control-sm copy_end thur_end">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn p-0"><i
                                                                class="ri-add-circle-line"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Friday</td>
                                                    <td><input type="time" name="fri_start"
                                                               class="form-control form-control-sm copy_start fri_start">
                                                    </td>
                                                    <td>to</td>
                                                    <td><input type="time" name="fri_end"
                                                               class="form-control form-control-sm copy_end fri_end">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn p-0"><i
                                                                class="ri-add-circle-line"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Saturday</td>
                                                    <td><input type="time" name="sat_start"
                                                               class="form-control form-control-sm copy_start sat_start">
                                                    </td>
                                                    <td>to</td>
                                                    <td><input type="time" name="sat_end"
                                                               class="form-control form-control-sm copy_end sat_end">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn p-0"><i
                                                                class="ri-add-circle-line"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sunday</td>
                                                    <td><input type="time" name="sun_start"
                                                               class="form-control form-control-sm copy_start sun_start">
                                                    </td>
                                                    <td>to</td>
                                                    <td><input type="time" name="sun_end"
                                                               class="form-control form-control-sm copy_end sun_end">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn p-0"><i
                                                                class="ri-add-circle-line"></i></button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <button class="btn btn-sm btn-primary mr-2 ladda-button"
                                                    data-style="expand-right">Save Facility
                                            </button>
                                            <button type="reset" class="btn btn-sm btn-danger"
                                                    onclick="window.location.reload();">Cancel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--/ accordion-item -->
                        <!-- accordion-item -->
                        <div class="accordion-item mb-3">
                            <a href="#item2" class="btn btn-primary text-left btn-block w-100" data-toggle="collapse">Box
                                No 32</a>
                            <div class="collapse border px-3 py-2" id="item2" data-parent="#box-accordion">
                                <form action="{{ route('superadmin.setting.name.location.box.two.save') }}"
                                      method="post" class="needs-validation" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3 mb-2">
                                            <label>Region Name</label>
                                            <input type="text" class="form-control form-control-sm" name="zone_name"
                                                   value="Main Zone" readonly required>
                                            <input type="hidden" class="form-control form-control-sm" name="box_32_id"
                                                   value="{{$name_location_box_two->id}}" required>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Facility Name</label>
                                            <input type="text" class="form-control form-control-sm"
                                                   name="facility_name_two"
                                                   value="{{$name_location_box_two->facility_name_two}}" required>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="row no-gutters">
                                                <div class="col-md-12">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="address" value="{{$name_location_box_two->address}}"
                                                           required>
                                                    <div class="invalid-feedback">Please Provide Address
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>City</label>
                                            <input type="text" class="form-control form-control-sm" name="city"
                                                   value="{{$name_location_box_two->city}}" required>
                                            <div class="invalid-feedback">Please Provide City</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>State</label>
                                            <select class="form-control form-control-sm" name="state" required>
                                                <option
                                                    value="AK" {{$name_location_box_two->state == "AK" ? 'selected' : ''}}>
                                                    Alaska
                                                </option>
                                                <option
                                                    value="AL" {{$name_location_box_two->state == "AL" ? 'selected' : ''}}>
                                                    Alabama
                                                </option>
                                                <option
                                                    value="AS" {{$name_location_box_two->state == "AS" ? 'selected' : ''}}>
                                                    American Samoa
                                                </option>
                                                <option
                                                    value="AZ" {{$name_location_box_two->state == "AZ" ? 'selected' : ''}}>
                                                    Arizona
                                                </option>
                                                <option
                                                    value="AR" {{$name_location_box_two->state == "AR" ? 'selected' : ''}}>
                                                    Arkansas
                                                </option>
                                                <option
                                                    value="CA" {{$name_location_box_two->state == "CA" ? 'selected' : ''}}>
                                                    California
                                                </option>
                                                <option
                                                    value="CO" {{$name_location_box_two->state == "CO" ? 'selected' : ''}}>
                                                    Colorado
                                                </option>
                                                <option
                                                    value="CT" {{$name_location_box_two->state == "CT" ? 'selected' : ''}}>
                                                    Connecticut
                                                </option>
                                                <option
                                                    value="DE" {{$name_location_box_two->state == "DE" ? 'selected' : ''}}>
                                                    Delaware
                                                </option>
                                                <option
                                                    value="DC" {{$name_location_box_two->state == "DC" ? 'selected' : ''}}>
                                                    District of Columbia
                                                </option>
                                                <option
                                                    value="FM" {{$name_location_box_two->state == "FM" ? 'selected' : ''}}>
                                                    Federated States of Micronesia
                                                </option>
                                                <option
                                                    value="FL" {{$name_location_box_two->state == "FL" ? 'selected' : ''}}>
                                                    Florida
                                                </option>
                                                <option
                                                    value="GA" {{$name_location_box_two->state == "GA" ? 'selected' : ''}}>
                                                    Georgia
                                                </option>
                                                <option
                                                    value="GU" {{$name_location_box_two->state == "GU" ? 'selected' : ''}}>
                                                    Guam
                                                </option>
                                                <option
                                                    value="HI" {{$name_location_box_two->state == "HI" ? 'selected' : ''}}>
                                                    Hawaii
                                                </option>
                                                <option
                                                    value="ID" {{$name_location_box_two->state == "ID" ? 'selected' : ''}}>
                                                    Idaho
                                                </option>
                                                <option
                                                    value="IL" {{$name_location_box_two->state == "IL" ? 'selected' : ''}}>
                                                    Illinois
                                                </option>
                                                <option
                                                    value="IN" {{$name_location_box_two->state == "IN" ? 'selected' : ''}}>
                                                    Indiana
                                                </option>
                                                <option
                                                    value="IA" {{$name_location_box_two->state == "IA" ? 'selected' : ''}}>
                                                    Iowa
                                                </option>
                                                <option
                                                    value="KS" {{$name_location_box_two->state == "KS" ? 'selected' : ''}}>
                                                    Kansas
                                                </option>
                                                <option
                                                    value="KY" {{$name_location_box_two->state == "KY" ? 'selected' : ''}}>
                                                    Kentucky
                                                </option>
                                                <option
                                                    value="LA" {{$name_location_box_two->state == "LA" ? 'selected' : ''}}>
                                                    Louisiana
                                                </option>
                                                <option
                                                    value="ME" {{$name_location_box_two->state == "ME" ? 'selected' : ''}}>
                                                    Maine
                                                </option>
                                                <option
                                                    value="MH" {{$name_location_box_two->state == "MH" ? 'selected' : ''}}>
                                                    Marshall Islands
                                                </option>
                                                <option
                                                    value="MD" {{$name_location_box_two->state == "MD" ? 'selected' : ''}}>
                                                    Maryland
                                                </option>
                                                <option
                                                    value="MA" {{$name_location_box_two->state == "MA" ? 'selected' : ''}}>
                                                    Massachusetts
                                                </option>
                                                <option
                                                    value="MI" {{$name_location_box_two->state == "MI" ? 'selected' : ''}}>
                                                    Michigan
                                                </option>
                                                <option
                                                    value="MN" {{$name_location_box_two->state == "MN" ? 'selected' : ''}}>
                                                    Minnesota
                                                </option>
                                                <option
                                                    value="MS" {{$name_location_box_two->state == "MS" ? 'selected' : ''}}>
                                                    Mississippi
                                                </option>
                                                <option
                                                    value="MO" {{$name_location_box_two->state == "MO" ? 'selected' : ''}}>
                                                    Missouri
                                                </option>
                                                <option
                                                    value="MT" {{$name_location_box_two->state == "MT" ? 'selected' : ''}}>
                                                    Montana
                                                </option>
                                                <option
                                                    value="NE" {{$name_location_box_two->state == "NE" ? 'selected' : ''}}>
                                                    Nebraska
                                                </option>
                                                <option
                                                    value="NV" {{$name_location_box_two->state == "NV" ? 'selected' : ''}}>
                                                    Nevada
                                                </option>
                                                <option
                                                    value="NH" {{$name_location_box_two->state == "NH" ? 'selected' : ''}}>
                                                    New Hampshire
                                                </option>
                                                <option
                                                    value="NJ" {{$name_location_box_two->state == "NJ" ? 'selected' : ''}}>
                                                    New Jersey
                                                </option>
                                                <option
                                                    value="NM" {{$name_location_box_two->state == "NM" ? 'selected' : ''}}>
                                                    New Mexico
                                                </option>
                                                <option
                                                    value="NY" {{$name_location_box_two->state == "NY" ? 'selected' : ''}}>
                                                    New York
                                                </option>
                                                <option
                                                    value="NC" {{$name_location_box_two->state == "NC" ? 'selected' : ''}}>
                                                    North Carolina
                                                </option>
                                                <option
                                                    value="ND" {{$name_location_box_two->state == "ND" ? 'selected' : ''}}>
                                                    North Dakota
                                                </option>
                                                <option
                                                    value="MP" {{$name_location_box_two->state == "MP" ? 'selected' : ''}}>
                                                    Northern Mariana Islands
                                                </option>
                                                <option
                                                    value="OH" {{$name_location_box_two->state == "OH" ? 'selected' : ''}}>
                                                    Ohio
                                                </option>
                                                <option
                                                    value="OK" {{$name_location_box_two->state == "OK" ? 'selected' : ''}}>
                                                    Oklahoma
                                                </option>
                                                <option
                                                    value="OR" {{$name_location_box_two->state == "OR" ? 'selected' : ''}}>
                                                    Oregon
                                                </option>
                                                <option
                                                    value="PW" {{$name_location_box_two->state == "PW" ? 'selected' : ''}}>
                                                    Palau
                                                </option>
                                                <option
                                                    value="PA" {{$name_location_box_two->state == "PA" ? 'selected' : ''}}>
                                                    Pennsylvania
                                                </option>
                                                <option
                                                    value="PR" {{$name_location_box_two->state == "PR" ? 'selected' : ''}}>
                                                    Puerto Rico
                                                </option>
                                                <option
                                                    value="RI" {{$name_location_box_two->state == "RI" ? 'selected' : ''}}>
                                                    Rhode Island
                                                </option>
                                                <option
                                                    value="SC" {{$name_location_box_two->state == "SC" ? 'selected' : ''}}>
                                                    South Carolina
                                                </option>
                                                <option
                                                    value="SD" {{$name_location_box_two->state == "SD" ? 'selected' : ''}}>
                                                    South Dakota
                                                </option>
                                                <option
                                                    value="TN" {{$name_location_box_two->state == "TN" ? 'selected' : ''}}>
                                                    Tennessee
                                                </option>
                                                <option
                                                    value="TX" {{$name_location_box_two->state == "TX" ? 'selected' : ''}}>
                                                    Texas
                                                </option>
                                                <option
                                                    value="UT" {{$name_location_box_two->state == "UT" ? 'selected' : ''}}>
                                                    Utah
                                                </option>
                                                <option
                                                    value="VT" {{$name_location_box_two->state == "VT" ? 'selected' : ''}}>
                                                    Vermont
                                                </option>
                                                <option
                                                    value="VI" {{$name_location_box_two->state == "VI" ? 'selected' : ''}}>
                                                    Virgin Islands
                                                </option>
                                                <option
                                                    value="VA" {{$name_location_box_two->state == "VA" ? 'selected' : ''}}>
                                                    Virginia
                                                </option>
                                                <option
                                                    value="WA" {{$name_location_box_two->state == "WA" ? 'selected' : ''}}>
                                                    Washington
                                                </option>
                                                <option
                                                    value="WV" {{$name_location_box_two->state == "WV" ? 'selected' : ''}}>
                                                    West Virginia
                                                </option>
                                                <option
                                                    value="WI" {{$name_location_box_two->state == "WI" ? 'selected' : ''}}>
                                                    Wisconsin
                                                </option>
                                                <option
                                                    value="WY" {{$name_location_box_two->state == "WY" ? 'selected' : ''}}>
                                                    Wyoming
                                                </option>
                                                <option
                                                    value="AE" {{$name_location_box_two->state == "AE" ? 'selected' : ''}}>
                                                    Armed Forces Africa
                                                </option>
                                                <option
                                                    value="AA" {{$name_location_box_two->state == "AA" ? 'selected' : ''}}>
                                                    Armed Forces Americas (except Canada)
                                                </option>
                                                <option
                                                    value="AE" {{$name_location_box_two->state == "AE" ? 'selected' : ''}}>
                                                    Armed Forces Canada
                                                </option>
                                                <option
                                                    value="AE" {{$name_location_box_two->state == "AE" ? 'selected' : ''}}>
                                                    Armed Forces Europe
                                                </option>
                                                <option
                                                    value="AE" {{$name_location_box_two->state == "AE" ? 'selected' : ''}}>
                                                    Armed Forces Middle East
                                                </option>
                                                <option
                                                    value="AP" {{$name_location_box_two->state == "AP" ? 'selected' : ''}}>
                                                    Armed Forces Pacific
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">Please Provide State</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Zip</label>
                                            <input type="text" class="form-control form-control-sm" name="zip"
                                                   value="{{$name_location_box_two->zip}}" required>
                                            <div class="invalid-feedback">Please Provide Zip</div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="row no-gutters">
                                                <div class="col-md-10">
                                                    <label>Phone 1</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="phone_one"
                                                           value="{{$name_location_box_two->phone_one}}" required
                                                           data-mask="(000)-000-0000" pattern=".{14,}" required=""
                                                           autocomplete="off" maxlength="14">
                                                    <div class="invalid-feedback">Please Provide Phone</div>
                                                </div>
                                                {{--                                                <div class="col-md-2 pl-2 align-self-end">--}}
                                                {{--                                                    <button type="button" class="btn btn-sm btn-primary"--}}
                                                {{--                                                            id="add_more_32" title="Add"><i class="ri-add-line"></i>--}}
                                                {{--                                                    </button>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                        </div>


                                        <div class="col-md-3 mb-2">
                                            <label>NPI</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm" name="npi"
                                                       value="{{$name_location_box_two->npi}}">
                                                <div class="input-group-append ml-2">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                            id="add_more_32" title="Add"><i class="ri-add-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <hr>
                                        </div>


                                        @foreach($name_location_box_data_new as $new_ox32)
                                            <div style="margin-top: 10px" class="col-md-12 removeexists32">
                                                <div class="row">
                                                    <div class="col-md-3 mb-2">
                                                        <label>Region Name</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="new_zone_name[]" value="{{$new_ox32->zone_name}}"
                                                               required>
                                                        {{--                                                        <input type="hidden" class="form-control form-control-sm"--}}
                                                        {{--                                                               name="box_32_id[]" value="{{$new_ox32->id}}" required>--}}
                                                        <input type="hidden" class="form-control form-control-sm"
                                                               name="edit_box_id[]" value="{{$new_ox32->id}}">
                                                    </div>
                                                    <div class="col-md-3 mb-2">
                                                        <label>Facility Name</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="new_facility_name_two[]"
                                                               value="{{$new_ox32->facility_name_two}}" required>
                                                    </div>
                                                    <div class="col-md-3 mb-2">
                                                        <div class="row ">
                                                            <div class="col-md-12">
                                                                <label>Address</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       name="new_address[]"
                                                                       value="{{$new_ox32->address}}" required>
                                                                <div class="invalid-feedback">Please Provide Address
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-2">
                                                        <label>City</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="new_city[]" value="{{$new_ox32->city}}" required>
                                                        <div class="invalid-feedback">Please Provide City</div>
                                                    </div>
                                                    <div class="col-md-3 mb-2">
                                                        <label>State</label>
                                                        <select class="form-control form-control-sm" name="new_state[]"
                                                                required>
                                                            <option
                                                                value="AK" {{$new_ox32->state == "AK" ? 'selected' : ''}}>
                                                                Alaska
                                                            </option>
                                                            <option
                                                                value="AL" {{$new_ox32->state == "AL" ? 'selected' : ''}}>
                                                                Alabama
                                                            </option>
                                                            <option
                                                                value="AS" {{$new_ox32->state == "AS" ? 'selected' : ''}}>
                                                                American Samoa
                                                            </option>
                                                            <option
                                                                value="AZ" {{$new_ox32->state == "AZ" ? 'selected' : ''}}>
                                                                Arizona
                                                            </option>
                                                            <option
                                                                value="AR" {{$new_ox32->state == "AR" ? 'selected' : ''}}>
                                                                Arkansas
                                                            </option>
                                                            <option
                                                                value="CA" {{$new_ox32->state == "CA" ? 'selected' : ''}}>
                                                                California
                                                            </option>
                                                            <option
                                                                value="CO" {{$new_ox32->state == "CO" ? 'selected' : ''}}>
                                                                Colorado
                                                            </option>
                                                            <option
                                                                value="CT" {{$new_ox32->state == "CT" ? 'selected' : ''}}>
                                                                Connecticut
                                                            </option>
                                                            <option
                                                                value="DE" {{$new_ox32->state == "DE" ? 'selected' : ''}}>
                                                                Delaware
                                                            </option>
                                                            <option
                                                                value="DC" {{$new_ox32->state == "DC" ? 'selected' : ''}}>
                                                                District of Columbia
                                                            </option>
                                                            <option
                                                                value="FM" {{$new_ox32->state == "FM" ? 'selected' : ''}}>
                                                                Federated States of Micronesia
                                                            </option>
                                                            <option
                                                                value="FL" {{$new_ox32->state == "FL" ? 'selected' : ''}}>
                                                                Florida
                                                            </option>
                                                            <option
                                                                value="GA" {{$new_ox32->state == "GA" ? 'selected' : ''}}>
                                                                Georgia
                                                            </option>
                                                            <option
                                                                value="GU" {{$new_ox32->state == "GU" ? 'selected' : ''}}>
                                                                Guam
                                                            </option>
                                                            <option
                                                                value="HI" {{$new_ox32->state == "HI" ? 'selected' : ''}}>
                                                                Hawaii
                                                            </option>
                                                            <option
                                                                value="ID" {{$new_ox32->state == "ID" ? 'selected' : ''}}>
                                                                Idaho
                                                            </option>
                                                            <option
                                                                value="IL" {{$new_ox32->state == "IL" ? 'selected' : ''}}>
                                                                Illinois
                                                            </option>
                                                            <option
                                                                value="IN" {{$new_ox32->state == "IN" ? 'selected' : ''}}>
                                                                Indiana
                                                            </option>
                                                            <option
                                                                value="IA" {{$new_ox32->state == "IA" ? 'selected' : ''}}>
                                                                Iowa
                                                            </option>
                                                            <option
                                                                value="KS" {{$new_ox32->state == "KS" ? 'selected' : ''}}>
                                                                Kansas
                                                            </option>
                                                            <option
                                                                value="KY" {{$new_ox32->state == "KY" ? 'selected' : ''}}>
                                                                Kentucky
                                                            </option>
                                                            <option
                                                                value="LA" {{$new_ox32->state == "LA" ? 'selected' : ''}}>
                                                                Louisiana
                                                            </option>
                                                            <option
                                                                value="ME" {{$new_ox32->state == "ME" ? 'selected' : ''}}>
                                                                Maine
                                                            </option>
                                                            <option
                                                                value="MH" {{$new_ox32->state == "MH" ? 'selected' : ''}}>
                                                                Marshall Islands
                                                            </option>
                                                            <option
                                                                value="MD" {{$new_ox32->state == "MD" ? 'selected' : ''}}>
                                                                Maryland
                                                            </option>
                                                            <option
                                                                value="MA" {{$new_ox32->state == "MA" ? 'selected' : ''}}>
                                                                Massachusetts
                                                            </option>
                                                            <option
                                                                value="MI" {{$new_ox32->state == "MI" ? 'selected' : ''}}>
                                                                Michigan
                                                            </option>
                                                            <option
                                                                value="MN" {{$new_ox32->state == "MN" ? 'selected' : ''}}>
                                                                Minnesota
                                                            </option>
                                                            <option
                                                                value="MS" {{$new_ox32->state == "MS" ? 'selected' : ''}}>
                                                                Mississippi
                                                            </option>
                                                            <option
                                                                value="MO" {{$new_ox32->state == "MO" ? 'selected' : ''}}>
                                                                Missouri
                                                            </option>
                                                            <option
                                                                value="MT" {{$new_ox32->state == "MT" ? 'selected' : ''}}>
                                                                Montana
                                                            </option>
                                                            <option
                                                                value="NE" {{$new_ox32->state == "NE" ? 'selected' : ''}}>
                                                                Nebraska
                                                            </option>
                                                            <option
                                                                value="NV" {{$new_ox32->state == "NV" ? 'selected' : ''}}>
                                                                Nevada
                                                            </option>
                                                            <option
                                                                value="NH" {{$new_ox32->state == "NH" ? 'selected' : ''}}>
                                                                New Hampshire
                                                            </option>
                                                            <option
                                                                value="NJ" {{$new_ox32->state == "NJ" ? 'selected' : ''}}>
                                                                New Jersey
                                                            </option>
                                                            <option
                                                                value="NM" {{$new_ox32->state == "NM" ? 'selected' : ''}}>
                                                                New Mexico
                                                            </option>
                                                            <option
                                                                value="NY" {{$new_ox32->state == "NY" ? 'selected' : ''}}>
                                                                New York
                                                            </option>
                                                            <option
                                                                value="NC" {{$new_ox32->state == "NC" ? 'selected' : ''}}>
                                                                North Carolina
                                                            </option>
                                                            <option
                                                                value="ND" {{$new_ox32->state == "ND" ? 'selected' : ''}}>
                                                                North Dakota
                                                            </option>
                                                            <option
                                                                value="MP" {{$new_ox32->state == "MP" ? 'selected' : ''}}>
                                                                Northern Mariana Islands
                                                            </option>
                                                            <option
                                                                value="OH" {{$new_ox32->state == "OH" ? 'selected' : ''}}>
                                                                Ohio
                                                            </option>
                                                            <option
                                                                value="OK" {{$new_ox32->state == "OK" ? 'selected' : ''}}>
                                                                Oklahoma
                                                            </option>
                                                            <option
                                                                value="OR" {{$new_ox32->state == "OR" ? 'selected' : ''}}>
                                                                Oregon
                                                            </option>
                                                            <option
                                                                value="PW" {{$new_ox32->state == "PW" ? 'selected' : ''}}>
                                                                Palau
                                                            </option>
                                                            <option
                                                                value="PA" {{$new_ox32->state == "PA" ? 'selected' : ''}}>
                                                                Pennsylvania
                                                            </option>
                                                            <option
                                                                value="PR" {{$new_ox32->state == "PR" ? 'selected' : ''}}>
                                                                Puerto Rico
                                                            </option>
                                                            <option
                                                                value="RI" {{$new_ox32->state == "RI" ? 'selected' : ''}}>
                                                                Rhode Island
                                                            </option>
                                                            <option
                                                                value="SC" {{$new_ox32->state == "SC" ? 'selected' : ''}}>
                                                                South Carolina
                                                            </option>
                                                            <option
                                                                value="SD" {{$new_ox32->state == "SD" ? 'selected' : ''}}>
                                                                South Dakota
                                                            </option>
                                                            <option
                                                                value="TN" {{$new_ox32->state == "TN" ? 'selected' : ''}}>
                                                                Tennessee
                                                            </option>
                                                            <option
                                                                value="TX" {{$new_ox32->state == "TX" ? 'selected' : ''}}>
                                                                Texas
                                                            </option>
                                                            <option
                                                                value="UT" {{$new_ox32->state == "UT" ? 'selected' : ''}}>
                                                                Utah
                                                            </option>
                                                            <option
                                                                value="VT" {{$new_ox32->state == "VT" ? 'selected' : ''}}>
                                                                Vermont
                                                            </option>
                                                            <option
                                                                value="VI" {{$new_ox32->state == "VI" ? 'selected' : ''}}>
                                                                Virgin Islands
                                                            </option>
                                                            <option
                                                                value="VA" {{$new_ox32->state == "VA" ? 'selected' : ''}}>
                                                                Virginia
                                                            </option>
                                                            <option
                                                                value="WA" {{$new_ox32->state == "WA" ? 'selected' : ''}}>
                                                                Washington
                                                            </option>
                                                            <option
                                                                value="WV" {{$new_ox32->state == "WV" ? 'selected' : ''}}>
                                                                West Virginia
                                                            </option>
                                                            <option
                                                                value="WI" {{$new_ox32->state == "WI" ? 'selected' : ''}}>
                                                                Wisconsin
                                                            </option>
                                                            <option
                                                                value="WY" {{$new_ox32->state == "WY" ? 'selected' : ''}}>
                                                                Wyoming
                                                            </option>
                                                            <option
                                                                value="AE" {{$new_ox32->state == "AE" ? 'selected' : ''}}>
                                                                Armed Forces Africa
                                                            </option>
                                                            <option
                                                                value="AA" {{$new_ox32->state == "AA" ? 'selected' : ''}}>
                                                                Armed Forces Americas (except Canada)
                                                            </option>
                                                            <option
                                                                value="AE" {{$new_ox32->state == "AE" ? 'selected' : ''}}>
                                                                Armed Forces Canada
                                                            </option>
                                                            <option
                                                                value="AE" {{$new_ox32->state == "AE" ? 'selected' : ''}}>
                                                                Armed Forces Europe
                                                            </option>
                                                            <option
                                                                value="AE" {{$new_ox32->state == "AE" ? 'selected' : ''}}>
                                                                Armed Forces Middle East
                                                            </option>
                                                            <option
                                                                value="AP" {{$new_ox32->state == "AP" ? 'selected' : ''}}>
                                                                Armed Forces Pacific
                                                            </option>
                                                        </select>
                                                        <div class="invalid-feedback">Please Provide State</div>
                                                    </div>
                                                    <div class="col-md-3 mb-2">
                                                        <label>Zip</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="new_zip[]" value="{{$new_ox32->zip}}" required>
                                                        <div class="invalid-feedback">Please Provide Zip</div>
                                                    </div>
                                                    <div class="col-md-3 mb-2">
                                                        <div class="row no-gutters">
                                                            <div class="col-md-10">
                                                                <label>Phone 1</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       name="new_phone_one[]"
                                                                       value="{{$new_ox32->phone_one}}" required
                                                                       data-mask="(000)-000-0000" pattern=".{14,}"
                                                                       required="" autocomplete="off" maxlength="14">
                                                                <div class="invalid-feedback">Please Provide Phone</div>
                                                            </div>
                                                            {{--                                                            <div class="col-md-2 pl-2 align-self-end">--}}
                                                            {{--                                                                <button class="btn btn-sm btn-danger remove_exists_32"--}}
                                                            {{--                                                                        data-id="{{$new_ox32->id}}" type="button"--}}
                                                            {{--                                                                        title="Delete"><i class="fa fa-trash"--}}
                                                            {{--                                                                                          aria-hidden="true"></i>--}}
                                                            {{--                                                                </button>--}}
                                                            {{--                                                            </div>--}}
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3 mb-2">
                                                        <label>NPI</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control form-control-sm"
                                                                   name="new_npi[]"
                                                                   value="{{$new_ox32->npi}}">
                                                            <div class="input-group-append ml-2">
                                                                <button class="btn btn-sm btn-danger remove_exists_32"
                                                                        data-id="{{$new_ox32->id}}" type="button"
                                                                        title="Delete"><i class="fa fa-trash"
                                                                                          aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                        @endforeach


                                        <div class="col-md-12 add_32_section"></div>


                                        <div class="col-md-12 mt-3">
                                            <button class="btn btn-sm btn-primary mr-2 ladda-button"
                                                    data-style="expand-right">Save Facility
                                            </button>
                                            <button type="reset" class="btn btn-sm btn-danger"
                                                    onclick="window.location.reload();">Cancel
                                            </button>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                        <!--/ accordion-item -->
                    </div>
                    <!--/ accordion -->
                </div>
            </div>
        </div>
    </div>
@endsection
@include('superadmin.settingFacilitySetup.include.namelocationinclude')
