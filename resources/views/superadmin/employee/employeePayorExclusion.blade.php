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
                            <a class="active" href="{{route('superadmin.emaployee.payor.exclusion',$employee->id)}}">Insurance
                                Exclusion(s)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
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
                        {{--                    <li class="nav-item">--}}
                        {{--                        <a class="nav-link" href="staff-activity.html">Staff Activity</a>--}}
                        {{--                    </li>--}}
                    </ul>
                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h2 class="common-title">Insurance Exclusion</h2>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label>Insurance</label>
                            <select class="form-control-sm form-control all_payor" multiple>

                            </select>
                            <input type="hidden" class="employee_id" value="{{$employee->id}}">
                        </div>
                        <div class="col-md-4 text-center mt-5">
                            <button type="button" class="btn btn-sm btn-primary" id="add_payor">Exclude Selected
                                Insurances
                            </button>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-danger alert-dismissible fade show show_alert_msg" role="alert">
                                <strong>No Current Association</strong>
                                <button type="button" class="close text-dark" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="table-responsive show_ass_table">

                            </div>
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

            //show all payor

            $('.loading2').show();


            let getAllPayor = function () {
                $('.loading2').show();
                let employee_id_get = $('.employee_id').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.employee.show.all.payor')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'employee_id_get': employee_id_get

                    },
                    success: function (data) {

                        $('.all_payor').empty();
                        $.each(data, function (index, value) {
                            $('.all_payor').append(
                                `<option value="${value.id}">${value.payor_name}</option>`
                            )
                        });
                        $('.loading2').hide();
                    }
                });
            };

            getAllPayor();


            //show assign payor
            let show_all_assign_payor = function () {
                $('.loading2').show();
                let employee_id = $('.employee_id').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.employee.show.assign.payor')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'employee_id': employee_id,

                    },
                    success: function (data) {
                        if (data.notices.length > 0) {
                            $('.show_alert_msg').hide();
                        } else {
                            $('.show_alert_msg').show();
                        }
                        $('.show_ass_table').empty();
                        $('.show_ass_table').html(data.view);
                        $('.loading2').hide();
                    }
                });
            };

            show_all_assign_payor();


            //add payor

            $('#add_payor').click(function () {
                $('.loading2').show();
                let payor_id = $('.all_payor').val();
                let employee_id = $('.employee_id').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.employee.add.payor')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'payor_id': payor_id,
                        'employee_id': employee_id,

                    },
                    success: function (data) {
                        getAllPayor();
                        show_all_assign_payor();
                        $('.loading2').hide();
                    }
                });

            });


            //delete assign payor
            $(document).on('click', '.deleteasspayor', function () {
                $('.loading2').show();
                let del_id = $(this).data('id');
                let employee_id = $('.employee_id').val();

                console.log(del_id);

                $.ajax({
                    type: "POST",
                    url: "{{route('superadmin.employee.delete.assign.payor')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'del_id': del_id,
                        'employee_id': employee_id,

                    },
                    success: function (data) {

                        getAllPayor();
                        show_all_assign_payor();
                        $('.loading2').hide();
                    }
                });
            })


        });
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
