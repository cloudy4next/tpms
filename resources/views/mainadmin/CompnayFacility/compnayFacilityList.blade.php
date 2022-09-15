@extends('layouts.MainAdmin')
@section('mainadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            <!-- Filter -->
            <div class="d-flex">
                <div class="mr-2">
                    <label>Company</label>
                </div>
                <div class="mr-2">
                    <select class="form-control selectcom all_compnay">
                        <option>Select Company</option>
                        <option>All Care - Matt</option>

                    </select>
                </div>
                <div class="ml-auto">
                    <button type="button" class="btn btn-primary addcom_btn">+ Add New Company</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        + Create Sub-Admin
                    </button>
                </div>
            </div>


            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Create Sub Admin </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('mainadmin.create.subadmin')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Facility</label>
                                    <select class="form-control s_admin_fac" name="s_admin_fac" required>
                                        <option value="">select admin</option>
                                        @foreach($all_facility_names as $a_fac)
                                            <option
                                                value="{{$a_fac->facility_name}}">{{$a_fac->facility_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Select Admin(*)</label>
                                    <select class="form-control up_admin_id" name="up_admin_id" required>
                                        <option value="">select admin</option>
                                        {{--                                        @foreach($all_admins as $aladmin)--}}
                                        {{--                                            <option--}}
                                        {{--                                                value="{{$aladmin->facility_name}}">{{$aladmin->first_name}} {{$aladmin->last_name}}</option>--}}
                                        {{--                                        @endforeach--}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>First Name(*)</label>
                                    <input type="text" class="form-control" name="sub_first_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Last Name(*)</label>
                                    <input type="text" class="form-control" name="sub_last_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Account Email(*)</label>
                                    <input type="email" class="form-control" name="sub_email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password (*)</label>
                                    <input type="text" class="form-control sub_password" name="sub_password" required>
                                    <span class="text-danger error_msg_subpass"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="accordion" id="accordionExample">
                <!-- Create Company -->
                <div class="com_detail mt-2">
                    <a href="#collapseOne" class="btn btn-primary text-left btn-block w-100" data-toggle="collapse">Company
                        Details</a>
                    <form action="#" class="needs-validation collapse show" id="collapseOne"
                          data-parent="#accordionExample" novalidate>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-12 mb-2 align-self-end">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input com_is_active" value="1">Active
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2 align-self-end">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control com_name" required>
                                    <input type="hidden" class="form-control is_edit" value="0">
                                    <input type="hidden" class="form-control edit_id" value="0">
                                    <div class="invalid-feedback">Enter Name</div>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2 align-self-end">
                                    <label>Address<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control com_address" required>
                                    <div class="invalid-feedback">Enter Address</div>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2 align-self-end">
                                    <label>City<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control com_city" required>
                                    <div class="invalid-feedback">Enter City</div>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2 align-self-end">
                                    <label>State<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control com_state" required>
                                    <div class="invalid-feedback">Enter State</div>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2 align-self-end">
                                    <label>Zip<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control com_zip" required>
                                    <div class="invalid-feedback">Enter Zip</div>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2 align-self-end">
                                    <label>Phone<span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control com_phone" required>
                                    <div class="invalid-feedback">Enter Phone</div>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2 align-self-end">
                                    <label>Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control com_email" required>
                                    <div class="invalid-feedback">Enter Email</div>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2 align-self-end">
                                    <label>Website</label>
                                    <input type="text" class="form-control com_website">
                                </div>
                                <div class="col-md-12 mt-2 align-self-end">
                                    <button type="submit" class="btn btn-primary mr-2" id="save_compnay">Save Company
                                        Details
                                    </button>
                                    <button type="button" class="btn btn-primary mr-2 addfacility_btn">Add New
                                        Facility
                                    </button>
                                    <button type="button" class="btn btn-danger cancel_btn">Cancel</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <!-- Add/Edit Facility -->
                <div class="addedit_facility mt-2">
                    <a href="#collapseTwo" class="btn btn-primary text-left btn-block w-100" data-toggle="collapse">Add/Edit
                        Facility</a>
                    <fieldset class="collapse" id="collapseTwo" data-parent="#accordionExample">
                        <form action="{{route('mainadmin.facility.save')}}" method="post" class="needs-validation"
                              novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Facility Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="facility_name" required>
                                    <input type="hidden" class="form-control comnay_id" name="compnay_id" required>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Main Contact Person<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>EIN<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ein" required>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Facility Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Office Start Time<span class="text-danger">*</span></label>
                                            <select class="form-control" required>
                                                <option value="None">None</option>
                                                <option value="05:00:00">05:00 AM</option>
                                                <option value="05:30:00">05:30 AM</option>
                                                <option value="06:00:00">06:00 AM</option>
                                                <option value="06:30:00">06:30 AM</option>
                                                <option value="07:00:00">07:00 AM</option>
                                                <option value="07:30:00">07:30 AM</option>
                                                <option value="08:00:00">08:00 AM</option>
                                                <option value="08:30:00">08:30 AM</option>
                                                <option value="09:00:00">09:00 AM</option>
                                                <option value="09:30:00">09:30 AM</option>
                                                <option value="10:00:00">10:00 AM</option>
                                                <option value="10:30:00">10:30 AM</option>
                                                <option value="11:00:00">11:00 AM</option>
                                                <option value="11:30:00">11:30 AM</option>
                                                <option value="12:00:00">12:00 PM</option>
                                                <option value="12:30:00">12:30 PM</option>
                                                <option value="13:00:00">01:00 PM</option>
                                                <option value="13:30:00">01:30 PM</option>
                                                <option value="14:00:00">02:00 PM</option>
                                                <option value="14:30:00">02:30 PM</option>
                                                <option value="15:00:00">03:00 PM</option>
                                                <option value="15:30:00">03:30 PM</option>
                                                <option value="16:00:00">04:00 PM</option>
                                                <option value="16:30:00">04:30 PM</option>
                                                <option value="17:00:00">05:00 PM</option>
                                                <option value="17:30:00">05:30 PM</option>
                                                <option value="18:00:00">06:00 PM</option>
                                                <option value="18:30:00">06:30 PM</option>
                                                <option value="19:00:00">07:00 PM</option>
                                                <option value="19:30:00">07:30 PM</option>
                                                <option value="20:00:00">08:00 PM</option>
                                                <option value="20:30:00">08:30 PM</option>
                                                <option value="21:00:00">09:00 PM</option>
                                                <option value="21:30:00">09:30 PM</option>
                                                <option value="22:00:00">10:00 PM</option>
                                                <option value="22:30:00">10:30 PM</option>
                                                <option value="23:00:00">11:00 PM</option>
                                                <option value="23:30:00">11:30 PM</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label>Office End Time<span class="text-danger">*</span></label>
                                            <select class="form-control" required>
                                                <option value="None">None</option>
                                                <option value="05:00:00">05:00 AM</option>
                                                <option value="05:30:00">05:30 AM</option>
                                                <option value="06:00:00">06:00 AM</option>
                                                <option value="06:30:00">06:30 AM</option>
                                                <option value="07:00:00">07:00 AM</option>
                                                <option value="07:30:00">07:30 AM</option>
                                                <option value="08:00:00">08:00 AM</option>
                                                <option value="08:30:00">08:30 AM</option>
                                                <option value="09:00:00">09:00 AM</option>
                                                <option value="09:30:00">09:30 AM</option>
                                                <option value="10:00:00">10:00 AM</option>
                                                <option value="10:30:00">10:30 AM</option>
                                                <option value="11:00:00">11:00 AM</option>
                                                <option value="11:30:00">11:30 AM</option>
                                                <option value="12:00:00">12:00 PM</option>
                                                <option value="12:30:00">12:30 PM</option>
                                                <option value="13:00:00">01:00 PM</option>
                                                <option value="13:30:00">01:30 PM</option>
                                                <option value="14:00:00">02:00 PM</option>
                                                <option value="14:30:00">02:30 PM</option>
                                                <option value="15:00:00">03:00 PM</option>
                                                <option value="15:30:00">03:30 PM</option>
                                                <option value="16:00:00">04:00 PM</option>
                                                <option value="16:30:00">04:30 PM</option>
                                                <option value="17:00:00">05:00 PM</option>
                                                <option value="17:30:00">05:30 PM</option>
                                                <option value="18:00:00">06:00 PM</option>
                                                <option value="18:30:00">06:30 PM</option>
                                                <option value="19:00:00">07:00 PM</option>
                                                <option value="19:30:00">07:30 PM</option>
                                                <option value="20:00:00">08:00 PM</option>
                                                <option value="20:30:00">08:30 PM</option>
                                                <option value="21:00:00">09:00 PM</option>
                                                <option value="21:30:00">09:30 PM</option>
                                                <option value="22:00:00">10:00 PM</option>
                                                <option value="22:30:00">10:30 PM</option>
                                                <option value="23:00:00">11:00 PM</option>
                                                <option value="23:30:00">11:30 PM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Service Area Miles<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="service_area_miles" required>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Default POS<span class="text-danger">*</span></label>
                                    <select class="form-control" name="default_pos" required>
                                        <option>As per Location</option>
                                        <option>Home (12)</option>
                                        <option>Office (11)</option>
                                        <option>Other Place of Service (99)</option>
                                        <option>School (03)</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>NPI<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="npi" required>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Virtual Number For SMS</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Default State</label>
                                    <input type="text" class="form-control" name="state">
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Taxonomy Code</label>
                                    <input type="text" class="form-control" name="taxonomy_code">
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2 align-self-end">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">Is Credential Facility
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Submit time sheet message</label>
                                    <textarea class="form-control" name="message"></textarea>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <p class="bg-dark text-white m-0 p-2">First Provider/Staff Details (required only
                                        during creation of facility)</p>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Staff's First Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="first_name" required>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Staff's Last Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="last_name" required>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Staff's Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Staff's DOB</label>
                                    <input type="date" class="form-control" name="dob">
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Staff's Gender</label>
                                    <select class="form-control" name="gender">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Staff's Phone</label>
                                    <input type="tel" class="form-control" name="phone">
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Staff's Fax</label>
                                    <input type="text" class="form-control" name="fax">
                                </div>
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <label>Staff's Account Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button type="submit" class="btn btn-primary mr-2">Save Facility Details</button>
                                    <button type="button" class="btn btn-danger cancel_facility">Cancel</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="my-3 text-success">Note: Placeholder Staff auto created</h6>
                        <div class="d-flex">
                            <div class="mr-3">
                                <label>NonBillableClient</label>
                            </div>
                            <div class="mr-3">
                                <input type="text" class="form-control">
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary">Mark as NonBillableClient</button>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <!-- Existing Facilities -->
                <div class="mt-2 exist_facility">
                    <a href="#collapseThree" class="btn btn-primary text-left btn-block w-100" data-toggle="collapse">Existing
                        Facilities</a>
                    <fieldset class="collapse" id="collapseThree" data-parent="#accordionExample">
                        <table class="table table-sm table-bordered mb-0 c_table">
                            <thead>
                            <tr>
                                <th>Facility Id</th>
                                <th>Name</th>
                                <th>Main Contact Person</th>
                                <th>Email</th>
                                <th>Phone 1</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all_facility as $fac)
                                <tr>
                                    <td>{{$fac->id}}</td>
                                    <td>{{$fac->facility_name}}</td>
                                    <td>{{$fac->facility_name}}</td>
                                    <td>{{$fac->email}}</td>
                                    <td>{{$fac->phone_one}}</td>
                                    <td><a href="#" class="detail_btn">Details</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$all_facility->links()}}
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('mainadmin.CompnayFacility.include.include_js')
