@extends('layouts.superadmin')
@section('superadmin')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="overflow-hidden mb-2">
                <div class="float-left">
                    <h5><a href="#" class="cmn_a">{{$employee->full_name}}</a> | <small><span
                                class="font-weight-bold text-orange">DOB:</span> {{$employee->staff_birthday != null ? \Carbon\Carbon::parse($employee->staff_birthday)->format('m/d/Y') : ''}}
                            | <small><span
                                    class="font-weight-bold text-orange">NPI:</span> {{$employee->individual_npi}} |
                                <span class=" font-weight-bold text-orange">Phone:</span> {{$employee->office_phone}}
                            </small></h5>
                </div>
                <div class="float-right">
                    <a href="{{route('superadmin.employee')}}" class="btn btn-sm btn-primary"><i
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
                                @if($employee->profile_photo==null)
                                    <img src="{{asset('assets/dashboard/')}}/images/user/01.jpg" class="img-fluid"
                                         id="photo"
                                         alt="aba+">
                                @else
                                    <img class="profile-pic" src="{{asset($employee->profile_photo)}}"
                                         alt="profile-pic" style="height: 100%">
                                @endif
                                <input type="file" id="file" class="d-none" autocomplete="nope">
                                <label for="file" id="uploadBtn">Upload Photo</label>
                            </div>
                        </li>
                        <!--/ Profile Picture -->
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{route('superadmin.emaployee.biographic',$employee->id)}}">Bio’s</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.contact.details',$employee->id)}}">Contact
                                Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.credentials',$employee->id)}}">Credentials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.department',$employee->id)}}">Department
                                Supervisor(s)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.payroll',$employee->id)}}">Payroll
                                Setup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.other.setup',$employee->id)}}">Other
                                Setup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.leave.tracking',$employee->id)}}">Leave
                                Tracking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.payor.exclusion',$employee->id)}}">Insurance
                                Exclusion(s)</a>
                        </li>
                        <li class="nav-item">
                            <a class="active"
                               href="{{route('superadmin.emaployee.subactivity.exclusion',$employee->id)}}">Service
                                Sub-Type Exclusions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.emaployee.client.exclusion',$employee->id)}}">Patient
                                Exclusion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('superadmin.employee.portal',$employee->id)}}">Staff
                                Portal</a>
                        </li>
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="staff-activity.html">Staff Activity</a>--}}
                        {{--                        </li>--}}
                    </ul>
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h2 class="common-title">Service Sub-Type Exclusion</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Service Sub-Type</label>
                            <select class="form-control-sm form-control all_sub_type" multiple>

                            </select>
                            <input type="hidden" class="employee_id" value="{{$employee->id}}"/>
                        </div>
                        <div class="col-md-4 mt-5">
                            <button type="button" class="btn btn-sm btn-primary" id="addsubtype">Exclude Selected
                                Service Sub-Type
                            </button>
                        </div>
                        <div class="col-md-4 assign_sub_act">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            //get all sub stype
            let getAllSubType = function () {
                let employee_id = $('.employee_id').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.employee.get.all.sub.type')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'employee_id': employee_id,
                    },
                    success: function (data) {
                        console.log(data)
                        $('.all_sub_type').empty();
                        $.each(data, function (index, value) {
                            $('.all_sub_type').append(
                                `<option value="${value.id}">${value.sub_activity}</option>`
                            )
                        });
                        $('.loading2').hide();
                    }
                });
            };

            getAllSubType();


            //get assign sub stype
            let getAssignSubType = function () {
                let employee_id = $('.employee_id').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.employee.get.assign.sub.type')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'employee_id': employee_id,
                    },
                    success: function (data) {
                        console.log(data)
                        $('.assign_sub_act').empty();
                        $('.assign_sub_act').html(data.view);
                        $('.loading2').hide();
                    }
                });
            };

            getAssignSubType();


            //add sub type
            $('#addsubtype').click(function () {
                let sub_activity_id = $('.all_sub_type').val();
                let employee_id = $('.employee_id').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.emaployee.subactivity.exclusion.save')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'sub_activity_id': sub_activity_id,
                        'employee_id': employee_id,
                    },
                    success: function (data) {
                        console.log(data)
                        getAllSubType();
                        getAssignSubType();
                        $('.loading2').hide();
                    }
                });
            });

            //delete sub act
            $(document).on('click', '.delete_sub_act', function () {
                let del_id = $(this).data('id');
                let employee_id = $('.employee_id').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.emaployee.subactivity.exclusion.delete')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'del_id': del_id,
                        'employee_id': employee_id,
                    },
                    success: function (data) {
                        console.log(data)
                        getAllSubType();
                        getAssignSubType();
                        $('.loading2').hide();
                    }
                });
            })

        })
    </script>
    <script>
        const imgDiv = document.querySelector('.profile-pic-div');
        const img = document.querySelector('#photo');
        const file = document.querySelector('#file');
        const uploadBtn = document.querySelector('#uploadBtn');
        file.addEventListener('change', function () {
            const choosedFile = this.files[0];
            if (choosedFile) {
                const reader = new FileReader();
                reader.addEventListener('load', function () {
                    img.setAttribute('src', reader.result);
                });
                reader.readAsDataURL(choosedFile);
            }
        });
    </script>
@endsection
