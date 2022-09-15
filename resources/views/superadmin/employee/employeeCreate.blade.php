@extends('layouts.superadmin')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/vendor/color/colorPick.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/vendor/color/colorPick.dark.theme.css">
@endsection
@section('superadmin')
    <div class="iq-card">
        <div class="iq-card-body">
            @if($employee == 'provider')
                <div class="overflow-hidden mb-2">
                    <div class="float-left">
                        <h5 class="common-title"> Provider</h5>
                    </div>
                    <div class="float-right">
                        <a href="{{route('superadmin.employee')}}" class="btn btn-sm btn-primary"><i
                                class="ri-arrow-left-circle-line mr-1 align-middle"></i>Back</a>
                    </div>
                </div>
            @else
                <div class="overflow-hidden mb-2">
                    <div class="float-left">
                        <h5 class="common-title"> Office Staff</h5>
                    </div>
                    <div class="float-right">
                        <a href="{{route('superadmin.employee')}}" class="btn btn-sm btn-primary"><i
                                class="ri-arrow-left-circle-line mr-1 align-middle"></i>Back</a>
                    </div>
                </div>
            @endif
            <form action="{{route('superadmin.employee.save')}}" method="post" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="fname">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="fname" name="first_name" required>
                        <input type="hidden" class="form-control form-control-sm" id="fname"
                               name="employee_type" value="{{$employee}}">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="mname">Middle Intial</label>
                        <input type="text" class="form-control form-control-sm" id="mname" name="middle_name">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lname">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="lname" name="last_name" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="nname">Nickname</label>
                        <input type="text" class="form-control form-control-sm" id="nname" name="nickname">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="bd">Staff Birthday <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-sm" id="bd" name="staff_birthday" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="ssn">SSN <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="ssn" name="ssn"
                               data-mask="00-0000000" placeholder="XX-YYYYYYY" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Office Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="office_phone"
                               data-mask="(000)-000-0000" pattern=".{14,}" placeholder="(XXX)-YYY-ZZZZ" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Office Fax</label>
                        <input type="text" class="form-control form-control-sm" name="office_fax">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Office Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control form-control-sm" name="office_email" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="d-block">Drivers License &amp; Expiration Date</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm mr-2" name="driver_license">
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="form-control form-control-sm" name="license_exp_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Title</label>
                        {{--                        <select class="form-control form-control-sm" name="title">--}}
                        {{--                            <option selected="selected" value=""></option>--}}
                        {{--                            @foreach($assign_type as $type)--}}
                        {{--                                <option value="{{$type->id}}">{{$type->type_name}}</option>--}}
                        {{--                            @endforeach--}}
                        {{--                        </select>--}}
                        <input type="text" class="form-control form-control-sm" name="title">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Hiring Date with Company</label>
                        <input type="date" class="form-control form-control-sm" name="hir_date_compnay">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Credential Type</label>
                        <select class="form-control form-control-sm" name="credential_type">
                            <option value="0">Select</option>
                            @foreach($employee_staff_type as $st_types)
                                <option
                                    value="{{$st_types->id}}">
                                    {{$st_types->type_name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Treatment Type</label>
                        <select class="form-control form-control-sm" name="treatment_type">
                            <option value="0">Select Treatment Type</option>
                            <option selected="selected" value="7">BT</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Individual NPI</label>
                        <input type="text" class="form-control form-control-sm" name="individual_npi">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>CAQH Id</label>
                        <input type="number" class="form-control form-control-sm" name="caqh_id">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Service Area Zip</label>
                        <input type="text" class="form-control form-control-sm" name="service_area_zip">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Termination Date</label>
                        <input type="date" class="form-control form-control-sm" name="terminated_date">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Language(s)</label>
                        <input type="text" class="form-control form-control-sm" name="language">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Taxonomy Code</label>
                        <input type="text" class="form-control form-control-sm" name="taxonomy_code">
                    </div>

                    <div class="col-md-3 form-group">
                        <label>Background Color</label>
                        <div class="colorPickSelector">
                            <input type="color" class="form-control form-control-sm d-none" name="back_color"
                                   value="">
                        </div>
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="d-block">Gender</label>
                        <div class="custom-control custom-radio custom-control-inline mb-1">
                            <input type="radio" id="male" name="gender" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="male">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline mb-1">
                            <input type="radio" id="female" name="gender" value="2"
                                   class="custom-control-input">
                            <label class="custom-control-label" for="female">Female</label>
                        </div>
                        {{--                                <div class="form-check">--}}
                        {{--                                    <input class="form-check-input" type="checkbox" value="1" id="ms" name="military_service" >--}}
                        {{--                                    <label class="form-check-label" for="ms">--}}
                        {{--                                        Military Service--}}
                        {{--                                    </label>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="form-check">--}}
                        {{--                                    <input class="form-check-input" type="checkbox" value="1" id="Therapist" name="therapist_bill">--}}
                        {{--                                    <label class="form-check-label" for="Therapist">--}}
                        {{--                                        Therapist Billable For Private Insurance--}}
                        {{--                                    </label>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="form-check">--}}
                        {{--                                    <input class="form-check-input" type="checkbox" value="1" id="actv" name="is_staff_active">--}}
                        {{--                                    <label class="form-check-label" for="actv">--}}
                        {{--                                        Is Staff Active--}}
                        {{--                                    </label>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="form-check">--}}
                        {{--                                    <input class="form-check-input" type="checkbox" value="1" id="encre" name="enable_fource_creation">--}}
                        {{--                                    <label class="form-check-label" for="encre">--}}
                        {{--                                        Enable Force Creation--}}
                        {{--                                    </label>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="form-check">--}}
                        {{--                                    <input class="form-check-input" type="checkbox" value="1" id="hasca" name="has_catalsty_access">--}}
                        {{--                                    <label class="form-check-label" for="hasca">--}}
                        {{--                                        Has Catalyst Access--}}
                        {{--                                    </label>--}}
                        {{--                                </div>--}}
                    </div>
                    {{--                            <div class="col-md-6 form-group">--}}
                    {{--                                <label>Notes</label>--}}
                    {{--                                <textarea class="form-control form-control-sm" name="notes"></textarea>--}}
                    {{--                            </div>--}}
                    <div class="col-md-12 form-group">
                        {{--                                <button type="submit" class="btn btn-sm btn-primary mr-3">Create/Manage Access</button>--}}
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/dashboard/')}}/vendor/color/colorPick.js"></script>
    <script>
        $(".colorPickSelector").colorPick({
            'initialColor': '#089bab',
            'allowRecent': false,
            'allowCustomColor': false,
            'palette': ["#089bab", "#dc3545", "#27b345", "#ffc107", "#343a40", "#003366", "#339966", "#ff0066",
                "#666699", "#993366", "#3333cc", "#009900", "#0066cc", "#660066", "#990000"
            ],
            'onColorSelected': function () {
                $(".colorPickSelector input").val(this.color);
                this.element.css({
                    'backgroundColor': this.color,
                });
            }
        });
    </script>
@endsection
