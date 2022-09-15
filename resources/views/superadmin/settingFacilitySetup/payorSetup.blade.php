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
                    <div class="table-responsive payor_table">
                        <table class="table table-sm table-bordered c_table">
                            <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="selectall">
                                    <label></label>
                                </th>
                                <th>Insurance</th>
                                <th>Is Electronic</th>
                                <th width="50px;">Cms1500 31</th>
                                <th width="50px;">Cms1500 32a</th>
                                <th width="50px;">Cms1500 32b</th>
                                <th width="50px;">Cms1500 33a</th>
                                <th width="50px;">Cms1500 33b</th>
                                <th>Active</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all_payor_fac as $a_payor)

                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox checkPayorSetup">
                                        <label></label>
                                        <input type="hidden" name="edit_payor" class="edit_payor"
                                               value="{{$a_payor->id}}"
                                               class="checkbox">
                                    </td>
                                    <td>{{$a_payor->payor_name}}</td>
                                    <td>
                                        {{--                                        <input type="checkbox"--}}
                                        {{--                                               name="is_electonic"--}}
                                        {{--                                               class="is_electonic" {{$a_payor->is_electronic == 1 ? 'checked':''}}>--}}
                                        {{--                                        <label></label>--}}
                                        @if ($a_payor->is_electronic == 1)
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="is_electonic"
                                                       id="tblen{{$a_payor->id}}" value="1"
                                                       checked>
                                                <label class="custom-control-label"
                                                       for="tblen{{$a_payor->id}}">Electronic</label>
                                            </div>
                                        @else
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="is_electonic"
                                                       id="tblen{{$a_payor->id}}" value="0"
                                                >
                                                <label class="custom-control-label"
                                                       for="tblen{{$a_payor->id}}">Electronic</label>
                                            </div>
                                        @endif


                                    </td>
                                    <td><input type="text" name="cms_1500_31"
                                               class="form-control form-control-sm cms_1500_31"
                                               value="{{$a_payor->cms_1500_31}}"></td>
                                    <td><input type="text" name="cms_1500_32a"
                                               class="form-control form-control-sm cms_1500_32a"
                                               value="{{$a_payor->cms_1500_32a}}"></td>
                                    <td><input type="text" name="cms_1500_32b"
                                               class="form-control form-control-sm cms_1500_32b"
                                               value="{{$a_payor->cms_1500_32b}}"></td>
                                    <td><input type="text" name="cms_1500_33a"
                                               class="form-control form-control-sm cms_1500_33a"
                                               value="{{$a_payor->cms_1500_33a}}"></td>
                                    <td><input type="text" name="cms_1500_33b"
                                               class="form-control form-control-sm cms_1500_33b"
                                               value="{{$a_payor->cms_1500_33b}}"></td>
                                    <td>
                                        {{--                                        <input type="checkbox" class="is_active"--}}
                                        {{--                                               name="is_active" {{$a_payor->is_active == 1 ? 'checked':''}}>--}}
                                        {{--                                        <label></label>--}}
                                        @if ($a_payor->is_active == 1)
                                            <div class="custom-control custom-switch ">
                                                <input type="checkbox" name="is_active"
                                                       class="custom-control-input tableactive"
                                                       id="tblai{{$a_payor->id}}"
                                                       checked>
                                                <label class="custom-control-label"
                                                       for="tblai{{$a_payor->id}}">Active</label>
                                            </div>
                                        @else
                                            <div class="custom-control custom-switch ">
                                                <input type="checkbox" name="is_active"
                                                       class="custom-control-input tableactive"
                                                       id="tblai{{$a_payor->id}}"
                                                >
                                                <label class="custom-control-label"
                                                       for="tblai{{$a_payor->id}}">In-Active</label>
                                            </div>
                                        @endif


                                    </td>
                                    <td><a href="#" class="edit_btn" data-id="{{$a_payor->id}}" title="Edit"><i
                                                class="ri-pencil-line text-primar"></i></a></td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        {{$all_payor_fac->links()}}
                    </div>
                    <button type="button" class="btn btn-sm btn-primary mb-2 save_payor">Save Payor Setup</button>
                    <!-- Edit Payor -->
                    <div class="edit_payor">
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label>CoPay Number</label>
                                    <input type="text" class="form-control form-control-sm copay_number" required>
                                    <input type="hidden" class="form-control form-control-sm payor_up_id" required>
                                    <div class="invalid-feedback">Enter CoPay Number</div>
                                </div>
                                <div class="col-md-3 mb-2 align-self-end">
                                    {{--                                    <div class="form-check">--}}
                                    {{--                                        <label class="form-check-label">--}}
                                    {{--                                            <input type="checkbox" class="form-check-input is_elec_edit" value="1">Is--}}
                                    {{--                                            Electronic--}}
                                    {{--                                        </label>--}}
                                    {{--                                    </div>--}}


                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input is_elec_edit" id="ie"
                                               checked>
                                        <label class="custom-control-label" for="ie">Is Electronic</label>
                                    </div>

                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Cms1500 31</label>
                                    <input type="text" class="form-control form-control-sm cms1500_31" required>
                                    <div class="invalid-feedback">Enter Cms1500 31</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Cms1500 32a</label>
                                    <input type="text" class="form-control form-control-sm cms1500_32a" required>
                                    <div class="invalid-feedback">Enter Cms1500 32a</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Cms1500 32b</label>
                                    <input type="text" class="form-control form-control-sm cms1500_32b" required>
                                    <div class="invalid-feedback">Enter Cms1500 32b</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Cms1500 33a</label>
                                    <input type="text" class="form-control form-control-sm cms1500_33a" required>
                                    <div class="invalid-feedback">Enter Cms1500 33a</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Cms1500 33b</label>
                                    <input type="text" class="form-control form-control-sm cms1500_33b" required>
                                    <div class="invalid-feedback">Enter Cms1500 33b</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Provider NPI</label>
                                    <input type="text" class="form-control form-control-sm npi" required>
                                    <div class="invalid-feedback">Enter Provider NPI</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>TaxId</label>
                                    <input type="text" class="form-control form-control-sm tax_id" required>
                                    <div class="invalid-feedback">Enter TaxId</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Main Taxonomy</label>
                                    <input type="text" class="form-control form-control-sm ssn" required>
                                    <div class="invalid-feedback">Enter Taxonomy/SSN</div>
                                </div>
                                <div class="col-md-6 mb-2 align-self-end">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input is_active_edit"
                                                       id="ain">
                                                <label class="custom-control-label" for="ain">Active</label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input box_17" id="fb"
                                                       checked>
                                                <label class="custom-control-label" for="fb">Is Fill
                                                    Box-17</label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input day_pay_cpt" id="dc"
                                                       checked>
                                                <label class="custom-control-label" for="dc">is
                                                    time required
                                                    Code</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>CMS1500 32 Address</label>
                                    <input type="text" class="form-control form-control-sm cms1500_32address" required>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>CMS1500 32 City</label>
                                    <input type="text" class="form-control form-control-sm cms1500_32city" required>
                                    <div class="invalid-feedback">Please Provide City</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>CMS1500 32 State</label>
                                    <select class="form-control form-control-sm cms1500_32state" required>
                                        <option value="AK">Alaska</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
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
                                        <option value="AE">Armed Forces Africa</option>
                                        <option value="AA">Armed Forces Americas (except Canada)
                                        </option>
                                        <option value="AE">Armed Forces Canada</option>
                                        <option value="AE">Armed Forces Europe</option>
                                        <option value="AE">Armed Forces Middle East</option>
                                        <option value="AP">Armed Forces Pacific</option>
                                    </select>
                                    <div class="invalid-feedback">Please Provide State</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>CMS1500 32 Zip</label>
                                    <input type="text" class="form-control form-control-sm cms1500_32zip" required>
                                    <div class="invalid-feedback">Please Provide Zip</div>
                                </div>

                                <div class="col-md-3 mb-2">
                                    <label>CMS1500 33 Address</label>
                                    <input type="text" class="form-control form-control-sm cms1500_33address" required>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>CMS1500 33 City</label>
                                    <input type="text" class="form-control form-control-sm cms1500_33city" required>
                                    <div class="invalid-feedback">Please Provide City</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>CMS1500 33 State</label>
                                    <select class="form-control form-control-sm cms1500_33state" required>
                                        <option value="AK">Alaska</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
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
                                        <option value="AE">Armed Forces Africa</option>
                                        <option value="AA">Armed Forces Americas (except Canada)
                                        </option>
                                        <option value="AE">Armed Forces Canada</option>
                                        <option value="AE">Armed Forces Europe</option>
                                        <option value="AE">Armed Forces Middle East</option>
                                        <option value="AP">Armed Forces Pacific</option>
                                    </select>
                                    <div class="invalid-feedback">Please Provide State</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>CMS1500 33 Zip</label>
                                    <input type="text" class="form-control form-control-sm cms1500_33zip" required>
                                    <div class="invalid-feedback">Please Provide Zip</div>
                                </div>


                                <div class="col-md-12">
                                    <table class="table-sm all_tx_types">


                                    </table>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-sm btn-primary mr-2" id="save">Save</button>
                            <button type="button" class="btn btn-sm btn-danger cancel_btn">Cancel</button>
                        </form>
                    </div>

                    <!-- Scrubbing Details --->

                    <div class="scrubbing_div">
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@include('superadmin.settingFacilitySetup.include.payorSetupDetails')
